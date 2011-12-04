"""
This is an indexer for ADAM XML documents.
"""

import sys, re, os, os.path
from optparse import make_option

import xml.dom.minidom as minidom
import whoosh.index, whoosh.fields

from django.core.management.base import BaseCommand, CommandError

from www.encyclopedia.models import Article


def cmpTextContent(x, y):
	xt = x.getAttribute("group")
	yt = y.getAttribute("group")
	if xt != yt:
		return cmp(xt, yt)
	xt = x.getAttribute("ordinal")
	yt = y.getAttribute("ordinal")
	return cmp(xt, yt)

def collectText(nodes):
	text = []
	for node in nodes:
		if node.nodeType == node.TEXT_NODE:
			text.append(node.data)
		else:
			text.append(collectText(node.childNodes))
	return " ".join(text)

def createIndex(output, quiet, index):
	# create a schema
	schema = whoosh.fields.Schema(
		title = whoosh.fields.TEXT(stored = True),
		fullTitle = whoosh.fields.STORED(),
		projectTypeId = whoosh.fields.STORED(),
		genContentId = whoosh.fields.STORED(),
		subContent = whoosh.fields.TEXT(stored = True),
		reviewedBy = whoosh.fields.TEXT(),
		body = whoosh.fields.TEXT(),
	)
	# prepare an index
	index = os.path.abspath(index)
	if not os.path.exists(index):
		os.makedirs(index)
		if not quiet:
			print >>output, "Creating new index in", index
	else:
		if not quiet:
			print >>output, "Clearing existing index in", index
	return whoosh.index.create_in(index, schema)

prohibited_characters = re.compile(r"[^a-z0-9_\-\s]")
space_underscore = re.compile(r"[\s_]")
dashes = re.compile(r"\-{2,}")

def update_article(title=None, article=None):
	# prepare title
	if not title:
		title = article.getAttribute("title")

	# prepare other fields
	language        = article.getAttribute("language")
	project_type_id = article.getAttribute("projectTypeID")
	gen_content_id  = article.getAttribute("genContentID")
	sub_content     = article.getAttribute("subContent")

	# get/create the article
	try:
		item = Article.objects.get(project_type_id__exact=project_type_id, gen_content_id__exact=gen_content_id)
	except Article.DoesNotExist:
		item = Article()

	# generate unique slug
	slug = re.sub(prohibited_characters, "", title.lower())
	slug = re.sub(space_underscore, "-", slug)
	slug = re.sub(dashes, "-", slug.strip("-"))
	i = 0
	t = slug
	while True:
		if item.slug == t:
			slug = t
			break
		try:
			Article.objects.get(slug__exact=t)
		except Article.DoesNotExist:
			slug = t
			break
		# try next combination
		i = i + 1
		t = slug + "-" + str(i)

	# update the fields
	item.slug            = slug
	item.title           = title
	item.language        = language
	item.project_type_id = project_type_id
	item.gen_content_id  = gen_content_id
	item.sub_content     = sub_content

	# save the result
	item.save()

def process(input, output, quiet, writer):
	dom = minidom.parse(input)
	adam = dom.getElementsByTagName("adamContent")[0]
	if not quiet:
		print >>output, "article:", adam.getAttribute("title"), adam.getAttribute("projectTypeID"), adam.getAttribute("genContentID")
	update_article(article=adam)
	doc = {
		"title":         adam.getAttribute("title").lower(),
		"fullTitle":     adam.getAttribute("title"),
		"projectTypeId": adam.getAttribute("projectTypeID"),
		"genContentId":  adam.getAttribute("genContentID"),
		"subContent":    adam.getAttribute("subContent"),
	}
	body = []
	if doc["title"]:
		body.append(doc["title"])
	textContent = sorted(adam.getElementsByTagName("textContent"), cmp = cmpTextContent)
	for textNode in textContent:
		title = textNode.getAttribute("title")
		text = collectText(textNode.childNodes)
		body.append(title + " " + text)
#		if title == "Alternative Names":
#			for name in [x.strip() for x in text.split(";") if x]:
#				update_article(article=adam, title=name)
	version = adam.getElementsByTagName("versionInfo")
	if version.length > 0:
		reviewedBy = version[0].getAttribute("reviewedBy")
		if reviewedBy:
			doc["reviewedBy"] = reviewedBy.lower()
			body.append(reviewedBy)
	doc["body"] = (" ".join(body)).lower()
	writer.add_document(**doc)
	dom.unlink()

file_pattern = re.compile(r"\.[xX][mM][lL]$")

class Command(BaseCommand):
	help = "Re-index ADAM articles."
	args = "[file ...]"
	option_list = BaseCommand.option_list + (
		make_option("-x", "--index", dest="index_dir", help="Directory where to create an index."),
	)

	def handle(self, *file_args, **options):
		# prepare
		index_dir = options.get("index_dir", None)
		if index_dir is None:
			raise CommandError("--index is a required option.")
		quiet = options.get("verbosity", "1") == "0"
		output = sys.stdout

		# create index
		ix = createIndex(output, quiet, index_dir)
		writer = ix.writer()

		# mark articles as obsolete
		Article.objects.all().update(language="zz")

		# process arguments
		for f in file_args:
			if os.path.isfile(f):
				process(f, output, quiet, writer)
				writer.commit()
			elif os.path.isdir(f):
				for root, dirs, files in os.walk(f):
					for name in files:
						if file_pattern.search(name):
							process(os.path.join(root, name), output, quiet, writer)
					writer.commit()

		# remove obsolete articles
		Article.objects.filter(language__exact="zz").delete()

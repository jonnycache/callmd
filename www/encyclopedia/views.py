from __future__ import with_statement

import os.path

from lxml import etree

from django.conf import settings
from django.http import HttpResponse, Http404, HttpResponsePermanentRedirect
from django.shortcuts import render_to_response
from django.template import RequestContext

from www.encyclopedia.models import Article


transform = None
getTitle = None
getLang = None
getSubCont = None

def redirect(request, projectTypeID, genContentID):
	try:
		article = Article.objects.get(project_type_id__exact=projectTypeID, gen_content_id__exact=genContentID)
	except:
		raise Http404
	return HttpResponsePermanentRedirect(article.get_absolute_url())

def format(request, projectTypeID, genContentID):
	# make sure that we have an XSLT processor ready
	global transform, getTitle, getLang, getSubCont
	if not transform:
		with open(settings.ADAM_XSLT) as f:
			transform = etree.XSLT(etree.parse(f))
		getTitle = etree.XPath("/adamContent/@title", smart_strings=False)
		getLang = etree.XPath("/adamContent/@language", smart_strings=False)
		getSubCont = etree.XPath("/adamContent/@subContent", smart_strings=False)
	# process the file
	try:
		with open(settings.ADAM_PATH % {"projectTypeID": projectTypeID, "genContentID": genContentID}) as f:
			doc = etree.parse(f)
	except IOError:
		raise Http404
	title = getTitle(doc)[0]
	language = getLang(doc)[0]
	subContent = getSubCont(doc)[0]
	result = etree.tostring(transform(doc))
	return render_to_response("adam.html",
		{
			"result": result,
			"title": title,
			"language": language,
			"subContent": subContent,
		},
		context_instance=RequestContext(request))

groups = {
	"images":          (u'imagepage',),
	"multimedia":      (u'multimedia',),
	"urology":         (u'Urology',),
	"poisons":         (u'Poison',),
	"symptoms":        (u'Symptoms',),
	"orthopedics":     (u'Orthopedics',),
	"surgeries":       (u'Surgery', u'General Surgery', u'Plastic Surgery', u'Thoracic Surgery',),
	"vascular":        (u'Vascular',),
	"tests":           (u'Test',),
	"first-aid":       (u'First Aid',),
	"birth-control":   (u'Birth Control',),
	"injuries":        (u'Injury',),
	"nutrition":       (u'Nutrition',),
	"pediatrics":      (u'Pediatrics',),
	"hematology":      (u'Hematology',),
	"ophthalmology":   (u'Ophthalmology',),
	"self-care":       (u'Self-Care Instructions',),
	"diseases":        (u'Disease',),
	"ear-nose-throat": (u'Ear, Nose, and Throat',),
	"special":         (u'SpecialTopic',),
	"neurology":       (u'Neurology',),
	"discharge":       (u'Discharge Instructions',),
	"questions":       (u'Questions To Ask Your Doctor',),
	"ob-gyn":          (u'Obstetrics/Gynecology (OB-GYN)',),
}
titles = {
	"imagepage":  "Images",
	"multimedia": "Multimedia Content",
	"nutrition":  "Nutrition, Vitamins & Special Diets",
	"tests":      "Tests",
	"injury":     "Injuries",
	"poison":     "Poisons",
}

exists_set = {}

def index(request):
	global groups, titles, exist_set
	
	# parse parameters
	sub_content = request.GET.get("content", "")
	page = request.GET.get("page", "a").lower()

	kwArgs = {}
	if sub_content:
		filter = sub_content in groups and groups[sub_content] or (sub_content,)
		kwArgs["sub_content__in"] = filter
	subset = Article.objects.filter(**kwArgs)
	if page == "0":
		kwArgs["title__regex"] = r"^[^a-z]"
	else:
		kwArgs["title__istartswith"] = page
	results = subset.filter(**kwArgs)
	
	if not sub_content in exists_set:
		t = []
		for x in xrange(ord("a"), ord("z") + 1):
			c = chr(x)
			t.append({"name": c, "title": c.upper(), "exist": len(subset.filter(title__istartswith=chr(x))[:1]) == 1})
		t.append({"name": "0", "title": "#0-9", "exist": len(subset.filter(title__regex=r"^[^a-z]")[:1]) == 1})
		exists_set[sub_content] = t

	total_len = len(results)
	right_len = total_len / 2
	left_len  = total_len - right_len
	left  = results[0:left_len]
	right = results[left_len:]
	title = sub_content and (sub_content in titles and titles[sub_content] or ", ".join(filter)) or "Encyclopedia"
	return render_to_response("adaminx.html",
		{
			"subContent": sub_content,
			"title": title,
			"page":  page,
			"count": total_len,
			"right": right,
			"left":  left,
			"index": exists_set[sub_content],
		},
		context_instance=RequestContext(request))

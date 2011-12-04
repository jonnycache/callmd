from django.conf import settings
from django.http import HttpResponse, HttpResponseRedirect
from django.shortcuts import render_to_response
from django.template import RequestContext

from whoosh.index import open_dir


searcher = None

def prepQuery(q):
	a = q.split()
	if "AND" in a or "OR" in a or "NOT" in a:
		return q
	return " OR ".join([x.lower() for x in a])

def getResults(request):
	q = request.GET.get("q", "")
	results = []
	if not q:
		return (results, "")
	pq = prepQuery(q)
	global searcher
	if not searcher:
		index = open_dir(settings.WHOOSH_INDEX)
		searcher = index.searcher()
	found = searcher.find("title", pq)
	found.upgrade_and_extend(searcher.find("body", pq))
	# convert to simple JSON object
	for x in found:
		results.append({
			"title":         x["fullTitle"],
			"projectTypeId": x["projectTypeId"],
			"genContentId":  x["genContentId"],
			"subContent":    x["subContent"],
		})
	return (results, q)

def result(request):
	results, q = getResults(request)
	# if no results => show symptoms
	if not results:
		return HttpResponseRedirect("/encyclopedia/home/")
	# check if we have a direct match
	projectTypeId = "";
	genContentId = ""
	query = q.lower()
	for item in results:
		if item["title"].lower() == query:
			if item["projectTypeId"] == "1":
				return HttpResponseRedirect("/encyclopedia/%s/%s/" % (item["projectTypeId"], item["genContentId"]))
			if not projectTypeId or item["projectTypeId"] < projectTypeId:
				projectTypeId = item["projectTypeId"]
				genContentId = item["genContentId"]
	if projectTypeId:
		return HttpResponseRedirect("/encyclopedia/%s/%s/" % (projectTypeId, genContentId))
	# show what we found
	return render_to_response("result.html", {"results": results, "query": q}, context_instance=RequestContext(request))

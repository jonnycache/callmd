import re

from django import http
from django.conf import settings

from www.encyclopedia.models import Article
from www.encyclopedia.views  import format


encyclopedia_article = re.compile(r"/(?P<sect>[a-z0-9\-]+)/(?P<slug>[a-z0-9\-]+)/?")

class EncyclopediaFallbackMiddleware(object):
	def process_response(self, request, response):
		if response.status_code != 404:
			return response # No need to check for a redirect for non-404 responses.
		path = request.get_full_path()
		match = encyclopedia_article.match(path)
		if match:
			try:
				article = Article.objects.get(slug__exact=match.group("slug"))
				if match.group("sect") == (article.section and article.section.name or "encyclopedia"):
					return format(request, article.project_type_id, article.gen_content_id)
			except:
				pass
		# No article was found. Return the response.
		return response

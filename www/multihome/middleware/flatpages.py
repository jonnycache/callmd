from django.conf import settings
from django.http import Http404, HttpResponse, HttpResponseRedirect
from django.shortcuts import get_object_or_404

from django.contrib.flatpages.models import FlatPage
from django.contrib.sites.models import Site

from django.template import loader, RequestContext
from django.core.xheaders import populate_xheaders
from django.utils.safestring import mark_safe

from www.multihome.middleware.current_request import get_current_request

class FlatpageFallbackMiddleware(object):
    def process_response(self, request, response):
        if response.status_code != 404:
            return response # No need to check for a flatpage for non-404 responses.
        try:
            return flatpage(request, request.path_info)
        # Return the original response if any errors happened. Because this
        # is a middleware, we can't assume the errors will be caught elsewhere.
        except Http404:
            return response
        except:
            if settings.DEBUG:
                raise
            return response

DEFAULT_TEMPLATE = 'flatpages/default.html'

def flatpage(request, url):
	if not url.endswith('/') and settings.APPEND_SLASH:
		return HttpResponseRedirect("%s/" % request.path)
	if not url.startswith('/'):
		url = "/" + url
	try:
		s = Site.objects.get(domain__exact=get_current_request().get_host())
	except:
		s = Site.objects.all()[0]
	try:
		f = get_object_or_404(FlatPage, url__exact=url, sites__id__exact=s.id)
	except Http404:
		if not url.endswith('/'):
			url = url + '/'
		else:
			url = url[:-1]
		f = get_object_or_404(FlatPage, url__exact=url, sites__id__exact=s.id)
	# If registration is required for accessing this page, and the user isn't
	# logged in, redirect to the login page.
	if f.registration_required and not request.user.is_authenticated():
		from django.contrib.auth.views import redirect_to_login
		return redirect_to_login(request.path)
	if f.template_name:
		t = loader.select_template((f.template_name, DEFAULT_TEMPLATE))
	else:
		t = loader.get_template(DEFAULT_TEMPLATE)

	# To avoid having to always use the "|safe" filter in flatpage templates,
	# mark the title and content as already safe (since they are raw HTML
	# content in the first place).
	f.title = mark_safe(f.title)
	f.content = mark_safe(f.content)

	c = RequestContext(request, {
		'flatpage': f,
	})
	response = HttpResponse(t.render(c))
	populate_xheaders(request, response, FlatPage, f.id)
	return response

from django.conf.urls.defaults import *

urlpatterns = patterns('www.encyclopedia.views',
	(r'^/?$', 'index'),
	(r'^index/?$', 'index'),
	(r'^(?P<projectTypeID>\d+)/(?P<genContentID>\d+)/?$', 'redirect'),
)

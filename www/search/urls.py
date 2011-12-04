from django.conf.urls.defaults import *

urlpatterns = patterns('www.search.views',
	(r'^$', 'result'),
)

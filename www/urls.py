from django.conf.urls.defaults import *

# Uncomment the next two lines to enable the admin:
from django.contrib import admin
admin.autodiscover()

urlpatterns = patterns('',
	(r'^search/', include('www.search.urls')),
	(r'^encyclopedia/', include('www.encyclopedia.urls')),
	(r'^merchant/', include('www.merchant.urls')),
	(r'^admin/doc/', include('django.contrib.admindocs.urls')),
	(r'^admin/', include(admin.site.urls)),
)

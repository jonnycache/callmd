# Django settings for www project.

DEBUG = True
#DEBUG = False
TEMPLATE_DEBUG = DEBUG

ADMINS = (
	('Eugene Lazutkin', 'eugene.lazutkin@gmail.com'),
)

MANAGERS = ADMINS

DATABASE_ENGINE = 'postgresql_psycopg2' # 'postgresql_psycopg2', 'postgresql', 'mysql', 'sqlite3' or 'oracle'.
DATABASE_NAME = 'callmd'                # Or path to database file if using sqlite3.
DATABASE_USER = 'postgres'              # Not used with sqlite3.
DATABASE_PASSWORD = '3x2sof'            # Not used with sqlite3.
DATABASE_HOST = ''                      # Set to empty string for localhost. Not used with sqlite3.
DATABASE_PORT = ''                      # Set to empty string for default. Not used with sqlite3.

# Local time zone for this installation. Choices can be found here:
# http://en.wikipedia.org/wiki/List_of_tz_zones_by_name
# although not all choices may be available on all operating systems.
# If running in a Windows environment this must be set to the same as your
# system time zone.
TIME_ZONE = 'America/Chicago'

# Language code for this installation. All choices can be found here:
# http://www.i18nguy.com/unicode/language-identifiers.html
LANGUAGE_CODE = 'en-us'

SITE_ID = 1

# If you set this to False, Django will make some optimizations so as not
# to load the internationalization machinery.
USE_I18N = False

# Absolute path to the directory that holds media.
# Example: "/home/media/media.lawrence.com/"
MEDIA_ROOT = '/opt/code/callmd/media/'

# URL that handles the media served from MEDIA_ROOT. Make sure to use a
# trailing slash if there is a path component (optional in other cases).
# Examples: "http://media.lawrence.com", "http://example.com/media/"
MEDIA_URL = ''

# URL prefix for admin media -- CSS, JavaScript and images. Make sure to use a
# trailing slash.
# Examples: "http://foo.com/media/", "/media/".
ADMIN_MEDIA_PREFIX = '/admedia/'

# Make this unique, and don't share it with anybody.
SECRET_KEY = '3f6_*1(*$h#nasjpcu(#zu%y$_mi-(+_t5j&56%n6h9bw#gbd)'

# List of callables that know how to import templates from various sources.
TEMPLATE_LOADERS = (
	'www.multihome.loader.load_template_source',
	'django.template.loaders.filesystem.load_template_source',
	'django.template.loaders.app_directories.load_template_source',
#	 'django.template.loaders.eggs.load_template_source',
)

MIDDLEWARE_CLASSES = (
	#'django.middleware.cache.UpdateCacheMiddleware',
	'django.middleware.common.CommonMiddleware',
	'django.contrib.sessions.middleware.SessionMiddleware',
	'django.contrib.auth.middleware.AuthenticationMiddleware',
	#'django.middleware.cache.FetchFromCacheMiddleware',
	'django.middleware.http.ConditionalGetMiddleware',
	'www.multihome.middleware.current_request.RegisterRequestMiddleware',
	'www.multihome.middleware.current_request.UnregisterRequestMiddleware',
	'www.multihome.middleware.flatpages.FlatpageFallbackMiddleware',
	'django.contrib.redirects.middleware.RedirectFallbackMiddleware',
	'www.encyclopedia.middleware.EncyclopediaFallbackMiddleware',
)

ROOT_URLCONF = 'www.urls'

TEMPLATE_DIRS = (
	'/opt/code/callmd/www/templates/',
)

INSTALLED_APPS = (
	'django.contrib.auth',
	'django.contrib.contenttypes',
	'django.contrib.sessions',
	'django.contrib.sites',
	'django.contrib.admin',
	'django.contrib.admindocs',
	'django.contrib.flatpages',
	'django.contrib.redirects',
	'django.contrib.sitemaps',
	'www.search',
	'www.encyclopedia',
	'www.merchant',
)

APPEND_SLASH = False
#PREPEND_WWW = True

# Caching settings

if not DEBUG:
	USE_ETAGS = True
	CACHE_SECONDS = 600
	#CACHE_BACKEND = 'db://cache/?max_entries=1000&cull_frequency=5'
	#CACHE_BACKEND = 'locmem:///?max_entries=10&cull_percentage=2'
	CACHE_BACKEND = 'memcached://127.0.0.1:11211/?max_entries=1000&cull_frequency=5'
	CACHE_MIDDLEWARE_SECONDS = CACHE_SECONDS
	CACHE_MIDDLEWARE_KEY_PREFIX = 'callmd.com'
	CACHE_MIDDLEWARE_ANONYMOUS_ONLY = True

# Whoosh settings

WHOOSH_INDEX = '/opt/code/callmd/data/index/'

# ADAM encyclopedia settings

ADAM_PATH = '/opt/code/callmd/data/xml/HIE Multimedia/%(projectTypeID)s/%(genContentID)s.xml'
ADAM_XSLT = '/opt/code/callmd/adam/to_html.xslt'

# Merchant settings

MERCHANT_URL = "https://secure.networkmerchants.com/cart/cart.php"
MERCHANT_USERNAME = ")a-mb/_UPVJ0_?21|#b(+2Nk8?f,IH:7"
MERCHANT_KEY_ID = "468499"
MERCHANT_ACTION = "process_cart"

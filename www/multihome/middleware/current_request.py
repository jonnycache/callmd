try:
	from threading import local
except ImportError:
	from django.utils._threading_local import local

_current_request = local()

def get_current_request():
    return getattr(_current_request, 'request', None)

class RegisterRequestMiddleware(object):
	def process_request(self, request):
		_current_request.request = request

class UnregisterRequestMiddleware(object):
	def process_response(self, request, response):
		_current_request.request = None
		return response

from django.template.loaders.filesystem import load_template_source as filesystem_load_template_source
from django.template import TemplateDoesNotExist

from www.multihome.middleware.current_request import get_current_request

def load_template_source(template_name, template_dirs=None):
	request = get_current_request()
	if not request:
		raise TemplateDoesNotExist('Request is not defined to extract host name.')
	host = request.get_host()
	if not host:
		raise TemplateDoesNotExist('Host is not defined.')
	return filesystem_load_template_source(host + '/' + template_name, template_dirs)
load_template_source.is_usable = True

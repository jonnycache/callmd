# a merchant link: views

from django.conf import settings
from django.http import HttpResponse, Http404
from django.shortcuts import render_to_response
from django.template import RequestContext

import md5
import urllib

def link(request):
	if not request.POST:
		raise Http404
	# create fields
	fields = []
	fields.append(("action", request.POST.get("Action", settings.MERCHANT_ACTION)))
	fields.append(("product_description_1", request.POST.get("Description", "")))
	fields.append(("product_sku_1", request.POST.get("sku", "BK001")))
	fields.append(("product_amount_1", request.POST.get("Amount", "")))
	fields.append(("product_quantity_1", "1"))
	fields.append(("product_taxable_1", "False"))
	fields.append(("url_finish", request.POST.get("url_finish", "http://www.myfilemd.com/promo1/thankyou.aspx") +
		"?product1Name=" + urllib.quote_plus(request.POST.get("Description", "")) +
		"&Ship_Zip=" + urllib.quote_plus(request.POST.get("billing_zip", "")) +
		"&Ship_State=" + urllib.quote_plus(request.POST.get("billing_state", "")) +
		"&Ship_Phone=" + urllib.quote_plus(request.POST.get("phone", "")) +
		"&e_mail=" + urllib.quote_plus(request.POST.get("email", ""))
		))
	fields.append(("checkout", "true"))
	fields.append(("customer_receipt", "true"))
	fields.append(("merchant_receipt_email", "randall@callmd.com"))
	fields.append(("shipping_same", "true"))
	fields.append(("first_name", request.POST.get("billing_firstname", "")))
	fields.append(("last_name", request.POST.get("billing_lastname", "")))
	fields.append(("address_1", request.POST.get("billing_address", "")))
	fields.append(("address_2", ""))
	fields.append(("city", request.POST.get("billing_city", "")))
	fields.append(("postal_code", request.POST.get("billing_zip", "")))
	fields.append(("state", request.POST.get("billing_state", "")))
	fields.append(("phone", request.POST.get("phone", "")))
	fields.append(("email", request.POST.get("email", "")))
	# conditional fields
	type = request.POST.get("type", "")
	if type:
		fields.append(("type", type))
	# calculate and add hash
	m = md5.new()
	m.update("|".join(f[1] for f in fields) + "|" + settings.MERCHANT_USERNAME)
	hash = "|".join(f[0] for f in fields) + "|" + m.hexdigest()
	# add the rest of the fields
	fields.append(("customer_receipt", "true"))
	fields.append(("key_id", settings.MERCHANT_KEY_ID))
	fields.append(("hash", hash))
	return render_to_response("link.html",
		{
			"fields": fields,
			"url": settings.MERCHANT_URL,
		},
		context_instance=RequestContext(request))

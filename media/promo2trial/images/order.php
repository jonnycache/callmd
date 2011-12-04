<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CallMD Ultimate</title>
<link rel="stylesheet" href="style.css" />
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url();
	background-repeat: repeat-x;
	background-color: #FFFFFF;
}
.style1 {
	color: #005e88;
	font-weight: bold;
	font-family: "Trebuchet MS", Verdana;
	font-size: 17px;
}
-->
</style>
<script type="text/javascript" src="script/Validations.js" language="javascript"></script> 
<?php  function safeRequest($strGet) {
      $strGet = preg_replace("/[^a-zA-Z0-9\_]*/m","",$strGet);
      //$strGet = preg_replace("/[^a-zA-Z0-9(\040)\(\)']*/m","",$strGet); //<--to allow space \040
      $strGet = str_ireplace("javascript","",$strGet);
      $strGet = str_ireplace("encode","",$strGet);
      $strGet = str_ireplace("decode","",$strGet);
      return trim($strGet);
      }?>
<script language="javascript" type="text/javascript">
	
	function toggleBillingAddress(radioButtonObj)
	{

		var billingDiv = document.getElementById('billingDiv');
		if (radioButtonObj.value == "no")
			billingDiv.style.display = 'inline';
		else
			billingDiv.style.display = 'none';
	}
	
	function check_adds(val)
	{
		var message;
		var error=0;
		message='';

		
		var group1Checked;
     var cardtype1Checked;
 
for (var i=0; i<val.extra.length; i++) {
	
		if (val.extra[i].checked) {
		group1Checked = val.extra[i].value
		}
		
	}

if(val.extra.value=='')
		{
			if(error==0)
			val.extra.focus();
			message = message + "- Please Select Your Plan.\n";
			error=1;
		}

	if(val.cc_type.value=='')
		{
			if(error==0)
			val.cc_type.focus();
			message = message + "- Please enter card type.\n";
			error=1;
		}
		
		 
 		if(val.cc_number.value=='')
		{
			if(error==0)
			val.cc_number.focus();
			message = message + "- Please enter card number.\n";
			error=1;
		}
		else if(isNaN(val.cc_number.value))
		{
			if(error==0)
			val.cc_number.focus();
			message = message + "- Please enter valid card number.\n";
			error=1;
		}
		
		if(val.cc_number.value != '')
		{
			if(val.cc_number.value.length < 13)
			{
				if(error==0)
				val.cc_number.focus();
				message = message + "- Please enter valid card number.\n";
				error=1;
			}
		}
		
		if(val.fields_expmonth.value=='')
		{
			if(error==0)
			val.fields_expmonth.focus();
			message = message + "- Please enter expiration month.\n";
			error=1;
		}
		
		if(val.fields_expyear.value=='')
		{
			if(error==0)
			val.fields_expyear.focus();
			message = message + "- Please enter expiration year.\n";
			error=1;
		}
		 
		if(val.cc_cvv.value=='')
		{
			if(error==0)
			val.cc_cvv.focus();
			message = message + "- Please enter CVV.\n";
			error=1;
		}
		
		if(document.getElementById('radioTwo').checked==true)
		{
			if(val.billing_street_address.value=='')
			{
				if(error==0)
				val.billing_street_address.focus();
				message = message + "- Please enter billing address.\n";
				error=1;
			}
			if(Trim(val.billing_city.value) == '')
			{
				if(error==0)
				val.billing_city.focus();
				message = message + "- Please enter billing city.\n";
				error=1;
			}
			
			else if(!IsNumeric(val.billing_city.value))
			{
				if(error==0)
				val.billing_city.focus();
				message = message + "- Please enter valid city.\n";
				error=1;
			}
		
			if(val.billing_state.value=='')
			{
				if(error==0)
				val.billing_state.focus();
				message = message + "- Please enter billing state.\n";
				error=1;
			}
			 
			if(val.billing_postcode.value=='')
			{
				if(error==0)
				val.billing_postcode.focus();
				message = message + "- Please enter zip code.\n";
				error=1;
			}
			else if(isNaN(val.billing_postcode.value))
			{
				if(error==0)
				val.billing_postcode.focus();
				message = message + "- Please enter valid zip code.\n";
				error=1;
			}
			
		    if (val.billing_postcode.value != '') 
		    {
				if (val.billing_postcode.value.length != 5)
				{
					if(error==0)
					val.billing_postcode.focus();
					message = message + "- Please enter valid zip code.\n";
					error=1;
				}
			}
			
		}
		if(val.confirm1.checked==false)
		{
			if(error==0)
			val.confirm1.focus();
			message = message + "- Please read the Benefit Service Agreement for this offer. !\n";
			error=1;
		}
		if(error==1)
		{
			alert("The following fields are missing or invalid:\n" + message);
			return false;
		}
		else
		{
			return true;
		}
	}
	
	</script>
   <script type='text/javascript'>
		String.prototype.ltrim = function() {
	return this.replace(/^\s+/,"");
	} 
	/* This function adds or subtracts the item from the total.
	But it is generic enough to support any checkBox click.  Just pass in a 
this reference to the checkbox, the amount to add/subtract and the currency
symbol and it will do the rest.
*/

  
function change_products(id){
			var upsellTotal = 0.00;
			
			
			if (id==11)
			  {
			  price=29.95;
			  }
			  if (id==12)
			  {
			  price=299.95;
			  }
			  if (id==15)
			  {
			  price=39.95;
			  }
			  if (id==16)
			  {
			  price=349.95;
			  }
	//we need to loop through the DOM and find all upsell_X where x is 1..something
	//and see if each one is checked or not.
				for (i = 0; i <10000; i++) 
				{
					var elementName = "upsell_price_"+i;
					if (document.getElementById(elementName))
					{
						var checkboxName 	= 'upsell_'+i;
						var priceObj 		= document.getElementById(elementName);
						var checkboxObject 	= document.getElementById(checkboxName);
						if (checkboxObject.checked)
						{
							//add to the total
							upsellTotal += parseFloat(priceObj.value);
						}
					}
				}
				//now do same for 3rd party upsells			
				for (i = 0; i <100; i++) 
				{
					var elementName = 'upsell_price_TPU'+i;
					if (document.getElementById(elementName))
					{
						var checkboxName 	= 'upsell_TPU'+i;
						var priceObj 		= document.getElementById(elementName);
						var checkboxObject 	= document.getElementById(checkboxName);
						if (checkboxObject.checked)
						{
							//add to the total
							upsellTotal += parseFloat(priceObj.value);
						
						}
					}
				}	
document.getElementById('custom_product').value=id;
document.getElementById('custom_product_price').value=price.toFixed(2);
if(price==0.0000){
document.getElementById('p_price').innerHTML = '<font color="#123258">Free Trial</font>'
}else{
document.getElementById('p_price').innerHTML = '<font color="#123258">$' +price.toFixed(2)+'</font>'
}
var ship_price = document.forms['opt_in_form'].shipping.value;var total_amount = parseFloat(document.forms['opt_in_form'].shipping.value) + parseFloat(price) + parseFloat(upsellTotal);
				total_amount = total_amount.toFixed(2);
				document.getElementById('total_amount').innerHTML = "$"+ total_amount;}





</script>
<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
//-->
</script>
</head>
<body>
<div class="main_div">
<div class="header">
  <div class="header_images"><img src="images/image_1.jpg" alt="" width="250" height="131" border="0" /></div>
  <div class="header_images"><img src="images/image_2_a.jpg" alt="" width="250" height="131" border="0" /></div>
  <div class="header_images"><img src="images/image_3.jpg" alt="" width="250" height="131" border="0" /></div>
  <div class="header_images_2nd"><img src="images/image_4.jpg" alt="" width="249" height="131" border="0" /></div>
  <div class="header_images"><img src="images/image_5.jpg" alt="" width="250" height="131" border="0" /></div>
  <div class="header_images"><img src="images/image_6.jpg" alt="" width="250" height="131" border="0" /></div>
  <div class="header_images"><img src="images/image_7.jpg" alt="" width="250" height="131" border="0" /></div>
  <div class="header_images_2nd"><img src="images/image_8.jpg" alt="" width="249" height="131" border="0" /></div>
  <div class="header_images"><img src="images/image_9.jpg" alt="" width="250" height="131" border="0" /></div>
  <div class="header_images"><img src="images/image_10.jpg" alt="" width="250" height="131" border="0" /></div>
  <div class="header_images"><img src="images/image_11.jpg" alt="" border="0" /> </div>
  <div class="header_images_2nd"><img src="images/image_12.jpg" alt="" width="249" height="131" border="0" /></div>
  <div class="header_images"><img src="images/image_13.jpg" alt="" width="250" height="131" border="0" /></div>
  <div class="header_images"><img src="images/image_14.jpg" alt="" width="250" height="131" border="0" /></div>
  <div class="header_images"><img src="images/image_15.jpg" alt="" width="250" height="131" border="0" /></div>
  <div class="header_images_2nd"><img src="images/image_16.jpg" alt="" width="249" height="131" border="0" /></div>
</div>
<div class="longstripe"><img src="images/long_stripe_1.jpg" alt="" width="999" height="59" border="0" /></div>

    <div class="box-order-Ap2">
         
            <table width="400" cellpadding="3" cellspacing="0" class="text12-25"  bgcolor="">
             
              <tr><td width="127">&nbsp;</td></tr>
              <tr>
                <td colspan=2 >
                <table width="94%" border="1" align="right" cellpadding="5" cellspacing="0" bordercolor="#eeeeee" bgcolor="#f7f7f7">
  <tr>
    <td colspan="3" class="order_table_free">Risk Free 30-Day-Trial For Only $1!</td>
    </tr>
  <tr>
    <td width="33%" class="order_headline">Our  Most Popular Plans</td>
    <td width="33%" class="order_headline">30  DAY RISK FREE TRIAL </td>
    <td width="34%" class="order_headline">Plans  for the Single Person</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">Family Monthly $39.95</td>
    <td valign="top">For $1, you can try the Individual  or Family>Monthly Plans risk  free!</td>
    <td valign="top">Individual Monthly
      $29.95</td>
  </tr>
  <tr>
    <td valign="top">Family Annual
$349.95</td>
    <td valign="top">If you’re not satisfied with your Health Program, you can  cancel at anytime during the 30 days at       NO RISK.  </td>
    <td valign="top">Individual  Annual  $249.95</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">You may cancel at any time. If you cancel during the free trial period, you will not be charged. (Residents of DE, MT, OK, SC, and SD: If you cancel within 30 days of receipt of membership materials, you will receive a full refund.) Note to Utah residents: This contract is not protected by the Utah Life and Health Guaranty Association. The program and its administrators have no liability for providing or guaranteeing service or the quality of service rendered.<br />
      </td>
    </tr>
   
</table>

                
                
                </td>
              </tr>
              
             <tr><td>&nbsp;</td>
             </tr>
              
              <tr>
                <td colspan="2" align="left"  ><div class="box-agree"> This AGREEMENT, is between Americare Services, Inc. (the Company), and the enrolled
                  person (Client) with respect to Clients enrollment in the Companys electronic medical
                  record storage and/or telephonic physician consultant services, as selected by Client
                  (the Program), on the date agreed to by the parties. In consideration of these premises
                  and the mutual promises and covenants hereinafter contained, Company and Client,
                  each intending to be legally bound hereby, agree as follows: <br />
                    <br />
                    <p> Section 1. Companys Obligations. Company shall provide the Program to Client so
                      long as Client pays the fees agreed to in connection with the Program. Client shall
                      enroll in the Program and register with Company in the manner prescribed by Company.
                      Client shall continue to have access to the Program until Client terminates his
                      or her membership in the Program, or Company or Client terminates such membership
                      as permitted under this Agreement. The Program encompasses the services described
                      by Company in its enrollment materials.</p>
                  <br />
                    <p> Section 2. Clients Obligations. Client shall pay Company the fees for the Program
                      as set forth in the enrollment materials.</p>
                  <br />
                    <p> Section 3. Term. </p>
                  <ol>
                      <li><u>Monthly Members</u></li>
                  </ol>
                  <p> i.CallMD Ultimate will automatically (no member request required) provide a full
                    refund of the first month’s subscription fee if member calls to cancel within the
                    first 30 days of enrolling.<br />
                    ii. CallMD Ultimate will automatically (no member request required)provide a full
                    of a second month’s subscription fee (if a 2nd subscription fee was collected)if
                    a member calls to cancel between the first 31 and 45 days of enrolling for residents
                    of the following states ONLY: CO, IN, MO, MT, ND, OH, OK, SC and SD. <br />
                    iii. If a member calls to cancel after the full-refund period outlined
                    in either paragraph 1(i) or 1(ii), depending on residency at the time of purchase,
                    then their membership will be extended out for the remainder of the monthly period
                    they’d paid for and no pro=rated refund will be made.</p>
                  <ol>
                      <li><u>Annual Members</u></li>
                    <li>CallMD Ultimate will automatically provide a full refund of the subscription fee
                      if a member calls to cancel within the first 30days of enrolling in the program
                      in the following states: AK, AL, AR, AZ, CA, CT, DC, DE, FL, GA, HA, IA, ID, IL,
                      KS, KT, LA, MA, MD, ME, MI, MN, MS, NC, NE, NH, NJ, NM, NY, OR, PA, RI, TN, TX,
                      UT, VA, VT, WA, WV, WY, ii. CallMD Ultimate will automatically provide a full refund
                      of the subscription fee if a members calls to cancel with the first 45 days of 30
                      days of receiving their fulfillment materials in the following states (45 Days)
                      CO, IN, MO, MT, ND, OH, OK, SC and SD.</li>
                  </ol>
                  <p> c. <u>Pro-Rated refunds of Initial Subscriptions</u><br />
                    i. CallMD Ultimate will automatically provide a pro-rated refund of the initial
                    subscription fees charged if a member calls to cancel more than 30 days after enrolling
                    in the program for residents of the following states: AK, AL, AR, AZ, CA, CT, DC,
                    DE, FL, GA, HA, IA, ID, IL, KS, KT, LA, MA, MD, ME, MI, MN, MS, NC, NE, NH, NJ,
                    NM, NV, NY, OR, PA, RI, TN, TX, UT, VA, VT, WA, WI, WV and WY. <br />
                    ii. CallMD Ultimate will automatically provide a pro-rated refund of the initial
                    subscription fees charged if a member calls to cancel more than 30 days after enrolling
                    in the program for residents of the following states: CO, IN, MO, MT, ND, OH, OK,
                    SC and SD&nbsp; </p>
                  <ol>
                      <li>CallMD Ultimate will automatically provide a pro-rated refund of the most recent
                        subscription fee charged if a member calls to cancel after an annual subscription
                        fee has been collected.</li>
                  </ol>
                  <br />
                    <p> Section 4. Amendment. This Agreement shall automatically terminate upon the liquidation,
                      dissolution, cessation of business or the filing of a bankruptcy petition by or
                      against either party. Upon termination of this Agreement for any reason, Client
                      shall pay Company for all services rendered through the effective date of termination.
                      This Agreement may only be amended from time to time by a writing signed by both
                      parties. No waiver by Client or Company of any provision herein, shall operate as
                      a waiver of any other provision or the same provision on a future occasion.</p>
                  <br />
                    <p> Section 5. Limitation of Liability. Company shall have no liability whatsoever for
                      any indirect, consequential, exemplary, special, incidental or punitive damages.
                      Companys liability to Client for any reason and upon any cause of action, whether
                      tort, contract, statute or any other legal theory whatsoever, shall be at all times
                      and in the aggregate be limited to the lesser of (a) $1,000, or (b) the amount of
                      compensation actually paid by Client to Company during the three (3) month period
                      immediately preceding the month in which the event upon which the liability is predicated.</p>
                  <br />
                    <p> Section 6. Assignment. The rights and obligations of the assigning party under this
                      Agreement shall not be assigned to any other individual, firm, corporation, association
                      or other entity without the prior written approval of the non-assigning party, which
                      approval shall not be unreasonably withheld, delayed or conditioned; provided that
                      nothing contained in this Agreement shall prevent assignment or be deemed assignment
                      of this Agreement in connection with the merger, sale of capital stock or sale of
                      all or substantially all of the assets of Company.</p>
                  <br />
                    <p> Section 7. Disclaimer. Company does not make any express or implied representations
                      or warranties, including but not limited to any warranty of merchantability or fitness
                      for a particular purpose with respect to the Program. Other Provisions. This document
                      contains the entire Agreement of the parties. It supersedes any and all prior agreements,
                      understandings or representations, whether oral or written. Neither party shall
                      be responsible for delays in performance due to strikes, riots, acts of God, shortages
                      of labor or materials, war, governmental laws, regulations, or restrictions, transportation
                      conditions, product/service suppliers or any other causes whatsoever that are beyond
                      the reasonable control of Company. This Agreement shall be interpreted exclusively
                      according to the laws of the State of Texas without regard to its conflicts of laws
                      principles. Any paragraph titles or captions contained in this Agreement are for
                      convenience only and shall not be deemed part of the context of this Agreement.
                      Except as set forth herein, the parties hereto do not intend to confer any rights
                      or remedies upon any person other than the parties named below.</p>
                </div>                 </td>
              </tr>
              <tr><td>
              <div class="membership_benefits_2"><img src="images/membership_benefits_2.jpg" alt="" width="252" height="39" border="0" /></div>
      <div class="list_3">
        <ul>
          <li>Typical savings of 10-50 percent on a wide range of health-related products and services.</li>
          <li> Pre-negotiated rates from participating health care professionals and facilities nationwide.</li>
          <li>Complements existing benefits for members who have health insurance.</li>
          <li><strong>Convenient access</strong> to licensed physicians available 24/7/365.</li>
          <li><strong>Secure HIPPA compliant</strong> storage and retrieval of medical records.</li>
          <li>Resolve your medical issues over the phone from wherever you are 24/7.</li>
          <li><strong>Easy </strong>prescription refills.</li>
          <li>No waiting days or weeks for an appointment.</li>
          <li> <strong>Instant advice</strong> for non-emergency issues.</li>
          <li>Confidentially discuss embarrassing issues.</li>
          <li><strong>Nurse follow-ups</strong> on every consultation!</li>
          <li>No Limitations on Usage!</li>
           <li><strong>Safe, private &amp; confidential.</strong></li>
            <li>Offers savings on many services that members purchase out of pocket.</li>
             <li>A non-insurance solution for those without access to traditional health insurance.</li>
              <li>Helps reduce health care costs/spending.</li>
        </ul>
      </div>
              </td></tr>
              <tr><td><div style="margin-bottom:20px; float:left;">
                <table width="94%" border="0" align="right" cellpadding="0" cellspacing="0">
                  <tr><td>&nbsp; </td></tr>
                  <tr>
                    <td width="34%" rowspan="2"  valign="top"><img src="images/darren_3.jpg" width="166" height="112" /></td>
      <td class="billing_2">&quot;Simply knowing that a doctor is there for me, ready to take my call, gives me peace of mind that's beyond a price tag&quot; </td>
      </tr>
                  <tr>
                    <td valign="top" class="order_table_free"> Darren Woodson, Former Dallas Cowboys Player, CallMD Member </td>
      </tr>
                </table>
              </div></td></tr>
            </table>
     
     
  </div>
    <div class="interior_page_right_pra">
     <?php if(isset($_GET['error_message'])) { echo '<div style="color:#FF0000 ">' . $_GET['error_message'] . '</div>'; } ?>
      <form id="frm" name="frm" method="post"  class="txt12-28" action="http://www.secureordermanagement.com/index.php?main_page=two_step_form_processor"  onsubmit="return check_adds(document.frm)">
<input type='hidden' name = 'product_name' id='product_name' value= "CallMD Individual Monthly Plan" />
<input type="hidden" id="custom_product" name="custom_product" value="11" />








  <table width="380" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><img src="images/form_new_head.jpg" width="388" height="116" /></td>
  </tr>
  <tr>
    <td style="background:url(images/form_new_rpt.jpg) top repeat-y;"><table align="center" cellpadding="0" cellspacing="10">
                 <tr>
               
<td  align="left" valign="top" colspan="2" ><table width="308" border="0" cellpadding="3"  cellspacing="0" align="center">
                    <tr>
                      <td width="60" align="left"><img src="images/mastercard.jpg" alt="" width="41" height="26" border="0" /></td>
                      <td width="5">&nbsp;</td>
                      <td width="60"><img src="images/visa.jpg" alt="" width="42" height="26" border="0" /></td>
                      <td width="5">&nbsp;</td>
                      <td width="60" align="center"><img src="images/discover.jpg" alt="" width="44" height="27" border="0" /></td>
                      <td width="5">&nbsp;</td>
                      <td width="71" align="center"><img src="images/amex.jpg" alt="" width="42" height="26" border="0" /></td>
                  </tr>
                    <tr>
                      <td colspan="7" align="left" style="height:3px;" ></td>
                    </tr>
                </table></td>
              </tr>
               
               <tr>
               <td class="billing_1"><div style="width:134px; float:left"> <strong>CallMD Ultimate Plans:</strong> </div></td>
      
						  <td width="199" align="left">
                          <select name="extra" id="extra" onchange="change_products(document.getElementById('extra').value);"  class="txtfield22">
                          <option value="99" selected="selected">Select Your Plan</option>
          <option value="11" >Individual Monthly - $29.95</option>
          <option value="12" >Individual Annual - $299.95</option>
          <option  value="15" >Family Monthly - $39.95</option>
          <option value="16" >Family Annual - $349.95</option>
        </select>                          </td>
    </tr>
					 <tr> <td align="left" width="157" class="billing_1">Product Price:</td>
					 <td align="left"><div id="p_price"><font color="#123258">$0.00</font></div></td>
	    </tr> 
								<input type="hidden" id="custom_product_price" name="custom_product_price" value="29.95"/>
								 <input type="hidden" name="shipping" id="shipping" value=0.00  />
							<div id="shipping_price" color="#FF0000" style="display:none;"> $0.00 </div>
							
							
							<script language="JavaScript">
							<!--
								//this function needs to just mod the total_amount by the shipping change, not overwrite it completly			
								function SetShippingValue() 
								{
									var totalObj = document.getElementById('total_amount');
									var tempStr = totalObj.innerHTML;
						
									//remove the currency sign
									var totalAmountString = tempStr.substr(1);	
								
									//get the previous shipping amount
									var previousShippingStr = document.getElementById('shipping_price').innerHTML;
									
									//remove the currency symbol
									var trimmed = previousShippingStr.replace(/^\s+|\s+$/g, '') ;
									var previousShippingStr = trimmed.substr(1);	
									
									//so take new shipping amount and subtract the old shipping amount, this is how much total_amount needs to move
									var delta = parseFloat(document.forms['opt_in_form'].shipping.value) - parseFloat(previousShippingStr);
									
									document.getElementById('shipping_price').innerHTML = "$" + document.forms['opt_in_form'].shipping.value;
									//uncoment this line if you use the shipping in more than 1 place
									//document.getElementById('shipping_price2').innerHTML = "$" + document.forms['opt_in_form'].shipping.value;
									
									//var total_amount = parseFloat(document.forms['opt_in_form'].shipping.value) + parseFloat(document.forms['opt_in_form'].custom_product_price.value);
									var total_amount = parseFloat(totalAmountString) + parseFloat(delta);
									
									total_amount = total_amount.toFixed(2);
									document.getElementById('total_amount').innerHTML = "$"+ total_amount;
					
								};
								-->
						</script>
    
  <tr><td colspan="2" style="height:3px;"></td></tr>
    <tr>
   
                <td colspan="2" class="billing_1"> Is your billing address the same as this shipping address?</td>
      </tr>
              <tr>
                <td></td>
<td align="left"><div class="question1  billing_1">
                    <input id="radioOne" onclick="toggleBillingAddress(this)" type="radio" name="billingSameAsShipping"
                                        value="yes" checked="checked" />
                  Yes
                  <input id="radioTwo" onclick="toggleBillingAddress(this)" type="radio" name="billingSameAsShipping"
                                        value="no" />
                No </div></td>
      </tr>
   

              <tr>
                <td colspan="2" align="left"><div style="display:none;" id="billingDiv">
                <table cellpadding="0" cellspacing="0" align="left">
                      <tr>
                        <td  align="left" class="billing_1"><div style="width:167px;"><label for='billing_street_address'> Billing Address:</label></div></td>
                        <td align="left"><div style="width:189px; margin-bottom:10px;"><input type='text' id='billing_street_address' name='billing_street_address' class="txtfield" maxlength="75"/></div></td>
                      </tr>
                      <tr>
                        <td align="left" class="billing_1"><label for='billing_city'> Billing City:</label></td>
                        <td align="left" ><div style="width:189px; margin-bottom:10px;"><input type='text' id='billing_city' name='billing_city' class="txtfield" onkeypress="return allowAlphaWithSpace(this,event);" maxlength="30" /></div></td>
                      </tr>
                      <tr>
                        <td align="left" class="billing_1"><label for='billing_state'> Billing State:</label></td>
                        <td align="left" ><div style="width:189px; margin-bottom:10px;"><select id="billing_state" name="billing_state" class="txtfield2">
                            <option value="" selected="selected">Select State</option>
                            <option value="AL">Alabama</option>
                            <option value="AK">Alaska</option>
                            <option value="AZ">Arizona</option>
                            <option value="AR">Arkansas</option>
                            <option value="CA">California</option>
                            <option value="CO">Colorado</option>
                            <option value="CT">Connecticut</option>
                            <option value="DE">Delaware</option>
                            <option value="DC">District of Columbia</option>
                            <option value="FL">Florida</option>
                            <option value="GA">Georgia</option>
                            <option value="HI">Hawaii</option>
                            <option value="ID">Idaho</option>
                            <option value="IL">Illinois</option>
                            <option value="IN">Indiana</option>
                            <option value="IA">Iowa</option>
                            <option value="KS">Kansas</option>
                            <option value="KY">Kentucky</option>
                            <option value="LA">Louisiana</option>
                            <option value="ME">Maine</option>
                            <option value="MD">Maryland</option>
                            <option value="MA">Massachusetts</option>
                            <option value="MI">Michigan</option>
                            <option value="MN">Minnesota</option>
                            <option value="MS">Mississippi</option>
                            <option value="MO">Missouri</option>
                            <option value="MT">Montana</option>
                            <option value="NE">Nebraska</option>
                            <option value="NV">Nevada</option>
                            <option value="NH">New Hampshire</option>
                            <option value="NJ">New Jersey</option>
                            <option value="NM">New Mexico</option>
                            <option value="NY">New York</option>
                            <option value="NC">North Carolina</option>
                            <option value="ND">North Dakota</option>
                            <option value="OH">Ohio</option>
                            <option value="OK">Oklahoma</option>
                            <option value="OR">Oregon</option>
                            <option value="PA">Pennsylvania</option>
                            <option value="RI">Rhode Island</option>
                            <option value="SC">South Carolina</option>
                            <option value="SD">South Dakota</option>
                            <option value="TN">Tennessee</option>
                            <option value="TX">Texas</option>
                            <option value="UT">Utah</option>
                            <option value="VT">Vermont</option>
                            <option value="VA">Virginia</option>
                            <option value="WA">Washington</option>
                            <option value="WV">West Virginia</option>
                            <option value="WI">Wisconsin</option>
                            <option value="WY">Wyoming</option>
                        </select></div></td>
                      </tr>
                      <tr>
                        <td align="left" class="billing_1"><label for='billing_postcode'> Billing Zip:</label></td>
                        <td align="left" ><div style="width:189px; margin-bottom:3px;"><input type='text' id='billing_postcode' name='billing_postcode' maxlength="5" class="txtfield" onkeydown="return onlyNumbers(event,'phone')"/></div></td>
                      </tr>
                    </table>
                </div></td>
      </tr>
              
              
               
              <tr>
                <td class="billing_1">Credit Card Type:</td>
              <td  align="left" valign="top"><select id="cc_type" name="cc_type" class="txtfield2">
                    <option value="" selected="selected">Select</option>
                    <option value="visa">Visa</option>
                    <option value="master">Master Card</option>
                    <option value="discover">Discover</option>
                    <option>American Express</option>
                </select>                </td>
      </tr>
              
              
              <tr>
                <td  class="billing_1"><label for='cc_number'> Card Number:</label></td>
                <td align="left"><input type='text' maxlength=16 onkeydown="return onlyNumbers(event,'cc')" id='cc_number'  class="txtfield" name='cc_number' /></td>
              </tr>
              <tr>
                <td  class="billing_1"><label for="cc_expires"> Expiration Date:</label></td>
                <td><select name="fields_expmonth" onchange="javascript:update_expire()" id="fields_expmonth" class="input1 txtfield3">
                    <option selected="selected" value="">Month</option>
                    <option value="01">January</option>
                    <option value="02">February</option>
                    <option value="03">March</option>
                    <option value="04">April</option>
                    <option value="05">May</option>
                    <option value="06">June</option>
                    <option value="07">July</option>
                    <option value="08">August</option>
                    <option value="09">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                  </select>
                  &nbsp;
                  <select name="fields_expyear" onchange="javascript:update_expire()" id="fields_expyear" class="input1 txtfield4">
                    <option selected="selected" value="">Year</option>
                   <option value='10'>2010</option>
                    <option value='11'>2011</option>
                    <option value='12'>2012</option>
                    <option value='13'>2013</option>
                    <option value='14'>2014</option>
                    <option value='15'>2015</option>
                    <option value='16'>2016</option>
                    <option value='17'>2017</option>
                    <option value='18'>2018</option>
                    <option value='19'>2019</option>
                    <option value='20'>2020</option>
                    <option value='21'>2021</option>
                    <option value='22'>2022</option>
                </select></td>
              </tr>
              <input type="hidden" id="cc_expires" name="cc_expires" />
              <tr>
                <td  class="billing_1" valign="middle"><label for='cc_cvv'> CVV:</label></td>
                <td align="left"><input type='text' id='cc_cvv' name='cc_cvv' class="txtfield5" maxlength="4" />
                  &nbsp;&nbsp;<a href="javascript:void(0)"  class="bluelink_2"  onclick="window.open('https://hoosonline.virginia.edu/CommonLib/Field/cvv.htm','welcome','width=740,height=400,menubar=no,status=yes,location=yes,toolbar=no,scrollbars=no,left=200,top=200,screenX=0,screenY=100,resizable=0')">What's this?</a></td>
              </tr>
              <tr>
                <td></td>
              </tr>
              
             
              <tr style="text-align: left; line-height: 20px;">
                <td align="left" valign="top" colspan="2" class="billing_1"><p>
                   
                    <input type="checkbox" name="confirm1" id="confirm1" />
                  Yes, I have read the Benefit Service Agreement and checking this checkbox indicates
                  my agreement and signature to this Agreement.
                  
                                  </p></td>
              </tr>
              <tr>
                
                <td colspan="2" align="center"><input type="submit" name="submit" id="submit" value="" style="text-align: left; cursor:pointer;
                                    background: transparent url(images/join_now_latest_small.png) top center no-repeat; margin: 0 0 0 0px;
                                    padding: 0 0 0px 0; width: 217px; height: 86px; border: none; line-height: 54px;"
                                    title="Join Now" onmouseover="MM_swapImage('submit','','join_now_latest_small.png',1)"
                                    onmouseout="MM_swapImgRestore()"   />
                <br />                </td>
        </tr>
               
          <tr>
            <td colspan="2" align="center"><table width="308" border="0" cellspacing="10" cellpadding="0">
              <tr>
                <td width="154" style="text-align:center;"><span id="siteseal"> 
      <script type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=efJRCGl2IbsTcUrkD0bs4zATS1DEb5ukmL2Vl6VysOwdo4kafMDet4"></script></span></td>
                <td width="154" align="center"><img src="images/icon_1.png" width="109" height="99" /></td>
              </tr>
              <tr>
                <td align="center"><img src="images/icon_3.png" width="116" height="94" /></td>
            <td align="center">
            <img src="images/icon_2.png" width="128" height="98" />               </td>              </tr>
            </table></td>
            </tr>
          </table></td>
  </tr>
  <tr>
    <td><img src="images/form_new_footer.jpg" width="388" height="28" /></td>
  </tr>
</table>

  <?php 
					if (isset($_GET['AFID']))
					{	
						$AFID = safeRequest($_GET['AFID']);	
						echo "<input type='hidden' name='AFID' value='".$AFID."'>";	
					} 	
					if (isset($_GET['afid']))
					{	
						$afid = safeRequest($_GET['afid']);	
						echo "<input type='hidden' name='afid' value='".$afid."'>";	
					} 	
					if (isset($_GET['SID']))
					{	
						$SID = safeRequest($_GET['SID']);	
						echo "<input type='hidden' name='SID' value='".$SID."'>";	
					} 	
					if (isset($_GET['sid']))
					{	
						$sid = safeRequest($_GET['sid']);	
						echo "<input type='hidden' name='sid' value='".$sid."'>";	
					} 	
					if (isset($_GET['AFFID']))
					{	
						$AFFID = safeRequest($_GET['AFFID']);	
						echo "<input type='hidden' name='AFFID' value='".$AFFID."'>";	
					} 	
					if (isset($_GET['affid']))
					{	
						$affid = safeRequest($_GET['affid']);	
						echo "<input type='hidden' name='affid' value='".$affid."'>";	
					} 	
					if (isset($_GET['C1']))
					{	
						$C1 = safeRequest($_GET['C1']);	
						echo "<input type='hidden' name='C1' value='".$C1."'>";	
					} 	
					if (isset($_GET['c1']))
					{	
						$c1 = safeRequest($_GET['c1']);	
						echo "<input type='hidden' name='c1' value='".$c1."'>";	
					} 	
					if (isset($_GET['C2']))
					{	
						$C2 = safeRequest($_GET['C2']);	
						echo "<input type='hidden' name='C2' value='".$C2."'>";	
					} 	
					if (isset($_GET['c2']))
					{	
						$c2 = safeRequest($_GET['c2']);	
						echo "<input type='hidden' name='c2' value='".$c2."'>";	
					} 	
					if (isset($_GET['C3']))
					{	
						$C3 = safeRequest($_GET['C3']);	
						echo "<input type='hidden' name='C3' value='".$C3."'>";	
					} 	
					if (isset($_GET['c3']))
					{	
						$c3 = safeRequest($_GET['c3']);	
						echo "<input type='hidden' name='c3' value='".$c3."'>";	
					} 	
					if (isset($_GET['BID']))
					{	
						$BID = safeRequest($_GET['BID']);	
						echo "<input type='hidden' name='BID' value='".$BID."'>";	
					} 	
					if (isset($_GET['bid']))
					{	
						$bid = safeRequest($_GET['bid']);	
						echo "<input type='hidden' name='bid' value='".$bid."'>";	
					} 	
					if (isset($_GET['AID']))
					{	
						$AID = safeRequest($_GET['AID']);	
						echo "<input type='hidden' name='AID' value='".$AID."'>";	
					} 	
					if (isset($_GET['aid']))
					{	
						$aid = safeRequest($_GET['aid']);	
						echo "<input type='hidden' name='aid' value='".$aid."'>";	
					} 	
					if (isset($_GET['OPT']))
					{	
						$OPT = safeRequest($_GET['OPT']);	
						echo "<input type='hidden' name='OPT' value='".$OPT."'>";	
					} 	
					if (isset($_GET['opt']))
					{	
						$opt = safeRequest($_GET['opt']);	
						echo "<input type='hidden' name='opt' value='".$opt."'>";	
					} 	
					if (isset($_GET['custom1']))
					{	
						$custom1 = safeRequest($_GET['custom1']);	
						echo "<input type='hidden' name='custom1' value='".$custom1."'>";	
					} 	
					if (isset($_GET['CUSTOM1']))
					{	
						$CUSTOM1 = safeRequest($_GET['CUSTOM1']);	
						echo "<input type='hidden' name='CUSTOM1' value='".$CUSTOM1."'>";	
					} 	
					if (isset($_GET['custom2']))
					{	
						$custom2 = safeRequest($_GET['custom2']);	
						echo "<input type='hidden' name='custom2' value='".$custom2."'>";	
					} 	
					if (isset($_GET['CUSTOM2']))
					{	
						$CUSTOM2 = safeRequest($_GET['CUSTOM2']);	
						echo "<input type='hidden' name='CUSTOM2' value='".$CUSTOM2."'>";	
					} 	
					if (isset($_GET['custom3']))
					{	
						$custom3 = safeRequest($_GET['custom3']);	
						echo "<input type='hidden' name='custom3' value='".$custom3."'>";	
					} 	
					if (isset($_GET['CUSTOM3']))
					{	
						$CUSTOM3 = safeRequest($_GET['CUSTOM3']);	
						echo "<input type='hidden' name='CUSTOM3' value='".$CUSTOM3."'>";	
					} 	 ?><input type='hidden' name = 'step' value='second' />
<input type='hidden' name = 'temp_order_id' value='<?php echo $_GET["tempOrderId"];?>' />
	<input type='hidden' name = 'campaign_id' value='10' />
   <input type='hidden' name='is_upsell' value='0' />
</form>
<div class="cl"></div>

  </div>
 </div>
    <div class="cl"></div>
    
<div class="footer">
  <div align="left" class="footer_text">
      <p>* Add $35 fee for each doctor consultation. Doctor consultation fees incurred during this period can not be refunded. CallMD and CallMD Ultimate are not health insurance products.<br />
        <br />
      Disclosure: The OptumHealthSM Allies discount plan is administered by HealthAllies®, Inc., a discount medical discount plan organization.<strong> The OptumHealth Allies discount plan is NOT insurance.</strong> The OptumHealth Allies discount plan provides discounts at certain health care providers for medical services. The OptumHealth Allies discount plan does not make payments directly to the providers of medical services. The discount plan member is obligated to pay for all health care services but will receive a discount from those health care providers who have contracted with the discount plan organization. HealthAllies, Inc., is located at P.O. Box 10340, Glendale, CA, 91209, [TFN].<br />
     
        ----------------------------------------------------------<br />
      You may cancel at any time. If you cancel within 30 days of the effective date (within 30 days of receipt of membership materials for residents of CO, IN, MO, MT, ND, OH, OK, SC, SD and WA), you will receive a full refund. <br />
      </p>
      <p>*<strong> Hospitals:</strong> Hospital discounts are not available in Maryland or other states where prohibited by law.<br />

* <strong>Fitness Clubs:</strong> Fitness club membership discounts are available to new members only.<br />

* <strong>Long-Term Care Services:</strong> Discounts on long term care services are available to new patients only.<br />

* <strong>Prescription drugs:</strong><br />
</p>

<p>Disclosure: This is NOT insurance. Discounts are available only at participating pharmacies. By using this card, you agree to pay the entire prescription cost less any applicable discount. Savings may vary by drug and by pharmacy. Savings are based on actual 2008 drug purchases for all drug discount card programs administered by Caremark. The program administrator may obtain fees or rebates from manufacturers and/or pharmacies based on your prescription drug purchases. Prescription claims through this program will not be eligible for reimbursement through Medicaid, Medicare or any other government program.</p>
</div>  <div class="validator">
    <table width="110" border="0" cellpadding="0" cellspacing="0" align="center">
    <tr>
      <td class="callmdlower">CMD 2</td>
    </tr>
      
    </table>
  </div>
</div>
<div class="cl"></div>
<div class="unsubscribe">
 <a href="javascript:void(0)"  style="color:#000000" onclick="window.open('http://www.mirchtraffic.com/unsubscribe/1','welcome','width=540,height=450,menubar=no,status=yes,location=yes,toolbar=no,scrollbars=no,left=200,top=200,screenX=0,screenY=100,resizable=0')">Unsubscribe</a>
 </div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-11984264-3");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>

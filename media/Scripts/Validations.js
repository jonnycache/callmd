
//This functions allows only alphabets to be entered into the textbox
function allowAlpha(myfield, e, dec) {
    var key;
    var keychar;

    if (window.event) {
        key = window.event.keyCode;
    }
    else if (!e) {
		return true;
    }
    key = e.which;

    if (key == 8 || key == 0) {
        return true;
    }
    return key > 96 && key < 123 || key == 13 || key > 64 && key < 91;
}

//This functions allows only alphabets to be entered into the textbox
function allowAlphaWithSpace(myfield, e, dec) {
    var key;
    var keychar;

    if (window.event) {
        key = window.event.keyCode;
    }
    else if (!e) {
        return true;
    }
    key = e.which;
    
    if (key == 32 || key == 8 || key== 0) {
            return true;
    }
    return key > 96 && key < 123 || key == 13 || key > 64 && key < 91 || key == 32;
}

//This function will allow both alphabets and numeric value to be entered in textbox
function allowAlphaNumeric(myfield, e, dec) {
    var key;
    var keychar;

    if (window.event) {
        key = window.event.keyCode;
    }
    else if (!e) {
        return true;
    }
    key = e.which;
	
    if (key == 32 || key == 8 || key == 0) {
        return true;
    }
   
    return key > 64 && key < 91 || key > 47 && key < 58 || key > 96 && key < 123 || key == 13;
}

//This function will allow numeric values only to be entered in textbox
function allowNumeric(myfield, e, dec) {
    
    var key;
    var keychar;

    if (window.event) {
        key = window.event.keyCode;
    }
    else if (!e) {
        return true;
    }
    key = e.which;
	
    if (key == 8 || key == 0) {
        return true;
    }
    if (key == 46 ) {
        return false;
    }
    return key > 47 && key < 58;
}

//This function will validate the email address entered.
function validateEmailAddress(str) {

	var at = "@"
	var dot = "."
	var lat = str.indexOf(at)
	var lstr = str.length
	var ldot = str.indexOf(dot)
	if (str.indexOf(at) == -1) {
		return false;
	}

	if (lat == -1 || lat == 0 || lat == lstr - 1) {
		return false;
	}

	if (ldot == -1 || ldot == 0 || ldot == lstr - 1) {
		return false;
	}

	if (str.indexOf(at, lat + 1) != -1) {
		return false;
	}

	if (str.charAt(lat - 1) == dot || str.charAt(lat + 1) == dot) {
		return false;
	}

	if (str.indexOf(dot, lat + 2) == -1) {
		return false;
	}

	if (str.indexOf(" ") != -1) {
		return false;
	}

	return true;
}

//This function will trim the value
function Trim(psText)
{
	return psText.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
}

function allValidChars(email) {
	return /^[a-z0-9@\.\-_]+$/.test(email);
}

function onlyNumbers(e,type) 
{ 
	var keynum;
	var keychar;
	var numcheck;
	if(window.event) // IE
	{
		keynum = e.keyCode;
	}
	else if(e.which) // Netscape/Firefox/Opera
	{
		keynum = e.which;
	}
	keychar = String.fromCharCode(keynum);
	numcheck = /\d/;    
	switch (keynum)
	{
		case 8: 	//backspace
		case 9:		//tab
		case 35:	//end
		case 36:	//home
		case 37:	//left arrow
		case 38:	//right arrow
		case 39:	//insert
		case 45:	//delete
		case 46:	//0
		case 48:	//1
		case 49:	//2
		case 50:	//3
		case 51:	//4	
		case 52:	//5
		case 54:	//6
		case 55:	//7
		case 56:	//8
		case 57:	//9
		case 96:	//0
		case 97:	//1
		case 98:	//2
		case 99:	//3
		case 100:	//4	
		case 101:	//5
		case 102:	//6
		case 103:	//7
		case 104:	//8
		case 105:	//9
			result2 = true;		
			break;
		case 109: // dash -
			if (type == 'phone')
			{
				result2 = true;
			}
			else
			{
				result2 = false;
			}	
			break;
		default:
			result2 = numcheck.test(keychar);
			break;
	}	
	return result2;
}  
	
function IsNumeric(sText)	// ???
{
	return /^[a-zA-Z\.]+$/.test(sText);
}
   
function IsNumeric2(sText)	// ???
{
	return /^[a-zA-Z\.\s]+$/.test(sText);
}

function onPhoneKeyUp(keyCode, sender){
	go_next = 0;
	if ((keyCode != 13) && (sender.name == 'phone1') && (sender.value.length > 2)) go_next = 1;
	if ((keyCode != 13) && (sender.name == 'phone2') && (sender.value.length > 2)) go_next = 1;
	if (go_next) {
		nextname = taborder[sender.name];
		objEl = document.forms['opt_in_form'][nextname];
		if (objEl != null)
			objEl.focus();
	}
}

function update_phone_field(field_name)
{
	phone1 = document.getElementById(field_name + "_phone1").value;
	phone2 = document.getElementById(field_name + "_phone2").value;
	phone3 = document.getElementById(field_name + "_phone3").value;
	document.getElementById(field_name).value = phone1 + phone2 + phone3;
}

function update_dob_field(custom1)
{
	mm = document.getElementById(custom1 + "_mm").value;
	dd = document.getElementById(custom1 + "_dd").value;
	yy = document.getElementById(custom1 + "_yy").value;
	document.getElementById(custom1).value = mm + "/"+ dd +"/"+ yy;
}

function update_expire()
{
	var month = document.getElementById("fields_expmonth");
	var month_value = month.options[month.selectedIndex].value;
	var year = document.getElementById("fields_expyear");
	var year_value = year.options[year.selectedIndex].value;

	if ((month_value != '' ) && (year_value != ''))
	{
		document.getElementById('cc_expires').value = month_value +  year_value;
	}
	else
		document.getElementById('cc_expires').value = '';
}	

//This functions allows only alphabets to be entered into the textbox
function allowAlpha(myfield, e, dec) {
    var key;
    var keychar;

    if (window.event) {
        key = window.event.keyCode;
    }
    else if (e) {
        key = e.which;
    }
    else {
        return true;
    }
    if (key == 8 || key == 0) {
        return true;
    }
    if (!(key > 96 && key < 123) && (key != 13) && !(key > 64 && key < 91)) {
        return false;
    }
}

//This functions allows only alphabets to be entered into the textbox
function allowAlphaWithSpace(myfield, e, dec) {
    var key;
    var keychar;

    if (window.event) {
        key = window.event.keyCode;
    }
    else if (e) {
        key = e.which;
    }
    else {
        return true;
    }
    
    if (key == 32 || key == 8 || key== 0) {
            return true;
    }
    if (!(key > 96 && key < 123) && (key != 13) && !(key > 64 && key < 91) && !(key == 32)) {
        return false;
    }
}

//This function will allow both alphabets and numeric value to be entered in textbox
function allowAlphaNumeric(myfield, e, dec) {
    var key;
    var keychar;

    if (window.event) {
        key = window.event.keyCode;
    }
    else if (e) {
        key = e.which;
    }
    else {
        return true;
    }
    if (key == 32 || key == 8 || key == 0) {
        return true;
    }
   
    if (!((key > 64 && key < 91) || (key > 47 && key < 58) || (key > 96 && key < 123) || (key == 13))) {
        return false;
    }
}

//This function will allow numeric values only to be entered in textbox
function allowNumeric(myfield, e, dec) {
    
    var key;
    var keychar;

    if (window.event) {
        key = window.event.keyCode;
    }
    else if (e) {
        key = e.which;
    }
    else {
        return true;
    }      
    if (key == 8 || key == 0) {
        return true;
    }
    if (key == 46 ) {
        return false;
    }
    if (!((key > 47 && key < 58) || (key == 46)) ) {
        return false;
    }
}

//This function will validate the email address entered.
function validateEmailAddress(str) {

        var at = "@"
        var dot = "."
        var lat = str.indexOf(at)
        var lstr = str.length
        var ldot = str.indexOf(dot)
        if (str.indexOf(at) == -1) {
            return false
        }

        if (str.indexOf(at) == -1 || str.indexOf(at) == 0 || str.indexOf(at) == lstr) {
            return false
        }

        if (str.indexOf(dot) == -1 || str.indexOf(dot) == 0 || str.indexOf(dot) == lstr) {
            return false
        }

        if (str.indexOf(at, (lat + 1)) != -1) {
            return false
        }

        if (str.substring(lat - 1, lat) == dot || str.substring(lat + 1, lat + 2) == dot) {
            return false
        }

        if (str.indexOf(dot, (lat + 2)) == -1) {
            return false
        }

        if (str.indexOf(" ") != -1) {
            return false
        }

        return true
    }

//This function will trim the value
function Trim(psText)
{
	psText = psText + '';
	while(''+ psText.charAt(0) == ' ')
	psText = psText.substring(1, psText.length);	
		
	while(''+ psText.charAt(psText.length - 1) == ' ')
	psText = psText.substring(0, psText.length - 1);
	return 	psText;
}

function allValidChars(email) {
  var parsed = true;
  var validchars = "abcdefghijklmnopqrstuvwxyz0123456789@.-_";
  for (var i=0; i < email.length; i++) {
    var letter = email.charAt(i).toLowerCase();
    if (validchars.indexOf(letter) != -1)
      continue;
    parsed = false;
    break;
  }
  return parsed;
}

//This function will trim the value
function Trim(psText)
{
	psText = psText + '';
	while(''+ psText.charAt(0) == ' ')
	psText = psText.substring(1, psText.length);	
		
	while(''+ psText.charAt(psText.length - 1) == ' ')
	psText = psText.substring(0, psText.length - 1);
	return 	psText;
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
	
	function IsNumeric(sText)
	{
	   var ValidChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ.";
	   var IsNumber=true;
	   var Char;

	 
	   for (i = 0; i < sText.length && IsNumber == true; i++) 
		  { 
		  Char = sText.charAt(i); 
		  if (ValidChars.indexOf(Char) == -1) 
			 {
			 IsNumber = false;
			 }
		  }
	   return IsNumber;
	   
	}
	   
	function IsNumeric2(sText)
	{
	   var ValidChars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ. ";
	   var IsNumber=true;
	   var Char;

	   for (i = 0; i < sText.length && IsNumber == true; i++) 
		  { 
		  Char = sText.charAt(i); 
		  if (ValidChars.indexOf(Char) == -1) 
			 {
			 IsNumber = false;
			 }
		  }
	   return IsNumber;
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

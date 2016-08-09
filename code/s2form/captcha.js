function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  }
  else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

addLoadEvent(function() {
  var captchaQuestion = [];
	captchaQuestion[0] = 'What is 2 plus five (number)?';
	captchaQuestion[1] = 'What is the color of a stop sign?';
	//captchaQuestion[2] = 'What is 3 minus two (number)?';
	//captchaQuestion[3] = 'What is the color of grass?';
	//captchaQuestion[4] = 'What is the color of milk?';
	//captchaQuestion[5] = 'What color are lemons?';
	//captchaQuestion[6] = 'What is four plus 2 (number)?';

	var randomNumber=Math.floor(Math.random()*2);
	var captchaInput = document.getElementById('captcha');
	captchaInput.setAttribute('name', 'captcha_'+randomNumber);
	var node=document.createTextNode(captchaQuestion[randomNumber]);
	var question=document.getElementById('captcha_question');
	if (question.firstChild == null) {
		question.appendChild(node);
	}else{
		question.firstChild.nodeValue = captchaQuestion[randomNumber];
	};
});

document.getElementById('captcha_error').style.display = "none";


//form fill code

function readCookie(name) {
		
	var cookiename = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1,c.length);
		if (c.indexOf(cookiename) == 0) return c.substring(cookiename.length,c.length);
		}
		return null;
}

var d = new Querystring( unescape( readCookie('form_data') ) );
var g = new Querystring( );

if (document.cookie.length > 0)
{
	var formcookie = 'form_data';
	gotData = document.cookie.indexOf(formcookie+"=");
	if (gotData != -1) // Note: != means "is not equal to"
	{
		document.getElementById('captcha_error').style.display = "block";
	}
}

if (d.params) {
	for(i in d.params) {
		is = document.getElementsByName( i );
		if (is[0] && is[0].value.length < 1) {
			is[0].value = unescape( d.params[i] );
		}
	}
}

if (QuerystringGet(g, 'cf') && document.getElementById('cap_fail')) {
	document.getElementById('cap_fail').style.display = 'block';
}

/* ---- */

/* Client-side access to querystring name=value pairs
	Version 1.2.5
	6 May 2008
	
	License (Simplified BSD):
	http://adamv.com/dev/javascript/qslicense.txt
*/
function Querystring(qs) { // optionally pass a querystring to parse
	this.params = {};
	//alert( document.location );
	if (qs == null) qs = document.location.search.substring(1, location.search.length);
	if (qs.length == 0) return;

// Turn <plus> back to <space>
// See: http://www.w3.org/TR/REC-html40/interact/forms.html#h-17.13.4.1
	qs = qs.replace(/\+/g, ' ');
	var args = qs.split('&'); // parse out name/value pairs separated via &

// split out each name=value pair
	for (var i = 0; i < args.length; i++) {
		var pair = args[i].split('=');
		var name = decodeURI(pair[0]);
		
		var value = (pair.length==2)
			? decodeURI(pair[1])
			: name;
		
		this.params[name] = value;
	}
};

function QuerystringGet(obj, key, default_) {
	var value = obj.params[key];
	return (value != null) ? value : default_;
}
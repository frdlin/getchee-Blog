<?php
/**
* S2 FORM PROCESSOR FOR HIGHRISE
* Copyright StringTwo Software, LLC - www.stringtwo.com
* Permission to copy or distribute this software and its documentation,
* with or without modification, for any purpose is prohibited.
* Software may be modified for single users own purpose.
*
* DISCLAIMERS
* 
* StringTwo Software, LLC is not liable for any direct, indirect, special 
* or consequential damages arising out of any use of this software or 
* documentation.
* 
* The name and trademarks of copyright holders may NOT be used in
* advertising or publicity pertaining to the software without specific, written
* prior permission.
* 
* Title to copyright in this software and any associated documentation 
* will at all times remain with copyright holders.
*
* Highrise and 37signals are registered trademarks of 37signals, LLC.
* 37signals is not associated with StringTwo Software, LLC
*/

$path = dirname( __FILE__ );
ini_set('include_path', 
  ini_get('include_path') . PATH_SEPARATOR .
	$path. '/phpmailer/' . PATH_SEPARATOR .
	$path. '/phpmailer/language/' . PATH_SEPARATOR);
require_once('config.php');
require_once('XMLParser.php');
require_once("class.phpmailer.php");
require_once("class.smtp.php");

//set variables
$sys_message = array();
$use_captcha = $conf['use_captcha'];
$token = $conf['highrise_token'];
$highrise_url = $conf['complete_highrise_url'];
$last_char = substr($highrise_url, -1);
if ($last_char != '/') {
  $highrise_url = $highrise_url.'/';
}
$add_hr_task = $conf['add_task'];
$full_form_note = $conf['full_form_note'];
//url redirect on success
$success_redirect = $conf['url_on_successful_submit'];
//smtp mail server settings
$smtp_host = $conf['smtp_host'];
$smtp_port = $conf['smtp_port'];
$smtp_use_authenication = $conf['use_authenication'];
$smtp_username = $conf['smtp_username'];
$smtp_password = $conf['smtp_password'];
//send email to contact variables
$send_email_to_contact = $conf['send_email_to_contact'];
$contact_email_from = $conf['contact_email_from'];
$contact_email_return_address = $conf['return_email_address'];
$contact_email_subject = $conf['contact_email_subject'];
$contact_email_body  = $conf['contact_email_body'];
$contact_sig_line1 = $conf['contact_email_signature_line_1'];
$contact_sig_line2 = $conf['contact_email_signature_line_2'];
$contact_sig_line3 = $conf['contact_email_signature_line_3'];
$contact_sig_line4 = $conf['contact_email_signature_line_4'];
$contact_sig_line5 = $conf['contact_email_signature_line_5'];
//conformation email variables
$send_email_to_self = $conf['send_email_to_self'];
$confirmation_email_subject = $conf['subject'];
$confirmation_email_to = $conf['conf_email_to'];
$confirmation_email_from_name = $conf['conf_email_from_name'];
$confirmation_email_from = $conf['conf_email_from'];

//test highrise account
function highrise_api_test()
{
	global $token;
	global $highrise_url;
	$url = $highrise_url.'users.xml';
	
	//make sure curl is installed
	if (!$got_curl = function_exists('curl_init')) {
		return 'ERROR: PHP libcurl support is not installed.';
	}
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERPWD, $token);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,20);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	$result = curl_exec($ch);
	curl_close($ch);
	//check for successful create
	if (preg_match("/200 OK/", $result)) {
		return 'We were successfully able to reach your Highrise account.';
	}
	
	//check for bad token
	if (preg_match("/401 Unauthorized/", $result)) {
		return 'ERROR: Unable to access your Highrise account. Please check your Highrise token.';
	}
	
	//check for bad token
	if (preg_match("/302 Moved/", $result) || preg_match("/302 Found/", $result) || $result == false) {
		return 'ERROR: Unable to access your Highrise account. Please check your Highrise domain.';
	}
	
	return 'ERROR: Unable to connect to your Highrise account.';	
}

//functin http_build_query for PHP4.3+
if (!function_exists('http_build_query')) {
    function http_build_query($data, $prefix='', $sep='', $key='') {
        $ret = array();
        foreach ((array)$data as $k => $v) {
            if (is_int($k) && $prefix != null) {
                $k = urlencode($prefix . $k);
            }
            if ((!empty($key)) || ($key === 0))  $k = $key.'['.urlencode($k).']';
            if (is_array($v) || is_object($v)) {
                array_push($ret, http_build_query($v, '', $sep, $k));
            } else {
                array_push($ret, $k.'='.urlencode($v));
            }
        }
        if (empty($sep)) $sep = ini_get('arg_separator.output');
        return implode($sep, $ret);
    }// http_build_query
}//endif

function bad_captcha($redirect)
{
	$values = http_build_query($_POST);
	setcookie("form_data", $values, time()+3600*24*(2), '/', null, 0 );
	header('Location: '.$redirect);
	die();
}

//check for captcha
function check_captcha()
{
	//captcha question answers
	$captcha_values = array('','');
	//$captcha_values = array('7','red','1','green','white', 'yellow', '6');
	
	//if is set captcha cookie unset
	if (isset($_COOKIE['form_data'])) {
		setcookie("form_data", '', time()-3600, '/', null, 0 );
	}
	
	//set the return url
	if (isset($_POST['form_path'])) {
		$return_url = $_POST['form_path'];
	}else{
		$return_url = $_SERVER["HTTP_REFERER"];
	}
	
	foreach ($captcha_values as $key => $value) {
		$pv = 'captcha_'.$key;
		if (isset($_POST[$pv])) {
			$answer = strtolower($_POST[$pv]);
			if ($answer == $value) {
				return;
			}else{
				bad_captcha($return_url);
			}
		}
	}
	
	bad_captcha($return_url);
}

//cleans the data for xml
function prep($value)
{
  $bad = ini_get('magic_quotes_gpc');
  if ($bad) {
    $value = stripslashes($value);
  }
	$clean = trim(htmlentities($value, ENT_QUOTES));
	return $clean;
}

//array dif key function for php4
//takes same inputs as php function
function PHP4_array_diff_key()
{
	$arrs = func_get_args();
	$result = array_shift($arrs);
	foreach ($arrs as $array) {
	    foreach ($result as $key => $v) {
	        if (array_key_exists($key, $array)) {
	            unset($result[$key]);
	        }
	    }
	}
	return $result;
}

//extract form data and create proper XML to send to Highrise
function create_contact_xml()
{

	if (isset($_POST['name'])) {
		$name = $_POST['name'];
		$names = explode(" ", $name);
		if (isset($names[0])) {
			$first_name = prep($names[0]);
		} else {
			$first_name = '';
		}
	
		if (isset($names[1])) {
			$last_name = prep($names[1]);
		} else {
			$last_name = '';
		}
	
		//extract first and last name and set variable
	} elseif(isset($_POST['first_name']) && isset($_POST['last_name'])) {
		$first_name = prep($_POST['first_name']);
		$last_name = prep($_POST['last_name']);
	} else {
		$first_name = '';
		$last_name = '';
	}

	//min requirement for highrise is first/last name
	if ($first_name == '' && $last_name == '') {
		return false;
	}

	//company
	if (isset($_POST['company'])) {
		$company = prep($_POST['company']);
	} else {
		$company = '';
	}
	//phone
	if (isset($_POST['phone'])) {
		$phone = prep($_POST['phone']);
	} else {
		$phone = '';
	}
	//email
	if (isset($_POST['email'])) {
		$email = prep($_POST['email']);
	} else {
		$email = '';
	}
	//web site
	if (isset($_POST['web_site'])) {
		$web_site = prep($_POST['web_site']);
	} else {
		$web_site = '';
	}
	//title
	if (isset($_POST['title'])) {
		$title = prep($_POST['title']);
	} else {
		$title = '';
	}
	//newsletter subscribe
	if (isset($_POST['subscribe'])) {
		$title = prep($_POST['subscribe']);
	} else {
		$title = '';
	}
	//industry
	if (isset($_POST['industry'])) {
		$industry = prep($_POST['industry']);
	} else {
		$industry = '';
	}
	//cities
	if (isset($_POST['cities'])) {
		$cities = prep($_POST['cities']);
	} else {
		$cities = '';
	}
$contact_xml =<<<CONTACT
	<person>
	  <first-name>{$first_name}</first-name>
	  <last-name>{$last_name}</last-name>
	  <title>{$title}</title>
	  <company-name>{$company}</company-name>
	  <background></background>
	  <contact-data>
			<web-addresses>
		    <web-address>
		      <location>Work</location>
		      <url>{$web_site}</url>
		    </web-address>
		  </web-addresses>
	    <email-addresses>
	      <email-address>
	        <address>{$email}</address>
	        <location>Work</location>
	      </email-address>
	    </email-addresses>
	    <phone-numbers>
	      <phone-number>
	        <number>{$phone}</number>
	        <location>Work</location>
	      </phone-number>
	    </phone-numbers>
	  </contact-data>
	</person>
CONTACT;

	return $contact_xml;
} 

//extract form data that is not designated as a highrise tag and create xml for note
function create_note_xml()
{
	$highrise_note = '';
	
	foreach ($_POST as $key => $value) {
		if (!preg_match("/captcha_/", $key) && !preg_match("/form_path/", $key)) {
			$highrise_note .= $key.' - '.$value."<br />";
		}
	}
	$note = prep($highrise_note);
	$note_xml =<<<NOTE
	<note>
	  <body>{$note}</body>
	</note>
NOTE;

	return $note_xml;
}

//connects to the highrise api via curl
function highrise_api($xml, $url)
{
	global $token;
	$header = array('Content-type: application/xml');
	//make sure curl is installed
	if (!$got_curl = function_exists('curl_init')) {
		return 'ERROR: PHP libcurl support is not installed.';
	}
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_USERPWD, $token);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,20);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$result = curl_exec($ch);
	curl_close($ch);
	
	//check for successful create
	if (preg_match("/201 Created/", $result)) {
		return strstr($result, '<?xml');
	}
	
	//check for bad token
	if (preg_match("/401 Unauthorized/", $result)) {
		return 'ERROR: Unable to access your Highrise account. Please check your Highrise token.';
	}
	
	//check for bad token
	if (preg_match("/302 Moved/", $result)) {
		return 'ERROR: Unable to access your Highrise account. Please check your Highrise domain.';
	}
	
	return 'ERROR: Unable to connect to your Highrise account.';
}

//add contact information and note to highrise
function add_contact()
{
	global $highrise_url;
	global $sys_message;
	global $add_hr_task;
	global $full_form_note;
	//add contact to highrise	
	$contact_url = $highrise_url.'people.xml';
	$contact_xml = create_contact_xml();
	if ($contact_xml == false) {
		$sys_message[] = 'Not enough client data to add to Highrise';
	  return $sys_message;
	}
	
	$add_contact = highrise_api($contact_xml, $contact_url);
	
	//if add contact was successful then add note and tags
	if (!preg_match("/ERROR:/", $add_contact)) {
		$sys_message[] = 'Client was successfully added to Highrise';
		$parser = new XMLParser($add_contact);
		$parser->Parse();
		$id = $parser->document->id[0]->tagData;
		
		if ($full_form_note) {
		  $note_xml = create_note_xml();
  		if (!$note_xml) {
  			$note_xml = 'New Contact information request.';
  		}

  		$note_url = $highrise_url.'people/'.$id.'/notes.xml';
  		$add_note = highrise_api($note_xml, $note_url);
  		if (!preg_match("/ERROR:/", $add_note)) {
  			$sys_message[] = 'Client note was successfully added to Highrise';
  		}else{
  			$sys_message[] = 'Highrise Error Adding Note: '.$add_note;
  		}
		}
		//check for tags
		if (isset($_POST['tags'])) {
			//parse csv value
			$tags = explode(',', $_POST['tags']);
			if (!empty($tags)) {
				$tag_url = $highrise_url."people/{$id}/tags.xml";
				//add tags to client
				foreach ($tags as $value) {
					$xml = "<name>{$value}</name>";
					$add_tag = highrise_api($xml, $tag_url);
					//add message for tag add
					if (!preg_match("/ERROR:/", $add_tag)) {
						$sys_message[] = 'Tag added successfully to Client: '.$value;
					}else{
						$sys_message[] = 'Highrise Error Adding Tags: '.$add_tag;
					}
				}
			}
		}
		//check for task
		if ($add_hr_task) {
			if (isset($_POST['name'])) {
				$name = prep($_POST['name']);
				//extract first and last name and set variable
			} elseif(isset($_POST['first_name']) && isset($_POST['last_name'])) {
				$first_name = prep($_POST['first_name']);
				$last_name = prep($_POST['last_name']);
				$name = $first_name.' '.$last_name;
			} else {
				$name = '';
			}
			$task_url = $highrise_url."tasks.xml";
			$xml = "<task><body>Follow up with new web form contact - {$name}</body><frame>tomorrow</frame></task>";
			$add_task = highrise_api($xml, $task_url);
			//add message for tag add
			if (!preg_match("/ERROR:/", $add_task)) {
				$sys_message[] = 'Task added successfully to Highrise';
			}else{
				$sys_message[] = 'Highrise Error Adding Task: '.$add_task;
			}
		}
	}else{
		$sys_message[] = 'Highrise Error Adding Client: '.$add_contact;
	}
	return $sys_message;
}

//send contact a confirmation email
function send_contact_email()
{
	global $sys_message;
	//smtp settings
	global $smtp_host;
	global $smtp_port;
	global $smtp_use_authenication;
	global $smtp_username;
	global $smtp_password;
	//mail to contact info
	global $contact_email_from;
	global $contact_email_return_address;
	global $contact_email_subject;
	global $contact_email_body;
	global $contact_sig_line1;
	global $contact_sig_line2;
	global $contact_sig_line3;
	global $contact_sig_line4;
	global $contact_sig_line5;
	
	$mail = new PHPMailer();
	$mail->SetLanguage("en", "phpmailer/language/");
	//smtp settings
	$mail->IsSMTP();
	$mail->Host = $smtp_host;
	$mail->Port = $smtp_port;
	$mail->SMTPAuth = $smtp_use_authenication;// turn on SMTP authentication
	$mail->Username = $smtp_username;  // SMTP username
	$mail->Password = $smtp_password; // SMTP password

	$client_email = $_POST['email'];
	if (!empty($client_email)) {
		if (isset($_POST['name'])) {
			$name = $_POST['name'];
		}elseif(isset($_POST['first_name'])) {
			$name = $_POST['first_name'];
		}else{
			$name = '';
		}

		$mail->FromName = $contact_email_from;
		$mail->From = $contact_email_return_address;
		$mail->AddAddress($client_email, $name);
		$mail->WordWrap = 50;// set word wrap to 50 characters
		$mail->IsHTML(true);// set email format to HTML
		//compile message
		$message = "<br />{$contact_email_body}<br /><br />";
		$message .= "{$contact_sig_line1}<br />";
		$message .= "$contact_sig_line2<br />";
		$message .= "$contact_sig_line3<br />";
		$message .= "$contact_sig_line4<br />";
		$message .= "$contact_sig_line5";
		
		$mail->Subject = $contact_email_subject;
		$mail->Body    = $message;
		$mail->AltBody = $message;
		

		if(!$mail->Send()){
			$sys_message[] = "Message could not be sent to contact. Mailer Error: " . $mail->ErrorInfo;
		}
		$sys_message[] = 'Email notification successfully sent to contact.';
	}else{
		$sys_message[] = 'Unable to send contact email.  Contact did not provide an email address';
	}

	return $sys_message;
}

function send_confirm_email($sys_message)
{
	global $confirmation_email_to;
	global $confirmation_email_subject;
	global $confirmation_email_from;
	global $confirmation_email_from_name;
	global $smtp_host;
	global $smtp_port;
	global $smtp_use_authenication;
	global $smtp_username;
	global $smtp_password;
	global $highrise_url;
	
	$mail = new PHPMailer();
	$mail->SetLanguage("en", "phpmailer/language/");
	//smtp settings
	$mail->IsSMTP();
	$mail->Host = $smtp_host;// specify main and backup server
	$mail->Port = $smtp_port;
	$mail->SMTPAuth = $smtp_use_authenication;// turn on SMTP authentication
	$mail->Username = $smtp_username;  // SMTP username
	$mail->Password = $smtp_password; // SMTP password
	$mail->FromName = $confirmation_email_from_name;
	$mail->From = $confirmation_email_from;
	if (preg_match('/,/', $confirmation_email_to)) {
	  preg_replace('/\s/', '', $confirmation_email_to);
  	$addresses = explode(',', $confirmation_email_to);
  	foreach ($addresses as $address) {
  	  $mail->AddAddress($address);
  	}
	}else{
	  $mail->AddAddress($confirmation_email_to);
	}
	$mail->WordWrap = 50;// set word wrap to 50 characters
	$mail->IsHTML(true);// set email format to HTML

	//compile comformation message
	$message = "The following information was submitted via your website form:<br /><br />";
	$message .= "System messages:<br /><br />";
	if (!empty($sys_message)) {
	 	foreach ($sys_message as $result) {
  		$message .= "{$result}<br />";
  	}
	}
	$message .= "<br /><a href=\"{$highrise_url}\">Visit your Highrise Account</a><br />";
	$message .= "<br />Raw Form Data: <br /><br />";
	foreach ($_POST as $key => $value) {
		$message .= $key.' - '.$value."<br />";
	}
	
	$mail->Subject = $confirmation_email_subject;
	$mail->Body    = stripslashes($message);
	$mail->AltBody = stripslashes($message);

	if(!$mail->Send())
	{
	   return "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
	}
	return "Message has been sent";
}

function smtp_test()
{
	global $confirmation_email_to;
	global $confirmation_email_subject;
	global $confirmation_email_from;
	global $confirmation_email_from_name;
	global $smtp_host;
	global $smtp_port;
	global $smtp_use_authenication;
	global $smtp_username;
	global $smtp_password;
	
	$mail = new PHPMailer();
	$mail->SetLanguage("en", "phpmailer/language/");
	//smtp settings
	$mail->IsSMTP();
	$mail->Host = $smtp_host;  // specify main and backup server
	$mail->Port = $smtp_port;
	$mail->SMTPAuth = $smtp_use_authenication;     // turn on SMTP authentication
	$mail->Username = $smtp_username;  // SMTP username
	$mail->Password = $smtp_password; // SMTP password
	$from = $confirmation_email_from;
	$fromname = $confirmation_email_from_name;
  $mail->FromName = $confirmation_email_from_name;
  $mail->From = $confirmation_email_from;
	if (preg_match('/,/', $confirmation_email_to)) {
	  preg_replace('/\s/', '', $confirmation_email_to);
  	$addresses = explode(',', $confirmation_email_to);
  	foreach ($addresses as $address) {
  	  $mail->AddAddress($address);
  	}
	}else{
	  $mail->AddAddress($confirmation_email_to);
	}
	$mail->WordWrap = 50;                                 // set word wrap to 50 characters
	$mail->IsHTML(true);                                  // set email format to HTML

	//compile comformation message
	$message = "This is a test email message sent from S2 Form Processor for Highrise.<br /><br />";
	
	$mail->Subject = 'Test Message for S2 Form';
	$mail->Body    = $message;
	$mail->AltBody = $message;

	if(!$mail->Send())
	{
	   return "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
	   exit;
	}

	return "Message has been sent. Your SMTP settings are properly configured.";
	exit;
}
?>

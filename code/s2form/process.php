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

require_once('functions.php');
if ($use_captcha) {
	$check_captcha = check_captcha($_POST);
}
//attempt to add the contact information to highrise
$add_contact = add_contact();
//send mail if enabled
if ($conf['use_email'] == true) {
  //send email to client if turned on
  if ($send_email_to_contact == true) {
  	$send_contact_email = send_contact_email();
    $message = $send_contact_email;
  }else{
    $message = $add_contact;
  }
  //send confirmation email to self
  if ($send_email_to_self == true) {
    $send_self_email = send_confirm_email($message);
  }
}
//redirect to successful submit page
header('Location: '.$success_redirect);
?>
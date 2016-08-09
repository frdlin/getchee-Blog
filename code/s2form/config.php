<?php
/**
 * StringTwo form configuration file.  
 * Edit the following values to set up your form to work with Highrise, add captcha and
 * send conformation emails.
 *
 * Tips: Only edit to the right of the equals sign.  All values other than true/false/number must be
 * surrounded by quotes.  Use the example values as a starting point.
 */

////////////////////////////////////////////////////////////////////////////////////////////
///////////////  HIGHRISE API SETTINGS  ////////////////////////////////////////////////////

/**
 * Description: Highrise url - Your company Highrise url
 * Value: Your company Highrise url
 * Default: example
 * Note: If your using ssl in your Highrise account make sure you use https rather than http. The
 * trailing slash on your url is necessary ex: https://yourcompany.highrisehq.com/
 *
 */
$conf['complete_highrise_url'] = "https://getchee.highrisehq.com/";

/**
 * Description: Highrise API token
 * Value: API token issued by Highrise
 * Default: example
 * Note: Login to Highrise -> My Info -> User Account -> Reveal Authentication Token
 *
 */
$conf['highrise_token'] = "7c45f4338fa76f2075d269817bfde1b4";

/**
 * Description: Add a task to your Highrise Account
 * Value: true or false
 * Default: false
 * Note: Creates a followup task for the next day in Highrise when the contact information is added
 *
 */
$conf['add_task'] = true;

/**
 * Description: Add a note to your Highrise Account with all the form field data including fields
 * that may not be compatible with Highries fields.  Essentially a summary of your form data added
 * as a note in Highrise.
 * Value: true or false
 * Default: true
 *
 */
$conf['full_form_note'] = true;

////////////////////////////////////////////////////////////////////////////////////////////
///////////////  General Form Settings  ////////////////////////////////////////////////////

/**
 * Description: Page to open after your form was submitted successfully
 * Value: Full path to your success page
 * Default: example
 * Example: http://www.yourdomain.com/thankyou.html
 */
$conf['url_on_successful_submit'] = "http://www.getchee.com/thank-you.html";

/**
 * Description: Use Captcha - Adds captcha functionality to your forms
 * Value: true of false
 * Default: false
 * 
 */
$conf['use_captcha'] = true;

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////  Email Settings  (Optional)  ////////////////////////////////////////
/**
 * Mail settings are entirely optional.  You can use the following settings to send an email to
 * the contact that filled out the form, a conformation to yourself/company or both. 
 * 
 * Note: Setting up SMTP settings can be tricky.  Make sure you have the username and password
 * for your email account if authentication is necessary.  Check with your ISP for more details.
 * If your using Google mail we have provided the host settings you will just need to add your
 * username and password.
 */

/**
 * Description: Use Email - Do you want to use email confirmations
 * Value: true or false
 * Default: false
 * Note: Only conformation email to self are available in the trial version
 *
 */
$conf['use_email'] = true;

/**
 * Description: SMTP host - the host account that your will use to send email from.
 * Value: Your SMTP host data from your ISP
 * Default: example
 * Note: If using gmail set value to ssl://smtp.gmail.com
 *
 */
$conf['smtp_host'] = "katib.lunarbreeze.com";

/**
 * Description: SMTP Authentication - Some ISP's will require you to use authentication when using their mail server.
 * Value: true or false
 * Default: false
 *
 */
$conf['use_authenication'] = true;

/**
 * Description: SMTP Username and Password - Required if above setting for authentication is set to true.
 * Value: username and password value from your ISP's SMTP server
 * Default: ""
 *
 */
$conf['smtp_username'] = "getchee0";
$conf['smtp_password'] = "getchee1";

/**
 * Description: SMTP Port - Some ISP's require outgoing mail to be sent using a specific port
 * Value: ISP SMTP outgoing mail port
 * Default: 25
 *
 * Note: If using gmail set port to 465
 */
$conf['smtp_port'] = 25;

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////  Conformation Email to Self  ////////////////////////////////////////

/**
 * Description: Conformation email to self - Emails sent to you when the form is submitted
 * Value: send_email_to_self - enable this feature true or false
 * Value: subject - custom subject
 * Value: conf_email_from_name - From name that will appear on email
 * Value: conf_email_from - From email address
 * Value: conf_email_to - To email address
 *
 * Note: All values are required
 */
$conf['send_email_to_self'] = true;
$conf['subject'] = "New Lead";
$conf['conf_email_from_name'] = "getchee Website";
$conf['conf_email_from'] = "noreply@getchee.com";
$conf['conf_email_to'] = "marketing@getchee.com";

////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////  Conformation Email to Lead  ////////////////////////////////////////

/**
 * Description: Conformation email to lead - sends email to lead that filled out the form
 * Value: send_email_to_contact - enable this feature true or false
 * Value: subject - custom subject
 * Value: contact_email_from - From name that will appear on email
 * Value: return_email_address - From email address - return email address
 * Value: contact_email_subject - custom subject 
 * Value: contact_email_body - message to send to lead
 * Value: contact_email_signature_line - up to 5 custom signature lines for the email
 * Value: conf_email_to - To email address
 * Not available in trial version
 *
 */
$conf['send_email_to_contact'] = true;
$conf['contact_email_from'] = "getchee";
$conf['return_email_address'] = "noreply@getchee.com";
$conf['contact_email_subject'] = "Thanks for contacting us.";
$conf['contact_email_body'] = "You can expect a response from getchee within 1 business day.";
$conf['contact_email_signature_line_1'] = "The getchee Team";
$conf['contact_email_signature_line_2'] = "";
$conf['contact_email_signature_line_3'] = "";
$conf['contact_email_signature_line_4'] = "";
$conf['contact_email_signature_line_5'] = "";
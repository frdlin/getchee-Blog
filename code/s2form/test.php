<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta http-equiv="Content-Style-Type" content="text/css" />
	<title>S2 Form Processor Settings Test Page</title>
	<style type="text/css">
	body{margin:0px;padding:0px;color:#000000; font-size:100%; text-align:center;}
	#wrapper{margin:0 auto; text-align:left; width:750px;}
	.success{color:green; font-weight:bold; padding:5px 0;}
	.error{color:red; font-weight:bold; padding:5px 0;}
	p{line-height:1.3em;}
	div{margin-bottom:20px;}
	h1{}
	h2{}
	#header{margin:10px 0px 20px 0px;}
	.right{float:right; padding-right:20px;}
	.left{float:left;}
	form.hr_form{background:#F0F7FA;border:2px solid #B7CCDB;width:232px;padding:10px 20px 20px 20px;}
	form.hr_form h2{color:#B55B27; font-size:19px; font-weight:bold; margin-bottom:20px;}
	label{display:block;color:#5A4E27;width:230px;}
	form.hr_form input, form.hr_form textarea{border:1px solid #7F9DB9; font-sixe:14px; width:230px;margin:3px 0 5px 0;padding:3px;}
	</style>
	
</head>
<body>
<div id="wrapper">
	<div id="header">
		<img src="s2-highrise-logo.jpg" class="right" alt="StringTwo Form Processor: Highrise Version" />
		<img src="s2_logo.jpg" alt="StringTwo Software Logo" />
		
	</div><!-- end div header -->
	<div id="intro">
		<h1>S2 Form Processor Config Settings Test Page</h1>
		<p>This page will test the various configuration settings required to run the S2 Form Processor to Highrise application.  Please make sure that you have added your settings to the config.php file located in the /s2form directory.</p>
	</div><!-- end div intro -->
	<hr>
	<?php if (file_exists('config.php')): ?>
	  <?php 
	    include_once('config.php'); 
	    include_once('functions.php');
	  ?>
  	<div id="highrise_test">
  		<?php
  			$hr_test = highrise_api_test();
  			if (preg_match("/ERROR:/", $hr_test)) {
  				$hr_class = 'error';
  			}else{
  				$hr_class = 'success';
  			}
  		?>
  		<h2>Highrise Settings</h2>
  		<p><strong>Your Highrise settings are as follows:</strong></p>
  		<p>
  			<strong>Highrise Url:</strong> <?php echo $highrise_url; ?><br />
  			<strong>Highrise Token:</strong> Omitted for security reasons.<br />
  		</p>
  		<span class= "<?php echo $hr_class; ?>" ><?php echo $hr_test; ?></span>
  	</div><!-- end div highrise_test -->
  	<hr>
  	<div id="mail_test">
  	  <h2>SMTP Mail Settings (Optional)</h2>
  	<?php if ($conf['use_email'] == true): ?>
  	  <?php if (!empty($conf['smtp_host']) AND !empty($conf['conf_email_to'])): ?>
  	   	<?php
    	 	 	$smtp_test = smtp_test();
    			if (preg_match("/Mailer Error:/", $smtp_test)) {
    				$smtp_class = 'error';
    			}else{
    				$smtp_class = 'success';
    			}
    		?>
    	 	<p><strong>Your SMTP settings are as follows:</strong></p>
    		<p>
    			<strong>SMTP Host:</strong> <?php echo $smtp_host; ?><br />
    			<strong>SMTP Use Authenication:</strong> <?php echo $smtp_use_authenication == true ? 'Yes' : 'No'; ?><br />
    			<strong>SMTP User:</strong> <?php echo $smtp_username; ?><br />
    			<strong>SMTP Password:</strong> Omitted for security reasons.
    		</p>
    		<span class= "<?php echo $smtp_class; ?>" ><?php echo $smtp_test; ?></span>
    	<?php else: ?>
    	  <p class="error">You must supply a SMTP host in your config file and have a valid email address for your conformation to value.</p>
  	  <?php endif ?>
  	<?php else: ?>
  		<p>Mail settings are not currently configured.</p>
  	<?php endif ?>
	
  	</div><!-- end div mail_test -->
  	<hr>
	
  	<div id="curl_test">
  		<?php
  			if (!$got_curl = function_exists('curl_init')) {
  				$curl_class = 'error';
  				$message = 'We were unable to access the libcurl library using PHP.  This is necessary for the script to work properly.  It is possible that libcurl is installed but not enabled.  Check you php.ini file and make sure the line - extension=php_curl.dll - is uncommented.';
  			}else{
  				$curl_class = 'success';
  				$message = 'The Curl library is enabled and accessible.';
  			}
  		?>
  		<h2>PHP Curl Settings</h2>
  		<p>PHP supports libcurl, a library created by Daniel Stenberg, that allows you to connect and communicate to many different types of servers with many different types of protocols.  PHP curl support is enabled and available on nearly all shared hosting platforms.  If you setup and run your own server you may have to manually add support for libcurl support. PHP libcurl support is necessary for the script to run properly.</p>
  		<span class= "<?php echo $curl_class; ?>" ><?php echo $message; ?></span>
  		<p><strong>Curl resources:</strong></p>
  		<a href="http://bobcares.com/blog/?p=98" target="_blank">Deploying libcurl with PHP</a><br />
  		<a href="http://us3.php.net/manual/en/intro.curl.php" target="_blank">PHP curl manual</a>
  	</div><!-- end div mail_test -->
  	<hr>
	
  	<div id="help">
  		<h2>Need Help?</h2>

  		<ul>
  		<li>Check out our <strong><a href="http://www.stringtwo.com/forums/" target="_blank">user forums</a></strong>.</li>
  		<li>Issue not documented on the forums?<strong><a href="mailto:support@stringtwo.com" > Email us</a></strong>.</li>
  		</ul>	
		
  	</div><!-- end div help -->
  <?php else: ?>
    <p class="error">You need a config.php file to get started. Rename your config-sample.php to config.php and make sure you add your settings then try again.</p>
	<?php endif ?>
</div><!-- end div wrapper -->

</body>
</html>

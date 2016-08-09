<?php

/**

 * Template: Header.php 

 *

 * @package WPFramework

 * @subpackage Template

 */

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head>

	<meta charset="utf-8">

	<title><?php semantic_title(); ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta name="description" content="getchee blog">

	<meta name="keywords" content="getchee blog">

	<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo('charset'); ?>" />

	<meta name="generator" content="WordPress" />

	<!--link rel="shortcut icon" href="<!--?php echo IMAGES . '/favicon.ico'; ?>" /-->

	<link rel="image_src" href="http://blog.getchee.com/wp-content/themes/getchee/website-thumbnail.png" />

	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600" />

	<link rel="stylesheet" href="<?php echo CSS . '/basic-style.css'; ?>" />

	<link rel="stylesheet" href="<?php echo CSS . '/large.css'; ?>" />

	<link rel="stylesheet" href="<?php echo CSS . '/medium.css'; ?>" />

	<link rel="stylesheet" href="<?php echo CSS . '/small.css'; ?>" />

	<link rel="stylesheet" href="<?php echo CSS . '/prettyPhoto.css'; ?>" />

	<script src="<?php echo JS . '/jquery-1.8.3.js'; ?>"></script>

	<script src="<?php echo JS . '/jquery-selectbox.js'; ?>"></script>

	<script src="<?php echo JS . '/custom-form-elements.js'; ?>"></script>

	<script src="<?php echo JS . '/global-scripts.js'; ?>"></script>

	<script src="<?php echo JS . '/jquery.prettyPhoto.js'; ?>"></script>

	<script src="<?php echo JS . '/jquery.validationEngine-en.js'; ?>"></script>

	<script src="<?php echo JS . '/jquery.validationEngine.js'; ?>"></script>

	<script>

		jQuery(document).ready(function(){

			// binds form submission and fields to the validation engine

			jQuery("#contact-form").validationEngine('attach', {promptPosition : "topLeft", autoPositionUpdate : true});

		});

	</script>

	<!--[if IE]>

		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>

	<![endif]-->

	<!--[if lt IE 9]>

		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>

	<![endif]-->

	<script>

		$(document).ready(function(){

			$(".search-switch").click(function(){

				$(".search").css({"visibility":"visible"}, 1000);

				$(".form-button").css({"visibility":"visible"}, 1000);

			});

		});

	</script>



	<script>

		function fbs_click() {

			u=location.href;t=document.title;window.open(

				'http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),

				'sharer','toolbar=0,status=0,width=626,height=436'

			);return false;

		}

	</script>

	<!-- Begin LinkedIn pop-up JavaScript -->

		<script>

			var win=null;

			function NewWindow(mypage,myname,w,h,scroll,pos){

				if(pos=="random"){LeftPosition=(screen.width)?Math.floor(Math.random()*(screen.width-w)):100;TopPosition=(screen.height)?Math.floor(Math.random()*((screen.height-h)-75)):100;}

                if(pos=="center"){LeftPosition=(screen.width)?(screen.width-w)/2:100;TopPosition=(screen.height)?(screen.height-h)/2:100;}

                else if((pos!="center" && pos!="random") || pos==null){LeftPosition=0;TopPosition=20}

                settings='width='+w+',height='+h+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',location=no,directories=no,status=no,menubar=no,toolbar=no,resizable=no';

                win=window.open(mypage,myname,settings);}

		</script>

	<!-- End LinkedIn pop-up JavaScript -->

	<script>

	$(document).ready(function(){

		$("#contact-form").get(0).reset();

		$("#contact-form")[0].reset();

	});

	</script>

	<script>

		$.getJSON('http://api.wipmania.com/jsonp?callback=?', function (data) {

			if (data.address.country_code == "CN") {

				$(".vimeo").hide();

				$(".youku").show();

			}

			else {

				$(".vimeo").show();

				$(".youku").hide();

			}

		});

	</script>



<script type="text/javascript">



  var _gaq = _gaq || [];

  _gaq.push(['_setAccount', 'UA-4949329-2']);

  _gaq.push(['_setDomainName', 'getchee.com']);

  _gaq.push(['_setAllowLinker', true]);

  _gaq.push(['_trackPageview']);



  (function() {

    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;

    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';

    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);

  })();



</script>



</head>

<body>

	<!-- Head -->

    <header id="header">

		<a href="http://blog.getchee.com/"><div id="logo"></div></a>

		<div id="head_link">

			<ul>

				<a href="http://www.getchee.com/newsletter/?utm_source=Getchee+Blog&utm_medium=Top+Page+Button&utm_content=Newsletter+Signup&utm_campaign=Newsletter+Subscribe" target="_blank"><li class="head_newsletter">Newsletter Signup</li></a>

				<a href="mailto:curious@getchee.com" target="_blank"><li class="head_email">Email</li></a>

			</ul>

		</div>

		<div class="clear"></div>

		<div class="wrapper">

			<hgroup>

				<h1>Bloom</h1>

				<h2>A blog about retail growth in Asia.</h2>

			</hgroup>

		</div>

	</header>

	<div style="display:none" class="gallery clearfix"></div>

	<!-- Head -->
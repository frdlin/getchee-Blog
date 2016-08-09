// JavaScript Document
// IMAGE SWAPPER
$(document).ready( function()
{
   PEPS.rollover.init();
});
PEPS = {};

PEPS.rollover =
{
   init: function()
   {
      this.preload();
     
      $(".ro").hover(
         function () { $(this).attr( 'src', PEPS.rollover.newimage($(this).attr('src')) ); },
         function () { $(this).attr( 'src', PEPS.rollover.oldimage($(this).attr('src')) ); }
      );
   },

   preload: function()
   {
      $(window).bind('load', function() {
         $('.ro').each( function( key, elm ) { $('<img>').attr( 'src', PEPS.rollover.newimage( $(this).attr('src') ) ); });
      });
   },
   
   newimage: function( src )
   {
      return src.substring( 0, src.search(/(\.[a-z]+)$/) ) + '-o' + src.match(/(\.[a-z]+)$/)[0];
   },

   oldimage: function( src )
   {
      return src.replace(/-o\./, '.');
   }
};
/**/
// ROUNDED CORNER
$('#readyTest').corner();

$(function(){
	$('div.roundcorner-inner').wrap('<div class="roundcorner-outer"></div>');
	$('p').wrap("<code></code>");
	
	$('div.roundcorner-inner').each(function() {
		var t = $(this).corner("round 3px").parent().css('padding', '1px').corner("round 5px");
		eval(t);
	});
	
	// fixed/fluid tests
	$("div.box, div.plain").corner();
	$("#abs").corner("cc:#08e");
});

$(function(){
	$('div.roundcorner-inner2').wrap('<div class="roundcorner-outer"></div>');
	$('p').wrap("<code></code>");
	
	$('div.roundcorner-inner2').each(function() {
		var t = $(this).corner("round 3px").parent().css('padding', '1px').corner("round 5px");
		eval(t);
	});
	
	// fixed/fluid tests
	$("div.box, div.plain").corner();
	$("#abs").corner("cc:#08e");
});
// NETWORK POPUP
$(document).ready(function() {
	$("a#open_sites").click(function(){

			if($.browser.msie){
				var cssObj = {
				        backgroundImage: "none",
				        backgroundColor: "black",
				        filter: "alpha(opacity=80)"
				}

				$("div#sites_bg").css(cssObj).fadeIn('slow');
				$("div#sites_menu").fadeIn('slow');
				return false; 

			} else {

				$("div#sites_bg").fadeIn('slow');
				$("div#sites_menu").fadeIn('slow');
				return false;

			}
		});
		$("a#close_link").click(function(){
				$("div#sites_bg").fadeOut('slow');
				$("div#sites_menu").fadeOut('slow');
				return false; 
			});

			$("div#sites_bg").click(function(){
				$("div#sites_bg").fadeOut('slow');
				$("div#sites_menu").fadeOut('slow');
				return false; 
			});

		    var docHeight = $(document).height(); 
				$('div#sites_bg').css("height",docHeight);

				$('div#sites_menu div a').hover(function() {
					$(this).parent().addClass('hovered');
					}, function() {
					$(this).parent().removeClass('hovered');
					});
});
// CLEAR FORM
$(function(){ 
    // find all the input elements with title attributes
	$('input[title!=""]').hint();
});
// SUBMENU
$(document).ready(function(){
		$('#navigation li').hover(
			function() { $('ul', this).css('display', 'block'); },
			function() { $('ul', this).css('display', 'none'); });
		$('#navigation li.open').hover(
			function() { $('ul', this).css('display', 'block'); },
			function() { $('ul', this).css('display', 'block'); });
});

// IMAGE ZOOM
jQuery(document.body).imageZoom();
// GREY BOX
var GB_ANIMATION = true;
$(document).ready(function(){
	$("a.greybox").click(function(){
		var t = this.title || $(this).text() || this.href;
		GB_show(t,this.href,700,960);
		return false;
	});
});

if(ie6){ // do this
    alert("You are using Internet Explorer 6 or higher");
} 


// CHANGE LANGUAGE
function lang_change(lang) {
    //if page in root folder
    var FinalPath = "";
    var lang_symbol = "./"+lang+"/";
    //if (lang == "us")
        //lang_symbol = "../";
    var sPath = window.location.pathname;    
    var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
    FinalPath = lang_symbol + sPage;

    var sFolder = sPath.split('/');
    var MidFolderName = "";
    if (sFolder.length != 2 && lang != "us") {//if page is not in root folder
        for (var i in sFolder) {
            if (i != 0 && i != sFolder.length - 1) {
                MidFolderName += sFolder[i] + "/";
            }
        }
        MidFolderName = MidFolderName.substring(0, MidFolderName.length - 1);

        var MidFolderDeep = sFolder.length - 2;
        for (var i = 0; i < MidFolderDeep; i++)
            FinalPath = +"../";
        FinalPath = "/" + lang + "/" + MidFolderName + "/" + sPage;        
    }
    else if (sFolder.length != 2 && lang == "us") {//if page is not in root folder, and eng mode
        FinalPath = "";
        for (var i in sFolder) {
            if (i != 0 &&i != 1 && i != sFolder.length - 1) {
                MidFolderName += sFolder[i] + "/";
            }
        }
        MidFolderName = MidFolderName.substring(0, MidFolderName.length - 1);
        var MidFolderDeep = sFolder.length - 2;
        for (var i = 0; i < MidFolderDeep; i++)
            FinalPath += "../";

        var sym = "/";
        if (MidFolderName == "") sym = "";
        FinalPath += MidFolderName + sym + sPage;
    
    }    
    window.location = FinalPath;
}


// IMAGE PRELOAD
;( function( $ ){
  $.preload = function(){
    var tmp = [], i = arguments.length;
    // reverse loop run faster
    for( ; i-- ; ) tmp.push( $( '<images/>' ).attr( 'src', arguments[ i ]));
  };
})( jQuery );
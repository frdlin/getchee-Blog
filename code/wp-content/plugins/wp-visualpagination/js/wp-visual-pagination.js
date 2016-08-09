/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var visual_pagination_preview_url = '';

jQuery(function(){    
    
    jQuery('.color-box').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                    jQuery(el).val(hex);
                    jQuery(el).ColorPickerHide();
            },
            onBeforeShow: function () {
                    jQuery(this).ColorPickerSetColor(this.value);
            }
    })
    .bind('keyup', function(){
            jQuery(this).ColorPickerSetColor(this.value);
    });  
    jQuery('#default-button').click(function(e){
        if (!confirm('Are you sure to restore the default settings?')) {
            e.preventDefault();
            return;
        }
        jQuery('#update-button').val('');        
    }); 
    //opening fancybox
    jQuery('#preview-button').click(function() {
        var iframeurl = visual_pagination_preview_url + '&' + jQuery('#visual-pagination-option-form').serialize();
        iframeurl = 
        jQuery.fancybox({
            'autoDimensions': false,
            width: 570,
            height: 270,
            scrolling: 'no',
            type: 'iframe',
            href: iframeurl
        });
    });
});

function showTemplateSlide(slide_number, ajax_url) {
    jQuery('#slides').slides({
        preload: true,
        preloadImage: 'img/loading.gif',        
        generatePagination: true,
        pause: 2500,
        hoverPause: true,
        animationStart: function(current){
            jQuery('.caption').animate({
                    bottom:-35
            },100);
            if (window.console && console.log) {
                    // example return of current slide number
                    console.log('animationStart on slide: ', current);
            };
        },
        animationComplete: function(current){                
            jQuery('.caption').animate({
                    bottom:0
            },200);           
            var is_customizable = jQuery('#slides .slide:nth-child(' + current + ') #customizable').val();
            if ( is_customizable == '1' ) {
                var template_name = jQuery('#slides .slide:nth-child(' + current + ') #template-name').val();
                jQuery.ajax({
                    url: ajax_url,
                    type: 'POST',
                    dataType: 'json',
                    data: {'action': 'visual_pagination_get_settings', 'template_name' : template_name},
                    success: function(response) {
                        if (response.result != 'success')
                            return;
                        jQuery('#visual-pagination-option-form').show();
                        jQuery('.notification').hide();
                        
                        jQuery('#selected_theme').html(response.name);
                        jQuery('#template_name').val(response.name);                    
                        jQuery('#font_size').val(response.font_size);
                        jQuery('#color').val(response.color);                   
                        jQuery('#background_color').val(response.background_color);
                        jQuery('#hover_background_color').val(response.hover_background_color);
                        jQuery('#hover_color').val(response.hover_color);                    
                        jQuery('#current_page_color').val(response.current_page_color);                    
                        jQuery('#current_background_color').val(response.current_background_color);                    
                        jQuery('#prev_bg_color').val(response.prev_bg_color);                    
                        jQuery('#next_bg_color').val(response.next_bg_color);                    
                    },
                    error: function(response) {
                            
                    }
                });
            } else {
                jQuery('#visual-pagination-option-form').hide();
                jQuery('.notification').show();
            }
        },
        slidesLoaded: function() {
                jQuery('.caption').animate({
                        bottom:0
                },200);
        },
        start: slide_number
    });   
}
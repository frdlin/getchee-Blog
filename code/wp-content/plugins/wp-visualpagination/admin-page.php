<?php
$current_template = self::get_visual_pagination_option( 'current_template' );
$options = $this->get_template_option( $current_template );  
if ( $options === false || !file_exists( dirname( __FILE__ ) . "/templates/$current_template" ) ) {
        $current_template = $this->_default_option['current_template'];
        $options = $this->get_template_option( $current_template ); 
}

$templates = $this->get_templates();
?>
<div class="left-side">
    <div id="slider-container">
        <img class="image-button"  src="<?php echo plugins_url( 'js/slider', __FILE__ );?>/img/new-ribbon.png" width="112" height="112" alt="New Ribbon" id="ribbon">
        <div id="slides">
                <div class="slides_container">
                <?php
                $selected_design_number = 1;
                $index = 1;
                foreach ( $templates as $template ) {                            
                    if ( $template['name'] == $current_template )
                        $selected_design_number = $index;
                    $index++;
                    ?>
                    <div class="slide">
                        <input type="hidden" id="template-name" value="<?php echo $template['name'];?>" disabled="disabled" />
                        <input type="hidden" id="customizable" value="<?php echo $template['enable'] ? 1 : 0;?>" disabled="disabled" />
                        <img class="image-button"  src="<?php echo $template['image'];?>" width="570" height="270" alt="Slide 1"></a>
                        <div class="caption" style="bottom:0">
                            <?php echo $template['caption'];?>
                        </div>
                    </div>  
                <?php }?>
                </div>
                <a href="#" class="prev"><img class="image-button"  src="<?php echo plugins_url( 'js/slider', __FILE__ );?>/img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
                <a href="#" class="next"><img class="image-button"  src="<?php echo plugins_url( 'js/slider', __FILE__ );?>/img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>
        </div>
        <img class="image-button"  src="<?php echo plugins_url( 'js/slider', __FILE__ );?>/img/example-frame.png" width="739" height="341" alt="Example Frame" id="frame">
    </div>   
    <div class="free-notification">
        <a href="#" id="upgrade-button"></a>
    </div>
    <br/>
    <br/>
    <form  <?php echo $options === FALSE ? 'style="display:none;"' : '';?> method="post" id="visual-pagination-option-form" class="visual_pagination-editform">
        <input type="hidden" name="template_name" id="template_name" value="<?php echo $current_template;?>" />
        <h3>Selected Theme:&nbsp;<span id="selected_theme">{<?php echo $current_template;?>}</span></h3>
        <h3>General Properties</h3>
        <table class="form-table">
            <tbody>                                            
                <tr>
                    <th scope="row">Font  Size</th>
                    <td><label><input type="text" name="font_size" id="font_size" value="<?php echo $options['font_size'];?>">px</label></td>
                </tr>
                <tr>
                    <th scope="row">Previous Button Color</th>
                    <td><label><input type="text" class="color-box" id="prev_bg_color"  name="prev_bg_color" value="<?php echo $options['prev_bg_color'];?>"></label></td>
                </tr>         
                <tr>
                    <th scope="row">Next Button Color</th>
                    <td>
                        <input type="text" class="color-box" name="next_bg_color" id="next_bg_color" value="<?php echo $options['next_bg_color'];?>">                    
                    </td>
                </tr>                         
            </tbody>
        </table>
        <h3>Before Buttons are Clicked</h3>
        <table class="form-table">
            <tbody>                                            
                <tr>
                    <th scope="row">Font Color</th>
                    <td><label><input type="text" class="color-box" id="color"  name="color" value="<?php echo $options['color'];?>"></label></td>
                </tr>         
                <tr>
                    <th scope="row">Background color</th>
                    <td>
                        <input type="text" class="color-box" name="background_color" id="background_color" value="<?php echo $options['background_color'];?>">                    
                    </td>
                </tr>                         
            </tbody>
        </table>
        <h3>When User Hovers</h3>
        <table class="form-table">
            <tbody>
                <tr>
                    <th scope="row">Font Color</th>
                    <td><label><input type="text" class="color-box" id="hover_color"  name="hover_color" value="<?php echo $options['hover_color'];?>"></label></td>
                </tr>
                <tr>
                    <th scope="row">Background color</th>
                    <td><label><input type="text" class="color-box" id="hover_background_color"  name="hover_background_color" value="<?php echo $options['hover_background_color'];?>"></label></td>
                </tr>                            
            </tbody>
        </table>
        <h3>Current Page Button</h3>
        <table class="form-table">
            <tbody>                  
                <tr>
                    <th scope="row">Font Color</th>
                    <td><label><input type="text" class="color-box" id="current_page_color"  name="current_page_color" value="<?php echo $options['current_page_color'];?>"></label></td>
                </tr>
                <tr>
                    <th scope="row">Background color</th>
                    <td><label><input type="text" class="color-box" id="current_background_color"  name="current_background_color" value="<?php echo $options['current_background_color'];?>"></label></td>
                </tr>            
            </tbody>
        </table>    
        <br/>
        <a class="fancybox fancybox.iframe" href="<?php echo get_bloginfo('url') .'/wp-admin/admin-ajax.php?action=visual_pagination_preview"';?>" id="fancybox-button" style="display: none;">&nbsp;</a>
        <input type="button" class="button-primary" value="Preview Changes" name="preview-button" id="preview-button" />
        <input type="submit" value="Save Changes" name="update-button" id="update-button" class="button-primary" />                        
        <input type="submit" value="Restore Default" name="default-button" id="default-button" class="button-secondary" />  
    </form>
    <div class="notification" <?php echo $options !== FALSE ? 'style="display:none;"' : '';?>>
        This theme is only available in Pro version. 
        <a href="http://www.wppluginpros.com/shop/wp-visual-pagination-pro/" >Upgrade</a> now or Choose a different theme.
    </div>
    <script type="text/javascript" language="javascript">  
        showTemplateSlide(<?php echo $selected_design_number .', "' . get_bloginfo('url') .'/wp-admin/admin-ajax.php"';?>);
        var visual_pagination_preview_url = '<?php echo get_bloginfo('url') .'/wp-admin/admin-ajax.php?action=visual_pagination_preview';?>';
        var plugins_url = '<?php echo plugins_url( '/', __FILE__ );?>';    
    </script>
</div>
<div class="right-side">
    <?php include_once( dirname(__FILE__) .'/admin-sidebar.php' ); ?>
</div>
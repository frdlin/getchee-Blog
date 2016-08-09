<?php
/*
Plugin Name: Visual Pagination
Version: 1.0.400
Description: Visually create fancy pagination or customize preloaded professional pagination themes
Author: Aspire2, JiaZhen Wang
Plugin URI: 
Text Domain: wp-visual-pagination
Domain Path: /lang

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
( at your option ) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 * */

class Visual_Pagination_Settings_Page {   
    
    public static $_plugin_title = 'visual_pagination';
    public static $_default_option = array(
        'current_template' => 'Free Black'
    );
    
    function __construct() {        
        
        add_action( 'admin_menu', array( $this, 'add_menus' ) ); 
        add_action( 'admin_init', array( $this, 'page_init' ) ); 
        add_action( 'wp_ajax_visual_pagination_get_settings', array( $this, 'ajax_get_settings' ) );
        add_action( 'wp_ajax_visual_pagination_preview', array( $this, 'preview_changes' ) );  
    }
    
    public static function get_visual_pagination_option( $key, $default = false ) {        
        if ( $default === false)
            return get_option( self::$_plugin_title .'-' .$key,  self::$_default_option[$key] );
        else
            return get_option( self::$_plugin_title .'-' .$key,  $default );
    }
    
    public static function update_visual_pagination_option( $key, $value ) {
        
        if ( get_option( self::$_plugin_title .'-' .$key , '' ) == '' )
                add_option( self::$_plugin_title .'-' .$key, self::$_default_option[$key] );
        update_option( self::$_plugin_title .'-' .$key, $value );
    }
    
    public static function delete_visual_pagination_option( $key ) {
        delete_option( self::$_plugin_title .'-' .$key );
    }
    
    public function add_visual_pagination_style() {        
        $template_name = self::get_visual_pagination_option( 'current_template' );
        $options = self::get_template_option( $template_name );       
        self::generate_customstyle( $template_name, $options );
        
        wp_enqueue_style( 'wp-visual-pagination-style', plugins_url( '/templates/' . rawurlencode($template_name) .'/pagenavi-css.css' , __FILE__ ) );
        wp_enqueue_style( 'wp-visual-pagination-customstyle', plugins_url( '/wp-visual-pagination-custom.css', __FILE__ ) );          
    }

    public function wp_pagenavi_filter( $content ) {
        //$content = '';
        if ( strpos( $content, 'previouspostslink' ) === FALSE  ) {
            $content = str_ireplace( "<div class='wp-pagenavi'>", "<div class='wp-pagenavi'><a class='previouspostslink disablepreviouspostslink' href='#' onclick='return false;'>&nbsp;</a>", $content );
        }
        if ( strpos( $content, 'nextpostslink' ) === FALSE  ) {
            $content = str_ireplace( "</div>", "<a class='nextpostslink disablenextpostslink' href='#' onclick='return false;'>&nbsp;</a></div>", $content );
        }
        $content = str_ireplace( "</div>", "<div class='clear'></div></div>", $content );
        return $content;
    }
    
    function preview_changes() {
        $template_name = isset( $_REQUEST['template_name'] ) ? $_REQUEST['template_name'] : '';
        if ( $template_name == '' ) {
            die( 'Invalid operation' );
        }
        //check the new image is uploaded
        $options = $_REQUEST;       
        $custom_style = $this->generate_customstyle( $template_name, $options );
        ?>
        <html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="en-US">
        <!--<![endif]-->
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
            <link rel='stylesheet' href='<?php echo plugins_url( '/wp-pagenavi/pagenavi-css.css', __FILE__ );?>' type='text/css' media='all' />
            <link rel='stylesheet' href='<?php echo plugins_url( '/templates/' .$template_name .'/pagenavi-css.css', __FILE__ );?>' type='text/css' media='all' />
            <style type="text/css">
                <?php echo $custom_style;?>
            </style>
        </head>
        <body style="height: 300px">            
            <div class="wp-pagenavi" id="wp-pagenavi" style="width: 410px;margin: 120px auto 0px auto;">
                <a class="previouspostslink" href="#">&nbsp;</a>
                <a class="page smaller" href="#">1</a>                
                <span class="current">2</span>                
                <span class="extend" href="#">...</span>
                <a class="page larger" href="#">15</a>
                <a class="page larger" href="#">30</a>
                <a onClick="return false;" href="#" class="nextpostslink">&nbsp;</a>
                <div class="clear">                
                </div>            
            </div>
        </body>
        </html>
        <?php
        die();
    }
    
    public static function generate_customstyle( $template_name, $options, $save_file = true ) {
        ob_start();        
        //normal anchor
        $wp_pagenavi_options = wp_parse_args( $options, PageNavi_Core::$options->get() );
        
        if ( intval( $wp_pagenavi_options['style'] ) == 1 )
            echo '.wp-pagenavi a, .wp-pagenavi span.current {' .chr( 13 );
        /*else if ( intval( $options['style'] ) == 2 )
            echo '.wp-pagenavi select {' .chr( 13 );*/
        
        if ( $options['font_size'] != '' )
            echo 'font-size: ' .$options['font_size'] .'px;';
        echo '}' .chr( 13 );
        
        //page
        echo '.wp-pagenavi .page {' .chr( 13 );
        if ( $options['color'] != '' )
            echo 'color: #' .$options['color'] .';';
        if ( $options['background_color'] != '' )
            echo 'background-color: #' .$options['background_color'] .';';
        echo '}' .chr( 13 );
        
        //current page
        echo '.wp-pagenavi span.current {' .chr( 13 );
        if ( $options['current_page_color'] != '' )
            echo "color: #{$options['current_page_color']}; ";  
        echo '}' .chr( 13 );
        
        //hover anchor
        echo '.wp-pagenavi a.page:hover {' .chr( 13 );
        if ( $options['hover_background_color'] != '' )
            echo "background-color: #{$options['hover_background_color']};";
        if ( $options['hover_color'] != '' )
            echo "color: #{$options['hover_color']};";
        echo  '}' .chr( 13 );
        //current page
        echo '.wp-pagenavi span.current  {' .chr( 13 );
        if ( $options['current_page_font'] != '' )
            echo "font-weight: {$options['current_page_font']} ;"; 
        if ( $options['current_page_color'] != '' )
            echo "color: {$options['current_page_color'] };";
        if ( $options['current_background_color'] != '' )
            echo "background-color: #{$options['current_background_color']};";
        echo ' }' .chr( 13 ); 
        
        // prev button
        echo '.wp-pagenavi .previouspostslink, .wp-pagenavi .first {' .chr( 13 );        
            echo "background-color: #{$options['prev_bg_color']};";        
        echo  '}' .chr( 13 );
        
        // next button
        echo '.wp-pagenavi .nextpostslink, .wp-pagenavi .last {' .chr( 13 );        
            echo "background-color: #{$options['next_bg_color']};";        
        echo  '}' .chr( 13 );
        
        //check drop-downliast        
        if ( intval( $wp_pagenavi_options['style'] ) == 2 ) {
            echo '.wp-pagenavi .current  {' .chr( 13 );
            echo 'background-image: none';
            echo ' }' .chr( 13 );
        }
        
        $content = ob_get_contents();           
        ob_clean();
        
        /*ob_start();
        var_dump( $options );
        file_put_contents( dirname(__FILE__) . '/wp-visual-pagination-custom.css', ob_get_contents() );
        ob_clean();*/
        
        if ( $save_file )
            file_put_contents( dirname(__FILE__) . '/wp-visual-pagination-custom.css', $content );
        return $content;
    }
    
    function page_init() { 
        
        //handle updating           
        if ( isset($_POST['update-button']) )
            $this->update_template_settings();
        else if ( isset($_POST['default-button']) )
            $this->restore_template_settings();
    }
    
    function add_menus() {
        
        $page = add_menu_page( 'Pagination Settings', 'Visual Pagination', 'manage_options', 
                'visual_pagination_menu', array( $this, 'general_options_page'), plugins_url( 'images/icon.png' , __FILE__ ) );           
		add_action( 'admin_print_styles-'. $page, array( &$this, 'add_admin_styles' ) );
		add_action( 'admin_print_scripts-'. $page, array( &$this, 'add_admin_scripts' ) );
    }   
	
	public function add_admin_styles() {
		wp_enqueue_style( 'visual_pagination-admin-style', plugins_url('wp-visual-pagination.css', __FILE__) );
        wp_enqueue_style( 'visual_pagination-slider-style', plugins_url('js/slider/css/global.css', __FILE__) );
		wp_enqueue_style( 'colorpicker-style', plugins_url('js/colorpicker/css/colorpicker.css', __FILE__) );     
		wp_enqueue_style( 'fancybox-style', plugins_url('js/fancybox/jquery.fancybox.css', __FILE__, false, '2.0.6' ) );
	}
	
	public function add_admin_scripts() {
		wp_enqueue_script( 'my-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js' );
        wp_enqueue_script( 'visual_pagination-slider-script', plugins_url('js/slider/slides.jquery.js', __FILE__) );
        wp_enqueue_script( 'visual_pagination-script', plugins_url('js/wp-visual-pagination.js', __FILE__) );
		wp_enqueue_script( 'colorpicker-script', plugins_url('js/colorpicker/js/colorpicker.js', __FILE__) );
        wp_enqueue_script( 'colorpicker-eye-script', plugins_url('js/colorpicker/js/eye.js', __FILE__) );
        wp_enqueue_script( 'colorpicker-utils-script', plugins_url('js/colorpicker/js/utils.js', __FILE__) );
        wp_enqueue_script( 'colorpicker-layout-script', plugins_url('js/colorpicker/js/layout.js', __FILE__), false, '1.0.2' );
        wp_enqueue_script( 'fancybox-script', plugins_url('js/fancybox/jquery.fancybox.js', __FILE__, false, '2.0.6' ) );
	}
    
    function update_template_settings() {
        /*var_dump( $_POST );
        die();*/
        $template_name = isset( $_POST['template_name'] ) ? $_POST['template_name'] : '';        
        if ( $template_name == '' )
            return;
        $keys = array(             
            'font_size', 'prev_bg_color', 'next_bg_color',
            'color', 'background_color',
            'hover_background_color', 'hover_color', 
            'current_page_font', 'current_page_color', 'current_background_color',
        );        
        $options = array();        
        foreach ( $keys as $key ) {
            $options[$key] = isset( $_POST[$key] ) ? $_POST[$key] : '';
        }        
        
        self::update_visual_pagination_option( 'current_template', $template_name );
        self::save_template_option( $template_name, $options );        
    }
    
    function restore_template_settings() { 
        
        $template_name = isset( $_POST['template_name'] ) ? $_POST['template_name'] : '';
        if ( $template_name == '' )
            return;
        self::delete_visual_pagination_option( 'tp-' .$template_name );
    }
    
    public static function get_template_option( $template_name ) {
        $options = self::get_visual_pagination_option( 'tp-' .$template_name,  FALSE );
        if ( $options == FALSE ) {            
            // check if the template is available
            if ( !file_exists( dirname( __FILE__ ) . "/templates/$template_name/default-setting.php" ) )
                return FALSE;
            // read the default settings
            require_once( dirname( __FILE__ ) . '/templates/' .$template_name . '/default-setting.php' );
            $options = $template_default_settings;
        }        
        return $options;
    }
    
    public function save_template_option( $template_name, $options ) {
        self::update_visual_pagination_option( 'tp-' .$template_name, $options );
    }
    
    function ajax_get_settings() {
        if ( !isset( $_POST['template_name'] ) )
            die( json_encode( array( 'result' => 'error' ) ) );
        
        $template_name = $_POST['template_name'];
        $template_options = $this->get_template_option( $template_name );
        
        if ( $template_options == FALSE ) {
            echo json_encode( array( 'result' => 'error', 'name' => $template_name ) );
        } else {
            $template_options['result'] = 'success';
            $template_options['name'] = $template_name;
            echo json_encode( $template_options );
        }
        die();
    }
    
    function get_templates() {
        $dir    = dirname(__FILE__) .'/templates';        
        $files = scandir($dir);        
        $templates = array();
        
        if( $files ) {
            foreach ( $files as $filename ) {
                if ( $filename != '.' && $filename != '..' && is_dir( $dir .'/' .$filename ) ) {
                    $is_customizable = file_exists( "$dir/$filename/default-setting.php" );
                    $templates[] = 
                        array( 'name' => $filename, 
                               'image' => plugins_url( 'templates/' .$filename .'/logo.png', __FILE__ ), 
                               'caption' => $filename,
                               'enable' => $is_customizable
                        );
                }
            }
        }
        return $templates;
    }   
    
    function select_option( $value, $check ) {
        if ( $value == $check )
            echo ' selected="selected" ';
    }
    
    function general_options_page() {       
        include_once( 'admin-page.php' );
    }    
    
}

if ( !function_exists('_pagenavi_init') ) {
    require_once( dirname(__FILE__) .'/wp-pagenavi/wp-pagenavi.php' );
}
if ( is_admin() ) {
    new Visual_Pagination_Settings_Page();
}
add_filter( 'wp_pagenavi', array( 'Visual_Pagination_Settings_Page', 'wp_pagenavi_filter' ) );
add_action( 'wp_head', array( 'Visual_Pagination_Settings_Page', 'add_visual_pagination_style' ) );
?>

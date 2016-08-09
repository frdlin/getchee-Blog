<?php

if ( !defined( 'ABSPATH' ) && !defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit();

require_once( 'wp-visual-pagination.php' );

Visual_Pagination_Settings_Page::delete_visual_pagination_option( 'current_template' );

// delete the options of templates.
$dir    = dirname(__FILE__) .'/templates';        
$files = scandir($dir);        

if( $files ) {
    foreach ( $files as $filename ) {
        if ( $filename != '.' && $filename != '..' && is_dir( $dir .'/' .$filename ) ) {
            Visual_Pagination_Settings_Page::delete_visual_pagination_option( 'tp-' .$filename );
        }
    }
}
?>

<?php



/**



 * Functions - Framework gatekeeper



 *



 * This file defines a few constants variables, loads up the core framework file, 



 * and finally initialises the main WP Framework Class.



 *



 * @package WPFramework



 * @subpackage Functions



 */







define( 'WP_FRAMEWORK', '0.2.4' ); // Defines current version for WP Framework



	



	/* Blast you red baron! Initialise WP Framework */



	require_once( TEMPLATEPATH . '/library/framework.php' );



	WPFramework::init();

/* Add feature image to the post. */

add_theme_support( 'post-thumbnails' );



/* Add link for feature image. */

add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );

function my_post_image_html( $html, $post_id, $post_image_id ) {

  $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a>';

  return $html;

}



/* Create customized sidebar */

if ( function_exists('register_sidebar') )

register_sidebar(array(

'name'=>'sidebar1',

'before_widget' => '<section class="widgets">',

'after_widget' => '</section>',

'before_title' => '<h3>',

'after_title' => '</h3>',

));

register_sidebar(array(

'name'=>'sidebar2',

'before_widget' => '<section class="widgets">',

'after_widget' => '</section>',

'before_title' => '<h3>',

'after_title' => '</h3>',

));

register_sidebar(array(

'name'=>'sidebar3',

'before_widget' => '<section class="widgets">',

'after_widget' => '</section>',

'before_title' => '<h3>',

'after_title' => '</h3>',

));





/* Customize comments area */

function mytheme_comment($comment, $args, $depth) {

$GLOBALS['comment'] = $comment; ?>

<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

<div id="comment-<?php comment_ID(); ?>">

	<div class="reply">

		<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>

	</div>

	<div class="comment-garvatar">

		<?php if(function_exists('get_avatar')) { echo get_avatar($comment, '40'); } ?>
	
	</div>

	<div class="comment-author vcard">

		<?php printf(__('%s'), get_comment_author_link()) ?>

	</div>



<?php if ($comment->comment_approved == '0') : ?>

<em><?php _e('Your comment is awaiting moderation.') ?></em>

<?php endif; ?>

<div class="clear"></div>

<div class="comment-meta commentmetadata"><?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()) ?><?php edit_comment_link(__('(Edit)'),' ','') ?></div>

<div class="clear"></div>

<?php comment_text() ?>



</div>

<?php

}


?>
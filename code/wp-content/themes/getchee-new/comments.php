<?php
if ( !empty( $_SERVER[ 'SCRIPT_FILENAME' ] ) && 'comments.php' == basename( $_SERVER[ 'SCRIPT_FILENAME' ] ) )
     die ( 'Please do not load this page directly. Thanks!' );
if ( post_password_required() ) { ?>
     <p class="password-protected alert">This post is password protected. Enter the password to view comments.</p>
<?php return; } ?>
<?php if ( have_comments() ) : // If comments exist for this entry, continue ?>
<!--BEGIN #comments-->
     <?php if ( ! empty( $comments_by_type['comment'] ) ) { ?>
          <!--BEGIN .comment-list-->
               <ul class="commentlist">
               <?php wp_list_comments('callback=mytheme_comment'); ?>
               </ul>
          <!--END .comment-list-->
     <?php } ?>
<!--END #comments-->
<?php endif; // ( have_comments() ) ?>

<?php if ( comments_open() ) : // show comment form ?>
<!--BEGIN #respond-->
<article id="respond">
     <div class="cancel-comment-reply"><?php cancel_comment_reply_link( 'Cancel Reply' ); ?></div>
     <?php if ( get_option( 'comment_registration' ) && !is_user_logged_in() ) : ?>
     <div id="login-req" class="alert">You must be <a href="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?redirect_to=<?php echo urlencode( get_permalink() ); ?>" target="_blank">logged in</a> to post a comment.</div>
     <?php else : ?>

     <!--BEGIN #comment-form-->
     <form method="post" action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php">
     
     <?php if ( is_user_logged_in() ) : global $current_user; // If user is logged-in, then show them their identity ?>
     
     <div class="comment-login-option">Logged in as <a href="<?php echo get_option( 'siteurl' ); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Log out of this account">Log out &raquo;</a></div>
        
          <!--BEGIN #form-section-author-->
               <input name="author" id="comment-author" type="text" value="<?php echo $current_user->user_nicename; ?>" tabindex="1" <?php if ( $req ) echo "aria-required='true'"; ?> class="textbox reply_name" placeholder="Name"/>
          <!--END #form-section-author-->
     

          <!--BEGIN #form-section-email-->
               <input name="email" id="comment-email" type="email" value="<?php echo $current_user->user_email; ?>" tabindex="2" <?php if ( $req ) echo "aria-required='true'"; ?> class="textbox reply_email" placeholder="Email"/>
          <!--END #form-section-email-->
           
          <?php else : // If user isn't logged-in, ask them for their details ?>
        
          <!--BEGIN #form-section-author-->
               <input name="author" id="comment-author" type="text" value="<?php echo $comment_author; ?>" tabindex="1" <?php if ( $req ) echo "aria-required='true'"; ?> class="textbox reply_name" placeholder="Name" />
          <!--END #form-section-author-->
     
          <!--BEGIN #form-section-email-->
               <input name="email" id="comment-email" type="email" value="<?php echo $comment_author_email; ?>" tabindex="2" <?php if ( $req ) echo "aria-required='true'"; ?> class="textbox reply_email" placeholder="Email"/>
          <!--END #form-section-email-->

          <?php endif; // if ( is_user_logged_in() ) ?>
          
     <!--BEGIN #form-section-comment-->
               <textarea name="comment" id="comment" tabindex="4" class="reply_comment" placeholder="Comment"></textarea>
          <!--END #form-section-comment-->
          <!--BEGIN #form-section-actions-->
               <div class="right_f">
                    <input type="submit" id="submit" class="button green" tabindex="5" name="subbut" value="Post"/>
                    <?php comment_id_fields(); ?>
               </div>
          <!--END #form-section-actions-->

     <?php do_action( 'comment_form', $post->ID ); // Available action: comment_form ?>
    <!--END #comment-form-->
    </form>
    
     <?php endif; // If registration required and not logged in ?>
<!--END #respond-->
     <div class="clear"></div>
</article>
<?php endif; // ( comments_open() ) ?>
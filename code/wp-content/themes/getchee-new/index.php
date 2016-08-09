<?php get_header(); ?>
<!-- Body -->
  <div id="content_head"></div>
    <div class="wrapper">
      <aside id="side" class="xxx">
        <?php include (TEMPLATEPATH . '/sidebar1.php'); ?>
      </aside>
      <div id="main" class="lxx">
        <?php if (have_posts()) : ?>
        <?php
        // -------------------------------------------------------------
        // IF THERE ARE NO POST
        // -------------------------------------------------------------
        ?>
        <?php while (have_posts()) : the_post(); ?>
        <?php if (in_category('') && is_home() ) continue; ?>
        <article class="main_single_post" id="post-<?php the_ID(); ?>">
            <div class="avatar">
              <figure><?php echo get_wp_user_avatar( $id_or_email, $size, $default, $alt ); ?></figure>
              <div class="author">
                <p><?php the_author_posts_link(); ?></p>
                <p><em><?php the_author_nickname() ?></em></p>
                <p class="time"><?php the_time('F j, Y') ?></p>
              </div>
            </div>
            <section class="group">
              <header>
                <ul class="article-social-network-index">
                  <li><a href="http://twitter.com/home?status=<?php the_title(); ?>%20<?php the_permalink() ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank"><img src="<?php echo IMAGES . '/icon-twitter.png'; ?>" alt="Tweet This" width="20" height="20" title="Tweet this"/></a></li>
                  <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title(); ?>&summary=<?php the_subtitle() ?>&source=getchee Blog - Retail and banking news from emerging markets in Asia." rel="nofollow" onclick="NewWindow(this.href,'template_window','550','400','yes','center');return false" onfocus="this.blur()" target="_blank" ><img src="<?php echo IMAGES . '/icon-linkedin.png'; ?>" title="Share on LinkedIn" alt="Share on LinkedIn" width="20" height="20" /></a></li>
                  <li><a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" onClick="return fbs_click()" target="_blank" title="<?php the_title(); ?>"><img src="<?php echo IMAGES . '/icon-facebook.png'; ?>" alt="Share on Facebook" width="20" height="20" /></a></li>
                  <li><a href="https://plus.google.com/share?url=<?php the_permalink() ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=620,width=495');return false;" target="_blank" ><img src="<?php echo IMAGES . '/icon-googleplus.png'; ?>" alt="Share on Google+" width="20" height="20" /></a></li>
                  <li><a href="http://service.weibo.com/share/share.php?url=<?php the_permalink() ?>&title=<?php the_title(); ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=620,width=450');return false;" target="_blank" ><img src="<?php echo IMAGES . '/icon-weibo.png'; ?>" alt="Tweet This" width="20" height="20" title="Share on Weibo"/></a></li>
                  <li><a href="mailto:?Subject=Hey, check this article out from getchee.&Body=I just saw this article and wanted to share. <?php the_permalink() ?>" ><img src="<?php echo IMAGES . '/icon-mail.png'; ?>" alt="Share by Email" width="20" height="20" /></a></li>
                </ul>
                <div class="clear"></div>
                <hgroup>
                  <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php if ( function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>"><?php the_title(); ?></a></h1>
                  <h2><?php the_subtitle() ?></h2>
                </hgroup>
                <div class="detail">
                  <ul>
                    <li class="detail_name"><?php the_author_posts_link(); ?></li>
                    <li class="detail_date"><?php the_time('F j, Y') ?></li>
                  </ul>
                </div>
              </header>
              <div class="clear"></div>
              <div class="feature_image_index"><?php the_post_thumbnail(''); ?></div>
              <?php the_content('Read the rest of this entry &raquo;'); ?>
            </section>
          <div class="clear"></div>
        </article>
        <?php endwhile; ?>
        <?php endif; ?>
        <?php wp_pagenavi(); ?>
      </div>
    </div>
    <div class="clear"></div>

  <!-- Body -->
<?php get_footer(); ?>
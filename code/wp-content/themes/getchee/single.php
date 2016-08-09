<?php get_header(); ?>
<!-- Body -->

  <div id="content_head"></div>
    <div class="wrapper">
      <aside id="side" class="xxv">
        <?php include (TEMPLATEPATH . '/sidebar1.php'); ?>
      </aside>
      <div id="main" class="lxxv">
        <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
        <article class="main_single_post" id="post-<?php the_ID(); ?>">
            <div class="avatar">
              <figure><?php echo get_avatar( $id_or_email, $size, $default, $alt ); ?></figure>
              <div class="author">
                <p><?php the_author_posts_link(); ?></p>
                <p><em><?php the_author_nickname() ?></em></p>
              </div>
            </div>
            <section class="group">
              <header>
                <div class="detail_category">
                  <ul>
                    <?php foreach (get_the_category() as $cat) : ?>
                    <li class="<?php echo $cat->slug; ?>"><a href="<?php echo get_category_link($cat->term_id); ?>"><img src="<?php echo z_taxonomy_image_url($cat->term_id); ?>" title="<?php echo $cat->cat_name; ?>"/></a></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
                <div class="clear"></div>
                <hgroup>
                  <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php if ( function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>"><?php the_title(); ?></a></h1>
                  <h2><?php the_subtitle() ?></h2>
                </hgroup>
                <div class="detail">
                  <ul>
                    <li class="detail_name"><?php the_author_posts_link(); ?></li>
                    <li class="detail_others"><a href="<?php comments_link(); ?>"><?php comments_number( 'Leave a Comment', '1 Comment', '% Comments' ); ?></a></li>
                    <li class="detail_date"><time datetime="2012-10-31T00:05:00+0000"><?php the_time('F j, Y') ?></time></li>
                  </ul>
                </div>
              </header>
              <div class="feature_image"><?php the_post_thumbnail(''); ?></div>
              <?php the_content(''); ?>
              <footer>
                <ul class="article-social-network">
                  <li><a href="mailto:?Subject=Hey, check this article out from getchee.&Body=I just saw this article and wanted to share. <?php the_permalink() ?>" ><img src="<?php echo IMAGES . '/icon-mail.png'; ?>" alt="Share by Email" width="40" height="40" /></a></li>
                  <li><a href="https://plus.google.com/share?url=<?php the_permalink() ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=620,width=495');return false;" target="_blank" ><img src="<?php echo IMAGES . '/icon-googleplus.png'; ?>" alt="Share on Google+" width="40" height="40" /></a></li>
                  <li><a href="http://www.facebook.com/share.php?u=<?php the_permalink() ?>" onClick="return fbs_click()" target="_blank" title="<?php the_title(); ?>"><img src="<?php echo IMAGES . '/icon-facebook.png'; ?>" alt="Share on Facebook" width="40" height="40" /></a></li>
                  <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>&title=<?php the_title(); ?>&summary=<?php the_subtitle() ?>&source=getchee Blog - Retail and banking news from emerging markets in Asia." rel="nofollow" onclick="NewWindow(this.href,'template_window','550','400','yes','center');return false" onfocus="this.blur()" target="_blank" ><img src="<?php echo IMAGES . '/icon-linkedin.png'; ?>" title="Share on LinkedIn" alt="Share on LinkedIn" width="40" height="40" /></a></li>
                  <li><a href="http://twitter.com/home?status=<?php the_title(); ?>%20<?php the_permalink() ?>" onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;" target="_blank"><img src="<?php echo IMAGES . '/icon-twitter.png'; ?>" alt="Tweet This" width="40" height="40" title="Tweet this"/></a></li>
                </ul>
              </footer>
            </section>
          <div class="clear"></div>
        </article>
      </div>
      <aside id="side" class="xxv">
        <?php include (TEMPLATEPATH . '/sidebar3.php'); ?>
      </aside>
    <section id="comments" class="lxxv">
      <div class="group">
        <h3>Comments</h3>
          <?php comments_template( '', true ); ?>
          <?php include ( TEMPLATEPATH . '/navigation.php' ); ?>
          <?php endwhile; else : ?>
          <?php include (TEMPLATEPATH . "/searchform.php"); ?>
          <?php endif; ?>
      </div>
    </section>
    </div>
    <div class="clear"></div>
  <!-- Body -->
<?php get_footer(); ?>
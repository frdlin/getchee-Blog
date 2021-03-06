<?php get_header(); ?>
<!-- Body -->
  
  <div id="content_head"></div>
    <div class="wrapper">
      <aside id="side" class="xxv">
        <?php include (TEMPLATEPATH . '/sidebar1.php'); ?>
      </aside>
      <div id="main" class="lxxv">
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
              <figure><?php echo get_avatar( $id_or_email, $size, $default, $alt ); ?></figure>
              <div class="author">
                <p><?php the_author_posts_link(); ?></p>
                <p><em><?php the_author_nickname() ?></em></p>
              </div>
            </div>
            <section class="group">
              <header>
                <hgroup>
                  <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php if ( function_exists('the_title_attribute')) the_title_attribute(); else the_title(); ?>"><?php the_title(); ?></a></h1>
                  <h2><?php the_subtitle() ?></h2>
                </hgroup>
                <div class="detail">
                  <ul>
                    <li class="detail_name"><?php the_author_posts_link(); ?></li>
                    <li class="detail_categories"><?php foreach (get_the_category() as $cat) : ?><a href="<?php echo get_category_link($cat->term_id); ?>"><?php echo $cat->cat_name; ?></a><?php endforeach; ?></li>
                    <li class="detail_others"><a href="<?php comments_link(); ?>"><?php comments_number( 'Leave a Comment', '1 Comment', '% Comments' ); ?></a></li>
                    <li class="detail_date"><time datetime="2012-10-31T00:05:00+0000"><?php the_time('F j, Y') ?></time></li>
                  </ul>
                </div>
              </header>
              <div class="feature_image_index"><?php the_post_thumbnail(''); ?></div>
              <?php the_content('Read the rest of this entry &raquo;'); ?>
            </section>
          <div class="clear"></div>
        </article>
        <?php endwhile; ?>
        <?php else : ?>
        <?php wp_pagenavi(); ?>
        <article id="main_single_post" class="post no-results not-found">
          <section class="group-fullpage">
              <header>
                <hgroup>
                  <h1><?php _e( 'Nothing Found' ); ?></h1>
                  <h2><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.' ); ?></h2>
                </hgroup>
              </header>
          </setion>
        </article>
        <?php endif; ?>
      </div>
    </div>
    <div class="clear"></div>
  </div>

  <!-- Body -->
<?php get_footer(); ?>
<?php get_header(); ?>
    <main class='main main--page'>
        <section class='content'>
          <?php while( have_posts() ) : the_post(); ?>
          <div class='content__title-wrapper'>
              <?php the_title( '<h1 class="content__title">', '</h1>' ); ?>
          </div>
          <div class='content__body-wrapper'>
              <div class='content__body'>
                  <?php the_content(); ?>
              </div>
          </div>
          <?php endwhile; ?>
        </section>
        <?php
          wp_reset_postdata();
          $args = array(
            'post_type' => 'location',
            'order' => 'ASC',
            'posts_per_page' => '10 ',
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1
          );
          $locations = new WP_Query( $args );
          if ( $locations->have_posts() ) :
        ?>
        <section class='city-picker'>
          <ul class='city-picker__item-list'>
          <?php while ( $locations->have_posts() ) : $locations->the_post();
          ?>    
            <?php
            $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
            $location_slug = get_permalink();
            $location_name = get_the_title();
              include(locate_template('component-location-diamond.php'));
            ?>
          <?php endwhile; ?>
          </ul>
          <?php where_page_paginator(); ?>
        </section>
        <?php endif; ?>
    </main>
<?php get_footer(); ?>
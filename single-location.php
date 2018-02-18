<?php get_header(); ?>
    <main class='main main--page'>
      <?php
        wp_reset_postdata();
        $args = array(
          'post_type' => 'location',
          'order' => 'ASC',
          'posts_per_page' => 8
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
          $location_title = get_the_title();
          $classes = is_single($location_title) ? ' city-picker__item-image-wrapper--selected' : '';
          include(locate_template('component-location-diamond.php'));
          ?>
        <?php endwhile; ?>
        </ul>
        <?php
            $count = $locations->found_posts;
            if ($count > 8 ) {
              echo '<div class="cta-button__wrapper"><a href='.get_permalink(get_page_by_path('where')).' class="cta-button">View all cities</a></div>';
            }
        ?>
      </section>
      <?php endif; ?>
      <?php
        while( have_posts() ) : the_post();
        global $post;
        $gallery = get_post_gallery($post->ID, false);
        if ($gallery) :
      ?>
      <section class='slider'>
        <div class='slider__wrapper'>
          <?php
            $gallery_attachment_ids = explode( ',', $gallery['ids']);
            $i = 0;
            foreach ($gallery_attachment_ids as $id) {
              $checked = $i === 0 ? 'checked' : '';
              echo '<input class="slider__input-radio" '. $checked .' type="radio" name="slides" id="slides_'.$id.'" />';
              $i++;
            }
          ?>
            <ul class='slider__item-list'>
              <?php
                foreach ( $gallery['src'] as $src ) {
                  echo '<li class="slider__item">';
                  //echo '<div class="slider__img-wrapper" style="background-image:url('.$src.');">';
                  echo '<img class="slider__img" src="'. $src .'" />';
                  //echo '</div>';
                  echo '</li>';
                }
              ?>
            </ul>
            <div class='slider__arrows-list'>
                <?php
                  $gallery_attachment_ids = explode( ',', $gallery['ids'] );
                  foreach ($gallery_attachment_ids as $id) {
                      echo "<label class='slider__arrow' for='slides_".$id."'></label>";
                  }
                ?>
            </div>
        </div>
      </section>
      <?php endif; ?>
      <section class='content content--secondary'>
        <div class='content__body-wrapper'>
            <div class='content__title-wrapper'>
                <h1 class='content__title'><?php the_field('content_title'); ?></h1>
            </div>
            <div class='content__body'>
                <?php the_content(); ?>
            </div>
        </div>
      </section>
      <?php endwhile; ?>
    </main>
<?php get_footer(); ?>
<?php get_header(); ?>
    <main class='main main--page'>
      <?php
        wp_reset_postdata();
        $args = array('post_type' => 'location', 'order' => 'ASC');
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
      </section>
      <?php endif; ?>
      <section class='slider'>
          <div class='slider__wrapper'>
              <input type='radio' class='slider__input-radio' name='slides' id='slides_1'/>
              <input type='radio' class='slider__input-radio' name='slides' checked='checked' id='slides_2'/>
              <input type='radio' class='slider__input-radio' name='slides' id='slides_3'/>
              <input type='radio' class='slider__input-radio' name='slides' id='slides_4'/>
              <input type='radio' class='slider__input-radio' name='slides' id='slides_5'/>
              <input type='radio' class='slider__input-radio' name='slides' id='slides_6'/>
              <ul class='slider__item-list'>
                  <li class='slider__item'>
                      <div class='slider__img-wrapper'><img class='slider__img' src='https://loremflickr.com/720/500/barcelona' /></div>
                  </li>
                  <li class='slider__item'>
                      <div class='slider__img-wrapper'><img class='slider__img' src='https://loremflickr.com/720/500/austin' /></div>
                  </li>
                  <li class='slider__item'>
                      <div class='slider__img-wrapper'><img class='slider__img' src='https://loremflickr.com/720/500/london' /></div>
                  </li>
                  <li class='slider__item'>
                      <div class='slider__img-wrapper'><img class='slider__img' src='https://loremflickr.com/720/500/chicago' /></div>
                  </li>
                  <li class='slider__item'>
                      <div class='slider__img-wrapper'><img class='slider__img' src='https://loremflickr.com/720/500/nyc' /></div>
                  </li>
                  <li class='slider__item'>
                      <div class='slider__img-wrapper'><img class='slider__img' src='https://loremflickr.com/720/500/miami' /></div>
                  </li>
              </ul>
              <div class='slider__arrows-list'>
                  <label class='slider__arrow' for='slides_1'></label>
                  <label class='slider__arrow' for='slides_2'></label>
                  <label class='slider__arrow' for='slides_3'></label>
                  <label class='slider__arrow' for='slides_4'></label>
                  <label class='slider__arrow' for='slides_5'></label>
                  <label class='slider__arrow' for='slides_6'></label>
              </div>
          </div>
      </section>
      <section class='content content--secondary'>
        <?php while( have_posts() ) : the_post(); ?>
        <div class='content__body-wrapper'>
            <div class='content__title-wrapper'>
                <h1 class='content__title'><?php the_field('content_title'); ?></h1>
            </div>
            <div class='content__body'>
                <?php the_content(); ?>
            </div>
        </div>
        <?php endwhile; ?>
      </section>
    </main>
<?php get_footer(); ?>
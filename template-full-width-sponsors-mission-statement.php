<?php get_header();
/**
 * Template Name: Full-width with Sponsors and Mission Statement
 *
 *
 */
?>
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
          //wp_reset_postdata();        
          $args = array('post_type' => 'sponsor', 'order' => 'ASC');
          $sponsors = new WP_Query( $args );
          if ( $sponsors->have_posts() ) :
        ?>
        <section class='sponsors'>
          <div class='sponsors__wrapper'>
            <ul class='sponsors__item-list'>
            <?php while ( $sponsors->have_posts() ) : $sponsors->the_post();
            ?>    
              <?php
              $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
              $sponsor_url = get_field('link');
              $sponsor_name = get_the_title();
                include(locate_template('component-sponsors.php'));
              ?>
            <?php endwhile; ?>
            </ul>
          </div>
          <div class='cta-button__wrapper'>
            <label role='button' for='contact-form-trigger--sponsor' class='cta-button'>Apply to Be a Sponsor</label>
          </div>
          <?php get_template_part('component-contact-sponsor'); ?>
        </section>
        <?php endif; ?>
        <?php
          wp_reset_postdata();
          while( have_posts() ) : the_post(); ?>
          <?php
            $show_secondary_content = get_field('show_secondary_content');
            if ($show_secondary_content) :
        ?>
          <section class='content content--secondary'>
              <hr class='hr' />
              <div class='content__title-wrapper'>
                  <?php the_field('secondary_title'); ?>
              </div>
              <div class='content__body-wrapper'>
                  <div class='content__body'>
                      <?php the_field('secondary_content'); ?>
                  </div>
              </div>
          </section>
        <?php endif; ?>
        <?php endwhile; ?>

    </main>
<?php get_footer(); ?>
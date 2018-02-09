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
          wp_reset_postdata();
          $args = array('post_type' => 'sponsor', 'order' => 'ASC');
        ?>
        <section class='sponsors'>
          <div class='sponsors__wrapper'>
            <ul class='sponsors__item-list'>
              <?php
                $sponsorquery = new WP_Query( $args );
                if ($sponsorquery->have_posts()) : while($sponsorquery->have_posts()) : $sponsorquery->the_post();
              ?>
                <?php
                  $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
                ?>
                <li class='sponsors__item'>
                  <a class='sponsors__item-img-wrapper' title='<?php the_title(); ?>' href='<?php the_field('link'); ?>'>
                    <img class='sponsors__item-img' alt='Cambria' src='<?php echo $featured_img_url; ?>' />
                  </a>
                </li>
               <?php endwhile; else : ?>
                No sponsors found.
               <?php endif; ?>
            </ul>
          </div>
          <div class='cta-button__wrapper'>
              <a class='cta-button'>Apply to Be a Sponsor</a>
          </div>
        </section>
        <section class='content content--secondary'>
            <hr class='hr' />
            <div class='content__title-wrapper content__title-wrapper--badge'>
                <img class='content__title--badge' src='<?php bloginfo('template_directory'); ?>/dist/img/Mission.png' alt='Mission' />
            </div>
            <div class='content__body-wrapper'>
                <div class='content__body'>
                    <p>Network Next Gen connects those in their 20's - 30's in the same industry. We host 4 dinners a year to network and talk about business, leadership, and how to grow. Invite only.</p>
                </div>
            </div>
        </section>
    </main>
<?php get_footer(); ?>
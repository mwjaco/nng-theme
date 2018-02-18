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
                BLAHHH
                  <?php the_content(); ?>
              </div>
          </div>
          <?php endwhile; ?>
        </section>
        <section class='sponsors'>
            <div class='sponsors__wrapper'>
                <ul class='sponsors__item-list'>
                    <li class='sponsors__item'><img class='sponsors__item-img' alt='Cambria' src='<?php bloginfo('template_directory'); ?>/dist/img/Cambria USA.png' /></li>
                    <li class='sponsors__item'><img class='sponsors__item-img' alt='Levantina' src='<?php bloginfo('template_directory'); ?>/dist/img/Levantina.png' /></li>
                    <li class='sponsors__item'><img class='sponsors__item-img' alt='Fireclay Tile' src='<?php bloginfo('template_directory'); ?>/dist/img/Fireclay Tile.png' /></li>
                    <li class='sponsors__item'><img class='sponsors__item-img' alt='Dorn Bracht' src='<?php bloginfo('template_directory'); ?>/dist/img/Dornbracht.png' /></li>
                    <li class='sponsors__item'><img class='sponsors__item-img' alt='Ceramic Technics Ltd' src='<?php bloginfo('template_directory'); ?>/dist/img/Ceramic Technics LTD.png' /></li>
                    <li class='sponsors__item'><img class='sponsors__item-img' alt='Haworth' src='<?php bloginfo('template_directory'); ?>/dist/img/Haworth.png' /></li>
                    <li class='sponsors__item'><img class='sponsors__item-img' alt='Mohawk Group' src='<?php bloginfo('template_directory'); ?>/dist/img/Mohawk Group.png' /></li>
                    <li class='sponsors__item'><img class='sponsors__item-img' alt='Carnegie' src='<?php bloginfo('template_directory'); ?>/dist/img/Carnegie Fabrics.png' /></li>
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
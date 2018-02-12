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
    </main>
<?php get_footer(); ?>
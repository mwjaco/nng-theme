<?php get_header(); ?>
    <main class='main main--page'>
        <section class='content'>
          <div class='content__title-wrapper'>
              <h1 class='content__title'>Oops! Something went wrong.</h1>
          </div>
          <div class='content__body-wrapper'>
              <div class='content__body'>
                  <p>The page you&#39;re looking for is unavailable or has moved.</p>
                  <p><a href='<?php echo site_url(); ?>'>Return home</a></p>
              </div>
          </div>
          <?php endwhile; ?>
        </section>
    </main>
<?php get_footer(); ?>
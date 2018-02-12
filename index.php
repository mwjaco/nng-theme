<?php get_header(); ?>
<main class='main main--landing-page'>
    <section class='landing'>
        <ul class='landing__item-list'>
            <li class='landing__item'>
                 <a href='<?php echo get_permalink(get_page_by_path('where')); ?>'><img class='landing__item-image' src='<?php bloginfo('template_directory'); ?>/dist/img/HUSTLERS.png' alt='' role='presentation' /></a>
            </li>
            <?php
                wp_reset_postdata();
                $args = array('post_type' => 'location', 'order' => 'ASC', 'posts_per_page' => '-1');
                $locations = new WP_Query( $args );


              if ( $locations->have_posts() ) : while ( $locations->have_posts() ) : $locations->the_post();
            ?>
                <?php
                $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
                $location_slug = get_permalink();
                $location_name = get_the_title();
                  include(locate_template('component-landing-item.php'));
                ?>
            <?php endwhile; endif; ?>
        </ul>
        <div role='presentation' class='landing__line-break-wrapper landing__line-break-wrapper--right'>
            <span class='landing__line-break landing__line-break--right'></span>
        </div>
        <div role='presentation' class='landing__line-break-wrapper landing__line-break-wrapper--left'>
            <span class='landing__line-break landing__line-break--left'></span>
        </div>
        <div role='presentation' class='landing__line-break-wrapper landing__line-break-wrapper--bottom'>
            <span class='landing__line-break'></span>
        </div>
    </section>
</main>
<?php get_footer(); ?>
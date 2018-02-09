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
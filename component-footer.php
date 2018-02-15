<footer class='footer'>
    <?php get_template_part('component-social-footer'); ?>
    <div class='footer__legal-wrapper'>
        <p class='footer__legal'>&copy; <?php echo date("Y"); ?>  Nextwork Next Gen. All Rights Reserved | <a href='<?php echo get_permalink(get_page_by_path('terms-and-conditions')); ?>'>Terms and Conditions</a></p>
    </div>
    <?php get_template_part('component-contact'); ?>
</footer>
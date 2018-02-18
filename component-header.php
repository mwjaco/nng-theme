<header class='header'>
    <div class='nav'>
        <button class='nav__button'>
            <span class='nav__button-bar'></span>
            <span class='nav__button-bar'></span>
            <span class='nav__button-bar'></span>
            Show/Hide Menu
        </button>
        <a class='brand' href='<?php echo site_url(); ?>' title='Network Next Gen - Home'>
            <img alt='Network Next Gen' src='<?php bloginfo('template_directory'); ?>/dist/img/Logo.png' class='brand__logo' />
        </a>
        <nav class='nav__nav-bar'>
            <?php
                $defaults = array(
                    'theme_location' => 'primary-menu',
                    'container' => false,
                    'menu' => 'Primary Menu',
                    'items_wrap' => '<ul class="nav__item-list">%3$s</ul>',
                    'walker' => new Custom_Nav_Walker()

                );
                wp_nav_menu($defaults);
            ?>

        </nav>
    </div>
    <?php get_template_part('component-social-header'); ?>
</header>
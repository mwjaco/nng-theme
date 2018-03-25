<?php
// Add support for post thumbnails, a.k.a. "Featured Images" or "Logos"
add_theme_support( 'post-thumbnails' ); 

add_action("wp_enqueue_scripts", "auto_version_and_enqueue_scripts", 20);

function auto_version_and_enqueue_scripts() {
  // Get last modified timestamp of CSS file in /css/style.css
  $csstime = filemtime( get_template_directory() . '/dist/css/style.css' );

  // Get last modified timestamp of JS file in /js/main.js
  $jtime = filemtime( get_template_directory() . '/dist/js/bundle.js' );

  wp_enqueue_style(
    'style_css', // handle for style.css
    get_template_directory_uri() . '/dist/css/style.css',
    array(), // dependencies
    $csstime, // version number
    false // load in footer
  );

  wp_enqueue_style( 'google_fonts', 'https://fonts.googleapis.com/css?family=Josefin+Sans:400,400i,600i,700', false );


  wp_enqueue_script(
    'all_js', // handle for main.js
    get_template_directory_uri() . '/dist/js/bundle.js',
    array(), // dependencies
    $jtime, // version number
    true // load in footer
  );
}


// Register our menus
function register_theme_menus() {
  register_nav_menus (
    array(
      'primary-menu' => __( 'Primary Menu' )
    )
  );
}

add_action('init', 'register_theme_menus');


function gallery_default_type_set_link( $settings ) {
  $settings['galleryDefaults']['link'] = 'none';
  $settings['galleryDefaults']['size'] = 'large';
  return $settings;
}
add_filter( 'media_view_settings', 'gallery_default_type_set_link');

function custom_image_size() {
  // Set default values for the upload media box
  update_option('image_default_size', 'large' );
}

add_filter( 'shortcode_atts_gallery', 'remove_link_from_gallery_images_and_set_size_to_large', 10, 4 );
function remove_link_from_gallery_images_and_set_size_to_large( $out, $pairs, $atts, $shortcode ) {
  if (!isset( $atts['link'])) {
    $out['link'] = 'none';
  }
  
  if (!isset( $atts['size'])) {
    $out['size'] = 'large';
  }

  return $out;
}

// Add additional <li> with mobile menu social icons
function add_social_to_nav( $items, $args ) {
  if ( ! function_exists( 'wpse_return_template_part' ) ) {
    function wpse_return_template_part( $arg ) {
      ob_start();
      get_template_part( $arg);
      return ob_get_clean();
    }
  }

  if ( function_exists( 'wpse_return_template_part' ) ) {
    $social_items = wpse_return_template_part( 'component-social-mobile-nav');
  }

  $items .= "<li class='nav__item'>"
            .$social_items
            ."</li>";
  return $items;
}

add_filter( 'wp_nav_menu_items', 'add_social_to_nav', 10, 2 );


// Add custom nav class to menu items
function custom_nav_class( $classes ) {
  $classes[] = 'nav__item';
  return $classes;
}

add_filter( 'nav_menu_css_class', 'custom_nav_class', 10, 2 );


// Walker for traversing nav items and customizing output
class Custom_Nav_Walker extends Walker_Nav_Menu {
  /**
   * Start the element output.
   *
   * @param  string $output Passed by reference. Used to append additional content.
   * @param  object $item   Menu item data object.
   * @param  int $depth     Depth of menu item. May be used for padding.
   * @param  array|object $args    Additional strings. Actually always an 
                                   instance of stdClass. But this is WordPress.
   * @return void
   */
  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    $classes = empty ( $item->classes ) ? array () : (array) $item->classes;

    $class_names = join(' ',
      apply_filters(
        'nav_menu_css_class',
        array_filter( $classes ), $item
      )
    );

    ! empty ( $class_names )
      and $class_names = ' class="'. esc_attr( $class_names ) . '"';

    $output .= "<li id='menu-item-$item->ID' $class_names>";

    ! empty( $item->title )
      and $attributes .= ' title="'  . esc_attr( $item->title ) .'"';
    ! empty( $item->target )
      and $attributes .= ' target="' . esc_attr( $item->target     ) .'"';
    ! empty( $item->xfn )
      and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
    ! empty( $item->url )
      and $attributes .= ' href="'   . esc_attr( $item->url        ) .'"';

    $title = apply_filters( 'the_title', $item->title, $item->ID );

    $item_output = $args->before
      . "<a $attributes>"
      . $args->link_before
      . $title
      . '</a> '
      . $args->link_after
      . $description
      . $args->after;

    // Since $output is called by reference we don't need to return anything.
    $output .= apply_filters(
      'walker_nav_menu_start_el',
      $item_output,
      $item,
      $depth,
      $args
    );
  }
}

// Where Page Pagination
function where_page_paginator() {
    $args = array(
        'post_type' => 'location',
        'order' => 'ASC',
        'posts_per_page' => 8
    );

    $where_page_query = new WP_Query($args); 
 
    /** Stop execution if there's only 1 page */
    if( $where_page_query->max_num_pages <= 1 )
        return;
 
    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $where_page_query->max_num_pages );
    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;
 
    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }
 
    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
 
    echo '<div class="pagination__wrapper"><ul class="pagination">' . "\n";
 
    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li class="pagination__item">%s</li>' . "\n", get_previous_posts_link('prev') );
 
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="pagination__item pagination__item--active"' : ' class="pagination__item"';
 
        printf( '<li%s><a class="pagination__item-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
 
        if ( ! in_array( 2, $links ) )
            echo '<li class="pagination__item">…</li>';
    }
 
    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="pagination__item pagination__item--active"' : ' class="pagination__item"';
        printf( '<li%s><a class="pagination__item-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }
 
    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li class="pagination__item">…</li>' . "\n";
 
        $class = $paged == $max ? ' class="pagination__item pagination__item--active"' : ' class="pagination__item"';
        printf( '<li%s><a class="pagination__item-link" href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }
 
    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li class="pagination__item">%s</li>' . "\n", get_next_posts_link('next') );
 
    echo '</ul></div>' . "\n";
}

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="pagination__item-link"';
}

function remove_shortcode_from_index( $content ) {
    $content = strip_shortcodes( $content );
    return $content;
}
add_filter( 'the_content', 'remove_shortcode_from_index' ); ?>
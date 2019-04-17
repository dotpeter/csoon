<?php



if ( ! function_exists( 'csoon_setup' ) ) :

  /**
  * Sets up theme defaults and registers support for various WordPress features.
  *
  * Note that this function is hooked into the after_setup_theme hook, which
  * runs before the init hook. The init hook is too late for some features, such
  * as indicating support for post thumbnails.
  */
  function csoon_setup() {
    /*
    * Make theme available for translation.
    * Translations can be filed in the /languages/ directory.
    * If you're building a theme based on Twenty Nineteen, use a find and replace
    * to change 'twentynineteen' to the name of your theme in all the template files.
    */
    load_theme_textdomain( 'csoon', get_template_directory() . '/languages' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    /*
    * Let WordPress manage the document title.
    * By adding theme support, we declare that this theme does not use a
    * hard-coded <title> tag in the document head, and expect WordPress to
    * provide it for us.
    */
    add_theme_support( 'title-tag' );

    /*
    * Enable support for Post Thumbnails on posts and pages.
    *
    * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
    */
    add_theme_support( 'post-thumbnails' );

    set_post_thumbnail_size( 1568, 9999 );

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(
      array(
        'main-menu' => __( 'Main Menu', 'csoon' )
      )
    );

    /*
    * Switch default core markup for search form, comment form, and comments
    * to output valid HTML5.
    */
    add_theme_support(
      'html5',
      array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
      )
    );

    /**
    * Add support for core custom logo.
    *
    * @link https://codex.wordpress.org/Theme_Logo
    */
    add_theme_support(
      'custom-logo',
      array(
        'height'      => 421,
        'width'       => 190,
        'flex-width'  => true,
        'flex-height' => true,
      )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for Block Styles.
    add_theme_support( 'wp-block-styles' );

    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );


    // Editor color palette.
    add_theme_support(
      'editor-color-palette',
      array(
        array(
          'name'  => __( 'Primary', 'csoon' ),
          'slug'  => 'primary',
          //'color' => csoon_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
        ),
        array(
          'name'  => __( 'Secondary', 'csoon' ),
          'slug'  => 'secondary',
          //'color' => csoon_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
        ),
        array(
          'name'  => __( 'Dark Gray', 'csoon' ),
          'slug'  => 'dark-gray',
          'color' => '#111',
        ),
        array(
          'name'  => __( 'Light Gray', 'csoon' ),
          'slug'  => 'light-gray',
          'color' => '#767676',
        ),
        array(
          'name'  => __( 'White', 'csoon' ),
          'slug'  => 'white',
          'color' => '#FFF',
        ),
      )
    );

    // Add support for responsive embedded content.
    add_theme_support( 'responsive-embeds' );
  }

endif;

add_action( 'after_setup_theme', 'csoon_setup' );

/**
* Register widget area.
*
* @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
*/

function csoon_widgets_init() {

  register_sidebar(
    array(
      'name'          => __( 'Footer', 'csoon' ),
      'id'            => 'sidebar-1',
      'description'   => __( 'Add widgets here to appear in your footer.', 'csoon' ),
      'before_widget' => '<section id="%1$s" class="widget %2$s">',
      'after_widget'  => '</section>',
      'before_title'  => '<h2 class="widget-title">',
      'after_title'   => '</h2>',
    )
  );

}

add_action( 'widgets_init', 'csoon_widgets_init' );

/**
* Set the content width in pixels, based on the theme's design and stylesheet.
*
* Priority 0 to make it available to lower priority callbacks.
*
* @global int $content_width Content width.
*/

function csoon_content_width() {
  // This variable is intended to be overruled from themes.
  // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
  // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
  $GLOBALS['content_width'] = apply_filters( 'csoon_content_width', 640 );
}

add_action( 'after_setup_theme', 'csoon_content_width', 0 );

/**
* Enqueue scripts and styles.
*/

function csoon_scripts() {

  if (!is_admin()) {

    // Normalize cross browser styles.
    wp_enqueue_style( 'normalize', get_theme_file_uri( '/assets/css/vendor/normalize.css' ) );

    // Theme styles.
    wp_enqueue_style( 'csoon-styles', get_theme_file_uri( '/assets/css/style.min.css' ) );

    // Font Awesome style
    wp_enqueue_style( 'font-awesome-styles', get_theme_file_uri( '/assets/css/vendor/font-awesome.min.css' ) );


    wp_enqueue_script( 'jquery' );

    //wp_enqueue_script( 'csoon-vendorsjs', get_theme_file_uri( '/assets/js/vendors.min.js' ) , array( 'jquery' ), false, false );

    //wp_enqueue_script( 'csoon-custom-js', get_theme_file_uri( '/assets/js/custom.js' ) , array( 'jquery' ), false, true );

    if ( is_singular() ) {
      wp_enqueue_script( "comment-reply" );
    }

  }

}

add_action( 'wp_enqueue_scripts', 'csoon_scripts' );

/**
* Fix skip link focus in IE11.
*
* This does not enqueue the script because it is tiny and because it is only for IE11,
* thus it does not warrant having an entire dedicated blocking script being loaded.
*
* @link https://git.io/vWdr2
*/
function csoon_skip_link_focus_fix() {

  // The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
  ?>
  <script>
  /(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
  </script>
  <?php

}

add_action( 'wp_print_footer_scripts', 'csoon_skip_link_focus_fix' );

/**
* Enqueue supplemental block editor styles.
*/

function csoon_editor_customizer_styles() {

  wp_enqueue_style( 'csoon-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

  if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
    // Include color patterns.
    require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
    wp_add_inline_style( 'csoon-editor-customizer-styles', csoon_custom_colors_css() );
  }

}

add_action( 'enqueue_block_editor_assets', 'csoon_editor_customizer_styles' );

/**
* Display custom color CSS in customizer and on frontend.
*/

function csoon_colors_css_wrap() {

  // Only include custom colors in customizer or frontend.
  if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
  return;
  }

  //require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

  $primary_color = 199;
  if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
  $primary_color = get_theme_mod( 'primary_color_hue', 199 );
  }
  ?>

  <style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
    <?php echo csoon_custom_colors_css(); ?>
  </style>
  <?php

}

add_action( 'wp_head', 'csoon_colors_css_wrap' );


/**
* Enhance the theme by hooking into WordPress.
*/
require get_template_directory() . '/inc/template-functions.php';

/**
* Custom template tags for the theme.
*/
require get_template_directory() . '/inc/template-tags.php';

/**
* Customizer additions.
*/
require get_template_directory() . '/inc/customizer.php';

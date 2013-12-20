<?php
/**
 * Typable functions and definitions
 *
 * @package Typable
 * @since Typable 1.3
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Typable 1.3
 */
if ( ! isset( $content_width ) )
  $content_width = 720; /* pixels */

if ( ! function_exists( 'typable_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 * @since Typable 1.3
 */
function typable_setup() {

    /* Add Customizer settings */
    require( get_template_directory() . '/customizer.php' );

    /* Initialize EDD update class */
    require( get_template_directory() . '/includes/updates/EDD_SL_Setup.php' );

    /* Add post styles */
    require_once( dirname( __FILE__ ) . "/includes/editor/add-styles.php" );

    /* Add default posts and comments RSS feed links to head */
    add_theme_support( 'automatic-feed-links' );

    /* Add editor styles */
    add_editor_style();

    /* Enable support for Post Thumbnails */
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'featured-image', 720, 9999, false );

    /* Custom Background Support */
    add_theme_support( 'custom-background' );

    /* This theme uses wp_nav_menu() in one location. */
    register_nav_menu('main', __( 'Main Menu', 'okay' ));

    /* Make theme available for translation */
    load_theme_textdomain( 'okay', get_template_directory() . '/languages' );

}
endif; // typable_setup
add_action( 'after_setup_theme', 'typable_setup' );


// Load Scripts and Styles

function typable_scripts_styles() {

    //Enqueue Styles

    //Main Stylesheet
    wp_enqueue_style( 'style', get_stylesheet_uri() );

	//Font Awesome CSS
	wp_enqueue_style( 'font_awesome_css', get_template_directory_uri() . "/includes/fonts/fontawesome/font-awesome.css", array(), '0.1', 'screen' );

	//Media Queries CSS
    wp_enqueue_style( 'media_queries_css', get_template_directory_uri() . "/media-queries.css", array(), '0.1', 'screen' );

	//Google Font - Lato
    wp_enqueue_style('google_lato', 'http://fonts.googleapis.com/css?family=Lato:300,400,700,400italic');

	//Enqueue Scripts

	//Register jQuery
	wp_enqueue_script('jquery');

    //Custom JS
    wp_enqueue_script('custom_js', get_template_directory_uri() . '/includes/js/custom/custom.js', false, false , true);

    wp_localize_script('custom_js', 'custom_js_vars', array(
      'toggle_ajax' => get_option('okay_theme_customizer_ajax_toggle')
    )
    );

    //History JS
    if ( get_option('okay_theme_customizer_ajax_toggle') == 'enabled' ) {
        wp_localize_script('custom_js', 'WPCONFIG', array( 'site_url' => site_url() ));
        wp_localize_script('custom_js', 'WPLANG', array(
          'type_your_search' => __('Type your search here and press enter...','okay')
        ));

        wp_deregister_script('history_js');
        wp_register_script( 'history_js', get_template_directory_uri() . '/includes/js/history/jquery.history.js', false, false , true);
        wp_enqueue_script( 'history_js' );
    }

    //Mobile JS
    wp_enqueue_script('mobile_menu_js', get_template_directory_uri() . '/includes/js/menu/jquery.mobilemenu.js', false, false , true);

    //FidVid
    wp_enqueue_script('fitvid_js', get_template_directory_uri() . '/includes/js/fitvid/jquery.fitvids.js', false, false , true);

}
add_action( 'wp_enqueue_scripts', 'typable_scripts_styles' );


// Register Widget Drawer

if ( function_exists('register_sidebars') )

register_sidebar( array(
    'name' => __( 'Widget Drawer', 'okay' ),
    'description' => __( 'Widgets in this area will be shown in the header drawer.', 'okay' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>'
));


// Add Customizer CSS To Header
function okay_customizer_css() {
?>
<style type="text/css">
    a, .logo-text a:hover, #cancel-comment-reply-link i, #archive-list li span, #archive-list li:hover a, .nav a:hover, #archive-list li a:hover, #archive-list li span, .ajax-loader , #widget-drawer .tagcloud a {
        color: <?php echo get_theme_mod( 'okay_theme_customizer_accent', '#00a9e0' ); ?>;
    }
    
    .header, #archive-list li:hover span, #respond .respond-submit, .wpcf7-submit, .header .search-form .submit, #commentform #submit{
        background: <?php echo get_theme_mod( 'okay_theme_customizer_accent', '#00a9e0' ); ?>; 
    }
    
    <?php echo get_theme_mod( 'okay_theme_customizer_css', '' );?>
</style>
<?php
}
add_action( 'wp_head', 'okay_customizer_css' );


// Pagination
function okay_page_has_nav() {
	global $wp_query;
	return ($wp_query->max_num_pages > 1);
}

function okay_posts_per_page( $query ) {
  if ( is_search() ) {
      $query->set( 'posts_per_page', -1 );
  }
  return;
}
add_action( 'pre_get_posts', 'okay_posts_per_page', 1 );


// Comment Reply Link
function okay_cancel_comment_reply_button($html, $link, $text) {
    $style = isset($_GET['replytocom']) ? '' : ' style="display:none;"';
    $button = '<div id="cancel-comment-reply-link"' . $style . '>';
    return $button . '<i class="icon-remove-sign"></i> </div>';
}

add_action( 'cancel_comment_reply_link', 'okay_cancel_comment_reply_button', 10, 3 );


// Javascript Helper Functions

if ( get_option( 'okay_theme_customizer_ajax_toggle' ) == 'enabled' ) {

// Output the next post link and include the post title
// in the data-title attribute to pass to JavaScript.

    function okay_next_post_link( $text='Forward' ){
      $next_post = get_adjacent_post('false', '', false);
      if ($next_post != ''){
        $next_post_url = get_permalink($next_post);
        $next_post_title =  htmlspecialchars($next_post->post_title, ENT_QUOTES);
        echo "<a href='$next_post_url' data-title='$next_post_title' rel='next'>$text</a>";
      }
    }

    // Output the prev post link with the data-title attribute
    function okay_prev_post_link( $text='Backward' ){
      $previous_post = get_adjacent_post('false', '', true);
      if ($previous_post != ''){
        $previous_post_url = get_permalink($previous_post);
        $previous_post_title =  htmlspecialchars($previous_post->post_title, ENT_QUOTES);
        echo "<a href='$previous_post_url' data-title='$previous_post_title' rel='prev'>$text</a>";
      }
    }
}
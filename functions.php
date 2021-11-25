<?php
// Before VC Init
/*add_action( 'init', 'vc_before_init_actions' );
 
function vc_before_init_actions() {

  // Require new custom Element
     
}*/

add_action( 'wp_enqueue_scripts', 'enqueue_child_theme_styles', PHP_INT_MAX);

function enqueue_child_theme_styles() {
  wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
  // child style ( this loads the css from the child folder after parent-style )
  wp_enqueue_style('child-style', get_stylesheet_directory_uri() .'/style.css', array('parent-style'));
}

function custom_scripts_method()
{
  wp_enqueue_style( 'bootstrap', get_stylesheet_directory_uri() . '/css/bootstrap.min.css' ); 
  wp_enqueue_script('customscripts');
}

add_action('wp_enqueue_scripts', 'custom_scripts_method');

/**
 * Custom Taxonomy & Custom Post Type(s)
 */
require_once locate_template( '/inc/ct_and_cpt.php' );

/**
 * Custom widgets
 */
require_once locate_template( '/inc/widgets.php' );

/**
 * Schedule redirection to pdf
 */
function schedule_redirect() {
  
  if ( strpos($_SERVER["REQUEST_URI"], "wcp-schedules")){

    if (explode("/wcp-schedules/",$_SERVER["REQUEST_URI"])){

      $url = explode("/wcp-schedules/",$_SERVER["REQUEST_URI"]);
      $scheduleId = preg_replace("/[^0-9]/", "", $url[1] );

      if ( isset($url[1]) && !empty( $scheduleId )){
        $schedule = get_field('schedule_file', $scheduleId);
        wp_redirect( $schedule );
        exit;
      } 

    }

  }

} 

add_action ('wp_loaded', 'schedule_redirect');


// Add query var
function add_query_vars_filter( $vars ){
  $vars[] = "areas";
  $vars[] = "typedoc";
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );


// Password page protection coockie timeout
function wpse166590_cockie_timeout($timeout) {
  return time() + 5 * 60; // 5 minute in seconds
}
add_filter('post_password_expires','wpse166590_cockie_timeout');



// Add schedules widgets search
add_action( 'wp_loaded', 'wpse_76959_register_widget_area' );
function wpse_76959_register_widget_area()
{
    register_sidebar(
        array (
            'name'          => __(
                'Schedule page sidebar',
                'theme_textdomain'
                ),
            'description'   => __(
                'Will be used on a page with a slug "wcp-schedules" only.',
                'theme_textdomain'
                ),
            'id'            => 'wcp-schedules',
            'before_widget' => '<div id="wcp-schedules-widget">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2>',
            'after_title'   => '</h2>',
        )
    );

    register_sidebar(
      array (
          'name'          => __(
              'Document page sidebar',
              'theme_textdomain'
              ),
          'description'   => __(
              'Will be used on a page with a slug "wcp-documents" only.',
              'theme_textdomain'
              ),
          'id'            => 'wcp-documents',
          'before_widget' => '<div id="wcp-documents-widget">',
          'after_widget'  => '</div>',
          'before_title'  => '<h2>',
          'after_title'   => '</h2>',
      )
    );
}


add_action( 'wp_head', 'dt_the7_child_head', 1 );
/**
 * Prints the Google Tag Manager <head> script
 */
function dt_the7_child_head(){
?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-NHTG8SK');</script>
    <!-- End Google Tag Manager -->
<?php
}



add_action( 'presscore_body_top', 'dt_the7_child_body_open', 1 );
/**
 * Prints the Google Tag Manager <body> script
 */
function dt_the7_child_body_open(){
?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NHTG8SK"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?php
}


function shortcode_bienvenue(){



  echo "<h2>Bienvenue!</h2>";
}
add_shortcode('bienvenue', 'shortcode_bienvenue');
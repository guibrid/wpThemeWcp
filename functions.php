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
  return $vars;
}
add_filter( 'query_vars', 'add_query_vars_filter' );



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
}
<?php

// Creating the widget 
class schedulesAreaLink_widget extends WP_Widget {
 
// The construct part  
function __construct() {
    parent::__construct(
  
        // Base ID of your widget
        'schedulesAreaLink_widget', 
          
        // Widget name will appear in UI
        __('Schedules Areas Links', 'wcp_widget_domain'), 
          
        // Widget description
        array( 'description' => __( 'Sample widget based on WPBeginner Tutorial', 'wcp_widget_domain' ), ) 
        );
}
  
// Creating widget front-end
public function widget( $args, $instance ) {

    echo '<div class="schedulesAreaLink"><h3>Schedules by areas</h3>';
    $terms = get_terms( array(
        'taxonomy' => 'area',
        'hide_empty' => true,
    ) );
    
    echo '<ul>';
    echo '<li><a href="'. get_site_url().'/wcp-schedules/'.'">All areas</a></li>';
    foreach ($terms as $term)
    {
        echo '<li><a href="'.add_query_arg( 'area', $term->slug, get_site_url().'/wcp-schedules/' ).'">'.$term->name.'</a></li>';
    }
    echo '</ul></div>';
}
          
// Creating widget Backend 
public function form( $instance ) {
    echo 'back';
 
}
      
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
 
}
 
// Class wpb_widget ends here
} 

function schedulesAreaLink_load_widget() {
    register_widget( 'schedulesAreaLink_widget' );
}
add_action( 'widgets_init', 'schedulesAreaLink_load_widget' );
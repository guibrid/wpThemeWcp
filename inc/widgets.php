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

// Creating the widget 
class documentType_widget extends WP_Widget {
 
    // The construct part  
    function __construct() {
        parent::__construct(
    
            // Base ID of your widget
            'documentType_widget', 
            
            // Widget name will appear in UI
            __('Document type Links', 'wcp_widget_domain'), 
            
            // Widget description
            array( 'description' => __( 'Sample widget based on WPBeginner Tutorial', 'wcp_widget_domain' ), ) 
            );
    }
    
    // Creating widget front-end
    public function widget( $args, $instance ) {

        echo '<div><h3>Document types</h3>';
        ?>
        <ul class="typedoc_list">
    <?php $hiterms = get_terms(array('taxonomy' => "typeDoc", "orderby" => "slug", "parent" => 0)); ?>
    <?php foreach($hiterms as $key => $hiterm) : ?>
        <li>
            <a href="<?php echo add_query_arg( 'typedoc', $hiterm->slug, get_site_url().'/wcp-documents/' ); ?>"><?php echo $hiterm->name; ?></a>
            <?php $loterms = get_terms(array('taxonomy' => 'typeDoc',"orderby" => "slug", "parent" => $hiterm->term_id)); ?>
            <?php if($loterms) : ?>
                <ul>
                    <?php foreach($loterms as $key => $loterm) : ?>
                        <li><a href="<?php echo add_query_arg( 'typedoc', $loterm->slug, get_site_url().'/wcp-documents/' ); ?>"><?php echo $loterm->name; ?></a></li>
                        <?php $loterms3 = get_terms(array('taxonomy' => 'typeDoc',"orderby" => "slug", "parent" => $loterm->term_id)); ?>
                        <?php if($loterms3) : ?>
                            <ul>
                                <?php foreach($loterms3 as $key => $lotermt) : ?>
                                    <li><a href="<?php echo add_query_arg( 'typedoc', $lotermt->slug, get_site_url().'/wcp-documents/' ); ?>"><?php echo $lotermt->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
<?php




        
    }
            
    // Creating widget Backend 
    public function form( $instance ) {
        echo 'back';
    
    }
 
// Class wpb_widget ends here
} 

function schedulesAreaLink_load_widget() {
    register_widget( 'schedulesAreaLink_widget' );
}
add_action( 'widgets_init', 'schedulesAreaLink_load_widget' );


function documentType_load_widget() {
    register_widget( 'documentType_widget' );
}
add_action( 'widgets_init', 'documentType_load_widget' );
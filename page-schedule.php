<?php /* Template Name: Page Schedule */ ?>

<?php get_header(); ?>

<?php
/*global $post;
$pageUrl = get_permalink();
var_dump($pageUrl);
var_dump(get_the_ID());
if (strpos($pageUrl, 'download')){
    wp_redirect( home_url() . '/login' );
    exit;
}*/
?>

<div class="schedules-bloc">
<?php 

    $term_args = [
        'orderby' => 'name',
        'order' => 'ASC'
    ];

    $terms = get_terms('area',$term_args);

    if ($terms) {

        foreach($terms as $term) {
           

            $args = [
                'post_type' => 'schedule',
                'post_status' => 'publish',
                'tax_query' => [
                    [
                        'taxonomy' => 'area',
                        'terms' => array($term->term_id),
                        'include_children' => true,
                        'operator' => 'IN'
                    ]
                ],
            ];

            $my_query = new WP_Query( $args ); 

            if ($my_query->have_posts()) {
                //var_dump($my_query->found_posts);
                //loop_columns
                // https://gist.github.com/cp6/e3edb35794521a8d2f08cad4f3b1e450 
                echo '<h3>'.$term->name."</h3>";
                echo '<div class="schedule-container container">';
                echo '<div class="row">';
                while ( $my_query->have_posts() ) : $my_query->the_post();
                    //var_dump($my_query);
                    echo '<div class="col-lg-3"><a href="/download" title="Download schedule">';
                    echo "<span class='content'>Ex ".get_field( "origin" )." to ".get_field( "destination" )."<span class='type'>".get_field( "type" )."</span></span>"; 
                    echo "</a></div>";
                endwhile;
                echo '</div>';
                echo '</div>';
            }

        }

    }

    wp_reset_postdata(); 

?>
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
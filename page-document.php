<?php /* Template Name: Page Document*/ ?>

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
    'order' => 'ASC',
    'search' => get_query_var('typedoc')
];
$terms = get_terms('typeDoc',$term_args);

    if ($terms) {

        foreach($terms as $term) {
           

            $args = [
                'post_type' => 'document',
                'post_status' => 'publish',
                'posts_per_page' => '100',
                'tax_query' => [
                    'relation' => 'AND',
                    [
                        'taxonomy' => 'typeDoc',
                        'terms' => array($term->term_id),
                        'include_children' => true,
                        'operator' => 'IN'
                    ],
                    array(
                        'taxonomy' => 'post_tag',
                        'field'    => 'slug',
                        'terms'    => 'protected',
                        'operator' => 'NOT IN',
                    ),
                ],
            ];

            $my_query = new WP_Query( $args ); 

            if ($my_query->have_posts()) {
                echo '<h3>'.$term->name."</h3>";
                echo '<div class="schedule-container">';
                while ( $my_query->have_posts() ) : $my_query->the_post();
                    $doc = get_field('document');
                    echo '<div><a href="'.$doc['url'].'" title="Download this document" target="_blank">';
                    echo "<p>".get_the_title( )."<br /><span class='type'>Size: ".$doc['filesize']."</span></p>"; 
                    echo "</a></div>";
                endwhile;
                echo '</div>';
            }

        }

    }

    wp_reset_postdata(); 

?>
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>
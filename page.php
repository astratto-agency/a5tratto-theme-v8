<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context(); 
$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$templates        = array( 'page.twig', 'index.twig' );

//  A_SETTINGS Assegno tutte le variabili di ACF a Twig
$fields = get_field_objects(get_queried_object_id($timber_post));
if ($fields):
    foreach ($fields as $field):
        $name_id = $field['name'];
        $value_id = $field['value'];
        $context[$name_id] = $value_id;
    endforeach;
endif;



 //  A_SETTINGS Main query
 $args = array(
    'post_type' => 'post', 
    'paged' => 2,
    'orderby' => 'date',
    'order' => 'ASC',
);
$context['posts'] = $posts = new Timber\PostQuery($args); 
 

if ( is_front_page() ) {  
    array_unshift( $templates, 'home.twig' );
} else {
    array_unshift( $templates, 'page-' . $timber_post->post_name . '.twig', 'page.twig' ); 
}

Timber::render( $templates, $context );

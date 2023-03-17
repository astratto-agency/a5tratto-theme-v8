<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.2
 */

$templates = array( 'archive.twig', 'index.twig' );

$context = Timber::context();

//  A_SETTINGS TERM QUERY elaboro query base per term
$context['term'] = $term = new Timber\Term(get_queried_object_id());

// A_SETTINGS Assegnazione del numero di paginazione di post per pagina
$paginazione = get_option('posts_per_page');
$num_pagina = $paginazione -1;
$exp_reg_pag = '%/page/('.$num_pagina.')%';

// A_SETTINGS Elaborazione dell'impaginato impostare il numero successivo qui '%/page/([0-3]+)%' in base al valore assegnato nella paginazione
preg_match($exp_reg_pag, $_SERVER['REQUEST_URI'], $matches );
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} elseif (get_query_var('page')) {
    $paged = get_query_var('page');
} elseif (isset($matches[1])) {
    $paged = $matches[1];
} elseif (!isset($paged) || !$paged) {
    $paged = 1;
} else {
    $paged = 1;
}


//  A_SETTINGS Controllo se la pagina è un CPT con slug simile
if (get_post_type() == 'page') {
    $context['title'] = $post->title;
    $cpt_args = array(
        'public' => true,
        '_builtin' => false
    );
    $post_types = get_post_types($cpt_args, 'object'); // use 'names' if you want to get only name of the post type.
    foreach ($post_types as $item_post_type) {
        if ($post->slug == $item_post_type->rewrite['slug'] || $post->slug == $item_post_type->name) {
            $post_type = $item_post_type->name;
            $context['title'] = $item_post_type->label;
        }
    }
    array_unshift($templates, 'archive-' . $post_type . '.twig'); // Update templates
} else {
    $post_type = get_post_type();
    $context['content'] = get_the_post_type_description();
}
$obj_post_type = get_post_type_object($post_type);
$context['post_type'] = 'archive';

$context['title'] = 'Archive';
if ( is_day() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'D M Y' );
} elseif ( is_month() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'M Y' );
} elseif ( is_year() ) {
	$context['title'] = 'Archive: ' . get_the_date( 'Y' );
} elseif ( is_tag() ) {
	$context['title'] = single_tag_title( '', false );
    array_unshift(
		$templates, 'tag-' . $term->slug . '.twig', 
		'tag.twig'
	);
} elseif ( is_category() ) {
	$context['title'] = single_cat_title( '', false );
    //  A_SETTINGS  Stampa child della categoria
$context['childs'] = $childs = get_terms(
    $term->taxonomy, array(
    'parent'    => $term->term_id,
    'hide_empty' => false
) );

//  A_SETTINGS  Stampa parent della categoria
$parent_id = $term->parent;
$context['parents'] = $parents = get_terms(
    $term->taxonomy, array(
    'term_taxonomy_id'  => $parent_id,
    'hide_empty' => false,

) );
    array_unshift(
		$templates, 
		'category-' . $term->slug . '.twig', 
		'archive-' . get_query_var( 'cat' ) . '.twig',
		'category.twig',  
	); 

} elseif ( is_post_type_archive() ) {
	$context['title'] = post_type_archive_title( '', false );
	array_unshift(
		$templates, 'archive-' . get_post_type() . '.twig'
	); 
    $context['post_type_name'] = 'Archive';
} else if (is_page()) {
    // A_SETTINGS page
    if (!empty($obj_post_type)) {
        $context['title'] = $obj_post_type->label; // Update title
        array_unshift($templates, 'archive-' . $obj_post_type->name . '.twig'); // Update templates
        $context['post_type_name'] = 'Page Archive';
    }
}
 
//  A_SETTINGS Assegno tutte le variabili di ACF a Twig
$fields = get_field_objects(get_queried_object_id($post));
if ($fields):
    foreach ($fields as $field):
        $name_id = $field['name'];
        $value_id = $field['value'];
        $context[$name_id] = $value_id;
    endforeach;
endif;



//  A_SETTINGS QUERY elaboro query base
$args = array(
    'post_type' => $post_type,
    'posts_per_page' => $paginazione,
    'paged' => $paged,  //////////// Impaginazione
    'orderby' => 'date',
    'order' => 'ASC',
);
$context['posts'] = $query_posts = new Timber\PostQuery($args);

 
//  A_SETTINGS Gestisco la numerazione della pagine e i corrispettivi valori trovati
$context['found_posts'] = $query_posts->found_posts;
$context['startpost'] = $startpost = 1;
$context['startpost'] = $startpost = $paginazione * ($paged - 1) + 1;
$context['endpost'] = $endpost = ($paginazione * $paged < $query_posts->found_posts ? $paginazione * $paged : $query_posts->found_posts);

Timber::render( $templates, $context );

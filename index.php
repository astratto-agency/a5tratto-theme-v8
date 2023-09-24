<?php
/**
* The main template file
* This is the most generic template file in a WordPress theme
* and one of the two required files for a theme (the other being style.css).
* It is used to display a page when nothing more specific matches a query.
* E.g., it puts together the home page when no home.php file exists
*
* Methods for TimberHelper can be found in the /lib sub-directory
*
* @package  WordPress
* @subpackage  Timber
* @since   Timber 0.1
*/

$context          = Timber::context();
$context['posts'] = new Timber\PostQuery();
$context['foo']   = 'bar';
$templates        = array( 'index.twig' );

if ( is_front_page() && is_home() ) {
	// Default homepage 
	include( get_template_directory() . '/archive.php' );   
}  elseif ( is_home() ) { 
	// blog page 
	include( get_template_directory() . '/archive.php' );  
} else {
	//everything else 
	Timber::render( $templates, $context );
}
 
 
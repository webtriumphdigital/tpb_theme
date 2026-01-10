<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Justhome
 * @since Justhome 1.0
 */
/*
*Template Name: Agencies Template
*/

global $justhome_agencies;

if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
    $paged = get_query_var( 'page' );
} else {
    $paged = 1;
}

$query_args = array(
	'post_type' => 'agency',
    'post_status' => 'publish',
    'post_per_page' => wp_realestate_get_option('number_agencies_per_page', 10),
    'paged' => $paged,
);

$params = array();
if ( WP_RealEstate_Abstract_Filter::has_filter() ) {
	$params = array_merge($params, $_GET);
}

$justhome_agencies = WP_RealEstate_Query::get_posts($query_args, $params);

if ( isset( $_REQUEST['load_type'] ) && WP_RealEstate_Mixes::is_ajax_request() ) {
	$args = array(
		'agencies' => $justhome_agencies,
		'settings' => !empty( $_REQUEST['settings'] ) ? $_REQUEST['settings'] : array(),
		'pagination_settings' => !empty( $_REQUEST['pagination_settings'] ) ? $_REQUEST['pagination_settings'] : array()
	);
	
	if ( 'items' !== $_REQUEST['load_type'] ) {
		echo WP_RealEstate_Template_Loader::get_template_part('archive-agency-ajax-full', $args);
	} else {
		echo WP_RealEstate_Template_Loader::get_template_part('archive-agency-ajax-agencies', $args);
	}
} else {
	get_header();
	?>

		<section id="main-container" class="inner">
			
			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();
				
				// Include the page content template.
				the_content();

			// End the loop.
			endwhile;
			?>

		</section>


	<?php

	get_footer();
}
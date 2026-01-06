<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wp_query, $justhome_properties;

if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
    $paged = get_query_var( 'page' );
} else {
    $paged = 1;
}

$query_args = array(
	'post_type' => 'property',
    'post_status' => 'publish',
    'post_per_page' => wp_realestate_get_option('number_properties_per_page', 10),
    'paged' => $paged,
);
$params = array();
$taxs = ['type', 'status', 'location', 'amenity', 'label', 'material'];
foreach ($taxs as $tax) {
	if ( is_tax('property_'.$tax) ) {
		$term = $wp_query->queried_object;
		if ( isset( $term->term_id) ) {
			$params['filter-'.$tax] = $term->term_id;
		}
	}
}

if ( WP_RealEstate_Abstract_Filter::has_filter() ) {
	$params = array_merge($params, $_GET);
}
$justhome_properties = WP_RealEstate_Query::get_posts($query_args, $params);


if ( isset( $_REQUEST['load_type'] ) && WP_RealEstate_Mixes::is_ajax_request() ) {
	$args = array(
		'properties' => $justhome_properties,
		'settings' => !empty( $_REQUEST['settings'] ) ? $_REQUEST['settings'] : array(),
		'pagination_settings' => !empty( $_REQUEST['pagination_settings'] ) ? $_REQUEST['pagination_settings'] : array()
	);
	if ( 'items' !== $_REQUEST['load_type'] ) {
        echo WP_RealEstate_Template_Loader::get_template_part('archive-property-ajax-full', $args);
	} else {
		echo WP_RealEstate_Template_Loader::get_template_part('archive-property-ajax-properties', $args);
	}

} else {
	get_header();

	?>
		<section id="main-container" class="inner ">
			<?php do_action('justhome_property_archive_content'); ?>
		</section>
	<?php

	get_footer();
}
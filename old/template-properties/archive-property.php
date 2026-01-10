<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;

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
$properties = WP_RealEstate_Query::get_posts($query_args, $params);

if ( isset( $_REQUEST['load_type'] ) && WP_RealEstate_Mixes::is_ajax_request() ) {
	if ( 'items' !== $_REQUEST['load_type'] ) {
        echo WP_RealEstate_Template_Loader::get_template_part('archive-property-ajax-full', array('properties' => $properties));
	} else {
		echo WP_RealEstate_Template_Loader::get_template_part('archive-property-ajax-properties', array('properties' => $properties));
	}

} else {
	get_header();

	$args = array(
		'properties' => $properties,
		'settings' => array(),
	);
	$sidebar_configs = justhome_get_properties_layout_configs();
	?>
		
		<section id="main-container" class="inner">
			
			<?php justhome_render_breadcrumbs(); ?>

			<div class="main-content container inner">
				
				<?php justhome_before_content( $sidebar_configs ); ?>
				
				<div class="row">
					<?php justhome_display_sidebar_left( $sidebar_configs ); ?>

					<div id="main-content" class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
						<main id="main" class="site-main" role="main">
							<?php
								echo WP_RealEstate_Template_Loader::get_template_part('loop/property/archive-inner', $args);

								echo WP_RealEstate_Template_Loader::get_template_part('loop/property/pagination', $args);
							?>
						</main><!-- .site-main -->
					</div><!-- .content-area -->
					
					<?php justhome_display_sidebar_right( $sidebar_configs ); ?>
				</div>

			</div>
		</section>
	<?php

	get_footer();
}
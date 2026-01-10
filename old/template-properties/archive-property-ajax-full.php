<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$args = array(
	'properties' => $properties,
	'settings' => $settings
);

$total = $properties->found_posts;
$per_page = $properties->query_vars['posts_per_page'];
$current = max( 1, $properties->get( 'paged', 1 ) );

$page_args = array(
	'properties' => $properties,
	'settings' => $pagination_settings
);
?>

<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/property/results-count', array('total' => $total, 'per_page' => $per_page, 'current' => $current)); ?>

<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/property/orderby', $args); ?>

<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/property/archive-inner', $args); ?>

<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/property/pagination', $page_args ); ?>
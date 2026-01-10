<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = array(
	'agencies' => $agencies,
	'settings' => $settings
);

$total = $agencies->found_posts;
$per_page = $agencies->query_vars['posts_per_page'];
$current = max( 1, $agencies->get( 'paged', 1 ) );

$page_args = array(
	'agencies' => $agencies,
	'settings' => $pagination_settings
);
?>

<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/agency/results-count', array('total' => $total, 'per_page' => $per_page, 'current' => $current)); ?>

<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/agency/orderby', $args); ?>

<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/agency/archive-inner', $args); ?>

<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/agency/pagination', $page_args ); ?>


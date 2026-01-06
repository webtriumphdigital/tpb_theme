<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$args = array(
	'agents' => $agents,
	'settings' => $settings
);

$total = $agents->found_posts;
$per_page = $agents->query_vars['posts_per_page'];
$current = max( 1, $agents->get( 'paged', 1 ) );

$page_args = array(
	'agents' => $agents,
	'settings' => $pagination_settings
);
?>

<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/agent/results-count', array('total' => $total, 'per_page' => $per_page, 'current' => $current)); ?>

<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/agent/orderby', $args); ?>

<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/agent/archive-inner', $args); ?>

<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/agent/pagination', $page_args ); ?>


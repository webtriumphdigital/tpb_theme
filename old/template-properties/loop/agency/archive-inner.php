<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$agency_inner_style = !empty($settings['agency_item_style']) ? $settings['agency_item_style'] : 'grid';

$columns = !empty($settings['columns']) ? $settings['columns'] : 3;
$columns_tablet = !empty($settings['columns_tablet']) ? $settings['columns_tablet'] : 2;
$columns_mobile = !empty($settings['columns_mobile']) ? $settings['columns_mobile'] : 1;

$mdcol = 12/$columns;
$smcol = 12/$columns_tablet;
$xscol = 12/$columns_mobile;

?>
<div class="agencies-listing-wrapper main-items-wrapper" data-settings="<?php echo esc_attr(json_encode($settings)); ?>">
	
	<?php
	if ( !empty($agencies) && !empty($agencies->posts) ) { ?>

		<div class="agencies-wrapper items-wrapper clearfix">
			<div class="row">
				<?php while ( $agencies->have_posts() ) : $agencies->the_post(); ?>
					<div class="col-xl-<?php echo esc_attr($mdcol); ?> col-md-<?php echo esc_attr($smcol); ?> col-<?php echo esc_attr( $xscol ); ?>">
						<?php echo WP_RealEstate_Template_Loader::get_template_part( 'agencies-styles/inner-'.$agency_inner_style ); ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>

		<?php wp_reset_postdata(); ?>

	<?php } else { ?>
		<div class="not-found text-center"><?php esc_html_e('No agency found.', 'justhome'); ?></div>
	<?php } ?>
	
</div>
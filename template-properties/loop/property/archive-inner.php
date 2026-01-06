<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$property_inner_style = !empty($settings['property_item_style']) ? $settings['property_item_style'] : 'grid';

$columns = !empty($settings['columns']) ? $settings['columns'] : 3;
$columns_tablet = !empty($settings['columns_tablet']) ? $settings['columns_tablet'] : 2;
$columns_mobile = !empty($settings['columns_mobile']) ? $settings['columns_mobile'] : 1;

$mdcol = 12/$columns;
$smcol = 12/$columns_tablet;
$xscol = 12/$columns_mobile;

?>
<div class="properties-listing-wrapper main-items-wrapper" data-settings="<?php echo esc_attr(json_encode($settings)); ?>">
	<?php if ( !empty($properties) && !empty($properties->posts) ) : ?>
		
		<div class="properties-wrapper items-wrapper clearfix">
			
			<div class="row">
				<?php while ( $properties->have_posts() ) : $properties->the_post(); ?>
					<div class="col-xl-<?php echo esc_attr($mdcol); ?> col-md-<?php echo esc_attr($smcol); ?> col-<?php echo esc_attr( $xscol ); ?>">
						<?php echo WP_RealEstate_Template_Loader::get_template_part( 'properties-styles/inner-'.$property_inner_style ); ?>
					</div>
				<?php endwhile; ?>
			</div>
		</div>

		<?php wp_reset_postdata(); ?>

	<?php else : ?>
		<div class="not-found text-center"><?php esc_html_e('No property found.', 'justhome'); ?></div>
	<?php endif; ?>
	
</div>
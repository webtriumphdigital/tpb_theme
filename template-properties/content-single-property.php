<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;

?>

<?php do_action( 'wp_realestate_before_property_detail', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class('property-single-layout property-single-v1'); ?>>
	
	<div class="<?php echo apply_filters('justhome_property_content_class', 'container');?>">
				
		<?php echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/top-header' ); ?>
		<?php echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/gallery' ); ?>
		<?php echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/header' ); ?>
		<!-- Main content -->
		<div class="content-property-detail">

			<div class="row property-v-wrapper">
				<div class="col-12 property-detail-main col-lg-<?php echo esc_attr( is_active_sidebar( 'property-single-sidebar' ) ? 8 : 12); ?>">

					<?php do_action( 'wp_realestate_before_property_content', $post->ID ); ?>

					<?php
					if ( justhome_get_config('show_property_overview', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/overview' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_description', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/description' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_detail', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/detail' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_attachments', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/attachments' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_location', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/location' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_amenities', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/amenities' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_materials', false) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/materials' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_energy', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/energy' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_floor-plans', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/floor-plans' );
					}
					?>
					
					<?php
					if ( justhome_get_config('show_property_tabs-video', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/video' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_tabs-virtual', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/virtual' );
					}
					?>

					

					<?php
					if ( justhome_get_config('show_property_mortgage-calculator', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/mortgage-calculator' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_stats_graph', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/stats_graph' );
					}
					?>
					
					<?php
					if ( justhome_get_config('show_property_facilities', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/facilities' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_valuation', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/valuation' );
					}
					?>
					
					
					<?php
					if ( justhome_get_config('show_property_nearby_yelp', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/nearby_yelp' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_walk_score', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/walk_score' );
					}
					?>

					<?php
					if ( justhome_get_config('show_property_google_places', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/google-places' );
					}
					?>
					
					<?php
					if ( justhome_get_config('show_property_schedule-tour', true) ) {
						//echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/schedule-tour' );
					}
					?>

					<?php if ( is_active_sidebar( 'property-single-sidebar' ) ): ?>
						<div class="sidebar-mobile d-block d-lg-none">
						   	<?php dynamic_sidebar( 'property-single-sidebar' ); ?>
					   	</div>
				   	<?php endif; ?>

					<?php if ( WP_RealEstate_Review::review_enable() ) { ?>
							<?php comments_template(); ?>
					<?php } ?>


					<?php do_action( 'wp_realestate_after_property_content', $post->ID ); ?>
				</div>
				
				<?php if ( is_active_sidebar( 'property-single-sidebar' ) ): ?>
					<div class="col-12 col-lg-4 sidebar-wrapper d-none d-lg-block">
				   		<div class="sidebar sidebar-right sidebar-property">
					   		<?php dynamic_sidebar( 'property-single-sidebar' ); ?>
				   		</div>
				   	</div>
			   	<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
	if ( justhome_get_config('show_property_related', true) ) {
		echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/related' );
	}
	?>

	<?php
	if ( justhome_get_config('show_property_subproperties', true) ) {
		echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/subproperties' );
	}
	?>
</article><!-- #post-## -->

<?php do_action( 'wp_realestate_after_property_detail', $post->ID ); ?>
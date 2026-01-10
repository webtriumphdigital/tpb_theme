<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

?>

<section id="primary" class="content-area inner">
	<div id="main" class="site-main content" role="main">
		<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : the_post();
				global $post;
				$latitude = WP_RealEstate_Property::get_post_meta( $post->ID, 'map_location_latitude', true );
				$longitude = WP_RealEstate_Property::get_post_meta( $post->ID, 'map_location_longitude', true );
			?>
				<div class="single-property-wrapper single-listing-wrapper" data-latitude="<?php echo esc_attr($latitude); ?>" data-longitude="<?php echo esc_attr($longitude); ?>">
					<?php
						echo WP_RealEstate_Template_Loader::get_template_part( 'content-single-property' );
					?>
				</div>
			<?php endwhile; ?>

			<?php the_posts_pagination( array(
				'prev_text'     => '<i class="ti-angle-left"></i>',
				'next_text'     => '<i class="ti-angle-right"></i>',
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'justhome' ) . ' </span>',
			) ); ?>
		<?php else : ?>
			<div class="<?php echo apply_filters('justhome_property_content_class', 'container');?>">
				<?php get_template_part( 'content', 'none' ); ?>
			</div>
		<?php endif; ?>
	</div><!-- .site-main -->
</section><!-- .content-area -->
<?php get_footer(); ?>
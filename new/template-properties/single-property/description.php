<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);

$status = homeo_property_display_status_label($post, false, false);
$location = homeo_property_display_full_location($post, 'no-icon-title', false);
$home_area = $meta_obj->check_post_meta_exist('home_area') ? $meta_obj->get_post_meta('home_area') : '';
$beds = $meta_obj->check_post_meta_exist('beds') ? $meta_obj->get_post_meta('beds') : '';
$baths = $meta_obj->check_post_meta_exist('baths') ? $meta_obj->get_post_meta('baths') : '';
$kitchen = $meta_obj->check_post_meta_exist('kitchen') ? $meta_obj->get_post_meta('kitchen') : '';
$size = $meta_obj->check_post_meta_exist('size') ? $meta_obj->get_post_meta('size') : '';

			
?>
<div class="description inner">
	<div class="detail-metas-top">
		<ul class="list list-overview d-flex flex-wrap">
			<li class="d-flex align-items-center">
				<div class="icon flex-shrink-0 d-flex align-items-center justify-content-center">
					<i aria-hidden="true" class="flaticon-city"></i>
				</div>
				<div class="details flex-grow-1">
					<div class="value">
						<span class="content-value">
							<a class="property-tax" href="#"><?php echo trim($status); ?></a>
						</span>
					</div>
				</div>
			</li>
			
			<li class="d-flex align-items-center">
				<div class="icon flex-shrink-0 d-flex align-items-center justify-content-center">
					<i aria-hidden="true" class="flaticon-location"></i>
				</div>
				<div class="details flex-grow-1">
					<div class="value">
						<span class="content-value">
							<a class="property-tax" href="#"><?php echo trim($location); ?></a>
						</span>
					</div>
				</div>
			</li>
			
			<li class="d-flex align-items-center">
				<div class="icon flex-shrink-0 d-flex align-items-center justify-content-center">
					<i aria-hidden="true" class="flaticon-minus-front"></i>
				</div>
				<div class="details flex-grow-1">
					<div class="value">
						<span class="content-value">
							<?php echo trim($home_area); ?>
						</span>
						<span class="suffix">Sqm</span>
					</div>
				</div>
			</li>
			
			<li class="d-flex align-items-center">
				<div class="icon flex-shrink-0 d-flex align-items-center justify-content-center">
					<i aria-hidden="true" class="flaticon-hotel"></i>
				</div>
				<div class="details flex-grow-1">
					<div class="value">
						<span class="content-value">
							<?php echo trim($beds); ?>
						</span>
						<span class="suffix">Bedrooms</span>
					</div>
				</div>
			</li>
			
			<li class="d-flex align-items-center">
				<div class="icon flex-shrink-0 d-flex align-items-center justify-content-center">
					<i aria-hidden="true" class="flaticon-bath-tub"></i>
				</div>
				<div class="details flex-grow-1">
					<div class="value">
						<span class="content-value">
							<?php echo trim($baths); ?>
						</span>
						<span class="suffix">Bathrooms</span>
					</div>
				</div>
			</li>
			
			<li class="d-flex align-items-center">
				<div class="icon flex-shrink-0 d-flex align-items-center justify-content-center">
					<i aria-hidden="true" class="flaticon-house-4"></i>
				</div>
				<div class="details flex-grow-1">
					<div class="value">
						<span class="content-value">
							<?php echo trim($kitchen); ?>
						</span>
						<span class="suffix">Kitchen</span>
					</div>
				</div>
			</li>
		</ul>
	</div>
	<h3 class="title"><?php esc_html_e('Overview', 'homeo'); ?></h3>
	<div class="description-inner">
		<?php the_content(); ?>
		<?php do_action('wp-realestate-single-property-description', $post); ?>
	</div>
</div>
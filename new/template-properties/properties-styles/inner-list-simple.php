<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);

// $suffix = wp_realestate_get_option('measurement_unit_area');
// $lot_area = homeo_property_display_meta($post, 'lot_area', '', '', $suffix.':');
// $beds = homeo_property_display_meta($post, 'beds', '', $meta_obj->get_post_meta_title( 'beds' ).':');
// $baths = homeo_property_display_meta($post, 'baths', '', $meta_obj->get_post_meta_title( 'baths' ).':');

$lot_area = homeo_property_display_meta($post, 'lot_area');
$beds = homeo_property_display_meta($post, 'beds');
$baths = homeo_property_display_meta($post, 'baths');
?>
<article <?php post_class('property-list-simple'); ?>>
    <div class="flex-middle">
        <div class="property-thumbnail-wrapper flex-middle">
            <?php homeo_property_display_image( $post, 'thumbnail' ); ?>
        </div>
        <div class="property-information">
            <?php the_title( sprintf( '<h2 class="entry-title property-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            <?php homeo_property_display_price($post, 'no-icon-title', true); ?>
            <div class="property-metas">
                <?php 
                    if(!empty($beds)) {                            
                        	echo trim('<i class="flaticon-hotel" style="margin-right: 5px;"></i> '.$beds);
				}
				if(!empty($baths)) {                            
                        	echo trim('<i class="flaticon-bathtub" style="margin-right: 5px;"></i> '.$baths);
				}
				if(!empty($lot_area)) {                            
                        	echo trim('<i class="flaticon-minus-front" style="margin-right: 5px;"></i> '.$lot_area);
				}
                ?>
            </div>
        </div>
    </div>
</article><!-- #post-## -->
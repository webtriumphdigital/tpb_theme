<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
$price_avg = '';
$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);
$home_area = $meta_obj->get_post_meta('home_area');
$price = $meta_obj->get_post_meta( 'price' );
$price_custom = $meta_obj->get_post_meta( 'price_custom' );
$symbol = wp_realestate_get_option('custom_symbol', '$');
if( !empty($price) && empty($price_custom) && !empty($home_area) ){
    $price_avg = $price / $home_area;
}
?>
<div class="top-header-detail-property">
    <div class="d-md-flex align-items-center">
        <div class="left-infor">
            <?php the_title( '<h1 class="property-title">', '</h1>' ); ?>
            <div class="property-metas">
                <?php justhome_property_display_full_location($post, 'icon',true); ?>
            </div>
        </div>
        <div class="text-end ms-auto">
            <?php if(!empty($price_avg)){ ?>
                <div class="avg-price">
                    <?php echo WP_RealEstate_Price::format_price($price_avg) ; ?> / <?php echo wp_realestate_get_option('measurement_unit_area'); ?>
                </div>
            <?php } ?>
            <?php justhome_property_display_price($post); ?>
        </div>
    </div>
</div>
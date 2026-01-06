<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);
?>
<div class="property-detail-detail">
    <ul class="list list-overview d-flex flex-wrap">

        <?php if ( ($type = justhome_property_display_type($post, false, false)) ) { ?>
            <li class="d-flex align-items-center">
                <div class="icon flex-shrink-0 d-flex align-items-center justify-content-center">
                    <i class="flaticon-city"></i>
                </div>
                <div class="details flex-grow-1">
                    <div class="value"><?php echo trim($type); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $meta_obj->check_post_meta_exist('year_built') && ($year_built = $meta_obj->get_post_meta('year_built')) ) { ?>
            <li class="d-flex align-items-center">
                <div class="icon flex-shrink-0 d-flex align-items-center justify-content-center">
                    <i class="flaticon-hammer"></i>
                </div>
                <div class="details flex-grow-1">
                    <div class="value"><?php echo esc_html($meta_obj->get_post_meta_title( 'year_built' )); ?> : <?php echo trim($year_built); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $meta_obj->check_post_meta_exist('home_area') && ($home_area = $meta_obj->get_post_meta('home_area')) ) { ?>
            <li class="d-flex align-items-center">
                <div class="icon flex-shrink-0 d-flex align-items-center justify-content-center">
                    <i class="flaticon-minus-front"></i>
                </div>
                <div class="details flex-grow-1">
                    <div class="value"><?php echo trim($home_area); ?> <?php echo wp_realestate_get_option('measurement_unit_area'); ?></div>
                </div>
            </li>
        <?php } ?>

        <?php if ( $meta_obj->check_post_meta_exist('beds') && ($beds = $meta_obj->get_post_meta('beds')) ) { ?>
            <li class="d-flex align-items-center">
                <div class="icon flex-shrink-0 d-flex align-items-center justify-content-center">
                    <i class="flaticon-hotel"></i>
                </div>
                <div class="details flex-grow-1">
                    <div class="value"><?php echo trim($beds); ?> <?php echo esc_html($meta_obj->get_post_meta_title( 'beds' )); ?></div>
                </div>
            </li>
        <?php } ?>
        <?php if ( $meta_obj->check_post_meta_exist('baths') && ($baths = $meta_obj->get_post_meta('baths')) ) { ?>
            <li class="d-flex align-items-center">
                <div class="icon flex-shrink-0 d-flex align-items-center justify-content-center">
                    <i class="flaticon-bathtub"></i>
                </div>
                <div class="details flex-grow-1">
                    <div class="value"><?php echo trim($baths); ?> <?php echo esc_html($meta_obj->get_post_meta_title( 'baths' )); ?></div>
                </div>
            </li>
        <?php } ?>
        
        <?php if ( $meta_obj->check_post_meta_exist('garages') && ($garages = $meta_obj->get_post_meta('garages')) ) { ?>
            <li class="d-flex align-items-center">
                <div class="icon flex-shrink-0 d-flex align-items-center justify-content-center">
                    <i class="flaticon-garage"></i>
                </div>
                <div class="details flex-grow-1">
                    <div class="value"><?php echo trim($garages); ?> <?php echo esc_html($meta_obj->get_post_meta_title( 'garages' )); ?></div>
                </div>
            </li>
        <?php } ?>
        
        <?php do_action('wp-realestate-single-property-overview', $post); ?>
    </ul>
</div>
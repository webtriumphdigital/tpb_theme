<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);
?>
<div class="property-detail-header top-header-detail-property">
    <div class="d-md-flex align-items-center">
        <div class="left-infor">
            <?php justhome_render_breadcrumbs_simple(); ?>
        </div>
        <div class="property-action-detail ms-auto">
            <div class="d-flex align-items-center action-item">
                <?php
                    if ( justhome_get_config('listing_enable_favorite', true) ) {
                        $args = array(
                            'added_icon_class' => 'flaticon-heart-1',
                            'add_icon_class' => 'flaticon-heart-1',
                            'show_text' => true,
                            'add_text' => esc_html__('Save', 'justhome'),
                            'added_text' => esc_html__('Saved', 'justhome'),
                        );
                        WP_RealEstate_Favorite::display_favorite_btn($post->ID, $args);
                    }

                    if ( justhome_get_config('listing_enable_compare', true) ) {
                        $args = array(
                            'added_icon_class' => 'flaticon-before-after',
                            'add_icon_class' => 'flaticon-before-after',
                            'show_text' => true,
                            'add_text' => esc_html__('Compare', 'justhome'),
                            'added_text' => esc_html__('Compared', 'justhome'),
                        );
                        WP_RealEstate_Compare::display_compare_btn($post->ID, $args);
                    }
                ?>
                <?php get_template_part('template-parts/sharebox-property'); ?>
                <?php
                if ( justhome_get_config('property_enable_printer', false) ) {
                    justhome_property_print_btn($post, true);
                }
                ?>
            </div>
        </div>
    </div>
</div>
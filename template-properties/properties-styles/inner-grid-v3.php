<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $post;
?>

<?php do_action( 'wp_realestate_before_property_content', $post->ID ); ?>

<article <?php post_class('map-item property-grid-v3 property-item'); ?> <?php justhome_property_item_map_meta($post); ?> <?php justhome_property_display_gallery($post, 'justhome-property-grid'); ?>>

    <div class="property-thumbnail-wrapper position-relative">
            <?php justhome_property_display_image( $post, 'justhome-property-grid' ); ?>
            <?php
                $featured = justhome_property_display_featured_icon($post, false);
                $labels = justhome_property_display_label($post, false);
                $status = justhome_property_display_status_label($post, false);
                if ( $featured || $labels || $status ) {
                    ?>
                    <div class="top-label d-flex align-items-center">
                        <?php justhome_property_display_status_label($post, true); ?>
                        <?php if ( $featured ) { ?>
                            <?php echo trim($featured); ?>
                        <?php } ?>
                        <?php if ( $labels ) { ?>
                            <?php echo trim($labels); ?>
                        <?php } ?>
                        <div class="ms-auto action-item">
                            <?php 
                            if ( justhome_get_config('listing_enable_favorite', true) ) {
                                $args = array(
                                    'added_icon_class' => 'flaticon-heart',
                                    'add_icon_class' => 'flaticon-heart',
                                );
                                WP_RealEstate_Favorite::display_favorite_btn($post->ID, $args);
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            ?>
    </div>

    <div class="property-information">
		<?php the_title( sprintf( '<h2 class="property-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        <?php justhome_property_display_full_location($post, 'icon'); ?>
        <div class="d-flex align-items-center flex-wrap info-bottom">
            <?php
            $meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);

            $beds = justhome_property_display_meta($post, 'beds', 'flaticon-hotel', false, $meta_obj->get_post_meta_title( 'beds' ));
            $baths = justhome_property_display_meta($post, 'baths', 'flaticon-bathtub', false, $meta_obj->get_post_meta_title( 'baths' ));

            $suffix = wp_realestate_get_option('measurement_unit_area');
            $lot_area = justhome_property_display_meta($post, 'lot_area', ' flaticon-minus-front', false, $suffix);

            if ( $lot_area || $beds || $baths ) {
            ?>
                <div class="property-metas d-flex flex-wrap">
                    <?php
                        echo trim($beds);
                        echo trim($baths);
                        echo trim($lot_area);
                    ?>
                </div>
            <?php } ?>
            <div class="ms-auto"><?php justhome_property_display_price($post, 'no-icon-title', true); ?></div>
        </div>
	</div>
</article><!-- #post-## -->

<?php do_action( 'wp_realestate_after_property_content', $post->ID ); ?>
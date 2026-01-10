<?php
/**
 * Property Grid v5
 * Updated & Safe for Homeo + wp-realestate
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;
$post_id = $post->ID;

do_action( 'wp_realestate_before_property_content', $post_id );
?>

<article <?php post_class( 'map-item property-grid-v3 v5 property-item' ); ?>
    <?php if ( function_exists( 'homeo_property_item_map_meta' ) ) { homeo_property_item_map_meta( $post ); } ?>
    <?php if ( function_exists( 'homeo_property_display_gallery' ) ) { homeo_property_display_gallery( $post, 'homeo-property-grid' ); } ?>>

    <!-- Thumbnail -->
    <div class="property-thumbnail-wrapper position-relative">

        <?php
        if ( function_exists( 'homeo_property_display_image' ) ) {
            homeo_property_display_image( $post, 'homeo-property-grid' );
        }
        ?>

        <?php
        // Labels
        $featured = function_exists('homeo_property_display_featured_icon') ? homeo_property_display_featured_icon( $post, false ) : '';
        $labels   = function_exists('homeo_property_display_label') ? homeo_property_display_label( $post, false ) : '';
        $status   = function_exists('homeo_property_display_status_label') ? homeo_property_display_status_label( $post, false ) : '';

        if ( $featured || $labels || $status ) :
        ?>
            <div class="top-label d-flex align-items-center">
                <?php
                if ( function_exists('homeo_property_display_status_label') ) {
                    homeo_property_display_status_label( $post, true );
                }
                ?>

                <?php echo trim( $featured ); ?>
                <?php echo trim( $labels ); ?>

                <div class="ms-auto action-item">
                    <?php
                    if ( function_exists('homeo_get_config') && homeo_get_config( 'listing_enable_favorite', true ) ) {
                        if ( class_exists( 'WP_RealEstate_Favorite' ) ) {
                            WP_RealEstate_Favorite::display_favorite_btn(
                                $post_id,
                                array(
                                    'added_icon_class' => 'flaticon-heart',
                                    'add_icon_class'   => 'flaticon-heart',
                                )
                            );
                        }
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>

    </div><!-- thumbnail -->

    <!-- Content -->
    <div class="property-information">

        <?php
        the_title(
            sprintf(
                '<h2 class="property-title"><a href="%s" rel="bookmark">',
                esc_url( get_permalink() )
            ),
            '</a></h2>'
        );
        ?>

        <?php
        if ( function_exists( 'homeo_property_display_full_location' ) ) {
            homeo_property_display_full_location( $post, 'icon' );
        }
        ?>

        <div class="d-flex align-items-center flex-wrap info-bottom">

            <?php
            if ( class_exists( 'WP_RealEstate_Property_Meta' ) ) {

                $meta_obj = WP_RealEstate_Property_Meta::get_instance( $post_id );

                $beds  = function_exists('homeo_property_display_meta')
                    ? homeo_property_display_meta( $post, 'beds', 'flaticon-hotel', false, $meta_obj->get_post_meta_title( 'beds' ) )
                    : '';

                $baths = function_exists('homeo_property_display_meta')
                    ? homeo_property_display_meta( $post, 'baths', 'flaticon-bathtub', false, $meta_obj->get_post_meta_title( 'baths' ) )
                    : '';

                $suffix   = function_exists('wp_realestate_get_option') ? wp_realestate_get_option( 'measurement_unit_area' ) : '';
                $lot_area = function_exists('homeo_property_display_meta')
                    ? homeo_property_display_meta( $post, 'lot_area', 'flaticon-minus-front', false, $suffix )
                    : '';

                if ( $beds || $baths || $lot_area ) :
                ?>
                    <div class="property-metas d-flex flex-wrap">
                        <?php
                        echo trim( $beds );
                        echo trim( $baths );
                        echo trim( $lot_area );
                        ?>
                    </div>
                <?php endif;
            }
            ?>

            <div class="ms-auto">
                <?php
                if ( function_exists( 'homeo_property_display_price' ) ) {
                    homeo_property_display_price( $post, 'no-icon-title', true );
                }
                ?>
            </div>

        </div>
    </div><!-- information -->

</article>

<?php do_action( 'wp_realestate_after_property_content', $post_id ); ?>

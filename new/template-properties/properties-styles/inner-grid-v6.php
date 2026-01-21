<?php
/**
 * Property Inner Grid v6
 * Updated & Safe version for Homeo + wp-realestate
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;
$post_id = $post->ID;

do_action( 'wp_realestate_before_property_content', $post_id );
?>

<article <?php post_class( 'map-item property-grid-v6 property-item' ); ?>
    <?php if ( function_exists( 'homeo_property_item_map_meta' ) ) { homeo_property_item_map_meta( $post ); } ?>>

    <div class="top-info">

        <!-- Thumbnail -->
        <div class="property-thumbnail-wrapper flex-middle justify-content-center">

            <?php
            if ( function_exists( 'homeo_property_display_image' ) ) {
                homeo_property_display_image( $post, 'homeo-property-grid' );
            }
            ?>

            <?php
            // Top labels
            $featured     = function_exists('homeo_property_display_featured_icon') ? homeo_property_display_featured_icon( $post, false ) : '';
            $status_label = function_exists('homeo_property_display_status_label') ? homeo_property_display_status_label( $post, false ) : '';
            $labels       = function_exists('homeo_property_display_label') ? homeo_property_display_label( $post, false ) : '';

            if ( $featured || $status_label || $labels ) :
            ?>
                <div class="top-label">
                    <?php echo trim( $status_label ); ?>
                    <?php echo trim( $featured ); ?>
                    <?php echo trim( $labels ); ?>
                </div>
            <?php endif; ?>
			
            <!-- Bottom price + actions -->
            <div class="bottom-label flex-middle">
                <?php
                if ( function_exists( 'homeo_property_display_price' ) ) {
                    homeo_property_display_price( $post, 'no-icon-title', true );
                }
                ?>

                <div class="ali-right">
                    <?php
                    /* if ( function_exists('homeo_get_config') && homeo_get_config( 'listing_enable_favorite', true ) ) {
                        if ( class_exists( 'WP_RealEstate_Favorite' ) ) {
                            WP_RealEstate_Favorite::display_favorite_btn( $post_id );
                        }
                    }

                    if ( function_exists('homeo_get_config') && homeo_get_config( 'listing_enable_compare', true ) ) {
                        if ( class_exists( 'WP_RealEstate_Compare' ) ) {
                            WP_RealEstate_Compare::display_compare_btn( $post_id, array(
                                'added_icon_class' => 'flaticon-transfer-1',
                                'add_icon_class'   => 'flaticon-transfer-1',
                            ));
                        }
                    } */
                    ?>
                </div>
            </div>

        </div><!-- thumbnail -->

        <!-- Content -->
        <div class="property-information">

            <?php
            if ( function_exists( 'homeo_property_display_type' ) ) {
                homeo_property_display_type( $post, 'no-icon-title', true );
            }
            ?>

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

            <?php
            // Property metas (beds, baths, area)
            if ( class_exists( 'WP_RealEstate_Property_Meta' ) ) {

                $meta_obj = WP_RealEstate_Property_Meta::get_instance( $post_id );

//                 $suffix   = function_exists('wp_realestate_get_option') ? wp_realestate_get_option( 'measurement_unit_area' ) : '';
//                 $beds     = function_exists('homeo_property_display_meta') ? homeo_property_display_meta( $post, 'beds', '', $meta_obj->get_post_meta_title( 'beds' ) . ':' ) : '';
//                 $baths    = function_exists('homeo_property_display_meta') ? homeo_property_display_meta( $post, 'baths', '', $meta_obj->get_post_meta_title( 'baths' ) . ':' ) : '';
//                 $lot_area = function_exists('homeo_property_display_meta') ? homeo_property_display_meta( $post, 'lot_area', '', $suffix ? $suffix . ':' : '' ) : '';

		$lot_area = homeo_property_display_meta($post, 'lot_area');
		$beds = homeo_property_display_meta($post, 'beds');
		$baths = homeo_property_display_meta($post, 'baths');
		
                if ( $beds || $baths || $lot_area ) :
                ?>
                    <div class="property-metas flex-middle flex-wrap">
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
                <?php endif;
            }
            ?>

        </div><!-- information -->

    </div><!-- top-info -->

</article>

<?php do_action( 'wp_realestate_after_property_content', $post_id ); ?>

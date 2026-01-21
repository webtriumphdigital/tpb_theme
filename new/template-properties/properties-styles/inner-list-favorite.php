<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

?>

<?php do_action( 'wp_realestate_before_property_content', $post->ID ); ?>

<article <?php post_class('map-item property-item my-properties-item property-item-favorite property-favorite-wrapper'); ?>>
    <div class="flex-middle">

        <div class="property-thumbnail-wrapper flex-middle justify-content-center">
            <?php homeo_property_display_image( $post, 'homeo-property-list' ); ?>
            <div class="top-label">
                <?php $status_label = homeo_property_display_status_label($post, true); ?>
            </div>
        </div>

        <div class="inner flex-middle">
            <div class="property-information">
                <?php the_title( sprintf( '<h2 class="entry-title property-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
        
                <?php homeo_property_display_full_location($post, 'icon'); ?>
                <?php homeo_property_display_price($post, 'no-icon-title', true); ?>
                
                <?php
                $meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);
                
                $lot_area = homeo_property_display_meta($post, 'lot_area');
                $beds = homeo_property_display_meta($post, 'beds');
                $baths = homeo_property_display_meta($post, 'baths');
                
                if ( $lot_area || $beds || $baths ) {
                ?>
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
                <?php } ?>
            </div>
            <div class="ali-right">
                <a href="javascript:void(0)" class="btn-remove-property-favorite btn-action-icon btn-action-lg" data-property_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-realestate-remove-property-favorite-nonce' )); ?>"><i class="flaticon-garbage"></i></a>
            </div>
        </div>
    </div>
</article><!-- #post-## -->
<?php do_action( 'wp_realestate_after_property_content', $post->ID ); ?>
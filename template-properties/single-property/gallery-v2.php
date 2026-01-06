<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);

$gallery = $meta_obj->get_post_meta( 'gallery' );
?>
<div class="property-detail-gallery v2">
<?php
if ( has_post_thumbnail() || ($gallery && is_array($gallery)) ) {
    $gallery_size = !empty($gallery_size) ? $gallery_size : '930x550';
    $gallery_second_size = !empty($gallery_second_size) ? $gallery_second_size : '145x110';
?>
    <div class="gallery-property-main-detail position-relative">
        <div class="slick-carousel slick-carousel-gallery-main no-gap" data-carousel="slick" data-items="1" data-medium="1" data-small="1" data-smallest="1" data-pagination="false" data-nav="true" data-autoplay="false" data-slickparent="true">
            <?php if ( has_post_thumbnail() ) {
                $thumbnail_id = get_post_thumbnail_id($post);
            ?>
                <div class="item">
                    <a href="<?php echo esc_url( get_the_post_thumbnail_url($post, 'full') ); ?>" data-elementor-lightbox-slideshow="justhome-gallery" class="p-popup-image">
                        <?php echo justhome_get_attachment_thumbnail($thumbnail_id, $gallery_size);?>
                    </a>
                </div>
            <?php } ?>

            <?php
            if ( $gallery && is_array($gallery) ) {
                foreach ( $gallery as $id => $src ) { ?>
                    <div class="item">
                        <a href="<?php echo esc_url( $src ); ?>" data-elementor-lightbox-slideshow="justhome-gallery" class="p-popup-image">
                            <?php echo justhome_get_attachment_thumbnail( $id, $gallery_size );?>
                        </a>
                    </div>
                <?php }
            } ?>
        </div>
        <div class="gallery-metas d-flex">
            <?php justhome_property_display_status_label($post, true); ?>
            <?php justhome_property_display_featured_icon($post, true); ?>
            <?php justhome_property_display_label($post, true); ?>
        </div>
    </div>
    <div class="slick-carousel gap-10 bottom-gallery" data-carousel="slick" data-items="6" data-large="6" data-medium="5" data-small="3" data-smallest="3" data-pagination="false" data-nav="false" data-autoplay="false" data-asnavfor=".slick-carousel-gallery-main" data-slidestoscroll="1" data-focusonselect="true">
        <?php if ( has_post_thumbnail() ) {
            $thumbnail_id = get_post_thumbnail_id($post); ?>
            <div class="item">
                <?php echo justhome_get_attachment_thumbnail($thumbnail_id, $gallery_second_size); ?>
            </div>
        <?php } ?>

        <?php
        if ( $gallery && is_array($gallery) ) {
            foreach ( $gallery as $id => $src ) { ?>
                <div class="item">
                   <?php echo justhome_get_attachment_thumbnail( $id, $gallery_second_size ); ?>
                </div>
            <?php }
        } ?>
    </div>

<?php } ?>

</div>
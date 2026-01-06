<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;

$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);
if ( $meta_obj->check_post_meta_exist('floor_plans_group') && ($floor_plans = $meta_obj->get_post_meta('floor_plans_group')) ) {
?>

    <div class="property-detail-floor-plans">
        <h3 class="title"><?php esc_html_e('Floor Plans', 'justhome'); ?></h3>
        <div class="accordion" id="accordion-floor_plans">
        <?php if(!empty($floor_plans)) { ?>
            <div class="floor-item">
                <div class="nav nav-tabs-floor" role="tablist">
                    <?php $i = 1; foreach ($floor_plans as $floor_plan) { ?>
                        <?php if ( !empty($floor_plan['name']) ) { ?>
                            <button class="nav-link <?php echo esc_attr($i == 1 ? 'active' : ''); ?>" data-bs-toggle="tab" data-bs-target="#floor_plan-<?php echo esc_attr($i); ?>" type="button" role="tab" aria-selected="<?php echo esc_attr($i == 1 ? 'true' : 'false'); ?>">
                                <?php if ( !empty($floor_plan['name']) ) { ?>
                                    <?php echo trim($floor_plan['name']); ?>
                                <?php } ?>
                            </button>
                        <?php } ?>
                    <?php $i++; } ?>
                </div>
                <div class="tab-content">
                    <?php $i = 1; foreach ($floor_plans as $floor_plan) { ?>
                        <?php if ( !empty($floor_plan['image_id']) || !empty($floor_plan['content']) ) { ?>
                            <div class="tab-pane fade <?php echo esc_attr($i == 1 ? 'show active' : ''); ?>" id="floor_plan-<?php echo esc_attr($i); ?>">
                                <div class="content-accordion">
                                    <div class="metas-floor ms-auto d-flex align-items-center flex-wrap">
                                        <?php if ( !empty($floor_plan['rooms']) ) { ?>
                                            <div class="rooms">
                                                <i class="flaticon-hotel"></i>
                                                <div class="subtitle"><?php esc_html_e('Rooms:', 'justhome'); ?></div> 
                                                <?php echo trim($floor_plan['rooms']); ?>
                                            </div>
                                        <?php } ?>
                                        <?php if ( !empty($floor_plan['baths']) ) { ?>
                                            <div class="baths">
                                                <i class="flaticon-bathtub"></i>
                                                <div class="subtitle"><?php esc_html_e('Bathrooms:', 'justhome'); ?></div>
                                                <?php echo trim($floor_plan['baths']); ?>
                                            </div>
                                        <?php } ?>
                                        <?php if ( !empty($floor_plan['size']) ) { ?>
                                            <div class="size">
                                                <i class="flaticon-minus-front"></i>
                                                <div class="subtitle"><?php esc_html_e('Size:', 'justhome'); ?></div> 
                                                <?php echo trim($floor_plan['size']); ?>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <?php if ( !empty($floor_plan['content']) ) { ?>
                                        <div class="content"><?php echo trim($floor_plan['content']); ?></div>
                                    <?php } ?>

                                    <?php if ( !empty($floor_plan['image_id']) ) { ?>
                                        <div class="image">
                                            <a href="<?php echo esc_url($floor_plan['image']); ?>">
                                                <?php echo wp_get_attachment_image($floor_plan['image_id'], 'large'); ?>
                                            </a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    <?php $i++; } ?>
                </div>
            </div>
        <?php } ?>
        </div>
        <?php do_action('wp-realestate-single-property-floor-plans', $post); ?>
    </div>
<?php }
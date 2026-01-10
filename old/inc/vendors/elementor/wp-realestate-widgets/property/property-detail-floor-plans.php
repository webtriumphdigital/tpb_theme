<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Floor_Plans extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_floor_plans';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Floor Plans', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-property-detail-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Settings', 'justhome' ),
			]
		);
		
		$this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'justhome' ),
            ]
        );

		$this->add_control(
			'layout',
			[
				'label' => esc_html__( 'Layout', 'justhome' ),
				'type' => Elementor\Controls_Manager::SELECT,
				'default' => 'tabs',
				'options' => [
					'tabs' => esc_html__( 'Tabs', 'justhome' ),
					'accordion' => esc_html__( 'Accordion', 'justhome' ),
				],
			]
		);

		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'justhome' ),
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        extract( $settings );
        if ( justhome_is_property_single_page() ) {
        	global $post;
			$post_id = get_the_ID();
		} else {
			$args = array(
				'limit' => 1,
				'fields' => 'ids',
			);
			$properties = justhome_get_properties($args);
			if ( !empty($properties->posts) ) {
				$post_id = $properties->posts[0];
				$post = get_post($post_id);
			}
		}
		if ( !empty($post) ) {
	        ?>
	        <?php if ( $floor_plans ) { ?>
                            <h2 class="title-related-properties"><?php echo esc_html($title); ?></h2>
                        <?php } ?>
			<div class="property-detail-floor-plans <?php echo esc_attr($el_class); ?>">
				<div class="floor-item">
					<?php
					$_id = justhome_random_key();
					$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);
					if ( $meta_obj->check_post_meta_exist('floor_plans_group') && ($floor_plans = $meta_obj->get_post_meta('floor_plans_group')) ) {
						if ( $layout == 'tabs' ) {
							?>
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
							<?php
						} else { ?>
					        <div class="accordion" id="accordion-floor_plans">
						        <?php $i = 1; foreach ($floor_plans as $floor_plan) { ?>
						            <div class="accordion-item floor-item">
						                <div class="accordion-header">
						                    <a class="accordion-button <?php echo esc_attr($i == 1 ? '' : 'collapsed'); ?>" data-bs-toggle="collapse" data-bs-target="#collapse-floor_plan<?php echo esc_attr($i); ?>" href="#collapse-floor_plan<?php echo esc_attr($i); ?>">
						                        <div class="w-100 d-md-flex align-items-center">
						                            <?php if ( !empty($floor_plan['name']) ) { ?>
						                            <h3><?php echo trim($floor_plan['name']); ?></h3>
						                            <?php } ?>

						                            <div class="metas ms-auto d-flex align-items-center justify-content-end">
						                                <?php if ( !empty($floor_plan['rooms']) ) { ?>
						                                    <div class="rooms"><span class="subtitle"><?php esc_html_e('Rooms:', 'justhome'); ?></span> <?php echo trim($floor_plan['rooms']); ?></div>
						                                <?php } ?>
						                                <?php if ( !empty($floor_plan['baths']) ) { ?>
						                                    <div class="baths"><span class="subtitle"><?php esc_html_e('Baths:', 'justhome'); ?></span> <?php echo trim($floor_plan['baths']); ?></div>
						                                <?php } ?>
						                                <?php if ( !empty($floor_plan['size']) ) { ?>
						                                    <div class="size"><span class="subtitle"><?php esc_html_e('Size:', 'justhome'); ?></span> <?php echo trim($floor_plan['size']); ?></div>
						                                <?php } ?>
						                            </div>
						                        </div>
						                    </a>
						                </div>
						                <div id="collapse-floor_plan<?php echo esc_attr($i); ?>" class="accordion-collapse collapse <?php echo esc_attr($i == 1 ? 'show' : ''); ?>">
						                    <?php if ( !empty($floor_plan['image_id']) || !empty($floor_plan['content']) ) { ?>
						                        <div class="content-accordion">
						                            <?php if ( !empty($floor_plan['image_id']) ) { ?>
						                                <div class="image">
						                                    <a href="<?php echo esc_url($floor_plan['image']); ?>">
						                                        <?php echo wp_get_attachment_image($floor_plan['image_id'], 'large'); ?>
						                                    </a>
						                                </div>
						                            <?php } ?>
						                            <?php if ( !empty($floor_plan['content']) ) { ?>
						                                <div class="content"><?php echo trim($floor_plan['content']); ?></div>
						                            <?php } ?>
						                        </div>
						                    <?php } ?>
						                </div>
						            </div>

						        <?php $i++; } ?>
					        </div>
					        <?php
					    }
				        do_action('wp-realestate-single-property-floor-plans', $post);
				    } ?>
				</div>
			</div>
			<?php
	    }
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Floor_Plans );

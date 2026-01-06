<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Price extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_price';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Price', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-property-detail-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Price', 'justhome' ),
			]
		);

        $this->add_responsive_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'justhome' ),
                'type' => Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'justhome' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'justhome' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'justhome' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justified', 'justhome' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .property-detail-price' => 'text-align: {{VALUE}};',
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

		$this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Style', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'color',
            [
                'label' => esc_html__( 'Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .property-detail-price, {{WRAPPER}} .property-price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Typography', 'justhome' ),
                'name' => 'price_typography',
                'selector' => '{{WRAPPER}} .property-price',
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
			$price_avg = '';
			$meta_obj = WP_RealEstate_Property_Meta::get_instance($post_id);
			$symbol = wp_realestate_get_option('custom_symbol', '$');
			$price = $meta_obj->get_post_meta( 'price' );
			$price_custom = $meta_obj->get_post_meta( 'price_custom' );
			$home_area = $meta_obj->get_post_meta('home_area');

			if( !empty($price) && empty($price_custom) && !empty($home_area) ){
			    $price_avg = $price / $home_area;
			}
			
	        ?>
			<div class="property-detail-price <?php echo esc_attr($el_class); ?>">
				<?php if(!empty($price_avg)){ ?>
	                <div class="avg-price">
	                    <?php echo WP_RealEstate_Price::format_price($price_avg) ; ?> / <?php echo wp_realestate_get_option('measurement_unit_area'); ?>
	                </div>
	            <?php } ?>
				<?php justhome_property_display_price($post); ?>
			</div>
			<?php
	    }
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Price );

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Featured_Label extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_featured_label';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Featured Label', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-property-detail-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Featured Label', 'justhome' ),
			]
		);

		$this->add_control(
            'title',
            [
                'label'         => esc_html__( 'Title', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'   => 'Featured',
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
			$meta_obj = WP_RealEstate_Property_Meta::get_instance($post_id);
			$featured = $meta_obj->get_post_meta( 'featured' );
			if ( $featured ) {
	        ?>
			<span class="featured-property <?php echo esc_attr($el_class); ?>">
				<?php echo trim($title); ?>
			</span>
			<?php
			}
	    }
	}
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Featured_Label );

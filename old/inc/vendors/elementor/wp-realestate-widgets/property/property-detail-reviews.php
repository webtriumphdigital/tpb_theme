<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Reviews extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_reviews';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Reviews', 'justhome' );
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
				setup_postdata( $GLOBALS['post'] =& $post );
			}
		}
		if ( !empty($post) ) {
	        ?>
			<div class="property-detail-reviews <?php echo esc_attr($el_class); ?>">
				<?php if ( WP_RealEstate_Review::review_enable() ) { ?>
						<?php comments_template(); ?>
				<?php } ?>
			</div>
			<?php
			if ( !justhome_is_property_single_page() ) {
				wp_reset_postdata();
			}
	    }
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Reviews );

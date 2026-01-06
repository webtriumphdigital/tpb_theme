<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Location extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_location';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Maps Location', 'justhome' );
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
			}
		}
		if ( !empty($post) ) {
			$latitude = WP_RealEstate_Property::get_post_meta( $post->ID, 'map_location_latitude', true );
			$longitude = WP_RealEstate_Property::get_post_meta( $post->ID, 'map_location_longitude', true );
	        ?>
			<div class="property-detail-location <?php echo esc_attr($el_class); ?>">

				<div class="widget-title-wrapper d-md-flex align-items-center">
		    		<h3 class="title"><?php esc_html_e('Location', 'justhome'); ?></h3>
		    		<div class="ms-auto">
		    			<?php justhome_property_display_full_location($post, true, true); ?>
		    		</div>
		    	</div>
				<div class="single-property-google-maps-wrapper">
				    <div id="single-property-google-maps" class="single-property-map" data-latitude="<?php echo esc_attr($latitude); ?>" data-longitude="<?php echo esc_attr($longitude); ?>"></div>
				</div>
			</div>
			<?php
	    }
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Location );

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Agency_Location extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_agency_location';
	}

	public function get_title() {
		return esc_html__( 'Agency Details:: Maps Location', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-agency-detail-elements' ];
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
        if ( justhome_is_agency_single_page() ) {
        	global $post;
			$post_id = get_the_ID();
		} else {
			$args = array(
				'limit' => 1,
				'fields' => 'ids',
			);
			$agencies = justhome_get_agencies($args);
			if ( !empty($agencies->posts) ) {
				$post_id = $agencies->posts[0];
				$post = get_post($post_id);
			}
		}
		if ( !empty($post) ) {
			$latitude = WP_RealEstate_Agency::get_post_meta( $post->ID, 'map_location_latitude', true );
			$longitude = WP_RealEstate_Agency::get_post_meta( $post->ID, 'map_location_longitude', true );
	        ?>
			<div class="agency-detail-location <?php echo esc_attr($el_class); ?>">

			    <div id="single-property-google-maps" class="single-property-map single-agent-map" data-latitude="<?php echo esc_attr($latitude); ?>" data-longitude="<?php echo esc_attr($longitude); ?>"></div>
			</div>
			<?php
	    }
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Agency_Location );

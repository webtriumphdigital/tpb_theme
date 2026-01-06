<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Video extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_video';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Video', 'justhome' );
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
	        $meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);

			$video = $meta_obj->get_post_meta('video');
			?>
			<?php if ( $video ) { ?>
                            <h2 class="title-related-properties"><?php echo esc_html($title); ?></h2>
                        <?php } ?>
			<?php if ( ! empty( $video ) ) : ?>
				<div class="property-section property-video <?php echo esc_attr($el_class); ?>">
					<div class="video-embed-wrapper">
						<?php
						if ( strpos($video, 'www.aparat.com') !== false ) {
						    $path = parse_url($video, PHP_URL_PATH);
							$matches = preg_split("/\/v\//", $path);
							
							if ( !empty($matches[1]) ) {
							    $output = '<iframe src="http://www.aparat.com/video/video/embed/videohash/'. $matches[1] . '/vt/frame"
							                allowFullScreen="true"
							                webkitallowfullscreen="true"
							                mozallowfullscreen="true"
							                height="720"
							                width="1280" >
							                </iframe>';

							    echo trim($output);
							}
					   	} else {
							echo apply_filters( 'the_content', '[embed width="1280" height="720"]' . esc_attr( $video ) . '[/embed]' );
						}

						?>
					</div>

					<?php do_action('wp-realestate-single-property-video', $post); ?>
				</div>
			<?php endif;
	    }
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Video );

<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Features extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_features';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Features', 'justhome' );
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
	        
			$amenities = get_the_terms($post->ID, 'property_amenity');
			?>

			<?php if ( ! empty( $amenities ) ) : ?>
			    <div class="property-section property-amenities <?php echo esc_attr($el_class); ?>">
			        <ul class="columns-gap">
			            <?php foreach ( $amenities as $amenity ) : ?>
			                <li class="yes">
			                    <?php
			                        $icon_font_value = get_term_meta( $amenity->term_id, 'apus_icon_font', true );
			                        if ( !empty($icon_font_value) ) {
			                            ?>
			                            <i class="<?php echo esc_attr($icon_font_value); ?>"></i>
			                            <?php
			                        }
			                        echo esc_html( $amenity->name );
			                    ?>  
			                </li>
			            <?php endforeach; ?>
			        </ul>

			        <?php do_action('wp-realestate-single-property-amenities', $post); ?>
			    </div><!-- /.property-amenities -->
			<?php endif;
			
	    }
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Features );

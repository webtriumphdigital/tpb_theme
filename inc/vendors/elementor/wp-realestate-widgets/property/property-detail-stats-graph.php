<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Stats_Graph extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_stats_graph';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Stats Graph', 'justhome' );
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
            'show_stats_graph_for',
            [
                'label' => esc_html__( 'Show Stats for', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
		            '' => esc_html__('All', 'justhome'),
		            'registered' => esc_html__('Registered user', 'justhome'),
		            'author' => esc_html__('Author + Administrator', 'justhome'),
		        ),
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
	        if ( $show_stats_graph_for == 'registered' ) {
			    if ( !is_user_logged_in() ) {
			        return;
			    }
			} elseif ( $show_stats_graph_for == 'author' ) {
			    if ( !is_user_logged_in() ) {
			        return;
			    }
			    $user = wp_get_current_user();
			    if ( !in_array('administrator', $user->roles) && $post->post_author !== $user->ID ) {
			        return;
			    }
			}
			?>
			<div class="property-section property-page_views <?php echo esc_attr($el_class); ?>">
				<div class="page_views-wrapper">
					<canvas id="property_chart_wrapper" data-property_id="<?php echo esc_attr($post->ID); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-realestate-property-chart-nonce' )); ?>"></canvas>
				</div>
			</div>
			<?php
	    }
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Stats_Graph );

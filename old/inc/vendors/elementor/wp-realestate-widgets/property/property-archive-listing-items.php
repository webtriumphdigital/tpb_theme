<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Property_Archive_Listing_Items extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_property_archive_listing_items';
	}

	public function get_title() {
		return esc_html__( 'Property Archive:: Property Items', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-property-archive-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Settings', 'justhome' ),
			]
		);

		$this->add_control(
            'property_item_style',
            [
                'label' => esc_html__( 'Property Item Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid Default', 'justhome'),
                    'grid-v1' => esc_html__('Grid V1', 'justhome'),
                    'list' => esc_html__('List Default', 'justhome'),
                    'list-v1' => esc_html__('List v1', 'justhome'),
                ),
                'default' => 'grid',
            ]
        );

        $columns = range( 1, 12 );
        $columns = array_combine( $columns, $columns );

        $this->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $columns,
                'frontend_available' => true,
                'default' => 3,
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

        $args = array(
        	'settings' => $settings,
        );

        if ( Elementor\Plugin::$instance->editor->is_edit_mode() ) {
        	$query_args = array(
				'post_type' => 'property',
			    'post_status' => 'publish',
			    'post_per_page' => wp_realestate_get_option('number_properties_per_page'),
			);

			$properties = WP_RealEstate_Query::get_posts($query_args);
			$args['properties'] = $properties;
        } else {
	        global $justhome_properties;
	        $args['properties'] = $justhome_properties;
	    }

		?>
		
		<div class="element-properties-listing-wrapper <?php esc_attr($el_class); ?>">
			<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/property/archive-inner', $args); ?>
		</div>
		<?php
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Property_Archive_Listing_Items );

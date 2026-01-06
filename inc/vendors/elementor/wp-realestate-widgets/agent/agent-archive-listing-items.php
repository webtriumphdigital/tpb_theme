<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Agent_Archive_Listing_Items extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_agent_archive_listing_items';
	}

	public function get_title() {
		return esc_html__( 'Agent Archive:: Agent Items', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-agent-archive-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Settings', 'justhome' ),
			]
		);

		$this->add_control(
            'agent_item_style',
            [
                'label' => esc_html__( 'Agent Item Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid Default', 'justhome'),
                    'list' => esc_html__('List Default', 'justhome'),
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
				'post_type' => 'agent',
			    'post_status' => 'publish',
			    'posts_per_page' => 4,
			);

			$agents = WP_RealEstate_Query::get_posts($query_args);
			$args['agents'] = $agents;
        } else {
	        global $justhome_agents;
	        $args['agents'] = $justhome_agents;
	    }

		?>
		
		<div class="element-agents-listing-wrapper <?php esc_attr($el_class); ?>">
			<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/agent/archive-inner', $args); ?>
		</div>
		<?php
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Agent_Archive_Listing_Items );

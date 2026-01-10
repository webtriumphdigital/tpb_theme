<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Agent_Archive_Pagination extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_agent_archive_pagination';
	}

	public function get_title() {
		return esc_html__( 'Agent Archive:: Pagination', 'justhome' );
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
            'pagination_type',
            [
                'label' => esc_html__( 'Pagination Type', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'default' => esc_html__('Default', 'justhome'),
		            'loadmore' => esc_html__('Load More Button', 'justhome'),
		            'infinite' => esc_html__('Infinite Scrolling', 'justhome'),
                ),
                'default' => 'default',
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
        
		global $justhome_agents;
		$args = array(
        	'agents' => $justhome_agents,
        	'settings' => $settings,
        );
		?>
		<div class="elements-agents-pagination-wrapper <?php echo esc_attr($el_class); ?>">
			<?php echo WP_RealEstate_Template_Loader::get_template_part('loop/agent/pagination', $args); ?>
		</div>
		<?php
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Agent_Archive_Pagination );

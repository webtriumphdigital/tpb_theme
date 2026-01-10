<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Blog_Single_Description extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_blog_single_description';
	}

	public function get_title() {
		return esc_html__( 'Blog Single:: Description', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'justhome' ),
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
                'name' => 'des_typography',
                'selector' => '{{WRAPPER}}',
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        extract( $settings );

        if ( is_singular('post') ) {
        	?>
			<div class="blog-single-description <?php echo esc_attr($el_class); ?>">
				<?php the_content(); ?>
			</div>
			<?php
		} else {
			?>
			<div class="blog-single-description <?php echo esc_attr($el_class); ?>">
				Fames massa tortor sit nisl sit. Duis nulla tempus quisque et diam condimentum nisl. Rhoncus quisque elementum nulla lorem at turpis vitae quisque. Vulputate duis vel et odio hendrerit magna. Nec lacus dui egestas sit. Vulputate tincidunt viverra viverra etiam porta facilisis. Diam dui euismod eget donec. Pharetra leo sed felis urna. At a viverra urna elementum tristique ac integer pretium. Vel tincidunt sed mi nulla lectus sagittis.
			</div>
			<?php
		}
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Blog_Single_Description );

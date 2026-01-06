<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Blog_Single_Nav extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_blog_single_nav';
	}

	public function get_title() {
		return esc_html__( 'Blog Single:: Navigation', 'justhome' );
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
	}

	protected function render() {
		$settings = $this->get_settings();

        extract( $settings );

		?>
		<div class="blog-single-navigation <?php echo esc_attr($el_class); ?>">
			<?php  
				the_post_navigation( array(
		            'next_text' => 
		                '<div class="inner d-flex justify-content-end"><div class="link_info clearfix flex-grow-1">'.
		                '<div class="navi">' . esc_html__( 'Next Post', 'justhome' ) . '</div>'.
		                '<span class="title-direct">%title</span></div><i class="ti-angle-right"></i></div>',
		            'prev_text' => 
		                '<div class="inner d-flex"><i class="ti-angle-left"></i>'.
		                '<div class="link_info clearfix flex-grow-1"><div class="navi">' . esc_html__( 'Previous Post', 'justhome' ) . '</div>'.
		                '<span class="title-direct">%title</span></div></div>',
		        ) );
			?>
		</div>
		<?php
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Blog_Single_Nav );

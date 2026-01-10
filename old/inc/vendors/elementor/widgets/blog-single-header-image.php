<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Blog_Single_Header_Image extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_blog_single_header_image';
	}

	public function get_title() {
		return esc_html__( 'Blog Single:: Image Header', 'justhome' );
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

        if ( is_singular('post') ) {
        	global $post;
		} else {
			$args = array(
	            'post_type' => 'post',
	            'post_status' => 'publish',
	            'posts_per_page' => 1,
	        );
        	$loop = new WP_Query($args);
			if ( !empty($loop->posts) ) {
				$post = $loop->posts[0];
			}
		}
		if ( !empty($post) ) {
			if ( has_post_thumbnail() ) {
				$image_url = get_the_post_thumbnail_url($post, 'full');
			}
			?>
			<?php if(has_post_thumbnail()) { ?>
		        <div class="entry-thumb-header text-center">
		            <img src="<?php echo esc_attr($image_url); ?>" alt="">
		        </div>
		    <?php } ?>
			<?php
		}
	}
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Blog_Single_Header_Image );

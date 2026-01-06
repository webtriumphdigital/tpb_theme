<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Blog_Single_Tags extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_blog_single_tags';
	}

	public function get_title() {
		return esc_html__( 'Blog Single:: Tags', 'justhome' );
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
        	$post_id = $post->ID;
		} else {
			$args = array(
	            'post_type' => 'post',
	            'post_status' => 'publish',
	            'posts_per_page' => 1,
	            'fields' => 'ids',
	        );
        	$loop = new WP_Query($args);
			if ( !empty($loop->posts) ) {
				$post_id = $loop->posts[0];
			}
		}
		if ( !empty($post_id) ) {
		?>
			<div class="blog-single-tags <?php echo esc_attr($el_class); ?>">
				<?php
					justhome_post_tags($post_id);
				?>
			</div>
			<?php
		}
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Blog_Single_Tags );

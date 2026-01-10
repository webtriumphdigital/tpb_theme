<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Blog_Single_Author extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_blog_single_author';
	}

	public function get_title() {
		return esc_html__( 'Blog Single:: Author', 'justhome' );
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
        global $post;
		?>
		<div class="blog-single-author <?php echo esc_attr($el_class); ?>">
			<?php  
				$description = get_the_author_meta( 'description',$post->post_author );
			?>
			<?php if(!empty($description)){ ?>
			<div class="author-info">
				<div class="about-container d-flex align-items-center">
					<div class="avatar-img flex-shrink-0">
						<?php echo justhome_get_avatar( $post->post_author,120 ); ?>
					</div>
					<!-- .author-avatar -->
					<div class="description flex-grow-1">
						<h4 class="author-title">
							<a href="<?php echo esc_url( get_author_posts_url( $post->post_author ) ); ?>">
								<?php the_author_meta( 'display_name', $post->post_author ); ?>
							</a>
						</h4>
						<?php the_author_meta( 'description',$post->post_author ); ?>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
		<?php
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Blog_Single_Author );

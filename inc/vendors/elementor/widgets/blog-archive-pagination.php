<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Blog_Archive_Pagination extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_blog_archive_pagination';
	}

	public function get_title() {
		return esc_html__( 'Blog Archive:: Pagination', 'justhome' );
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
		<div class="blog-posts <?php echo esc_attr($el_class); ?>">
			<?php

			if ( justhome_is_post_archive_page() ) {
				justhome_paging_nav();
		    } else {
				$args = array(
		            'post_type' => 'post',
		            'post_status' => 'publish',
		            'posts_per_page' => get_option('posts_per_page'),
		        );
		        $loop = new WP_Query($args);
		        if ( $loop->have_posts() ) {
		        	$per_page = get_option('posts_per_page');
		        	$total = $loop->max_num_pages;
					justhome_pagination($per_page, $total);
		        }
	    	}

		    ?>
		</div>
		<?php
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Blog_Archive_Pagination );

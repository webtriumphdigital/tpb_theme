<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Blog_Archive_Posts extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_blog_archive_posts';
	}

	public function get_title() {
		return esc_html__( 'Blog Archive:: Posts', 'justhome' );
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
            'item_style',
            [
                'label' => esc_html__( 'Post Item Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid V1', 'justhome'),
                    'grid-v2' => esc_html__('Grid V2', 'justhome'),
                    'list' => esc_html__('List Default', 'justhome'),
                ),
                'default' => 'grid',
            ]
        );

		$this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default' => 'large',
                'separator' => 'none',
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

        if ( $image_size == 'custom' ) {
            if ( $image_custom_dimension['width'] && $image_custom_dimension['height'] ) {
                $thumbsize = $image_custom_dimension['width'].'x'.$image_custom_dimension['height'];
            } else {
                $thumbsize = 'full';
            }
        } else {
            $thumbsize = $image_size;
        }

        $columns = !empty($columns) ? $columns : 3;
        $columns_tablet = !empty($columns_tablet) ? $columns_tablet : 2;
        $columns_mobile = !empty($columns_mobile) ? $columns_mobile : 1;

        $mdcol = 12/$columns;
        $smcol = 12/$columns_tablet;
        $xscol = 12/$columns_mobile;

        
		?>
		<div class="blog-posts <?php echo esc_attr($el_class); ?>">
			<?php
			if ( justhome_is_post_archive_page() ) {
				?>
				<div class="row">
				<?php
		        while ( have_posts() ) : the_post(); ?>
			        <div class="col-xl-<?php echo esc_attr($mdcol); ?> col-md-<?php echo esc_attr($smcol); ?> col-<?php echo esc_attr($xscol); ?>">
			            <?php get_template_part( 'template-posts/loop/inner', $item_style, array('thumbsize' => $thumbsize) ); ?>
			        </div>
			    <?php
				endwhile;
				?>
				</div>
				<?php
		    } else {
		    	$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
				$args = array(
		            'post_type' => 'post',
		            'post_status' => 'publish',
		            'posts_per_page' => get_option('posts_per_page'),
		            'paged' => $paged,
		        );
		        $loop = new WP_Query($args);
		        if ( $loop->have_posts() ) {
		        	?>
					<div class="row">
					<?php
		        	while ( $loop->have_posts() ) : $loop->the_post(); ?>
				        <div class="col-xl-<?php echo esc_attr($mdcol); ?> col-md-<?php echo esc_attr($smcol); ?> col-<?php echo esc_attr($xscol); ?>">
				            <?php get_template_part( 'template-posts/loop/inner', $item_style, array('thumbsize' => $thumbsize) ); ?>
				        </div>
				    <?php
					endwhile;
					?>
					</div>
					<?php
					wp_reset_postdata();
		        }
	    	}
		    ?>
		</div>
		<?php
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Blog_Archive_Posts );

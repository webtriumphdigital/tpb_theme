<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Blog_Single_Header extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_blog_single_header';
	}

	public function get_title() {
		return esc_html__( 'Blog Single:: Header', 'justhome' );
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
            'show_author',
            [
                'label' => esc_html__( 'Show Author', 'justhome' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'justhome' ),
                'label_off' => esc_html__( 'Show', 'justhome' ),
            ]
        );

		$this->add_control(
            'show_category',
            [
                'label' => esc_html__( 'Show Category', 'justhome' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'justhome' ),
                'label_off' => esc_html__( 'Show', 'justhome' ),
            ]
        );

		$this->add_control(
            'show_date',
            [
                'label' => esc_html__( 'Show Date', 'justhome' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'justhome' ),
                'label_off' => esc_html__( 'Show', 'justhome' ),
            ]
        );

		$this->add_control(
            'show_title',
            [
                'label' => esc_html__( 'Show Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'justhome' ),
                'label_off' => esc_html__( 'Show', 'justhome' ),
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
            'section_box_style',
            [
                'label' => esc_html__( 'Style', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_control(
            'author_color',
            [
                'label' => esc_html__( 'Author Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .author' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'category_color',
            [
                'label' => esc_html__( 'Category Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .category a, {{WRAPPER}} .category' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'date_color',
            [
                'label' => esc_html__( 'Date Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .date' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_control(
            'entry_title_color',
            [
                'label' => esc_html__( 'Title Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .entry-title' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_group_control(
			Elementor\Group_Control_Typography::get_type(),
			[
				'label' => esc_html__( 'Title Typography', 'justhome' ),
				'name' => 'typography',
				'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .entry-title',
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
			?>
			<div class="entry-content-detail header-info-blog <?php echo esc_attr($el_class); ?>">
				<?php if ( $show_title ) { ?>
				    <h1 class="detail-title">
				    	<?php echo get_the_title($post); ?>
				    </h1>
				<?php } ?>
				<div class="top-detail-info d-flex flex-wrap align-items-center">
					<?php if ( $show_author ) { ?>
			        	<div class="author">
				            <?php the_author_meta( 'display_name', $post->post_author ); ?>
				        </div>
			        <?php } ?>
			        <?php if ( $show_category ) { ?>
			        	<div class="category">
				            <?php justhome_post_categories($post); ?>
				        </div>
			        <?php } ?>
			        <?php if ( $show_date ) { ?>
				        <div class="date">
				            <?php the_time( get_option('date_format', 'd M, Y') ); ?>
				        </div>
			        <?php } ?>
				</div>
			</div>
			<?php
		}
	}
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Blog_Single_Header );

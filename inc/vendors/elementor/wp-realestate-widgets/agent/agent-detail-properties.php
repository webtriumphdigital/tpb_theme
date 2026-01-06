<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Agent_Properties extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_agent_properties';
	}

	public function get_title() {
		return esc_html__( 'Agent Details:: Properties', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-agent-detail-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Properties', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title here', 'justhome' ),
            ]
        );

		$this->add_control(
            'limit',
            [
                'label' => esc_html__( 'Limit', 'justhome' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'input_type' => 'number',
                'description' => esc_html__( 'Limit agents to display', 'justhome' ),
                'default' => 4
            ]
        );

        $this->add_control(
            'view_all_text',
            [
                'label'         => esc_html__( 'View All Text', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'default'   => 'View All',
            ]
        );

        $this->add_control(
            'view_all_icon',
            [
                'label' => esc_html__( 'View All Icon', 'justhome' ),
                'type' => Elementor\Controls_Manager::ICONS,
            ]
        );

		$this->add_control(
            'property_item_style',
            [
                'label' => esc_html__( 'Agent Item Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid Default', 'justhome'),
                ),
                'default' => 'grid'
            ]
        );

		$this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid', 'justhome'),
                    'carousel' => esc_html__('Carousel', 'justhome'),
                ),
                'default' => 'grid'
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

        $this->add_responsive_control(
            'slides_to_scroll',
            [
                'label' => esc_html__( 'Slides to Scroll', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'description' => esc_html__( 'Set how many slides are scrolled per swipe.', 'justhome' ),
                'options' => $columns,
                'condition' => [
                    'columns!' => '1',
                    'layout_type' => 'carousel',
                ],
                'frontend_available' => true,
                'default' => 1,
            ]
        );

        $this->add_control(
            'rows',
            [
                'label' => esc_html__( 'Rows', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'number',
                'placeholder' => esc_html__( 'Enter your rows number here', 'justhome' ),
                'default' => 1,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label'         => esc_html__( 'Show Navigation', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'         => esc_html__( 'Show Pagination', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );


        $this->add_control(
            'slider_autoplay',
            [
                'label'         => esc_html__( 'Autoplay', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'justhome' ),
                'label_off'     => esc_html__( 'No', 'justhome' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label'         => esc_html__( 'Infinite Loop', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'justhome' ),
                'label_off'     => esc_html__( 'No', 'justhome' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'position_nav',
            [
                'label' => esc_html__( 'Position Nav', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'justhome'),
                    'nav-bottom' => esc_html__('Bottom', 'justhome'),
                ),
                'default' => '',
                'condition' => [
                    'layout_type' => 'carousel',
                ],
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
                'label' => esc_html__( 'Title', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        extract( $settings );
        if ( justhome_is_agent_single_page() ) {
        	global $post;
			$post_id = get_the_ID();
		} else {
			$args = array(
				'limit' => 1,
				'fields' => 'ids',
			);
			$agents = justhome_get_agents($args);
			if ( !empty($agents->posts) ) {
				$post_id = $agents->posts[0];
				$post = get_post($post_id);
			}
		}

		if ( !empty($post) ) {
				if ( get_query_var( 'paged' ) ) {
                    $paged = get_query_var( 'paged' );
                } elseif ( get_query_var( 'page' ) ) {
                    $paged = get_query_var( 'page' );
                } else {
                    $paged = 1;
                }
                $bcol = 12/$columns;
                $loop = WP_RealEstate_Query::get_agents_properties(array(
                    'agent_ids' => array($post->ID),
                    'post_per_page' => $limit,
                    'paged' => $paged
                ));
				if( $loop->have_posts() ):
                    $user_id = WP_RealEstate_User::get_user_by_agent_id($post_id);
                    $properties_url = WP_RealEstate_Mixes::get_properties_page_url();
                    $properties_url = add_query_arg( 'filter-author', $user_id, $properties_url );
				        $columns = !empty($columns) ? $columns : 3;
			            $columns_tablet = !empty($columns_tablet) ? $columns_tablet : 2;
			            $columns_mobile = !empty($columns_mobile) ? $columns_mobile : 1;
			            
			            $slides_to_scroll = !empty($slides_to_scroll) ? $slides_to_scroll : 1;
			            $slides_to_scroll_tablet = !empty($slides_to_scroll_tablet) ? $slides_to_scroll_tablet : $columns_tablet;
			            $slides_to_scroll_mobile = !empty($slides_to_scroll_mobile) ? $slides_to_scroll_mobile : $columns_mobile;
		            ?>
                    <div class="member-detail-properties agent-detail-properties <?php echo esc_attr($el_class); ?>">
                        <div class="d-flex align-items-center top-info">
                            <?php if ( !empty($title) ) { ?>
                                <h4 class="title m-0 flex-grow-1">
                                    <?php echo trim($title); ?>
                                </h4>
                            <?php } ?>

                            <?php if ($view_all_text) { ?>
                                <div class="ms-auto">
                                    <a href="<?php echo esc_url($properties_url); ?>" class="btn-readmore"><?php echo trim( $view_all_text ); ?>
                                        <?php if ( $view_all_icon ) {
                                            if ( empty( $settings['icon'] ) && ! Elementor\Icons_Manager::is_migration_allowed() ) {
                                                // add old default
                                                $settings['icon'] = 'fa fa-star';
                                            }

                                            if ( ! empty( $settings['icon'] ) ) {
                                                $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
                                                $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                                            }

                                            $migrated = isset( $settings['__fa4_migrated']['view_all_icon'] );
                                            $is_new = empty( $settings['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
                                            if ( $is_new || $migrated ) { ?>
                                                <span class="next">
                                                    <?php Elementor\Icons_Manager::render_icon( $settings['view_all_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                                </span>
                                            <?php } else { ?>
                                                <span class="next"><i <?php $this->print_render_attribute_string( 'icon' ); ?>></i></span>
                                            <?php }
                                        } ?>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>

    		            <div class="widget-properties <?php echo esc_attr($layout_type); ?>">
    		                
    		                <div class="widget-content">
    		                    <?php if ( $layout_type == 'carousel' ): ?>
    		                        <div class="slick-carousel <?php echo esc_attr($columns < $loop->post_count?'':'hidden-dots'); ?> <?php echo esc_attr($position_nav); ?>"
    		                            data-items="<?php echo esc_attr($columns); ?>"
    			                        data-large="<?php echo esc_attr( $columns_tablet ); ?>"
    			                        data-medium="<?php echo esc_attr( $columns_tablet ); ?>"
    			                        data-small="<?php echo esc_attr($columns_mobile); ?>"
    			                        data-smallest="<?php echo esc_attr($columns_mobile); ?>"

    			                        data-slidestoscroll="<?php echo esc_attr($slides_to_scroll); ?>"
    			                        data-slidestoscroll_large="<?php echo esc_attr( $slides_to_scroll_tablet ); ?>"
    			                        data-slidestoscroll_medium="<?php echo esc_attr( $slides_to_scroll_tablet ); ?>"
    			                        data-slidestoscroll_small="<?php echo esc_attr($slides_to_scroll_mobile); ?>"
    			                        data-slidestoscroll_smallest="<?php echo esc_attr($slides_to_scroll_mobile); ?>"

    		                            data-pagination="<?php echo esc_attr( $show_pagination ? 'true' : 'false' ); ?>" data-nav="<?php echo esc_attr( $show_nav ? 'true' : 'false' ); ?>" data-rows="<?php echo esc_attr( $rows ); ?>" data-infinite="<?php echo esc_attr( $infinite_loop ? 'true' : 'false' ); ?>" data-autoplay="<?php echo esc_attr( $slider_autoplay ? 'true' : 'false' ); ?>">
    		                            <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
    		                                <div class="item">
    		                                    <?php echo WP_RealEstate_Template_Loader::get_template_part( 'properties-styles/inner-'. $property_item_style ); ?>
    		                                </div>
    		                            <?php endwhile; ?>
    		                        </div>
    		                    <?php else: ?>
    		                        <?php
    		                            $mdcol = 12/$columns;
    		                            $smcol = 12/$columns_tablet;
    		                            $xscol = 12/$columns_mobile;
    		                        ?>
    		                        <div class="row">
    		                            <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
    		                                <div class="col-xl-<?php echo esc_attr($mdcol); ?> col-md-<?php echo esc_attr($smcol); ?> col-<?php echo esc_attr( $xscol ); ?> list-item">
    		                                    <?php echo WP_RealEstate_Template_Loader::get_template_part( 'properties-styles/inner-'. $property_item_style ); ?>
    		                                </div>
    		                            <?php endwhile; ?>
    		                        </div>
    		                    <?php endif; ?>
    		                    <?php wp_reset_postdata(); ?>
    		                </div>

    		            </div>
                    </div>
                <?php endif;
	    }
	}
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Agent_Properties );

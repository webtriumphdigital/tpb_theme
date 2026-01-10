<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Justhome_Elementor_RealEstate_Properties extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_realestate_properties';
    }

	public function get_title() {
        return esc_html__( 'Apus Properties', 'justhome' );
    }
    
	public function get_categories() {
        return [ 'justhome-elements' ];
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
            'status_slugs',
            [
                'label' => esc_html__( 'Statuses Slug', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter slugs spearate by comma(,)', 'justhome' ),
            ]
        );

        $this->add_control(
            'type_slugs',
            [
                'label' => esc_html__( 'Types Slug', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter slugs spearate by comma(,)', 'justhome' ),
            ]
        );

        $this->add_control(
            'location_slugs',
            [
                'label' => esc_html__( 'Location Slug', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter slugs spearate by comma(,)', 'justhome' ),
            ]
        );

        $this->add_control(
            'amenity_slugs',
            [
                'label' => esc_html__( 'Amenities Slug', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter slugs spearate by comma(,)', 'justhome' ),
            ]
        );

        $this->add_control(
            'material_slugs',
            [
                'label' => esc_html__( 'Materials Slug', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter slugs spearate by comma(,)', 'justhome' ),
            ]
        );

        $this->add_control(
            'label_slugs',
            [
                'label' => esc_html__( 'Labels Slug', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXTAREA,
                'rows' => 2,
                'default' => '',
                'placeholder' => esc_html__( 'Enter slugs spearate by comma(,)', 'justhome' ),
            ]
        );

        $this->add_control(
            'limit',
            [
                'label' => esc_html__( 'Limit', 'justhome' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'input_type' => 'number',
                'description' => esc_html__( 'Limit properties to display', 'justhome' ),
                'default' => 4
            ]
        );
        
        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Order by', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'justhome'),
                    'date' => esc_html__('Date', 'justhome'),
                    'ID' => esc_html__('ID', 'justhome'),
                    'author' => esc_html__('Author', 'justhome'),
                    'title' => esc_html__('Title', 'justhome'),
                    'modified' => esc_html__('Modified', 'justhome'),
                    'rand' => esc_html__('Random', 'justhome'),
                    'comment_count' => esc_html__('Comment count', 'justhome'),
                    'menu_order' => esc_html__('Menu order', 'justhome'),
                ),
                'default' => ''
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => esc_html__( 'Sort order', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'justhome'),
                    'ASC' => esc_html__('Ascending', 'justhome'),
                    'DESC' => esc_html__('Descending', 'justhome'),
                ),
                'default' => ''
            ]
        );

        $this->add_control(
            'get_properties_by',
            [
                'label' => esc_html__( 'Get Properties By', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'featured' => esc_html__('Featured Properties', 'justhome'),
                    'recent' => esc_html__('Recent Properties', 'justhome'),
                ),
                'default' => 'recent'
            ]
        );

        $this->add_control(
            'property_item_style',
            [
                'label' => esc_html__( 'Property Item Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'grid' => esc_html__('Grid Default', 'justhome'),
                    'grid-v1' => esc_html__('Grid V1', 'justhome'),
                    'grid-v2' => esc_html__('Grid V2', 'justhome'),
                    'grid-v3' => esc_html__('Grid V3', 'justhome'),
                    'grid-v4' => esc_html__('Grid V4', 'justhome'),
                    'grid-v5' => esc_html__('Grid V5', 'justhome'),
                    'grid-v6' => esc_html__('Grid V6', 'justhome'),
                    'list' => esc_html__('List Default', 'justhome'),
                    'list-v1' => esc_html__('List V1', 'justhome'),
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
                'default'       => 'yes',
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
                'default'       => 'yes',
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
                'default'       => 'yes',
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
                'default'       => 'yes',
                'condition' => [
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'navigation_stretch',
            [
                'label'         => esc_html__( 'Stretch Navigation', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'justhome' ),
                'label_off'     => esc_html__( 'No', 'justhome' ),
                'condition' => [
                    'show_nav' => 'yes',
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'navigation_position',
            [
                'label' => esc_html__( 'Navigation Position', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'justhome'),
                    'st_nav_bottom' => esc_html__('Bottom', 'justhome'),
                ),
                'default' => '',
                'condition' => [
                    'show_nav' => 'yes',
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'style_pagination',
            [
                'label' => esc_html__( 'Pagination Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'justhome'),
                    'st_pa_line' => esc_html__('Line', 'justhome'),
                ),
                'default' => '',
                'condition' => [
                    'show_pagination' => 'yes',
                    'layout_type' => 'carousel',
                ],
            ]
        );

        $this->add_control(
            'fullscreen',
            [
                'label'         => esc_html__( 'Full Screen', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'justhome' ),
                'label_off'     => esc_html__( 'No', 'justhome' ),
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
            'section_item_style',
            [
                'label' => esc_html__( 'Item Style', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'label' => esc_html__( 'Border', 'justhome' ),
                'selector' => '{{WRAPPER}} .property-item',
            ]
        );

        $this->add_control(
            'item_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .property-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_nav_style',
            [
                'label' => esc_html__( 'Nav', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
            $this->start_controls_tabs(
                'style_tabs'
            );
                $this->start_controls_tab(
                    'button_normal_tab',
                        [
                            'label' => esc_html__( 'Normal', 'justhome' ),
                        ]
                    );
                    $this->add_control(
                        'btn_color',
                        [
                            'label' => esc_html__( 'Color', 'justhome' ),
                            'type' => Elementor\Controls_Manager::COLOR,
                            
                            'selectors' => [
                                '{{WRAPPER}} .slick-carousel .slick-arrow' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'btn_bg_color',
                        [
                            'label' => esc_html__( 'Background', 'justhome' ),
                            'type' => Elementor\Controls_Manager::COLOR,
                            
                            'selectors' => [
                                '{{WRAPPER}} .slick-carousel .slick-arrow' => 'background: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'btn_br_color',
                        [
                            'label' => esc_html__( 'Border', 'justhome' ),
                            'type' => Elementor\Controls_Manager::COLOR,
                            
                            'selectors' => [
                                '{{WRAPPER}} .slick-carousel .slick-arrow' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                    

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'button_hover_tab',
                        [
                            'label' => esc_html__( 'Hover', 'justhome' ),
                        ]
                    );
                    $this->add_control(
                        'btn_hover_color',
                        [
                            'label' => esc_html__( 'Color', 'justhome' ),
                            'type' => Elementor\Controls_Manager::COLOR,
                            
                            'selectors' => [
                                '{{WRAPPER}} .slick-carousel .slick-arrow:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .slick-carousel .slick-arrow:focus' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'btn_hover_bg_color',
                        [
                            'label' => esc_html__( 'Background', 'justhome' ),
                            'type' => Elementor\Controls_Manager::COLOR,
                            
                            'selectors' => [
                                '{{WRAPPER}} .slick-carousel .slick-arrow:hover' => 'background: {{VALUE}};',
                                '{{WRAPPER}} .slick-carousel .slick-arrow:focus' => 'background: {{VALUE}};',
                            ],
                        ]
                    );
                    $this->add_control(
                        'btn_hover_br_color',
                        [
                            'label' => esc_html__( 'Border', 'justhome' ),
                            'type' => Elementor\Controls_Manager::COLOR,
                            
                            'selectors' => [
                                '{{WRAPPER}} .slick-carousel .slick-arrow:hover' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .slick-carousel .slick-arrow:focus' => 'border-color: {{VALUE}};',
                            ],
                        ]
                    );
                    

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_pag_style',
            [
                'label' => esc_html__( 'Pagination', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'pagination_bg_color',
            [
                'label' => esc_html__( 'Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-carousel .slick-dots li button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_hv_bg_color',
            [
                'label' => esc_html__( 'Active Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-carousel .slick-dots li:hover button, {{WRAPPER}} .slick-carousel .slick-dots li:focus button, {{WRAPPER}} .slick-carousel .slick-dots li.slick-active button' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-carousel .slick-dots li.slick-active:before,{{WRAPPER}} .slick-carousel .slick-dots li:hover:before,{{WRAPPER}} .slick-carousel .slick-dots li:focus:before' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'pagination_br_color',
            [
                'label' => esc_html__( 'Active Border Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-carousel .slick-dots li:hover,{{WRAPPER}} .slick-carousel .slick-dots li:focus,{{WRAPPER}} .slick-carousel .slick-dots li.slick-active' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        
        $status_slugs = !empty($status_slugs) ? array_map('trim', explode(',', $status_slugs)) : array();
        $type_slugs = !empty($type_slugs) ? array_map('trim', explode(',', $type_slugs)) : array();
        $location_slugs = !empty($location_slugs) ? array_map('trim', explode(',', $location_slugs)) : array();
        $amenity_slugs = !empty($amenity_slugs) ? array_map('trim', explode(',', $amenity_slugs)) : array();
        $material_slugs = !empty($material_slugs) ? array_map('trim', explode(',', $material_slugs)) : array();
        $label_slugs = !empty($label_slugs) ? array_map('trim', explode(',', $label_slugs)) : array();

        $args = array(
            'limit' => $limit,
            'get_properties_by' => $get_properties_by,
            'orderby' => $orderby,
            'order' => $order,
            'statuses' => $status_slugs,
            'types' => $type_slugs,
            'locations' => $location_slugs,
            'amenities' => $amenity_slugs,
            'materials' => $material_slugs,
            'labels' => $label_slugs,
        );
        $loop = justhome_get_properties($args);
        if ( $loop->have_posts() ) {
            $columns = !empty($columns) ? $columns : 3;
            $columns_tablet = !empty($columns_tablet) ? $columns_tablet : 2;
            $columns_mobile = !empty($columns_mobile) ? $columns_mobile : 1;
            
            $slides_to_scroll = !empty($slides_to_scroll) ? $slides_to_scroll : $columns;
            $slides_to_scroll_tablet = !empty($slides_to_scroll_tablet) ? $slides_to_scroll_tablet : $slides_to_scroll;
            $slides_to_scroll_mobile = !empty($slides_to_scroll_mobile) ? $slides_to_scroll_mobile : 1;
            ?>
            <div class="widget-properties <?php echo esc_attr( (!empty($navigation_stretch))?'navigation_stretch':''); ?> <?php echo esc_attr($el_class); ?>">
                <div class="widget-content">
                    <?php if ( $layout_type == 'carousel' ): ?>
                        <div class="slick-carousel <?php echo esc_attr($style_pagination.' '.$navigation_position); ?> <?php echo esc_attr( $fullscreen ? 'fullscreen' : 'nofullscreen' ); ?> <?php echo esc_attr($columns < $loop->post_count?'':'hidden-dots'); ?>"
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
                            <?php while ( $loop->have_posts() ) : $loop->the_post();
                                if($property_item_style == 'list' || $property_item_style == 'list-v1'){
                                    $smcol = 12;
                                }
                            ?>
                                <div class="col-lg-<?php echo esc_attr($mdcol); ?> col-sm-<?php echo esc_attr($smcol); ?> col-<?php echo esc_attr( $xscol ); ?> list-item">
                                    <?php echo WP_RealEstate_Template_Loader::get_template_part( 'properties-styles/inner-'. $property_item_style ); ?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
            <?php
        }
    }
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_RealEstate_Properties );
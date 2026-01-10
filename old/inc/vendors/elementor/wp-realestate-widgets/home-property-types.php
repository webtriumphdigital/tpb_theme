<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Justhome_Elementor_RealEstate_Property_Types extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_realestate_property_types';
    }

	public function get_title() {
        return esc_html__( 'Apus Property Types', 'justhome' );
    }
    
	public function get_categories() {
        return [ 'justhome-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Types Banner', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title here', 'justhome' ),
            ]
        );

        $repeater->add_control(
            'slug',
            [
                'label' => esc_html__( 'Type Slug', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your Type Slug here', 'justhome' ),
            ]
        );

        $repeater->add_control(
            'custom_url',
            [
                'label' => esc_html__( 'Custom URL', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your custom url here', 'justhome' ),
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Icon', 'justhome' ),
                'type' => Elementor\Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
            ]
        );

        $this->add_control(
            'types',
            [
                'label' => esc_html__( 'Types Box', 'justhome' ),
                'type' => Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'show_nb_properties',
            [
                'label' => esc_html__( 'Show Number Properties', 'justhome' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Hide', 'justhome' ),
                'label_off' => esc_html__( 'Show', 'justhome' ),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'justhome'),
                    'style2' => esc_html__('Style 2', 'justhome'),
                    'style3' => esc_html__('Style 3', 'justhome'),
                ),
                'default' => 'style1'
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
                    'line' => esc_html__('Line', 'justhome'),
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
                'condition' => [
                    'layout_type' => ['carousel','grid'],
                ],
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
            'section_box',
            [
                'label' => esc_html__( 'Box Style', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_box_style' );

            $this->start_controls_tab(
                'tab_box_normal',
                [
                    'label' => esc_html__( 'Normal', 'justhome' ),
                ]
            );

            $this->add_control(
                'box_color',
                [
                    'label' => esc_html__( 'Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .type-banner-inner' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_box',
                    'selector' => '{{WRAPPER}} .type-banner-inner',
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_shadow',
                    'label' => esc_html__( 'Box Shadow', 'justhome' ),
                    'selector' => '{{WRAPPER}} .type-banner-inner',
                ]
            );

            $this->end_controls_tab();

            // tab hover
            $this->start_controls_tab(
                'tab_box_hover',
                [
                    'label' => esc_html__( 'Hover', 'justhome' ),
                ]
            );

            $this->add_control(
                'box_hv_color',
                [
                    'label' => esc_html__( 'Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .type-banner-inner:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_hv_box',
                    'selector' => '{{WRAPPER}} .type-banner-inner:hover',
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Box_Shadow::get_type(),
                [
                    'name' => 'box_hv_shadow',
                    'label' => esc_html__( 'Box Shadow', 'justhome' ),
                    'selector' => '{{WRAPPER}} .type-banner-inner:hover',
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__( 'Padding Widget', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .widget-property-types .slick-list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'box_radius',
            [
                'label' => esc_html__( 'Border Radius', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .type-banner-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__( 'Icon Style', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_icon_style' );

            $this->start_controls_tab(
                'tab_icon_normal',
                [
                    'label' => esc_html__( 'Normal', 'justhome' ),
                ]
            );

            $this->add_control(
                'icon_color',
                [
                    'label' => esc_html__( 'Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .type-icon' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_icon',
                    'selector' => '{{WRAPPER}} .type-icon',
                ]
            );

            $this->end_controls_tab();

            // tab hover
            $this->start_controls_tab(
                'tab_icon_hover',
                [
                    'label' => esc_html__( 'Hover', 'justhome' ),
                ]
            );

            $this->add_control(
                'icon_hv_color',
                [
                    'label' => esc_html__( 'Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .type-banner-inner:hover .type-icon' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_hv_icon',
                    'selector' => '{{WRAPPER}} .type-banner-inner:hover .type-icon',
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();



        $this->start_controls_section(
            'section_typography',
            [
                'label' => esc_html__( 'Item Style', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_typography_style' );

            $this->start_controls_tab(
                'tab_typography_normal',
                [
                    'label' => esc_html__( 'Normal', 'justhome' ),
                ]
            );

            $this->add_control(
                'title_color',
                [
                    'label' => esc_html__( 'Title Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .type-banner-inner .title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_tab();

            // tab hover
            $this->start_controls_tab(
                'tab_typography_hover',
                [
                    'label' => esc_html__( 'Hover', 'justhome' ),
                ]
            );

            $this->add_control(
                'title_hv_color',
                [
                    'label' => esc_html__( 'Title Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .type-banner-inner:hover .title' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'title_margin',
            [
                'label' => esc_html__( 'Margin Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .type-banner-inner .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_padding',
            [
                'label' => esc_html__( 'Padding Item', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .type-banner-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($types) ) {
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
        ?>
            <div class="widget-property-types <?php echo esc_attr($el_class); ?>">
                
                <?php if ( $layout_type == 'carousel' ) {
                    
                    $slides_to_scroll = !empty($slides_to_scroll) ? $slides_to_scroll : $columns;
                    $slides_to_scroll_tablet = !empty($slides_to_scroll_tablet) ? $slides_to_scroll_tablet : $slides_to_scroll;
                    $slides_to_scroll_mobile = !empty($slides_to_scroll_mobile) ? $slides_to_scroll_mobile : 1;
                ?>
                    <div class="slick-carousel <?php echo esc_attr( $fullscreen ? 'fullscreen' : 'nofullscreen' ); ?> <?php echo ( ( $columns >= count($types))?'hidden-dots':'' ); ?>"
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

                        <?php foreach ($types as $item) {
                            $term = get_term_by( 'slug', $item['slug'], 'property_type' );
                            $link = $item['custom_url'];
                            $title = $item['title'];
                            if ($term) {
                                if ( empty($link) ) {
                                    $link = get_term_link( $term, 'property_type' );
                                }
                                if ( empty($title) ) {
                                    $title = $term->name;
                                }
                            }

                            ?>
                            <div class="item">
                                <a class="types-banner-inner d-flex align-items-center <?php echo esc_attr($style); ?>" href="<?php echo esc_url($link); ?>">
                                    <div class="inner-wrapper flex-grow-1 d-flex align-items-center">
                                        <div class="type-icon d-flex align-items-center justify-content-center">    
                                            <?php
                                            if ( empty( $item['icon'] ) && ! Elementor\Icons_Manager::is_migration_allowed() ) {
                                                // add old default
                                                $item['icon'] = 'fa fa-star';
                                            }

                                            if ( ! empty( $item['icon'] ) ) {
                                                $this->add_render_attribute( 'icon', 'class', $item['icon'] );
                                                $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                                            }

                                            $migrated = isset( $item['__fa4_migrated']['selected_icon'] );
                                            $is_new = empty( $item['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
                                            if ( $is_new || $migrated ) {
                                                Elementor\Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
                                            } else { ?>
                                                <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                                            <?php } ?>
                                        </div>
                                        <div class="inner">
                                            <?php if ( !empty($title) ) { ?>
                                                <h4 class="title">
                                                    <?php echo trim($title); ?>
                                                </h4>
                                            <?php } ?>
                                            <?php if ( $show_nb_properties ) {
                                                    $args = array(
                                                        'fields' => 'ids',
                                                        'types' => array($item['slug']),
                                                        'limit' => 1
                                                    );
                                                    $query = justhome_get_properties($args);
                                                    $count = $query->found_posts;
                                                    $number_properties = $count ? WP_RealEstate_Mixes::format_number($count) : 0;
                                            ?>
                                            <div class="number"><?php echo sprintf(_n('<span>%d</span> Property', '<span>%d</span> Properties', $count, 'justhome'), $number_properties); ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <span class="flex-shrink-0 direction d-inline-flex align-items-center justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg>
                                    </span>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                <?php } elseif( $layout_type == 'grid' ) { ?>
                    <div class="row">
                        <?php
                            $mdcol = 12/$columns;
                            $smcol = 12/$columns_tablet;
                            $xscol = 12/$columns_mobile;
                        ?>
                        <?php foreach ($types as $item) {
                            $term = get_term_by( 'slug', $item['slug'], 'property_type' );
                            $link = $item['custom_url'];
                            $title = $item['title'];
                            if ($term) {
                                if ( empty($link) ) {
                                    $link = get_term_link( $term, 'property_type' );
                                }
                                if ( empty($title) ) {
                                    $title = $term->name;
                                }
                            }

                            ?>
                            <div class="col-lg-<?php echo esc_attr($mdcol); ?> col-md-<?php echo esc_attr($smcol); ?> col-<?php echo esc_attr( $xscol ); ?>">
                                <a class="types-banner-inner d-flex align-items-center <?php echo esc_attr($style); ?>" href="<?php echo esc_url($link); ?>">
                                    <div class="inner-wrapper flex-grow-1 d-flex align-items-center">
                                        <div class="type-icon d-flex align-items-center justify-content-center">    
                                            <?php
                                            if ( empty( $item['icon'] ) && ! Elementor\Icons_Manager::is_migration_allowed() ) {
                                                // add old default
                                                $item['icon'] = 'fa fa-star';
                                            }

                                            if ( ! empty( $item['icon'] ) ) {
                                                $this->add_render_attribute( 'icon', 'class', $item['icon'] );
                                                $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                                            }

                                            $migrated = isset( $item['__fa4_migrated']['selected_icon'] );
                                            $is_new = empty( $item['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
                                            if ( $is_new || $migrated ) {
                                                Elementor\Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
                                            } else { ?>
                                                <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                                            <?php } ?>
                                        </div>
                                        <div class="inner">
                                            <?php if ( !empty($title) ) { ?>
                                                <h4 class="title">
                                                    <?php echo trim($title); ?>
                                                </h4>
                                            <?php } ?>
                                            <?php if ( $show_nb_properties ) {
                                                    $args = array(
                                                        'fields' => 'ids',
                                                        'types' => array($item['slug']),
                                                        'limit' => 1
                                                    );
                                                    $query = justhome_get_properties($args);
                                                    $count = $query->found_posts;
                                                    $number_properties = $count ? WP_RealEstate_Mixes::format_number($count) : 0;
                                            ?>
                                            <div class="number"><?php echo sprintf(_n('<span>%d</span> Property', '<span>%d</span> Properties', $count, 'justhome'), $number_properties); ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <span class="flex-shrink-0 direction d-inline-flex align-items-center justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg>
                                    </span>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <?php } elseif( $layout_type == 'line' ) { ?>
                    <div class="st_line_types d-flex flex-wrap justify-content-center">
                        <?php foreach ($types as $item) {
                            $term = get_term_by( 'slug', $item['slug'], 'property_type' );
                            $link = $item['custom_url'];
                            $title = $item['title'];
                            if ($term) {
                                if ( empty($link) ) {
                                    $link = get_term_link( $term, 'property_type' );
                                }
                                if ( empty($title) ) {
                                    $title = $term->name;
                                }
                            }

                            ?>
                                <a class="types-banner-inner d-flex align-items-center <?php echo esc_attr($style); ?>" href="<?php echo esc_url($link); ?>">
                                    <div class="inner-wrapper flex-grow-1 d-flex align-items-center">
                                        <div class="type-icon d-flex align-items-center justify-content-center">    
                                            <?php
                                            if ( empty( $item['icon'] ) && ! Elementor\Icons_Manager::is_migration_allowed() ) {
                                                // add old default
                                                $item['icon'] = 'fa fa-star';
                                            }

                                            if ( ! empty( $item['icon'] ) ) {
                                                $this->add_render_attribute( 'icon', 'class', $item['icon'] );
                                                $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                                            }

                                            $migrated = isset( $item['__fa4_migrated']['selected_icon'] );
                                            $is_new = empty( $item['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
                                            if ( $is_new || $migrated ) {
                                                Elementor\Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
                                            } else { ?>
                                                <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                                            <?php } ?>
                                        </div>
                                        <div class="inner">
                                            <?php if ( !empty($title) ) { ?>
                                                <h4 class="title">
                                                    <?php echo trim($title); ?>
                                                </h4>
                                            <?php } ?>
                                            <?php if ( $show_nb_properties ) {
                                                    $args = array(
                                                        'fields' => 'ids',
                                                        'types' => array($item['slug']),
                                                        'limit' => 1
                                                    );
                                                    $query = justhome_get_properties($args);
                                                    $count = $query->found_posts;
                                                    $number_properties = $count ? WP_RealEstate_Mixes::format_number($count) : 0;
                                            ?>
                                            <div class="number"><?php echo sprintf(_n('<span>%d</span> Property', '<span>%d</span> Properties', $count, 'justhome'), $number_properties); ?></div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <span class="flex-shrink-0 direction d-inline-flex align-items-center justify-content-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg>
                                    </span>
                                </a>
                        <?php } ?>
                    </div>                  
                <?php } ?>
            </div>
        <?php
        }
    }
}
Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_RealEstate_Property_Types );
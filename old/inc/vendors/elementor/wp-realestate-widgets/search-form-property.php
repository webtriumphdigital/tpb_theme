<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Justhome_Elementor_RealEstate_Search_Form extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_realestate_search_form';
    }

	public function get_title() {
        return esc_html__( 'Apus Properties Search Form', 'justhome' );
    }
    
	public function get_categories() {
        return [ 'justhome-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Search Form', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $fields = apply_filters( 'wp-realestate-default-property-filter-fields', array() );
        $search_fields = array( '' => esc_html__('Choose a field', 'justhome') );
        foreach ($fields as $key => $field) {
            $name = $field['name'];
            if ( empty($field['name']) ) {
                $name = $key;
            }
            $search_fields[$key] = $name;
        }

        $repeater = new Elementor\Repeater();

        $repeater->add_control(
            'filter_field',
            [
                'label' => esc_html__( 'Filter field', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $search_fields
            ]
        );
        
        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
            ]
        );

        $repeater->add_control(
            'placeholder',
            [
                'label' => esc_html__( 'Placeholder', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
            ]
        );

        $repeater->add_control(
            'enable_autocompleate_search',
            [
                'label' => esc_html__( 'Enable autocompleate search', 'justhome' ),
                'type' => Elementor\Controls_Manager::SWITCHER,
                'default' => '',
                'label_on' => esc_html__( 'Yes', 'justhome' ),
                'label_off' => esc_html__( 'No', 'justhome' ),
                'condition' => [
                    'filter_field' => 'title',
                ],
            ]
        );

        $repeater->add_control(
            'style',
            [
                'label' => esc_html__( 'Price Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    'slider' => esc_html__('Price Slider', 'justhome'),
                    'text' => esc_html__('Pice Min/max Input Text', 'justhome'),
                    'list' => esc_html__('Price List', 'justhome'),
                ],
                'default' => 'slider',
                'condition' => [
                    'filter_field' => 'price',
                ],
            ]
        );
        $repeater->add_control(
            'price_range_size',
            [
                'label' => esc_html__( 'Price range size', 'justhome' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'input_type' => 'text',
                'default' => 1000,
                'condition' => [
                    'filter_field' => 'price',
                    'style' => 'list',
                ],
            ]
        );
        $repeater->add_control(
            'price_range_max',
            [
                'label' => esc_html__( 'Max price ranges', 'justhome' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'input_type' => 'text',
                'default' => 10,
                'condition' => [
                    'filter_field' => 'price',
                    'style' => 'list',
                ],
            ]
        );
        $repeater->add_control(
            'min_price_placeholder',
            [
                'label' => esc_html__( 'Min Price Placeholder', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Min Price',
                'condition' => [
                    'filter_field' => 'price',
                    'style' => 'text',
                ],
            ]
        );

        $repeater->add_control(
            'max_price_placeholder',
            [
                'label' => esc_html__( 'Max Price Placeholder', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Max Price',
                'condition' => [
                    'filter_field' => 'price',
                    'style' => 'text',
                ],
            ]
        );

        $repeater->add_control(
            'slider_style',
            [
                'label' => esc_html__( 'Layout Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    'slider' => esc_html__('Slider', 'justhome'),
                    'text' => esc_html__('Input Text', 'justhome'),
                ],
                'default' => 'slider',
                'condition' => [
                    'filter_field' => ['home_area', 'lot_area', 'year_built'],
                ],
            ]
        );

        $repeater->add_control(
            'min_placeholder',
            [
                'label' => esc_html__( 'Min Placeholder', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Min',
                'condition' => [
                    'filter_field' => ['home_area', 'lot_area', 'year_built'],
                    'slider_style' => 'text',
                ],
            ]
        );

        $repeater->add_control(
            'max_placeholder',
            [
                'label' => esc_html__( 'Max Placeholder', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Max',
                'condition' => [
                    'filter_field' => ['home_area', 'lot_area', 'year_built'],
                    'slider_style' => 'text',
                ],
            ]
        );

        $repeater->add_control(
            'suffix',
            [
                'label' => esc_html__( 'Suffix', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Sqft',
                'condition' => [
                    'filter_field' => ['home_area', 'lot_area'],
                ],
            ]
        );

        $repeater->add_control(
            'number_filter_layout',
            [
                'label' => esc_html__( 'Filter Layout', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'select' => esc_html__('Select', 'justhome'),
                    'radio' => esc_html__('Radio Button', 'justhome'),
                ),
                'default' => 'select',
                'condition' => [
                    'filter_field' => ['baths', 'beds', 'rooms', 'garages'],
                ],
            ]
        );

        $repeater->add_control(
            'number_style',
            [
                'label' => esc_html__( 'Layout Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => [
                    'number-plus' => esc_html__('Number +', 'justhome'),
                    'number' => esc_html__('Number', 'justhome'),
                ],
                'default' => 'number-plus',
                'condition' => [
                    'filter_field' => ['baths', 'beds', 'rooms', 'garages'],
                ],
            ]
        );

        $repeater->add_control(
            'min_number',
            [
                'label' => esc_html__( 'Min Number', 'justhome' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'input_type' => 'text',
                'default' => 1,
                'condition' => [
                    'filter_field' => ['baths', 'beds', 'rooms', 'garages'],
                ],
            ]
        );

        $repeater->add_control(
            'max_number',
            [
                'label' => esc_html__( 'Max Number', 'justhome' ),
                'type' => Elementor\Controls_Manager::NUMBER,
                'input_type' => 'text',
                'default' => 5,
                'condition' => [
                    'filter_field' => ['baths', 'beds', 'rooms', 'garages'],
                ],
            ]
        );

        $repeater->add_control(
            'filter_layout',
            [
                'label' => esc_html__( 'Filter Layout', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'select' => esc_html__('Select', 'justhome'),
                    'radio' => esc_html__('Radio Button', 'justhome'),
                    'check_list' => esc_html__('Check Box', 'justhome'),
                ),
                'default' => 'select',
                'condition' => [
                    'filter_field' => ['type', 'status', 'location', 'label', 'amenity', 'material'],
                ],
            ]
        );
        
        $columns = array();
        for ($i=1; $i <= 12 ; $i++) { 
            $columns[$i] = sprintf(esc_html__('%d Columns', 'justhome'), $i);
        }
        $repeater->add_responsive_control(
            'columns',
            [
                'label' => esc_html__( 'Columns', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $columns,
                'default' => 1
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Icon', 'justhome' ),
                'type' => Elementor\Controls_Manager::ICONS,
            ]
        );


        $this->add_control(
            'main_search_fields',
            [
                'label' => esc_html__( 'Main Search Fields', 'justhome' ),
                'type' => Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control(
            'show_advance_search',
            [
                'label'         => esc_html__( 'Show Advanced Search', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'advance_search_layout_type',
            [
                'label' => esc_html__( 'Advanced Search Layout', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'justhome'),
                    'popup' => esc_html__('Popup', 'justhome'),
                ),
                'default' => ''
            ]
        );

        $this->add_control(
            'advance_search_title',
            [
                'label' => esc_html__( 'Advanced Search Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'default' => 'Advanced Search',
                'condition' => [
                    'advance_search_layout_type' => ['popup'],
                ],
            ]
        );

        $this->add_control(
            'advance_search_btn_text',
            [
                'label' => esc_html__( 'Advanced Search Button Text', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Find Property',
                'condition' => [
                    'advance_search_layout_type' => ['popup'],
                ],
            ]
        );

        $this->add_control(
            'advance_search_fields',
            [
                'label' => esc_html__( 'Advanced Search Fields', 'justhome' ),
                'type' => Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control(
            'filter_btn_text',
            [
                'label' => esc_html__( 'Button Text', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Find Property',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_icon_button',
            [
                'label'         => esc_html__( 'Show Icon Button', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
            ]
        );

        $this->add_control(
            'selected_icon_button',
            [
                'label' => esc_html__( 'Icon Button', 'justhome' ),
                'type' => Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'show_icon_button' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'advanced_btn_text',
            [
                'label' => esc_html__( 'Advanced Text', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'default' => 'Advanced',
            ]
        );

        $this->add_control(
            'selected_icon_button_advanced',
            [
                'label' => esc_html__( 'Icon Button Advanced', 'justhome' ),
                'type' => Elementor\Controls_Manager::ICONS,
                'condition' => [
                    'show_advance_search' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'btn_columns',
            [
                'label' => esc_html__( 'Button Columns', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $columns,
                'default' => 1
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout Type', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'horizontal' => esc_html__('Horizontal', 'justhome'),
                    'vertical' => esc_html__('Vertical', 'justhome'),
                ),
                'default' => 'horizontal',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'justhome'),
                    'style1' => esc_html__('Style 1', 'justhome'),
                    'style2' => esc_html__('Style 2', 'justhome'),
                    'style3' => esc_html__('Style 3', 'justhome'),
                ),
                'default' => ''
            ]
        );

        $this->add_control(
            'show_reset',
            [
                'label'         => esc_html__( 'Show Reset button', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_save_search',
            [
                'label'         => esc_html__( 'Show Save Search button', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
            ]
        );

        $this->add_responsive_control(
            'reset_save_search_columns',
            [
                'label' => esc_html__( 'Reset | Save Search Columns', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $columns,
                'default' => 1,
            ]
        );

        $this->add_control(
            'show_mobile',
            [
                'label'         => esc_html__( 'Always Show Mobile', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'default'       => 'yes',

            ]
        );

   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'justhome' ),
                'type'          => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'justhome' ),
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_border_style',
            [
                'label' => esc_html__( 'Box', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'space_color_item',
            [
                'label' => esc_html__( 'Space Item Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} form.form-search .content-main-inner .list-fileds > div' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'margin_item',
            [
                'label' => esc_html__( 'Space Item', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} form.form-search .content-main-inner .form-group' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'padding_box',
            [
                'label' => esc_html__( 'Padding', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .search-form-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bg_box',
            [
                'label' => esc_html__( 'Background Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-form-inner' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'border_box',
                'label' => esc_html__( 'Border', 'justhome' ),
                'selector' => '{{WRAPPER}} .search-form-inner',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'justhome' ),
                'selector' => '{{WRAPPER}} .search-form-inner',
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .search-form-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_typography_style',
            [
                'label' => esc_html__( 'Main Box', 'justhome' ),
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
                    'text_input_color',
                    [
                        'label' => esc_html__( 'Input Color', 'justhome' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .content-main-inner .form-control, {{WRAPPER}} .content-main-inner .select2-selection--single .select2-selection__rendered' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'placeholder_input_color',
                    [
                        'label' => esc_html__( 'Input Placeholder Color', 'justhome' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .content-main-inner .form-control::placeholder,{{WRAPPER}} .content-main-inner .select2-selection--single .select2-selection__placeholder' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .content-main-inner .select2-container--open .select2-selection--single .select2-selection__arrow b' => 'border-bottom-color: {{VALUE}};',
                            '{{WRAPPER}} .content-main-inner .select2-selection--single .select2-selection__arrow b' => 'border-top-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'text_input_bg_color',
                    [
                        'label' => esc_html__( 'Input Background Color', 'justhome' ),
                        'type' => Elementor\Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .content-main-inner .form-control,{{WRAPPER}} .content-main-inner .select2-selection--single' => 'background-color: {{VALUE}} !important;',
                        ],
                    ]
                );

                $this->add_group_control(
                    Elementor\Group_Control_Border::get_type(),
                    [
                        'name' => 'border_input',
                        'label' => esc_html__( 'Border', 'justhome' ),
                        'selector' => '{{WRAPPER}} .content-main-inner .form-control, {{WRAPPER}} .content-main-inner .select2-container .select2-selection--single',
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
                'text_input_focus_bg_color',
                [
                    'label' => esc_html__( 'Input Background Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content-main-inner .form-control:focus' => 'background-color: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_control(
                'text_input_focus_br_color',
                [
                    'label' => esc_html__( 'Input Border Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content-main-inner .form-control:focus, .content-main-inner .select2-container--default.select2-container.select2-container--open .select2-selection--single' => 'border-color: {{VALUE}};',
                    ],
                    'condition' => [
                        'border_input_border!' => '',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'input_border_radius',
            [
                'label' => esc_html__( 'Input Border Radius', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .content-main-inner .form-control, {{WRAPPER}} .content-main-inner .select2-container--default.select2-container .select2-selection--single' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label' => esc_html__( 'Button', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

            $this->start_controls_tab(
                'tab_button_normal',
                [
                    'label' => esc_html__( 'Normal', 'justhome' ),
                ]
            );
            
            $this->add_control(
                'button_color',
                [
                    'label' => esc_html__( 'Button Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .btn-submit' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_button',
                    'label' => esc_html__( 'Background', 'justhome' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .btn-submit',
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border_button',
                    'label' => esc_html__( 'Border', 'justhome' ),
                    'selector' => '{{WRAPPER}} .btn-submit',
                ]
            );

            $this->add_responsive_control(
                'padding_button',
                [
                    'label' => esc_html__( 'Padding', 'justhome' ),
                    'type' => Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .btn-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'btn_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'justhome' ),
                    'type' => Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .btn-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->end_controls_tab();

            // tab hover
            $this->start_controls_tab(
                'tab_button_hover',
                [
                    'label' => esc_html__( 'Hover', 'justhome' ),
                ]
            );

            $this->add_control(
                'button_hover_color',
                [
                    'label' => esc_html__( 'Button Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .btn-submit:hover, {{WRAPPER}} .btn-submit:focus' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_button_hover',
                    'label' => esc_html__( 'Background', 'justhome' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .btn-submit:hover, {{WRAPPER}} .btn-submit:focus',
                ]
            );

            $this->add_control(
                'button_hover_border_color',
                [
                    'label' => esc_html__( 'Border Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'condition' => [
                        'border_button_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .btn-submit:hover, {{WRAPPER}} .btn-submit:focus' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'padding_button_hover',
                [
                    'label' => esc_html__( 'Padding', 'justhome' ),
                    'type' => Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .btn-submit:hover, {{WRAPPER}} .btn-submit:focus' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'btn_hv_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'justhome' ),
                    'type' => Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .btn-submit:hover, {{WRAPPER}} .btn-submit:focus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        // end tab 

        $this->end_controls_section();


        $this->start_controls_section(
            'section_button_av_style',
            [
                'label' => esc_html__( 'Button Advanced', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs( 'tabs_button_av_style' );

            $this->start_controls_tab(
                'tab_button_av_normal',
                [
                    'label' => esc_html__( 'Normal', 'justhome' ),
                ]
            );
            
            $this->add_control(
                'button_av_color',
                [
                    'label' => esc_html__( 'Button Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content-main-inner .advance-search-btn' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_button_av',
                    'label' => esc_html__( 'Background', 'justhome' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .content-main-inner .advance-search-btn',
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border_button_av',
                    'label' => esc_html__( 'Border', 'justhome' ),
                    'selector' => '{{WRAPPER}} .content-main-inner .advance-search-btn',
                ]
            );

            $this->end_controls_tab();

            // tab hover
            $this->start_controls_tab(
                'tab_button_av_hover',
                [
                    'label' => esc_html__( 'Hover', 'justhome' ),
                ]
            );

            $this->add_control(
                'button_av_hover_color',
                [
                    'label' => esc_html__( 'Button Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .content-main-inner .advance-search-btn:hover, {{WRAPPER}} .content-main-inner .advance-search-btn:focus' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_button_av_hover',
                    'label' => esc_html__( 'Background', 'justhome' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .content-main-inner .advance-search-btn:hover, {{WRAPPER}} .content-main-inner .advance-search-btn:focus',
                ]
            );

            $this->add_control(
                'button_av_hover_border_color',
                [
                    'label' => esc_html__( 'Border Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'condition' => [
                        'border_button_av_border!' => '',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .content-main-inner .advance-search-btn:hover, {{WRAPPER}} .content-main-inner .advance-search-btn:focus' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_tab();

            $this->add_responsive_control(
                'padding_button_av',
                [
                    'label' => esc_html__( 'Padding', 'justhome' ),
                    'type' => Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .content-main-inner .advance-search-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );

            $this->add_responsive_control(
                'btn_av_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'justhome' ),
                    'type' => Elementor\Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors' => [
                        '{{WRAPPER}} .content-main-inner .advance-search-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_tabs();
        // end tab 

        $this->end_controls_section();

    }

	protected function render() {
        $settings = $this->get_settings();

        extract( $settings );
        
        $search_page_url = WP_RealEstate_Mixes::get_properties_page_url();

        justhome_load_select2();

        $filter_fields = apply_filters( 'wp-realestate-default-property-filter-fields', array() );
        $instance = array();
        $widget_id = justhome_random_key();
        $args = array( 'widget_id' => $widget_id );

        $btn_columns = !empty($btn_columns) ? $btn_columns : 12;
        $btn_columns_tablet = !empty($btn_columns_tablet) ? $btn_columns_tablet : $btn_columns;
        $btn_columns_mobile = !empty($btn_columns_mobile) ? $btn_columns_mobile : 12;

        $reset_save_search_columns = !empty($reset_save_search_columns) ? $reset_save_search_columns : 12;
        $reset_save_search_columns_tablet = !empty($reset_save_search_columns_tablet) ? $reset_save_search_columns_tablet : $reset_save_search_columns;
        $reset_save_search_columns_mobile = !empty($reset_save_search_columns_mobile) ? $reset_save_search_columns_mobile : 12;
        
        if($style == 'style2'){
            $add_space_main = 'row-60';
        } else {
            $add_space_main = 'row-10';
        }
        ?>
        <div class="widget-property-search-form <?php echo esc_attr($el_class); ?>">
            <?php if ( empty($show_mobile) ) { ?>
                <span class="action-show-filters action-mobile-map d-inline-block d-dk-none"><i class="flaticon-filter"></i><?php esc_html_e('Search Property','justhome') ?></span>
            <?php } ?>
            <form id="filter-listing-form-<?php echo esc_attr($widget_id); ?>" action="<?php echo esc_url($search_page_url); ?>" class="form-search filter-listing-form <?php echo esc_attr($style.' '.$layout_type); ?>" method="GET">
                <div class="search-form-inner position-relative">
                    <?php if ( $layout_type == 'horizontal' ) { ?>
                        <div class="main-inner clearfix">
                            <div class="content-main-inner">
                                <div class="row <?php echo trim($add_space_main); ?> d-lg-flex align-items-center list-fileds">
                                    <?php
                                    $this->form_fields_display($main_search_fields, $filter_fields, $instance, $args);
                                    ?>
                                    <div class="col-<?php echo esc_attr($btn_columns_mobile); ?> col-md-<?php echo esc_attr($btn_columns_tablet); ?> col-xl-<?php echo esc_attr($btn_columns); ?> form-group-search">
                                        <div class="d-md-flex align-items-center <?php echo trim( ($filter_btn_text)?'':'no-text' ); ?>">
                                            <?php if ( $show_advance_search && !empty($advance_search_fields) ) {
                                                $addvance_class = '';
                                                $href = 'javascript:void(0);';
                                                if ( $advance_search_layout_type == 'popup' ) {
                                                    $addvance_class = 'popup';
                                                    $href = '#advance-search-wrapper-'.esc_attr($widget_id);
                                                }
                                            ?>
                                                <div class="advance-link">
                                                    <a href="<?php echo trim($href); ?>" class="advance-search-btn d-flex align-items-center <?php echo esc_attr($addvance_class); ?>">
                                                        <?php
                                                        if ( ! empty( $settings['icon'] ) ) {
                                                            $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
                                                            $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                                                        }
                                                        $migrated = isset( $settings['__fa4_migrated']['selected_icon_button_advanced'] );
                                                        $is_new = empty( $settings['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
                                                        if ( $is_new || $migrated ) {
                                                            Elementor\Icons_Manager::render_icon( $settings['selected_icon_button_advanced'], [ 'aria-hidden' => 'true' ] );
                                                        } else { ?>
                                                            <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                                                        <?php } ?>
                                                        <?php
                                                            if ( !empty($advanced_btn_text) ) { ?>
                                                                <span class="text"><?php echo esc_html($advanced_btn_text); ?></span>
                                                            <?php } else { ?>
                                                                <span class="text"><?php esc_html_e('Advanced Advanced ', 'justhome'); ?></span>
                                                            <?php }
                                                        ?>
                                                    </a>
                                                </div>
                                            <?php } ?>
                                            
                                            <button class="btn-submit btn btn-theme <?php echo trim( ($filter_btn_text)?'':'no-text' ); ?>" type="submit">
                                                <?php echo trim($filter_btn_text); ?>
                                                <?php
                                                if ( ! empty( $settings['icon'] ) ) {
                                                    $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
                                                    $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                                                }
                                                $migrated = isset( $settings['__fa4_migrated']['selected_icon_button'] );
                                                $is_new = empty( $settings['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
                                                if ( $is_new || $migrated ) {
                                                    Elementor\Icons_Manager::render_icon( $settings['selected_icon_button'], [ 'aria-hidden' => 'true' ] );
                                                } else { ?>
                                                    <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                                                <?php } ?>
                                            </button>

                                        </div>
                                    </div>
                                </div>
                                <!-- Save Search -->
                                <?php if ( ($show_reset || $show_save_search) && ($advance_search_layout_type !== 'popup')  ) { ?>
                                    <div class="row <?php echo trim($add_space_main); ?>">
                                        <div class="col-<?php echo esc_attr($reset_save_search_columns_mobile); ?> col-md-<?php echo esc_attr($reset_save_search_columns_tablet); ?> col-xl-<?php echo esc_attr($reset_save_search_columns); ?> search-action">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <?php if ( $show_reset ) { ?>
                                                    <a href="javascript:void(0);" class="reset-search-btn">
                                                        <i class="flaticon-turn-back"></i>
                                                        <?php esc_html_e('Reset Search', 'justhome'); ?>
                                                    </a>
                                                <?php } ?>
                                                <?php if ( $show_save_search ) { ?>
                                                    <a href="#saved-search-form-btn-wrapper-<?php echo esc_attr($widget_id); ?>" class="save-search-btn btn-saved-search">
                                                        <i class="flaticon-heart"></i>
                                                        <?php esc_html_e('Save Search', 'justhome'); ?>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                        if ( $show_advance_search && !empty($advance_search_fields) ) {
                            ?>
                            <div id="advance-search-wrapper-<?php echo esc_attr($widget_id); ?>" class="advance-search-wrapper">
                                <div class="advance-search-wrapper-fields form-theme position-static">

                                    <?php
                                    if ( $advance_search_layout_type == 'popup' ) {
                                        ?>
                                        <div class="advance-search-top d-flex align-items-center">
                                            <?php if ( !empty($advance_search_title) ) { ?>
                                                <h4 class="advance-title"><?php echo esc_html($advance_search_title); ?></h4>
                                            <?php } ?>
                                            <div class="ms-auto">
                                                <span class="close-advance-popup"><i class="ti-close"></i></span>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="inner-search-advance">
                                        <div class="inner">
                                            <div class="row row-20">
                                                <?php
                                                $this->form_fields_display($advance_search_fields, $filter_fields, $instance, $args);
                                                ?>
                                                
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    if ( $advance_search_layout_type == 'popup' ) {
                                        ?>
                                        <div class="advance-search-bottom">
                                            <?php if ( !empty($advance_search_btn_text) ) { ?>
                                                <div class="row">
                                                    <div class="col-12  form-group-search">
                                                        <button class="submit-advance-search-btn btn-submit w-100 btn btn-theme <?php echo trim( ($advance_search_btn_text)?'':'no-text' ); ?>" type="submit" data-form_id="#filter-listing-form-<?php echo esc_attr($widget_id); ?>">
                                                            <?php echo trim($advance_search_btn_text); ?>
                                                            <?php
                                                            if ( ! empty( $settings['icon'] ) ) {
                                                                $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
                                                                $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                                                            }
                                                            $migrated = isset( $settings['__fa4_migrated']['selected_icon_button'] );
                                                            $is_new = empty( $settings['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
                                                            if ( $is_new || $migrated ) {
                                                                Elementor\Icons_Manager::render_icon( $settings['selected_icon_button'], [ 'aria-hidden' => 'true' ] );
                                                            } else { ?>
                                                                <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                                                            <?php } ?>
                                                        </button>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <!-- Save Search -->
                                            <?php if ( ($show_reset || $show_save_search) ) { ?>
                                                <div class="row">
                                                    <div class="col-<?php echo esc_attr($reset_save_search_columns_mobile); ?> col-md-<?php echo esc_attr($reset_save_search_columns_tablet); ?> col-xl-<?php echo esc_attr($reset_save_search_columns); ?> search-action">
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <?php if ( $show_reset ) { ?>
                                                                <a href="javascript:void(0);" class="reset-search-btn">
                                                                    <i class="flaticon-turn-back"></i>
                                                                    <?php esc_html_e('Reset Search', 'justhome'); ?>
                                                                </a>
                                                            <?php } ?>
                                                            <?php if ( $show_save_search ) { ?>
                                                                <a href="#saved-search-form-btn-wrapper-<?php echo esc_attr($widget_id); ?>" class="save-search-btn btn-saved-search">
                                                                    <i class="flaticon-heart"></i>
                                                                    <?php esc_html_e('Save Search', 'justhome'); ?>
                                                                </a>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    <?php } else { ?>
                        <div class="main-inner clearfix">
                            <div class="content-main-inner">
                                <div class="row">
                                    <?php
                                    $this->form_fields_display($main_search_fields, $filter_fields, $instance, $args);
                                    ?>
                                    

                                    <?php if( $show_advance_search && !empty($advance_search_fields)){
                                        $addvance_class = '';
                                        $href = 'javascript:void(0);';
                                        if ( $advance_search_layout_type == 'popup' ) {
                                            $addvance_class = 'popup';
                                            $href = '#advance-search-wrapper-'.esc_attr($widget_id);
                                        }
                                    ?>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="advance-link">
                                                    <a href="<?php echo trim($href); ?>" class=" advance-search-btn d-flex align-items-center <?php echo esc_attr($addvance_class); ?>">
                                                        <?php
                                                        if ( ! empty( $settings['icon'] ) ) {
                                                            $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
                                                            $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                                                        }
                                                        $migrated = isset( $settings['__fa4_migrated']['selected_icon_button_advanced'] );
                                                        $is_new = empty( $settings['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
                                                        if ( $is_new || $migrated ) {
                                                            Elementor\Icons_Manager::render_icon( $settings['selected_icon_button_advanced'], [ 'aria-hidden' => 'true' ] );
                                                        } else { ?>
                                                            <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                                                        <?php } ?>
                                                        <?php
                                                            if ( !empty($advanced_btn_text) ) { ?>
                                                                <span class="text"><?php echo esc_html($advanced_btn_text); ?></span>
                                                            <?php } else { ?>
                                                                <span class="text"><?php esc_html_e('Advanced Advanced ', 'justhome'); ?></span>
                                                            <?php }
                                                        ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>

                                <?php
                                if ( $show_advance_search && !empty($advance_search_fields) ) {
                                    ?>
                                    <div id="advance-search-wrapper-<?php echo esc_attr($widget_id); ?>" class="advance-search-wrapper">
                                        <div class="advance-search-wrapper-fields form-theme position-static">

                                            <?php
                                            if ( $advance_search_layout_type == 'popup' ) {
                                                ?>
                                                <div class="advance-search-top d-flex align-items-center">
                                                    <?php if ( !empty($advance_search_title) ) { ?>
                                                        <h4 class="advance-title"><?php echo esc_html($advance_search_title); ?></h4>
                                                    <?php } ?>
                                                    <div class="ms-auto">
                                                        <span class="close-advance-popup"><i class="ti-close"></i></span>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="inner-search-advance">
                                                <div class="inner">
                                                    <div class="row">
                                                        <?php
                                                        $this->form_fields_display($advance_search_fields, $filter_fields, $instance, $args);
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            if ( $advance_search_layout_type == 'popup' ) {
                                                ?>
                                                <div class="advance-search-bottom">
                                                    <?php if ( !empty($advance_search_btn_text) ) { ?>
                                                        <div class="row">
                                                            <div class="col-12 form-group-search">
                                                                <button class="submit-advance-search-btn btn-submit w-100 btn btn-theme <?php echo trim( ($filter_btn_text)?'':'no-text' ); ?>" type="submit" data-form_id="#filter-listing-form-<?php echo esc_attr($widget_id); ?>">
                                                                    <?php echo trim($advance_search_btn_text); ?>
                                                                    <?php
                                                                    if ( ! empty( $settings['icon'] ) ) {
                                                                        $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
                                                                        $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                                                                    }
                                                                    $migrated = isset( $settings['__fa4_migrated']['selected_icon_button'] );
                                                                    $is_new = empty( $settings['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
                                                                    if ( $is_new || $migrated ) {
                                                                        Elementor\Icons_Manager::render_icon( $settings['selected_icon_button'], [ 'aria-hidden' => 'true' ] );
                                                                    } else { ?>
                                                                        <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                                                                    <?php } ?>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                    <!-- Save Search -->
                                                    <?php if ( ($show_reset || $show_save_search) ) { ?>
                                                        <div class="row">
                                                            <div class="col-<?php echo esc_attr($reset_save_search_columns_mobile); ?> col-md-<?php echo esc_attr($reset_save_search_columns_tablet); ?> col-xl-<?php echo esc_attr($reset_save_search_columns); ?> search-action">
                                                                <div class="d-flex align-items-center justify-content-between">
                                                                    <?php if ( $show_reset ) { ?>
                                                                        <a href="javascript:void(0);" class="reset-search-btn">
                                                                            <i class="flaticon-turn-back"></i>
                                                                            <?php esc_html_e('Reset Search', 'justhome'); ?>
                                                                        </a>
                                                                    <?php } ?>
                                                                    <?php if ( $show_save_search ) { ?>
                                                                        <a href="#saved-search-form-btn-wrapper-<?php echo esc_attr($widget_id); ?>" class="save-search-btn btn-saved-search">
                                                                            <i class="flaticon-heart"></i>
                                                                            <?php esc_html_e('Save Search', 'justhome'); ?>
                                                                        </a>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                                <div class="row">
                                    <div class="col-<?php echo esc_attr($btn_columns_mobile); ?> col-md-<?php echo esc_attr($btn_columns_tablet); ?> col-xl-<?php echo esc_attr($btn_columns); ?> form-group-search">
                                        <button class="btn-submit w-100 btn btn-theme <?php echo trim( ($filter_btn_text)?'':'no-text' ); ?>" type="submit">
                                            <?php echo trim($filter_btn_text); ?>
                                            <?php
                                            if ( ! empty( $settings['icon'] ) ) {
                                                $this->add_render_attribute( 'icon', 'class', $settings['icon'] );
                                                $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                                            }
                                            $migrated = isset( $settings['__fa4_migrated']['selected_icon_button'] );
                                            $is_new = empty( $settings['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
                                            if ( $is_new || $migrated ) {
                                                Elementor\Icons_Manager::render_icon( $settings['selected_icon_button'], [ 'aria-hidden' => 'true' ] );
                                            } else { ?>
                                                <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                                            <?php } ?>
                                        </button>
                                    </div>
                                </div>

                                <!-- Save Search -->
                                <?php if ( ($show_reset || $show_save_search) && ($advance_search_layout_type !== 'popup')  ) { ?>
                                    <div class="row">
                                        <div class="col-<?php echo esc_attr($reset_save_search_columns_mobile); ?> col-md-<?php echo esc_attr($reset_save_search_columns_tablet); ?> col-xl-<?php echo esc_attr($reset_save_search_columns); ?> search-action">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <?php if ( $show_reset ) { ?>
                                                    <a href="javascript:void(0);" class="reset-search-btn">
                                                        <i class="flaticon-turn-back"></i>
                                                        <?php esc_html_e('Reset Search', 'justhome'); ?>
                                                    </a>
                                                <?php } ?>
                                                <?php if ( $show_save_search ) { ?>
                                                    <a href="#saved-search-form-btn-wrapper-<?php echo esc_attr($widget_id); ?>" class="save-search-btn btn-saved-search">
                                                        <i class="flaticon-heart"></i>
                                                        <?php esc_html_e('Save Search', 'justhome'); ?>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                        
                    <?php } ?>
                </div>
            </form>

            <?php if ( $show_save_search ) { ?>
                 <?php justhome_properties_display_save_search($widget_id); ?>
            <?php } ?>
        </div>
        <?php
    }

    public function form_fields_display($search_fields, $filter_fields, $instance, $args) {
        $i = 1;
        if ( !empty($search_fields) ) {
            foreach ($search_fields as $item) {
                if ( empty($filter_fields[$item['filter_field']]['field_call_back']) ) {
                    continue;
                }
                $filter_field = $filter_fields[$item['filter_field']];
                if ( isset($item['placeholder']) ) {
                    $filter_field['placeholder'] = $item['placeholder'];
                }

                if ( isset($item['title']) ) {
                    $filter_field['name'] = $item['title'];
                    $filter_field['show_title'] = true;
                } else {
                    $filter_field['show_title'] = false;
                }

                if ( isset($item['selected_icon']) ) {
                    ob_start();
                    $item['icon'] = '';
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
                    <?php }
                    $filter_field['icon_html'] = ob_get_clean();
                }

                $columns = !empty($item['columns']) ? $item['columns'] : 12;
                $columns_tablet = !empty($item['columns_tablet']) ? $item['columns_tablet'] : $item['columns'];
                $columns_mobile = !empty($item['columns_mobile']) ? $item['columns_mobile'] : 12;
                
                if ( $item['filter_field'] == 'title' ) {
                    if ($item['enable_autocompleate_search']) {
                        wp_enqueue_script( 'handlebars', get_template_directory_uri() . '/js/handlebars.min.js', array(), null, true);
                        wp_enqueue_script( 'typeahead-jquery', get_template_directory_uri() . '/js/typeahead.bundle.min.js', array('jquery', 'handlebars'), null, true);
                        $filter_field['add_class'] = 'apus-autocompleate-input';
                    }
                } elseif ( $item['filter_field'] == 'price' ) {
                    $filter_field['style'] = $item['style'];
                    $filter_field['min_price_placeholder'] = $item['min_price_placeholder'];
                    $filter_field['max_price_placeholder'] = $item['max_price_placeholder'];
                    $filter_field['price_range_size'] = $item['price_range_size'];
                    $filter_field['price_range_max'] = $item['price_range_max'];
                } elseif ( in_array($item['filter_field'], ['baths', 'beds', 'rooms', 'garages']) ) {
                    $filter_field['number_style'] = $item['number_style'];
                    $filter_field['min_number'] = $item['min_number'];
                    $filter_field['max_number'] = $item['max_number'];
                    if ( $item['number_filter_layout'] == 'radio') {
                        $filter_field['field_call_back'] = 'justhome_filter_field_location_select';
                    }
                } elseif ( in_array($item['filter_field'], ['home_area', 'lot_area', 'year_built']) ) {
                    $filter_field['slider_style'] = $item['slider_style'];
                    $filter_field['min_placeholder'] = $item['min_placeholder'];
                    $filter_field['max_placeholder'] = $item['max_placeholder'];
                }
                if ( in_array($item['filter_field'], ['home_area', 'lot_area']) ) {
                    $filter_field['suffix'] = $item['suffix'];
                }

                if ( $item['filter_layout'] && in_array($item['filter_field'], array('type', 'status', 'location', 'label', 'amenity', 'material')) ) {
                    switch ($item['filter_layout']) {
                        case 'radio':
                            $filter_field['field_call_back'] = array( 'WP_RealEstate_Abstract_Filter', 'filter_field_taxonomy_hierarchical_radio_list');
                            break;
                        case 'check_list':
                            $filter_field['field_call_back'] = array( 'WP_RealEstate_Abstract_Filter', 'filter_field_taxonomy_hierarchical_check_list');
                            break;
                        default:
                            if ( $item['filter_field'] == 'location' ) {
                                $filter_field['field_call_back'] = array( 'WP_RealEstate_Abstract_Filter', 'filter_field_location_select');
                            } else {
                                $filter_field['field_call_back'] = array( 'WP_RealEstate_Abstract_Filter', 'filter_field_taxonomy_hierarchical_select');
                            }
                            break;
                    }
                }
                ?>
                <div class="<?php echo trim( ($i== count($search_fields)?'last-item':'list-item') ); ?> col-<?php echo esc_attr($columns_mobile); ?> col-md-<?php echo esc_attr($columns_tablet); ?> col-xl-<?php echo esc_attr($columns); ?>">
                    <?php call_user_func( $filter_field['field_call_back'], $instance, $args, $item['filter_field'], $filter_field ); ?>
                </div>
                <?php $i++;
            }
        }
    }
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_RealEstate_Search_Form );
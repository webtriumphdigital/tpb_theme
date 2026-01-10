<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Print_Button extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_print_button';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Print Button', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-property-detail-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Print', 'justhome' ),
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'justhome' ),
				'type' => Elementor\Controls_Manager::TEXT,
				'default' => 'Print',
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
            'section_icon_style',
            [
                'label' => esc_html__( 'Icon Style', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_box_style' );

            $this->start_controls_tab(
                'tab_icon_normal',
                [
                    'label' => esc_html__( 'Normal', 'justhome' ),
                ]
            );

            $this->add_control(
                'color',
                [
                    'label' => esc_html__( 'Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .action-item [class*="btn"] i' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .action-item [class*="btn"] i' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'space_color',
                [
                    'label' => esc_html__( 'Border Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .action-item [class*="btn"] i' => 'border-color: {{VALUE}};',
                    ],
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
                'hv_color',
                [
                    'label' => esc_html__( 'Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .action-item [class*="btn"]:hover i,{{WRAPPER}} .action-item [class*="btn"]:focus i' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'bg_hv_color',
                [
                    'label' => esc_html__( 'Background Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .action-item [class*="btn"]:hover i, {{WRAPPER}} .action-item [class*="btn"]:focus i' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'space_hv_color',
                [
                    'label' => esc_html__( 'Border Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .action-item [class*="btn"]:hover i, {{WRAPPER}} .action-item [class*="btn"]:focus i' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        // end tab normal and hover

        $this->end_controls_section();

        $this->start_controls_section(
            'section_text_style',
            [
                'label' => esc_html__( 'Text Style', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .action-item span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        extract( $settings );

        if ( justhome_is_property_single_page() ) {
			$post_id = get_the_ID();
		} else {
			$args = array(
				'limit' => 1,
				'fields' => 'ids',
			);
			$properties = justhome_get_properties($args);
			if ( !empty($properties->posts) ) {
				$post_id = $properties->posts[0];
			}
		}
		if ( !empty($post_id) ) {
			?>
			<div class="action-item">
		        <a href="javascript:void(0);" class="btn-print-property <?php echo esc_attr($el_class); ?>" data-property_id="<?php echo esc_attr($post_id); ?>" data-nonce="<?php echo esc_attr(wp_create_nonce( 'justhome-printer-property-nonce' )); ?>" data-toggle="tooltip" title="<?php echo esc_attr($title); ?>"><i class="ti-printer"></i>
		        	<?php if(!empty($title)) {?>
		        		<span><?php echo trim($title); ?></span>
		        	<?php } ?>
		        </a>
	        </div>
			<?php
        }
	}
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Print_Button );

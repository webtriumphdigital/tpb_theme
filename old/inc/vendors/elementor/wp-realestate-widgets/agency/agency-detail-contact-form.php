<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Agency_Contact_Form extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_agency_contact_form';
	}

	public function get_title() {
		return esc_html__( 'Agency Details:: Contact Form', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-agency-detail-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Settings', 'justhome' ),
			]
		);

		$args = array(
			'post_type'   => 'wpcf7_contact_form',
			'numberposts' => -1,
		);
		$posts = get_posts( $args );
		$options = array();
		if ( $posts ) {
			foreach ($posts as $post) {
				$options[$post->ID] = $post->post_title;
			}
		}
		$this->add_control(
			'contact_form',
			[
				'label' => esc_html__( 'Contact Form', 'justhome' ),
				'type' => Elementor\Controls_Manager::SELECT,
				'default' => 'default',
				'options' => $options,
			]
		);

		$this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'default' => esc_html__('Default', 'justhome'),
                    'popup' => esc_html__('Popup', 'justhome'),
                ),
                'default' => 'default'
            ]
        );

		$this->add_control(
            'title', [
                'label' => esc_html__( 'Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'default' => '',
            ]
        );

		$this->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'default' => 'Send Email',
                'condition' => [
                    'layout_type' => 'popup',
                ],
            ]
        );

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'justhome' ),
				'type' => Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' => [
                    'layout_type' => 'popup',
                ],
			]
		);

		$this->add_control(
            'show_whatsapp',
            [
                'label'         => esc_html__( 'Show Whatsapp', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'default'       => 'yes',
            ]
        );

		$this->add_control(
			'whatsapp_title',
			[
				'label' => esc_html__( 'Whatsapp Title', 'justhome' ),
				'type' => Elementor\Controls_Manager::TEXT,
				'default' => 'Whatsapp',
				'condition' => [
                    'show_whatsapp' => 'yes',
                ],
			]
		);

		$this->add_control(
			'whatsapp_icon',
			[
				'label' => esc_html__( 'Whatsapp Icon', 'justhome' ),
				'type' => Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' => [
                    'show_whatsapp' => 'yes',
                ],
			]
		);

		$this->add_control(
            'show_phone_call',
            [
                'label'         => esc_html__( 'Show Phone Call', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'default'       => 'yes',
            ]
        );

		$this->add_control(
			'phone_call_title',
			[
				'label' => esc_html__( 'Phone Call Title', 'justhome' ),
				'type' => Elementor\Controls_Manager::TEXT,
				'default' => 'Call',
				'condition' => [
                    'show_phone_call' => 'yes',
                ],
			]
		);
		
		$this->add_control(
			'phone_call_icon',
			[
				'label' => esc_html__( 'Phone Call Icon', 'justhome' ),
				'type' => Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
				'condition' => [
                    'show_phone_call' => 'yes',
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
            'section_style',
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
	            'button_text_color',
	            [
	                'label' => esc_html__( 'Text Color', 'justhome' ),
	                'type' => Elementor\Controls_Manager::COLOR,
	                'default' => '',
	                'selectors' => [
	                    '{{WRAPPER}} .btn-show-popup ' => 'fill: {{VALUE}}; color: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_control(
	            'background_color',
	            [
	                'label' => esc_html__( 'Background Color', 'justhome' ),
	                'type' => Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .btn-show-popup ' => 'background-color: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
                Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border_button',
                    'label' => esc_html__( 'Border', 'justhome' ),
                    'selector' => '{{WRAPPER}} .btn-show-popup ',
                ]
            );

	        $this->end_controls_tab();

	        $this->start_controls_tab(
	            'tab_button_hover',
	            [
	                'label' => esc_html__( 'Hover', 'justhome' ),
	            ]
	        );

	        $this->add_control(
	            'hover_color',
	            [
	                'label' => esc_html__( 'Text Color', 'justhome' ),
	                'type' => Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .btn-show-popup:hover, {{WRAPPER}} .btn-show-popup:focus' => 'color: {{VALUE}};',
	                    '{{WRAPPER}} .btn-show-popup:hover svg, {{WRAPPER}} .btn-show-popup:focus svg' => 'fill: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_control(
	            'button_background_hover_color',
	            [
	                'label' => esc_html__( 'Background Color', 'justhome' ),
	                'type' => Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .btn-show-popup:hover, {{WRAPPER}} .btn-show-popup:focus' => 'background-color: {{VALUE}};',
	                ],
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
	                    '{{WRAPPER}} .btn-show-popup:hover, {{WRAPPER}} .btn-show-popup:focus' => 'border-color: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->end_controls_tab();

	        $this->end_controls_tabs();

	        $this->add_responsive_control(
	            'button_padding',
	            [
	                'label' => esc_html__( 'Padding', 'justhome' ),
	                'type' => Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => [ 'px', '%' ],
	                'selectors' => [
	                    '{{WRAPPER}} .btn-show-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'separator' => 'before',
	            ]
	        );

	        $this->add_responsive_control(
	            'button_border_radius',
	            [
	                'label' => esc_html__( 'Border Radius', 'justhome' ),
	                'type' => Elementor\Controls_Manager::DIMENSIONS,
	                'size_units' => [ 'px', '%' ],
	                'selectors' => [
	                    '{{WRAPPER}} .btn-show-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
	            Elementor\Group_Control_Typography::get_type(),
	            [
	                'label' => esc_html__( 'Typography', 'justhome' ),
	                'name' => 'btn_typography',
	                'selector' => '{{WRAPPER}} .btn-show-popup',
	            ]
	        );
		$this->end_controls_section();

		$this->start_controls_section(
            'section_style_icon',
            [
                'label' => esc_html__( 'Icon', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label' => esc_html__( 'Space', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .btn-show-popup i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Typography', 'justhome' ),
                'name' => 'icon_typography',
                'selector' => '{{WRAPPER}} .btn-show-popup i',
            ]
        );

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        extract( $settings );
        if ( justhome_is_agency_single_page() ) {
        	global $post;
			$post_id = get_the_ID();
		} else {
			$args = array(
				'limit' => 1,
				'fields' => 'ids',
			);
			$agencies = justhome_get_agencies($args);
			if ( !empty($agencies->posts) ) {
				$post_id = $agencies->posts[0];
				$post = get_post($post_id);
			}
		}
		if ( !empty($post) ) {
	        if ( $contact_form ) {
				?>
				<div class="agent-detail-element agency-detail-contact-form <?php echo esc_attr($el_class); ?>">
					<?php
					$rand = justhome_random_key();
					if ($layout_type == 'popup') {
						?>
						<a href="#contact-form-wrapper-<?php echo esc_attr($rand); ?>" class="btn-show-popup btn btn-theme w-100">
			                
			                <?php
			                if ( empty( $settings['icon'] ) && ! Elementor\Icons_Manager::is_migration_allowed() ) {
								// add old default
								$settings['icon'] = 'fa fa-star';
							}

							if ( ! empty( $settings['icon'] ) ) {
								$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
								$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
							}

							$migrated = isset( $settings['__fa4_migrated']['selected_icon'] );
							$is_new = empty( $settings['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
							if ( $is_new || $migrated ) {
								Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
							} else { ?>
								<i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
							<?php } ?>

			                <?php if ( $text ) {
		                		echo esc_html($text);
			            	} ?>
			            </a>
			            <div id="contact-form-wrapper-<?php echo esc_attr($rand); ?>" class="popup-inner contact-form-wrapper1 mfp-hide" data-effect="fadeIn">
			            	<div class="header-info d-flex align-items-center">
			            		<?php if ( !empty($title) ) { ?>
				                    <h3 class="title"><?php echo esc_html($title); ?></h3>
				                <?php } ?>
			            		<a href="javascript:void(0);" class="close-magnific-popup ms-auto"><i class="ti-close"></i></a>
			            	</div>
			            	<?php echo do_shortcode('[contact-form-7 id="'.$contact_form.'"]'); ?>
			            </div>
						<?php
					} else { ?>

						<?php if ( !empty($title) ) { ?>
		                    <h3 class="title"><?php echo esc_html($title); ?></h3>
		                <?php } ?>
						<?php echo do_shortcode('[contact-form-7 id="'.$contact_form.'"]'); ?>

					<?php }
					if ( $show_whatsapp || $show_phone_call ) {
						?>
						<div class="mt-20 d-flex column-gap-20">
							<?php
							$whatsapp = WP_RealEstate_Agency::get_post_meta( $post->ID, 'whatsapp' );
							$phone = WP_RealEstate_Agency::get_post_meta( $post->ID, 'phone' );
							if ( $show_phone_call && $phone ) {
								?>
								<a class="btn-phone btn btn-outline btn-theme w-100" href="tel:<?php echo esc_attr($phone); ?>" target="_blank">
									<?php if(!empty($phone_call_title)) { ?>
										<span class="text">
											<?php echo trim($phone_call_title); ?>
										</span>
									<?php } ?>
									<?php
									$settings['icon'] = '';
					                if ( empty( $settings['icon'] ) && ! Elementor\Icons_Manager::is_migration_allowed() ) {
										// add old default
										$settings['icon'] = 'fa fa-star';
									}

									if ( ! empty( $settings['icon'] ) ) {
										$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
										$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
									}

									$migrated = isset( $settings['__fa4_migrated']['phone_call_icon'] );
									$is_new = empty( $settings['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
									if ( $is_new || $migrated ) {
										Elementor\Icons_Manager::render_icon( $settings['phone_call_icon'], [ 'aria-hidden' => 'true' ] );
									} else { ?>
										<i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
									<?php } ?>

								</a>
								<?php
							}
							if ( $show_whatsapp && $whatsapp ) {
								?>

		                        <a class="btn-whatsapp btn btn-outline btn-theme w-100" href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($whatsapp); ?>&text=Hello" target="_blank">
		                        	<?php if(!empty($whatsapp_title)) { ?>
		                        		<span class="text">
											<?php echo trim($whatsapp_title); ?>
										</span>
									<?php } ?>
									<?php
									$settings['icon'] = '';
					                if ( empty( $settings['icon'] ) && ! Elementor\Icons_Manager::is_migration_allowed() ) {
										// add old default
										$settings['icon'] = 'fa fa-star';
									}

									if ( ! empty( $settings['icon'] ) ) {
										$this->add_render_attribute( 'icon', 'class', $settings['icon'] );
										$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
									}

									$migrated = isset( $settings['__fa4_migrated']['whatsapp_icon'] );
									$is_new = empty( $settings['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
									if ( $is_new || $migrated ) {
										Elementor\Icons_Manager::render_icon( $settings['whatsapp_icon'], [ 'aria-hidden' => 'true' ] );
									} else { ?>
										<i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
									<?php } ?>

								</a>
								<?php
							}
							?>
						</div>
						<?php
					}

					?>
				</div>
				<?php
			}
		}
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Agency_Contact_Form );

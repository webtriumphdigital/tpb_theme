<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Author_Info extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_author_info';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Author Info', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-property-detail-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Settings', 'justhome' ),
			]
		);

		$this->add_control(
            'show_avarta',
            [
                'label'         => esc_html__( 'Show Avarta', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
            ]
        );

        $this->add_control(
            'show_name',
            [
                'label'         => esc_html__( 'Show Name', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
            ]
        );

        $this->add_control(
            'show_email',
            [
                'label'         => esc_html__( 'Show Email', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
            ]
        );

		$this->add_control(
            'show_phone',
            [
                'label'         => esc_html__( 'Show Phone', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
            ]
        );

		$this->add_control(
            'show_whatsapp',
            [
                'label'         => esc_html__( 'Show Whatsapp', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
            ]
        );

		$this->add_control(
			'whatsapp_title',
			[
				'label' => esc_html__( 'Whatsapp Title', 'justhome' ),
				'type' => Elementor\Controls_Manager::TEXT,
				'default' => 'Chat Via Whatsapp',
				'condition' => [
                    'show_whatsapp' => 'yes',
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
                'label' => esc_html__( 'Box', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'box_bg_color',
            [
                'label' => esc_html__( 'Background', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                
                'selectors' => [
                    '{{WRAPPER}} .user-content-wrapper' => 'background: {{VALUE}};',
                ],
            ]
        );

		$this->add_responsive_control(
            'box_padding',
            [
                'label' => esc_html__( 'Padding', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .user-content-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'box_border',
                'label' => esc_html__( 'Border', 'justhome' ),
                'selector' => '{{WRAPPER}} .user-content-wrapper',
            ]
        );

        $this->add_responsive_control(
            'box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .user-content-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'justhome' ),
                'selector' => '{{WRAPPER}} .user-content-wrapper',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
            'section_button_message_style',
            [
                'label' => esc_html__( 'Button Message', 'justhome' ),
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
	                    '{{WRAPPER}} .send-private-message-btn ' => 'fill: {{VALUE}}; color: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_control(
	            'background_color',
	            [
	                'label' => esc_html__( 'Background Color', 'justhome' ),
	                'type' => Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .send-private-message-btn ' => 'background-color: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
                Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border_button',
                    'label' => esc_html__( 'Border', 'justhome' ),
                    'selector' => '{{WRAPPER}} .send-private-message-btn ',
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
	                    '{{WRAPPER}} .send-private-message-btn:hover, {{WRAPPER}} .send-private-message-btn:focus' => 'color: {{VALUE}};',
	                    '{{WRAPPER}} .send-private-message-btn:hover svg, {{WRAPPER}} .send-private-message-btn:focus svg' => 'fill: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_control(
	            'button_background_hover_color',
	            [
	                'label' => esc_html__( 'Background Color', 'justhome' ),
	                'type' => Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .send-private-message-btn:hover, {{WRAPPER}} .send-private-message-btn:focus' => 'background-color: {{VALUE}};',
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
	                    '{{WRAPPER}} .send-private-message-btn:hover, {{WRAPPER}} .send-private-message-btn:focus' => 'border-color: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->end_controls_tab();

	        $this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
            'section_button_whatsapp_style',
            [
                'label' => esc_html__( 'Button Whatsapp', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

	        $this->start_controls_tabs( 'tabs_button_whatsapp_style' );

	        $this->start_controls_tab(
	            'tab_button_whatsapp_normal',
	            [
	                'label' => esc_html__( 'Normal', 'justhome' ),
	            ]
	        );

	        $this->add_control(
	            'button_whatsapp_text_color',
	            [
	                'label' => esc_html__( 'Text Color', 'justhome' ),
	                'type' => Elementor\Controls_Manager::COLOR,
	                'default' => '',
	                'selectors' => [
	                    '{{WRAPPER}} .btn-whatsapp ' => 'fill: {{VALUE}}; color: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_control(
	            'whatsapp_background_color',
	            [
	                'label' => esc_html__( 'Background Color', 'justhome' ),
	                'type' => Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .btn-whatsapp ' => 'background-color: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_group_control(
                Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'whatsapp_border_button',
                    'label' => esc_html__( 'Border', 'justhome' ),
                    'selector' => '{{WRAPPER}} .btn-whatsapp ',
                ]
            );

	        $this->end_controls_tab();

	        $this->start_controls_tab(
	            'tab_button_whatsapp_hover',
	            [
	                'label' => esc_html__( 'Hover', 'justhome' ),
	            ]
	        );

	        $this->add_control(
	            'whatsapp_hover_color',
	            [
	                'label' => esc_html__( 'Text Color', 'justhome' ),
	                'type' => Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .btn-whatsapp:hover, {{WRAPPER}} .btn-whatsapp:focus' => 'color: {{VALUE}};',
	                    '{{WRAPPER}} .btn-whatsapp:hover svg, {{WRAPPER}} .btn-whatsapp:focus svg' => 'fill: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_control(
	            'whatsapp_button_background_hover_color',
	            [
	                'label' => esc_html__( 'Background Color', 'justhome' ),
	                'type' => Elementor\Controls_Manager::COLOR,
	                'selectors' => [
	                    '{{WRAPPER}} .btn-whatsapp:hover, {{WRAPPER}} .btn-whatsapp:focus' => 'background-color: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->add_control(
	            'whatsapp_button_hover_border_color',
	            [
	                'label' => esc_html__( 'Border Color', 'justhome' ),
	                'type' => Elementor\Controls_Manager::COLOR,
	                'condition' => [
	                    'border_button_border!' => '',
	                ],
	                'selectors' => [
	                    '{{WRAPPER}} .btn-whatsapp:hover, {{WRAPPER}} .btn-whatsapp:focus' => 'border-color: {{VALUE}};',
	                ],
	            ]
	        );

	        $this->end_controls_tab();

	        $this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

        extract( $settings );
        if ( justhome_is_property_single_page() ) {
        	global $post;
			$post_id = get_the_ID();
		} else {
			$args = array(
				'limit' => 1,
				'fields' => 'ids',
			);
			$properties = justhome_get_properties($args);
			if ( !empty($properties->posts) ) {
				$post_id = $properties->posts[0];
				$post = get_post($post_id);
			}
		}
		if ( !empty($post) ) {
			$author_id = $post->post_author;

			$whatsapp = $avatar = $a_phone = $a_url = '';
			if ( WP_RealEstate_User::is_agency($author_id) ) {
				$agency_id = WP_RealEstate_User::get_agency_by_user_id($author_id);
				$agency_post = get_post($agency_id);
				$author_email = justhome_agency_display_email($agency_post, 'no-title', false);
				
				$avatar = '';
				ob_start();
				justhome_agency_display_image($agency_post);
				$avatar = ob_get_clean();

				$a_url = get_permalink($agency_id);
				$a_title = get_the_title($agency_id);
				$a_title_html = '<a href="'.$a_url.'">'.get_the_title($agency_id).'</a>';
				$a_phone = justhome_agency_display_phone($agency_post, 'no-title', false);

				$whatsapp = WP_RealEstate_Agency::get_post_meta( $agency_id, 'whatsapp' );

			} elseif ( WP_RealEstate_User::is_agent($author_id) ) {
				$agent_id = WP_RealEstate_User::get_agent_by_user_id($author_id);
				$agent_post = get_post($agent_id);
				$author_email = justhome_agent_display_email($agent_post, 'no-title', false);

				$avatar = '';
				ob_start();
				justhome_agent_display_image($agent_post);
				$avatar = ob_get_clean();

				$a_url = get_permalink($agent_id);
				$a_title = get_the_title($agent_id);
				$a_title_html = '<a href="'.$a_url.'">'.get_the_title($agent_id).'</a>';
				$a_phone = justhome_agent_display_phone($agent_post, 'no-title', false);

				$whatsapp = WP_RealEstate_Agent::get_post_meta( $agent_id, 'whatsapp' );

			} else {
				$user_id = $post->post_author;
				$author_email = get_the_author_meta('user_email');
				$a_title = $a_title_html = get_user_meta( $user_id, 'first_name', true ).' '.get_user_meta( $user_id, 'last_name', true );
				$a_phone = get_user_meta($user_id, '_phone', true);
				$a_phone = justhome_user_display_phone($a_phone, 'no-title', false);
				$whatsapp = get_user_meta($author_id, '_user_whatsapp', true);

				$avatar = justhome_get_avatar($post->post_author, 90);
			}

	        ?>
			<div class="property-detail-author-info <?php echo esc_attr($el_class); ?>">
				<div class="user-content-wrapper d-flex align-items-center">
					<?php if ( $show_avarta ) { ?>
						<div class="user-thumbnail d-flex align-items-center justify-content-center flex-shrink-0">
							<?php if ( $a_url ) { ?>
							<a href="<?php echo esc_url( $a_url ); ?>">
							<?php } ?>
								<?php echo trim($avatar); ?>
							<?php if ( $a_url ) { ?>
							</a>
							<?php } ?>
						</div>
					<?php } ?>

					<div class="user-content flex-grow-1">
							<?php if ( $show_name ) { ?>
								<h3 class="title-user"><?php echo trim($a_title_html); ?></h3>
							<?php } ?>
							<?php if ( $show_email && $author_email ) { ?>
								<div class="author-email">
									<?php echo trim($author_email); ?></div>
							<?php } ?>

							<?php if ( $show_phone && $a_phone ) { ?>
								<div class="author-phone">
									<?php echo trim($a_phone); ?></div>
							<?php } ?>
						<?php if ( $show_whatsapp && $whatsapp ) { ?>
							<div class="user-content-bottom">
								<a class="btn btn-theme btn-outline btn-whatsapp w-100" href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($whatsapp); ?>&text=Hello" target="_blank">
									<?php echo esc_html($whatsapp_title); ?>
									<svg xmlns="http://www.w3.org/2000/svg" class="next" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg>
								</a>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php
	    }
	}
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Author_Info );

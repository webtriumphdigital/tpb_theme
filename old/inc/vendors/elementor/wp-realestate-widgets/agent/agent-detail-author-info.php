<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Agent_Author_Info extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_agent_author_info';
	}

	public function get_title() {
		return esc_html__( 'Agent Details:: Author Info', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-agent-detail-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Settings', 'justhome' ),
			]
		);

		$this->add_control(
            'show_avatar',
            [
                'label'         => esc_html__( 'Show Avatar', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'default'       => 'yes',
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

		$this->add_control(
            'show_address',
            [
                'label'         => esc_html__( 'Show Address', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'default'       => 'yes',
            ]
        );

		$this->add_control(
            'show_phone',
            [
                'label'         => esc_html__( 'Show Phone', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'default'       => 'yes',
            ]
        );

		$this->add_control(
            'show_fax',
            [
                'label'         => esc_html__( 'Show Fax', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'default'       => 'yes',
            ]
        );

		$this->add_control(
            'show_email',
            [
                'label'         => esc_html__( 'Show Email', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'default'       => 'yes',
            ]
        );

        $this->add_control(
            'show_website',
            [
                'label'         => esc_html__( 'Show Email', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'default'       => 'yes',
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
				'default' => 'Chat Via Whatsapp',
				'condition' => [
                    'show_whatsapp' => 'yes',
                ],
			]
		);

		$this->add_control(
            'show_social',
            [
                'label'         => esc_html__( 'Show Social', 'justhome' ),
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
			
			$phone = justhome_agent_display_phone($post, 'title', false, true);
			$fax = justhome_agent_display_meta_data($post, 'fax', esc_html__('Fax', 'justhome'), '', false);
			$email = justhome_agent_display_email($post, 'title', false);
			$website = justhome_agent_display_website($post, 'title', false);
			$location = justhome_agent_display_full_location($post, 'title', false);

			$whatsapp = WP_RealEstate_Agent::get_post_meta( $post->ID, 'whatsapp' );
			
	        ?>
			<div class="agent-detail-element agent-detail-author-info <?php echo esc_attr($el_class); ?>">
					<?php if ( $show_avatar ) {
						if ( $image_size == 'custom' ) {
				            if ( $image_custom_dimension['width'] && $image_custom_dimension['height'] ) {
				                $thumbsize = $image_custom_dimension['width'].'x'.$image_custom_dimension['height'];
				            } else {
				                $thumbsize = 'full';
				            }
				        } else {
				            $thumbsize = $image_size;
				        }
					?>
						<div class="user-thumbnail">
							<?php justhome_agent_display_image($post, $thumbsize); ?>
						</div>
					<?php } ?>

					<div class="agent-detail-user member-detail-user">
						<?php if ( $show_address && $location ) { ?>
							<?php echo trim($location); ?>
						<?php } ?>

						<?php if ( $show_phone && $phone ) { ?>
							<?php echo trim($phone); ?>
						<?php } ?>

						<?php if ( $show_fax && $fax ) { ?>
							<?php echo trim($fax); ?>
						<?php } ?>

						<?php if ( $show_email && $email ) { ?>
							<?php echo trim($email); ?>
						<?php } ?>

						<?php if ( $show_website && $website ) { ?>
							<?php echo trim($website); ?>
						<?php } ?>

						<?php if ( $show_whatsapp && $whatsapp ) { ?>
							<div class="whatsapp-wrapper">
		                		<span class="with-title"><?php esc_html_e('Whatsapp:', 'justhome');?> </span>
		                        <a class="btn-whatsapp" href="https://api.whatsapp.com/send?phone=<?php echo esc_attr($whatsapp); ?>&text=Hello" target="_blank">
									<?php echo trim($whatsapp_title); ?>
								</a>
	                        </div>
							
						<?php } ?>

						<?php if ( $show_social ) { ?>
							<div class="social-wrapper">
								<span class="with-title"><?php esc_html_e('Socials:', 'justhome');?> </span>
							<?php
					            $socials = get_post_meta( $post->ID, '_agent_socials', true );
					            $all_socials = WP_RealEstate_Mixes::get_socials_network();
					        ?>
					            <?php if ( $socials ) { ?>
				                    <?php foreach ($socials as $social) { ?>
				                        <?php if ( !empty($social['url']) && !empty($social['network']) ) {
				                            $icon_class = $social['network'];
				                        ?>
				                            <a href="<?php echo esc_url($social['url']); ?>">
				                                <i class="<?php echo esc_attr($icon_class); ?>"></i>
				                            </a>
				                        <?php } ?>
				                    <?php } ?>
					            <?php } ?>
					        </div>
						<?php } ?>
					</div>
			</div>
			<?php
	    }
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Agent_Author_Info );

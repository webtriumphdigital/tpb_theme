<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Justhome_Elementor_Private_Message_Form extends Elementor\Widget_Base {

	public function get_name() {
        return 'apus_element_private_message_form';
    }

	public function get_title() {
        return esc_html__( 'Private Message Form', 'justhome' );
    }
    
	public function get_categories() {
        return [ 'justhome-header-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__( 'Settings', 'justhome' ),
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
                'condition' => [
                    'layout_type' => 'popup',
                ],
            ]
        );

        $this->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'default' => 'Send Message',
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
        
        global $post;
        $user_id = $post->post_author;
        $rand = justhome_random_key();
        ?>
        <?php if(is_user_logged_in()) { ?>
            <div class="private-message-form <?php echo esc_attr($el_class); ?>">
                <?php
                if ($layout_type == 'popup') {
                    ?>
                    <a href="#contact-form-wrapper-<?php echo esc_attr($rand); ?>" class="btn-show-popup btn btn-theme w-100">
                        <?php if ( $text ) { ?>
                            <span class="text">
                                <?php echo esc_html($text); ?>
                            </span>
                        <?php } ?>
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
                    </a>
                    <div id="contact-form-wrapper-<?php echo esc_attr($rand); ?>" class="popup-inner contact-form-wrapper1 mfp-hide" data-effect="fadeIn">
                        <div class="header-info d-flex align-items-center">
                            <?php if ( !empty($title) ) { ?>
                                <h3 class="title"><?php echo esc_html($title); ?></h3>
                            <?php } ?>
                            <a href="javascript:void(0);" class="close-magnific-popup ms-auto"><i class="ti-close"></i></a>
                        </div>

                        <?php
                        if ( is_user_logged_in() ) {
                            ?>
                            <form id="send-message-form" class="send-message-form form-theme" action="?" method="post">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" id="subject" required="required">
                                    <label for="subject" class="for-control"><?php echo esc_html__('Subject','justhome'); ?></label>
                                </div>
                                <div class="form-group">
                                    <textarea id="message" class="form-control message" name="message" required="required"></textarea>
                                    <label for="message" class="for-control"><?php echo esc_html__('Enter text here...','justhome'); ?></label>
                                </div><!-- /.form-group -->

                                <?php wp_nonce_field( 'wp-private-message-send-message', 'wp-private-message-send-message-nonce' ); ?>
                                <input type="hidden" name="recipient" value="<?php echo esc_attr($user_id); ?>">
                                <input type="hidden" name="action" value="wp_private_message_send_message">
                                <button class="button btn btn-theme send-message-btn"><?php echo esc_html__( 'Send Message', 'justhome' ); ?><svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg></button>
                            </form>
                            <?php
                        } else {
                            ?>
                            <div class="login"><?php esc_html_e('Please login to send a private message', 'justhome'); ?></div>
                            <?php
                        }
                        ?>
                    </div>
                    <?php
                } else {
                    if ( is_user_logged_in() ) {
                        ?>
                        <form id="send-message-form" class="send-message-form form-theme" action="?" method="post">
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" required="required">
                                <label for="subject" class="for-control"><?php echo esc_html__('Subject','justhome'); ?></label>
                            </div>
                            <div class="form-group">
                                <textarea id="message" class="form-control message" name="message" required="required"></textarea>
                                <label for="message" class="for-control"><?php echo esc_html__('Enter text here...','justhome'); ?></label>
                            </div><!-- /.form-group -->

                            <?php wp_nonce_field( 'wp-private-message-send-message', 'wp-private-message-send-message-nonce' ); ?>
                            <input type="hidden" name="recipient" value="<?php echo esc_attr($user_id); ?>">
                            <input type="hidden" name="action" value="wp_private_message_send_message">
                            <button class="button btn btn-theme w-100 send-message-btn"><?php echo esc_html__( 'Send Message', 'justhome' ); ?><svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg></button>
                        </form>
                        <?php
                    } else {
                        ?>
                        <div class="login"><?php esc_html_e('Please login to send a private message', 'justhome'); ?></div>
                        <?php
                    }
                }
                ?>

            </div>
            <?php
        }
    }
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Private_Message_Form );
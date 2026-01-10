<?php

//namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Justhome_Elementor_User_Info extends Elementor\Widget_Base {

    public function get_name() {
        return 'apus_element_user_info';
    }

    public function get_title() {
        return esc_html__( 'Apus Header User Info', 'justhome' );
    }
    
    public function get_categories() {
        return [ 'justhome-header-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'layout_type',
            [
                'label' => esc_html__( 'Layout Type', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'popup' => esc_html__('Popup', 'justhome'),
                    'page' => esc_html__('Page', 'justhome'),
                ),
                'default' => 'popup'
            ]
        );

        $this->add_control(
            'login_title',
            [
                'label' => esc_html__( 'Login Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter title here', 'justhome' ),
                'condition' => [
                    'layout_type' => 'popup',
                ],
            ]
        );

        $this->add_control(
            'login_img',
            [
                'label' => esc_html__( 'Login Image', 'justhome' ),
                'type' => Elementor\Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Image Here', 'justhome' ),
                'condition' => [
                    'layout_type' => 'popup',
                ],
            ]
        );

        $this->add_control(
            'register_title',
            [
                'label' => esc_html__( 'Register Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'Enter title here', 'justhome' ),
                'condition' => [
                    'layout_type' => 'popup',
                ],
            ]
        );
        
        $this->add_control(
            'register_img',
            [
                'label' => esc_html__( 'Register Image', 'justhome' ),
                'type' => Elementor\Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Image Here', 'justhome' ),
                'condition' => [
                    'layout_type' => 'popup',
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
                'label' => esc_html__( 'Style Button', 'justhome' ),
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
                    'label' => esc_html__( 'Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .btn-login' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_button',
                    'label' => esc_html__( 'Background', 'justhome' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .btn-login',
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Border::get_type(),
                [
                    'name' => 'border_button',
                    'label' => esc_html__( 'Border', 'justhome' ),
                    'selector' => '{{WRAPPER}} .btn-login',
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
                    'label' => esc_html__( 'Color', 'justhome' ),
                    'type' => Elementor\Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .btn-login.active,{{WRAPPER}} .btn-login:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_group_control(
                Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'background_button_hover',
                    'label' => esc_html__( 'Background', 'justhome' ),
                    'types' => [ 'classic', 'gradient', 'video' ],
                    'selector' => '{{WRAPPER}} .btn-login.active,{{WRAPPER}} .btn-login:hover',
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
                        '{{WRAPPER}} .btn-login.active,{{WRAPPER}} .btn-login:hover' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        // end tab 

        $this->end_controls_section();

        $this->start_controls_section(
            'section_info',
            [
                'label' => esc_html__( 'Information', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__( 'Name Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .name-acount' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( is_user_logged_in() ) {
            $user_id = get_current_user_id();
            $userdata = get_userdata($user_id);
            $user_name = $userdata->display_name;
            
            $menu_nav = 'user-menu';

            if ( WP_RealEstate_User::is_agency($user_id) ) {
                $menu_nav = 'agency-menu';
                $agency_id = WP_RealEstate_User::get_agency_by_user_id($user_id);
                $user_name = get_post_field('post_title', $agency_id);
                $post_thumbnail_id = get_post_thumbnail_id($agency_id);
                $avatar = justhome_get_attachment_thumbnail( $post_thumbnail_id, 'thumbnail' );
            } elseif ( WP_RealEstate_User::is_agent($user_id) ) {
                $menu_nav = 'agent-menu';
                $agent_id = WP_RealEstate_User::get_agent_by_user_id($user_id);
                $user_name = get_post_field('post_title', $agent_id);
                $post_thumbnail_id = get_post_thumbnail_id($agent_id);
                $avatar = justhome_get_attachment_thumbnail( $post_thumbnail_id, 'thumbnail' );
            } else {
                $user_name = get_user_meta( $user_id, 'first_name', true ).' '.get_user_meta( $user_id, 'last_name', true );
            }
            ?>
            <div class="top-wrapper-menu author-verify <?php echo esc_attr($el_class); ?>">
                <a class="drop-dow" href="javascript:void(0);">
                    <div class="infor-account d-flex align-items-center">
                        <div class="avatar-wrapper d-flex justify-content-center align-items-center">
                            <?php if ( !empty($avatar)) {
                                echo trim($avatar);
                            } else {
                                echo justhome_get_avatar($user_id, 54);
                            } ?>
                        </div>
                        <div class="name-acount"><!--<?php echo esc_html($user_name); ?>-->
                            <?php if ( !empty($menu_nav) && has_nav_menu( $menu_nav ) ) { ?>
                                <!--<i class="ti-angle-down" aria-hidden="true"></i>-->
                            <?php } ?>
                        </div>
                    </div>
                </a>
                <?php
                    if ( !empty($menu_nav) && has_nav_menu( $menu_nav ) ) {
                        $args = array(
                            'theme_location' => $menu_nav,
                            'container_class' => 'inner-top-menu',
                            'menu_class' => 'nav navbar-nav topmenu-menu',
                            'fallback_cb' => '',
                            'menu_id' => '',
                            'walker' => new Justhome_Nav_Menu()
                        );
                        wp_nav_menu($args);
                    }
                ?>
            </div>
        <?php } else {
            $login_register_page_id = wp_realestate_get_option('login_register_page_id');
        ?>
            <div class="top-wrapper-menu not-login <?php echo esc_attr($el_class); ?>">
                <?php if ( $layout_type == 'page' ) { ?>
                    <a class="btn-login d-inline-flex align-items-center justify-content-center" href="<?php echo esc_url( get_permalink( $login_register_page_id ) ); ?>" title="<?php esc_attr_e('Sign in','justhome'); ?>">
                        <i class="flaticon-user"></i>
                    </a>
                <?php } else { ?>
                    <a class="btn-login btn-login-show-popup d-inline-flex align-items-center justify-content-center" href="#apus_login_forgot_form" title="<?php esc_attr_e('Login','justhome'); ?>">
                        <i class="flaticon-user"></i>
                    </a>

                    <div id="apus_login_forgot_form" class="apus_login_register_form mfp-hide" data-effect="fadeIn">
                        <span class="close-advance-popup"><i class="ti-close"></i></span>
                        <div class="form-login-register-inner">
                            <div class="row m-0 d-md-flex align-items-center">
                                <?php
                                $bcol = 12;
                                if ( !empty($login_img['id']) ) {
                                    $bcol = 6;
                                ?>
                                    <div class="p-0 col-md-<?php echo esc_attr($bcol); ?> d-md-block d-none banner-image">
                                        <?php echo justhome_get_attachment_thumbnail($login_img['id'], 'full'); ?>
                                    </div>
                                <?php } ?>
                                <div class="p-0 col-md-<?php echo esc_attr($bcol); ?> col-12">
                                    <div class="inner-right">
                                        <?php if ( !empty($login_title) ) { ?>
                                            <div class="header-info">
                                                <h3 class="title"><?php echo trim($login_title); ?></h3>
                                            </div>
                                        <?php } ?>

                                        <?php echo do_shortcode( '[wp_realestate_login]' ); ?>

                                        <div class="register-info">
                                            <?php esc_html_e('Don\'t you have an account?', 'justhome'); ?>
                                            <a class="apus-user-register" href="#apus_register_form">
                                                <?php esc_html_e('Register', 'justhome'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="apus_register_form" class="apus_login_register_form mfp-hide" data-effect="fadeIn">
                        <span class="close-advance-popup"><i class="ti-close"></i></span>
                        <div class="form-login-register-inner">
                            <div class="row m-0">
                                <?php
                                $bcol = 12;
                                if ( !empty($register_img['id']) ) {
                                    $bcol = 6;
                                ?>
                                    <div class="p-0 col-md-<?php echo esc_attr($bcol); ?> d-md-block d-none banner-image">
                                        <?php echo justhome_get_attachment_thumbnail($register_img['id'], 'full'); ?>
                                    </div>
                                <?php } ?>
                                <div class="p-0 col-md-<?php echo esc_attr($bcol); ?> col-12">
                                    <div class="inner-right">
                                        <?php if ( !empty($register_title) ) { ?>
                                            <div class="header-info">
                                                <h3 class="title"><?php echo trim($register_title); ?></h3>
                                            </div>
                                        <?php } ?>
                                        <?php echo do_shortcode( '[wp_realestate_register]' ); ?>

                                        <div class="login-info">
                                            <?php esc_html_e('Already have an account?', 'justhome'); ?>
                                            <a class="apus-user-login" href="#apus_login_forgot_form">
                                                <?php esc_html_e('Login', 'justhome'); ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php } ?>
            </div>
        <?php }
    }
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_User_Info );

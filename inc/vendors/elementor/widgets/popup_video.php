<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Justhome_Elementor_Popup_Video extends Widget_Base {

	public function get_name() {
        return 'apus_element_popup_video';
    }

	public function get_title() {
        return esc_html__( 'Apus Popup Video', 'justhome' );
    }

	public function get_icon() {
        return 'eicon-youtube';
    }

	public function get_categories() {
        return [ 'justhome-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content', 'justhome' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label' => esc_html__( 'Youtube Video Link', 'justhome' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'justhome' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'justhome'),
                ),
                'default' => 'style1'
            ]
        );
   		$this->add_control(
            'el_class',
            [
                'label'         => esc_html__( 'Extra class name', 'justhome' ),
                'type'          => Controls_Manager::TEXT,
                'placeholder'   => esc_html__( 'If you wish to style particular content element differently, please add a class name to this field and refer to it in your custom CSS file.', 'justhome' ),
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__( 'Style', 'justhome' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'size',
            [
                'label' => esc_html__( 'Size', 'justhome' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1440,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} a.popup-video .popup-video-inner' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
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
                'icon_color',
                [
                    'label' => esc_html__( 'Color', 'justhome' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.popup-video .popup-video-inner' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'justhome' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.popup-video .popup-video-inner' => 'background-color: {{VALUE}};',
                    ],
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
                'icon_hv_color',
                [
                    'label' => esc_html__( 'Color', 'justhome' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.popup-video:hover .popup-video-inner' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_hv_bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'justhome' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} a.popup-video:hover .popup-video-inner' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        // end tab normal and hover

        $this->add_control(
            'icon_before_bg_color',
            [
                'label' => esc_html__( 'Background Overlay', 'justhome' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} a.popup-video .popup-video-inner::before' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget-video <?php echo esc_attr($el_class);?>">
            <div class="video-wrapper-inner">
                <?php
                if ( !empty($img_src['id']) ) {
                ?>
                    <?php echo justhome_get_attachment_thumbnail($img_src['id'], 'full'); ?>
                <?php } ?>
                <a class="popup-video d-inline-flex align-items-center justify-content-center <?php echo esc_attr($style);?>" href="<?php echo esc_url($video_link); ?>">
                    <span class="popup-video-inner d-flex align-items-center justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 22 22" fill="none">
<path d="M4.98509 20.9C5.5015 20.8992 6.00851 20.7618 6.45469 20.5018L18.4799 13.5454C18.9267 13.2874 19.2977 12.9164 19.5557 12.4696C19.8136 12.0228 19.9495 11.5159 19.9495 11C19.9495 10.4841 19.8136 9.97723 19.5557 9.53042C19.2977 9.08361 18.9267 8.71257 18.4799 8.4546L6.45469 1.507C6.00784 1.25183 5.50187 1.11835 4.98729 1.11989C4.47272 1.12142 3.96755 1.25793 3.52223 1.51577C3.07692 1.77361 2.70703 2.14376 2.44951 2.58926C2.192 3.03476 2.05586 3.54003 2.05469 4.0546V17.9454C2.05351 18.7252 2.3611 19.4737 2.91022 20.0274C3.45934 20.581 4.20532 20.8948 4.98509 20.9ZM3.58369 4.0546C3.58186 3.80827 3.64572 3.56591 3.76868 3.35246C3.89165 3.13901 4.06928 2.96219 4.28329 2.8402C4.49604 2.71634 4.73781 2.65108 4.98399 2.65108C5.23017 2.65108 5.47195 2.71634 5.68469 2.8402L17.7165 9.7878C17.9284 9.91084 18.1042 10.0874 18.2265 10.2997C18.3487 10.5121 18.4131 10.7528 18.4131 10.9978C18.4131 11.2428 18.3487 11.4835 18.2265 11.6959C18.1042 11.9082 17.9284 12.0848 17.7165 12.2078L5.68469 19.1598C5.47162 19.2826 5.23001 19.3471 4.98411 19.3469C4.73821 19.3467 4.49668 19.2819 4.28379 19.1588C4.0709 19.0358 3.89413 18.8589 3.77124 18.6459C3.64835 18.4329 3.58367 18.1913 3.58369 17.9454V4.0546Z" fill="currentColor"/>
</svg>
                    </span>
                </a>
            </div>
        </div>
        <?php
    }
}

Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Popup_Video );
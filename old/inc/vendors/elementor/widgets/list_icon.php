<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Justhome_Elementor_List_Icon extends Widget_Base {

	public function get_name() {
        return 'apus_element_list_icon';
    }

	public function get_title() {
        return esc_html__( 'Apus List Icon', 'justhome' );
    }

	public function get_icon() {
        return 'eicon-bullet-list';
    }

	public function get_categories() {
        return [ 'justhome-elements' ];
    }

	protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'List Icon', 'justhome' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'image_icon',
            [
                'label' => esc_html__( 'Image or Icon', 'justhome' ),
                'type' => Controls_Manager::SELECT,
                'options' => array(
                    'icon' => esc_html__('Icon', 'justhome'),
                    'image' => esc_html__('Image', 'justhome'),
                ),
                'default' => 'image'
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Icon', 'justhome' ),
                'type' => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'condition' => [
                    'image_icon' => 'icon',
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__( 'Choose Image', 'justhome' ),
                'type' => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'image_icon' => 'image',
                ],
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
                'condition' => [
                    'image_icon' => 'image',
                ],
            ]
        );
        $repeater->add_control(
            'title_text',
            [
                'label' => esc_html__( 'Title', 'justhome' ),
                'type' => Controls_Manager::TEXT,
                'default' => '',
                'placeholder' => '',
            ]
        );

        $repeater->add_control(
            'description_text',
            [
                'label' => esc_html__( 'Content', 'justhome' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => '',
                'placeholder' => '',

            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Link to', 'justhome' ),
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'https://your-link.com', 'justhome' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'features',
            [
                'label' => esc_html__( 'List Icon', 'justhome' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
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
            'section_box_style',
            [
                'label' => esc_html__( 'Box Style', 'justhome' ),
                'tab' => Controls_Manager::TAB_STYLE,
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
                'color',
                [
                    'label' => esc_html__( 'Color', 'justhome' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .list-icon' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'bg_color',
                [
                    'label' => esc_html__( 'Background Color', 'justhome' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .list-icon' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'space_color',
                [
                    'label' => esc_html__( 'Border Color', 'justhome' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .list-icon .box-content' => 'border-color: {{VALUE}};',
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
                'hv_color',
                [
                    'label' => esc_html__( 'Color', 'justhome' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .list-icon:hover,{{WRAPPER}} .list-icon:focus' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'bg_hv_color',
                [
                    'label' => esc_html__( 'Background Color', 'justhome' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .list-icon:hover, {{WRAPPER}} .list-icon:focus' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'space_hv_color',
                [
                    'label' => esc_html__( 'Border Color', 'justhome' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .list-icon:hover .box-content, {{WRAPPER}} .list-icon:focus .box-content' => 'border-color: {{VALUE}};',
                    ],
                ]
            );

            $this->end_controls_tab();

        $this->end_controls_tabs();
        // end tab normal and hover

        $this->end_controls_section();

    }

	protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($features) ) {
            ?>
            <div class="widget-list-icon <?php echo esc_attr($el_class); ?>">
                    <?php foreach ($features as $item): ?>
                            <?php if ( ! empty( $item['link']['url'] ) ) { ?>
                                <a href="<?php echo esc_url($item['link']['url']); ?>" 
                                    target="<?php echo esc_attr($item['link']['is_external'] ? '_blank' : '_self'); ?>" 
                                    <?php echo trim($item['link']['nofollow'] ? 'rel="nofollow"' : ''); ?> class="w-100 list-icon d-flex align-items-center <?php echo esc_attr($style); ?>">
                            <?php } else { ?>
                                <a href="javascript:void(0)" class="w-100 list-icon d-flex align-items-center <?php echo esc_attr($style); ?>">
                            <?php } ?>
                                    <?php
                                    $has_content = ! empty( $item['title_text'] ) || ! empty( $item['description_text'] );
                                    $html = '';

                                    if ( $item['image_icon'] == 'image' ) {
                                        if ( ! empty( $item['image']['url'] ) ) {
                                            $this->add_render_attribute( 'image', 'src', $item['image']['url'] );
                                            $this->add_render_attribute( 'image', 'alt', Control_Media::get_image_alt( $item['image'] ) );
                                            $this->add_render_attribute( 'image', 'title', Control_Media::get_image_title( $item['image'] ) );


                                            $image_html = Group_Control_Image_Size::get_attachment_image_html( $item, 'thumbnail', 'image' );

                                            $html .= '<div class="list-icon-left img">' . $image_html . '</div>';
                                        }
                                    } elseif ( $item['image_icon'] == 'icon' ) {
                                        $html .= '<div class="list-icon-left icon">';
                                            ob_start();
                                            if ( empty( $item['icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
                                                // add old default
                                                $item['icon'] = 'fa fa-star';
                                            }

                                            if ( ! empty( $item['icon'] ) ) {
                                                $this->add_render_attribute( 'icon', 'class', $item['icon'] );
                                                $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                                            }

                                            $migrated = isset( $item['__fa4_migrated']['selected_icon'] );
                                            $is_new = empty( $item['icon'] ) && Icons_Manager::is_migration_allowed();
                                            if ( $is_new || $migrated ) {
                                                Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
                                            } else { ?>
                                                <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                                            <?php }
                                            $html .= ob_get_clean();
                                        $html .= '</div>';
                                    }
                                if ( $has_content ) {
                                    $html .= '<div class="box-content">';

                                    if ( ! empty( $item['description_text'] ) ) {
                                        $html .= sprintf( '<div class="description">%1$s</div>', $item['description_text'] );
                                    }
                                    if ( ! empty( $item['title_text'] ) ) {
                                        
                                        $title_html = $item['title_text'];

                                        $html .= sprintf( '<h3 class="title">%1$s</h3>', $title_html );
                                    }

                                    $html .= '</div>';
                                }

                                echo trim($html);
                                ?>

                            </a>
                    <?php endforeach; ?>
            </div>
            <?php
        }
    }
}
Plugin::instance()->widgets_manager->register( new Justhome_Elementor_List_Icon );

<?php

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Justhome_Elementor_Team extends Widget_Base {

    public function get_name() {
        return 'apus_element_team';
    }

    public function get_title() {
        return esc_html__( 'Apus Teams', 'justhome' );
    }

    public function get_icon() {
        return 'fa fa-users';
    }

    public function get_categories() {
        return [ 'justhome-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Team', 'justhome' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title', [
                'label' => esc_html__( 'Social Title', 'justhome' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Social Title' , 'justhome' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Social Link', 'justhome' ),
                'type' => Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your social link here', 'justhome' ),
            ]
        );

        $repeater->add_control(
            'selected_icon',
            [
                'label' => esc_html__( 'Social Icon', 'justhome' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-star',
            ]
        );

        $this->add_control(
            'name', [
                'label' => esc_html__( 'Member Name', 'justhome' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Member Name' , 'justhome' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'property', [
                'label' => esc_html__( 'Member Property', 'justhome' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Member Property' , 'justhome' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'img_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Image', 'justhome' ),
                'type' => Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Image Here', 'justhome' ),
            ]
        );

        $this->add_control(
            'description', [
                'label' => esc_html__( 'Member Description', 'justhome' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Member Description' , 'justhome' ),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'socials',
            [
                'label' => esc_html__( 'Socials', 'justhome' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
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
            'section_title_style',
            [
                'label' => esc_html__( 'Title', 'justhome' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Background Hover Color', 'justhome' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => [
                    'type' => Core\Schemes\Color::get_type(),
                    'value' => Core\Schemes\Color::COLOR_1,
                ],
                'selectors' => [
                    // Stronger selector to avoid section style from overwriting
                    '{{WRAPPER}} .social a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget widget-team <?php echo esc_attr($el_class); ?>">
            <div class="team-item">
                <div class="top-image">
                    <?php
                    if ( !empty($settings['img_src']['id']) ) {
                    ?>
                        <div class="team-image">
                            <?php echo justhome_get_attachment_thumbnail($settings['img_src']['id'], 'full'); ?>
                        </div>
                    <?php } ?>
                </div>
                <?php if ( !empty($socials) ) { ?>
                    <ul class="social">
                        <?php foreach ($socials as $social) { ?>
                            <?php if ( !empty($social['link']) && !empty($social['icon']) ) { ?>
                                <li>
                                    <a href="<?php echo esc_url($social['link']);?>" <?php echo esc_html(!empty($social['title']) ? 'title="'.$social['title'].'"' : ''); ?>>
                                        <?php
                                        $social['icon'] = '';
                                        if ( ! empty( $social['icon'] ) ) {
                                            $this->add_render_attribute( 'icon', 'class', $social['icon'] );
                                            $this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
                                        }
                                        $migrated = isset( $social['__fa4_migrated']['selected_icon'] );
                                        $is_new = empty( $social['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
                                        if ( $is_new || $migrated ) {
                                            Elementor\Icons_Manager::render_icon( $social['selected_icon'], [ 'aria-hidden' => 'true' ] );
                                        } else { ?>
                                            <i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
                                        <?php } ?>
                                    </a>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </div>
            <div class="content">
                <?php if ( !empty($property) ) { ?>
                    <div class="property text-theme"><?php echo esc_html($property); ?></div>
                <?php } ?>
                <?php if ( !empty($name) ) { ?>
                    <h3 class="name-team"><?php echo esc_html($name); ?></h3>
                <?php } ?>
            </div>
        </div>
        <?php
    }

}

Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Team );
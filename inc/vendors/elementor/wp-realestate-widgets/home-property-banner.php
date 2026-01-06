<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Justhome_Elementor_RealEstate_Property_Banner extends Elementor\Widget_Base {

    public function get_name() {
        return 'apus_element_realestate_property_banner';
    }

    public function get_title() {
        return esc_html__( 'Apus Property Banner', 'justhome' );
    }
    
    public function get_categories() {
        return [ 'justhome-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Property Banner', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'tagline',
            [
                'label' => esc_html__( 'Tagline', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title here', 'justhome' ),
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__( 'Property Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title here', 'justhome' ),
            ]
        );

        $this->add_control(
            'property_id',
            [
                'label' => esc_html__( 'Property ID', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your Property ID here', 'justhome' ),
            ]
        );

        $this->add_control(
            'custom_url',
            [
                'label' => esc_html__( 'Custom URL', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'url',
                'placeholder' => esc_html__( 'Enter your custom url here', 'justhome' ),
            ]
        );

        $this->add_control(
            'img_bg_src',
            [
                'name' => 'image',
                'label' => esc_html__( 'Image', 'justhome' ),
                'type' => Elementor\Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Image Here', 'justhome' ),
            ]
        );

        $this->add_responsive_control(
            'height',
            [
                'label' => esc_html__( 'Height', 'justhome' ),
                'type' => Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1440,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .property-banner-inner' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Style 1', 'justhome'),
                    'style2' => esc_html__('Style 2', 'justhome'),
                ),
                'default' => ''
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
            'section_overlay',
            [
                'label' => esc_html__( 'Box', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_overlay',
                'label' => esc_html__( 'Background Overlay', 'justhome' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .property-banner-inner:before',
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'justhome' ),
                'type' => Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .property-banner-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__( 'Typography', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Title Typography', 'justhome' ),
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .title',
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label' => esc_html__( 'Number Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Typography::get_type(),
            [
                'label' => esc_html__( 'Number Typography', 'justhome' ),
                'name' => 'number_typography',
                'selector' => '{{WRAPPER}} .number',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        ?>
        <div class="widget-property-banner <?php echo esc_attr($el_class); ?>">

            <?php
            $post = get_post($property_id);

            $img_bg_src = ( isset( $img_bg_src['id'] ) && $img_bg_src['id'] != 0 ) ? wp_get_attachment_url( $img_bg_src['id'] ) : '';
            $style_bg = '';
            if ( !empty($img_bg_src) ) {
                $style_bg = 'style="background-image:url('.esc_url($img_bg_src).')"';
            }
            $link = $custom_url;
            if ( !empty($post) ) {
                if ( empty($link) ) {
                    $link = get_permalink($post);
                }
            }
            ?>
            <?php if($style == 'style2'){ ?>
                <div class="property-banner-inner style2 position-relative" <?php echo trim($style_bg); ?>>
                    <?php
                        $featured = justhome_property_display_featured_icon($post, false);
                        $labels = justhome_property_display_label($post, false);
                        $status = justhome_property_display_status_label($post, false);
                        if ( $featured || $labels || $status ) {
                            ?>
                            <div class="top-label d-flex align-items-center">
                                <?php justhome_property_display_status_label($post, true); ?>
                                <?php if ( $featured ) { ?>
                                    <?php echo trim($featured); ?>
                                <?php } ?>
                                <?php if ( $labels ) { ?>
                                    <?php echo trim($labels); ?>
                                <?php } ?>
                            </div>
                            <?php
                        }
                    ?>
                    <?php
                    if ( empty($title) ) {
                        $title = !empty($post->post_title) ? $post->post_title : '';
                    }
                    ?>
                    <div class="bottom-info d-flex align-items-end">
                        <div class="inner flex-grow-1">
                            <?php justhome_property_display_price($post, 'no-icon-title', true); ?>
                            <h4 class="property-title">
                                <a href="<?php echo esc_url($link); ?>">
                                    <?php echo trim($title); ?>
                                </a>
                            </h4>
                            <?php justhome_property_display_full_location($post, 'icon'); ?>
                            <div class="metas-bottom">
                                <?php
                                if ( !empty($post) ) {
                                    $meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);

                                    $beds = justhome_property_display_meta($post, 'beds', 'flaticon-hotel', false, $meta_obj->get_post_meta_title( 'beds' ));
                                    $baths = justhome_property_display_meta($post, 'baths', 'flaticon-bathtub', false, $meta_obj->get_post_meta_title( 'baths' ));

                                    $suffix = wp_realestate_get_option('measurement_unit_area');
                                    $lot_area = justhome_property_display_meta($post, 'lot_area', ' flaticon-minus-front', false, $suffix);

                                    if ( $lot_area || $beds || $baths || $garages ) {
                                    ?>
                                        <div class="property-metas d-flex flex-wrap">
                                            <?php
                                                echo trim($beds);
                                                echo trim($baths);
                                                echo trim($lot_area);
                                            ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <a class="flex-shrink-0 direction d-inline-flex align-items-center justify-content-center" href="<?php echo esc_url($link); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg>
                        </a>
                    </div>
                </div>
            <?php } else{ ?>
                <div class="property-banner-inner position-relative" <?php echo trim($style_bg); ?>>
                    <?php
                        $featured = justhome_property_display_featured_icon($post, false);
                        $labels = justhome_property_display_label($post, false);
                        $status = justhome_property_display_status_label($post, false);
                        if ( $featured || $labels || $status ) {
                            ?>
                            <div class="top-label d-flex align-items-center">
                                <?php justhome_property_display_status_label($post, true); ?>
                                <?php if ( $featured ) { ?>
                                    <?php echo trim($featured); ?>
                                <?php } ?>
                                <?php if ( $labels ) { ?>
                                    <?php echo trim($labels); ?>
                                <?php } ?>
                            </div>
                            <?php
                        }
                    ?>
                    <?php
                    if ( empty($title) ) {
                        $title = !empty($post->post_title) ? $post->post_title : '';
                    }
                    ?>
                    <div class="bottom-info d-flex align-items-end">
                        <div class="inner flex-grow-1">
                            <h4 class="property-title">
                                <a href="<?php echo esc_url($link); ?>">
                                    <?php echo trim($title); ?>
                                </a>
                            </h4>
                            <?php justhome_property_display_full_location($post, 'icon'); ?>
                            <div class="metas-bottom d-flex align-items-center flex-wrap">
                                <?php justhome_property_display_price($post, 'no-icon-title', true); ?>
                                <?php
                                if ( !empty($post) ) {
                                    $meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);

                                    $beds = justhome_property_display_meta($post, 'beds', 'flaticon-hotel', false, $meta_obj->get_post_meta_title( 'beds' ));
                                    $baths = justhome_property_display_meta($post, 'baths', 'flaticon-bathtub', false, $meta_obj->get_post_meta_title( 'baths' ));

                                    $suffix = wp_realestate_get_option('measurement_unit_area');
                                    $lot_area = justhome_property_display_meta($post, 'lot_area', ' flaticon-minus-front', false, $suffix);

                                    if ( $lot_area || $beds || $baths || $garages ) {
                                    ?>
                                        <div class="property-metas d-flex flex-wrap">
                                            <?php
                                                echo trim($beds);
                                                echo trim($baths);
                                                echo trim($lot_area);
                                            ?>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                        <a class="flex-shrink-0 direction d-inline-flex align-items-center justify-content-center" href="<?php echo esc_url($link); ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg>
                        </a>
                    </div>
                </div>
            <?php } ?>
            
        </div>
        <?php
    }
}
Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_RealEstate_Property_Banner );
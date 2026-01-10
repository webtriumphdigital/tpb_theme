<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Justhome_Elementor_RealEstate_Properties_Slider extends Elementor\Widget_Base {

    public function get_name() {
        return 'apus_element_realestate_properties_slider';
    }

    public function get_title() {
        return esc_html__( 'Apus Properties Slider', 'justhome' );
    }
    
    public function get_categories() {
        return [ 'justhome-elements' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Properties', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'property_id', [
                'label' => esc_html__( 'Property ID', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter property ID', 'justhome' ),
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'condition' => [
                    'style' => 'style2',
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'name' => 'image',
                'label' => esc_html__( 'Image', 'justhome' ),
                'type' => Elementor\Controls_Manager::MEDIA,
                'placeholder'   => esc_html__( 'Upload Image', 'justhome' ),
            ]
        );

        $this->add_control(
            'sliders',
            [
                'label' => esc_html__( 'Sliders', 'justhome' ),
                'type' => Elementor\Controls_Manager::REPEATER,
                'placeholder' => esc_html__( 'Enter your property tabs here', 'justhome' ),
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control(
            'show_nav',
            [
                'label'         => esc_html__( 'Show Navigation', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
            ]
        );

        $this->add_control(
            'show_pagination',
            [
                'label'         => esc_html__( 'Show Pagination', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'         => esc_html__( 'Autoplay', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'justhome' ),
                'label_off'     => esc_html__( 'No', 'justhome' ),
            ]
        );

        $this->add_control(
            'infinite_loop',
            [
                'label'         => esc_html__( 'Infinite Loop', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'justhome' ),
                'label_off'     => esc_html__( 'No', 'justhome' ),            ]
        );

        $this->add_control(
            'navigation_stretch',
            [
                'label'         => esc_html__( 'Stretch Navigation', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Yes', 'justhome' ),
                'label_off'     => esc_html__( 'No', 'justhome' ),
                'condition' => [
                    'show_nav' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    'style1' => esc_html__('Style 1', 'justhome'),
                    'style2' => esc_html__('Style 2', 'justhome'),
                ),
                'default' => 'style1',
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
                    '{{WRAPPER}} .property-item' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'style' => 'style2',
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
                'label' => esc_html__( 'Style', 'justhome' ),
                'tab' => Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__( 'Background Color', 'justhome' ),
                'type' => Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inner-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings();

        extract( $settings );

        if ( !empty($sliders) ) {
            $columns = !empty($columns) ? $columns : 1;
            $columns_tablet = !empty($columns_tablet) ? $columns_tablet : 1;
            $columns_mobile = !empty($columns_mobile) ? $columns_mobile : 1;
            
            $slides_to_scroll = !empty($slides_to_scroll) ? $slides_to_scroll : $columns;
            $slides_to_scroll_tablet = !empty($slides_to_scroll_tablet) ? $slides_to_scroll_tablet : $slides_to_scroll;
            $slides_to_scroll_mobile = !empty($slides_to_scroll_mobile) ? $slides_to_scroll_mobile : 1;
        ?>
        <div class="widget-properties-slider <?php echo esc_attr($el_class.' '.$style); ?> <?php echo esc_attr( (!empty($navigation_stretch))?'navigation_stretch':''); ?>">
            <div class="slick-carousel no-gap" 
            data-items="<?php echo esc_attr($columns); ?>"
            data-large="<?php echo esc_attr( $columns_tablet ); ?>"
            data-medium="<?php echo esc_attr( $columns_tablet ); ?>"
            data-small="<?php echo esc_attr($columns_mobile); ?>"
            data-smallest="<?php echo esc_attr($columns_mobile); ?>"

            data-slidestoscroll="<?php echo esc_attr($slides_to_scroll); ?>"
            data-slidestoscroll_large="<?php echo esc_attr( $slides_to_scroll_tablet ); ?>"
            data-slidestoscroll_medium="<?php echo esc_attr( $slides_to_scroll_tablet ); ?>"
            data-slidestoscroll_small="<?php echo esc_attr($slides_to_scroll_mobile); ?>"
            data-slidestoscroll_smallest="<?php echo esc_attr($slides_to_scroll_mobile); ?>"
            data-pagination="<?php echo esc_attr( $show_pagination ? 'true' : 'false' ); ?>" data-nav="<?php echo esc_attr( $show_nav ? 'true' : 'false' ); ?>" data-infinite="<?php echo esc_attr( $infinite_loop ? 'true' : 'false' ); ?>" data-autoplay="<?php echo esc_attr( $autoplay ? 'true' : 'false' ); ?>">
                <?php foreach ($sliders as $slider): ?>
                    <?php 
                        $img_bg_src = ( isset( $slider['image']['id'] ) && $slider['image']['id'] != 0 ) ? wp_get_attachment_url( $slider['image']['id'] ) : '';
                        $style_bg = '';
                        if ( !empty($img_bg_src) ) {
                            $style_bg = 'style="background-image:url('.esc_url($img_bg_src).')"';
                        }
                    ?>
                    <div class="item">
                            <?php if($style == 'style1'){ ?>
                                <div class="property-item m-0 property-grid-slider-style1">
                                        <?php
                                        if ( !empty($slider['property_id']) ) {

                                            $post_object = get_post( $slider['property_id'] );
                                            if ( $post_object ) {
                                                setup_postdata( $GLOBALS['post'] =& $post_object );
                                                global $post;
                                                if(!empty($slider['image']['id'])){
                                                    $firstclass= "col-md-6";
                                                } else {
                                                    $firstclass= "";
                                                }
                                                ?>
                                                    <div class="row m-0 align-items-center">
                                                        <?php
                                                        if ( !empty($slider['image']['id']) ) {
                                                        ?>
                                                            <div class="col-12 col-md-6 p-0 d-none d-md-block">
                                                                <div class="property-thumbnail-wrapper position-relative">
                                                                    <?php echo justhome_get_attachment_thumbnail($slider['image']['id'], 'full'); ?>
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
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-12 p-0 <?php echo esc_attr($firstclass); ?>">
                                                            <div class="inner-content">
                                                                <?php the_title( sprintf( '<h2 class="property-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                                                                <?php justhome_property_display_full_location($post, 'icon'); ?>
                                                                <?php if(get_the_excerpt()){ ?>
                                                                    <div class="description"><?php echo justhome_substring( get_the_excerpt(),26, '...' ); ?></div>
                                                                <?php } ?>
                                                                <?php
                                                                $meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);

                                                                $beds = justhome_property_display_meta($post, 'beds', 'flaticon-hotel', false, $meta_obj->get_post_meta_title( 'beds' ));
                                                                $baths = justhome_property_display_meta($post, 'baths', 'flaticon-bathtub', false, $meta_obj->get_post_meta_title( 'baths' ));

                                                                $suffix = wp_realestate_get_option('measurement_unit_area');
                                                                $lot_area = justhome_property_display_meta($post, 'lot_area', ' flaticon-minus-front', false, $suffix);

                                                                if ( $lot_area || $beds || $baths ) {
                                                                ?>
                                                                    <div class="property-metas d-flex flex-wrap">
                                                                        <?php
                                                                            echo trim($beds);
                                                                            echo trim($baths);
                                                                            echo trim($lot_area);
                                                                        ?>
                                                                    </div>
                                                                <?php } ?>
                                                                <?php justhome_property_display_price($post, 'no-icon-title', true); ?>
                                                                <a href="<?php the_permalink(); ?>" class="btn-theme btn" data-toggle="tooltip" data-original-title="<?php esc_html_e('Learn More','justhome') ?>"><?php esc_html_e('Learn More','justhome') ?><svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg></a>

                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                <?php

                                                wp_reset_postdata();
                                            }

                                        }
                                        ?>
                                </div>
                            <?php } else { ?>
                                <div class="property-item m-0 property-grid-slider-style2 w-100 d-flex flex-column align-items-center justify-content-center text-center" <?php echo trim($style_bg); ?>>
                                        <?php
                                        if ( !empty($slider['property_id']) ) {

                                            $post_object = get_post( $slider['property_id'] );
                                            if ( $post_object ) {
                                                setup_postdata( $GLOBALS['post'] =& $post_object );
                                                global $post;
                                                $title = $slider['title'];
                                                if(empty($title)){
                                                    $title = get_the_title();
                                                }
                                                ?>

                                                                <?php
                                                                $meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);

                                                                $beds = justhome_property_display_meta($post, 'beds', '', false, $meta_obj->get_post_meta_title( 'beds' ));
                                                                $baths = justhome_property_display_meta($post, 'baths', '', false, $meta_obj->get_post_meta_title( 'baths' ));

                                                                $suffix = wp_realestate_get_option('measurement_unit_area');
                                                                $lot_area = justhome_property_display_meta($post, 'lot_area', '', false, $suffix);

                                                                if ( $lot_area || $beds || $baths ) {
                                                                ?>
                                                                    <div class="property-metas2 d-flex flex-wrap">
                                                                        <?php
                                                                            echo trim($beds);
                                                                            echo trim($baths);
                                                                            echo trim($lot_area);
                                                                        ?>
                                                                    </div>
                                                                <?php } ?>
                                                                <h2 class="property-title"><a href="<?php echo esc_url( get_permalink()); ?>"><?php echo trim(
                                                                    $title); ?></a></h2>
                                                                <?php justhome_property_display_price($post, 'no-icon-title', true); ?>
                                                                <a href="<?php the_permalink(); ?>" class="btn-theme btn" data-toggle="tooltip" data-original-title="<?php esc_html_e('View Details','justhome') ?>"><?php esc_html_e('View Details','justhome') ?><svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg></a>

                                                        
                                                <?php

                                                wp_reset_postdata();
                                            }

                                        }
                                        ?>
                                </div>
                            <?php } ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
        <?php
        }
    }
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_RealEstate_Properties_Slider );
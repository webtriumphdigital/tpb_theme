<?php

function justhome_realestate_customize_property_register( $wp_customize ) {

    $elementor_options = ['' => esc_html__('Choose a elementor template', 'justhome')];
    if ( did_action( 'elementor/loaded' ) ) {
        $ele_obj = \Elementor\Plugin::$instance;
        $templates = $ele_obj->templates_manager->get_source( 'local' )->get_items();
        
        if ( !empty( $templates ) ) {
            foreach ( $templates as $template ) {
                $elementor_options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
            }
        }
    }

    // Properties Panel
    $wp_customize->add_panel( 'justhome_settings_property', array(
        'title' => esc_html__( 'Properties Settings', 'justhome' ),
        'priority' => 4,
    ) );

    // General Section
    $wp_customize->add_section('justhome_settings_properties_general', array(
        'title'    => esc_html__('General', 'justhome'),
        'priority' => 1,
        'panel' => 'justhome_settings_property',
    ));

    // Other Setting ?
    $wp_customize->add_setting('justhome_theme_options[property_other_setting]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Justhome_WP_Customize_Heading_Control($wp_customize, 'property_other_setting', array(
        'label'    => esc_html__('Other Settings', 'justhome'),
        'section'  => 'justhome_settings_properties_general',
        'settings' => 'justhome_theme_options[property_other_setting]',
    )));
    
    // Show Full Phone Number
    $wp_customize->add_setting('justhome_theme_options[listing_show_full_phone]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '0',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_listing_show_full_phone', array(
        'settings' => 'justhome_theme_options[listing_show_full_phone]',
        'label'    => esc_html__('Show Full Phone Number', 'justhome'),
        'section'  => 'justhome_settings_properties_general',
        'type'     => 'checkbox',
    ));

    // Enable Favorite
    $wp_customize->add_setting('justhome_theme_options[listing_enable_favorite]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_listing_enable_favorite', array(
        'settings' => 'justhome_theme_options[listing_enable_favorite]',
        'label'    => esc_html__('Enable Favorite', 'justhome'),
        'section'  => 'justhome_settings_properties_general',
        'type'     => 'checkbox',
    ));

    // Enable Compare
    $wp_customize->add_setting('justhome_theme_options[listing_enable_compare]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_listing_enable_compare', array(
        'settings' => 'justhome_theme_options[listing_enable_compare]',
        'label'    => esc_html__('Enable Compare', 'justhome'),
        'section'  => 'justhome_settings_properties_general',
        'type'     => 'checkbox',
    ));



    if ( did_action( 'elementor/loaded' ) ) {
        $wp_customize->add_setting( 'justhome_theme_options[property_archive_elementor_template]', array(
            'default'        => '',
            'type'           => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'justhome_settings_property_archive_elementor_template', array(
            'label'   => esc_html__('Property Archive Layout', 'justhome'),
            'section' => 'justhome_settings_properties_general',
            'type'    => 'select',
            'choices' => $elementor_options,
            'settings' => 'justhome_theme_options[property_archive_elementor_template]',
        ) );
    

        // Single Property
    
        $wp_customize->add_setting( 'justhome_theme_options[property_elementor_template]', array(
            'default'        => '',
            'type'           => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'justhome_settings_property_single_property_elementor_template', array(
            'label'   => esc_html__('Property Single Layout', 'justhome'),
            'section' => 'justhome_settings_properties_general',
            'type'    => 'select',
            'choices' => $elementor_options,
            'settings' => 'justhome_theme_options[property_elementor_template]',
        ) );
    }


    // Print Property
    $wp_customize->add_section('justhome_settings_listing_print', array(
        'title'    => esc_html__('Property Print', 'justhome'),
        'priority' => 4,
        'panel' => 'justhome_settings_property',
    ));

    // Show Print Button
    $wp_customize->add_setting('justhome_theme_options[property_enable_printer]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'       => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_property_enable_printer', array(
        'settings' => 'justhome_theme_options[property_enable_printer]',
        'label'    => esc_html__('Show Print Button', 'justhome'),
        'section'  => 'justhome_settings_listing_print',
        'type'     => 'checkbox',
    ));

    // Print Logo
    $wp_customize->add_setting('justhome_theme_options[print-logo]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',

    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'print-logo', array(
        'label'    => esc_html__('Print Logo', 'justhome'),
        'section'  => 'justhome_settings_listing_print',
        'settings' => 'justhome_theme_options[print-logo]',
    )));

    $contents = apply_filters('justhome_listing_single_print_content', array(
        'header' => esc_html__('Print Header', 'justhome'),
        'qrcode' => esc_html__('Qrcode', 'justhome'),
        'agent' => esc_html__('Agent Info', 'justhome'),
        'description' => esc_html__('Description', 'justhome'),
        'energy' => esc_html__('EU Energy', 'justhome'),
        'detail' => esc_html__('Detail', 'justhome'),
        'amenities' => esc_html__('Amenities', 'justhome'),
        'floor-plans' => esc_html__('Floor plans', 'justhome'),
        'facilities' => esc_html__('Facilities', 'justhome'),
        'valuation' => esc_html__('Valuation', 'justhome'),
        'gallery' => esc_html__('Gallery', 'justhome'),
    ));

    foreach ($contents as $key => $value) {
        // Show Social Share
        $wp_customize->add_setting('justhome_theme_options[show_print_'.$key.']', array(
            'capability' => 'edit_theme_options',
            'type'       => 'option',
            'default'       => '1',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('justhome_theme_options_show_print_'.$key, array(
            'settings' => 'justhome_theme_options[show_print_'.$key.']',
            'label'    => sprintf(esc_html__('Show %s', 'justhome'), $value),
            'section'  => 'justhome_settings_listing_print',
            'type'     => 'checkbox',
        ));
    }
}
add_action( 'customize_register', 'justhome_realestate_customize_property_register', 15 );
<?php

function justhome_realestate_customize_other_register( $wp_customize ) {
    global $wp_registered_sidebars;
    
    // General Section
    $wp_customize->add_section('justhome_settings_register_form_general', array(
        'title'    => esc_html__('Register Form', 'justhome'),
        'priority' => 15,
    ));

    // Enable Register Agency
    $wp_customize->add_setting('justhome_theme_options[register_form_enable_agency]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_register_form_enable_agency', array(
        'settings' => 'justhome_theme_options[register_form_enable_agency]',
        'label'    => esc_html__('Enable Register Agency', 'justhome'),
        'section'  => 'justhome_settings_register_form_general',
        'type'     => 'checkbox',
    ));

    // Enable Register Agent
    $wp_customize->add_setting('justhome_theme_options[register_form_enable_agent]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_register_form_enable_agent', array(
        'settings' => 'justhome_theme_options[register_form_enable_agent]',
        'label'    => esc_html__('Enable Register Agent', 'justhome'),
        'section'  => 'justhome_settings_register_form_general',
        'type'     => 'checkbox',
    ));
}
add_action( 'customize_register', 'justhome_realestate_customize_other_register', 15 );


function justhome_realestate_customize_mortgage_calculator_register( $wp_customize ) {
    global $wp_registered_sidebars;
    

    // General Section
    $wp_customize->add_section('justhome_settings_mortgage_calculator_general', array(
        'title'    => esc_html__('Mortgage Calculator', 'justhome'),
        'priority' => 15,
    ));

    // General
    $wp_customize->add_setting('justhome_theme_options[mortgage_calculator_general_setting]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Justhome_WP_Customize_Heading_Control($wp_customize, 'mortgage_calculator_general_setting', array(
        'label'    => esc_html__('General', 'justhome'),
        'section'  => 'justhome_settings_mortgage_calculator_general',
        'settings' => 'justhome_theme_options[mortgage_calculator_general_setting]',
    )));

    // Total Amount
    $wp_customize->add_setting('justhome_theme_options[mortgage_calculator_total_amount]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 70000,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_mortgage_calculator_total_amount', array(
        'settings' => 'justhome_theme_options[mortgage_calculator_total_amount]',
        'label'    => esc_html__('Total Amount', 'justhome'),
        'section'  => 'justhome_settings_mortgage_calculator_general',
        'type'     => 'text',
    ));

    // Down payment
    $wp_customize->add_setting('justhome_theme_options[mortgage_calculator_down_payment]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 10000,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_mortgage_calculator_down_payment', array(
        'settings' => 'justhome_theme_options[mortgage_calculator_down_payment]',
        'label'    => esc_html__('Down payment', 'justhome'),
        'section'  => 'justhome_settings_mortgage_calculator_general',
        'type'     => 'text',
    ));

    // Interest Rate
    $wp_customize->add_setting('justhome_theme_options[mortgage_calculator_interest_rate]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '3.5',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_mortgage_calculator_interest_rate', array(
        'settings' => 'justhome_theme_options[mortgage_calculator_interest_rate]',
        'label'    => esc_html__('Interest Rate', 'justhome'),
        'section'  => 'justhome_settings_mortgage_calculator_general',
        'type'     => 'text',
    ));

    // Loan Terms (Years)
    $wp_customize->add_setting('justhome_theme_options[mortgage_calculator_loan_terms]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '15',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_mortgage_calculator_loan_terms', array(
        'settings' => 'justhome_theme_options[mortgage_calculator_loan_terms]',
        'label'    => esc_html__('Loan Terms (Years)', 'justhome'),
        'section'  => 'justhome_settings_mortgage_calculator_general',
        'type'     => 'text',
    ));

    // Property Tax
    $wp_customize->add_setting('justhome_theme_options[mortgage_calculator_property_tax]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '3000',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_mortgage_calculator_property_tax', array(
        'settings' => 'justhome_theme_options[mortgage_calculator_property_tax]',
        'label'    => esc_html__('Property Tax', 'justhome'),
        'section'  => 'justhome_settings_mortgage_calculator_general',
        'type'     => 'text',
    ));

    // Home Insurance
    $wp_customize->add_setting('justhome_theme_options[mortgage_calculator_home_insurance]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1000',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_mortgage_calculator_home_insurance', array(
        'settings' => 'justhome_theme_options[mortgage_calculator_home_insurance]',
        'label'    => esc_html__('Home Insurance', 'justhome'),
        'section'  => 'justhome_settings_mortgage_calculator_general',
        'type'     => 'text',
    ));

    // Home Insurance
    $wp_customize->add_setting('justhome_theme_options[mortgage_calculator_home_insurance]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1000',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_mortgage_calculator_home_insurance', array(
        'settings' => 'justhome_theme_options[mortgage_calculator_home_insurance]',
        'label'    => esc_html__('Home Insurance', 'justhome'),
        'section'  => 'justhome_settings_mortgage_calculator_general',
        'type'     => 'text',
    ));

    // Color Setting
    $wp_customize->add_setting('justhome_theme_options[mortgage_calculator_color_setting]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new Justhome_WP_Customize_Heading_Control($wp_customize, 'mortgage_calculator_color_setting', array(
        'label'    => esc_html__('Color Setting', 'justhome'),
        'section'  => 'justhome_settings_mortgage_calculator_color',
        'settings' => 'justhome_theme_options[mortgage_calculator_color_setting]',
    )));

    // Principal & Interest Color
    $wp_customize->add_setting('justhome_theme_options[mortgage_calculator_principal_interest_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mortgage_calculator_principal_interest_color', array(
        'label'    => esc_html__('Principal & Interest Color', 'justhome'),
        'section'  => 'justhome_settings_mortgage_calculator_color',
        'settings' => 'justhome_theme_options[mortgage_calculator_principal_interest_color]',
    )));

    // Property Tax Color
    $wp_customize->add_setting('justhome_theme_options[mortgage_calculator_property_tax_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mortgage_calculator_property_tax_color', array(
        'label'    => esc_html__('Property Tax Color', 'justhome'),
        'section'  => 'justhome_settings_mortgage_calculator_color',
        'settings' => 'justhome_theme_options[mortgage_calculator_property_tax_color]',
    )));


    // Home Insurance Color
    $wp_customize->add_setting('justhome_theme_options[mortgage_calculator_home_insurance_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'mortgage_calculator_home_insurance_color', array(
        'label'    => esc_html__('Home Insurance Color', 'justhome'),
        'section'  => 'justhome_settings_mortgage_calculator_color',
        'settings' => 'justhome_theme_options[mortgage_calculator_home_insurance_color]',
    )));
}
add_action( 'customize_register', 'justhome_realestate_customize_mortgage_calculator_register', 15 );
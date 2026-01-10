<?php

function justhome_realestate_customize_agent_register( $wp_customize ) {
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

    // Agent Panel
    $wp_customize->add_section('justhome_settings_agent', array(
        'title'    => esc_html__('Agent Settings', 'justhome'),
        'priority' => 4,
    ));

    if ( did_action( 'elementor/loaded' ) ) {
        $wp_customize->add_setting( 'justhome_theme_options[agent_archive_elementor_template]', array(
            'default'        => '',
            'type'           => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'justhome_settings_agent_archive_elementor_template', array(
            'label'   => esc_html__('Agent Archive Layout', 'justhome'),
            'section' => 'justhome_settings_agent',
            'type'    => 'select',
            'choices' => $elementor_options,
            'settings' => 'justhome_theme_options[agent_archive_elementor_template]',
        ) );
        
        $wp_customize->add_setting( 'justhome_theme_options[agent_elementor_template]', array(
            'default'        => '',
            'type'           => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'justhome_settings_agent_elementor_template', array(
            'label'   => esc_html__('Agent Single Layout', 'justhome'),
            'section' => 'justhome_settings_agent',
            'type'    => 'select',
            'choices' => $elementor_options,
            'settings' => 'justhome_theme_options[agent_elementor_template]',
        ) );
    }
}
add_action( 'customize_register', 'justhome_realestate_customize_agent_register', 15 );
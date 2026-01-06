<?php
/**
 * Justhome Customizer functionality
 *
 * @package WordPress
 * @subpackage Justhome
 * @since Justhome 1.0
 */

function justhome_customize_register( $wp_customize ) {

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
    
	$wp_customize->add_section('apus_settings_general', array(
        'title'    => esc_html__('General', 'justhome'),
        'priority' => 1,
    ));

	// preload
    $wp_customize->add_setting('justhome_theme_options[preload]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_preload', array(
        'settings' => 'justhome_theme_options[preload]',
        'label'    => esc_html__('Preload Website', 'justhome'),
        'section'  => 'apus_settings_general',
        'type'     => 'checkbox',
    ));

    // preload icon
    $wp_customize->add_setting('justhome_theme_options[media-preload-icon]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'media-preload-icon', array(
        'label'    => esc_html__('Preload Icon', 'justhome'),
        'section'  => 'apus_settings_general',
        'settings' => 'justhome_theme_options[media-preload-icon]',
    )));

    // Image Lazy Loading
    $wp_customize->add_setting('justhome_theme_options[image_lazy_loading]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_image_lazy_loading', array(
        'settings' => 'justhome_theme_options[image_lazy_loading]',
        'label'    => esc_html__('Image Lazy Loading', 'justhome'),
        'section'  => 'apus_settings_general',
        'type'     => 'checkbox',
    ));


    // Header Section
    $wp_customize->add_section('apus_settings_header', array(
        'title'    => esc_html__('Header', 'justhome'),
        'priority' => 2,
    ));

    // header layout
    $wp_customize->add_setting( 'justhome_theme_options[header_type]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_header_header_type', array(
        'label'   => esc_html__('Header Layout Type', 'justhome'),
        'section' => 'apus_settings_header',
        'type'    => 'select',
        'choices' => justhome_get_header_layouts(),
        'settings' => 'justhome_theme_options[header_type]',
        'description' => sprintf(wp_kses(__('You can add or edit a header in <a href="%s" target="_blank">Headers Builder</a>', 'justhome'), array('a' => array('href' => array())) ), admin_url( 'edit.php?post_type=apus_header') ),
    ) );

    // Sticky Header
    $wp_customize->add_setting('justhome_theme_options[keep_header]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_keep_header', array(
        'settings' => 'justhome_theme_options[keep_header]',
        'label'    => esc_html__('Sticky Header', 'justhome'),
        'section'  => 'apus_settings_header',
        'type'     => 'checkbox',
    ));

    // Mobile Logo
    $wp_customize->add_setting('justhome_theme_options[media-mobile-logo]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'media-mobile-logo', array(
        'label'    => esc_html__('Mobile Logo Upload', 'justhome'),
        'section'  => 'apus_settings_header',
        'settings' => 'justhome_theme_options[media-mobile-logo]',
    )));

    // Enable Header Mobile Menu
    $wp_customize->add_setting('justhome_theme_options[header_mobile_menu]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_header_mobile_menu', array(
        'settings' => 'justhome_theme_options[header_mobile_menu]',
        'label'    => esc_html__('Enable Header Mobile Menu', 'justhome'),
        'section'  => 'apus_settings_header',
        'type'     => 'checkbox',
    ));

    // Enable Header Mobile Login
    $wp_customize->add_setting('justhome_theme_options[header_mobile_login]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_header_mobile_login', array(
        'settings' => 'justhome_theme_options[header_mobile_login]',
        'label'    => esc_html__('Enable Header Mobile Login', 'justhome'),
        'section'  => 'apus_settings_header',
        'type'     => 'checkbox',
    ));

    // Enable Header Mobile "Add Listing" button
    $wp_customize->add_setting('justhome_theme_options[header_mobile_add_listing_btn]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => '1',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_header_mobile_add_listing_btn', array(
        'settings' => 'justhome_theme_options[header_mobile_add_listing_btn]',
        'label'    => esc_html__('Enable Header Mobile "Add Listing" button', 'justhome'),
        'section'  => 'apus_settings_header',
        'type'     => 'checkbox',
    ));


    // Footer Section
    $wp_customize->add_section('apus_settings_footer', array(
        'title'    => esc_html__('Footer', 'justhome'),
        'priority' => 2,
    ));

    // header layout
    $wp_customize->add_setting( 'justhome_theme_options[footer_type]', array(
        'default'        => '',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'apus_settings_footer_layout_type', array(
        'label'   => esc_html__('Footer Layout Type', 'justhome'),
        'section' => 'apus_settings_footer',
        'type'    => 'select',
        'choices' => justhome_get_footer_layouts(),
        'settings' => 'justhome_theme_options[footer_type]',
        'description' => sprintf(wp_kses(__('You can add or edit a header in <a href="%s" target="_blank">Footers Builder</a>', 'justhome'), array('a' => array('href' => array())) ), admin_url( 'edit.php?post_type=apus_footer') ),
    ) );

    // Back To Top Button
    $wp_customize->add_setting('justhome_theme_options[back_to_top]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_back_to_top', array(
        'settings' => 'justhome_theme_options[back_to_top]',
        'label'    => esc_html__('Back To Top Button', 'justhome'),
        'section'  => 'apus_settings_footer',
        'type'     => 'checkbox',
    ));


    // Blog & Post Archives Section
    $wp_customize->add_section('apus_settings_blog', array(
        'title'    => esc_html__('Blog & Post', 'justhome'),
        'priority' => 3,
    ));


    if ( did_action( 'elementor/loaded' ) ) {
        // Archive Post Template
        $wp_customize->add_setting( 'justhome_theme_options[post_archive_elementor_template]', array(
            'default'        => '',
            'type'           => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'justhome_theme_options_blog_archive_post_archive_elementor_template', array(
            'label'   => esc_html__('Post Archive Template', 'justhome'),
            'section' => 'apus_settings_blog',
            'type'    => 'select',
            'choices' => $elementor_options,
            'settings' => 'justhome_theme_options[post_archive_elementor_template]',
        ) );
        
        // Single Post Template
        $wp_customize->add_setting( 'justhome_theme_options[post_elementor_template]', array(
            'default'        => '',
            'type'           => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( 'justhome_theme_options_blog_single_post_elementor_template', array(
            'label'   => esc_html__('Post Single Template', 'justhome'),
            'section' => 'apus_settings_blog',
            'type'    => 'select',
            'choices' => $elementor_options,
            'settings' => 'justhome_theme_options[post_elementor_template]',
        ) );
    }



    // 404 Settings
    $wp_customize->add_section('apus_settings_404_page', array(
        'title'    => esc_html__('404 Page', 'justhome'),
        'priority' => 5,
    ));

    // Background Image
    $wp_customize->add_setting('justhome_theme_options[404_bg_img]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, '404_bg_img', array(
        'label'    => esc_html__('Background Image', 'justhome'),
        'section'  => 'apus_settings_404_page',
        'settings' => 'justhome_theme_options[404_bg_img]',
    )));

    // Title
    $wp_customize->add_setting('justhome_theme_options[404_slogan]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_404_slogan', array(
        'settings' => 'justhome_theme_options[404_slogan]',
        'label'    => esc_html__('Slogan', 'justhome'),
        'section'  => 'apus_settings_404_page',
        'type'     => 'text',
    ));

    // Title
    $wp_customize->add_setting('justhome_theme_options[404_title]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_404_title', array(
        'settings' => 'justhome_theme_options[404_title]',
        'label'    => esc_html__('Title', 'justhome'),
        'section'  => 'apus_settings_404_page',
        'type'     => 'text',
    ));

    // 404 description
    $wp_customize->add_setting('justhome_theme_options[404_description]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_404_description', array(
        'settings' => 'justhome_theme_options[404_description]',
        'label'    => esc_html__('Description', 'justhome'),
        'section'  => 'apus_settings_404_page',
        'type'     => 'textarea',
    ));

    // Custom Style
    $wp_customize->add_section('apus_settings_custom_style', array(
        'title'    => esc_html__('Theme Color', 'justhome'),
        'priority' => 6,
    ));

    // Main Theme Color
    $wp_customize->add_setting('justhome_theme_options[main_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'main_color', array(
        'label'    => esc_html__('Main Theme Color', 'justhome'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'justhome_theme_options[main_color]',
    )));

    // Main Theme Hover Color
    $wp_customize->add_setting('justhome_theme_options[main_hover_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'main_hover_color', array(
        'label'    => esc_html__('Main Theme Hover Color', 'justhome'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'justhome_theme_options[main_hover_color]',
    )));

    // Text Color
    $wp_customize->add_setting('justhome_theme_options[text_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'text_color', array(
        'label'    => esc_html__('Text Color', 'justhome'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'justhome_theme_options[text_color]',
    )));

    // Link Color
    $wp_customize->add_setting('justhome_theme_options[link_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
        'label'    => esc_html__('Link Color', 'justhome'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'justhome_theme_options[link_color]',
    )));

    // Link Hover Color
    $wp_customize->add_setting('justhome_theme_options[link_hover_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
        'label'    => esc_html__('Link Hover Color', 'justhome'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'justhome_theme_options[link_hover_color]',
    )));

    // Heading Color
    $wp_customize->add_setting('justhome_theme_options[heading_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'heading_color', array(
        'label'    => esc_html__('Heading Color', 'justhome'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'justhome_theme_options[heading_color]',
    )));

    // Header Mobile Color
    $wp_customize->add_setting('justhome_theme_options[header_mobile_color]', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));

    $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_mobile_color', array(
        'label'    => esc_html__('Header Mobile Color', 'justhome'),
        'section'  => 'apus_settings_custom_style',
        'settings' => 'justhome_theme_options[header_mobile_color]',
    )));


    // Typography
    
    $wp_customize->add_section('apus_settings_custom_typography', array(
        'title'    => esc_html__('Typography', 'justhome'),
        'priority' => 6.5,
    ));

    $wp_customize->add_setting( 'justhome_theme_options[main-font]',
        array(
            'default' => '',
            'sanitize_callback' => 'justhome_google_font_sanitization',
            'type'           => 'option',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    $wp_customize->add_control( new Justhome_Google_Font_Select_Custom_Control( $wp_customize, 'main-font',
        array(
            'label' => esc_html__( 'Main Font Face', 'justhome'),
            'description' => esc_html__( 'Pick the Main Font for your site', 'justhome'),
            'section' => 'apus_settings_custom_typography',
            'settings' => 'justhome_theme_options[main-font]',
        )
    ) );

    // Font Size
    $wp_customize->add_setting('justhome_theme_options[main-font-size]', array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_main-font-size', array(
        'settings' => 'justhome_theme_options[main-font-size]',
        'label'    => esc_html__('Main Font Size', 'justhome'),
        'section'  => 'apus_settings_custom_typography',
        'type'     => 'number',
        'description'     => esc_html__('Set a font size (px)', 'justhome'),
    ));


    $wp_customize->add_setting( 'justhome_theme_options[heading-font]',
        array(
            'default' => '',
            'sanitize_callback' => 'justhome_google_font_sanitization',
            'type'           => 'option',
        )
    );
    $wp_customize->add_control( new Justhome_Google_Font_Select_Custom_Control( $wp_customize, 'heading-font',
        array(
            'label' => esc_html__( 'Heading Font Face', 'justhome'),
            'description' => esc_html__( 'Pick the Heading Font for your site', 'justhome'),
            'section' => 'apus_settings_custom_typography',
            'settings' => 'justhome_theme_options[heading-font]',
        )
    ) );

    


    // Social Media
    $wp_customize->add_section('apus_settings_social_media', array(
        'title'    => esc_html__('Social Media', 'justhome'),
        'priority' => 7,
    ));

    // Enable Facebook Share
    $wp_customize->add_setting('justhome_theme_options[facebook_share]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_facebook_share', array(
        'settings' => 'justhome_theme_options[facebook_share]',
        'label'    => esc_html__('Enable Facebook Share', 'justhome'),
        'section'  => 'apus_settings_social_media',
        'type'     => 'checkbox',
    ));

    // Enable twitter Share
    $wp_customize->add_setting('justhome_theme_options[twitter_share]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_twitter_share', array(
        'settings' => 'justhome_theme_options[twitter_share]',
        'label'    => esc_html__('Enable twitter Share', 'justhome'),
        'section'  => 'apus_settings_social_media',
        'type'     => 'checkbox',
    ));

    // Enable linkedin Share
    $wp_customize->add_setting('justhome_theme_options[linkedin_share]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_linkedin_share', array(
        'settings' => 'justhome_theme_options[linkedin_share]',
        'label'    => esc_html__('Enable linkedin Share', 'justhome'),
        'section'  => 'apus_settings_social_media',
        'type'     => 'checkbox',
    ));

    // Enable pinterest Share
    $wp_customize->add_setting('justhome_theme_options[pinterest_share]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'    => 1,
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('justhome_theme_options_pinterest_share', array(
        'settings' => 'justhome_theme_options[pinterest_share]',
        'label'    => esc_html__('Enable pinterest Share', 'justhome'),
        'section'  => 'apus_settings_social_media',
        'type'     => 'checkbox',
    ));
    


    $wp_customize->remove_section( 'header_image' );
	$wp_customize->remove_section( 'colors' );
	$wp_customize->remove_section( 'background_image' );
}
add_action( 'customize_register', 'justhome_customize_register', 10 );


/**
 * Register color schemes for Justhome.
 *
 * Can be filtered with {@see 'justhome_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Sidebar Background Color.
 * 3. Box Background Color.
 * 4. Main Text and Link Color.
 * 5. Sidebar Text and Link Color.
 * 6. Meta Box Background Color.
 *
 * @since Justhome 1.0
 *
 * @return array An associative array of color scheme options.
 */
function justhome_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Justhome.
	 *
	 * The default schemes include 'default', 'dark', 'yellow', 'pink', 'purple', and 'blue'.
	 *
	 * @since Justhome 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, sidebar
	 *                              background, box background, main text and link, sidebar text and link,
	 *                              meta box background.
	 *     }
	 * }
	 */
	return apply_filters( 'justhome_color_schemes', array(
		'default' => array(
			'label'  => esc_html__( 'Default', 'justhome' ),
			'colors' => array(
				'#f1f1f1',
				'#ffffff',
				'#ffffff',
				'#333333',
				'#333333',
				'#f7f7f7',
			),
		),
		'dark'    => array(
			'label'  => esc_html__( 'Dark', 'justhome' ),
			'colors' => array(
				'#111111',
				'#202020',
				'#202020',
				'#bebebe',
				'#bebebe',
				'#1b1b1b',
			),
		),
		'yellow'  => array(
			'label'  => esc_html__( 'Yellow', 'justhome' ),
			'colors' => array(
				'#f4ca16',
				'#ffdf00',
				'#ffffff',
				'#111111',
				'#111111',
				'#f1f1f1',
			),
		),
		'pink'    => array(
			'label'  => esc_html__( 'Pink', 'justhome' ),
			'colors' => array(
				'#ffe5d1',
				'#e53b51',
				'#ffffff',
				'#352712',
				'#ffffff',
				'#f1f1f1',
			),
		),
		'purple'  => array(
			'label'  => esc_html__( 'Purple', 'justhome' ),
			'colors' => array(
				'#674970',
				'#2e2256',
				'#ffffff',
				'#2e2256',
				'#ffffff',
				'#f1f1f1',
			),
		),
		'blue'   => array(
			'label'  => esc_html__( 'Blue', 'justhome' ),
			'colors' => array(
				'#e9f2f9',
				'#55c3dc',
				'#ffffff',
				'#22313f',
				'#ffffff',
				'#f1f1f1',
			),
		),
	) );
}

if ( ! function_exists( 'justhome_get_color_scheme' ) ) :
/**
 * Get the current Justhome color scheme.
 *
 * @since Justhome 1.0
 *
 * @return array An associative array of either the current or default color scheme hex values.
 */
function justhome_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = justhome_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // justhome_get_color_scheme

if ( ! function_exists( 'justhome_get_color_scheme_choices' ) ) :
/**
 * Returns an array of color scheme choices registered for Justhome.
 *
 * @since Justhome 1.0
 *
 * @return array Array of color schemes.
 */
function justhome_get_color_scheme_choices() {
	$color_schemes                = justhome_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // justhome_get_color_scheme_choices

if ( ! function_exists( 'justhome_sanitize_color_scheme' ) ) :
/**
 * Sanitization callback for color schemes.
 *
 * @since Justhome 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function justhome_sanitize_color_scheme( $value ) {
	$color_schemes = justhome_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		$value = 'default';
	}

	return $value;
}
endif; // justhome_sanitize_color_scheme

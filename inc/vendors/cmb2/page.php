<?php

if ( !function_exists( 'justhome_page_metaboxes' ) ) {
	function justhome_page_metaboxes(array $metaboxes) {
		global $wp_registered_sidebars;
        $sidebars = array();

        if ( !empty($wp_registered_sidebars) ) {
            foreach ($wp_registered_sidebars as $sidebar) {
                $sidebars[$sidebar['id']] = $sidebar['name'];
            }
        }
        $headers = array_merge( array('global' => esc_html__( 'Global Setting', 'justhome' )), justhome_get_header_layouts() );
        $footers = array_merge( array('global' => esc_html__( 'Global Setting', 'justhome' )), justhome_get_footer_layouts() );

		$prefix = 'apus_page_';

        $columns = array(
            '' => esc_html__( 'Global Setting', 'justhome' ),
            '1' => esc_html__('1 Column', 'justhome'),
            '2' => esc_html__('2 Columns', 'justhome'),
            '3' => esc_html__('3 Columns', 'justhome'),
            '4' => esc_html__('4 Columns', 'justhome'),
            '6' => esc_html__('6 Columns', 'justhome')
        );

        // Properties Page
        $fields = array(
            array(
                'name' => esc_html__( 'Properties Layout', 'justhome' ),
                'id'   => $prefix.'layout_type',
                'type' => 'select',
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'justhome' ),
                    'default' => esc_html__('Default', 'justhome'),
                    'half-map' => esc_html__('Half Map - v1', 'justhome'),
                    'half-map-v2' => esc_html__('Half Map - v2', 'justhome'),
                    'half-map-v3' => esc_html__('Half Map - v3', 'justhome'),
                    'top-map' => esc_html__('Top Map', 'justhome'),
                )
            ),
            array(
                'id' => $prefix.'display_mode',
                'type' => 'select',
                'name' => esc_html__('Default Display Mode', 'justhome'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'justhome' ),
                    'grid' => esc_html__('Grid', 'justhome'),
                    'list' => esc_html__('List', 'justhome'),
                )
            ),
            array(
                'id' => $prefix.'inner_list_style',
                'type' => 'select',
                'name' => esc_html__('Properties list style', 'justhome'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'justhome' ),
                    'list' => esc_html__('List Default', 'justhome'),
                ),
            ),
            array(
                'id' => $prefix.'inner_grid_style',
                'type' => 'select',
                'name' => esc_html__('Properties grid style', 'justhome'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'justhome' ),
                    'grid' => esc_html__('Grid Default', 'justhome'),
                    'grid-v1' => esc_html__('Grid V1', 'justhome'),
                    'grid-v2' => esc_html__('Grid V2', 'justhome'),
                    'grid-v3' => esc_html__('Grid V3', 'justhome'),
                    'grid-v4' => esc_html__('Grid V4', 'justhome'),
                    'grid-v5' => esc_html__('Grid V5', 'justhome'),
                    'grid-v6' => esc_html__('Grid V6', 'justhome'),
                    'grid-v7' => esc_html__('Grid V7', 'justhome'),
                    'grid-v8' => esc_html__('Grid V8', 'justhome'),
                    'grid-v9' => esc_html__('Grid V9', 'justhome'),
                    'grid-v10' => esc_html__('Grid V10', 'justhome'),
                    'list' => esc_html__('List Default', 'justhome'),
                ),
            ),
            array(
                'id' => $prefix.'properties_columns',
                'type' => 'select',
                'name' => esc_html__('Grid Listing Columns', 'justhome'),
                'options' => $columns,
            ),
            array(
                'id' => $prefix.'properties_pagination',
                'type' => 'select',
                'name' => esc_html__('Pagination Type', 'justhome'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'justhome' ),
                    'default' => esc_html__('Default', 'justhome'),
                    'loadmore' => esc_html__('Load More Button', 'justhome'),
                    'infinite' => esc_html__('Infinite Scrolling', 'justhome'),
                ),
            ),

            array(
                'id' => $prefix.'properties_show_filter_top',
                'type' => 'select',
                'name' => esc_html__('Show Filter Top', 'justhome'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'justhome' ),
                    'no' => esc_html__('No', 'justhome'),
                    'yes' => esc_html__('Yes', 'justhome')
                ),
            ),
            array(
                'id' => $prefix.'properties_filter_top_sidebar',
                'type' => 'select',
                'name' => esc_html__('Properties Filter Top Sidebar', 'justhome'),
                'description' => esc_html__('Choose a filter top sidebar for your website.', 'justhome'),
                'options' => array(
                    '' => esc_html__('Global Setting', 'justhome'),
                    'properties-filter-top' => esc_html__('Properties Filter Top Sidebar', 'justhome'),
                    'properties-filter-top2' => esc_html__('Properties Filter Top 2 Sidebar', 'justhome'),
                ),
                'default' => ''
            ),

            array(
                'id' => $prefix.'properties_show_offcanvas_filter',
                'type' => 'select',
                'name' => esc_html__('Show Offcanvas Filter', 'justhome'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'justhome' ),
                    'no' => esc_html__('No', 'justhome'),
                    'yes' => esc_html__('Yes', 'justhome')
                ),
            ),

            array(
                'id' => $prefix.'properties_filter_sidebar',
                'type' => 'select',
                'name' => esc_html__('Properties Filter Sidebar', 'justhome'),
                'description' => esc_html__('Choose a filter sidebar for your website.', 'justhome'),
                'options' => array(
                    '' => esc_html__('Global Setting', 'justhome'),
                    'properties-filter' => esc_html__('Properties Filter Sidebar', 'justhome'),
                    'properties-filter2' => esc_html__('Properties Filter 2 Sidebar', 'justhome'),
                    'properties-filter3' => esc_html__('Properties Filter 3 Sidebar', 'justhome'),
                ),
                'default' => ''
            ),
        );
        
        $metaboxes[$prefix . 'properties_setting'] = array(
            'id'                        => $prefix . 'properties_setting',
            'title'                     => esc_html__( 'Properties Settings', 'justhome' ),
            'object_types'              => array( 'page' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'show_names'                => true,
            'fields'                    => $fields
        );


        // Agents Page
        $fields = array(
            array(
                'id' => $prefix.'agents_columns',
                'type' => 'select',
                'name' => esc_html__('Agent Columns', 'justhome'),
                'options' => $columns,
                'description' => esc_html__('Apply for display mode is grid and simple.', 'justhome'),
            ),
            array(
                'id' => $prefix.'agents_display_mode',
                'type' => 'select',
                'name' => esc_html__('Default Display Mode', 'justhome'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'justhome' ),
                    'grid' => esc_html__('Grid', 'justhome'),
                    'list' => esc_html__('List', 'justhome'),
                )
            ),
            array(
                'id' => $prefix.'agents_pagination',
                'type' => 'select',
                'name' => esc_html__('Pagination Type', 'justhome'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'justhome' ),
                    'default' => esc_html__('Default', 'justhome'),
                    'loadmore' => esc_html__('Load More Button', 'justhome'),
                    'infinite' => esc_html__('Infinite Scrolling', 'justhome'),
                ),
            ),
        );
        $metaboxes[$prefix . 'agents_setting'] = array(
            'id'                        => $prefix . 'agents_setting',
            'title'                     => esc_html__( 'Agents Settings', 'justhome' ),
            'object_types'              => array( 'page' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'show_names'                => true,
            'fields'                    => $fields
        );

        // Agencies Page
        $fields = array(
            array(
                'id' => $prefix.'agencies_columns',
                'type' => 'select',
                'name' => esc_html__('Agency Columns', 'justhome'),
                'options' => $columns,
                'description' => esc_html__('Apply for display mode is grid.', 'justhome'),
            ),
            array(
                'id' => $prefix.'agencies_display_mode',
                'type' => 'select',
                'name' => esc_html__('Default Display Mode', 'justhome'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'justhome' ),
                    'grid' => esc_html__('Grid', 'justhome'),
                    'list' => esc_html__('List', 'justhome'),
                )
            ),
            array(
                'id' => $prefix.'agencies_pagination',
                'type' => 'select',
                'name' => esc_html__('Pagination Type', 'justhome'),
                'options' => array(
                    '' => esc_html__( 'Global Setting', 'justhome' ),
                    'default' => esc_html__('Default', 'justhome'),
                    'loadmore' => esc_html__('Load More Button', 'justhome'),
                    'infinite' => esc_html__('Infinite Scrolling', 'justhome'),
                ),
            ),
        );
        $metaboxes[$prefix . 'agencies_setting'] = array(
            'id'                        => $prefix . 'agencies_setting',
            'title'                     => esc_html__( 'Agencies Settings', 'justhome' ),
            'object_types'              => array( 'page' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'show_names'                => true,
            'fields'                    => $fields
        );

        // General
	    $fields = array(
			array(
				'name' => esc_html__( 'Select Layout', 'justhome' ),
				'id'   => $prefix.'layout',
				'type' => 'select',
				'options' => array(
					'main' => esc_html__('Main Content Only', 'justhome'),
					'left-main' => esc_html__('Left Sidebar - Main Content', 'justhome'),
					'main-right' => esc_html__('Main Content - Right Sidebar', 'justhome')
				)
			),
			array(
                'id' => $prefix.'fullwidth',
                'type' => 'select',
                'name' => esc_html__('Is Full Width?', 'justhome'),
                'default' => 'no',
                'options' => array(
                    'no' => esc_html__('No', 'justhome'),
                    'yes' => esc_html__('Yes', 'justhome')
                )
            ),
            array(
                'id' => $prefix.'left_sidebar',
                'type' => 'select',
                'name' => esc_html__('Left Sidebar', 'justhome'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'right_sidebar',
                'type' => 'select',
                'name' => esc_html__('Right Sidebar', 'justhome'),
                'options' => $sidebars
            ),
            array(
                'id' => $prefix.'show_breadcrumb',
                'type' => 'select',
                'name' => esc_html__('Show Breadcrumb?', 'justhome'),
                'options' => array(
                    'no' => esc_html__('No', 'justhome'),
                    'yes' => esc_html__('Yes', 'justhome')
                ),
                'default' => 'yes',
            ),
            array(
                'id' => $prefix.'breadcrumb_text_color',
                'type' => 'colorpicker',
                'name' => esc_html__('Breadcrumb Color ( with background color )', 'justhome')
            ),
            array(
                'id' => $prefix.'breadcrumb_color',
                'type' => 'colorpicker',
                'name' => esc_html__('Breadcrumb Background Color', 'justhome')
            ),
            array(
                'id' => $prefix.'breadcrumb_image',
                'type' => 'file',
                'name' => esc_html__('Breadcrumb Background Image', 'justhome')
            ),

            array(
                'id' => $prefix.'header_type',
                'type' => 'select',
                'name' => esc_html__('Header Layout Type', 'justhome'),
                'description' => esc_html__('Choose a header for your website.', 'justhome'),
                'options' => $headers,
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'header_transparent',
                'type' => 'select',
                'name' => esc_html__('Header Transparent', 'justhome'),
                'description' => esc_html__('Choose a header for your website.', 'justhome'),
                'options' => array(
                    'no' => esc_html__('No', 'justhome'),
                    'yes' => esc_html__('Yes', 'justhome')
                ),
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'header_fixed',
                'type' => 'select',
                'name' => esc_html__('Header Fixed Top', 'justhome'),
                'description' => esc_html__('Choose a header position', 'justhome'),
                'options' => array(
                    'no' => esc_html__('No', 'justhome'),
                    'yes' => esc_html__('Yes', 'justhome')
                ),
                'default' => 'no'
            ),
            array(
                'id' => $prefix.'footer_type',
                'type' => 'select',
                'name' => esc_html__('Footer Layout Type', 'justhome'),
                'description' => esc_html__('Choose a footer for your website.', 'justhome'),
                'options' => $footers,
                'default' => 'global'
            ),
            array(
                'id' => $prefix.'extra_class',
                'type' => 'text',
                'name' => esc_html__('Extra Class', 'justhome'),
                'description' => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'justhome')
            )
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'justhome' ),
			'object_types'              => array( 'page' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

        $prefix = 'apus_product_';
        // Properties Page
        $fields = array(
            array(
                'name'    => esc_html__( 'Package Icon', 'justhome' ),
                'id'      => $prefix . 'package_icon',
                'type'    => 'file',
                'text'    => array(
                    'add_upload_file_text' => esc_html__( 'Add Icon', 'justhome' ),
                ),
                'query_args' => array(
                    'type' => array(
                        'image/gif',
                        'image/jpeg',
                        'image/png',
                    ),
                ),
                'preview_size' => 'large', // Image size to use when previewing in the admin
            )
        );
        $metaboxes[$prefix . 'package_setting'] = array(
            'id'                        => $prefix . 'package_setting',
            'title'                     => esc_html__( 'Package Settings', 'justhome' ),
            'object_types'              => array( 'product' ),
            'context'                   => 'normal',
            'priority'                  => 'high',
            'show_names'                => true,
            'fields'                    => $fields
        );

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'justhome_page_metaboxes' );

if ( !function_exists( 'justhome_cmb2_style' ) ) {
	function justhome_cmb2_style() {
        wp_enqueue_style( 'justhome-cmb2-style', get_template_directory_uri() . '/inc/vendors/cmb2/assets/style.css', array(), '1.0' );
		wp_enqueue_script( 'justhome-admin', get_template_directory_uri() . '/js/admin.js', array( 'jquery' ), '20150330', true );
	}
}
add_action( 'admin_enqueue_scripts', 'justhome_cmb2_style' );



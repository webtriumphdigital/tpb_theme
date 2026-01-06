<?php

function justhome_get_agencies( $params = array() ) {
	$params = wp_parse_args( $params, array(
		'limit' => -1,
		'post_status' => 'publish',
		'get_agencies_by' => 'recent',
		'orderby' => '',
		'order' => '',
		'post__in' => array(),
		'fields' => null, // ids
		'author' => null,
	));
	extract($params);

	$query_args = array(
		'post_type'         => 'agency',
		'posts_per_page'    => $limit,
		'post_status'       => $post_status,
		'orderby'       => $orderby,
		'order'       => $order,
	);

	$meta_query = array();
	switch ($get_agencies_by) {
		case 'recent':
			$query_args['orderby'] = 'date';
			$query_args['order'] = 'DESC';
			break;
		case 'featured':
			$meta_query[] = array(
				'key' => WP_REALESTATE_AGENCY_PREFIX.'featured',
	           	'value' => 'on',
	           	'compare' => '=',
			);
			break;
	}

	if ( !empty($post__in) ) {
    	$query_args['post__in'] = $post__in;
    }

    if ( !empty($fields) ) {
    	$query_args['fields'] = $fields;
    }

    if ( !empty($author) ) {
    	$query_args['author'] = $author;
    }

    if ( !empty($meta_query) ) {
    	$query_args['meta_query'] = $meta_query;
    }

	return new WP_Query( $query_args );
}

if ( !function_exists('justhome_agency_content_class') ) {
	function justhome_agency_content_class( $class ) {
		$prefix = 'agencies';
		if ( is_singular( 'agency' ) ) {
            $prefix = 'agency';
        }
		if ( justhome_get_config($prefix.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'justhome_agency_content_class', 'justhome_agency_content_class', 1 , 1 );

if ( !function_exists('justhome_get_agencies_layout_configs') ) {
	function justhome_get_agencies_layout_configs() {
		$layout_type = 'main-right';
		switch ( $layout_type ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => 'agencies-filter-sidebar', 'class' => 'col-lg-4 col-sm-12 col-12'  );
		 		$configs['main'] = array( 'class' => 'col-lg-8 col-sm-12 col-12' );
		 		break;
		 	case 'main-right':
		 	default:
		 		$configs['right'] = array( 'sidebar' => 'agencies-filter-sidebar',  'class' => 'col-lg-4 col-sm-12 col-12' ); 
		 		$configs['main'] = array( 'class' => 'col-lg-8 col-sm-12 col-12' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-12' );
	 			break;
		}
		return $configs; 
	}
}

function justhome_get_agency_layout_type() {
	global $post;
	if ( defined('JUSTHOME_DEMO_MODE') && JUSTHOME_DEMO_MODE ) {
		$layout_type = get_post_meta($post->ID, WP_REALESTATE_AGENCY_PREFIX.'layout_type', true);
	}
	
	if ( empty($layout_type) ) {
		$layout_type = justhome_get_config('agency_elementor_template');
	}
	return apply_filters( 'justhome_get_agency_layout_type', $layout_type );
}

function justhome_is_agencies_page() {
	if( is_post_type_archive('agency') || is_tax('agency_category') || is_tax('agency_location')) {
		return true;
	}
	return false;
}

function justhome_is_agency_single_page() {
	if( is_singular('agency') ) {
		return true;
	}
	return false;
}


// custom fields
add_filter( 'cmb2_meta_boxes', 'justhome_is_agencies_fields', 100 );
function justhome_is_agencies_fields( array $metaboxes ) {
	$prefix = WP_REALESTATE_AGENCY_PREFIX;
	if ( !empty($metaboxes[ $prefix . 'contact_details' ]['fields']) ) {
		$fields = $metaboxes[ $prefix . 'contact_details' ]['fields'];
		$rfields = array();
		foreach ($fields as $key => $field) {
			$rfields[] = $field;
			if ( !empty($field['id']) && $field['id'] == $prefix . 'phone' ) {
				$rfields[] = array(
					'id'                => $prefix . 'fax',
					'name'              => esc_html__( 'Fax', 'justhome' ),
					'type'              => 'text',
				);
				$rfields[] = array(
					'id'                => $prefix . 'whatsapp',
					'name'              => esc_html__( 'Whatsapp', 'justhome' ),
					'type'              => 'text',
				);
				$rfields[] = array(
					'id'                => $prefix . 'skype',
					'name'              => esc_html__( 'Skype', 'justhome' ),
					'type'              => 'text',
				);
				$rfields[] = array(
					'id'                => $prefix . 'opening_hours',
					'name'              => esc_html__( 'Opening Hours', 'justhome' ),
					'type'              => 'text',
				);
				$rfields[] = array(
					'id'                => $prefix . 'languages',
					'name'              => esc_html__( 'Languages', 'justhome' ),
					'type'              => 'text',
				);
				$rfields[] = array(
					'id'                => $prefix . 'license',
					'name'              => esc_html__( 'License', 'justhome' ),
					'type'              => 'text',
				);
				$rfields[] = array(
					'id'                => $prefix . 'tax_number',
					'name'              => esc_html__( 'Tax Number', 'justhome' ),
					'type'              => 'text',
				);
			}
		}
		$metaboxes[ $prefix . 'contact_details' ]['fields'] = $rfields;
	}

	if ( defined('JUSTHOME_DEMO_MODE') && JUSTHOME_DEMO_MODE ) {

		$elementor_options = ['' => esc_html__('Global Settings', 'justhome')];
	    if ( did_action( 'elementor/loaded' ) ) {
	        $ele_obj = \Elementor\Plugin::$instance;
	        $templates = $ele_obj->templates_manager->get_source( 'local' )->get_items();
	        
	        if ( !empty( $templates ) ) {
	            foreach ( $templates as $template ) {
	                $elementor_options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
	            }
	        }
        }
        
		$metaboxes[ $prefix . 'layout_type' ] = array(
			'id'                        => $prefix . 'layout_type',
			'title'                     => __( 'Layout Settings', 'justhome' ),
			'object_types'              => array( 'agency' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'show_in_rest'				=> true,
			'fields'                    => array(
				array(
					'name'              => esc_html__( 'Layout Type', 'justhome' ),
					'id'                => $prefix . 'layout_type',
					'type'              => 'select',
					'options'			=> $elementor_options
				)
			),
		);
	}

	return $metaboxes;
}

add_filter( 'wp-realestate-agency-fields-front', 'justhome_is_agencies_fields_front', 100 );
function justhome_is_agencies_fields_front($fields) {
	$prefix = WP_REALESTATE_AGENCY_PREFIX;
	$fields[] = array(
		'id'                => $prefix . 'fax',
		'name'              => esc_html__( 'Fax', 'justhome' ),
		'type'              => 'text',
		'priority'           => 7.2,
	);
	$fields[] = array(
		'id'                => $prefix . 'whatsapp',
		'name'              => esc_html__( 'Whatsapp', 'justhome' ),
		'type'              => 'text',
		'priority'           => 7.3,
	);
	$fields[] = array(
		'id'                => $prefix . 'skype',
		'name'              => esc_html__( 'Skype', 'justhome' ),
		'type'              => 'text',
		'priority'           => 7.4,
	);
	$fields[] = array(
		'id'                => $prefix . 'opening_hours',
		'name'              => esc_html__( 'Opening Hours', 'justhome' ),
		'type'              => 'text',
		'priority'           => 7.5,
	);
	$fields[] = array(
		'id'                => $prefix . 'languages',
		'name'              => esc_html__( 'Languages', 'justhome' ),
		'type'              => 'text',
		'priority'           => 7.6,
	);
	$fields[] = array(
		'id'                => $prefix . 'license',
		'name'              => esc_html__( 'License', 'justhome' ),
		'type'              => 'text',
		'priority'           => 7.7,
	);
	$fields[] = array(
		'id'                => $prefix . 'tax_number',
		'name'              => esc_html__( 'Tax Number', 'justhome' ),
		'type'              => 'text',
		'priority'           => 7.8,
	);
	return $fields;
}


// Elementor template
add_filter( 'template_include', 'justhome_agency_set_template', 100 );
function justhome_agency_set_template($template) {
    if ( is_embed() ) {
        return $template;
    }
    if ( is_singular( 'agency' ) ) {
    	$template_id = justhome_get_agency_layout_type();
        if ( $template_id ) {
            $template = WP_RealEstate_Template_Loader::locate('template-properties/single-agency-elementor');
        }
    } elseif ( justhome_is_agencies_page() ) {
        if ( justhome_get_config( 'agency_archive_elementor_template' ) ) {
            $template = WP_RealEstate_Template_Loader::locate('template-properties/archive-agency-elementor');
        }
    }
    return $template;
}

add_action( 'justhome_agency_detail_content', 'justhome_agency_detail_builder_content', 5 );
function justhome_agency_detail_builder_content() {
    $template_id = justhome_get_agency_layout_type();
    if ( $template_id ) {
        $post = get_post($template_id);
        echo apply_filters( 'justhome_generate_post_builder', '', $post, $template_id);
    }
}

add_action( 'justhome_agency_archive_content', 'justhome_agency_archive_builder_content', 5 );
function justhome_agency_archive_builder_content() {
    $template_id = justhome_get_config('agency_archive_elementor_template');
    if ( $template_id ) {
        $post = get_post($template_id);
        echo apply_filters( 'justhome_generate_post_builder', '', $post, $template_id);
    }
}
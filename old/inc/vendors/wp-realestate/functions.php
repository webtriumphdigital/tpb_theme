<?php

function justhome_get_properties( $params = array() ) {
	$params = wp_parse_args( $params, array(
		'limit' => -1,
		'post_status' => 'publish',
		'get_properties_by' => 'recent',
		'orderby' => '',
		'order' => '',
		'post__in' => array(),
		'fields' => null, // ids
		'author' => null,
		'statuses' => array(),
		'types' => array(),
		'locations' => array(),
		'amenities' => array(),
		'materials' => array(),
		'labels' => array(),
	));
	extract($params);

	$query_args = array(
		'post_type'         => 'property',
		'posts_per_page'    => $limit,
		'post_status'       => $post_status,
		'orderby'       => $orderby,
		'order'       => $order,
	);

	$meta_query = array();
	switch ($get_properties_by) {
		case 'recent':
			$query_args['orderby'] = 'date';
			$query_args['order'] = 'DESC';
			break;
		case 'featured':
			$meta_query[] = array(
				'key' => WP_REALESTATE_PROPERTY_PREFIX.'featured',
	           	'value' => 'on',
	           	'compare' => '=',
			);
			break;
		case 'urgent':
			$meta_query[] = array(
				'key' => WP_REALESTATE_PROPERTY_PREFIX.'urgent',
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

    $tax_query = array();
    if ( !empty($statuses) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'property_status',
            'field'         => 'slug',
            'terms'         => $statuses,
            'operator'      => 'IN'
        );
    }
    if ( !empty($types) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'property_type',
            'field'         => 'slug',
            'terms'         => $types,
            'operator'      => 'IN'
        );
    }
    if ( !empty($locations) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'property_location',
            'field'         => 'slug',
            'terms'         => $locations,
            'operator'      => 'IN'
        );
    }

    if ( !empty($amenities) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'property_amenity',
            'field'         => 'slug',
            'terms'         => $amenities,
            'operator'      => 'IN'
        );
    }
    if ( !empty($materials) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'property_material',
            'field'         => 'slug',
            'terms'         => $materials,
            'operator'      => 'IN'
        );
    }
    if ( !empty($labels) ) {
    	$tax_query[] = array(
            'taxonomy'      => 'property_label',
            'field'         => 'slug',
            'terms'         => $labels,
            'operator'      => 'IN'
        );
    }

    if ( !empty($tax_query) ) {
    	$query_args['tax_query'] = $tax_query;
    }
    
    if ( !empty($meta_query) ) {
    	$query_args['meta_query'] = $meta_query;
    }

	return new WP_Query( $query_args );
}

if ( !function_exists('justhome_property_content_class') ) {
	function justhome_property_content_class( $class ) {
		$prefix = 'properties';
		if ( is_singular( 'property' ) ) {
            $prefix = 'property';
        }
		if ( justhome_get_config($prefix.'_fullwidth') ) {
			return 'container-fluid';
		}
		return $class;
	}
}
add_filter( 'justhome_property_content_class', 'justhome_property_content_class', 1 , 1  );

function justhome_property_template_folder_name($folder) {
	$folder = 'template-properties';
	return $folder;
}
add_filter( 'wp-realestate-theme-folder-name', 'justhome_property_template_folder_name', 10 );

if ( !function_exists('justhome_get_properties_layout_configs') ) {
	function justhome_get_properties_layout_configs() {
		$layout_sidebar = 'main-right';

		$sidebar = 'properties-filter-sidebar';
		switch ( $layout_sidebar ) {
		 	case 'left-main':
		 		$configs['left'] = array( 'sidebar' => $sidebar, 'class' => 'col-lg-4 col-sm-12 col-12 sidebar-blog'  );
		 		$configs['main'] = array( 'class' => 'col-lg-8 col-sm-12 col-12' );
		 		break;
		 	case 'main-right':
		 	default:
		 		$configs['right'] = array( 'sidebar' => $sidebar,  'class' => 'col-lg-4 col-sm-12 col-12 sidebar-blog' ); 
		 		$configs['main'] = array( 'class' => 'col-lg-8 col-sm-12 col-12' );
		 		break;
	 		case 'main':
	 			$configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-12' );
	 			break;
		}
		return $configs; 
	}
}

function justhome_get_property_layout_type() {
	global $post;
	if ( defined('JUSTHOME_DEMO_MODE') && JUSTHOME_DEMO_MODE ) {
		$layout_type = get_post_meta($post->ID, WP_REALESTATE_PROPERTY_PREFIX.'layout_type', true);
	}
	
	if ( empty($layout_type) ) {
		$layout_type = justhome_get_config('property_elementor_template' );
	}
	return apply_filters( 'justhome_get_property_layout_type', $layout_type );
}


function justhome_property_scripts() {
	
	wp_enqueue_style( 'leaflet' );
	wp_enqueue_script( 'jquery-highlight' );
    wp_enqueue_script( 'leaflet' );
    wp_enqueue_script( 'control-geocoder' );
    wp_enqueue_script( 'esri-leaflet' );
    wp_enqueue_script( 'esri-leaflet-geocoder' );
    wp_enqueue_script( 'leaflet-markercluster' );
    wp_enqueue_script( 'leaflet-HtmlIcon' );
    
    if ( wp_realestate_get_option('map_service') == 'google-map' ) {
    	wp_enqueue_script( 'leaflet-GoogleMutant' );
    }
    
	wp_register_script( 'justhome-property', get_template_directory_uri() . '/js/property.js', array( 'jquery', 'wp-realestate-main', 'perfect-scrollbar', 'imagesloaded' ), '20150330', true );

	$currency_symbol = ! empty( wp_realestate_get_option('currency_symbol') ) ? wp_realestate_get_option('currency_symbol') : '$';
	$dec_point = ! empty( wp_realestate_get_option('money_dec_point') ) ? wp_realestate_get_option('money_dec_point') : '.';
	$thousands_separator = ! empty( wp_realestate_get_option('money_thousands_separator') ) ? wp_realestate_get_option('money_thousands_separator') : '';

	wp_localize_script( 'justhome-property', 'justhome_property_opts', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),

		'dec_point' => $dec_point,
		'thousands_separator' => $thousands_separator,
		'currency' => esc_attr($currency_symbol),
		'monthly_text' => esc_html__('Monthly Payment: ', 'justhome'),
		'compare_added_title' => esc_html__('Compared', 'justhome'),
		'compare_title' => esc_html__('Compare', 'justhome'),
		'compare_added_tooltip_title' => esc_html__('Remove Compare', 'justhome'),
		'compare_add_tooltip_title' => esc_html__('Add Compare', 'justhome'),
		'favorite_added_tooltip_title' => esc_html__('Remove Favorite', 'justhome'),
		'favorite_add_tooltip_title' => esc_html__('Add Favorite', 'justhome'),

		'template' => apply_filters( 'justhome_autocompleate_search_template', '<a href="{{url}}" class="d-flex align-items-center autocompleate-media">
			<div class="flex-shrink-0">
				<img src="{{image}}" class="media-object" height="55" width="55">
			</div>
			<div class="flex-grow-1 d-flex">
				<h4>{{title}}</h4>
				<span>{{{status}}}</span>
				</div></a>' ),
        'empty_msg' => apply_filters( 'justhome_autocompleate_search_empty_msg', esc_html__( 'Unable to find any listing that match the currenty query', 'justhome' ) ),
	));
	wp_enqueue_script( 'justhome-property' );

	$here_map_api_key = '';
	$here_style = '';
	$mapbox_token = '';
	$mapbox_style = '';
	$custom_style = '';
	$googlemap_type = wp_realestate_get_option('googlemap_type', 'roadmap');
	if ( empty($googlemap_type) ) {
		$googlemap_type = 'roadmap';
	}
	$map_service = wp_realestate_get_option('map_service', '');
	if ( $map_service == 'mapbox' ) {
		$mapbox_token = wp_realestate_get_option('mapbox_token', '');
		$mapbox_style = wp_realestate_get_option('mapbox_style', 'streets-v11');
		if ( empty($mapbox_style) || !in_array($mapbox_style, array( 'streets-v11', 'light-v10', 'dark-v10', 'outdoors-v11', 'satellite-v9' )) ) {
			$mapbox_style = 'streets-v11';
		}
	} elseif ( $map_service == 'here' ) {
		$here_map_api_key = wp_realestate_get_option('here_map_api_key', '');
		$here_style = wp_realestate_get_option('here_map_style', 'normal.day');
	} else {
		$custom_style = wp_realestate_get_option('google_map_style', '');
	}

	wp_register_script( 'justhome-property-map', get_template_directory_uri() . '/js/property-map.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'justhome-property-map', 'justhome_property_map_opts', array(
		'map_service' => $map_service,
		'mapbox_token' => $mapbox_token,
		'mapbox_style' => $mapbox_style,
		'here_map_api_key' => $here_map_api_key,
		'here_style' => $here_style,
		'custom_style' => $custom_style,
		'googlemap_type' => $googlemap_type,
		'default_latitude' => wp_realestate_get_option('default_maps_location_latitude', '43.6568'),
		'default_longitude' => wp_realestate_get_option('default_maps_location_longitude', '-79.4512'),
		'default_pin' => wp_realestate_get_option('default_maps_pin', ''),
		
	));
	wp_enqueue_script( 'justhome-property-map' );
}
add_action( 'wp_enqueue_scripts', 'justhome_property_scripts', 10 );

function justhome_is_properties_page() {
	if( is_post_type_archive('property') || is_tax('property_status') || is_tax('property_type') || is_tax('property_location') || is_tax('property_tag') || is_tax('property_label') || is_tax('property_amenity') || is_tax('property_material') ) {
		return true;
	}
	return false;
}

function justhome_is_property_single_page() {
	if ( is_singular('property') || apply_filters('justhome_is_property_single', false) ) {
		return true;
	}
	return false;
}

function justhome_property_metaboxes($fields) {
	// property

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
        
		$prefix = WP_REALESTATE_PROPERTY_PREFIX;
		if ( !empty($fields) ) {
			$fields[ $prefix . 'tab-layout-version' ] = array(
				'id' => $prefix . 'tab-layout-version',
				'icon' => 'dashicons-admin-appearance',
				'title' => esc_html__( 'Layout Type', 'justhome' ),
				'fields' => array(
					array(
						'name'              => esc_html__( 'Layout Type', 'justhome' ),
						'id'                => $prefix . 'layout_type',
						'type'              => 'select',
						'options'			=> $elementor_options
					)
				)
			);
		}
	}
	
	return $fields;
}
add_filter( 'wp-realestate-admin-custom-fields', 'justhome_property_metaboxes' );


add_filter('wp_realestate_settings_general', 'justhome_properties_settings_general', 10);
function justhome_properties_settings_general($fields) {
	$rfields = array();
	foreach ($fields as $key => $field) {
		$rfields[] = $field;
		if ( $field['id'] == 'default_maps_location_longitude' ) {
			$rfields[] = array(
				'name'    => esc_html__( 'Map Pin', 'justhome' ),
				'desc'    => esc_html__( 'Enter your map pin', 'justhome' ),
				'id'      => 'default_maps_pin',
				'type'    => 'file',
				'options' => array(
					'url' => true,
				),
				'query_args' => array(
					'type' => array(
						'image/gif',
						'image/jpeg',
						'image/png',
					),
				),
			);
		}
	}
	return $rfields;
}

add_action( 'wre_ajax_justhome_get_ajax_properties', 'justhome_get_ajax_properties' );

add_action( 'wp_ajax_justhome_get_ajax_properties', 'justhome_get_ajax_properties' );
add_action( 'wp_ajax_nopriv_justhome_get_ajax_properties', 'justhome_get_ajax_properties' );
function justhome_get_ajax_properties() {
	$settings = !empty($_POST['settings']) ? $_POST['settings'] : array();

    extract( $settings );

    $status_slugs = !empty($status_slugs) ? array_map('trim', explode(',', $status_slugs)) : array();
    $type_slugs = !empty($type_slugs) ? array_map('trim', explode(',', $type_slugs)) : array();
    $location_slugs = !empty($location_slugs) ? array_map('trim', explode(',', $location_slugs)) : array();
    $amenity_slugs = !empty($amenity_slugs) ? array_map('trim', explode(',', $amenity_slugs)) : array();
    $material_slugs = !empty($material_slugs) ? array_map('trim', explode(',', $material_slugs)) : array();
    $label_slugs = !empty($label_slugs) ? array_map('trim', explode(',', $label_slugs)) : array();

    $args = array(
        'limit' => $limit,
        'get_properties_by' => $get_properties_by,
        'orderby' => $orderby,
        'order' => $order,
        'statuses' => $status_slugs,
        'types' => $type_slugs,
        'locations' => $location_slugs,
        'amenities' => $amenity_slugs,
        'materials' => $material_slugs,
        'labels' => $label_slugs,
    );
    $loop = justhome_get_properties($args);
    
    if ( $loop->have_posts() ) {
        while ( $loop->have_posts() ) : $loop->the_post();
        	echo WP_RealEstate_Template_Loader::get_template_part( 'properties-styles/inner-grid' );
        endwhile;
        wp_reset_postdata();
    }
    exit();
}

add_action( 'wre_ajax_justhome_get_ajax_properties_load_more', 'justhome_get_ajax_properties_load_more' );

add_action( 'wp_ajax_justhome_get_ajax_properties_load_more', 'justhome_get_ajax_properties_load_more' );
add_action( 'wp_ajax_nopriv_justhome_get_ajax_properties_load_more', 'justhome_get_ajax_properties_load_more' );
function justhome_get_ajax_properties_load_more() {
	$paged = !empty($_POST['paged']) ? $_POST['paged'] : '';
	$post_id = !empty($_POST['post_id']) ? $_POST['post_id'] : '';
	$type = !empty($_POST['type']) ? $_POST['type'] : 'agent';


	if ( empty($paged) || empty($post_id) ) {
		$return = array(
			'paged' => 1,
			'output' => '',
			'load_more' => false
		);
		echo wp_json_encode($return);
        exit;
	}
	$return = array(
		'paged' => $paged + 1,
		'output' => '',
		'load_more' => false
	);
    if ( $type == 'agent' ) {

    	$number = justhome_get_config('agent_property_per_page', 3);
		$columns = justhome_get_config('agent_property_columns', 3);

    	$loop = WP_RealEstate_Query::get_agents_properties(array(
		    'agent_ids' => array($post_id),
		    'post_per_page' => $number,
		    'paged' => $paged
		));
    } else {
    	$number = justhome_get_config('agency_property_per_page', 3);
		$columns = justhome_get_config('agency_property_columns', 3);
    	$agents = WP_RealEstate_Query::get_agency_agents( $post_id, array('fields' => 'ids') );
		if ( !empty($agents) && !empty($agents->posts) ) {
		    $loop = WP_RealEstate_Query::get_agents_properties(array(
		        'agent_ids' => $agents->posts,
		        'post_per_page' => $number,
		        'paged' => $paged
		    ));
		}
    }
    $i = $number*$paged - $number;
    $bcol = 12/$columns;
    $output = '';
    if ( !empty($loop) && $loop->have_posts() ) {
    	$return['load_more'] = $loop->max_num_pages > $paged ? true : false;
        while ( $loop->have_posts() ) : $loop->the_post();
        	$classes = '';
            if ( $i%2 == 0 ) {
                $classes .= ' sm-clearfix';
            }
            if ( $i%$columns == 0 ) {
                $classes .= ' md-clearfix lg-clearfix';
            }
        	$output .= '<div class="col-12 col-sm-6 col-md-'.$bcol.' '.$classes.'">';
        	$output .= WP_RealEstate_Template_Loader::get_template_part( 'properties-styles/inner-grid' );
        	$output .= '</div>';
        $i++; endwhile;
        wp_reset_postdata();
    }
    $return['output'] = $output;
    echo wp_json_encode($return);
    exit();
}

add_action( 'wre_ajax_justhome_get_ajax_agents_load_more', 'justhome_get_ajax_agents_load_more' );

add_action( 'wp_ajax_justhome_get_ajax_agents_load_more', 'justhome_get_ajax_agents_load_more' );
add_action( 'wp_ajax_nopriv_justhome_get_ajax_agents_load_more', 'justhome_get_ajax_agents_load_more' );
function justhome_get_ajax_agents_load_more() {
	$paged = !empty($_POST['paged']) ? $_POST['paged'] : '';
	$post_id = !empty($_POST['post_id']) ? $_POST['post_id'] : '';


	if ( empty($paged) || empty($post_id) ) {
		$return = array(
			'paged' => 1,
			'output' => '',
			'load_more' => false
		);
		echo wp_json_encode($return);
        exit;
	}
	$return = array(
		'paged' => $paged + 1,
		'output' => '',
		'load_more' => false
	);
	
	$loop = WP_RealEstate_Query::get_agency_agents($post_id, array(
	    'post_per_page' => get_option('posts_per_page'),
	    'paged' => $paged
	));
    
    $output = '';
    if ( !empty($loop) && $loop->have_posts() ) {
    	$return['load_more'] = $loop->max_num_pages > $paged ? true : false;
        while ( $loop->have_posts() ) : $loop->the_post();
        	$output .= '<div class="col-12 col-sm-6 list-item">';
        	$output .= WP_RealEstate_Template_Loader::get_template_part( 'agents-styles/inner-list' );
        	$output .= '</div>';
        endwhile;
        wp_reset_postdata();
    }
    $return['output'] = $output;
    echo wp_json_encode($return);
    exit();
}

function justhome_properties_display_save_search($rand_key) {
	$output = WP_RealEstate_Template_Loader::get_template_part('loop/property/properties-save-search-form2', array('rand_key' => $rand_key));
	echo trim($output);
}

function justhome_placeholder_img_src( $size = 'thumbnail' ) {
	$src               = get_template_directory_uri() . '/images/placeholder.png';
	$placeholder_image = justhome_get_config('property_placeholder_image');
	if ( !empty($placeholder_image['id']) ) {
        if ( is_numeric( $placeholder_image['id'] ) ) {
			$image = wp_get_attachment_image_src( $placeholder_image['id'], $size );

			if ( ! empty( $image[0] ) ) {
				$src = $image[0];
			}
		} else {
			$src = $placeholder_image;
		}
    }

	return apply_filters( 'justhome_job_placeholder_img_src', $src );
}

function justhome_compare_footer_html() {
	if ( !justhome_get_config('listing_enable_compare', true) ) {
		return;
	}
	$compare_ids = WP_RealEstate_Compare::get_compare_items(); ?>
	<div id="compare-sidebar" class="<?php echo esc_attr(count($compare_ids) > 0 ? 'active' : ''); ?>">
		<h3 class="title"><?php echo esc_html__('Compare Properties', 'justhome'); ?></h3>
		<div class="compare-sidebar-inner">
			<div class="compare-list">
				<?php
					if ( count($compare_ids) > 0 ) {
						$page_id = wp_realestate_get_option('compare_properties_page_id');
	            		$submit_url = $page_id ? get_permalink($page_id) : home_url( '/' );
						
						foreach ($compare_ids as $property_id) {
							$post_object = get_post( $property_id );
	                        if ( $post_object ) {
	                            setup_postdata( $GLOBALS['post'] =& $post_object );
	                            echo WP_RealEstate_Template_Loader::get_template_part( 'properties-styles/inner-list-compare-small' );
	                        }
						}
					}
				?>
			</div>
			<?php if ( count($compare_ids) > 0 ) { ?>
				<div class="compare-actions">
					<div class="row row-20 clearfix">
						<div class="col-6">
						<a href="<?php echo esc_url($submit_url); ?>" class="btn btn-dark btn-sm w-100"><?php echo esc_html__('Compare', 'justhome'); ?></a>
						</div>
						<div class="col-6">
						<a href="javascript:void(0);" class="btn-remove-compare-all btn btn-danger btn-sm w-100" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-realestate-remove-property-compare-nonce' )); ?>"><?php echo esc_html__('Clear', 'justhome'); ?></a>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="compare-sidebar-btn">
			<?php esc_html_e( 'Compare', 'justhome' ); ?> (<span class="count"><?php echo count($compare_ids); ?></span>)
		</div>
	</div><!-- .widget-area -->
<?php
}
add_action( 'wp_footer', 'justhome_compare_footer_html', 10 );

function justhome_add_remove_property_compare_return($return) {
	$compare_ids = WP_RealEstate_Compare::get_compare_items();
	$output = '';
	if ( !empty($compare_ids) && count($compare_ids) > 0 ) {
		ob_start();
		$page_id = wp_realestate_get_option('compare_properties_page_id');
		$submit_url = $page_id ? get_permalink($page_id) : home_url( '/' );
		?>
		<div class="compare-list">
			<?php
			foreach ($compare_ids as $property_id) {
				$post_object = get_post( $property_id );
                if ( $post_object ) {
                    setup_postdata( $GLOBALS['post'] =& $post_object );
                    echo WP_RealEstate_Template_Loader::get_template_part( 'properties-styles/inner-list-compare-small' );
                }
			}
			?>
		</div>
		<div class="compare-actions">
			<div class="row row-20 clearfix">
				<div class="col-6">
				<a href="<?php echo esc_url($submit_url); ?>" class="btn btn-dark btn-sm w-100"><?php echo esc_html__('Compare', 'justhome'); ?></a>
				</div>
				<div class="col-6">
				<a href="javascript:void(0);" class="btn-remove-compare-all btn btn-danger btn-sm w-100" data-nonce="<?php echo esc_attr(wp_create_nonce( 'wp-realestate-remove-property-compare-nonce' )); ?>"><?php echo esc_html__('Clear', 'justhome'); ?></a>
				</div>
			</div>
		</div>
		<?php
		$output = ob_get_clean();
	}
	$return['html_output'] = $output;
	$return['count'] = !empty($compare_ids) ? count($compare_ids) : 0;
	

	return $return;
}
add_filter( 'wp-realestate-process-add-property-compare-return', 'justhome_add_remove_property_compare_return', 10, 1 );
add_filter( 'wp-realestate-process-remove-property-compare-return', 'justhome_add_remove_property_compare_return', 10, 1 );


remove_action( 'wp_realestate_before_property_archive', array( 'WP_RealEstate_Property', 'display_properties_orderby_start' ), 15 );
add_action( 'wp_realestate_before_property_archive', array( 'WP_RealEstate_Property', 'display_properties_orderby_start' ), 1 );



// autocomplete search properties
add_action( 'wre_ajax_justhome_autocomplete_search_properties', 'justhome_autocomplete_search_properties' );

add_action( 'wp_ajax_justhome_autocomplete_search_properties', 'justhome_autocomplete_search_properties' );
add_action( 'wp_ajax_nopriv_justhome_autocomplete_search_properties', 'justhome_autocomplete_search_properties' );

function justhome_autocomplete_search_properties() {
    // Query for suggestions
    $suggestions = array();
    $args = array(
		'post_type' => 'property',
		'posts_per_page' => 10,
		'fields' => 'ids'
	);
    $filter_params = isset($_REQUEST['data']) ? $_REQUEST['data'] : null;

	$properties = WP_RealEstate_Query::get_posts( $args, $filter_params );

	if ( !empty($properties->posts) ) {
		foreach ($properties->posts as $post_id) {
			$suggestion['title'] = get_the_title($post_id);
			$suggestion['url'] = get_permalink($post_id);

			if ( has_post_thumbnail( $post_id ) ) {
	            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'thumbnail' );
	            $suggestion['image'] = $image[0];
	        } else {
	            $suggestion['image'] = justhome_placeholder_img_src();
	        }
	        
	        $suggestion['price'] = justhome_property_display_price($post_id, 'no-icon-title', false);
	        

	        $post = get_post($post_id);

	        $statuses = get_the_terms( $post_id, 'property_status' );
	        ob_start();
			if ( $statuses ) {
				foreach ($statuses as $term) {
					?>
		            	<span><?php echo esc_html($term->name); ?> </span>
		        	<?php
		    	}
		    }
		    $status_html = ob_get_clean();
	        $suggestion['status'] = $status_html;

	        $meta_obj = WP_RealEstate_Property_Meta::get_instance($post_id);
            $beds = justhome_property_display_meta($post, 'beds', '', false, $meta_obj->get_post_meta_title( 'beds' ));
            $baths = justhome_property_display_meta($post, 'baths', '', false, $meta_obj->get_post_meta_title( 'baths' ));

            $suffix = wp_realestate_get_option('measurement_unit_area');
            $lot_area = justhome_property_display_meta($post, 'lot_area', '', false, $suffix);

            ob_start();
            if ( $lot_area || $beds || $baths ) {
            ?>
                <div class="property-metas d-flex flex-wrap">
                    <?php
                        echo trim($beds);
                        echo trim($baths);
                        echo trim($lot_area);
                    ?>
                </div>
            <?php }
            $metas = ob_get_clean();
            $suggestion['metas'] = $metas;

        	$suggestions[] = $suggestion;
		}
		wp_reset_postdata();
	}
    echo json_encode( $suggestions );
 
    exit;
}


function justhome_user_display_phone($phone, $display_type = 'no-title', $echo = true, $always_show_phone = false) {
    ob_start();
    if ( $phone ) {
        $show_full = justhome_get_config('listing_show_full_phone', false);
        $hide_phone = $show_full ? false : true;
        $hide_phone = apply_filters('justhome_phone_hide_number', $hide_phone );
        if ( $always_show_phone ) {
        	$hide_phone = false;
        }
        $add_class = '';
        if ( $hide_phone ) {
            $add_class = 'phone-hide';
        }
        if ( $display_type == 'title' ) {
            ?>
            <div class="phone-wrapper agent-phone with-title <?php echo esc_attr($add_class); ?>">
                <span><?php esc_html_e('Phone: ', 'justhome'); ?></span>
            <?php
        } elseif ($display_type == 'icon') {
            ?>
            <div class="phone-wrapper agent-phone with-icon <?php echo esc_attr($add_class); ?>">
                <i class="ti-headphone-alt"></i>
        <?php
        } else {
            ?>
            <div class="phone-wrapper agent-phone <?php echo esc_attr($add_class); ?>">
            <?php
        }

        ?>
            <a class="phone" href="tel:<?php echo trim($phone); ?>"><?php echo trim($phone); ?></a>
            <?php if ( $hide_phone ) {
                $dispnum = substr($phone, 0, (strlen($phone)-3) ) . str_repeat("*", 3);
            ?>
                <span class="phone-show" onclick="this.parentNode.classList.add('show');"><?php echo trim($dispnum); ?> <span><?php esc_html_e('show', 'justhome'); ?></span></span>
            <?php } ?>
        </div>
        <?php
    }
    $output = ob_get_clean();
    if ( $echo ) {
        echo trim($output);
    } else {
        return $output;
    }
}


add_action( 'wp_ajax_nopriv_justhome_ajax_print_property', 'justhome_ajax_print_property' );
add_action( 'wp_ajax_justhome_ajax_print_property', 'justhome_ajax_print_property' );

add_action( 'wre_ajax_justhome_ajax_print_property', 'justhome_ajax_print_property' );

function justhome_ajax_print_property () {
	if ( !isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'justhome-printer-property-nonce' )  ) {
		exit();
	}
	if( !isset($_POST['property_id'])|| !is_numeric($_POST['property_id']) ){
        exit();
    }

    $property_id = intval($_POST['property_id']);
    $the_post = get_post( $property_id );

    if( $the_post->post_type != 'property' || $the_post->post_status != 'publish' ) {
        exit();
    }
    setup_postdata( $GLOBALS['post'] =& $the_post );
    global $post;

    $dir = '';
    $body_class = '';
    if ( is_rtl() ) {
    	$dir = 'dir="rtl"';
    	$body_class = 'rtl';
    }

    print  '<html '.$dir.'><head><link href="'.get_stylesheet_uri().'" rel="stylesheet" type="text/css" />';
    if( is_rtl() ) {
    	print '<link href="'.get_template_directory_uri().'/css/bootstrap.rtl.css" rel="stylesheet" type="text/css" />';
    	print  '<html><head><link href="'.get_template_directory_uri().'/css/template.rtl.css" rel="stylesheet" type="text/css" />';
    } else {
	    print  '<html><head><link href="'.get_template_directory_uri().'/css/bootstrap.css" rel="stylesheet" type="text/css" />';
	    print  '<html><head><link href="'.get_template_directory_uri().'/css/template.css" rel="stylesheet" type="text/css" />';
	}
    print  '<html><head><link href="'.get_template_directory_uri().'/css/all-awesome.css" rel="stylesheet" type="text/css" />';
    print  '<html><head><link href="'.get_template_directory_uri().'/css/flaticon.css" rel="stylesheet" type="text/css" />';
    print  '<html><head><link href="'.get_template_directory_uri().'/css/themify-icons.css" rel="stylesheet" type="text/css" />';

    print '</head>';
    print '<script>window.onload = function() { window.print(); }</script>';
    print '<body class="'.$body_class.'">';

    $logo_url = justhome_get_config('print-logo');
    if( isset($logo_url) && !empty($logo_url) ) {
    	$print_logo = $logo_url;
    } else {
    	$print_logo = get_template_directory_uri().'/images/logo.svg';
    }
    $title = get_the_title( $property_id );

    $image_id = get_post_thumbnail_id( $property_id );
    $full_img = wp_get_attachment_image_src($image_id, 'full');
    $full_img = $full_img [0];

    ?>

    <section id="section-body">
        <!--start detail content-->
        <section class="section-detail-content">
            <div class="detail-bar print-detail">
                
                <?php if ( justhome_get_config('show_print_header', true) ) { ?>
	            	<div class="print-header-top">
	                    <div class="inner">
	                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="print-logo">
	                            <img src="<?php echo esc_url($print_logo); ?>" alt="<?php esc_attr_e('Logo', 'justhome'); ?>">
	                            <span class="tag-line"><?php bloginfo( 'description' ); ?></span>
	                        </a>
	                    </div>
	                </div>
	            <?php } ?>

                <div class="print-header-middle">
                    <div class="print-header-middle-left">
                        <h1><?php echo esc_attr($title); ?></h1>
                        <?php justhome_property_display_full_location($post,'no-icon-title',true); ?>
                    </div>
                    <div class="print-header-middle-right">
                        <?php justhome_property_display_price($post); ?>
                    </div>
                </div>

                <?php if( !empty($full_img) ) { ?>
	                <div class="print-banner">
	                    <div class="print-main-image">
                            <img src="<?php echo esc_url( $full_img ); ?>" alt="<?php echo esc_attr($title); ?>">
                            <?php if ( justhome_get_config('show_print_qrcode', true) ) { ?>
	                            <img class="qr-image" src="https://chart.googleapis.com/chart?chs=105x104&cht=qr&chl=<?php echo esc_url( get_permalink($property_id) ); ?>&choe=UTF-8" title="<?php echo esc_attr($title); ?>" />
	                        <?php } ?>
	                    </div>
	                </div>
                <?php } ?>
                <?php
                
                if ( justhome_get_config('show_print_agent', true) ) {
                	$author_id = $post->post_author;
					$avatar = $a_phone = $a_website = $a_title = '';
					if ( WP_RealEstate_User::is_agency($author_id) ) {
						$agency_id = WP_RealEstate_User::get_agency_by_user_id($author_id);
						$agency_post = get_post($agency_id);
						$author_email = justhome_agency_display_email($agency_post, 'no-title', false);
						
						$post_thumbnail_id = get_post_thumbnail_id($agency_id);
	            		$avatar = wp_get_attachment_image( $post_thumbnail_id, 'thumbnail' );

						$a_title = get_the_title($agency_id);
						$a_phone = justhome_agency_display_phone($agency_post, 'no-title', false, true);
						$a_website = justhome_agency_display_website($agent_post, 'no-title', false);
					} elseif ( WP_RealEstate_User::is_agent($author_id) ) {
						$agent_id = WP_RealEstate_User::get_agent_by_user_id($author_id);
						$agent_post = get_post($agent_id);
						$author_email = justhome_agent_display_email($agent_post, 'no-title', false);

						$post_thumbnail_id = get_post_thumbnail_id($agent_id);
	            		$avatar = wp_get_attachment_image( $post_thumbnail_id, 'thumbnail' );

						$a_title = get_the_title($agent_id);
						$a_phone = justhome_agent_display_phone($agent_post, 'no-title', false, true);
						$a_website = justhome_agent_display_website($agent_post, 'no-title', false);
					} else {
						$user_id = $post->post_author;
						$author_email = get_the_author_meta('user_email');
						$a_title = get_the_author_meta('display_name');
						$a_phone = get_user_meta($user_id, '_phone', true);
						$a_phone = justhome_user_display_phone($a_phone, 'no-title', false, true);
						$a_website = get_user_meta($user_id, '_url', true);
					}
            	?>
                    <div class="print-block">
                    	<h3><?php esc_html_e( 'Contact Agent', 'justhome' ); ?></h3>
                        <div class="agent-media">
                            <div class="media-image-left">
                                <?php if ( !empty($avatar) ) {
									echo trim($avatar);
								} else {
							        echo justhome_get_avatar($post->post_author, 180);
								} ?>
                            </div>
                            <div class="media-body-right">
                                
                                <h4 class="title"><?php echo trim($a_title); ?></h4>
								<div class="phone"><?php echo trim($a_phone); ?></div>
								<div class="email"><?php echo trim($author_email); ?></div>
								<div class="website"><?php echo trim($a_website); ?></div>

                            </div>
                        </div>
                    </div>
                <?php } ?>

                <div id="property-single-details">
					<?php
					if ( justhome_get_config('show_print_description', true) ) {
						?>
						<div class="description inner">
						    <h3 class="title"><?php esc_html_e('Overview', 'justhome'); ?></h3>
						    <div class="description-inner">
						        <?php the_content(); ?>
						        <?php do_action('wp-realestate-single-property-description', $post); ?>
						    </div>
						</div>
						<?php
					}
					
					if ( justhome_get_config('show_print_energy', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/energy' );
					}
					
					?>

					<?php
					if ( justhome_get_config('show_print_detail', true) ) {
						echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/detail' );
					}
					?>

				</div>

				<?php
				if ( justhome_get_config('show_print_amenities', true) ) {
					echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/amenities' );
				}
				?>

				<?php
				if ( justhome_get_config('show_print_floor-plans', true) ) {
					echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/floor-plans-print' );
				}
				?>
				
				<?php
				if ( justhome_get_config('show_print_facilities', true) ) {
					echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/facilities' );
				}
				?>

				<?php
				if ( justhome_get_config('show_print_valuation', true) ) {
					echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/valuation' );
				}

				$obj_property_meta = WP_RealEstate_Property_Meta::get_instance($post->ID);
				$gallery = $obj_property_meta->get_post_meta( 'gallery' );
				if ( justhome_get_config('show_print_gallery', true) && $gallery ) {
				?>
					<div class="print-gallery">
						<div class="detail-title-inner">
                            <h4 class="title-inner"><?php esc_html_e('Property images', 'justhome'); ?></h4>
                        </div>
                        <div class="row">
							<?php foreach ( $gallery as $id => $src ) { ?>
				                <div class="print-gallery-image col-12 col-sm-6">
				                    <?php echo wp_get_attachment_image( $id, 'full' ); ?>
				                </div>
			                <?php } ?>
		                </div>
		          	</div>
	          	<?php } ?>
				
            </div>
        </section>
    </section>


    <?php
    
    wp_reset_postdata();

    print '</body></html>';
    wp_die();
}


function justhome_load_select2(){
	if ( version_compare(WP_REALESTATE_PLUGIN_VERSION, '1.5.3', '>=') ) {
		wp_enqueue_script('wre-select2');
		wp_enqueue_style('wre-select2');
	} else {
		wp_enqueue_script('select2');
		wp_enqueue_style('select2');
	}
}


add_filter('wp-realestate-property-stats-bg-color', 'justhome_property_stats_bg_color');
add_filter('wp-realestate-property-stats-border-color', 'justhome_property_stats_bg_color');
function justhome_property_stats_bg_color($color) {
	if ( justhome_get_config('main_color') != "" ) {
		$color = justhome_get_config('main_color');
	} else {
		$color = '#0061DF';
	}
	return $color;
}

add_filter('wp-realestate-process-change-profile-normal-keys', 'justhome_property_process_change_profile_normal_keys', 100);
function justhome_property_process_change_profile_normal_keys($keys) {
	$keys[] = 'whatsapp';
	return $keys;
}

add_filter( 'wp-realestate-create-attachment-remove-image-sizes', 'justhome_property_create_attachment_remove_image_sizes', 100);
function justhome_property_create_attachment_remove_image_sizes($sizes) {
	$layout_type = justhome_get_config('property_layout_type', 'v1');
	$sizes[] = 'large';
	$sizes[] = 'medium_large';
	$sizes[] = 'medium';
	$sizes[] = 'justhome-agent-grid';
	return $sizes;
}

function justhome_filter_field_location_select($instance, $args, $key, $field) {
	$name = WP_RealEstate_Abstract_Filter::filter_get_name($key, $field);
    $selected = !empty( $_GET[$name] ) ? $_GET[$name] : '';

    include WP_RealEstate_Template_Loader::locate( 'widgets/filter-fields/number_choose' );
}


add_filter( 'wp_realestate_display_field_data', 'justhome_display_hook_custom_field_data', 10, 6 );
function justhome_display_hook_custom_field_data($html, $custom_field, $post, $field_name, $output_value, $current_hook) {
	if ( $current_hook === 'wp-realestate-single-property-details' ) {
		ob_start();
        ?>
        <li class="d-flex align-items-center">
            <?php if ( $field_name ) { ?>
                <div class="text flex-shrink-0"><?php echo trim($field_name); ?>:</div>
            <?php } ?>
            <div class="value flex-grow-1"><?php echo trim($output_value); ?></div>
        </li>
        <?php
        $html = ob_get_clean();
    }

    return $html;
}


// Elementor template
add_filter( 'template_include', 'justhome_property_set_template', 100 );
function justhome_property_set_template($template) {
    if ( is_embed() ) {
        return $template;
    }
    if ( is_singular( 'property' ) ) {
    	$template_id = justhome_get_property_layout_type();
        if ( $template_id ) {
            $template = WP_RealEstate_Template_Loader::locate('template-properties/single-property-elementor');
        }
    } elseif ( justhome_is_properties_page() ) {
        if ( justhome_get_config( 'property_archive_elementor_template' ) ) {
            $template = WP_RealEstate_Template_Loader::locate('template-properties/archive-property-elementor');
        }
    }
    return $template;
}

add_action( 'justhome_property_detail_content', 'justhome_property_detail_builder_content', 5 );
function justhome_property_detail_builder_content() {
    $template_id = justhome_get_property_layout_type();
    if ( $template_id ) {
        $post = get_post($template_id);
        echo apply_filters( 'justhome_generate_post_builder', '', $post, $template_id);
    }
}

add_action( 'justhome_property_archive_content', 'justhome_property_archive_builder_content', 5 );
function justhome_property_archive_builder_content() {
    $template_id = justhome_get_config('property_archive_elementor_template');
    if ( $template_id ) {
        $post = get_post($template_id);
        echo apply_filters( 'justhome_generate_post_builder', '', $post, $template_id);
    }
}

add_filter('wp-realestate-twitter-login-btn', 'justhome_twitter_login_btn', 10, 2);
function justhome_twitter_login_btn($output, $obj) {
	if ( is_user_logged_in() ) {
        return;
    }
    ob_start();
    $obj->display_message();
    ?>
    <div class="twitter-login-btn-wrapper">
        <a class="twitter-login-btn" href="<?php echo esc_url($obj->get_login_url()); ?>"><i class="fa-brands fa-x-twitter"></i></a>
    </div>
    <?php
    $output = ob_get_clean();
    echo trim($output);
}

add_filter( 'wp-realestate-get-socials-network', 'justhome_wp_realestate_get_socials_network', 10);
function justhome_wp_realestate_get_socials_network($fields) {
	$fields = array(
		'fab fa-facebook-f' => esc_html__('Facebook', 'justhome'),
		'fa-brands fa-x-twitter' => esc_html__('Twitter', 'justhome'),
		'fab fa-linkedin-in' => esc_html__('Linkedin', 'justhome'),
        'fab fa-dribbble' => esc_html__('Dribbble', 'justhome'),
        'fab fa-instagram' => esc_html__('Instagram', 'justhome'),
        'fab fa-google-plus-g' => esc_html__('Google +', 'justhome'),
        'fab fa-github-alt' => esc_html__('Github', 'justhome'),
        'fab fa-reddit-alien' => esc_html__('Reddit', 'justhome'),
        'fab fa-youtube' => esc_html__('Youtube', 'justhome'),
        'fab fa-vimeo-v' => esc_html__('Vimeo', 'justhome'),
		'fab fa-pinterest' => esc_html__('Pinterest', 'justhome'),
	);
	return $fields;
}


// demo function
function justhome_check_demo_account() {
	if ( defined('JUSTHOME_DEMO_MODE') && JUSTHOME_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'agency' || strtolower($user_obj->data->user_login) == 'agent' ) {
			$return = array( 'status' => false, 'msg' => esc_html__('Demo users are not allowed to modify information.', 'justhome') );
		   	echo wp_json_encode($return);
		   	exit;
		}
	}
}

add_action('wp-realestate-process-forgot-password', 'justhome_check_demo_account', 10);
add_action('wp-realestate-process-change-password', 'justhome_check_demo_account', 10);
add_action('wp-realestate-before-delete-profile', 'justhome_check_demo_account', 10);
add_action('wp-realestate-before-remove-property-alert', 'justhome_check_demo_account', 10 );
add_action('wp-realestate-before-change-profile-normal', 'justhome_check_demo_account', 10 );
add_action('wp-realestate-process-add-agent', 'justhome_check_demo_account', 10 );
add_action('wp-realestate-process-remove-agent', 'justhome_check_demo_account', 10 );
add_action('wp-realestate-process-remove-before-save', 'justhome_check_demo_account', 10);

function justhome_check_demo_account2($error) {
	if ( defined('JUSTHOME_DEMO_MODE') && JUSTHOME_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'agency' || strtolower($user_obj->data->user_login) == 'agent' ) {
			$error[] = esc_html__('Demo users are not allowed to modify information.', 'justhome');
		}
	}
	return $error;
}
add_filter('wp-realestate-submission-validate', 'justhome_check_demo_account2', 10, 2);
add_filter('wp-realestate-edit-validate', 'justhome_check_demo_account2', 10, 2);

function justhome_check_demo_account3($post_id, $prefix) {
	if ( defined('JUSTHOME_DEMO_MODE') && JUSTHOME_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'agency' || strtolower($user_obj->data->user_login) == 'agent' ) {
			$_SESSION['messages'][] = array( 'danger', esc_html__('Demo users are not allowed to modify information.', 'justhome') );
			$redirect_url = get_permalink( wp_realestate_get_option('edit_profile_page_id') );
			WP_RealEstate_Mixes::redirect( $redirect_url );
			exit();
		}
	}
}
add_action('wp-realestate-process-profile-before-change', 'justhome_check_demo_account3', 10, 2);

function justhome_check_demo_account4() {
	if ( defined('JUSTHOME_DEMO_MODE') && JUSTHOME_DEMO_MODE ) {
		$user_id = get_current_user_id();
		$user_obj = get_user_by('ID', $user_id);
		if ( strtolower($user_obj->data->user_login) == 'agency' || strtolower($user_obj->data->user_login) == 'agent' ) {
			$return['msg'] = esc_html__('Demo users are not allowed to modify information.', 'justhome');
			$return['status'] = false;
			echo json_encode($return); exit;
		}
	}
}
add_action('wp-private-message-before-reply-message', 'justhome_check_demo_account4');
add_action('wp-private-message-before-add-message', 'justhome_check_demo_account4');
add_action('wp-private-message-before-delete-message', 'justhome_check_demo_account4');
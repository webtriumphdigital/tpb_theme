<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Gallery extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_gallery';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Gallery', 'justhome' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'justhome-property-detail-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Title', 'justhome' ),
			]
		);

		$this->add_control(
			'layout_type',
			[
				'label' => esc_html__( 'Layout Type', 'justhome' ),
				'type' => Elementor\Controls_Manager::SELECT,
				'default' => 'v1',
				'options' => [
					'v1' => esc_html__( 'V1', 'justhome' ),
					'v2' => esc_html__( 'V2', 'justhome' ),
					'v3' => esc_html__( 'V3', 'justhome' ),
					'v4' => esc_html__( 'V4', 'justhome' ),
					'v5' => esc_html__( 'V5', 'justhome' ),
					'v6' => esc_html__( 'V6', 'justhome' ),
				],
			]
		);

		$this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default' => 'full',
                'separator' => 'none',
                'condition' => [
                    'layout_type' => ['v1', 'v4', 'v6'],
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
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		extract( $settings );

		if ( justhome_is_property_single_page() ) {
			global $post;
			$post_id = get_the_ID();
		} else {
			$args = array(
				'limit' => 1,
				'fields' => 'ids',
			);
			$properties = justhome_get_properties($args);
			if ( !empty($properties->posts) ) {
				$post_id = $properties->posts[0];
				$post = get_post($post_id);
				setup_postdata( $GLOBALS['post'] =& $post );
			}
		}
		if ( !empty($post) ) {
			?>
			<div class="detail-gallery <?php echo esc_attr($el_class); ?>">
				<?php
					$args = array('post' => $post, 'layout_type' => $layout_type);
					if ( $image_size == 'custom' ) {
		                
		                if ( $image_custom_dimension['width'] && $image_custom_dimension['height'] ) {
		                    $imagesize = $image_custom_dimension['width'].'x'.$image_custom_dimension['height'];
		                } else {
		                    $imagesize = 'full';
		                }
		            } else {
		                $imagesize = $image_size;
		            }
		            $args['gallery_size'] = $imagesize;

		            if ( $layout_type == 'v1' ) {
			            if ( $thumbnail_size == 'custom' ) {
			                
			                if ( $thumbnail_custom_dimension['width'] && $thumbnail_custom_dimension['height'] ) {
			                    $thumbnailsize = $thumbnail_custom_dimension['width'].'x'.$thumbnail_custom_dimension['height'];
			                } else {
			                    $thumbnailsize = 'full';
			                }
			            } else {
			                $thumbnailsize = $thumbnail_size;
			            }
			            $args['gallery_second_size'] = $thumbnailsize;
			            echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/gallery', $args );
			        } elseif ( $layout_type == 'v4' ) {
			            if ( $thumbnail_size == 'custom' ) {
			                
			                if ( $thumbnail_custom_dimension['width'] && $thumbnail_custom_dimension['height'] ) {
			                    $thumbnailsize = $thumbnail_custom_dimension['width'].'x'.$thumbnail_custom_dimension['height'];
			                } else {
			                    $thumbnailsize = 'full';
			                }
			            } else {
			                $thumbnailsize = $thumbnail_size;
			            }
			            $args['gallery_second_size'] = $thumbnailsize;
			            echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/gallery-v4', $args );
			        } elseif ( $layout_type == 'v6' ) {
			            if ( $thumbnail_size == 'custom' ) {
			                
			                if ( $thumbnail_custom_dimension['width'] && $thumbnail_custom_dimension['height'] ) {
			                    $thumbnailsize = $thumbnail_custom_dimension['width'].'x'.$thumbnail_custom_dimension['height'];
			                } else {
			                    $thumbnailsize = 'full';
			                }
			            } else {
			                $thumbnailsize = $thumbnail_size;
			            }
			            $args['gallery_second_size'] = $thumbnailsize;
			            echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/gallery-v6', $args );
			        } elseif ($layout_type == 'v5') {
		            	echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/gallery-v5', $args );
		            } elseif ($layout_type == 'v2') {
		            	echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/gallery-v2', $args );
		            } else {
		            	echo WP_RealEstate_Template_Loader::get_template_part( 'single-property/gallery-v3', $args );
		            }
				?>
			</div>
			<?php
			if ( !justhome_is_property_single_page() ) {
				wp_reset_postdata();
			}
		}
	}

}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Gallery );

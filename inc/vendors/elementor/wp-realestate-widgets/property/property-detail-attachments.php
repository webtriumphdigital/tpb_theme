<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Attachments extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_attachments';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Attachments', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-property-detail-elements' ];
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Settings', 'justhome' ),
			]
		);

		$this->add_control(
            'title',
            [
                'label' => esc_html__( 'Title', 'justhome' ),
                'type' => Elementor\Controls_Manager::TEXT,
                'input_type' => 'text',
                'placeholder' => esc_html__( 'Enter your title here', 'justhome' ),
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
		$settings = $this->get_settings();

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
			}
		}
		if ( !empty($post) ) {
			$meta_obj = WP_RealEstate_Property_Meta::get_instance($post->ID);

			$attachments = $meta_obj->get_post_meta('attachments');

			if ( $meta_obj->check_post_meta_exist('attachments') && $attachments ) {
				$download_url = WP_RealEstate_Ajax::get_endpoint('wp_realestate_ajax_download_attachment');
			?>
				<?php if ( $attachments ) { ?>
                            <h2 class="title-related-properties"><?php echo esc_html($title); ?></h2>
                        <?php } ?>
				<div class="property-attachments <?php echo esc_attr($el_class); ?>">
					<div class="attachments-inner clearfix">
						<?php foreach ($attachments as $id => $attachment_url) {
					        $file_info = pathinfo($attachment_url);
					        if ( $file_info ) {
					            $download_url = add_query_arg(array('file_id' => $id), $download_url);
					        ?>
					            <div class="attachment-item">
					                <a href="<?php echo esc_url($download_url); ?>" class="attachment-detail-download-url d-flex align-items-center">
					                	<span class="icon_type flex-shrink-0">
					                		<i class="flaticon-pdf"></i>
					                	</span>
					                	<span class="inner flex-grow-1">
							                <?php if ( !empty($file_info['filename']) ) { ?>
							                    <span class="filename"><?php echo esc_html($file_info['filename']); ?></span>
							                <?php } ?>
							                <?php if ( !empty($file_info['extension']) ) { ?>
							                    <span class="extension"><?php echo esc_html($file_info['extension']); ?></span>
							                <?php } ?>
						                </span>
						            </a>
					            </div>
					        <?php }
					    }?>
					</div>
				</div>
			<?php }
	    }
	}
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Attachments );

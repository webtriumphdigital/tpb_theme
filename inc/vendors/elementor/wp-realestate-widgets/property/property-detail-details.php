<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class Justhome_Elementor_Widget_Detail_Property_Details extends Elementor\Widget_Base {

	public function get_name() {
		return 'apus_element_detail_property_details';
	}

	public function get_title() {
		return esc_html__( 'Property Details:: Details', 'justhome' );
	}

	public function get_categories() {
		return [ 'justhome-property-detail-elements' ];
	}

	public function get_property_fields() {
		$fields = WP_RealEstate_Custom_Fields::get_custom_fields(array(), false);
        $all_fields = array( '' => esc_html__('Choose a field', 'justhome') );
        if ( !empty($fields) ) {
	        foreach ($fields as $key => $field) {
	        	if ( $field['type'] !== 'title' ) {
		            $name = $field['name'];
		            if ( empty($field['name']) ) {
		                $name = $field['id'];
		            }
		            $all_fields[$field['id']] = $name;
		        }
	        }
        }

        return $all_fields;
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Fields', 'justhome' ),
			]
		);

		$all_fields = $this->get_property_fields();

		$repeater = new Elementor\Repeater();

        $repeater->add_control(
            'show_field',
            [
                'label' => esc_html__( 'Show field', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => $all_fields
            ]
        );

        $repeater->add_control(
			'custom_title',
			[
				'label' => esc_html__( 'Custom Label', 'justhome' ),
				'type' => Elementor\Controls_Manager::TEXT,
			]
		);

        $repeater->add_control(
            'show_url',
            [
                'label'         => esc_html__( 'Show URL', 'justhome' ),
                'type'          => Elementor\Controls_Manager::SWITCHER,
                'label_on'      => esc_html__( 'Show', 'justhome' ),
                'label_off'     => esc_html__( 'Hide', 'justhome' ),
                'return_value'  => true,
                'default'       => true,
                'condition' => [
                    'show_field' => array('_property_type', '_property_location', '_property_status', '_property_label', '_property_amenity', '_property_material'),
                ],
            ]
        );

		$repeater->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Icon', 'justhome' ),
				'type' => Elementor\Controls_Manager::ICONS,
				'fa4compatibility' => 'icon',
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'suffix',
			[
				'label' => esc_html__( 'Suffix', 'justhome' ),
				'type' => Elementor\Controls_Manager::TEXT,
				'default' => '',
			]
		);

		$this->add_control(
            'items',
            [
                'label' => esc_html__( 'Fields', 'justhome' ),
                'type' => Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
            ]
        );

        $this->add_control(
            'style',
            [
                'label' => esc_html__( 'Style', 'justhome' ),
                'type' => Elementor\Controls_Manager::SELECT,
                'options' => array(
                    '' => esc_html__('Default', 'justhome'),
                    'st_border' => esc_html__('Border', 'justhome'),
                    'st_big' => esc_html__('Big Size', 'justhome'),
                ),
                'default' => ''
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
			$post_id = get_the_ID();
		} else {
			$args = array(
				'limit' => 1,
				'fields' => 'ids',
			);
			$properties = justhome_get_properties($args);
			if ( !empty($properties->posts) ) {
				$post_id = $properties->posts[0];
			}
		}

		if ( !empty($post_id) && !empty($items) ) {
			$all_fields = $this->get_property_fields();
			?>
			<div class="property-detail-detail <?php echo esc_attr($el_class); ?>">
				<ul class="list list-detail d-flex flex-wrap <?php echo esc_attr($style); ?>">
					<?php foreach ($items as $item) {
						$field_name = isset($all_fields[$item['show_field']]) ? $all_fields[$item['show_field']] : array();
						$this->render_meta_field($item, $post_id, $field_name);
					} ?>
				</ul>
			</div>
			<?php
		}
	}

	private function render_meta_field($item, $post_id, $field_name) {
		extract( $item );

		$meta_obj = WP_RealEstate_Property_Meta::get_instance($post_id);

		$value_html = '';
		$taxs = array('_property_type', '_property_location', '_property_status', '_property_label', '_property_amenity', '_property_material');
		
		if ( in_array($show_field, $taxs) ) {
			if ( $meta_obj->check_custom_post_meta_exist($show_field) ) {
				$tax_values = get_the_terms( $post_id, ltrim($show_field, '_') );
				if ( $tax_values && ! is_wp_error( $tax_values ) ) {
					$number = 1;
					ob_start();
					foreach ($tax_values as $term) {
						if ( $show_url ) {
						?>
			            	<a class="property-tax" href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo esc_html($term->name); ?></a><?php if($number < count($tax_values)) echo trim(', ');?>
			        	<?php
			        	} else {
			        		?>
			        		<span class="property-tax"><?php echo esc_html($term->name); ?></span><?php if($number < count($tax_values)) echo trim(', ');?>
			        		<?php
			        	}
			        	$number++;
			    	}
			    	$value_html = ob_get_clean();
				}
			}
		} else {
			if ( $meta_obj->check_custom_post_meta_exist($show_field) && ($value = $meta_obj->get_custom_post_meta($show_field)) ) {
				$value_html = is_array($value) ? implode(', ', $value) : $value;
			}
		}
		?>
		<li class="d-flex align-items-center">
			<div class="text flex-shrink-0">
				<?php
				if ( empty( $item['icon'] ) && ! Elementor\Icons_Manager::is_migration_allowed() ) {
					// add old default
					$item['icon'] = 'fa fa-star';
				}

				if ( ! empty( $item['icon'] ) ) {
					$this->add_render_attribute( 'icon', 'class', $item['icon'] );
					$this->add_render_attribute( 'icon', 'aria-hidden', 'true' );
				}

				$migrated = isset( $item['__fa4_migrated']['selected_icon'] );
				$is_new = empty( $item['icon'] ) && Elementor\Icons_Manager::is_migration_allowed();
				if ( $is_new || $migrated ) {
					Elementor\Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] );
				} else { ?>
					<i <?php $this->print_render_attribute_string( 'icon' ); ?>></i>
				<?php } ?>
				<?php
				$field_name = !empty($item['custom_title']) ? $item['custom_title'] : $field_name;
				if ( $field_name ) {
					?>
					<span class="field-title">
						<?php echo esc_html($field_name); ?>
					</span>
					<?php
				}
				?>
			</div>
			<div class="value flex-grow-1">
				<span class="content-value">
					<?php echo trim($value_html); ?>
				</span>
				<?php if ( $suffix ) { ?>
					<span class="suffix"><?php echo trim($suffix); ?></span>
				<?php } ?>
			</div>
		</li>
		<?php
	}
}

Elementor\Plugin::instance()->widgets_manager->register( new Justhome_Elementor_Widget_Detail_Property_Details );
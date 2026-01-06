<?php
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_filter( 'manage_edit-property_amenity_columns', 'justhome_tax_columns' );
add_filter( 'manage_property_amenity_custom_column', 'justhome_tax_column', 10, 3 );
add_action( 'property_amenity_add_form_fields', 'justhome_tax_add_fields_form' );
add_action( 'property_amenity_edit_form_fields', 'justhome_tax_edit_fields_form', 10, 2 );


add_action( 'create_term', 'justhome_tax_save' );
add_action( 'edit_term', 'justhome_tax_save' );


function justhome_tax_add_fields_form($taxonomy) {
	?>
	
	<div class="form-field icon-type-wrapper icon-type-font">
		<label><?php esc_html_e( 'Icon Font', 'justhome' ); ?></label>
		<?php justhome_input_icon_font_field(); ?>
	</div>

	<?php
}

function justhome_tax_edit_fields_form( $term, $taxonomy ) {
	$icon_font_value = get_term_meta( $term->term_id, 'apus_icon_font', true );
	?>
	
	<tr class="form-field icon-type-wrapper icon-type-font">
		<th scope="row" valign="top"><label><?php esc_html_e( 'Icon Font', 'justhome' ); ?></label></th>
		<td>
			<?php justhome_input_icon_font_field($icon_font_value); ?>
		</td>
	</tr>

	<?php
}

function justhome_input_icon_font_field( $val = '' ) {
	?>
	<input id="apus_tax_icon_font" name="apus_icon_font" type="text" value="<?php echo esc_attr($val); ?>">
	<?php
}


function justhome_tax_save( $term_id ) {
    update_term_meta( $term_id, 'apus_icon_font', isset( $_POST['apus_icon_font'] ) ? $_POST['apus_icon_font'] : '' );
}

function justhome_tax_columns( $columns ) {
	$new_columns = array();
	foreach ($columns as $key => $value) {
		if ( $key == 'name' ) {
			$new_columns['icon'] = esc_html__( 'Icon', 'justhome' );
		}
		$new_columns[$key] = $value;
	}
	return $new_columns;
}

function justhome_tax_column( $columns, $column, $id ) {
	if ( $column == 'icon' ) {
		$icon_font_value = get_term_meta( $id, 'apus_icon_font', true );
		if ( !empty($icon_font_value) ) {
			$columns .= '<i class="'.esc_attr($icon_font_value).'"></i>';
		}
	}
	return $columns;
}

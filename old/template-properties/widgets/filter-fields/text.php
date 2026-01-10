<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="form-group form-group-<?php echo esc_attr($key); ?>">
	<?php if ( (!isset($field['show_title']) || $field['show_title']) && !empty($field['name']) ) { ?>
    	<label for="<?php echo esc_attr( $args['widget_id'] ); ?>_<?php echo esc_attr($key); ?>" class="heading-label">
    		<?php echo wp_kses_post($field['name']); ?>
    	</label>
    <?php } ?>
    <div class="form-group-inner inner">
	    <input type="text" name="<?php echo esc_attr($name); ?>" class="form-control <?php echo esc_attr(!empty($field['add_class']) ? $field['add_class'] : '');?>"
	           value="<?php echo esc_attr($selected); ?>"
	           id="<?php echo esc_attr( $args['widget_id'] ); ?>_<?php echo esc_attr($key); ?>" placeholder="<?php echo esc_attr(!empty($field['placeholder']) ? $field['placeholder'] : ''); ?>">
	    <?php if ( !empty($field['icon_html']) ) { ?>
	    	<?php echo trim( $field['icon_html'] ); ?>
	    <?php } ?>
	</div>
</div><!-- /.form-group -->

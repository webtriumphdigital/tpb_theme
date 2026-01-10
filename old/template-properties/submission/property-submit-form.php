<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
wp_enqueue_style( 'dashicons' );
?>
<div class="property-submission-form-wrapper">
	<h1 class="title-profile"><?php echo esc_html__('Add New Property','justhome') ?></h1>
	<div class="box-submit">
		<?php if ( sizeof($form_obj->errors) ) : ?>
			
			<?php foreach ( $form_obj->errors as $message ) { ?>
				<div class="alert alert-danger margin-bottom-15">
					<?php echo trim( $message ); ?>
				</div>
			<?php
			}
			?>
		<?php endif; ?>

		<?php if ( sizeof($form_obj->success_msg) ) : ?>
			<?php foreach ( $form_obj->success_msg as $message ) { ?>
				<div class="alert alert-success margin-bottom-15">
					<?php echo trim( $message ); ?>
				</div>
			<?php
			}
			?>
		<?php endif; ?>
		
		<?php
			echo cmb2_get_metabox_form( $metaboxes_form, $post_id, array(
				'form_format' => '<form action="' . $form_obj->get_form_action() . '" class="cmb-form" method="post" id="%1$s" enctype="multipart/form-data" encoding="multipart/form-data"><input type="hidden" name="property_id" value="'.$property_id.'"><input type="hidden" name="'.$form_obj->get_form_name().'" value="'.$form_obj->get_form_name().'"><input type="hidden" name="submit_step" value="'.$step.'"><input type="hidden" name="object_id" value="%2$s">%3$s
					<div class="submit-button-wrapper">
						<button type="submit" name="submit-cmb-property" value="%4$s" class="btn btn-theme">%4$s<svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg></button>
					</div>
					</form>',
				'save_button' => $submit_button_text,
			) );
		?>
	</div>
</div>
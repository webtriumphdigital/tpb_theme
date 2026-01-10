<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<h1 class="title-profile"><?php esc_html_e('Change Password', 'justhome'); ?></h1>
<div class="box-white-dashboard max-650">
	<form method="post" action="" class="change-password-form form-theme">
		<div class="clearfix">
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						<input id="change-password-form-old-password" class="form-control" type="password" name="old_password" required="required">
						<label for="change-password-form-old-password" class="for-control"><?php echo esc_html__( 'Old password', 'justhome' ); ?></label>
					</div><!-- /.form-control -->
				</div>
				<div class="col-12">
					<div class="form-group">
						<input id="change-password-form-new-password" class="form-control" type="password" name="new_password" required="required" minlength="8">
						<label for="change-password-form-new-password" class="for-control"><?php echo esc_html__( 'New password', 'justhome' ); ?></label>
					</div><!-- /.form-control -->
				</div>
				<div class="col-12">
					<div class="form-group">
						<input id="change-password-form-retype-password" class="form-control" type="password" name="retype_password" required="required" minlength="8">
						<label for="change-password-form-retype-password" class="for-control"><?php echo esc_html__( 'Retype password', 'justhome' ); ?></label>
					</div><!-- /.form-control -->
				</div>
			</div>
		</div>
		<button type="submit" name="change_password_form" class="button btn btn-theme btn-inverse"><?php echo esc_html__( 'Change Password', 'justhome' ); ?><svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg></button>
	</form>
</div>
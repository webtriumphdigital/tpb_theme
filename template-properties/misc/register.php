<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$register_title = !empty($register_title) ? $register_title : '';
?>
<div class="register-form-wrapper">
  	<div class="form-login-register-inner">
  		<?php if ( $register_title ) { ?>
	  		<h2 class="title-small"><?php echo trim($register_title); ?></h2>
	  	<?php } ?>
      	<form name="registerForm" method="post" class="register-form form-theme">
      		
			<div class="form-group">
				<input type="text" class="form-control" name="username" id="register-username">
				<label class="for-control" for="register-username"><?php echo esc_html__('User Name','justhome'); ?></label>
			</div>
			<div class="form-group">
				<input type="text" class="form-control" name="email" id="register-email">
				<label class="for-control" for="register-email"><?php echo esc_html__('Email','justhome'); ?></label>
			</div>

			<?php if ( version_compare(WP_REALESTATE_PLUGIN_VERSION, '1.3.0', '>=') && wp_realestate_get_option('users_requires_approval') == 'phone_approve' ) { ?>
				<div class="form-group d-flex align-items-center">
					<?php
					
						$cc_list = include WP_REALESTATE_PLUGIN_DIR.'includes/sms/countries-phone.php';
						if ( wp_realestate_get_option('phone_approve_default_country_code') == 'geolocation' ) {
							$default_cc = WP_RealEstate_SMS_Geolocation::get_phone_code();
						} else {
							$default_cc = wp_realestate_get_option('phone_approve_default_country_code_custom');
						}
					?>
						<select class="form-control" name="phone-cc" id="register-phone-cc" required>
							<option disabled><?php esc_html_e( 'Select Country Code', 'justhome' ); ?></option>
							<?php foreach( $cc_list as $country_code => $country_phone_code ): ?>
								<option value="<?php echo esc_attr($country_phone_code); ?>" <?php selected($country_phone_code, $default_cc); ?>><?php echo esc_html($country_code.' '.$country_phone_code); ?></option>
							<?php endforeach; ?>
						</select>
						

					<input type="text" class="form-control" name="phone" id="register-phone" placeholder="<?php esc_attr_e('Phone','justhome'); ?>" required>

				</div>

				<input type="hidden" class="form-control" name="step" id="register-step" value="1">
				<input type="hidden" class="form-control" name="form-token" id="register-form-token" value="<?php echo mt_rand( 1000, 9999 ); ?>">
			<?php } ?>

			<div class="form-group">
				<input type="password" class="form-control" name="password" id="password">
				<label class="for-control" for="password"><?php echo esc_html__('Password','justhome'); ?></label>
			</div>

			<div class="form-group">
				<input type="password" class="form-control" name="confirmpassword" id="confirmpassword">
				<label class="for-control" for="confirmpassword"><?php echo esc_html__('Re-enter Password','justhome'); ?></label>
			</div>

			<div class="form-group">
				<select class="form-control" name="role">
					<option value=""><?php esc_html_e('Select Role', 'justhome'); ?></option>
					<option value="subscriber"><?php esc_html_e('User', 'justhome'); ?></option>

					<?php if ( justhome_get_config('register_form_enable_agent', true) ) { ?>
						<option value="wp_realestate_agent"><?php esc_html_e('Agent', 'justhome'); ?></option>
					<?php } ?>

					<?php if ( justhome_get_config('register_form_enable_agency', true) ) { ?>
						<option value="wp_realestate_agency"><?php esc_html_e('Agency', 'justhome'); ?></option>
					<?php } ?>
				</select>
			</div>

			<?php wp_nonce_field('ajax-register-nonce', 'security_register'); ?>

			<?php if ( WP_RealEstate_Recaptcha::is_recaptcha_enabled() ) { ?>
	            <div id="recaptcha-contact-form" class="ga-recaptcha" data-sitekey="<?php echo esc_attr(wp_realestate_get_option( 'recaptcha_site_key' )); ?>"></div>
	      	<?php } ?>

	      	<?php
	      		$page_id = wp_realestate_get_option('terms_conditions_page_id');
	      		if ( !empty($page_id) ) {
	      			$page_id = WP_RealEstate_Mixes::get_lang_post_id($page_id);
	      			$page_url = get_permalink($page_id);
	      			?>
		      	<div class="form-group">
					<label for="register-terms-and-conditions">
						<input type="checkbox" name="terms_and_conditions" value="on" id="register-terms-and-conditions" required>
						<?php
							echo sprintf(wp_kses(__('I have read and accept the <a href="%s">Terms and Privacy Policy</a>', 'justhome'), array('a' => array('href' => array())) ), esc_url($page_url));
						?>
					</label>
				</div>
			<?php } ?>

			<div class="form-group m-0">
				<button type="submit" class="btn btn-theme w-100" name="submitRegister">
					<?php echo esc_html__('REGISTER', 'justhome'); ?><svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg>
				</button>
			</div>
      	</form>

      	<?php if ( version_compare(WP_REALESTATE_PLUGIN_VERSION, '1.3.0', '>=') && wp_realestate_get_option('users_requires_approval') == 'phone_approve' ) { ?>
	  		<form name="registerFormOTP" method="post" class="register-form-otp form-login-register-inner form-theme">

				<div class="sent-txt">
					<span class="no-txt"></span>
					<span class="no-change"> <?php esc_html_e( 'Change', 'justhome' ); ?></span>
				</div>

				<div class="notice-cont">
					<div class="notice"></div>
				</div>

				<div class="form-group">
					<div class="otp-input-cont">
						<?php for ( $i= 0; $i < wp_realestate_get_option('phone_approve_otp_digits', 4); $i++ ): ?>
							<input type="text" maxlength="1" autocomplete="off" name="otp[]" class="otp-input">
						<?php endfor; ?>
					</div>
				</div>

				<button type="submit" class="btn btn-theme w-100"><?php esc_html_e( 'Verify', 'justhome' ); ?></button>

				<div class="resend">
					<a href="javascript:void(0);" class="resend-link"><?php esc_html_e( 'Not received your code? Resend code', 'justhome' ); ?></a>
					<span class="resend-timer"></span>
				</div>

			</form>
		<?php } ?>

		<?php do_action('register_form'); ?>

    </div>
</div>
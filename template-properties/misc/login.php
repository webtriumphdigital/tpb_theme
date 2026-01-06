<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
justhome_load_select2();
$rand = justhome_random_key();

$login_title = !empty($login_title) ? $login_title : '';
$reset_password_title = !empty($reset_password_title) ? $reset_password_title : '';
?>
<div class="login-form-wrapper">
	
	<div id="login-form-wrapper-<?php echo esc_attr($rand); ?>" class="form-container form-login-register-inner ">
		<?php if ( $login_title ) { ?>
			<h2 class="title-small"><?php echo trim($login_title); ?></h2>
		<?php } ?>
		<form class="login-form form-theme" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="post">
			<div class="form-group">
				<input autocomplete="off" type="text" name="username" class="form-control" id="username_or_email">
				<label for="username_or_email" class="for-control"><?php esc_html_e('Username Or Email', 'justhome'); ?></label>
			</div>
			<div class="form-group">
				<input name="password" type="password" class="password required form-control" id="login_password">
				<label for="login_password" class="for-control"><?php echo esc_html__('Password','justhome'); ?></label>
			</div>
			<div class="row form-group">
				<div class="col-6">
					<label for="user-remember-field">
						<input type="checkbox" name="remember" id="user-remember-field" value="true"> <?php echo esc_html__('Keep me signed in','justhome'); ?>
					</label>
				</div>
				<div class="col-6 text-end">
					<a href="#forgot-password-form-wrapper-<?php echo esc_attr($rand); ?>" class="back-link" title="<?php esc_attr_e('Forgot Password','justhome'); ?>"><?php echo esc_html__("Lost Your Password?",'justhome'); ?></a>
				</div>
			</div>
			<div class="form-group">
				<button class="btn btn-theme w-100" type="submit"><?php echo esc_html__('Sign In','justhome'); ?><svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg></button>
			</div>
			<?php do_action('login_form'); ?>
			<?php
				wp_nonce_field('ajax-login-nonce', 'security_login');
			?>
		</form>

		<?php if ( defined('JUSTHOME_DEMO_MODE') && JUSTHOME_DEMO_MODE ) { ?>
			<div class="sign-in-demo-notice">
				Username: <strong>agency</strong> or <strong>agent</strong><br>
				Password: <strong>demo</strong>
			</div>
		<?php } ?>

	</div>
	<!-- reset form -->
	<div id="forgot-password-form-wrapper-<?php echo esc_attr($rand); ?>" class="form-container form-login-register-inner form-forgot-password-inner">
		<?php if ( $reset_password_title ) { ?>
			<h2 class="title-small"><?php echo trim($reset_password_title); ?></h2>
		<?php } ?>
		<form name="forgotpasswordform" class="forgotpassword-form form-theme" action="<?php echo esc_url( site_url('wp-login.php?action=lostpassword', 'login_post') ); ?>" method="post">
			<div class="lostpassword-fields">
				<div class="form-group">
					<input type="text" name="user_login" class="user_login form-control" id="lostpassword_username">
					<label for="lostpassword_username" class="for-control"><?php echo esc_html__('Username or E-mail','justhome'); ?></label>
				</div>
				<?php
					do_action('lostpassword_form');
					wp_nonce_field('ajax-lostpassword-nonce', 'security_lostpassword');
				?>

				<?php if ( version_compare(WP_REALESTATE_PLUGIN_VERSION, '1.1.0', '>=') && WP_RealEstate_Recaptcha::is_recaptcha_enabled() ) { ?>
		            <div id="recaptcha-contact-form" class="ga-recaptcha" data-sitekey="<?php echo esc_attr(wp_realestate_get_option( 'recaptcha_site_key' )); ?>"></div>
		      	<?php } ?>

				<div class="form-group">
					<button class="btn btn-dark w-100" type="submit"><?php echo esc_html__('Get New Password', 'justhome'); ?>
						<svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg>
					</button>
					<input type="button" class="btn btn-danger w-100 btn-cancel mt-3" value="<?php esc_attr_e('Cancel', 'justhome'); ?>" tabindex="101" />
				</div>
			</div>
			<div class="lostpassword-link text-center"><a href="#login-form-wrapper-<?php echo esc_attr($rand); ?>" class="back-link"><?php echo esc_html__('Back To Login', 'justhome'); ?></a></div>
		</form>
	</div>
</div>
<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package WordPress
 * @subpackage Justhome
 * @since Justhome 1.0
 */
/*
*Template Name: 404 Page
*/
get_header();

$bg_url = justhome_get_config('404_bg_img');
if(!empty($bg_url)){
	$style = 'style="background-image: url('.$bg_url.')"';
} else {
	$style = 'style="background-image: url('.get_template_directory_uri().'/images/error.jpg'.')"';
}
?>
<section class="page-404 d-flex flex-column justify-content-center" <?php echo trim($style); ?>>
	<section class="not-found">
		<div class="container">
			<div class="content-inner text-center">
				<h3 class="slogan">
					<?php
					$slogan = justhome_get_config('404_slogan');
					if ( !empty($slogan) ) {
						echo esc_html($slogan);
					} else {
						esc_html_e('404', 'justhome');
					}
					?>
				</h3>
				<h4 class="title-big">
					<?php
					$title = justhome_get_config('404_title');
					if ( !empty($title) ) {
						echo esc_html($title);
					} else {
						esc_html_e('Oh! Page Not Found', 'justhome');
					}
					?>
				</h4>
				<div class="description">
					<?php
					$description = justhome_get_config('404_description');
					if ( !empty($description) ) {
						echo esc_html($description);
					} else {
						esc_html_e('The page you’re looking for isn’t available. Try to search again or use the go to.', 'justhome');
					}
					?>
				</div>
				<?php get_search_form(); ?>
			</div>
		</div>
	</section><!-- .error-404 -->
</section>
<?php get_footer(); ?>
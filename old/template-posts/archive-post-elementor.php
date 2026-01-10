<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $wp_query;


get_header();

?>
	<section id="main-container" class="inner ">
		<?php do_action('justhome_post_archive_content'); ?>
	</section>
<?php

get_footer();
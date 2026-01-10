<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( empty($agents) ) {
	return;
}
$pagination_type = !empty($settings['pagination_type']) ? $settings['pagination_type'] : 'default';
?>

<div class="agents-pagination-wrapper main-pagination-wrapper">
	<?php
		if ( $pagination_type == 'loadmore' || $pagination_type == 'infinite' ) {
			$next_link = get_next_posts_link( '&nbsp;', $agents->max_num_pages );
			if ( $next_link ) {
		?>
				<div class="ajax-pagination <?php echo trim($pagination_type == 'loadmore' ? 'loadmore-action' : 'infinite-action'); ?>">
					<div class="apus-pagination-next-link hidden"><?php echo trim($next_link); ?></div>
					<a href="#" class="apus-loadmore-btn"><?php esc_html_e( 'Load more', 'justhome' ); ?></a>
					<span class="apus-allproducts"><?php esc_html_e( 'All agents loaded.', 'justhome' ); ?></span>
				</div>
		<?php
			}
		} else {
			WP_RealEstate_Mixes::custom_pagination( array(
				'max_num_pages' => $agents->max_num_pages,
				'prev_text'     => '<i class="ti-angle-left"></i>',
				'next_text'     => '<i class="ti-angle-right"></i>',
				'wp_query' => $agents
			));
		}
	?>
</div>

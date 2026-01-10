<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$user_id = get_current_user_id();
$agency_id = WP_RealEstate_User::get_agency_by_user_id($user_id);

if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
    $paged = get_query_var( 'page' );
} else {
    $paged = 1;
}

$loop = WP_RealEstate_Query::get_agency_agents($agency_id, array(
    'post_per_page' => get_option('posts_per_page'),
    'paged' => $paged
));
wp_enqueue_script('jquery-ui-autocomplete');
?>
<h1 class="title-profile"><?php esc_html_e('Team Members', 'justhome'); ?></h1>
<div class="agency-agents-member">
	<div class="agency-agents-list">
		<div class="box-white-dashboard max-700">
			<h3 class="title"><?php esc_html_e( 'All Members', 'justhome' ) ; ?></h3>
			<?php if ( !empty($loop) && $loop->have_posts() ) { ?>
			    <div class="agency-agents-list-inner">
			        <?php
			            while ( $loop->have_posts() ) : $loop->the_post();
			                echo WP_RealEstate_Template_Loader::get_template_part( 'agents-styles/inner-list-team' );
			            endwhile;
			        ?>
			    </div>
			    
			    <?php
			    WP_RealEstate_Mixes::custom_pagination( array(
					'max_num_pages' => $loop->max_num_pages,
					'prev_text'     => esc_html__( 'Previous page', 'justhome' ),
					'next_text'     => esc_html__( 'Next page', 'justhome' ),
					'wp_query' 		=> $loop
				));

	            wp_reset_postdata();
	            ?>
			<?php } else { ?>
				<div class="not-found"><?php esc_html_e('No agents found.', 'justhome'); ?></div>
			<?php } ?>
		</div>
	</div>
	<!-- Form list -->
	<div class="agency-agents-form-wrapper box-white-dashboard max-700">
		<h3 class="title"><?php esc_html_e('Add Member', 'justhome'); ?></h3>
		<form action="" method="get" class="agency-add-agents-form">
			<div class="form-group team-agent-autocomplete-wrapper">
				<div class="team-agent-wrapper"></div>
				
				<input id="team-agent-autocomplete" type="text" name="agent_name" class="agent-autocomplete form-control" placeholder="<?php echo esc_html__( 'Search..', 'justhome' ); ?>">
			</div>
			<div class="clearfix mt-4">
				<button class="search-submit btn btn-theme" name="submit"><?php echo esc_html__( 'Add Agent', 'justhome' ); ?><svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none"><path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"></path></svg></button>
				<input type="hidden" name="nonce" value="<?php echo esc_attr(wp_create_nonce( 'wp-realestate-agency-add-agent-nonce' )); ?>">
			</div>
		</form>
	</div>
</div>
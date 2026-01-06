<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post;

?>

<?php do_action( 'wp_realestate_before_agent_content', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="member-grid member-item">
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="member-thumbnail-wrapper position-relative d-flex align-items-center justify-content-center flex-shrink-0">
                <?php justhome_agent_display_image( $post, 'justhome-agent-grid'); ?>
                <?php justhome_agent_display_socials($post); ?>
            </div>
        <?php } else { ?>
            <?php justhome_agent_display_socials($post); ?>
        <?php } ?>
        <div class="agent-information-bottom">
            <?php the_title( sprintf( '<h2 class="agent-title member-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            <?php justhome_agent_display_job( $post ); ?>
        </div>
    </div>
</article><!-- #post-## -->

<?php do_action( 'wp_realestate_after_agent_content', $post->ID ); ?>
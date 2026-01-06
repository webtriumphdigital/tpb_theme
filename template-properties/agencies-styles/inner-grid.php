<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post;
?>

<?php do_action( 'wp_realestate_before_agency_content', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="member-grid member-item">
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="member-thumbnail-wrapper img-agency position-relative d-flex align-items-center justify-content-center flex-shrink-0">
                <?php justhome_agency_display_image( $post, 'justhome-agent-grid'); ?>
                <?php justhome_agency_display_socials($post); ?>
            </div>
        <?php } else { ?>
            <?php justhome_agency_display_socials($post); ?>
        <?php } ?>

        <div class="agency-information-bottom">
            <?php the_title( sprintf( '<h2 class="agency-title member-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
            <?php justhome_agency_display_full_location( $post ); ?>
        </div>  
    </div>
</article><!-- #post-## -->

<?php do_action( 'wp_realestate_after_agency_content', $post->ID ); ?>
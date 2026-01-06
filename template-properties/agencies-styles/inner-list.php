<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $post;

?>

<?php do_action( 'wp_realestate_before_agency_content', $post->ID ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="member-list agency-item member-item">
        <div class="d-flex d-md-none align-items-center">
            <?php if ( has_post_thumbnail() ) { ?>
                <div class="member-thumbnail-wrapper img-agency d-flex align-items-center justify-content-center flex-shrink-0">
                    <?php justhome_agency_display_image( $post, 'thumbnail'); ?>
                </div>
            <?php } ?>
            <div class="inner-mobile flex-grow-1">
                <?php the_title( sprintf( '<h2 class="agency-title member-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                <?php justhome_agency_display_full_location( $post,'icon' ); ?>
            </div>
        </div>
        <div class="d-md-flex align-items-center">
            <?php if ( has_post_thumbnail() ) { ?>
                <div class="member-thumbnail-wrapper img-agency d-none d-md-flex align-items-center justify-content-center flex-shrink-0">
                    <?php justhome_agency_display_image( $post, 'thumbnail'); ?>
                </div>
            <?php } ?>
            
            <div class="member-information agency-information flex-grow-1">
                <div class="d-none d-md-block">
                    <?php the_title( sprintf( '<h2 class="agency-title member-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                    <?php justhome_agency_display_full_location( $post,'icon' ); ?>
                </div>
                <div class="metas d-md-flex align-items-center flex-wrap">
                    <?php justhome_agency_display_phone($post, 'all',true,true); ?>
                    <?php justhome_agency_display_fax($post, 'all'); ?>
                    <?php justhome_agency_display_email($post, 'all'); ?>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center info-bottom">
            <?php justhome_agency_display_socials($post); ?>
            <div class="ms-auto"><?php justhome_agency_display_nb_properties( $post ); ?></div>
        </div>
    </div>
</article><!-- #post-## -->

<?php do_action( 'wp_realestate_after_agency_content', $post->ID ); ?>
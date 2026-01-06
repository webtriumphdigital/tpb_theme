<?php 
global $post;
$thumbsize = !isset($args['thumbsize']) ? justhome_get_config( 'blog_item_thumbsize', '330x220' ) : $args['thumbsize'];
$thumb = justhome_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-layout post-grid-v2'); ?>>
        <?php
            if ( !empty($thumb) ) {
                ?>
                <div class="top-image">
                    <?php
                        echo trim($thumb);
                    ?>
                 </div>
                <?php
            }
        ?>
        <div class="col-content text-center">
            <div class="top-detail-info d-flex flex-wrap align-items-center justify-content-center">
                <?php justhome_post_categories_first($post); ?>
                <div class="date">
                    <?php the_time( get_option('date_format', 'd M, Y') ); ?>
                </div>
            </div>
            <?php if (get_the_title()) { ?>
                <h4 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            <?php } ?>
            <div class="readmore">
            <a href="<?php the_permalink(); ?>" class="btn-readmore"><?php echo esc_html__('Read More','justhome') ?><svg class="next" xmlns="http://www.w3.org/2000/svg" width="14" height="12" viewBox="0 0 14 12" fill="none">
<path d="M0.8125 5.43752H12.0341L7.73716 1.34477C7.51216 1.13045 7.50344 0.77439 7.71775 0.54939C7.93178 0.324671 8.28784 0.315671 8.51312 0.529984L13.4204 5.20436C13.6327 5.41698 13.75 5.69936 13.75 6.00002C13.75 6.30039 13.6327 6.58305 13.4105 6.80495L8.51284 11.4698C8.404 11.5735 8.2645 11.625 8.125 11.625C7.9765 11.625 7.828 11.5665 7.71747 11.4504C7.50316 11.2254 7.51188 10.8696 7.73688 10.6553L12.0518 6.56252H0.8125C0.502 6.56252 0.25 6.31052 0.25 6.00002C0.25 5.68952 0.502 5.43752 0.8125 5.43752Z" fill="currentColor"/>
</svg>
</a></div>
        </div>
</article>
<?php
$post_format = get_post_format();
global $post;
?>
<div class="entry-content-detail header-info-blog">
    <?php if(has_post_thumbnail()) { ?>
        <div class="entry-thumb-header text-center">
            <?php
                $thumb = justhome_post_thumbnail();
                echo trim($thumb);
            ?>
        </div>
    <?php } ?>
    <div class="clearfix">
        <?php if (get_the_title()) { ?>
            <h1 class="entry-title">
                <?php the_title(); ?>
            </h1>
        <?php } ?>
        
        <div class="top-detail-info d-flex flex-wrap align-items-center">
            <?php justhome_post_categories($post); ?>
            <div class="date">
                <?php the_time( get_option('date_format', 'd M, Y') ); ?>
            </div>
        </div>
    </div>
</div>
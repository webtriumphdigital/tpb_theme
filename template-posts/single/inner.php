<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('m-0 main-detail-post'); ?>>
    <div class="inner">
    	<div class="entry-content-detail <?php echo esc_attr((!has_post_thumbnail())?'not-img-featured':'' ); ?>">

        	<div class="single-info info-bottom">
                <div class="entry-description clearfix">
                    <?php
                        the_content();
                    ?>
                </div><!-- /entry-content -->
        		<?php
        		wp_link_pages( array(
        			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'justhome' ) . '</span>',
        			'after'       => '</div>',
        			'link_before' => '<span>',
        			'link_after'  => '</span>',
        			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'justhome' ) . ' </span>%',
        			'separator'   => '',
        		) );
        		?>
                <?php  
                    $posttags = get_the_tags();
                ?>
                <?php if( !empty($posttags) || justhome_get_config('show_blog_social_share', true) ){ ?>
            		<div class="tag-social d-md-flex align-items-center">
                        <?php if( justhome_get_config('show_blog_social_share', true) ) { ?>
                            <?php get_template_part( 'template-parts/sharebox' ); ?>
                        <?php } ?>
                        <?php if(!empty($posttags)){ ?>
                            <div class="ms-auto">
                                <?php justhome_post_tags(); ?>
                            </div>
                        <?php } ?>
            		</div>
                <?php } ?>
        	</div>

        </div>
    </div>
    <?php get_template_part( 'template-posts/single/author-bio' ); ?>
    <?php
        //Previous/next post navigation.
        the_post_navigation( array(
            'next_text' => 
                '<div class="inner d-flex justify-content-end"><div class="link_info clearfix flex-grow-1">'.
                '<div class="navi">' . esc_html__( 'Next Post', 'justhome' ) . '</div>'.
                '<span class="title-direct">%title</span></div><i class="ti-angle-right"></i></div>',
            'prev_text' => 
                '<div class="inner d-flex"><i class="ti-angle-left"></i>'.
                '<div class="link_info clearfix flex-grow-1"><div class="navi">' . esc_html__( 'Prev Post', 'justhome' ) . '</div>'.
                '<span class="title-direct">%title</span></div></div>',
        ) );
    ?>
</article>
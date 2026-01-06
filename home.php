<?php
get_header();
$sidebar_configs = justhome_get_blog_layout_configs();
$columns = justhome_get_config('blog_columns', 1);
$layout = justhome_get_config( 'blog_display_mode', 'grid' );
justhome_render_breadcrumbs();
$thumbsize = !isset($thumbsize) ? justhome_get_config( 'blog_item_thumbsize', '930x500' ) : $thumbsize;

?>
<section id="main-container" class="home-page-default <?php echo apply_filters('justhome_blog_content_class', 'container');?> inner">
	<?php justhome_before_content( $sidebar_configs ); ?>
	<div class="row responsive-medium">
		<?php justhome_display_sidebar_left( $sidebar_configs ); ?>

		<div id="main-content" class="col-12 <?php echo esc_attr($sidebar_configs['main']['class']); ?>">
			<div id="main" class="site-main layout-blog" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header d-none">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				<?php
				get_template_part( 'template-posts/layouts/'.$layout, null, array('columns' => $columns, 'thumbsize' => $thumbsize) );

				// Previous/next page navigation.
				justhome_paging_nav();

			// If no content, include the "No posts found" template.
			else :
				get_template_part( 'template-posts/content', 'none' );

			endif;
			?>

			</div><!-- .site-main -->
		</div><!-- .content-area -->
		
		<?php justhome_display_sidebar_right( $sidebar_configs ); ?>
		
	</div>
</section>
<?php get_footer(); ?>
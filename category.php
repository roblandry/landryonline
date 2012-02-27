<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<!--category.php-->
		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php
						printf( __( 'Category Archives: %s', 'twentyeleven' ), '<span>' . single_cat_title( '', false ) . '</span>' );
					?></h1>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</header>

<?php /* Start wp-pagenavi support */ ?>
<?php if(function_exists('wp_pagenavi') ) : ?>
  <?php wp_pagenavi(); ?>
<?php else: ?>
  <?php twentyeleven_content_nav( 'nav-above' ); ?>
<?php endif; ?>
<?php /* End wp-pagenavi support */ ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

<?php /* Start wp-pagenavi support */ ?>
<?php if(function_exists('wp_pagenavi') ) : ?>
  <?php wp_pagenavi(); ?>
<?php else: ?>
  <?php twentyeleven_content_nav( 'nav-below' ); ?>
<?php endif; ?>
<?php /* End wp-pagenavi support */ ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header>

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div>
				</article>

			<?php endif; ?>

			</div>
		</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<!--search.php-->
		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>
				<div class="imageborder">
				<div class="header_01"><?php printf( __( 'Search Results for: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></div></div>

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
<div class="imageborder">
				<article id="post-0" class="post no-results not-found">
					<div class="header_01"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></div>

					<div class="entry-content">
						<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div>
				</article>
</div>
			<?php endif; ?>

			</div>
		</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

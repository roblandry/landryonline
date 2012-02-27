<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>
<!--index.php-->

		<div id="primary" width="100%">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

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

				<article id="post-0" class="imageborder post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header>

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><
				</article>

			<?php endif; ?>

			</div>
		</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

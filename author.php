<?php
/**
 * The template for displaying Author Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<!--author.php-->
		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php the_post(); ?>
<div class="imageborder">
				<header class="page-header">
					<div class="header_01"><?php printf( __( 'Author Archives: %s', 'twentyeleven' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="author">' . get_the_author() . '</a></span>' ); ?></div>
				</header>

				<?php rewind_posts(); ?>

				<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<div id="author-info">
					<div id="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'id' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 68 ) ); ?>
					</div>
					<div id="author-description">
						<h2><?php printf( __( 'About %s', 'twentyeleven' ), get_the_author() ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
					</div>

<?php echo do_shortcode("[author_follow_me]"); ?>
				</div>
				<?php endif; ?>
</div>
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

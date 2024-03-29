<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<!--content-single.php-->
	<?php

	if ( get_the_author_meta( 'description' ) && ( ! function_exists( 'is_multi_author' ) || is_multi_author() ) ) : ?>
	<div class="imageborder">
	<div class="header_01">The Author</div>	
	<div id="author-info">
		<div id="author-avatar">
		  <?php echo get_avatar( get_the_author_meta( 'id' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 68 ) ); ?>
		</div>
	<div id="author-description">
	  <h2><?php printf( __( 'About %s', 'twentyeleven' ), get_the_author() ); ?></h2>
	  <?php the_author_meta( 'description' ); ?>
	  <div id="author-link">
	    <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
		<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentyeleven' ), get_the_author() ); ?>
	    </a>
	  </div>
	</div>

<?php echo do_shortcode("[author_follow_me]"); ?>
	</div>
	</div>
	<?php endif; ?>

	<nav id="nav-single">
		<h3 class="assistive-text"><?php _e( 'Post navigation', 'twentyeleven' ); ?></h3>
		<span class="nav-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'twentyeleven' ) ); ?></span>
		<span class="nav-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?></span>
	</nav>

<article id="post-<?php the_ID(); ?>" <?php post_class('imageborder'); ?>>
	  <header class="entry-header">
	    <div class="header_01"><?php the_title(); ?></div>
	    <?php if ( 'post' == get_post_type() ) : ?>
	      <div class="entry-meta">
		<?php twentyeleven_posted_on(); ?>
	      </div>
	    <?php endif; ?>
	  </header>

	  <div class="entry-content">
	    <?php the_content(); ?>
	    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	  </div>

	  <footer class="entry-meta">
	  	<?php
		$categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );

		$tag_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
		if ( '' != $tag_list ) {
			$utility_text = __( 'This entry was posted in %1$s and tagged %2$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
		} elseif ( '' != $categories_list ) {
			$utility_text = __( 'This entry was posted in %1$s by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
		} else {
			$utility_text = __( 'This entry was posted by <a href="%6$s">%5$s</a>. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'twentyeleven' );
		}

		printf(
			$utility_text,
			$categories_list,
			$tag_list,
			esc_url( get_permalink() ),
			the_title_attribute( 'echo=0' ),
			get_the_author(),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
			);
		?>
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	  </footer>
</article>

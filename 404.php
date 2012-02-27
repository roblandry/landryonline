<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<!--404.php-->
	<div id="primary">
		<div id="content" role="main">
			<article id="post-0" class="post error404 not-found">
				<div class="imageborder">
				<header class="entry-header">
					<div class="header_01"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentyeleven' ); ?></div>
				</header>
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'twentyeleven' ); ?></p>

					<?php get_search_form(); ?>
				</div><!-- .top -->
			</article><!-- #post-0 -->


	<div id="supplementary" class="three">
		<div id="first" class="widget-area imageborder" role="complementary">
			<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'before_title' => '<div class="header_01">' , 'after_title' => '</div>' , 'widget_id' => '404' ) ); ?>
		</div><!-- recent.posts -->

		<div id="second" class="widget-area imageborder" role="complementary">
			<div class="header_01"><?php _e( 'Most Used', 'twentyeleven' ); ?></div>
				<ul>
				<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
				</ul>
		</div><!-- most.used -->

		<div id="third" class="widget-area imageborder" role="complementary">
			<?php
			/* translators: %1$s: smilie */
			$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'twentyeleven' ), convert_smilies( ':)' ) ) . '</p>';
			the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 1 ), array( 'before_title' => '<div class="header_01">' , 'after_title' => '</div>'.$archive_content ) );
			?>
		</div><!-- archives -->
	</div><!-- supplementary -->
<!--?php #the_widget( 'WP_Widget_Tag_Cloud' ); ?-->
		</div><!-- .entry-content -->
	</div><!-- #primary -->





<?php get_sidebar(); ?>
<?php get_footer(); ?>

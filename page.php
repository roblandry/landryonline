<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>
<!--page.php-->
		<div id="primary">
			<div id="content" role="main">
<div class="imageborder">
				<?php the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>
</div>
				<?php comments_template( '', true ); ?>

			</div>
		</div>
<?php get_footer(); ?>

<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<!--footer.php-->
	</div>

	<footer id="colophon" role="contentinfo">
		<?php get_sidebar( 'footer' ); ?>
		<div id="site-generator" class="imageborder">
		<?php
		$year = date("Y");
		$previousyear = $year -1;
		?>
			Copyright &copy; <a href="<?php echo site_url(); ?>"><?php bloginfo('name'); ?></a> <?php echo $previousyear . '-' . $year; ?>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>

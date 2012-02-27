<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<!--sidebar-footer.php-->
<?php
	if (   ! is_active_sidebar( 'sidebar-3'  )
		&& ! is_active_sidebar( 'sidebar-4' )
		&& ! is_active_sidebar( 'sidebar-5'  )
	)
		return;
?>
<div id="supplementary" <?php twentyeleven_footer_sidebar_class(); ?>>
	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
	<div id="first" class="widget-area imageborder"role="complementary">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
	<div id="second" class="widget-area imageborder" role="complementary">
		<?php dynamic_sidebar( 'sidebar-4' ); ?>
	</div>
	<?php endif; ?>

	<?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
	<div id="third" class="widget-area imageborder" role="complementary">
		<?php dynamic_sidebar( 'sidebar-5' ); ?>
	</div>
	<?php endif; ?>
</div>

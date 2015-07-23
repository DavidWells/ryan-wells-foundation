<?php
/**
 * The Sidebar for the blog pages.
 */
?>

	<div id="sidebar" class="one-third column last">

		<div id="sidebar-inner">
			<?php  $id = get_the_ID();
				   $custom_sidebar = get_field('custom_sidebar_top', $id);
				   $custom_sidebar_bottom = get_field('custom_sidebar_bottom', $id); ?>
			<div id="sidebar-top">
			<?php echo $custom_sidebar; ?>
			</div>
			<?php if ( ! dynamic_sidebar( 'sidebar-blog' ) ) : ?>

				<!-- No widgets -->

			<?php endif; ?>
			<div id="sidebar-bottom">
				<?php echo $custom_sidebar_bottom; ?>
			</div>

		</div><!-- #sidebar-inner -->

	</div><!-- #sidebar -->
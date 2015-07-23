<?php
/**
 * The Sidebar for the pages.
 */

$sidebar_name = 'sidebar-page';

if ( function_exists( 'bp_is_blog_page' ) && ! bp_is_blog_page() ) { $sidebar_name = 'sidebar-buddypress'; }
if ( function_exists( 'is_bbpress' ) && is_bbpress() ) { $sidebar_name = 'sidebar-buddypress'; }
if ( function_exists( 'is_woocommerce' ) && ( is_cart() || is_checkout() ) ) { $sidebar_name = 'sidebar-woocommerce'; }

?>

	<div id="sidebar" class="one-third column last">

		<div id="sidebar-inner">

			<?php  $id = get_the_ID();
				   $custom_sidebar = get_field('custom_sidebar_top', $id);
				   $custom_sidebar_bottom = get_field('custom_sidebar_bottom', $id); ?>
			<div id="sidebar-top">
			<?php echo $custom_sidebar; ?>
			</div>
			<?php if ( ! dynamic_sidebar( $sidebar_name ) ) : ?>

				<!-- No widgets -->

			<?php endif; ?>
			<div id="sidebar-bottom">
				<?php echo $custom_sidebar_bottom; ?>
			</div>
		</div><!-- #sidebar-inner -->

	</div><!-- #sidebar -->
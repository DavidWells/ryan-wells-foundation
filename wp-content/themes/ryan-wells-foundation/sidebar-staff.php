<?php
/**
 * The Sidebar for the staff pages.
 */
?>

	<div id="sidebar" class="one-third column last">

		<div id="sidebar-inner">
			<?php
			$id = get_the_ID();

            if ( has_post_thumbnail() ) {
                    $imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), 'member');
                    $thumb = $imgsrc[0];
                    $img = '<img src="'.$thumb.'">';
            } else {
                 	$img = '';
            }


            ?>
            <div id="staff-photo">
				<?php echo $img;?>
            </div>
			<?php if ( ! dynamic_sidebar( 'sidebar-staff' ) ) : ?>

				<!-- No widgets -->

			<?php endif; ?>

		</div><!-- #sidebar-inner -->

	</div><!-- #sidebar -->
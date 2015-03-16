<?php
/**
 * The Sidebar for the events.
 */

	global $dd_sn;
	$event_info = get_post_meta( get_the_ID(), $dd_sn . 'event_info', true );
	$event_fb = get_post_meta( get_the_ID(), $dd_sn . 'event_facebook_link', true );

?>

	<div id="sidebar" class="one-third column last">

		<div id="sidebar-inner">

			<?php if ( is_single() ) : ?>
			<?php 	$id = get_the_ID();
					$custom_sidebar = get_field('custom_sidebar_top', $id); ?>

				<div class="widget">

					<div class="widget-wrap">

						<div class="event-info-widget">

							<?php dd_multicol_colors(); ?>

							<div class="event-info-widget-when">
								<?php $date = new DateTime(get_the_time());
									$now = new DateTime();

									if($date < $now) {
									    echo 'date is in the past';
									}
									?>
								<em><?php _e( 'When is it?', 'dd_string' ); ?></em>
								<span><?php the_time('F jS, Y'); ?></span>
								<?php echo $custom_sidebar; ?>
							</div>

							<?php $parity = 'odd'; ?>

							<?php if ( ! empty ( $event_info ) ) : ?>
								<?php foreach ( $event_info as $e_info ) : ?>
									<div class="event-info-widget-info <?php echo $parity; ?>">
										<em><?php echo $e_info['title']; ?></em>
										<span><?php echo $e_info['value']; ?></span>
									</div>
									<?php if ( $parity == 'odd' ) { $parity = 'even'; } else { $parity = 'odd'; }  ?>
								<?php endforeach; ?>
							<?php endif; ?>

							<?php if ( $event_fb != '' ) : ?>
								<div class="event-info-widget-view-fb <?php echo $parity; ?>">
									<a href="<?php echo $event_fb; ?>" class="dd-button big dd-button-fb has-icon"><?php _e( 'VIEW FACEBOOK PAGE', 'dd_string' ); ?><span class="dd-button-icon"><span class="icon-social-facebook"></span></span></a>
								</div>
							<?php endif; ?>

						</div><!-- .event-info-widget -->

					</div><!-- .widget-wrap -->

				</div><!-- .widget -->
				<?php $custom_sidebar_bottom = get_field('custom_sidebar_bottom', $id); ?>
				<div id="sidebar-bottom">
					<?php echo $custom_sidebar_bottom; ?>
				</div>
			<?php endif; ?>

			<?php if ( ! dynamic_sidebar( 'sidebar-events' ) ) : ?>

				<!-- No widgets -->

			<?php endif; ?>

		</div><!-- #sidebar-inner -->

	</div><!-- #sidebar -->
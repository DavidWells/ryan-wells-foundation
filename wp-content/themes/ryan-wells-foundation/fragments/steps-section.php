<?php 

	$steps = get_field( 'steps' );

	if ( empty($steps) )
		return;

?>

<?php foreach ($steps as $step): 

	$items = $step['step_items'];
	$count = count($items);

	if ( empty($items) )
		continue;

?>

	<section class="section steps-section">
		<div class="shell">
			<?php if ( $title = $step['step_section_title'] ) : ?>
				<h2><?php echo apply_filters('the_title', $title); ?></h2>
			<?php endif; ?>

			<div class="cols cols-<?php echo ( $count > 1 ? $count : 2 ); ?> ">
				<div class="row clearfix">

					<?php foreach ($items as $i => $item): 

						$item_title 	= $item['step_title'];
						$description 	= $item['step_description'];

						// Button
						$button_text = $item['step_button_text'];
						$button_link = $item['step_button_link'];

						$image_url = '';

						if ( $item['step_image'] )
							$image_url = $item['step_image']['url'];

					?>
						
						<div class="col">
							<span class="number"><?php echo $i+1 ?></span>
							
							<?php if ( $image_url ) : ?>

								<?php if ( $count != 3 ) : ?>
									<div class="img-holder frame">
								<?php endif; ?>

									<img src="<?php echo $image_url; ?>" alt="" />

								<?php if ( $count != 3 ) : ?>
									</div>
								<?php endif; ?>

							<?php endif; ?>

							<?php if ( $item_title ) : ?>
								<h4><?php echo apply_filters('the_title', $item_title); ?></h4>
							<?php endif; ?>

							<?php echo apply_filters('the_content', $description); ?>

							<?php if ( $button_text && $button_link ) : ?>
								<a target="_blank" href="<?php echo esc_url( $button_link ); ?>" class="button"><?php echo $button_text; ?></a>
							<?php endif; ?>
						</div>
						
					<?php endforeach ?>

				</div>
			</div>
		</div>
	</section>
	<!-- end of steps-section -->
	
<?php endforeach ?>
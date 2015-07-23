<?php

	$steps = $layout['steps'];

	if ( empty($steps) )
		return;

?>

<?php foreach ($steps as $step):

	$items = $step['step_items'];
	$section_id = (isset($step['section_id'])) ? $step['section_id'] : '';
	$section_id = str_replace("#", "", $section_id);
	$count = count($items);

	if ( empty($items) )
		continue;

	$boxed = $step['step_boxed'];

?>

	<section id="<?php echo $section_id; ?>" class="section steps-section <?php echo $boxed ?"boxed-steps" :""; ?>">
		<div class="shell">
			<?php if ( $title = $step['step_section_title'] ) : ?>
				<h2><?php echo apply_filters('the_title', $title); ?></h2>
			<?php endif; ?>

			<div class="cols cols-<?php echo ( $count > 1 ? $count : 2 ); ?> ">
				<div class="row clearfix">

					<?php foreach ($items as $i => $item):

						$item_box_title = $item['step_box_title'];
						$item_title 	= $item['step_title'];
						$description 	= $item['step_description'];

						// Button
						$button_text = $item['step_button_text'];
						$button_link = $item['step_button_link'];
						$button_font_size = $item['step_button_font_size'];

						$image_url = '';

						if ( $item['step_image'] )
							$image_url = $item['step_image']['url'];

					?>

						<div class="col col-<?php echo $i; ?>">

								<?php if ($item_box_title): ?>
									<span class="box-title"><?php echo apply_filters('the_title', $item_box_title); ?></span>
								<?php endif ?>



							<?php if ( $image_url ) : ?>


									<div class="img-holder frame">


									<img src="<?php echo $image_url; ?>" alt="" />


									</div>


							<?php endif; ?>

							<div class="box-content">
								<?php if ( $item_title ) : ?>
									<h4><?php echo apply_filters('the_title', $item_title); ?></h4>
								<?php endif; ?>

								<?php echo apply_filters('the_content', $description); ?>
							</div>

							<?php if ( $button_text && $button_link ) : ?>
								<a target="_blank" href="<?php echo esc_url( $button_link ); ?>" style="<?php echo $button_font_size ?"font-size:{$button_font_size}px;" :"" ?>" class="button"><?php echo $button_text; ?></a>
							<?php endif; ?>
						</div>

					<?php endforeach ?>

				</div>
			</div>
		</div>
	</section>
	<!-- end of steps-section -->

<?php endforeach ?>
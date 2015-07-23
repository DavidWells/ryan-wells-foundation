<?php

	$section_title 	= $layout['content_section_title'];
	$boxes 			= $layout['grid_items'];
	$section_id 	= (isset($layout['section_id'])) ? $layout['section_id'] : '';
	$section_id 	= str_replace("#", "", $section_id);

	if ( empty($boxes) )
		return;

?>

<section id="<?php echo $section_id; ?>" class="section double-column-grid-content">
	<div class="shell">

		<?php if ( $section_title ) : ?>
			<h2><?php echo apply_filters('the_title', $section_title); ?></h2>
		<?php endif; ?>
		<?php $count = count($boxes);
				if($count >= 3) {
					$class = " cols-3";
				} else {
					$class = " cols-2";
				}
				?>
		<div class="grid-items <?php echo $class;?>">
			<?php foreach ($boxes as $i => $box): extract($box); ?>

				<div class="col">

					<?php if ( $image ) : ?>
						<img src="<?php echo wpthumb( $image['url'], array( 'width' => 460 ) ); ?>" alt="" />
					<?php endif; ?>

					<div class="cnt">
						<h3><?php echo apply_filters('the_title', $title); ?></h3>


						<?php echo apply_filters('the_content', $content); ?>

						<?php if ( $button_text && $button_link ) : ?>
							<a target="_blank" href="<?php echo esc_url( $button_link ); ?>" style="<?php echo $button_font_size ?"font-size:{$button_font_size}px;" :"" ?>" class="button"><?php echo $button_text; ?></a>
						<?php endif; ?>
					</div>
				</div>

			<?php endforeach ?>
			<div class="cl"></div>
		</div>

	</div>
</section>
<!-- end of double-column-content -->
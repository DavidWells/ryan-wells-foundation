<?php

	$section_title 	= $layout['content_section_title'];
	$boxes 			= $layout['content_areas'];
	$section_id 	= (isset($layout['section_id'])) ? $layout['section_id'] : '';
	$section_id 	= str_replace("#", "", $section_id);
	if ( empty($boxes) )
		return;

?>

<section id="<?php echo $section_id; ?>" class="section double-column-content">
	<div class="shell">

		<?php if ( $section_title ) : ?>
			<h2><?php echo apply_filters('the_title', $section_title); ?></h2>
		<?php endif; ?>

		<?php foreach ($boxes as $i => $box): extract($box); ?>

			<div class="row row-image-<?php echo ( ($i+1) % 2 == 0 ? 'right' : 'left' ) ?> clearfix">

				<?php if ( $content_image ) : ?>
					<img src="<?php echo wpthumb( $content_image['url'], array( 'width' => 460 ) ); ?>" alt="" />
				<?php endif; ?>

				<div class="cnt">
					<h3><?php echo apply_filters('the_title', $content_area_title); ?></h3>

					<?php if ( $content_area_sub_title ) : ?>
						<h5><?php echo $content_area_sub_title; ?></h5>
					<?php endif; ?>

					<?php echo apply_filters('the_content', $content_wysiwyg); ?>

					<?php if ( $content_button_text && $content_button_link ) : ?>
						<a target="_blank" href="<?php echo esc_url( $content_button_link ); ?>" style="<?php echo $content_button_font_size ?"font-size:{$content_button_font_size}px;" :"" ?>" class="button"><?php echo $content_button_text; ?></a>
					<?php endif; ?>
				</div>
			</div>

		<?php endforeach ?>

	</div>
</section>
<!-- end of double-column-content -->
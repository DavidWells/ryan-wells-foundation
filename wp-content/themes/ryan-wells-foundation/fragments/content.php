<?php

	$section_title 	= $layout['content_section_title'];
	$section_text 	= $layout['content_text'];
	$section_id 	= (isset($layout['section_id'])) ? $layout['section_id'] : '';
	$section_id 	= str_replace("#", "", $section_id);
?>


<section id="<?php echo $section_id; ?>" class="section content-section">
	<div class="shell">

		<?php if ( $section_title ) : ?>
			<h2><?php echo apply_filters('the_title', $section_title); ?></h2>
		<?php endif; ?>

		<?php if ( $section_text ) : ?>
			<div class="content-text"><?php echo $section_text; ?></div>
		<?php endif; ?>
	</div>
</section>
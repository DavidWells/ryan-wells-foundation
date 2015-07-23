<?php

	$section_title 	= $layout['content_section_title'];
	$section_id 	= (isset($layout['section_id'])) ? $layout['section_id'] : '';
	$section_id 	= str_replace("#", "", $section_id);
?>


<section id="<?php echo $section_id; ?>" class="section content-table">
	<div class="shell">

		<?php if ( $section_title ) : ?>
			<h2><?php echo apply_filters('the_title', $section_title); ?></h2>
		<?php endif; ?>

		<?php
		if(isset($layout["rows"])):
			echo "<table cellpadding='0' cellspacing='0'>";
			foreach($layout["rows"] as $key=>$row):
				echo "<tr>";
				foreach($row as $col_key=>$col):
					echo ($key==0 ?"<th" :"<td") . " class='{$col_key}'>";
					echo $col;
					echo $key==0 ?"</th>" :"</td>";
				endforeach;
				echo "</tr>";
			endforeach;
			echo "</table>";
		endif;
		?>
	</div>
</section>
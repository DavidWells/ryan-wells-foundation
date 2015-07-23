<?php

	$section_title 	= $layout['content_section_title'];
	$posts 			= $layout['grid_items'];
	$section_id 	= (isset($layout['section_id'])) ? $layout['section_id'] : '';
	$section_id 	= str_replace("#", "", $section_id);

	if ( empty($posts) )
		return;

?>

<section id="<?php echo $section_id; ?>" class="section post-grid-layout">
	<div class="shell">

		<?php if ( $section_title ) : ?>
			<h2><?php echo apply_filters('the_title', $section_title); ?></h2>
		<?php endif; ?>

		<div class="boxes">

			<?php foreach ($posts as $p):
				$url = $p["link"];
				if(is_array($p) && isset($p["image"]["sizes"]) && isset($p["image"]["sizes"]["venue-thumb"])) {
					$image_src = $p["image"]["sizes"]["venue-thumb"];
				} else {
					$image_src = "";
				}

			?>

				<div class="box">
					<?php if ( $url === "" || $url == false ) {
						$no_opacity = "no-link-here";
					} else {
						$no_opacity = "";
					} ?>

					<a href="<?php echo $url; ?>" class="box-img frame <?php echo $no_opacity;?>">

						<?php if ( $image_src ) : ?>
							<img src="<?php echo $image_src; ?>" alt="" />
						<?php endif; ?>
						<?php if ( $url != "" || $url != false ) : ?>
						<span class="overlay">
							<span class="overlay-t">
								<span class="overlay-v"><?php _e( 'Learn more' ); ?></span>
							</span>
						</span>
						<?php endif; ?>
					</a>

					<?php if ($p["title"]): ?>
						<h4><a href="<?php echo $url; ?>"><?php echo apply_filters('the_title', $p["title"]); ?></a></h4>
					<?php endif ?>

					<?php if ($p["text"]): ?>
						<p><?php echo $p["text"]; ?></p>
					<?php endif ?>
				</div>

			<?php endforeach ?>

		</div>
		<!-- end of boxes -->
	</div>
</section>
<!-- end of post-grid-layout -->
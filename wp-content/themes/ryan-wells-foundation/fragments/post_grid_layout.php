<?php

	$section_title 	= $layout['section_title'];
	$posts 			= $layout['music_venues_posts'];
	$section_id 		= (isset($layout['section_id'])) ? $layout['section_id'] : '';
	$section_id 		= str_replace("#", "", $section_id);

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
				$url = get_permalink( $p->ID );

				$thumb_id 	= crb_get_meta( '_thumbnail_id', $p->ID );
				$thumb 		= wp_get_attachment_image_src( $thumb_id, 'venue-thumb', false );
				$image_src 	= $thumb[0];

			?>

				<div class="box">
					<a href="<?php echo $url; ?>" class="box-img frame">

						<?php if ( $image_src ) : ?>
							<img src="<?php echo $image_src; ?>" alt="" />
						<?php endif; ?>

						<span class="overlay">
							<span class="overlay-t">
								<span class="overlay-v"><?php _e( 'Learn more' ); ?></span>
							</span>
						</span>
					</a>
					<h4><a href="<?php echo $url; ?>"><?php echo apply_filters('the_title', $p->post_title); ?></a></h4>
					<p><?php echo wp_trim_words( $p->post_content, 33 ); ?></p>
				</div>

			<?php endforeach ?>

		</div>
		<!-- end of boxes -->
	</div>
</section>
<!-- end of post-grid-layout -->
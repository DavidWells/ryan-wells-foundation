<?php 
	
	$section_title 	= get_field( 'post_section_title' );
	$posts 			= get_field( 'music_venues_posts' );

	if ( empty($posts) )
		return;

?>

<section class="section post-grid-layout">
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
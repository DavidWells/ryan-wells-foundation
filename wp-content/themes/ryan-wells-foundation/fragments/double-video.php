<?php 
	
	// Metas
	$section_title 	= get_field( 'double_video_section_title' );
	$video_title 	= get_field( 'double_video_title' );
	$description 	= get_field( 'double_video_description' );

	$image 			= get_field( 'video_thumbnail_image_1' );
	$link 			= get_field( 'video_link_1' );

	$image_2 		= get_field( 'video_thumbnail_image_2' );
	$link_2 		= get_field( 'video_link_2' );

	if ( empty($image) || empty($link) )
		return;
?>


<section class="section double-video">
	<div class="shell">
		<?php if ( $section_title ) : ?>
			<h2><?php echo apply_filters('the_title', $section_title); ?></h2>
		<?php endif; ?>


		<div class="video-holder frame">
			<a target="_blank" href="<?php echo esc_url( $link ); ?>">
				<img src="<?php echo wpthumb( $image['url'], array( 'width' => 308 ) ); ?>" alt="" />
			</a>
		</div>
		<div class="video-holder frame">
			<a target="_blank" href="<?php echo esc_url( $link_2 ); ?>">
				<img src="<?php echo wpthumb( $image_2['url'], array( 'width' => 308 ) ); ?>" alt="" />
			</a>
		</div>

		<div class="video-cnt">
			<?php if ( $video_title ) : ?>
				<h4><?php echo apply_filters('the_title', $video_title); ?></h4>
			<?php endif; ?>
			<?php echo apply_filters('the_content', $description); ?>
		</div>
	</div>
</section>
<!-- end of double-video -->
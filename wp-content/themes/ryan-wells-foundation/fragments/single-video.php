<?php

	// Metas
	$section_title 	= get_field( 'single_video_section_title' );
	$video_title 	= get_field( 'video_title' );


	$description 	= get_field( 'video_description' );
	$image 			= get_field( 'video_thumbnail_image' );
	$link 			= get_field( 'video_link' );

	if ( empty($image) || empty($link) )
		return;
?>

<section class="section single-video">
	<div class="shell">
		<?php if ( $section_title ) : ?>
			<h2><?php echo apply_filters('the_title', $section_title); ?></h2>
		<?php endif; ?>

		<div class="video-holder frame">
			<a target="_blank" href="<?php echo esc_url( $link ); ?>">
				<img src="<?php echo wpthumb( $image['url'], array( 'width' => 694 ) ); ?>" alt="" />
			</a>
		</div>

		<div class="video-cnt">
			<?php if ( $video_title ) : ?>
				<h4><?php echo apply_filters('the_title', $video_title); ?></h4>
			<?php endif; ?>
			<div><?php echo apply_filters('the_content', $description); ?></div>
		</div>
	</div>
</section>
<!-- end of single-video -->
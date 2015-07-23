<?php

	// Metas
	$section_title 	= $layout['single_video_section_title'];
	$video_title 	= $layout['video_title'];
	$description 	= $layout['video_description'];
	$image 			= $layout['video_thumbnail_image'];
	$link 			= $layout['video_link'];

	$section_id 	= (isset($layout['section_id'])) ? $layout['section_id'] : '';
	$section_id 	= str_replace("#", "", $section_id);


	if ( empty($image) || empty($link) )
		return;

	preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $video_id);
	$video_id = count($video_id) ?$video_id[0] :"";
?>

<section id="<?php echo $section_id; ?>" class="section single-video">
	<div class="shell">
		<?php if ( $section_title ) : ?>
			<h2><?php echo apply_filters('the_title', $section_title); ?></h2>
		<?php endif; ?>

		<div class="video-holder frame">
			<a target="_blank" href="<?php echo esc_url( $link ); ?>">
				<img src="<?php echo wpthumb( $image['url'], array( 'width' => 694 ) ); ?>" alt="" />
			</a>
			<iframe id="player_<?php echo uniqid(); ?>" type="text/html" width="100%" height="100%"
			  src="http://www.youtube.com/embed/<?php echo $video_id; ?>?enablejsapi=1"
			  frameborder="0"></iframe>
		</div>

		<div class="video-cnt">
			<?php if ( $video_title ) : ?>
				<h4 ><?php echo apply_filters('the_title', $video_title); ?></h4>
			<?php endif; ?>
			<div ><?php echo apply_filters('the_content', $description); ?></div>
		</div>
	</div>
</section>
<!-- end of single-video -->
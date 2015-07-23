<?php

	// Metas
	$section_title 	= $layout['double_video_section_title'];
	$video_title 	= $layout['double_video_title'];
	$description 	= $layout['double_video_description'];

	$image 			= $layout['video_thumbnail_image_1'];
	$link 			= $layout['video_link_1'];

	$image_2 		= $layout['video_thumbnail_image_2'];
	$link_2 		= $layout['video_link_2'];
	$video_1_title = $layout['video_1_title'];
	$video_1_description = $layout['video_1_description'];
	$video_2_title = $layout['video_2_title'];
	$video_2_description = $layout['video_2_description'];
	$section_id 	= (isset($layout['section_id'])) ? $layout['section_id'] : '';
	$section_id 	= str_replace("#", "", $section_id);

	if ( empty($image) || empty($link) )
		return;

	preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link, $video_id);
	$video_id = count($video_id) ?$video_id[0] :"";

	preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $link_2, $video_id_2);
	$video_id_2 = count($video_id_2) ?$video_id_2[0] :"";
?>


<section id="<?php echo $section_id; ?>" class="section double-video">
	<div class="shell">
		<?php if ( $section_title ) : ?>
			<h2><?php echo apply_filters('the_title', $section_title); ?></h2>
		<?php endif; ?>


		<div class="video-holder frame">
			<a target="_blank" href="<?php echo esc_url( $link ); ?>">
				<img src="<?php echo wpthumb( $image['url'], array( 'width' => 308 ) ); ?>" alt="" />
			</a>
			<iframe id="player_<?php echo uniqid(); ?>" type="text/html" width="100%" height="100%"
			  src="http://www.youtube.com/embed/<?php echo $video_id; ?>?enablejsapi=1"
			  frameborder="0"></iframe>
		</div>


		<div class="video-holder frame">
			<a target="_blank" href="<?php echo esc_url( $link_2 ); ?>">
				<img src="<?php echo wpthumb( $image_2['url'], array( 'width' => 308 ) ); ?>" alt="" />
			</a>
			<iframe id="player_<?php echo uniqid(); ?>" type="text/html" width="100%" height="100%"
			  src="http://www.youtube.com/embed/<?php echo $video_id_2; ?>?enablejsapi=1"
			  frameborder="0"></iframe>
		</div>

		<div class="video-cnt double">
			<?php if ( $video_1_title ) : ?>
				<h4><?php echo apply_filters('the_title', $video_1_title); ?></h4>
			<?php endif; ?>
			<?php echo apply_filters('the_content', $video_1_description); ?>
		</div>
		<div class="video-cnt double">
			<?php if ( $video_2_title ) : ?>
				<h4><?php echo apply_filters('the_title', $video_2_title); ?></h4>
			<?php endif; ?>
			<?php echo apply_filters('the_content', $video_2_description); ?>
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
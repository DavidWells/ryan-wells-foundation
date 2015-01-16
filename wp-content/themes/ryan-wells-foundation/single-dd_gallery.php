<?php
/**
 * The Template for displaying a gallery.
 */

get_header();

$content_class = '';
$layout = get_post_meta( get_the_ID(), $sn . 'layout', true );

if ( empty( $layout ) || $layout == 'c' ) {
	$content_class = '';
}

?>
		
	<div class="container clearfix">

		<div id="content" class="<?php echo $content_class; ?>">

			<?php

				if (have_posts()) : while (have_posts()) : the_post();
					
						// Content
						get_template_part( 'templates/gallery', '' );

						// Related
						dd_related_galleries( get_the_ID() );

						// Comments
						if ( comments_open() || '0' != get_comments_number() ) { comments_template( '', true ); }

				endwhile; endif;

			?>

		</div>

	</div><!-- .container -->

<?php get_footer(); ?>
<?php
/**
 * The Template for displaying pages.
 */

get_header();

// Layout
$lay = get_post_meta( get_the_ID(), $dd_sn . 'layout', true );
$blocks = get_field( 'page_flexible_content');
if ( empty ( $lay ) ) { $lay = 'cs'; }

// Content Class
$content_class = '';
if ( $lay == 'cs' ) { $content_class = 'two-thirds column'; }

?>

	<div class="container clearfix">

		<div id="content" class="<?php echo $content_class; ?>">

			<?php

				if (have_posts()) : while (have_posts()) : the_post();

					get_template_part( 'templates/page', '' );

				endwhile; endif;

			?>

			<?php if ( $blocks ) {

				foreach( $blocks as $layout) {
					$section = $layout['acf_fc_layout'];

					if ( $section == 'header_area' ) {
						// The main heading section
						crb_heading_section( $layout );
					} else {

						include( locate_template( 'fragments/' . $section . '.php' ) );

					}
				}
			} ?>

			<?php $vertical_sections = get_field('vertical_sections', $page_id, 'complex');
			if(!empty($vertical_sections)) : ?>
				<div class="main">

					<div class="shell">

						<?php include( locate_template( 'fragments/vert.php' ) ); ?>

					</div><!-- /.shell -->
				</div><!-- /.main -->
			<?php endif; ?>

		</div>

		<?php if ( $lay == 'cs' ) { get_sidebar( 'page' ); } ?>

	</div><!-- .container -->

<?php get_footer(); ?>
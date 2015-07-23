<?php
/*
* Template Name: Page No Title
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
<style type="text/css">
	.page-single {
		margin-bottom: 0px;
	}
	.section:first-of-type {
		padding-top: 0px;
	}
</style>
	<div class="container clearfix">

		<div id="content" style="padding-top:0px;" class="<?php echo $content_class; ?>">

			<?php

				if (have_posts()) : while (have_posts()) : the_post();

					get_template_part( 'templates/page-no-title', '' );

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

			<div class="page-post-content">

				<?php the_content(); ?>

			</div><!-- .page-post-content -->

		</div>

		<?php if ( $lay == 'cs' ) { get_sidebar( 'page' ); } ?>

	</div><!-- .container -->

<?php get_footer(); ?>
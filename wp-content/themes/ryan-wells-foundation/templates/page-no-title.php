<div <?php post_class( 'page-single' ); ?>>

	<div class="page-single-main">

		<div id="post-pagination">
			<?php
				$args = array(
					'before' => '',
					'after' => '',
					'link_before' => '<span class="dd-button">',
					'link_after' => '</span>',
					'next_or_number' => 'number',
					'pagelink' => '%',
				);
				wp_link_pages( $args );
			?>
		</div><!-- #post-pagination -->

	</div><!-- .page-post-single-main -->

</div><!-- .page-post-single -->
<?php

	// Option fields
	$sign_up_text 	= get_field( 'account_text', 'option' );
	$sign_up_link 	= get_field( 'sign_up_link', 'option' );
	$signup_link_color 	= get_field( 'signup_link_color', 'option' );
	$login_text 	= get_field( 'login_text', 'option' );
	$login_url 		= get_field( 'login_url', 'option' );
	$login_link_color 		= get_field( 'login_link_color', 'option' );


	$socials = array(
		'twitter_url' 	=> 'twitter_circle',
		'facebook_url' 	=> 'facebook_circle',
		'youtube_url' 	=> 'youtube_circle',
		'flickr_url' 	=> 'flickr_circle',
	);
?>

<div class="header-right">
	<div class="login-link"><a class="sign-up-link-top" style="color:<?php echo $signup_link_color;?>;"  href="<?php echo $sign_up_link; ?>"><?php echo $sign_up_text; ?></a> | <a target="_blank" style="color:<?php echo $login_link_color;?>;"  class="login-link-top" href="<?php echo esc_url( $login_url ); ?>"><?php echo $login_text; ?></a></div>

	<script type="text/javascript">
		var language_text = "<?php echo __('Language','sitepress'); ?>";
	</script>
	<?php do_action('icl_language_selector'); ?>

	<div class="socials">

		<?php foreach ($socials as $key => $icon):
			$url = get_field( $key, 'option' );

			if ( empty($url) )
				continue;
		?>

		<a target="_blank" href="<?php echo esc_url( $url ); ?>">
			<img src="<?php bloginfo( 'stylesheet_directory'); ?>/images/<?php echo $icon; ?>.png" alt="" />
		</a>

		<?php endforeach ?>

	</div>
</div>
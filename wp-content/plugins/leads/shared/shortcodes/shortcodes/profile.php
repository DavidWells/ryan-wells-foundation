<?php
/**
*   Profile Shortcode
*/

/* 	Shortcode generator config
 * 	----------------------------------------------------- */
	$shortcodes_config['profile'] = array(
		'no_preview' => true,
		'options' => array(
			'name' => array(
				'name' => __('Profile Name', 'leads'),
				'desc' => __('Enter the name.', 'leads'),
				'type' => 'text',
				'std' => ''
			),
			'meta' => array(
				'name' => __('Profile Meta', 'leads'),
				'desc' => __('Enter the profile meta. e.g job position etc.', 'leads'),
				'type' => 'text',
				'std' => ''
			),
			'image' => array(
				'name' => __('Profile Image', 'leads'),
				'desc' => __('Paste your profile image URL here.', 'leads'),
				'type' => 'text',
				'std' => ''
			),
			'link' => array(
				'name' => __('Profile Link', 'leads'),
				'desc' => __('Paste your profile link URL here.', 'leads'),
				'type' => 'text',
				'std' => ''
			),
			'facebook' => array(
				'name' => __('Profile Facebook', 'leads'),
				'desc' => __('Paste your facebook URL here.', 'leads'),
				'type' => 'text',
				'std' => ''
			),
			'twitter' => array(
				'name' => __('Profile Twitter', 'leads'),
				'desc' => __('Paste your twitter URL here.', 'leads'),
				'type' => 'text',
				'std' => ''
			),
			'email' => array(
				'name' => __('Profile Email Address', 'leads'),
				'desc' => __('Paste your email address here.', 'leads'),
				'type' => 'text',
				'std' => ''
			),
			'content' => array(
				'name' => __('Profile Description',  'leads'),
				'desc' => __('Enter the profile description text.',  'leads'),
				'type' => 'textarea',
				'std' => ''
			)
		),
		'shortcode' => '[profile name="{{name}}" meta="{{meta}}" image="{{image}}"]{{content}}[/profile]',
		'popup_title' => 'Insert Profile Shortcode'
	);

/* 	Page builder module config
 * 	----------------------------------------------------- */
	$freshbuilder_modules['profile'] = array(
		'name' => __('Profile', 'leads'),
		'size' => 'one_fourth',
		'options' => array(
			'name' => array(
				'name' => __('Profile Name', 'leads'),
				'desc' => __('Enter the name.', 'leads'),
				'type' => 'text',
				'std' => '',
				'class' => '',
				'is_content' => 0
			),
			'meta' => array(
				'name' => __('Profile Meta', 'leads'),
				'desc' => __('Enter the profile meta. e.g job position etc.', 'leads'),
				'type' => 'text',
				'std' => '',
				'class' => '',
				'is_content' => 0
			),
			'image' => array(
				'name' => __('Profile Image', 'leads'),
				'desc' => __('Paste your profile image URL here.', 'leads'),
				'type' => 'text',
				'std' => '',
				'class' => '',
				'is_content' => 0
			),
			'link' => array(
				'name' => __('Profile Link', 'leads'),
				'desc' => __('Paste your profile URL here.', 'leads'),
				'type' => 'text',
				'std' => '',
				'class' => '',
				'is_content' => 0
			),
			'facebook' => array(
				'name' => __('Profile Facebook', 'leads'),
				'desc' => __('Paste your facebook URL here.', 'leads'),
				'type' => 'text',
				'std' => '',
				'class' => '',
				'is_content' => 0
			),
			'twitter' => array(
				'name' => __('Profile Twitter', 'leads'),
				'desc' => __('Paste your twitter URL here.', 'leads'),
				'type' => 'text',
				'std' => '',
				'class' => '',
				'is_content' => 0
			),
			'email' => array(
				'name' => __('Profile Email Address', 'leads'),
				'desc' => __('Paste your email address here.', 'leads'),
				'type' => 'text',
				'std' => '',
				'class' => '',
				'is_content' => 0
			),
			'content' => array(
				'name' => __('Profile Description', 'leads'),
				'desc' => __('Enter the profile description text.',  'leads'),
				'type' => 'textarea',
				'std' => '',
				'class' => '',
				'is_content' => 1
			)
		)
	);

/* 	Add shortcode
 * 	----------------------------------------------------- */
	add_shortcode('profile', 'inbound_shortcode_profile');

	function inbound_shortcode_profile( $atts, $content = null ) {
		extract(shortcode_atts(array(
			'name' => '',
			'meta' => '',
			'image' => '',
			'link' => '',
			'facebook' => '',
			'twitter' => '',
			'email' => ''
		), $atts));

		$out = '';
		$out .= '<div class="profile-box clearfix">';

			if($link != '') :
				$out .= '<figure class="profile-img"><a href="'. $link .'"><img src="'. $image .'" alt="'. $name .'"/></a></figure>';
			else :
				$out .= '<figure class="profile-img"><img src="'. $image .'" alt="'. $name .'"/></figure>';
			endif;

			if($name != '')
			$out .= '<h3 class="profile-name">'. $name .'</h3>';

			if($meta != '')
			$out .= '<div class="profile-meta">'. $meta .'</div>';

			$out .= '<div class="profile-desc">'. do_shortcode($content) .'</div>';

			if($facebook || $twitter || $email ) {
				$out .= '<div class="profile-footer">';
					if($facebook != '')
					$out .= '<a href="'. $facebook .'"><i class="icon-facebook-sign"></i> Facebook</a>';

					if($twitter != '')
					$out .= '<a href="'. $twitter .'"><i class="icon-twitter"></i> Twitter</a>';

					if($email != '' && is_email($email) )
					$out .= '<a href="mailto:'. $email .'"><i class="icon-envelope-alt"></i> Email</a>';
				$out .= '</div>';
			}
		$out .= '</div>';

		return $out;
	}
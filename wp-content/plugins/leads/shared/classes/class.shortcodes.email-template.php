<?php

if ( !class_exists( 'Inbound_Email_Template_Shortcodes' ) ) {

class Inbound_Email_Template_Shortcodes {

	public function __construct() {

		self::load_hooks();
	}

	public function load_hooks() {

		/* Shortcode for lead conversion data table - used in new lead notification email template */
		add_shortcode( 'inbound-email-post-params', array( __CLASS__, 'post_params_table' ), 1 );

		/* Shortcode for generating gravitar from email */
		add_shortcode( 'inbound-gravitar', array( __CLASS__, 'generate_gravitar' ), 1 );
	}


	/**
	* Used by leads-new-lead-notification email template to dispaly form fields the user inputted when converting on a form.
	*
	*/
	public static function post_params_table( $atts ) {
		/*
		extract( shortcode_atts( array(
	      'foo' => 'no foo',
	      'baz' => 'default baz'
		), $atts ) );
		*/
		$html = '';

		$post_params = apply_filters( 'inbound-email-post-params' , $_POST);
		$blacklist = array('inbound_submitted', 'inbound_notify', 'inbound_params', 'inbound_furl', 'stop_dirty_subs');

		// Parse out UTM Params
		if(isset($_POST['inbound_params']) && $_POST['inbound_params'] != "") {

			$url_params = json_decode(stripslashes($_POST['inbound_params']));
			foreach ($url_params as $field => $value) {
				/* Store UTM params */
				if (preg_match( '/utm_/i', $field)) {
					//echo $field . ":" . $value;
					$post_params[$field] = strip_tags( $value );
				}
			}
		}

		if( isset($post_params[ 'email' ])){
			$emailVal = $post_params[ 'email' ];
			unset($post_params[ 'email' ]);
			$email_array = array('email' => $emailVal );
			$post_params = array_merge( $email_array, $post_params );
			//print_r($post_params); exit;
		}

		foreach ($post_params as $key => $value ) {

			$name = str_replace(array('-','_'),' ', $key);
			$name = ucwords($name);

			if(in_array($key, $blacklist)) {
				continue;
			}


			if (is_array($value)) {
				$value = implode(', ', $value);
			} else if ( strlen($value) < 1 ) {
				$value  = __( 'n/a' , 'ma');
			}


			/* Rewrite UTM params */
			if (preg_match( '/utm_/i', $key)) {
				$name = ucfirst(str_replace("utm_", "", $key));
			}

			if ($key == "inbound_form_id" ) {
				$value = "<a title='". __( 'View/Edit this form' , 'ma' ) ."' href='" . admin_url( 'post.php?post=' . $value . '&action=edit' ). "'>".$value."</a>";
			}

			if($key == "inbound_form_lists" && $value != "") {
				$name = 'Added to Lists:';
				$lists = explode(',', $value);
				$count = count($lists) - 1;
				$list_links = "";
				foreach ($lists as $list ) {
					//$list_name = get_term_by('term_id', $list, 'wplead_list_category');
					$list_links .= "<a title='". __( 'View this list' , 'ma' ) ."' href='" . admin_url( 'edit.php?page=lead_management&post_type=wp-lead&wplead_list_category%5B%5D='.$list.'&relation=AND&orderby=date&order=asc&s=&t=&submit=Search+Leads' ). "'>".$list."</a>";
					if($count) { $list_links .= ' - '; $count--; }
				}
				$value = $list_links;
			}

			if ($key == "wp_cta_id" ) {
				$value = "<a title=' ". __( 'View/Edit this CTA' , 'ma' ) ."' href='" . admin_url( 'post.php?post=' . $value . '&action=edit' ). "'>".$value."</a>";
			}

			if ( $key == "inbound_current_page_url" ) {
				$name = __("Converted on Page" , 'ma' );
			}

			$html .= '<tr style="border-bottom-width:1px;border-bottom-style:solid;border-bottom-color:#cccccc;">';
			$html .= '<td width="600" style="border-right:1px solid #cccccc;">';
			//$html .= '<div style="padding-left:5px;display:inline-block;padding-bottom:5px;font-size:16px;color:#555;font-weight:bold;">' . $name . '</div>';
			$html .= '<table cellpadding="10" style="width:100%;max-width:600px;border-collapse:collapse;border:none;background:white;"><tbody><tr style="background:#ffffff;height:27px;font-weight:lighter;color:#555;font-size:16px;border:none;text-align:left;"><td align="left" width="200" style="color:#555;font-size:16px;font-weight:bold;">';
		     $html .= $name;
		     $html .= '</td><td align="left" width="400" style="font-size:14px;color:#000;">';
		     $html .= $value;
     		$html .= '</td></tr></tbody></table>';
			//$html .= '<div style="padding-left:5px;display:inline-block;font-size:14px;color:#000;">'. $value .'</div>';
			$html .= '</td></tr>';
		}

		//echo $html; exit;

		return $html;
	}

	/**
	* Used by wp-notify-post-author email template to show comment author gravitar
	*
	*
	*/
	public static function generate_gravitar( $atts ) {

		extract( shortcode_atts( array(
	      'email' => 'default@gravitar.com',
	      'size' => '60',
		  'default' => 'mm'
		), $atts ) );

		return "//www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

	}
}

/* Initiate the logging system */
$Inbound_Email_Template_Shortcodes = new Inbound_Email_Template_Shortcodes();

}
<?php
if ( ! class_exists( 'Inbound_Options_API' ) ) {

	class Inbound_Options_API {

		/**
		*  Gets option value in name space object
		*/
		public static function get_option( $namespace , $key , $default = null ) {
			$options = json_decode( stripslashes( get_option( $namespace ) ) , true ) ;

			if (!isset( $options[ $key ] )) {
				add_option( $namespace , '', '', 'no' );
				return $default;
			} else {
				return $options[ $key ];
			}
		}

		/**
		*  Updates option value in name space object
		*/
		public static function update_option( $namespace , $key , $value ) {

			$options = json_decode( stripslashes( get_option( $namespace ) ) , true ) ;

			if (!$options) {
				add_option( $namespace , '', '', 'no' );
				$options = array();
			}

			$options[$key] = $value;

			update_option( $namespace , json_encode( $options ) );
		}

	}


}
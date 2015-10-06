<?php

if ( !class_exists('Leads_Field_Map') ) {

	class Leads_Field_Map {

		static $field_map;

		/* Define Default Lead Fields */
		public static function get_lead_fields() {

			$lead_fields = array(
				array(
					'label' => __( 'First Name' , 'cta' ) ,
					'key'  => 'wpleads_first_name',
					'priority' => 20,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Last Name' , 'cta' ) ,
					'key'  => 'wpleads_last_name',
					'priority' => 30,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Email' , 'cta' ) ,
					'key'  => 'wpleads_email_address',
					'priority' => 40,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Website' , 'cta' ) ,
					'key'  => 'wpleads_website',
					'priority' => 50,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Job Title' , 'cta' ) ,
					'key'  => 'wpleads_job_title',
					'priority' => 60,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Company Name' , 'cta' ) ,
					'key'  => 'wpleads_company_name',
					'priority' => 70,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Mobile Phone' , 'cta' ) ,
					'key'  => 'wpleads_mobile_phone',
					'priority' => 80,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Work Phone' , 'cta' ) ,
					'key'  => 'wpleads_work_phone',
					'priority' => 90,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Address' , 'cta' ) ,
					'key'  => 'wpleads_address_line_1',
					'priority' => 100,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Address Continued' , 'cta' ) ,
					'key'  => 'wpleads_address_line_2',
					'priority' => 110,
					'type'  => 'text'
					),
				array(
					'label' => __( 'City' , 'cta' ) ,
					'key'  => 'wpleads_city',
					'priority' => 120,
					'type'  => 'text'
					),
				array(
					'label' => __( 'State/Region' , 'cta' ) ,
					'key'  => 'wpleads_region_name',
					'priority' => 130,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Zip-code' , 'cta' ) ,
					'key'  => 'wpleads_zip',
					'priority' => 140,
					'type'  => 'text'
					),

				array(
					'label' => __( 'Country' , 'cta' ) ,
					'key'  => 'wpleads_country_code',
					'priority' => 150,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Billing First Name' , 'cta' ) ,
					'key'  => 'wpleads_billing_first_name',
					'priority' => 160,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Billing Last Name' , 'cta' ) ,
					'key'  => 'wpleads_billing_last_name',
					'priority' => 120,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Billing Company' , 'cta' ) ,
					'key'  => 'wpleads_billing_company_name',
					'priority' => 170,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Billing Address' , 'cta' ) ,
					'key'  => 'wpleads_billing_address_line_1',
					'priority' => 180,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Billing Address Continued' , 'cta' ) ,
					'key'  => 'wpleads_billing_address_line_2',
					'priority' => 190,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Billing City' , 'cta' ) ,
					'key'  => 'wpleads_billing_city',
					'priority' => 200,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Billing State/Region' , 'cta' ) ,
					'key'  => 'wpleads_billing_region_name',
					'priority' => 210,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Billing Zip-code' , 'cta' ) ,
					'key'  => 'wpleads_billing_zip',
					'priority' => 220,
					'type'  => 'text'
					),

				array(
					'label' => __( 'Billing Country' , 'cta' ) ,
					'key'  => 'wpleads_billing_country_code',
					'priority' => 230,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Shipping First Name' , 'cta' ) ,
					'key'  => 'wpleads_shipping_first_name',
					'priority' => 240,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Shipping Last Name' , 'cta' ) ,
					'key'  => 'wpleads_shipping_last_name',
					'priority' => 250,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Shipping Company Name' , 'cta' ) ,
					'key'  => 'wpleads_shipping_company_name',
					'priority' => 260,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Shipping Address' , 'cta' ) ,
					'key'  => 'wpleads_shipping_address_line_1',
					'priority' => 270,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Shipping Address Continued' , 'cta' ) ,
					'key'  => 'wpleads_shipping_address_line_2',
					'priority' => 280,
					'type'  => 'text'
					),
					array(
					'label' => __( 'Shipping City' , 'cta' ) ,
					'key'  => 'wpleads_shipping_city',
					'priority' => 290,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Shipping State/Region' , 'cta' ) ,
					'key'  => 'wpleads_shipping_region_name',
					'priority' => 300,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Shipping Zip-code' , 'cta' ) ,
					'key'  => 'wpleads_shipping_zip',
					'priority' => 310,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Shipping Country' , 'cta' ) ,
					'key'  => 'wpleads_shipping_country_code',
					'priority' => 320,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Related Websites' , 'cta' ) ,
					'key'  => 'wpleads_websites',
					'priority' => 330,
					'type'  => 'links'
					),
				array(
					'label' => __( 'Notes' , 'cta' ) ,
					'key'  => 'wpleads_notes',
					'priority' => 340,
					'type'  => 'textarea'
					),
				array(
					'label' => __( 'Twitter Account' , 'cta' ) ,
					'key'  => 'wpleads_social_youtube',
					'priority' => 350,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Youtube Account' , 'cta' ) ,
					'key'  => 'wpleads_social_youtube',
					'priority' => 360,
					'type'  => 'text'
					),
				array(
					'label' => __( 'Facebook Account' , 'cta' ) ,
					'key'  => 'wpleads_social_facebook',
					'priority' => 370,
					'type'  => 'text'
					)

			);

			$lead_fields = apply_filters('wp_leads_add_lead_field',$lead_fields);

			return $lead_fields;
		}
		
		
		
		/**
		*  		Builds key=>label array of lead fields 
		*/
		public static function build_map_array() {
			
			$lead_fields = Leads_Field_Map::get_lead_fields();
			$lead_fields = Leads_Field_Map::prioritize_lead_fields( $lead_fields );
			
			$field_map = array();
			$field_map[''] = 'No Mapping'; // default empty
			foreach ($lead_fields as $key=>$field) {
					$label = $field['label'];
					$key = $field['key'];
					$field_map[$key] = $label;
			}

			return $field_map;
		}
		
		/**
		*  Priorize Lead Fields Array
		*  @param ARRAY $fields simplified id => label array of lead fields
		*  @param STRING $sort_flags default = SORT_ASC
		*/
		public static function prioritize_lead_fields( $fields ,  $sort_flags=SORT_ASC) { 

			$prioritized = array();
			foreach ($fields as $key => $value) {
				while (isset($prioritized[$value['priority']])) {
					$value['priority']++;
				}
				$prioritized[$value['priority']] = $value;
			}
			
			ksort($prioritized, $sort_flags);

			return array_values($prioritized); 

		}

		/**
		*  Gets lead field
		*  @param $lead_id 
		*  @param $field_key
		*/
		public static function get_field( $lead_id , $field_key ) {
			return get_post_meta( $lead_id , $field_key , true);		
		}

	}

}

/**
 * Add in custom lead fields
 *
 * This function adds additional fields to your lead profiles.
 * Label: Name of the Field
 * key: Meta key associated with data
 * priority: Where you want the fields placed. See https://github.com/inboundnow/leads/blob/master/modules/module.userfields.php#L7 for current weights
 * type: type of user area. 'text' or 'textarea'
 */

/*
add_filter('wp_leads_add_lead_field', 'custom_add_more_lead_fields', 10, 1);
function custom_add_more_lead_fields($lead_fields) {

 $new_fields =  array(
 					array(
				        'label' => __( 'Style' , 'cta' ) ,
				        'key'  => 'wpleads_style',
				        'priority' => 1,
				        'type'  => 'text'
				        ),
 					array(
				        'label' => __( 'Lead Source' , 'cta' ) ,
				        'key'  => 'wpleads_lead_source',
				        'priority' => 19,
				        'type'  => 'text'
				        ),
 					array(
				        'label' => __( 'New Field' , 'cta' ) ,
				        'key'  => 'wpleads_lead_source',
				        'priority' => 19,
				        'type'  => 'text'
				        ),
 					array(
				        'label' => __( 'Description' , 'cta' ) ,
				        'key'  => 'wpleads_description',
				        'priority' => 19,
				        'type'  => 'textarea'
				        )
				    );

		foreach ($new_fields as $key => $value) {
			array_push($lead_fields, $new_fields[$key]);
		}

        return $lead_fields;

}
/**/

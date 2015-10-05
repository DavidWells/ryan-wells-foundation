<?php

if ( !class_exists('Landing_Pages_Post_Type') ) {

    class Landing_Pages_Post_Type {

        function __construct() {
            self::load_hooks();
        }

        /**
         * setup hooks and filters
         */
        private function load_hooks() {
            add_action('init', array( __CLASS__ , 'register_post_type' ) );
        }

        /**
         * register post type
         */
        public static function register_post_type() {

            $slug = get_option( 'lp-main-landing-page-permalink-prefix', 'go' );
            $labels = array(
                'name' => _x('Landing Pages', 'post type general name' , 'landing-pages' ),
                'singular_name' => _x('Landing Page', 'post type singular name' , 'landing-pages' ),
                'add_new' => _x('Add New', 'Landing Page' , 'landing-pages' ),
                'add_new_item' => __('Add New Landing Page' , 'landing-pages' ),
                'edit_item' => __('Edit Landing Page' , 'landing-pages' ),
                'new_item' => __('New Landing Page' , 'landing-pages' ),
                'view_item' => __('View Landing Page' , 'landing-pages' ),
                'search_items' => __('Search Landing Page' , 'landing-pages' ),
                'not_found' =>  __('Nothing found' , 'landing-pages' ),
                'not_found_in_trash' => __('Nothing found in Trash' , 'landing-pages' ),
                'parent_item_colon' => ''
            );

            $args = array(
                'labels' => $labels,
                'public' => true,
                'publicly_queryable' => true,
                'show_ui' => true,
                'query_var' => true,
                'menu_icon' => LANDINGPAGES_URLPATH . '/images/plus.gif',
                'rewrite' => array("slug" => "$slug",'with_front' => false),
                'capability_type' => 'post',
                'hierarchical' => false,
                'menu_position' => 32,
                'supports' => array('title','custom-fields','editor','thumbnail', 'excerpt')
            );

            register_post_type( 'landing-page' , $args );
        }


        /* Register Category Taxonomy */
        public static function register_category_taxonomy() {

            register_taxonomy('wp_call_to_action_category','wp-call-to-action', array(
                'hierarchical' => true,
                'label' => __( 'CTA Categories' , 'cta' ),
                'singular_label' => __( 'Call to Action Category' , 'cta' ),
                'show_ui' => true,
                'show_in_nav_menus'	=> false,
                'query_var' => true,
                "rewrite" => true
            ));

        }

        /* Register Columns */
        public static function register_columns( $cols ) {

            $cols = array(
                "cb" => "<input type=\"checkbox\" />",
                "thumbnail-cta" => __( 'Preview' , 'cta' ),
                "title" => __( 'Call to Action Title' , 'cta' ),
                "cta_stats" => __( 'Variation Testing Stats' , 'cta' ),
                "cta_impressions" => __( 'Total<br>Impressions' , 'cta' ),
                "cta_actions" => __( 'Total<br>Conversions' , 'cta' ),
                "cta_cr" => __( 'Total<br>Click Through Rate' , 'cta' )

            );

            return $cols;

        }

        /* Prepare Column Data */
        public static function prepare_column_data( $column , $post_id ) {
            global $post;

            if ($post->post_type !='wp-call-to-action') {
                return $column;
            }

            if ("ID" == $column){
                echo $post->ID;
            } else if ("title" == $column) {
            }
            else if ("author" == $column) {
            }
            else if ("date" == $column)	{
            }
            else if ("thumbnail-cta" == $column) {
                $template = get_post_meta($post->ID, 'wp-cta-selected-template-0', true);
                $permalink = get_permalink($post->ID);
                $permalink = add_query_arg( array('w'=>'140') , $permalink );
                $thumbnail = '//s.wordpress.com/mshots/v1/' . urlencode(esc_url($permalink)) . '?w=140';

                echo "<a title='". __('Click to Preview this variation' , 'cta' ) ."' class='thickbox' href='".$permalink."?wp-cta-variation-id=0&wp_cta_iframe_window=on&post_id=".$post->ID."&TB_iframe=true&width=640&height=703' target='_blank'><img src='".$thumbnail."' style='width:150px;height:110px;' title='Click to Preview'></a>";

            }
            else if ("cta_stats" == $column) {
                self::show_stats_data();
            }
            elseif ("cta_impressions" == $column) {
                echo self::show_aggregated_stats("cta_impressions");

            }
            elseif ("cta_actions" == $column) {
                echo self::show_aggregated_stats("cta_actions");
            }
            elseif ("cta_cr" == $column) {
                echo self::show_aggregated_stats("cta_cr") . "%";
            }
            elseif ("template" == $column) {
                $template_used = get_post_meta($post->ID, 'wp-cta-selected-template', true);
                echo $template_used;
            }
        }

        /* Define Sortable Columns */
        public static function define_sortable_columns($columns) {

            return array(
                'title' 			=> 'title',
                'impressions'		=> 'impressions',
                'actions'			=> 'actions',
                'cr'				=> 'cr'
            );

        }

        /* Define Row Actions */
        public static function filter_row_actions( $actions , $post ) {

            if ($post->post_type=='wp-call-to-action') 			{
                $actions['clear'] = '<a href="#clear-stats" id="wp_cta_clear_'.$post->ID.'" class="clear_stats" title="'
                    . __( 'Clear impression and conversion records', 'cta' )
                    . '" >' .	__( 'Clear All Stats' , 'cta') . '</a>';

                /* show shortcode */
                $actions['clear'] .= '<br><span style="color:#000;">' . __( 'Shortcode:' , 'cta' ) .'</span> <input type="text" style="width: 60%; text-align: center;" class="regular-text code short-shortcode-input" readonly="readonly" id="shortcode" name="shortcode" value="[cta id=\''.$post->ID.'\']">';
            }

            return $actions;

        }

        /* Adds ability to filter email templates by custom post type */
        public static function add_category_taxonomy_filter() {
            global $post_type;

            if ($post_type === "wp-call-to-action") {
                $post_types = get_post_types( array( '_builtin' => false ) );
                if ( in_array( $post_type, $post_types ) ) {
                    $filters = get_object_taxonomies( $post_type );

                    foreach ( $filters as $tax_slug ) {
                        $tax_obj = get_taxonomy( $tax_slug );
                        (isset($_GET[$tax_slug])) ? $current = $_GET[$tax_slug] : $current = 0;
                        wp_dropdown_categories( array(
                            'show_option_all' => __('Show All '.$tax_obj->label ),
                            'taxonomy' 		=> $tax_slug,
                            'name' 			=> $tax_obj->name,
                            'orderby' 		=> 'name',
                            'selected' 		=> $current,
                            'hierarchical' 		=> $tax_obj->hierarchical,
                            'show_count' 		=> false,
                            'hide_empty' 		=> true
                        ) );
                    }
                }
            }
        }

        /* Convert Taxonomy ID to Slug for Filter Serch */
        public static function convert_id_to_slug($query) {
            global $pagenow;
            $qv = &$query->query_vars;
            if( $pagenow=='edit.php' && isset($qv['wp_call_to_action_category']) && is_numeric($qv['wp_call_to_action_category']) ) {
                $term = get_term_by('id',$qv['wp_call_to_action_category'],'wp_call_to_action_category');
                $qv['wp_call_to_action_category'] = $term->slug;
            }
        }

        /* Changes the title of Excerpt meta box to Summary */
        public static function change_excerpt_to_summary() {
            $post_type = "wp-call-to-action";
            if ( post_type_supports($post_type, 'excerpt') ) {
                add_meta_box('postexcerpt', __( 'Short Description' , 'cta' ), 'post_excerpt_meta_box', $post_type, 'normal', 'core');
            }
        }

        public static function show_stats_data()
        {
            global $post, $CTA_Variations;

            $permalink = get_permalink($post->ID);
            $variations = $CTA_Variations->get_variations( $post->ID );

            $admin_url = admin_url();
            $admin_url = str_replace('?frontend=false','',$admin_url);

            if ($variations)
            {
                //echo "<b>".$wp_cta_impressions."</b> visits";
                echo "<span class='show-stats button'>". __( 'Show Variation Stats' , 'cta' ) ."</span>";
                echo "<ul class='wp-cta-varation-stat-ul'>";

                $first_status = get_post_meta($post->ID,'wp_cta_ab_variation_status', true); // Current status
                $first_notes = get_post_meta($post->ID,'wp-cta-variation-notes', true);
                $cr_array = array();
                $i = 0;
                $impressions = 0;
                $conversions = 0;
                foreach ($variations as $vid => $variation)
                {
                    $letter = $CTA_Variations->vid_to_letter( $post->ID , $vid ); // convert to letter
                    $each_impression = get_post_meta($post->ID,'wp-cta-ab-variation-impressions-'.$vid, true); // get impressions
                    $v_status = get_post_meta($post->ID,'cta_ab_variation_status_'.$vid, true); // Current status

                    if ($i === 0) { $v_status = $first_status; } // get status of first

                    (($v_status === "")) ? $v_status = "1" : $v_status = $v_status; // Get on/off status

                    $each_notes = get_post_meta($post->ID,'wp-cta-variation-notes-'.$vid, true); // Get Notes

                    if ($i === 0) { $each_notes = $first_notes; } // Get first notes

                    $each_conversion = get_post_meta($post->ID,'wp-cta-ab-variation-conversions-'.$vid, true);
                    (($each_conversion === "")) ? $final_conversion = 0 : $final_conversion = $each_conversion;

                    $impressions += get_post_meta($post->ID,'wp-cta-ab-variation-impressions-'.$vid, true);

                    $conversions += get_post_meta($post->ID,'wp-cta-ab-variation-conversions-'.$vid, true);

                    if ($each_impression != 0)
                    {
                        $conversion_rate = $final_conversion / $each_impression;
                    }
                    else
                    {
                        $conversion_rate = 0;
                    }

                    $conversion_rate = round($conversion_rate,2) * 100;
                    $cr_array[] = $conversion_rate;

                    if ($v_status === "0")
                    {
                        $final_status = __( '(Paused)' , 'cta' );
                    }
                    else
                    {
                        $final_status = "";
                    }
                    /*if ($cr_array[$i] > $largest) {
                    $largest = $cr_array[$i];
                    }
                    (($largest === $conversion_rate)) ? $winner_class = 'wp-cta-current-winner' : $winner_class = ""; */
                    (($final_conversion === "1")) ? $c_text = 'conversion' : $c_text = "conversions";
                    (($each_impression === "1")) ? $i_text = 'view' : $i_text = "views";
                    (($each_notes === "")) ? $each_notes = 'No notes' : $each_notes = $each_notes;
                    $data_letter = "data-letter=\"".$letter."\"";

                    $popup = "data-notes=\"<span class='wp-cta-pop-description'>".$each_notes."</span><span class='wp-cta-pop-controls'><span class='wp-cta-pop-edit button-primary'><a href='".$admin_url."post.php?post=".$post->ID."&wp-cta-variation-id=".$vid."&action=edit'>Edit This Varaition</a></span><span class='wp-cta-pop-preview button'><a title='Click to Preview this variation' class='thickbox' href='".$permalink."&wp_cta_iframe_window=on&post_id=".$post->ID."&TB_iframe=true&width=640&height=703' target='_blank'>Preview This Varaition</a></span><span class='wp-cta-bottom-controls'><span class='wp-cta-delete-var-stats' data-letter='".$letter."' data-vid='".$vid."' rel='".$post->ID."'>Clear These Stats</span></span></span>\"";

                    echo "<li rel='".$final_status."' data-postid='".$post->ID."' data-letter='".$letter."' data-wp-cta='' class='wp-cta-stat-row-".$vid." ".$post->ID. '-'. $conversion_rate ." status-".$v_status. "'><a ".$popup." ".$data_letter." class='wp-cta-letter' title='click to edit this variation' href='".$admin_url."/wp-admin/post.php?post=".$post->ID."&wp-cta-variation-id=".$vid."&action=edit'>" . $letter . "</a><span class='wp-cta-numbers'> <span class='wp-cta-impress-num'>" . $each_impression . "</span><span class='visit-text'>".$i_text." with</span><span class='wp-cta-con-num'>". $final_conversion . "</span> ".$c_text."</span><a ".$popup." ".$data_letter." class='cr-number cr-empty-".$conversion_rate."' href='/wp-admin/post.php?post=".$post->ID."&wp-cta-variation-id=".$vid."&action=edit'>". $conversion_rate . "%</a></li>";
                    $i++;
                }
                echo "</ul>";

                $winning_cr = max($cr_array); // best conversion rate

                if ($winning_cr != 0) {
                    echo "<span class='variation-winner-is'>".$post->ID. "-".$winning_cr."</span>";
                }
                //echo "Total Visits: " . $impressions;
                //echo "Total Conversions: " . $conversions;
            }
            else
            {
                $notes = get_post_meta($post->ID,'wp-cta-variation-notes', true); // Get Notes
                $cr = self::show_aggregated_stats("cta_cr");
                (($notes === "")) ? $notes = 'No notes' : $notes = $notes;
                $popup = "data-notes=\"<span class='wp-cta-pop-description'>".$notes."</span><span class='wp-cta-pop-controls'><span class='wp-cta-pop-edit button-primary'><a href='".$admin_url."post.php?post=".$post->ID."&wp-cta-variation-id=0&action=edit'>Edit This Varaition</a></span><span class='wp-cta-pop-preview button'><a title='Click to Preview this variation' class='thickbox' href='".$permalink."?wp-cta-variation-id=0&wp_cta_iframe_window=on&post_id=".$post->ID."&TB_iframe=true&width=640&height=703' target='_blank'>Preview This Varaition</a></span><span class='wp-cta-bottom-controls'><span class='wp-cta-delete-var-stats' data-letter='A' data-vid='0' rel='".$post->ID."'>Clear These Stats</span></span></span>\"";

                echo "<ul class='wp-cta-varation-stat-ul'><li rel='' data-postid='".$post->ID."' data-letter='A' data-wp-cta=''><a ".$popup." data-letter=\"A\" class='wp-cta-letter' title='click to edit this variation' href='".$admin_url."post.php?post=".$post->ID."&wp-cta-variation-id=0&action=edit'>A</a><span class='wp-cta-numbers'> <span class='wp-cta-impress-num'>" . self::show_aggregated_stats("cta_impressions") . "</span><span class='visit-text'>visits</span><span class='wp-cta-con-num'>". self::show_aggregated_stats("cta_actions") . "</span> conversions</span><a class='cr-number cr-empty-".$cr."' href='".$admin_url."post.php?post=".$post->ID."&wp-cta-variation-id=0&action=edit'>". $cr . "%</a></li></ul>";
                echo "<div class='no-stats-yet'>". __( 'No A/B Tests running for this landing page.' , 'cta' ) ." <a href='/wp-admin/post.php?post=".$post->ID."&wp-cta-variation-id=1&action=edit&new-variation=1&wp-cta-message=go'>Start one</a></div>";

            }
        }

        /* Needs Documentation */
        public static function show_aggregated_stats($type_of_stat)
        {
            global $post, $CTA_Variations;

            $variations = $CTA_Variations->get_variations($post->ID);


            $impressions = 0;
            $conversions = 0;

            foreach ($variations as $vid => $variation)
            {
                $impressions +=  $CTA_Variations->get_impressions( $post->ID , $vid );
                $conversions +=  $CTA_Variations->get_conversions( $post->ID , $vid );
            }

            if ($type_of_stat === "cta_actions")
            {
                return $conversions;
            }
            if ($type_of_stat === "cta_impressions")
            {
                return $impressions;
            }
            if ($type_of_stat === "cta_cr")
            {
                if ($impressions != 0) {
                    $conversion_rate = $conversions / $impressions;
                } else {
                    $conversion_rate = 0;
                }

                $conversion_rate = round($conversion_rate,2) * 100;

                return $conversion_rate;
            }
        }

        /* Add butotn to clear all CTA stats */
        public static function add_clear_all_stats_button() {
            global $post;

            if ( !isset( $post ) || $post->post_type != 'wp-call-to-action' ) {
                return;
            }

            ?>

            <script>
                jQuery(document).ready(function($) {
                    var cta_button_html = '<span id="cta_clear_all_cta_stats" class="button"><img src="<?php echo WP_CTA_URLPATH; ?>images/reset.png" style="margin-top:-3px;vertical-align:middle;padding-right:3px;"> <?php _e( 'Reset All CTA Stats' , 'cta' ); ?></span>';
                    jQuery('.search-box').append(cta_button_html);
                    jQuery("#cta_clear_all_cta_stats").click( function(e) {
                        e.preventDefault();
                        if (confirm('<?php _e('Are you sure you want to clear all call to action stats?' , 'cta' ); ?>')) {

                            jQuery.ajax({
                                type: 'POST',
                                url: ajaxurl,
                                context: this,
                                data: {
                                    action: 'wp_cta_clear_all_cta_stats',
                                },

                                success: function(data){
                                    var self = this;

                                    jQuery(self).text("Stats Removed!").css("color", "green").removeClass("wp-cta-delete-var-stats").addClass('wp-cta-clear-success');
                                    jQuery(".wp-cta-impress-num, .wp-cta-con-num").text("0");
                                    jQuery(".cr-number").addClass("cr-empty-0").text("0%");
                                },

                                error: function(MLHttpRequest, textStatus, errorThrown){
                                    alert("Ajax not enabled");
                                }
                            });
                        };
                    });
                });

            </script>
        <?php
        }

        /* Clears stats of all CTAs	*/
        public static function clear_all_cta_stats() {
            $ctas = get_posts( array(
                'post_type' => 'wp-call-to-action',
                'posts_per_page' => -1
            ));


            foreach ($ctas as $cta) {
                Landing_Pages_Post_Type::clear_cta_stats( $cta->ID );
            }
        }

        /* Clears stats of a single CTA
        *
        * @param	cta_id INT of call to action
        */
        public static function clear_cta_stats( $cta_id ) {
            global $CTA_Variations;

            $variations = $CTA_Variations->get_variations($cta_id);
            if ($variations)
            {
                foreach ( $variations as $vid => $variation )
                {
                    add_post_meta( $cta_id, 'wp-cta-ab-variation-impressions-'.$vid, 0 , true ) or update_post_meta( $cta_id, 'wp-cta-ab-variation-impressions-'.$vid , 0 );
                    add_post_meta( $cta_id, 'wp-cta-ab-variation-conversions-'.$vid, 0 , true ) or update_post_meta( $cta_id, 'wp-cta-ab-variation-conversions-'.$vid , 0 );
                }

            } else {
                add_post_meta( $cta_id, 'wp-cta-ab-variation-impressions-0', 0 , true ) or update_post_meta( $cta_id, 'wp-cta-ab-variation-impressions-0' , 0 );
                add_post_meta( $cta_id, 'wp-cta-ab-variation-conversions-0', 0 , true ) or update_post_meta( $cta_id, 'wp-cta-ab-variation-conversions-0' , 0 );
            }
        }

        /* Clears stats for CTA variation given CTA & Variation ID
        *
        * @param cta_id INI
        * @param variation_id INT
        *
        */
        public static function clear_cta_variation_stats( $cta_id = 0 , $variation_id = 0 ) {

            add_post_meta( $cta_id, 'wp-cta-ab-variation-impressions-'.$variation_id , 0 , true ) or update_post_meta( $cta_id, 'wp-cta-ab-variation-impressions-'.$variation_id , 0 );
            add_post_meta( $cta_id, 'wp-cta-ab-variation-conversions-'.$variation_id , 0 , true ) or update_post_meta( $cta_id, 'wp-cta-ab-variation-conversions-'.$variation_id , 0 );

        }
    }

    /* Load Post Type Pre Init */
    $GLOBALS['Landing_Pages_Post_Type'] = new Landing_Pages_Post_Type();
}
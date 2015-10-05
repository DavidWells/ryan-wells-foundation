jQuery(document).ready(function($) {

    var cookies = (typeof (jQuery.cookie) != "undefined" ? true : false); // Check for JQuery Cookie
    function cookie_notice() {
        alert('Oh no! jQuery Cookie not loaded. Your Server Might be Blocking this. Some functionality may be impaired');
    }

    jQuery('.button.button-small').each(function(){
        var $this = jQuery(this);
        var text =  $this.text();
        if(text === "Get Shortlink") {
            $this.hide();
        }
    });

    var width = jQuery("#lp-thumbnail-sidebar-preview").width();
    jQuery('#zoomer').zoomer({ width: width, height: 225, zoom: 0.3, tranformOrigin: '0 43px', });

    // Filter Styling
    jQuery('#template-filter li').first().addClass('button-primary');
	// filter items when filter link is clicked
	jQuery('#template-filter a').click(function(){
	  var selector = jQuery(this).attr('data-filter');
	  jQuery("ul#template-filter li").removeClass('button-primary');
      jQuery(this).parent().addClass('button-primary');
      $(".template-item-boxes").fadeOut(500);
      setTimeout(function() {
       $(selector).fadeIn(500);
      }, 500);

	  return false;
	});

	/* Ajax loading tabs
		jQuery.koolSwap({
			swapBox : '#poststuff',
			outDuration : 550,
			inDuration : 600,
	});
	*/

	jQuery("body").on('click', '#content-tmce, .wp-switch-editor.switch-tmce', function () {
        if(cookies) {
		  $.cookie("lp-edit-view-choice", "editor", { path: '/', expires: 7 });
        } else {
          cookie_notice();
        }
	});

	jQuery("body").on('click', '#content-html, .wp-switch-editor.switch-html', function () {
        if(cookies) {
		$.cookie("lp-edit-view-choice", "html", { path: '/', expires: 7 });
        } else {
        cookie_notice();
        }
	});

    if(cookies) {
	   var which_editor = $.cookie("lp-edit-view-choice");
    } else {
        var which_editor = 'editor';
        cookie_notice();
    }
	if(which_editor === null){
	   setTimeout(function() {
		//jQuery("#content-tmce").click();
		//jQuery(".wp-switch-editor.switch-tmce").click();
		}, 1000);

	}
    /*

        var chtml= jQuery('#content-html');
        var ctmce= jQuery('#content-tmce');
        var c= jQuery('#content'); // textarea
        var vismode= c.css('display')=='none';
        switchEditors.switchto(chtml[0]); // switch to html
        switchEditors.switchto(ctmce[0]); // switch to tinymce

     */
	if(which_editor === 'editor'){
	  setTimeout(function() {

        var ctmce= jQuery('#content-tmce');
        switchEditors.switchto(ctmce[0]); // switch to tinymce

        var conversion_area = jQuery("#landing-page-myeditor-tmce");
        switchEditors.switchto(conversion_area[0]); // switch to tinymce
		//jQuery("#content-tmce").click();
		//jQuery(".wp-switch-editor.switch-tmce").click();
        jQuery('.inbound-wysiwyg-option textarea').each(function(){
            var chtml= "#" + jQuery(this).attr('id') + '-html';
            var ctmce= "#" + jQuery(this).attr('id') + '-tmce';
            var html_box = jQuery(chtml);
            var tinymce_box = jQuery(ctmce);
            switchEditors.switchto(tinymce_box[0]); // switch to tinymce
        });
		}, 1000);
	}

    /* Tour Start JS */
    var tourbutton = '<a class="" id="lp-tour" style="font-size:13px;">Need help? Take the tour</a>';
    jQuery(tourbutton).appendTo("h2:eq(0)");
    jQuery("body").on('click', '#lp-tour', function () {
        var tour = jQuery("#lp-tour-style").length;
         if ( tour === 0 ) {
            jQuery('head').append("<link rel='stylesheet' id='lp-tour-style' href='/wp-content/plugins/landing-pages/css/admin-tour.css' type='text/css' /><script type='text/javascript' src='/wp-content/plugins/landing-pages/js/admin/tour/tour.post-edit.js'></script><script type='text/javascript' src='/wp-content/plugins/landing-pages/js/admin/intro.js'></script>");
          }
        setTimeout(function() {
                introJs().start(); // start tour
        }, 300);

    });

    var current_a_tab = jQuery("#tabs-0").hasClass('nav-tab-special-active');
    if (current_a_tab === true){
        var url_norm = jQuery("#view-post-btn a").attr('href');
        var new_url = url_norm + "?lp-variation-id=0";
        jQuery("#view-post-btn a").attr('href', new_url);
    }

    // Fix inactivate theme display
    jQuery("#template-box a").live('click', function () {

		setTimeout(function() {
			jQuery('#TB_window iframe').contents().find("#customize-controls").hide();
				jQuery('#TB_window iframe').contents().find(".wp-full-overlay.expanded").css("margin-left", "0px");
		}, 600);

    });

    // Fix Split testing iframe size
    jQuery("#lp-metabox-splittesting a.thickbox, #leads-table-container-inside .column-details a").live('click', function () {
        jQuery('#TB_iframeContent, #TB_window').hide();
        setTimeout(function() {

         jQuery('#TB_iframeContent, #TB_window').width( 640 ).height( 800 ).css("margin-left", "0px").css("left", "35%");
         jQuery('#TB_iframeContent, #TB_window').show();
        }, 600);
    });

    // Load meta box in correct position on page load
    var current_template = jQuery("input#lp_select_template ").val();
    var current_template_meta = "#lp_" + current_template + "_custom_meta_box";
    jQuery(current_template_meta).removeClass("postbox").appendTo("#template-display-options").addClass("Old-Template");
    var current_template_h3 = "#lp_" + current_template + "_custom_meta_box h3";
   // jQuery(current_template_h3).css("background","#f8f8f8");
    jQuery(current_template_meta +' .handlediv').hide();
    jQuery(current_template_meta +' .hndle').css('cursor','default');


    // Fix Thickbox width/hieght
    jQuery(function($) {
        tb_position = function() {
            var tbWindow = $('#TB_window');
            var width = $(window).width();
            var H = $(window).height();
            var W = ( 1720 < width ) ? 1720 : width;

            if ( tbWindow.size() ) {
                tbWindow.width( W - 50 ).height( H - 45 );
                $('#TB_iframeContent').width( W - 50 ).height( H - 75 );
                tbWindow.css({'margin-left': '-' + parseInt((( W - 50 ) / 2),10) + 'px'});
                if ( typeof document.body.style.maxWidth != 'undefined' )
                    tbWindow.css({'top':'40px','margin-top':'0'});
                //$('#TB_title').css({'background-color':'#fff','color':'#cfcfcf'});
            };

            return $('a.thickbox').each( function() {
                var href = $(this).attr('href');
                if ( ! href ) return;
                href = href.replace(/&width=[0-9]+/g, '');
                href = href.replace(/&height=[0-9]+/g, '');
                $(this).attr( 'href', href + '&width=' + ( W - 80 ) + '&height=' + ( H - 85 ) );
                /*
                var frontend_status = jQuery("#frontend-on").val();
                if (typeof (frontend_status) != "undefined" && frontend_status !== null) {
                     console.log('clixk');
                    var custom_css = jQuery("#TB_iframeContent").contents().find('#custom-media-css').length;
                    // Not complete need to troubleshoot
                        if( custom_css < 1) {
                        console.log('yes');
                        setTimeout(function() {
                        jQuery("#TB_iframeContent").contents().find('head').append('<link rel="stylesheet" id="custom-media-css" href="/wp-content/plugins/landing-pages/css/customizer.media-uploader.css" type="text/css" />');
                         }, 500);
                        setTimeout(function() {
                            jQuery("#TB_iframeContent").contents().find('head').append('<link rel="stylesheet" id="custom-media-css" href="/wp-content/plugins/landing-pages/css/customizer.media-uploader.css" type="text/css" />');
                        }, 2000);
                    }
                } */
            });

        };

        jQuery('a.thickbox').click(function(){
            if ( typeof tinyMCE != 'undefined' &&  tinyMCE.activeEditor ) {
                tinyMCE.get('content').focus();
                tinyMCE.activeEditor.windowManager.bookmark = tinyMCE.activeEditor.selection.getBookmark('simple');
            }

        });

        $(window).resize( function() { tb_position() } );
    });




    jQuery('.lp_select_template').click(function(){
        var template = jQuery(this).attr('id');
        var label = jQuery(this).attr('label');
		var selected_template_id = "#" + template;
		var currentlabel = jQuery(".currently_selected").show();
		var current_template = jQuery("input#lp_select_template ").val();
        var current_template_meta = "#lp_" + current_template + "_custom_meta_box";
        var current_template_h3 = "#lp_" + current_template + "_custom_meta_box h3";
        var current_template_div = "#lp_" + current_template + "_custom_meta_box .handlediv";
        var open_variation = jQuery("#open_variation").val();

		if (open_variation>0) {
			var variation_tag = "-"+open_variation;
		} else {
			var variation_tag = "";
		}

	    jQuery("#template-box.default_template_highlight").removeClass("default_template_highlight");

        jQuery(selected_template_id).parent().addClass("default_template_highlight").prepend(currentlabel);
        function capitaliseFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }
	    jQuery(".lp-template-selector-container").fadeOut(500,function(){
			jQuery('#lp_metabox_select_template input').remove();
			jQuery('#lp_metabox_select_template .form-table').remove();

			var ajax_data = {
				action: 'lp_get_template_meta',
				selected_template: template,
				post_id: lp_post_edit_ui.post_id,
			};

			jQuery.ajax({
					type: "POST",
					url: lp_post_edit_ui.ajaxurl,
					data: ajax_data,
					dataType: 'html',
					timeout: 7000,
					success: function (response) {
						//alert(response);
						var html = '<input id="lp_select_template" type="hidden" value="'+template+'" name="lp-selected-template'+variation_tag+'">'
								 + '<input type="hidden" value="'+lp_post_edit_ui.lp_template_nonce+'" name="lp_lp_custom_fields_nonce">'
								 + response;

						jQuery('#lp_metabox_select_template #template-display-options').html(html);
						jQuery('.time-picker').timepicker({ 'timeFormat': 'H:i' });
                        var template_name = capitaliseFirstLetter(template).replace("-", " ");
                        var template_name = template_name.replace("_", " ");
                        jQuery("#lp_metabox_select_template .hndle").first().text(template_name + " Template Options");

					},
					error: function(request, status, err) {
						alert(status);
					}
				});
            jQuery(".wrap").fadeIn(500, function(){
            });
        });

        jQuery(current_template_meta).appendTo("#template-display-options");

        jQuery('#lp_select_template').val(template);
        jQuery(".Old-Template").hide();

        jQuery(current_template_div).css("display","none");
        //jQuery(current_template_h3).css("background","#f8f8f8");
        jQuery(current_template_meta).show().appendTo("#template-display-options").removeClass("postbox").addClass("Old-Template");
        //alert(template);
        //alert(label);
    });

    jQuery('#lp-cancel-selection').click(function(){
        jQuery(".lp-template-selector-container").fadeOut(500,function(){
            jQuery(".wrap").fadeIn(500, function(){
            });
        });

    });

    // the_content default overwrite
    jQuery('body').on('click', '#overwrite-content', function(){
        if (confirm('Are you sure you want to overwrite what is currently in the main edit box above?')) {
            var ctmce= jQuery('#content-tmce');
            switchEditors.switchto(ctmce[0]); // switch to tinymce
            setTimeout(function() {
              var default_content = jQuery(".inbound-default-content-option textarea").first().text();
             jQuery("#content_ifr").contents().find("body").html(default_content);
            }, 500);

        }
    });

    // Colorpicker fix
    jQuery('.jpicker').one('mouseenter', function () {
        jQuery(this).jPicker({
            window: // used to define the position of the popup window only useful in binded mode
            {
                title: null, // any title for the jPicker window itself - displays "Drag Markers To Pick A Color" if left null
                position: {
                    x: 'screenCenter', // acceptable values "left", "center", "right", "screenCenter", or relative px value
                    y: 'center', // acceptable values "top", "bottom", "center", or relative px value
                },
                expandable: false, // default to large static picker - set to true to make an expandable picker (small icon with popup) - set
                // automatically when binded to input element
                liveUpdate: true, // set false if you want the user to click "OK" before the binded input box updates values (always "true"
                // for expandable picker)
                alphaSupport: false, // set to true to enable alpha picking
                alphaPrecision: 0, // set decimal precision for alpha percentage display - hex codes do not map directly to percentage
                // integers - range 0-2
                updateInputColor: true // set to false to prevent binded input colors from changing
            }
        },
        function(color, context)
        {
          var all = color.val('all');
         // alert('Color chosen - hex: ' + (all && '#' + all.hex || 'none') + ' - alpha: ' + (all && all.a + '%' || 'none'));
           //jQuery(this).attr('rel', all.hex);

           jQuery(this).parent().find(".lp-success-message").remove();
           //jQuery(this).parent().find(".new-save-lp").show();
           //jQuery(this).parent().find(".new-save-lp-frontend").show();
           //jQuery(this).attr('value', all.hex);
        });
    });


    if (jQuery(".lp-template-selector-container").css("display") == "none"){
        jQuery(".currently_selected").hide(); }
    else {
        jQuery(".currently_selected").show();
    }

    // Add current title of template to selector
    var selected_template = jQuery('#lp_select_template').val();
    var selected_template_id = "#" + selected_template;
    var clean_template_name = selected_template.replace(/-/g, ' ');
    function capitaliseFirstLetter(string)
    {
    return string.charAt(0).toUpperCase() + string.slice(1);
    }
    var currentlabel = jQuery(".currently_selected");
    jQuery(selected_template_id).parent().addClass("default_template_highlight").prepend(currentlabel);
    jQuery("#lp_metabox_select_template h3").first().prepend('<strong>' + capitaliseFirstLetter(clean_template_name) + '</strong> - ');

    jQuery('#lp-change-template-button').live('click', function () {
		jQuery('.acf-postbox').remove();
        jQuery(".wrap").fadeOut(500,function(){

            jQuery(".lp-template-selector-container").fadeIn(500, function(){
                jQuery(".currently_selected").show();
                jQuery('#lp-cancel-selection').show();
            });

        });
    });

    /* Move Slug Box
    var slugs = jQuery("#edit-slug-box");
    jQuery('#main-title-area').after(slugs.show());
    */
    // Background Options
    jQuery('.background-style').on('change', function () {
        var input = jQuery(".background-style option:selected").val();
        if (input == 'color') {
            jQuery('.background-color').show();
            jQuery('.background-image').hide();
            jQuery('.background_tip').hide();
        }
        else if (input == 'default') {
            jQuery('.background-color').hide();
            jQuery('.background-image').hide();
            jQuery('.background_tip').hide();
        }
        else if (input == 'custom') {
            var obj = jQuery(".background-style .lp_tooltip");
            obj.removeClass("lp_tooltip").addClass("background_tip").html("Use the custom css block at the bottom of this page to set up custom CSS rules");
            jQuery('.background_tip').show();
        }
        else {
            jQuery('.background-color').hide();
            jQuery('.background-image').show();
            jQuery('.background_tip').hide();
        }

    });

    // Check BG options on page load
    jQuery(document).ready(function () {
        var input = jQuery(".background-style option:selected").val();
        if (input == 'color') {
                 jQuery('.background-color').show();
                 jQuery('.background-image').hide();
                 jQuery('.background_tip').hide();
             }
             else if (input == 'default') {
                 jQuery('.background-color').hide();
                 jQuery('.background-image').hide();
                 jQuery('.background_tip').hide();
             }
             else if (input == 'custom') {
                 var obj = jQuery(".background-style .lp_tooltip");
                 obj.removeClass("lp_tooltip").addClass("background_tip").html("Use the custom css block at the bottom of this page to set up custom CSS rules");
                 jQuery('.background_tip').show();
             }
             else {
                 jQuery('.background-color').hide();
                 jQuery('.background-image').show();
                 jQuery('.background_tip').hide();
             }
    });

    //Stylize lead's wp-list-table
    var cnt = $("#leads-table-container").contents();
    $("#lp_conversion_log_metabox").replaceWith(cnt);

    //remove inputs from wp-list-table
    jQuery('#leads-table-container-inside input').each(function(){
        jQuery(this).remove();
    });

     var post_status = jQuery("#original_post_status").val();

    if (post_status === "draft") {
        // jQuery( ".nav-tab-wrapper.a_b_tabs .lp-ab-tab, #tabs-add-variation").hide();
        jQuery(".new-save-lp-frontend").on("click", function(event) {
            event.preventDefault();
            alert("Must publish this page before you can use the visual editor!");
        });
        var subbox = jQuery("#submitdiv");
        jQuery("#lp_ab_display_stats_metabox").before(subbox)
    } else {
        jQuery("#publish").val("Update All");
    }



});

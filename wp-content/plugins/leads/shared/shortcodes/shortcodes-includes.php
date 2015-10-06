<?php

/*
Grab all icons from http://fontawesome.io/icons/
jQuery(".container").eq(3).addClass('special-class');
function toTitleCase(str)
{
    return str.replace(/\w\S*/
    /*g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
}
jQuery(".lead").html("");
jQuery('.special-class i').each(function(i){
var testclass=  jQuery(this).attr('class');
var clean = testclass.replace('fa ', '');

var clean = clean.replace('fa-', '');
var new_name = clean.replace(/-/g, ' ');
//console.log(clean);
jQuery(".lead").append('"' + clean + '" => "' + toTitleCase(new_name) + '", ');

});
*/

/* 	Include & Variables
 * 	----------------------------------------------------- */
	global $shortcodes_config;

	$fontawesome = array("" => "None", "arrow-circle-o-right" => "Arrow Circle O Right", "arrow-circle-o-left" => "Arrow Circle O Left", "check" => "Check", "check-circle" => "Check Circle", "check-circle-o" => "Check Circle O", "check-square" => "Check Square", "check-square-o" => "Check Square O",  "comment" => "Comment", "comment-o" => "Comment O", "comments" => "Comments", "comments-o" => "Comments O", "asterisk" => "Asterisk", "thumbs-o-up" => "Thumbs O Up", "thumbs-up" => "Thumbs Up", "check-square" => "Check Square", "check-square-o" => "Check Square O", "arrow-circle-down" => "Arrow Circle Down", "arrow-circle-left" => "Arrow Circle Left", "arrow-circle-o-down" => "Arrow Circle O Down", "arrow-circle-o-left" => "Arrow Circle O Left", "arrow-circle-o-right" => "Arrow Circle O Right", "arrow-circle-o-up" => "Arrow Circle O Up", "arrow-circle-right" => "Arrow Circle Right", "arrow-circle-up" => "Arrow Circle Up", "arrow-down" => "Arrow Down", "arrow-left" => "Arrow Left", "arrow-right" => "Arrow Right", "arrow-up" => "Arrow Up", "angle-double-down" => "Angle Double Down", "angle-double-left" => "Angle Double Left", "angle-double-right" => "Angle Double Right", "angle-double-up" => "Angle Double Up", "angle-down" => "Angle Down", "angle-left" => "Angle Left", "angle-right" => "Angle Right", "angle-up" => "Angle Up", "caret-down" => "Caret Down", "caret-left" => "Caret Left", "caret-right" => "Caret Right", "caret-square-o-down" => "Caret Square O Down", "caret-square-o-left" => "Caret Square O Left", "caret-square-o-right" => "Caret Square O Right", "caret-square-o-up" => "Caret Square O Up", "caret-up" => "Caret Up", "chevron-circle-down" => "Chevron Circle Down", "chevron-circle-left" => "Chevron Circle Left", "chevron-circle-right" => "Chevron Circle Right", "chevron-circle-up" => "Chevron Circle Up", "chevron-down" => "Chevron Down", "chevron-left" => "Chevron Left", "chevron-right" => "Chevron Right", "chevron-up" => "Chevron Up", "hand-o-down" => "Hand O Down", "hand-o-left" => "Hand O Left", "hand-o-right" => "Hand O Right", "hand-o-up" => "Hand O Up", "long-arrow-down" => "Long Arrow Down", "long-arrow-left" => "Long Arrow Left", "long-arrow-right" => "Long Arrow Right", "long-arrow-up" => "Long Arrow Up", "toggle-down" => "Toggle Down", "toggle-left" => "Toggle Left", "toggle-right" => "Toggle Right", "toggle-up" => "Toggle Up", "arrows-alt" => "Arrows Alt", "backward" => "Backward", "compress" => "Compress", "eject" => "Eject", "expand" => "Expand", "fast-backward" => "Fast Backward", "fast-forward" => "Fast Forward", "forward" => "Forward", "pause" => "Pause", "play" => "Play", "play-circle" => "Play Circle", "play-circle-o" => "Play Circle O", "step-backward" => "Step Backward", "step-forward" => "Step Forward", "rub" => "Rub", "ruble" => "Ruble", "rouble" => "Rouble", "pagelines" => "Pagelines", "stack-exchange" => "Stack Exchange", "caret-square-o-left" => "Caret Square O Left", "toggle-left" => "Toggle Left", "dot-circle-o" => "Dot Circle O", "wheelchair" => "Wheelchair", "vimeo-square" => "Vimeo Square", "try" => "Try", "turkish-lira" => "Turkish Lira", "plus-square-o" => "Plus Square O", "adjust" => "Adjust", "anchor" => "Anchor", "archive" => "Archive", "arrows" => "Arrows", "arrows-h" => "Arrows H", "arrows-v" => "Arrows V", "ban" => "Ban", "bar-chart-o" => "Bar Chart O", "barcode" => "Barcode", "bars" => "Bars", "beer" => "Beer", "bell" => "Bell", "bell-o" => "Bell O", "bolt" => "Bolt", "book" => "Book", "bookmark" => "Bookmark", "bookmark-o" => "Bookmark O", "briefcase" => "Briefcase", "bug" => "Bug", "building-o" => "Building O", "bullhorn" => "Bullhorn", "bullseye" => "Bullseye", "calendar" => "Calendar", "calendar-o" => "Calendar O", "camera" => "Camera", "camera-retro" => "Camera Retro", "caret-square-o-down" => "Caret Square O Down", "caret-square-o-left" => "Caret Square O Left", "caret-square-o-right" => "Caret Square O Right", "caret-square-o-up" => "Caret Square O Up", "certificate" => "Certificate", "circle" => "Circle", "circle-o" => "Circle O", "clock-o" => "Clock O", "cloud" => "Cloud", "cloud-download" => "Cloud Download", "cloud-upload" => "Cloud Upload", "code" => "Code", "code-fork" => "Code Fork", "coffee" => "Coffee", "cog" => "Cog", "cogs" => "Cogs", "compass" => "Compass", "credit-card" => "Credit Card", "crop" => "Crop", "crosshairs" => "Crosshairs", "cutlery" => "Cutlery", "dashboard" => "Dashboard", "desktop" => "Desktop", "dot-circle-o" => "Dot Circle O", "download" => "Download", "edit" => "Edit", "ellipsis-h" => "Ellipsis H", "ellipsis-v" => "Ellipsis V", "envelope" => "Envelope", "envelope-o" => "Envelope O", "eraser" => "Eraser", "exchange" => "Exchange", "exclamation" => "Exclamation", "exclamation-circle" => "Exclamation Circle", "exclamation-triangle" => "Exclamation Triangle", "external-link" => "External Link", "external-link-square" => "External Link Square", "eye" => "Eye", "eye-slash" => "Eye Slash", "female" => "Female", "fighter-jet" => "Fighter Jet", "film" => "Film", "filter" => "Filter", "fire" => "Fire", "fire-extinguisher" => "Fire Extinguisher", "flag" => "Flag", "flag-checkered" => "Flag Checkered", "flag-o" => "Flag O", "flash" => "Flash", "flask" => "Flask", "folder" => "Folder", "folder-o" => "Folder O", "folder-open" => "Folder Open", "folder-open-o" => "Folder Open O", "frown-o" => "Frown O", "gamepad" => "Gamepad", "gavel" => "Gavel", "gear" => "Gear", "gears" => "Gears", "gift" => "Gift", "glass" => "Glass", "globe" => "Globe", "group" => "Group", "hdd-o" => "Hdd O", "headphones" => "Headphones", "heart" => "Heart", "heart-o" => "Heart O", "home" => "Home", "inbox" => "Inbox", "info" => "Info", "info-circle" => "Info Circle", "key" => "Key", "keyboard-o" => "Keyboard O", "laptop" => "Laptop", "leaf" => "Leaf", "legal" => "Legal", "lemon-o" => "Lemon O", "level-down" => "Level Down", "level-up" => "Level Up", "lightbulb-o" => "Lightbulb O", "location-arrow" => "Location Arrow", "lock" => "Lock", "magic" => "Magic", "magnet" => "Magnet", "mail-forward" => "Mail Forward", "mail-reply" => "Mail Reply", "mail-reply-all" => "Mail Reply All", "male" => "Male", "map-marker" => "Map Marker", "meh-o" => "Meh O", "microphone" => "Microphone", "microphone-slash" => "Microphone Slash", "minus" => "Minus", "minus-circle" => "Minus Circle", "minus-square" => "Minus Square", "minus-square-o" => "Minus Square O", "mobile" => "Mobile", "mobile-phone" => "Mobile Phone", "money" => "Money", "moon-o" => "Moon O", "music" => "Music", "pencil" => "Pencil", "pencil-square" => "Pencil Square", "pencil-square-o" => "Pencil Square O", "phone" => "Phone", "phone-square" => "Phone Square", "picture-o" => "Picture O", "plane" => "Plane", "plus" => "Plus", "plus-circle" => "Plus Circle", "plus-square" => "Plus Square", "plus-square-o" => "Plus Square O", "power-off" => "Power Off", "print" => "Print", "puzzle-piece" => "Puzzle Piece", "qrcode" => "Qrcode", "question" => "Question", "question-circle" => "Question Circle", "quote-left" => "Quote Left", "quote-right" => "Quote Right", "random" => "Random", "refresh" => "Refresh", "reply" => "Reply", "reply-all" => "Reply All", "retweet" => "Retweet", "road" => "Road", "rocket" => "Rocket", "rss" => "Rss", "rss-square" => "Rss Square", "search" => "Search", "search-minus" => "Search Minus", "search-plus" => "Search Plus", "share" => "Share", "share-square" => "Share Square", "share-square-o" => "Share Square O", "shield" => "Shield", "shopping-cart" => "Shopping Cart", "sign-in" => "Sign In", "sign-out" => "Sign Out", "signal" => "Signal", "sitemap" => "Sitemap", "smile-o" => "Smile O", "sort" => "Sort", "sort-alpha-asc" => "Sort Alpha Asc", "sort-alpha-desc" => "Sort Alpha Desc", "sort-amount-asc" => "Sort Amount Asc", "sort-amount-desc" => "Sort Amount Desc", "sort-asc" => "Sort Asc", "sort-desc" => "Sort Desc", "sort-down" => "Sort Down", "sort-numeric-asc" => "Sort Numeric Asc", "sort-numeric-desc" => "Sort Numeric Desc", "sort-up" => "Sort Up", "spinner" => "Spinner", "square" => "Square", "square-o" => "Square O", "star" => "Star", "star-half" => "Star Half", "star-half-empty" => "Star Half Empty", "star-half-full" => "Star Half Full", "star-half-o" => "Star Half O", "star-o" => "Star O", "subscript" => "Subscript", "suitcase" => "Suitcase", "sun-o" => "Sun O", "superscript" => "Superscript", "tablet" => "Tablet", "tachometer" => "Tachometer", "tag" => "Tag", "tags" => "Tags", "tasks" => "Tasks", "terminal" => "Terminal", "thumb-tack" => "Thumb Tack", "thumbs-down" => "Thumbs Down", "thumbs-o-down" => "Thumbs O Down", "ticket" => "Ticket", "times" => "Times", "times-circle" => "Times Circle", "times-circle-o" => "Times Circle O", "tint" => "Tint", "toggle-down" => "Toggle Down", "toggle-left" => "Toggle Left", "toggle-right" => "Toggle Right", "toggle-up" => "Toggle Up", "trash-o" => "Trash O", "trophy" => "Trophy", "truck" => "Truck", "umbrella" => "Umbrella", "unlock" => "Unlock", "unlock-alt" => "Unlock Alt", "unsorted" => "Unsorted", "upload" => "Upload", "user" => "User", "users" => "Users", "video-camera" => "Video Camera", "volume-down" => "Volume Down", "volume-off" => "Volume Off", "volume-up" => "Volume Up", "warning" => "Warning", "wheelchair" => "Wheelchair", "wrench" => "Wrench", "circle" => "Circle", "circle-o" => "Circle O", "dot-circle-o" => "Dot Circle O", "minus-square" => "Minus Square", "minus-square-o" => "Minus Square O", "plus-square" => "Plus Square", "plus-square-o" => "Plus Square O", "square" => "Square", "square-o" => "Square O", "bitcoin" => "Bitcoin", "btc" => "Btc", "cny" => "Cny", "dollar" => "Dollar", "eur" => "Eur", "euro" => "Euro", "gbp" => "Gbp", "inr" => "Inr", "jpy" => "Jpy", "krw" => "Krw", "money" => "Money", "rmb" => "Rmb", "rouble" => "Rouble", "rub" => "Rub", "ruble" => "Ruble", "rupee" => "Rupee", "try" => "Try", "turkish-lira" => "Turkish Lira", "usd" => "Usd", "won" => "Won", "yen" => "Yen", "align-center" => "Align Center", "align-justify" => "Align Justify", "align-left" => "Align Left", "align-right" => "Align Right", "bold" => "Bold", "chain" => "Chain", "chain-broken" => "Chain Broken", "clipboard" => "Clipboard", "columns" => "Columns", "copy" => "Copy", "cut" => "Cut", "dedent" => "Dedent", "eraser" => "Eraser", "file" => "File", "file-o" => "File O", "file-text" => "File Text", "file-text-o" => "File Text O", "files-o" => "Files O", "floppy-o" => "Floppy O", "font" => "Font", "indent" => "Indent", "italic" => "Italic", "link" => "Link", "list" => "List", "list-alt" => "List Alt", "list-ol" => "List Ol", "list-ul" => "List Ul", "outdent" => "Outdent", "paperclip" => "Paperclip", "paste" => "Paste", "repeat" => "Repeat", "rotate-left" => "Rotate Left", "rotate-right" => "Rotate Right", "save" => "Save", "scissors" => "Scissors", "strikethrough" => "Strikethrough", "table" => "Table", "text-height" => "Text Height", "text-width" => "Text Width", "th" => "Th", "th-large" => "Th Large", "th-list" => "Th List", "underline" => "Underline", "undo" => "Undo", "unlink" => "Unlink",  "arrows" => "Arrows", "arrows-alt" => "Arrows Alt", "arrows-h" => "Arrows H", "arrows-v" => "Arrows V", "stop" => "Stop", "youtube-play" => "Youtube Play", "adn" => "Adn", "android" => "Android", "apple" => "Apple", "bitbucket" => "Bitbucket", "bitbucket-square" => "Bitbucket Square", "bitcoin" => "Bitcoin", "btc" => "Btc", "css3" => "Css3", "dribbble" => "Dribbble", "dropbox" => "Dropbox", "facebook" => "Facebook", "facebook-square" => "Facebook Square", "flickr" => "Flickr", "foursquare" => "Foursquare", "github" => "Github", "github-alt" => "Github Alt", "github-square" => "Github Square", "gittip" => "Gittip", "google-plus" => "Google Plus", "google-plus-square" => "Google Plus Square", "html5" => "Html5", "instagram" => "Instagram", "linkedin" => "Linkedin", "linkedin-square" => "Linkedin Square", "linux" => "Linux", "maxcdn" => "Maxcdn", "pagelines" => "Pagelines", "pinterest" => "Pinterest", "pinterest-square" => "Pinterest Square", "renren" => "Renren", "skype" => "Skype", "stack-exchange" => "Stack Exchange", "stack-overflow" => "Stack Overflow", "trello" => "Trello", "tumblr" => "Tumblr", "tumblr-square" => "Tumblr Square", "twitter" => "Twitter", "twitter-square" => "Twitter Square", "vimeo-square" => "Vimeo Square", "vk" => "Vk", "weibo" => "Weibo", "windows" => "Windows", "xing" => "Xing", "xing-square" => "Xing Square", "youtube" => "Youtube", "youtube-play" => "Youtube Play", "youtube-square" => "Youtube Square", "ambulance" => "Ambulance", "h-square" => "H Square", "hospital-o" => "Hospital O", "medkit" => "Medkit", "plus-square" => "Plus Square", "stethoscope" => "Stethoscope", "user-md" => "User Md", "wheelchair" => "Wheelchair");
	$lp_cats = get_transient( 'landing-page-cats' ); // array of landing page categories
	$form_names = get_transient( 'inbound-form-names' ); // array of landing page categories
	$lead_mapping_fields = Leads_Field_Map::build_map_array();
	$lead_list_names = get_transient( 'inbound-list-names' );

	/* Global Inbound Now Shortcodes */
	require_once ('shortcodes/forms.php'); // Form Builder
	require_once ('shortcodes/column.php'); // Columned Layouts
	require_once ('shortcodes/call-to-action.php');
	require_once ('shortcodes/alert.php');
	require_once ('shortcodes/button.php');
	require_once ('shortcodes/lists.php');
	require_once ('shortcodes/social-share.php');
	require_once ('shortcodes/quick-forms.php');

	// Leads only Shortcodes

	// Landing Page Only Shortcodes
	require_once ('shortcodes/landing_pages.php'); // Category specific landing pages

	do_action( 'inbound_shortcode_addon_include' , $form_names ); // Hook into shortcode engine


	// Call to Action Only Shortcodes

	// Landing Pages and CTA Shared Shortcodes

	/* Temporary need Forks */
	/**
	require_once ('shortcodes/callout.php');
	//require_once ('shortcodes/landing-page-list.php'); // ALL Landing page list

	require_once ('shortcodes/content-box.php');
	require_once ('shortcodes/divider.php');


	require_once ('shortcodes/gmap.php');

	require_once ('shortcodes/icon.php');
	require_once ('shortcodes/intro.php');
	require_once ('shortcodes/leadp.php');
	require_once ('shortcodes/list-icon.php');

	require_once ('shortcodes/pricing.php');
	require_once ('shortcodes/profile.php');
	require_once ('shortcodes/social.php');
	require_once ('shortcodes/tabs.php');
	require_once ('shortcodes/teaser.php');
	//require_once ('shortcodes/testimonial.php'); // add custom testimonials
	//require_once ('shortcodes/video.php'); // Add trackable video
*/
/**
 * 	Fix issues when shortcodes are embedded in a block of content that is filtered by wpautop.
 * 	http://www.johannheyne.de
 * 	----------------------------------------------------- */
	if (!function_exists('inbound_shortcode_empty_paragraph_fix')) {
		function inbound_shortcode_empty_paragraph_fix($content){
			$array = array (
				'<p>[' => '[',
				']</p>' => ']',
				']<br />' => ']'
			);

			$content = strtr($content, $array);

			return $content;
		}
	}

	add_filter('the_content', 'inbound_shortcode_empty_paragraph_fix');
	add_filter( 'widget_text', 'do_shortcode', 11);
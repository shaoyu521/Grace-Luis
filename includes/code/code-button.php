<?php
/*
代码高亮
*/

if (in_array($pagenow, array('post.php', 'post-new.php', 'page.php', 'page-new.php'))) {
	add_action('init', 'zmgcp_addbuttons');
}

function zmgcp_addbuttons() {
	// Add only in Rich Editor mode
	if (get_user_option('rich_editing') == 'true') {
		// add the button for wp25 in a new way
		add_filter("mce_external_plugins", "add_zmgcp_tinymce_plugin", 5);
		add_filter('mce_buttons', 'register_zmgcp_button', 5);
	}
}

// used to insert button in wordpress 2.5x editor
function register_zmgcp_button($buttons) {
	array_push($buttons, "separator", "zmgcp");
	return $buttons;
}

// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function add_zmgcp_tinymce_plugin($plugin_array){
	$plugin_array['zmgcp'] = get_template_directory_uri() . '/includes/code/editor-plugin.js';
	return $plugin_array;
}

function prettify_script() {
	if(is_singular()){
		wp_enqueue_style( 'prettify', get_template_directory_uri() . '/includes/code/prettify.css', array(), version );
		wp_enqueue_script( 'prettify', get_template_directory_uri() . '/includes/code/prettify.js', array(), version, true );
	}
}
add_action('wp_enqueue_scripts', 'prettify_script');
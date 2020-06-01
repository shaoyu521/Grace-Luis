<?php
///删除 wp_head 中无关紧要的代码
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'locale_stylesheet' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('rest_pre_serve_request', '_oembed_rest_pre_serve_request', 10, 4);
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10 );
remove_filter('oembed_response_data',   'get_oembed_response_data_rich',  10, 4);
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
remove_action( 'wp_footer', 'wp_print_footer_scripts' );
remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
remove_filter( 'the_title', 'capital_P_dangit' );
remove_filter( 'the_content', 'capital_P_dangit' );
remove_filter( 'the_content', 'wptexturize');
remove_filter( 'comment_text', 'capital_P_dangit' );
remove_action('admin_print_scripts',    'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_action('wp_head',        'print_emoji_detection_script', 7);
remove_action('wp_print_styles',    'print_emoji_styles');
remove_action('embed_head',     'print_emoji_detection_script');
remove_filter('the_content_feed',   'wp_staticize_emoji');
remove_filter('comment_text_rss',   'wp_staticize_emoji');
remove_filter('wp_mail',        'wp_staticize_emoji_for_email');
add_filter( 'emoji_svg_url',        '__return_false' );
add_filter( 'show_admin_bar', '__return_false' );
remove_action('wp_head', 'adjacent_posts_rel_link');
add_filter('xmlrpc_enabled', '__return_false');
add_filter('rest_enabled', '__return_false');
add_filter('rest_jsonp_enabled', '__return_false');
remove_action('template_redirect', 'rest_output_link_header', 11 );
function remove_footer_admin () {
    echo '感谢选择 <a href="http://www.lurbk.com" target="_blank">ShaoYu & Lur stem</a> 为您设计！</p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');
?>
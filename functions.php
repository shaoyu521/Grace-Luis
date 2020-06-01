<?php

date_default_timezone_set('PRC');
define('THEME_VERSION', 'Grace-Luis');
define('THEME_URI', get_stylesheet_directory_uri());
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
require_once get_template_directory() . '/inc/options-framework.php';
require get_template_directory() . '/includes/pagemetabox.php';
require get_template_directory() . '/includes/widgets/index.php';
require get_template_directory() . '/functions_suxingme.php';
require get_template_directory() . '/includes/modules/categories-images.php';
require get_template_directory() . '/includes/meta/metabox.php';
require get_template_directory() . '/ajax-comment/do.php';
require get_template_directory() . '/includes/modules/comments.php';
require get_template_directory() . '/includes/modules/canonical.php';
require get_template_directory() . '/includes/wp-alu/functions.php';
require get_template_directory() . '/includes/modules/breadcrumbs.php';
require get_template_directory() . '/includes/code/code-button.php';
require_once dirname( __FILE__ ) . '/includes/sitemap.php';
require_once dirname( __FILE__ ) . '/includes/tool.php';
add_editor_style( '/includes/css/editor-style.css' );
if (suxingme('suxingme_post_like', !0)) {
	include_once get_template_directory() . '/includes/modules/like.php';
}
if (suxingme('friendly', !0)) {
	include_once get_template_directory() . '/includes/modules/friendlyimages.php';
}
if (suxingme('suxingme_keywordlink', !1)) {
	include_once get_template_directory() . '/includes/modules/keywordlink.php';
}
if (suxingme('suxingme_fancybox', !1)) {
	include_once get_template_directory() . '/includes/modules/fancybox.php';
}
if (suxingme('suxingme_autonofollow', !1)) {
	include_once get_template_directory() . '/includes/modules/autonofollow.php';
}
if (suxingme('suxingme_wphead', !0)) {
	include_once get_template_directory() . '/includes/modules/wphead.php';
}
if (suxingme('suxingme_ajax_posts', !0)) {
	include_once get_template_directory() . '/includes/modules/ajaxpost.php';
}
function remove_open_sans()
{
	wp_deregister_style('open-sans');
	wp_register_style('open-sans', !1);
	wp_enqueue_style('open-sans', '');
}
add_action('init', 'remove_open_sans');
register_nav_menu('top-nav', '导航菜单');
register_nav_menu('mobile-nav', '移动端菜单');
register_nav_menu('footer-nav', '底部菜单');
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($_var_12)
{
	return is_array($_var_12) ? array_intersect($_var_12, array('current-menu-item', 'current-post-ancestor', 'current-menu-ancestor', 'current-menu-parent', 'menu-item-has-children')) : '';
}
if (function_exists('register_sidebar')) {
	register_sidebar(array('name' => '全站侧栏', 'id' => 'widget_right', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3><span>', 'after_title' => '</span></h3>'));
	register_sidebar(array('name' => '首页侧栏', 'id' => 'widget_sidebar', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3><span>', 'after_title' => '</span></h3>'));
	register_sidebar(array('name' => '文章页侧栏', 'id' => 'widget_post', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3><span>', 'after_title' => '</span></h3>'));
	register_sidebar(array('name' => '页面侧栏', 'id' => 'widget_page', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3><span>', 'after_title' => '</span></h3>'));
	register_sidebar(array('name' => '分类/标签/搜索页侧栏', 'id' => 'widget_other', 'before_widget' => '<div class="widget %2$s">', 'after_widget' => '</div>', 'before_title' => '<h3><span>', 'after_title' => '</span></h3>'));
}
add_action('media_buttons_context', 'mee_insert_post_custom_button');
function mee_insert_post_custom_button($_var_13)
{
	$_var_13 .= '<button type="button" id="insert-media-button" class="button insert-post-embed" data-editor="content"><span class="dashicons dashicons-pressthis"></span>插入指定文章</button><div class="smilies-wrap"></div><script>jQuery(document).ready(function(){jQuery(document).on("click", ".insert-post-embed",function(){var post_id=prompt("输入文章ID，多个文章，使用英文逗号隔开","");if (post_id!=null && post_id!=""){send_to_editor("[suxing_insert_post ids="+ post_id +"]");}return false;});});</script>';
	return $_var_13;
}
function suxingme_head_css()
{
	$_var_14 = '';
	if (suxingme('suxingme_site_gray')) {
		$_var_14 .= '
		            html{overflow-y:scroll;filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(100%);}';
	}
	if (suxingme('theme_skin_custom')) {
		$_var_15 = suxingme('theme_skin_custom');
		$_var_16 = $_var_15;
	} else {
		$_var_15 = suxingme('theme_skin');
		$_var_16 = '#' . $_var_15;
	}
	if ($_var_15 && $_var_15 !== '19B5FE' && suxingme('suxingme_site_gray_turn')) {
		$_var_14 .= "
		            #top-slide .owl-item .slider-content .post-categories a,
		            #top-slide .owl-item .slider-content .slider-titleh2:after,
		            #top-slide .owl-item .slider-content .read-more a:hover,
		            .posts-default-title h2:after,
		            #ajax-load-posts a, #ajax-load-posts span, 
		            #ajax-load-posts button,.post-title .title:after,#commentform .form-submit input[type='submit'],
		            .tag-clouds .tagname:hover,
		            .cat ul li .title span,
		            #top-slide-three .slider-content .slider-content-box .slider-content-item .post-categories a{background-color:{$_var_16};}
		            a:hover,.authors_profile .author_name a{color:{$_var_16};}
		            #ajax-load-posts a:hover,#ajax-load-posts button:hover{background-color:#273746}
		            #header .search-box form button:hover, 
		            #header .primary-menu ul > li > a:hover, 
		            #header .primary-menu ul > li:hover > a, 
		            #header .primary-menu ul > li.current-menu-ancestor > a, 
		            #header .primary-menu ul > li.current-menu-item > a, 
		            #header .primary-menu ul > li .sub-menu li.current-menu-item > a, 
		            #header .primary-menu ul > li .sub-menu li a:hover, #menu-mobile a:hover{color:{$_var_16};}
		            @media screen and (max-width: 767px){
		                #header .search-box form button{background-color:{$_var_16};}
		            }
		            .comment-form-smilies .smilies-box a:hover{border-color:{$_var_16}}
		        ";
	}
	$_var_14 .= suxingme('csscode');
	if ($_var_14) {
		echo '<style>' . $_var_14 . '</style>';
	}
}
add_action('wp_head', 'suxingme_head_css');
function get_links_category()
{
	$_var_17 = get_terms('link_category');
	$_var_18 .= '<div class="show-links-id"><p>相关的链接分类ID：</p><ul>';
	foreach ($_var_17 as $_var_19 => $_var_20) {
		$_var_18 .= '<li>' . $_var_20->name . '（' . $_var_20->term_id . '）</li>';
	}
	$_var_18 .= '</ul></div>';
	return $_var_18;
}
function suxingme_add_page($_var_21, $_var_22, $_var_23 = '')
{
	$_var_24 = get_pages();
	$_var_25 = !1;
	foreach ($_var_24 as $_var_26) {
		if (strtolower($_var_26->post_name) == strtolower($_var_22)) {
			$_var_25 = !0;
		}
	}
	if ($_var_25 == !1) {
		$_var_27 = wp_insert_post(array('post_title' => $_var_21, 'post_type' => 'page', 'post_name' => $_var_22, 'comment_status' => 'closed', 'ping_status' => 'closed', 'post_content' => '', 'post_status' => 'publish', 'post_author' => 1, 'menu_order' => 0));
		if ($_var_27 && $_var_23 != '') {
			update_post_meta($_var_27, '_wp_page_template', $_var_23);
		}
	}
}
function suxingme_add_pages()
{
	global $pagenow;
	if ('themes.php' == $pagenow && isset($_GET['activated'])) {
		suxingme_add_page('热门标签', 'tags-page', 'pages/page-tags.php');
		suxingme_add_page('友情链接', 'links-page', 'pages/page-links.php');
		suxingme_add_page('年度归档', 'archives-page', 'pages/page-archives.php');
		suxingme_add_page('人气文章排行榜', 'like-page', 'pages/page-like.php');
		suxingme_add_page('投稿', 'contribute-page', 'pages/page-contribute.php');
	}
}
add_action('load-themes.php', 'suxingme_add_pages');
add_theme_support('post-formats', array('gallery', 'aside', 'image', 'link'));
function rename_post_formats($_var_28)
{
	if ($_var_28 == '相册') {
		return '左图模版';
	}
	if ($_var_28 == '图像') {
		return '多图模版';
	}
	if ($_var_28 == '日志') {
		return '无图模版';
	}
	if ($_var_28 == '链接') {
		return '推广模版';
	}
	return $_var_28;
}
add_filter('esc_html', 'rename_post_formats');
add_action('wp_head', 'wow_duang');
function wow_duang()
{
	$GLOBALS['wow_single_list'] = '';
	if (is_category() || is_home() || is_search() || is_author()) {
		if (suxingme('suxing_wow_single_list', !0)) {
			$GLOBALS['wow_single_list'] = 'wow fadeInUp';
		}
	}
	if (is_single() || is_page()) {
		if (function_exists('get_query_var')) {
			$_var_29 = intval(get_query_var('page'));
			$_var_30 = intval(get_query_var('comment-page'));
		}
		if (!empty($_var_29) || !empty($_var_30)) {
			echo '
			';
			echo '<meta name="robots" content="noindex, nofollow" />';
			echo '
			';
		}
	}
}
add_filter('user_contactmethods', 'suxingme_add_contact_fields');
function suxingme_add_contact_fields($_var_31)
{
	$_var_31['alipay'] = '支付宝二维码图片链接';
	$_var_31['wxpay'] = '微信二维码图片链接';
	return $_var_31;
}
add_filter('get_avatar', 'sutheme_avatar', 10, 3);
function sutheme_avatar($_var_32)
{
	if (!is_admin() && suxingme('suxingme_timthumb_lazyload', !0) || $_SERVER['PHP_SELF'] == '/wp-admin/admin-ajax.php' && suxingme('suxingme_timthumb_lazyload', !0)) {
		$_var_32 = str_replace('src=', 'src="' . suxingme('new_avatar_pic') . '" data-original=', $_var_32);
	}
	if (suxingme('suxingme_get_avatar', 'two') == 'two') {
		$_var_32 = str_replace(array('www.gravatar.com/avatar', '0.gravatar.com/avatar', '1.gravatar.com/avatar', '2.gravatar.com/avatar'), 'cdn.v2ex.com/gravatar', $_var_32);
	}
	return $_var_32;
}
function tizipu_ad($_var_33)
{
	$_var_33 = '您可以在<a href="https://cn.gravatar.com/">Gravatar</a>修改您的资料图片。<br>当然这是需要翻墙才可以访问的：<a target="_blank" href="https://www.tizipu.net/?grace">点我购买翻墙加速服务【站长必备】</a>';
	return $_var_33;
}
add_filter('user_profile_picture_description', 'tizipu_ad', 10, 1);
function cc_avatar()
{
	global $post;
	$_var_35 = get_post_meta($post->ID, 'cus_avatar', !0);
	$_var_36 = !$_var_35 ? suxingme('new_avatar_pic') : $_var_35;
	if (!is_admin() && suxingme('suxingme_timthumb_lazyload', !0)) {
		$_var_37 = '<img alt="" src="' . suxingme('new_avatar_pic') . '" data-original="' . $_var_36 . '" class="avatar avatar-96 photo" height="96" width="96">';
	} else {
		$_var_37 = '<img alt="" src="' . $_var_36 . '" class="avatar avatar-96 photo" height="96" width="96">';
	}
	return $_var_37;
}
add_action('wp_ajax_nopriv_do_upimg', 'do_upimg');
add_action('wp_ajax_do_upimg', 'do_upimg');
function do_upimg()
{
	if (isset($_POST['_suxingnonce']) && wp_verify_nonce($_POST['_suxingnonce'], 'do-contribute')) {
		if (!function_exists('wp_handle_upload')) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}
		$_var_38 = file_type($_FILES['image']['tmp_name']);
		if ($_var_38 == 'jpg' || $_var_38 == 'png' || $_var_38 == 'gif') {
			$_var_39 = $_FILES['image'];
			$_var_39['name'] = 'su-' . time() . '.' . $_var_38;
			$_var_40 = array('test_form' => !1);
			$_var_41 = wp_handle_upload($_var_39, $_var_40);
			if ($_var_41 && !isset($_var_41['error'])) {
				$_var_42 = array('status' => 1, 'url' => $_var_41['url'], 'file_type' => $_var_38);
			} else {
				$_var_42 = array('status' => 0, 'info' => '上传失败，请稍后在试！');
			}
		} else {
			$_var_42 = array('status' => 0, 'info' => '上传失败，只允许上传 .jpg .png .gif 类型的图片文件！');
		}
	} else {
		$_var_42 = array('status' => 0, 'info' => '非法请求！');
	}
	echo json_encode($_var_42);
	die;
}
add_action('wp_ajax_nopriv_do_contribute', 'do_contribute');
add_action('wp_ajax_do_contribute', 'do_contribute');
function do_contribute()
{
	SESSION_START();
	if (isset($_POST['_suxingnonce']) && wp_verify_nonce($_POST['_suxingnonce'], 'do-contribute')) {
		if (!isset($_SESSION['last_access']) || time() - $_SESSION['last_access'] > 120) {
			$_var_43 = isset($_POST['name']) ? $_POST['name'] : NULL;
			$_var_44 = isset($_POST['source']) ? $_POST['source'] : NULL;
			$_var_45 = isset($_POST['email']) ? $_POST['email'] : NULL;
			if (isset($_POST['cats'])) {
				foreach ($_POST['cats'] as $_var_46) {
					if (!empty($_var_46)) {
						$_var_47[] = htmlspecialchars($_var_46);
					}
				}
			}
			$_var_48 = '';
			$_var_49 = array('ID' => $_var_48, 'post_title' => htmlspecialchars($_POST['title']), 'post_content' => $_POST['post_content'], 'post_status' => 'pending', 'post_type' => 'post', 'post_category' => $_var_47);
			$_var_50 = wp_insert_post($_var_49);
			if ($_var_50) {
				if ($_var_43 && $_var_44 && $_var_45) {
					if (!update_post_meta($_var_50, 'cus_author_name', $_var_43)) {
						add_post_meta($_var_50, 'cus_author_name', $_var_43, !0);
					}
					if (!update_post_meta($_var_50, 'other_posturl', $_var_44)) {
						add_post_meta($_var_50, 'other_posturl', $_var_44, !0);
					}
					if (!update_post_meta($_var_50, 'contribute_email', $_var_45)) {
						add_post_meta($_var_50, 'contribute_email', $_var_45, !0);
					}
				}
				$_SESSION['last_access'] = time();
				$_var_51 = array('status' => 1, 'post_id' => $_var_50, 'info' => '提交成功！');
			} else {
				$_var_51 = array('status' => 0, 'post_id' => $_var_50, 'info' => '提交失败，请稍后再试！');
			}
		} else {
			$_var_51 = array('status' => 0, 'info' => '请勿再短时间内重复提交！等2分钟再试一试吧~');
		}
	} else {
		$_var_51 = array('status' => 0, 'info' => '非法请求！');
	}
	echo json_encode($_var_51);
	die;
}
if (!function_exists('file_type')) {
	function file_type($_var_52)
	{
		$_var_53 = fopen($_var_52, 'rb');
		$_var_54 = fread($_var_53, 2);
		fclose($_var_53);
		$_var_55 = @unpack('C2chars', $_var_54);
		$_var_56 = intval($_var_55['chars1'] . $_var_55['chars2']);
		$_var_57 = '';
		switch ($_var_56) {
			case 7790:
				$_var_57 = 'exe';
				break;
			case 7784:
				$_var_57 = 'midi';
				break;
			case 8297:
				$_var_57 = 'rar';
				break;
			case 8075:
				$_var_57 = 'zip';
				break;
			case 255216:
				$_var_57 = 'jpg';
				break;
			case 7173:
				$_var_57 = 'gif';
				break;
			case 6677:
				$_var_57 = 'bmp';
				break;
			case 13780:
				$_var_57 = 'png';
				break;
			default:
				$_var_57 = 'unknown: ' . $_var_56;
		}
		if ($_var_55['chars1'] == '-1' && $_var_55['chars2'] == '-40') {
			return 'jpg';
		}
		if ($_var_55['chars1'] == '-119' && $_var_55['chars2'] == '80') {
			return 'png';
		}
		return $_var_57;
	}
}
function save_no_email_post($_var_58)
{
	$_var_59 = get_post_meta($_var_58, 'contribute_email', !0);
	$_var_60 = suxingme('contribute_no_content', '您在' . get_bloginfo('name') . '的投稿被发布啦');
	if (!empty($_var_59) && $_var_59 != NULL) {
		wp_mail($_var_59, $_var_60, $_var_60);
	}
}
add_action('save_post', 'save_no_email_post');
//微语
add_action('init', 'my_custom_init');
function my_custom_init()
{ $labels = array( 'name' => '微语',
'singular_name' => '微语',
'add_new' => '发表微语',
'add_new_item' => '发表微语',
'edit_item' => '编辑微语',
'new_item' => '新微语',
'view_item' => '查看微语',
'search_items' => '搜索微语',
'not_found' => '暂无微语',
'not_found_in_trash' => '没有已遗弃的微语',
'parent_item_colon' => '', 'menu_name' => '微语' );
$args = array( 'labels' => $labels,
'public' => true,
'publicly_queryable' => true,
'show_ui' => true,
'show_in_menu' => true,
'exclude_from_search' =>true,
'query_var' => true,
'rewrite' => true, 'capability_type' => 'post',
'has_archive' => false, 'hierarchical' => false,
'menu_position' => null,
'taxonomies'=> array('category','post_tag'),
'supports' => array('editor','author','title', 'custom-fields','comments') );
register_post_type('shuoshuo',$args);
}
	// 禁用古藤堡编辑器
	add_filter('use_block_editor_for_post', '__return_false');
    remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );
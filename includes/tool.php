<?php
	//百度收录检测
	function checkBaidu($url) { 
    $url = 'http://www.baidu.com/s?wd=' . urlencode($url); 
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL, $url); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
    $rs = curl_exec($curl); 
    curl_close($curl); 
    if (!strpos($rs, '没有找到')) {
        return '已收录'; 
    } else { 
        return '未收录'; 
    } 
	}
    // 百度主动推送
	if(!function_exists('Baidu_Submit')){
	 function Baidu_Submit($post_ID) {
	$WEB_DOMAIN = suxingme('Baidu_Submit'); //这里请换成你的网站的百度主动推送的token值
	$WEB_DOMAIN = get_option('home');
	//已成功推送的文章不再推送
	if(get_post_meta($post_ID,'Baidusubmit',true) == 1) return;
	$url = get_permalink($post_ID);
	$api = 'http://data.zz.baidu.com/urls?site='.$WEB_DOMAIN.'&token='.$WEB_TOKEN;
	$request = new WP_Http;
	$result = $request->request( $api , array( 'method' => 'POST', 'body' => $url , 'headers' => 'Content-Type: text/plain') );
	$result = json_decode($result['body'],true);
	//如果推送成功则在文章新增自定义栏目Baidusubmit，值为1
	if (array_key_exists('success',$result)) {
	add_post_meta($post_ID, 'Baidusubmit', 1, true);
	}
	}
	add_action('publish_post', 'Baidu_Submit', 0);
	}
	//熊掌id自动推送
	if(!function_exists('Baidu_XZH_Submit')){
    function Baidu_XZH_Submit($post_ID) {
        //已成功推送的文章不再推送
        if(get_post_meta($post_ID,'BaiduXZHsubmit',true) == 1) return;
		$APPID = 
		$TOKEN = 
        $url = get_permalink($post_ID);
        $api = 'http://data.zz.baidu.com/urls?appid='.$APPID.'&token='.$TOKEN.'&type=realtime';
        $request = new WP_Http;
        $result = $request->request( $api , array( 'method' => 'POST', 'body' => $url , 'headers' => 'Content-Type: text/plain') );
        $result = json_decode($result['body'],true);
        //如果推送成功则在文章新增自定义栏目BaiduXZHsubmit，值为1
        if (array_key_exists('success',$result)) {
            add_post_meta($post_ID, 'BaiduXZHsubmit', 1, true);
        }
    }
    add_action('publish_post', 'Baidu_XZH_Submit', 0);
}
	if( suxingme('yemin_html',false) ) :
    // 页面链接添加html后缀
    add_action('init', 'html_page_permalink', -1);
    function html_page_permalink() {
        global $wp_rewrite;
        if ( !strpos($wp_rewrite->get_page_permastruct(), '.html')){
            $wp_rewrite->page_structure = $wp_rewrite->page_structure . '.html';
        }
    }
    // 添加斜杠
    function nice_trailingslashit($string, $type_of_url) {
        if ( $type_of_url != 'single' && $type_of_url != 'page' )
          $string = trailingslashit($string);
        return $string;
    }
    add_filter('user_trailingslashit', 'nice_trailingslashit', 10, 2);
    endif;
    // 取文章第一个图片 作为缩略图
	function catch_that_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];
	if(empty($first_img)){ //Defines a default image
	$first_img = "/images/default.jpg";
	}
	return $first_img;
	}
if( suxingme('wuguanhanshu',false) ) :
remove_action( ‘wp_head’, ‘wp_enqueue_scripts’, 1 );
remove_action( ‘wp_head’, ‘feed_links’, 2 );
remove_action( ‘wp_head’, ‘feed_links_extra’, 3 );
remove_action( ‘wp_head’, ‘rsd_link’ );
remove_action( ‘wp_head’, ‘wlwmanifest_link’ );
remove_action( ‘wp_head’, ‘index_rel_link’ );
remove_action(‘wp_head’, ‘parent_post_rel_link’, 10, 0 );
remove_action(‘wp_head’, ‘start_post_rel_link’, 10, 0 );
remove_action( ‘wp_head’, ‘adjacent_posts_rel_link_wp_head’, 10, 0 );
remove_action( ‘wp_head’, ‘locale_stylesheet’ );
remove_action(‘publish_future_post’,’check_and_publish_future_post’,10, 1 );
remove_action( ‘wp_head’, ‘noindex’, 1 );
remove_action( ‘wp_head’, ‘wp_print_styles’, 8 );
remove_action( ‘wp_head’, ‘wp_print_head_scripts’, 9 );
remove_action( ‘wp_head’, ‘wp_generator’ );
remove_action( ‘wp_head’, ‘rel_canonical’ );
remove_action( ‘wp_footer’, ‘wp_print_footer_scripts’ );
remove_action( ‘wp_head’, ‘wp_shortlink_wp_head’, 10, 0 );
remove_action( ‘template_redirect’, ‘wp_shortlink_header’, 11, 0 );
add_action(‘widgets_init’, ‘my_remove_recent_comments_style’);
function my_remove_recent_comments_style() {
global $wp_widget_factory;
remove_action(‘wp_head’, array($wp_widget_factory->widgets[‘WP_Widget_Recent_Comments’] ,’recent_comments_style’));
}
if ( !is_admin() ) {
function my_init_method() {
wp_deregister_script( ‘jquery’ );
}
add_action(‘init’, ‘my_init_method’);
}
wp_deregister_script( ‘l10n’ );
endif;

if( suxingme('qiantaiyasuo',false) ) :
    //压缩 WordPress 前端 html 代码 
    function wp_compress_html(){
        function wp_compress_html_main ($buffer){
            $initial=strlen($buffer);
            $buffer=explode("<!--wp-compress-html-->", $buffer);
            $count=count ($buffer);
            for ($i = 0; $i <= $count; $i++){
                if (stristr($buffer[$i], '<!--wp-compress-html no compression-->')) {
                    $buffer[$i]=(str_replace("<!--wp-compress-html no compression-->", " ", $buffer[$i]));
                } else {
                    $buffer[$i]=(str_replace("\t", " ", $buffer[$i]));
                    $buffer[$i]=(str_replace("\n\n", "\n", $buffer[$i]));
                    $buffer[$i]=(str_replace("\n", "", $buffer[$i]));
                    $buffer[$i]=(str_replace("\r", "", $buffer[$i]));
                    while (stristr($buffer[$i], '  ')) {
                        $buffer[$i]=(str_replace("  ", " ", $buffer[$i]));
                    }
                }
                $buffer_out.=$buffer[$i];
            }
            $final=strlen($buffer_out);
            $savings=($initial-$final)/$initial*100;
            $savings=round($savings, 2);
            $buffer_out.="\n<!--Grace-Luis主题代码压缩:压缩前的大小: $initial bytes; 压缩后的大小: $final bytes; 节约：$savings% -->";
        return $buffer_out;
    }
    //WordPress 后台不压缩
    if ( !is_admin() ) {
            ob_start("wp_compress_html_main");
        }
    }
    add_action('init', 'wp_compress_html');
    //当检测到文章内容中有代码标签时文章内容不会被压缩
    function unCompress($content) {
        if(preg_match_all('/(crayon-|<\/pre>)/i', $content, $matches)) {
            $content = '<!--wp-compress-html--><!--wp-compress-html no compression-->'.$content;
            $content.= '<!--wp-compress-html no compression--><!--wp-compress-html-->';
        }
        return $content;
    }
    add_filter( "the_content", "unCompress");
endif;
//自动添加图片 alt 和 title 属性
    function image_alttitle( $imgalttitle ){
            global $post;
            $category = get_the_category();
            $flname=$category[0]->cat_name;
            $btitle = get_bloginfo();
            $imgtitle = $post->post_title;
            $imgUrl = "<img\s[^>]*src=(\"??)([^\" >]*?)\\1[^>]*>";
            if(preg_match_all("/$imgUrl/siU",$imgalttitle,$matches,PREG_SET_ORDER)){
                    if( !empty($matches) ){
                            for ($i=0; $i < count($matches); $i++){
                                    $tag = $url = $matches[$i][0];
                                    $j=$i+1;
                                    $judge = '/title=/';
                                    preg_match($judge,$tag,$match,PREG_OFFSET_CAPTURE);
                                    if( count($match) < 1 )
                                    $altURL = ' alt="'.$imgtitle.' '.$flname.' 第'.$j.'张" title="'.$imgtitle.' '.$flname.' 第'.$j.'张-'.$btitle.'" ';
                                    $url = rtrim($url,'>');
                                    $url .= $altURL.'>';
                                    $imgalttitle = str_replace($tag,$url,$imgalttitle);
                            }
                    }
            }
            return $imgalttitle;
    }
    add_filter( 'the_content','image_alttitle');
    if( suxingme('suxingme_post_biaoqian',false) ) :
    //自动为文章添加标签
    add_action('save_post', 'auto_add_tags');
    function auto_add_tags(){
        $tags = get_tags( array('hide_empty' => false) );
        $post_id = get_the_ID();
        $post_content = get_post($post_id)->post_content;
        if ($tags) {
            foreach ( $tags as $tag ) {
                if ( strpos($post_content, $tag->name) !== false)
                    wp_set_post_tags( $post_id, $tag->name, true );
            }
        }
    }
    endif;
    //引入相册
	@include(TEMPLATEPATH.'/ikmoe-functions.php');
?>
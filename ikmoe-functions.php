<?php
function exclude_category_home( $query ) {  
    if ( $query->is_home ) {

        $ikmoe_c= suxingme('xcid1');//请写上ikmoe_b的分类ID，并且有个负数符号“-” 

        $query->set( 'cat', $ikmoe_c);   
    }  
    return $query;  
}
   
add_filter( 'pre_get_posts', 'exclude_category_home' ); 

if(!function_exists('pagination')){
    function pagination($page = 2){
        global $wp_query;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        $total = $wp_query->max_num_pages;
        if ($total == 1) return;
        if ($current > 1) $links .= '<a href="' . esc_url(get_pagenum_link($current - 1)) . '" class="prev">上一页</a>';
        if ($current > $page + 1) $links .= page_link(1, 1);
        if ($current > $page + 2) $links .= '<span class="dot">...</span>';
        for($i = $current - $page; $i <= $current + $page; $i++ ) {
            if ($i > 0 && $i <= $total) $i == $current ? $links .= '<span class="num cur">'.$i.'</span>' : $links .= page_link($i, $i);
        }
        if ($current < $total - $page - 1) $links .= '<span class="dot">...</span>';
        if ($current < $total - $page) $links .= page_link( $total, $total);
        if ($current < $total) $links .= '<a href="' . esc_url(get_pagenum_link($current + 1)) . '" class="next">下一页</a>';
        echo $links;
    }
    function page_link($page, $num) {
        return '<a href="' . esc_url(get_pagenum_link($page)) . '" class="num">'.$num.'</a>';
    }
}

function ikmoe_img_src() {
global $post, $posts;
$first_img = '';
ob_start();
ob_end_clean();
$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
$first_img = $matches [1] [0];
if(empty($first_img)){ 
$first_img = "ikmoe.png//不存在的";
}
return $first_img;
}

?>
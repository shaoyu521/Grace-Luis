<?php

//ajax post by weiwei
function fa_make_post_section(){
    global $post;

    if( suxingme('suxing_wow_single_list',true) ){
        $GLOBALS['wow_single_list'] = 'wow fadeInUp';
    }

    $target='';
    $image='';
    $excerpt='';
    $excerpt2='';
    $cate='';
    $post_section ='';
    $post_html = '';
    $category = get_the_category();
    if( suxingme('suxingme_post_target')) { $target='target="_blank"';}
    $excerpt = wp_trim_words(get_the_excerpt(), 100 );
    $excerpt2 = wp_trim_words(get_the_excerpt(), 60 );
    if($category[0]){
        $cate='<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';
    }

    if( get_post_meta($post->ID,'suxing_ding',true) ){ $ding_num = get_post_meta($post->ID,'suxing_ding',true); } else { $ding_num =  '0';}

    $metainfo = suxingme('single_metainfo');
    $dis_author = $metainfo['author'];
    $dis_cat  = $metainfo['cat'];
    $dis_time = $metainfo['time'];
    $dis_view = $metainfo['view'];
    $dis_like = $metainfo['like'];
    $cc_value = get_post_meta($post->ID,"cc_value",true );
    if( $dis_author == 1 ){
        if( $cc_value != 2 && $cc_value != 3 ){
            $post_html .= '<li class="post-author hidden-xs hidden-sm"><div class="avatar">'. get_avatar( get_the_author_meta('ID') ).'</div><a href="'. get_author_posts_url( get_the_author_meta( 'ID' ) ). '" target="_blank">'. get_the_author() .'</a></li>'; 
       }
        
    }
    if( $cc_value == 1 ){
        $post_html .= '<li class="postoriginal hidden-xs hidden-sm"><span><i class="icon-cc-1"></i>'.suxingme('suxingme_custom_cc').'</span></li>';
    }
    if( $dis_cat == 1 ){
        $post_html .= '<li class="ico-cat"><i class="icon-list"></i>  '.$cate.'</li>';
    }
    if( $dis_time == 1 ){
        $post_html .= '<li class="ico-time"><i class="icon-clock-1"></i> '.timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ).'</li>';
    }
    if( $dis_view == 1 ){
        $post_html .= '<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> '.post_views('','',0).'</li>';
    }
    if( $dis_like == 1 ){
        $post_html .= '<li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> '.$ding_num.'</li>';
    }

    if( has_post_format( 'gallery' ) ){

        if( suxingme('suxingme_timthumb') && suxingme('suxingme_timthumb_lazyload',true) ) { 
            $image ='<img class="lazy thumbnail" data-original="'. get_template_directory_uri() .'/timthumb.php?src='.post_thumbnail_src().'&h=173.98&w=231.98&zc=1" src="'.constant("THUMB_SMALL_DEFAULT").'" alt="'. get_the_title().'" />';   
        }
        if ( suxingme('suxingme_timthumb') && !suxingme('suxingme_timthumb_lazyload',true) ) {

            $image ='<img class="thumbnail" src="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=173.98&w=231.98&zc=1" alt="' . get_the_title() . '" />';

        } if( suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb') ){
           $image ='<img src="'.constant("THUMB_SMALL_DEFAULT").'" data-original="'.post_thumbnail_src().'" alt="'. get_the_title().'" class="lazy thumbnail" />';
        } 
        if( !suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb')){
            $image ='<img src="'.post_thumbnail_src().'" alt="'. get_the_title().'" class="thumbnail" />';
        }

        $post_section ='
            <li class="ajax-load-con content '.$GLOBALS['wow_single_list'].'">
                <div class="content-box posts-gallery-box">
                    <div class="posts-gallery-img">
                        <a href="'.get_permalink().'" title="'.get_the_title().'" '.$target.'>  
                            '.$image.'
                        </a> 
                    </div>
                    <div class="posts-gallery-content">
                        <h2 class="posts-gallery-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '" '.$target.'>'.get_the_title().'</a></h2>  
                       <div class="posts-gallery-text">'.$excerpt2.'</div>
                        <div class="posts-default-info posts-gallery-info">
                            <ul>
                                '.$post_html.'
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        ';
    }
    else if ( has_post_format( 'image' )) { //多图 
        $post_section .= '<li class="ajax-load-con content '.$GLOBALS['wow_single_list'].'"><div class="content-box posts-image-box"><div class="posts-default-title">';
        if (suxingme('suxingme_post_tags',true)) { 
            $posttags = get_the_tags();
            if ($posttags) {
                $post_section .='<div class="post-entry-categories">';
                foreach($posttags as $tag) {
                    $post_section .= '<a href="'.get_tag_link($tag->term_id).'" rel="tag">' .$tag->name .'</a>'; 
                }
                $post_section .='</div>';
            }
        }
        if(suxingme('images-style-two')){ $style2 = 'class="images-style-two"'; } else { $style2 = ''; }
        $post_section .= '<h2><a href="' . get_permalink() . '" title="' . get_the_title() . '" '.$target.'>'.get_the_title().'</a></h2></div>
                <div class="post-images-item">
                    <ul>
                        '.suxingme_get_thumbnail().'
                    </ul>
                </div>
                <div class="posts-default-content"><div class="posts-text">'.$excerpt.'</div></div>
                <div class="posts-default-info">
                    <ul>
                        '.$post_html.'
                    </ul>
                </div>
                </div>
                
            </li>';
     }
    else if ( has_post_format( 'aside' )) {
        $post_section .= '<li class="ajax-load-con content '.$GLOBALS['wow_single_list'].'"><div class="content-box posts-aside"><div class="posts-default-content"><div class="posts-default-title">';
        if (suxingme('suxingme_post_tags',true)) { 
            $posttags = get_the_tags();
            if ($posttags) {
                $post_section .='<div class="post-entry-categories">';
                foreach($posttags as $tag) {
                    $post_section .= '<a href="'.get_tag_link($tag->term_id).'" rel="tag">' .$tag->name .'</a>'; 
                }
                $post_section .='</div>';
            }
        }
        $post_section .= '
            <h2 class="posts-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '" '.$target.'>'.get_the_title().'</a></h2></div>
                    <div class="posts-text">'.$excerpt.'</div>
                        <div class="posts-default-info">
                            <ul>
                                '.$post_html.'
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        ';
    }
   else if ( has_post_format( 'link' )) {
        if( suxingme('suxingme_timthumb') && suxingme('suxingme_timthumb_lazyload',true) ) { 
            $image ='<img class="lazy thumbnail" data-original="'. get_template_directory_uri() .'/timthumb.php?src='.post_thumbnail_src().'&h=173.98&w=231.98&zc=1" src="'.constant("THUMB_SMALL_DEFAULT").'" alt="'. get_the_title().'" />';   
        }
        if ( suxingme('suxingme_timthumb') && !suxingme('suxingme_timthumb_lazyload',true) ) {

            $image ='<img class="thumbnail" src="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=173.98&w=231.98&zc=1" alt="' . get_the_title() . '" />';

        } if( suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb') ){
           $image ='<img src="'.constant("THUMB_SMALL_DEFAULT").'" data-original="'.post_thumbnail_src().'" alt="'. get_the_title().'" class="lazy thumbnail" />';
        } 
        if( !suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb')){
            $image ='<img src="'.post_thumbnail_src().'" alt="'. get_the_title().'" class="thumbnail" />';
        }
        $post_section ='
            <li class="ajax-load-con content '.$GLOBALS['wow_single_list'].'">
                <div class="content-box posts-gallery-box">
                    <div class="posts-gallery-img">
                        
                        <a href="' . get_permalink() . '" title="' . get_the_title() . '" '.$target.'>  
                            '.$image.'
                        </a> 
                    </div>
                    <div class="posts-gallery-content">
                        <h2 class="posts-gallery-title"><a href="' . get_permalink() . '" title="' . get_the_title() . '" '.$target.'>' . get_the_title() . '</a></h2>  
                        <div class="posts-gallery-text">'.$excerpt2.'</div>
                        <div class="post-style-tips">
							<span><a href="'.get_post_meta($post->ID,"tuiguang_value",true ).'">'.get_post_meta($post->ID,"tuiguangtext_value",true ).'</a></span>
						</div>
                    </div>
                </div>
            </li>
        ';
   }
   else{
        if( suxingme('suxingme_timthumb') && suxingme('suxingme_timthumb_lazyload',true) ) { 
            $image ='<img class="lazy thumbnail" data-original="'. get_template_directory_uri() .'/timthumb.php?src='.post_thumbnail_src().'&h=300&w=750&zc=1" src="'.constant("THUMB_BIG_DEFAULT").'" alt="'. get_the_title().'" />';   
        }
        if ( suxingme('suxingme_timthumb') && !suxingme('suxingme_timthumb_lazyload',true) ) {

            $image ='<img class="thumbnail" src="'.get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=300&w=750&zc=1" alt="' . get_the_title() . '" />';

        } if( suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb') ){
           $image ='<img src="'.constant("THUMB_BIG_DEFAULT").'" data-original="'.post_thumbnail_src().'" alt="'. get_the_title().'" class="lazy thumbnail" />';
        } 
        if( !suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb')){
            $image ='<img src="'.post_thumbnail_src().'" alt="'. get_the_title().'" class="thumbnail" />';
        }

        $post_section .='<li class="ajax-load-con content posts-default '.$GLOBALS['wow_single_list'].'"><div class="content-box">
                            <div class="posts-default-img">
                                <a href="' . get_permalink() . '" title="'.get_the_title().'" '.$target.'>
                                    <div class="overlay"></div>     
                                    '.$image.'
                                </a> 
                            </div>';

        $post_section .='<div class="posts-default-box"><div class="posts-default-title">';

        if (suxingme('suxingme_post_tags',true)) { 
            $posttags = get_the_tags();
            if ($posttags) {
                $post_section .='<div class="post-entry-categories">';
                foreach($posttags as $tag) {
                    $post_section .= '<a href="'.get_tag_link($tag->term_id).'" rel="tag">' .$tag->name .'</a>'; 
                }
                $post_section .='</div>';
            }
        }
        $post_section .='<h2><a href="' . get_permalink() . '" title="' . get_the_title() . '" '.$target.'>'.get_the_title().'</a></h2></div><div class="posts-default-content">
                        <div class="posts-text">'.$excerpt.'</div>
                        <div class="posts-default-info">
                            <ul>
                                '.$post_html.'
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        ';
   }

   return $post_section;
}

add_action('wp_ajax_nopriv_fa_load_postlist', 'fa_load_postlist_callback');
add_action('wp_ajax_fa_load_postlist', 'fa_load_postlist_callback');
function fa_load_postlist_callback(){
    $postlist = '';
    $home = !empty($_POST["home"]) ? $_POST["home"] : false;
    $paged = !empty($_POST["paged"]) ? $_POST["paged"] : null;
    $total = !empty($_POST["total"]) ? $_POST["total"] : null;
    $category = !empty($_POST["category"]) ? $_POST["category"] : null;
    $author = !empty($_POST["author"]) ? $_POST["author"] : null;
    $tag = !empty($_POST["tag"]) ? $_POST["tag"] : null;
    $search = !empty($_POST["search"]) ? $_POST["search"] : null;
    $year = !empty($_POST["year"]) ? $_POST["year"] : null;
    $month = !empty($_POST["month"]) ? $_POST["month"] : null;
    $day = !empty($_POST["day"]) ? $_POST["day"] : null;
    $query_args = array(
        "posts_per_page" => get_option('posts_per_page'),
        "cat" => $category,
        "tag" => $tag,
        "author" => $author,
        "post_status" => "publish",
        "post_type" => "post",
        "paged" => $paged,
        "s" => $search,
        "year" => $year,
        "monthnum" => $month,
        "day" => $day,
        "ignore_sticky_posts" => 1
    );
    $notinhome = suxingme('notinhome');
    if( !empty ( $notinhome ) && $home ){
        $pool = array();
        foreach (suxingme('notinhome') as $key => $value) {
            if( $value ) $pool[] = $key;
        }
        $query_args['cat'] = '-'.implode($pool, ',-');
    }
    else{
        $query_args['cat'] = $category;
    }
    $the_query = new WP_Query( $query_args );
    while ( $the_query->have_posts() ){
        $the_query->the_post();
        $postlist .= fa_make_post_section();
    }
    $code = $postlist ? 200 : 500;
    wp_reset_postdata();
    $next = ( $total > $paged )  ? ( $paged + 1 ) : '' ;
    echo json_encode(array('code'=>$code,'postlist'=>$postlist,'next'=> $next,'test'=>$home ));
    die;
}

function fa_load_postlist_button(){
    global $wp_query;
    if (2 > $GLOBALS["wp_query"]->max_num_pages) {
        return;
    } else {
        $button = '<button id="fa-loadmore" class="button button-more '.$GLOBALS['wow_single_list'].'" data-wow-delay="0.3s"';
        if (is_home()) $button .= ' data-home="true"';
        if (is_category()) $button .= ' data-category="' . get_query_var('cat') . '"';

        if (is_author()) $button .=  ' data-author="' . get_query_var('author') . '"';

        if (is_tag()) $button .=  ' data-tag="' . get_query_var('tag') . '"';

        if (is_search()) $button .=  ' data-search="' . get_query_var('s') . '"';

        if (is_date() ) $button .=  ' data-year="' . get_query_var('year') . '" data-month="' . get_query_var('monthnum') . '" data-day="' . get_query_var('day') . '"';

        $button .= ' data-paged="2" data-action="fa_load_postlist" data-total="' . $GLOBALS["wp_query"]->max_num_pages . '">加载更多</button>';

        return $button;
    }
}



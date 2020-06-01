<?php

//自定义域

function new_page_meta_boxes() {
    global $post;

    $new_page_meta_boxes =
    array(
      "linkcat" => array(
        "name" => "linkcat",
        "std" => "输入要显示的链接分类ID，每个链接分类ID 用 英文逗号 隔开。",
        "title" => "输入导航分类ID:"),
    );

    foreach((array)$new_page_meta_boxes as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

        if($meta_box_value == "")
          $meta_box_value = $meta_box['std'];

        // 自定义字段标题
        echo'<h4>'.$meta_box['title'].'</h4>';

        // 自定义字段输入框
        echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
        if($meta_box['std'] != ''){   
            echo '<p>'.$meta_box['std'].'</p>';
        }
        echo get_links_category();  
    }
    echo '<input type="hidden" name="ludou_metaboxes_nonce" id="ludou_metaboxes_nonce" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
    echo
<<<JS
<script>
    jQuery(document).ready(function(){
        var defaultpage = jQuery('#page_template').children('option:selected').val();
        if(defaultpage != 'pages/page-nav.php'){
            jQuery('#new-meta-boxes-nav').hide();
        }
        jQuery('#page_template').change(function(){
            var curpage = jQuery(this).children('option:selected').val();
            if(curpage == 'pages/page-nav.php'){
                jQuery('#new-meta-boxes-nav').show();
            }
            else{
                jQuery('#new-meta-boxes-nav').hide();
            }
        });
    });
</script>
JS;
}

function create_page_meta_box() {
    global $theme_name;
    if ( function_exists('add_meta_box') ) {
        add_meta_box( 'new-meta-boxes-nav', '导航分类设置', 'new_page_meta_boxes', 'page', 'normal', 'high' );
        add_meta_box( 'new-meta-boxes-nav1', '专题设置', 'new_page_meta_boxes1', 'page', 'normal', 'high' );
    }
}
function save_pagedata( $post_id ) {
    $new_page_meta_boxes =
    array(
      "linkcat" => array(
        "name" => "linkcat",
        "std" => "输入要显示的链接分类ID，每个链接分类ID 用 英文逗号 隔开。",
        "title" => "输入导航分类ID:"),
    );
    if ( @!wp_verify_nonce( $_POST['ludou_metaboxes_nonce'], plugin_basename(__FILE__) ))
    return;
    if ( !current_user_can( 'edit_posts', $post_id ))
    return;           
    foreach($new_page_meta_boxes as $meta_box) {
    $data = $_POST[$meta_box['name'].'_value'];
    if($data == "")
        delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    else
      update_post_meta($post_id, $meta_box['name'].'_value', $data);
   }
}
add_action('admin_menu', 'create_page_meta_box');
add_action('save_post', 'save_pagedata');


function new_page_meta_boxes1() {
    global $post;
    //投稿自定义
    $new_page_meta_boxes1 =
    array(
      "zhuanticat" => array(
        "name" => "zhuanticat",
        "std" => "输入要显示的专题标签ID，标签ID 用 英文逗号 隔开。",
        "title" => "输入前【2个】专题标签ID:"),
      "zhuantidesc" => array(
        "name" => "zhuantidesc",
        "std" => "输入专题描述",
        "title" => "输入专题描述:"),
      "zhuantiimg" => array(
        "name" => "zhuantiimg",
        "std" => "专题的背景图片URL",
        "title" => "输入专题背景图片URL:"),
    );
    foreach((array)$new_page_meta_boxes1 as $meta_box) {
        $meta_box_value = get_post_meta($post->ID, $meta_box['name'].'_value', true);

        if($meta_box_value == "")
          $meta_box_value = $meta_box['std'];

        // 自定义字段标题
        echo'<h4>'.$meta_box['title'].'</h4>';

        // 自定义字段输入框
        echo '<textarea cols="60" rows="3" name="'.$meta_box['name'].'_value">'.$meta_box_value.'</textarea><br />';
        if($meta_box['std'] != ''){   
            echo '<p>'.$meta_box['std'].'</p>';
        }
    }
    echo '<input type="hidden" name="ludou_metaboxes_nonce1" id="ludou_metaboxes_nonce1" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
    echo
<<<JS
<script>
    jQuery(document).ready(function(){
        var defaultpage = jQuery('#page_template').children('option:selected').val();
        if(defaultpage != 'pages/page-zhuanti.php'){
            jQuery('#new-meta-boxes-nav1').hide();
        }
        jQuery('#page_template').change(function(){
            var curpage = jQuery(this).children('option:selected').val();
            if(curpage == 'pages/page-zhuanti.php'){
                jQuery('#new-meta-boxes-nav1').show();
            }
            else{
                jQuery('#new-meta-boxes-nav1').hide();
            }
        });
    });
</script>
JS;
}

function save_pagedata1( $post_id ) {
    //投稿自定义
    $new_page_meta_boxes1 =
    array(
      "zhuanticat" => array(
        "name" => "zhuanticat",
        "std" => "输入要显示的专题标签ID，标签ID 用 英文逗号 隔开。",
        "title" => "输入前【2个】专题标签ID:"),
      "zhuantidesc" => array(
        "name" => "zhuantidesc",
        "std" => "输入专题描述",
        "title" => "输入专题描述:"),
      "zhuantiimg" => array(
        "name" => "zhuantiimg",
        "std" => "专题的背景图片URL",
        "title" => "输入专题背景图片URL:"),
    );
    if ( @!wp_verify_nonce( $_POST['ludou_metaboxes_nonce1'], plugin_basename(__FILE__) ))
    return;
    if ( !current_user_can( 'edit_posts', $post_id ))
    return;           
    foreach($new_page_meta_boxes1 as $meta_box) {
    $data = $_POST[$meta_box['name'].'_value'];
    if($data == "")
        delete_post_meta($post_id, $meta_box['name'].'_value', get_post_meta($post_id, $meta_box['name'].'_value', true));
    else
      update_post_meta($post_id, $meta_box['name'].'_value', $data);
   }
}
add_action('save_post', 'save_pagedata1');

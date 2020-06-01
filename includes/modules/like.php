<?php
//文章点赞
add_action('wp_ajax_nopriv_suxing_like', 'suxing_like');
add_action('wp_ajax_suxing_like', 'suxing_like');
function suxing_like(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
    $bigfa_raters = get_post_meta($id,'suxing_ding',true);
    $expire = time() + 99999999;
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
    setcookie('suxing_ding_'.$id,$id,$expire,'/',$domain,false);
    if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
        update_post_meta($id, 'suxing_ding', 1);
    } 
    else {
            update_post_meta($id, 'suxing_ding', ($bigfa_raters + 1));
        }
   
    echo get_post_meta($id,'suxing_ding',true);
    
    } 
    
    die;
}

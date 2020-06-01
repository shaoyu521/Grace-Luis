<?php
/**
 * Shortcodes 主题文件
 *
 * @package    YEAHZAN
 * @subpackage ZanBlog
 * @since      ZanBlog 3.0.0
 
 */
// 解决 Shortcode 中自动添加的 br 或者 p 标签
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 12);

add_action( 'admin_print_footer_scripts', 'shortcode_buttons', 100 );
function shortcode_buttons() {
?>
<script type="text/javascript">
QTags.addButton( '1', '蓝色长条', '[blue-strip]内容[/blue-strip]' ); 
QTags.addButton( '2', '灰色长条', '[gray-strip]内容[/gray-strip]' );     
QTags.addButton( '6', '围边按钮', '[btn-button href=""]内容[/btn-button]' );
QTags.addButton( '7', '反色按钮', '[blue-button href=""]内容[/blue-button]' );
QTags.addButton( '8', '下载按钮', '[download-button href=""]内容[/download-button]' );
QTags.addButton( '9', '预览按钮', '[preview-button href=""]内容[/preview-button]' );
QTags.addButton( '20', '灰色引文', '[gray-cue]内容[/gray-cue]' ); 
QTags.addButton( '21', '蓝色引文', '[blue-cue]内容[/blue-cue]' ); 
QTags.addButton( '22', '红色引文', '[red-cue]内容[/red-cue]' ); 
QTags.addButton( '23', '绿色引文', '[green-cue]内容[/green-cue]' ); 
QTags.addButton( '25', '副标题', '[quote]内容[/quote]' ); 
QTags.addButton( '26', '空两格', '[p2em]内容[/p2em]' ); 
</script>
<?php }
function add_editor_buttons( $buttons ) { 
$buttons[] = 'fontselect'; 
$buttons[] = 'fontsizeselect'; 
$buttons[] = 'cleanup'; 
$buttons[] = 'styleselect'; 
$buttons[] = 'hr'; 
$buttons[] = 'del'; 
$buttons[] = 'sub'; 
$buttons[] = 'sup'; 
$buttons[] = 'copy'; 
$buttons[] = 'paste'; 
$buttons[] = 'cut'; 
$buttons[] = 'undo'; 
$buttons[] = 'image'; 
$buttons[] = 'anchor'; 
$buttons[] = 'backcolor'; 
$buttons[] = 'wp_page'; 
$buttons[] = 'charmap'; return $buttons; } add_filter( "mce_buttons_3", "add_editor_buttons" );

/* 空两格 */
function p2em( $atts, $content="" ) { 
	return '<p style="text-indent:2em;">'.$content.'</p>'; 
} 
add_shortcode( 'p2em', 'p2em' ); 

/* 引用 */
function quote( $atts, $content="" ) { 
	return '<h2 class="yinyong"><quote>'.$content.'</quote></h2>'; 
} 
add_shortcode( 'quote', 'quote' ); 


/* 提示框 */
function blue_strip( $atts, $content="" ) { 
	return '<div class="sx blue-strip">'.$content.'</div>'; 
} 
add_shortcode( 'blue-strip', 'blue_strip' ); 

function gray_strip( $atts, $content="" ) { 
	return '<div class="sx gray-strip">'.$content.'</div>'; 
} 
add_shortcode( 'gray-strip', 'gray_strip' ); 

/*引文 */

function gray_cue( $atts, $content="" ) { 
	return '<div class="sx gray-cue"><i class="icon-info-circled"></i><div class="cue_text"><p>'.$content.'</p></div ></div>'; 
} 
add_shortcode( 'gray-cue', 'gray_cue' ); 


function blue_cue( $atts, $content="" ) { 
	return '<div class="sx blue-cue"><i class="icon-attention-circled"></i><div class="cue_text"><p>'.$content.'</p></div ></div>'; 
} 
add_shortcode( 'blue-cue', 'blue_cue' ); 

function green_cue( $atts, $content="" ) { 
	return '<div class="sx green-cue"><i class="icon-ok-circled"></i><div class="cue_text"><p>'.$content.'</p></div ></div>'; 
} 
add_shortcode( 'green-cue', 'green_cue' ); 

function red_cue( $atts, $content="" ) { 
	return '<div class="sx red-cue"><i class="icon-cancel-circled"></i><div class="cue_text"><p>'.$content.'</p></div ></div>'; 
} 
add_shortcode( 'red-cue', 'red_cue' ); 
/*按钮 */

function btn_button( $atts, $content="" ) { 
	extract( shortcode_atts( array( 
		"href" => 'http://', 
	), $atts ) );
	return '<a href="'.$href.'" class="btn btn-button" rel="nofollow" target="_blank">'.$content.'</a>'; 
} 
add_shortcode( 'btn-button', 'btn_button' ); 


function blue_button( $atts, $content="" ) { 
	extract( shortcode_atts( array( 
		"href" => 'http://', 
	), $atts ) );
	return '<a href="'.$href.'" class="btn blue-button" rel="nofollow" target="_blank">'.$content.'</a>';
} 
add_shortcode( 'blue-button', 'blue_button' );


function download_button( $atts, $content="" ) { 
	extract( shortcode_atts( array( 
		"href" => 'http://', 
	), $atts ) );
	return '<a href="'.$href.'" class="btn download-button" rel="nofollow" target="_blank"><i class=" icon-down-open"></i>'.$content.'</a>';
} 
add_shortcode( 'download-button', 'download_button' );

function preview_button( $atts, $content="" ) { 
	extract( shortcode_atts( array( 
		"href" => 'http://', 
	), $atts ) );
	return '<a href="'.$href.'" class="btn preview-button" rel="nofollow" target="_blank"><i class=" icon-picture"></i>'.$content.'</a>';
} 
add_shortcode( 'preview-button', 'preview_button' );



?>
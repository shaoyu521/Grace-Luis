<?php  

//widget suxingme_comment

add_action('widgets_init', create_function('', 'return register_widget("suxingme_comment");'));

class suxingme_comment extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'description' => '显示网友最新评论（名称+评论）' );
		parent::__construct('suxingme_comment', '最新评论 ', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		$title = apply_filters('widget_name', $instance['title']);
		$instance['outer']    = isset( $instance['outer'] ) ? absint( $instance['outer'] ) : 1;
		$instance['outpost']    = isset( $instance['outpost'] ) ? absint( $instance['outpost'] ) : 0;
		$instance['limit']    = isset( $instance['limit'] ) ? absint( $instance['limit'] ) : 5;

		echo $before_title.$title.$after_title; 
		echo '<ul class="w_comment">';
		echo suxingme_newcomments( $instance['limit'],$instance['outpost'],$instance['outer'] );
		echo '</ul>';
		echo $after_widget;
	}
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['limit'] = strip_tags($new_instance['limit']);
		$instance['outer'] = strip_tags($new_instance['outer']);
		$instance['outpost'] = strip_tags($new_instance['outpost']);
		return $instance;
	}
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => '最新评论',
			'limit' => '5',
			'outer' => '1',
			'outpost' => '0',
			) 
		);
		$instance['outer']    = isset( $instance['outer'] ) ? absint( $instance['outer'] ) : 1;
		$instance['outpost']    = isset( $instance['outpost'] ) ? absint( $instance['outpost'] ) : 0;
?>

	<p>
		<label> 标题：
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</label>
	</p>
	<p>
		<label> 显示数目：
			<input class="widefat" id="<?php echo $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="number" value="<?php echo $instance['limit']; ?>" />
		</label>
	</p>
	<p>
			<label>
				排除某用户ID：
				<input class="widefat" id="<?php echo $this->get_field_id('outer'); ?>" name="<?php echo $this->get_field_name('outer'); ?>" type="number" value="<?php echo $instance['outer']; ?>" />
			</label>
		</p>
		<p>
			<label>
				排除某文章ID：
				<input class="widefat" id="<?php echo $this->get_field_id('outpost'); ?>" name="<?php echo $this->get_field_name('outpost'); ?>" type="text" value="<?php echo $instance['outpost']; ?>" />
			</label>
		</p>
<?php
	}
}

function suxingme_newcomments( $limit,$outpost,$outer ){
$limit = $limit ? $limit : 5;
$outpost = $outpost ? $outpost : 0;
$outer = $outer ? $outer : 1;
$output='';
global $wpdb;
	$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author,user_id, comment_date_gmt, comment_approved,comment_author_email, comment_type,comment_author_url, SUBSTRING(comment_content,1,40) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_post_ID!='".$outpost."' AND user_id!='".$outer."' AND comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $limit";
	$comments = $wpdb->get_results($sql);
foreach ($comments as $comment) {

$output .= "<li><div class='message'><a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"发表在： " .$comment->post_title . "\" class='comment_t'>". strip_tags($comment->com_excerpt)."</a></div><div class='clearfix meta'><div class='avatar'>".get_avatar( $comment )."</div><a href=\"" . get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\" 在： " .$comment->post_title . "\" class='link'>".strip_tags($comment->comment_author)." 评 " .$comment->post_title . "</a></div></li>";


}

$output = convert_smilies($output);
echo $output;
};

?>

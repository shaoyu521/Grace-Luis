<?php  
add_action('widgets_init', create_function('', 'return register_widget("suxingme_cjtz");'));
class suxingme_cjtz extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'description' => '右栏广告');
		parent::__construct('suxingme_cjtz', '广告推荐 ', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args);
		$content = $instance['content'];
		$link = $instance['link'];
		$blank = $instance['blank'];
		$img = $instance['img'];
		$imgwidth = $instance['imgwidth'];
		$imgheight = $instance['imgheight'];
		$title = apply_filters('widget_name', $instance['title']);
		$titlebb = ! empty( $instance['titlebb'] ) ? esc_attr( $instance['titlebb'] ) : '';

		
		echo $before_widget;
		echo '<div class="widget_cjtz">';
		
		$lank = '';
		
		if( $blank ) $lank = ' target="_blank"';
		if( $titlebb ) echo '<h3 class="widget_cjtz_title"><span>'.$title.'</span></h3>';
		if($titlebb) {
			echo '<div class="widget_cjtz_img" style="margin: 0;">';
		}
		else {
			echo '<div class="widget_cjtz_img" style="margin: -35px -30px;">';
		}
		
		echo '<a class="cjtz-border" href="'.$link.'"'.$lank.'>';
		echo '<img src="'.$img.'" title="'.$content.'" width="'.$imgwidth.'" height="'.$imgheight.'"></a>';
		
		if($content) {
			echo '<div class="img-info"><i class="icon-info"></i><div class="info">'.$content.'</div></div></div>';}
		else {
			echo '</div>';
		}

		echo '</div>';
		echo $after_widget;
	}
	


	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => '666666',
			'imgwidth' => '100%',
			'imgheight' => 'auto',
			) 
		);
		$instance['link'] = ! empty( $instance['link'] ) ? esc_attr( $instance['link'] ) : '';
		$instance['img'] = ! empty( $instance['img'] ) ? esc_attr( $instance['img'] ) : '';
		$instance['blank'] = ! empty( $instance['blank'] ) ? esc_attr( $instance['blank'] ) : '';
		$instance['content'] = ! empty( $instance['content'] ) ? esc_attr( $instance['content'] ) : '';
		$instance['titlebb'] = ! empty( $instance['titlebb'] ) ? esc_attr( $instance['titlebb'] ) : '';
?>

<p>
	<label> 栏目标题：
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
	</label>
</p>
<p>
	<label>
		<input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php checked( $instance['titlebb'], 'on' ); ?> id="<?php echo $this->get_field_id('titlebb'); ?>" name="<?php echo $this->get_field_name('titlebb'); ?>">
		显示栏目标题 </label>
</p>

<p>
	<label> 描述：
		<textarea id="<?php echo $this->get_field_id('content'); ?>" name="<?php echo $this->get_field_name('content'); ?>" class="widefat" rows="3"><?php echo $instance['content']; ?></textarea>
	</label>
</p>
<p>
	<label> 跳转链接：
		<input style="width:100%;" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="url" value="<?php echo $instance['link']; ?>" size="24" />
	</label>
</p>
<p>
	<label> 图片链接：
		<input style="width:100%;" id="<?php echo $this->get_field_id('img'); ?>" name="<?php echo $this->get_field_name('img'); ?>" type="url" value="<?php echo $instance['img']; ?>" size="24" />
	</label>
</p>
<p>
	<label> 图片宽度（输入数字例如：250px或者100%）：
		<input class="widefat" id="<?php echo $this->get_field_id('imgwidth'); ?>" name="<?php echo $this->get_field_name('imgwidth'); ?>" type="text" value="<?php echo $instance['imgwidth']; ?>" />
	</label>
</p>
<p>
	<label> 图片高度（默认，或者输入数字例如：250px或者100%）：
		<input class="widefat" id="<?php echo $this->get_field_id('imgheight'); ?>" name="<?php echo $this->get_field_name('imgheight'); ?>" type="text" value="<?php echo $instance['imgheight']; ?>" />
	</label>
</p>
<p>
	<label>
		<input style="vertical-align:-3px;margin-right:4px;" class="checkbox" type="checkbox" <?php checked( $instance['blank'], 'on' ); ?> id="<?php echo $this->get_field_id('blank'); ?>" name="<?php echo $this->get_field_name('blank'); ?>">
		新打开浏览器窗口 </label>
</p>
<?php
	}
}

?>

<?php  

add_action('widgets_init', create_function('', 'return register_widget("suxingme_topic");'));
class suxingme_topic extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'suxingme_topic', 'description' => '显示推荐专题' );
		parent::__construct('suxingme_topic', '推荐专题 ', $widget_ops);
	}

	function widget( $args, $instance ) {
		extract( $args );
		echo $before_widget;
		$title  = apply_filters('widget_name', $instance['title']);
		$catids = $instance['catids'];
		echo $before_title.$title.$after_title;

		$zhuanticat_ids = explode(",",$catids);
		foreach ($zhuanticat_ids as $key => $value) {
			$term = get_term( $value, 'special' );
			echo '<ul class="widget_suxingme_topic">
					<li>
						<a href="'.get_term_link( $term->term_id ).'" title="'.$term->name.'">
							<div class="overlay"></div>	
							<div class="image" style="background-image: url('.z_taxonomy_image_url($term->term_id).');"></div>	
							<div class="title">
								<h4>'.$term->description.'</h4>
								<div class="meta"><span>查看专题</span></div>
							</div>
						</a>
					</li>
				</ul>';
		}

		echo $after_widget;
	}

	function form($instance) {
	    $instance = wp_parse_args( (array) $instance, array( 
			'title' => '推荐专题',
			'catids' => '填写专题标签ID，英文逗号分隔'
			) 
		);
?>

<p>
	<label> 名称：
		<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label> 专题标签分类ID,英文逗号分隔：
		<input id="<?php echo $this->get_field_id('catids'); ?>" name="<?php echo $this->get_field_name('catids'); ?>" type="text" value="<?php echo $instance['catids']; ?>" class="widefat" />
	</label>
</p>
<?php
	}
}

?>

<?php  

add_action('widgets_init', create_function('', 'return register_widget("suxingme_social");'));
class suxingme_social extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'suxingme_social', 'description' => '集成社交网站链接入口' );
		parent::__construct('suxingme_social', '关注我们 ', $widget_ops);
	}
    function widget($args, $instance) {
        extract( $args );

		$title = apply_filters('widget_name', $instance['title']);
		$qq = $instance['qq'];
		$sinaweibo = $instance['sinaweibo'];
		$sinaweiboid = $instance['sinaweiboid'];
		$mail = $instance['mail'];
		$weixin = $instance['weixin'];
		$tencent = $instance['tencent'];
		$tencentid = $instance['tencentid'];
		
		echo $before_widget;
		echo $before_title.$title.$after_title; 
        echo suxingme_widget_social($title,$sinaweibo,$sinaweiboid,$tencent,$tencentid,$qq,$mail,$weixin);
        echo $after_widget;	
    }

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 
			'title' => '关注我们 么么哒！',
			) 
		);
		$instance['sinaweibo'] = ! empty( $instance['sinaweibo'] ) ? esc_attr( $instance['sinaweibo'] ) : '';
		$instance['sinaweiboid'] = ! empty( $instance['sinaweiboid'] ) ? esc_attr( $instance['sinaweiboid'] ) : '';
		$instance['tencent'] = ! empty( $instance['tencent'] ) ? esc_attr( $instance['tencent'] ) : '';
		$instance['tencentid'] = ! empty( $instance['tencentid'] ) ? esc_attr( $instance['tencentid'] ) : '';
		$instance['qq'] = ! empty( $instance['qq'] ) ? esc_attr( $instance['qq'] ) : '';
		$instance['mail'] = ! empty( $instance['mail'] ) ? esc_attr( $instance['mail'] ) : '';
		$instance['weixin'] = ! empty( $instance['weixin'] ) ? esc_attr( $instance['weixin'] ) : '';
		
?>

<p style="clear: both;padding-top: 5px;">
	<label>显示标题
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" />
	</label>
</p>
<p>
	<label> 微博ID：
		<input id="<?php echo $this->get_field_id('sinaweiboid'); ?>" name="<?php echo $this->get_field_name('sinaweiboid'); ?>" type="text" value="<?php echo $instance['sinaweiboid']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label> 微博链接（链接以http://开头）：
		<input id="<?php echo $this->get_field_id('sinaweibo'); ?>" name="<?php echo $this->get_field_name('sinaweibo'); ?>" type="text" value="<?php echo $instance['sinaweibo']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label>  QQ微博ID：
		<input id="<?php echo $this->get_field_id('tencentid'); ?>" name="<?php echo $this->get_field_name('tencentid'); ?>" type="text" value="<?php echo $instance['tencentid']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label>  QQ微博链接（链接以http://开头）：
		<input id="<?php echo $this->get_field_id('tencent'); ?>" name="<?php echo $this->get_field_name('tencent'); ?>" type="text" value="<?php echo $instance['tencent']; ?>" class="widefat" />
	</label>
</p>

<p>
	<label>  QQ客服号：
		<input id="<?php echo $this->get_field_id('qq'); ?>" name="<?php echo $this->get_field_name('qq'); ?>" type="text" value="<?php echo $instance['qq']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label>  QQ邮箱地址：
		<input id="<?php echo $this->get_field_id('mail'); ?>" name="<?php echo $this->get_field_name('mail'); ?>" type="text" value="<?php echo $instance['mail']; ?>" class="widefat" />
	</label>
</p>
<p>
	<label>  微信公众号ID（微信二维码请到【主题选项】里设置）：
		<input id="<?php echo $this->get_field_id('weixin'); ?>" name="<?php echo $this->get_field_name('weixin'); ?>" type="text" value="<?php echo $instance['weixin']; ?>" class="widefat" />
	</label>
</p>

<?php
	}
}

function suxingme_widget_social($title,$sinaweibo,$sinaweiboid,$tencent,$tencentid,$qq,$mail,$weixin){ 
?>
	<div class="attentionus">
		<ul class="items clearfix">

			<?php if( $sinaweibo ) { ?>
				<span class="social-widget-link social-link-weibo"> <span class="social-widget-link-count"><i class="icon-weibo"></i><?php echo $sinaweiboid; ?></span> <span class="social-widget-link-title">新浪微博</span> <a href="<?php echo $sinaweibo ?>" target="_blank" rel="nofollow" ></a></span>
			<?php } ?>

			<?php if( $tencent ) { ?>
			<span class="social-widget-link social-link-tencent-weibo"> <span class="social-widget-link-count"><i class="icon-tencent-weibo"></i><?php echo $tencentid; ?></span> <span class="social-widget-link-title">腾讯微博</span> <a href="<?php echo $tencent ?>" target="_blank" rel="nofollow" ></a> </span>
			<?php } ?>

			<?php if( $qq ) { ?>
				<span class="social-widget-link social-link-qq"> <span class="social-widget-link-count"><i class="icon-qq"></i><?php echo $qq ?></span> <span class="social-widget-link-title">QQ号</span> <a href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo $qq ?>&site=qq&menu=yes" rel="nofollow" ></a> </span>
			<?php } ?>

			<?php if( $mail ) { ?>
			<span class="social-widget-link social-link-email"> <span class="social-widget-link-count"><i class="icon-mail"></i><?php echo $mail ?></span> <span class="social-widget-link-title">QQ邮箱</span> <a href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=<?php echo $mail ?>" target="_blank" rel="nofollow" ></a> </span>
			<?php } ?>

			<?php if( $weixin ) { ?>
				<span class="social-widget-link social-link-wechat"> <span class="social-widget-link-count"><i class="icon-wechat"></i><?php echo $weixin; ?></span> <span class="social-widget-link-title">微信公众号</span> <a id="tooltip-s-weixin" href="javascript:void(0);"></a> </span>
			<?php } ?>
			
		</ul>
	</div>
		
<?php }?>

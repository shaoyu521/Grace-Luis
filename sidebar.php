<div class="sidebar col-xs-12 col-sm-4 col-md-4">
<?php if (is_home() || is_front_page()) { ?>
<div class="widget_text widget widget_custom_html"><div class="textwidget custom-html-widget"><style type="text/css"> .icon { width: 1.8em; height: 1.8em; vertical-align: -0.5em; fill: currentColor; overflow: hidden; }</style><div class="authors_profile"> <div class="avatar-panel"> <a title="<?php echo suxingme('suxingme_xgj_name') ; ?>" class="author_pic"> <img alt="" src="//q1.qlogo.cn/g?b=qq&nk=<?php echo suxingme('suxingme_xgj_qq') ; ?>&s=640" class="avatar avatar-80 photo" style="display: inline;" width="80" height="80"> </a> </div> <div class="author_zan" aria-label=""> <i class="fa fa-thumbs-o-up" aria-hidden="true"></i> <p></p></div><div class="author_name"> <a title="<?php echo suxingme('suxingme_xgj_name') ; ?>"><?php echo suxingme('suxingme_xgj_name') ; ?></a> </div> <p class="author_dec"> <i class="fa fa-pencil"></i></p> <div class="author_txt"> <p><i class="iconfont lur-qq" aria-hidden="true"></i> <?php echo suxingme('suxingme_xgj_qq') ; ?> ( <?php echo suxingme('suxingme_xgj_name') ; ?> )</p> <p class="qq_level"><i class="iconfont lur-dengji" aria-hidden="true"></i>&nbsp;<svg class="icon" aria-hidden="true"> <use xlink:href="#lur-yueliang"></use></svg><svg class="icon" aria-hidden="true"> <use xlink:href="#lur-yueliang"></use></svg><svg class="icon" aria-hidden="true"> <use xlink:href="#lur-yueliang"></use></svg><svg class="icon" aria-hidden="true"> <use xlink:href="#lur-xingxing"></use></svg><svg class="icon" aria-hidden="true"> <use xlink:href="#lur-xingxing"></use></svg>1.5倍慢速升级中....</p> <p><i class="iconfont lur-jia" aria-hidden="true"></i>&nbsp;<?php echo suxingme('suxingme_xgj_home') ; ?></p> </div> </div></div></div>
<?php } ?>
<?php 
	if (is_single() && suxingme('suxingme_post_author_box',true) && ( get_post_meta($post->ID,"cc_value",true ) != 2 && get_post_meta($post->ID,"cc_value",true ) != 3 ) || is_author() && suxingme('suxingme_author_box',true) ) { ?>
	<div class="widget suxingme_post_author">
		
		<?php 
			$author_id=get_the_author_meta('ID');
			$author_url=get_author_posts_url($author_id);	
			$user_email = get_the_author_meta( 'user_email' );
		?>	
		<div class="authors_profile">
			<div class="avatar-panel" <?php if( suxingme('suxingme_author_bgp',false ) ){ echo 'style="background-image:url('.suxingme('suxingme_author_bgp').')"'; }?>>
				<a target="_blank" href="<?php echo $author_url;?>" title="<?php  echo the_author_meta( 'nickname' ); ?>" class="author_pic">
					<?php echo get_avatar( $author_id, 80 ); ?>
				</a>
		</div>	
		<div class="author_name"><a target="_blank" href="<?php echo $author_url;?>" title="<?php  echo the_author_meta( 'nickname' ); ?>"><?php the_author()?></a><span><?php echo suxing_level() ?></span></div>
		<p class="author_dec"><?php if(get_the_author_meta('description')){ echo the_author_meta( 'description' );}else{echo'我想要你后悔失去了这样的一个我。所以我不断努力，让自己变得更优秀。'; }?></p>
	</div>
</div>			
<?php }	?>
<?php if ( !is_active_sidebar( 'widget_right' ) && !is_active_sidebar( 'widget_post' ) && !is_active_sidebar( 'widget_special' ) && !is_active_sidebar( 'widget_page' ) && !is_active_sidebar( 'widget_sidebar' ) && !is_active_sidebar( 'widget_other' )) { 
		echo '<div class="widget"><p>请到[后台->外观->小工具]中添加需要显示的小工具。</p></div>';
	 }else{
		dynamic_sidebar( 'widget_right' ); 
		if (is_home()){
			dynamic_sidebar( 'widget_sidebar' ); 
		}
		else if (is_page()){
			dynamic_sidebar( 'widget_page' ); 
		}
		else if (is_single()){
			dynamic_sidebar( 'widget_post' ); 
		}
		else if( is_tax('special') ){
			dynamic_sidebar( 'widget_special' ); 
		}
		else {
			dynamic_sidebar( 'widget_other' );
		}
	
	} ?>
</div>
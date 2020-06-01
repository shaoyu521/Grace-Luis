<div class="clearfix"></div>
<?php if( suxingme('suxingme_footer_style','suxingme_footer_style_1') == 'suxingme_footer_style_1' ) { ?>
<div id="footer" class="one-s-footer clearfix">
	<div class="container">
		<div class="social-footer">
			<?php if(suxingme('suxingme_social_weibo')){?>
				<a class="weiboii" href="<?php echo suxingme('suxingme_social_weibo') ;  ?>" target="_blank"><i class="icon-weibo"></i></a>
			<?php } ?>
			<?php if(suxingme('suxingme_social_qqweibo')){?>
				<a class="ttweiboii" href="<?php echo suxingme('suxingme_social_qqweibo') ;  ?>" target="_blank" rel="nofollow" title="腾讯微博"><i class="icon-tencent-weibo"></i></a>
			<?php } ?>
			<?php if(suxingme('suxingme_social_email')){?>
				<a class="mailii" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=<?php echo suxingme('suxingme_social_email');?>"target="_blank"><i class="icon-mail-2"></i></a>
			<?php } ?>
			<?php if(suxingme('suxingme_social_qq')){?>
				<a class="qqii" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo suxingme('suxingme_social_qq');  ?>&site=qq&menu=yes" target="_blank"><i class="icon-qq"></i></a>
			<?php } ?>
			<?php if(suxingme('suxingme_social_weixin')){?>
				<a id="tooltip-f-weixin" class="wxii" href="javascript:void(0);"><i class="icon-wechat"></i></a>
			<?php } ?>
		</div>
		<div class="footer-copyright">Copyright © <?php echo intval(date('Y')); ?> <a class="site-link" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" rel="home"><?php bloginfo('name'); ?></a> <?php if( suxingme('suxingme_beian') ) { ?> <a href="http://www.miitbeian.gov.cn" rel="external nofollow" target="_blank"><?php echo suxingme('suxingme_beian'); ?></a><?php } ?> <?php if( suxingme('suxingme_statistics_code') ) { ?><?php echo suxingme('suxingme_statistics_code'); ?><?php } ?>
		<br/>Powered By WordPress · Grace Theme By <a href="http://www.lurbk.com" target="_blank" rel="nofollow">ShaoYu</a> 
		</div>
	</div>
</div>
<?php } else{ ?>
<div id="footer" class="two-s-footer clearfix">
	<div class="footer-box">
		<div class="container">
			<div class="social-footer">
				<?php if(suxingme('suxingme_social_weibo')){?>
					<a class="weiboii" href="<?php echo suxingme('suxingme_social_weibo') ;  ?>" target="_blank"><i class="icon-weibo"></i></a>
				<?php } ?>
				<?php if(suxingme('suxingme_social_qqweibo')){?>
					<a class="ttweiboii" href="<?php echo suxingme('suxingme_social_qqweibo') ;  ?>" target="_blank" rel="nofollow" title="腾讯微博"><i class="icon-tencent-weibo"></i></a>
				<?php } ?>
				<?php if(suxingme('suxingme_social_email')){?>
					<a class="mailii" href="http://mail.qq.com/cgi-bin/qm_share?t=qm_mailme&email=<?php echo suxingme('suxingme_social_email');?>"target="_blank"><i class="icon-mail-2"></i></a>
				<?php } ?>
				<?php if(suxingme('suxingme_social_qq')){?>
					<a class="qqii" href="http://wpa.qq.com/msgrd?v=3&uin=<?php echo suxingme('suxingme_social_qq');  ?>&site=qq&menu=yes" target="_blank"><i class="icon-qq"></i></a>
				<?php } ?>
				<?php if(suxingme('suxingme_social_weixin')){?>
					<a id="tooltip-f-weixin" class="wxii" href="javascript:void(0);"><i class="icon-wechat"></i></a>
				<?php } ?>
			</div>
			<div class="nav-footer">
			<?php 
				if ( function_exists( 'wp_nav_menu' ) && has_nav_menu('footer-nav') ) {
					$frlink = wp_nav_menu( array( 'container' => false, 'items_wrap' => '%3$s', 'theme_location' => 'footer-nav','depth' => 1, 'echo' => false ) ); 
					echo strip_tags( $frlink, '<a>' );
				} else { 
					echo '<a href="/wp-admin/nav-menus.php">请到[后台->外观->菜单]中设置菜单。</a>'; 
				} ?>
			</div>
			<div class="copyright-footer">
				<p>Copyright © <?php echo intval(date('Y')); ?> <a class="site-link" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>" rel="home"><?php bloginfo('name'); ?></a> 

				<?php if( suxingme('suxingme_beian') ) { ?>
					<a href="http://www.miitbeian.gov.cn" rel="external nofollow" target="_blank"><?php echo suxingme('suxingme_beian'); ?></a>
				<?php } ?>
				<?php if( suxingme('suxingme_statistics_code') ) { ?><?php echo suxingme('suxingme_statistics_code'); ?>
				<?php } ?> · Powered By WordPress · Grace Theme By <a href="http://www.lurbk.com" target="_blank">ShaoYu</a> </p>
			</div>
			<?php if(is_home()&&!is_paged()){ ?>
			<div class="links-footer">
				<span>友情链接：</span>
				<?php
					$fr_link = array(
						'categorize'  => false,
						'category'    => suxingme('select_link_friends'),
						'before'      => false,
						'after'       => false,
						'title_li'    => false,
						'show_images' => false,
						'echo'        => false
					);
					$fr_link_rel = wp_list_bookmarks( $fr_link );
					if( empty( $fr_link_rel ) ){
						echo '<a href="'.get_option('home').'/wp-admin/link-manager.php">请到后台 [链接] 中添加链接，并在 [主题选项 CMS设置] 中选择链接分类</a>';
					} else {
						echo $fr_link_rel;
					}
				?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>

<div class="search-form">
	<form method="get" action="<?php bloginfo('url'); ?>" role="search">       
		<div class="search-form-inner">
			<div class="search-form-box">
				 <input class="form-search" type="text" name="s" placeholder="键入搜索关键词">
				 <button type="submit" id="btn-search"><i class="icon-search"></i> </button>
				 
			</div>
			<?php
				$keyword = suxingme('suxingme_custom_searchkey');
				if( ! empty( $keyword ) ) :
					$key = explode(',',$keyword);

			?>
			<div class="search-commend">
				<h4>大家都在搜</h4>
				<ul>
					<?php
						for ($i=0; $i < count($key); $i++) { 
							echo '<li><a href="'.get_option('home').'/?s='.$key[$i].'">'.$key[$i].'</a></li>';
						}
					?>
				</ul>
			</div>
			<?php endif; ?>
		</div>                
	</form> 
	<div class="close-search">
		<span class="close-top"></span>
			<span class="close-bottom"></span>
    </div>
</div>
<div class="f-weixin-dropdown">
	<div class="tooltip-weixin-inner">
		<h3>关注我们的公众号</h3>
		<div class="qcode"> 
			<img src="<?php echo suxingme('suxingme_social_weixin') ; ?>" width="160" height="160" alt="微信公众号">
		</div>
	</div>
	<div class="close-weixin">
		<span class="close-top"></span>
			<span class="close-bottom"></span>
    </div>
</div>      
<?php wp_footer();?>
</body>
</html>
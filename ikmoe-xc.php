<?php/*
Template Name:图库页面
*/
?>
<?php include("ikmoe-peizhi.php");?>
<?php echo $ikmoe;?>
<?php include("header.php") ?>
<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/ikmoe-xc.css">
<!-- 整体布局 -->
<div class="ikmoe-buju">
		<div class="ikmoe-buju-1"></div>
	<!-- 相册布局 -->
	<div class="ikmoe-xc-buju">

<!-- 输出内容 -->
		<!-- 循环与指定 -->
<?php query_posts("cat=".$ikmoe_b."&showposts=".$ikmoe_a."&paged=$paged$")?>
<?php while (have_posts()) : the_post(); ?>
		<!-- ↑end -->
<!-- 输出相册的图片 -->
<div class="ikmoe-xc-tu">
	<!-- 边框样式 -->
	<div class="ikmoe-xc-bk">
		<div class="ikmoe-buju-1"></div>
			<a href="<?php  echo ikmoe_img_src();?>" target="_blank"><img src="<?php  echo ikmoe_img_src();?>" alt="<?php the_title(); ?>">
				</a>
			<!-- 标题 -->
			<h2><B><?php the_title(); ?></B></h2>
	<!-- ↓图片结束 -->
	<!-- 日期检查 --><h4><?php the_time('Y-m-d'); ?>-[<a href="<?php the_permalink(); ?>"  target="_blank"> 评论</a>]
		<div class="ikmoe-buju-1"></div>
	</h4>
		</div>
			<div class="ikmoe-buju-1"></div>
		</div> 	
<?php endwhile; ?>

<!-- 内容结束 -->
		<!-- 相册布局结束 -->
		<!-- 低级侧边栏(其实是下一页与重置query) -->
	</div>
<div class="ikmoe-buju-0"></div>
<!-- 整体结束 -->
</div>

<div class="ikmoe-cbl">
	<B><?php pagination();  wp_reset_query();?>
[<a href="<?php echo $ikmoe_c;?>" target="_blank"><i class="fa fa-check-square-o" aria-hidden="true"></i>
打赏一下</a>-
<?php $posts = get_posts( 'numberposts=-1&category='.$ikmoe_b);
echo count($posts);?>张图片

]</B>
</div>
<div class="ikmoe-buju-0"></div>
<?php  include("footer.php");?>


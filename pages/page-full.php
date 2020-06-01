<?php 
/*
Template Name: 单栏页面
*/
get_header();?>
<div id="page-content">
	<div class="container">
		<div class="page-content">
			<?php if(have_posts()):  while(have_posts()):the_post();  ?>
			<div class="post-title">
				<h1 class="title">
					<?php the_title(); ?>
				</h1>
			</div>
			<div class="post-content">
				<?php 
					the_content();
					suxing_link_pages('before=<div class="page-links">&after=&next_or_number=next&previouspagelink=上一页&nextpagelink=');
					suxing_link_pages('before=&after= ');
					suxing_link_pages('before=&after=</div>&next_or_number=next&previouspagelink=&nextpagelink=下一页');
				?>
			</div>	
		</div>
		<div class="clear"></div>
		<?php if (comments_open()) comments_template( '', true ); ?>
		<?php endwhile;  endif; ?>	
	</div>	
</div>
<?php get_footer(); ?>
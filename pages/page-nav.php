<?php 
/*
Template Name: 导航页面
*/
get_header();

?>
<?php if(have_posts()): while(have_posts()):the_post();  


$linkcat = get_post_meta($post->ID, 'linkcat_value', true);

$link_cat_ids = explode(",",$linkcat);


?>
<div class="page-single page-nav"  >
	<div class="page-title"  style="background-image:url(<?php echo pagenav_banner_pic(); ?>);">
		<div class="container">
			<h1 class="title">
				<?php the_title(); ?>
			</h1>
			<div class="page-dec">
				<?php the_content();?>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="page-nav-items">
			<?php
			foreach ( $link_cat_ids as $key => $value) {
				wp_list_bookmarks(array(
					'category' => $value,
					'show_description' => true,
					'title_before'     => '<h2><span><i class="icon-record-outline"></i>',
  					'title_after'      => '</span></h2>',
  					'before' => '<li><div class="nav-item">',
  					'after' => '</div></li>',
  					'between' => '<p>',
					'category_before'  => '<div class="item">',
					'category_after'   => '</div>',
					'category_order' => 'ASC',
					'show_images'=> 0
				));
			}
			?>
		</div>
	</div>
</div>
<?php endwhile; endif; ?>	
<?php get_footer(); ?>

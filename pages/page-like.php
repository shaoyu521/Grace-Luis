<?php 
/*
Template Name: 点赞排行榜
*/
get_header();?>
<?php if(have_posts()): while(have_posts()):the_post();  ?>
<div class="page-single" >
	<div class="page-title" style="background-image:url(<?php echo like_banner_pic(); ?>);">
		<div class="container">
			<h1 class="title">
				<?php the_title(); ?>
			</h1>
			<div class="page-dec">
				<?php the_content();?>
			</div>
		</div>
	</div>
	<div class="likepage clearfix">
		<div class="container">
			<?php 
				$args = array(
				    'ignore_sticky_posts' => 1,
				    'meta_key' => 'suxing_ding',
				    'orderby' => 'meta_value_num',
				    'showposts' => 40
				);
				query_posts($args);

				while ( have_posts() ) : the_post(); 
			    $like = get_post_meta( get_the_ID(), 'bigfa_ding', true );?>
					<div class="like-post col-xs-6 col-sm-4 col-md-3">
						<div class="like-post-box">
							<a href="<?php the_permalink(); ?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>>

								<div class="views">
									<span class="icon s-like">喜欢 |  </span>
									<span class="count num"><?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></span>
								</div>
								<div class="image" style="background-image:url(<?php echo post_thumbnail_src(); ?>)" ></div>
								<div class="title">
									<h2><?php the_title(); ?></h2>
									
								</div>
							</a>
						</div>
					</div>
			   <?php 
			   endwhile; 
			    wp_reset_query();
			?>
		</div>
	</div>
</div>
<?php endwhile; endif; ?>	
<?php get_footer(); ?>

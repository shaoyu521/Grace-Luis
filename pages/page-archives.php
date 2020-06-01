<?php 
/*
Template Name: 归档页面
*/
get_header();?>
<?php if(have_posts()): while(have_posts()):the_post();  ?>
<div class="page-single" >
	<div class="page-title" style="background-image:url(<?php echo archives_banner_pic(); ?>);">
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
		<div class="page-content">
			<div class="mod-archive">
				<?php 
					$args = array(
						'posts_per_page'      => -1,
						'post_type'           => 'post',
						'post_status'         => 'publish',
						'ignore_sticky_posts' => 1, 
					);

					$yearpost = new WP_Query( $args );
					$i = 1; 

					if( $yearpost->have_posts() ) :
						while($yearpost->have_posts()) : $yearpost->the_post();
							if( $date != date( 'Y', strtotime($post->post_date) ) ){ ?>
								</ul>
								<div id="<?php echo date( 'Y', strtotime($post->post_date) ); ?>" class="mod-archive-year"><?php echo date( 'Y', strtotime($post->post_date) ); ?></div>
								<ul class="mod-archive-list">
							<?php 
							} else { 
								if( $i == 1 ){ ?>
									<div id="2015" class="mod-archive-year"><?php echo date( 'Y', strtotime($post->post_date) ); ?></div>
									<ul class="mod-archive-list">
								<?php } 
							} ?>
							<li><time class="mod-archive-time" datetime="<?php the_time('m-d h:i:s'); ?>"><?php the_time('m.d'); ?></time><span><i class="icon-eye-4"></i><?php post_views('',''); ?></span><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>  </li>
				<?php 
						$i++; 
						$ul = 0; 
						$date  =  date( 'Y', strtotime($post->post_date) ); 
						endwhile; 
					endif; 
					wp_reset_query(); ?> 
			</div>
		</div>
		<div class="clear"></div>
		<?php if (comments_open()) comments_template( '', true ); ?>
		
	</div>
</div>
<?php endwhile; endif; ?>	
<?php get_footer(); ?>
<?php get_header(); ?>
<div id="page-content">
	<div class="container">
		<div class="row">
			<div class="article  col-xs-12 col-sm-8 col-md-8">
				<div class="post page">
					<?php if(have_posts()): while(have_posts()):the_post();  ?>
					<div class="post-title">
						<?php the_tags('<div class="post-entry-categories">','','</div>'); ?>
						<h1 class="title"><?php the_title(); ?></h1>
					</div>
					<div class="post-content">
						<div class="item-intro-content">
							<?php if(has_excerpt()): ?>
								<p class="post-abstract">
								<span class="abstract-tit">摘要：</span>
								<?php echo get_the_excerpt(); ?>
								</p>
							<?php endif;?>
							<?php the_content();?>
						</div>
						
					</div>
				</div>
				<div class="clear"></div>
				<?php if (comments_open()) comments_template( '', true ); endwhile;  endif; ?>	
			</div>	
			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php get_footer(); ?>

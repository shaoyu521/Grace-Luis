<?php get_header(); ?>
<div id="page-content">
	<div class="container">
		<div class="row">
			<?php if ( !have_posts() ) : ?>
				<div class="blog-emtry">
					<i class="icon-frown"></i>
					<p><?php echo '该栏目暂无内容'; ?></p></div>
				<?php else: ?>
					<div class="article search-posts col-xs-12 col-sm-8 col-md-8">
						<div class="search-title">
							<h3><span><?php global $wp_query; echo '搜索到 ' . $wp_query->found_posts . ' 篇相关的文章';?></span></h3>
						</div>
						<div class="ajax-load-box posts-con">
							<?php while ( have_posts() ) : the_post(); 
								include( TEMPLATEPATH.'/includes/excerpt.php' );endwhile; ?>
						</div>
						<div class="clearfix"></div>
						<?php if( suxingme('suxingme_ajax_posts',true) ) { ?>
							<div id="ajax-load-posts"><?php echo fa_load_postlist_button();?></div>
						<?php  }else {
							the_posts_pagination( array(
								'prev_text'          =>上页,
								'next_text'          =>下页,
								'screen_reader_text' =>'',
								'mid_size' => 1,
						) ); }  ?>
					</div>
					<?php get_sidebar();  endif; ?>
				
		</div>
	</div>
</div>
<?php get_footer(); ?>
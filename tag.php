<?php 
$queried_object = get_queried_object(); 
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;
get_header();?>
<div id="page-content" class="page-topic">
	<div class="topic-bg" style="background-image: url(<?php echo z_taxonomy_image_url($term_id); ?>);">
		<div class="container">
			<h2 class="title"><?php echo $queried_object->name; ?></h2>
            <p class="description"><?php echo $queried_object->description; ?></p>
            <span><?php echo $queried_object->count; ?>篇文章</span>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<?php if(have_posts()) : ?>
				<div class="article col-xs-12 col-sm-8 col-md-8">
					<?php if (suxingme('suxingme_breadcrumbs',false) && function_exists('dimox_breadcrumbs')) dimox_breadcrumbs(); ?>
					<div class="ajax-load-box posts-con">
						<?php while ( have_posts() ) : the_post(); 
							include( TEMPLATEPATH.'/includes/excerpt.php' );endwhile; ?>
					</div>
					<div class="clearfix"></div>
					<?php if( suxingme('suxingme_ajax_posts',true) ) { ?>
							<div id="ajax-load-posts">
								<?php echo fa_load_postlist_button();?>
							</div>
							<?php  } else {
								the_posts_pagination( array(
									'prev_text'          =>'上页',
									'next_text'          =>'下页',
									'screen_reader_text' =>'',
									'mid_size' => 1,
								) ); 
							} ?>
				</div>
				<?php get_sidebar(); ?>
				<?php else: ?>			
					<div class="blog-emtry">
						<i class="icon-frown"></i>
						<p><?php echo '该栏目暂无内容'; ?></p>
					</div>
				<?php  endif; ?>
					
			
		</div>
		
	</div>
</div>
<?php get_footer(); ?>
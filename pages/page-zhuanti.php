<?php 
/*
Template Name: 专题页面
*/
get_header();
while( have_posts() ) : the_post();

$zhuanticat = get_post_meta(get_the_ID(),'zhuanticat_value',true);
$zhuanticat_ids = explode(",",$zhuanticat);
$zhuanticat_ids = array_slice($zhuanticat_ids,0,2);
?>
<div id="page-content" class="topic-plaza">
	<div class="topic-bg" style="background-image: url(<?php echo get_post_meta(get_the_ID(),'zhuantiimg_value',true); ?>);">
		<div class="container">
			<h2 class="title"><?php the_title(); ?></h2>
            <p class="description"><?php echo get_post_meta(get_the_ID(),'zhuantidesc_value',true); ?></p>
		</div>

	</div>
	<div class="container">
		<div class="topic-featured row">
			<?php
				foreach ($zhuanticat_ids as $key => $value) {
					$term = get_term( $value, 'special' );
			?>

					<div class="topic-tag col-xs-12 col-sm-6 col-md-6">
						<div class="item" style="background-image: url(<?php echo z_taxonomy_image_url($term->term_id); ?>);">
							<a href="<?php echo get_term_link( $term->term_id ); ?>">
								<div class="overlay"></div>
								<div class="title">
									<h2><?php echo $term->description; ?></h2> 
									<div class="meta"><?php echo $term->count; ?>篇文章</div>
								</div> 
								<div class="tag"><span>#<?php echo $term->name; ?></span></div>
							
							</a>
						</div>
					</div>


			<?php } ?>

			
		</div>
		<div class="topic-list row">

			<?php
				$terms = get_terms( array( 
					'taxonomy'   => 'special',
					'hide_empty' => false,
					'exclude'    =>$zhuanticat,
				) );
				foreach ($terms as $key => $value) {
					
			?>
					
					<div class="topic-tag col-xs-12 col-sm-4 col-md-3">
						<div class="item" style="background-image: url(<?php echo z_taxonomy_image_url($value->term_id); ?>);">
							<a href="<?php echo get_term_link( $value->term_id ); ?>">
								<div class="overlay"></div>
								<div class="title">
									<h2><?php echo $value->description; ?></h2> 
									<div class="meta"><?php echo $value->count; ?>篇文章</div>
								</div> 
								<div class="tag"><span>#<?php echo $value->name; ?></span></div>
							
							</a>
						</div>
					</div>

			<?php } ?>





		</div>
	</div>
</div>
<?php 
endwhile;
get_footer(); ?>

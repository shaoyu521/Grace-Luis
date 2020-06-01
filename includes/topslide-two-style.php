<div class="top-content">
	<div class="container">
		<div class="row">
			<div class="owl-carousel top-slide-two">
				<?php
				if( suxingme('suxingme_slide2',false) ): 
					for ($i=1; $i < suxingme('suxingme_slide_number') + 1; $i++) { ?>
							<div class="item">	
								<a href="<?php echo suxingme('suxingme_slide_url_'.$i);?>" title="<?php echo suxingme('suxingme_slide_title_'.$i);?>">
									<div class="slider-content"  style="background-image: url(<?php echo suxingme('suxingme_slide_img_'.$i); ?>);">
										<div class="slider-content-box"> 
											<div class="slider-content-item">
												<div class="slider-title">
													<h2><?php echo suxingme('suxingme_slide_title_'.$i);?></h2>
									            </div>
								           	</div>
							           	</div>   
									</div>
								</a>

							</div>
					<?php }
				?>
				<?php else: ?>
					<?php 
						$numpost = suxingme('suxingme_slide_number');
						$args = array( 
						'showposts' => $numpost,
						'ignore_sticky_posts' => 1,	
						'meta_query' => array(
							array(
								'key' => 'lunbo_value', 
								'value' => '1'  
								)));
						query_posts($args);
						if (have_posts()) : 
							while (have_posts()) : the_post();?>
								<div class="item">	
									<a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
										<div class="slider-content" style="background-image: url(<?php if (get_post_meta($post->ID,"postthumb_value",true ) ){ echo get_post_meta($post->ID,"postthumb_value",true); } elseif( suxingme('suxingme_timthumb') ){ echo get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=500&w=1120'; } else { echo post_thumbnail_src(); } ?>); ">
											<div class="slider-content-item">
												<div class="slider-cat clearfix"><?php $category = get_the_category();if($category[0]){ echo $category[0]->cat_name;}?></div>  
												<h2><?php the_title();?></h2>
								           	</div>
										</div>
									</a>

								</div>
						<?php 
							endwhile; 
						else:  
							$categories = explode(",",suxingme( 'suxingme_slide_fenlei' ));
							$order = suxingme('suxingme_slide_order');
							$num = suxingme('suxingme_slide_number');
							$args = array(
								'ignore_sticky_posts'=> 1,
								'paged' => $paged,
								'orderby'=> $order,//date DESC rand
								'posts_per_page' =>  $num,
								'cat' => $categories , 
								'tax_query' => array( array( 
									'taxonomy' => 'post_format',
									'field' => 'slug',
									'terms' => array(
										//请根据需要保留要排除的文章形式
										'post-format-aside',
										'post-format-link'
										),
									'operator' => 'NOT IN',
								) ),
							);
							query_posts($args);			
							while (have_posts()) : the_post();?>
							<div class="item">	
								<a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
									<div class="slider-content" style="background-image: url(<?php if( suxingme('suxingme_timthumb') ){ echo get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=500&w=1120'; } else { echo post_thumbnail_src(); } ?>); ">
										<div class="slider-content-item">
											<div class="slider-cat clearfix"><?php $category = get_the_category();if($category[0]){echo $category[0]->cat_name;}?></div>  
											<h2><?php the_title();?></h2>
							           	</div>
									</div>
								</a>
							</div>
					<?php endwhile; wp_reset_query(); endif; ?>
				<?php endif; ?>
			</div>

			<div class="top-singles hidden-xs hidden-sm">
				<?php
					$args = array( 
					'showposts' => 2,
					'ignore_sticky_posts' => 1,	
					'meta_query' => array(
						array(
							'key' => 'lunbo_silde_value', 
							'value' => '1'  
							)));
					$query = new WP_query( $args );
					if( $query->have_posts() ):
						while( $query->have_posts() ): $query->the_post();
				?>
						<div class="single-item">
							<div class="image" style="background-image:url(<?php if (get_post_meta($post->ID,"postthumb_silde_value",true ) ){ echo get_post_meta($post->ID,"postthumb_silde_value",true); } elseif( suxingme('suxingme_timthumb') ){ echo get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=210&w=360'; } else { echo post_thumbnail_src(); } ?>)">
								<a href="<?php the_permalink();?>">
									<div class="overlay"></div>
									<div class="title"><span><?php $category = get_the_category();if($category[0]){echo $category[0]->cat_name;}?></span><h3><?php the_title();?></h3></div>
								</a>
							</div>
						</div>
				<?php endwhile; wp_reset_query(); endif;?>
			</div>

		</div>
	</div>
</div>


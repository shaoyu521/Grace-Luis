<div class="top-content">
	<div class="container">
		<div class="row">
			<div class="owl-carousel top-slide">

				<?php 
					$numpost = suxingme('suxingme_slide_number');
					$args = array(
						'showposts' => $numpost,
						'ignore_sticky_posts' => 1,	
						'meta_query' => array(
							array(
								'key' => 'lunbo_value', 
								'value' => '1'  
							)
						)
					);
					query_posts($args);
					if (have_posts()) : while (have_posts()) : the_post();?>
						<div class="item">
							<div class="slider-image">
								<a href="<?php the_permalink(); ?>"  target="_blank" title="<?php the_title();?>"
									style="background-image:url(<?php if (get_post_meta($post->ID,"postthumb_value",true ) ){ echo get_post_meta($post->ID,"postthumb_value",true); } elseif( suxingme('suxingme_timthumb') ){ echo get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=450&w=800'; } else { echo post_thumbnail_src(); } ?>)">
								</a>
							</div>
							
							<div class="slider-content">
								<div class="slider-content-box">    
									<div class="post-categories clearfix">            
										<?php $category = get_the_category(); if( $category[0] ) { echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>'; } ?>       
									</div>  
									
									<div class="slider-title">
										<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
						            </div>
						            <div class="post-element clearfix">
							            <ul>
							            	<li  class="post-slider-author"><?php echo get_avatar( get_the_author_meta('ID') ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>                
							            	<li class="post-slider-clock"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
							            	<li class="post-slider-views"><i class="icon-eye"></i> <?php post_views('',''); ?></li>            
							            </ul>        
						            </div>
							        <div class="slider-post-text clearfix"><?php  echo '<p class="posts-gallery-text">'.wp_trim_words(get_the_excerpt(), 60 ).'</p>';?></div>
							        <div class="read-more"><a href="<?php the_permalink(); ?>">阅读全文</a></div>   
					           	</div>
							</div>
							
						</div>
						<?php endwhile; else:  
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
							<div class="slider-image">
								<a href="<?php the_permalink(); ?>"  target="_blank" title="<?php the_title();?>"
									style="background-image:url(<?php if (get_post_meta($post->ID,"postthumb_value",true ) ){ echo get_post_meta($post->ID,"postthumb_value",true); } elseif( suxingme('suxingme_timthumb') ){ echo get_template_directory_uri().'/timthumb.php?src='.post_thumbnail_src().'&h=450&w=800'; } else { echo post_thumbnail_src(); } ?>)">
								</a>
							</div>
							
								<div class="slider-content">
									<div class="slider-content-box">    
										<div class="post-categories clearfix">            
											<?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?>       
										</div>  
										
										<div class="slider-title">
											<h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
							            </div>
							            <div class="post-element clearfix">
								            <ul>
								            	<li  class="post-slider-author"><?php echo get_avatar( get_the_author_meta('ID') ); ?><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>                
								            	<li class="post-slider-clock"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
								            	<li class="post-slider-views"><i class="icon-eye"></i> <?php post_views('',''); ?></li>            
								            </ul>        
							            </div>
								        <div class="slider-post-text clearfix"><?php echo '<p class="posts-gallery-text">'.wp_trim_words(get_the_excerpt(), 60 ).'</p>';?></div>
								        <div class="read-more"><a href="<?php the_permalink(); ?>">阅读全文</a></div>   
						           	</div>
								</div>
							 
						</div>
				<?php endwhile; wp_reset_query(); endif; ?>
			</div>
		</div>
	</div>
</div>
<div class="related-post">
	<h3 class="subtitle"><span>猜你喜欢</span></h3>
	<ul>
		<?php
			global $post;
			$cats = wp_get_post_categories($post->ID);
			if ($cats) {
				$args = array(
					  'category__in' => array( $cats[0] ),
					  'post__not_in' => array( $post->ID ),
					  'showposts' => 6,
					  'ignore_sticky_posts' => 1,
					  'orderby'=>'rand',
				  );
			  query_posts($args);
			  if (have_posts()) {
				while (have_posts()) {
				  the_post(); update_post_caches($posts); ?>  
					<li>
						<div class="item">
							<a class="relatedpostpic" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<div class="overlay"></div>

								<?php if( suxingme('suxingme_timthumb') && suxingme('suxingme_timthumb_lazyload',true) ) { ?>
									<img class="lazy thumbnail" data-original="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=172.5&w=230&zc=1" src="<?php echo constant("THUMB_SMALL_DEFAULT");?>" alt="<?php the_title(); ?>" />	
								<?php }
								if ( suxingme('suxingme_timthumb') && !suxingme('suxingme_timthumb_lazyload',true) ) {	?>
									<img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=172.5&w=230&zc=1" alt="<?php the_title(); ?>" />
								<?php } if( suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb') ){ ?>
									<img src="<?php echo constant("THUMB_SMALL_DEFAULT");?>" data-original="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="lazy thumbnail" />
								<?php } ?>
								<?php if( !suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb')){ ?>
									<img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="thumbnail" />
								<?php } ?>  
								<h4><span><?php the_title(); ?></span></h4>                    
							</a>
						</div>
					</li>
			<?php
				}
			  } 
			  else {
				echo '<li>暂无相关文章</li>';
			  }
			  wp_reset_query(); 
			}
			else {
			  echo '<li>暂无相关文章</li>';
			}
		?>
	</ul>
</div>

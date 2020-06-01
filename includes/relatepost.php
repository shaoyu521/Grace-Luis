<div class="related-post">
	<h3><span>猜你喜欢</span></h3>
	<ul>
	<?php
		$exclude_id = isset( $post->ID ) ? $post->ID : NULL;
		$post_num = suxingme('related-post-num',true); 
		$posttags = get_the_tags(); 
		$i = 0;
		if ( $posttags ) { 
		$tags = ''; 
		foreach ( $posttags as $tag ) $tags .= $tag->name .',';
		$args = array(
		    'post_status' => 'publish',
		    'tag_slug__in' => explode(',', $tags), 
		    'post__not_in' => explode(',', $exclude_id), 
		    'ignore_sticky_posts' => 1, 
		    'orderby' => 'comment_date', 
		    'posts_per_page' => $post_num
		);
		query_posts($args); 
		while( have_posts() ) { the_post(); ?>
		    <li>
				<div class="item">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<div class="overlay"></div>
						<?php if( suxingme('suxingme_timthumb') && suxingme('suxingme_timthumb_lazyload',true) ) { ?>
							<img class="lazy thumbnail" data-original="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=161&w=214.66&zc=1" src="<?php echo constant("THUMB_SMALL_DEFAULT");?>" alt="<?php the_title(); ?>" />	
						<?php }
						if ( suxingme('suxingme_timthumb') && !suxingme('suxingme_timthumb_lazyload',true) ) {	?>
							<img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=161&w=216.66&zc=1" alt="<?php the_title(); ?>" />
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
		    $exclude_id .= ',' . $post->ID; 
		    $i ++;
		}
		wp_reset_query();
		}
		if ( $i < $post_num ) { 
		$cats = ''; 
		foreach ( get_the_category() as $cat ) $cats .= $cat->cat_ID . ',';
		$args = array(
		    'category__in' => explode(',', $cats), 
		    'post__not_in' => explode(',', $exclude_id),
		    'ignore_sticky_posts' => 1,
		    'orderby' => 'comment_date',
		    'posts_per_page' => $post_num - $i
		);
		query_posts($args);
		while( have_posts() ) { the_post(); ?>
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
		    $i ++;
		} 
		wp_reset_query();
		}
		if ( $i  == 0 )  echo '<li>暂无相关文章</li>';
		?>
	</ul>
</div>

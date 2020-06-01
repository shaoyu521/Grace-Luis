<?php if( suxingme('suxing_ad_posts_pc') ){  ?>
	<?php
		$num = suxingme('suxing_ad_posts_pc_num',3);
		if ($wp_query->current_post == $num) : ?>
			<div class="ajax-load-con content posts-cjtz hidden-xs hidden-sm <?php echo $GLOBALS['wow_single_list']; ?>">
				<?php echo suxingme('suxing_ad_posts_pc_url'); ?>
			</div>
		<?php endif; ?>
<?php } ?>
<?php if( suxingme('suxing_ad_posts_m') ){  ?>
	<?php
		$num = suxingme('suxing_ad_posts_m_num');
		if ($wp_query->current_post == $num) : ?>
			<div class="ajax-load-con content posts-cjtz-min hidden-md hidden-lg <?php echo $GLOBALS['wow_single_list']; ?>">
				<?php echo suxingme('suxing_ad_posts_m_url'); ?>
			</div>
		<?php endif; ?>
<?php }

$metainfo = suxingme('single_metainfo');
$dis_author = $metainfo['author'];
$dis_cat  = $metainfo['cat'];
$dis_time = $metainfo['time'];
$dis_view = $metainfo['view'];
$dis_like = $metainfo['like'];
$cc_value = get_post_meta($post->ID,"cc_value",true );

if( has_post_format( 'link' ) ){ //推广文章?>
<div class="ajax-load-con content <?php echo $GLOBALS['wow_single_list']; ?>">
	<div class="content-box posts-gallery-box">
		<div class="posts-gallery-img">
			
			<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>>	
				<?php if( suxingme('suxingme_timthumb') && suxingme('suxingme_timthumb_lazyload',true) ) { ?>
					<img class="lazy thumbnail" data-original="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=173.98&w=231.98&zc=1" src="<?php echo constant("THUMB_SMALL_DEFAULT");?>" alt="<?php the_title(); ?>" />	
				<?php }
				if ( suxingme('suxingme_timthumb') && !suxingme('suxingme_timthumb_lazyload',true) ) {	?>
					<img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=173.98&w=231.98&zc=1" alt="<?php the_title(); ?>" />
				<?php } if( suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb') ){ ?>
					<img src="<?php echo constant("THUMB_SMALL_DEFAULT");?>" data-original="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="lazy thumbnail" />
				<?php } ?>
				<?php if( !suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb')){ ?>
					<img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="thumbnail" />
				<?php } ?>
			</a> 
		</div>
		<div class="posts-gallery-content">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>><?php the_title();?></a></h2>	
			<div class="posts-gallery-text"><?php echo wp_trim_words(get_the_excerpt(), 60 ); ?></div>
			<div class="post-style-tips">
				<span><a href="<?php echo get_post_meta($post->ID,"tuiguang_value",true ); ?>"><?php echo get_post_meta($post->ID,"tuiguangtext_value",true ); ?></a></span>
			</div>
			
		</div>
	</div>
</div>
<?php } else if ( has_post_format( 'aside' )) { //无图文章 ?>
<div class="ajax-load-con content <?php echo $GLOBALS['wow_single_list']; ?>">
	<div class="content-box posts-aside">
		<div class="posts-default-content">
			<div class="posts-default-title">
				<?php if (suxingme('suxingme_post_tags',true)) { the_tags('<div class="post-entry-categories">','','</div>'); }?>
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>><?php the_title();?></a></h2>
			</div>
			<div class="posts-text"><?php echo wp_trim_words(get_the_excerpt(), 100); ?></div>
			<div class="posts-default-info">
				<ul>
					<?php  if($dis_author == 1) {
						if( $cc_value != 2 && $cc_value != 3 ){ ?> 
							<li class="post-author hidden-xs hidden-sm"><div class="avatar"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
						<?php } ?>
					<?php } if( $cc_value == 1 ) { ?>
						<li class="postoriginal hidden-xs hidden-sm"><span><i class="icon-cc-1"></i><?php echo suxingme('suxingme_custom_cc');?></span></li>
									
					<?php }	if($dis_cat == 1) { ?>
						<li class="ico-cat"><i class="icon-list-2"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
					<?php } if($dis_time == 1) { ?>
						<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
					<?php } if($dis_view == 1) { ?>
						<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> <?php post_views('',''); ?></li>
					<?php }  if($dis_like == 1) { ?><li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> <?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></li><?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php } else if ( has_post_format( 'image' )) { //多图 ?>
<div class="ajax-load-con content <?php echo $GLOBALS['wow_single_list']; ?>">
	<div class="content-box posts-image-box">
		<div class="posts-default-title">
			<?php if (suxingme('suxingme_post_tags',true)) { the_tags('<div class="post-entry-categories">','','</div>'); }?>
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>><?php the_title();?></a></h2>
		</div>
		<div class="post-images-item">
			<ul>
				<?php echo suxingme_get_thumbnail();?>	
            </ul>
		</div>
		<div class="posts-default-content">
			<div class="posts-text"><?php echo wp_trim_words( get_the_excerpt(), 100); ?></div>
		</div>
		<div class="posts-default-info">
				<ul>
					<?php  if($dis_author == 1) { 
						if( $cc_value != 2 && $cc_value != 3 ){?> 
							<li class="post-author hidden-xs hidden-sm"><div class="avatar"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
						<?php }  ?>  
					<?php } if( $cc_value == 1 ) { ?>
						<li class="postoriginal hidden-xs hidden-sm"><span><i class="icon-cc-1"></i><?php echo suxingme('suxingme_custom_cc');?></span></li>
									
					<?php }	if($dis_cat == 1) { ?>
						<li class="ico-cat"><i class="icon-list-2"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
					<?php } if($dis_time == 1) { ?>
						<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
					<?php } if($dis_view == 1) { ?>
						<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> <?php post_views('',''); ?></li>
					<?php }  if($dis_like == 1) { ?><li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> <?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></li><?php } ?>
				</ul>
			</div>
	</div>
</div>
<?php } else if ( has_post_format( 'gallery' )) { //左图 ?>

<div class="ajax-load-con content <?php echo $GLOBALS['wow_single_list']; ?>">
	<div class="content-box posts-gallery-box">
		<div class="posts-gallery-img">
			<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>>	
				<?php if( suxingme('suxingme_timthumb') && suxingme('suxingme_timthumb_lazyload',true) ) { ?>
					<img class="lazy thumbnail" data-original="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=173.98&w=231.98&zc=1" src="<?php echo constant("THUMB_SMALL_DEFAULT");?>" alt="<?php the_title(); ?>" />	
				<?php }
				if ( suxingme('suxingme_timthumb') && !suxingme('suxingme_timthumb_lazyload',true) ) {	?>
					<img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=173.98&w=231.98&zc=1" alt="<?php the_title(); ?>" />
				<?php } if( suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb') ){ ?>
					<img src="<?php echo constant("THUMB_SMALL_DEFAULT");?>" data-original="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="lazy thumbnail" />
				<?php } ?>
				<?php if( !suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb')){ ?>
					<img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="thumbnail" />
				<?php } ?>
			</a> 
		</div>
		<div class="posts-gallery-content">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>><?php the_title();?></a></h2>
			<div class="posts-gallery-text"><?php echo wp_trim_words(get_the_excerpt(), 60 ) ;?></div>
			<div class="posts-default-info posts-gallery-info">
				<ul>
					<?php  if($dis_author == 1) { 
						if( $cc_value != 2 && $cc_value != 3 ){?> 
							<li class="post-author hidden-xs hidden-sm"><div class="avatar"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
						<?php }  ?>  
					<?php } if( $cc_value == 1 ) { ?>
						<li class="postoriginal hidden-xs hidden-sm"><span><i class="icon-cc-1"></i><?php echo suxingme('suxingme_custom_cc');?></span></li>
									
					<?php }	if($dis_cat == 1) { ?>
						<li class="ico-cat"><i class="icon-list-2"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
					<?php } if($dis_time == 1) { ?>
						<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
					<?php } if($dis_view == 1) { ?>
						<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> <?php post_views('',''); ?></li>
					<?php }  if($dis_like == 1) { ?><li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> <?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></li><?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>
<?php } else{ //标准 ?>
<div class="ajax-load-con content posts-default <?php echo $GLOBALS['wow_single_list']; ?>">
	<div class="content-box">	
		<div class="posts-default-img">
			<a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>>
				<div class="overlay"></div>	
				<?php if( suxingme('suxingme_timthumb') && suxingme('suxingme_timthumb_lazyload',true) ) { ?>
					<img class="lazy thumbnail" data-original="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=284&w=710&zc=1" src="<?php echo constant("THUMB_BIG_DEFAULT");?>" alt="<?php the_title(); ?>" />	
				<?php }
				if ( suxingme('suxingme_timthumb') && !suxingme('suxingme_timthumb_lazyload',true) ) {	?>
					<img class="thumbnail" src="<?php echo get_template_directory_uri(); ?>/timthumb.php?src=<?php echo post_thumbnail_src(); ?>&h=300&w=750&zc=1" alt="<?php the_title(); ?>" />
				<?php } if( suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb') ){ ?>
					<img src="<?php echo constant("THUMB_BIG_DEFAULT");?>" data-original="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="lazy thumbnail" />
				<?php } ?>
				<?php if( !suxingme('suxingme_timthumb_lazyload',true) && !suxingme('suxingme_timthumb')){ ?>
					<img src="<?php echo post_thumbnail_src(); ?>" alt="<?php the_title(); ?>" class="thumbnail" />
				<?php } ?>
			</a> 
		</div>
		<div class="posts-default-box">
			<div class="posts-default-title">
				<?php if (suxingme('suxingme_post_tags',true)) { the_tags('<div class="post-entry-categories">','','</div>'); }?>
				<h2><a href="<?php the_permalink(); ?>" title="<?php the_title();?>" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?>><?php the_title();?></a></h2>
			</div>
			<div class="posts-default-content">
				
				<div class="posts-text"><?php echo wp_trim_words(get_the_excerpt(), 100 );?></div>
				<div class="posts-default-info">
					<ul>
						<?php  if($dis_author == 1) { 
						if( $cc_value != 2 && $cc_value != 3){?> 
							<li class="post-author hidden-xs hidden-sm"><div class="avatar"><?php echo get_avatar( get_the_author_meta('ID') ); ?></div><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>" target="_blank"><?php echo get_the_author() ?></a></li>
						<?php } ?> 
					<?php } if( $cc_value == 1 ) { ?>
						<li class="postoriginal hidden-xs hidden-sm"><span><i class="icon-cc-1"></i><?php echo suxingme('suxingme_custom_cc');?></span></li>
									
					<?php }	if($dis_cat == 1) { ?>
							<li class="ico-cat"><i class="icon-list-2"></i> <?php $category = get_the_category();if($category[0]){echo '<a href="'.get_category_link($category[0]->term_id ).'">'.$category[0]->cat_name.'</a>';}?></li>
						<?php } if($dis_time == 1) { ?>
							<li class="ico-time"><i class="icon-clock-1"></i> <?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ); ?></li>
						<?php } if($dis_view == 1) { ?>
							<li class="ico-eye hidden-xs hidden-sm"><i class="icon-eye-4"></i> <?php post_views('',''); ?></li>
						<?php }  if($dis_like == 1) { ?><li class="ico-like hidden-xs hidden-sm"><i class="icon-heart"></i> <?php if( get_post_meta($post->ID,'suxing_ding',true) ){ echo get_post_meta($post->ID,'suxing_ding',true); } else {echo '0';}?></li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>

<?php } ?>

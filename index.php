<?php get_header();?>
<div id="page-content" <?php if( suxingme('suxing_slide_img_button','index_slide_sytle_1') == 'index_slide_sytle_3' ) { echo 'class="page-content-110"';}?>>
	<?php 
		if( suxingme('suxing_slide_img_button','index_slide_sytle_1') == 'index_slide_sytle_3' && ! is_paged() ) { 
	    	include(get_template_directory().'/includes/topslide-three-style.php' );
	    }else if( suxingme('suxing_slide_img_button','index_slide_sytle_1') == 'index_slide_sytle_2' && ! is_paged() ) {
			include( get_template_directory().'/includes/topslide-two-style.php' ); 
	    }
	    else if( suxingme('suxing_slide_img_button','index_slide_sytle_1') == 'index_slide_sytle_1' && ! is_paged() ) {
			include( get_template_directory().'/includes/topslide-one-style.php' ); 
	    }
        else if( suxingme('suxing_slide_img_button','index_slide_sytle_1') == 'index_slide_sytle_4' && ! is_paged() ) {
    		include( get_template_directory().'/includes/topslide-four-style.php' ); 
        }
	?>
	<?php if( is_home() && ! is_paged() && suxingme('suxingme_get_index3') != 'three'){  ?>	
		<div class="recommend-content">
			<div class="container">
				<div class="row">
					<div class="cat">
						<div class="thumbnail-cat">
						<?php 
							if( suxingme('suxingme_get_index3') == 'one' ) :
								$categories=explode(",",suxingme('suxing_cat_index'));
								if( $categories[0] != '' ) :
									foreach ($categories as $cat=>$catid ) { ?>
										<div class="image col-xs-12 col-sm-4 col-md-4">
											<div class="index-cat-box" style="background-image:url(<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url($catid); ?>)">
												<a  class="iscat" href="<?php echo get_category_link($catid);?>">
													<div class="promo-overlay"><?php $cat = get_category($catid);echo $cat->name; ?></div>
													<div class="modulo_line"></div>
												</a>
											</div>
										</div>
									<?php }
								else :
									echo '<h4>请在主题选项【CMS设置】-【首页3个区块-显示的分类】填写分类ID，并按照要求上传分类封面图。</h4>';
								endif;
							endif; 
							if( suxingme('suxingme_get_index3') == 'two' ) :
								$top_args = array(
									'showposts'=> '3',
									'post__in' => get_option( 'sticky_posts' ),
									);
								$top_posts = new WP_Query($top_args);
								if($top_posts->have_posts()):
									while($top_posts->have_posts()):$top_posts->the_post();
							?>
								<div class="image col-xs-12 col-sm-4 col-md-4">
									<div class="index-cat-box" <?php if( suxingme('suxingme_post_target')) { echo 'target="_blank"';}?> style="background-image:url(<?php echo post_thumbnail_src(); ?>)">
										<a class="istop" href="<?php the_permalink();?>">
											<div class="overlay"></div>
											<div class="title"><span><?php $catarr=get_the_category(); echo $catarr[0]->cat_name; ?></span><h3><?php the_title();?></h3></div>
										</a>
									</div>
								</div>
						<?php endwhile; else : echo '<li>暂无文章</li>'; endif; wp_reset_postdata(); endif;?>
						<?php 
						if( suxingme('suxingme_get_index3') == 'four' ) : 
							$special = explode(",",suxingme('suxing_cat_index'));
							if( $special[0] != '' ) :
								foreach ( $special as $key => $value ) { 
									$term = get_term( $value, 'special' );
						?>
									<div class="image col-xs-12 col-sm-4 col-md-4">
										<div class="index-cat-box" style="background-image:url(<?php if (function_exists('z_taxonomy_image_url')) echo z_taxonomy_image_url($term->term_id); ?>)">
											<a  class="istopic" href="<?php echo get_term_link($term->term_id);?>">
												<div class="overlay"></div>
												<div class="topic-title">
													<h3><?php echo $term->description; ?></h3>
													<button class="btn btn-read-topic">查看专题</button>
												</div>
												
											</a>
										</div>
									</div>

								<?php }
							else :
								echo '<h4>请在主题选项【CMS设置】-【首页3个区块-显示的分类】填写专题ID，并按照要求上传专题封面图。</h4>';
							endif;
						endif; ?>
									
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<?php if(suxingme('suxingme_new_post',true)) { ?>
		<div class="main-content">
			<div class="container">
				<div class="row">
					<div class="article col-xs-12 col-sm-8 col-md-8">
					<?php
						if( suxingme('suxing_index_custom_cat_tab',false) && suxingme('suxingme_ajax_posts',false) ){
							$count_posts = wp_count_posts();
							$published_posts = $count_posts->publish;
							$new_post_total = ceil($published_posts / get_option('posts_per_page'));
					?>
						<div class="post-nav">
							<span class="new-post current" data-paged="1" data-action="fa_load_postlist" data-home="true" data-total="<?php echo $new_post_total;?>">最新</span>
							<?php
								$str = suxingme('suxing_index_custom_cat_tab_id');
								$cat_arr = explode(",",$str);
								for ($i=0; $i < count($cat_arr); $i++) {
									$thisCat = get_category($cat_arr[$i]);
									$total = ceil($thisCat->count / get_option('posts_per_page')); 
									echo '<span class="cat-post" data-category="'.$thisCat->cat_ID.'" data-paged="1" data-action="fa_load_postlist" data-total="'.$total.'">'.$thisCat->cat_name.'</span>';
								}
							?>
						</div>
					<?php } ?>

					<?php
						if( suxingme('suxingme_get_index3') == 'two' ) { $sticky_value = 1; } else { $sticky_value = 0; }
						$args = array(
							'paged' => $paged,
							'ignore_sticky_posts' => $sticky_value,
						);
						if( suxingme('notinhome') ){
							$pool = array();
							foreach (suxingme('notinhome') as $key => $value) {
								if( $value ) $pool[] = $key;
							}
							$args['cat'] = '-'.implode($pool, ',-');
						}		
						query_posts($args);
						if ( have_posts() ) : ?>
							<div class="ajax-load-box posts-con">
								<?php while ( have_posts() ) : the_post(); 
									include( get_template_directory().'/includes/excerpt.php' );endwhile; ?>
							</div>
							<div class="clearfix"></div>
							<?php if( suxingme('suxingme_ajax_posts',true) ) { ?>
								<div id="ajax-load-posts">
									<?php echo fa_load_postlist_button();?>
								</div>
								
								<?php  }else {
									the_posts_pagination( array(
										'prev_text'=>'上页',
										'next_text'=>'下页',
										'screen_reader_text' =>'',
										'mid_size' => 1,
									) ); } ?>
								<?php 	else :
								get_template_part( 'content', 'none' );

						endif;?>
					</div>
					<?php get_sidebar(); ?>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
<!--wp-compress-html--><!--wp-compress-html no compression-->
<?php	if( suxingme('dbfl',false) ) :?>
<div class="post-wall">
	<div class="banner-top-one"></div>
            <div class="swiper-container">
                <div class="swiper-wrapper">
<?php
$args=array(
'cat' => suxingme('dbflid'),
'posts_per_page' => suxingme('dbflxssl'),
);
query_posts($args);
if(have_posts()) : while (have_posts()) : the_post();
?>
                    <div class="swiper-slide">
                        <a href="<?php the_permalink();?>">
                            <img class="lazy thumbnail" data-original="/wp-content/themes/Grace-Luis/timthumb.php?src=<?php echo catch_that_image() ?>&h=292&w=506&zc=1" src="/wp-content/themes/Grace-Luis/timthumb.php?src=<?php echo catch_that_image() ?>&h=292&w=506&zc=1" about="<?php the_title();?>" title="<?php the_title();?>">
                        </a>
                    </div>
<?php endwhile; endif; wp_reset_query(); ?>
                </div>
                <div class="banner-arrow">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>
            <div class="swiper-pagination"></div>

        </div>
	</div>
	<script type="text/javascript">

            window.onload = function() {
                var swiper = new Swiper('.swiper-container',{
                    autoplay: false, //是否自动滚动
                    speed: 500,      //滚动速速
                    autoplayDisableOnInteraction: true,
                    loop: true,
                    centeredSlides: true,
                    slidesPerView: 3, //当前选中
                    pagination: '.swiper-pagination',
                    paginationClickable: true,
                    prevButton: '.swiper-button-prev', // 左右切换
                    nextButton: '.swiper-button-next', // 左右切换
                    onInit: function(swiper) {
                        swiper.slides[3].className = "swiper-slide swiper-slide-active"; //当前选中 状态
                    },
                    breakpoints: {
                        100: {
                            slidesPerView: 0,
                        }
                    }
                });
            }

        </script>
       <?php endif; ?>
<!--wp-compress-html no compression--><!--wp-compress-html-->
<?php get_footer(); ?>
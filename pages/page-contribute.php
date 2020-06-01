<?php
/*
Template Name: 投稿页面
*/

$contribute_cat_id = explode(',',suxingme('contribute_cat_id'));

get_header();
if(have_posts()): while(have_posts()):the_post();  ?>
<div class="page-single" >
	<div class="page-title" style="background-image:url(<?php echo contri_banner_pic(); ?>);">
		<div class="container">
			<h1 class="title">
				<?php the_title(); ?>
			</h1>
		</div>
	</div>
	<div class="container">
		<div class="page-contribute">
			<div class="contribute-item contribute-content">
				<div class="form-group">
	              	<div class="form-control-box">
	              		<input type="text" name="title" id="title" class="form-control" placeholder="请输入标题">
	              		<div class="form-control-border"></div>
	              	</div>
	              	<div class="tips-error">
	                	<i class="icon-info-circled-2"></i>请填写文章标题！
	                </div>
	          	</div>
	          	<div class="form-group">
	          		<div class="form-upimg">
	          			<span><i class="icon-picture"></i>添加图片</span>
		          		<input id="upimg" type="file" name="image">
		          		
		          	</div>
	          		<?php 
	          		wp_editor( 
	          			'', 
	          			'post_content', 
	          			array(
	          				'teeny' => false,
	          				'media_buttons'	=> false,
	          				'quicktags'=> false,
	          				'editor_css' =>'<style></style>',
	          				'dfw'	=> true,
	          				'editor_height' => 300,
	          			)
	          		); ?>
	          		<div class="form-control-border"></div>
	          		<div class="tips-error">
                    	<i class="icon-info-circled-2"></i>请输入不少于200字的文章内容！
                    </div>
	          	</div>
			</div>
			<div class="contribute-item contribute-meta">
				<h3><span>文章分类</span></h3>
				<p>选择本文的分类，可多选</p>
				<ul class="contribute-cat" id="contribute-cat">
					<?php
						for ($i=0; $i < count($contribute_cat_id) ; $i++) { 
							echo '<li data-id="'.$contribute_cat_id[$i].'">'.get_category($contribute_cat_id[$i])->name.'</li>';
						}
					?>
				</ul>
				<div class="tips-error">
                	<i class="icon-info-circled-2"></i>请输入符合文章类型的分类！
                </div>
			</div>
			<div class="contribute-item contribute-copyright">
				<h3><span>版权说明</span></h3>
                <div class="suxing-radio">
                    <input type="radio" name="radio1" id="radio1" value="option1" checked>
                    <label for="radio1" class="radio" >
                        授权本站及本站有合作关系的第三方平台发布您的原创稿件<em>请您放心，授权会严格满足转载规范，标明您的姓名及来源等信息</em>
                    </label>
                    <div class="copy-meta">
                        <div class="form-group">
			              	<input type="text" name="name" id="name" class="form-control" placeholder="请输入姓名">
			              	<div class="form-control-border"></div>
			          	</div>
			          	<div class="form-group">
			              	<input type="text" name="source" id="source" class="form-control" placeholder="请输入来源网址">
			              	<div class="form-control-border"></div>
			          	</div>
			        </div>
                </div>
                <div class="suxing-radio">
                    <input type="radio" name="radio1" id="radio2" value="option2">
                    <label for="radio2">
                        匿名投稿
                    </label>
                </div>
                <div class="tips-error">
                	<i class="icon-info-circled-2"></i>请选择
                </div>
			</div>
			<button class="btn-contribute" id="nice-check-contribute">提交稿件</button>
		</div>
	</div>
</div>
<!-- Mail Check Modal -->
<div class="modal fade" id="mailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  	<div class="modal-dialog" role="document">
	    <div class="modal-content">
	      	<div class="modal-header">
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        	<h4 class="modal-title" id="myModalLabel">邮箱验证</h4>
	      	</div>
	      	<div class="modal-body">
	        		<div class="form-group">
                        <label for="email" class="control-label">常用邮箱</label>
                        <input class="form-control" id="email" name="email" type="text" placeholder="输入常用邮箱接收验证码" value="">
                    </div>
                    <div class="form-group clearfix">
                        <label for="code" class="control-label">验证码</label>
                        <div class="row">
                        	<div class="col-xs-7 col-sm-8 col-md-8"> 
                        		<input class="form-control" id="code" name="code" type="text" placeholder="请输入验证码" value="">
                        	</div>
                        	<div class="col-xs-5 col-sm-4 col-md-4">
                        		<button class="btn btn-default" id="nice-do-contribute-verify-code" data-nonce="<?php echo wp_create_nonce('nice-do-contribute-verify-code'); ?>">获取验证码</button>
                        	</div>
                        </div>
                        <div class="tips-error">
                        	<i class="icon-info-circled-2"></i>验证码有误！
                        </div>
                    </div>
	      	</div>
	      	<div class="modal-footer">
	      		<input id="nonce" type="hidden" value="<?php echo wp_create_nonce('do-contribute'); ?>">
	        	<button type="button" class="btn btn-default" data-dismiss="modal">再想想</button>
	        	<button type="button" class="btn btn-primary" id="do-contribute">确认投稿</button>
	      	</div>
	    </div>
  	</div>
</div>
<?php endwhile; endif; ?>	
<?php get_footer(); ?>

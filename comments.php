<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="clearfix">

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
	?>	
		<div id="respond">
			<p class="tips"><?php echo '评论已关闭。'; ?></p>
		</div>	
	<?php else: ?>
	<?php if( !have_comments() ): ?>

	<?php else: ?>
		<div class="comments-box">
			<h3 class="comments-title">全部评论：<span class="comments-num"><?php  echo get_comments_number();?>条</span></h3>
			<div id="loading-comments"><span><i class="icon-spin6 animate-spin"></i> 加载中...</span></div>
			<ol class="commentlist">
				<?php wp_list_comments('avatar_size=40&type=comment&callback=wpmee_comment&end-callback=wpmee_end_comment&max_depth='.get_option('thread_comments_depth'));	?>
			</ol><!-- .comment-list -->
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div id="comments-navi">
				<?php paginate_comments_links('prev_text=<i class="icon-left-open-1"></i>&next_text=<i class="icon-right-open-1"></i>'); ?>
			</div>
		
		<?php endif;?>	
		</div>
	<?php endif;?>
	
	<div id="respond"  class="respond-box">
		<h3 class="comments-title">发表评论 <span id="cancel-comment-reply"><?php cancel_comment_reply_link(); ?></span></h3>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			<p class="tips"><?php print '您必须'; ?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"> [ 登录 ] </a>才能发表留言！</p>
		<?php else : ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if ( $user_ID ) : ?>
					<div class="comment-from-main">
						<div class="logged-in-as">你好，<?php echo $user_identity; ?> ！ <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出"><?php echo '退出'; ?></a></div>
					</div>
				<?php elseif ( '' != $comment_author ): ?>
					<div class="comment-from-main">
						<div class="logged-in-as"><?php printf(__('你好，%s，'), $comment_author); ?>
							<a href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info"><i>[ 资料修改 ]</i></a>
						</div>
					</div>
					<script type="text/javascript" charset="utf-8">
						//<![CDATA[
						var changeMsg = "<i>[ 资料修改 ]</i>";
						var closeMsg = "<i>[ 收起来 ]</i>";
						function toggleCommentAuthorInfo() {
							jQuery('#comment-author-info').slideToggle('slow', function(){
								if ( jQuery('#comment-author-info').css('display') == 'none' ) {
								jQuery('#toggle-comment-author-info').html(changeMsg);
								} else {
								jQuery('#toggle-comment-author-info').html(closeMsg);
								}
							});
						}
						jQuery(document).ready(function(){
							jQuery('#comment-author-info').hide();
						});
						//]]>
					</script>
				<?php endif; ?>
				
				<?php if ( ! $user_ID ): ?>	  
					<div id="comment-author-info" class="clearfix"> 
						<div class="comment-md-3">
							<label for="author">昵称<span class="required">*</span></label>
							<input type="text" name="author" id="author" class="comment-md-9" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
						</div>
						<div class="comment-md-3">
							<label for="email">邮箱<span class="required">*</span></label>
							<input type="email" name="email" id="email" class="comment-md-9" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
						</div>
						<div class="comment-md-3 comment-form-url">
							<label for="url">网址<span class="required"></span></label>
							<input type="text" name="url" id="url" class="comment-md-9" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
						</div>
					</div>
				<?php endif; ?>
				<div class="comment-from-main clearfix">
					<div class="comment-form-textarea">
						<div class="comment-textarea-box">
							<textarea class="comment-textarea" name="comment" id="comment"  placeholder="说点什么吧..."></textarea>
						</div>
					</div>

					<div class="form-submit">
						<button id="smilies" class="btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    						<i class="icon-emo-happy"></i> 表情
  						</button>
						<div class="dropdown-menu dropdown-menu-left comment-form-smilies" aria-labelledby="smilies">
						    <div class="smilies-box"><?php echo alu_get_wpsmiliestrans();?></div>
						</div>
						<input class="btn-comment pull-right" name="submit" type="submit" id="submit" tabindex="5" title="发表评论" value="发表评论">
						<?php comment_id_fields(); ?>
						<?php do_action('comment_form', $post->ID); ?>
					</div>
					
				</div>
				<script type="text/javascript">	//Crel+Enter
				//<![CDATA[
					jQuery(document).keypress(function(e){
						if(e.ctrlKey && e.which == 13 || e.which == 10) { 
							jQuery("#submit").click();
							document.body.focus();
						} else if (e.shiftKey && e.which==13 || e.which == 10) {
							jQuery("#submit").click();
						}          
					})
				// ]]>
				</script>
			</form>
		<?php endif; ?>
	</div>	
</div>	
<?php endif; ?>
<?php 
/*
* 阅读日志页面
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="row">
    <div class="span9" id="content">
		<div id="ajax_content">
    	<div class="post pleft">
            <div class="page-header">
	<h2><?php topflg($top); ?><?php echo $log_title; ?></h2>
	<h6><span>Author : <?php blog_author($value['author']); ?> / </span>
	<span>Post Time : <?php echo gmdate('Y-n-j G:i l', $value['date']); ?> / </span>
	<span>Sort : <?php blog_sort($value['logid']); ?></span>
    </h6>
	<div class="entry-content"><?php echo $log_content; ?></div>
	<div class="entry-tags">Tags : <?php blog_tag($logid); ?></div>
	<?php doAction('log_related', $logData); ?>
	</div>
	</div><!-- End Post -->
	<hr class="soften" />
	<?php blog_trackback($tb, $tb_url, $allow_tb); ?>
	<?php blog_comments($comments); ?>
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
	</div>
	</div> <!-- end #content-->
<?php
 include View::getView('side');
?>
</div>

<?php
 include View::getView('footer');
?>
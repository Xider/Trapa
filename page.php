<?php 
/*
* 自建页面模板
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="row">
    <div class="span9" id="content">
		<div id="ajax_content">
        <div class="post pleft">
            <div class="page-header">
                <h2>
                    <?php echo $log_title; ?>
                    <small></small>
                </h2>
                <h6>
                	<span>Author :<?php blog_author($value['author']); ?> / </span>
    <span>Post Time :<?php echo gmdate('Y-n-j G:i l', $value['date']); ?></span>
                </h6>
                </div>
    <div class="entry-content">
	<?php echo $log_content; ?>
	</div>
	</div>
	<hr class="soften" />
	<?php blog_comments($comments); ?>
	<?php blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark); ?>
	</div>
	</div><!-- end #content-->
<?php
 include View::getView('side');
?>
</div>
<?php
 include View::getView('footer');
?>
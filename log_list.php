<?php 
/*
* 首页日志列表部分
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="row">
    <div class="span9" id="content">
		<div id="ajax_content">
<?php doAction('index_loglist_top'); ?>
<?php foreach($logs as $value): ?>
<div id="post" class="post pleft">
    <div class="page-header">
	<h2><?php topflg($value['top']); ?><a href="<?php echo $value['log_url']; ?>"><?php echo $value['log_title']; ?></a><small></small></h2>
	<h6><span>Author : <?php blog_author($value['author']); ?> / </span>
		<span>Post Time : <?php echo gmdate('Y-n-j G:i l', $value['date']); ?> / </span>
	<span>Sort : <?php blog_sort($value['logid']); ?> / </span>
	<a href="<?php echo $value['log_url']; ?>#comments"><?php echo $value['comnum']; ?> Comments</a><span> / </span>
	<a href="<?php echo $value['log_url']; ?>"><?php echo $value['views']; ?> Views</a>
	</h6>
	<div class="entry-content">
	<?php echo $value['log_description']; ?>
    </div>
	</div>
</div><!-- End Post -->
<hr class="soften" />
<?php endforeach; ?>

<div id="page-nav" class="pagination box">
	<?php echo $page_url;?>
</div>

		</div>
</div> <!-- end #content-->
<?php
 include View::getView('side');
?>
</div>

<?php
 include View::getView('footer');
?>
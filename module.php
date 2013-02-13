<?php 
/*
* 侧边栏组件、页面模块
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
//widget：blogger
function widget_blogger($title){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$name = $user_cache[1]['mail'] != '' ? "<a href=\"mailto:".$user_cache[1]['mail']."\">".$user_cache[1]['name']."</a>" : $user_cache[1]['name'];?>
	<div class="widget box">
	<h3><?php echo $title; ?></h3>
	<ul id="bloggerinfo">
	<div id="bloggerinfoimg">
	<?php if (!empty($user_cache[1]['photo']['src'])): ?>
	<img src="<?php echo BLOG_URL.$user_cache[1]['photo']['src']; ?>" width="<?php echo $user_cache[1]['photo']['width']; ?>" height="<?php echo $user_cache[1]['photo']['height']; ?>" alt="blogger" />
	<?php endif;?>
	</div>
	<p><b><?php echo $name; ?></b>
	<?php echo $user_cache[1]['des']; ?></p>
	</ul>
	</div>
<?php }?>
<?php
//widget：日历
function widget_calendar($title){ ?>
	<div class="widget box">
	<h3><?php echo $title; ?></h3>
	<div id="calendar">
	</div>
	<script>sendinfo('<?php echo Calendar::url(); ?>','calendar');</script>
	</div>
<?php }?>
<?php
//widget：标签
function widget_tag($title){
	global $CACHE;
	$tag_cache = $CACHE->readCache('tags');?>
	<div class="widget box">
	<h3><?php echo $title; ?>></h3>
	<ul id="blogtags">
	<?php foreach($tag_cache as $value): ?>
		<span style="font-size:<?php echo $value['fontsize']; ?>pt; line-height:30px;">
		<a href="<?php echo Url::tag($value['tagurl']); ?>" title="<?php echo $value['usenum']; ?> 篇日志"><?php echo $value['tagname']; ?></a></span>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：分类
function widget_sort($title){
	global $CACHE;
	$sort_cache = $CACHE->readCache('sort'); ?>
	<div class="widget box">
	<h3><?php echo $title; ?></h3>
	<ul id="blogsort">
	<?php foreach($sort_cache as $value): ?>
	<li>
	<a href="<?php echo Url::sort($value['sid']); ?>"><?php echo $value['sortname']; ?>(<?php echo $value['lognum'] ?>)</a>
	</li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新碎语
function widget_twitter($title){
	global $CACHE; 
	$newtws_cache = $CACHE->readCache('newtw');
	$istwitter = Option::get('istwitter');
	?>
	<div class="widget box">
	<h3><?php echo $title; ?></h3>
	<ul id="twitter">
	<?php foreach($newtws_cache as $value): ?>
	<?php $img = empty($value['img']) ? "" : '<a title="查看图片" class="t_img" href="'.BLOG_URL.str_replace('thum-', '', $value['img']).'" target="_blank">&nbsp;</a>';?>
	<li><?php echo $value['t']; ?><?php echo $img;?><p><?php echo smartDate($value['date']); ?></p></li>
	<?php endforeach; ?>
    <?php if ($istwitter == 'y') :?>
	<p><a href="<?php echo BLOG_URL . 't/'; ?>">更多&raquo;</a></p>
	<?php endif;?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	?>
	<div class="widget box">
	<h3><?php echo $title; ?></h3>
	<ul id="newcomment">
	<?php
	foreach($com_cache as $value):
	$url = Url::comment($value['gid'], $value['page'], $value['cid']);
	?>
	<li><?php echo $value['name']; ?>
	<br /><a href="<?php echo $url; ?>"><?php echo $value['content']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：最新日志
function widget_newlog($title){
	global $CACHE; 
	$newLogs_cache = $CACHE->readCache('newlog');
	?>
	<div class="widget box">
	<h3><?php echo $title; ?></h3>
	</ul>
	<?php foreach($newLogs_cache as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：热门日志
function widget_hotlog($title){
	$index_hotlognum = Option::get('index_hotlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getHotLog($index_hotlognum);?>
	<div class="widget box">
	<h3><?php echo $title; ?></h3>
	<ul id="hotlog">
	<?php foreach($randLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//widget：随机日志
function widget_random_log($title){
	$index_randlognum = Option::get('index_randlognum');
	$Log_Model = new Log_Model();
	$randLogs = $Log_Model->getRandLog($index_randlognum);?>
	<div class="widget box">
	<h3><?php echo $title; ?></h3>
	<ul id="randlog">
	<?php foreach($randLogs as $value): ?>
	<li><a href="<?php echo Url::log($value['gid']); ?>"><?php echo $value['title']; ?></a></li>
	<?php endforeach; ?>
	</ul>
</div>
<?php }?>
<?php
//widget：搜索
function widget_search($title){ ?>
	<div class="widget_search">
	<form class="form-search" id="searchform" name="keyform" method="get" action="<?php echo BLOG_URL; ?>index.php">
	<input name="keyword" class="span2" type="text" id="s" />
	<button type="submit" class="btn" id="searchsubmit">搜索</button>
	</form>
	</div>
<?php } ?>
<?php
//widget：归档
function widget_archive($title){
	global $CACHE; 
	$record_cache = $CACHE->readCache('record');
	?>
	<div class="widget box">
	<h3><?php echo $title; ?></h3>
	<ul id="record">
	<?php foreach($record_cache as $value): ?>
	<li><a href="<?php echo Url::record($value['date']); ?>"><?php echo $value['record']; ?>(<?php echo $value['lognum']; ?>)</a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php } ?>
<?php
//widget：自定义组件
function widget_custom_text($title, $content){ ?>
	<div class="widget box">
	<h3><?php echo $title; ?></h3>
	<ul>
	<?php echo $content; ?>
	</ul>
	</div>
<?php } ?>
<?php
//widget：链接
function widget_link($title){
	global $CACHE; 
	$link_cache = $CACHE->readCache('link');
	?>
	<div class="widget box">
	<h3><?php echo $title; ?></h3>
	<ul id="link">
	<?php foreach($link_cache as $value): ?>
	<li><a href="<?php echo $value['url']; ?>" title="<?php echo $value['des']; ?>" target="_blank"><?php echo $value['link']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</div>
<?php }?>
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
            <div class="container">
                <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
            <a class="brand" href="<?php echo BLOG_URL; ?>">
                    Trapa
                </a>
          <div class="nav-collapse">
                    <ul id="nav" class="nav">
	<?php 
	foreach($navi_cache as $value):
		if($value['url'] == 'admin' && (ROLE == 'admin' || ROLE == 'writer')):
			?>
			<li><a href="<?php echo BLOG_URL; ?>admin/write_log.php">写日志</a></li>
			<li><a href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li><a href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
						<li class="divider-vertical"></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
		$value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
		$current_tab = (BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url']) ? 'current' : 'common';
		?>
		<li class="<?php echo $current_tab;?>"><a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a></li>
						<li class="divider-vertical"></li>
	<?php endforeach; ?>

	</ul>
	</div><!--/.nav-collapse -->
	</div>
	</div>
        </div>
<?php }?>
<?php
//blog：置顶
function topflg($istop){
	$topflg = $istop == 'y' ? "<img src=\"".TEMPLATE_URL."/images/import.gif\" title=\"置顶日志\" /> " : '';
	echo $topflg;
}
?>
<?php
//blog：编辑
function editflg($logid,$author){
	$editflg = ROLE == 'admin' || $author == UID ? '<a href="'.BLOG_URL.'admin/write_log.php?action=edit&gid='.$logid.'">编辑</a>' : '';
	echo $editflg;
}
?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
	<a href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php endif;?>
<?php }?>
<?php
//blog：日志标签
function blog_tag($blogid){
	global $CACHE;
	$log_cache_tags = $CACHE->readCache('logtags');
	if (!empty($log_cache_tags[$blogid])){
		$tag = '';
		foreach ($log_cache_tags[$blogid] as $value){
			$tag .= "   <span class='label label-info'><a href=\"".Url::tag($value['tagurl'])."\">".$value['tagname'].'</a></span>';
		}
		echo $tag;
	}
}
?>
<?php
//blog：日志作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：相邻日志
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	&laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>
		|
	<?php endif;?>
	<?php if($nextLog):?>
		 <a href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>&raquo;
	<?php endif;?>
<?php }?>
<?php
//blog：引用通告
function blog_trackback($tb, $tb_url, $allow_tb){
    if($allow_tb == 'y' && Option::get('istrackback') == 'y'):?>
	<div id="trackback_address" class="box" style="padding-bottom: 5px;">
	<p>引用地址: <input type="text" style="width:350px" class="input" value="<?php echo $tb_url; ?>">
	<a name="tb"></a></p>
	</div>
	<?php endif; ?>
	<?php foreach($tb as $key=>$value):?>
		<ul id="trackback">
		<li><a href="<?php echo $value['url'];?>" target="_blank"><?php echo $value['title'];?></a></li>
		<li>BLOG: <?php echo $value['blog_name'];?></li><li><?php echo $value['date'];?></li>
		</ul>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：评论列表
function blog_comments($comments){
    extract($comments);
    if($commentStacks): ?>
    <div id="comments" class="box">
	<a name="comments"></a>
	<h3>不明真相围观的群众：</h3>
	<?php endif; ?>
	<div id="comment-list">
	<ol class="comment-list">
		<div id="ajax_comment">
	<?php
	$isGravatar = Option::get('isgravatar');
	foreach($commentStacks as $cid):
    $comment = $comments[$cid];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<div class="comment-body comment-parent comment-odd" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<div class="comment-author">
		<?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo getGravatar($comment['mail']); ?>" /></div><?php endif; ?>
		<cite class="fn"><?php echo $comment['poster']; ?> </cite>
	</div>
	<div class="comment-meta">
        <?php echo $comment['date']; ?>
    </div>
		<div class="comment-content"><?php echo $comment['content']; ?></div>
			<?php if($comment['level'] < 4): ?><div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div><?php endif; ?>
		<?php blog_comments_children($comments, $comment['children']); ?>
		</div>
	<?php endforeach; ?>
		</div>
	</ol>
</div>
		</div>
    <div id="pagenavi" class="box">
		<div id="ajax_page">
	    <?php echo $commentPageUrl;?>
		</div>
    </div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){
	$isGravatar = Option::get('isgravatar');
	foreach($children as $child):
	$comment = $comments[$child];
	$comment['poster'] = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
	?>
	<div class="comment-body comment-child comment-level-odd comment-odd" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<div class="comment-author">
			<?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo getGravatar($comment['mail']); ?>" /></div><?php endif; ?>
			<cite class="fn"><?php echo $comment['poster']; ?> </cite>
		</div>
		<div class="comment-meta">
        <?php echo $comment['date']; ?>
    </div>
			<div class="comment-content"><?php echo $comment['content']; ?></div>
			<?php if($comment['level'] < 4): ?><div class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)">回复</a></div><?php endif; ?>
		</div>
		<?php blog_comments_children($comments, $comment['children']);?>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'): ?>
	<fieldset id="comment-place" class="box">
	<div class="comment-post" id="comment-post">
		<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
		<legend>New Comment »<a name="respond"></a></legend>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<div class="control-group">
				<label class="control-label" for="author"><small>Name</small></label>
				<input type="text" class="input-large" name="comname" maxlength="49" value="<?php echo $ckname; ?>" size="22" tabindex="1">
			</div>
			<div class="control-group">
				<label class="control-label" for="email"><small>Email</small></label>
				<input type="text" class="input-large" name="commail"  maxlength="128"  value="<?php echo $ckmail; ?>" size="22" tabindex="2">
			</div>
			<div class="control-group"> 
				<label class="control-label" for="url"><small>Website</small></label>
				<input type="text" class="input-large" name="comurl" maxlength="128"  value="<?php echo $ckurl; ?>" size="22" tabindex="3">
			</div>
			<div class="control-group"><label class="control-label" for="url">Comment</label>
				<div class="controls">
                            <textarea class="input-xlarge" name="comment" id="comment" rows="3" tabindex="4"></textarea>
                            <p class="help-block">Type your comment here...</p>
                        </div>        
			</div>
			<div class="control-group">
				<div class="controls"><?php echo $verifyCode; ?> </div></div>

<div class="form-actions">
                        <input class="btn btn-primary submit" type="submit" id="comment_submit" value="Submit" tabindex="6" />
<div id="commiting" class="alert alert-info">Now I Am Pushing Your Comment ...</div>
	<div id="error" class="alert alert-error"></div>	
                    </div>	
			<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
		</form>
	</div>
	</fieldset>
	<?php endif; ?>
<?php }?>
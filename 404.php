<?php 
/*
* 自定义404页面
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
?>
<?php
 include View::getView('header');
?>
<div class="row">
    <div class="span9" id="content">
        <div class="post">
            <div class="page-header">
                <h1>
                	404 - 你所请求的页面不存在
                <small></small>
                </h1>
            </div>
            <a href="<?php echo BLOG_URL; ?>"><?php _e('返回首页'); ?></a>
        </div>
        <hr class="soften" />
    </div><!-- end #content-->
<?php
 include View::getView('side');
?>
</div>
<?php
 include View::getView('footer');
?>
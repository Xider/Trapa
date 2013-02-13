<?php
/*
Template Name:Trapa
Description:基于 Bootstrap 的 Emlog 主题
Version:1.0
Author:Xider
Author Url:http://blog.i-xider.com
Sidebar Amount:1
ForEmlog:5.0.0
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $site_title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="generator" content="emlog" />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL; ?>xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL; ?>wlwmanifest.xml" />
<link rel="alternate" type="application/rss+xml" title="RSS"  href="<?php echo BLOG_URL; ?>rss.php" />
<link href="<?php echo TEMPLATE_URL; ?>styles.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo TEMPLATE_URL; ?>css/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo TEMPLATE_URL; ?>css/bootstrap-responsive.min.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo TEMPLATE_URL; ?>styles.css" />
	
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="images/favicon.ico">
<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

<?php doAction('index_head'); ?>
</head>
<body>
<div class="container">
<!-- header begin -->
<header class="jumbotron" id="overview">
    <h1><a href="<?php echo BLOG_URL; ?>"><?php echo $blogname; ?></a><p class="lead"><?php echo $bloginfo; ?></p></h1>
<?php blog_navi();?>
</header>
	<div id="loading" class="alert-info alert" style="display:none;position: fixed;top: 70px;right: 50px;"><strong>Now Loading ...</strong></div>
<!-- header end -->
<div class="content">
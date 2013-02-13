<?php 
/*
* 底部信息
*/
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<footer>
	<p>
Powered by <a href="http://www.emlog.net" title="emlog <?php echo Option::EMLOG_VERSION;?>">EMLOG</a>.
<a href="http://lab.i-xider.com/trapa">Trapa</a> theme by <a href="http://blog.i-xider.com">Xider</a>.  
<a href="http://www.miibeian.gov.cn" target="_blank"><?php echo $icp; ?></a> <?php echo $footer_info; ?>
</p>
<?php doAction('index_footer'); ?>
</footer><!--end #footer-->

</div>
</div>	
<script src="<?php echo TEMPLATE_URL; ?>js/jquery-1.7.1.min.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/jquery.trapa.js"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/common_tpl.js" type="text/javascript"></script>
<script src="<?php echo TEMPLATE_URL; ?>js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('.page-navigator:not(:has(a))').html('<a>...</a>');
    $('.page-navigator .current').addClass('active'); 
    $('.entry-content a').attr('target','_blank');
</script>
<script type="text/javascript">
  WebFontConfig = {
    google: { families: [ 'Open+Sans:400' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })(); </script>

</body>
</html>
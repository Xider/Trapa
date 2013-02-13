$body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
$('#post a,#nav a,header a,#page-nav a').live('click', function(e){
	var load_url=$(this).attr("href");
	e.preventDefault();
	$.ajax({
		type: "GET",
		url: load_url,
		beforeSend: function(){
        	document.body.style.cursor = 'wait';
				var C=0.7;
				$('.span9').css({opacity:C,MozOpacity:C,KhtmlOpacity:C,filter:'alpha(opacity=' + C * 100 + ')'});
				$('#loading').slideDown();
        },
		error: function(request) 
			{
				alert(request.responseText);
			},
		dataType: "html",
        success: function(out){
        	result = $(out).find('#ajax_content');
				$('#content').html(result);
				window.history.pushState('', '', load_url);
			var C=1; 
				$('#content').css({opacity:C,MozOpacity:C,KhtmlOpacity:C,filter:'alpha(opacity=' + C * 100 + ')'});
				$('#loading').slideUp();
				document.body.style.cursor = 'auto';
        	$body.animate( { scrollTop: $("#content").offset().top - 150}, 500);
        },
	});
});
$('#pagenavi a').live('click', function(e){
	var load_url=$(this).attr("href");
	e.preventDefault();
	$.ajax({
		type: "GET",
		url: load_url,
		beforeSend: function(){
        	document.body.style.cursor = 'wait';
				var C=0.7;
				$('#comments').css({opacity:C,MozOpacity:C,KhtmlOpacity:C,filter:'alpha(opacity=' + C * 100 + ')'});
				$('#loading').slideDown();
        },
		error: function(request) 
			{
				alert(request.responseText);
			},
		dataType: "html",
        success: function(out){
        	result = $(out).find('#ajax_comment');
			nextlink = $(out).find('#ajax_page');
				$('#comment_list').html(result);
			$('#pagenavi').html(nextlink);
				window.history.pushState('', '', load_url);
			var C=1; 
				$('#comments').css({opacity:C,MozOpacity:C,KhtmlOpacity:C,filter:'alpha(opacity=' + C * 100 + ')'});
				$('#loading').slideUp();
				document.body.style.cursor = 'auto';
        	$body.animate( { scrollTop: $("#comments").offset().top - 150}, 500);
        },
	});
});
function focusEle(ele){
	try {document.getElementById(ele).focus();}
	catch(e){}
}
function updateEle(ele,content){
	document.getElementById(ele).innerHTML = content;
}
function timestamp(){
	return new Date().getTime();
}
var XMLHttp = {  
	_objPool: [],
	_getInstance: function () {
		for (var i = 0; i < this._objPool.length; i ++) {
			if (this._objPool[i].readyState == 0 || this._objPool[i].readyState == 4) {
				return this._objPool[i];
			}
		}
		this._objPool[this._objPool.length] = this._createObj();
		return this._objPool[this._objPool.length - 1];
	},
	_createObj: function(){
		if (window.XMLHttpRequest){
			var objXMLHttp = new XMLHttpRequest();
		} else {
			var MSXML = ['MSXML2.XMLHTTP.5.0', 'MSXML2.XMLHTTP.4.0', 'MSXML2.XMLHTTP.3.0', 'MSXML2.XMLHTTP', 'Microsoft.XMLHTTP'];
			for(var n = 0; n < MSXML.length; n ++){
				try{
					var objXMLHttp = new ActiveXObject(MSXML[n]);
					break;
				}catch(e){}
			}
		}
		if (objXMLHttp.readyState == null){
			objXMLHttp.readyState = 0;
			objXMLHttp.addEventListener('load',function(){
				objXMLHttp.readyState = 4;
				if (typeof objXMLHttp.onreadystatechange == "function") {  
					objXMLHttp.onreadystatechange();
				}
			}, false);
		}
		return objXMLHttp;
	},
	sendReq: function(method, url, data, callback){
		var objXMLHttp = this._getInstance();
		with(objXMLHttp){
			try {
				if (url.indexOf("?") > 0) {
					url += "&randnum=" + Math.random();
				} else {
					url += "?randnum=" + Math.random();
				}
				open(method, url, true);
				setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
				send(data);
				onreadystatechange = function () {  
					if (objXMLHttp.readyState == 4 && (objXMLHttp.status == 200 || objXMLHttp.status == 304)) {  
						callback(objXMLHttp);
					}
				}
			} catch(e) {
				alert('emria:error');
			}
		}
	}
};
function sendinfo(url,node){
	updateEle(node,"<div><span style=\"background-color:#FFFFE5; color:#666666;overflow:hidden;float:left;\">加载中...</span></div>");
	XMLHttp.sendReq('GET',url,'',function(obj){updateEle(node,obj.responseText);});
}
function loadr(url,tid){
    url = url+"&stamp="+timestamp();
	var r=document.getElementById("r_"+tid);
	var rp=document.getElementById("rp_"+tid);
	if (r.style.display=="block"){
		r.style.display="none";
		rp.style.display="none";
	} else {
		r.style.display="block";
        r.innerHTML = '<span style=\"background-color:#FFFFE5;text-align:center;font-size:12px;color:#666666;\">加载中...</span>';
        XMLHttp.sendReq('GET',url,'',function(obj){r.innerHTML = obj.responseText;rp.style.display="block";});
	}
}
function reply(url,tid){
    var rtext=document.getElementById("rtext_"+tid).value;
    var rname=document.getElementById("rname_"+tid).value;
    var rcode=document.getElementById("rcode_"+tid).value;
    var rmsg=document.getElementById("rmsg_"+tid);
    var rn=document.getElementById("rn_"+tid);
    var r=document.getElementById("r_"+tid);
    var data = "r="+rtext+"&rname="+rname+"&rcode="+rcode+"&tid="+tid;
    XMLHttp.sendReq('POST',url,data,function(obj){
        if(obj.responseText == 'err1'){rmsg.innerHTML = '(回复长度需在140个字内)';
        }else if(obj.responseText == 'err2'){rmsg.innerHTML = '(昵称不能为空)';
        }else if(obj.responseText == 'err3'){rmsg.innerHTML = '(验证码错误)';
        }else if(obj.responseText == 'err4'){rmsg.innerHTML = '(不允许使用该昵称)';
        }else if(obj.responseText == 'err5'){rmsg.innerHTML = '(已存在该回复)';
        }else if(obj.responseText == 'succ1'){rmsg.innerHTML = '(回复成功，等待管理员审核)';
        }else{r.innerHTML += obj.responseText;rn.innerHTML = Number(rn.innerHTML)+1;rmsg.innerHTML=''}});
}
function re(tid, rp){
    var rtext=document.getElementById("rtext_"+tid).value = rp;
    focusEle("rtext_"+tid);
}
function commentReply(pid,c){
	var response = document.getElementById('comment-post');
	document.getElementById('comment-pid').value = pid;
	document.getElementById('cancel-reply').style.display = '';
	c.parentNode.parentNode.appendChild(response);
}
function cancelReply(){
	var commentPlace = document.getElementById('comment-place'),response = document.getElementById('comment-post');
	document.getElementById('comment-pid').value = 0;
	document.getElementById('cancel-reply').style.display = 'none';
	commentPlace.appendChild(response);
}
function popup() {
	var e = $("#downloadfile").height() - $("#dialog-box").height();
	var d = ($("#downloadfile").width() - $("#dialog-box").width()) / 2;
	$("#dialog-box").css({
		top: e,
		left: d
	}).show(800)
}
$(function() {
	$("#close,#down a").click(function() {
		$("#dialog-box").hide()
	});
	$(window).resize(function() {
		if (!$("#dialog-box").is(":hidden")) {
			popup()
		}
	});
	$("#download").click(function() {
		popup();
		return false
	})

 // Ajax评论
   $("#commentform").submit(function(){
	var q = $("#commentform").serialize();
	$(".submit").attr("disabled","disabled");
	$("#commiting").show();
	$.post($("#commentform").attr("action"),q,function(d){
		var reg = /<div class=\"main\">[\r\n]*<p>(.*?)<\/p>/i;
		if(reg.test(d)){
			$("#error").html(d.match(reg)[1]);
			$("#error").show();
			$("#commiting").hide();
			setTimeout('$("#error").hide()',2000);
		}else{
			var p = $("input[name=pid]").val();
			cancelReply();
			$("[name=comment]").val("");
			$("#comment_list").html($(d).find("#comment_list"));
			if(p != 0) {
				var body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
				body.animate({scrollTop: $("#comment-" + p).offset().top - 20},	"normal",function() {$("#commiting").hide();});
			} else {
				var body = (window.opera) ? (document.compatMode == "CSS1Compat" ? $('html') : $('body')) : $('html,body');
				body.animate({scrollTop: $("#comments").offset().top - 20},	"normal",function() {$("#commiting").hide();});
			}
		}
		$(".submit").attr("disabled",false);
	});
	return false;	})   
	$(document).keypress(function(e){
	if(e.ctrlKey && e.which == 13 || e.which == 10) {
	$("#commentform").submit();
	} else if (e.shiftKey && e.which==13 || e.which == 10) {
	$("#commentform").submit();//#commentform是发表评论表单form的ID
	 }
	})	
   });
/*
Template Name:魅影
Description:Designed For Emlog
Version:1.0
Author:麦特佐罗
Author Url:http://hc123.site/zorro
Sidebar Amount:1
ForEmlog:5.3.0
*/
function grin(tag) {
	var myField;
	tag = ' ' + tag + ' ';
	if (document.getElementById('comment') && document.getElementById('comment').type == 'textarea') {
		myField = document.getElementById('comment');
	}
	else {
		return false;
	}
	if (document.selection) {
		myField.focus();
		sel = document.selection.createRange();
		sel.text = tag;
		myField.focus();
	}
	else if (myField.selectionStart || myField.selectionStart == '0') {
		var startPos = myField.selectionStart;
		var endPos = myField.selectionEnd;
		var cursorPos = endPos;
		myField.value = myField.value.substring(0, startPos)
		+ tag
		+ myField.value.substring(endPos, myField.value.length);
		cursorPos += tag.length;
		myField.focus();
		myField.selectionStart = cursorPos;
		myField.selectionEnd = cursorPos;
	}
	else {
		myField.value += tag;
		myField.focus();
	}
}
function share() {
	if($('.share').css('display')=='none'){
		$('.share').show()
	
	}
	else{
		$('.share').hide()
	
	}
};
$('.share').click(function(){
	$('.share').hide();
});
jQuery(document).ready(function(){
	var share_url = encodeURIComponent(location.href);
	var share_title = encodeURIComponent(document.title);
	$('.share li a.share1').click(function(e) {
		window.open("http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url="+share_url+"&title="+share_title,'newwindow');
	});
	$('.share li a.share2').click(function(e) {
		window.open('http://v.t.sina.com.cn/share/share.php?url=' + share_url + '&title=' + share_title,'newwindow');
	});
	$('.share li a.share3').click(function(e) {
		window.open('http://v.t.qq.com/share/share.php?title=' + share_title + '&url=' + share_url + '&site=','newwindow');
	});
	$('.share li a.share4').click(function(e) {
		window.open('http://share.renren.com/share/buttonshare?link=' + share_url + '&title=' + share_title,'newwindow');
	});
	$('.share li a.share5').click(function(e) {
		window.open('http://www.facebook.com/sharer.php?u='+share_url+'&t='+share_title,'newwindow');
	});
	$('.share li a.share6').click(function(e) {
		window.open('http://twitter.com/home?url=' + share_url + '&text=' + share_title,'newwindow');
	});
	$('.post-title a').click(function(e) {
		e.preventDefault();
		var htm = '拼命加载肿',
		i = 9,
		t = $(this).html(htm).unbind('click');
		(function ct() {
			i < 0 ? (i = 9, t.html(htm), ct()) : (t[0].innerHTML += '.', i--, setTimeout(ct, 100))
		
		})();
		window.location = this.href
	
	});
	$('.archives h4').click(function(){
		$(this).next('ul').slideToggle();
	});

	$('nav ul li').hover(function(){
	$(this).children('ul').show();
	},function(){
	$(this).find('ul').hide();
	});
	
	var mailList = new Array('@qq.com','@foxmail.com','@live.com','@hotmail.com','@gmail.com','@163.com','@126.com');
	$("#email").bind("keyup",function(){
		var val = $(this).val();
		if(val == '' || val.indexOf("@")>-1){
			$(".emaillist").hide();
			return false;
		}
		$('.emaillist').empty();
		for(var i = 0;i<mailList.length;i++){
			var emailText = $(this).val();
			$('.emaillist').append('<li class=addr>'+emailText+mailList[i]+'</li>');
		}
		$('.emaillist').show();
		$('.emaillist li').click(function(){
			$('#email').val($(this).text());
			$('.emaillist').hide();
		})	
	
	});
});

function embedSmiley() {
	if($('.opensmile i').hasClass('icon-happy')){
		$('.smile').show()
		$('.opensmile i').removeClass('icon-happy');
		$('.opensmile i').addClass('icon-sad');
	}
	else{
		$('.smile').hide()
		$('.opensmile i').removeClass('icon-sad');
		$('.opensmile i').addClass('icon-happy');
	}
};
$('.smile').click(function(){
	$('.smile').hide();
	$('.opensmile i').removeClass('icon-sad');
	$('.opensmile i').addClass('icon-happy');
});

function commentReply(pid,c){
	var response = document.getElementById('comment-post');
	c.style.display = 'none';
	document.getElementById('comment-pid').value = pid;
	document.getElementById('cancel-reply').style.display = '';
	document.getElementById('comment-post').style.display = 'none';
	c.parentNode.parentNode.appendChild(response);
	$('#comment-post').slideDown()
}
function cancelReply(){
	$('#comment-post').slideUp(504,function(){
		var commentPlace = document.getElementById('comment-place'),response = document.getElementById('comment-post');
		document.getElementById('comment-pid').value = 0;
		$('.reply a').css({
			'display':''
		})
		document.getElementById('cancel-reply').style.display = 'none';
		commentPlace.appendChild(response);
		$('#comment-post').slideDown();
	})
}


$('#newlog li a,#randlog li a,#hotlog li a,#record li a,#blogsort li a,#newcomment li a,#link li a,#statistics li a').hover(function(){
	$(this).stop().animate({
		marginLeft:"4px"
	}
	,"fast");
}
,function(){
	$(this).stop().animate({
		marginLeft:"0px"
	}
	,"fast");
});


$('.open-nav,.close-nav').click(function(){
	if ($('#mmenu').hasClass('has-opened')) {
		$('#mmenu').removeClass('has-opened');
	}
	else {
		$('#mmenu').addClass('has-opened');
	}
});

$("#circletext").text("加载肿");
$(window).load(function() {
$("#circle").fadeOut(400);
$("#circle1").fadeOut(600);
$("#circletext").text("完成鸟").fadeOut(800);
});

jQuery(document).ready(function(){
	$('#comment').focus(function(){
	$(this).animate({height:"120px"},"fast");
	});
	bindSchEvents($('#hsch'), $('#hschform .txt'));
})

function bindSchEvents($lnk, $txt){
	$lnk.bind('click', function () {
		$(this).addClass('f-hidden').parent().addClass('m-schshow');
		setTimeout(function () {
			$txt.focus();
		}, 300);
		return false;
	});
	$txt.bind('blur', function () {
		setTimeout(function () {
			$lnk.removeClass('f-hidden').parent().removeClass('m-schshow');
		}, 300);
		return false;
	});
}

function mmenu() {
	if($('#mmenu').css('display')=='none'){
		$('#mmenu').show()
	
	}
	else{
		$('#mmenu').hide()
	
	}
};

jQuery(document).ready(function($){
 var sweetTitles = {
 x : 10, 
 y : 20,
 tipElements : "a,span,img,div", 
 noTitle : false,
 init : function() {
 var noTitle = this.noTitle;
 $(this.tipElements).each(function(){
 $(this).mouseover(function(e){
 if(noTitle){
 isTitle = true;
 }else{
 isTitle = $.trim(this.title) != '';
 }
 if(isTitle){
 this.myTitle = this.title;
 this.title = "";
 var tooltip = "<div id='tooltip'><p>"+this.myTitle+"</p></div>";
 $('body').append(tooltip);
 $('#tooltip')
 .css({
 "top" :( e.pageY+20)+"px",
 "left" :( e.pageX+10)+"px"
 }).show('fast');
 }
 }).mouseout(function(){
 if(this.myTitle != null){
 this.title = this.myTitle;
 $('#tooltip').remove();
 }
 }).mousemove(function(e){
 $('#tooltip')
 .css({
 "top" :( e.pageY+20)+"px",
 "left" :( e.pageX+10)+"px"
 });
 });
 });
 }
 };
 $(function(){
 sweetTitles.init();
 });	
});
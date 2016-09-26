$(function(){		
    $("#menu").css({"right":-1500});
    $("#mobile-menu").click(function(){
        $("#menu").show();
        
        if($("#menu").css("right") == "-1500px") 
        {
          $("#menu").animate({ "right":0 }, 400);
        }
        else
        {
          $("#menu").animate({ "right":-1500 }, 400);
        }
        
        return false;
    });
    

    $("#menu a").click(function(){
      $("#menu").animate({ "right":-1500 }, 400);
    });

	 $("#commentform").submit(function(){
	var q = $("#commentform").serialize();
	$.post($("#commentform").attr("action"),q,function(d){
		var reg = /<div class=\"main\">[\r\n]*<p>(.*?)<\/p>/i;
		if(reg.test(d)){
			$("#error").html(d.match(reg)[1]).show().fadeOut(5000);
		}
	});
	return false;	})
  jQuery(window).scroll(function(){
	if (jQuery(this).scrollTop() > 100) {
		jQuery('#back-to-top').css({bottom:"1px"}).attr("title", "返回顶部");
	} else {
		jQuery('#back-to-top').css({bottom:"-100px"});
	}
});
jQuery('#back-to-top').click(function(){
	jQuery('html, body').animate({scrollTop: '0px'}, 500);
	return false;
});
});




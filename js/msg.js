$(function(){
	$("a.msg-up").click(function(){
		var _this=$(this);
		var uid=_this.parents('.msg').attr("mid");
		var upNum=_this.find('.up_num');
		 $.get('./index.php?m=up',{"uid":uid},function(data){
              if(data.status){
                 upNum.html(data.num);
                 _this.unbind("click").siblings('a').unbind("click");
              }
          },'json')
	});
	$("a.msg-down").click(function(){
		var _this=$(this);
		var did=_this.parents('.msg').attr("mid");
		var upNum=_this.find('.down_num');
		 $.get('./index.php?m=down',{"did":did},function(data){
              if(data.status){
                 upNum.html(data.num);
                 _this.unbind("click").siblings('a').unbind("click");
              }
          },'json')
	});
	$("#main .msg-box .msg .msger span").click(function() {
		var _this=$(this);
		var msg=_this.parents('.msg');
		var del_id=msg.attr("mid");
		$.get('./index.php?m=del',{"del_id":del_id},function(data){
              if(data.status){
                 msg.hide(600);
              }
          },'json')
	});
})
$(function(){
		    var back=$("div.return-top");
			back.click(function(){
				var timer=setInterval(function(){
					 	$(window).scrollTop($(window).scrollTop()-200);
						if($(window).scrollTop()==0){
							 clearInterval(timer);
							}
					},20)
			});
			$(window).scroll(function(){
				if($(window).scrollTop()<150){
				back.hide(500);
				}else{
				back.show(500);	
					}
				})
			var width=parseInt(($(window).width()-$("#main").width())/2)+630;
			$("div.tools").css({
				left:width
			})
})
$(function(){
	//alert($("body").height());
	$(".replay-box").click(function(){
		$(window).scrollTop($("body").height());
	});
	$("#main .msg-box .msg").hover(function(){
		$(this).find('.msger span').show();
	},function(){
		$(this).find('.msger span').hide();
	})
})
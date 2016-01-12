function url2Hash(_url,fgf){
	var parmhash={};
	var querstr=_url||location.search;
	var offset1=querstr.indexOf("?");
	if(offset1!=-1){
		querstr=querstr.substring(offset1+1);
	}
	if(querstr!=""){
		var parms=querstr.split(fgf||"&");
		var parmsLen=parms.length;
		for(var i=0;i<parmsLen;i++){
			var _keyval=parms[i].split("=");
			var _key=$.trim(_keyval[0]);
			var _val=$.trim(_keyval[1]);
			try{
					parmhash[_key]=decodeURI(_val);
			}catch(ex){
				var offset0=-1;
				var n=0;
				while((offset0=_val.indexOf("%%"))!=-1){
					_val=_val.substring(0,offset0)+'%25'+_val.substring(offset0+1);
					n+=4;
				}
				parmhash[_key]=decodeURI(_val);
			}
		}
	}
	return parmhash;
}
function bannerSwiperfun(){
	var bannerSlider_smlogo = new Swiper('#bannerSlider_smlogo', {
		spaceBetween: 0,
		effect: 'fade'
	});
	var bannerSwiper = new Swiper('#bannerSlider', {
		pagination: '.bannerSlider-pagination',
		paginationClickable: '.bannerSlider-pagination',
		nextButton: '.bannerSlider-button-next',
		prevButton: '.bannerSlider-button-prev',
		spaceBetween: 0,
		autoplay: 5000,
		//loop: true,
		//effect: 'fade',
		onTransitionEnd:function(a){
			//console.log(a.activeIndex);
		}
	});
	if(bannerSwiper){
		bannerSwiper.params.control = bannerSlider_smlogo;
		bannerSlider_smlogo.params.control = bannerSwiper;
	}
	//console.log(bannerSwiper.activeIndex)
	var daynominateSlider = new Swiper('#daynominateSlider', {
		pagination: '.daynominateSlider-pagination',
		paginationClickable: '.daynominateSlider-pagination',
		spaceBetween: 0,
		//autoplay: 5000,
		loop: true,
		//effect: 'fade'
	});
	//////
	new Swiper('#tealistSlider', {
		nextButton: '.tealistSlider-button-next',
		prevButton: '.tealistSlider-button-prev',
		scrollbarHide: true,
		slidesPerView: 'auto'
	});
	//////allbannerSlider
	new Swiper('.allbannerSlider', {
		pagination: '.bannerSlider-pagination',
		paginationClickable: '.bannerSlider-pagination',
		nextButton: '.bannerSlider-button-next',
		prevButton: '.bannerSlider-button-prev',
		spaceBetween: 0,
		autoplay: 5000,
		//loop: true,
		//effect: 'fade',
		onTransitionEnd:function(a){
			//console.log(a.activeIndex);
		}
	});
}



function showteaView(){
	$("#teaView").show();
	$("#teachooseView").hide();
}
function showteachooseView(){
	$("#teaView").hide();
	$("#teachooseView").show();
}
function changeChooseview(n){
	var _n=n+'%';
	$("#chooseview").css({
		"transform":"translateX("+_n+")",
		"-webkit-transform":"translateX("+_n+")",
		"-moz-transform":"translateX("+_n+")",
		"-ms-transform":"translateX("+_n+")"
	});
}
function bestteabegin(){
	showteachooseView();
}
$(".toggleClass").on('click','li',function(){
	var _obj=$(this);
	var _thisclass=_obj.attr('class')||'';
	if(_thisclass.indexOf("active")!=-1){
		_obj.removeClass("active");
	}else{
		_obj.addClass("active");
	}
});
$("#bestteaarrow").on('click','span',function(){
	var _view=$("#chooseview").attr("data-view");
	var _name=$(this).attr("class");
	if(_view==1&&_name=="prev"){
		showteaView();
	}else if(_view==3&&_name=="next"){
		   var Taste = "";
	    var Userhabits = "";
	    var Situation = "";
	    $("#crilist .active").each(function () {
	        Taste = Taste + $(this).attr("data")+",";
	    });
	    $("#squarelist .active").each(function () {
	        Userhabits = Userhabits + $(this).attr("data")+",";
	    });
	    $("#squarelist_2 .active").each(function () {
	        Situation = Situation + $(this).attr("data")+",";
	    });
	    if ((Taste + Userhabits + Situation) != "") {
	        location.href = "gsearch.html?Taste=" + Taste + "&Userhabits=" + Userhabits + "&Situation=" + Situation;
	    }
	    else {
	        alert("您未做出任何选择！");
	    }
	}else{
		if(_name=="prev"){
			var _newview=Number(_view)-1;
			var _offset=-33.33333*(_newview-1);
			changeChooseview(_offset);
			$("#chooseview").attr("data-view",_newview);
		}else if(_name=="next"){
			var _offset=-33.33333*_view;
			var _newview=Number(_view)+1;
			changeChooseview(_offset);
			$("#chooseview").attr("data-view",_newview);
		}
	}
});

function subSwiper(){
	$('.prolistslider').each(function(index, element) {
		var _nextButton=$(this).parent().find('.prolistSlider-button-next');
		var _prevButton=$(this).parent().find('.prolistSlider-button-prev');
		new Swiper($(this), {
			nextButton: _nextButton,
			prevButton: _prevButton,
			slidesPerView: 'auto'
		});
    });
}

function bhtealistslider(){
	if(!$(".bhtealistsliderbox").length){
		return;
	}
	var _nextButton=$('.bhtealistSlider-button-next');
	var _prevButton=$('.bhtealistSlider-button-prev');
	new Swiper($('.bhtealistslider'), {
		nextButton: _nextButton,
		prevButton: _prevButton,
		spaceBetween: 0,
		loop: true
	});
}

function fineperipheral(){
	$('.fineperipheral').on('click','.arrow',function(){
		var _this=$(this);
		var _classname=_this.parent().attr("class");
		if(_classname.indexOf("open")!=-1){
			_this.parent().removeClass("open");
		}else{
			_this.parent().addClass("open");
		}
	});
}
function resetsubmenu(){
	if(!$("#smenu").length){
		return;
	}
	var _obj=$("#smenu");
	var _tabs=url2Hash()["tabs"]||'0';
	function _shdiv(){
		var _l=_obj.find(".items li").length;
		_obj.find(".items li").removeClass('active');
		for(var i=0;i<_l;i++){
			$("#maincontent_"+i).hide();
		}
		$("#maincontent_"+_tabs).show();
		_obj.find(".items li").eq(_tabs).addClass('active');
	}
	_obj.on('click','li',function(){
		if($(this).attr('data-noclick')){
			return;
		}
		_tabs=$(this).attr('data-itabs');
		_shdiv();
	});
	_shdiv();
}

function nsslider(){
	var _obj=document.getElementById("nssliderwarp");
	if(!_obj){
		return;
	}
	var _cnum=1,_array=[0,1,2];
	var _sobj=$("#nssliderwarp");
	function _shownsinfo(num){
		$("#newserviceInfo .nsinfo").hide();
		$("#newserviceInfo").attr("class","newserviceInfo").addClass("color0"+num);
		$("#nsinfo_"+num).show();
	}
	function _animation(){
		$("#nsslider_"+_array[0]).attr("class","nsslider").addClass("postionleft");
		$("#nsslider_"+_array[1]).attr("class","nsslider").addClass("postioncenter");
		$("#nsslider_"+_array[2]).attr("class","nsslider").addClass("postionright");
		_shownsinfo(_array[1]);
	}
	$("#nssliderwarpprev").on('click',function(){
		var _temp=_array.shift();
		_array.push(_temp);
		_animation();
	});
	$("#nssliderwarpnext").on('click',function(){
		var _temp=_array.pop();
		_array.unshift(_temp);
		_animation();
	});
	_shownsinfo(_cnum);
}

window.requestAnimFrame = (function(){
	return	window.requestAnimationFrame       ||
			window.webkitRequestAnimationFrame ||
			window.mozRequestAnimationFrame    ||
			function( callback ){
				window.setTimeout(callback, 1000 / 60);
			};
})();
$(document).ready(function(){
	//banner
	bannerSwiperfun();
	//
	subSwiper();
	//精美周边
	fineperipheral();
	//设置内导航
	resetsubmenu();
	//
	bhtealistslider();
	//
	nsslider();
	try{
		
	}catch(err){
		console.log(err);
	}
	
	var submainheight=$("#smleft").height();
	if(submainheight>554){
		$(".submain").css("min-height",submainheight+"px");	
	}
	
	$('.mini_nav').on("click", function(){
		
	});
	
	
	$('body').append('<div id="wericeQQ" class="wericeQQ"></div>');
	BizQQWPA.addCustom({aty: '0', a: '0', nameAccount: 800111803, selector: 'wericeQQ'});
	
	//$('body').append('<div class="go_top"></div>');
	
	var _leftobj=$("#smleft");
	var _leftheight=_leftobj.height();
	var _leftparentheight=_leftobj.parent().height();
	var _leftparenttop=_leftobj.offset()!=null?_leftobj.offset().top:0;
	$(window).scroll(function(){
		/*if(_leftobj){
			var _wintop=$(window).scrollTop();
			if(_wintop>_leftparenttop&&_wintop<(_leftparenttop+_leftparentheight-_leftheight)){
				requestAnimFrame(function(){_leftobj.css("top",_wintop-_leftparenttop+"px")});
			}else if(_wintop<_leftparenttop){
				requestAnimFrame(function(){_leftobj.css("top","0px")});
			}
			
		}*/
		/*if($(this).scrollTop()>200){
			$('.go_top').fadeIn(200);
		}else{
			$('.go_top').fadeOut(200);
		}*/
	});
	
});
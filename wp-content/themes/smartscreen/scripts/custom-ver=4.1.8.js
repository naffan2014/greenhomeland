/*!
* FitVids 1.1
*
* Copyright 2013, Chris Coyier - http://css-tricks.com + Dave Rupert - http://daverupert.com
* Credit to Thierry Koblentz - http://www.alistapart.com/articles/creating-intrinsic-ratios-for-video/
* Released under the WTFPL license - http://sam.zoy.org/wtfpl/
*
*/
(function(e){"use strict";e.fn.fitVids=function(t){var n={customSelector:null,ignore:null};if(!document.getElementById("fit-vids-style")){var r=document.head||document.getElementsByTagName("head")[0];var i=".fluid-width-video-wrapper{width:100%;position:relative;padding:0;}.fluid-width-video-wrapper iframe,.fluid-width-video-wrapper object,.fluid-width-video-wrapper embed {position:absolute;top:0;left:0;width:100%;height:100%;}";var s=document.createElement("div");s.innerHTML='<p>x</p><style id="fit-vids-style">'+i+"</style>";r.appendChild(s.childNodes[1])}if(t){e.extend(n,t)}return this.each(function(){var t=["iframe[src*='player.vimeo.com']","iframe[src*='youtube.com']","iframe[src*='youtube-nocookie.com']","iframe[src*='kickstarter.com'][src*='video.html']","object","embed"];if(n.customSelector){t.push(n.customSelector)}var r=".fitvidsignore";if(n.ignore){r=r+", "+n.ignore}var i=e(this).find(t.join(","));i=i.not("object object");i=i.not(r);i.each(function(){var t=e(this);if(t.parents(r).length>0){return}if(this.tagName.toLowerCase()==="embed"&&t.parent("object").length||t.parent(".fluid-width-video-wrapper").length){return}if(!t.css("height")&&!t.css("width")&&(isNaN(t.attr("height"))||isNaN(t.attr("width")))){t.attr("height",9);t.attr("width",16)}var n=this.tagName.toLowerCase()==="object"||t.attr("height")&&!isNaN(parseInt(t.attr("height"),10))?parseInt(t.attr("height"),10):t.height(),i=!isNaN(parseInt(t.attr("width"),10))?parseInt(t.attr("width"),10):t.width(),s=n/i;if(!t.attr("id")){var o="fitvid"+Math.floor(Math.random()*999999);t.attr("id",o)}t.wrap('<div class="fluid-width-video-wrapper"></div>').parent(".fluid-width-video-wrapper").css("padding-top",s*100+"%");t.removeAttr("height").removeAttr("width")})})}})(window.jQuery||window.Zepto);


/*
 * jQuery BBQ: Back Button & Query Library - v1.2.1 - 2/17/2010
 * http://benalman.com/projects/jquery-bbq-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($,p){var i,m=Array.prototype.slice,r=decodeURIComponent,a=$.param,c,l,v,b=$.bbq=$.bbq||{},q,u,j,e=$.event.special,d="hashchange",A="querystring",D="fragment",y="elemUrlAttr",g="location",k="href",t="src",x=/^.*\?|#.*$/g,w=/^.*\#/,h,C={};function E(F){return typeof F==="string"}function B(G){var F=m.call(arguments,1);return function(){return G.apply(this,F.concat(m.call(arguments)))}}function n(F){return F.replace(/^[^#]*#?(.*)$/,"$1")}function o(F){return F.replace(/(?:^[^?#]*\?([^#]*).*$)?.*/,"$1")}function f(H,M,F,I,G){var O,L,K,N,J;if(I!==i){K=F.match(H?/^([^#]*)\#?(.*)$/:/^([^#?]*)\??([^#]*)(#?.*)/);J=K[3]||"";if(G===2&&E(I)){L=I.replace(H?w:x,"")}else{N=l(K[2]);I=E(I)?l[H?D:A](I):I;L=G===2?I:G===1?$.extend({},I,N):$.extend({},N,I);L=a(L);if(H){L=L.replace(h,r)}}O=K[1]+(H?"#":L||!K[1]?"?":"")+L+J}else{O=M(F!==i?F:p[g][k])}return O}a[A]=B(f,0,o);a[D]=c=B(f,1,n);c.noEscape=function(G){G=G||"";var F=$.map(G.split(""),encodeURIComponent);h=new RegExp(F.join("|"),"g")};c.noEscape(",/");$.deparam=l=function(I,F){var H={},G={"true":!0,"false":!1,"null":null};$.each(I.replace(/\+/g," ").split("&"),function(L,Q){var K=Q.split("="),P=r(K[0]),J,O=H,M=0,R=P.split("]["),N=R.length-1;if(/\[/.test(R[0])&&/\]$/.test(R[N])){R[N]=R[N].replace(/\]$/,"");R=R.shift().split("[").concat(R);N=R.length-1}else{N=0}if(K.length===2){J=r(K[1]);if(F){J=J&&!isNaN(J)?+J:J==="undefined"?i:G[J]!==i?G[J]:J}if(N){for(;M<=N;M++){P=R[M]===""?O.length:R[M];O=O[P]=M<N?O[P]||(R[M+1]&&isNaN(R[M+1])?{}:[]):J}}else{if($.isArray(H[P])){H[P].push(J)}else{if(H[P]!==i){H[P]=[H[P],J]}else{H[P]=J}}}}else{if(P){H[P]=F?i:""}}});return H};function z(H,F,G){if(F===i||typeof F==="boolean"){G=F;F=a[H?D:A]()}else{F=E(F)?F.replace(H?w:x,""):F}return l(F,G)}l[A]=B(z,0);l[D]=v=B(z,1);$[y]||($[y]=function(F){return $.extend(C,F)})({a:k,base:k,iframe:t,img:t,input:t,form:"action",link:k,script:t});j=$[y];function s(I,G,H,F){if(!E(H)&&typeof H!=="object"){F=H;H=G;G=i}return this.each(function(){var L=$(this),J=G||j()[(this.nodeName||"").toLowerCase()]||"",K=J&&L.attr(J)||"";L.attr(J,a[I](K,H,F))})}$.fn[A]=B(s,A);$.fn[D]=B(s,D);b.pushState=q=function(I,F){if(E(I)&&/^#/.test(I)&&F===i){F=2}var H=I!==i,G=c(p[g][k],H?I:{},H?F:2);p[g][k]=G+(/#/.test(G)?"":"#")};b.getState=u=function(F,G){return F===i||typeof F==="boolean"?v(F):v(G)[F]};b.removeState=function(F){var G={};if(F!==i){G=u();$.each($.isArray(F)?F:arguments,function(I,H){delete G[H]})}q(G,2)};e[d]=$.extend(e[d],{add:function(F){var H;function G(J){var I=J[D]=c();J.getState=function(K,L){return K===i||typeof K==="boolean"?l(I,K):l(I,L)[K]};H.apply(this,arguments)}if($.isFunction(F)){H=F;return G}else{H=F.handler;F.handler=G}}})})(jQuery,this);
/*
 * jQuery hashchange event - v1.2 - 2/11/2010
 * http://benalman.com/projects/jquery-hashchange-plugin/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 */
(function($,i,b){var j,k=$.event.special,c="location",d="hashchange",l="href",f=$.browser,g=document.documentMode,h=f.msie&&(g===b||g<8),e="on"+d in i&&!h;function a(m){m=m||i[c][l];return m.replace(/^[^#]*#?(.*)$/,"$1")}$[d+"Delay"]=100;k[d]=$.extend(k[d],{setup:function(){if(e){return false}$(j.start)},teardown:function(){if(e){return false}$(j.stop)}});j=(function(){var m={},r,n,o,q;function p(){o=q=function(s){return s};if(h){n=$('<iframe src="javascript:0"/>').hide().insertAfter("body")[0].contentWindow;q=function(){return a(n.document[c][l])};o=function(u,s){if(u!==s){var t=n.document;t.open().close();t[c].hash="#"+u}};o(a())}}m.start=function(){if(r){return}var t=a();o||p();(function s(){var v=a(),u=q(t);if(v!==t){o(t=v,u);$(i).trigger(d)}else{if(u!==t){i[c][l]=i[c][l].replace(/#.*/,"")+"#"+u}}r=setTimeout(s,$[d+"Delay"])})()};m.stop=function(){if(!n){r&&clearTimeout(r);r=0}};return m})()})(jQuery,this);

// Images rollover effect function
function frameHover () {
    var frame_img = jQuery(this).find('img');
    var frame_ico = jQuery(this).find('.zoom,.video');
    jQuery(this).hover(function(){
        jQuery(frame_img).stop(true, true).animate({top:30}, '5000', 'swing');
        jQuery(frame_ico).stop(true, true).animate({top:0}, '5000', 'swing');
    }, function(){
        jQuery(frame_img).stop(true, true).animate({top:0}, '5000', 'swing');
        jQuery(frame_ico).stop(true, true).animate({top:-99}, '5000', 'swing');

    });
}

// Checking for Retina Devices
function isRetina() {
    var query = '(-webkit-min-device-pixel-ratio: 1.5),\
                (min--moz-device-pixel-ratio: 1.5),\
                (-o-min-device-pixel-ratio: 3/2),\
                (min-device-pixel-ratio: 1.5),\
                (min-resolution: 144dpi),\
                (min-resolution: 1.5dppx)';

    if (window.devicePixelRatio > 1 || (window.matchMedia && window.matchMedia(query).matches)) {
        return true;
    }

    return false;
}
isMobile = 'ontouchstart' in document.documentElement;


//** Smooth Navigational Menu- By Dynamic Drive DHTML code library: http://www.dynamicdrive.com
//** Script Download/ instructions page: http://www.dynamicdrive.com/dynamicindex1/ddlevelsmenu/
//** Menu created: Nov 12, 2008

var ddsmoothmenu={transition:{overtime:300,outtime:300},showhidedelay:{showdelay:100,hidedelay:200},detectwebkit:navigator.userAgent.toLowerCase().indexOf("applewebkit")!=-1,detectie6:document.all&&!window.XMLHttpRequest,getajaxmenu:function(e,t){var n=jQuery("#"+t.contentsource[0]);n.html("Loading Menu...");e.ajax({url:t.contentsource[1],async:true,error:function(e){n.html("Error fetching content. Server Response: "+e.responseText)},success:function(r){n.html(r);ddsmoothmenu.buildmenu(e,t)}})},buildmenu:function(e,t){var n=ddsmoothmenu;var r=jQuery("#"+t.mainmenuid+">ul");r.parent().get(0).className=t.classname||"ddsmoothmenu";var i=r.find("ul").parent();i.hover(function(e){jQuery(this).children("a:eq(0)").addClass("selected")},function(e){jQuery(this).children("a:eq(0)").removeClass("selected")});i.each(function(e){var n=jQuery(this).css({zIndex:100-e});var r=jQuery(this).find("ul:eq(0)").css({display:"block"});r.data("timers",{});this._dimensions={w:this.offsetWidth,h:this.offsetHeight,subulw:r.outerWidth(),subulh:r.outerHeight()};this.istopheader=n.parents("ul").length==1?true:false;r.css({top:this.istopheader&&t.orientation!="v"?this._dimensions.h+"px":0});n.hover(function(e){var i=r;var s=n.get(0);clearTimeout(i.data("timers").hidetimer);i.data("timers").showtimer=setTimeout(function(){s._offsets={left:n.offset().left,top:n.offset().top};var e=s.istopheader&&t.orientation!="v"?0:s._dimensions.w;e=s._offsets.left+e+s._dimensions.subulw>jQuery(window).width()?s.istopheader&&t.orientation!="v"?-s._dimensions.subulw+s._dimensions.w:-s._dimensions.w:e;if(i.queue().length<=1){i.css({left:e+"px",width:s._dimensions.subulw+"px"}).animate({height:"show",opacity:"show"},ddsmoothmenu.transition.overtime)}},ddsmoothmenu.showhidedelay.showdelay)},function(e){var t=r;var i=n.get(0);clearTimeout(t.data("timers").showtimer);t.data("timers").hidetimer=setTimeout(function(){t.animate({height:"hide",opacity:"hide"},ddsmoothmenu.transition.outtime)},ddsmoothmenu.showhidedelay.hidedelay)})});r.find("ul").css({display:"none",visibility:"visible"})},init:function(e){if(typeof e.customtheme=="object"&&e.customtheme.length==2){var t="#"+e.mainmenuid;var n=e.orientation=="v"?t:t+", "+t;document.write('<style type="text/css">\n'+n+" ul li a {background:"+e.customtheme[0]+";}\n"+t+" ul li a:hover {background:"+e.customtheme[1]+";}\n"+"</style>")}jQuery(document).ready(function(t){if(typeof e.contentsource=="object"){ddsmoothmenu.getajaxmenu(t,e)}else{ddsmoothmenu.buildmenu(t,e)}})}}



jQuery(document).ready(function ($) { //#Begin

    /*** [jQuery Easying] ***/
    /* -------------------------------------------------------------------------------- */
    $.easing["jswing"]=$.easing["swing"];$.extend($.easing,{def:"easeOutQuad",swing:function(e,t,n,r,i){return $.easing[$.easing.def](e,t,n,r,i)},easeInQuad:function(e,t,n,r,i){return r*(t/=i)*t+n},easeOutQuad:function(e,t,n,r,i){return-r*(t/=i)*(t-2)+n},easeInOutQuad:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t+n;return-r/2*(--t*(t-2)-1)+n},easeInCubic:function(e,t,n,r,i){return r*(t/=i)*t*t+n},easeOutCubic:function(e,t,n,r,i){return r*((t=t/i-1)*t*t+1)+n},easeInOutCubic:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t+n;return r/2*((t-=2)*t*t+2)+n},easeInQuart:function(e,t,n,r,i){return r*(t/=i)*t*t*t+n},easeOutQuart:function(e,t,n,r,i){return-r*((t=t/i-1)*t*t*t-1)+n},easeInOutQuart:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t+n;return-r/2*((t-=2)*t*t*t-2)+n},easeInQuint:function(e,t,n,r,i){return r*(t/=i)*t*t*t*t+n},easeOutQuint:function(e,t,n,r,i){return r*((t=t/i-1)*t*t*t*t+1)+n},easeInOutQuint:function(e,t,n,r,i){if((t/=i/2)<1)return r/2*t*t*t*t*t+n;return r/2*((t-=2)*t*t*t*t+2)+n},easeInSine:function(e,t,n,r,i){return-r*Math.cos(t/i*(Math.PI/2))+r+n},easeOutSine:function(e,t,n,r,i){return r*Math.sin(t/i*(Math.PI/2))+n},easeInOutSine:function(e,t,n,r,i){return-r/2*(Math.cos(Math.PI*t/i)-1)+n},easeInExpo:function(e,t,n,r,i){return t==0?n:r*Math.pow(2,10*(t/i-1))+n},easeOutExpo:function(e,t,n,r,i){return t==i?n+r:r*(-Math.pow(2,-10*t/i)+1)+n},easeInOutExpo:function(e,t,n,r,i){if(t==0)return n;if(t==i)return n+r;if((t/=i/2)<1)return r/2*Math.pow(2,10*(t-1))+n;return r/2*(-Math.pow(2,-10*--t)+2)+n},easeInCirc:function(e,t,n,r,i){return-r*(Math.sqrt(1-(t/=i)*t)-1)+n},easeOutCirc:function(e,t,n,r,i){return r*Math.sqrt(1-(t=t/i-1)*t)+n},easeInOutCirc:function(e,t,n,r,i){if((t/=i/2)<1)return-r/2*(Math.sqrt(1-t*t)-1)+n;return r/2*(Math.sqrt(1-(t-=2)*t)+1)+n},easeInElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return-(u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o))+n},easeOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i)==1)return n+r;if(!o)o=i*.3;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);return u*Math.pow(2,-10*t)*Math.sin((t*i-s)*2*Math.PI/o)+r+n},easeInOutElastic:function(e,t,n,r,i){var s=1.70158;var o=0;var u=r;if(t==0)return n;if((t/=i/2)==2)return n+r;if(!o)o=i*.3*1.5;if(u<Math.abs(r)){u=r;var s=o/4}else var s=o/(2*Math.PI)*Math.asin(r/u);if(t<1)return-.5*u*Math.pow(2,10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)+n;return u*Math.pow(2,-10*(t-=1))*Math.sin((t*i-s)*2*Math.PI/o)*.5+r+n},easeInBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*(t/=i)*t*((s+1)*t-s)+n},easeOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;return r*((t=t/i-1)*t*((s+1)*t+s)+1)+n},easeInOutBack:function(e,t,n,r,i,s){if(s==undefined)s=1.70158;if((t/=i/2)<1)return r/2*t*t*(((s*=1.525)+1)*t-s)+n;return r/2*((t-=2)*t*(((s*=1.525)+1)*t+s)+2)+n},easeInBounce:function(e,t,n,r,i){return r-$.easing.easeOutBounce(e,i-t,0,r,i)+n},easeOutBounce:function(e,t,n,r,i){if((t/=i)<1/2.75){return r*7.5625*t*t+n}else if(t<2/2.75){return r*(7.5625*(t-=1.5/2.75)*t+.75)+n}else if(t<2.5/2.75){return r*(7.5625*(t-=2.25/2.75)*t+.9375)+n}else{return r*(7.5625*(t-=2.625/2.75)*t+.984375)+n}},easeInOutBounce:function(e,t,n,r,i){if(t<i/2)return $.easing.easeInBounce(e,t*2,0,r,i)*.5+n;return $.easing.easeOutBounce(e,t*2-i,0,r,i)*.5+r*.5+n}})


    ddsmoothmenu.init({
        mainmenuid:"nav", //Menu DIV id
        orientation:'v', //Horizontal or vertical menu: Set to "h" or "v"
        classname:'jqueryslidemenu', //class added to menu's outer DIV
        contentsource:"markup" //"markup" or ["container_id", "path_to_menu_file"]
    });


    /*** [Testimonials] ***/
    /* -------------------------------------------------------------------------------- */
    $('.sc-testimonials .flexslider').flexslider({
        animation:"fade",
        animationLoop:true,
        maxItems:1,
        move:1,
        directionNav:false,
        controlNav:true,
        slideshow:false
    });


    /*** [ToolTip] ***/
    /* -------------------------------------------------------------------------------- */
    $(".tooltip_sc").tooltip({ relative:true, offset:[5, 0], tipClass:'tool_tip' });

    /*** [Slideshow Shortcode] ***/
    /* -------------------------------------------------------------------------------- */
    $('.slideshow-sc').flexslider({
        directionNav:true,
        pauseOnHover:true,
        controlsContainer:'.flex-container'
    });

    /*** [Tab] ***/
    /* -------------------------------------------------------------------------------- */
    $("ul.tabs-titles").tabs("> .tab-content");
    $(".accordion").tabs(".acc-item .acc-content", {tabs:'h3', effect:'slide', initialIndex:null});

    /*** [Toggle] ***/
    /* -------------------------------------------------------------------------------- */
    $(".toggle-body").hide();
    $(".toggle-head").click(function () {
        var tb = $(this).next(".toggle-body");

        if (tb.is(':hidden')) {
            tb.prev('.toggle-head').children('h3').addClass('minus');
            tb.slideDown('slow');

        }
        else {
            tb.slideUp(200, function () {
                tb.prev('.toggle-head').children('h3').removeClass('minus');
            });
        }
    });

    /*** [Footer Icons Functions] ***/
    /* -------------------------------------------------------------------------------- */
    $('#shutdown').click(function(){
        if($(this).attr('class') == 'active') {
            if($('body').hasClass('home')){
             $(' .social-in-homepage').fadeIn();
            } else {
             $(' .social-in-page').fadeIn();
            }
            $('#menu-wrap, #slidecaption, #wrap').fadeIn();
            $(this).removeClass('active');
        } else {
            if($('body').hasClass('home')){
             $(' .social-in-homepage').fadeOut();
            } else {
             $(' .social-in-page').fadeOut();
            }            
            $('#menu-wrap, #slidecaption, #wrap').fadeOut();
            $(this).addClass('active');

        }
    });

    $('#tray-button').click(function(){
        if($(this).attr('class') == 'active') {
            $('#slidecaption').fadeIn();
            $(this).removeClass('active');
        } else {
            $('#slidecaption').fadeOut();
            $(this).addClass('active');
        }
    });

    /*** [Menu & Entries Toggle] ***/
    /* -------------------------------------------------------------------------------- */

    $('.menu-toggle').click(function(){
        var menu_height = $('#menu-wrap').height() + 50;
        if($(this).attr('data-active') == 'yes') {
            $('#menu-wrap').stop(true, true).animate({top:0}, '5000', 'swing');
            $(this).attr('data-active', 'no');
        } else {
            $('#menu-wrap').stop(true, true).animate({top:-menu_height}, '5000', 'swing');
            $(this).attr('data-active', 'yes');
        }
    });
 
    $('.entries-toggle').click(function(){
        var sidebar_height = $('#sidebar').height() + 50;
        if($(this).attr('data-active') == 'yes') {
            $('#entries-box').slideDown();
            $('#sidebar').stop(true, true).animate({top:0}, '5000', 'swing');
            $(this).attr('data-active', 'no');
        } else {
            $('#entries-box').slideUp();
            $('#sidebar').stop(true, true).animate({top:-sidebar_height}, '5000', 'swing');
            $(this).attr('data-active', 'yes');
        }
    });


    /*** [Filterable Portfolio] ***/
    /* -------------------------------------------------------------------------------- */


        var container = $('.filterable');
        var classicContainer = $('#portfolio');
        container.imagesLoaded(function () {
            $('.portfolio-item-slideshow').flexslider({
            controlNav: false,
            smoothHeight: true,
            directionNav: true,
            slideshow: false,
            keyboard: false,
            touch: true
            });

        });
        classicContainer.imagesLoaded(function () {
            $('.portfolio-item-slideshow').flexslider({
            controlNav: false,
            smoothHeight: true,
            directionNav: true,
            slideshow: false,
            keyboard: false,
            touch: true
            });

        });    
        defaultOptions = {
                filter: '*',
                itemSelector: '.folio-box',
                layoutMode: 'fitRows',
          };
        container.imagesLoaded(function () {
            container.isotope(defaultOptions);
        });

    var $optionSets = $('.filters'),
          isOptionLinkClicked = false;
  
      // switches selected class on buttons
      function changeSelectedLink( $elem ) {
        // remove selected class on previous item
        $elem.parents('.filters').find('.selected').removeClass('selected');
        // set selected class on new item
        $elem.addClass('selected');
      }
  
  
      $optionSets.find('a').click(function(){
        var $this = $(this);
        // don't proceed if already selected
        if ( $this.hasClass('selected') ) {
          return;
        }
        changeSelectedLink( $this );
            // get href attr, remove leading #
        var href = $this.attr('href').replace( /^#/, '' ),
            // convert href into object
            // i.e. 'filter=.inner-transition' -> { filter: '.inner-transition' }
            option = $.deparam( href, true );
        // apply new option to previous
        $.extend( isotopeOptions, option );
        // set hash, triggers hashchange on window
        $.bbq.pushState( isotopeOptions );
        isOptionLinkClicked = true;
        return false;
      });

      var hashChanged = false;

        $(window).bind( 'hashchange', function( event ){
            // get options object from hash
            var hashOptions = window.location.hash ? $.deparam.fragment( window.location.hash, true ) : {},
                // do not animate first call
                aniEngine = hashChanged ? 'best-available' : 'none',
                // apply defaults where no option was specified
                options = $.extend( {}, defaultOptions, hashOptions, { animationEngine: aniEngine } );
            // apply options from hash
            container.isotope( options );
            // save options
            isotopeOptions = hashOptions;

            // if option link was not clicked
            // then we'll need to update selected links
            if ( !isOptionLinkClicked ) {
              // iterate over options
              var hrefObj, hrefValue, $selectedLink;
              for ( var key in options ) {
                hrefObj = {};
                hrefObj[ key ] = options[ key ];
                // convert object into parameter string
                // i.e. { filter: '.inner-transition' } -> 'filter=.inner-transition'
                hrefValue = $.param( hrefObj );
                // get matching link
                $selectedLink = $optionSets.find('a[href="#' + hrefValue + '"]');
                changeSelectedLink( $selectedLink );
              }
            }

            isOptionLinkClicked = false;
            hashChanged = true;
        })

        // trigger hashchange to capture any hash data on init
        .trigger('hashchange');


        $('#folio-single-slideshow').flexslider({
            animation: 'fade',
            directionNav: false, // set true to enable Next/Previous Buttons
            slideshowSpeed: 6000,
            controlsContainer: '.flex-container'
        });

    /*** [Responsive Menu] ***/
    /* -------------------------------------------------------------------------------- */
/*    selectnav('main-menu', {
        label: 'Select an item',
        nested: true,
        indent: '─'
    });*/

    // Responsive
    $("#mobile-nav").before('<div id="mobilepro"><i class="fa fa-reorder fa-times"></i></div>');
    $("#mobile-menu li ul.sub-menu").prev().before('<div class="subarrow"><i class="fa fa-angle-down"></i></div>');
    $('#mobile-menu .subarrow').click(function () {
        $(this).parent().toggleClass("xpopdrop");
    });
    $('#mobilepro').click(function () {
        $('#mobile-menu').slideToggle('slow', 'easeInOutExpo').toggleClass("xactive");
        $("#mobilepro i").toggleClass("fa-reorder");
    });
    $('#mobilepro, #mobile-menu').click(function(e) {
        e.stopPropagation();
    });
    function checkWindowSize() {
        if ($(window).width() > 998) {
            $('#mobile-menu').css('display', 'none').removeClass("xactive");
            $('#mobilepro i').addClass('fa-reorder');
        }
    }
    $(window).load(checkWindowSize);
    $(window).resize(checkWindowSize);

    /*** [Smooth Scrolling] ***/
    /* http://github.com/kswedberg/jquery-smooth-scroll */
    /* -------------------------------------------------------------------------------- */

    $(window).scroll(function(){
        if ($(this).scrollTop() > 100) {
            $('.scrollup').fadeIn();
        } else {
            $('.scrollup').fadeOut();
        }
    });

    $("a[href*=#wrap],.scrollup").click(function (document) {
        if ($.browser.opera) {
            $("html").animate({scrollTop:0}, "slow");
        } else {
            $("html, body").animate({scrollTop:0}, "slow");
        }
    });

    /*** [Ajax Contact form] ***/
    /* -------------------------------------------------------------------------------- */
    $('form#contactform').submit(function (event) {
       event.preventDefault();
        $.ajax({
            url: MyAjax.ajaxurl,
            type:'POST',
            data: 'action=ht_contact_action&'+ $("#contactform").serialize() + '&contactNounce='+MyAjax.contactNounce
        }).success(function (data) {
            $('.log').html(data);
            $('.loading').remove();
            if ($('.info-box-wrapper').hasClass('success')) {
                $('#contactform').slideUp('slow');
            }
        });

    }); 
    
    /*** [Hover Column] ***/
    /* -------------------------------------------------------------------------------- */
    $(".woocommerce ul.products li.product").hover(function(){
        $(this).find('.thumbnail-container').stop().animate({
            opacity: 0.7
        }, 500);
        $(this).find('.onsale').stop().animate({
            top: 5
        }, 300);


    }, function(){

        $(this).find('.thumbnail-container').stop().animate({
            opacity: 1
        }, 500);
        $(this).find('.onsale').stop().animate({
            top:0
        }, 300);      
    });

    $(".woocommerce .images a.zoom").hover(function(){
        $(this).stop().animate({
            opacity: 0.7
        }, 500);

    }, function(){
        $(this).stop().animate({
            opacity: 1
        }, 500);

    });

    $('.woocommerce-page table.shop_table tr:odd').addClass('woo-cart-item');
    $('#searchform #searchsubmit').val('');
    

    /*** [Replace Retina images] ***/
    /* -------------------------------------------------------------------------------- */    
    if(window.isRetina()) {
        $('img[data-retina]').each(function(){
            var img_src = $(this).attr('src');
            var retinaSrc = img_src.replace('.png', '@2x.png');
            var img_height = $(this).height();
            var img_width = $(this).width();
            $(this).attr('src' , retinaSrc);  
            $(this).attr('width' , img_width);
            $(this).attr('height' , img_height); 
        });    
    }

    /*** [Fit Videos] ***/
    /* -------------------------------------------------------------------------------- */
    $("#main").fitVids();

    /*** [Video Background Poster] ***/
    /* -------------------------------------------------------------------------------- */    
    if ($(".video-background video[poster]")[0]) {
        var poster = $('.video-background video').attr('poster');
        if( poster.length > 0 ) {
             $('<div class="poster-img" style="background-image: url('+poster+');">').appendTo('body');
        }
    }


}); //#END



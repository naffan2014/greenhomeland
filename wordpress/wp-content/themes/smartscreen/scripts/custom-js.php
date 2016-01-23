<?php
/************************************************************************
 * Custom JS File
 *************************************************************************/ 

function load_custom_js(){
	global $data;

	$script_out = '';

	$script_out .= '<script type="text/javascript">'."\n";
	$script_out .= 'jQuery(document).ready(function($){'."\n";
	$script_out .=  ht_music_status_js();
	$script_out .=  ht_lightbox_themes_js();
	$script_out .=  ht_misc_js();
	$script_out .= 	ht_slider_js();
	$script_out .= '});'."\n";
	$script_out .= "\n".'</script>'."\n\n\n";
	if( is_singular('portfolio') || is_singular('post') ){
		$script_out .= ht_add_google_plus();
	}

	echo $script_out;

}

add_action('wp_footer','load_custom_js',100);


function ht_music_status_js() {
	global $data;
	$out = '';

	if( $data['music_autoplay'] ) {
		$autoplay = 'true';
	} else {
		$autoplay = 'false';
	}

	if( $data['music_loop'] ){
		$loop = 'true';
	} else {
		$loop = 'false';
	}

	// if audio for all pages
	if ( '2' == $data['music_status'] ) {
			$out .='
	        audiojs.settings.autoplay = '. $autoplay.';
	        audiojs.settings.loop = '. $loop .';
	        audiojs.events.ready(function() {
	            var as = audiojs.createAll();
	        });
			';	

	// if just for homepage
	} else if( '3' == $data['music_status'] ) {
		if( is_front_page() ) {
			$out .='
	        audiojs.settings.autoplay = '. $autoplay.';
	        audiojs.settings.loop = '. $loop .';
	        audiojs.events.ready(function() {
	            var as = audiojs.createAll();
	        });
			';			
		}

	}

	return $out;


}

function ht_lightbox_themes_js() {
	global $data;
	$out = '';

	$lightbox_theme = ( $data['lightbox_theme'] ) ? $data['lightbox_theme'] : 'dark_square';

	$out .='
    jQuery("a[rel^=\'prettyPhoto\']").prettyPhoto({animation_speed:\'normal\', autoplay_slideshow: false, theme:\' '.$lightbox_theme.'\'});
    ';

	return $out;

}

function ht_misc_js() {
	global $data;
	$out = '';

	if( $data['hide_menu'] =='1' && is_front_page() ) {

		$out .='
		var menu_height = jQuery("#menu-wrap").height() + 50;
		var isMobile = "ontouchstart" in document.documentElement;

		if( !isMobile) { 
			jQuery("#menu-wrap").stop(true, true).animate({top:-menu_height}, "5000", "swing");
			jQuery(".menu-toggle").attr("data-active", "yes");
		}
	    ';

	}

	if( $data['rollover_effect'] !='1' ) { 
		$out .='jQuery(".frame").each(frameHover);';
	}

	$out .= '
	var retina = (window.devicePixelRatio > 1 || (window.matchMedia && window.matchMedia("(-webkit-min-device-pixel-ratio: 1.5),(-moz-min-device-pixel-ratio: 1.5),(min-device-pixel-ratio: 1.5)").matches) );';

     if( isset($data['retina_logo_url'] ) && $data['retina_logo_url'] != '' ) {
        $out .='
        if(retina) {
            var defaultWidth = jQuery("#menu #logo img").width();
            
            jQuery("#menu #logo img").attr("src", "'.$data["retina_logo_url"].'").css("width", defaultWidth + "px");
        }
        ';
     }

	return $out;
}
function ht_add_google_plus() {
	$out = '';
	$out .= '
	<script type="text/javascript" src="//apis.google.com/js/plusone.js"></script>
        <script type="text/javascript">
        function plusone_vote( obj ) {
            _gaq.push([\'_trackEvent\',\'plusone\',obj.state]);
        }
    </script>
    ';
    return $out;
}





/*
*  print out the JS for slider
*/
if( ! function_exists('ht_slider_js') ){
    function ht_slider_js() {
        global $data;
        $out ='';

        $out .='
            $(window).load(function() {
                $("#slideshow .flexslider").flexslider({
                    animation: " '. strtolower($data['slideshow_transition_effect']) .'",
                    pauseOnHover: true,
                    keyboard: true,
                    animationLoop: true,
                    smoothHeight: true,';

                    if( $data['slideshow_timeout'] ) : 
                        $out .='slideshowSpeed: '.$data['slideshow_timeout'].'000,';
                        else : 
                        $out .= 'slideshow: false,';
                        endif; 
                $out .='});';

                $out .='$("#slideshow").hover(function(){
                    	$("#slideshow .flex-next, #slideshow .flex-prev").css({"display":"block"});
                		}, function(){
                    	$("#slideshow .flex-next, #slideshow .flex-prev").css({"display":"none"});
                	});

            });//end load
		';

		return $out;
        }

}

?>
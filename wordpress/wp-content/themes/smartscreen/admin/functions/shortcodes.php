<?php
/**
 *
 * HighThemes Options Framework
 * twitter : http://twitter.com/theHighthemes
 *
 */


/*
 * Formatting the content autop manually
 */
function ht_autop($str) 
{
    $str = wpautop( $str );
    $str = preg_replace( '/<\/?p>(\[(.*)\])<\/?p>/', '$1', $str );    // <p>[sc]</p>
    $str = preg_replace( '/(\[(.*)\])[ ]*<\/?p>/', '$1', $str );       // [/sc]</p>
    $str = preg_replace( '/(\[(.*)\])<br \/>/', '$1', $str );     // [/sc]<br />
    $str = preg_replace( '/<\/?p>(\[(.*))/', '$1', $str );           // <p>[sc
    $str = preg_replace( '/(=")<br \/>\n/', '$1', $str );           // ="<br />
    $str = preg_replace( '/\n<\/?p>(")/', '$1', $str );           // <p>" 
    $str = do_shortcode( $str );
    
    return $str;
}    

function ht_content_formatter( $str ) 
{
    $str = ht_autop( $str );
    $str = prepend_attachment($str);
    
    return $str;
}      

remove_filter( 'the_content', 'wpautop');
remove_filter( 'the_content', 'prepend_attachment' );      
remove_filter( 'the_content', 'do_shortcode', 11 ); 
add_filter   ( 'the_content', 'ht_content_formatter' );       
                                           


/*
 * Lists
 */
if( ! function_exists( 'ht_list' ) ) {
    function ht_list( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'type'	=> 'bulletlist'
        ), $atts));

        return str_replace('<ul>', '<ul class="'.$type.'">', do_shortcode($content));
    }
}
add_shortcode("list", "ht_list");

/*
 * Buttons
 */
if( ! function_exists( 'ht_button' ) ) {
    function ht_button( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'link'      => '#',
            'target'    => '',
            'type'      => 'glossy', // simple, glossy
            'size' 		=> 'small', // small, medium. large
            'color'		=> 'black' // magenta, rosy, pink, orange, yellow, red, green, blue, grey, black, purple, teal
        ), $atts));

        if($type == 'glossy') {
            return '<a class="button '.$size.' '.$color.'" href="'.$link.'" target="'.$target.'"><span></span>'.$content.'</a>';
        } else {
            return '<a class="s-button '.$size.' s-'.$color.'" href="'.$link.'" target="'.$target.'">'.$content.'</a>';
        }
    }
}
add_shortcode('button', 'ht_button');

/*
 * Icon Link
 */
if( ! function_exists( 'ht_icon_link' ) ) {
    function ht_icon_link( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'link'      => '#',
            'icon'      => '',
            'target'    => '_self'
        ), $atts));

        return '<a class="icon-link" target="'.$target.'" href="'.$link.'"><i class="fa '.$icon.'"></i>'.$content.'</a>';
    }
}
add_shortcode('icon_link', 'ht_icon_link');

/*
 * Special Boxes
 */
if( ! function_exists( 'ht_simple_box' ) ) {
    function ht_simple_box( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'border_size'	=> '1px',
            'border_color'	=> '#000'
        ), $atts));

        return '<div style="border:'.$border_size.' solid '.$border_color.'" class="simple-box">'. do_shortcode($content) .'</div>';
    }
}
add_shortcode('simple_box', 'ht_simple_box');

/*
 * Titled Box
 */
if( ! function_exists( 'ht_titled_box' ) ) {
    function ht_titled_box( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'title'      => 'title',
            'color'		=> 'white'
        ), $atts));
        $out = '';
        $out .= '<h6 class="titled-box-header s-'.$color.'"><span>'.$title.'</span></h6>';
        $out .= '<div class="titled-box">'. do_shortcode($content) .'</div>';

        return $out;
    }
}
add_shortcode('titled_box', 'ht_titled_box');

/*
 * Info Box
 */
if( ! function_exists( 'ht_info_box' ) ) {
    function ht_info_box( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'type'  => 'titled',
            'title' => 'title',
            'color' => 'green',
            'icon'  => '',
            'link'  => ''
        ), $atts));
        $out = '';

        if($type == 'titled') {

            if($link){
                $new_title = '<a href="'.$link.'"> ' . do_shortcode($title) . '</a>';
            } else {
                $new_title = do_shortcode($title);

            }
            $out .= '<div class="info-box-wrapper">';
            if($icon == '') {
                $out .= '<div class="info-box-'.$color.'-header"><div class="info-content-box">'.$new_title.'</div></div>';
            } else {
                $out .= '<div class="info-box-'.$color.'-header"><div class="info-content-box-icon"><i class="fa '.$icon.'"></i> '.$new_title.'</div></div>';
            }
            $out .= '</div>';
        } else {
            $out .= '<div class="info-box-wrapper">';
            if($icon == '') {
                $out .= '<div class="info-box-'.$color.'-header"><div class="info-content-box">'.do_shortcode($title).'</div></div>';
            } else {
                $out .= '<div class="info-box-'.$color.'-header"><div class="info-content-box-icon"><i class="fa '.$icon.'"></i> '.do_shortcode($title).'</div></div>';
            }
            $out .= '<div class="info-box-'.$color.'-body"><div class="info-content-box">'. do_shortcode($content) .'</div></div>';
            $out .= '</div>';
        }

        return $out;
    }

}
add_shortcode('info_box', 'ht_info_box');

/*
 * Call to action 
 */
if( ! function_exists( 'ht_cta_box' ) ) {
    function ht_cta_box( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'button_color' => 'green',
            'button_title' => '',
            'button_url' => '',
            'title' => ''
        ), $atts));


        $out = '';
        $out .= ' <div class="cta-box">';
        if(!empty($button_title)) {
            $out .= ' <a href="'.$button_url.'" class="s-button large s-'.$button_color.'"><span></span>'.$button_title.'</a>';
        }
        $out .= ' <div class="cta-text">';
        $out .= ' <h2>'.$title.'</h2>';
        $out .= ' <p>'.do_shortcode($content).'</p>';
        $out .= ' </div>';
        $out .= ' </div>';

        return $out;

    }

}
add_shortcode('cta_box', 'ht_cta_box');

/*
 * Tooltip
 */
if( ! function_exists( 'ht_tooltip' ) ) {
    function ht_tooltip( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'trigger'      => '',
        ), $atts));
        $out = '';
        $out .= '<span class="tooltip_sc">'.$trigger.'</span>';
        $out .= '<div class="tool_tip">';
        $out .= '<div class="tooltip_body">'.$content.'</div>';
        $out .= '<div class="tooltip_tip"></div>';
        $out .= '</div>';

        return $out;
    }

}
add_shortcode('tooltip', 'ht_tooltip');


/*
 * Code & Pre
 */
if( ! function_exists( 'ht_code' ) ) {
    function ht_code( $atts, $content = null ) {
        return '<code class="code">'.$content.'</code>';
    }
}
add_shortcode('code_sc', 'ht_code');

// pre
if( ! function_exists( 'ht_pre' ) ) {
    function ht_pre( $atts, $content = null ) {
        return '<pre class="pre">'.$content.'</pre>';
    }

}
add_shortcode('pre', 'ht_pre');

/*
 * Dividers
 */
if( ! function_exists( 'ht_divider' ) ) {
    function ht_divider( $atts, $content = null ) {
        return '<div class="divider"></div>';
    }

}
add_shortcode('hr', 'ht_divider');


// with top link
if( ! function_exists( 'ht_divider_top' ) ) {
    function ht_divider_top( $atts, $content = null ) {
        return '<div class="divider top"><a href="#wrap">'.__('Top','highthemes').'</a></div>';
    }
}
add_shortcode('hr_top', 'ht_divider_top');

/*
 * Drop-Caps
 */
if( ! function_exists( 'ht_drop_cap' ) ) {
    function ht_drop_cap( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'type'      => 'dropcap1'
        ), $atts));

        return '<span class="'.$type.'">'.$content.'</span>';
    }

}
add_shortcode('dropcap', 'ht_drop_cap');

/*
 * Pullquote
 */
if( ! function_exists( 'ht_callout_right' ) ) {
    function ht_callout_right( $atts, $content = null ) {
        return '<blockquote class="pullquote-right"><p>'. do_shortcode($content) .'</p></blockquote>';
    }
}
add_shortcode('callout_right', 'ht_callout_right');

// callout left
if( ! function_exists( 'ht_callout_left' ) ) {
    function ht_callout_left( $atts, $content = null ) {
        return '<blockquote class="pullquote-left"><p>' . do_shortcode($content) . '</p></blockquote>';
    }
}
add_shortcode('callout_left', 'ht_callout_left');

// pullquote
if( ! function_exists( 'ht_pullquote' ) ) {
    function ht_pullquote( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'cite'      => ''
        ), $atts));
        $out = '';
        $out .= '<blockquote class="pullquote">';
        $out .= 	'<p>'. do_shortcode($content) .'<cite>'.$cite.'</cite></p>';
        $out .= '</blockquote>';

        return $out;
    }

}
add_shortcode('pullquote', 'ht_pullquote');

/*
 * Toggle
 */
if( ! function_exists( 'ht_toggle' ) ) {
    function ht_toggle( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'title'		=> ''
        ), $atts));
        $out = '';
        $out .= '<div class="toggle-item">';
        $out .= 	'<div class="toggle-head"><h3><span class="arrow"></span>'.$title.'</h3></div>';
        $out .= 	'<div class="toggle-body"><p>'.do_shortcode($content).'</p></div>';
        $out .= '</div>';


        return $out;
    }

}
add_shortcode('toggle', 'ht_toggle');

/*
 * Text Highlight
 */
if( ! function_exists( 'ht_highlight' ) ) {
    function ht_highlight ($atts, $content = null) {
        extract(shortcode_atts(array(
            'color'      => 'yellow' //red, black
        ), $atts));

        return '<span class="highlight-'.$color.'">'. do_shortcode($content) .'</span>';
    }

}
add_shortcode('highlight', 'ht_highlight');

/*
 * Image Frames
 */
if( ! function_exists( 'ht_lightbox' ) ) {
    function ht_lightbox ($atts, $content = null) {
        extract(shortcode_atts(array(
            'big_image_url' => '',
            'video_url'     => '',
            'type'          => 'image', //image , video
            'align'         => '', // left , right
            'title'         => '',
        ), $atts));
        $content = str_replace("&#215;", "x", $content);

        $out = '';
        if($type == 'image' || empty($type)) {
            $out .=  '<a href="'.$big_image_url.'" title="'.$title.'" rel="prettyPhoto">';
            $out .=  '<img src="'.$content.'" alt="" />';
            $out .=  '<i class="fa fa-search zoom"></i>';
            $out .=  '</a>';
        } else {
            $out .=  '<a href="'.$video_url.'" title="'.$title.'" rel="prettyPhoto">';
            $out .=  '<img src="'.$content.'" alt="" />';
            $out .=  '<i class="fa fa-video-camera video"></i>';
            $out .=  '</a>';
        }
        if($align == 'right') {
            $out = '<div class="frame fr sc-lightbox">'.$out.'</div>';
        } elseif($align == 'left') {
            $out = '<div class="frame fl sc-lightbox">'.$out.'</div>';
        } else {
            $out = '<div class="frame fc sc-lightbox">'.$out.'</div>';
        }
        return $out;
    }

}
add_shortcode('lightbox', 'ht_lightbox');

if( ! function_exists( 'ht_image_left' ) ) {
    function ht_image_left( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'link'      => '',
        ), $atts));
        $out = '';
        if(trim($link) !='') {
            $out .= '<a href="'.$link.'"><p class="alignleft"><img class="frame" src="' . $content . '" title="" alt="" /></p></a>';
        } else {
            $out .= '<p class="alignleft"><img class="frame" src="' . $content . '" title="" alt="" /></p>';
        }
        return $out;
    }

}
add_shortcode('image_left', 'ht_image_left');

// image right
if( ! function_exists( 'ht_image_right' ) ) {
    function ht_image_right( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'link'      => '',
        ), $atts));
        $out = '';
        if(trim($link) !='') {
            $out .= '<a href="'.$link.'"><p class="alignright"><img class="frame" src="' . $content . '" title="" alt="" /></p></a>';
        } else {
            $out .= '<p class="alignright"><img class="frame" src="' . $content . '" title="" alt="" /></p>';
        }

        return $out;
    }

}
add_shortcode('image_right', 'ht_image_right');

// image centered
if( ! function_exists( 'ht_image_center' ) ) {
    function ht_image_center( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'link'      => '',
        ), $atts));
        $out = '';
        if(trim($link) !='') {
            $out .= '<p class="aligncenter"><a href="'.$link.'"><img class="aligncenter" src="' . $content . '" title="" alt="" /></a></p>';
        } else {
            $out .= '<p class="aligncenter"><img class="frame aligncenter" src="' . $content . '" title="" alt="" /></p>';
        }

        return $out;
    }

}
add_shortcode('image_center', 'ht_image_center');

/*
* Tabs
*/
if( ! function_exists( 'ht_tabs_sc' ) ) {
    function ht_tabs_sc( $atts, $content = null ) {
        extract(shortcode_atts(array(
        ), $atts));
        $out = '';
        $out .= '<div class="tab-set">';
        $out .= '<ul class="tabs-titles">';
        foreach ($atts as $tab) {
            $out .= '<li><a href="#">' .$tab. '</a></li>';
        }
        $out .= '</ul>';
        $out .= do_shortcode($content) .'</div>';

        return $out;
    }

}
add_shortcode('tabs', 'ht_tabs_sc');
if( ! function_exists( 'custom_tabs_sc' ) ) {
    function custom_tabs_sc( $atts, $content = null ) {
        extract(shortcode_atts(array(
        ), $atts));

        return '<div class="tab-content">' . do_shortcode($content) .'</div>';
    }

}
add_shortcode('tab', 'custom_tabs_sc');

/* 
* Accordions
*/
if( ! function_exists( 'ht_accordions_sc' ) ) {
    function ht_accordions_sc( $atts, $content = null ) {
        extract(shortcode_atts(array(
        ), $atts));
        $out = '';
        $out .= '<div class="accordion">';
        $out .= 	do_shortcode($content);
        $out .= '</div>';

        return $out;
    }

}
add_shortcode('accordions', 'ht_accordions_sc');

if( ! function_exists( 'ht_accordion_sc' ) ) {
    function ht_accordion_sc( $atts, $content = null ) {
        extract(shortcode_atts(array('title'=>'',
        ), $atts));
        $out = '';
        $out .= '<div class="acc-item"><div class="acc-head"><h3><span class="arrow"></span>' .$title. '</h3></div>';
        $out .= 	'<div class="acc-content"><p>'.do_shortcode($content).'</p></div>';
        $out .= '</div>';

        return $out;
    }

}
add_shortcode('accordion', 'ht_accordion_sc');

/* 
* Slideshow
*/
if( ! function_exists( 'ht_slideshow' ) ) {
    function ht_slideshow( $atts, $content = null ) {
        extract(shortcode_atts(array('width' =>'500'
        ), $atts));
        $content = str_replace("&#215;", "x", $content);

        $out = '';
        $out .= '<div style="width: ' . $width . 'px" class="slideshow-sc flexslider"><ul class="slides">';
        $out .= 	do_shortcode($content);
        $out .= '</ul></div>';

        return $out;
    }

}
add_shortcode('slideshow', 'ht_slideshow');

if( ! function_exists( 'ht_slide' ) ) {
    function ht_slide( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'link'		=> '#',
            'width' => '',
            'height' =>'',
        ), $atts));
        $out = '';

            if($link == '') {
                $out .= '<li><img width="'.$width.'" height="'.$height.'" class="frame" src="'.$content.'" alt="" /></li>';

            } else {
                $out .= '<li><a href="'.$link.'"><img width="'.$width.'" height="'.$height.'" class="frame" src="'.$content.'" alt="" /></a></li>';
            }



        return $out;
    }

}
add_shortcode('slide', 'ht_slide');

/* 
* Testimonial
*/
if( ! function_exists( 'ht_testimonials' ) ) {
    function ht_testimonials( $atts, $content = null ) {
        $out="";
        $out .= '<div class="sc-testimonials"><div class="flexslider"><ul class="slides">';
        $out .= 	do_shortcode($content);
        $out .= '</ul></div></div>';

        return $out;
    }

}
add_shortcode('testimonials', 'ht_testimonials');

if( ! function_exists( 'ht_testimonial' ) ) {
    function ht_testimonial( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'name'			=> 'John Smith',
            'website_url'	=> 'http://www.site.com'
        ), $atts));

        if($name == '' && $website_url !='') {
            return '<li class="testimonial"><p>'.$content.'<cite>'.$website_url.'</cite></p></li>';
        } elseif($name != '' && $website_url =='') {
            return '<li class="testimonial"><p>'.$content.'<cite>- '.$name.'</cite></p></li>';
        } elseif($name == '' && $website_url =='') {
            return '<li class="testimonial"><p>'.$content.'</p></li>';
        } else {
            return '<li class="testimonial"><p>'.$content.'<cite>- '.$name.', '.$website_url.'</cite></p></li>';
        }
    }

}
add_shortcode('testimonial', 'ht_testimonial');

/*
* Progress Bar
*/
if( ! function_exists( 'ht_progress' ) ) {
    function ht_progress( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'value'	=> '10', // 1-100
            'color'	=> 'grey',
            'width'	=> '10', // 1-100
            'type'	=> 'simple' // Simple,Round
        ), $atts));

        $out = '';
        $out .= '<div style="width: '.$width.'%" class="progress '.($type == 'round' ? 'round' : 'simple').'">';
        $out .= '<span class="meter s-'.$color.'" style="width: '.$value.'%;">'.$content.'</span>';
        $out .= '</div>';
        return $out;
    }

}
add_shortcode('progress', 'ht_progress');


/**
 * Multiple point Google Map
 *
 */
if( ! function_exists( 'ht_google_map' ) ) {
    function ht_google_map( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'values'  =>'',
            'height' => '230',
            'zoom'   => '10', // 1-19
            'type'   => 'ROADMAP', // ROADMAP, SATELLITE, HYBRID, TERRAIN
        ), $atts));
        $unique = uniqid();
        $gmap_lines = explode(",", $values);
        $max_value = 0.0;
        $gmap_lines_data = array();
        foreach ($gmap_lines as $line) {
            $line = trim($line);
            $new_line = array();
            $text_info = 2;
            $data = explode("|", $line);
            $new_line['lat'] = isset($data[0]) ? $data[0] : 0;
            $new_line['lng'] = isset($data[1]) ? $data[1] : 0;
            $new_line['text_info'] = isset($data[2]) ? $data[2] : '';

            $gmap_lines_data[] = $new_line;
        }

        $location = '';
        foreach($gmap_lines_data as $line) {
        
            $location .= "['<div class=\"gmap-info\">". $line['text_info'] ."</div>', ". $line['lat'] .", ". $line['lng'] ."],";

        } 

        if(is_ssl()){
            $google_url = 'https://maps.google.com/maps/api/js?sensor=false';
        } else {
           $google_url = 'http://maps.google.com/maps/api/js?sensor=false';
        }

        $out = <<<EOF
<script src="$google_url" type="text/javascript" ></script>
<div id="google_map_{$unique}" class="google-map" style="height:{$height}px;" >
</div>
  <script type="text/javascript">
  (function(){
    // Define your locations: HTML content for the info window, latitude, longitude
    var locations = [
        $location
    ];
    
    // Setup the different icons and shadows
    var iconURLPrefix = 'http://maps.google.com/mapfiles/ms/icons/';
    
    var icons = [
      iconURLPrefix + 'red-dot.png',
      iconURLPrefix + 'green-dot.png',
      iconURLPrefix + 'blue-dot.png',
      iconURLPrefix + 'orange-dot.png',
      iconURLPrefix + 'purple-dot.png',
      iconURLPrefix + 'pink-dot.png',      
      iconURLPrefix + 'yellow-dot.png'
    ]
    var icons_length = icons.length;
    
    
    var shadow = {
      anchor: new google.maps.Point(15,33),
      url: iconURLPrefix + 'msmarker.shadow.png'
    };

    var map = new google.maps.Map(document.getElementById('google_map_{$unique}'), {
      zoom: {$zoom},
      center: new google.maps.LatLng(locations[0][1], locations[0][2]),
      mapTypeId: google.maps.MapTypeId.{$type},
      mapTypeControl: false,
      streetViewControl: false,
      scrollwheel: false, 
      panControl: false,

      zoomControlOptions: {
         position: google.maps.ControlPosition.LEFT_BOTTOM
      }
    });

    var infowindow = new google.maps.InfoWindow({
      maxWidth: 300,
    });

    var marker;
    var markers = new Array();
    
    var iconCounter = 0;
    
    // Add the markers and infowindows to the map
    for (var i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon : icons[iconCounter],
        shadow: shadow
      });

      markers.push(marker);

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
      
      iconCounter++;
      // We only have a limited number of possible icon colors, so we may have to restart the counter
      if(iconCounter >= icons_length){
        iconCounter = 0;
      }
     
    }
        function AutoCenter() {
      //  Create a new viewpoint bound
      var bounds = new google.maps.LatLngBounds();
      //  Go through each...
      jQuery.each(markers, function (index, marker) {
        bounds.extend(marker.position);
      });
      //  Fit these bounds to the map
      map.fitBounds(bounds);
    }
    if( locations.length > 1 ) {
        AutoCenter();     
    }


})();    
  </script> 
EOF;

return $out;

    }
}
add_shortcode( 'ht_google_map', 'ht_google_map' );


/* 
* Pricing Table
*/
if( ! function_exists( 'ht_pricing_table' ) ) {
    function ht_pricing_table( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'cols'	=> '4'
        ), $atts));
        $out = '';
        $out .= '<div class="pricing-tables pricing-table-'.$cols.'col">';
        $out .= 	do_shortcode($content);
        $out .= '</div>';

        return $out;
    }

}
add_shortcode('pricing_table', 'ht_pricing_table');

if( ! function_exists( 'ht_pricing_col' ) ) {
    function ht_pricing_col( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'title'		=> 'standard',
            'color'		=> 'teal',
            'price'		=> '',
            'sign'		=> '$',
            'special'	=> 'false',
            'special_color'	=> 'orange',
            'button_title'	=> '',
            'button_link'	=> '#'
        ), $atts));
        $out = '';
        if($special == 'false') {
            $out .= '<div class="pricing-table">';
            $out .=     '<div class="pricing-block s-'.$color.'">';
        } else {
            $out .= '<div class="pricing-table pricing-special">';
            $out .=     '<div class="pricing-block s-'.$special_color.'">';
        }
        $out .=         '<h2 class="pricing-title">'.$title.'</h2>';
        $out .=     '</div>';
        $out .=     '<div class="pricing-block s-grey">';
        $out .=         '<h2 class="pricing-price">'.$price.'<span>'.html_entity_decode($sign).'</span></h2>';
        $out .=     '</div>';
        $out .= 	'<div class="pricing-body">';
        $out .= 	    ''.do_shortcode($content).'';
        $out .= 	'</div>';
        $out .=     '<div class="pricing-block s-grey">';
        $out .=         '<a href="'.$button_link.'" class="s-button medium s-'.$special_color.'">'.$button_title.'</a>';
        $out .=     '</div>';
        $out .= '</div>';

        return $out;
    }

}
add_shortcode('col', 'ht_pricing_col');

/*
 * Grid Columns
 */
if( ! function_exists( 'ht_one_third' ) ) {
    function ht_one_third( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'last'		=> 'no',
        ), $atts));
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        $class = ($last == 'yes') ? 'last' : '';
        $fix = '';
        if( 'yes' == $last ){
            $fix = '<div class="fix"></div>';
        }        
        return '<div class="one_third '.$class.'">' . do_shortcode($content) . '</div>' . $fix;
    }
}
add_shortcode('one_third', 'ht_one_third');

if( ! function_exists( 'ht_one_third_last' ) ) {
    function ht_one_third_last( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="fix"></div>';
    }
}
add_shortcode('one_third_last', 'ht_one_third_last');

if( ! function_exists( 'ht_two_third' ) ) {
    function ht_two_third( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'last'		=> 'no',
        ), $atts));
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        $class = ($last == 'yes') ? 'last' : '';
        $fix = '';
        if( 'yes' == $last ){
            $fix = '<div class="fix"></div>';
        }        
        return '<div class="two_third '.$class.'">' . do_shortcode($content) . '</div>' . $fix;
    }
}
add_shortcode('two_third', 'ht_two_third');

if( ! function_exists( 'ht_two_third_last' ) ) {
    function ht_two_third_last( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="fix"></div>';
    }
}
add_shortcode('two_third_last', 'ht_two_third_last');

if( ! function_exists( 'ht_one_half' ) ) {
    function ht_one_half( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'last'		=> 'no',
        ), $atts));
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        $class = ($last == 'yes') ? 'last' : '';
        $fix = '';
        if( 'yes' == $last ){
            $fix = '<div class="fix"></div>';
        }        
        return '<div class="one_half '.$class.'">' . do_shortcode($content) . '</div>' . $fix;
    }
}
add_shortcode('one_half', 'ht_one_half');

if( ! function_exists( 'ht_one_half_last' ) ) {
    function ht_one_half_last( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="fix"></div>';
    }
}
add_shortcode('one_half_last', 'ht_one_half_last');

if( ! function_exists( 'ht_one_fourth' ) ) {
    function ht_one_fourth( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'last'		=> 'no',
        ), $atts));
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        $class = ($last == 'yes') ? 'last' : '';
        $fix = '';
        if( 'yes' == $last ){
            $fix = '<div class="fix"></div>';
        }        
        return '<div class="one_fourth '.$class.'">' . do_shortcode($content) . '</div>' . $fix ;
    }
}
add_shortcode('one_fourth', 'ht_one_fourth');

if( ! function_exists( 'ht_one_fourth_last' ) ) {
    function ht_one_fourth_last( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="fix"></div>';
    }
}
add_shortcode('one_fourth_last', 'ht_one_fourth_last');

if( ! function_exists( 'ht_three_fourth' ) ) {
    function ht_three_fourth( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'last'		=> 'no',
        ), $atts));
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        $class = ($last == 'yes') ? 'last' : '';
        $fix = '';
        if( 'yes' == $last ){
            $fix = '<div class="fix"></div>';
        }        
        return '<div class="three_fourth '.$class.'">' . do_shortcode($content) . '</div>' . $fix;
    }
}
add_shortcode('three_fourth', 'ht_three_fourth');

if( ! function_exists( 'ht_three_fourth_last' ) ) {
    function ht_three_fourth_last( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="fix"></div>';
    }
}
add_shortcode('three_fourth_last', 'ht_three_fourth_last');

if( ! function_exists( 'ht_one_fifth' ) ) {
    function ht_one_fifth( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'last'		=> 'no',
        ), $atts));
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        $class = ($last == 'yes') ? 'last' : '';
        $fix = '';
        if( 'yes' == $last ){
            $fix = '<div class="fix"></div>';
        }        
        return '<div class="one_fifth '.$class.'">' . do_shortcode($content) . '</div>' . $fix;
    }
}
add_shortcode('one_fifth', 'ht_one_fifth');

if( ! function_exists( 'ht_one_fifth_last' ) ) {
    function ht_one_fifth_last( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="fix"></div>';
    }
}
add_shortcode('one_fifth_last', 'ht_one_fifth_last');

if( ! function_exists( 'ht_two_fifth' ) ) {
    function ht_two_fifth( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'last'		=> 'no',
        ), $atts));
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        $class = ($last == 'yes') ? 'last' : '';
        $fix = '';
        if( 'yes' == $last ){
            $fix = '<div class="fix"></div>';
        }        
        return '<div class="two_fifth '.$class.'">' . do_shortcode($content) . '</div>' . $fix;
    }
}
add_shortcode('two_fifth', 'ht_two_fifth');

if( ! function_exists( 'ht_two_fifth_last' ) ) {
    function ht_two_fifth_last( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="fix"></div>';
    }
}
add_shortcode('two_fifth_last', 'ht_two_fifth_last');

if( ! function_exists( 'ht_three_fifth' ) ) {
    function ht_three_fifth( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'last'		=> 'no',
        ), $atts));
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        $class = ($last == 'yes') ? 'last' : '';
        $fix = '';
        if( 'yes' == $last ){
            $fix = '<div class="fix"></div>';
        }        
        return '<div class="three_fifth '.$class.'">' . do_shortcode($content) . '</div>' . $fix;
    }
}
add_shortcode('three_fifth', 'ht_three_fifth');

if( ! function_exists( 'ht_three_fifth_last' ) ) {
    function ht_three_fifth_last( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="fix"></div>';
    }
}
add_shortcode('three_fifth_last', 'ht_three_fifth_last');

if( ! function_exists( 'ht_four_fifth' ) ) {
    function ht_four_fifth( $atts, $content = null ) {
        extract(shortcode_atts(array(
            'last'		=> 'no',
        ), $atts));
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        $class = ($last == 'yes') ? 'last' : '';
        $fix = '';
        if( 'yes' == $last ){
            $fix = '<div class="fix"></div>';
        }        
        return '<div class="four_fifth '.$class.'">' . do_shortcode($content) . '</div>' . $fix;
    }

}
add_shortcode('four_fifth', 'ht_four_fifth');

if( ! function_exists( 'ht_four_fifth_last' ) ) {
    function ht_four_fifth_last( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="fix"></div>';
    }
}
add_shortcode('four_fifth_last', 'ht_four_fifth_last');

if( ! function_exists( 'ht_one_sixth' ) ) {
    function ht_one_sixth( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
    }
}
add_shortcode('one_sixth', 'ht_one_sixth');

if( ! function_exists( 'ht_one_sixth_last' ) ) {
    function ht_one_sixth_last( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="fix"></div>';
    }
}
add_shortcode('one_sixth_last', 'ht_one_sixth_last');

if( ! function_exists( 'ht_five_sixth' ) ) {
    function ht_five_sixth( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
    }
}
add_shortcode('five_sixth', 'ht_five_sixth');

if( ! function_exists( 'ht_five_sixth_last' ) ) {
    function ht_five_sixth_last( $atts, $content = null ) {
        $content = preg_replace('#^<\/p>|<p>$#', '', $content);
        return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="fix"></div>';
    }

}
add_shortcode('five_sixth_last', 'ht_five_sixth_last');

/*
 * Misc
 */
if( ! function_exists( 'ht_line' ) ) {
    function ht_line( $atts, $content = null ) {
        return '<div class="line-sc"></div>';
    }

}
add_shortcode('line', 'ht_line');
if( ! function_exists( 'ht_p_sc' ) ) {
    function ht_p_sc( $atts, $content = null ) {
        return '<p class="p-sc">' . do_shortcode($content) . '</p>';
    }

}
add_shortcode('p', 'ht_p_sc');
if( ! function_exists( 'ht_image_sc' ) ) {
    function ht_image_sc( $atts, $content = null ) {
        return '<div class="image-sc">' . do_shortcode($content) . '</div>';
    }

}
add_shortcode('image', 'ht_image_sc');
if( ! function_exists( 'ht_text_align_center' ) ) {
    function ht_text_align_center( $atts, $content = null ) {
        return '<div style="text-align: center;">' . do_shortcode($content) . '</div>';
    }

}
add_shortcode('text_align_center', 'ht_text_align_center');
if( ! function_exists( 'ht_text_align_right' ) ) {
    function ht_text_align_right( $atts, $content = null ) {
        return '<div style="text-align: right;">' . do_shortcode($content) . '</div>';
    }

}
add_shortcode('text_align_right', 'ht_text_align_right');

if ( ! class_exists('Jetpack') ) {
    // remove default shortcode
    remove_shortcode('gallery', 'gallery_shortcode');

    /**
     * Re-declare Wordpress gallery shortcode
     */
    function ht_gallery_shortcode($attr) {
        $post = get_post();

        static $instance = 0;
        $instance++;

        if ( ! empty( $attr['ids'] ) ) {
            // 'ids' is explicitly ordered, unless you specify otherwise.
            if ( empty( $attr['orderby'] ) )
                $attr['orderby'] = 'post__in';
            $attr['include'] = $attr['ids'];
        }

        // Allow plugins/themes to override the default gallery template.
        $output = apply_filters('post_gallery', '', $attr);
        if ( $output != '' )
            return $output;

        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }

        extract(shortcode_atts(array(
            'order'      => 'ASC',
            'orderby'    => 'menu_order ID',
            'id'         => $post ? $post->ID : 0,
            'itemtag'    => 'div',
            'icontag'    => 'div',
            'captiontag' => 'h3',
            'columns'    => 3,
            'size'       => 'medium',
            'include'    => '',
            'exclude'    => ''
        ), $attr, 'gallery'));

        $id = intval($id);
        if ( 'RAND' == $order )
            $orderby = 'none';

        if ( !empty($include) ) {
            $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( !empty($exclude) ) {
            $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        } else {
            $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        }

        if ( empty($attachments) )
            return '';

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment )
                $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
        }

        $itemtag = tag_escape($itemtag);
        $captiontag = tag_escape($captiontag);
        $icontag = tag_escape($icontag);
        $valid_tags = wp_kses_allowed_html( 'post' );
        if ( ! isset( $valid_tags[ $itemtag ] ) )
            $itemtag = 'dl';
        if ( ! isset( $valid_tags[ $captiontag ] ) )
            $captiontag = 'dd';
        if ( ! isset( $valid_tags[ $icontag ] ) )
            $icontag = 'dt';

        $columns = intval($columns);


        switch ($columns) {
            case 1:
                $span ='';
                $size ='full-width';
                break;
            case 2:
                $span ='one_half';
                $size = 'large';
                break;
            case 3:
                $span ='one_third';
                $size='medium';
                break;
            case 4:
                $span ='one_fourth';
                $size='medium';

                break;
            case 5:
                $span ='one_fifth';
                break;                                                         
            
            default:
                $span ='one_fourth';
                $size='portfolio-thumbnail';

                break;
        }
        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
        $float = is_rtl() ? 'right' : 'left';

        $selector = "gallery-{$instance}";

        $gallery_style = $gallery_div = '';
        if ( apply_filters( 'use_default_gallery_style', true ) )
            $gallery_style = "
            <style type='text/css'>
                #{$selector} {
                    margin: auto;
                }
                #{$selector} .gallery-item {
                    float: {$float};
                    margin-top: 10px;
                    text-align: center;
                    margin-bottom: 20px;
                    
                }
                #{$selector} .gallery-item.span12 {
                margin-left: 0;
                    
                }   

                #{$selector} .gallery-item img {
                    width: 100%;
                }            
                #{$selector} .gallery-caption {
                    margin-left: 0;
                    margin-top:10px;
                }
                /* see gallery_shortcode() in wp-includes/media.php */
            </style>";
        $size_class = sanitize_html_class( $size );
        $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
        $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

        $i = 0;
        foreach ( $attachments as $id => $attachment ) {
            if ( ! empty( $attr['link'] ) && 'file' === $attr['link'] ) {
                $image_full_url = wp_get_attachment_image_src($id, 'large');            
                $image_output = '<div class="frame"><a rel="prettyPhoto" href="'.$image_full_url[0].'">';
                $image_output .= wp_get_attachment_image( $id, $size, false );
                $image_output .= '<div class="mask zoom"></div>';
                $image_output .= '</a></div>';            
            }

            elseif ( ! empty( $attr['link'] ) && 'none' === $attr['link'] )
                $image_output = wp_get_attachment_image( $id, $size, false );
            else
                $image_output = wp_get_attachment_link( $id, $size, true, false );

            $image_meta  = wp_get_attachment_metadata( $id );

            $orientation = '';
            if ( isset( $image_meta['height'], $image_meta['width'] ) )
                $orientation = ( $image_meta['height'] > $image_meta['width'] ) ? 'portrait' : 'landscape';
            $last_item ='';
            $clearfix = '';
            if ( $columns > 0 && ++$i % $columns == 0 && $columns !==1 ){
                $last_item .= 'last';
                $clearfix = '<div class="fix"></div>';
            }

            $output .= "<{$itemtag} class='gallery-item $span $last_item'>";
            $output .= "
                <{$icontag} class='gallery-icon {$orientation}'>
                    $image_output
                </{$icontag}>";
            if ( $captiontag && trim($attachment->post_excerpt) ) {
                $output .= "
                    <{$captiontag} class='wp-caption-text gallery-caption'>
                    " . wptexturize($attachment->post_excerpt) . "
                    </{$captiontag}>";
            }
            $output .= "</{$itemtag}>". $clearfix;

        }

        $output .= "
                <br style='clear: both;' />
            </div>\n";

        return $output;
    }
    add_shortcode( 'gallery', 'ht_gallery_shortcode' );

}

?>
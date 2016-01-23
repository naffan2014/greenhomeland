<?php
global $post, $data;


/**
 * Get video bg parameters
 */

$out                = '';

if( ht_has_video_bg() ) {

    $ht_bg_video_mp4    = get_post_meta( $post->ID, '_bg_video_mp4', true );
    $ht_bg_video_webm   = get_post_meta( $post->ID, '_bg_video_webm', true );
    $ht_bg_video_ogv    = get_post_meta( $post->ID, '_bg_video_ogv', true );
    $ht_bg_video_poster = get_post_meta( $post->ID, '_bg_video_poster', true );
    $ht_bg_video_poster =  ht_get_featured_image_url('', $ht_bg_video_poster, 'full' );

    $out .= '<script type="text/javascript">'."\n";
    $out .='jQuery(document).ready(function($) {
                $("body").prepend("<div class=video-background></div>");
                $(".video-background").videobackground({
                    videoSource: [';
                    if( !empty($ht_bg_video_mp4) ) {
                       $out .='["'.$ht_bg_video_mp4.'", "video/mp4"],';
                    }
                    if( !empty($ht_bg_video_webm) ) {
                       $out .='["'.$ht_bg_video_webm.'", "video/webm"],';
                    }
                    if( !empty($ht_bg_video_ogv) ) {
                       $out .='["'.$ht_bg_video_ogv.'", "video/ogg"],';
                    }  
                    $out .= '],';
                    if( ! empty($ht_bg_video_poster['url']) ) {
                        $out .= 'poster: "'.$ht_bg_video_poster['url'].'",';        
                    }
                    $out .= 'loop:true,';                               


                    $out .='
                    loadedCallback: function() {
                        // $(this).videobackground("mute");
                    }
                });
            });
        </script>
    ';
    echo $out;
} else {

    // get slider category set by pages
    $ht_slideshow_category =  get_post_meta($post->ID, '_slideshow_category', true);

    // if archive page of blog
    if( is_archive() ){
        $ht_slideshow_category = $data['category_slideshow_cat'];
    }

    // if archive page of portfolio
    if( is_tax('portfolio-category') ){
        $ht_slideshow_category = $data['portfolio_slideshow_cat'];
    }

    // if archive page of woocommerece productgs
    if ( is_post_type_archive( 'product' ) || is_tax('product_cat') ) {
        $post                  = get_post( woocommerce_get_page_id( 'shop' ) );
        $ht_slideshow_category = get_post_meta($post->ID, '_slideshow_category', true);

    }

    // if randomize selected
    if ($data['slideshow_ranomize'] =='1'){
        $orderby = 'rand';
    } else {
        $orderby = 'date';
    }

    // building the query
    if( ! isset( $ht_slideshow_category ) || $ht_slideshow_category == '' ) {
        $slideshow_args=array(
            'post_type'      => 'slideshow',
            'post_status'    => 'publish',
            'orderby'        => $orderby,
            'posts_per_page' => -1
        );

    } else {
        $slideshow_args = array(
            'posts_per_page'        => -1,
            'post_type'             => 'slideshow',
            'orderby'               => $orderby,
            'post_status' => 'publish',
            'tax_query' => array(
                array(  'taxonomy'  => 'slideshow-category',
                    'field'     => 'slug',
                    'terms'     => $ht_slideshow_category
                )
            )
        );
    }

    $my_query = null;
    $my_query = new WP_Query($slideshow_args);
    if( $my_query->have_posts() ):
        $j=0;
        $slides = '';
        while( $my_query->have_posts() ): $my_query->the_post();
            $image_url = ht_get_featured_image_url($post->ID, '', 'full');
            $image_url = $image_url['url'];

            if( trim( get_the_content() ) != '' ){
                $excerpt     = addslashes( do_shortcode( get_the_content() ) );
                $excerpt     = nl2br($excerpt);
                $excerpt     =  str_replace(array("\r\n", "\r", "\n"), '\n', $excerpt);
                $description = '<div class="slideshow-caption-wrap clearfix">' . $excerpt . '</div>';
            } else {
                $description = '';
            }

            $disable_slider_caption         =   get_post_meta($post->ID, '_slider_disable_caption', true);
            $disable_slider_caption_title   =   get_post_meta($post->ID, '_slider_disable_caption_title', true);

            if($disable_slider_caption) {
                $slides .= "{image : '" . $image_url . "',  thumb : '".$image_url."', url : ''} ,\n\t";

            } else {
                if($disable_slider_caption_title){
                    $slides .= "{image : '" . $image_url . "', title : '<div class=\"slider-caption\">".$description."</div>',  thumb : '".$image_url."', url : ''} ,\n\t";
                }else {
                    $slides .= "{image : '" . $image_url . "', title : '<div class=\"slider-caption\"><h2>". the_title("", "", false) ."</h2>".$description."</div>',  thumb : '".$image_url."', url : ''} ,\n\t";

                }

            }
            $j++;
        endwhile;
    endif;
    $slides = trim($slides);
    $data['NUMBEROFSLIDES'] = $j;
    wp_reset_query();


    $out  = '';
        $out .= '<script type="text/javascript">'."\n";
        $out .= 'jQuery(document).ready(function($){'."\n";
        $out .= '
                jQuery.supersized({

                    // Functionality
                    slide_interval          :   ' . $data['slideshow_timeout'] * 1000 .',       
                    transition              :   ' . $data['slideshow_transition_effect'].', 
                    transition_speed        :   1000,
                    keyboard_nav            :   1,

                    // Speed of transition

                    // Components
                    slide_links             :   \'blank\',
                    slides                  :   [           
                    ' . substr($slides,0, strlen($slides)-1) .'
                    ]

                });
        ';
    $out .= '});'."\n";
    $out .= "\n".'</script>'."\n\n\n";        

    echo $out;
}
?>
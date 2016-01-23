<?php 
global $data, $is_iphone; 

// reset the query
wp_reset_query();

// if footer is enabled
if( empty( $data['footer_disable'] ) ) { 
?>
<i class="scrollup arrow-toggle"></i>
<?php
// if slideshow enabled
if( ht_slideshow_status() == '1' ) {

    // show progress bar if we have more than 1 slides available
    if( isset($data['NUMBEROFSLIDES']) && $data['NUMBEROFSLIDES']  > 1  && $data['slideshow_progress_status'] == '1' ) {
?>
    <div id="progress-back" class="load-item">
        <div id="progress-bar"></div>
    </div><!-- [/Time Bar] -->
<?php
    }

    // if is front page
    if( is_front_page() ) {
        if( isset($data['NUMBEROFSLIDES']) && $data['NUMBEROFSLIDES']  > 1  ) { ?>
        <div id="thumb-tray" class="load-item">
            <div id="thumb-back"></div>
            <div id="thumb-forward"></div>
        </div>
        <?php }?>
        <!--Slide captions displayed here-->
        <?php
        if(  isset($data['NUMBEROFSLIDES']) && $data['NUMBEROFSLIDES']  >= 1 ) {
            if( $data['slideshow_caption'] ) { ?>
            <div id="slidecaption"></div>
        <?php
            }
        }
    } // end check for front page

} // end check if slideshow is enabled

 ?>
<div id="controls-wrap" class="load-item">
    <?php if( isset($data['NUMBEROFSLIDES']) && $data['NUMBEROFSLIDES']  > 1  && ht_slideshow_status() == '1' && $data['slideshow_button_status'] == '1' ){?>
        <a id="nextslide" class="load-item"><i class="fa fa-forward"></i></a>
        <a id="play-button"><i class="fa fa-pause"></i></a>
        <a id="prevslide" class="load-item"><i class="fa fa-backward"></i></a>
    <?php }?>
    <div id="audio-wrap">
        <?php if( $data['music_status'] != '1' && $data['music_url'] != '' && $data['music_status'] == '3' && is_front_page() ) { ?>
        <audio preload="auto" <?php if( $data['music_loop'] ){ echo 'loop="loop"'; } ?> src="<?php echo $data['music_url'];?>"></audio>
        <?php }?>
        <?php if( $data['music_status'] != '1' && $data['music_url'] != '' && $data['music_status'] == '2'  ) {?>
        <audio preload="auto" <?php if( $data['music_loop'] ){ echo 'loop="loop"'; } ?> src="<?php echo $data['music_url'];?>"></audio>
        <?php }?>
    </div>      
    <p <?php if( empty( $data['slideshow_thumbs'] )  && is_front_page() ) {echo 'style="padding-left: 45px;"';} ?> class="copyright"><?php echo stripslashes( do_shortcode( $data['footer_text'] ) ); ?></p>
    <?php if( $data['slideshow_thumbs'] ) { ?>
    <?php if( is_front_page() ) { ?>
            <?php if(  isset($data['NUMBEROFSLIDES']) && $data['NUMBEROFSLIDES']  > 1 && ht_slideshow_status() =='1' ){?>
                <a id="tray-button"><i class="fa fa-th-large"></i></a>
    <?php } } } ?>
    <a href="#" id="shutdown"><i class="fa fa-eye"></i></a>    
</div><!-- [/Control Bar] -->

<?php } // end footer enable check ?>
<?php echo stripslashes( $data['google_analytics'] ); ?>
<?php wp_footer(); ?>
</body>
</html>
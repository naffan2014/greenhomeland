<?php
/*
Template Name: Homepage Default
*/
get_header();
global $data;
embed_fullscreen_bg();
wp_reset_postdata();
if ( ht_has_video_bg() && get_the_content() != '' ){ 
?>
<div id="slidecaption">
	<div class="slider-caption"><?php echo the_content();?></div>
</div>
<?php
}
get_footer();
?>
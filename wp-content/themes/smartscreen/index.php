<?php
get_header();

// variables
global $data;

// title of the page goes here
$teaser              = __('Recent Posts', 'highthemes');

// sidebar status
$ht_sidebar_status = ht_sidebar_layout();

// embed slider
embed_fullscreen_bg();

?>
<div id="wrap" class="clearfix <?php echo ht_sidebar_layout(); ?>">
    <div id="main">
        <div id="entries">
            <h2 class="page-title"><?php echo $teaser;?>
                <i class="entries-toggle arrow-toggle"></i>
                <?php if( $data['breadcrumb_inner'] ) { ?>
                    <div id="breadcrumb">
                        <?php if (class_exists('simple_breadcrumb')) { $bc = new simple_breadcrumb; } ?>
                    </div>
                    <?php } ?>
            </h2>
            <div id="entries-box">
            <?php
            if (have_posts()) :
                while (have_posts() ) :the_post();
                    get_template_part( 'content', get_post_format() );
                endwhile;
            ?>
            <?php  else:  ?>
                <div class="post-item ">
                    <div class="info-box-wrapper">
                        <div class="info-box-orange-header info-box-warning">
                            <div class="info-content-box-icon"><?php _e("There's no post here yet!",'highthemes'); ?></div>
                        </div>
                    </div>
                </div>
            <?php  endif;  ?>
               <div class="navi">
                <?php 
                if( ! empty ( $data['pagenavi_status'] ) ) {
                    wp_pagenavi();
                } else {
                ?>
                <div class="prev fl"><?php previous_posts_link('&larr; ' . __('Previous','highthemes'),''); ?></div>
                <div class="next fr"><?php next_posts_link( __('Next','highthemes') . ' &rarr;' , '' ); ?> </div>    
                <?php } ?>
                </div>
            </div><!-- [/entries-box] -->
        </div><!-- [/entries] -->
    </div><!-- [/main] -->
    <?php if( $ht_sidebar_status != 'no-sidebar') get_sidebar(); ?>
</div><!-- [/wrap] -->
<?php get_footer();?>
<?php
get_header();

global $data;
$teaser = __("Error 404! Page Not Found.", "highthemes");
?>
<?php embed_fullscreen_bg();?>
<div id="wrap" class="clearfix <?php echo ht_sidebar_layout(1); ?>">
    <div id="main">
        <div id="entries">
            <h2 class="page-title"><?php echo $teaser;?>
                <i class="entries-toggle arrow-toggle"></i>
                <?php if($data['breadcrumb_inner']){ ?>
                    <div id="breadcrumb">
                        <?php if (class_exists('simple_breadcrumb')) { $bc = new simple_breadcrumb; } ?>
                    </div>
                    <?php } ?>
            </h2>
            <div id="entries-box">
            <div  id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                <div class="entry">
                    <div class="fix"></div>
                    <?php if( trim($data['custom_404'])!='' ) {?><p><?php echo stripslashes($data['custom_404']); ?></p><?php } ?>
                    <div class="divider top"><a href="#"><?php _e('Top','highthemes'); ?></a></div>
                    <?php get_template_part("includes/sitemap_content"); ?>
                </div>
            </div>
     </div><!-- [/entries-box] -->
    </div><!-- [/entries] -->
    </div><!-- [/main] -->
    <?php if( ht_sidebar_layout(1) != 'no-sidebar') get_sidebar(); ?>
</div><!-- [/wrap] -->
<?php get_footer();?>
<?php
/*
Template Name: Sitemap
*/
get_header();
global $data;

$override_title =       get_post_meta( get_the_ID(), '_override_title', true );
$teaser         = ! empty( $override_title ) ? $override_title : get_the_title();
?>
<?php embed_fullscreen_bg();?>
<div id="wrap" class="no-sidebar clearfix">
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
        <?php if (have_posts()) : ?>
        <div id="entries-box">
            <?php while ( have_posts() ) : the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                    <div class="entry">
                        <?php the_content();?>
                        <div class="fix"></div>
                       <?php get_template_part("includes/sitemap_content"); ?>
                    </div>
                </div><!-- [/post-item] -->

                <?php endwhile;?>
        </div><!-- [/entries-box] -->
        </div><!-- [/entries] -->

        <?php endif; ?>
    </div><!-- [/main] -->
</div><!-- [/wrap] -->
<?php get_footer();?>
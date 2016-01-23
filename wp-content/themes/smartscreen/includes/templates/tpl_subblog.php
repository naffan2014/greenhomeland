<?php
get_header();

// variables
global $data;

// title of the page goes here
$override_title      = get_post_meta( get_the_ID(), '_override_title', true );
$teaser              = ! empty( $override_title ) ? $override_title : get_the_title();
$ht_subblog_category = get_post_meta( get_the_ID(), '_subblog_category', true );
$ht_item_number      = get_post_meta( get_the_ID(), '_item_number', true );

// sidebar status
$ht_sidebar_status = ht_sidebar_layout();

if( ! is_numeric( $ht_item_number ) || ! isset( $ht_item_number ) ) {
    $ht_item_number = 9;
}

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
            // exclude categories
            $blog_query_args = array( 'category__in'      => $ht_subblog_category, 'posts_per_page' => $ht_item_number );

            // Get current page and append to custom query parameters array
            $blog_query_args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

            // Instantiate custom query
            $blog_query = new WP_Query( $blog_query_args );

            // Pagination fix
            $temp_query = $wp_query;
            $wp_query   = NULL;
            $wp_query   = $blog_query;

                if ( $blog_query->have_posts()) :
                    global $more;
                    $more = 0;

                    while ( $blog_query->have_posts() ) : $blog_query->the_post();
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
            <?php 
            endif;
            wp_reset_postdata();

             ?>
               <div class="navi">
                <?php 
                if( ! empty ( $data['pagenavi_status'] ) ) {
                    wp_pagenavi();
                } else {
                ?>
                <div class="prev fl"><?php previous_posts_link('&larr; ' . __('Previous','highthemes'),''); ?></div>
                <div class="next fr"><?php next_posts_link( __('Next','highthemes') . ' &rarr;' , $blog_query->max_num_pages ); ?> </div>    
                <?php } ?>
            </div>

            <?php
            $wp_query = NULL;
            $wp_query = $temp_query;

            ?>
            </div><!-- [/entries-box] -->
        </div><!-- [/entries] -->
    </div><!-- [/main] -->
    <?php if( $ht_sidebar_status != 'no-sidebar') get_sidebar(); ?>
</div><!-- [/wrap] -->
<?php get_footer();?>
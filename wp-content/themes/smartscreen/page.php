<?php
// getting the page type
$ht_page_type = get_post_meta( get_the_ID(), '_page_type', true );

get_header();

// load variables
global $data;

$override_title      = get_post_meta( get_the_ID(), '_override_title', true);
$teaser              = ! empty( $override_title ) ? $override_title : get_the_title();

if( $ht_page_type == 'subblog' ) {
    get_template_part('includes/templates/tpl_subblog');  
    exit;

} elseif ( $ht_page_type == 'portfolio' ) {
    get_template_part( 'includes/templates/tpl_portfolio' );
    exit;

} elseif ( $ht_page_type == 'portfolio-filterable' ) {
    get_template_part( 'includes/templates/tpl_filtered_portfolio' );
    exit;

} else {

// include slideshow
embed_fullscreen_bg();
?>
<div id="wrap" class="clearfix <?php echo ht_sidebar_layout(); ?>">
    <div id="main">
        <?php 
            if( is_woocommerce_activated() ) {

                if( is_cart() || is_checkout() || is_account_page() ){
                    $woobar = ht_get_woobar();

                }
                if( isset( $woobar ) ) echo $woobar;
            }
        ?>
        <?php if (have_posts()) : ?>
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
            <?php
            while (have_posts()) :the_post();
            ?>
            <div  id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                <div class="entry">
                    <?php the_content();?>
                    <div class="fix"></div>
                    <?php wp_link_pages();?>
                </div>
            </div>
            <?php endwhile;?>
        <?php else: ?>
        <div class="post-item ">
            <div class="info-box-wrapper">
                <div class="info-box-orange-header info-box-warning">
                    <div class="info-content-box-icon"><?php _e("There's no post here yet!",'highthemes'); ?></div>
                </div>
            </div>
        </div>
        <?php endif; ?>
        <?php if( $data['pages_comment'] ) {
            comments_template( '', true );
        }
        ?>
        </div><!-- [/entries-box] -->
    </div><!-- [/entries] -->
    </div><!-- [/main] -->
    <?php if( ht_sidebar_layout() != 'no-sidebar') get_sidebar(); ?>
</div><!-- [/wrap] -->
<?php get_footer(); }?>
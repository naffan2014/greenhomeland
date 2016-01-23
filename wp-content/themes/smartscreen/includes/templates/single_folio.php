<?php
global $data;

// title of the page goes here
$override_title        = get_post_meta( get_the_ID(), '_override_title', true);
$teaser                = ! empty( $override_title ) ? $override_title : get_the_title();
$ht_slideshow_category = get_post_meta( get_the_ID(), '_slideshow_category', true);

// embed slideshow
embed_fullscreen_bg();
?>
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
        <div id="entries-box">
              <div id="folio-nav">
                    <span class="fl folio-prev"> <?php previous_post_link('%link', __('&larr; Previous', 'highthemes')); ?></span>
                    <span class="fr folio-next">  <?php next_post_link('%link', __('Next &rarr;', 'highthemes')); ?></span>
                </div>
        <?php 
        if ( have_posts()) : the_post(); 

            $video_link    =    get_post_meta( get_the_ID(), '_video_link', true );
            $extra_info    =    get_post_meta( get_the_ID(), '_extra_info', true );

            // featured image
            $thumb         =    wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); 
            $image_url     =    wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
            $image_url     =    $image_url[0];

            // slider images
            $slider_images =    get_post_meta( get_the_ID(), '_slider_image', true );

            $post_images   =    array();

            if( is_array($slider_images) ) {
                foreach ( $slider_images as $slider_image ) {
                    $post_images[]       = wp_get_attachment_image_src( $slider_image , 'full');
                    $post_large_images[] = wp_get_attachment_image_src( $slider_image , 'full');
                    $the_alts[]          =    get_post_meta($slider_image, '_wp_attachment_image_alt', true);
                }
            } 
            // get the terms   
            $terms = get_the_terms( get_the_ID(), 'portfolio-category' );

            // set status of video/image
            if( ! empty( $video_link ) ) {
                $video_status = 'video';
                $image_url = $video_link;
            } else {
                $video_status = 'zoom';
            }
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class('post-item clearfix'); ?>>

            <?php if ( ! post_password_required() ) { ?>

            <?php if( count( $post_images ) > 0 ) { ?>

            <div id="folio-single-slideshow" class="flexslider">
                <ul class="slides">
                <li>
                    <div class="post-image frame">
                        <a href="<?php echo $image_url;?>" title="<?php the_title_attribute();?>" rel="prettyPhoto[gallery]">
                            <img src="<?php echo $thumb[0];?>" alt="<?php the_title_attribute();?>" />
                            <i class="fa <?php echo $video_status;?>"></i>
                        </a>
                    </div>
                </li>
                    <?php 
                    for( $z=0; $z < count( $post_images ); $z++ ) {

                        if( $z == 0 && ! empty( $video_link ) ) {
                            $post_large_images[$z] = $video_link; 
                            $video_status='video';
                        } else {
                            $video_status = 'zoom';
                        }
                    ?>
                    <li>
                        <div class="post-image frame">
                            <a href="<?php echo $post_large_images[$z][0];?>" title="<?php echo $the_alts[$z]?>" rel="prettyPhoto[gallery]">
                                <img src="<?php echo $post_images[$z][0];?>" alt="<?php echo $the_alts[$z]?>" />
                                <i class="fa <?php echo $video_status;?>"></i>
                            </a>
                        </div>

                    </li>
                    <?php } // foreach?>
                </ul>
            </div>
            <?php } else if ( has_post_thumbnail() ) { ?>
                <div class="post-image frame">
                    <a href="<?php echo $image_url;?>" title="<?php the_title();?>" rel="prettyPhoto[gallery]">
                    <img src="<?php echo esc_attr($thumb[0]);?>" alt="<?php the_title_attribute();?>" >
                        <i class="fa <?php echo $video_status;?>"></i>
                    </a>
                </div>
            <?php }  // has post thumbnail?>

            <?php } //password protected ?>
            <?php 
            if( empty( $data['disable_portfolio_details'] ) ) {
                $grid_class = 'two_third';
                $sidebar_class = '';

            } else {
                $grid_class = '';
                $sidebar_class = 'hidden';
            }
            ?>
            <div class="portfolio-desc entry <?php echo $grid_class;?>">
                 <?php the_content();?>
            </div>
            <ul class="meta one_third last <?php echo $sidebar_class;?>">
                <li class="post-date"><span><?php _e('Date:', 'highthemes');?> </span><?php the_time( get_option('date_format') );?></li>
                <li class="post-cats">
                    <span><?php _e('Tags:', 'highthemes');?> </span>
                    <?php
                    $z = 1;
                    foreach($terms as $term=>$value){
                        $term_link =  get_term_link( $value->slug, 'portfolio-category' );
                        $term_name =  $value->name;
                        echo '<a href="'.$term_link.'" >'.$term_name.'</a>';
                        if( count($terms)!=$z ){
                            echo  ", ";
                        }
                        $z++;
                    }
                    ?>
                </li>
                <?php
                $extra_info = explode(PHP_EOL,$extra_info);
                foreach($extra_info as $info) {
                    echo '<li class="portfolio-extra-info">'. $info .'</li>';
                }
                ?>
                <?php if($data['disable_socials_folio'] != '1') { ?>
                <li class="social-share social-twitter">
                    <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
                    <a href="http://twitter.com/share" class="twitter-share-button"
                       data-url="<?php the_permalink(); ?>"
                       data-via="<?php echo $data['twitter_id'] ?>"
                       data-text="<?php the_title(); ?>"
                       data-count="horizontal"><?php _e("Tweet", "highthemes");?></a>
                </li>
                <li class="social-share social-facebook">
                    <div id="fb-root"></div>
                    <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like href="<?php echo get_permalink(); ?>" show_faces="false" layout="button_count" width="450"></fb:like>
                </li>
                <li class="social-share social-gplus">
                    <g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone>

                </li>
            <?php }?>
            </ul>

        </div>
        <?php endif;?>

        <?php
        if($data['disable_related_folio'] !="1"){
            get_template_part( 'includes/related_posts' );
        }
        ?>
        <?php comments_template( '', true ); ?>
    </div><!-- [/entries-box] -->
    </div><!-- [/entries] -->
    </div><!-- [/main] -->
</div><!-- [/wrap] -->
<?php get_footer();?>
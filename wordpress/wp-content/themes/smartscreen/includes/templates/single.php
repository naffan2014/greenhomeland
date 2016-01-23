<?php
global $data;

$category = get_the_category();

if( isset( $category[0]->cat_name ) ) $teaser = $category[0]->cat_name;

$ht_sidebar_status     = ht_sidebar_layout();
$ht_slideshow_category = get_post_meta( get_the_ID(), '_slideshow_category', true);

// embed slider
embed_fullscreen_bg();
?>
<div id="wrap" class="<?php echo ht_sidebar_layout(); ?> clearfix">
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
            <?php
            if (have_posts()) :

                while ( have_posts() ) : the_post();

                    $post_format = get_post_format();

                    if( 'link' == $post_format ) {
                        include(locate_template('content-'. get_post_format() .'.php'));
                    } else if( 'quote' == $post_format ) {
                        include(locate_template('content-'. get_post_format() .'.php'));
                    } else if( 'video' == $post_format ) {
                        include(locate_template('content-'. get_post_format() .'.php'));
                    } else if( 'audio' == $post_format ) {
                        include(locate_template('content-'. get_post_format() .'.php'));                        
                    } else {

                    $video_link             =       get_post_meta($post->ID, '_video_link', true);
                    $disable_post_image	    =       get_post_meta($post->ID, '_disable_post_image', true);

                        if( has_post_thumbnail() ) {
                            
                            $image_url     =  ht_get_featured_image_url($post->ID, '', 'full');
                            $thumb_details =  ht_get_featured_image_url(get_the_ID(), '', 'ht-blog' );
                            $thumb_url     =  $thumb_details['url'];

                            if($ht_sidebar_status =='no-sidebar') {
                                
                                $thumb_details =  ht_get_featured_image_url(get_the_ID(), '', 'full' );
                                $thumb_url     =  $thumb_details['url'];                                

                            }                    
                        }


                        if($disable_post_image =='' && $data['disable_post_image'] =='1')  {
                            $disable_post_image = 'false';
                        }

                        if( trim($video_link) <> '' ) {
                            $video_status = 'video';
                            $image_url['url'] = $video_link;
                        } else {
                            $video_status = 'zoom';
                        }
                ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                    <?php if(has_post_thumbnail() && $disable_post_image !='false'){?>
                    <div class="post-image frame">
                        <a href="<?php echo $image_url['url'];?>" title="<?php the_title();?>" rel="prettyPhoto">
                            <img  src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
                            <i class="fa <?php echo $video_status;?>"></i>
                        </a>
                    </div>
                    <?php }?>

                    <div class="post-meta">
                        <span class="post-date"><?php the_time(get_option('date_format'));?></span> <?php if(comments_open()){ echo ' / '; comments_popup_link(__('No Comment','highthemes'), __('1 Comment','highthemes'), "% ".__('Comments','highthemes'));} ?>
                    </div>
                    <h3 class="post-title"><a title="<?php the_title_attribute();?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <div class="entry">
                        <?php
                        if(is_single()){
                            the_content();
                            wp_link_pages( );
                            the_tags( '<div class="entry-tags">'.__('Tags: ', 'highthemes').'<span class="tag-links">', ', ', '</span></div>' );          
                        } else { ?>
                            <p>
                                <?php echo ht_excerpt(300, '...'); ?>
                            </p>
                            <?php } ?>
                    </div>
                    <?php include( locate_template('/includes/blog_socials.php') );?>
                </div><!-- [/post-item] -->
                <?php }?>
                    <?php endwhile;?>
        <?php  else: ?>
            <div class="post-item ">
                <div class="info-box-wrapper">
                    <div class="info-box-orange-header info-box-warning">
                        <div class="info-content-box-icon"><?php _e("There's no post here yet!",'highthemes'); ?></div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php comments_template( '', true ); ?>
        </div><!-- [/entries-box] -->
    </div><!-- [/entries] -->
    </div><!-- [/main] -->
    <?php if( $ht_sidebar_status != 'no-sidebar') get_sidebar(); ?>
</div><!-- [/wrap] -->
<?php get_footer();?>
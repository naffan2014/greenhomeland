<?php
global $data;
$video_link            =   get_post_meta( get_the_ID() , '_video_link', true );
$disable_post_image    =   get_post_meta( get_the_ID() , '_disable_post_image', true );

if( empty( $disable_post_image ) && $data['disable_post_image'] =='1' ){
    $disable_post_image = 'false';
}

if( has_post_thumbnail() && $data['disable_post_image'] != '1' ){
    $image_url = ht_get_featured_image_url( get_the_ID(), '', 'full' );

    // width: 560
    // height: 250
    
    
    $thumb_details =  ht_get_featured_image_url(get_the_ID(), '', 'large' );
    $thumb_url     =  $thumb_details['url'];

    if( ! empty( $video_link ) ) {
        $video_status     = 'video';
        $image_url['url'] = $video_link;
    } else {
        $video_status     = 'zoom';
    }

    $lightbox_status = '';

    if( $data['blog_lightbox'] ) {
        $lightbox_status = 'href="'. get_permalink() .'"';
    } else {
        $lightbox_status = 'rel="prettyPhoto" href="' . $image_url['url'] .'"';
    }
}

/**
 *  search content
 */
if( get_post_type() == 'page' ) { ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('post-item page-item'); ?>>

    <h3 class="post-title"><a title="<?php the_title_attribute();?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
    <div class="entry">
        <?php
         if( $data['disable_excerpt'] != '1'  || is_search()) { ?>
            <p>
                <?php echo ht_excerpt(150, '...'); ?>
            </p>
        <?php 
         } else { 
            the_content( __(" Continue Reading". ' &rarr;', "highthemes") ); 
         } 
        ?>
        <?php if( $data['disable_excerpt'] != '1'){?> <a class="read-more" href="<?php the_permalink(); ?>"><?php _e("Continue Reading &rarr;","highthemes");?></a><?php }?>
    </div>
</div><!-- [/post-item] -->

<?php } elseif( get_post_type() == 'portfolio' || get_post_type() == 'product' ) { ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('post-item page-item'); ?>>
    <?php if( has_post_thumbnail() ){?>
    <div class="post-image frame">
        <a title="<?php the_title();?>" <?php echo $lightbox_status;?>>
            <img  src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
            <span class="<?php echo $video_status;?>"></span>
        </a>
    </div>
    <?php }?>
    <h3 class="post-title"><a title="<?php the_title_attribute();?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
    <div class="entry">
        <?php
         if( $data['disable_excerpt'] != '1'  || is_search()) { ?>
            <p>
                <?php echo ht_excerpt(150, '...'); ?>
            </p>
        <?php 
         } else { 
            the_content( __(" Continue Reading". ' &rarr;', "highthemes") ); 
         } 
        ?>
        <?php if( $data['disable_excerpt'] != '1'){?> <a class="read-more" href="<?php the_permalink(); ?>"><?php _e("Continue Reading &rarr;","highthemes");?></a><?php }?>
    </div>
</div><!-- [/post-item] -->

<?php } else { ?>

<div id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
    <?php if(has_post_thumbnail() && $data['disable_post_image'] !='1'){?>
    <div class="post-image frame">
        <a title="<?php the_title();?>" <?php echo $lightbox_status;?>>
            <img  src="<?php echo $thumb_url;?>" alt="<?php the_title_attribute();?>" />
            <span class="<?php echo $video_status;?>"></span>
        </a>
    </div>
    <?php }?>
    <div class="post-meta">
        <span class="post-date"><?php the_time(get_option('date_format'));?></span> / <?php comments_popup_link(__('Leave a Comment','highthemes'), __('1 Comment','highthemes'), "% ".__('Comments','highthemes')); ?>
    </div>
    <h3 class="post-title"><a title="<?php the_title_attribute();?>" href="<?php the_permalink();?>"><?php the_title();?></a></h3>
    <div class="entry">
        <?php
         if( $data['disable_excerpt'] != '1'  || is_search()) { ?>
            <p>
                <?php echo ht_excerpt(150, '...'); ?>
            </p>
        <?php 
         } else { 
            the_content( __(" Continue Reading". ' &rarr;', "highthemes") ); 
         } 
        ?>
        <?php if( $data['disable_excerpt'] != '1'){?> <a class="read-more" href="<?php the_permalink(); ?>"><?php _e("Continue Reading &rarr;","highthemes");?></a><?php }?>
    </div>
</div><!-- [/post-item] -->
<?php }?>
<?php
global $data;
$ex_link   = get_post_meta( get_the_ID(), '_link_post_format', true );
$permalink = ( !empty($ex_link) ) ? $ex_link :  get_permalink();
?>
<div id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
    <div class="post-meta">
        <span class="post-date"><?php the_time(get_option('date_format'));?></span> / <?php comments_popup_link(__('Leave a Comment','highthemes'), __('1 Comment','highthemes'), "% ".__('Comments','highthemes')); ?>
    </div>
    <h3 class="post-title">
    <a title="<?php the_title_attribute();?>" href="<?php echo $permalink;?>"><?php the_title();?> <span>/ <?php echo get_post_format();?></span></a>
    </h3>
    <div class="entry">
        <?php 
        the_content( __(" Continue Reading". ' &rarr;', "highthemes") ); 
        wp_link_pages( );
        the_tags( '<div class="entry-tags">'.__('Tags: ', 'highthemes').'<span class="tag-links">', ', ', '</span></div>' );
        ?>
    </div>
    <?php include( locate_template('/includes/blog_socials.php') );?>

</div><!-- [/post-item] -->

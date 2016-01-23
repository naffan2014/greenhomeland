<h2><?php _e('Pages','highthemes'); ?></h2>
<ul class="arrowlist"><?php wp_list_pages('title_li=' ); ?></ul>
<div class="divider top"><a href="#wrap"><?php _e('Top','highthemes'); ?></a></div>

<h2><?php _e('Feeds','highthemes'); ?></h2>
<ul class="arrowlist">
    <li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e('Main RSS','highthemes'); ?></a></li>
    <li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comment Feed','highthemes'); ?></a></li>
</ul>
<div class="divider top"><a href="#wrap"><?php _e('Top','highthemes'); ?></a></div>

<h2><?php _e('Categories','highthemes'); ?></h2>
<ul class="arrowlist"><?php wp_list_categories('title_li=&orderby=name&show_count=1&hierarchical=0&feed=RSS'); ?></ul>
<div class="divider top"><a href="#wrap"><?php _e('Top','highthemes'); ?></a></div>

<h2><?php _e('Portfolio/Gallery','highthemes'); ?></h2>
<?php
$orderby = 'name';
$show_count = 0; 
$pad_counts = 0; 
$hierarchical = 1;
$taxonomy = 'portfolio-category';
$title = '';

$args = array(
  'orderby' => $orderby,
  'show_count' => $show_count,
  'pad_counts' => $pad_counts,
  'hierarchical' => $hierarchical,
  'taxonomy' => $taxonomy,
  'title_li' => $title
);
?>
<ul class="arrowlist">
    <?php wp_list_categories($args); ?>
</ul>

<div class="divider top"><a href="#wrap"><?php _e('Top','highthemes'); ?></a></div>

<h2><?php _e('Archives','highthemes'); ?></h2>
<ul class="arrowlist">
    <?php wp_get_archives('type=monthly&show_post_count=true'); ?>
</ul>

<div class="divider top"><a href="#wrap"><?php _e('Top','highthemes'); ?></a></div>
<?php 
global $data;
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="format-detection" content="telephone=no">
    <?php
    if($data['responsive_layout'] == 'responsive') {?>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri();?>/scripts/css3-mediaqueries.js"></script>
    <![endif]-->
    <?php }?>

    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php if($data['custom_favicon']) { echo ht_favicon($data['custom_favicon']);} ?>

    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
if( is_front_page() ) {
    $social_class = "social-in-homepage";
} else {
    $social_class = "social-in-page";
}
if($data['sb_inner']){ ?>
<div class="<?php echo $social_class;?> social-bookmarks">
<?php ht_social_icons_list(); ?>
</div><!-- [/social-bookmarks] -->
<div class="social-in-page social-bookmarks res-social-bookmarks">
<?php ht_social_icons_list(); ?>
</div><!-- [/Responsive social-bookmarks] -->
<?php } ?>
<div id="wrap-wide"></div><!-- [/wrap-wide] -->
<div id="menu-wrap">
    <?php do_action('icl_language_selector'); ?>
    <div id="menu">
        <a id="logo" title="<?php bloginfo("description");?>" href="<?php echo home_url();?>">
            <?php if ($data['logo_url']) { ?>
            <img src="<?php echo $data['logo_url'];?>" alt="<?php bloginfo('description'); ?>"/>
            <?php } else { ?>
            <img src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="Logo"/>
            <?php }?>
        </a><!-- [/logo] -->
        <?php
        $params = array('container_class' => 'jqueryslidemenu', 'theme_location' => 'nav', 'container_id' => 'nav','walker' => new description_walker());
        wp_nav_menu($params);
        $params = array('container_id' => 'mobile-nav', 'menu_id' => 'mobile-menu', 'theme_location' => 'nav');
        wp_nav_menu($params);
        ?>
        <i class="menu-toggle arrow-toggle"></i>
    </div>
</div><!-- [/menu] -->
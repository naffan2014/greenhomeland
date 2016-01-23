<?php
/*
Template Name: Contact Page 2
*/
session_start();
include( HT_INCLUDES_PATH . "captcha/captcha.php" );

get_header();

global $data;

$_SESSION['captcha'] =   captcha();
$_SESSION['seccode'] =   $_SESSION['captcha']['code'];
$override_title      =   get_post_meta($post->ID, '_override_title', true);
$teaser              =   ! empty( $override_title ) ? $override_title : get_the_title();

embed_fullscreen_bg();
?>
<div id="wrap" class="clearfix <?php echo ht_sidebar_layout(); ?>">
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
            <?php  while ( have_posts() ) : the_post();  ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                    <div class="entry">
                        <div id="contact-box">
                        <?php the_content();?>
                        </div>
                        <div class="contact-form-wrapper">
                            <h3 class="special-heading">
                            <?php if($data['contact_form_title']) echo stripslashes($data['contact_form_title']); else  _e("Send us a message", "highthemes");?></h3>
                            <div class="log"></div>
                            <form action="<?php the_permalink();?>" method="post" id="contactform">
                                <div class="form-details ">
                                    <p>
                                        <input type="text" name="fullname" id="fullname" tabindex="1" class="txt required" value="<?php if(isset($_POST['fullname'])) echo $_POST['fullname']; else _e('Full Name:', 'highthemes'); ?>" onfocus="if(this.value == '<?php _e('Full Name:','highthemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Full Name:','highthemes'); ?>';}">
                                    </p>
                                    <p>
                                        <input type="text" name="email" id="email" tabindex="2" value="<?php if(isset($_POST['email'])) echo $_POST['email']; else _e('Email:', 'highthemes'); ?>" class="txt required" onfocus="if(this.value == '<?php _e('Email:','highthemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Email:','highthemes'); ?>';}">
                                    </p>
                                    <p>
                                        <input type="text" name="url" id="url" tabindex="3" value="<?php if(isset($_POST['url'])) echo $_POST['url']; else _e('Website URL:', 'highthemes'); ?>" class="txt" onfocus="if(this.value == '<?php _e('Website URL:','highthemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Website URL:','highthemes'); ?>';}">
                                    </p>
                                    <?php if($data['disable_captcha'] !="1"){?>
                                    <p>
                                        <?php echo '<img src="' . $_SESSION['captcha']['image_src'] . '" alt="CAPTCHA" />'; ?>
                                        <input type="text" class="txt required" value="<?php if(isset($_POST['captcha'])) echo $_POST['captcha']; else _e('Security Code:', 'highthemes'); ?>" tabindex="4" id="captcha" name="captcha" onfocus="if(this.value == '<?php _e('Security Code:','highthemes'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Security Code:','highthemes'); ?>';}">
                                    </p>
                                    <?php } ?>
                                    <p>
                                        <textarea rows="10" cols="10" id="form_message" class="required" name="form_message" tabindex="5"><?php if(isset($_POST['form_message'])) echo $_POST['form_message'];  ?></textarea>
                                    </p>
                                    <p>
                                        <input type="hidden" value="<?php _e('send', 'highthemes');?>" name="sendContact" id="sendContact">
                                        <input type="submit" id="submit" class="submit-button" name="submit" value="<?php _e('Send', 'highthemes');?>">
                                        <input type="reset" class="submit-button" name="reset" value="<?php _e('Reset', 'highthemes');?>">
                                    </p>
                                </div>
                            </form>
                        </div>
                </div>
            </div><!-- [/post-item] -->

                <?php endwhile;?>
        </div><!-- [/entries-box] -->
        </div><!-- [/entries] -->
        <?php endif; ?>
    </div><!-- [/main] -->
    <?php if( ht_sidebar_layout() != 'no-sidebar') get_sidebar(); ?>

</div><!-- [/wrap] -->
<?php get_footer();?>
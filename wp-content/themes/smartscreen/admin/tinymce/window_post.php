<?php
require_once('config.php');
 
// check for rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') )
    wp_die(__("You are not allowed to be here",'highthemes'));
global  $data;
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $theme_name .' Shortcodes'; ?></title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/admin/tinymce/tinymce.css">
    <script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/admin/tinymce/tinymce.js"></script>
    <script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/scripts/jquery.tools.min.js"></script>  

    <script>
    jQuery(document).ready(function(){
        jQuery("ul.tab-titles").tabs("> .tab-content");
       
    });
    

    </script>

</head>


<body>
<div id="shortcode-content">



<div class="clearfix tab-set tab-horizontal tab-left">
    <ul class="tab-titles">
        <li data-id="general" class="current"><?php _e("General", "highthemes");?></li>
        <li data-id="button"><?php _e("Button", "highthemes");?></li>
        <li data-id="list"><?php _e("Lists", "highthemes");?></li>
        <li data-id="info_box"><?php _e("Info Boxes", "highthemes");?></li>
        <li data-id="titled_box"><?php _e("Titled Boxes", "highthemes");?></li>
        <li data-id="simple_box"><?php _e("Simple Boxes", "highthemes");?></li>
        <li data-id="links"><?php _e("Links", "highthemes");?></li>
    </ul>





    <div class="tab-content clearfix" id="general">
        <label for="style_shortcode"><?php _e('Select Custom Shortcode:','highthemes'); ?></label>
        <div class="field-content">
            <select id="style_shortcode" name="style_shortcode" style="width: 200px">
                <option value="0"><?php _e('No Style','highthemes'); ?></option>

                <optgroup label="<?php _e('Misc','highthemes'); ?>">
                    <option value="googlemap"><?php _e('Googel Map','highthemes'); ?></option>
                    <option value="progress"><?php _e('Progress Bar','highthemes'); ?></option>
                    <option value="slideshow"><?php _e('Slideshow','highthemes'); ?></option>
                    <option value="testimonial"><?php _e('Testimonial','highthemes'); ?></option>
                    <option value="tooltip"><?php _e('Tooltip','highthemes'); ?></option>
                    <option value="cta_box"><?php _e('Call To Action Box','highthemes'); ?></option>
                    <option value="code_sc"><?php _e('Code','highthemes'); ?></option>
                    <option value="pre"><?php _e('Pre','highthemes'); ?></option>
                </optgroup>

                <optgroup label="<?php _e('Pricing Table','highthemes'); ?>">
                    <option value="pricing_3col"><?php _e('3 Column','highthemes'); ?></option>
                    <option value="pricing_4col"><?php _e('4 Column','highthemes'); ?></option>
                    <option value="pricing_5col"><?php _e('5 Column','highthemes'); ?></option>
                </optgroup>

                <optgroup label="<?php _e('DropCap','highthemes'); ?>">
                    <option value="dropcap1"><?php _e('Drop Cap1','highthemes'); ?></option>
                    <option value="dropcap2"><?php _e('Drop Cap2','highthemes'); ?></option>
                    <option value="dropcap3"><?php _e('Drop Cap3','highthemes'); ?></option>
                </optgroup>
                <optgroup label="<?php _e('Divider','highthemes'); ?>">
                    <option value="hr_top"><?php _e('Divider Top','highthemes'); ?></option>
                    <option value="hr"><?php _e('Divider','highthemes'); ?></option>

                </optgroup>
                <optgroup label="<?php _e('Callout / Pullquote','highthemes'); ?>">
                    <option value="callout_left"><?php _e('Left Aligned','highthemes'); ?></option>
                    <option value="callout_right"><?php _e('Right Aligned','highthemes'); ?></option>
                    <option value="pullquote"><?php _e('Pullquote','highthemes'); ?></option>
                </optgroup>

                <optgroup label="<?php _e('Highlights','highthemes'); ?>">
                    <option value="h_yellow"><?php _e('Yello','highthemes'); ?></option>
                    <option value="h_black"><?php _e('Black','highthemes'); ?></option>
                    <option value="h_red"><?php _e('Red','highthemes'); ?></option>
                </optgroup>

                <optgroup label="<?php _e('Image alignment/lightbox','highthemes'); ?>">
                    <option value="lightbox"><?php _e('Image With Lightbox Effect','highthemes'); ?></option>
                    <option value="image_left"><?php _e('Left Aligned','highthemes'); ?></option>
                    <option value="image_right"><?php _e('Right Aligned','highthemes'); ?></option>
                    <option value="image_center"><?php _e('Centered','highthemes'); ?></option>
                </optgroup>

                <optgroup label="<?php _e('Tabs, Accordings, Toggle','highthemes'); ?>">
                    <option value="tabs"><?php _e('Tabs','highthemes'); ?></option>
                    <option value="accordions"><?php _e('Accordion','highthemes'); ?></option>

                    <option value="toggle"><?php _e('Toggle','highthemes'); ?></option>
                </optgroup>
            </select>
        </div>
    </div> <!-- #general -->




    <!-- #button -->
    <div class="tab-content clearfix" id="button">
            <label for="button_title"><?php _e('Title: ','highthemes'); ?></label>
            <div class="field-content">
                <input type="text" id="button_title" name="button_title" >
            </div>
            <label for="button_link"><?php _e('Link: ','highthemes'); ?></label>
            <div class="field-content">
                <input type="text" id="button_link" name="button_link" >
            </div>

            <label for="button_color"><?php _e('Color','highthemes');?></label>
            <div class="field-content">
                <select id="button_color" name="button_color" >
                    <option value="red"><?php _e('Red','highthemes'); ?></option>
                    <option value="magenta"><?php _e('Magenta','highthemes'); ?></option>
                    <option value="pink"><?php _e('Pink','highthemes'); ?></option>
                    <option value="orange"><?php _e('Orange','highthemes'); ?></option>
                    <option value="green"><?php _e('Green','highthemes'); ?></option>
                    <option value="blue"><?php _e('Blue','highthemes'); ?></option>
                    <option value="grey"><?php _e('Grey','highthemes'); ?></option>
                    <option value="black"><?php _e('Black','highthemes'); ?></option>
                    <option value="purple"><?php _e('Purple','highthemes'); ?></option>
                </select>
            </div>

            <label for="button_size"><?php _e('Size','highthemes');?></label>
            <div class="field-content">
                <select id="button_size" name="button_size">
                    <option value="small"><?php _e("Small", "highthemes"); ?></option>
                    <option value="medium"><?php _e("Medium","highthemes"); ?></option>
                    <option value="large"><?php _e("Large","highthemes"); ?></option>
                </select>
            </div>  

            <label for="button_type"><?php _e('Type','highthemes');?></label>
            <div class="field-content">
                <select type="text" id="button_type" name="button_type" >
                    <option value="simple"><?php _e('Simple','highthemes');?></option>
                    <option value="glossy"><?php _e('Glossy','highthemes');?></option>
                </select>
            </div>                      

            <label for="button_target"><?php _e('Target','highthemes');?></label>
            <div class="field-content">
                <input type="checkbox" id="button_target" name="button_target" >
            </div>
    </div>
    <!-- #button -->


    <!-- #List -->
    <div class="tab-content clearfix" id="list">
            <label for="list_type"><?php _e('List Type','highthemes');?></label>
            <div class="field-content">
                <select id="list_type" name="list_type" >
                    <option value="dottedlist"><?php _e('Dotted','highthemes'); ?></option>
                    <option value="dashedlist"><?php _e('Dashed','highthemes'); ?></option>
                    <option value="linelist"><?php _e('Line','highthemes'); ?></option>
                    <option value="checklist"><?php _e('Check','highthemes'); ?></option>
                    <option value="bulletlist"><?php _e('Circle Bullet','highthemes'); ?></option>
                    <option value="arrowlist"><?php _e('Arrow','highthemes'); ?></option>
                </select>
            </div>
    </div>
    <!-- #list -->


    <!-- #info_box -->
    <div class="tab-content clearfix" id="info_box">
            <label for="info_title"><?php _e('Title: ','highthemes'); ?></label>
            <div class="field-content">
                <input type="text" id="info_title" name="info_title" >
            </div>

            <label for="info_title_link"><?php _e('Title Link: ','highthemes'); ?></label>
            <div class="field-content">
                <input type="text" id="info_title_link" name="info_title_link" >
            </div>

            <label for="info_type"><?php _e('Box Type','highthemes');?></label>
            <div class="field-content">
                <select id="info_type" name="info_type" >
                    <option value="titled"><?php _e('Title Only','highthemes'); ?></option>
                    <option value="description"><?php _e('With Description','highthemes'); ?></option>
                </select>
            </div>

            <label for="info_color"><?php _e('Box Color','highthemes');?></label>
            <div class="field-content">
                <select id="info_color" name="info_color">
                    <option value="green"><?php _e('Green','highthemes'); ?></option>
                    <option value="red"><?php _e('Red','highthemes'); ?></option>
                    <option value="blue"><?php _e('Blue','highthemes'); ?></option>
                    <option value="silver"><?php _e('Silver','highthemes'); ?></option>
                    <option value="orange"><?php _e('Orange','highthemes'); ?></option>
                </select>
            </div>  

            <label for="info_icon"><?php _e('font Awesome Icon','highthemes');?></label>
            <div class="field-content">
                <input type="text" id="info_icon" name="info_icon" placeholder="fa-bug">
            </div>
        
    </div>
    <!-- #info_box -->


    <!-- #titled_box -->
    <div class="tab-content clearfix" id="titled_box">
            <label for="tbox_title"><?php _e('Title: ','highthemes'); ?></label>
            <div class="field-content">
                <input type="text" id="tbox_title" name="tbox_title" >
            </div>


            <label for="tbox_color"><?php _e('Background Color','highthemes');?></label>
            <div class="field-content">
                <select id="tbox_color" name="tbox_color">
                    <option value="red"><?php _e('Red','highthemes'); ?></option>
                    <option value="magenta"><?php _e('Magenta','highthemes'); ?></option>
                    <option value="pink"><?php _e('Pink','highthemes'); ?></option>
                    <option value="orange"><?php _e('Orange','highthemes'); ?></option>
                    <option value="green"><?php _e('Green','highthemes'); ?></option>
                    <option value="blue"><?php _e('Blue','highthemes'); ?></option>
                    <option value="grey"><?php _e('Grey','highthemes'); ?></option>
                    <option value="black"><?php _e('Black','highthemes'); ?></option>
                    <option value="purple"><?php _e('Purple','highthemes'); ?></option>
                </select>
            </div>  

          
    </div>
    <!-- #titled_box -->

  <!-- #simple_box -->
    <div class="tab-content clearfix" id="simple_box">
            <label for="sbox_border"><?php _e('Border Size (px): ','highthemes'); ?></label>
            <div class="field-content">
                <input type="text" id="sbox_border" name="sbox_border" >
            </div>


            <label for="sbox_border_color"><?php _e('Border Color','highthemes');?></label>
            <div class="field-content">
                <select id="sbox_border_color" name="sbox_border_color">
                    <option value="#da2e2e"><?php _e('Red','highthemes'); ?></option>
                    <option value="#980143"><?php _e('Magenta','highthemes'); ?></option>
                    <option value="#d6288e"><?php _e('Pink','highthemes'); ?></option>
                    <option value="#f15f0c"><?php _e('Orange','highthemes'); ?></option>
                    <option value="#8eb614"><?php _e('Green','highthemes'); ?></option>
                    <option value="#0ba6e1"><?php _e('Blue','highthemes'); ?></option>
                    <option value="#686868"><?php _e('Grey','highthemes'); ?></option>
                    <option value="#000"><?php _e('Black','highthemes'); ?></option>
                    <option value="#8a5092"><?php _e('Purple','highthemes'); ?></option>
                </select>
            </div>  

          
    </div>
    <!-- #simple_box -->



    <!-- #links -->
    <div class="tab-content clearfix" id="links">
            <label for="link_title"><?php _e('Title: ','highthemes'); ?></label>
            <div class="field-content">
                <input type="text" id="link_title" name="link_title" >
            </div>
            <label for="link_url"><?php _e('URL: ','highthemes'); ?></label>
            <div class="field-content">
                <input type="text" id="link_url" name="link_url" >
            </div>

            <label for="link_target"><?php _e('Link Target','highthemes');?></label>
            <div class="field-content">
                <select id="link_target" name="link_target">
                    <option value="_self"><?php _e('Same Window','highthemes'); ?></option>
                    <option value="_blank"><?php _e('New Window','highthemes'); ?></option>
                </select>
            </div>  

             <label for="link_icon"><?php _e('Fontawesome Icon','highthemes');?></label>
            <div class="field-content">
                <input type="text" id="link_icon" name="link_icon" placeholder="fa-bug" >
            </div>  
         
    </div>
    <!-- #links -->
</div> <!-- .tab-horizontal -->
<!-- <form onsubmit="insertLink();return false;" action="#"> -->
<form name="ht_shortcodes" action="#">
<div class="mceActionPanel">
    <div style="float: left">
        <p class="submit">
            <input onClick="InsertShortcodes();" type="button" id="ht-submit" class="button-primary" value="Insert Shortcode" name="submit" />
        </p>
    </div>
    
</div>
</form>
</div>
</body>
</html>


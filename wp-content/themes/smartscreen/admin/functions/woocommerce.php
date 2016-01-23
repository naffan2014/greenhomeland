<?php
// Custom Cart Message
function ht_woocommerce_js_scripts() {
?>
<script type="text/javascript">
jQuery(document).ready(function($){   
    $('body').bind('added_to_cart', function(){
        $('.add_to_cart_button.added').text('ADDED');
        
    });               
});
</script>
<?php
}
add_action( 'wp_head', 'ht_woocommerce_js_scripts' );

// This theme supports woocommerce
add_theme_support( 'woocommerce' );

// Disable WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Redefine woocommerce_output_related_products()
function woocommerce_output_related_products() {
    $args = array(
        'posts_per_page' => 3,
        'columns' => 3,
        'orderby' => 'rand'
    );
    woocommerce_related_products($args); // Display 3 products in rows of 3
}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

function ht_redefine_upsell_display(){
    woocommerce_upsell_display('-1', 3);
}
add_action( 'woocommerce_after_single_product_summary', 'ht_redefine_upsell_display', 15 );

/**
 * Hook in on activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'ht_woocommerce_image_dimensions', 1 );

/**
 * Define image sizes
 */
function ht_woocommerce_image_dimensions() {
    $catalog = array(
        'width' => '380',	// px
        'height'	=> '350',	// px
        'crop'	=> 0 // true
    );

    $single = array(
        'width' => '377',	// px
        'height'	=> '377',	// px
        'crop'	=> 0 // true
    );

    $thumbnail = array(
        'width' => '86',	// px
        'height'	=> '86',	// px
        'crop'	=> 0 // false
    );

// Image sizes
    update_option( 'shop_catalog_image_size', $catalog ); // Product category thumbs
    update_option( 'shop_single_image_size', $single ); // Single product image
    update_option( 'shop_thumbnail_image_size', $thumbnail ); // Image gallery thumbs
}

/*
 * Redefining WooCommerce CSS styles
 */
function ht_woo_style() {
    wp_register_style( 'ht-woocommerce', get_template_directory_uri() . '/woocommerce/style/woocommerce.css', null, 1.0, 'screen' );
    wp_enqueue_style( 'ht-woocommerce' );
}
add_action( 'wp_enqueue_scripts', 'ht_woo_style' );

// Some customizations on woo pages.
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Adding our own wrapper start & end
add_action('woocommerce_before_main_content', 'my_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'my_theme_wrapper_end', 10);


function ht_get_woobar(){
    global $woocommerce;
    $woobar['logout'] = "";

    $woobar['shop_cart'] = '<a class="cart-contents" href="'. $woocommerce->cart->get_cart_url().'" title="'. __('View your shopping cart', 'highthemes').'"> '. sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'highthemes'), $woocommerce->cart->cart_contents_count) .' - '. $woocommerce->cart->get_cart_total().'</a>';

  
    if ( is_user_logged_in() ) {
        $woobar['logout']       = ' | <a href="'. get_permalink( get_option('woocommerce_logout_page_id') ).'" title="'. __('Logout','highthemes').'">'. __('Logout','highthemes') . '</a>';
        $woobar['my_account']   = '<a href="'. get_permalink( get_option('woocommerce_myaccount_page_id') ).'" title="'. __('My Account','highthemes').'">'. __('My Account','highthemes') . '</a>';
    }
    else {
        $woobar['my_account']  = '<a href="'. get_permalink( get_option('woocommerce_myaccount_page_id') ).'" title="'. __('Login / Register','highthemes').'">'. __('Login / Register','highthemes').'</a>';
    }
        $woobar['checkout'] = ' | <a href="'. $woocommerce->cart->get_checkout_url().'" title="'. __('Checkout','highthemes').'">'. __('Checkout','highthemes') .'</a>';

        $output = '<div id="woo-cart">'.$woobar['my_account'] . ' | ' . $woobar['shop_cart'] . $woobar['checkout'] . $woobar['logout'].'</div>';
    return $output;
}

function my_theme_wrapper_start() {
    global $woocommerce;
    embed_fullscreen_bg();
  
    $woobar = ht_get_woobar();
    $sidebar_status =  ht_sidebar_layout();
    echo '<div id="wrap" class="'.$sidebar_status.'">
                <div id="main">
                    '. $woobar .'
                    <div id="entries">';
}
function my_theme_wrapper_end() {
   echo '</div><!--/end #entries--></div><!--/end #main-->';
}

// sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
add_action('woocommerce_sidebar', 'ht_woocommerce_sidebar', 10);

function ht_woocommerce_sidebar(){
    $sidebar_status =  ht_sidebar_layout();
    if($sidebar_status != 'no-sidebar'){
        woocommerce_get_template( 'global/sidebar.php' );
    }
    echo '</div><!--/end #wrap-->';
}

//remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

//
add_filter('woocommerce_page_title', 'ht_override_woo_page_title');
function ht_override_woo_page_title($title){
    $override_title             =       get_post_meta(woocommerce_get_page_id( 'shop' ), '_override_title', true);
    $teaser   =    ($override_title != '' ? $override_title : $title);

    return $teaser;

}



//
add_filter('woocommerce_breadcrumb_defaults', 'ht_woo_breadcrumb');
function ht_woo_breadcrumb($defaults){
    $defaults['delimiter'] = '&raquo;';
    $defaults['before'] = '<span class="arrow"> ';
    $defaults['after'] = ' </span>';
    $defaults['wrap_before'] = '<div id="breadcrumb"><p class="breadcrumb"> ';
    $defaults['wrap_after'] = '</p></div>';
    return $defaults;
}



//
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');

function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'highthemes'); ?>"><?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'highthemes'), $woocommerce->cart->cart_contents_count);?> - <?php echo $woocommerce->cart->get_cart_total(); ?></a>
    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}


//


/* Posts */
/*-----------------------------------------------------------------------------------*/


if ( ! function_exists('add_ht_woo_post_options_cb') ) {
    function add_ht_woo_post_options_cb() {
        add_meta_box(
            'ht_woo_post_options_cb',
            'HighThemes Options',
            'show_ht_woo_post_options_cb',
            'product',
            'normal',
            'high');
    }

}

add_action('add_meta_boxes', 'add_ht_woo_post_options_cb');

function ht_get_product_options() {

    // prefix of options
    $prefix = '_';


    // slideshow tax
    $sterms = array();
    $sterms = get_terms('slideshow-category');
    $sterms_array = array(
        'all' => array (
            'label' => __('All Items', 'highthemes'),
            'value' => ''
        ));
    if($sterms){
        foreach($sterms as $sterm){
            $sterms_array[$sterm->slug]['label']  = $sterm->name;
            $sterms_array[$sterm->slug]['value']  =$sterm->slug;
        }
    }

    $custom_woo_post_meta_fields = array(
        array(
            'label' =>__('Enable Video BG for this page', 'highthemes'),
            'desc'  =>__('If you enable video bg, you need to fill the video sources. Also the background slideshow will be disabled.', 'highthemes'),
            'id'    =>$prefix.'enable_video_bg',
            'type'  =>'checkbox'
        ),
        array(
            'label'=> __('BG Video Source MP4', 'highthemes'),
            'desc'  => __('Enter the mp4 video source url here.', 'highthemes'),
            'id'    => $prefix.'bg_video_mp4',
            'type'  => 'text'
        ),
        array(
            'label'=> __('BG Video Source WebM', 'highthemes'),
            'desc'  => __('Enter the webm video source url here.', 'highthemes'),
            'id'    => $prefix.'bg_video_webm',
            'type'  => 'text'
        ),
        array(
            'label'=> __('BG Video Source OGV', 'highthemes'),
            'desc'  => __('Enter the ogv video source url here.', 'highthemes'),
            'id'    => $prefix.'bg_video_ogv',
            'type'  => 'text'
        ),
        array(
            'label'=> __('BG Video Poster', 'highthemes'),
            'desc'  => __('Upload a video poster image for this video.', 'highthemes'),
            'id'    => $prefix.'bg_video_poster',
            'type'  => 'image'
        ),        
        array(
            'label'=> __('Slideshow Status', 'highthemes'),
            'desc'  => __('You can override the slideshow status for this page/post.', 'highthemes'),
            'id'    => $prefix.'slideshow_status',
            'type'  => 'select',
            'options' => array (
                'default' => array (
                    'label' => __('Default Settings', 'highthemes'),
                    'value' => ''
                ),
                'enable' => array (
                    'label' => __('Enable Slideshow', 'highthemes'),
                    'value' => 1
                ),
                'disable' => array (
                    'label' => __('Disable Slideshow', 'highthemes'),
                    'value' => 'false'
                )
            )
        ),

        array (
            'label' => __('Slideshow Category', 'highthemes'),
            'desc'  => __('Check the categories you wish to show items from', 'highthemes'),
            'id'    => $prefix.'slideshow_category',
            'type'  => 'select',
            'options' => $sterms_array
        )  ,
        array(
            'label' =>__('Disable Sidebar?', 'highthemes'),
            'desc'  =>__('Check to disable sidebar', 'highthemes'),
            'id'    =>$prefix.'disable_sidebar',
            'type'  =>'checkbox'
        )


    );   
    return $custom_woo_post_meta_fields; 
}


if ( ! function_exists('show_ht_woo_post_options_cb') ) {
    function show_ht_woo_post_options_cb() {
        global  $post;
        $custom_woo_post_meta_fields = ht_get_product_options();
        echo '<input type="hidden" name="custom_post_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';

        echo '<table class="form-table">';
        foreach ($custom_woo_post_meta_fields as $field) {
            $meta = get_post_meta($post->ID, $field['id'], true);
            $option_value = ( $post->ID != FALSE ) ? get_post_meta( $post->ID, $field['id'], true ) : $field['std'];
            if ( empty( $option_value ) )
                $option_value = $field['std'];

            echo '<tr>
                    <th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
                    <td>';
            switch($field['type']) {
                // text
                case 'text':
                    echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
            <br /><span class="description">'.$field['desc'].'</span>';
                    break;
                // textarea
                case 'textarea':
                    echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
            <br /><span class="description">'.$field['desc'].'</span>';
                    break;
                // checkbox
                case 'checkbox':
                    echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
            <label for="'.$field['id'].'">'.$field['desc'].'</label>';
                    break;
                // checkbox_group
                case 'checkbox_group':
                    foreach ($field['options'] as $option) {
                        echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' />
                <label for="'.$option['value'].'">'.$option['label'].'</label><br />';
                    }
                    echo '<span class="description">'.$field['desc'].'</span>';
                    break;
            case 'image':  
                $wp_version = floatval(get_bloginfo('version'));
                $image_attributes = wp_get_attachment_image_src( $option_value ,'thumbnail');
                $html = '';
                $visible = ($image_attributes[0] =="") ? 'display:none;' : 'display:block';

                
                    $html .= '
                    <ul id="'.$field['id'].'" style="'.$visible.'" class="image-holder-single">
                        <li>
                        <img width="150"  height="150" class="thumbnail" src="'.$image_attributes[0].'" />
                        <br/>
                        <a href="#" style="text-decoration: none;" data-relid="'.$field['id'].'"" class="remove-image">[X]</a>
                        </li>
                    </ul>';
               
                
                $html .= '<input type="hidden" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$option_value.'" />
                      <input id="'.$field['id'].'" data-title="'.__("Choose an image").'" data-version="'.$wp_version.'" class="ht_upload_image_single button" type="button" value="Upload Image" /> 
                      <br />
                      <span class="description">'.$field['desc'].'</span>';
                echo $html;

                break;                  

                // multi image  
                case 'multi-image':  
                $wp_version = floatval(get_bloginfo('version'));

                $html = '';

                    $html .= '<span class="description">'.$field['desc'].'</span>';
                    $html .='<ul id="'.$field['id'].'-holder" class="image-holder">';

                    if(is_array($option_value)){

                        foreach ($option_value as $key => $option) {

                            $image_attributes = wp_get_attachment_image_src( $option ,'thumbnail');

                            if($image_attributes[0]){

                                $html .= '<li>';
                                $html .= '<input type="hidden" name="'.$field['id'].'[]" value="'.$option.'" />';
                                $html .= '<img width="150" height="150" class="thumbnail" src="'.$image_attributes[0].'" /><br/>';
                                $html .= '<a href="#" style="text-decoration: none;" class="remove-image">[X]</a></li>';

                            }

                        }
                    }

                    $html .= '</ul>';
                    $html .= '<input id="'.$field['id'].'" data-title="'.__("Select Images", "highthemes") .'" data-version="'.$wp_version.'"  class="ht_upload_image button" type="button" value="Upload Image" /> ';
                    echo $html;
                    break;                      
                // select
                case 'select':
                    echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
                    foreach ($field['options'] as $option) {
                        echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
                    }
                    echo '</select><br /><span class="description">'.$field['desc'].'</span>';
                    break;



            }
            echo '</td></tr>';
        }
        echo '</table>';
    }

}

// Save the Data
if ( ! function_exists('save_custom_woo_post_meta') ) {
    function save_custom_woo_post_meta($post_id) {

        $custom_woo_post_meta_fields = ht_get_product_options();

        if(isset($_POST['custom_post_meta_box_nonce'])){

            if (!wp_verify_nonce($_POST['custom_post_meta_box_nonce'], basename(__FILE__)))
                return $post_id;
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
                return $post_id;
            if ('page' == $_POST['post_type']) {
                if (!current_user_can('edit_page', $post_id))
                    return $post_id;
            } elseif (!current_user_can('edit_post', $post_id)) {
                return $post_id;
            }

            // loop through fields and save the data
            foreach ($custom_woo_post_meta_fields as $field) {
                $old = get_post_meta($post_id, $field['id'], true);
                $new = $_POST[$field['id']];
                if ($new && $new != $old) {
                    update_post_meta($post_id, $field['id'], $new);
                } elseif ('' == $new && $old) {
                    delete_post_meta($post_id, $field['id'], $old);
                }
            }

        }
    }

}

add_action('save_post', 'save_custom_woo_post_meta');
?>
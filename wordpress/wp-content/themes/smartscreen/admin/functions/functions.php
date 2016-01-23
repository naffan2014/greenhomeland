<?php
/**
 *
 * HighThemes Options Framework
 * twitter : http://twitter.com/theHighthemes
 *
 */


include( get_template_directory() . '/scripts/custom-js.php' );


/**
 * image sizes
 */
add_image_size('ht-large-thumb',920, 670, true);
add_image_size('ht-folio1', 460, 270, true);
add_image_size('ht-folio2', 330, 198); 
add_image_size('ht-blog', 560, 250, true);
add_image_size('small-thumb', 45, 45, true);  


/**
 * After setup theme actions
 */
add_action( 'after_setup_theme', 'ht_theme_setup' );
function ht_theme_setup() {
    global $content_width;

    /* Set the $content_width for things such as video embeds. */
    if ( !isset( $content_width ) ){
        $content_width = 920;
    }

    /* Add theme support for automatic feed links. */   
    add_theme_support( 'automatic-feed-links' );

    /* Add theme support for post thumbnails (featured images). */
    add_theme_support('post-thumbnails', array('post', 'slideshow', 'portfolio', 'product'));

    /* Add theme support for post formats */
    add_theme_support('post-formats', array('link', 'quote', 'video','audio'));

    /* Add nav menus  */
    add_action( 'init', 'ht_register_menus' );

    /* Add sidebars */
    add_action( 'widgets_init', 'ht_register_sidebars' );

    /* Load JavaScript files  */
    add_action( 'wp_enqueue_scripts', 'ht_scripts_styles' );

    /* Add excerpt to page */
    add_post_type_support( 'page', 'excerpt' );

    /*
     * change the default.po file with poedit to create .mo file
     * The .mo file must be named based on the locale exactly.
     */
    load_theme_textdomain('highthemes', get_template_directory() .'/languages');

}

function ht_register_menus() {
    register_nav_menu( 'nav', __('Primary Navigation of '.THEMENAME,'highthemes') );
}

function ht_register_sidebars() {
    register_sidebars(1,array('name' => __('Default Sidebar','highthemes'), 'id'=>'default-sidebar', 'before_widget' =>
    '<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3 class="widget-title"><span>','after_title' => '</span></h3>'));

    register_sidebars(1,array('name' => __('Default Shop Sidebar','highthemes'), 'id'=>'shop-sidebar', 'before_widget' =>
    '<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3 class="widget-title"><span>','after_title' => '</span></h3>'));

    register_sidebars(1,array('name' => __('Archive Page Sidebar','highthemes'), 'id'=>'archive-sidebar', 'before_widget' =>
    '<div id="%1$s" class="%2$s widget">','after_widget' => '</div>','before_title' => '<h3 class="widget-title"><span>','after_title' => '</span></h3>'));
}



/**
 * Needed scripts & styles
 */
function ht_scripts_styles() {
     global $data, $wp_styles;

    /*
     * Adds JavaScript to pages with the comment form to support
     * sites with threaded comments (when in use).
     */
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );    
    }

    wp_enqueue_script( 'jquery.tools', HT_JS_PATH .'jquery.tools.min.js', array('jquery') , '', true);
    wp_enqueue_script( 'flex-js', HT_JS_PATH .'jquery.flexslider-min.js', array('jquery'), '', true);
    wp_enqueue_script( 'prettyPhoto', HT_JS_PATH .'jquery.prettyPhoto.js', array('jquery'), '', true);
    wp_enqueue_script( 'filterable', HT_JS_PATH .'jquery.isotope.min.js', array('jquery'), '', true);
    wp_enqueue_script( 'video-background', HT_JS_PATH .'jquery.videobackground.js', array('jquery'), '', true);


    if(ht_slideshow_status() == '1' && ! ht_has_video_bg() ) {
        wp_enqueue_script( 'supersized', HT_JS_PATH .'supersized.3.2.7.min.js', array('jquery'));
    }
    if($data['music_status'] !='1' && $data['music_url'] !='' && $data['music_status'] =='3' && is_front_page() ){
         wp_enqueue_script( 'audio', HT_JS_PATH .'audio.js');
    }
    if($data['music_status'] !='1' && $data['music_url'] !='' && $data['music_status'] =='2' ){
        wp_enqueue_script( 'audio', HT_JS_PATH .'audio.js');
    }
    wp_enqueue_script( 'custom-js', HT_JS_PATH .'custom.js', array('jquery'), '', true);
    wp_localize_script( 'custom-js', 'MyAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),  'contactNounce' => wp_create_nonce( 'myajax-contact-nonce' ), 'theme_directory' => get_template_directory_uri() ) );
    wp_localize_script( 'supersized', 'themeDetails', array( 'url' => get_template_directory_uri() ) );


    // Needed css files
    wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/styles/flexslider.css' );
    wp_enqueue_style( 'icons', get_template_directory_uri()  . '/styles/font-awesome.min.css' );
    wp_enqueue_style( 'prettyPhoto', get_template_directory_uri()  . '/styles/prettyPhoto.css' );
    wp_enqueue_style( 'supersized', get_template_directory_uri()  . '/styles/supersized.css' );


    // Main css
    wp_enqueue_style( 'ht-style', get_stylesheet_uri() );

    // lovely IE!
    wp_enqueue_style( 'ie-general', get_template_directory_uri()  . '/styles/ie.css' );
    wp_enqueue_style( 'ie-8', get_template_directory_uri()  . '/styles/ie8.css' );
    wp_enqueue_style( 'ie-7', get_template_directory_uri()  . '/styles/ie7.css' );

    wp_style_add_data( 'ie-general', 'conditional', 'lt IE 9' );
    wp_style_add_data( 'ie-8', 'conditional', 'lte IE 9' );
    wp_style_add_data( 'ie-7', 'conditional', 'IE 7' );

    if($data['responsive_layout'] == 'responsive') {
        wp_enqueue_style( 'responsive', get_template_directory_uri()  . '/styles/responsive.css' );

    }


}

/**
 * setup feedburner
 */
function ht_custom_rss_feed( $output, $feed ) {
    global $data;
    if ( strpos( $output, 'comments' ) ) {
        return $output;
    }
    if( empty($data['rss_id']) ) {
        return $output;
    }
    if(  ! empty($data['rss_id']) ) {
        return esc_url( $data['rss_id'] );
    } 

}
add_action( 'feed_link', 'ht_custom_rss_feed', 10, 2 );

/**
 * contact form in ajax
 */
add_action( 'wp_ajax_nopriv_ht_contact_action', 'ht_contact_action' );
add_action( 'wp_ajax_ht_contact_action', 'ht_contact_action' );

function ht_contact_action() {

    global $data;

    // start session for captcha
    session_start();

    // security check
    $nonce = $_POST['contactNounce'];
     if ( ! wp_verify_nonce( $nonce, 'myajax-contact-nonce' ) )
        die ( 'NOPE!');

    // getting the email address to send emails to
    $to_email = $data['contact_email_address'];

    $hasError = 'false';

    // check name
    if( empty( $_POST['fullname'] ) || $_POST['fullname'] == __('Full Name:','highthemes') ) {
        $hasError = "true";
        $error = __('Please enter your name.','highthemes');
        echo '
        <div class="info-box-wrapper">
            <div class="info-box-red-header info-box-warning">
                <div class="info-content-box-icon">'.$error.'</div>
            </div>
        </div>
        ';
        exit;

    } else {
        $name = trim( $_POST['fullname'] );
    }

    // check email
    if( empty( $_POST['email'] ) )  {
        $hasError = "true";
        $error = __('Please enter email address.','highthemes');
        echo '
        <div class="info-box-wrapper">
            <div class="info-box-red-header info-box-warning">
                <div class="info-content-box-icon">'.$error.'</div>
            </div>
        </div>
        ';
        exit;

    } else if ( ! preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/', strtolower( trim( $_POST['email'] ) ) ) ) {
        $hasError = "true";
        $error = __('Please enter your valid email address.','highthemes');
        echo '
        <div class="info-box-wrapper">
            <div class="info-box-red-header info-box-warning">
                <div class="info-content-box-icon">'.$error.'</div>
            </div>
        </div>
        ';
        exit;

    } else {
        $email = trim( $_POST['email'] );
    }

    // check captcha
    if( $data['disable_captcha'] !="1" ) {
        if( empty( $_POST['captcha'] ) ) {
            $hasError = "true";
            $error = __('Please enter captcha.','highthemes');
            echo '
            <div class="info-box-wrapper">
                <div class="info-box-red-header info-box-warning">
                    <div class="info-content-box-icon">'.$error.'</div>
                </div>
            </div>
            ';
            exit;
        } elseif ( trim( $_POST['captcha'] ) != $_SESSION['seccode'] ) {
            $hasError = "true";
            $error = __('Please enter captcha correctly','highthemes');
            echo '
            <div class="info-box-wrapper">
                <div class="info-box-red-header info-box-warning">
                    <div class="info-content-box-icon">'.$error.'</div>
                </div>
            </div>
            ';
            exit;
        }
    }

    // check message
    if( empty( $_POST['form_message'] ) ) {
        $hasError = "true";
        $error = __('Please enter your message.','highthemes');
        echo '
        <div class="info-box-wrapper">
            <div class="info-box-red-header info-box-warning">
                <div class="info-content-box-icon">'.$error.'</div>
            </div>
        </div>
        ';
        exit;

    } else {
        $comment = stripslashes(trim($_POST['form_message']));
    }
    if( isset( $_POST['url'] ) ) $website = stripslashes( trim( $_POST['url'] ) );

    if($hasError!="true") {
        $e_date    = date( 'Y/m/d - h:i A', time() );
        $e_subject = ''.__('New Message By','highthemes'    ).' ' . $name . ' '.__('on','highthemes').' ' . $e_date . '';
        $e_body    = $name . __(" has contacted you",'highthemes') ."\r\n\n";
        $e_body .= __("Comment: ",'highthemes') . $comment ." \r\n\n";
        $e_body .= __("Email: ",'highthemes') .  $email . " \r\n\n";
        $e_body .= __("website: ",'highthemes') . $website ." \r\n\n";
        $msg = $e_body;

        $headers = 'From: '.$name.' <'.$email.'>' . "\r\n" . 'Reply-To: ' . $email;

        if( wp_mail($to_email, $e_subject, $msg, $headers) ) {
            $emailSent = true;
        }

        echo "";
        echo '<div class="info-box-wrapper success">
            <div class="info-box-green-header">
            <div class="info-content-box">'.__("Message Sent Successfully!",'highthemes').' </div>
            </div>
            <div class="info-box-green-body">
            <div class="info-content-box">';
        echo __("Thank you ",'highthemes') . "<strong>$name</strong>, " . __("your message has been submitted to us.",'highthemes') ."";
        echo '</div>
            </div>
            </div>';
        exit;
    }

}


/*
 * Formatting description of menu items
 */
class description_walker extends Walker_Nav_Menu { 
        function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){
        global $wp_query;
        
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';

        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

        $prepend = '';
        $append = '';
        $description  = ! empty( $item->description ) ? '<span>'.esc_attr( $item->description ).'</span>' : '';

        if($depth != 0)
        {
            $description = $append = $prepend = "";
        }

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
        $item_output .= $description.$args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args, $id );
    }
}

/*
 * convert hexadecimal color to rgb
 */
if( ! function_exists('hex_to_rgb') ){
    function hex_to_rgb($color) {
        $without_hash = substr($color, 1);
        $r = substr($without_hash, 0, 2);
        $g = substr($without_hash, 2, 2);
        $b = substr($without_hash, 4, 2);

        return hexdec($r) . "," . hexdec($g) . "," . hexdec($b);
    }

}

/*
 *  google fonts come with a 'google_' prefix. with this function we will remove it from the font name
 */
if( ! function_exists('trim_google_font')){
    function trim_google_font($font){
        if(substr($font, 0, 6) == 'google'){
            return substr($font, 7);
        }
        else{
            return $font;
        }
    }
}


/*
 *  include google fonts link in the header
 */
if( ! function_exists('ht_include_google_font') ){
    function ht_include_google_font() {
        global $data;

        $font         = $data['heading_font'];
        $font_nav     = $data['navigation_font'];
        $font_body    = $data['body_font'];
        $font_sidebar = $data['sidebar_font'];
        $latin_chars  = ( isset($data['latin_chars']) && $data['latin_chars'] =='1') ? '&subset=latin,latin-ext' : '';


        // heading custom font
        if( substr($font['face'], 0, 6) == 'google' ){

            $font['face'] = substr($font['face'], 7);
            $font['face'] = str_replace( ' ', '+', $font['face'] );
            
            if( $font['face'] == 'Oswald' ) {
                    $font['face'] = $font['face'] . ":700,400,300";
            }            
            wp_enqueue_style( 'custom-heading-fonts', 'http://fonts.googleapis.com/css?family='.$font['face'].$latin_chars);

        }

        // Navigation custom font
        if( substr($font_nav['face'], 0, 6) == 'google' ){

            $font_nav['face'] = substr($font_nav['face'], 7);
            $font_nav['face'] = str_replace( ' ', '+', $font_nav['face'] );
            
            if( $font_nav['face'] == 'Oswald' ) {
                    $font_nav['face'] = $font_nav['face'] . ":700,400,300";
            }            

            wp_enqueue_style( 'custom-navigation-fonts', 'http://fonts.googleapis.com/css?family='.$font_nav['face'].$latin_chars);

        } 

        // Body custom font
        if( substr($font_body['face'], 0, 6) == 'google' ){

            $font_body['face'] = substr($font_body['face'], 7);
            $font_body['face'] = str_replace( ' ', '+', $font_body['face'] );
            
            if( $font_body['face'] == 'Oswald' ) {
                    $font_body['face'] = $font_body['face'] . ":700,400,300";
            }            

            wp_enqueue_style( 'custom-body-fonts', 'http://fonts.googleapis.com/css?family='.$font_body['face'].$latin_chars);

        } 

        // sidebar custom font
        if( substr($font_sidebar['face'], 0, 6) == 'google' ){

            $font_sidebar['face'] = substr($font_sidebar['face'], 7);
            $font_sidebar['face'] = str_replace( ' ', '+', $font_sidebar['face'] );
            
            if( $font_sidebar['face'] == 'Oswald' ) {
                    $font_sidebar['face'] = $font_sidebar['face'] . ":700,400,300";
            }            

            wp_enqueue_style( 'custom-sidebar-fonts', 'http://fonts.googleapis.com/css?family='.$font_sidebar['face'].$latin_chars);

        }         

        
    }

}
add_action('wp_enqueue_scripts', 'ht_include_google_font');

/*
 *  output custom dynamic css. it's controlled by admin options style section
 */
if( ! function_exists('ht_custom_css') ){
    function ht_custom_css(){
        require_once( get_template_directory()  .'/styles/custom-css.php');
    }
}
add_action('wp_head', 'ht_custom_css', 20);

/*
 *  include custom favicon
 */
if( ! function_exists('ht_favicon') ){
    function ht_favicon($url = "")
    {
        $link = "";
        if($url)
        {
            $type = "image/x-icon";
            if(strpos($url,'.png' )) $type = "image/png";
            if(strpos($url,'.gif' )) $type = "image/gif";

            $link = '<link rel="shortcut icon" href="'.$url.'" type="'.$type.'">';
        }
        return $link;
    }
}


/*
 *  enable shortcodes on text widgets
 */
add_filter('widget_text', 'do_shortcode');

/*
 * get image url
 */
if( ! function_exists('ht_get_img_url') ){
    function ht_get_img_url($thumbnail='full', $thumb_id=0) {
        $thumb =   wp_get_attachment_image_src( $thumb_id, $thumbnail ); 
        return $thumb[0];
    }

}

/*
 *  get image url of a certain featured image
 */
if( ! function_exists('ht_get_featured_image_url') ){
    function ht_get_featured_image_url($post_id=0, $image_id = '', $thumbnail='full'){

        if( $post_id ) {
            $id = get_post_meta($post_id, "_thumbnail_id", true);
        } else {
            $id = $image_id;
        }
        if( $id > 0 ){
            $image = wp_get_attachment_image_src($id,$thumbnail);
            $image_details['url'] = $image[0];
            $image_details['id'] = $id;
            return $image_details;
        } else {
            return '';
        }

    }

}


/*
 * custom excerpt with custom length and ellipsis
 */
if( ! function_exists('ht_excerpt') ){
    function ht_excerpt($length, $ellipsis) {
        $text = get_the_content();
        $text = preg_replace('`\[[^\]]*\]`','',$text);
        $text = strip_tags($text);
        if(strlen($text) <= $length) {

            return $text;
        }
        else {
            $text = substr($text, 0, $length);
            $text = substr($text, 0, strripos($text, " "));
            $text = $text.$ellipsis;
            return $text;
        }
    }

}



/*
 *  new excerpt more
 */
if( ! function_exists('new_excerpt_more') ){
    function new_excerpt_more($more) {
        return ' ...';
    }
}
add_filter('excerpt_more', 'new_excerpt_more');



/*
 *  twitter like time
 */
if( ! function_exists('ht_days_date') ){
    function ht_days_date($date){

        $days = round((date('U') - $date) / (60*60*24));
        if ($days==0) {
            _e("Published today", "highthemes");
        }
        elseif ($days==1) {
            _e("1 day ago", "highthemes");
        }
        else {
            echo $days . __(" days ago", "highthemes");
        }
    }
}


/*
 * comments template. this function used to make a custom template for comments
 */
if( ! function_exists('custom_comment') ){
    function custom_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
<div <?php comment_class(); ?> id="div-comment-<?php comment_ID() ?>">
	<div class="comment-entry clearfix" id="comment-<?php comment_ID(); ?>">

        <div class="comment-author-wrap">
            <?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['avatar_size'] ); ?>
        </div>

        <div class="comment-content">
            <div class="comment-author-info">
                <span class="comment-author">
                    <?php ($comment->comment_author_url == 'http://Website' || $comment->comment_author_url == '') ? comment_author() : comment_author_link(); ?>
                </span> -
                <span class="comment-time"><span><?php comment_date('d. M, Y'); ?></span></span> -
                <span class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
            </div>
            <?php
            if($comment->comment_approved == '0'){
                echo '<strong><em>'.__('Your comment is awaiting moderation.', 'highthemes').'</em></strong>';
            }
            ?>
            <?php comment_text() ?>
        </div>

    </div>
        <?php
    }

}



/*
 * display related posts for posts.
 */
if( ! function_exists('ht_related_post') ){
    function ht_related_post() {
        global $post, $wpdb;
        $backup = $post;  // backup the current object
        $tags = wp_get_post_tags($post->ID);
        $tagIDs = array();
        if ($tags) {
            $tagcount = count($tags);
            for ($i = 0; $i < $tagcount; $i++) {
                $tagIDs[$i] = $tags[$i]->term_id;
            }
            $args=array(
                'tag__in' => $tagIDs,
                'post__not_in' => array($post->ID),
                'showposts'=>4,
                'caller_get_posts'=>1
            );
            $my_query = new WP_Query($args);
            if( $my_query->have_posts() ) { $related_post_found = true; ?>
            <div class="related-posts">

                <h2 class="htitle"><span><?php _e('Related Posts','highthemes'); ?></span></h2>
                <ul class="thumb-list">
                    <?php
                    $i=1;
                    while ($my_query->have_posts()) : $my_query->the_post();

                        $post_id = get_the_ID();
                        $post_thumbnail = get_the_post_thumbnail($post_id, array(60, 60), array("class" => "post_thumbnail frame"));

                        if(!$post_thumbnail){
                            $post_thumbnail = '<img class="frame" alt="image" src="'.get_template_directory_uri() .'/images/empty_thumb.gif" />';
                        }
                        ?>
                        <li class="one_half <?php if(($i%2)==0 && $i<>0){ echo ' last';}?>">
                            <a class="fl" href="<?php the_permalink() ?>" title="<?php the_title(); ?>">
                                <?php echo $post_thumbnail;?></a>
                            <p><a class="thumb-title" href="<?php the_permalink() ?>"	rel="bookmark"> <?php the_title(); ?></a><br />
        <span class="date">
        <?php the_date(); ?>
        </span>
                                <br class="fix" />
                            </p>
                        </li>
                        <?php
                        $i++;
                    endwhile;
                    ?>
                </ul>
            </div>

                <?php
            }
        }

        wp_reset_query();

    }

}

/*
* set the layout sidebar alignment.
*/
if( ! function_exists('ht_sidebar_layout') ){
    function ht_sidebar_layout($flag=0){
        if( $flag ){
            global $data;
            return $data['sidebar_layout'];

        }
        global $data, $post;

        if ( is_post_type_archive( 'product' ) ) {
            $post   = get_post( woocommerce_get_page_id( 'shop' ) );
        }
        if (get_post_meta($post->ID, '_disable_sidebar', true) !=''){
            $sidebar_layout ='no-sidebar';
            
        } elseif( get_post_meta($post->ID,'_sidebar_alignment',true) ){
            $sidebar_layout = get_post_meta($post->ID,'_sidebar_alignment',true);
        }
        else {
            $sidebar_layout = $data['sidebar_layout'];
        }

        return $sidebar_layout;

    }

}



/*
* Slideshow status.
*/
if( ! function_exists('ht_slideshow_status') ){
    function ht_slideshow_status($flag=0){
        if($flag){
            global $data;
            return $data['slideshow_status'];

        }
        global $data, $post;
        if ( is_post_type_archive( 'product' ) ) {
            $post   = get_post( woocommerce_get_page_id( 'shop' ) );
        }
        if (get_post_meta($post->ID, '_slideshow_status', true) !=''){
            $disable_slideshow = get_post_meta($post->ID, '_slideshow_status', true);
        }  else {
            $disable_slideshow = $data['slideshow_status'];
        }

        return $disable_slideshow;

    }

}




/*
 *  tweak wp_title to make it more useful
 */
if( ! function_exists('ht_filter_wp_title') ){
    function ht_filter_wp_title( $title, $separator ) {
        if ( is_feed() )
            return $title;

        global $paged, $page;

        if ( is_search() ) {
            $title = sprintf( __( 'Search results for','highthemes').' %s', '"' . get_search_query() . '"' );
            if ( $paged >= 2 )
                $title .= " $separator " . sprintf( __( 'Page','highthemes' ) . ' %s', $paged );
            $title .= " $separator " . get_bloginfo( 'name', 'highthemes' );
            return $title;
        }

        $title .= get_bloginfo( 'name', 'highthemes' );

        $site_description = get_bloginfo( 'description', 'highthemes' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            $title .= " $separator " . $site_description;

        if ( $paged >= 2 || $page >= 2 )
            $title .= " $separator " . sprintf( __( 'Page','highthemes' ) . ' %s', max( $paged, $page ) );

        return $title;
    }

}
add_filter( 'wp_title', 'ht_filter_wp_title', 10, 2 );


/*
 * comment form template
 */
if( ! function_exists('ht_comment_form') ){
    function ht_comment_form($form_options) {
        global $user_identity;
        if(!isset($commenter['comment_author'])){$commenter['comment_author'] = 'Name';}
        if(!isset($commenter['comment_author_email'])){$commenter['comment_author_email'] = 'Email';}
        if(!isset($commenter['comment_author_url'])){$commenter['comment_author_url'] = 'Website';}


        $aria_req = "";
        // Fields Array
        $fields = array(

            'author' =>
            '<div class="personal-data"><p>' .
                ( isset($req) ? '<span class="required">*</span>' : '' ) .
                '<label for="fullname">'.__('Full name','highthemes').'</label><input id="fullname" class="txt" name="author" type="text"  size="30"' . $aria_req . '  />' .
                '</p>',

            'email' =>
            '<p>' .
                ( isset($req) ? '<span class="required">*</span>' : '' ) .
                '<label for="email">'.__('Email','highthemes').'</label><input  id="email" name="email" class="txt" type="text"  size="30"' . $aria_req . ' />' .
                '</p>',

            'url' =>
            '<p>'  .
                '<label for="url">'.__('Website URL','highthemes').'</label><input name="url" class="txt" size="30" id="url" type="text"  />' .
                '</p>
		</div>',

        );

        $post_id = "";
        // Form Options Array
        $form_options = array(
            // Include Fields Array
            'fields' => apply_filters( 'comment_form_default_fields', $fields ),

            // Template Options
            'comment_field' =>

            '<div class="form-data"><p>' .
                '<label for="form_message">'. __('Comment','highthemes').'</label><textarea  name="comment" id="form_message" aria-required="true" rows="8" cols="45" ></textarea>' .
                '</p></div>',

            'must_log_in' =>
            '<p class="must-log-in">' .
                sprintf( __( 'You must be', 'highthemes') .' <a href="%s">'.__('logged in','highthemes') . '</a> '.__('to post a comment.', 'highthemes' ),
                    wp_login_url( apply_filters( 'the_permalink', get_permalink($post_id) ) ) ) .
                '</p>',

            'logged_in_as' =>
            '<p class="logged-in-as">' .
                sprintf( __( 'Logged in as', 'highthemes') .' <a href="%1$s">%2$s</a>. <a href="%3$s" title="' . __('Log out of this account', 'highthemes') .'">'.__('Log out?', 'highthemes') . '</a>',
                    admin_url('profile.php'), $user_identity, wp_logout_url( apply_filters('the_permalink', get_permalink($post_id)) ) ) .
                '</p>',

            'comment_notes_before' =>
            '',

            'comment_notes_after' => '',
            'class_submit'         => 'submit',
            'name_submit'          => 'submit',
            'submit_button'        => '<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s" />',
            'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',

            // Rest of Options
            'id_form' => 'form-comment',
            'id_submit' => 'submit',
            'title_reply' => __( 'Leave a Reply', 'highthemes' ),
            'title_reply_to' => __( 'Leave a Reply to', 'highthemes' ) .' %s',
            'cancel_reply_link' => __( '<span>Cancel reply</span>', 'highthemes' ),
            'label_submit' => __( 'Post Comment' , 'highthemes'),
        );
        return $form_options;
    }
}
add_filter('comment_form_defaults', 'ht_comment_form');

/*
 * author bio box
 */
if( ! function_exists('ht_author_bio') ){
    function ht_author_bio() { ?>
    <div id="author-info">
        <div class="border-style">
            <div class="inner"><span class="fl"><?php echo get_avatar( get_the_author_meta('email'), '60' ); ?></span>
                <p>
                    <strong class="author-name">
                        <?php the_author_link(); ?>
                    </strong>
                    <?php if(get_the_author_meta('description') == '') {
                    echo __('The author didn\'t add any Information to his profile yet. ', 'highthemes');
                } else {
                    the_author_meta('description');
                } ?>
                </p>
                <div class="fix"></div>
            </div>
        </div>
    </div>
        <?php
    }

}

/*
 * Social icons
 */
if( ! function_exists('ht_social_icons_list') ){
    function ht_social_icons_list() { 

    global $data;
    $social_target = (isset($data['social_target'])) ? '_blank' : '';
?>
    
    <ul>
        <?php if($data['twitter_id']){?><li class="twitter"><a target="<?php echo $social_target;?>" href="http://twitter.com/<?php echo $data['twitter_id'];?>"><i class="fa fa-twitter"></i></a></li><?php }?>
        <?php if($data['facebook_id']){?><li class="facebook"><a target="<?php echo $social_target;?>" href="<?php echo $data['facebook_id'];?>"><i class="fa fa-facebook"></i></a></li><?php }?>
        <?php if($data['gplus_id']){?><li class="gplus"><a target="<?php echo $social_target;?>" href="<?php echo $data['gplus_id'];?>"><i class="fa fa-google-plus"></i></a></li><?php }?>
        <?php if($data['flickr_id']){?><li class="flickr"><a target="<?php echo $social_target;?>" href="<?php echo $data['flickr_id'];?>"><i class="fa fa-flickr"></i></a></li><?php }?>
        <?php if($data['rss_id']){?><li class="rss"><a target="<?php echo $social_target;?>" href="<?php echo $data['rss_id'];?>"><i class="fa fa-rss"></i></a></li><?php }?>
        <?php if($data['linkedin_id']){?><li class="linkedin"><a target="<?php echo $social_target;?>" href="<?php echo $data['linkedin_id'];?>"><i class="fa fa-linkedin"></i></a></li><?php }?>
        <?php if($data['vimeo_id']){?><li class="vimeo"><a target="<?php echo $social_target;?>" href="<?php echo $data['vimeo_id'];?>"><i class="fa fa-vimeo-square"></i></a></li><?php }?>
        <?php if($data['behance_id']){?><li class="behance"><a target="<?php echo $social_target;?>" href="<?php echo $data['behance_id'];?>"><i class="fa fa-behance"></i></a></li><?php }?>
        <?php if($data['dribble_id']){?><li class="dribble"><a target="<?php echo $social_target;?>" href="<?php echo $data['dribble_id'];?>"><i class="fa fa-dribbble"></i></a></li><?php }?>
        <?php if($data['digg_id']){?><li class="digg"><a target="<?php echo $social_target;?>" href="<?php echo $data['digg_id'];?>"><i class="fa fa-digg"></i></a></li><?php }?>
        <?php if($data['delicious_id']){?><li class="delicious"><a target="<?php echo $social_target;?>" href="<?php echo $data['delicious_id'];?>"><i class="fa fa-delicious"></i></a></li><?php }?>
        <?php if($data['tumblr_id']){?><li class="tumblr"><a target="<?php echo $social_target;?>" href="<?php echo $data['tumblr_id'];?>"><i class="fa fa-tumblr"></i></a></li><?php }?>
        <?php if($data['youtube_id']){?><li class="youtube"><a target="<?php echo $social_target;?>" href="<?php echo $data['youtube_id'];?>"><i class="fa fa-youtube"></i></a></li><?php }?>
        <?php if($data['instagram_id']){?><li class="instagram"><a target="<?php echo $social_target;?>" href="<?php echo $data['instagram_id'];?>"><i class="fa fa-instagram"></i></a></li><?php }?>
        <?php if($data['pinterest_id']){?><li class="pinterest"><a target="<?php echo $social_target;?>" href="<?php echo $data['pinterest_id'];?>"><i class="fa fa-pinterest"></i></a></li><?php }?>
        <?php if($data['soundcloud_id']){?><li class="soundcloud"><a target="<?php echo $social_target;?>" href="<?php echo $data['soundcloud_id'];?>"><i class="fa fa-soundcloud"></i></a></li><?php }?>
        <?php if($data['skype_id']){?><li class="soundcloud"><a target="<?php echo $social_target;?>" href="<?php echo $data['skype_id'];?>"><i class="fa fa-skype"></i></a></li><?php }?>        
        <?php if($data['dropbox_id']){?><li class="soundcloud"><a target="<?php echo $social_target;?>" href="<?php echo $data['dropbox_id'];?>"><i class="fa fa-dropbox"></i></a></li><?php }?>                
        <?php if($data['email_id']){?><li class="email-social"><a target="<?php echo $social_target;?>" href="<?php echo $data['email_id'];?>"><i class="fa fa-envelope"></i></a></li><?php }?>
    </ul>

    <?php
    }
}



/*
 * embed slideshow as background slideshow
 */
function embed_fullscreen_bg($flag=''){
    if(ht_slideshow_status($flag) == '1') { get_template_part("includes/slideshow_content"); }
 }


// is woocommerce activated?
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
    function is_woocommerce_activated() {
        if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
    }
}

/**
 * Mobile Detect
 * @license    http://www.opensource.org/licenses/mit-license.php The MIT License
 */
class Mobile_Detect
{

    protected $accept;
    protected $userAgent;
    protected $isMobile = false;
    protected $isAndroid = null;
    protected $isAndroidtablet = null;
    protected $isIphone = null;
    protected $isIpad = null;
    protected $isBlackberry = null;
    protected $isBlackberrytablet = null;
    protected $isOpera = null;
    protected $isPalm = null;
    protected $isWindows = null;
    protected $isWindowsphone = null;
    protected $isGeneric = null;
    protected $devices = array(
        "android" => "android.*mobile",
        "androidtablet" => "android(?!.*mobile)",
        "blackberry" => "blackberry",
        "blackberrytablet" => "rim tablet os",
        "iphone" => "(iphone|ipod)",
        "ipad" => "(ipad)",
        "palm" => "(avantgo|blazer|elaine|hiptop|palm|plucker|xiino)",
        "windows" => "windows ce; (iemobile|ppc|smartphone)",
        "windowsphone" => "windows phone os",
        "generic" => "(kindle|mobile|mmp|midp|pocket|psp|symbian|smartphone|treo|up.browser|up.link|vodafone|wap|opera mini)"
    );

    public function __construct()
    {
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
        $this->accept = $_SERVER['HTTP_ACCEPT'];

        if (isset($_SERVER['HTTP_X_WAP_PROFILE']) || isset($_SERVER['HTTP_PROFILE'])) {
            $this->isMobile = true;
        } elseif (strpos($this->accept, 'text/vnd.wap.wml') > 0 || strpos($this->accept, 'application/vnd.wap.xhtml+xml') > 0) {
            $this->isMobile = true;
        } else {
            foreach ($this->devices as $device => $regexp) {
                if ($this->isDevice($device)) {
                    $this->isMobile = true;
                }
            }
        }
    }

    /**
     * Overloads isAndroid() | isAndroidtablet() | isIphone() | isIpad() | isBlackberry() | isBlackberrytablet() | isPalm() | isWindowsphone() | isWindows() | isGeneric() through isDevice()
     *
     * @param string $name
     * @param array $arguments
     * @return bool
     */
    public function __call($name, $arguments)
    {
        $device = substr($name, 2);
        if ($name == "is" . ucfirst($device) && array_key_exists(strtolower($device), $this->devices)) {
            return $this->isDevice($device);
        } else {
            trigger_error("Method $name not defined", E_USER_WARNING);
        }
    }

    /**
     * Returns true if any type of mobile device detected, including special ones
     * @return bool
     */
    public function isMobile()
    {
        return $this->isMobile;
    }

    protected function isDevice($device)
    {
        $var = "is" . ucfirst($device);
        $return = $this->$var === null ? (bool) preg_match("/" . $this->devices[strtolower($device)] . "/i", $this->userAgent) : $this->$var;
        if ($device != 'generic' && $return == true) {
            $this->isGeneric = false;
        }

        return $return;
    }

}
$ht_mobile = new Mobile_Detect();     

/**
 * change portfolio archive page posts number to 12
 */
function ht_portfolio_archive_posts( $query ) {
    if(is_tax('portfolio-category')){
      $query->set('posts_per_page', 12);
    }
}

add_action( 'pre_get_posts', 'ht_portfolio_archive_posts' );

/**
 * has video bg
 */
function ht_has_video_bg() {
    global $post, $data;

    $ht_enable_video_bg = get_post_meta( $post->ID , '_enable_video_bg', true);

    if( ! empty( $ht_enable_video_bg ) ) {
        return true;
    } else {
        return false;
    }

}
?>
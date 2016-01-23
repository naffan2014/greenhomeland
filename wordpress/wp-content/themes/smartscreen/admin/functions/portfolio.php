<?php
/**
 *
 * HighThemes Options Framework
 * twitter : http://twitter.com/theHighthemes
 *
 */

add_action('init', 'ht_portfolio_type',0);
function ht_portfolio_type() {
    global $data;
    $portfolio_slug = 'portfolio';
    if(isset($data['folio_slug']) && $data['folio_slug'] !=''){
        $portfolio_slug = strtolower($data['folio_slug']);
    }

    $portfolio_cat_slug = 'portfolio-category';
    if(isset($data['folio_cat_slug']) && $data['folio_cat_slug'] !=''){
        $portfolio_cat_slug = strtolower($data['folio_cat_slug']);
    }
    $labels = array(
        'name' => __('Portfolio','highthemes'),
        'singular_name' => __('Portfolio Item','highthemes'),
        'add_new' => __('Add New','highthemes'),
        'add_new_item' => __('Add New Item','highthemes'),
        'edit_item' => __('Edit Item','highthemes'),
        'new_item' => __('New Item','highthemes'),
        'view_item' => __('View Portfolio Item','highthemes'),
        'search_items' => __('Search Portfolio Items','highthemes'),
        'not_found' =>  __('No items found','highthemes'),
        'not_found_in_trash' => __('No items found in Trash','highthemes'),
        'parent_item_colon' => ''
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => $portfolio_slug
        ),
        'capability_type' => 'post',
        'hierarchical' => false,
         'menu_icon' => 'dashicons-portfolio',
        'menu_position' => 5,
        'supports' => array('title','editor','author','thumbnail','excerpt','comments'),
    );
    register_post_type( 'portfolio' , $args );

    // register custom taxonomy for portfolio
    register_taxonomy('portfolio-category',array('portfolio'), array(
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array(
            'slug' => $portfolio_cat_slug
        )
    ));



}

add_filter('post_updated_messages', 'portfolio_updated_messages');
function portfolio_updated_messages( $messages ) {
    global $post, $post_ID;

    $messages['portfolio'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => sprintf( __('Item updated.','highthemes') . ' <a href="%s">'. __('View Item', 'highthemes') . '</a>', esc_url( get_permalink($post_ID) ) ),
        2 => __('Custom field updated.','highthemes'),
        3 => __('Custom field deleted.','highthemes'),
        4 => __('Item updated.','highthemes'),
        /* translators: %s: date and time of the revision */
        5 => isset($_GET['revision']) ? sprintf( __('Item restored to revision from','highthemes') . ' %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
        6 => sprintf( __('Item published','highthemes').' <a href="%s">'.__('View Item','highthemes').'</a>', esc_url( get_permalink($post_ID) ) ),
        7 => __('Item saved.','highthemes'),
        8 => sprintf( __('Item submitted.','highthemes').' <a target="_blank" href="%s">'.__('Preview Item','highthemes').'</a>', esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
        9 => sprintf( __('Item scheduled for:','highthemes').' <strong>%1$s</strong>. <a target="_blank" href="%2$s">'.__('Preview Item','highthemes').'</a>',
            // translators: Publish box date format, see http://php.net/date
            date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
        10 => sprintf( __('Item draft updated. ','highthemes') . '<a target="_blank" href="%s">'.__('Preview Item','highthemes').'</a>', esc_url( add_query_arg( __('preview','highthemes'), 'true', get_permalink($post_ID) ) ) ),
    );

    return $messages;
}

//add thumbnail col to portfolio list

    function ht_add_thumb_col($cols) {

        $cols['thumbnail'] = __('Thumbnail','highthemes');

        return $cols;
    }
    function fb_add_thumb_value($column_name, $post_id) {

        $width = (int) 80;
        $height = (int) 80;

        if ( 'thumbnail' == $column_name ) {
            // thumbnail of WP 2.9
            $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
            // image from gallery
            $attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
            if ($thumbnail_id)
                $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
            elseif ($attachments) {
                foreach ( $attachments as $attachment_id => $attachment ) {
                    $thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
                }
            }
            if ( isset($thumb) && $thumb ) {
                echo $thumb;
            } else {
                echo __('None','highthemes');
            }
        }
    }

    // for posts
    add_filter( 'manage_posts_columns', 'ht_add_thumb_col' );
    add_action( 'manage_posts_custom_column', 'fb_add_thumb_value', 10, 2 );

    // for pages
    add_filter( 'manage_pages_columns', 'ht_add_thumb_col' );
    add_action( 'manage_pages_custom_column', 'fb_add_thumb_value', 10, 2 );

    // for portfolio
    add_filter( 'manage_portfolio_columns', 'ht_add_thumb_col' );
    add_action( 'manage_portfolio_custom_column', 'fb_add_thumb_value', 10, 2 );

?>
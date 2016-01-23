<?php
/**
 *
 * HighThemes Options Framework
 * twitter : http://twitter.com/theHighthemes
 *
 */

add_action('init', 'ht_slideshow_type');

global $data;
if( ! function_exists( 'ht_slideshow_type' ) ) {
    function ht_slideshow_type() {
        $labels = array(
            'name' => __('Slideshow','highthemes'),
            'singular_name' => __('Slideshow Item','highthemes'),
            'add_new' => __('Add New','highthemes'),
            'add_new_item' => __('Add New Item','highthemes'),
            'edit_item' => __('Edit Item','highthemes'),
            'new_item' => __('New Item','highthemes'),
            'view_item' => __('View Slideshow Item','highthemes'),
            'search_items' => __('Search Slideshow Items','highthemes'),
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
            'rewrite' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'menu_icon'          =>'dashicons-slides',
            'menu_position' => 5,
            'supports' => array('title','editor','author','thumbnail','excerpt','comments')
        );


        register_post_type( 'slideshow' , $args );

        // register custom taxonomy for portfolio
       register_taxonomy('slideshow-category','slideshow', array(
            'hierarchical' => true,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => true,
        ));

    }

}


//add filter to insure the text Item, or Item, is displayed when user updates a Item 
add_filter('post_updated_messages', 'slideshow_updated_messages');
if( ! function_exists( 'slideshow_updated_messages' ) ) {
    function slideshow_updated_messages( $messages ) {
        global $post, $post_ID;

        $messages['slideshow'] = array(
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

}


?>
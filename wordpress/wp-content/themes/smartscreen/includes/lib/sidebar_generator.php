<?php

class ht_sidebar_generator
{

    function __construct()
    {
        add_action('init', array('ht_sidebar_generator', 'init'));
    }

    public static function init()
    {
        //go through each sidebar and register it
        $sidebars = ht_sidebar_generator::get_sidebars();

        if (is_array($sidebars)) {
            $z = 1;
            foreach ($sidebars as $id => $sidebar) {
                $id = sanitize_title($sidebar);
                register_sidebar(array(
                    'name' => $sidebar,
                    'id' => 'ht_'.$id,
                    'before_widget' => '<div id="%1$s" class="widget ' . $id . ' %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h3 class="widget-title"><span>',
                    'after_title' => '</span></h3>',
                ));
                $z++;
            }
        }
    }

    /**
     * called by the action get_sidebar. this is what places this into the theme
     */
    public static function get_sidebar($index='default-sidebar')
    {
        wp_reset_query();
        global $wp_query;
        $post = $wp_query->get_queried_object();
        if ( is_post_type_archive( 'product' ) ) {
            $post   = get_post( woocommerce_get_page_id( 'shop' ) );
        }
        if (isset($post->ID)) {
            $selected_sidebar = get_post_meta($post->ID, '_selected_sidebar', true);
        } else {
            $selected_sidebar = "";
        }
        if ($selected_sidebar != '' && $selected_sidebar != "0") {
            echo "\n\n<!-- begin generated sidebar [$selected_sidebar] -->\n";
            //echo "<!-- selected: $selected_sidebar -->";
            dynamic_sidebar('ht_'.$selected_sidebar);
            echo "\n<!-- end generated sidebar -->\n\n";
        } else {
            //dynamic_sidebar($index);
            if (!function_exists('dynamic_sidebar') || !dynamic_sidebar($index)
            ) :

                //echo '<div id="search" class="widget widget_search">';
                //get_search_form();
                //echo '</div>';

            endif;
        }
    }

    /**
     * gets the generated sidebars
     */
    public static function get_sidebars()
    {
        $sidebars = get_option('ht_sidebar_generator');
        return $sidebars;
    }

}

$sbg = new ht_sidebar_generator;
function ht_generated_dynamic_sidebar($index)
{
    ht_sidebar_generator::get_sidebar($index);
    return true;
}

?>
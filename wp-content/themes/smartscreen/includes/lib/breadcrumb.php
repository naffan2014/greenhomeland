<?php

if(!class_exists('simple_breadcrumb'))
{
    class simple_breadcrumb
    {
        var $options;

        function simple_breadcrumb($options = ""){

            $this->options = array(
                'before' => '<span class="arrow"> ',
                'after' => ' </span>',
                'delimiter' => '&raquo;'
            );

            if(is_array($options))
            {
                $this->options = array_merge($this->options, $options);
            }


            $markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];

            global $post;
            echo '<p class="breadcrumb"><span class="breadcrumb_info"></span> <a href="'.home_url().'">';
            _e("Home", "highthemes");
            echo "</a>";
            if(!is_front_page()){echo $markup;}

            $output = $this->simple_breadcrumb_case($post);

            echo "<span class='current_crumb'>";
            if ( is_page() || is_single()) {
                the_title();
            }else{
                echo $output;
            }
            echo " </span></p>";
        }

        function simple_breadcrumb_case($der_post)
        {
            global $post, $data;

            $portfolio_bread = '<a href="'.get_permalink($data['portfolio_main_page']).'">'.get_the_title($data['portfolio_main_page']).'</a>';
              

            $blog_query = new WP_Query(array(
                'post_type'  => 'page',  /* overrides default 'post' */
                'meta_key'   => '_wp_page_template',
                'meta_value' => 'tpl_blog.php',
                'post_status' =>'publish'
            ));

             while( $blog_query->have_posts() ) : $blog_query->the_post();
                  $blog_bread = '<a href="'.get_permalink().'">'.get_the_title().'</a>';

             endwhile;
             wp_reset_query();             

            $markup = $this->options['before'].$this->options['delimiter'].$this->options['after'];
            if (is_page()){
                if($der_post->post_parent) {
                    $my_query = get_post($der_post->post_parent);
                    $this->simple_breadcrumb_case($my_query);
                    $link = '<a href="';
                    $link .= get_permalink($my_query->ID);
                    $link .= '">';
                    $link .= ''. get_the_title($my_query->ID) . '</a>'. $markup;
                    echo $link;
                }
                return;
            }

            if(is_single())
            {
                $category = get_the_category();
                if (is_attachment()){

                    $my_query = get_post($der_post->post_parent);
                    $category = get_the_category($my_query->ID);

                    if(isset($category[0]))
                    {
                        $ID = $category[0]->cat_ID;
                        $parents = get_category_parents($ID, TRUE, $markup, FALSE );
                        if(!is_object($parents)) echo $parents;
                        previous_post_link("%link $markup");
                    }

                }else{

                    $postType = get_post_type();

                    if($postType == 'post')
                    {
                        $ID = $category[0]->cat_ID;
                        echo $blog_bread. $markup .get_category_parents($ID, TRUE, $markup, FALSE );
                    }
                    else if($postType == 'portfolio')
                    {



                        $terms = get_the_term_list( $post->ID, 'portfolio-category', '', '$$$', '' );
                        $terms = explode('$$$',$terms);
                        $term_s = "";
                        $terms_count = count($terms);
                        if($terms_count > 1){
                            for($i=0;$i<$terms_count;$i++){
                                $term_s .= ($i==$terms_count-1)? $terms[$i] : $terms[$i] .", ";

                            }
                            echo $portfolio_bread.$markup.$term_s.$markup;

                        } else {
                            echo $portfolio_bread.$markup.$terms[0].$markup;
                        }

                    }
                }
                return;
            }

            if(is_tax()){
                $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
                return $portfolio_bread.$markup.$term->name;

            }


            if(is_category()){
                $category = get_the_category();
                $i = $category[0]->cat_ID;
                $parent = $category[0]-> category_parent;

                if($parent > 0 && $category[0]->cat_name == single_cat_title("", false)){
                    echo get_category_parents($parent, TRUE, $markup, FALSE);
                }
                return $blog_bread . $markup . single_cat_title('',FALSE);
            }


            if(is_author()){
                //$curauth = get_userdatabylogin(get_query_var('author_name'));
                return "Author: ".get_the_author();
            }
            if(is_tag()){ return "Tag: ".single_tag_title('',FALSE); }

            if(is_404()){ return _e("404 - Page not Found",'highthemes'); }

            if(is_search()){ return _e("Search",'highthemes');}

            if(is_year()){ return get_the_time('Y'); }

            if(is_month()){
                $k_year = get_the_time('Y');
                echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
                return get_the_time('F'); }

            if(is_day() || is_time()){
                $k_year = get_the_time('Y');
                $k_month = get_the_time('m');
                $k_month_display = get_the_time('F');
                echo "<a href='".get_year_link($k_year)."'>".$k_year."</a>".$markup;
                echo "<a href='".get_month_link($k_year, $k_month)."'>".$k_month_display."</a>".$markup;

                return get_the_time('jS (l)'); }

        }

    }
}



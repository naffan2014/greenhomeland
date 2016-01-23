<?php 
global $data;

// portfolio layout
$ht_portfolio_layout = get_post_meta( get_the_ID(), '_portfolio_layout', true );

// declare the needed vars
$excerpt_length      = '';
$thumbnail_size      = '';
$grid_class          = '';
$wrapper_class       = '';

// if portfolio 1 column
if( '1c' == $ht_portfolio_layout ) {
    $excerpt_length = 350;
    $thumbnail_size = 'ht-large-thumb';
    $grid_class     ='';
    $wrapper_class  = 'filterable-1c';
   
// if portfolio 2 column
} elseif( '2c' == $ht_portfolio_layout ) {
    $excerpt_length = 200;
    $thumbnail_size = 'ht-folio1';
    $grid_class     = 'one_half';
    $wrapper_class  = 'filterable-2c';

// if portfolio 3 column  
} elseif( '3c' == $ht_portfolio_layout ) {
    $excerpt_length = 150;
    $thumbnail_size = 'ht-folio1';
    $grid_class     = 'one_third';
    $wrapper_class  = 'filterable-3c';
    
// if portfolio 4 column
} elseif( '4c' == $ht_portfolio_layout  ) {
    $excerpt_length = 0;
    $thumbnail_size = 'ht-folio1';
    $grid_class     = 'one_fourth';
    $wrapper_class  = 'filterable-4c';
    
}

// hide categories
$ht_hide_folio_cats = ( $data['hide_folio_cats'] == '1' ) ? true : false;

// portfolio category
$ht_portfolio_category =   get_post_meta( get_the_ID(), '_portfolio_category', true );

// disable lightbox on this page
$ht_disable_lightbox   =   get_post_meta( get_the_ID(), '_disable_lightbox', true );

// page title
$override_title        =   get_post_meta( get_the_ID(), '_override_title', true );
$teaser                =   ! empty( $override_title ) ? $override_title : get_the_title();

// full screen bg
embed_fullscreen_bg();
?>
<div id="wrap" class="clearfix no-sidebar <?php echo $wrapper_class;?>">
    <div id="main" class="portfolio">
        <div id="entries">
            <h2 class="page-title"><?php echo $teaser;?>
                <i class="entries-toggle arrow-toggle"></i>
                <?php if ( $data['breadcrumb_inner'] ) { ?>
                <div id="breadcrumb">
                <?php
                if (class_exists('simple_breadcrumb')) {
                    $bc = new simple_breadcrumb;
                }
                ?>
                </div>
                <?php } ?>
            </h2>
            <div id="entries-box">
            <?php
            while ( have_posts() ) :the_post();
                if ( get_the_content() != '' ):
                ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                    <div class="entry">
                        <?php the_content();?>
                        <div class="fix"></div>
                        <?php wp_link_pages();?>
                    </div>
                </div>
                <?php
                endif;
            endwhile;

            // if the page is password protected

            if( ! post_password_required() ) {

            // set the number of posts per page
            $posts_per_page = -1;
            $paged          = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

            // build the query
            $args = array(
                'paged'	 			    => $paged,
                'posts_per_page'        => $posts_per_page,
                'post_type'			    => 'portfolio',
                'order_by'			    => 'date',
                'tax_query' => array(
                    array('taxonomy'  => 'portfolio-category',
                          'field'     => 'slug',
                          'terms'     => $ht_portfolio_category
                    )
                )
            );
            
            $temp     = $wp_query;
            $wp_query = new WP_Query($args);

            if ( $wp_query->have_posts() ) :

                if( is_array( $ht_portfolio_category ) ) {

                    foreach( $ht_portfolio_category as $index=>$value ){
                        $term_details       = get_term_by( 'slug', $value, 'portfolio-category');
                        if( ! $term_details) continue;                       
                        $term_array[$value] = $term_details->name;
                    }
                }

                ?>
                <div id="filters" class="filters">
                    <ul>
                    <?php
                    if( count( $term_array ) > 0 ) {
                        $n=1;
                        foreach( $term_array as $term_slug=>$term_name ) { ?>
                        <li>
                            <a href="#filter=.<?php echo $term_slug;?>" data-filter=".<?php echo $term_slug;?>" title=""><?php echo $term_name;?></a>
                        </li>
                        <?php 
                            $n++;
                        } #foreach
                    } #if
                    ?>
                        <li>
                            <a href="#" data-filter="*" class="allcats"><?php _e("All Categories", "highthemes");?></a>
                        </li>
                    </ul>
                </div><!-- ./filters -->
                <div class="entry">
                    <div id="portfolio" class="filterable" >
                <?php
                $i=1;
                $terms_name = "";
                while( $wp_query->have_posts() ) : $wp_query->the_post();

                    // build spaced terms list
                    $terms = get_the_terms( get_the_ID(), 'portfolio-category' );
                    foreach( $terms as $term=>$value ) {
                        $terms_name .= " ".$value->slug . " ";
                    }
                    $filter_list = $terms_name;
                    $terms_name  = "";
                    
                    $video_link  = get_post_meta( get_the_ID(), '_video_link', true);


                    // featured image
                    $thumb         =    wp_get_attachment_image_src( get_post_thumbnail_id(), $thumbnail_size ); 
                    $image_url     =    wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
                    $image_url     =    $image_url[0];

                    // slider images
                    $slider_images     =    get_post_meta( get_the_ID(), '_slider_image', true );
                    $post_images       =    array();
                    $post_large_images =    array();
                    if( is_array($slider_images) ) {
                        foreach ( $slider_images as $slider_image ) {
                            $post_images[]       = wp_get_attachment_image_src( $slider_image , $thumbnail_size);
                            $post_large_images[] = wp_get_attachment_image_src( $slider_image , 'full');
                            $the_alts[]          =    get_post_meta($slider_image, '_wp_attachment_image_alt', true);

                        }
                    }    

                    // set status of video/image
                    if( ! empty( $video_link ) ) {
                        $video_status = 'video';
                        $image_url = $video_link;
                    } else {
                        $video_status = 'zoom';
                    }
                    $uniqid = uniqid();

                    $lightbox_status = '';
                    
                    $custom_url       =  get_post_meta( get_the_ID(), '_custom_url', true );
                    $custom_url_point =  get_post_meta( get_the_ID(), '_custom_url_point', true );

                    if( !empty($custom_url) && ( $custom_url_point == 'ex_thumb' || $custom_url_point == 'ex_both' ) ) {
                        $lightbox_status = 'href="'. $custom_url .'"';
                    } else {
                        if( $ht_disable_lightbox ) {
                            $lightbox_status = 'href="'. get_permalink() .'"';
                        } else if( count( $post_images ) > 0 ) {
                            $lightbox_status = 'rel="prettyPhoto[gallery-'.$uniqid.']" href="' . $image_url .'"';
                        } else {
                            $lightbox_status = 'rel="prettyPhoto" href="' . $image_url .'"';
                        }                        
                    }

                    ?>

                    <div id="post-<?php the_ID();?>" class="<?php echo $grid_class;?> folio-box clearfix <?php echo $filter_list;?>">
                    <?php 
                    if( count( $post_images ) > 0 ) { 
                    ?>
                        <div class="flexslider portfolio-item-slideshow">
                            <ul class="slides">
                                <li>
                                    <div class="frame">
                                        <a <?php echo $lightbox_status;?> title="<?php the_title();?>">
                                            <img src="<?php echo $thumb[0];?>" alt="<?php the_title_attribute();?>" />
                                            <i class="fa <?php echo $video_status;?>"></i>
                                        </a>
                                    </div>
                                </li> 
                                <?php 
                                for( $z=0; $z < count( $post_images ); $z++ ) {

                                    if( $z == 0 && ! empty( $video_link ) ) {
                                        $post_large_images[$z] = $video_link; 
                                        $video_status='video';
                                    } else {
                                        $video_status = 'zoom';
                                    }
                                    $lightbox_status = ( $ht_disable_lightbox ) ? 'href="'. get_permalink() .'"' : 'rel="prettyPhoto[gallery-'.$uniqid.']" href="' . $post_large_images[$z][0] .'"';                                    
                                ?>                                
                                <li>
                                    <div class="frame">
                                        <a <?php echo $lightbox_status;?> title="<?php echo $the_alts[$z]?>">
                                            <img alt="<?php echo $the_alts[$z]?>" src="<?php echo $post_images[$z][0];?>" />
                                            <i class="fa <?php echo $video_status;?>"></i>
                                        </a>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>

                    <?php } else {?>
                        <div class="frame">
                            <a title="<?php the_title();?>" <?php echo $lightbox_status;?>>
                                <img alt="<?php the_title_attribute();?>" src="<?php echo esc_attr($thumb[0]);?>">
                                <i class="fa <?php echo $video_status;?>"></i>
                            </a>
                        </div>
                    <?php }?>
                        <div class="portfolio-info">
                            <h3 class="folio-title">
                                <?php if( !empty($custom_url) && ( $custom_url_point == 'ex_title' || $custom_url_point == 'ex_both' ) ) { ?>
                                <a title="<?php the_title();?>" href="<?php echo $custom_url; ?>"><?php the_title();?></a>
                                <?php } else { ?>
                                <a title="<?php the_title();?>" href="<?php the_permalink();?>"><?php the_title();?></a>
                                <?php } ?>
                            </h3>
                            <?php if( !$ht_hide_folio_cats ) { ?>
                            <div class="folio-cats">
                            <?php
                            $z = 1;
                            foreach($terms as $term=>$value){
                                $term_link =  get_term_link($value->slug, 'portfolio-category');
                                $term_name =  $value->name;
                                echo '<a href="'.$term_link.'" >'.$term_name.'</a>';
                                if( count($terms)!=$z ){
                                    echo  ", ";
                                }
                                $z++;
                            }
                            ?>
                            </div>
                            <?php } ?>
                            <?php if( '4c' != $ht_portfolio_layout ) { ?>
                            <p>
                                <?php echo ht_excerpt($excerpt_length, '...');?>
                            </p>
                            <?php }?>

                        </div>
                    </div>
                    <?php
                    $i++;
                endwhile;?>
                <?php else: ?>
                <div class="post-item ">
                    <div class="info-box-wrapper">
                        <div class="info-box-orange-header info-box-warning">
                            <div class="info-content-box-icon"><?php _e("There's no post here yet!",'highthemes'); ?></div>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            <?php
            $wp_query = null; $wp_query = $temp;
            wp_reset_query();
            ?>
                </div><!--#portfolio-->
            </div><!--.entry-->

        <?php }  // password protected check ?>
        </div><!-- .entries-box -->
    </div><!-- .entries-->
    </div><!-- .main -->
</div><!-- .wrap -->
<?php get_footer();?>
<?php 
global $data;

get_header();


if( is_tax() ) {
    global $wp_query;
    $term   = $wp_query->get_queried_object();
    $teaser = $term->name;
}

// portfolio layout
$ht_portfolio_layout = '3c';

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

// get col number
$col_number = substr($ht_portfolio_layout, 0, 1);

// disable lightbox on this page
$ht_disable_lightbox = ( $data['disable_lightbox_folio_archive'] == '1' ) ? true : false;

// hide categories
$ht_hide_folio_cats = ( $data['hide_folio_cats'] == '1' ) ? true : false;

// full screen bg
embed_fullscreen_bg(1);
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
            if ( have_posts() ) :
            ?>
            <div id="portfolio" >
                <div class="entry">
                <?php
                $i=1;
                $terms_name = "";
                

                while( have_posts() ) : the_post();

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
                    $slider_images =    get_post_meta( get_the_ID(), '_slider_image', true );
                    $post_images       =    array();
                    $post_large_images =    array();                    

                    if( is_array($slider_images) ) {
                        foreach ( $slider_images as $slider_image ) {
                            $post_images[]       = wp_get_attachment_image_src( $slider_image , $thumbnail_size);
                            $post_large_images[] = wp_get_attachment_image_src( $slider_image , 'full');
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

                    $custom_url       =  get_post_meta( get_the_ID(), '_custom_url', true );
                    $custom_url_point =  get_post_meta( get_the_ID(), '_custom_url_point', true );                    

                    $lightbox_status = '';

                    if( !empty($custom_url) && ( $custom_url_point == 'ex_thumb' || $custom_url_point == 'ex_both' ) ) {
                        $lightbox_status = 'href="'. $custom_url .'"';
                    } else {                    
                        if($ht_disable_lightbox){
                            $lightbox_status = 'href="'. get_permalink() .'"';
                        } else {
                            $lightbox_status = 'rel="prettyPhoto[gallery-'.$uniqid.']" href="' . $image_url .'"';
                        }
                    }
                    ?>

                    <div id="post-<?php the_ID();?>" class="<?php echo $grid_class;?> folio-box clearfix <?php if(($i%$col_number)==0 && $i<>0){ echo "last"; } ?>">
                    <?php 
                    if( count( $post_images ) > 0 ) { 
                    ?>
                        <div class="flexslider portfolio-item-slideshow">
                            <ul class="slides">
                                <li>
                                    <div class="frame">
                                        <a <?php echo $lightbox_status;?> title="<?php the_title();?>">
                                            <img src="<?php echo $thumb[0];?>" alt="<?php the_title_attribute();?>" />
                                            <span class="<?php echo $video_status;?>"></span>
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
                                        <a <?php echo $lightbox_status;?> title="<?php the_title();?>">
                                            <img src="<?php echo $post_images[$z][0];?>" alt="<?php the_title_attribute();?>" />
                                            <span class="<?php echo $video_status;?>"></span>
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
                                <span class="<?php echo $video_status;?>"></span>
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
                    <?php if( ( $i % $col_number ) == 0 && $i != 0 ){ echo '<div class="fix"></div>'; } ?>
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
               <div class="navi">
                <?php 
                if( ! empty ( $data['pagenavi_status'] ) ) {
                    wp_pagenavi();
                } else {
                ?>
                <div class="prev fl"><?php previous_posts_link('&larr; ' . __('Previous','highthemes'),''); ?></div>
                <div class="next fr"><?php next_posts_link( __('Next','highthemes') . ' &rarr;' ,'' ); ?> </div>    
                <?php } ?>
            </div>                
            <?php
            $wp_query = null; $wp_query = $temp;
            wp_reset_query();
            ?>
        </div><!--.entry-->
        </div><!--#portfolio-->
        </div><!-- .entries-box -->
    </div><!-- .entries-->
    </div><!-- .main -->
</div><!-- .wrap -->
<?php get_footer();?>
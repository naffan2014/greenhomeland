<?php
/**
 *
 * HighThemes Options Framework
 * twitter : http://twitter.com/theHighthemes
 *
 */


/**
 * HighThemes Recent Posts Widget
 */

class HT_Recent_Posts extends WP_Widget {
	
	function HT_Recent_Posts() {
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_recent_posts',
							'description' => __( 'The most recent posts with thumbnails','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Recent_Posts',"Highthemes -  " . __('Recent Posts','highthemes'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		global $wpdb;
		extract($args);
		
		$exclude_blog_cats = preg_replace('!(\d)+!','-${0}$0', get_option('ht_excluded_cats'));
		$posts_number  = (int) $instance['posts_number'];
		$posts = get_posts("post_type=post&cat=$exclude_blog_cats&numberposts=$posts_number&offset=0");

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts','highthemes') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		

		if($posts){ ?>
        

		<ul class="thumb-list">
		<?php
        $post_format = '';
        foreach($posts as $post){

            $post_title = stripslashes($post->post_title);
            $post_date = $post->post_date;
            $post_date = mysql2date('F j, Y', $post_date, false);
            $permalink = get_permalink($post->ID);

            if ( post_type_supports( $post->post_type, 'post-formats' ) ){
                $_format = get_the_terms( $post->ID, 'post_format' );
                if ( !empty( $_format ) ){
                    $format = array_shift( $_format );
                    $post_format = str_replace('post-format-', '', $format->slug );
                }
            }
            $thumb_url = '';
            if(has_post_thumbnail($post->ID)){
				$image_details = ht_get_featured_image_url($post->ID,'', 'small-thumb');
				$thumb_url     = $image_details['url'];
				$image_id      = $image_details['id'];
        	}
            
            if(!$thumb_url) {

                $thumb_url = get_template_directory_uri() .'/images/empty_thumb.png';
            }
            switch ($post_format) {
                case 'video':
                    $thumb_url =  get_template_directory_uri() .'/images/video_thumb.png';;
                    break;
                case 'link':
                    $thumb_url =  get_template_directory_uri() .'/images/link_thumb.png';;
                    break;
                case 'quote':
                    $thumb_url =  get_template_directory_uri() .'/images/quote_thumb.png';;
                    break;
                case 'audio':
                    $thumb_url =  get_template_directory_uri() .'/images/audio_thumb.png';;
                    break;
            }



            ?>
		<li>
            <a class="fl" href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>">
                <img class="frame" src="<?php echo $thumb_url;?>" alt="<?php echo $post_title;?>" />
            </a>
            <div class="thumb-details">
                <a class="thumb-title" href="<?php echo $permalink; ?>" rel="bookmark"><?php echo $post_title; ?></a>
		        <span class="date"><?php echo $post_date; ?></span>
            </div>
        </li>

		<?php $post_format = ''; }?>
        </ul>
        <?php
            }
		echo $after_widget;
		
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		// replace old with new
		$instance['posts_number'] = (int) strip_tags($new_instance['posts_number']);
		$instance['title'] =  strip_tags($new_instance['title']);
		$instance['style'] =  $new_instance['style'];
		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'posts_number' => 3, 'title'=> __('Recent Posts','highthemes'), 'style' =>'' ) );
	$posts_number = (int) strip_tags($instance['posts_number']);
	$title =  strip_tags($instance['title']);
	$style = $instance['style'];
	// print the form fields
?>
	
	<p><label for="<?php echo $this->get_field_id('title'); ?>">
	<?php _e('Title:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo
		esc_attr($title); ?>" /></p>    
        
    <p><label for="<?php echo $this->get_field_id('posts_number'); ?>">
	<?php _e('Number of Posts:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('posts_number'); ?>" name="<?php echo $this->get_field_name('posts_number'); ?>" type="text" value="<?php echo
		esc_attr($posts_number); ?>" /></p>

	<?php
	}
	}

/**
 * HighThemes  ads
 */

class HT_Ad_Widget extends WP_Widget {
	
	function HT_Ad_Widget() {
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_ad_widget',
							'description' => __( 'Displays 6 ads blocks','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Ad_Widget',"Highthemes -  " . __('Custom Ads','highthemes'), $widget_ops);

	}
	// display the widget in the theme
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$ad1 = $instance['ad1'];
		$ad2 = $instance['ad2'];
		$ad3 = $instance['ad3'];
		$ad4 = $instance['ad4'];
		$ad5 = $instance['ad5'];
		$ad6 = $instance['ad6'];
		$link1 = $instance['link1'];
		$link2 = $instance['link2'];
		$link3 = $instance['link3'];
		$link4 = $instance['link4'];
		$link5 = $instance['link5'];
		$link6 = $instance['link6'];
		$randomize = $instance['random'];

		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;

		//Randomize ads order in a new array
		$ads = array();

        /* Display a containing div */
        echo '<div class="ads-banner clearfix">';
        echo '<ul>';

		/* Display Ad 1. */
		if ( $link1 )
			$ads[] = '<li><a href="' . $link1 . '"><img src="' . $ad1 . '"  alt="" /></a></li>';
			
		elseif ( $ad1 )
		 	$ads[] = '<li><img src="' . $ad1 . '" alt="" /></li>';
		
		/* Display Ad 2. */
		if ( $link2 )
			$ads[] = '<li><a href="' . $link2 . '"><img src="' . $ad2 . '"  alt="" /></a></li>';
			
		elseif ( $ad2 )
		 	$ads[] = '<li><img src="' . $ad2 . '"  alt="" /></li>';
			
		/* Display Ad 3. */
		if ( $link3 )
			$ads[] = '<li><a href="' . $link3 . '"><img src="' . $ad3 . '"  alt="" /></a></li>';
			
		elseif ( $ad3 )
		 	echo '<li><img src="' . $ad3 . '"  alt="" /></li>';
			
		/* Display Ad 4. */
		if ( $link4 )
			$ads[] = '<li><a href="' . $link4 . '"><img src="' . $ad4 . '"  alt="" /></a></li>';
			
		elseif ( $ad4 )
		 	$ads[] = '<li><img src="' . $ad4 . '"  alt="" /></li>';
			
		/* Display Ad 5. */
		if ( $link5 )
			$ads[] = '<li><a href="' . $link5 . '"><img src="' . $ad5 . '"  alt="" /></a></li>';
			
		elseif ( $ad5 )
		 	$ads[] = '<li><img src="' . $ad5 . '"  alt="" /></li>';
			
		/* Display Ad 6. */
		if ( $link6 )
			$ads[] = '<li><a href="' . $link6 . '"><img src="' . $ad6 . '"  alt="" /></a></li>';
			
		elseif ( $ad6 )
		 	$ads[] = '<li><img src="' . $ad6 . '"  alt="" /></li>';
		
		//Randomize order if user want it
		if ($randomize){
			shuffle($ads);
		}
		
		//Display ads
		foreach($ads as $ad){
			echo $ad;
		}
		
		echo '</ul>';
		echo '</div>';

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );

		/* No need to strip tags */
		$instance['ad1'] = $new_instance['ad1'];
		$instance['ad2'] = $new_instance['ad2'];
		$instance['ad3'] = $new_instance['ad3'];
		$instance['ad4'] = $new_instance['ad4'];
		$instance['ad5'] = $new_instance['ad5'];
		$instance['ad6'] = $new_instance['ad6'];
		$instance['link1'] = $new_instance['link1'];
		$instance['link2'] = $new_instance['link2'];
		$instance['link3'] = $new_instance['link3'];
		$instance['link4'] = $new_instance['link4'];
		$instance['link5'] = $new_instance['link5'];
		$instance['link6'] = $new_instance['link6'];
		$instance['random'] = $new_instance['random'];
		
		return $instance;
	}
		
	function form( $instance ) {
	
		/* Set up some default widget settings. */
		$defaults = array(
		'title' => 'Advertisement',
		'ad1' => get_template_directory_uri()."/images/banner-ads.jpg",
		'link1' => 'http://www.highthemes.com',
		'ad2' => get_template_directory_uri()."/images/banner-ads.jpg",
		'link2' => 'http://www.highthemes.com',
		'ad3' => '',
		'link3' => '',
		'ad4' => '',
		'link4' => '',
		'ad5' => '',
		'link5' => '',
		'ad6' => '',
		'link6' => '',
		'random' => false
		);
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'ad1' ); ?>"><?php _e('Ad 1 image url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad1' ); ?>" name="<?php echo $this->get_field_name( 'ad1' ); ?>" value="<?php echo $instance['ad1']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link1' ); ?>"><?php _e('Ad 1 link url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link1' ); ?>" name="<?php echo $this->get_field_name( 'link1' ); ?>" value="<?php echo $instance['link1']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad2' ); ?>"><?php _e('Ad 2 image url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad2' ); ?>" name="<?php echo $this->get_field_name( 'ad2' ); ?>" value="<?php echo $instance['ad2']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link2' ); ?>"><?php _e('Ad 2 link url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link2' ); ?>" name="<?php echo $this->get_field_name( 'link2' ); ?>" value="<?php echo $instance['link2']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad3' ); ?>"><?php _e('Ad 3 image url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad3' ); ?>" name="<?php echo $this->get_field_name( 'ad3' ); ?>" value="<?php echo $instance['ad3']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link3' ); ?>"><?php _e('Ad 3 link url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link3' ); ?>" name="<?php echo $this->get_field_name( 'link3' ); ?>" value="<?php echo $instance['link3']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad4' ); ?>"><?php _e('Ad 4 image url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad4' ); ?>" name="<?php echo $this->get_field_name( 'ad4' ); ?>" value="<?php echo $instance['ad4']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link4' ); ?>"><?php _e('Ad 4 link url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link4' ); ?>" name="<?php echo $this->get_field_name( 'link4' ); ?>" value="<?php echo $instance['link4']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad5' ); ?>"><?php _e('Ad 5 image url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad5' ); ?>" name="<?php echo $this->get_field_name( 'ad5' ); ?>" value="<?php echo $instance['ad5']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link5' ); ?>"><?php _e('Ad 5 link url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link5' ); ?>" name="<?php echo $this->get_field_name( 'link5' ); ?>" value="<?php echo $instance['link5']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'ad6' ); ?>"><?php _e('Ad 6 image url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'ad6' ); ?>" name="<?php echo $this->get_field_name( 'ad6' ); ?>" value="<?php echo $instance['ad6']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'link6' ); ?>"><?php _e('Ad 6 link url:','highthemes') ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'link6' ); ?>" name="<?php echo $this->get_field_name( 'link6' ); ?>" value="<?php echo $instance['link6']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id( 'random' ); ?>"><?php _e('Randomize ads order?','highthemes') ?></label>
			<?php if ($instance['random']){ ?>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'random' ); ?>" name="<?php echo $this->get_field_name( 'random' ); ?>" checked="checked" />
			<?php } else { ?>
				<input type="checkbox" id="<?php echo $this->get_field_id( 'random' ); ?>" name="<?php echo $this->get_field_name( 'random' ); ?>"  />
			<?php } ?>
		</p>
	<?php
	}
}


/**
 * HighThemes Popular Posts
 */

class HT_Popular_Posts extends WP_Widget {
	
	function HT_Popular_Posts() {
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_popular_posts',
							'description' => __( 'The most popular posts with thumbnails','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Popular_Posts',"Highthemes -  " . __('Popular Posts','highthemes'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		global $wpdb;
		extract($args);
		
	$pop_posts =  (int) strip_tags($instance['posts_number']);
	
	if (empty($pop_posts) || $pop_posts < 1) $pop_posts = 3;
	$now = gmdate("Y-m-d H:i:s",time());
	$lastmonth = gmdate("Y-m-d H:i:s",gmmktime(date("H"), date("i"), date("s"), date("m")-12,date("d"),date("Y")));
	$popularposts = "SELECT ID, post_title,post_type,  post_date, COUNT($wpdb->comments.comment_post_ID) AS
					'stammy' FROM $wpdb->posts, $wpdb->comments WHERE comment_approved = '1' AND post_type='post'
					AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status = 'publish'  
					AND comment_status = 'open' GROUP BY $wpdb->comments.comment_post_ID ORDER BY stammy DESC LIMIT ".$pop_posts;
	
	$posts = $wpdb->get_results($popularposts);
	$popular = '';
		
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Popular Posts','highthemes') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;
		

		if($posts){ ?>
		<ul class="thumb-list">
		<?php
            $post_format = '';
            foreach($posts as $post){

                $post_title = stripslashes($post->post_title);
                $post_date = $post->post_date;
                $post_date = mysql2date('F j, Y', $post_date, false);
                $permalink = get_permalink($post->ID);

                if ( post_type_supports( $post->post_type, 'post-formats' ) ){
                    $_format = get_the_terms( $post->ID, 'post_format' );
                    if ( !empty( $_format ) ){
                        $format = array_shift( $_format );
                        $post_format = str_replace('post-format-', '', $format->slug );
                    }
                }
                $thumb_url = '';
            	if(has_post_thumbnail($post->ID)){
					$image_details = ht_get_featured_image_url($post->ID,'', 'small-thumb');
					$thumb_url     = $image_details['url'];
					$image_id      = $image_details['id'];

        		}
 
	            
                if(!$thumb_url) {
                    $thumb_url = get_template_directory_uri() .'/images/empty_thumb.png';
                }
                switch ($post_format) {
                    case 'video':
                        $thumb_url =  get_template_directory_uri() .'/images/video_thumb.png';;
                        break;
                    case 'link':
                        $thumb_url =  get_template_directory_uri() .'/images/link_thumb.png';;
                        break;
                    case 'quote':
                        $thumb_url =  get_template_directory_uri() .'/images/quote_thumb.png';;
                        break;
                    case 'audio':
                        $thumb_url =  get_template_directory_uri() .'/images/audio_thumb.png';;
                        break;
                }
		?>
            <li>
                <a class="fl" href="<?php echo $permalink; ?>" title="<?php echo $post_title; ?>">
                    <img class="frame" src="<?php echo $thumb_url;?>" alt="<?php echo $post_title;?>" />
                </a>
                <div class="thumb-details">
                    <a class="thumb-title" href="<?php echo $permalink; ?>" rel="bookmark"><?php echo $post_title; ?></a>
                    <span class="date"><?php echo $post_date; ?></span>
                </div>
            </li>
                <?php $post_format = ''; }?>
		</ul>
		<?php }
		echo $after_widget;
		
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		// replace old with new
		$instance['posts_number'] = (int) strip_tags($new_instance['posts_number']);
		$instance['title'] =  strip_tags($new_instance['title']);
		
		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'posts_number' => 3, 'title' => __('Popular Posts','highthemes') ) );
	$posts_number = (int) strip_tags($instance['posts_number']);
	$title =  strip_tags($instance['title']);
	
	// print the form fields
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>">
	<?php _e('Title: ','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo
		esc_attr($title); ?>" /></p>
        
	<p><label for="<?php echo $this->get_field_id('posts_number'); ?>">
	<?php _e('Number of Posts:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('posts_number'); ?>" name="<?php echo $this->get_field_name('posts_number'); ?>" type="text" value="<?php echo
		esc_attr($posts_number); ?>" /></p>
	<?php
	}
	}	

/**
 * HighThemes Recent Tweets
 */


class HT_Recent_Tweets extends WP_Widget {
	
	function HT_Recent_Tweets() {
		
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_recent_tweets',
							'description' => __( 'Recent tweets','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Recent_Tweets',"Highthemes -  " . __('Recent Tweets','highthemes'), $widget_ops);
	
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$consumer_key = $instance['consumer_key'];
		$consumer_secret = $instance['consumer_secret'];
		$access_token = $instance['access_token'];
		$access_token_secret = $instance['access_token_secret'];
		$twitter_id = $instance['twitter_id'];
		$count = $instance['count'];

		echo $before_widget;

		if($title) {
			echo $before_title.$title.$after_title;
		}
		
		if($twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) { 
		require_once 'twitteroauth/twitteroauth.php';
		$transName = 'list_tweets';
		$cacheTime = 10;
		if(false === ($twitterData = get_transient($transName))) {
		     // require the twitter auth class
		     require_once 'twitteroauth/twitteroauth.php';
		     $twitterConnection = new TwitterOAuth(
							$consumer_key,	// Consumer Key
							$consumer_secret,   	// Consumer secret
							$access_token,       // Access token
							$access_token_secret    	// Access token secret
							);
		     $twitterData = $twitterConnection->get(
							  'statuses/user_timeline',
							  array(
							    'screen_name'     => $twitter_id,
							    'count'           => $count,
							    'exclude_replies' => false
							  )
							);
		     if($twitterConnection->http_code != 200)
		     {
		          $twitterData = get_transient($transName);
		     }
		     // Save our new transient.
		     set_transient($transName, $twitterData, 60 * $cacheTime);
		}
		$twitter = get_transient($transName);
		if($twitter && is_array($twitter)) {
		?>
			<div class="recent-tweets" id="tweets_<?php echo $args['widget_id']; ?>">
						<ul>
							<?php foreach($twitter as $tweet): ?>
							<li class="jtwt_tweet">
								<i class="fa fa-twitter"></i>
								<p class="jtwt_tweet_text">
								<?php
								$latestTweet = $tweet->text;
								$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $latestTweet);
								$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '<a href="http://twitter.com/$1" target="_blank">@$1</a>', $latestTweet);
								echo $latestTweet;
								?>
								</p>
								<?php
								$twitterTime = strtotime($tweet->created_at);
								$timeAgo = $this->ago($twitterTime);
								?>
								<span class="twitterTime"><a href="http://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" class="jtwt_date"><?php echo $timeAgo; ?></a></span>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
		<?php }}
		
		echo $after_widget;
	}
	
	function ago($time)
	{
	   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	   $lengths = array("60","60","24","7","4.35","12","10");

	   $now = time();

	       $difference     = $now - $time;
	       $tense         = "ago";

	   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	       $difference /= $lengths[$j];
	   }

	   $difference = round($difference);

	   if($difference != 1) {
	       $periods[$j].= "s";
	   }

	   return "$difference $periods[$j] ago ";
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['consumer_key'] = $new_instance['consumer_key'];
		$instance['consumer_secret'] = $new_instance['consumer_secret'];
		$instance['access_token'] = $new_instance['access_token'];
		$instance['access_token_secret'] = $new_instance['access_token_secret'];
		$instance['twitter_id'] = $new_instance['twitter_id'];
		$instance['count'] = $new_instance['count'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Tweets', 'twitter_id' => '', 'count' => 3);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		
		<p><a href="http://dev.twitter.com/apps">Find or Create your Twitter App</a></p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('consumer_key'); ?>">Consumer Key:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" value="<?php echo $instance['consumer_key']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('consumer_secret'); ?>">Consumer Secret:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" value="<?php echo $instance['consumer_secret']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('access_token'); ?>">Access Token:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" value="<?php echo $instance['access_token']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('access_token_secret'); ?>">Access Token Secret:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" value="<?php echo $instance['access_token_secret']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_id'); ?>">Twitter ID:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" />
		</p>

			<label for="<?php echo $this->get_field_id('count'); ?>">Number of Tweets:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" />
		</p>

	<?php
	}

	}

/**
 * Highthemes Sub Navigation
 */

class HT_Sub_Navigatioin extends WP_Widget {
	
	function HT_Sub_Navigatioin() {
		
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_sub_navigation',
							'description' => __( 'Showing subpages on sidebar','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Sub_Navigatioin',"Highthemes -  " . __('Sub Pages','highthemes'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		global $wpdb, $post;
		extract($args);
		
	 	if ( !is_page() ) return false;

    	if ($post->post_parent != 0)
    	$parent = get_post($post->post_parent);
    	else
    	$parent = false;
	  
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Sub Pages','highthemes') : $instance['title'], $instance, $this->id_base);

		echo $before_widget;
		
		if ( $title ) echo $before_title . $title . $after_title;


 		// Default Args for selecting sub pages
    	$page_args = array( 'title_li' => '',
                        'child_of' => $post->ID,
                        'depth'    => 1,
                        'echo'     => false );

      	// Read the subpages again
     	$page_listing = wp_list_pages($page_args);
	    //if ( !$page_listing ) return false;


        echo  '<ul>';
        echo $page_listing;
     	echo '</ul>';
		echo $after_widget;
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);

		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'title' => __('Sub Pages','highthemes') ) );
	$title = strip_tags($instance['title']);
	
	
	// print the form fields
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>">
	<?php _e('Title:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo
		esc_attr($title); ?>" /></p>
    

	<?php
	}
	}
	
	

/**
 * Highthemes Flickr
 */

class HT_Flickr extends WP_Widget {
	
	function HT_Flickr() {
		
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_flickr_widget',
							'description' => __( 'Pulls in images from your Flickr account.','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Flickr',"Highthemes -  " . __('Flickr','highthemes'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		extract($args);
		
	  	$number = (int) strip_tags($instance['number']);
	  	$id = strip_tags($instance['id']);
		
		echo $before_widget;
		

?>
<div class="flickr">
<h3 class="widget-title"><span><?php _e('Photos on Flickr ','highthemes'); ?></span></h3>
<div class="wrap">
<div class="fix"></div>
<script type="text/javascript"
	src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>
<div class="fix"></div>
</div>
</div>
<?php
		echo $after_widget;
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		$instance['number'] = (int) strip_tags($new_instance['number']);
		$instance['id'] = strip_tags($new_instance['id']);

		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'id' => '', 'number'=>6 ) );
	$id = strip_tags($instance['id']);
	$number = strip_tags($instance['number']);
	
	
	
	// print the form fields
?>
	<p><label for="<?php echo $this->get_field_id('id'); ?>">
	<?php _e('Flickr ID ','highthemes'); ?>(<a href="http://www.idgettr.com" target="_blank">idGettr</a>):</label>
	<input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo
		esc_attr($id); ?>" /></p>

	<p><label for="<?php echo $this->get_field_id('number'); ?>">
	<?php _e('Number:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo
		esc_attr($number); ?>" /></p>        
    

	<?php
	}
	}

/**
 * Highthemes Google Map
 */

class HT_Google_Map extends WP_Widget {

    function HT_Google_Map() {

        global  $theme_name;
        // define widget title and description
        $widget_ops = array('classname' => 'ht_google_map',
            'description' => __( 'Google Maps Widget','highthemes') );
        // register the widget
        $this->WP_Widget('HT_Google_Map',"Highthemes -  " . __('Google Map','highthemes'), $widget_ops);

    }

    // display the widget in the theme
    function widget( $args, $instance ) {
        extract($args);

        $instance['g_map_title'] = strip_tags(stripslashes($instance['g_map_title']));
        $instance['g_map_info_bubble'] = stripslashes($instance['g_map_info_bubble']);
        $instance['g_map_zoom'] = stripslashes($instance['g_map_zoom']);
        $instance['g_map_lat'] = stripslashes($instance['g_map_lat']);
        $instance['g_map_lng'] = stripslashes($instance['g_map_lng']);
        $instance['g_map_type'] = stripslashes($instance['g_map_type']);

        $title = apply_filters('widget_title', empty($instance['g_map_title']) ? __('Map','highthemes') : $instance['g_map_title'], $instance, $this->id_base);
		if(is_ssl()){
			$google_url = 'https://maps.google.com/maps/api/js?sensor=false';
		} else {
			$google_url = 'http://maps.google.com/maps/api/js?sensor=false';
		}
        echo $before_widget;

        $unique = uniqid();
echo <<<EOF
<script type="text/javascript" src="$google_url"></script>
<script>
var latlng=new google.maps.LatLng({$instance['g_map_lat']},{$instance['g_map_lng']});
function initialize()
{
var mapProp = {
center:latlng,
zoom:{$instance['g_map_zoom']},
mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
mapTypeControl: false,
streetViewControl: false,
scrollwheel: false, 
panControl: false,
mapTypeId:google.maps.MapTypeId.{$instance['g_map_type']}
};
var map=new google.maps.Map(document.getElementById("google_map_{$unique}"),mapProp);
var marker=new google.maps.Marker({
position:latlng,
map: map,
title: ''
});
marker.setMap(map);
var infowindow = new google.maps.InfoWindow({
content:"{$instance['g_map_info_bubble']}"
});
google.maps.event.addListener(marker, 'click', function() {
infowindow.open(map,marker);
});
}
google.maps.event.addDomListener(window, 'load', initialize);
</script>
<h3 class="widget-title"><span>{$title}</span></h3>
<div id="google_map_{$unique}" class="google-map"></div>
EOF;

        echo $after_widget;

        //end
    }

    // update the widget when new options have been entered
    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        $instance['g_map_title'] = strip_tags($new_instance['g_map_title']);
        $instance['g_map_info_bubble'] = $new_instance['g_map_info_bubble'];
        $instance['g_map_zoom'] = $new_instance['g_map_zoom'];
        $instance['g_map_lat'] = $new_instance['g_map_lat'];
        $instance['g_map_lng'] = $new_instance['g_map_lng'];
        $instance['g_map_type'] = $new_instance['g_map_type'];

        return $instance;
    }

    // print the widget option form on the widget management screen
    function form( $instance ) {

        // combine provided fields with defaults
        $instance = wp_parse_args( (array) $instance, array( 'g_map_title' => __('Google Map','highthemes') ));
        $g_map_title = $instance['g_map_title'];
        $g_map_info_bubble = $instance['g_map_info_bubble'];
        $g_map_zoom = $instance['g_map_zoom'];
        $g_map_lat = $instance['g_map_lat'];
        $g_map_lng = $instance['g_map_lng'];
        $g_map_type = $instance['g_map_type'];


        // print the form fields
        ?>

    <div class="google-map-details">
        <p><label for="<?php echo $this->get_field_id('g_map_title'); ?>">
            <?php _e('Title:','highthemes'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('g_map_title'); ?>" name="<?php echo $this->get_field_name('g_map_title'); ?>" type="text" value="<?php echo
            esc_attr($g_map_title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('g_map_zoom'); ?>">
            <?php _e('Zoom Level: (1-19)','highthemes'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('g_map_zoom'); ?>" name="<?php echo $this->get_field_name('g_map_zoom'); ?>" type="text" value="<?php echo
            esc_attr($g_map_zoom); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('g_map_lat'); ?>">
            <?php _e('Latitude:','highthemes'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('g_map_lat'); ?>" name="<?php echo $this->get_field_name('g_map_lat'); ?>" type="text" value="<?php echo
            esc_attr($g_map_lat); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('g_map_lng'); ?>">
            <?php _e('Longitude:','highthemes'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('g_map_lng'); ?>" name="<?php echo $this->get_field_name('g_map_lng'); ?>" type="text" value="<?php echo
            esc_attr($g_map_lng); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('g_map_type'); ?>">
            <?php _e('Map Type:','highthemes'); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name('g_map_type'); ?>" id="<?php echo $this->get_field_id('g_map_type'); ?>">
                <option <?php if($g_map_type == 'ROADMAP')echo 'selected="selected"' ; ?> value="ROADMAP"><?php _e("ROADMAP", "highthemes");?></option>
                <option <?php if($g_map_type == 'SATELLITE')echo 'selected="selected"' ; ?> value="SATELLITE"><?php _e("SATELLITE", "highthemes");?></option>
                <option <?php if($g_map_type == 'HYBRID')echo 'selected="selected"' ; ?> value="HYBRID"><?php _e("HYBRID", "highthemes");?></option>
                <option <?php if($g_map_type == 'TERRAIN')echo 'selected="selected"' ; ?> value="TERRAIN"><?php _e("TERRAIN", "highthemes");?></option>
            </select>
        </p>

        <p><label for="<?php echo $this->get_field_id('g_map_info_bubble'); ?>">
            <?php _e('Info Bubble Content:','highthemes'); ?></label>
            <textarea cols="36" rows="5" name="<?php echo $this->get_field_name('g_map_info_bubble'); ?>" id="<?php echo $this->get_field_id('g_map_info_bubble'); ?>"><?php echo
            esc_attr($g_map_info_bubble); ?></textarea>
        </p>


    </div>
    <?php
    }
}
/**
 * Highthemes Contact Details
 */

class HT_Contact_Details extends WP_Widget {
	
	function HT_Contact_Details() {
		
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_contact_details',
							'description' => __( 'Contact Details for Sidebar','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Contact_Details',"Highthemes -  " . __('Contact Details','highthemes'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		extract($args);
		
		
		$instance['contact_text'] = stripslashes($instance['contact_text']);
		$instance['contact_details'] = stripslashes($instance['contact_details']);
		$instance['contact_title'] = strip_tags(stripslashes($instance['contact_title']));

		$title = apply_filters('widget_title', empty($instance['contact_title']) ? __('Contact','highthemes') : $instance['contact_title'], $instance, $this->id_base);
		
		echo $before_widget;
				


?>
<div class="contact-details"> 
            <?php if ( $title ) echo $before_title . $title . $after_title; ?>
            <p><?php echo stripslashes($instance['contact_text']); ;?> </p>
            <ul>
              <?php echo stripslashes($instance['contact_details']);?>
            </ul>
          </div>

<?php
		echo $after_widget;
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['contact_title'] = strip_tags($new_instance['contact_title']);
		$instance['contact_text'] = $new_instance['contact_text'];
		$instance['contact_details'] = $new_instance['contact_details'];
		$instance['contact_email'] = $new_instance['contact_email'];

		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'contact_title' => __('Contact Info','highthemes'), 'contact_text'=>'lorem ipsum dolor sit amet', 'contact_details'=>'<li><i class="fa fa-home"></i>008 Quickers Street, Cupertino, CA, 12345</li>
<li><i class="fa fa-phone"></i> (123) 456-7890</li>
<li><i class="fa fa-mobile"></i> 052-456-4521</li><li><i class="fa fa-print"></i> (123) 456-7890</li><li><i class="fa fa-envelope"></i>office@touchm.com</li>' ) );
	$contact_title = strip_tags($instance['contact_title']);
	$contact_text = $instance['contact_text'];
	$contact_details = $instance['contact_details'];
	
	
	
	// print the form fields
?>

    <div class="contact-details">
        <p><label for="<?php echo $this->get_field_id('contact_title'); ?>">
        <?php _e('Title:','highthemes'); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('contact_title'); ?>" name="<?php echo $this->get_field_name('contact_title'); ?>" type="text" value="<?php echo
            esc_attr($contact_title); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id('contact_text'); ?>">
        <?php _e('Text:','highthemes'); ?></label>
            <textarea cols="36" rows="5" name="<?php echo $this->get_field_name('contact_text'); ?>" id="<?php echo $this->get_field_id('contact_text'); ?>"><?php echo
            esc_attr($contact_text); ?></textarea>
        </p>
        <p><label for="<?php echo $this->get_field_id('contact_details'); ?>">
        <?php _e('Contact Details:','highthemes'); ?></label>
            <textarea cols="36" rows="15" name="<?php echo $this->get_field_name('contact_details'); ?>" id="<?php echo $this->get_field_id('contact_details'); ?>"><?php echo
            esc_attr($contact_details); ?></textarea>
            </p>

    </div>
	<?php
	}
	}

/**
 * Highthemes Logos
 */

class HT_Logos_list extends WP_Widget {
	
	function HT_Logos_list() {
		
		global  $theme_name;
		// define widget title and description
		$widget_ops = array('classname' => 'ht_logos_list',
							'description' => __( 'Small 40x40 clients logos','highthemes') );
		// register the widget
		$this->WP_Widget('HT_Logos_list',"Highthemes -  " . __('Logos List','highthemes'), $widget_ops);
	
	}
	
	// display the widget in the theme
	function widget( $args, $instance ) {
		extract($args);
		
		
		$instance['logo_details'] = stripslashes($instance['logo_details']);
		$instance['logo_title'] = strip_tags(stripslashes($instance['logo_title']));
		
		$title = apply_filters('widget_title', empty($instance['logo_title']) ? __('Logos','highthemes') : $instance['logo_title'], $instance, $this->id_base);
		
		echo $before_widget;
				


?>
<div class="clients"> 
	<?php if ( $title ) echo $before_title . $title . $after_title; ?>
    <?php echo stripslashes($instance['logo_details']); ;?> 
    <div class="fix"></div>
</div>

<?php
		echo $after_widget;
		
		//end
	}
	
	// update the widget when new options have been entered
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;
		
		$instance['logo_title'] = strip_tags($new_instance['logo_title']);
		$instance['logo_details'] = $new_instance['logo_details'];

		return $instance;
	}
	
	// print the widget option form on the widget management screen
	function form( $instance ) {

	// combine provided fields with defaults
	$instance = wp_parse_args( (array) $instance, array( 'logo_title' => __('Clients Logos','highthemes'), 'logo_details'=>'
<a href="#"><img alt="logo" src="'.get_template_directory_uri().'/images/client.png"></a>
<a href="#"><img alt="logo" src="'.get_template_directory_uri().'/images/client.png"></a>
<a href="#"><img alt="logo" src="'.get_template_directory_uri().'/images/client.png"></a>
<a href="#"><img alt="logo" src="'.get_template_directory_uri().'/images/client.png"></a>


	' ) );

	$logo_title = $instance['logo_title'];
	$logo_details = $instance['logo_details'];
	
	
	
	// print the form fields
?>



	<p><label for="<?php echo $this->get_field_id('logo_title'); ?>">
	<?php _e('Title:','highthemes'); ?></label>
	<input class="widefat" id="<?php echo $this->get_field_id('logo_title'); ?>" name="<?php echo $this->get_field_name('logo_title'); ?>" type="text" value="<?php echo
		esc_attr($logo_title); ?>" /></p>        
   
	<p><label for="<?php echo $this->get_field_id('logo_details'); ?>">
	<?php _e('Logo Details:','highthemes'); ?></label>
        <textarea cols="26" rows="15" name="<?php echo $this->get_field_name('logo_details'); ?>" id="<?php echo $this->get_field_id('logo_details'); ?>"><?php echo
		esc_attr($logo_details); ?></textarea>
        </p>       


	<?php
	}
	}
/**
 * Register all of the Highthemes WordPress widgets on startup.
 *
 * Calls 'widgets_init' action after all of the WordPress widgets have been
 * registered.
 */
function ht_widgets_init() {
	
	global $tweet_widget_number;
	$tweet_widget_number = 0;
	register_widget('HT_Recent_Posts');
	register_widget('HT_Ad_Widget');
	register_widget('HT_Popular_Posts');
	register_widget('HT_Recent_Tweets');
	register_widget('HT_Sub_Navigatioin');
	register_widget('HT_Flickr');
	register_widget('HT_Contact_Details');
    register_widget('HT_Logos_list');
    register_widget('HT_Google_Map');

	
}

add_action('widgets_init', 'ht_widgets_init',1);	
?>
<?php if( $data['post_socials'] == '1' && is_single() ) { ?>
<div class="divider"></div>
<ul class="post-share-buttons">
    <li>
        <div id="fb-root"></div>
        <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
        <fb:like href="<?php echo get_permalink(); ?>" show_faces="false" layout="button_count" width="450"></fb:like>
    </li>
    <li>
        <g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone>
    </li>
    <li>
        <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
        <a href="http://twitter.com/share" class="twitter-share-button"
        <a href="http://twitter.com/share" class="twitter-share-button"
        data-url="<?php the_permalink(); ?>"
        data-via="<?php echo $data['twitter_id'] ?>"
        data-text="<?php the_title(); ?>"
        data-count="horizontal">Tweet</a>
    </li>
</ul>
<?php }?>
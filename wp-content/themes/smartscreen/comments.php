<div class="fix"></div>
<div id="comments">
    <?php if ( post_password_required() ) : ?>
        <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'highthemes' ); ?></p>
    </div><!-- #comments -->
	<?php
			return;
    endif; ?>

	<?php // You can start editing here -- including this comment! ?>
	<?php comment_form(); ?>

	<?php if ( have_comments() ) : ?>
        <div class="section-title">
            <h2>
                <?php
                if(get_comments_number() == 1) {
                    _e("1 Comment","highthemes");
                } else {
                    print(get_comments_number() . " " . __("Comments","highthemes"));
                }
                ?>
            </h2>
        </div>
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-above">
			<h1 class="assistive-text"><?php _e( 'Comment navigation', 'highthemes' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'highthemes' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'highthemes' ) ); ?></div>
		</nav>
    <?php endif; // check for comment navigation ?>

    <div class="commentlist">
        <?php
             wp_list_comments('avatar_size=60&callback=custom_comment&style=div');
        ?>
    </div>

    <?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
    <nav id="comment-nav-below">
        <h1 class="assistive-text"><?php _e( 'Comment navigation', 'highthemes' ); ?></h1>
        <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'highthemes' ) ); ?></div>
        <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'highthemes' ) ); ?></div>
    </nav>
    <?php endif; // check for comment navigation ?>

	<?php elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.', 'highthemes' ); ?></p>
	<?php  endif; ?>

</div><!-- #comments -->
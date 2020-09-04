<?php
if (post_password_required()) {
    ?>
    <p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'sohopro'); ?></p>
    <?php return;
}
?>

    <?php

    #Required for nested reply function that moves reply inline with JS
    if (is_singular()) wp_enqueue_script('comment-reply');

    if (have_comments()) : ?>
	<div id="comments">    
    	<div class="single_comments_wrapper">
            <div class="page_title_wrapper has_subtitle">
				<h2 class="comment_title"><?php echo esc_html__('Comments', 'sohopro') . ' ('. get_comments_number(get_the_ID()) .')'; ?></h2>
            </div>
            <ol class="commentlist">
            <?php 
				if ( gt3_get_theme_option("post_pingbacks") == "enabled" ) {
					wp_list_comments('type=all&callback=gt3_theme_comment');
				} else {
					wp_list_comments('type=comment&callback=gt3_theme_comment');
				}			
			?>
            </ol>
            <div class="dn"><?php paginate_comments_links(); ?></div>
        </div>
	</div>
        <?php if ('open' == $post->comment_status) : ?>

        <?php else : // comments are closed ?>

        <?php endif; ?>
    <?php endif; ?>



    <?php if ('open' == $post->comment_status) :

        $comment_form = array(
            'fields' => apply_filters('comment_form_default_fields', array(
                'author' => '<label class="label-name"></label><input type="text" placeholder="' . esc_html__('Name *', 'sohopro') . '" title="' . esc_html__('Name *', 'sohopro') . '" id="author" name="author" class="form_field">',
                'email' => '<label class="label-email"></label><input type="text" placeholder="' . esc_html__('Email *', 'sohopro') . '" title="' . esc_html__('Email *', 'sohopro') . '" id="email" name="email" class="form_field">',
                'url' => '<label class="label-web"></label><input type="text" placeholder="' . esc_html__('URL', 'sohopro') . '" title="' . esc_html__('URL', 'sohopro') . '" id="web" name="url" class="form_field">'
            )),
            'comment_field' => '<label class="label-message"></label><textarea name="comment" cols="45" rows="5" placeholder="' . esc_html__('Your Comment', 'sohopro') . '" id="comment-message" class="form_field"></textarea>',
            'comment_form_before' => '',
            'comment_form_after' => '',
            'must_log_in' => esc_html__('You must be logged in to post a comment.', 'sohopro'),
            'title_reply' => esc_html__('Leave a Comment', 'sohopro'),
            'label_submit' => esc_html__('Comment', 'sohopro'),
            'logged_in_as' => '<p class="logged-in-as">' . esc_html__('Logged in as', 'sohopro') . ' <a href="' . esc_url(admin_url('profile.php')) . '">' . $user_identity . '</a>. <a href="' . esc_url(wp_logout_url(apply_filters('the_permalink', get_permalink()))) . '">' . esc_html__('Log out?', 'sohopro') . '</a></p>',
        );

        add_filter('comment_form_fields', 'gt3_reorder_comment_fields');

        function gt3_reorder_comment_fields($fields ) {
            $new_fields = array();

            $myorder = array('author', 'email', 'url', 'comment');

            foreach( $myorder as $key ){
                $new_fields[ $key ] = $fields[ $key ];
                unset( $fields[ $key ] );
            }

            if( $fields ) {
                foreach( $fields as $key => $val ) {
                    $new_fields[ $key ] = $val;
                }
            }

            return $new_fields;
        }

        comment_form($comment_form, $post->ID);

    else : // Comments are closed
        ?>
    <?php endif; ?>
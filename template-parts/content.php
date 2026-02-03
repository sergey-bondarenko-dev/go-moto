<div class="post-item">
    <div class='post-item__image'>
        <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?></a>
    </div>
    <h3 class="post-item__link"><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a></h3>
</div>

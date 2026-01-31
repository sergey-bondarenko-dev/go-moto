<?php
add_filter('wpcf7_autop_or_not', '__return_false');

remove_filter('get_the_excerpt', 'wp_trim_excerpt');

add_filter('body_class', function ($classes) {
    if (is_front_page()) {
        $classes[] = 'front-page';
    }
    return $classes;
});

add_filter('wp_get_attachment_image_attributes', function ($attr, $attachment, $size) {
    if (is_front_page() && isset($attr['fetchpriority'])) {
        unset($attr['fetchpriority']);
    }

    return $attr;
}, 20, 3);

<?php
add_action('widgets_init', 'register_my_widgets');
function register_my_widgets()
{

	register_sidebar(array(
		'name' => "Footer 1",
		'id' => "footer-1",
		'description' => '',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>\n",
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => "</h4>\n",
		'before_sidebar' => '', // WP 5.6
		'after_sidebar' => '', // WP 5.6
	));
	register_sidebar(array(
		'name' => "Footer 2",
		'id' => "footer-2",
		'description' => '',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>\n",
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => "</h4>\n",
		'before_sidebar' => '', // WP 5.6
		'after_sidebar' => '', // WP 5.6
	));
	register_sidebar(array(
		'name' => "Footer 3",
		'id' => "footer-3",
		'description' => '',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>\n",
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => "</h4>\n",
		'before_sidebar' => '', // WP 5.6
		'after_sidebar' => '', // WP 5.6
	));
	register_sidebar(array(
		'name' => "Footer 4",
		'id' => "footer-4",
		'description' => '',
		'class' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>\n",
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => "</h4>\n",
		'before_sidebar' => '', // WP 5.6
		'after_sidebar' => '', // WP 5.6
	));
}

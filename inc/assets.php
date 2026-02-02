<?php
add_action('wp_footer', 'enqueue_scripts_to_footer');

function enqueue_scripts_to_footer()
{

	// JavaScript
	wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/js/fancybox.js', array('jquery'));
	wp_enqueue_script('swiper-fancy-mask', get_stylesheet_directory_uri() . '/js/swiper-fancy-mask.js', array('jquery'));
	wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'));
}

add_action('wp_enqueue_scripts', 'theme_name_scripts');

function theme_name_scripts()
{
	// CSS
	wp_enqueue_style('style', get_stylesheet_directory_uri() . '/style.css', array(), '1.0.5');
}

add_filter( 'style_loader_tag',  'preload_filter', 10, 2 );
function preload_filter( $html, $handle ){
    if ($handle === 'style') {
        $html = str_replace("rel='stylesheet'", "rel='preload' as='style' onload='this.rel=\"stylesheet\"'", $html);
    }
    return $html;
}

function smartwp_remove_wp_block_library_css()
{
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
	wp_dequeue_style('wc-blocks-style'); // Remove WooCommerce block CSS
}

add_action('wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100);

add_action('wp_enqueue_scripts', 'theme_add_scripts');

function theme_add_scripts()
{
	wp_enqueue_style('fancybox', get_template_directory_uri() . '/css/fancybox.css');
}

add_action('wp_head', function () {
	$theme_fonts_uri = get_stylesheet_directory_uri() . '/fonts/';
	?>
	<link rel="preload" href="<?= esc_url($theme_fonts_uri . 'Montserrat-Regular.ttf') ?>"
	      as="font" type="font/ttf" crossorigin>
	<link rel="preload" href="<?= esc_url($theme_fonts_uri . 'Montserrat-SemiBold.ttf') ?>"
	      as="font" type="font/ttf" crossorigin>
	<link rel="preload" href="<?= esc_url($theme_fonts_uri . 'Montserrat-Bold.ttf') ?>"
	      as="font" type="font/ttf" crossorigin>
	<?php
}, 1);

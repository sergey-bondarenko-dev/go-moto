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

define('GOMOTO_VITE_DEV_SERVER', 'http://localhost:5173');
define('GOMOTO_VITE_MANIFEST', get_template_directory() . '/dist/manifest.json');

function gomoto_is_vite_dev(): bool
{
	$host = $_SERVER['HTTP_HOST'] ?? '';
	if ($host === '') {
		return false;
	}

	$host = trim($host);
	if (strpos($host, '[') === 0) {
		$end = strpos($host, ']');
		$host = $end === false ? $host : substr($host, 1, $end - 1);
	} else {
		$host = explode(':', $host)[0];
	}

	$host = trim($host, '[]');
	$dev_hosts = ['localhost', '127.0.0.1', '::1'];

	return in_array($host, $dev_hosts, true);
}

function gomoto_enqueue_vite_assets()
{
	$entry = 'src/scripts/main.ts';

	if (gomoto_is_vite_dev()) {
		wp_enqueue_script('vite-client', GOMOTO_VITE_DEV_SERVER . '/@vite/client', [], null, true);
		wp_script_add_data('vite-client', 'type', 'module');

		wp_enqueue_script('vite-main', GOMOTO_VITE_DEV_SERVER . '/' . $entry, [], null, true);
		wp_script_add_data('vite-main', 'type', 'module');
		return;
	}

	if (!file_exists(GOMOTO_VITE_MANIFEST)) {
		return;
	}

	$manifest = json_decode(file_get_contents(GOMOTO_VITE_MANIFEST), true);
	if (!is_array($manifest) || empty($manifest[$entry]['file'])) {
		return;
	}

	$entry_data = $manifest[$entry];
	$entry_uri = get_template_directory_uri() . '/dist/' . $entry_data['file'];

	wp_enqueue_script('vite-main', $entry_uri, [], null, true);
	wp_script_add_data('vite-main', 'type', 'module');

	if (!empty($entry_data['css']) && is_array($entry_data['css'])) {
		foreach ($entry_data['css'] as $index => $css_file) {
			$css_uri = get_template_directory_uri() . '/dist/' . $css_file;
			wp_enqueue_style('vite-main-' . $index, $css_uri, [], null);
		}
	}
}

add_action('wp_enqueue_scripts', 'gomoto_enqueue_vite_assets');

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

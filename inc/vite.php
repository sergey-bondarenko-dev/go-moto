<?php
if (!defined('VITE_DEV_SERVER')) {
	define('VITE_DEV_SERVER', 'http://localhost:5173');
}

if (!defined('VITE_MANIFEST')) {
	define('VITE_MANIFEST', get_template_directory() . '/dist/manifest.json');
}

function is_vite_dev(): bool
{
	static $cached = null;
	if ($cached !== null) {
		return $cached;
	}

	$url = rtrim(VITE_DEV_SERVER, '/') . '/@vite/client';
	$response = wp_remote_get($url, [
		'timeout'     => 0.5,
		'redirection' => 0,
		'blocking'    => true,
	]);

	if (is_wp_error($response)) {
		$cached = false;
		return $cached;
	}

	$code = wp_remote_retrieve_response_code($response);
	$cached = ($code >= 200 && $code < 400);
	return $cached;
}

function enqueue_vite_assets()
{
	$entry = 'src/scripts/main.ts';

	if (is_vite_dev()) {
		wp_enqueue_script_module('vite-client', VITE_DEV_SERVER . '/@vite/client', [], false);
		wp_enqueue_script_module('vite-main', VITE_DEV_SERVER . '/' . $entry, ['vite-client'], false);
		return;
	}

	if (!file_exists(VITE_MANIFEST)) {
		return;
	}

	$manifest = json_decode(file_get_contents(VITE_MANIFEST), true);
	if (!is_array($manifest) || empty($manifest[$entry]['file'])) {
		return;
	}

	$entry_data = $manifest[$entry];
	$entry_uri = get_template_directory_uri() . '/dist/' . $entry_data['file'];

	wp_enqueue_script_module('vite-main', $entry_uri, [], false);

	if (!empty($entry_data['css']) && is_array($entry_data['css'])) {
		foreach ($entry_data['css'] as $index => $css_file) {
			$css_uri = get_template_directory_uri() . '/dist/' . $css_file;
			wp_enqueue_style('vite-main-' . $index, $css_uri, [], null);
		}
	}
}

add_action('wp_enqueue_scripts', 'enqueue_vite_assets');

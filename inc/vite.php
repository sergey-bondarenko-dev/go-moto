<?php
if ( ! defined( 'VITE_DEV_SERVER' ) ) {
	define( 'VITE_DEV_SERVER', 'http://localhost:5173' );
}

if ( ! defined( 'VITE_MANIFEST' ) ) {
	define( 'VITE_MANIFEST', get_template_directory() . '/dist/.vite/manifest.json' );
}

if ( ! defined( 'VITE_DEV_ENABLED' ) ) {
	define( 'VITE_DEV_ENABLED', false );
}

function is_vite_dev(): bool {
	static $cached = null;
	if ( $cached !== null ) {
		return $cached;
	}

	if ( ! VITE_DEV_ENABLED ) {
		$cached = false;
		return $cached;
	}

	$url      = rtrim( VITE_DEV_SERVER, '/' ) . '/@vite/client';
	$response = wp_remote_get(
		$url,
		array(
			'timeout'     => 0.5,
			'redirection' => 0,
			'blocking'    => true,
		)
	);

	if ( is_wp_error( $response ) ) {
		$cached = false;
		return $cached;
	}

	$code   = wp_remote_retrieve_response_code( $response );
	$cached = ( $code >= 200 && $code < 400 );
	return $cached;
}

function enqueue_vite_assets() {
	$entry = 'src/scripts/main.ts';

	if ( is_vite_dev() ) {
		wp_enqueue_script_module( 'vite-client', VITE_DEV_SERVER . '/@vite/client', array(), null );
		wp_enqueue_script_module( 'vite-main', VITE_DEV_SERVER . '/' . $entry, array( 'vite-client' ), null );
		return;
	}

	if ( ! file_exists( VITE_MANIFEST ) ) {
		return;
	}

	$manifest = json_decode( file_get_contents( VITE_MANIFEST ), true );
	if ( ! is_array( $manifest ) ) {
		return;
	}

	$entry_data = $manifest[ $entry ] ?? null;
	if ( ! is_array( $entry_data ) ) {
		$entry_normalized = str_replace( '\\', '/', $entry );
		foreach ( $manifest as $item ) {
			if ( ! is_array( $item ) || empty( $item['src'] ) ) {
				continue;
			}

			$src = str_replace( '\\', '/', (string) $item['src'] );
			if ( $src === $entry_normalized || str_ends_with( $src, $entry_normalized ) ) {
				$entry_data = $item;
				break;
			}
		}
	}

	if ( ! is_array( $entry_data ) || empty( $entry_data['file'] ) ) {
		return;
	}
	$entry_uri  = get_template_directory_uri() . '/dist/' . $entry_data['file'];

	wp_enqueue_script_module( 'vite-main', $entry_uri, array(), false );

	if ( ! empty( $entry_data['css'] ) && is_array( $entry_data['css'] ) ) {
		foreach ( $entry_data['css'] as $index => $css_file ) {
			$css_uri = get_template_directory_uri() . '/dist/' . $css_file;
			wp_enqueue_style( 'vite-main-' . $index, $css_uri, array(), null );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'enqueue_vite_assets' );

function preload_vite_fonts() {
	$font_sources = array(
		'src/fonts/Montserrat-Regular.ttf',
		'src/fonts/Montserrat-Medium.ttf',
		'src/fonts/Montserrat-Bold.ttf',
	);

	if ( is_vite_dev() ) {
		foreach ( $font_sources as $font_path ) {
			$font_url = rtrim( VITE_DEV_SERVER, '/' ) . '/' . $font_path;
			printf(
				'<link rel="preload" href="%s" as="font" type="font/ttf" crossorigin>' . "\n",
				esc_url( $font_url )
			);
		}
		return;
	}

	if ( ! file_exists( VITE_MANIFEST ) ) {
		return;
	}

	$manifest = json_decode( file_get_contents( VITE_MANIFEST ), true );
	if ( ! is_array( $manifest ) ) {
		return;
	}

	foreach ( $font_sources as $font_path ) {
		if ( empty( $manifest[ $font_path ]['file'] ) ) {
			continue;
		}

		$font_url = get_template_directory_uri() . '/dist/' . $manifest[ $font_path ]['file'];
		printf(
			'<link rel="preload" href="%s" as="font" type="font/ttf" crossorigin>' . "\n",
			esc_url( $font_url )
		);
	}
}

add_action( 'wp_head', 'preload_vite_fonts', 1 );

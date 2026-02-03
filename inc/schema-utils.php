<?php

function gomoto_get_theme_contacts(): array {
	$email   = gomoto_get_theme_option( 'email' );
	$address = gomoto_get_theme_option( 'address' );
	$phones  = gomoto_get_theme_option( 'phones' ) ?: array();

	$phoneList = array_values( array_filter( array_column( $phones, 'phone' ) ) );
	$phoneMain = $phoneList[0] ?? '+375293842436';

	return array(
		'email'     => $email ?: 'info@gomoto.by',
		'address'   => $address,
		'phones'    => $phoneList,
		'phoneMain' => $phoneMain,
	);
}

function gomoto_render_schema( array $schema ): void {
	if ( empty( $schema ) ) {
		return;
	}

	echo '<script type="application/ld+json">' .
		wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT ) .
		'</script>';
}

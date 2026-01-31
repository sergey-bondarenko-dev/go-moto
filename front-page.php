<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package MLine
 */
/* Template Name: Главная */
get_header();

$rating_value = carbon_get_theme_option('rating_value');
$rating_count = carbon_get_theme_option('rating_count');

$schema = [
    '@context' => 'https://schema.org',
    '@type' => 'MotorcycleRental',
    '@id' => 'https://gomoto.by/#organization',
    'name' => 'GoMoto — прокат мотоциклов в Минске',
    'url' => 'https://gomoto.by/',
    'logo' => 'https://gomoto.by/wp-content/uploads/2024/11/1212.png',
    'description' => 'GoMoto — самый большой прокат мотоциклов в Минске. В наличии самые популярные мировые производители и модели мотоциклов. Прокат мотоциклов с экипировкой, страховкой и посуточной оплатой. Удобные условия и выгодные цены. Скидки и программа лояльности.',
    'priceRange' => 'от 150 BYN/сутки',
    'telephone' => '+375 29 384 24 36',
    'email' => 'info@gomoto.by',
    'address' => [
        '@type' => 'PostalAddress',
        'streetAddress' => 'Ждановичи, ул. Магистральная, 10',
        'addressLocality' => 'Минск',
        'postalCode' => '220025',
        'addressCountry' => 'BY',
    ],
    'geo' => [
        '@type' => 'GeoCoordinates',
        'latitude' => 53.933372,
        'longitude' => 27.410849,
    ],
    'openingHoursSpecification' => [
        [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            'opens' => '10:00',
            'closes' => '21:00',
        ],
        [
            '@type' => 'OpeningHoursSpecification',
            'dayOfWeek' => ['Saturday', 'Sunday'],
            'opens' => '10:00',
            'closes' => '21:00',
        ],
    ],
    'sameAs' => [
        'https://www.instagram.com/gomoto.by/',
        'https://www.facebook.com/gomoto.by/',
        'https://t.me/gomotoby',
		"https://maps.app.goo.gl/cvYvo4iH2Y3z6EfD6",
"https://yandex.by/maps/-/CLbF6J~P"
    ],
    'potentialAction' => [
        [
            '@type' => 'RentalAction',
            'name' => 'Арендовать мотоцикл в GoMoto',
            'target' => [
                '@type' => 'EntryPoint',
                'urlTemplate' => 'https://gomoto.by/',
                'inLanguage' => 'ru',
                'actionPlatform' => [
                    'https://schema.org/DesktopWebPlatform',
                    'https://schema.org/MobileWebPlatform',
                ],
            ],
            'expectsAcceptanceOf' => [
                '@type' => 'Offer',
                'priceCurrency' => 'BYN',
                'priceSpecification' => [
                    '@type' => 'PriceSpecification',
                    'priceCurrency' => 'BYN',
                    'price' => 'от 150 BYN/сутки',
                ],
                'availability' => 'https://schema.org/InStock',
            ],
            'agent' => [
                '@type' => 'Organization',
                'name' => 'GoMoto',
                'url' => 'https://gomoto.by',
            ],
            'result' => [
                '@type' => 'Thing',
                'name' => 'Арендованный мотоцикл',
            ],
        ],
        [
            '@type' => 'SearchAction',
            'target' => 'https://gomoto.by/?s={search_term_string}',
            'query-input' => 'required name=search_term_string',
        ],
    ],
    'hasMap' => 'https://maps.app.goo.gl/YP4kGVMSZWezDtD5A',
    'license' => 'https://gomoto.by/',
];

// Добавляем aggregateRating, если заполнено в настройках
if ($rating_value && $rating_count) {
    $schema['aggregateRating'] = [
        '@type' => 'AggregateRating',
        'ratingValue' => $rating_value,
        'reviewCount' => $rating_count,
    ];
}
?>
<script type="application/ld+json">
<?= wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>
<main id="primary" class="site-main">
	<?php get_template_part( 'template-parts/hero' ); ?>

	<section class="front-products woocommerce pt-60">
		<div class="container">
			<div class="section-content">

				<div class="section-title">
					<h2 class="section-title__title">Доступные мотоциклы</h2>
				</div>

				<ul class="products">
					<?php $n = 0;
					$products = carbon_get_the_post_meta('offers');
					foreach ($products as $prod) {
						$_product = wc_get_product($prod['id']);
						$n++;
						?>
						<li class="product type-product">
							<div class="colored-separator" style="text-align: center;">
								<div class="first-long stm-base-background-color"></div>
								<div class="last-short stm-base-background-color"></div>
							</div>
							<a href="<?php echo get_the_permalink($prod['id']); ?>" class="product-image-link">
								<?php echo get_the_post_thumbnail($prod['id'], 'woocommerce_thumbnail'); ?>

								<?php

								$stickerIds = carbon_get_post_meta($prod['id'], 'product_stickers');

								if (!empty($stickerIds)):
									$stickerIds = array_slice($stickerIds, 0, 3) ?>

									<div class="stickers-wrapper">

										<?php foreach ($stickerIds as $stickerId):
											$stickerText = get_the_title($stickerId);
											$stickerColor = carbon_get_post_meta($stickerId, 'sticker_color'); ?>

											<span class="product-sticker" style="background-color: <?= $stickerColor ?>;">
												<?= $stickerText ?>
											</span>

										<?php endforeach; ?>

									</div>

								<?php endif; ?>
							</a>
							<h3 class="fs-18"><a
								   href="<?php echo get_the_permalink($prod['id']); ?>"><?php echo $_product->get_title(); ?></a>
							</h3>
							<p class="fs-14"><?php echo get_the_excerpt($prod['id']); ?></p>
							<div class="product__price">
								<?php if (carbon_get_post_meta($prod['id'], 'product-type') == 'rent') { ?>
									<div class="product-price fs-16"><span class="red"><?php echo $_product->get_price(); ?> BYN
											/ сутки</span>
									</div>
								<?php } else { ?>
									<div class="product-price fs-16"><span class="red"><?php echo $_product->get_price(); ?>
											BYN</span></div>
								<?php } ?>
							</div>
						</li>
					<?php } ?>
				</ul>

				<section class="booking-form pb-60">
					<div class="section-title categories__title-wrapper">
						<h2 class="section-title__title categories__title">
							Забронировать онлайн
						</h2>
						<div class="colored-separator" style="text-align: center;">
							<div class="first-long stm-base-background-color"></div>
							<div class="last-short stm-base-background-color"></div>
						</div>
					</div>
					<?= do_shortcode('[base_booking_form]') ?>
				</section>

				<div class="section-title categories__title-wrapper">
					<h2 class="section-title__title categories__title">
						Мотоциклы по классам
					</h2>
					<div class="colored-separator" style="text-align: center;">
						<div class="first-long stm-base-background-color"></div>
						<div class="last-short stm-base-background-color"></div>
					</div>
				</div>

				<?php

				$subcategories = get_terms([
					'taxonomy' => 'product_cat',
					'parent' => 32,
					'hide_empty' => false
				]);

				?>

				<ul class="categories__list">
	<?php foreach ( $subcategories as $subcategory ): ?>
		<?php
		$icon_id = carbon_get_term_meta( $subcategory->term_id, 'product_category_icon' );
		$icon_html = '';

		if ( $icon_id ) {
			// Выведет <img> с корректными alt, width, height
			$icon_html = wp_get_attachment_image( $icon_id, [200, 120], false, [
				'class' => 'categories__list-image',
				'loading' => 'lazy',
			] );
		}
		?>
		<li class="categories__list-item">
			<a href="<?= esc_url( get_term_link( $subcategory ) ) ?>" class="categories__list-link">
				<?= $icon_html ?>
				<span><?= esc_html( $subcategory->name ) ?></span>
			</a>
		</li>
	<?php endforeach; ?>
</ul>
			</div>
		</div>
	</section>

	<section class="pluses-section pb-60">
		<div class="container">

		</div>
	</section>
	<section class="sert bg-navy pt-60 pb-60">
		<div class="container">
			<div class="row flex ali-c">
				<div class="col col--2">
					<?php echo wp_get_attachment_image(carbon_get_the_post_meta('sert-image'), 'full'); ?>
				</div>
				<div class="col col--2 flex ali-c fd-c jc-c">
					<div class="sert__content bg-yellow p-30">
						<h3>
							<?php echo carbon_get_the_post_meta('sert-title'); ?>
						</h3>
						<div class="body-4">
							<?php echo apply_filters('the_content', carbon_get_the_post_meta('sert-text')); ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<section class="front-products woocommerce pt-60 pb-60">
		<div class="container">
			<div class="section-title">
				<?php if (!empty($offers_title = carbon_get_the_post_meta('offers-2-title'))) { ?>
					<h2 class="section-title__title">
						<?php echo $offers_title; ?>
					</h2>
				<?php } ?>
			</div>
			<div class="section-content">
				<div class="products columns-3">
					<div class="swiper swiper-container gear">
						<div class="swiper-wrapper">
							<?php $products = carbon_get_the_post_meta('offers-2');
							foreach ($products as $prod) {
								$_product = wc_get_product($prod['id']);
								?>
								<div class="swiper-slide product type-product">
									<div class="colored-separator" style="text-align: center;">
										<div class="first-long stm-base-background-color"></div>
										<div class="last-short stm-base-background-color"></div>
									</div>
									<a href="<?php echo get_the_permalink($prod['id']); ?>">
										<?php echo get_the_post_thumbnail($prod['id'], 'woocommerce_thumbnail'); ?>
									</a>
									<h3 class="fs-22"><a
										   href="<?php echo get_the_permalink($prod['id']); ?>"><?php echo $_product->get_title(); ?></a>
									</h3>
									<p class="fs-16"><?php echo get_the_excerpt($prod['id']); ?></p>
									<div class="product__price">

										<?php if (!$_product->get_price()): ?>
											<div class="product-price fs-16">
												<span class="red">
													Бесплатно
												</span>
											</div>
										<?php elseif (carbon_get_post_meta($prod['id'], 'product-type') == 'rent'): ?>
											<div class="product-price fs-16">
												<span class="red">
													<?php echo $_product->get_price(); ?> BYN / сутки
												</span>
											</div>
										<?php else: ?>
											<div class="product-price fs-16">
												<span class="red">
													<?php echo $_product->get_price(); ?> BYN
												</span>
											</div>
										<?php endif; ?>
									</div>
								</div>
							<?php } ?>
						</div>


						<div class="swiper-button-prev"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
								 viewBox="0 0 21 20" fill="none">
								<path d="M16.9225 10.6609L7.26745 10.6609L11.0175 14.4109L9.83912 15.5893L4.07745 9.82758L9.83912 4.06592L11.0175 5.24425L7.26745 8.99425H16.9225V10.6609Z"
									  fill="#ff9800" />
							</svg></div>
						<div class="swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
								 viewBox="0 0 21 20" fill="none">
								<path d="M4.07745 8.99425L13.7325 8.99425L9.98245 5.24425L11.1608 4.06592L16.9225 9.82758L11.1608 15.5893L9.98245 14.4109L13.7325 10.6609H4.07745L4.07745 8.99425Z"
									  fill="#ff9800" />
							</svg></div>

					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="banner pt-120 pb-120"
			 style="background-image:url(<?php echo wp_get_attachment_image_url(carbon_get_the_post_meta('banner-image'), 'full'); ?>)">
		<div class="container">
			<div class="banner-content bg-red">
				<h3>
					<?php echo carbon_get_the_post_meta('banner-title'); ?>
				</h3>
				<?php echo apply_filters('the_content', carbon_get_the_post_meta('banner-text')); ?>
			</div>
		</div>
	</section>

	<?php if (!empty($questions = carbon_get_the_post_meta('question'))) { ?>
		<section class="questions pt-60 pb-60">
			<div class="container">
				<div class="section-title">
					<?php if (!empty($questions_title = carbon_get_the_post_meta('question-title'))) { ?>
						<h2 class="section-title__title">
							<?php echo $questions_title; ?>
						</h2>
						<div class="colored-separator" style="text-align: center;">
							<div class="first-long stm-base-background-color"></div>
							<div class="last-short stm-base-background-color"></div>
						</div>
					<?php } ?>
				</div>
				<div class="section-content">
					<ul class="accordion-group">

						<?php foreach ($questions as $index => $question):
							$id = 'accordion-item-' . ($index + 1); ?>

							<li class="accordion-group__item">

								<div class="accordion">

									<details class="accordion__details" name="accordion-group">
										<summary class="accordion__summary">
											<h3 class="accordion__title h5">
												<span role="term" aria-details="<?php echo esc_attr($id); ?>">
													<?php echo esc_html($question['question']); ?>
												</span>
												<div class="accordion__arrow">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
														<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
													</svg>
												</div>
											</h3>
										</summary>
									</details>

									<div id="<?php echo esc_attr($id); ?>" class="accordion__content" role="definition">
										<div class="accordion__content-inner">
											<div class="accordion__content-body">
												<?php echo apply_filters('the_content', $question['answer']); ?>
											</div>
										</div>
									</div>

								</div>

							</li>

						<?php endforeach; ?>

					</ul>

				</div>
			</div>
		</section>

	<?php } ?>

	<section class="seo-block pt-40 pb-40">
		<div class="container">
			<!--div class="row flex jc-spb">
				<div class="col col--3">
					<h4 class="flex gap-10 ali-c">
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
							width="512" height="512" x="0" y="0" viewBox="0 0 8.467 8.467"
							style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
							<g>
								<path
									d="M4.233.265A3.973 3.973 0 0 0 .265 4.233a3.973 3.973 0 0 0 3.968 3.97 3.973 3.973 0 0 0 3.97-3.97A3.973 3.973 0 0 0 4.232.265zm0 .529a3.437 3.437 0 0 1 3.442 3.44 3.44 3.44 0 0 1-3.442 3.441 3.437 3.437 0 0 1-3.44-3.442 3.436 3.436 0 0 1 3.44-3.44zM4.23 2.118a.265.265 0 0 0-.26.268v.223c-.427.08-.793.355-.793.832 0 .33.15.598.35.754s.426.224.624.29c.199.067.37.13.467.206.098.075.144.14.144.338 0 .44-1.056.44-1.056 0a.265.265 0 1 0-.529 0c0 .476.366.752.793.832v.222a.265.265 0 1 0 .529 0V5.86c.427-.08.793-.356.793-.832 0-.331-.15-.599-.35-.754-.2-.156-.426-.226-.624-.292-.199-.066-.37-.129-.468-.204-.097-.076-.144-.14-.144-.338 0-.441 1.056-.441 1.056 0a.265.265 0 1 0 .53 0c0-.476-.366-.751-.793-.832v-.223a.265.265 0 0 0-.27-.268z"
									fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
							</g>
						</svg>
						Скидки
					</h4>
					<?php foreach (carbon_get_the_post_meta('seo-discounts') as $li) { ?>
						<div class="flex gap-10 ali-c grey uppercase body-4">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
								width="512" height="512" x="0" y="0" viewBox="0 0 60 60"
								style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
								<g>
									<path
										d="M58 12H2a2 2 0 0 0-2 2v32a2 2 0 0 0 2 2h56a2 2 0 0 0 2-2V14a2 2 0 0 0-2-2ZM2 46V14h56v32Z"
										fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
									<path
										d="M54.284 21.949a5.01 5.01 0 0 1-4.233-4.23A1.985 1.985 0 0 0 48.078 16H11.922a2.006 2.006 0 0 0-1.973 1.716 5.011 5.011 0 0 1-4.229 4.233A1.984 1.984 0 0 0 4 23.922v12.156a1.985 1.985 0 0 0 1.716 1.974 5.011 5.011 0 0 1 4.233 4.229A2.008 2.008 0 0 0 11.922 44h36.156a1.985 1.985 0 0 0 1.973-1.719 5.01 5.01 0 0 1 4.234-4.23A1.984 1.984 0 0 0 56 36.078V23.922a2.006 2.006 0 0 0-1.716-1.973ZM54 36.071a7.011 7.011 0 0 0-4.215 2.262A6.908 6.908 0 0 0 48.078 42h-36.15A7 7 0 0 0 6 36.078v-12.15A7 7 0 0 0 11.922 18h36.15A7.01 7.01 0 0 0 54 23.929Z"
										fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
									<path
										d="M12 26a4 4 0 1 0 4 4 4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2 2 2 0 0 1-2 2ZM44 30a4 4 0 1 0 4-4 4 4 0 0 0-4 4Zm6 0a2 2 0 1 1-2-2 2 2 0 0 1 2 2ZM30 20a10 10 0 1 0 10 10 10.011 10.011 0 0 0-10-10Zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8Z"
										fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
									<path
										d="M30 29a1 1 0 1 1 .867-1.5 1 1 0 1 0 1.731-1A2.993 2.993 0 0 0 31 25.2V25a1 1 0 0 0-2 0v.184A2.993 2.993 0 0 0 30 31a1 1 0 1 1-.867 1.5 1 1 0 0 0-1.731 1 3 3 0 0 0 1.6 1.3v.2a1 1 0 0 0 2 0v-.183A2.993 2.993 0 0 0 30 29Z"
										fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
								</g>
							</svg>
							<span><?php echo $li['text']; ?></span>
						</div>
					<?php } ?>

					<div class="flex gap-10 ali-c body-4">
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
							width="512" height="512" x="0" y="0" viewBox="0 0 426.667 426.667"
							style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
							<g>
								<path
									d="M405.332 192H234.668V21.332C234.668 9.559 225.109 0 213.332 0 201.559 0 192 9.559 192 21.332V192H21.332C9.559 192 0 201.559 0 213.332c0 11.777 9.559 21.336 21.332 21.336H192v170.664c0 11.777 9.559 21.336 21.332 21.336 11.777 0 21.336-9.559 21.336-21.336V234.668h170.664c11.777 0 21.336-9.559 21.336-21.336 0-11.773-9.559-21.332-21.336-21.332zm0 0"
									fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
							</g>
						</svg>
						Скидки суммируются с картой постоянного клиента
					</div>
				</div>
				<div class="col col--3">
					<h4 class="flex gap-10 ali-c ">
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
							width="512" height="512" x="0" y="0" viewBox="0 0 512 512"
							style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
							<g>
								<path
									d="M376 30c-27.783 0-53.255 8.804-75.707 26.168-21.525 16.647-35.856 37.85-44.293 53.268-8.437-15.419-22.768-36.621-44.293-53.268C189.255 38.804 163.783 30 136 30 58.468 30 0 93.417 0 177.514c0 90.854 72.943 153.015 183.369 247.118 18.752 15.981 40.007 34.095 62.099 53.414C248.38 480.596 252.12 482 256 482s7.62-1.404 10.532-3.953c22.094-19.322 43.348-37.435 62.111-53.425C439.057 330.529 512 268.368 512 177.514 512 93.417 453.532 30 376 30z"
									fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
							</g>
						</svg>
						Плюсы
					</h4>
					<?php foreach (carbon_get_the_post_meta('seo-advantages') as $li) { ?>
						<div class="flex gap-10 ali-c grey uppercase body-4">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
								width="512" height="512" x="0" y="0" viewBox="0 0 330 330"
								style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
								<g>
									<path
										d="M165 0C74.019 0 0 74.019 0 165s74.019 165 165 165 165-74.019 165-165S255.981 0 165 0zm0 300c-74.44 0-135-60.561-135-135S90.56 30 165 30s135 60.561 135 135-60.561 135-135 135z"
										fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
									<path
										d="m226.872 106.664-84.854 84.853-38.89-38.891c-5.857-5.857-15.355-5.858-21.213-.001-5.858 5.858-5.858 15.355 0 21.213l49.496 49.498a15 15 0 0 0 10.606 4.394h.001c3.978 0 7.793-1.581 10.606-4.393l95.461-95.459c5.858-5.858 5.858-15.355 0-21.213-5.858-5.858-15.355-5.859-21.213-.001z"
										fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
								</g>
							</svg>
							<span><?php echo $li['text']; ?></span>
						</div>
					<?php } ?>
				</div>
				<div class="col col--3">
					<h4 class="flex gap-10 ali-c ">
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
							width="512" height="512" x="0" y="0" viewBox="0 0 512 512"
							style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
							<g>
								<path
									d="M434.929 46.131C424.549 35.729 410.745 30 396.058 30H371.25v-5c0-13.785-11.215-25-25-25h-180c-13.785 0-25 11.215-25 25v5h-24.897c-30.261 0-54.908 24.646-54.942 54.939l-.411 372c-.016 14.702 5.691 28.528 16.07 38.93C87.45 506.271 101.255 512 115.942 512h279.704c30.262 0 54.909-24.646 54.942-54.939l.412-372c.017-14.703-5.691-28.529-16.071-38.93zM171.25 30h170v30h-170zm249.37 427.027C420.604 470.798 409.401 482 395.646 482H115.942c-6.676 0-12.951-2.604-17.669-7.332-4.718-4.729-7.312-11.013-7.305-17.695l.411-372C91.394 71.202 102.597 60 116.353 60h24.897v5c0 13.785 11.215 25 25 25h180c13.785 0 25-11.215 25-25v-5h24.808c6.676 0 12.951 2.604 17.669 7.332s7.313 11.013 7.305 17.695z"
									fill="#ff9800" opacity="1" data-original="#ff9800"></path>
								<path
									d="M261.099 200H367.67c8.284 0 15-6.716 15-15s-6.716-15-15-15H261.099c-8.284 0-15 6.716-15 15s6.716 15 15 15zM261.099 300H367.67c8.284 0 15-6.716 15-15s-6.716-15-15-15H261.099c-8.284 0-15 6.716-15 15s6.716 15 15 15zM368.099 370h-107c-8.284 0-15 6.716-15 15s6.716 15 15 15h107c8.284 0 15-6.716 15-15s-6.715-15-15-15zM197.256 144.157l-34.592 34.592-8.156-8.157c-5.858-5.858-15.355-5.858-21.213 0-5.858 5.857-5.858 15.355 0 21.213l18.763 18.764a15 15 0 0 0 21.213 0l45.199-45.198c5.858-5.857 5.858-15.355 0-21.213-5.858-5.859-15.355-5.859-21.214-.001zM197.256 251.794l-34.592 34.592-8.156-8.156c-5.858-5.858-15.355-5.858-21.213 0-5.858 5.857-5.858 15.354 0 21.213l18.763 18.764a15 15 0 0 0 21.213 0l45.199-45.199c5.858-5.857 5.858-15.355 0-21.213s-15.356-5.858-21.214-.001zM197.256 351.794l-34.592 34.592-8.156-8.156c-5.858-5.858-15.355-5.858-21.213 0-5.858 5.857-5.858 15.354 0 21.213l18.763 18.764a15 15 0 0 0 21.213 0l45.199-45.199c5.858-5.857 5.858-15.355 0-21.213s-15.356-5.858-21.214-.001z"
									fill="#ff9800" opacity="1" data-original="#ff9800"></path>
							</g>
						</svg>
						В аренду мотоцикла входит
					</h4>
					<?php foreach (carbon_get_the_post_meta('seo-included') as $li) { ?>
						<div class="flex gap-10 ali-c grey uppercase body-4">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
								width="512" height="512" x="0" y="0" viewBox="0 0 214.27 214.27"
								style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
								<g>
									<path
										d="M196.926 55.171c-.11-5.785-.215-11.25-.215-16.537a7.5 7.5 0 0 0-7.5-7.5c-32.075 0-56.496-9.218-76.852-29.01a7.498 7.498 0 0 0-10.457 0c-20.354 19.792-44.771 29.01-76.844 29.01a7.5 7.5 0 0 0-7.5 7.5c0 5.288-.104 10.755-.215 16.541-1.028 53.836-2.436 127.567 87.331 158.682a7.495 7.495 0 0 0 4.912 0c89.774-31.116 88.368-104.849 87.34-158.686zm-89.795 143.641c-76.987-27.967-75.823-89.232-74.79-143.351.062-3.248.122-6.396.164-9.482 30.04-1.268 54.062-10.371 74.626-28.285 20.566 17.914 44.592 27.018 74.634 28.285.042 3.085.102 6.231.164 9.477 1.032 54.121 2.195 115.388-74.798 143.356z"
										fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
									<path
										d="m132.958 81.082-36.199 36.197-15.447-15.447a7.501 7.501 0 0 0-10.606 10.607l20.75 20.75a7.477 7.477 0 0 0 5.303 2.196 7.477 7.477 0 0 0 5.303-2.196l41.501-41.5a7.498 7.498 0 0 0 .001-10.606 7.5 7.5 0 0 0-10.606-.001z"
										fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
								</g>
							</svg>
							<span><?php echo $li['text']; ?></span>
						</div>
					<?php } ?>
				</div>
			</div-->
			<?php if (trim(carbon_get_the_post_meta('seo-text'))): ?>
				<div class="seo__text pt-30">
					<?= apply_filters('the_content', carbon_get_the_post_meta('seo-text')) ?>
				</div>
			<?php endif; ?>
		</div>
	</section>


	<section class="directions pt-60 pb-60 bg-navy">
		<div class="container">
			<div class="row">
				<?php
				$class = "bg-red";
				foreach (carbon_get_the_post_meta('directions') as $direction) { ?>
					<div class="col col--2">
						<div class="directions__item <?php echo $class;
						$class = "bg-yellow"; ?> p-40 flex ali-c gap-20">
							<div class="direction__icon">
								<?php echo $direction['icon']; ?>
							</div>
							<div class="direction__text">
								<h3>
									<?php echo $direction['title']; ?>
								</h3>
								<?php echo $direction['text']; ?>
							</div>
						</div>
					</div>
				<?php } ?>

			</div>
		</div>
	</section>


	<section class="pt-60 pb-60">
		<div class="container">
			<div class="section-title">
				<h2 class="section-title__title">
					Полезная информация
				</h2>
				<div class="colored-separator" style="text-align: center;">
					<div class="first-long stm-base-background-color"></div>
					<div class="last-short stm-base-background-color"></div>
				</div>
			</div>
			<div class="section-content">
				<div class="posts">
					<?php
					$query = new WP_Query('posts_per_page=3&ignore_sticky_posts=0&orderby=date');
					?>
					<?php if ($query->have_posts()):
						$index = 0; ?>
						<div class="swiper-wrapper">
							<?php while ($query->have_posts()):
								$query->the_post();
								$index++;
								if ($index > 3)
									break; ?>
								<div class="swiper-slide">
									<div class="post-item">
										<div class='post-item__image'>
											<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('full'); ?></a>
										</div>
										<h3 class="post-item__link">
											<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
										</h3>
									</div>
								</div>
							<?php endwhile;
							wp_reset_postdata(); ?>
						</div>
						<div class="swiper-button-prev">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
								<path d="M16.9225 10.6609L7.26745 10.6609L11.0175 14.4109L9.83912 15.5893L4.07745 9.82758L9.83912 4.06592L11.0175 5.24425L7.26745 8.99425H16.9225V10.6609Z"
									  fill="#ff9800"></path>
							</svg>
						</div>
						<div class="swiper-button-next">
							<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20" viewBox="0 0 21 20" fill="none">
								<path d="M4.07745 8.99425L13.7325 8.99425L9.98245 5.24425L11.1608 4.06592L16.9225 9.82758L11.1608 15.5893L9.98245 14.4109L13.7325 10.6609H4.07745L4.07745 8.99425Z"
									  fill="#ff9800"></path>
							</svg>
						</div>
					<?php endif; ?>
					<div style="text-align: center; flex: 1 1 auto;">
						<a class="wp-block-button__link wp-element-button"
						   href="<?php echo get_post_type_archive_link('post'); ?>"
						   style="max-width: 200px; margin: 0 auto;">
							Смотреть всё
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php if (!empty($slides = carbon_get_post_meta(get_the_ID(), 'front-gallery'))) { ?>
		<section class="gallery bg-navy pt-60 pb-60">
			<div class="container">
				<div class="section-title">
					<?php if (!empty($offer_title = carbon_get_the_post_meta('gallery-title'))) { ?>
						<h2 class="section-title__title">
							<?php echo $offer_title; ?>
						</h2>
					<?php } ?>
				</div>
			</div>
			<div class="pt-60">
				<div class="swiper swiper-container -paginate">
					<div class="swiper-wrapper">
						<?php foreach ($slides as $slide): ?>
							<div class="swiper-slide"><?php echo wp_get_attachment_image($slide, 'full', false, array('loading' => 'lazy')); ?></div>
						<?php endforeach; ?>
					</div>

					<div class="swiper-pagination"></div>
					<div class="swiper-button-prev"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
							 viewBox="0 0 21 20" fill="none">
							<path d="M16.9225 10.6609L7.26745 10.6609L11.0175 14.4109L9.83912 15.5893L4.07745 9.82758L9.83912 4.06592L11.0175 5.24425L7.26745 8.99425H16.9225V10.6609Z"
								  fill="#ff9800" />
						</svg></div>
					<div class="swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
							 viewBox="0 0 21 20" fill="none">
							<path d="M4.07745 8.99425L13.7325 8.99425L9.98245 5.24425L11.1608 4.06592L16.9225 9.82758L11.1608 15.5893L9.98245 14.4109L13.7325 10.6609H4.07745L4.07745 8.99425Z"
								  fill="#ff9800" />
						</svg></div>

				</div>
			</div>
		</section>
	<?php } ?>
	<section class="feedback pt-60 pb-120">
		<div class="container">
			<div class="section-title">
				<h2 class="section-title__title">
					Отзывы о нас
				</h2>
				<div class="colored-separator" style="text-align: center;">
					<div class="first-long stm-base-background-color"></div>
					<div class="last-short stm-base-background-color"></div>
				</div>
			</div>
			<div class="section-content">
				<div class="row ali-c jc-sa">
					<div class="col flex jc-c">
						<a href="<?php echo carbon_get_theme_option('feedback-google'); ?>" rel="noopener noreferrer"
						   target="_blank">
							<img width="250" height="117" src="/wp-content/uploads/2025/03/googlemaps-1.webp"
								 alt="Отзывы в Гугле">
						</a>
					</div>
					<div class="col flex jc-c">
						<a href="<?php echo carbon_get_theme_option('feedback-yandex'); ?>" rel="noopener noreferrer"
						   target="_blank">
							<img width="250" height="117" src="/wp-content/uploads/2025/03/yandexmaps.webp"
								 alt="Отзывы в Яндексе">
						</a>
					</div>
					<div class="col flex jc-c col--2gis">
						<a href="<?php echo carbon_get_theme_option('feedback-2gis'); ?>" rel="noopener noreferrer"
						   target="_blank">
							<img width="250" height="117" src="/wp-content/uploads/2025/03/2gis-1.webp"
								 alt="Отзывы на 2GIS">
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</main><!-- #main -->

<?php
get_footer();

<?php

/* Template Name: Главная */
get_header();

$rating_value = gomoto_get_theme_option('rating_value');
$rating_count = gomoto_get_theme_option('rating_count');

$schema = array(
	'@context'                  => 'https://schema.org',
	'@type'                     => 'MotorcycleRental',
	'@id'                       => 'https://gomoto.by/#organization',
	'name'                      => 'GoMoto — прокат мотоциклов в Минске',
	'url'                       => 'https://gomoto.by/',
	'logo'                      => 'https://gomoto.by/wp-content/uploads/2024/11/1212.png',
	'description'               => 'GoMoto — самый большой прокат мотоциклов в Минске. В наличии самые популярные мировые производители и модели мотоциклов. Прокат мотоциклов с экипировкой, страховкой и посуточной оплатой. Удобные условия и выгодные цены. Скидки и программа лояльности.',
	'priceRange'                => 'от 150 BYN/сутки',
	'telephone'                 => '+375 29 384 24 36',
	'email'                     => 'info@gomoto.by',
	'address'                   => array(
		'@type'           => 'PostalAddress',
		'streetAddress'   => 'Ждановичи, ул. Магистральная, 10',
		'addressLocality' => 'Минск',
		'postalCode'      => '220025',
		'addressCountry'  => 'BY',
	),
	'geo'                       => array(
		'@type'     => 'GeoCoordinates',
		'latitude'  => 53.933372,
		'longitude' => 27.410849,
	),
	'openingHoursSpecification' => array(
		array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'),
			'opens'     => '10:00',
			'closes'    => '21:00',
		),
		array(
			'@type'     => 'OpeningHoursSpecification',
			'dayOfWeek' => array('Saturday', 'Sunday'),
			'opens'     => '10:00',
			'closes'    => '21:00',
		),
	),
	'sameAs'                    => array(
		'https://www.instagram.com/gomoto.by/',
		'https://www.facebook.com/gomoto.by/',
		'https://t.me/gomotoby',
		'https://maps.app.goo.gl/cvYvo4iH2Y3z6EfD6',
		'https://yandex.by/maps/-/CLbF6J~P',
	),
	'potentialAction'           => array(
		array(
			'@type'               => 'RentalAction',
			'name'                => 'Арендовать мотоцикл в GoMoto',
			'target'              => array(
				'@type'          => 'EntryPoint',
				'urlTemplate'    => 'https://gomoto.by/',
				'inLanguage'     => 'ru',
				'actionPlatform' => array(
					'https://schema.org/DesktopWebPlatform',
					'https://schema.org/MobileWebPlatform',
				),
			),
			'expectsAcceptanceOf' => array(
				'@type'              => 'Offer',
				'priceCurrency'      => 'BYN',
				'priceSpecification' => array(
					'@type'         => 'PriceSpecification',
					'priceCurrency' => 'BYN',
					'price'         => 'от 150 BYN/сутки',
				),
				'availability'       => 'https://schema.org/InStock',
			),
			'agent'               => array(
				'@type' => 'Organization',
				'name'  => 'GoMoto',
				'url'   => 'https://gomoto.by',
			),
			'result'              => array(
				'@type' => 'Thing',
				'name'  => 'Арендованный мотоцикл',
			),
		),
		array(
			'@type'       => 'SearchAction',
			'target'      => 'https://gomoto.by/?s={search_term_string}',
			'query-input' => 'required name=search_term_string',
		),
	),
	'hasMap'                    => 'https://maps.app.goo.gl/YP4kGVMSZWezDtD5A',
	'license'                   => 'https://gomoto.by/',
);

// Добавляем aggregateRating, если заполнено в настройках
if ($rating_value && $rating_count) {
	$schema['aggregateRating'] = array(
		'@type'       => 'AggregateRating',
		'ratingValue' => $rating_value,
		'reviewCount' => $rating_count,
	);
}
?>
<script type="application/ld+json">
	<?php echo wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT); ?>
</script>
<main id="primary" class="site-main">
	<?php get_template_part('template-parts/hero'); ?>

	<section class="front-products woocommerce pt-60">
		<div class="container">
			<div class="section-content">

				<div class="section-title">
					<h2 class="section-title__title">Доступные мотоциклы</h2>
				</div>

				<?php $motorcycle_terms = gomoto_get_children_cats('motorcycles'); ?>

				<nav class="nav-tabs margin-y-section" 
					 data-product-category-nav="affordableMotorcycles">
					<button type="button" class="nav-tabs__link is-active"
							data-product-category-slug="">
						Все
					</button>
					<?php foreach ($motorcycle_terms as $term): ?>
						<button type="button" class="nav-tabs__link"
								data-product-category-slug="<?= esc_attr($term->slug); ?>">
							<?= esc_html($term->name); ?>
						</button>
					<?php endforeach; ?>

					<label class="nav-tabs__select-wrap">
						<span class="screen-reader-text visually-hidden">Выберите категорию мотоциклов</span>
						<select class="nav-tabs__select" data-product-category-select aria-label="Категория мотоциклов">
							<option value="">Все</option>
							<?php foreach ($motorcycle_terms as $term): ?>
								<option value="<?= esc_attr($term->slug); ?>">
									<?= esc_html($term->name); ?>
								</option>
							<?php endforeach; ?>
						</select>
					</label>
				</nav>

				<ul class="products" 
					style="margin-bottom: 4rem;" 
					id="affordableMotorcycles"
					>
					<?php
					$n        = 0;
					$products = gomoto_get_the_post_meta('offers');
					foreach ($products as $prod) {
						$_product = wc_get_product($prod['id']);
						++$n;

						$terms = array_map(fn($term) => $term->slug, gomoto_get_product_categories($prod['id']));
					?>
						<li class="product type-product"
							data-product-category-slugs="<?= esc_attr(json_encode($terms)); ?>">
							<?php
							get_template_part(
								'template-parts/product-card',
								null,
								[
									'product_id' => $prod['id'],
									'product' => $_product,
									'title_class' => 'fs-18',
									'excerpt_class' => 'fs-14',
									'image_link_class' => 'product-image-link',
								]
							);
							?>
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
					<?php echo do_shortcode('[gomoto_booking_form]'); ?>
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

				$subcategories = get_terms(
					array(
						'taxonomy'   => 'product_cat',
						'parent'     => 32,
						'hide_empty' => false,
					)
				);

				?>

				<ul class="categories__list" style="margin-bottom: 2rem;">
					<?php foreach ($subcategories as $subcategory) : ?>
						<?php
						$icon_id   = gomoto_get_term_meta($subcategory->term_id, 'product_category_icon');
						$icon_html = '';

						if ($icon_id) {
							// Выведет <img> с корректными alt, width, height
							$icon_html = wp_get_attachment_image(
								$icon_id,
								array(200, 120),
								false,
								array(
									'class'   => 'categories__list-image',
									'loading' => 'lazy',
									'sizes'   => '(min-width: 1300px) 16vw, (min-width: 1200px) 20vw, (min-width: 1024px) 25vw, (min-width: 768px) 33.33vw, 50vw',
								)
							);
						}
						?>
						<li class="categories__list-item">
							<a href="<?php echo esc_url(get_term_link($subcategory)); ?>" class="categories__list-link">
								<?php echo $icon_html; ?>
								<span><?php echo esc_html($subcategory->name); ?></span>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</section>

	<section class="sert bg-navy pt-60 pb-60">
		<div class="container">
			<div class="row flex ali-c">
				<div class="col col--2">
					<?php
					echo wp_get_attachment_image(
						gomoto_get_the_post_meta('sert-image'),
						'full',
						false,
						[
							'sizes' => '(min-width: 1240px) 610px, (min-width: 1024px) 50vw, 100vw',
						]
					);
					?>
				</div>
				<div class="col col--2 flex ali-c fd-c jc-c">
					<div class="sert__content bg-yellow p-30">
						<h3>
							<?php echo gomoto_get_the_post_meta('sert-title'); ?>
						</h3>
						<div class="body-4">
							<?php echo apply_filters('the_content', gomoto_get_the_post_meta('sert-text')); ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<section class="front-products woocommerce pt-60 pb-60">
		<div class="container">
			<div class="section-title">
				<?php if (! empty($offers_title = gomoto_get_the_post_meta('offers-2-title'))) { ?>
					<h2 class="section-title__title">
						<?php echo $offers_title; ?>
					</h2>
				<?php } ?>
			</div>
			<div class="section-content">
				<?php
				$products = gomoto_get_the_post_meta('offers-2');
				get_template_part(
					'template-parts/product-slider',
					null,
					[
						'products' => $products,
						'title_class' => 'fs-22',
						'excerpt_class' => 'fs-16',
						'image_link_class' => '',
					]
				);
				?>
			</div>
		</div>
	</section>
	<section class="banner pt-120 pb-120"
		style="background-image:url(<?php echo esc_url(wp_get_attachment_image_url(gomoto_get_the_post_meta('banner-image'), 'full')); ?>)">
		<div class="container">
			<div class="banner-content bg-red">
				<h3>
					<?php echo gomoto_get_the_post_meta('banner-title'); ?>
				</h3>
				<?php echo apply_filters('the_content', gomoto_get_the_post_meta('banner-text')); ?>
			</div>
		</div>
	</section>

	<?php if (! empty($questions = gomoto_get_the_post_meta('question'))) { ?>
		<section class="questions pt-60 pb-60">
			<div class="container">
				<div class="section-title">
					<?php if (! empty($questions_title = gomoto_get_the_post_meta('question-title'))) { ?>
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

						<?php
						foreach ($questions as $index => $question) :
							$id = 'accordion-item-' . ($index + 1);
						?>

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
														<path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4" />
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
			<?php if (trim(gomoto_get_the_post_meta('seo-text'))) : ?>
				<div class="seo__text pt-30">
					<?php echo apply_filters('the_content', gomoto_get_the_post_meta('seo-text')); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>


	<section class="directions pt-60 pb-60 bg-navy">
		<div class="container">
			<div class="row">
				<?php
				$class = 'bg-red';
				foreach (gomoto_get_the_post_meta('directions') as $direction) {
				?>
					<div class="col col--2">
						<div class="directions__item 
						<?php
						echo $class;
						$class = 'bg-yellow';
						?>
						p-40 flex ali-c gap-20">
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
				<div class="posts-swiper">
					<div class="posts swiper">
						<?php
						$query = new WP_Query('posts_per_page=3&ignore_sticky_posts=0&orderby=date');
						?>
						<?php
						if ($query->have_posts()) :
							$index = 0;
						?>
							<div class="swiper-wrapper">
								<?php
								while ($query->have_posts()) :
									$query->the_post();
									++$index;
									if ($index > 3) {
										break;
									}
								?>
									<div class="swiper-slide">
										<div class="post-item">
											<div class='post-item__image'>
												<a href="<?php echo esc_url(get_permalink()); ?>">
													<?php the_post_thumbnail([390, 390], [
														'sizes' => '(min-width: 1240px) 390px, (min-width: 1024px) 33.33vw, (min-width: 768px) 50vw, 100vw',
													]); ?>
												</a>
											</div>
											<h3 class="post-item__link">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
										</div>
									</div>
								<?php
								endwhile;
								wp_reset_postdata();
								?>
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
					</div>
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

	<?php if (! empty($slides = gomoto_get_post_meta(get_the_ID(), 'front-gallery'))) { ?>
		<section class="gallery bg-navy pt-60 pb-60">
			<div class="container">
				<div class="section-title">
					<?php if (! empty($offer_title = gomoto_get_the_post_meta('gallery-title'))) { ?>
						<h2 class="section-title__title">
							<?php echo $offer_title; ?>
						</h2>
					<?php } ?>
				</div>
			</div>
			<div class="pt-60">
				<div class="swiper -paginate">
					<div class="swiper-wrapper">
						<?php foreach ($slides as $slide) : ?>
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
						<a href="<?php echo esc_url(gomoto_get_theme_option('feedback-google')); ?>" rel="noopener noreferrer"
							target="_blank">
							<img width="250" height="117" loading="lazy" src="<?php echo esc_url('/wp-content/uploads/2025/03/googlemaps-1.webp'); ?>"
								alt="Отзывы в Гугле">
						</a>
					</div>
					<div class="col flex jc-c">
						<a href="<?php echo esc_url(gomoto_get_theme_option('feedback-yandex')); ?>" rel="noopener noreferrer"
							target="_blank">
							<img width="250" height="117" loading="lazy" src="<?php echo esc_url('/wp-content/uploads/2025/03/yandexmaps.webp'); ?>"
								alt="Отзывы в Яндексе">
						</a>
					</div>
					<div class="col flex jc-c col--2gis">
						<a href="<?php echo esc_url(gomoto_get_theme_option('feedback-2gis')); ?>" rel="noopener noreferrer"
							target="_blank">
							<img width="250" height="117" loading="lazy" src="<?php echo esc_url('/wp-content/uploads/2025/03/2gis-1.webp'); ?>"
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

<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
	Container::make( 'theme_options', __( 'Настройки сайта' ) )
		->add_tab(
			__( 'Контакты' ),
			array(
				Field::make( 'complex', 'phones', 'Телефоны' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields(
					array(
						Field::make( 'text', 'phone', 'Телефон' ),
						Field::make( 'text', 'department', 'Отдел' ),
					)
				),
				Field::make( 'complex', 'socials', 'Соцсети' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields(
					array(
						Field::make( 'text', 'icon', 'Иконка' ),
						Field::make( 'text', 'link', 'Ссылка' ),
						Field::make( 'checkbox', 'messenger', 'Мессенджер' )
							->set_option_value( 'yes' )
							->set_help_text( 'Отметьте, если это ссылка на мессенджер (WhatsApp/Telegram/Viber и т.д.).' ),
					)
				),
				Field::make( 'text', 'email', 'Email' ),
				Field::make( 'text', 'address', 'Адрес' ),
				Field::make( 'text', 'coord', 'Координаты' ),
				Field::make( 'text', 'scedule', 'График работы' ),
				Field::make( 'text', 'yandex-link', 'На картах' ),
				Field::make( 'text', 'yandex-route', 'Построить маршрут' ),
				Field::make( 'text', 'yandex-map', 'Карта' ),
				Field::make( 'text', 'copyright', 'Копирайт' ),
				Field::make( 'text', 'dev', 'Дев' ),

				Field::make( 'text', 'feedback-google', 'Ссылка на отзывы в Гугле' ),
				Field::make( 'text', 'feedback-yandex', 'Ссылка на отзывы в Яндексе' ),
				Field::make( 'text', 'feedback-2gis', 'Ссылка на отзывы в 2GIS' ),

				Field::make( 'rich_text', 'additional-text1', 'Дополнительный контент 1' ),
				Field::make( 'rich_text', 'additional-text2', 'Дополнительный контент 2' ),
				Field::make( 'rich_text', 'additional-text3', 'Дополнительный контент 3' ),

			)
		)

		->add_tab(
			__( 'Форма бронирования' ),
			array(
				Field::make( 'textarea', 'base-booking-form', 'Общая форма бронирования' )
					->set_help_text( 'Введите код общей формы бронирования' ),
			)
		)

		->add_tab(
			__( '404' ),
			array(
				Field::make( 'text', '404-title', 'Заголовок' ),
				Field::make( 'text', '404-subtitle', 'Подзаголовок' ),
				Field::make( 'complex', '404-buttons', 'Кнопки' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields(
					array(
						Field::make( 'text', 'text', 'Текст на кнопке' ),
						Field::make( 'text', 'link', 'Ссылка' ),
						Field::make( 'text', 'attr', 'Дополинтельные атрибуты' ),
						Field::make( 'html', 'example' )
							->set_html( '<b>Пример заполнения: </b><br>data-fancybox data-form-title="Отклик на вакансию" data-form-subtitle="Заправщик на АЗС" data-form-button="Откликнуться"' ),
						Field::make( 'select', 'color', __( 'Цвет' ) )
						->set_options(
							array(
								'red'   => 'Красная',
								'white' => 'Белая',
							)
						),
						Field::make( 'text', 'icon', 'Иконка' ),
					)
				),
				Field::make( 'image', '404-decor', 'Красивая картинка' ),
			)
		)
		->add_tab(
			'SEO',
			array(
				Field::make( 'text', 'rating_value', 'Рейтинг (ratingValue)' )
				->set_attribute( 'type', 'number' )
				->set_attribute( 'step', '0.1' ),

				Field::make( 'text', 'rating_count', 'Количество отзывов (reviewCount)' )
							->set_attribute( 'type', 'number' ),
			)
		)
		->add_tab(
			__( 'Скидки аренды' ),
			array(
				Field::make( 'complex', 'rent_discounts', 'Скидки' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields(
					array(
						Field::make( 'text', 'percent', 'Процент скидки (%)' )
							->set_attribute( 'type', 'number' )
							->set_attribute( 'min', 0 )
							->set_attribute( 'max', 100 ),

						Field::make( 'text', 'days', 'Описание дней' ),
					)
				)
				->set_header_template( '<%- percent %>%' ),
			)
		);

	Container::make( 'post_meta', 'Custom Data' )
		->where( 'post_id', '=', '132' )
		->add_tab(
			__( 'Скидки' ),
			array(
				Field::make( 'complex', 'discounts', 'Числа' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields(
					array(
						Field::make( 'text', 'number', 'Число' ),
						Field::make( 'text', 'text', 'Текст' ),
					)
				),
			)
		);
	Container::make( 'post_meta', 'Custom Data' )
		->where( 'post_id', '=', '12' )
		->add_tab(
			__( 'Вакансии' ),
			array(
				Field::make( 'complex', 'vacancies', 'Вакансии' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields(
					array(
						Field::make( 'text', 'title', 'Заголовок' ),
						Field::make( 'rich_text', 'text', 'Текст' ),
					)
				),
			)
		);
	Container::make( 'post_meta', 'Custom Data' )
		->where( 'post_template', '=', 'front-page.php' )

		->add_tab(
			__( 'Hero Видео' ),
			array(
				Field::make( 'file', 'hero_video_webm', 'Видео (webm)' )
					->set_type( array( 'video' ) )
					->set_help_text( 'Приоритетный формат видео, загружайте в .webm для наибольшей скорости загрузки.' )
					->set_width( 50 ),

				Field::make( 'file', 'hero_video_mp4', 'Видео (mp4)' )
					->set_type( array( 'video' ) )
					->set_help_text( 'Запасной формат видео, используйте формат .mp4.' )
					->set_width( 50 ),

				Field::make( 'file', 'hero_video_mobile_webm', 'Видео (Mobile, опционально, webm)' )
					->set_type( array( 'video' ) )
					->set_help_text( 'Если не указано — будет использоваться Desktop видео.' )
					->set_width( 50 ),

				Field::make( 'file', 'hero_video_mobile_mp4', 'Видео (Mobile, опционально, mp4)' )
					->set_type( array( 'video' ) )
					->set_help_text( 'Если не указано — будет использоваться Desktop видео.' )
					->set_width( 50 ),

				Field::make( 'image', 'hero_poster', 'Постер' )
					->set_width( 50 ),

				Field::make( 'text', 'hero_darkness', 'Степень затемнения (%)' )
					->set_attribute( 'type', 'number' )
					->set_attribute( 'min', 0 )
					->set_attribute( 'max', 100 )
					->set_default_value( 40 ),
			)
		)

		->add_tab(
			__( 'Мотоциклы на главной' ),
			array(
				Field::make( 'text', 'offers-title', 'Заголовок' ),
				Field::make( 'association', 'offers' )
				->set_types(
					array(
						array(
							'type'      => 'post',
							'post_type' => 'product',
						),
					)
				),
			)
		)
		->add_tab(
			__( 'Блок с картинкой (Подарочный сертификат)' ),
			array(
				Field::make( 'image', 'sert-image', 'Изображение' ),
				Field::make( 'text', 'sert-title', 'Заголовок' ),
				Field::make( 'rich_text', 'sert-text', 'Текст' ),

			)
		)
		->add_tab(
			__( 'Преимущества' ),
			array(
				Field::make( 'text', 'adv-title', 'Заголовок' ),
				Field::make( 'complex', 'adv', 'Преимущества' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields(
					array(
						Field::make( 'text', 'title', 'Заголовок' ),
						Field::make( 'text', 'text', 'Текст' ),
						Field::make( 'text', 'icon', 'Иконка' ),
					)
				),
			)
		)
		->add_tab(
			__( 'Аксессуары на главной' ),
			array(
				Field::make( 'text', 'offers-2-title', 'Заголовок' ),
				Field::make( 'association', 'offers-2' )
				->set_types(
					array(
						array(
							'type'      => 'post',
							'post_type' => 'product',
						),
					)
				),
			)
		)
		->add_tab(
			__( 'Блок с картинкой на фоне' ),
			array(
				Field::make( 'image', 'banner-image', 'Фон' ),
				Field::make( 'text', 'banner-title', 'Заголовок' ),
				Field::make( 'text', 'banner-text', 'Текст' ),
			)
		)
		->add_tab(
			__( 'SEO блок' ),
			array(
				Field::make( 'complex', 'seo-discounts', 'Скидки' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields(
					array(
						Field::make( 'text', 'text', 'Текст' ),
					)
				),

				Field::make( 'complex', 'seo-advantages', 'Плюсы' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields(
					array(
						Field::make( 'text', 'text', 'Текст' ),
					)
				),

				Field::make( 'complex', 'seo-included', 'Что входит в стоимость' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields(
					array(
						Field::make( 'text', 'text', 'Текст' ),
					)
				),
				Field::make( 'rich_text', 'seo-text', 'SEO Текст' ),
			)
		)

		->add_tab(
			__( 'Направления деятельности' ),
			array(
				Field::make( 'complex', 'directions', 'Направления деятельности' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields(
					array(
						Field::make( 'text', 'icon', 'Иконка' ),
						Field::make( 'text', 'title', 'Заголовок' ),
						Field::make( 'text', 'text', 'Текст' ),
					)
				),
			)
		)

		->add_tab(
			__( 'Популярные вопросы' ),
			array(
				Field::make( 'text', 'question-title', 'Заголовок' ),
				Field::make( 'complex', 'question', 'Популярные вопросы' )
				->set_layout( 'tabbed-horizontal' )
				->add_fields(
					array(
						Field::make( 'text', 'question', 'Вопрос' ),
						Field::make( 'rich_text', 'answer', 'Ответ' ),
					)
				),
			)
		)

		->add_tab(
			__( 'Галерея' ),
			array(
				Field::make( 'text', 'gallery-title', 'Заголовок' ),
				Field::make( 'media_gallery', 'front-gallery', 'Галерея' ),
			)
		);

	Container::make( 'post_meta', 'Custom Data' )
		->where( 'post_template', '=', 'page-contacts.php' )
		->add_tab(
			__( 'Контакты' ),
			array(
				Field::make( 'text', 'contacts-contacts-title', 'Заголовок' ),
				Field::make( 'text', 'contacts-contacts-subtitle', 'Подзаголовок' ),
				Field::make( 'media_gallery', 'contacts-gallery', 'Галерея' ),
			)
		);

	Container::make( 'post_meta', 'Custom Data' )
		->where( 'post_type', '=', 'product' )
		->add_tab(
			__( 'Общее' ),
			array(
				Field::make( 'select', 'product-type', 'Тип цены' )
				->add_options(
					array(
						'rent'     => 'Цена за сутки',
						'for-sale' => 'Цена',
					)
				),
				Field::make( 'text', 'price-text', 'Текст под ценником' ),
				Field::make( 'rich_text', 'additional-text', 'Дополнительный текст' ),
				Field::make( 'multiselect', 'product_stickers', 'Выберите стикеры' )
				->add_options(
					function () {
						$stickers = get_posts(
							array(
								'post_type'   => 'sticker',
								'numberposts' => -1,
							)
						);
						$options = array();

						foreach ( $stickers as $sticker ) {
							$title = get_the_title( $sticker->ID );
							$color = gomoto_get_post_meta( $sticker->ID, 'sticker_color' );

							$options[ $sticker->ID ] = "$title ($color)";
						}

						return $options;
					}
				)
				->set_help_text( 'Выберите не больше 3 стикеров. Больше 3 стикеров отображаться на карточке товара не будут.' ),
				Field::make( 'textarea', 'online-booking-form', 'Код формы бронирования' )
					->set_help_text( 'Вставьте сюда код формы бронирования для этого продукта' ),
			)
		)
		->add_tab(
			__( 'Скорость' ),
			array(
				Field::make( 'text', 'razgon', 'Разгон 0-100 км/ч' ),
				Field::make( 'text', 'max-skorost', 'Максимальная скорость' ),
			)
		)
		->add_tab(
			__( 'Прочее' ),
			array(
				Field::make( 'text', 'prochee-1', 'Сцепление' ),
				Field::make( 'text', 'prochee-2', 'КПП' ),
				Field::make( 'text', 'prochee-3', 'Привод' ),
				Field::make( 'text', 'prochee-4', 'Топливная система' ),
				Field::make_complex('additional_options', 'Дополнительные опции')
					->set_layout('tabbed-vertical')
					->add_fields(array(
						Field::make_text('option_name', 'Опция'),
					))
					->set_header_template( '
						<% if (option_name) { %>
							<%- option_name %>
						<% } %>
					' ),
				Field::make_complex('sounds', 'Звуки')
				->set_layout('tabbed-vertical')
				->add_fields(array(
					Field::make_text('sound_label', 'Название'),
					Field::make_file('sound_file', 'Файл')
						->set_type(array('audio')),
				))
				->set_header_template( '
					<% if (sound_label) { %>
						<%- sound_label %>
					<% } %>
				' )
			),
		);

	Container::make( 'term_meta', 'Custom Data' )
		->show_on_taxonomy( 'product_cat' )
		->add_fields(
			array(
				Field::make( 'text', 'category-title', 'Заголовок' ),
			)
		);
}

const GOMOTO_SOCIALS_FILTER_ALL                 = 'all';
const GOMOTO_SOCIALS_FILTER_ONLY_MESSENGERS     = 'only_messengers';
const GOMOTO_SOCIALS_FILTER_ONLY_NON_MESSENGERS = 'only_non_messengers';

function gomoto_get_socials( string $filter = GOMOTO_SOCIALS_FILTER_ALL ): array {
	$cache_group = 'theme_options';

	// Нормализуем фильтр на случай, если кто-то передал ерунду
	$allowed = array(
		GOMOTO_SOCIALS_FILTER_ALL,
		GOMOTO_SOCIALS_FILTER_ONLY_MESSENGERS,
		GOMOTO_SOCIALS_FILTER_ONLY_NON_MESSENGERS,
	);
	if ( ! in_array( $filter, $allowed, true ) ) {
		$filter = GOMOTO_SOCIALS_FILTER_ALL;
	}

	$cache_key = 'theme_socials_' . $filter;

	$cached = wp_cache_get( $cache_key, $cache_group );
	if ( $cached !== false ) {
		return $cached;
	}

	$socials = gomoto_get_theme_option( 'socials' ) ?: array();

	$socials = array_map(
		function ( $item ) {
			return array(
				'icon'      => $item['icon'] ?? '',
				'link'      => $item['link'] ?? '',
				'messenger' => ! empty( $item['messenger'] ),
			);
		},
		$socials
	);

	if ( $filter === GOMOTO_SOCIALS_FILTER_ONLY_MESSENGERS ) {
		$socials = array_values( array_filter( $socials, fn ( $s ) => ! empty( $s['messenger'] ) ) );
	} elseif ( $filter === GOMOTO_SOCIALS_FILTER_ONLY_NON_MESSENGERS ) {
		$socials = array_values( array_filter( $socials, fn ( $s ) => empty( $s['messenger'] ) ) );
	}

	wp_cache_set( $cache_key, $socials, $cache_group, 0 );

	return $socials;
}

function gomoto_get_additional_options() {
	$options = gomoto_get_the_post_meta('additional_options', []);
	if (!is_array($options)) {
		return [];
	}

	return array_map(fn($option) => $option['option_name'], $options);
}

function gomoto_get_motorcycle_sounds() {
	$options = gomoto_get_the_post_meta('sounds', []);
	if (!is_array($options)) {
		return [];
	}

	return array_map(fn($option) => array(
		'label' => $option['sound_label'],
		'file_id' => $option['sound_file'],
	), $options);
}

add_action(
	'carbon_fields_theme_options_container_saved',
	function () {
		wp_cache_delete( 'theme_socials_' . GOMOTO_SOCIALS_FILTER_ALL, 'theme_options' );
		wp_cache_delete( 'theme_socials_' . GOMOTO_SOCIALS_FILTER_ONLY_MESSENGERS, 'theme_options' );
		wp_cache_delete( 'theme_socials_' . GOMOTO_SOCIALS_FILTER_ONLY_NON_MESSENGERS, 'theme_options' );
	}
);

/**
 * Функция для получения кода общей формы бронирования из настроек темы.
 *
 * @return string Код формы бронирования или пустая строка, если поле не заполнено.
 */
function get_base_booking_form_code() {
	$booking_form_code = gomoto_get_theme_option( 'base-booking-form' );

	if ( ! empty( $booking_form_code ) ) {
		return $booking_form_code;
	} else {
		return '';
	}
}

/**
 * Регистрация шорткода [base_booking_form].
 */
function register_base_booking_form_shortcode() {
	add_shortcode( 'base_booking_form', 'get_base_booking_form_code' );
}

add_action( 'init', 'register_base_booking_form_shortcode' );

/**
 * Шорткод-обертка для формы бронирования с прелоадером.
 *
 * @param array       $atts    Атрибуты шорткода.
 * @param string|null $content Вложенный контент (опционально).
 * @return string
 */
function gomoto_booking_form_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'shortcode' => 'base_booking_form',
			'loader_text' => 'Загрузка формы...',
		),
		$atts,
		'gomoto_booking_form'
	);

	$inner = '';
	if ( $content !== null && trim( $content ) !== '' ) {
		$inner = do_shortcode( $content );
	} else {
		$inner = do_shortcode( '[' . $atts['shortcode'] . ']' );
	}

	if ( $inner === '' ) {
		return '';
	}

	$loader_text = esc_html( $atts['loader_text'] );

	return '<div class="rentprog-container is-loading" data-rentprog-container aria-busy="true">'
		. '<div class="rentprog-loader" role="status" aria-live="polite">'
		. '<div class="rentprog-spinner" aria-hidden="true"></div>'
		. '<div class="rentprog-loader__text">' . $loader_text . '</div>'
		. '</div>'
		. $inner
		. '</div>';
}

/**
 * Регистрация шорткода [gomoto_booking_form].
 */
function register_gomoto_booking_form_shortcode() {
	add_shortcode( 'gomoto_booking_form', 'gomoto_booking_form_shortcode' );
}

add_action( 'init', 'register_gomoto_booking_form_shortcode' );

function registerStickerPostType() {
	$args = array(
		'label'    => 'Стикеры',
		'public'   => false,
		'show_ui'  => true,
		'supports' => array( 'title' ),
	);

	register_post_type( 'sticker', $args );
}

add_action( 'init', 'registerStickerPostType' );

add_action(
	'carbon_fields_register_fields',
	function () {
		Container::make( 'post_meta', 'Настройки стикера' )
		->where( 'post_type', '=', 'sticker' )
		->add_fields(
			array(
				Field::make( 'color', 'sticker_color', 'Цвет стикера' )
					->set_help_text( 'Выберите цвет или укажите вручную!' ),
			)
		);

		Container::make( 'term_meta', 'Дополнительные настройки' )
		->where( 'term_taxonomy', '=', 'product_cat' )
		->add_fields(
			array(
				Field::make( 'image', 'product_category_icon', 'Иконка категории' )
					->set_value_type( 'id' )
					->set_help_text( 'Загрузите иконку для категории' ),
			)
		);
	}
);

add_action(
	'after_setup_theme',
	function () {
		\Carbon_Fields\Carbon_Fields::boot();
	}
);

<?php
/**
 * MLine functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package MLine
 */


require_once get_theme_file_path('inc/schema-utils.php');
require_once get_theme_file_path('inc/schema-builders.php');

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'crb_attach_theme_options');
function crb_attach_theme_options()
{
	Container::make('theme_options', __('Настройки сайта'))
		->add_tab(__('Контакты'), array(
			Field::make('complex', 'phones', 'Телефоны')
				->set_layout('tabbed-horizontal')
				->add_fields(array(
					Field::make('text', 'phone', 'Телефон'),
					Field::make('text', 'department', 'Отдел'),
				)),
			Field::make('complex', 'socials', 'Соцсети')
				->set_layout('tabbed-horizontal')
				->add_fields(array(
					Field::make('text', 'icon', 'Иконка'),
					Field::make('text', 'link', 'Ссылка'),
					Field::make('checkbox', 'messenger', 'Мессенджер')
						->set_option_value('yes')
						->set_help_text('Отметьте, если это ссылка на мессенджер (WhatsApp/Telegram/Viber и т.д.).'),
				)),
			Field::make('text', 'email', 'Email'),
			Field::make('text', 'address', 'Адрес'),
			Field::make('text', 'coord', 'Координаты'),
			Field::make('text', 'scedule', 'График работы'),
			Field::make('text', 'yandex-link', 'На картах'),
			Field::make('text', 'yandex-route', 'Построить маршрут'),
			Field::make('text', 'yandex-map', 'Карта'),
			Field::make('text', 'copyright', 'Копирайт'),
			Field::make('text', 'dev', 'Дев'),

			Field::make('text', 'feedback-google', 'Ссылка на отзывы в Гугле'),
			Field::make('text', 'feedback-yandex', 'Ссылка на отзывы в Яндексе'),
			Field::make('text', 'feedback-2gis', 'Ссылка на отзывы в 2GIS'),

			Field::make('rich_text', 'additional-text1', 'Дополнительный контент 1'),
			Field::make('rich_text', 'additional-text2', 'Дополнительный контент 2'),
			Field::make('rich_text', 'additional-text3', 'Дополнительный контент 3'),
			
			
		))

		->add_tab(__('Форма бронирования'), [
			Field::make('textarea', 'base-booking-form', 'Общая форма бронирования')
				->set_help_text('Введите код общей формы бронирования'),
		])

		->add_tab(__('404'), array(
			Field::make('text', '404-title', 'Заголовок'),
			Field::make('text', '404-subtitle', 'Подзаголовок'),
			Field::make('complex', '404-buttons', 'Кнопки')
				->set_layout('tabbed-horizontal')
				->add_fields(array(
					Field::make('text', 'text', 'Текст на кнопке'),
					Field::make('text', 'link', 'Ссылка'),
					Field::make('text', 'attr', 'Дополинтельные атрибуты'),
					Field::make('html', 'example')
						->set_html('<b>Пример заполнения: </b><br>data-fancybox data-form-title="Отклик на вакансию" data-form-subtitle="Заправщик на АЗС" data-form-button="Откликнуться"'),
					Field::make('select', 'color', __('Цвет'))
						->set_options(array(
							'red' => 'Красная',
							'white' => 'Белая',
						)),
					Field::make('text', 'icon', 'Иконка'),
				)),
			Field::make('image', '404-decor', 'Красивая картинка'),
		))
		->add_tab('SEO', array(
			Field::make('text', 'rating_value', 'Рейтинг (ratingValue)')
            ->set_attribute('type', 'number')
            ->set_attribute('step', '0.1'),

        Field::make('text', 'rating_count', 'Количество отзывов (reviewCount)')
            ->set_attribute('type', 'number'),
		))
		->add_tab(__('Скидки аренды'), array(
        Field::make('complex', 'rent_discounts', 'Скидки')
            ->set_layout('tabbed-horizontal')
            ->add_fields(array(
                Field::make('text', 'percent', 'Процент скидки (%)')
                    ->set_attribute('type', 'number')
                    ->set_attribute('min', 0)
                    ->set_attribute('max', 100),

                Field::make('text', 'days', 'Описание дней'),
            ))
            ->set_header_template('<%- percent %>%')
    	));


	Container::make('post_meta', 'Custom Data')
		->where('post_id', '=', '132')
		->add_tab(__('Скидки'), array(
			Field::make('complex', 'discounts', 'Числа')
				->set_layout('tabbed-horizontal')
				->add_fields(array(
					Field::make('text', 'number', 'Число'),
					Field::make('text', 'text', 'Текст'),
				)),
		));
	Container::make('post_meta', 'Custom Data')
		->where('post_id', '=', '12')
		->add_tab(__('Вакансии'), array(
			Field::make('complex', 'vacancies', 'Вакансии')
				->set_layout('tabbed-horizontal')
				->add_fields(array(
					Field::make('text', 'title', 'Заголовок'),
					Field::make('rich_text', 'text', 'Текст'),
				)),
		));
	Container::make('post_meta', 'Custom Data')
		->where('post_template', '=', 'front-page.php')

		->add_tab(__('Hero Видео'), array(
			Field::make('file', 'hero_video_webm', 'Видео (webm)')
				->set_type(array('video'))
				->set_help_text('Приоритетный формат видео, загружайте в .webm для наибольшей скорости загрузки.')
				->set_width(50),

			Field::make('file', 'hero_video_mp4', 'Видео (mp4)')
				->set_type(array('video'))
				->set_help_text('Запасной формат видео, используйте формат .mp4.')
				->set_width(50),

			Field::make('file', 'hero_video_mobile_webm', 'Видео (Mobile, опционально, webm)')
				->set_type(array('video'))
				->set_help_text('Если не указано — будет использоваться Desktop видео.')
				->set_width(50),

			Field::make('file', 'hero_video_mobile_mp4', 'Видео (Mobile, опционально, mp4)')
				->set_type(array('video'))
				->set_help_text('Если не указано — будет использоваться Desktop видео.')
				->set_width(50),
								
			Field::make('image', 'hero_poster', 'Постер')
				->set_width(50),

			Field::make('text', 'hero_darkness', 'Степень затемнения (%)')
				->set_attribute('type', 'number')
				->set_attribute('min', 0)
				->set_attribute('max', 100)
				->set_default_value(40),
		))

		->add_tab(__('Мотоциклы на главной'), array(
			Field::make('text', 'offers-title', 'Заголовок'),
			Field::make('association', 'offers')
				->set_types(array(
					array(
						'type' => 'post',
						'post_type' => 'product',
					),
				))
		))
		->add_tab(__('Блок с картинкой (Подарочный сертификат)'), array(
			Field::make('image', 'sert-image', 'Изображение'),
			Field::make('text', 'sert-title', 'Заголовок'),
			Field::make('rich_text', 'sert-text', 'Текст'),

		))
		->add_tab(__('Преимущества'), array(
			Field::make('text', 'adv-title', 'Заголовок'),
			Field::make('complex', 'adv', 'Преимущества')
				->set_layout('tabbed-horizontal')
				->add_fields(array(
					Field::make('text', 'title', 'Заголовок'),
					Field::make('text', 'text', 'Текст'),
					Field::make('text', 'icon', 'Иконка')
				)),
		))
		->add_tab(__('Аксессуары на главной'), array(
			Field::make('text', 'offers-2-title', 'Заголовок'),
			Field::make('association', 'offers-2')
				->set_types(array(
					array(
						'type' => 'post',
						'post_type' => 'product',
					),
				))
		))
		->add_tab(__('Блок с картинкой на фоне'), array(
			Field::make('image', 'banner-image', 'Фон'),
			Field::make('text', 'banner-title', 'Заголовок'),
			Field::make('text', 'banner-text', 'Текст'),
		))
		->add_tab(__('SEO блок'), array(
			Field::make('complex', 'seo-discounts', 'Скидки')
				->set_layout('tabbed-horizontal')
				->add_fields(array(
					Field::make('text', 'text', 'Текст')
				)),

			Field::make('complex', 'seo-advantages', 'Плюсы')
				->set_layout('tabbed-horizontal')
				->add_fields(array(
					Field::make('text', 'text', 'Текст')
				)),

			Field::make('complex', 'seo-included', 'Что входит в стоимость')
				->set_layout('tabbed-horizontal')
				->add_fields(array(
					Field::make('text', 'text', 'Текст')
				)),
			Field::make('rich_text', 'seo-text', 'SEO Текст'),
		))

		->add_tab(__('Направления деятельности'), array(
			Field::make('complex', 'directions', 'Направления деятельности')
				->set_layout('tabbed-horizontal')
				->add_fields(array(
					Field::make('text', 'icon', 'Иконка'),
					Field::make('text', 'title', 'Заголовок'),
					Field::make('text', 'text', 'Текст')
				)),
		))

		->add_tab(__('Популярные вопросы'), array(
			Field::make('text', 'question-title', 'Заголовок'),
			Field::make('complex', 'question', 'Популярные вопросы')
				->set_layout('tabbed-horizontal')
				->add_fields(array(
					Field::make('text', 'question', 'Вопрос'),
					Field::make('rich_text', 'answer', 'Ответ'),
				)),
		))

		->add_tab(__('Галерея'), array(
			Field::make('text', 'gallery-title', 'Заголовок'),
			Field::make('media_gallery', 'front-gallery', 'Галерея'),
		));


	Container::make('post_meta', 'Custom Data')
		->where('post_template', '=', 'page-contacts.php')
		->add_tab(__('Контакты'), array(
			Field::make('text', 'contacts-contacts-title', 'Заголовок'),
			Field::make('text', 'contacts-contacts-subtitle', 'Подзаголовок'),
			Field::make('media_gallery', 'contacts-gallery', 'Галерея'),
		));

	Container::make('post_meta', 'Custom Data')
		->where('post_type', '=', 'product')
		->add_tab(__('Общее'), array(
			Field::make('select', 'product-type', 'Тип цены')
				->add_options(array(
					'rent' => 'Цена за сутки',
					'for-sale' => 'Цена',
				)),
			Field::make('text', 'price-text', 'Текст под ценником'),
			Field::make('rich_text', 'additional-text', 'Дополнительный текст'),
			Field::make('multiselect', 'product_stickers', 'Выберите стикеры')
				->add_options(function () {
					$stickers = get_posts([
						'post_type' => 'sticker',
						'numberposts' => -1
					]);
					$options = [];

					foreach ($stickers as $sticker) {
						$title = get_the_title($sticker->ID);
						$color = carbon_get_post_meta($sticker->ID, 'sticker_color');

						$options[$sticker->ID] = "$title ($color)";
					}

					return $options;
				})
				->set_help_text('Выберите не больше 3 стикеров. Больше 3 стикеров отображаться на карточке товара не будут.'),
			Field::make('textarea', 'online-booking-form', 'Код формы бронирования')
				->set_help_text('Вставьте сюда код формы бронирования для этого продукта')
		))
		->add_tab(__('Скорость'), array(
			Field::make('text', 'razgon', 'Разгон 0-100 км/ч'),
			Field::make('text', 'max-skorost', 'Максимальная скорость'),
		))
		->add_tab(__('Прочее'), array(
			Field::make('text', 'prochee-1', 'Сцепление'),
			Field::make('text', 'prochee-2', 'КПП'),
			Field::make('text', 'prochee-3', 'Привод'),
			Field::make('text', 'prochee-4', 'Топливная система'),
		));

	Container::make('term_meta', 'Custom Data')
		->show_on_taxonomy('product_cat')
		->add_fields(array(
			Field::make('text', 'category-title', 'Заголовок'),
		));
}

const GOMOTO_SOCIALS_FILTER_ALL = 'all';
const GOMOTO_SOCIALS_FILTER_ONLY_MESSENGERS = 'only_messengers';
const GOMOTO_SOCIALS_FILTER_ONLY_NON_MESSENGERS = 'only_non_messengers';

function gomoto_get_socials(string $filter = GOMOTO_SOCIALS_FILTER_ALL): array
{
    $cache_group = 'theme_options';

    // Нормализуем фильтр на случай, если кто-то передал ерунду
    $allowed = [
        GOMOTO_SOCIALS_FILTER_ALL,
        GOMOTO_SOCIALS_FILTER_ONLY_MESSENGERS,
        GOMOTO_SOCIALS_FILTER_ONLY_NON_MESSENGERS,
    ];
    if (!in_array($filter, $allowed, true)) {
        $filter = GOMOTO_SOCIALS_FILTER_ALL;
    }

    $cache_key = 'theme_socials_' . $filter;

    $cached = wp_cache_get($cache_key, $cache_group);
    if ($cached !== false) {
        return $cached;
    }

    $socials = carbon_get_theme_option('socials') ?: [];

    $socials = array_map(function ($item) {
        return [
            'icon'      => $item['icon'] ?? '',
            'link'      => $item['link'] ?? '',
            'messenger' => !empty($item['messenger']),
        ];
    }, $socials);

    if ($filter === GOMOTO_SOCIALS_FILTER_ONLY_MESSENGERS) {
        $socials = array_values(array_filter($socials, fn ($s) => !empty($s['messenger'])));
    } elseif ($filter === GOMOTO_SOCIALS_FILTER_ONLY_NON_MESSENGERS) {
        $socials = array_values(array_filter($socials, fn ($s) => empty($s['messenger'])));
    }

    wp_cache_set($cache_key, $socials, $cache_group, 0);

    return $socials;
}

add_action('carbon_fields_theme_options_container_saved', function () {
    wp_cache_delete('theme_socials_' . GOMOTO_SOCIALS_FILTER_ALL, 'theme_options');
    wp_cache_delete('theme_socials_' . GOMOTO_SOCIALS_FILTER_ONLY_MESSENGERS, 'theme_options');
    wp_cache_delete('theme_socials_' . GOMOTO_SOCIALS_FILTER_ONLY_NON_MESSENGERS, 'theme_options');
});

/**
 * Функция для получения кода общей формы бронирования из настроек темы.
 *
 * @return string Код формы бронирования или пустая строка, если поле не заполнено.
 */
function get_base_booking_form_code()
{
	$booking_form_code = carbon_get_theme_option('base-booking-form');

	if (!empty($booking_form_code)) {
		return $booking_form_code;
	} else {
		return '';
	}
}

/**
 * Регистрация шорткода [base_booking_form].
 */
function register_base_booking_form_shortcode()
{
	add_shortcode('base_booking_form', 'get_base_booking_form_code');
}

add_action('init', 'register_base_booking_form_shortcode');

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function mline_setup()
{

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support('title-tag');

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__('Primary', 'mline'),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height' => 250,
			'width' => 250,
			'flex-width' => true,
			'flex-height' => true,
		)
	);
}
add_action('after_setup_theme', 'mline_setup');


add_action('wp_footer', 'enqueue_scripts_to_footer');

function enqueue_scripts_to_footer()
{

	// JavaScript
	wp_enqueue_script('fancybox', get_stylesheet_directory_uri() . '/js/fancybox.js', array('jquery'));
	wp_enqueue_script('swiper-fancy-mask', get_stylesheet_directory_uri() . '/js/swiper-fancy-mask.js', array('jquery'));
	wp_enqueue_script('custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'));
}

add_filter('wpcf7_autop_or_not', '__return_false');

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

add_action('after_setup_theme', 'woocommerce_support');
function woocommerce_support()
{
	add_theme_support('woocommerce');
}

remove_filter('get_the_excerpt', 'wp_trim_excerpt');

add_filter('woocommerce_catalog_orderby', 'custom_orderby_options');
function custom_orderby_options($sortby)
{
	$sortby['menu_order'] = 'Сортировать';

	unset($sortby['popularity']);
	unset($sortby['rating']);
	unset($sortby['date']);

	$sortby['year'] = 'По возрастанию года';
	$sortby['year-desc'] = 'По убыванию года';

	return $sortby;
}

add_action('wp_enqueue_scripts', 'theme_add_scripts');

function theme_add_scripts()
{
	wp_enqueue_style('fancybox', get_template_directory_uri() . '/css/fancybox.css');
}

add_filter('woocommerce_get_catalog_ordering_args', 'year_order');
function year_order($args)
{
	$orderby_value = isset($_GET['orderby']) ? wc_clean($_GET['orderby']) :
		apply_filters('woocommerce_default_catalog_orderby', get_option('woocommerce_default_catalog_orderby'));

	if ($orderby_value == 'year-desc') {
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = '_attribute_pa_god';
		$args['order'] = 'DESC';
	} elseif ($orderby_value == 'year') {
		$args['orderby'] = 'meta_value_num';
		$args['meta_key'] = '_attribute_pa_god';
		$args['order'] = 'ASC';
	}


	return $args;
}

add_action('woocommerce_process_product_meta', 'save_product_attributes_as_meta');
function save_product_attributes_as_meta($post_id)
{
	$product = wc_get_product($post_id);

	$attributes = $product->get_attributes();

	if (!empty($attributes)) {
		foreach ($attributes as $attribute) {
			$attribute_name = $attribute->get_name();
			$attribute_value = $product->get_attribute($attribute_name);

			$meta_key = '_' . 'attribute_' . sanitize_title($attribute_name);

			update_post_meta($post_id, $meta_key, $attribute_value);
		}
	}

}

function registerStickerPostType()
{
	$args = [
		'label' => 'Стикеры',
		'public' => false,
		'show_ui' => true,
		'supports' => ['title'],
	];

	register_post_type('sticker', $args);
}

add_action('init', 'registerStickerPostType');

add_action('carbon_fields_register_fields', function () {
	Container::make('post_meta', 'Настройки стикеры')
		->where('post_type', '=', 'sticker')
		->add_fields([
			Field::make('color', 'sticker_color', 'Цвет стикера')
				->set_help_text('Выберите цвет или укажите вручную!'),
		]);

	Container::make('term_meta', 'Дополнительные настройки')
		->where('term_taxonomy', '=', 'product_cat')
		->add_fields([
			Field::make('image', 'product_category_icon', 'Иконка категории')
				->set_value_type('id')
				->set_help_text('Загрузите иконку для категории')
		]);
});

add_action('after_setup_theme', function () {
	\Carbon_Fields\Carbon_Fields::boot();
});

function theme_preload_product_main_image() {
	if ( ! is_product() ) {
		return;
	}

	global $product;
	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$image_id  = $product->get_image_id();
	$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'woocommerce_single' ) : '';

	if ( $image_url ) {
		$type = esc_attr( get_post_mime_type( $image_id ) );
		echo '<link rel="preload" as="image" href="' . esc_url( $image_url ) . '" type="' . $type . '">' . "\n";
	}
}
add_action( 'wp_head', 'theme_preload_product_main_image', 1 );

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

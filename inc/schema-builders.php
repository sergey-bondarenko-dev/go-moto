<?php

function gomoto_get_product_schema(WC_Product $product, array $contacts): array {
    $post_id = get_the_ID();
    $permalink = get_permalink($post_id);

    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id'   => $permalink,
        ],
        'name' => get_the_title(),
        'description' => wp_strip_all_tags($product->get_short_description() ?: get_the_excerpt()),
        'sku' => $product->get_sku() ?: 'gomoto-' . $post_id,
        'brand' => ['@type' => 'Brand', 'name' => 'GoMoto'],
        'offers' => [
            '@type' => 'Offer',
            'url' => $permalink,
            'priceCurrency' => 'BYN',
            'price' => $product->get_price() ? (string) floatval($product->get_price()) : '',
            'availability' => $product->is_in_stock()
                ? 'https://schema.org/InStock'
                : 'https://schema.org/OutOfStock',
            'seller' => gomoto_get_publisher_schema($contacts),
            'priceValidUntil' => date('Y-m-d', strtotime('+1 year')),
        ],
    ];

    // Добавляем изображения
    $images = array_filter(array_merge(
        [wp_get_attachment_image_url($product->get_image_id(), 'full')],
        array_map(fn($id) => wp_get_attachment_image_url($id, 'full'), $product->get_gallery_image_ids())
    ));
    if ($images) $schema['image'] = $images;

    // Категории
    $terms = wp_get_post_terms($post_id, 'product_cat', ['fields' => 'names']);
    if ($terms) $schema['category'] = $terms;

    // Доп. свойства
    $props = [
        'Разгон 0–100 км/ч' => carbon_get_post_meta($post_id, 'razgon'),
        'Максимальная скорость' => carbon_get_post_meta($post_id, 'max-skorost'),
        'Сцепление' => carbon_get_post_meta($post_id, 'prochee-1'),
        'КПП' => carbon_get_post_meta($post_id, 'prochee-2'),
        'Привод' => carbon_get_post_meta($post_id, 'prochee-3'),
        'Топливная система' => carbon_get_post_meta($post_id, 'prochee-4'),
    ];

    $schema['additionalProperty'] = array_reduce(array_keys($props), function($carry, $key) use ($props) {
        if ($props[$key]) {
            $carry[] = [
                '@type' => 'PropertyValue',
                'name' => $key,
                'value' => $props[$key],
            ];
        }
        return $carry;
    }, []);

    return $schema;
}

function gomoto_get_article_schema(array $contacts): array {
    $post_id = get_the_ID();

    return [
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'mainEntityOfPage' => [
            '@type' => 'WebPage',
            '@id'   => get_permalink(),
        ],
        'headline' => get_the_title(),
        'description' => wp_strip_all_tags(get_the_excerpt() ?: ''),
        'image' => get_the_post_thumbnail_url($post_id, 'full') ?: '',
        'datePublished' => get_the_date('c', $post_id),
        'dateModified' => get_the_modified_date('c', $post_id),
        'author' => [
            '@type' => 'Person',
            'name' => get_the_author(),
            'url'  => get_author_posts_url(get_the_author_meta('ID')),
        ],
        'publisher' => gomoto_get_publisher_schema($contacts),
        'inLanguage' => 'ru-RU',
    ];
}

function gomoto_get_publisher_schema(array $contacts): array {
    return [
        '@type' => 'Organization',
        'name' => 'GoMoto',
        'url' => home_url(),
        'logo' => [
            '@type' => 'ImageObject',
            'url' => get_theme_file_uri('/assets/img/logo.png'),
            'width' => 347,
            'height' => 100,
        ],
        'telephone' => $contacts['phoneMain'],
        'email' => $contacts['email'],
        'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Минск',
            'streetAddress' => $contacts['address'],
            'addressCountry' => 'BY',
        ],
    ];
}

<?php
/**
 * Product card markup shared between Woo loops and custom lists.
 *
 * Args:
 * - product_id (int)
 * - product (WC_Product)
 */

$product_id = isset($args['product_id']) ? (int) $args['product_id'] : 0;
$product = $args['product'] ?? null;

if (!$product_id && $product instanceof WC_Product) {
	$product_id = $product->get_id();
}

if (!$product_id) {
	$product_id = get_the_ID();
}

if (!$product instanceof WC_Product) {
	$product = wc_get_product($product_id);
}

if (!$product instanceof WC_Product) {
	return;
}

$sizes = $args['sizes'] ?? '(min-width: 1240px) 283px, (min-width: 1024px) 25vw, (min-width: 768px) 33.333vw, (min-width: 361px) 50vw, 300px';
$title_class = $args['title_class'] ?? 'fs-18';
$excerpt_class = $args['excerpt_class'] ?? 'fs-14';
$image_link_class = $args['image_link_class'] ?? 'product-image-link';
?>
<div class="colored-separator" style="text-align: center;">
	<div class="first-long stm-base-background-color"></div>
	<div class="last-short stm-base-background-color"></div>
</div>
<?php if (has_post_thumbnail($product_id)) { ?>
	<a href="<?php echo esc_url(get_permalink($product_id)); ?>"<?php echo $image_link_class ? ' class="' . esc_attr($image_link_class) . '"' : ''; ?>>
		<?php echo get_the_post_thumbnail($product_id, [300, 300], [
			'sizes' => $sizes,
		]); ?>

		<?php
		$stickerIds = gomoto_get_post_meta($product_id, 'product_stickers');
		if (!empty($stickerIds)):
			$stickerIds = array_slice($stickerIds, 0, 3);
			?>
			<div class="stickers-wrapper">
				<?php foreach ($stickerIds as $stickerId):
					$stickerText = get_the_title($stickerId);
					$stickerColor = gomoto_get_post_meta($stickerId, 'sticker_color'); ?>

					<span class="product-sticker" style="background-color: <?php echo esc_attr($stickerColor); ?>;">
						<?php echo esc_html($stickerText); ?>
					</span>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</a>
<?php } ?>
<h3 class="<?php echo esc_attr($title_class); ?>">
	<a href="<?php echo esc_url(get_permalink($product_id)); ?>">
		<?php echo esc_html($product->get_title()); ?>
	</a>
</h3>
<p class="<?php echo esc_attr($excerpt_class); ?>"><?php echo esc_html(get_the_excerpt($product_id)); ?></p>
<?php if (!empty($product->get_price())): ?>
	<div class="product__price">
		<?php if (gomoto_get_post_meta($product_id, 'product-type') == 'rent') { ?>
			<div class="product-price fs-16">
				<span class="red"><?php echo esc_html($product->get_price()); ?> BYN / сутки</span>
			</div>
		<?php } else { ?>
			<div class="product-price fs-16">
				<span class="red"><?php echo esc_html($product->get_price()); ?> BYN</span>
			</div>
		<?php } ?>
	</div>
<?php else: ?>
	<div class="product__price">
		<div class="product-price fs-16">
			<span class="red">
				Бесплатно
			</span>
		</div>
	</div>
<?php endif; ?>

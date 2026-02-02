<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.4.0
 */

defined('ABSPATH') || exit;

global $product;

// Check if the product is a valid WooCommerce product and ensure its visibility before proceeding.
if (!is_a($product, WC_Product::class) || !$product->is_visible()) {
	return;
}
?>
<li <?php wc_product_class('', $product); ?>>
	<div class="colored-separator" style="text-align: center;">
		<div class="first-long stm-base-background-color"></div>
		<div class="last-short stm-base-background-color"></div>
	</div>
	<?php if (has_post_thumbnail()) { ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="product-image-link">
			<?php the_post_thumbnail('woocommerce_thumbnail'); ?>

			<?php

			$stickerIds = gomoto_get_post_meta(get_the_ID(), 'product_stickers');

			if (!empty($stickerIds)):
				$stickerIds = array_slice($stickerIds, 0, 3) ?>

				<div class="stickers-wrapper">

					<?php foreach ($stickerIds as $stickerId):
						$stickerText = get_the_title($stickerId);
						$stickerColor = gomoto_get_post_meta($stickerId, 'sticker_color'); ?>

						<span class="product-sticker" style="background-color: <?= $stickerColor ?>;">
							<?= $stickerText ?>
						</span>


					<?php endforeach; ?>

				</div>

			<?php endif; ?>
		</a>
	<?php } ?>
	<h3 class="fs-18"><a href="<?php the_permalink(); ?>"><?php echo $product->get_title(); ?></a></h3>
	<p class="fs-14"><?= get_the_excerpt() ?></p>
	<?php if (!empty($product->get_price())): ?>
		<div class="product__price">
			<?php if (gomoto_get_post_meta(get_the_ID(), 'product-type') == 'rent') { ?>
				<div class="product-price fs-16"><span class="red"><?php echo $product->get_price(); ?> BYN / сутки</span></div>
			<?php } else { ?>
				<div class="product-price fs-16"><span class="red"><?php echo $product->get_price(); ?> BYN</span></div>
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
</li>


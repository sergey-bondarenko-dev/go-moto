<?php

add_filter('wpseo_json_ld_output', '__return_false');
get_header();

$product = wc_get_product(get_the_ID());
if ($product) {
    $contacts = gomoto_get_theme_contacts();
    $schema = gomoto_get_product_schema($product, $contacts);
    gomoto_render_schema($schema);
}

$product_type = gomoto_get_the_post_meta('product-type');

?>


<main id="primary" class="site-main">
	<section class="pt-60 pb-60">
		<div class="container">
			<div class="page">
				<div class="product-content">

					<div class="row gap-40">
						<div class="col -right">
							<div class="product-gallery">
								<div class="swiper slider">
									<div class="swiper-wrapper">
										<?php if (!empty($thumbnail_url = get_the_post_thumbnail_url())) { ?>
											<div class="swiper-slide">
												<a data-src="<?php echo $thumbnail_url; ?>" data-fancybox="gallery">
													<?php echo get_the_post_thumbnail(null, 'woocommerce_single'); ?>
												</a>
											</div>
										<?php } ?>
										<?php $attachment_ids = $product->get_gallery_image_ids();

										foreach ($attachment_ids as $attachment_id) {
											?>
											<div class="swiper-slide">
												<a data-src="<?php echo wp_get_attachment_url($attachment_id); ?>"
												   data-fancybox="gallery">
													<?php echo wp_get_attachment_image($attachment_id, 'full'); ?>
												</a>
											</div>
										<?php } ?>
									</div>
									<div class="swiper-button-prev">
										<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
											 viewBox="0 0 21 20" fill="none">
											<path d="M16.9225 10.6609L7.26745 10.6609L11.0175 14.4109L9.83912 15.5893L4.07745 9.82758L9.83912 4.06592L11.0175 5.24425L7.26745 8.99425H16.9225V10.6609Z"
												  fill="#ff9800" />
										</svg>
									</div>
									<div class="swiper-button-next">
										<svg xmlns="http://www.w3.org/2000/svg" width="21" height="20"
											 viewBox="0 0 21 20" fill="none">
											<path d="M4.07745 8.99425L13.7325 8.99425L9.98245 5.24425L11.1608 4.06592L16.9225 9.82758L11.1608 15.5893L9.98245 14.4109L13.7325 10.6609H4.07745L4.07745 8.99425Z"
												  fill="#ff9800" />
										</svg>
									</div>
								</div>
								<div class="swiper slider-thumbnail">
									<div class="swiper-wrapper">
										<?php if (!empty($thumbnail_url = get_the_post_thumbnail_url())) { ?>
											<div class="swiper-slide">
												<?php echo get_the_post_thumbnail(null, 'woocommerce_gallery_thumbnail'); ?>
											</div>
										<?php } ?>
										<?php $attachment_ids = $product->get_gallery_image_ids();

										foreach ($attachment_ids as $attachment_id) {
											?>
											<div class="swiper-slide">
												<?php echo wp_get_attachment_image($attachment_id, 'woocommerce_gallery_thumbnail'); ?>
											</div>
										<?php } ?>
									</div>
									<div class="swiper-button-prev"><svg xmlns="http://www.w3.org/2000/svg" width="21"
											 height="20" viewBox="0 0 21 20" fill="none">
											<path d="M16.9225 10.6609L7.26745 10.6609L11.0175 14.4109L9.83912 15.5893L4.07745 9.82758L9.83912 4.06592L11.0175 5.24425L7.26745 8.99425H16.9225V10.6609Z"
												  fill="#ff9800" />
										</svg></div>
									<div class="swiper-button-next"><svg xmlns="http://www.w3.org/2000/svg" width="21"
											 height="20" viewBox="0 0 21 20" fill="none">
											<path d="M4.07745 8.99425L13.7325 8.99425L9.98245 5.24425L11.1608 4.06592L16.9225 9.82758L11.1608 15.5893L9.98245 14.4109L13.7325 10.6609H4.07745L4.07745 8.99425Z"
												  fill="#ff9800" />
										</svg></div>
								</div>
							</div>
							<div class="product__content mt20">
								<?= apply_filters('the_content', gomoto_get_the_post_meta('additional-text')); ?>
							</div>


						</div>
						<div class="col -left">
							<h1 class="fs-44" style="margin-bottom: 20px"><?php echo the_title(); ?></h1>

							<div class="product__price">
								
								<?php if (empty($product->get_price())): ?>
								
									<div class="product_price-price bg-red">
										<span></span><span>Бесплатно с мотоциклом</span>
									</div>
								
								<?php else: ?>

									<?php if ($product_type === 'rent') { ?>
									<div class="product_price-price bg-red">
										<span>сутки</span><span><?php echo $product->get_price(); ?> BYN</span>
									</div>
									<?php } else { ?>
									<div class="product_price-price bg-red"><span><?php echo $product->get_price(); ?>
										BYN</span></div>
									<?php } ?>
								
								<?php endif; ?>
								
								<?php if (!empty($text = gomoto_get_the_post_meta('price-text'))) { ?>
								<div class="product_price-included bg-navy fs-14"><?php echo $text; ?></div>
								<?php } ?>
								
								<?php if (!empty($product->get_price()) && $product_type === 'rent'): ?>
									<?php get_template_part('template-parts/rent-prices', null, array('price' => (float) $product->get_price())); ?>
								<?php endif; ?>
							</div>
							
							<div class="row gap-20 flex jc-spb">
								<div class="col">
									<div class="product__phones">
										<h3>Позвонить</h3>
										<div class="header-contact ali-fs">
											<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
													 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512"
													 x="0" y="0" viewBox="0 0 25.625 25.625"
													 style="enable-background:new 0 0 512 512" xml:space="preserve"
													 class="">
													<g>
														<path d="M22.079 17.835c-1.548-1.324-3.119-2.126-4.648-.804l-.913.799c-.668.58-1.91 3.29-6.712-2.234-4.801-5.517-1.944-6.376-1.275-6.951l.918-.8c1.521-1.325.947-2.993-.15-4.71l-.662-1.04C7.535.382 6.335-.743 4.81.58l-.824.72c-.674.491-2.558 2.087-3.015 5.119-.55 3.638 1.185 7.804 5.16 12.375 3.97 4.573 7.857 6.87 11.539 6.83 3.06-.033 4.908-1.675 5.486-2.272l.827-.721c1.521-1.322.576-2.668-.973-3.995l-.931-.801z"
															  style="" fill="#030104" data-original="#030104"></path>
													</g>
												</svg></div>
											<div class="header-content-text">
												<?php foreach (gomoto_get_theme_option('phones') as $phone) { ?>
													<a
													   href="tel:<?php echo $phone['phone']; ?>"><b><?php echo $phone['phone']; ?></b></a>
												<?php } ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col">
									<div class="product__phones">
										<h3>Написать</h3>

										<div class="socials">
											<?php foreach (gomoto_get_socials(GOMOTO_SOCIALS_FILTER_ONLY_MESSENGERS) as $social) { ?>
												<a href="<?php echo $social['link']; ?>"
													target="_blank"><?php echo $social['icon']; ?></a>
											<?php } ?>
										</div>
									</div>
								</div>
							</div>
<div style="text-align: center; flex: 1 1 auto;"><a class="wp-block-button__link wp-element-button" style="max-width: 200px; margin: 0 auto;" href="#booking" >Забронировать онлайн</a></div>
<div class="wp-block-spacer" style="height: 15px;" aria-hidden="true"></div>
							<div class="product__content">
								<?php the_content(); ?>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
	<section class="product__content product__content--mobile pb-60" style="display: none">
		<div class="container">
			<div class="product__content mt20">
				<?= apply_filters('the_content', gomoto_get_the_post_meta('additional-text')); ?>
			</div>
		</div>
	</section>
	<?php if ($product->has_attributes()) { ?>
		<section class="details pb-60">
			<div class="container">
				<div class="secition-title">
					<h2 class="section-title__title">Характеристики</h2>
				</div>
				<div class="section-content">
					<div class="row gap-40">
						<div class="col col--2">
							<div class="details__wrapper">
								<h5 class="flex ali-c gap-10">
									<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
										 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
										 viewBox="0 0 480 480" style="enable-background:new 0 0 512 512"
										 xml:space="preserve" class="">
										<g>
											<path d="m477.656 226.344-16-16A8 8 0 0 0 456 208h-24a8 8 0 0 0-8 8v40h-16v-56a8 8 0 0 0-8-8h-51.72l-29.6-44.44A8 8 0 0 0 312 144h-48v-16h56a8 8 0 0 0 8-8V88a8 8 0 0 0-8-8H160a8 8 0 0 0-8 8v32a8 8 0 0 0 8 8h56v16h-48a8 8 0 0 0-6.656 3.56L131.72 192H88a8 8 0 0 0-8 8v48H64v-48a8 8 0 0 0-8-8H24a8 8 0 0 0-6.656 3.56l-16 24A8.052 8.052 0 0 0 0 224v24a8.052 8.052 0 0 0 1.344 4.44L16 274.4V344a8 8 0 0 0 8 8h32a8 8 0 0 0 8-8v-48h16v48a8 8 0 0 0 8 8h43.72l29.6 44.44A8 8 0 0 0 168 400h232a8 8 0 0 0 8-8v-72h16v56a8 8 0 0 0 8 8h24a8 8 0 0 0 5.656-2.344l16-16A8 8 0 0 0 480 360V232a8 8 0 0 0-2.344-5.656zM48 256v80H32v-64a8.052 8.052 0 0 0-1.344-4.44L16 245.6v-19.2L28.28 208H48v48zm32 24H64v-16h16v16zm88-168V96h144v16H168zm80 16v16h-16v-16h16zm112 256H172.28l-29.6-44.44A8 8 0 0 0 136 336H96V208h40a8 8 0 0 0 6.656-3.56L172.28 160h135.44l29.6 44.44A8 8 0 0 0 344 208h16v176zm32-120v120h-16V208h16v56zm32 40h-16v-32h16v32zm40 52.688L452.688 368H440V224h12.688L464 235.312v121.376z"
												  fill="#ff9800" opacity="1" data-original="#ff98000" class=""></path>
											<path d="M309.897 258.593A8 8 0 0 0 304 256h-38.024l13.832-62.264a8 8 0 0 0-13.216-7.632l-96 88A8 8 0 0 0 176 288h38.024l-13.832 62.264a8 8 0 0 0 13.216 7.632l96-88a8 8 0 0 0 .489-11.303zm-88.577 70.343 10.488-47.2A7.999 7.999 0 0 0 224 272h-27.432l62.112-56.936-10.488 47.2A7.999 7.999 0 0 0 256 272h27.432l-62.112 56.936zM112 256h16v64h-16zM112 224h16v16h-16z"
												  fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
										</g>
									</svg>
									Общее
								</h5>
								<?php echo wc_display_product_attributes($product); ?>
							</div>
						</div>
						<div class="col col--2">
							<?php if ((!empty(gomoto_get_the_post_meta('razgon'))) || (!empty(gomoto_get_the_post_meta('max-skorost')))) { ?>
								<div class="details__wrapper">
									<h5 class="flex ali-c gap-10">
										<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
											 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
											 viewBox="0 0 682.667 682.667" style="enable-background:new 0 0 512 512"
											 xml:space="preserve" class="">
											<g>
												<defs>
													<clipPath id="b" clipPathUnits="userSpaceOnUse">
														<path d="M0 512h512V0H0Z" fill="#ff9800" opacity="1"
															  data-original="#ff9800"></path>
													</clipPath>
												</defs>
												<mask id="a">
													<rect width="100%" height="100%" fill="#ffffff" opacity="1"
														  data-original="#ffffff"></rect>
												</mask>
												<g mask="url(#a)">
													<g clip-path="url(#b)" transform="matrix(1.33333 0 0 -1.33333 0 682.667)">
														<path d="M0 0c42.468 30.144 92.354 45.218 142.236 45.218 62.982 0 125.967-24.029 174.025-72.086 39.294-39.294 62.961-89.472 69.87-141.955 6.883-52.28-3.027-106.791-30.853-154.988-9.547-16.614-30.756-22.343-47.37-12.795-16.614 9.548-22.343 30.757-12.796 47.371 19.983 34.611 27.094 73.805 22.141 111.428-4.927 37.418-21.952 73.346-50.27 101.663-34.444 34.445-79.595 51.668-124.747 51.668-45.151 0-90.3-17.223-124.747-51.668-28.317-28.317-45.343-64.245-50.268-101.663-4.953-37.623 2.157-76.817 22.139-111.428 9.548-16.614 3.82-37.823-12.795-47.371-16.614-9.548-37.823-3.819-47.371 12.795-27.825 48.196-37.734 102.708-30.852 154.988 5.751 43.672 23.104 85.751 51.408 121.288m18.463 20.667.1.101"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:22.926;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(113.763 419.005)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="22.926"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="M0 0a51.267 51.267 0 0 0-7.271-9.14c-19.981-19.981-52.376-19.981-72.358 0-19.98 19.981-19.98 52.377 0 72.358 19.982 19.982 52.377 19.982 72.358 0C2.288 53.66 7.271 41.26 7.684 28.737"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:22.926;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(299.465 191.059)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="22.926"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="M0 0h-66.101"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:22.926;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(77.782 218.114)" fill="none" stroke="#ff9800"
															  stroke-width="20" stroke-linecap="round" stroke-linejoin="round"
															  stroke-miterlimit="22.926" stroke-dasharray="none"
															  stroke-opacity="" data-original="#ff9800" class=""></path>
														<path d="m0 0-57.514 33.205"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:22.926;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(101.782 307.151)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="22.926"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="m0 0-33.875 58.674"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:22.926;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(167.281 371.778)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="22.926"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="M0 0v66.59"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:22.926;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(255.999 396.081)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="22.926"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="m0 0 33.313 57.699"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:22.926;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(344.999 372.266)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="22.926"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="m0 0 58.192 33.598"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:22.926;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(409.877 306.955)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="22.926"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="M0 0h67.278"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:22.926;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(433.628 218.114)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="22.926"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="M196 77.78h119.999v32H196Z"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:22.926;stroke-dasharray:none;stroke-opacity:1"
															  fill="none" stroke="#ff9800" stroke-width="20"
															  stroke-linecap="round" stroke-linejoin="round"
															  stroke-miterlimit="22.926" stroke-dasharray="none"
															  stroke-opacity="" data-original="#ff9800" class=""></path>
														<path d="m0 0-195.829 31.998c-10.732 1.753-16.799 13.718-13.985 24.221l.001.001c2.813 10.503 14.047 17.832 24.221 13.984z"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:22.926;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(446.726 166.997)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="22.926"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="M0 0h.236"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2.613;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(108.195 218.116)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="2.613"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="m0 0 .118-.205"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2.613;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(182.112 346.109)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="2.613"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="m0 0-.118-.205"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2.613;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(329.916 346.091)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="2.613"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="M0 0h-.235"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2.613;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(403.802 218.081)" fill="none"
															  stroke="#ff9800" stroke-width="20" stroke-linecap="round"
															  stroke-linejoin="round" stroke-miterlimit="2.613"
															  stroke-dasharray="none" stroke-opacity="" data-original="#ff9800"
															  class=""></path>
														<path d="M0 0h-.235m70.001-.002H28.731"
															  style="stroke-width:20;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:2.613;stroke-dasharray:none;stroke-opacity:1"
															  transform="translate(221.234 47.78)" fill="none" stroke="#ff9800"
															  stroke-width="20" stroke-linecap="round" stroke-linejoin="round"
															  stroke-miterlimit="2.613" stroke-dasharray="none"
															  stroke-opacity="" data-original="#ff9800" class=""></path>
													</g>
												</g>
											</g>
										</svg>
										Скорость

									</h5>
									<?php if (!empty($detail1 = gomoto_get_the_post_meta('razgon'))) { ?>
										<div class="detail flex ali-c gap-10">
											<span>Разгон 0-100 км/ч</span>
											<span><?php echo $detail1; ?></span>
										</div>
									<?php } ?>
									<?php if (!empty($detail2 = gomoto_get_the_post_meta('max-skorost'))) { ?>
										<div class="detail flex ali-c gap-10">
											<span>Максимальная скорость</span>
											<span><?php echo $detail2; ?></span>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
							<?php if ((!empty($detail3 = gomoto_get_the_post_meta('prochee-1'))) || (!empty($detail3 = gomoto_get_the_post_meta('prochee-2'))) || (!empty($detail3 = gomoto_get_the_post_meta('prochee-3'))) || (!empty($detail3 = gomoto_get_the_post_meta('prochee-4')))) { ?>
								<div class="details__wrapper">
									<h5 class="flex ali-c gap-10">
										<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
											 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
											 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
											 xml:space="preserve" class="">
											<g>
												<circle cx="452" cy="60" r="40"
														style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
														fill="none" stroke="#ff9800" stroke-width="40" stroke-linecap="round"
														stroke-linejoin="round" stroke-miterlimit="10" data-original="#ff9800">
												</circle>
												<circle cx="256" cy="60" r="40"
														style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
														fill="none" stroke="#ff9800" stroke-width="40" stroke-linecap="round"
														stroke-linejoin="round" stroke-miterlimit="10" data-original="#ff9800">
												</circle>
												<circle cx="60" cy="60" r="40"
														style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
														fill="none" stroke="#ff9800" stroke-width="40" stroke-linecap="round"
														stroke-linejoin="round" stroke-miterlimit="10" data-original="#ff9800">
												</circle>
												<circle cx="60" cy="452" r="40"
														style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
														fill="none" stroke="#ff9800" stroke-width="40" stroke-linecap="round"
														stroke-linejoin="round" stroke-miterlimit="10" data-original="#000000">
												</circle>
												<circle cx="256" cy="452" r="40"
														style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
														fill="none" stroke="#ff9800" stroke-width="40" stroke-linecap="round"
														stroke-linejoin="round" stroke-miterlimit="10" data-original="#ff9800">
												</circle>
												<path d="M452 100v112c0 22.091-17.909 40-40 40H60v160M60 252V100M256 100v312"
													  style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
													  fill="none" stroke="#ff9800" stroke-width="40" stroke-linecap="round"
													  stroke-linejoin="round" stroke-miterlimit="10" data-original="#ff9800">
												</path>
												<circle cx="452" cy="452" r="40"
														style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
														fill="none" stroke="#ff9800" stroke-width="40" stroke-linecap="round"
														stroke-linejoin="round" stroke-miterlimit="10" data-original="#ff9800">
												</circle>
												<path d="M452 332v80"
													  style="stroke-width:40;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
													  fill="none" stroke="#ff9800" stroke-width="40" stroke-linecap="round"
													  stroke-linejoin="round" stroke-miterlimit="10" data-original="#ff9800">
												</path>
											</g>
										</svg>
										Прочее
									</h5>
									<?php if (!empty($detail3 = gomoto_get_the_post_meta('prochee-1'))) { ?>
										<div class="detail flex ali-c gap-10">
											<span>Сцепление</span>
											<span><?php echo $detail3; ?></span>
										</div>
									<?php } ?>
									<?php if (!empty($detail4 = gomoto_get_the_post_meta('prochee-2'))) { ?>
										<div class="detail flex ali-c gap-10">
											<span>КПП</span>
											<span><?php echo $detail4; ?></span>
										</div>
									<?php } ?>
									<?php if (!empty($detail5 = gomoto_get_the_post_meta('prochee-3'))) { ?>
										<div class="detail flex ali-c gap-10">
											<span>Привод</span>
											<span><?php echo $detail5; ?></span>
										</div>
									<?php } ?>
									<?php if (!empty($detail6 = gomoto_get_the_post_meta('prochee-4'))) { ?>
										<div class="detail flex ali-c gap-10">
											<span>Топливная система</span>
											<span><?php echo $detail6; ?></span>
										</div>
									<?php } ?>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>
	<?php } ?>
	<section class="seo-block pb-60">
		<div class="container">
			<div class="secition-title">
				<h2 class="section-title__title">Преимущества GoMoto</h2>
			</div>
			<div class="section-content">
				<div class="row gap-40">
					<div class="col col--2">
						<h4 class="flex gap-10 ali-c">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
								 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
								 viewBox="0 0 8.467 8.467" style="enable-background:new 0 0 512 512"
								 xml:space="preserve" class="">
								<g>
									<path d="M4.233.265A3.973 3.973 0 0 0 .265 4.233a3.973 3.973 0 0 0 3.968 3.97 3.973 3.973 0 0 0 3.97-3.97A3.973 3.973 0 0 0 4.232.265zm0 .529a3.437 3.437 0 0 1 3.442 3.44 3.44 3.44 0 0 1-3.442 3.441 3.437 3.437 0 0 1-3.44-3.442 3.436 3.436 0 0 1 3.44-3.44zM4.23 2.118a.265.265 0 0 0-.26.268v.223c-.427.08-.793.355-.793.832 0 .33.15.598.35.754s.426.224.624.29c.199.067.37.13.467.206.098.075.144.14.144.338 0 .44-1.056.44-1.056 0a.265.265 0 1 0-.529 0c0 .476.366.752.793.832v.222a.265.265 0 1 0 .529 0V5.86c.427-.08.793-.356.793-.832 0-.331-.15-.599-.35-.754-.2-.156-.426-.226-.624-.292-.199-.066-.37-.129-.468-.204-.097-.076-.144-.14-.144-.338 0-.441 1.056-.441 1.056 0a.265.265 0 1 0 .53 0c0-.476-.366-.751-.793-.832v-.223a.265.265 0 0 0-.27-.268z"
										  fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
								</g>
							</svg>
							Скидки
						</h4>
						<div class="flex gap-10 ali-c body-4">
							Скидки суммируются с картой постоянного клиента
						</div>
						<?php foreach (gomoto_get_post_meta(2, 'seo-discounts') as $li) { ?>
							<div class="flex gap-10 ali-c grey uppercase body-4">
								<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
									 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
									 viewBox="0 0 60 60" style="enable-background:new 0 0 512 512" xml:space="preserve"
									 class="">
									<g>
										<path d="M58 12H2a2 2 0 0 0-2 2v32a2 2 0 0 0 2 2h56a2 2 0 0 0 2-2V14a2 2 0 0 0-2-2ZM2 46V14h56v32Z"
											  fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
										<path d="M54.284 21.949a5.01 5.01 0 0 1-4.233-4.23A1.985 1.985 0 0 0 48.078 16H11.922a2.006 2.006 0 0 0-1.973 1.716 5.011 5.011 0 0 1-4.229 4.233A1.984 1.984 0 0 0 4 23.922v12.156a1.985 1.985 0 0 0 1.716 1.974 5.011 5.011 0 0 1 4.233 4.229A2.008 2.008 0 0 0 11.922 44h36.156a1.985 1.985 0 0 0 1.973-1.719 5.01 5.01 0 0 1 4.234-4.23A1.984 1.984 0 0 0 56 36.078V23.922a2.006 2.006 0 0 0-1.716-1.973ZM54 36.071a7.011 7.011 0 0 0-4.215 2.262A6.908 6.908 0 0 0 48.078 42h-36.15A7 7 0 0 0 6 36.078v-12.15A7 7 0 0 0 11.922 18h36.15A7.01 7.01 0 0 0 54 23.929Z"
											  fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
										<path d="M12 26a4 4 0 1 0 4 4 4 4 0 0 0-4-4Zm0 6a2 2 0 1 1 2-2 2 2 0 0 1-2 2ZM44 30a4 4 0 1 0 4-4 4 4 0 0 0-4 4Zm6 0a2 2 0 1 1-2-2 2 2 0 0 1 2 2ZM30 20a10 10 0 1 0 10 10 10.011 10.011 0 0 0-10-10Zm0 18a8 8 0 1 1 8-8 8.009 8.009 0 0 1-8 8Z"
											  fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
										<path d="M30 29a1 1 0 1 1 .867-1.5 1 1 0 1 0 1.731-1A2.993 2.993 0 0 0 31 25.2V25a1 1 0 0 0-2 0v.184A2.993 2.993 0 0 0 30 31a1 1 0 1 1-.867 1.5 1 1 0 0 0-1.731 1 3 3 0 0 0 1.6 1.3v.2a1 1 0 0 0 2 0v-.183A2.993 2.993 0 0 0 30 29Z"
											  fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
									</g>
								</svg>
								<span><?php echo $li['text']; ?></span>
							</div>
						<?php } ?>
						<div class="flex gap-10 ali-c grey uppercase body-4">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
								 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
								 viewBox="0 0 512.032 512.032" style="enable-background:new 0 0 512 512"
								 xml:space="preserve" class="">
								<g>
									<path d="M496.016 224c-8.832 0-16 7.168-16 16v181.184l-128 51.2V304c0-8.832-7.168-16-16-16s-16 7.168-16 16v168.352l-128-51.2V167.648l74.144 29.664c8.096 3.264 17.504-.704 20.8-8.928 3.296-8.192-.704-17.504-8.928-20.8l-95.776-38.336h-.032l-.256-.096a15.87 15.87 0 0 0-11.872 0l-.288.096h-.032L10.064 193.152A16.005 16.005 0 0 0 .016 208v288c0 5.312 2.656 10.272 7.04 13.248a15.892 15.892 0 0 0 8.96 2.752c2.016 0 4.032-.384 5.952-1.152l154.048-61.6 153.76 61.504h.032l.288.128a15.87 15.87 0 0 0 11.872 0l.288-.128h.032L502 446.88c6.016-2.464 10.016-8.32 10.016-14.88V240c0-8.832-7.168-16-16-16zm-336 197.152-128 51.2V218.816l128-51.2v253.536zM400.016 64c-26.464 0-48 21.536-48 48s21.536 48 48 48 48-21.536 48-48-21.536-48-48-48zm0 64c-8.832 0-16-7.168-16-16s7.168-16 16-16 16 7.168 16 16-7.168 16-16 16z"
										  fill="#ff9800" opacity="1" data-original="#ff9800"></path>
									<path d="M400.016 0c-61.76 0-112 50.24-112 112 0 57.472 89.856 159.264 100.096 170.688 3.04 3.36 7.36 5.312 11.904 5.312s8.864-1.952 11.904-5.312C422.16 271.264 512.016 169.472 512.016 112c0-61.76-50.24-112-112-112zm0 247.584c-34.944-41.44-80-105.056-80-135.584 0-44.096 35.904-80 80-80s80 35.904 80 80c0 30.496-45.056 94.144-80 135.584z"
										  fill="#ff9800" opacity="1" data-original="#ff9800"></path>
								</g>
							</svg>
							<span>Карты GoMoto Club<a href="/gomoto-club/">Подробнее</a></span>
						</div>
						<div class="flex gap-10 ali-c grey uppercase body-4">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
								 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
								 viewBox="0 0 527.927 527.926" style="enable-background:new 0 0 512 512"
								 xml:space="preserve" class="">
								<g>
									<path d="M0 168.707v190.524c0 25.178 20.425 45.621 45.642 45.621h380.684c25.188 0 45.622-20.443 45.622-45.621v-19.967h33.153c12.594 0 22.826-10.232 22.826-22.836V210.619c0-12.584-10.223-22.807-22.826-22.807h-33.153v-19.105c0-25.197-20.435-45.632-45.622-45.632H45.642C20.425 123.065 0 143.51 0 168.707zm426.325 190.524H45.642V168.707h380.684v190.524z"
										  fill="#ff9800" opacity="1" data-original="#ff9800"></path>
									<path d="M99.957 324.997h7.822c10.557 0 19.125-8.568 19.125-19.125v-83.825c0-10.557-8.568-19.125-19.125-19.125h-7.822c-10.566 0-19.125 8.568-19.125 19.125v83.825c0 10.556 8.558 19.125 19.125 19.125zM185.445 324.997h7.822c10.557 0 19.125-8.568 19.125-19.125v-83.825c0-10.557-8.568-19.125-19.125-19.125h-7.822c-10.557 0-19.125 8.568-19.125 19.125v83.825c0 10.556 8.569 19.125 19.125 19.125zM270.973 324.997h7.774c10.566 0 19.125-8.568 19.125-19.125v-83.825c0-10.557-8.559-19.125-19.125-19.125h-7.774c-10.567 0-19.125 8.568-19.125 19.125v83.825c0 10.556 8.558 19.125 19.125 19.125z"
										  fill="#ff9800" opacity="1" data-original="#ff9800"></path>
								</g>
							</svg>
							<span>Спецтарифы<a href="/exclusive-rates/">Подробнее</a></span>
						</div>


					</div>
					<div class="col col--2">
						<div class="flex gap-10 ali-c body-4">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
								 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
								 viewBox="0 0 511.985 511.985" style="enable-background:new 0 0 512 512"
								 xml:space="preserve" class="">
								<g>
									<path d="M500.088 83.681c-15.841-15.862-41.564-15.852-57.426 0L184.205 342.148 69.332 227.276c-15.862-15.862-41.574-15.862-57.436 0-15.862 15.862-15.862 41.574 0 57.436l143.585 143.585c7.926 7.926 18.319 11.899 28.713 11.899 10.394 0 20.797-3.963 28.723-11.899l287.171-287.181c15.862-15.851 15.862-41.574 0-57.435z"
										  fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
								</g>
							</svg>
							<span>Все мотоциклы с ТО и страховкой</span>
						</div>
						<div class="flex gap-10 ali-c body-4">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
								 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
								 viewBox="0 0 511.985 511.985" style="enable-background:new 0 0 512 512"
								 xml:space="preserve" class="">
								<g>
									<path d="M500.088 83.681c-15.841-15.862-41.564-15.852-57.426 0L184.205 342.148 69.332 227.276c-15.862-15.862-41.574-15.862-57.436 0-15.862 15.862-15.862 41.574 0 57.436l143.585 143.585c7.926 7.926 18.319 11.899 28.713 11.899 10.394 0 20.797-3.963 28.723-11.899l287.171-287.181c15.862-15.851 15.862-41.574 0-57.435z"
										  fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
								</g>
							</svg>
							<span>Для резидентов — без залога</span>
						</div>
						<div class="flex gap-10 ali-c body-4">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
								 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
								 viewBox="0 0 511.985 511.985" style="enable-background:new 0 0 512 512"
								 xml:space="preserve" class="">
								<g>
									<path d="M500.088 83.681c-15.841-15.862-41.564-15.852-57.426 0L184.205 342.148 69.332 227.276c-15.862-15.862-41.574-15.862-57.436 0-15.862 15.862-15.862 41.574 0 57.436l143.585 143.585c7.926 7.926 18.319 11.899 28.713 11.899 10.394 0 20.797-3.963 28.723-11.899l287.171-287.181c15.862-15.851 15.862-41.574 0-57.435z"
										  fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
								</g>
							</svg>
							<span>Любая форма оплаты</span>
						</div>
						<div class="flex gap-10 ali-c body-4">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
								 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
								 viewBox="0 0 511.985 511.985" style="enable-background:new 0 0 512 512"
								 xml:space="preserve" class="">
								<g>
									<path d="M500.088 83.681c-15.841-15.862-41.564-15.852-57.426 0L184.205 342.148 69.332 227.276c-15.862-15.862-41.574-15.862-57.436 0-15.862 15.862-15.862 41.574 0 57.436l143.585 143.585c7.926 7.926 18.319 11.899 28.713 11.899 10.394 0 20.797-3.963 28.723-11.899l287.171-287.181c15.862-15.851 15.862-41.574 0-57.435z"
										  fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
								</g>
							</svg>
							<span>Консультация и помощь в выборе</span>
						</div>

						<h4 class="flex gap-10 ali-c ">
							<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
								 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
								 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"
								 class="">
								<g>
									<path d="M467 76H45C20.238 76 0 96.149 0 121v270c0 24.86 20.251 45 45 45h422c24.762 0 45-20.149 45-45V121c0-24.857-20.248-45-45-45zm-6.91 30L267.624 299.094c-5.864 5.882-17.381 5.886-23.248 0L51.91 106h408.18zM30 385.485v-258.97L159.065 256 30 385.485zM51.91 406l128.334-128.752 42.885 43.025c17.574 17.631 48.175 17.624 65.743 0l42.885-43.024L460.09 406H51.91zM482 385.485 352.935 256 482 126.515v258.97z"
										  fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
								</g>
							</svg>
							Контакты
						</h4>



						<div class="header-contact">
							<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
									 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
									 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
									 xml:space="preserve" class="">
									<g>
										<path d="M256 0C153.755 0 70.573 83.182 70.573 185.426c0 126.888 165.939 313.167 173.004 321.035 6.636 7.391 18.222 7.378 24.846 0 7.065-7.868 173.004-194.147 173.004-321.035C441.425 83.182 358.244 0 256 0zm0 278.719c-51.442 0-93.292-41.851-93.292-93.293S204.559 92.134 256 92.134s93.291 41.851 93.291 93.293-41.85 93.292-93.291 93.292z"
											  fill="#000000" opacity="1" data-original="#000000"></path>
									</g>
								</svg></div>
							<div class="header-content-text">
								<span>Телефоны:</span>
								<?php foreach (gomoto_get_theme_option('phones') as $phone) { ?>
									<a href="tel:<?php echo $phone['phone']; ?>"><?php echo $phone['phone']; ?></a>
								<?php } ?>
							</div>
						</div>









						<div class="header-contact">
							<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
									 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
									 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
									 xml:space="preserve" class="">
									<g>
										<path d="M256 0C153.755 0 70.573 83.182 70.573 185.426c0 126.888 165.939 313.167 173.004 321.035 6.636 7.391 18.222 7.378 24.846 0 7.065-7.868 173.004-194.147 173.004-321.035C441.425 83.182 358.244 0 256 0zm0 278.719c-51.442 0-93.292-41.851-93.292-93.293S204.559 92.134 256 92.134s93.291 41.851 93.291 93.293-41.85 93.292-93.291 93.292z"
											  fill="#000000" opacity="1" data-original="#000000"></path>
									</g>
								</svg></div>
							<div class="header-content-text">
								<span>Время работы:</span>
								<?php echo gomoto_get_theme_option('scedule'); ?>
							</div>
						</div>




						<div class="header-contact">
							<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
									 xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
									 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
									 xml:space="preserve" class="">
									<g>
										<path d="M256 0C153.755 0 70.573 83.182 70.573 185.426c0 126.888 165.939 313.167 173.004 321.035 6.636 7.391 18.222 7.378 24.846 0 7.065-7.868 173.004-194.147 173.004-321.035C441.425 83.182 358.244 0 256 0zm0 278.719c-51.442 0-93.292-41.851-93.292-93.293S204.559 92.134 256 92.134s93.291 41.851 93.291 93.293-41.85 93.292-93.291 93.292z"
											  fill="#000000" opacity="1" data-original="#000000"></path>
									</g>
								</svg></div>
							<div class="header-content-text">
								<span>Адрес:</span>
								<?php echo gomoto_get_theme_option('address'); ?>
							</div>
						</div>





					</div>
				</div>

			</div>
		</div>
	</section>

	<?php

	$online_booking_form = gomoto_get_the_post_meta('online-booking-form');

	if ($online_booking_form):

		?>

		<section class="order pb-60">
			<div class="container">
				<div class="section-title">
					<h2 class="flex ali-c gap-10" id="booking">
						<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
							 width="512" height="512" x="0" y="0" viewBox="0 0 512.005 512.005"
							 style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
							<g>
								<path d="M511.658 51.675c2.496-11.619-8.895-21.416-20.007-17.176l-482 184a15 15 0 0 0-.054 28.006L145 298.8v164.713a15 15 0 0 0 28.396 6.75l56.001-111.128 136.664 101.423c8.313 6.17 20.262 2.246 23.287-7.669C516.947 34.532 511.431 52.726 511.658 51.675zm-118.981 52.718L157.874 271.612 56.846 232.594zM175 296.245l204.668-145.757c-176.114 185.79-166.916 176.011-167.684 177.045-1.141 1.535 1.985-4.448-36.984 72.882zm191.858 127.546-120.296-89.276 217.511-229.462z"
									  fill="#ff9800" opacity="1" data-original="#ff9800" class=""></path>
							</g>
						</svg>
						Забронировать онлайн
					</h2>
				</div>
				<div class="section-content">
					<div class="rentprog-container is-loading" data-rentprog-container aria-busy="true">
						<div class="rentprog-loader" role="status" aria-live="polite">
							<div class="rentprog-spinner" aria-hidden="true"></div>
							<div class="rentprog-loader__text">Загрузка формы...</div>
						</div>
						<?= $online_booking_form ?>
					</div>
				</div>
			</div>
		</section>

	<?php endif ?>


	<?php
	$related = $product->get_upsell_ids();
	if (!empty($related)) { ?>
		<section class="related pb-60">
			<div class="container">
				<div class="section-title">
					<h2 class="flex ali-c gap-10">
						Похожие предложения
					</h2>
				</div>
				<div class="section-content">
					<div class="products columns-3">
						<div class="swiper -paginate">
							<div class="swiper-wrapper">
								<?php



								foreach ($related as $prod) {
									$_product = wc_get_product($prod);
									?>
									<div class="swiper-slide product type-product">
										<?php
										get_template_part(
											'template-parts/product-card',
											null,
											[
												'product_id' => $prod,
												'product' => $_product,
												'title_class' => 'fs-18',
												'excerpt_class' => 'fs-14',
												'image_link_class' => '',
											]
										);
										?>
									</div>
								<?php }
								/* $cats = wp_get_post_terms( get_the_id(), 'product_cat' );
																																																							$cat = $cats[0];
																																																							$args = array(      
																																																								'post_type' => 'product',
																																																								'post_status' => 'publish',
																																																								'tax_query' => array(
																																																									array(
																																																										'taxonomy' => 'product_cat',
																																																										'field'    => 'term_id',
																																																										'terms'    => $cat,
																																																										),
																																																									),
																																																								);
																																																							

																																																							$query = new WP_Query( $args );
																																																							if( $query->have_posts() ) :
																																																								while( $query->have_posts() ) : $query->the_post();
																																																								$_product = wc_get_product( get_the_ID() );
																																																								
																																																								
																																																								?>
																																																								<li class="swiper-slide product type-product">
																																																									<div class="colored-separator" style="text-align: center;">
																																																										<div class="first-long stm-base-background-color"></div>
																																																										<div class="last-short stm-base-background-color"></div>
																																																									</div>
																																																									<a href="<?php  echo get_the_permalink( get_the_ID() ); ?>"><?php  echo get_the_post_thumbnail(get_the_ID()); ?>
																																																									</a>
																																																									<h3 class="fs-22"><a href="<?php  echo get_the_permalink(get_the_ID()); ?>"><?php echo  $_product->get_title(); ?></a></h3>
																																																									<p class="fs-16"><?php echo get_the_excerpt(get_the_ID()); ?></p>
																																																									<div class="product__price">
																																																										<?php if ( gomoto_get_post_meta( $prod['id'],'product-type') == 'rent') { ?>
																																																								<div class="product-price fs-16"><b>Стоимость: <span class="red"><?php echo $_product->get_price(); ?> рублей / сутки</span> </b></div>
																																																								<?php } else { ?>
																																																								<div class="product-price fs-16"><b>Стоимость: <span class="red"><?php echo $_product->get_price(); ?> рублей </span> </b></div>
																																																								<?php } ?>
																																																									</div>
																																																									
																																																								</li>
																																																							<?php endwhile;
																																																							endif;
																																																							wp_reset_postdata();
																																																							*/ ?>

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
	<?php } ?>
</main>

<?php
get_footer();


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
/* Template Name: Контакты */
get_header();
?>

<main id="primary" class="site-main">
	<section class="page-title">
		<div class="container">
			<h1>
				<?php the_title(); ?>
			</h1>
		</div>
	</section>
	<section class="pt-60 pb-60">
		<div class="container">
			<div class="page">
				<div class="page-content">
					<div class="section-title">
						<?php if (!empty($title = carbon_get_the_post_meta('contacts-contacts-title'))) { ?>
							<h2 class="section-title__title">
								<?php echo $title; ?>
							</h2>
						<?php } ?>
						<?php if (!empty($subtitle = carbon_get_the_post_meta('contacts-contacts-subtitle'))) { ?>
							<p class="section-title__subtitle body-3">
								<?php echo $subtitle; ?>
							</p>
						<?php } ?>
					</div>
					<div class="contacts__wrapper row" style="flex-direction: column;">
						<style>
							.contacts__wrapper .contacts-grid {
								width: 100%;

								display: grid;
								grid-template-columns: 1fr 1fr 1fr 1fr;
								column-gap: 15px;
							}

							.contacts__wrapper .header-contact {
								display: flex;
								flex-direction: column;
								gap: 15px;

								text-align: center;
							}

							.contacts__wrapper .header-contact .icon {
								--size: 50px;
								width: var(--size);
								height: var(--size);
								fill: var(--red);
							}

							.contacts__wrapper .contacts__wrapper .header-content-text>span:first-child {
								margin-bottom: 10px;
							}

							.contacts__wrapper .header-content-text {
								font-size: 18px;
							}

							.contacts__wrapper .contacts-additional {
								display: grid;
								grid-template-columns: repeat(3, 1fr);
								gap: 35px;
								font-size: 20px;
							}

							@media screen and (max-width: 1024px) {
								.contacts__wrapper .contacts-grid {
									grid-template-columns: 1fr 1fr;
									row-gap: 15px;
								}

								.contacts__wrapper .contacts-additional {
									grid-template-columns: repeat(1, 1fr);
									gap: 25px;
									font-size: 18px;
								}
							}

							@media screen and (max-width: 480px) {
								.contacts__wrapper .contacts-grid {
									grid-template-columns: 1fr;
								}

								.contacts__wrapper .contacts-additional {
									gap: 15px;
									font-size: 16px;
								}
							}
						</style>
						<div class="contacts-grid">
							<div class="header-contact phones">
								<div class="icon">
									<svg xmlns="http://www.w3.org/2000/svg" version="1.1"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
										viewBox="0 0 25.625 25.625" style="enable-background:new 0 0 512 512"
										xml:space="preserve" class="">
										<g>
											<path
												d="M22.079 17.835c-1.548-1.324-3.119-2.126-4.648-.804l-.913.799c-.668.58-1.91 3.29-6.712-2.234-4.801-5.517-1.944-6.376-1.275-6.951l.918-.8c1.521-1.325.947-2.993-.15-4.71l-.662-1.04C7.535.382 6.335-.743 4.81.58l-.824.72c-.674.491-2.558 2.087-3.015 5.119-.55 3.638 1.185 7.804 5.16 12.375 3.97 4.573 7.857 6.87 11.539 6.83 3.06-.033 4.908-1.675 5.486-2.272l.827-.721c1.521-1.322.576-2.668-.973-3.995l-.931-.801z"
												style="" fill="#030104" data-original="#030104"></path>
										</g>
									</svg>
								</div>
								<div class="header-content-text">
									<span>Телефоны:</span>
									<?php foreach (carbon_get_theme_option('phones') as $phone) { ?>
										<a href="tel:<?php echo $phone['phone']; ?>"><?php echo $phone['phone']; ?></a>
									<?php } ?>
								</div>
							</div>
							<div class="header-contact address">
								<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
										viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
										xml:space="preserve" class="">
										<g>
											<path
												d="M256 0C153.755 0 70.573 83.182 70.573 185.426c0 126.888 165.939 313.167 173.004 321.035 6.636 7.391 18.222 7.378 24.846 0 7.065-7.868 173.004-194.147 173.004-321.035C441.425 83.182 358.244 0 256 0zm0 278.719c-51.442 0-93.292-41.851-93.292-93.293S204.559 92.134 256 92.134s93.291 41.851 93.291 93.293-41.85 93.292-93.291 93.292z"
												fill="#000000" opacity="1" data-original="#000000"></path>
										</g>
									</svg></div>
								<div class="header-content-text">
									<span>Адрес:</span>
									<?php echo carbon_get_theme_option('address'); ?>
								</div>
							</div>
							
							
														<div class="header-contact coords">
								<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
										viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
										xml:space="preserve" class="">
										<g>
											<path
												d="M256 0C153.755 0 70.573 83.182 70.573 185.426c0 126.888 165.939 313.167 173.004 321.035 6.636 7.391 18.222 7.378 24.846 0 7.065-7.868 173.004-194.147 173.004-321.035C441.425 83.182 358.244 0 256 0zm0 278.719c-51.442 0-93.292-41.851-93.292-93.293S204.559 92.134 256 92.134s93.291 41.851 93.291 93.293-41.85 93.292-93.291 93.292z"
												fill="#000000" opacity="1" data-original="#000000"></path>
										</g>
									</svg></div>
								<div class="header-content-text">
									<span>Координаты:</span>
									<?php echo carbon_get_theme_option('coord'); ?>
								</div>
							</div>
							
							
							<div class="header-contact worktime">
								<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
										viewBox="0 0 347.442 347.442" style="enable-background:new 0 0 512 512"
										xml:space="preserve" class="">
										<g>
											<path
												d="M173.721 347.442c95.919 0 173.721-77.802 173.721-173.721S269.64 0 173.721 0 0 77.802 0 173.721s77.802 173.721 173.721 173.721zm-12.409-272.99c0-6.825 5.584-12.409 12.409-12.409s12.409 5.584 12.409 12.409v93.313l57.39 45.912c5.336 4.281 6.204 12.098 1.923 17.434a12.342 12.342 0 0 1-9.679 4.653c-2.73 0-5.46-.869-7.755-2.73L165.966 183.4c-2.916-2.358-4.653-5.894-4.653-9.679V74.452z"
												fill="#000000" opacity="1" data-original="#000000" class=""></path>
										</g>
									</svg></div>
								<div class="header-content-text">
									<span>График работы:</span>
									<?php echo carbon_get_theme_option('scedule'); ?>
								</div>
							</div>


							<div class="header-contact email">
								<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
										viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
										xml:space="preserve" class="">
										<g>
											<path
												d="m331.756 277.251-42.881 43.026c-17.389 17.45-47.985 17.826-65.75 0l-42.883-43.026L26.226 431.767C31.959 434.418 38.28 436 45 436h422c6.72 0 13.039-1.58 18.77-4.232L331.756 277.251z"
												fill="#000000" opacity="1" data-original="#000000" class=""></path>
											<path
												d="M467 76H45c-6.72 0-13.041 1.582-18.772 4.233l164.577 165.123c.011.011.024.013.035.024a.05.05 0 0 1 .013.026l53.513 53.69c5.684 5.684 17.586 5.684 23.27 0l53.502-53.681s.013-.024.024-.035c0 0 .024-.013.035-.024L485.77 80.232C480.039 77.58 473.72 76 467 76zM4.786 101.212C1.82 107.21 0 113.868 0 121v270c0 7.132 1.818 13.79 4.785 19.788l154.283-154.783L4.786 101.212zM507.214 101.21 352.933 256.005 507.214 410.79C510.18 404.792 512 398.134 512 391V121c0-7.134-1.82-13.792-4.786-19.79z"
												fill="#000000" opacity="1" data-original="#000000" class=""></path>
										</g>
									</svg></div>
								<div class="header-content-text">
									<span>Email:</span>
									<?php echo carbon_get_theme_option('email'); ?>
								</div>
							</div>

							<div class="header-contact ymap">
								<div class="icon no-border"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
										viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
										xml:space="preserve" class="">
										<g>
											<path
												d="m331.756 277.251-42.881 43.026c-17.389 17.45-47.985 17.826-65.75 0l-42.883-43.026L26.226 431.767C31.959 434.418 38.28 436 45 436h422c6.72 0 13.039-1.58 18.77-4.232L331.756 277.251z"
												fill="#000000" opacity="1" data-original="#000000" class=""></path>
											<path
												d="M467 76H45c-6.72 0-13.041 1.582-18.772 4.233l164.577 165.123c.011.011.024.013.035.024a.05.05 0 0 1 .013.026l53.513 53.69c5.684 5.684 17.586 5.684 23.27 0l53.502-53.681s.013-.024.024-.035c0 0 .024-.013.035-.024L485.77 80.232C480.039 77.58 473.72 76 467 76zM4.786 101.212C1.82 107.21 0 113.868 0 121v270c0 7.132 1.818 13.79 4.785 19.788l154.283-154.783L4.786 101.212zM507.214 101.21 352.933 256.005 507.214 410.79C510.18 404.792 512 398.134 512 391V121c0-7.134-1.82-13.792-4.786-19.79z"
												fill="#000000" opacity="1" data-original="#000000" class=""></path>
										</g>
									</svg></div>
								<div class="header-content-text">
									<span>Яндекс карты:</span>
									<a href="<?php echo carbon_get_theme_option('yandex-link'); ?>"
										target="_blank">GoMoto в Яндекс.Картах</a>
								</div>
							</div>
							<div class="header-contact gmap">
								<div class="icon no-border"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
										viewBox="0 0 512 512" style="enable-background:new 0 0 512 512"
										xml:space="preserve" class="">
										<g>
											<path
												d="m331.756 277.251-42.881 43.026c-17.389 17.45-47.985 17.826-65.75 0l-42.883-43.026L26.226 431.767C31.959 434.418 38.28 436 45 436h422c6.72 0 13.039-1.58 18.77-4.232L331.756 277.251z"
												fill="#000000" opacity="1" data-original="#000000" class=""></path>
											<path
												d="M467 76H45c-6.72 0-13.041 1.582-18.772 4.233l164.577 165.123c.011.011.024.013.035.024a.05.05 0 0 1 .013.026l53.513 53.69c5.684 5.684 17.586 5.684 23.27 0l53.502-53.681s.013-.024.024-.035c0 0 .024-.013.035-.024L485.77 80.232C480.039 77.58 473.72 76 467 76zM4.786 101.212C1.82 107.21 0 113.868 0 121v270c0 7.132 1.818 13.79 4.785 19.788l154.283-154.783L4.786 101.212zM507.214 101.21 352.933 256.005 507.214 410.79C510.18 404.792 512 398.134 512 391V121c0-7.134-1.82-13.792-4.786-19.79z"
												fill="#000000" opacity="1" data-original="#000000" class=""></path>
										</g>
									</svg></div>
								<div class="header-content-text">
									<span>Построить маршрут:</span>
									<a href="<?php echo carbon_get_theme_option('yandex-route'); ?>" target="_blank">Еду
										в GoMoto</a>
								</div>
							</div>
							
							
																						<div class="header-contact socials">
								<div class="icon">
									<svg id="Layer_1_1_" style="enable-background:new 0 0 64 64;" version="1.1"
										viewBox="0 0 64 64" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
										xmlns:xlink="http://www.w3.org/1999/xlink">
										<circle cx="32" cy="46" r="5" />
										<path
											d="M41,55c0-2.209-1.612-4-3.6-4H32h-5.4c-1.988,0-3.6,1.791-3.6,4v7h18V55z" />
										<path
											d="M32.93,26.032C39.698,26.511,45,32.206,45,39h2c0-7.839-6.119-14.411-13.93-14.962L32.93,26.032z" />
										<path
											d="M17.346,35.786C17.116,36.834,17,37.916,17,39h2c0-0.94,0.101-1.878,0.3-2.786L17.346,35.786z" />
										<path
											d="M52.504,26.521C54.791,30.276,56,34.592,56,39h2c0-4.775-1.31-9.45-3.788-13.521L52.504,26.521z" />
										<path
											d="M6,39h2c0-13.233,10.767-24,24-24c1.953,0,3.891,0.234,5.76,0.695l0.479-1.941C36.214,13.254,34.115,13,32,13  C17.664,13,6,24.663,6,39z" />
										<path
											d="M32,3c-3.874,0-7.681,0.611-11.315,1.816l0.63,1.898C24.745,5.577,28.34,5,32,5c11.854,0,23.022,6.313,29.144,16.476  l1.713-1.031C56.375,9.685,44.552,3,32,3z" />
										<path
											d="M5.771,17.358l-1.542-1.273c-1.132,1.371-2.17,2.838-3.085,4.359l1.714,1.031C3.722,20.038,4.702,18.653,5.771,17.358z" />
										<path
											d="M49,54h10c0.552,0,1-0.448,1-1V43c0-0.552-0.448-1-1-1H49c-0.552,0-1,0.448-1,1v3l-6,4h6v3C48,53.552,48.448,54,49,54z" />
										<path
											d="M14,42H4c-0.552,0-1,0.448-1,1v10c0,0.552,0.448,1,1,1h10c0.552,0,1-0.448,1-1v-3h6l-6-4v-3C15,42.448,14.552,42,14,42z" />
										<path
											d="M47,11c-4.418,0-8,3.582-8,8s3.582,8,8,8s8-3.582,8-8S51.418,11,47,11z M47,26c-1.955,0-3.72-0.803-4.99-2.095  C42.061,21.741,43.823,20,46,20h1c-1.657,0-3-1.343-3-3s1.343-3,3-3s3,1.343,3,3s-1.343,3-3,3h1c2.177,0,3.939,1.741,3.99,3.905  C50.72,25.197,48.955,26,47,26z" />
										<path
											d="M32,28c0-4.418-3.582-8-8-8s-8,3.582-8,8s3.582,8,8,8S32,32.418,32,28z M23,29h1c-1.657,0-3-1.343-3-3s1.343-3,3-3  s3,1.343,3,3s-1.343,3-3,3h1c2.177,0,3.939,1.741,3.99,3.905C27.72,34.197,25.955,35,24,35c-1.955,0-3.72-0.803-4.99-2.095  C19.061,30.741,20.823,29,23,29z" />
										<path
											d="M12,2c-4.418,0-8,3.582-8,8s3.582,8,8,8s8-3.582,8-8S16.418,2,12,2z M12,17c-1.955,0-3.72-0.803-4.99-2.095  C7.061,12.741,8.823,11,11,11h1c-1.657,0-3-1.343-3-3s1.343-3,3-3s3,1.343,3,3s-1.343,3-3,3h1c2.177,0,3.939,1.741,3.99,3.905  C15.72,16.197,13.955,17,12,17z" />
									</svg>
								</div>
								<div class="header-content-text">
									<span>Соц. сети:</span>
									<div class="socials">
									<?php foreach (gomoto_get_socials(GOMOTO_SOCIALS_FILTER_ONLY_MESSENGERS) as $social) { ?>
										<a href="<?php echo $social['link']; ?>"
											target="_blank"><?php echo $social['icon']; ?></a>
										<?php } ?>
									</div>
								</div>
							</div>
							
							
						</div>
						<div class="contacts-additional">
							<div class="content">
								<?= apply_filters('the_content', carbon_get_theme_option('additional-text1')); ?>
							</div>
							<div class="content">
								<?= apply_filters('the_content', carbon_get_theme_option('additional-text2')); ?>
							</div>
							<div class="content">
								<?= apply_filters('the_content', carbon_get_theme_option('additional-text3')); ?>
							</div>

							<script>

								let additional = document.querySelector('.contacts-additional');
								let linksWithImg = additional.querySelectorAll('a:has(img)');
								let imgs = additional.querySelectorAll('img');

								linksWithImg.forEach(link => {
									link.setAttribute('data-src', link.getAttribute('href'));
									link.removeAttribute('href');
									link.setAttribute('data-fancybox', 'gallery');
								});

								imgs.forEach(img => {
									// if parent node is a, then skip
									if (img.parentNode.tagName === 'A') {
										return;
									}

									let srcset = img.getAttribute("srcset");

									if (srcset) {
										let largestImage = srcset.split(", ")
											.map(src => {
												let parts = src.trim().split(" ");
												return { url: parts[0], width: parseInt(parts[1], 10) };
											})
											.reduce((max, current) => (current.width > max.width ? current : max), { width: 0 });

										// Добавляем найденную ссылку в атрибут data-fancybox
										img.setAttribute("data-fancybox", "gallery");
										img.setAttribute("data-src", largestImage.url);
									}
								});

							</script>
						</div>
						<!-- <div class="col">
							<div class="contacts__gallery">
								<?php $slides = carbon_get_post_meta(get_the_ID(), 'contacts-gallery');
								foreach ($slides as $slide):
									?>
									<a href="<?php echo wp_get_attachment_image_url($slide, 'full'); ?>" data-fancybox><img
											src="<?php echo wp_get_attachment_image_url($slide, 'full'); ?>"
											alt="Image"></a>
								<?php endforeach; ?>
							</div>
						</div> -->
					</div>
					<div class="contacts__map pt-60">
						<?php echo carbon_get_theme_option('yandex-map'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<section class="contacts__form pt-120 pb-60">
		<div class="container">
			<div class="contacts__form-wrapper pt-60 pb-60">
				<h2>
					Обратная связь
				</h2>
				<?php echo do_shortcode('[contact-form-7 id="1e1c1ea" title="Форма в контактах"]'); ?>
			</div>
		</div>
	</section>

</main><!-- #main -->

<?php
get_footer();
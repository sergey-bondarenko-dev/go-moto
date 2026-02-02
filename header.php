<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
<link rel="icon" href="https://gomoto.by/favicon_120x120.png" type="image/x-icon">
	<?php wp_head(); ?>

	<script>var mlineObj = { "frontUrl": "<?php echo esc_url(home_url()); ?>", "themeUrl": "<?php echo get_stylesheet_directory_uri(); ?>" };</script>

	
	

	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
		(function (m, e, t, r, i, k, a) {
			m[i] = m[i] || function () { (m[i].a = m[i].a || []).push(arguments) };
			m[i].l = 1 * new Date();
			for (var j = 0; j < document.scripts.length; j++) { if (document.scripts[j].src === r) { return; } }
			k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
		})
			(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

		ym(95280190, "init", {
			clickmap: true,
			trackLinks: true,
			accurateTrackBounce: true
		});
	</script>
	<noscript>
		<div><img src="https://mc.yandex.ru/watch/95280190" style="position:absolute; left:-9999px;" alt="" /></div>
	</noscript>
	<!-- /Yandex.Metrika counter -->
	
	<link href="https://rentprog-b5205.web.app/css/app.css" rel="stylesheet"/>
	
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<div class="header-wrapper">
			<header id="masthead" class="site-header bg-navy">
				<div class="container">
					<div class="flex jc-spb ali-c">

						<div class="header-item site-branding">
							<?php echo get_custom_logo(); ?>
						</div>
						<button class="site-burger" type="button" aria-label="Открыть меню">
							<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
								<path
									d="M0 1.59998H15.9999V4.49022H0.000918411L0 1.59998ZM0 6.55486H15.9999V9.4451H0.000918411L0 6.55486ZM0 11.5097H15.9999V14.4H0V11.5097Z"
									fill="white"></path>
							</svg>
						</button>
						<div class="header-item flex ali-c jc-fe">
							<div class="header-contact">
								<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
										viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve"
										class="">
										<g>
											<path
												d="M256 0C153.755 0 70.573 83.182 70.573 185.426c0 126.888 165.939 313.167 173.004 321.035 6.636 7.391 18.222 7.378 24.846 0 7.065-7.868 173.004-194.147 173.004-321.035C441.425 83.182 358.244 0 256 0zm0 278.719c-51.442 0-93.292-41.851-93.292-93.293S204.559 92.134 256 92.134s93.291 41.851 93.291 93.293-41.85 93.292-93.291 93.292z"
												fill="#000000" opacity="1" data-original="#000000"></path>
										</g>
									</svg></div>
								<div class="header-content-text">
									<?php echo carbon_get_theme_option('address'); ?>
								</div>
							</div>
						</div>
						<div class="header-item flex ali-c jc-fe">
							<div class="header-contact">
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
									<?php echo carbon_get_theme_option('scedule'); ?>
								</div>
							</div>
						</div>
						<div class="header-item flex ali-c jc-fe">
							<div class="header-contact">
								<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
										xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
										viewBox="0 0 25.625 25.625" style="enable-background:new 0 0 512 512"
										xml:space="preserve" class="">
										<g>
											<path
												d="M22.079 17.835c-1.548-1.324-3.119-2.126-4.648-.804l-.913.799c-.668.58-1.91 3.29-6.712-2.234-4.801-5.517-1.944-6.376-1.275-6.951l.918-.8c1.521-1.325.947-2.993-.15-4.71l-.662-1.04C7.535.382 6.335-.743 4.81.58l-.824.72c-.674.491-2.558 2.087-3.015 5.119-.55 3.638 1.185 7.804 5.16 12.375 3.97 4.573 7.857 6.87 11.539 6.83 3.06-.033 4.908-1.675 5.486-2.272l.827-.721c1.521-1.322.576-2.668-.973-3.995l-.931-.801z"
												style="" fill="#030104" data-original="#030104"></path>
										</g>
									</svg></div>
								<div class="header-content-text">
									<?php foreach (carbon_get_theme_option('phones') as $phone) { ?>
										<a
											href="tel:<?php echo preg_replace('/[^0-9.]+/', '', $phone['phone']); ?>"><?php echo $phone['phone']; ?></a>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="header-item flex ali-c jc-fe">
							<div class="header-contact">
								<div class="socials">
									<?php foreach (gomoto_get_socials(GOMOTO_SOCIALS_FILTER_ONLY_MESSENGERS) as $social) { ?>
										<a href="<?php echo $social['link']; ?>"
											target="_blank"><?php echo $social['icon']; ?></a>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- #site-navigation -->
			</header><!-- #masthead -->
			<div class="desktop-menu">
				<div class="container">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
						)
					);
					?>
				</div>
			</div>
			<div class="mobile-menu bg-navy">
				<div class="mobile-menu-top">
					<div class="mobile-menu-logo">
						<?php echo get_custom_logo(); ?>
					</div>
					<button class="site-burger -close" type="button" aria-label="Закрыть меню">
						<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
							<path d="M9.3335 9.33334L22.6668 22.6667M9.3335 22.6667L22.6668 9.33334" stroke="white"
								stroke-width="3.33333" stroke-linecap="round" stroke-linejoin="round" />
						</svg>
					</button>
				</div>
				
				<div class="mobile-nav">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
						)
					);
					?>
				</div>

				<div class="header-contact">
					<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
							xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
							viewBox="0 0 25.625 25.625" style="enable-background:new 0 0 512 512" xml:space="preserve"
							class="">
							<g>
								<path
									d="M22.079 17.835c-1.548-1.324-3.119-2.126-4.648-.804l-.913.799c-.668.58-1.91 3.29-6.712-2.234-4.801-5.517-1.944-6.376-1.275-6.951l.918-.8c1.521-1.325.947-2.993-.15-4.71l-.662-1.04C7.535.382 6.335-.743 4.81.58l-.824.72c-.674.491-2.558 2.087-3.015 5.119-.55 3.638 1.185 7.804 5.16 12.375 3.97 4.573 7.857 6.87 11.539 6.83 3.06-.033 4.908-1.675 5.486-2.272l.827-.721c1.521-1.322.576-2.668-.973-3.995l-.931-.801z"
									style="" fill="#030104" data-original="#030104"></path>
							</g>
						</svg></div>
					<div class="header-content-text">
						<?php foreach (carbon_get_theme_option('phones') as $phone) { ?>
							<a
								href="tel:<?php echo preg_replace('/[^0-9.]+/', '', $phone['phone']); ?>"><?php echo $phone['phone']; ?></a>
						<?php } ?>
					</div>
				</div>
				<div class="header-contact">
					<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
							xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
							viewBox="0 0 512 512" style="enable-background:new 0 0 512 512" xml:space="preserve" class="">
							<g>
								<path
									d="M256 0C153.755 0 70.573 83.182 70.573 185.426c0 126.888 165.939 313.167 173.004 321.035 6.636 7.391 18.222 7.378 24.846 0 7.065-7.868 173.004-194.147 173.004-321.035C441.425 83.182 358.244 0 256 0zm0 278.719c-51.442 0-93.292-41.851-93.292-93.293S204.559 92.134 256 92.134s93.291 41.851 93.291 93.293-41.85 93.292-93.291 93.292z"
									fill="#000000" opacity="1" data-original="#000000"></path>
							</g>
						</svg></div>
					<div class="header-content-text">
						<?php echo carbon_get_theme_option('address'); ?>
					</div>
				</div>
				<div class="header-contact">
					<div class="icon"><svg xmlns="http://www.w3.org/2000/svg" version="1.1"
							xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0"
							viewBox="0 0 347.442 347.442" style="enable-background:new 0 0 512 512" xml:space="preserve"
							class="">
							<g>
								<path
									d="M173.721 347.442c95.919 0 173.721-77.802 173.721-173.721S269.64 0 173.721 0 0 77.802 0 173.721s77.802 173.721 173.721 173.721zm-12.409-272.99c0-6.825 5.584-12.409 12.409-12.409s12.409 5.584 12.409 12.409v93.313l57.39 45.912c5.336 4.281 6.204 12.098 1.923 17.434a12.342 12.342 0 0 1-9.679 4.653c-2.73 0-5.46-.869-7.755-2.73L165.966 183.4c-2.916-2.358-4.653-5.894-4.653-9.679V74.452z"
									fill="#000000" opacity="1" data-original="#000000" class=""></path>
							</g>
						</svg></div>
					<div class="header-content-text">
						<?php echo carbon_get_theme_option('scedule'); ?>
					</div>
				</div>

				<div class="header-contact">
					<div class="socials">
						<?php foreach (carbon_get_theme_option('socials') as $social) { ?>
							<a href="<?php echo $social['link']; ?>" target="_blank"><?php echo $social['icon']; ?></a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>


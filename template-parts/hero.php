<?php

$video_webm_id         = gomoto_get_the_post_meta('hero_video_webm');
$video_mp4_id          = gomoto_get_the_post_meta('hero_video_mp4');
$video_mobile_webm_id  = gomoto_get_the_post_meta('hero_video_mobile_webm');
$video_mobile_mp4_id   = gomoto_get_the_post_meta('hero_video_mobile_mp4');
$poster_id             = gomoto_get_the_post_meta('hero_poster');

$video_webm_src        = wp_get_attachment_url($video_webm_id);
$video_mp4_src         = wp_get_attachment_url($video_mp4_id);
$video_mobile_webm_src = wp_get_attachment_url($video_mobile_webm_id);
$video_mobile_mp4_src  = wp_get_attachment_url($video_mobile_mp4_id);
$poster_src            = wp_get_attachment_url($poster_id);

$opacity = (float) gomoto_get_the_post_meta('hero_darkness');
?>

<section class="hero" style="--opacity: <?php echo ($opacity / 100); ?>">
		<div class="hero__inner container">
			<div class="section-title">
				<?php if (!empty($offers_title = gomoto_get_the_post_meta('offers-title'))) { ?>
					<h1 class="section-title__title">
						<?php echo $offers_title; ?>
					</h1>
					<div class="colored-separator" style="text-align: center;">
						<div class="first-long stm-base-background-color"></div>
						<div class="last-short stm-base-background-color"></div>
					</div>
				<?php } ?>
			</div>
			<div class="pluses-wrapper">
				<?php if (!empty($adv_title = gomoto_get_the_post_meta('adv-title'))) { ?>
					<div class="section-title">
						<h2 class="section-title__title">
							<?php echo $adv_title; ?>
						</h2>
						<div class="colored-separator" style="text-align: center;">
							<div class="first-long stm-base-background-color"></div>
							<div class="last-short stm-base-background-color"></div>
						</div>
					</div>
				<?php } ?>
				<div class="section-content">
					<div class="pluses flex gap-20 jc-spb">
						<?php foreach (gomoto_get_the_post_meta('adv') as $plus) { ?>
							<div class="pluses__item flex gap-20">
								<div class="pluses__icon">
									<?php echo $plus['icon']; ?>
								</div>
								<div>
									<div class="pluses__title body-4">
										<?php echo $plus['title']; ?>
									</div>
									<div class="body-4">
										<?php echo $plus['text']; ?>
									</div>
								</div>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
		<video class="hero__video-bg" autoplay muted loop playsinline poster="<?= esc_url($poster_src); ?>">

			<?php if ($video_mobile_webm_src): ?>
				<source 
					src="<?= esc_url($video_mobile_webm_src); ?>" 
					type="video/webm"
					media="(max-width: 767px)"
				>
			<?php endif; ?>

			<?php if ($video_mobile_mp4_src): ?>
				<source 
					src="<?= esc_url($video_mobile_mp4_src); ?>" 
					type="video/mp4"
					media="(max-width: 767px)"
				>
			<?php endif; ?>

			<?php if ($video_webm_src): ?>
				<source 
					src="<?= esc_url($video_webm_src); ?>" 
					type="video/webm"
				>
			<?php endif; ?>

			<?php if ($video_mp4_src): ?>
				<source 
					src="<?= esc_url($video_mp4_src); ?>" 
					type="video/mp4"
				>
			<?php endif; ?>

		</video>
	</section>


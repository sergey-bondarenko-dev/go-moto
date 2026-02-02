<?php get_header(); ?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found bg-navy">
			<div class="container">
				<div class="section-title">
					<?php if ( ! empty ( $title = carbon_get_theme_option('404-title') ) ) { ?>
					<h2 class="section-title__title">
						<?php echo $title; ?>
					</h2>
					<?php } ?>
					<?php if ( ! empty ( $subtitle = carbon_get_theme_option('404-subtitle') ) ) { ?>
					<p class="section-title__subtitle body-2">
						<?php echo $subtitle; ?>
					</p>
					<?php } ?>
				</div>
				<div class="section-content">
					<?php if ( ! empty ( $buttons = carbon_get_theme_option('404-buttons') ) ) { ?>
					<div class="error-404__buttons flex ali-c jc-spb">
						<?php foreach ( $buttons as $button ) { ?>
						<a href="<?php echo $button['link']; ?>" <?php echo $button['attr']; ?> class="theme-btn <?php echo $button['color']; ?>">
							<span class="body-4 fw-400"><?php echo $button['text']; ?></span>
							<?php echo $button['icon']; ?>
						</a>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
				<div class="error-404-decor">
					<?php echo wp_get_attachment_image( carbon_get_theme_option('404-decor'), 'full' ); ?>
				</div>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();

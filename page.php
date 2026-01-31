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

get_header();
?>

<main id="primary" class="site-main">
	<section class="page-title">
		<div class="container">
			<?php /* if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb( '<div class="breadcrumbs">','</div>' ); } */ ?>
			<h1>
				<?php the_title(); ?>
			</h1>
		</div>
	</section>
	<section class="pt-60 pb-60">
		<div class="container">
			<div class="page">
				<div class="page-content">
					<?php the_content(); ?>
					<?php if ( is_page (132) && ( ! empty ( $discounts = carbon_get_the_post_meta('discounts') ) ) ) { ?>
					<div class="discount pt-60 pb-60">
						<?php foreach ( $discounts  as $discount ) { ?>
						<div class="discount__item">
							<span><span class="counter-number" data-number="<?php echo $discount['number']; ?>"><?php echo $discount['number']; ?></span>%</span>
							<span><?php echo $discount['text']; ?></span>
						</div>
						<?php } ?>
					</div>
					<?php } ?>

					<?php if ( is_page (12) && ( ! empty ( $vacancies = carbon_get_the_post_meta('vacancies') ) ) ) { ?>
					<div class="vacancies pt-60 pb-60">
						<?php foreach ( $vacancies  as $vacancy ) { ?>
						<div class="vacancies__item">
							<div class="vacancies__item-header">
								<div class="vacancies__item-title">
									<?php echo $vacancy['title']; ?>                  
								</div>
								<div class="vacancies__item-icon"></div>
							</div>
							<div class="vacancies__item-body">
								<?php echo apply_filters('the_content', $vacancy['text']); ?>
							</div>
						</div>
						<?php } ?>
					</div>
					<script>
						document.addEventListener('click', e => {
							const target = e.target;

							if (target.classList.contains('vacancies__item-header')) {
								const item = target.closest('.vacancies__item')
								console.log('item', item)
								item.classList.toggle('active')
							}
						})
					</script>
					<?php } ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();

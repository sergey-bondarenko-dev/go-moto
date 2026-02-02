<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package MLine
 */

?>

<footer id="colophon" class="site-footer pt-60 pb-60 bg-navy">
	<div class="container">
		<div class="footer__row flex jc-spb">
			<div class="footer__col">
				<?php
				if (function_exists('dynamic_sidebar'))
					dynamic_sidebar('footer-1');
				?>
			</div>
			<div class="footer__col">
				<?php
				if (function_exists('dynamic_sidebar'))
					dynamic_sidebar('footer-2');
				?>
			</div>
			<div class="footer__col">
				<?php
				if (function_exists('dynamic_sidebar'))
					dynamic_sidebar('footer-3');
				?>
			</div>
			<div class="footer__col">
				<h4>
					Соц. сети
				</h4>
				<div class="socials" style="margin-bottom: 2rem;">
					<?php foreach (gomoto_get_socials(GOMOTO_SOCIALS_FILTER_ONLY_NON_MESSENGERS) as $social) { ?>
						<a  href="<?php echo $social['link']; ?>"
					   		target="_blank"><?php echo $social['icon']; ?></a>
					<?php } ?>
				</div>
				<h4>
					Мессенджеры
				</h4>
				<div class="socials">
					<?php foreach (gomoto_get_socials(GOMOTO_SOCIALS_FILTER_ONLY_MESSENGERS) as $social) { ?>
						<a  href="<?php echo $social['link']; ?>"
					   		target="_blank"><?php echo $social['icon']; ?></a>
					<?php } ?>
				</div>
			</div>


		</div>
		<div class="footer__row">
			<div><?php echo carbon_get_theme_option('copyright'); ?></div>
			<div><?php echo carbon_get_theme_option('dev'); ?></div>
		</div>
	</div>
</footer><!-- #colophon -->
</div><!-- #page -->
<?php wp_footer(); ?>
<style>
	@media screen and (max-width: 414px) {
		.gear .product.swiper-slide {
			width: calc(50% - 10px) !important;
			max-width: 100% !important;
		}
	}
</style>

<script src="https://rentprog-b5205.web.app/js/app.js"></script>

</body>

</html>

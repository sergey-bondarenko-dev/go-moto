<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package MLine
 */

add_filter('wpseo_json_ld_output', '__return_false');
get_header();

$contacts = gomoto_get_theme_contacts();
$schema = gomoto_get_article_schema($contacts);
gomoto_render_schema($schema);

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

		<?php
		while ( have_posts() ) :
			the_post();

			the_content();

		endwhile; // End of the loop.
		?>

	</div></div>
	</div></section></main><!-- #main -->

<?php

get_footer();

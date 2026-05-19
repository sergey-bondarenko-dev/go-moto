<?php get_header(); ?>

	<main id="primary" class="site-main">
		<section class="page-title">
			<div class="container">
				<h1>
					<?php
					if ( is_category() ) {
						// Рубрика: Название рубрики
						echo 'Рубрика: ' . single_cat_title( '', false );

					} elseif ( is_tag() ) {
						echo 'Тег: ' . single_tag_title( '', false );

					} elseif ( is_tax() ) {
						// Кастомные таксономии
						$term = get_queried_object();
						echo $term->name;

					} elseif ( is_post_type_archive() ) {
						echo post_type_archive_title( '', false );

					} elseif ( is_search() ) {
						echo 'Результаты поиска: ' . get_search_query();

					} elseif ( is_404() ) {
						echo 'Страница не найдена';

					} else {
						echo 'Блог';
					}
					?>
				</h1>
			</div>
		</section>
		<section class="pt-60 pb-60">
			<div class="container">
				<div class="page">
					<nav class="nav-tabs">
						<?php
						$current_cat_id = 0;
						if ( is_category() ) {
							$current_cat_id = get_queried_object_id();
						}
						$all_categories_url = get_post_type_archive_link( 'post' );
						?>
						<a href="<?php echo esc_url( $all_categories_url ); ?>"
						class="nav-tabs__link <?php echo ! $current_cat_id ? 'is-active' : ''; ?>">
							Все рубрики
						</a>

						<?php
						$categories = get_categories(
							array(
								'orderby'    => 'name',
								'order'      => 'ASC',
								'hide_empty' => true,
							)
						);

						foreach ( $categories as $cat ) :
							if ( mb_strtolower( $cat->name ) === 'без рубрики' ) {
								continue;
							}
							$active = $current_cat_id === $cat->term_id ? 'is-active' : '';
							?>
							<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
							class="nav-tabs__link <?php echo esc_attr( $active ); ?>">
								<?php echo esc_html( $cat->name ); ?>
							</a>
						<?php endforeach; ?>

						<label class="nav-tabs__select-wrap">
							<span class="screen-reader-text visually-hidden">Выберите рубрику</span>
							<select class="nav-tabs__select" data-nav-tabs-select aria-label="Рубрика">
								<option value="<?php echo esc_url( $all_categories_url ); ?>" <?php selected( ! $current_cat_id ); ?>>
									Все рубрики
								</option>
								<?php foreach ( $categories as $cat ) : ?>
									<?php
									if ( mb_strtolower( $cat->name ) === 'без рубрики' ) {
										continue;
									}
									?>
									<option value="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>" <?php selected( $current_cat_id, $cat->term_id ); ?>>
										<?php echo esc_html( $cat->name ); ?>
									</option>
								<?php endforeach; ?>
							</select>
						</label>
					</nav>

					<div class="posts">
						
						<?php
						if ( have_posts() ) :


							while ( have_posts() ) :
								the_post();

								get_template_part( 'template-parts/content', get_post_type() );

							endwhile;

							the_posts_navigation();

						else :

							get_template_part( 'template-parts/content', 'none' );

						endif;
						?>

					</div>
				</div>
			</div>
		</section>
	</main><!-- #primary -->

<?php
get_footer();

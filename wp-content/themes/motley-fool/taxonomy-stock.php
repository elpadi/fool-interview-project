<?php
use FinancialPages\CompanyInfo;

global $wp_query;
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

get_header();

$stock_symbol = get_term_by('slug', get_query_var('stock'), 'stock')->name;
$stock_data = CompanyInfo::fetchProfile($stock_symbol);
extract($stock_data['profile'], \EXTR_PREFIX_ALL, 'company');
/*
4. If the company has been recommended, a list of links to the recommendation articles should be displayed under the header “Recommendations”, in reverse chronological order (newest first).
5. Any News articles should be listed under the header “Other Coverage” in reverse chronological order (newest first). If there are more than 10 articles, the user should be able to page through them. Subsequent pages should contain everything _except_ the list of Recommendation articles.
 */
?>

<main id="site-content" role="main">

	<article class="financial-company post">

		<header class="entry-header has-text-align-center">

			<div class="entry-header-inner section-inner medium">

				<h1><?= $company_companyName; ?></h1>
				<img src="<?= $company_image; ?>" alt="">

			</div>

		</header>

		<div class="post-inner ">

			<div class="entry-content">

				<p><?= $company_description; ?></p>

			</div>

		</div>

	</article>

</main>

<?php

include(__DIR__.'/template-parts/financial-sidebar.php');

?>

<?php 
if (intval(get_query_var('paged')) < 2):
$recommendations = new WP_Query([
	'post_type' => 'stock-recommendation',
	'tax_query' => [
		[
			'taxonomy' => 'stock',
			'field' => 'slug',
			'terms' => get_query_var('stock'),
		],
	],
	'nopaging' => true,
]);

if ($recommendations->have_posts()): ?>
<section class="full-width stock-recommendations">

	<header class="archive-header has-text-align-center header-footer-group">

		<div class="archive-header-inner section-inner medium">

			<h1 class="archive-title">Stock Recommendations</h1>

			<?php while ($recommendations->have_posts()): $recommendations->the_post(); ?>

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<header class="entry-header has-text-align-center">

					<?php the_title( '<h2 class="entry-title heading-size-1"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>

				</header>

			</article>

			<?php endwhile; ?>
	
		</div>

	</header>

</section>
<?php 
endif; endif;

if (have_posts()): ?>
<section class="full-width news-articles">

	<header class="archive-header has-text-align-center header-footer-group">

		<div class="archive-header-inner section-inner medium">

			<h1 class="archive-title">Other Coverage</h1>

			<?php while (have_posts()): the_post(); ?>

			<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

				<header class="entry-header has-text-align-center">

					<?php the_title( '<h2 class="entry-title heading-size-1"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>

				</header>

			</article>

			<?php endwhile; ?>
	
		</div>

	</header>

	<?php get_template_part( 'template-parts/pagination' ); ?>

</section>
<?php endif;

get_footer();

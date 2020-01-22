<?php
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
?>

<main id="site-content" role="main">

	<?php

	$archive_title    = get_the_archive_title();
	$archive_subtitle = get_the_archive_description();

	if ( $archive_title || $archive_subtitle ): ?>

	<header class="archive-header has-text-align-center header-footer-group">

		<div class="archive-header-inner section-inner medium">

			<?php if ( $archive_title ) { ?>
				<h1 class="archive-title"><?php echo wp_kses_post( $archive_title ); ?></h1>
			<?php } ?>

			<?php if ( $archive_subtitle ) { ?>
				<div class="archive-subtitle section-inner thin max-percentage intro-text"><?php echo wp_kses_post( wpautop( $archive_subtitle ) ); ?></div>
			<?php } ?>

		</div><!-- .archive-header-inner -->

	</header><!-- .archive-header -->

	<?php endif;

	if ( have_posts() ):
	
	$i = 0;

	while ( have_posts() ): the_post();

	$stockSymbol = financial_pages_get_stock_symbol_from_post();

	$i++;
	if ( $i > 1 ) {
		echo '<hr class="post-separator styled-separator is-style-wide section-inner" aria-hidden="true" />';
	}

	?>

	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<header class="entry-header has-text-align-center">

			<?php the_title( '<h2 class="entry-title heading-size-1"><a href="' . esc_url( get_permalink() ) . '">', sprintf('</a> (<a href="%s">%s</a>)</h2>', financial_pages_get_stock_url($stockSymbol), $stockSymbol) ); ?>

		</header>

	</article>

	<?php endwhile; endif;
	
	get_template_part( 'template-parts/pagination' ); ?>

</main><!-- #site-content -->

<?php
get_footer();
<?php
/**
 * The template for displaying search results pages.
 *
 * @link     https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package  TM Moody
 * @since    1.0
 */
get_header();

$page_sidebar_position = Insight::setting( 'search_page_sidebar_position' );
$page_sidebar1         = Insight::setting( 'search_page_sidebar_1' );
$page_sidebar2         = Insight::setting( 'search_page_sidebar_2' );
?>
<?php get_template_part( 'components/title-bar' ); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'left' ); ?>

				<div class="page-main-content col-md-8">
					<?php if ( 'above' === Insight::setting( 'search_page_search_form_display' ) ) : ?>
						<div
							class="search-page-search-form <?php echo esc_attr( Insight::setting( 'search_page_search_form_display' ) ); ?>">
							<?php get_search_form(); ?>
						</div>
					<?php endif; ?>

					<?php get_template_part( 'components/content', 'blog' ); ?>

					<?php if ( 'below' === Insight::setting( 'search_page_search_form_display' ) ) : ?>
						<div
							class="search-page-search-form <?php echo esc_attr( Insight::setting( 'search_page_search_form_display' ) ); ?>">
							<?php get_search_form(); ?>
						</div>
					<?php endif; ?>
				</div>

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'right' ); ?>

			</div>
		</div>
	</div>
<?php
get_footer();

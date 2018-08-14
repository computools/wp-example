<?php
/**
 * The template for displaying all single portfolio posts.
 *
 * @package TM Moody
 * @since   1.0
 */
$style = Insight_Helper::get_post_meta( 'portfolio_layout_style', '' );
if ( $style === '' ) {
	$style = Insight::setting( 'single_portfolio_style' );
}

get_header();

$page_sidebar_position = Insight_Helper::get_post_meta( 'page_sidebar_position', 'default' );
$page_sidebar1         = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
$page_sidebar2         = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );

if ( $page_sidebar1 === 'default' ) {
	$page_sidebar1 = Insight::setting( 'portfolio_page_sidebar_1' );
}

if ( $page_sidebar2 === 'default' ) {
	$page_sidebar2 = Insight::setting( 'portfolio_page_sidebar_2' );
}

if ( $page_sidebar_position === 'default' ) {
	$page_sidebar_position = Insight::setting( 'portfolio_page_sidebar_position' );
}

?>
<?php get_template_part( 'components/title-bar' ); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'left' ); ?>

				<div class="page-main-content col-md-12">
					<?php while ( have_posts() ) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<?php get_template_part( 'loop/portfolio/single/style', $style ); ?>
						</article>
						<?php
						if ( Insight::setting( 'portfolio_related_enable' ) ) {
							get_template_part( 'components/content-single-related-portfolios' );
						} ?>
						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						if ( Insight::setting( 'single_portfolio_comment_enable' ) === '1' && ( comments_open() || get_comments_number() ) ) :
							comments_template();
						endif;
						?>
					<?php endwhile; ?>
				</div>

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'right' ); ?>

			</div>
		</div>
	</div>
<?php
get_footer();

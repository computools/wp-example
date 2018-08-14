<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Moody
 * @since   1.0
 */
get_header();

$page_sidebar_position = Insight_Helper::get_post_meta( 'page_sidebar_position', 'default' );
$page_sidebar1         = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
$page_sidebar2         = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );

if ( $page_sidebar1 === 'default' ) {
	$page_sidebar1 = Insight::setting( 'page_sidebar_1' );
}

if ( $page_sidebar2 === 'default' ) {
	$page_sidebar2 = Insight::setting( 'page_sidebar_2' );
}

if ( $page_sidebar_position === 'default' ) {
	$page_sidebar_position = Insight::setting( 'page_sidebar_position' );
}
?>
<?php get_template_part( 'components/title-bar' ); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'left' ); ?>

				<div id="page-main-content" class="page-main-content col-md-12">
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'components/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div>

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'right' ); ?>

			</div>
		</div>
	</div>
<?php get_footer();

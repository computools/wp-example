<?php
/**
 * The template for displaying archive pages.
 *
 * @link     https://codex.wordpress.org/Template_Hierarchy
 *
 * @package  TM Moody
 * @since    1.0
 */
get_header();

$page_sidebar_position = Insight::setting( 'blog_archive_page_sidebar_position' );
$page_sidebar1         = Insight::setting( 'blog_archive_page_sidebar_1' );
$page_sidebar2         = Insight::setting( 'blog_archive_page_sidebar_2' );
?>
<?php get_template_part( 'components/title-bar' ); ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'left' ); ?>

				<div class="page-main-content col-md-8">
					<?php get_template_part( 'components/content', 'blog' ); ?>
				</div>

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'right' ); ?>

			</div>
		</div>
	</div>
<?php get_footer();

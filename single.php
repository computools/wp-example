<?php
/**
 * The template for displaying all single posts.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package TM Moody
 * @since   1.0
 */
get_header();

$page_sidebar_position = Insight_Helper::get_post_meta( 'page_sidebar_position', 'default' );
$page_sidebar1         = Insight_Helper::get_post_meta( 'page_sidebar_1', 'default' );
$page_sidebar2         = Insight_Helper::get_post_meta( 'page_sidebar_2', 'default' );

if ( $page_sidebar1 === 'default' ) {
	$page_sidebar1 = Insight::setting( 'post_page_sidebar_1' );
}

if ( $page_sidebar2 === 'default' ) {
	$page_sidebar2 = Insight::setting( 'post_page_sidebar_2' );
}

if ( $page_sidebar_position === 'default' ) {
	$page_sidebar_position = Insight::setting( 'post_page_sidebar_position' );
}

$style = Insight_Helper::get_post_meta( 'post_layout_style', '' );
if ( $style === '' ) {
	$style = Insight::setting( 'single_post_style' );
}
?>
<?php if ( $style === '2' ) { ?>
	<?php get_template_part( 'components/blog-image-header' ); ?>
<?php } else { ?>
	<?php get_template_part( 'components/title-bar' ); ?>
<?php } ?>
	<div id="page-content" class="page-content">
		<div class="container">
			<div class="row">

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'left' ); ?>

				<div class="page-main-content">
					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'components/content', 'single' );


						if ( Insight::setting( 'single_post_pagination_enable' ) === '1' ) {
							the_post_navigation();
						}

						if ( Insight::setting( 'single_post_related_enable' ) ) {
							get_template_part( 'components/content', 'single-related-posts' );
						}

						// If comments are open or we have at least one comment, load up the comment template.
						if ( Insight::setting( 'single_post_comment_enable' ) === '1' && ( comments_open() || get_comments_number() ) ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>
				</div>

				<?php Insight_Templates::render_sidebar( $page_sidebar_position, $page_sidebar1, $page_sidebar2, 'right' ); ?>

			</div>
		</div>
	</div>
<?php
get_footer();

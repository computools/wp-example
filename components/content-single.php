<?php
/**
 * Template part for displaying single post pages.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Moody
 * @since   1.0
 */

$style = Insight_Helper::get_post_meta( 'post_layout_style', '' );
if ( $style === '' ) {
	$style = Insight::setting( 'single_post_style' );
}
$_post_title = Insight::setting( 'single_post_title_enable' );
$format      = '';
if ( get_post_format() !== false ) {
	$format = get_post_format();
}
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( $style !== '2' ) : ?>
			<div class="entry-header">
				<?php if ( $_post_title === '1' ) : ?>
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php endif; ?>
				<?php get_template_part( 'loop/blog-single/meta' ); ?>
			</div>
			<?php if ( Insight::setting( 'single_post_feature_enable' ) === '1' ) : ?>
				<div class="post-feature">
					<?php get_template_part( 'loop/blog-single/format', $format ); ?>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="entry-content">
			<?php
			the_content( sprintf( /* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'tm-moody' ), array( 'span' => array( 'class' => array() ) ) ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );

			Insight_Templates::page_links();
			?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="entry-footer">
					<div class="row row-xs-center">
						<div class="col-md-6">
							<?php if ( Insight::setting( 'single_post_tags_enable' ) === '1' ) : ?>
								<div class="post-tags">
									<?php the_tags( '<h6>' . esc_html__( 'Tags: ', 'tm-moody' ) . '</h6>', ', ', '' ); ?>
								</div>
							<?php endif; ?>
						</div>
						<div class="col-md-6">
							<?php if ( Insight::setting( 'single_post_share_enable' ) === '1' ) : ?>
								<?php Insight_Templates::post_sharing(); ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</article>
<?php
$author_desc = get_the_author_meta( 'description' );
if ( Insight::setting( 'single_post_author_enable' ) === '1' && ! empty( $author_desc ) ) {
	Insight_Templates::post_author();
}

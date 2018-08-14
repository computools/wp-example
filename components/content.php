<?php
/**
 * Template part for displaying posts.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Moody
 * @since   1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		}

		if ( 'post' === get_post_type() ) : ?>
			<?php get_template_part( 'components/content', 'meta' ); ?>
			<?php
		endif; ?>
	</header>
	<?php if ( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail">
			<a href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail( 'full' ); ?>
			</a>
		</div>
	<?php endif; ?>
	<div class="entry-content">
		<?php
		the_content( sprintf( /* translators: %s: Name of current post. */
			wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'tm-moody' ), array( 'span' => array( 'class' => array() ) ) ), the_title( '<span class="screen-reader-text">"', '"</span>', false ) ) );

		Insight_Templates::page_links();
		?>
	</div>
	<?php Insight_Templates::post_author(); ?>
</article><!-- #post-## -->

<?php
/**
 * Template Name: One Page Scroll
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package TM Moody
 * @since   1.0
 */

get_header();
?>
	<div id="page-content" class="page-content">
		<div id="one-page-scroll" class="one-page-scroll tm-enable-onepage-animation tm-3d-style-1"
		     data-enable-dots="true">
			<?php
			if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
				<?php
			endwhile;
				the_posts_navigation();
			else :
				get_template_part( 'components/content', 'none' );
			endif; ?>
		</div>
	</div>
<?php get_footer( 'blank' );

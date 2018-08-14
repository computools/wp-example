<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link    https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package TM Moody
 * @since   1.0
 */

get_header( 'blank' );

$copyright = Insight::setting( 'error404_page_copyright' );
?>
	<div class="error404">
		<div class="error404--header">
			<?php get_template_part( 'components/branding' ); ?>
		</div>
		<div class="error404--content-wrap">
			<div class="error404--content">
				<img src="<?php echo get_template_directory_uri() . '/assets/images/image_404.png' ?>" alt="">
				<h2 class="error404--title">
					<?php echo esc_html( Insight::setting( 'error404_page_title' ) ); ?>
				</h2>
				<div class="error404--text">
					<?php echo esc_html( Insight::setting( 'error404_page_text' ) ); ?>
				</div>
				<div class="error-buttons">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>"
					   class="tm-button style-outline tm-button-default"
					   id="tm-btn-go-back">
						<span><?php esc_html_e( 'Go back', 'tm-moody' ); ?></span>
					</a>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="tm-button style-outline tm-button-grey">
						<span><?php esc_html_e( 'Homepage', 'tm-moody' ); ?></span>
					</a>
				</div>
			</div>
		</div>
	</div>
<?php get_footer( 'blank' );

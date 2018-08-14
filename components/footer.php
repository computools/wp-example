<?php
$footer_page = Insight_Helper::get_post_meta( 'footer_page', 'default' );

if ( $footer_page === 'default' ) {
	$footer_page = Insight::setting( 'footer_page' );
}

if ( $footer_page === '' ) {
	return;
}

$_insight_args = array(
	'post_type' => 'ic_footer',
	'name'      => $footer_page,
);

$_insight_query = new WP_Query( $_insight_args );
?>
<?php if ( $_insight_query->have_posts() ) { ?>
	<?php while ( $_insight_query->have_posts() ) : $_insight_query->the_post(); ?>
		<?php
		$footer_options      = unserialize( get_post_meta( get_the_ID(), 'insight_footer_options', true ) );
		$footer_wrap_classes = 'page-footer-wrapper';
		$_effect             = Insight_Helper::get_the_post_meta( $footer_options, 'effect', '' );

		if ( $_effect !== '' ) {
			$footer_wrap_classes .= " {$_effect}";
		}
		?>


		<div id="page-footer-wrapper" class="<?php echo esc_attr( $footer_wrap_classes ); ?>">
			<div id="page-footer" <?php Insight::footer_class(); ?>>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="page-footer-inner">


								<?php the_content(); ?>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php endwhile; ?>
<?php }
wp_reset_postdata();

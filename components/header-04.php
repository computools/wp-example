<?php if ( Insight::setting( 'header_enable' ) === '1' ) { ?>
	<?php
	$header_inner_classes = 'page-header-inner';
	$left_header_shadow   = Insight::setting( 'left_header_shadow' );
	if ( $left_header_shadow === '1' ) {
		$header_inner_classes .= ' has-shadow';
	}
	?>
	<div id="page-header-inner" class="<?php echo esc_attr( $header_inner_classes ); ?>" data-header-position="left"
	     data-sticky="1">
		<?php get_template_part( 'components/branding' ); ?>
		<div id="page-open-mobile-menu" class="page-open-mobile-menu">
			<div><i></i></div>
		</div>
		<div id="page-navigation" <?php Insight::navigation_class(); ?>>
			<nav id="menu" class="menu menu--primary">
				<?php Insight::menu_primary( array(
					'menu_class' => 'menu__container sm sm-simple sm-vertical',
				) ); ?>
			</nav>
		</div>
		<div class="page-header-widgets">
			<?php Insight_Templates::generated_sidebar( 'left_header_widget' ); ?>
		</div>
	</div>
<?php } ?>

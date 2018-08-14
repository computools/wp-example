<?php if ( Insight::setting( 'header_enable' ) === '1' ) { ?>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1">
		<div class="container">
			<div class="row row-xs-center">
				<div class="header-wrap">
					<?php get_template_part( 'components/branding' ); ?>
					<div class="header-right">
						<?php Insight_Woo::render_mini_cart(); ?>
						<?php Insight_Templates::header_search_button(); ?>
						<div id="page-open-mobile-menu" class="page-open-mobile-menu">
							<div><i></i></div>
						</div>
					</div>
				</div>
				<div class="col-xs-12 page-navigation-wrap">
					<?php get_template_part( 'components/navigation' ); ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

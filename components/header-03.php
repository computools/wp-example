<?php if ( Insight::setting( 'header_enable' ) === '1' ) { ?>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="header-wrap">
						<?php get_template_part( 'components/branding' ); ?>
						<div class="header-right">
							<?php Insight_Woo::render_mini_cart(); ?>
							<?php Insight_Templates::header_search_button(); ?>
							<div id="page-open-mobile-menu" class="page-open-mobile-menu">
								<div><i></i></div>
							</div>
							<div id="page-open-main-menu" class="page-open-main-menu">
								<div><i></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php get_template_part( 'components/off-canvas' ); ?>
<?php } ?>

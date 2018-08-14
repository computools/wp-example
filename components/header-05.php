<?php if ( Insight::setting( 'header_enable' ) === '1' ) { ?>
	<div id="page-header-inner" class="page-header-inner" data-sticky="1">
		<div class="container-fluid">
			<div class="row row-xs-center">
				<div class="col-md-12">
					<div class="header-wrap">
						<div class="header-left">
							<?php get_template_part( 'components/branding' ); ?>
						</div>
						<div class="page-navigation-wrap">
							<?php get_template_part( 'components/navigation' ); ?>
						</div>
						<div class="header-right">
							<?php get_template_part( 'components/header', 'button' ); ?>
							<div id="page-open-mobile-menu" class="page-open-mobile-menu">
								<div><i></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

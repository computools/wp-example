<?php
$columns               = Insight::setting( 'top_bar_01_columns' );
$top_bar_left_element  = Insight::setting( 'top_bar_01_left_element' );
$top_bar_right_element = Insight::setting( 'top_bar_01_right_element' );
?>
<div class="page-top-bar page-top-bar-01">
	<div class="container">
		<div class="row">
			<?php if ( $columns === '1' ) { ?>
				<div class="col-md-12 col-xs-center">
					<?php
					switch ( $top_bar_left_element ) {
						case 'info':
							Insight_Templates::top_bar_info( '01' );
							break;
						case 'social_networks':
							get_template_part( 'components/topbar', 'social_networks' );
							break;
						case 'widgets':
							Insight_Templates::generated_sidebar( 'top_bar_widget_01' );
							break;
					}
					?>
				</div>
			<?php } elseif ( $columns === '2' ) { ?>
				<div class="col-md-6">
					<div class="top-bar-wrap top-bar-left">

						<?php
						switch ( $top_bar_left_element ) {
							case 'info':
								Insight_Templates::top_bar_info( '01' );
								break;
							case 'social_networks':
								get_template_part( 'components/topbar', 'social_networks' );
								break;
							case 'widgets':
								Insight_Templates::generated_sidebar( 'top_bar_widget_01' );
								break;
						}
						?>

					</div>
				</div>
				<div class="col-md-6 top-bar-right">
					<div class="top-bar-wrap top-bar-right">

						<?php
						switch ( $top_bar_right_element ) {
							case 'info':
								Insight_Templates::top_bar_info( '01' );
								break;
							case 'social_networks':
								get_template_part( 'components/topbar', 'social_networks' );
								break;
							case 'widgets':
								Insight_Templates::generated_sidebar( 'top_bar_widget_01' );
								break;
						}
						?>

					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>

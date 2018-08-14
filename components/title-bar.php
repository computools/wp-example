<?php
$title_bar_layout = Insight_Helper::get_post_meta( 'page_title_bar_layout', 'default' );
if ( $title_bar_layout === 'default' ) {
	if ( is_singular( 'post' ) ) {
		$title_bar_layout = Insight::setting( 'single_post_title_bar_layout' );
	} elseif ( is_singular( 'page' ) ) {
		$title_bar_layout = Insight::setting( 'single_page_title_bar_layout' );
	} elseif ( is_singular( 'product' ) ) {
		$title_bar_layout = Insight::setting( 'single_product_title_bar_layout' );
	} elseif ( is_singular( 'portfolio' ) ) {
		$title_bar_layout = Insight::setting( 'single_portfolio_title_bar_layout' );
	} else {
		$title_bar_layout = Insight::setting( 'title_bar_layout' );
	}
	if ( $title_bar_layout === 'default' ) {
		$title_bar_layout = Insight::setting( 'title_bar_layout' );
	}
}

if ( $title_bar_layout === 'none' ) {
	return;
}

$title = Insight_Helper::get_post_meta( 'page_title_bar_custom_heading', '' );
if ( $title === '' ) {
	if ( is_category() || is_tax() ) {
		$title = Insight::setting( 'title_bar_archive_category_title' ) . single_cat_title( '', false );
	} elseif ( is_home() ) {
		$title = Insight::setting( 'title_bar_home_title' ) . single_tag_title( '', false );
	} elseif ( is_tag() ) {
		$title = Insight::setting( 'title_bar_archive_tag_title' ) . single_tag_title( '', false );
	} elseif ( is_author() ) {
		$title = Insight::setting( 'title_bar_archive_author_title' ) . '<span class="vcard">' . get_the_author() . '</span>';
	} elseif ( is_year() ) {
		$title = Insight::setting( 'title_bar_archive_year_title' ) . get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'tm-moody' ) );
	} elseif ( is_month() ) {
		$title = Insight::setting( 'title_bar_archive_month_title' ) . get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'tm-moody' ) );
	} elseif ( is_day() ) {
		$title = Insight::setting( 'title_bar_archive_day_title' ) . get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'tm-moody' ) );
	} elseif ( is_post_type_archive() ) {
		$title = sprintf( esc_html__( 'Archives: %s', 'tm-moody' ), post_type_archive_title( '', false ) );
	} elseif ( is_search() ) {
		$title = Insight::setting( 'title_bar_search_title' ) . '"' . get_search_query() . '"';
	} elseif ( get_post_type() === 'post' ) {
		$title = Insight::setting( 'title_bar_single_blog_title' );
		if ( $title === '' ) {
			$title = get_the_title();
		}
	} elseif ( get_post_type() === 'portfolio' ) {
		$title = Insight::setting( 'title_bar_single_portfolio_title' );
		if ( $title === '' ) {
			$title = get_the_title();
		}
	} else {
		$title = get_the_title();
	}
}
?>
<?php if ( in_array( $title_bar_layout, array( '02', '03' ) ) ) { ?>
	<div id="page-title-bar" class="page-title-bar">
		<div class="page-title-bar-overlay"></div>

		<div class="page-title-bar-inner">
			<div class="container">
				<div class="row row-xs-center">
					<div class="col-md-6">
						<div class="page-title-bar-heading">
							<h1 class="heading">
								<?php echo wp_kses( $title, array(
									'span' => array(
										'class' => array(),
									),
								) ); ?>
							</h1>
						</div>
					</div>
					<div class="col-md-6">
						<?php get_template_part( 'components/breadcrumb' ); ?>
					</div>
				</div>
				<!-- /.row -->
			</div>
		</div>
	</div>
<?php } else { ?>
	<div id="page-title-bar" class="page-title-bar">
		<div class="page-title-bar-overlay"></div>

		<div class="page-title-bar-inner">
			<div class="container">
				<div class="row row-xs-center">
					<div class="col-md-12">
						<div class="page-title-bar-heading">
							<h1 class="heading">
								<?php echo wp_kses( $title, array(
									'span' => array(
										'class' => array(),
									),
								) ); ?>
							</h1>
						</div>
					</div>
				</div>
				<!-- /.row -->
			</div>
		</div>
		<?php get_template_part( 'components/breadcrumb' ); ?>
	</div>
<?php } ?>

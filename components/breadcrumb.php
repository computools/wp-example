<?php
// DON'T render breadcrumb if the current page is the front latest posts.
if ( ( is_home() && is_front_page() ) || ! function_exists( 'insight_core_breadcrumb' ) ) {
	return;
}
?>
	<div id="page-breadcrumb" class="page-breadcrumb">
		<?php echo insight_core_breadcrumb(); ?>
	</div>
<?php

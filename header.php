<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section
 *
 * @link     https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package  TM Moody
 * @since    1.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php Insight::body_attributes(); ?>>
<?php get_template_part( 'components/preloader' ); ?>
<div id="page" class="site">
	<div class="content-wrapper">
		<?php Insight_Templates::top_bar(); ?>
		<?php Insight_Templates::slider( 'below' ); ?>
		<header id="page-header" <?php Insight::header_class(); ?>>
			<?php $header_type = Insight::setting( 'header_type' ); ?>
			<?php get_template_part( 'components/header', $header_type ); ?>
			<?php Insight_Templates::slider( 'behind' ); ?>
		</header>
		<?php Insight_Templates::slider( 'above' ); ?>

<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 *
 * @var $atts
 * @var $values
 * @var $units
 * @var $custombgcolor
 * @var $customtxtcolor
 * @var $options
 * @var $el_class
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Progress_Bar
 */
$style  = $values = $units = $custombgcolor = $customtxtcolor = $options = $el_class = $track_color = '';
$output = '';
$atts   = vc_map_get_attributes( $this->getShortcode(), $atts );
$atts   = $this->convertAttributesToNewProgressBar( $atts );

extract( $atts );
wp_enqueue_script( 'waypoints' );

$el_class = $this->getExtraClass( $el_class );
$css_id   = uniqid( 'tm-progress-bar-' );
Insight_VC::get_progress_bar_inline_css( '#' . $css_id, $atts );
$bar_classes   = array( 'vc_bar' );
$track_classes = array( 'vc_general vc_single_bar' );
$options       = explode( ',', $options );
if ( in_array( 'animated', $options ) ) {
	$bar_classes[] = 'animated';
}
if ( in_array( 'striped', $options ) ) {
	$bar_classes[] = 'striped';
}
if ( $background_color === 'primary' ) {
	$bar_classes[] = 'primary-background-color-important';
} elseif ( $background_color === 'secondary' ) {
	$bar_classes[] = 'secondary-background-color-important';
}

if ( $track_color === 'primary' ) {
	$track_classes[] = 'primary-background-color-important';
} elseif ( $track_color === 'secondary' ) {
	$track_classes[] = 'secondary-background-color-important';
}

$label_classes = 'vc_single_bar_title';
if ( $text_color === 'primary' ) {
	$label_classes .= ' primary-color-important';
} elseif ( $text_color === 'secondary' ) {
	$label_classes .= ' secondary-color-important';
}

$class_to_filter = 'vc_progress_bar ' . $el_class;
$css_class       = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$css_class       .= " style-$style";

$output = '<div class="' . esc_attr( $css_class ) . '" id="' . esc_attr( $css_id ) . '">';

$values           = (array) vc_param_group_parse_atts( $values );
$max_value        = 0.0;
$graph_lines_data = array();
foreach ( $values as $data ) {
	$new_line          = $data;
	$new_line['value'] = isset( $data['value'] ) ? $data['value'] : 0;
	$new_line['label'] = isset( $data['label'] ) ? $data['label'] : '';
	if ( $max_value < (float) $new_line['value'] ) {
		$max_value = $new_line['value'];
	}
	$graph_lines_data[] = $new_line;
}

foreach ( $values as $line ) {
	if ( $max_value > 100.00 ) {
		$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
	} else {
		$percentage_value = $line['value'];
	}
	$bar_style = '';
	if ( isset( $line['background_color'] ) && $line['background_color'] === 'custom' ) {
		$bar_style = 'background-color: ' . $line['custom_background_color'] . '!important';
	}
	$line_bar_classes = '';
	if ( isset( $line['background_color'] ) ) {
		if ( $line['background_color'] === 'primary' ) {
			$line_bar_classes = ' primary-background-color-important';
		} elseif ( $line['background_color'] === 'secondary' ) {
			$line_bar_classes = ' secondary-background-color-important';
		}
	}
	$label_style = 'width: ' . $percentage_value . '%;';
	if ( isset( $line['text_color'] ) && $line['text_color'] === 'custom' ) {
		$label_style .= 'color: ' . $line['custom_text_color'] . '!important';
	}
	$line_label_classes = $label_classes;
	if ( isset( $line['text_color'] ) ) {
		if ( $line['text_color'] === 'primary' ) {
			$line_label_classes .= ' primary-color-important';
		} elseif ( $line['text_color'] === 'secondary' ) {
			$line_label_classes .= ' secondary-color-important';
		}
	}
	$unit   = ( '' !== $units ) ? ' <span class="vc_label_units">' . $line['value'] . $units . '</span>' : '';
	$output .= '<div class="vc_single_bar_wrapper">';
	$output .= '<div class="' . esc_attr( $line_label_classes ) . '" style="' . esc_attr( $label_style ) . '">' . '<span class="vc_label_text">' . $line['label'] . '</span>' . $unit . '</div>';
	$output .= '<div class="' . esc_attr( implode( ' ', $track_classes ) ) . '">';
	$output .= '<small class="vc_label"></small>';

	$output .= '<span class="' . esc_attr( implode( ' ', $bar_classes ) . $line_bar_classes ) . '" data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . '" style="' . esc_attr( $bar_style ) . '"></span>';
	$output .= '</div></div>';
}

$output .= '</div>';

echo '' . $output;

<?php

class WPBakeryShortCode_TM_Portfolio extends WPBakeryShortCode {

	public function get_inline_css( $selector = '' ) {
		global $insight_shortcode_lg_css;
		global $insight_shortcode_md_css;
		global $insight_shortcode_sm_css;
		global $insight_shortcode_xs_css;

		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );

		if ( isset( $atts['carousel_height'] ) && $atts['carousel_height'] !== '' ) {
			$arr = explode( ';', $atts['carousel_height'] );

			foreach ( $arr as $value ) {
				$tmp = explode( ':', $value );
				if ( $tmp['0'] === 'lg' ) {
					$insight_shortcode_lg_css .= "$selector .swiper-slide img { height: {$tmp['1']}px; }";
				} elseif ( $tmp['0'] === 'md' ) {
					$insight_shortcode_md_css .= "$selector .swiper-slide img { height: {$tmp['1']}px; }";
				} elseif ( $tmp['0'] === 'sm' ) {
					$insight_shortcode_sm_css .= "$selector .swiper-slide img { height: {$tmp['1']}px; }";
				} elseif ( $tmp['0'] === 'xs' ) {
					$insight_shortcode_xs_css .= "$selector .swiper-slide img { height: {$tmp['1']}px; }";
				}
			}
		}

		if ( $custom_styling_enable === '1' ) {
			if ( isset ( $atts['item_border_radius'] ) && $atts['item_border_radius'] !== '' ) {
				$insight_shortcode_lg_css .= "$selector .grid-item { border-radius: {$atts['item_border_radius']}; overflow: hidden; }";
			}

			Insight_VC::get_responsive_css( array(
				'element' => "$selector .post-overlay-title",
				'atts'    => array(
					'font-size' => array(
						'media_str' => $overlay_title_font_size,
						'unit'      => 'px',
					),
				),
			) );
		}

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_tab = esc_html__( 'Carousel Settings', 'tm-moody' );
$styling_tab  = esc_html__( 'Styling', 'tm-moody' );

vc_map( array(
	'name'     => esc_html__( 'Portfolio', 'tm-moody' ),
	'base'     => 'tm_portfolio',
	'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'     => 'tm-i tm-i-portfoliogrid',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Portfolio Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Grid Classic', 'tm-moody' )         => 'grid',
				esc_html__( 'Grid Metro', 'tm-moody' )           => 'metro',
				esc_html__( 'Grid Masonry', 'tm-moody' )         => 'masonry',
				esc_html__( 'Carousel Slider', 'tm-moody' )      => 'carousel',
				esc_html__( 'Carousel Auto Wide', 'tm-moody' )   => 'carousel-auto-wide',
				esc_html__( 'Full Wide Slider', 'tm-moody' )     => 'full-wide-slider',
				esc_html__( 'Grid Justify Gallery', 'tm-moody' ) => 'justified',
			),
			'std'         => 'grid',
		),
		array(
			'heading'    => esc_html__( 'Metro Layout', 'tm-moody' ),
			'type'       => 'param_group',
			'param_name' => 'metro_layout',
			'params'     => array(
				array(
					'heading'     => esc_html__( 'Item Size', 'tm-moody' ),
					'type'        => 'dropdown',
					'param_name'  => 'size',
					'admin_label' => true,
					'value'       => array(
						esc_html__( 'Width 1 - Height 1', 'tm-moody' ) => '1:1',
						esc_html__( 'Width 1 - Height 2', 'tm-moody' ) => '1:2',
						esc_html__( 'Width 2 - Height 1', 'tm-moody' ) => '2:1',
						esc_html__( 'Width 2 - Height 2', 'tm-moody' ) => '2:2',
					),
					'std'         => '1:1',
				),
			),
			'value'      => rawurlencode( wp_json_encode( array(
				array(
					'size' => '2:2',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '2:2',
				),
				array(
					'size' => '1:1',
				),
				array(
					'size' => '1:1',
				),
			) ) ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'metro' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Columns', 'tm-moody' ),
			'type'        => 'number_responsive',
			'param_name'  => 'columns',
			'min'         => 1,
			'max'         => 6,
			'step'        => 1,
			'suffix'      => '',
			'media_query' => array(
				'lg' => '3',
				'md' => '',
				'sm' => '2',
				'xs' => '1',
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'masonry',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Gutter', 'tm-moody' ),
			'description' => esc_html__( 'Controls the gutter of grid.', 'tm-moody' ),
			'type'        => 'number',
			'param_name'  => 'gutter',
			'std'         => 30,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'masonry',
					'justified',
				),
			),
		),
		array(
			'heading'    => esc_html__( 'Image Size', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'image_size',
			'value'      => array(
				esc_html__( '480x480', 'tm-moody' ) => '480x480',
				esc_html__( '480x317', 'tm-moody' ) => '480x317',
				esc_html__( '585x395', 'tm-moody' ) => '585x395',
			),
			'std'        => '480x480',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Row Height', 'tm-moody' ),
			'description' => esc_html__( 'Controls the height of grid row.', 'tm-moody' ),
			'type'        => 'number',
			'param_name'  => 'justify_row_height',
			'std'         => 300,
			'min'         => 50,
			'max'         => 500,
			'step'        => 10,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'     => esc_html__( 'Max Row Height', 'tm-moody' ),
			'description' => esc_html__( 'Controls the max height of grid row. Leave blank or 0 keep it disabled.', 'tm-moody' ),
			'type'        => 'number',
			'param_name'  => 'justify_max_row_height',
			'std'         => 0,
			'min'         => 0,
			'max'         => 500,
			'step'        => 10,
			'suffix'      => 'px',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Last row alignment', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'justify_last_row_alignment',
			'value'      => array(
				esc_html__( 'Justify', 'tm-moody' )                              => 'justify',
				esc_html__( 'Left', 'tm-moody' )                                 => 'nojustify',
				esc_html__( 'Center', 'tm-moody' )                               => 'center',
				esc_html__( 'Right', 'tm-moody' )                                => 'right',
				esc_html__( 'Hide ( if row can not be justified )', 'tm-moody' ) => 'hide',
			),
			'std'        => 'justify',
			'dependency' => array(
				'element' => 'style',
				'value'   => array( 'justified' ),
			),
		),
		array(
			'heading'    => esc_html__( 'Overlay Style', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'overlay_style',
			'value'      => array(
				esc_html__( 'None', 'tm-moody' )                         => 'none',
				esc_html__( 'Modern', 'tm-moody' )                       => 'modern',
				esc_html__( 'Image zoom - content below', 'tm-moody' )   => 'zoom',
				esc_html__( 'Image zoom - content below 2', 'tm-moody' ) => 'zoom2',
				esc_html__( 'Faded', 'tm-moody' )                        => 'faded',
			),
			'std'        => 'faded',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'masonry',
					'carousel',
					'carousel-auto-wide',
					'justified',
				),
			),
		),
		Insight_VC::get_animation_field( array(
			'std'        => 'move-up',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'metro',
					'masonry',
					'justified',
				),
			),
		) ),
		Insight_VC::extra_class_field(),
		array(
			'group'       => $carousel_tab,
			'heading'     => esc_html__( 'Items Height', 'tm-moody' ),
			'type'        => 'number_responsive',
			'param_name'  => 'carousel_height',
			'min'         => 100,
			'max'         => 1000,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => 560,
				'md' => 440,
				'sm' => '',
				'xs' => 320,
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => 'carousel-auto-wide',
			),
		),
		array(
			'group'       => $carousel_tab,
			'heading'     => esc_html__( 'Auto Play', 'tm-moody' ),
			'description' => esc_html__( 'Delay between transitions (in ms), ex: 3000. Leave blank to disabled.', 'tm-moody' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_auto_play',
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'carousel-auto-wide',
					'full-wide-slider',
				),
			),
		),
		array(
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Navigation', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_nav',
			'value'      => Insight_VC::get_slider_navs(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'carousel-auto-wide',
					'full-wide-slider',
				),
			),
		),
		array(
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Pagination', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_pagination',
			'value'      => Insight_VC::get_slider_dots(),
			'std'        => '',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'carousel-auto-wide',
					'full-wide-slider',
				),
			),
		),
		array(
			'group'      => $carousel_tab,
			'heading'    => esc_html__( 'Gutter', 'tm-moody' ),
			'type'       => 'number',
			'param_name' => 'carousel_gutter',
			'std'        => 30,
			'min'        => 0,
			'max'        => 50,
			'step'       => 1,
			'suffix'     => 'px',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'carousel',
					'carousel-auto-wide',
				),
			),
		),
		array(
			'group'       => $carousel_tab,
			'heading'     => esc_html__( 'Items Display', 'tm-moody' ),
			'type'        => 'number_responsive',
			'param_name'  => 'carousel_items_display',
			'min'         => 1,
			'max'         => 10,
			'suffix'      => 'item (s)',
			'media_query' => array(
				'lg' => 3,
				'md' => 3,
				'sm' => 2,
				'xs' => 1,
			),
			'dependency'  => array(
				'element' => 'style',
				'value'   => 'carousel',
			),
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'tm-moody' ),
			'heading'     => esc_html__( 'Items per page', 'tm-moody' ),
			'description' => esc_html__( 'Number of items to show per page.', 'tm-moody' ),
			'type'        => 'number',
			'param_name'  => 'number',
			'std'         => 9,
			'min'         => 1,
			'max'         => 100,
			'step'        => 1,
		),
		array(
			'group'              => esc_html__( 'Data Settings', 'tm-moody' ),
			'heading'            => esc_html__( 'Narrow data source', 'tm-moody' ),
			'description'        => esc_html__( 'Enter categories, tags or custom taxonomies.', 'tm-moody' ),
			'type'               => 'autocomplete',
			'param_name'         => 'taxonomies',
			'settings'           => array(
				'multiple'       => true,
				'min_length'     => 1,
				'groups'         => true,
				// In UI show results grouped by groups, default false.
				'unique_values'  => true,
				// In UI show results except selected. NB! You should manually check values in backend, default false.
				'display_inline' => true,
				// In UI show results inline view, default false (each value in own line).
				'delay'          => 500,
				// delay for search. default 500.
				'auto_focus'     => true,
				// auto focus input, default true.
			),
			'param_holder_class' => 'vc_not-for-custom',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'tm-moody' ),
			'heading'     => esc_html__( 'Order by', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'orderby',
			'value'       => array(
				esc_html__( 'Date', 'tm-moody' )                  => 'date',
				esc_html__( 'Post ID', 'tm-moody' )               => 'ID',
				esc_html__( 'Author', 'tm-moody' )                => 'author',
				esc_html__( 'Title', 'tm-moody' )                 => 'title',
				esc_html__( 'Last modified date', 'tm-moody' )    => 'modified',
				esc_html__( 'Post/page parent ID', 'tm-moody' )   => 'parent',
				esc_html__( 'Number of comments', 'tm-moody' )    => 'comment_count',
				esc_html__( 'Menu order/Page Order', 'tm-moody' ) => 'menu_order',
				esc_html__( 'Meta value', 'tm-moody' )            => 'meta_value',
				esc_html__( 'Meta value number', 'tm-moody' )     => 'meta_value_num',
				esc_html__( 'Random order', 'tm-moody' )          => 'rand',
			),
			'description' => esc_html__( 'Select order type. If "Meta value" or "Meta value Number" is chosen then meta key is required.', 'tm-moody' ),
			'std'         => 'date',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'tm-moody' ),
			'heading'     => esc_html__( 'Sort order', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'order',
			'value'       => array(
				esc_html__( 'Descending', 'tm-moody' ) => 'DESC',
				esc_html__( 'Ascending', 'tm-moody' )  => 'ASC',
			),
			'description' => esc_html__( 'Select sorting order.', 'tm-moody' ),
			'std'         => 'DESC',
		),
		array(
			'group'       => esc_html__( 'Data Settings', 'tm-moody' ),
			'heading'     => esc_html__( 'Meta key', 'tm-moody' ),
			'description' => esc_html__( 'Input meta key for grid ordering.', 'tm-moody' ),
			'type'        => 'textfield',
			'param_name'  => 'meta_key',
			'dependency'  => array(
				'element' => 'orderby',
				'value'   => array(
					'meta_value',
					'meta_value_num',
				),
			),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Custom Styling Enable', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'custom_styling_enable',
			'value'      => array( esc_html__( 'Yes', 'tm-moody' ) => '1' ),
		),
		array(
			'group'      => $styling_tab,
			'heading'    => esc_html__( 'Items Border Radius', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'item_border_radius',
		),
		array(
			'group'       => $styling_tab,
			'heading'     => esc_html__( 'Overlay Title Font Size', 'tm-moody' ),
			'type'        => 'number_responsive',
			'param_name'  => 'overlay_title_font_size',
			'min'         => 8,
			'suffix'      => 'px',
			'media_query' => array(
				'lg' => '',
				'md' => '',
				'sm' => '',
				'xs' => '',
			),
		),
		array(
			'group'      => esc_html__( 'Filter', 'tm-moody' ),
			'heading'    => esc_html__( 'Filter Enable', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'filter_enable',
			'value'      => array( esc_html__( 'Enable', 'tm-moody' ) => '1' ),
			'std'        => '1',
		),
		array(
			'group'      => esc_html__( 'Filter', 'tm-moody' ),
			'heading'    => esc_html__( 'Filter Type', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'filter_type',
			'value'      => array(
				esc_html__( 'Isotope', 'tm-moody' ) => 'isotope',
				esc_html__( 'Ajax', 'tm-moody' )    => 'ajax',
			),
			'std'        => 'isotope',
		),
		array(
			'group'              => esc_html__( 'Filter', 'tm-moody' ),
			'heading'            => esc_html__( 'Narrow data source', 'tm-moody' ),
			'description'        => esc_html__( 'Enter only categories that you want to show in filter or leave blank to show all.', 'tm-moody' ),
			'type'               => 'autocomplete',
			'param_name'         => 'filter_category',
			'settings'           => array(
				'multiple'       => true,
				'min_length'     => 1,
				'groups'         => true,
				// In UI show results grouped by groups, default false.
				'unique_values'  => true,
				// In UI show results except selected. NB! You should manually check values in backend, default false.
				'display_inline' => true,
				// In UI show results inline view, default false (each value in own line).
				'delay'          => 500,
				// delay for search. default 500.
				'auto_focus'     => true,
				// auto focus input, default true.
			),
			'param_holder_class' => 'vc_not-for-custom',
		),
		array(
			'group'      => esc_html__( 'Filter', 'tm-moody' ),
			'heading'    => esc_html__( 'Filter Counter', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'filter_counter',
			'value'      => array( esc_html__( 'Enable', 'tm-moody' ) => '1' ),
			'std'        => '1',
		),
		array(
			'group'       => esc_html__( 'Filter', 'tm-moody' ),
			'heading'     => esc_html__( 'Filter Grid Wrapper', 'tm-moody' ),
			'description' => esc_html__( 'Wrap filter into grid container.', 'tm-moody' ),
			'type'        => 'checkbox',
			'param_name'  => 'filter_wrap',
			'value'       => array( esc_html__( 'Enable', 'tm-moody' ) => '1' ),
		),
		array(
			'group'      => esc_html__( 'Filter', 'tm-moody' ),
			'heading'    => esc_html__( 'Filter Align', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'filter_align',
			'value'      => array(
				esc_html__( 'Left', 'tm-moody' )   => 'left',
				esc_html__( 'Center', 'tm-moody' ) => 'center',
				esc_html__( 'Right', 'tm-moody' )  => 'right',
			),
			'std'        => 'center',
		),
		array(
			'group'      => esc_html__( 'Pagination', 'tm-moody' ),
			'heading'    => esc_html__( 'Pagination', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination',
			'value'      => array(
				esc_html__( 'No Pagination', 'tm-moody' ) => '',
				esc_html__( 'Button', 'tm-moody' )        => 'loadmore',
				esc_html__( 'Infinite', 'tm-moody' )      => 'infinite',
			),
			'std'        => '',
		),
		array(
			'group'      => esc_html__( 'Pagination', 'tm-moody' ),
			'heading'    => esc_html__( 'Pagination Align', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination_align',
			'value'      => array(
				esc_html__( 'Left', 'tm-moody' )   => 'left',
				esc_html__( 'Center', 'tm-moody' ) => 'center',
				esc_html__( 'Right', 'tm-moody' )  => 'right',
			),
			'std'        => 'center',
			'dependency' => array(
				'element' => 'pagination',
				'value'   => array( 'pagination', 'loadmore', 'infinite' ),
			),
		),
		array(
			'group'      => esc_html__( 'Pagination', 'tm-moody' ),
			'heading'    => esc_html__( 'Pagination Button Text', 'tm-moody' ),
			'type'       => 'textfield',
			'param_name' => 'pagination_button_text',
			'std'        => esc_html__( 'Load More', 'tm-moody' ),
			'dependency' => array(
				'element' => 'pagination',
				'value'   => 'loadmore',
			),
		),
	), Insight_VC::get_vc_spacing_tab() ),
) );


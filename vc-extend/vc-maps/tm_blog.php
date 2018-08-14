<?php

class WPBakeryShortCode_TM_Blog extends WPBakeryShortCode {

	public function get_inline_css( $selector = '' ) {
		global $insight_shortcode_lg_css;
		$atts = vc_map_get_attributes( $this->getShortcode(), $this->getAtts() );
		extract( $atts );
		$tmp      = '';
		$item_tmp = '';

		$style           = isset( $atts['style'] ) ? $atts['style'] : '';
		$gutter          = isset( $atts['gutter'] ) ? $atts['gutter'] : 0;
		$carousel_gutter = isset( $atts['carousel_gutter'] ) ? $atts['carousel_gutter'] : 0;

		if ( in_array( $style, array( 'grid' ), true ) ) {
			if ( $gutter > 0 ) {
				$item_tmp .= "margin-bottom: {$gutter}px";
			} else {
				$item_tmp .= "margin-bottom: -1px; margin-left: -1px;";
			}
		} elseif ( in_array( $style, array(
			'grid_left_image',
			'grid_classic',
			'grid_simple',
			'grid_flip_box',
			'grid_modern',
		), true ) ) {
			if ( $gutter > 0 ) {
				$item_tmp .= "margin-bottom: {$gutter}px";
			}
		} elseif ( $style === 'carousel' ) {
			if ( $carousel_gutter == 0 ) {
				$insight_shortcode_lg_css .= "$selector .post-item:not(.swiper-slide-active){ margin-left: -1px; }";
			}
		}

		if ( $tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector{ {$tmp} }";
		}

		if ( $item_tmp !== '' ) {
			$insight_shortcode_lg_css .= "$selector .post-item { {$item_tmp} }";
		}

		$insight_shortcode_lg_css .= Insight_VC::get_vc_spacing_css( $selector, $atts );
	}
}

$carousel_group = esc_html__( 'Carousel Settings', 'tm-moody' );

vc_map( array(
	'name'     => esc_html__( 'Blog', 'tm-moody' ),
	'base'     => 'tm_blog',
	'category' => INSIGHT_VC_SHORTCODE_CATEGORY,
	'icon'     => 'tm-i tm-i-blog',
	'params'   => array_merge( array(
		array(
			'heading'     => esc_html__( 'Blog Style', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'style',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Large Image', 'tm-moody' )        => 'list',
				esc_html__( 'Grid Overlay Image', 'tm-moody' ) => 'grid',
				esc_html__( 'Grid Preview Image', 'tm-moody' ) => 'grid_feature',
				esc_html__( 'Grid Simple', 'tm-moody' )        => 'grid_simple',
				esc_html__( 'Grid Left Image', 'tm-moody' )    => 'grid_left_image',
				esc_html__( 'Grid Classic', 'tm-moody' )       => 'grid_classic',
				esc_html__( 'Grid Modern', 'tm-moody' )        => 'grid_modern',
				esc_html__( 'Grid Flip Box', 'tm-moody' )      => 'grid_flip_box',
				esc_html__( 'Carousel Slider', 'tm-moody' )    => 'carousel',
				esc_html__( 'Magazine', 'tm-moody' )           => 'magazine',
				esc_html__( 'Metro', 'tm-moody' )              => 'metro',
			),
			'std'         => 'list',
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
			'heading'     => esc_html__( 'Blog Skin', 'tm-moody' ),
			'type'        => 'dropdown',
			'param_name'  => 'skin',
			'admin_label' => true,
			'value'       => array(
				esc_html__( 'Default', 'tm-moody' ) => '',
				esc_html__( 'Light', 'tm-moody' )   => 'light',
			),
			'std'         => '',
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
					'grid_left_image',
					'grid_feature',
					'grid_classic',
					'grid_simple',
					'grid_modern',
					'grid_flip_box',
					'metro',
				),
			),
		),
		array(
			'heading'     => esc_html__( 'Grid Gutter', 'tm-moody' ),
			'description' => esc_html__( 'Controls the gutter of grid. Default 30px', 'tm-moody' ),
			'type'        => 'number',
			'param_name'  => 'gutter',
			'std'         => 30,
			'min'         => 0,
			'max'         => 100,
			'step'        => 1,
			'suffix'      => 'px',
		),
		Insight_VC::get_animation_field(),
		Insight_VC::extra_class_field(),
		array(
			'group'       => $carousel_group,
			'heading'     => esc_html__( 'Auto Play', 'tm-moody' ),
			'description' => esc_html__( 'Delay between transitions (in ms), ex: 3000. Leave blank to disabled.', 'tm-moody' ),
			'type'        => 'number',
			'suffix'      => 'ms',
			'param_name'  => 'carousel_auto_play',
			'dependency'  => array( 'element' => 'style', 'value' => 'carousel' ),
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Navigation', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_nav',
			'value'      => Insight_VC::get_slider_navs(),
			'std'        => '',
			'dependency' => array( 'element' => 'style', 'value' => 'carousel' ),
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Pagination', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'carousel_pagination',
			'value'      => Insight_VC::get_slider_dots(),
			'std'        => '',
			'dependency' => array( 'element' => 'style', 'value' => 'carousel' ),
		),
		array(
			'group'      => $carousel_group,
			'heading'    => esc_html__( 'Gutter', 'tm-moody' ),
			'type'       => 'number',
			'param_name' => 'carousel_gutter',
			'std'        => 30,
			'min'        => 0,
			'max'        => 50,
			'step'       => 1,
			'suffix'     => 'px',
			'dependency' => array( 'element' => 'style', 'value' => 'carousel' ),
		),
		array(
			'group'       => $carousel_group,
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
			'dependency'  => array( 'element' => 'style', 'value' => 'carousel' ),
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
			'group'      => esc_html__( 'Filter', 'tm-moody' ),
			'heading'    => esc_html__( 'Filter Enable', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'filter_enable',
			'value'      => array( esc_html__( 'Enable', 'tm-moody' ) => '1' ),
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'grid_left_image',
					'grid_feature',
					'grid_classic',
					'grid_simple',
					'grid_flip_box',
					'grid_modern',
					'metro',
					'magazine',
				),
			),
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
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'grid_left_image',
					'grid_feature',
					'grid_classic',
					'grid_simple',
					'grid_flip_box',
					'grid_modern',
					'metro',
					'magazine',
				),
			),
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
			'dependency'         => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'grid_left_image',
					'grid_feature',
					'grid_classic',
					'grid_simple',
					'grid_flip_box',
					'grid_modern',
					'metro',
					'magazine',
				),
			),
		),
		array(
			'group'      => esc_html__( 'Filter', 'tm-moody' ),
			'heading'    => esc_html__( 'Filter Counter', 'tm-moody' ),
			'type'       => 'checkbox',
			'param_name' => 'filter_counter',
			'value'      => array( esc_html__( 'Enable', 'tm-moody' ) => '1' ),
			'std'        => '1',
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'grid_left_image',
					'grid_feature',
					'grid_classic',
					'grid_simple',
					'grid_flip_box',
					'grid_modern',
					'metro',
					'magazine',
				),
			),
		),
		array(
			'group'       => esc_html__( 'Filter', 'tm-moody' ),
			'heading'     => esc_html__( 'Filter Grid Wrapper', 'tm-moody' ),
			'description' => esc_html__( 'Wrap filter into grid container.', 'tm-moody' ),
			'type'        => 'checkbox',
			'param_name'  => 'filter_wrap',
			'value'       => array( esc_html__( 'Enable', 'tm-moody' ) => '1' ),
			'dependency'  => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'grid_left_image',
					'grid_feature',
					'grid_classic',
					'grid_simple',
					'grid_flip_box',
					'grid_modern',
					'metro',
					'magazine',
				),
			),
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
			'dependency' => array(
				'element' => 'style',
				'value'   => array(
					'grid',
					'grid_left_image',
					'grid_feature',
					'grid_classic',
					'grid_simple',
					'grid_flip_box',
					'grid_modern',
					'metro',
					'magazine',
				),
			),
		),
		array(
			'group'      => esc_html__( 'Pagination', 'tm-moody' ),
			'heading'    => esc_html__( 'Pagination', 'tm-moody' ),
			'type'       => 'dropdown',
			'param_name' => 'pagination',
			'value'      => array(
				esc_html__( 'No Pagination', 'tm-moody' ) => '',
				esc_html__( 'Pagination', 'tm-moody' )    => 'pagination',
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
			'std'        => 'left',
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

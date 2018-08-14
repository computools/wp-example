if ( _.isUndefined( window.vc ) ) {
	var vc = {atts: {}};
}
(
	function ( $ ) {
		var TMNumberResponsiveParam = Backbone.View.extend( {
			                                                    events: {}, initialize: function () {
			}, render: function () {
				return this;
			}, save: function () {
				var data = [];
				this.$el.find( '.number_responsive_field' ).each( function () {
					var $field = $( this );
					var $id = $( this ).attr( 'id' );
					if ( $field.is( '[type=number]' ) && $field.val() != '' ) {
						data.push( $id + ':' + $field.val() );
					}
				} );
				return data.reverse();
			}
		                                                    } );
		vc.atts.number_responsive = {
			parse: function ( param ) {
				var $field = this.content()
				                 .find( 'input.wpb_vc_param_value.' + param.param_name + '' ), number_responsive = $field.data( 'tmNumberResponsiveParam' ), result = number_responsive.save();
				return result.join( ';' );
			}, init: function ( param, $field ) {
				$( '[data-number-responsive="true"]', $field ).each( function () {
					var $this = $( this ), $field = $this.find( '.wpb_vc_param_value' );
					$field.data( 'tmNumberResponsiveParam', new TMNumberResponsiveParam( {el: $this} ).render() );
				} );
			}
		};

		/* event for plus and minus buttons */
		function isInt( n ) {
			return n % 1 === 0;
		}

		$( '.plus, .minus' ).on( 'click', function () {

			// Get values
			var $number = $( this )
				.closest( '.tm_number' )
				.find( '.number_responsive_field' ), currentVal = parseFloat( $number.val() ), max = parseFloat( $number.attr( 'max' ) ), min = parseFloat( $number.attr( 'min' ) ), step = $number.attr( 'step' );

			// Format values
			if ( ! currentVal || currentVal === '' || currentVal === 'NaN' ) {
				currentVal = 0;
			}
			if ( max === '' || max === 'NaN' ) {
				max = '';
			}
			if ( min === '' || min === 'NaN' ) {
				min = 0;
			}
			if ( step === 'any' || step === '' || step === undefined || parseFloat( step ) === 'NaN' ) {
				step = 1;
			}

			// Change the value
			if ( $( this ).is( '.plus' ) ) {

				if ( max && (
						max == currentVal || currentVal > max
					) ) {
					$number.val( max );
				} else {

					if ( isInt( step ) ) {
						$number.val( currentVal + parseFloat( step ) );
					} else {
						$number.val( (
							             currentVal + parseFloat( step )
						             ).toFixed( 1 ) );
					}
				}

			} else {

				if ( min && (
						min == currentVal || currentVal < min
					) ) {
					$number.val( min );
				} else if ( currentVal > 0 ) {
					if ( isInt( step ) ) {
						$number.val( currentVal - parseFloat( step ) );
					} else {
						$number.val( (
							             currentVal - parseFloat( step )
						             ).toFixed( 1 ) );
					}
				}

			}

			// Trigger change event
			$number.trigger( 'change' );
		} );
	}
)( window.jQuery );

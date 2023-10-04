/**
 * Upadate Live Customizer Setting
 *
 * @package Nexter
 * @since 1.0.0
 */
 
 ( function( $ ) {
	'use strict';
	
	var api = wp.customize;
	var nexter_preview = {
		
		init : function () {
			var $this = this,
				themeOption = 'nxt-theme-options';
			//Body Typography
			$this.responsiveSlider( themeOption + '[body-line-height]', 'body, button, input, select,optgroup, textarea', 'line-height' );
			$this.commonCss( themeOption + '[body-transform]', 'body, button, input, select,optgroup, textarea', 'text-transform' );
			$this.commonCss( themeOption + '[body-color]', 'body', 'color' );
			$this.commonCss( themeOption + '[paragraph-mb]', 'p, .entry-content p', 'margin-bottom', 'em' );
			$this.backgroundCss( themeOption + '[body-bgcolor]', 'body' );
			$this.backgroundCss( themeOption + '[content-bgcolor]', '#content.site-content' );
			
			//Site Header Block Container Width
			$this.containerCss( themeOption + '[site-header-block-width]', '#nxt-header .nxt-container-block-editor > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-template-load),#nxt-header .nxt-container-block-editor > .nxt-template-load > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce), .nxt-breadcrumb-wrap .nxt-container-block-editor > .nxt-template-load > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull)', 'max-width' );
			
			//Site Header Container Width
			$this.containerCss( themeOption + '[site-header-container-width]', '#nxt-header .nxt-container-block-editor .alignwide,#nxt-header .nxt-container', 'max-width' );

			//Site Header Container Fluid Spacing
			$this.responsiveDimension( themeOption + '[header-fluid-spacing]', '#nxt-header .nxt-container-fluid', 'padding', ['right', 'left' ] );
			
			//Site Footer Block Container Width
			$this.containerCss( themeOption + '[site-footer-block-width]', '#nxt-footer .nxt-container-block-editor > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-template-load),#nxt-footer .nxt-container-block-editor > .nxt-template-load > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce)', 'max-width' );
			
			//Site Footer Container Width
			$this.containerCss( themeOption + '[site-footer-container-width]', '#nxt-footer .nxt-container-block-editor .alignwide,#nxt-footer .nxt-container', 'max-width' );
			
            //Site Footer Container Fluid Spacing
			$this.responsiveDimension( themeOption + '[footer-fluid-spacing]', '#nxt-footer .nxt-container-fluid', 'padding', ['right', 'left' ] );

			//Site Block Container Width
			$this.containerCss( themeOption + '[layout-block-width]', '.site-content .nxt-container-block-editor > .nxt-row article > .entry-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce),.nxt-container-block-editor .site-main > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull), .site-content > .nxt-container-block-editor > *:not(.content-area):not(.nxt-row):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull)', 'max-width' );
			//Site Container Width
			$this.containerCss( themeOption + '[layout-container]', '.site-content .nxt-container-block-editor .alignwide,.site-content .nxt-container', 'max-width' );
			//Site Container Fluid Spacing
			$this.responsiveDimension( themeOption + '[site-fluid-spacing]', '.site-content .nxt-container-fluid:not(.nxt-archive-cont),.site-content .nxt-container-fluid:not(.nxt-archive-cont) .nxt-row .nxt-col', 'padding', ['right', 'left' ] );
            $this.responsiveDimension( themeOption + '[site-fluid-spacing]', '.site-content .nxt-container-fluid:not(.nxt-archive-cont) .nxt-row,.archive-page-header', 'margin', ['right', 'left' ], false, 'minus' );

			//Page Block Container Width
			$this.containerCss( themeOption + '[site-page-block-width]', '.site-content .nxt-page-cont.nxt-container-block-editor >.nxt-row article >.entry-content >*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce)', 'max-width' );
			//Page Container
			$this.containerCss( themeOption + '[layout-page-container]', '.site-content .nxt-page-cont.nxt-container-block-editor .alignwide, .nxt-page-cont.nxt-container', 'max-width' );
            //Page Container Fluid Spacing
			$this.responsiveDimension( themeOption + '[page-fluid-spacing]', '.site-content .nxt-page-cont.nxt-container-fluid,.site-content .nxt-page-cont.nxt-container-fluid .nxt-row .nxt-col', 'padding', ['right', 'left' ] );
            $this.responsiveDimension( themeOption + '[page-fluid-spacing]', '.site-content .nxt-page-cont.nxt-container-fluid .nxt-row', 'margin', ['right', 'left' ], false, 'minus' );
			
			//Posts Block Container Width
			$this.containerCss( themeOption + '[site-posts-block-width]', '.site-content > .nxt-post-cont.nxt-container-block-editor .site-main >*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull), .site-content > .nxt-post-cont.nxt-container-block-editor >*:not(.content-area):not(.nxt-row):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull)', 'max-width' );
			//Posts Container
			$this.containerCss( themeOption + '[layout-posts-container]', '.site-content .nxt-post-cont.nxt-container-block-editor .alignwide, .nxt-post-cont.nxt-container', 'max-width' );
			//Posts Container Fluid Spacing
            $this.responsiveDimension( themeOption + '[post-fluid-spacing]', '.site-content .nxt-post-cont.nxt-container-fluid,.site-content .nxt-post-cont.nxt-container-fluid .nxt-row .nxt-col', 'padding', ['right', 'left' ] );
            $this.responsiveDimension( themeOption + '[post-fluid-spacing]', '.site-content .nxt-post-cont.nxt-container-fluid .nxt-row', 'margin', ['right', 'left' ], false, 'minus' );

			//Archive Block Container Width
			$this.containerCss( themeOption + '[site-archive-block-width]', '.site-content >.nxt-container-block-editor.nxt-archive-cont >*:not(.content-area):not(.nxt-row):not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(.nxt-alignfull), .nxt-container-block-editor.nxt-archive-cont .site-main >*:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.wp-block-separator):not(.woocommerce):not(article):not(.nxt-alignfull)', 'max-width' );
			//Archive Container
			$this.containerCss( themeOption + '[layout-archive-container]', '.site-content .nxt-archive-cont.nxt-container-block-editor .alignwide, .site-content .nxt-archive-cont.nxt-container', 'max-width' );
			//Archive Container Fluid Spacing
            $this.responsiveDimension( themeOption + '[archive-fluid-spacing]', '.site-content .nxt-archive-cont.nxt-container-fluid,.site-content .nxt-archive-cont.nxt-container-fluid .site-main > .nxt-row > .nxt-col', 'padding', ['right', 'left' ] );
            $this.responsiveDimension( themeOption + '[archive-fluid-spacing]', '.site-content .nxt-archive-cont.nxt-container-fluid .site-main > .nxt-row,.archive-page-header', 'margin', ['right', 'left' ], false, 'minus' );

			//woo Container Width
			$this.containerCss( themeOption + '[woo-container-width]', '.nxt-woocommerce .nxt-container', 'max-width' );
			//woo Container Fluid Spacing
            $this.responsiveDimension( themeOption + '[woo-fluid-spacing]', '.woocommerce .site-content .nxt-container-fluid,.woocommerce .site-content .nxt-container-fluid .nxt-row .nxt-col', 'padding', ['right', 'left' ] );
            $this.responsiveDimension( themeOption + '[woo-fluid-spacing]', '.woocommerce .site-content .nxt-container-fluid .site-main > .nxt-row,.woocommerce ul.products, .woocommerce-page ul.products,.nxt-prodcut-nav.nxt-row', 'margin', ['right', 'left' ], false, 'minus' );

			$this.responsiveDimension( themeOption + '[body-frame-padding]','body', 'padding', ['top', 'right', 'bottom', 'left' ] );
			//Fixed Body Frame
			$this.responsiveDimension( themeOption + '[body-frame-padding]','.nxt-body-frame.frame-top', 'height', ['top'], true );
			$this.responsiveDimension( themeOption + '[body-frame-padding]','.nxt-body-frame.frame-bottom', 'height', ['bottom'], true );
			$this.responsiveDimension( themeOption + '[body-frame-padding]','.nxt-body-frame.frame-left', 'width', ['left'], true );
			$this.responsiveDimension( themeOption + '[body-frame-padding]','.nxt-body-frame.frame-right', 'width', ['right'], true );
			
			//Selected Text/content color
			$this.commonCss( themeOption + '[selected-text-bg-color]', '::selection', 'background' );
			$this.commonCss( themeOption + '[selected-text-color]', '::selection', 'color' );
			
			//H1-H6 typography
			var headingStyle = { 'h1' : 'h1, h1 a', 'h2' : 'h2, h2 a', 'h3' : 'h3, h3 a, .archive-post-title a', 'h4' : 'h4, h4 a', 'h5' : 'h5, h5 a', 'h6' : 'h6, h6 a'};
			Object.keys(headingStyle).forEach(function (key) {
				$this.responsiveFontSize( themeOption + '[font-size-'+key+']', headingStyle[key]);
				$this.responsiveSlider( themeOption + '[line-height-'+key+']', headingStyle[key], 'line-height');
				$this.commonCss( themeOption + '[transform-'+key+']', headingStyle[key], 'text-transform' );
				$this.commonCss( themeOption + '[heading-color-'+key+']', headingStyle[key], 'color' );
			})
			
			//Single Post Title Typography
			$this.responsiveFontSize( themeOption + '[font-size-s-blog-title]', '.single-post-title h1');
			$this.commonCss( themeOption + '[s-blog-title-line-height]', '.single-post-title h1', 'line-height');
			$this.commonCss( themeOption + '[s-blog-title-transform]', '.single-post-title h1', 'text-transform');
			$this.commonCss( themeOption + '[s-blog-title-color]', '.single-post-title h1', 'color' );
			$this.commonCss( themeOption + '[s-blog-title-letter-spacing]', '.single-post-title h1', 'letter-spacing','px');
		
			//Post Meta Typography
			$this.responsiveFontSize( themeOption + '[font-size-s-post-meta]', '.nxt-meta-info');
			$this.commonCss( themeOption + '[s-post-meta-line-height]', '.nxt-meta-info', 'line-height');
			$this.commonCss( themeOption + '[s-post-meta-transform]', '.nxt-meta-info', 'text-transform');
			$this.commonCss( themeOption + '[s-post-meta-color]', '.nxt-meta-info,.nxt-meta-info a', 'color' );
			$this.commonCss( themeOption + '[s-post-meta-letter-spacing]', '.nxt-meta-info', 'letter-spacing', 'px');
		},
		
		//Remove Style Tag 
		removeStyleClass : function ( option ){
			if( option ){
				option = option.replace( '[', '-' ).replace( ']', '' );
				$( 'style.' + option ).remove();
			}
		},
		
		//Add Style Tag 
		addStyleClass : function ( option, style ){
			if( option ){
				option = option.replace( '[', '-' ).replace( ']', '' );
				var styleClass = $( 'style.' + option );
				if(styleClass.length){
					styleClass.replaceWith( '<style class="' + option + '">' + style+ '</style>' );
				}else{
					$( 'head' ).append( '<style class="' + option + '">' + style+ '</style>' );
				}
			}
		},
		
		responsiveMedia : function(selector , css, maxWidth){
			if( css ){
				return '@media (max-width: '+maxWidth+'px) {' + selector + ' { ' + css + ' } }';
			}else {
				return '';
			}
		},
		
		//Responsive Font Size
		responsiveFontSize : function( option, selector ) {
			var $this = this;
			api( option, function( value ) {
				value.bind( function( value ) {
				
					if ( value.desktop || value.mobile || value.tablet ) {
						
						var property = 'font-size', mdSize = '', smSize = '', xsSize = '';
						if ( value.desktop != '' ) {
							mdSize = property + ' : ' + value.desktop + value['desktop-unit'];
						}
						if ( value.tablet != '' ) {
							smSize = property + ' : ' + value.tablet + value['tablet-unit'];
						}
						if ( value.mobile != '' ) {
							xsSize = property + ' : ' + value.mobile + value['mobile-unit'];
						}
						
						var style = (mdSize) ? selector + ' { ' + mdSize + ' }' : '';
							style += (smSize) ? $this.responsiveMedia(selector, smSize, '1024') : '';
							style += (xsSize) ? $this.responsiveMedia(selector, xsSize, '767') : '';
							
						$this.addStyleClass( option, style );
					} else {
						$this.removeStyleClass( option );
					}
				});
			});
			
		},
		
		//Responsive Slider
		responsiveSlider : function ( option, selector, property, unit='' ){
		
			var $this = this;
			api( option, function( value ) {
				value.bind( function( value ) {
				
					if ( value.desktop || value.tablet || value.mobile ) {
						var style='';
						if(value.desktop != ''){
							style += selector +'{ '+ property +' : ' + value.desktop + unit +' } ';
						}
						if(value.tablet != ''){
							var smVal = property + ' : ' + value.tablet + unit;
							style += $this.responsiveMedia(selector, smVal, '1024');
						}
						if(value.mobile != ''){
							var xsVal = property + ' : ' + value.tablet + unit;
							style += $this.responsiveMedia(selector, xsVal, '767');
						}
						$this.addStyleClass( option, style );
					}else{
						api.preview.send( 'refresh' );
						$this.removeStyleClass( option );
					}
					
				});
			});
			
		},
		
		//Responsive Dimension
		responsiveDimension : function( option, selector, property, align, fixed_val=false, minus= '' ){
		
			var $this = this;
			api( option, function( value ) {
				value.bind( function( value ) {
				
					var defaultAlign = "";
					var defaultProperty = "padding";
					if ( value.md.top || value.md.right || value.md.bottom || value.md.left || value.sm.top || value.sm.right || value.sm.bottom || value.sm.left || value.xs.top || value.xs.right || value.xs.bottom || value.xs.left ) {
						
						if ( typeof align != undefined ) {
							defaultAlign = align + "";
							defaultAlign = defaultAlign.replace(/,/g , "-");
						}
						if ( typeof property != undefined ) {
							defaultProperty = property + "";
						}
						
						$this.removeStyleClass( option + '-' + defaultProperty + '-' + defaultAlign );
						
						var paddingAlign = ( typeof align != undefined ) ? align : [ 'top','bottom','right','left' ];
						
						var deviceStyle = [];
						
						$.each( [ 'md', 'sm', 'xs' ], function( index, device ){
							deviceStyle[device] = '';
							$.each( paddingAlign, function( index, alignVal ){
								if ( value[device][alignVal] != '' ) {
									if ( typeof fixed_val != undefined && fixed_val==false) {
										var fixedAlign = '-' + alignVal;
									}else{
										var fixedAlign = '';
									}
									deviceStyle[device] += defaultProperty + fixedAlign +': ' + (minus=='minus' ? '-' : '') +value[device][alignVal] + value[device+'-unit'] +';';
								}
							});
						});
						
						var style = (deviceStyle.md) ? selector + ' { ' + deviceStyle.md + ' }' : '';
							style += (deviceStyle.sm) ? $this.responsiveMedia(selector, deviceStyle.sm, '1024') : '';
							style += (deviceStyle.xs) ? $this.responsiveMedia(selector, deviceStyle.xs, '767') : '';
							
						$this.addStyleClass( option + '-' + defaultProperty + '-' + defaultAlign, style );
					}else{
						api.preview.send( 'refresh' );
						$this.removeStyleClass( option + '-' + defaultProperty + '-' + defaultAlign );
					}
					
				});
			});
			
		},
		
		//Background Css
		backgroundCss : function( option, selector ){
			
			var $this = this;
			api( option, function( value ) {
				value.bind( function( value ) {
					var bgType = (value['bg-type']) ? value['bg-type'] : '',
						bgColor = (value['bg-color']) ? value['bg-color'] : '',
						bgImg = (value['bg-image']) ? value['bg-image'] : '',
						style= '';
					
					if( bgColor ==='' && bgImg ==='' ){
						api.preview.send( 'refresh' );
					}else{
						if ( bgColor !== '' && bgType === 'color' ) {
							style = 'background-color: ' + bgColor + ';';
							style += 'background-image: none;';
						}else if ( bgImg !== '' && bgType === 'image' ) {
							style = 'background-image: url(' + bgImg + ');';
							style += (value['bg-size']!='') ? 'background-size: ' + value['bg-size'] + ';' : '';
							style += (value['bg-position']!='') ? 'background-position: ' + value['bg-position'] + ';' : '';
							style += (value['bg-repeat']!='') ? 'background-repeat: ' + value['bg-repeat'] + ';' : '';
							style += (value['bg-attachment']!='') ? 'background-attachment: ' + value['bg-attachment'] + ';' : '';
						}
					}
					
					if(style){
						style = selector + ' { ' + style + ' }';
						$this.addStyleClass( option, style );
					}
					
				});
			});
			
		},
		
		//container Class Style
		containerCss : function ( option, selector, property ){
			var $this = this;
			api( option, function( value ) {
				value.bind( function( value ) {
					if(value.desktop !='' || value.tablet != '' || value.mobile != ''){
						var style='';
						if( value.desktop !='' ){
							style += '@media (min-width: 992px) {';
							style += selector +'{ ' + property +' : ' + value.desktop + 'px } ';
							style += '}';
						}
						if(value.tablet != ''){
							style += '@media (max-width: 991px)and (min-width: 577px) {';
							style += selector +'{ ' + property +' : ' + value.tablet + 'px } ';
							style += '}';
						}
						if(value.mobile != ''){
							style += '@media (max-width: 576px) {';
							style += selector +'{ ' + property +' : ' + value.mobile + 'px } ';
							style += '}';
						}
						$this.addStyleClass( option, style );
					}else{
						api.preview.send( 'refresh' );
					}
				});
			});
			
		},
		//Common Style Css
		commonCss : function( option, selector, property, unit ){
		
			var $this = this;
			api( option, function( value ) {
				value.bind( function( value ) {
					if( value ){
					
						if ( typeof unit != 'undefined') {
							if ( unit === 'url' ) {
								value = 'url(' + value + ')';	//unit => url
							} else {
								value = value + unit;	//unit => px,em,rem
							}
						}
						
						var style = selector + ' { ' + property + ': ' + value + ' }';
						$this.addStyleClass( option, style );
						
					}else{
						api.preview.send( 'refresh' );
						$this.removeStyleClass( option );
					}
				});
			});
			
		},
	};
	$(function () { nexter_preview.init(); });
})(jQuery);
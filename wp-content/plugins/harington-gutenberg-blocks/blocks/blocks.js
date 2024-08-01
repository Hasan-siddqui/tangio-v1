/**
 * Harington Shortcodes Gutenberg Blocks
 *
 */
( function( blocks, blockEditor, i18n, element, components ) {
	var el = element.createElement;
	var __ = i18n.__;
	var RichText = blockEditor.RichText;
	var PlainText = blockEditor.PlainText;
	var MediaPlaceHolder = blockEditor.MediaPlaceHolder;
	var TextControl = components.TextControl;
	var TextareaControl = components.TextareaControl;
	var RangeControl = components.RangeControl;
	var ColorPaletteControl = components.ColorPalette;
	var ColorPickerControl = components.ColorPicker;
	var SelectControl = components.SelectControl;
	var InspectorControls = blockEditor.InspectorControls;
	var MediaUpload = blockEditor.MediaUpload;
	var InnerBlocks = blockEditor.InnerBlocks;
	var AlignmentToolbar = blockEditor.AlignmentToolbar;
	var BlockControls = blockEditor.BlockControls;
 	
	/** Utils **/
	function normalizeUndef( x ){
		
		if (typeof x === 'undefined'){
			
			 return '';
		}
		else{
			
			return x;
		}
	}
	
	/** Button **/
	blocks.registerBlockType( 'harington-gutenberg/button', {
		title: __( 'Harington: Button Box', 'harington-gutenberg' ),
		icon: 'editor-removeformatting',
		category: 'harington-block-category',
		attributes: {
			caption: {
				type: 'string',
				default: __( 'Caption', 'harington-gutenberg' )
			},
			background_color: {
				type: 'string',
				default: ''
			},
			text_color: {
				type: 'string',
				default: ''
			},
			link: {
				type: 'string',
				default: 'http://'
			},
			target: {
				type: 'string',
				default: '_blank'
			},
			type: {
				type: 'string',
				default: 'normal'
			},
			rounded: {
				type: 'string',
				default: 'yes'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'button', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			const colorsBackground = [ 
				{ name: 'Default', color: '#ffffff' }
			];
			
			const colorsText = [ 
				{ name: 'Default', color: '#000000' }
			];
			
			return [
				
				 el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-button-box is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-editor-removeformatting' } ),
									),
									__('Harington Button Box', 'harington-gutenberg' ) ),
						
						el( PlainText,
						{
							className: 'clapat-inline-caption',
							value: props.attributes.caption,
							onChange: ( value ) => { props.setAttributes( { caption: value } ); },
						}),
						el( PlainText,
						{
							className: 'clapat-inline-content',
							value: props.attributes.link,
							onChange: ( value ) => { props.setAttributes( { link: value } ); },
						}),
						
						/*
						 * InspectorControls lets you add controls to the Block sidebar.
						 */
						el( InspectorControls, {},
							el( 'div', { className: 'components-panel__body is-opened' }, 
								el( 'strong', {}, __('Select Background Color:',  'harington-gutenberg') ),
									el( 'div', { className : 'clapat-color-palette' },
										el( ColorPaletteControl, {
											colors: colorsBackground,
											value: props.attributes.background_color,
											onChange: ( value ) => { 
												props.setAttributes( { background_color: value === undefined ? '' : value } ); 
											},
										} )
									),
									
								el( 'strong', {}, __('Select Text Color:',  'harington-gutenberg') ),
									el( 'div', { className : 'clapat-color-palette' },
										el( ColorPaletteControl, {
											colors: colorsText,
											value: props.attributes.text_color,
											onChange: ( value ) => { 
												props.setAttributes( { text_color: value === undefined ? '' : value } ); 
											},
										} )
									),
									
								el( SelectControl, {
									label: __('Type', 'harington-gutenberg'),
									value: props.attributes.type,
									options : [
										{ label: __('Normal', 'harington-gutenberg'), value: 'normal' },
										{ label: __('Outline',  'harington-gutenberg'), value: 'outline' },
									],
									onChange: ( value ) => { props.setAttributes( { type: value } ); },
								} ),
								el( SelectControl, {
									label: __('Rounded', 'harington-gutenberg'),
									value: props.attributes.rounded,
									options : [
										{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
										{ label: __('No',  'harington-gutenberg'), value: 'no' },
									],
									onChange: ( value ) => { props.setAttributes( { rounded: value } ); },
								} ),
								el( SelectControl, {
									label: __('Link Target', 'harington-gutenberg'),
									value: props.attributes.target,
									options: [
										{ label: 'Blank', value: '_blank' },
										{ label: 'Self', value: '_self' },
									],
									onChange: ( value ) => { props.setAttributes( { target: value } ); },
								} ),
								el( SelectControl, {
									label: __('Has animation', 'harington-gutenberg'),
									value: props.attributes.has_animation,
									options : [
										{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
										{ label: __('No',  'harington-gutenberg'), value: 'no' },
									],
									onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
								} ),
								el( 'div', { className : 'clapat-range-control' }, 
									el( RangeControl, {
										label: __('Animation delay',  'harington-gutenberg'),
										value: props.attributes.animation_delay,
										onChange: ( value ) => { 
											if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
									} ) ),
							),
						),
					)
			]
		},
		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[button link="' + props.attributes.link + '" target="' + props.attributes.target + '" type="' + props.attributes.type + '" rounded="' + props.attributes.rounded + '" background_color="' + props.attributes.background_color + '" text_color="' + props.attributes.text_color + '" animation="' + props.attributes.has_animation + '" animation_delay="' + props.attributes.animation_delay + '" extra_class_name="' + addClassName + '"]' + props.attributes.caption + '[/button]'; 
		},
	} );
	
	/** Text Link **/
	blocks.registerBlockType( 'harington-gutenberg/button-link', {
		title: __( 'Harington: Button Link', 'harington-gutenberg' ),
		icon: 'admin-links',
		category: 'harington-block-category',
		attributes: {
			caption: {
				type: 'string',
				default: __( 'Read More', 'harington-gutenberg' )
			},
			link: {
				type: 'string',
				default: 'http://'
			},
			target: {
				type: 'string',
				default: '_blank'
			},
			position: {
				type: 'string',
				default: 'left'
			},
			type: {
				type: 'string',
				default: 'arrow'
			},
			size: {
				type: 'string',
				default: 'small-btn'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'button', 'harington-gutenberg' ), __( 'link', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
				
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-button-link is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-admin-links' } ),
									),
									__('Harington Button Link', 'harington-gutenberg' ) ),
						
						el( PlainText,
						{
							className: 'clapat-inline-caption',
							value: props.attributes.caption,
							onChange: ( value ) => { props.setAttributes( { caption: value } ); },
						}),
						el( PlainText,
						{
							className: 'clapat-inline-content',
							value: props.attributes.link,
							onChange: ( value ) => { props.setAttributes( { link: value } ); },
						}),
						
						/*
						 * InspectorControls lets you add controls to the Block sidebar.
						 */
						el( InspectorControls, {},
							el( 'div', { className: 'components-panel__body is-opened' }, 
								el( SelectControl, {
									label: __('Link Target', 'harington-gutenberg'),
									value: props.attributes.target,
									options: [
										{ label: 'Blank', value: '_blank' },
										{ label: 'Self', value: '_self' },
									],
									onChange: ( value ) => { props.setAttributes( { target: value } ); },
								} ),
								el( SelectControl, {
									label: __('Position', 'harington-gutenberg'),
									value: props.attributes.position,
									options: [
										{ label: 'Left', value: 'left' },
										{ label: 'Right', value: 'right' },
									],
									onChange: ( value ) => { props.setAttributes( { position: value } ); },
								} ),
								el( SelectControl, {
									label: __('Type', 'harington-gutenberg'),
									value: props.attributes.type,
									options: [
										{ label: 'Arrow', value: 'arrow' },
										{ label: 'Bullet', value: 'bullet' },
									],
									onChange: ( value ) => { props.setAttributes( { type: value } ); },
								} ),
								el( SelectControl, {
									label: __('Size', 'harington-gutenberg'),
									value: props.attributes.size,
									options: [
										{ label: 'Small', value: 'small-btn' },
										{ label: 'Large', value: 'large-btn' },
									],
									onChange: ( value ) => { props.setAttributes( { size: value } ); },
								} ),
								el( SelectControl, {
									label: __('Has animation', 'harington-gutenberg'),
									value: props.attributes.has_animation,
									options : [
										{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
										{ label: __('No',  'harington-gutenberg'), value: 'no' },
									],
									onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
								} ),
								el( 'div', { className : 'clapat-range-control' }, 
									el( RangeControl, {
										label: __('Animation delay',  'harington-gutenberg'),
										value: props.attributes.animation_delay,
										onChange: ( value ) => { 
											if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
									} ) ),
							),
							
						),
					)
			]
		},
		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[button_link link="' + props.attributes.link + '" target="' + props.attributes.target + '" caption="' + props.attributes.caption + '" position="' + props.attributes.position + '" type="' + props.attributes.type + '" size="' + props.attributes.size + '" animation="' + props.attributes.has_animation + '" animation_delay="' + props.attributes.animation_delay + '" extra_class_name="' + addClassName + '"][/button_link]'; 
		},
	} );
	
	/** Marquee Content **/
	blocks.registerBlockType( 'harington-gutenberg/marquee-content', {
		title: __( 'Harington: Marquee Content', 'harington-gutenberg' ),
		icon: 'editor-textcolor',
		category: 'harington-block-category',
		attributes: {
			direction: {
				type: 'string',
				default: 'fw'
			},
			caption: {
				type: 'string',
				default: 'Marquee text'
			},
		},
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'marquee text', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
					el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-marquee-text is-large'},
						el( 'div', { className: 'components-placeholder__label' }, 
							el( 'span', { className: 'block-editor-block-icon has-colors' },
								el( 'span', { className: 'dashicon dashicons dashicons-editor-textcolor' } ),
								),
								__('Harington Marquee Content', 'harington-gutenberg' ) ),
						
						el( PlainText,
						{
							className: 'clapat-inline-caption',
							value: props.attributes.caption,
							onChange: ( value ) => { props.setAttributes( { caption: value } ); },
						}),
						/*
						 * InspectorControls lets you add controls to the Block sidebar.
						 */
						el( InspectorControls, {},
							el( 'div', { className: 'components-panel__body is-opened' }, 
								el( SelectControl, {
									label: __('Direction', 'harington-gutenberg'),
									value: props.attributes.direction,
									options : [
										{ label: __('Forward', 'harington-gutenberg'), value: 'fw' },
										{ label: __('Backward',  'harington-gutenberg'), value: 'bw' },
									],
									onChange: ( value ) => { props.setAttributes( { direction: value } ); },
								} ),
							),
						),
					
					)
			]
		},
		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[marquee_content direction="' + props.attributes.direction + '" extra_class_name="' + addClassName + '"]' + props.attributes.caption + '[/marquee_content]'; 
		},			
			
	} );
	
	/** Moving Title **/
	blocks.registerBlockType( 'harington-gutenberg/moving-title', {
		title: __( 'Harington: Moving Title', 'harington-gutenberg' ),
		icon: 'editor-textcolor',
		category: 'harington-block-category',
		attributes: {
			direction: {
				type: 'string',
				default: 'title-moving-forward'
			},
			caption: {
				type: 'string',
				default: 'Moving text'
			},
		},
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'moving title', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
					el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-moving-title is-large'},
						el( 'div', { className: 'components-placeholder__label' }, 
							el( 'span', { className: 'block-editor-block-icon has-colors' },
								el( 'span', { className: 'dashicon dashicons dashicons-editor-textcolor' } ),
								),
								__('Harington Moving Title', 'harington-gutenberg' ) ),
						
						el( PlainText,
						{
							className: 'clapat-inline-caption',
							value: props.attributes.caption,
							onChange: ( value ) => { props.setAttributes( { caption: value } ); },
						}),
						/*
						 * InspectorControls lets you add controls to the Block sidebar.
						 */
						el( InspectorControls, {},
							el( 'div', { className: 'components-panel__body is-opened' }, 
								el( SelectControl, {
									label: __('Direction', 'harington-gutenberg'),
									value: props.attributes.direction,
									options : [
										{ label: __('Forward', 'harington-gutenberg'), value: 'title-moving-forward' },
										{ label: __('Backward',  'harington-gutenberg'), value: 'title-moving-backward' },
									],
									onChange: ( value ) => { props.setAttributes( { direction: value } ); },
								} ),
							),
						),
					)
			]
		},
		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[moving_title direction="' + props.attributes.direction + '" extra_class_name="' + addClassName + '"]' + props.attributes.caption + '[/moving_title]'; 
		},			
			
	} );

	/** Moving Gallery **/
	const template_clapat_moving_gallery = [
	  [ 'harington-gutenberg/moving-gallery-image', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'harington-gutenberg/moving-gallery', {
		title: __( 'Harington: Moving Gallery', 'harington-gutenberg' ),
		icon: 'images-alt2',
		category: 'harington-block-category',
		allowedBlocks: ['harington-gutenberg/moving-gallery-image'],
		attributes: {
			direction: {
				type: 'string',
				default: 'fw-gallery'
			},
			randomize: {
				type: 'string',
				default: 'no'
			}
		}, 
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'moving gallery', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-moving-gallery is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-images-alt2' } ),
									),
									__('Harington Moving Gallery', 'harington-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['harington-gutenberg/moving-gallery-image'], template: template_clapat_moving_gallery} ),
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Direction', 'harington-gutenberg'),
										value: props.attributes.direction,
										options : [
											{ label: __('Forward', 'harington-gutenberg'), value: 'fw-gallery' },
											{ label: __('Backward', 'harington-gutenberg'), value: 'bw-gallery' },
										],
										onChange: ( value ) => { props.setAttributes( { direction: value } ); },
									} ),
									el( SelectControl, {
										label: __('Randomize gallery images size?', 'harington-gutenberg'),
										value: props.attributes.randomize,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { randomize: value } ); },
									} )
								),
							),
						);

		},

		save: function( props ) {
			
			let blockClasses = 'moving-gallery';
			blockClasses += ' ' + props.attributes.direction;
			if( props.attributes.randomize !== 'no' ) { blockClasses += ' random-sizes'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, 
						el( 'ul', { className: 'wrapper-gallery' }, InnerBlocks.Content() )
					);
	
		},
	} );
	
	blocks.registerBlockType( 'harington-gutenberg/moving-gallery-image', {
		title: __( 'Harington: Moving Gallery Image', 'harington-gutenberg' ),
		icon: 'format-image',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/moving-gallery' ],

		attributes: {
			gallery_image: {
				type: 'string',
				default: ''
			},
			gallery_image_id: {
				type: 'number',
			}
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					gallery_image: media.url,
					gallery_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.gallery_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.gallery_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.gallery_image_id ? i18n.__( 'Upload Gallery Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.gallery_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Gallery Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),

				)
				
			];
		},

		save: function( props ) {
			
			return '[clapat_moving_gallery_image img_url="' + props.attributes.gallery_image + '" img_id="' + props.attributes.gallery_image_id + '"][/clapat_moving_gallery_image]'; 

		},
	} );
	
	/** Horizontal Scrolling Panels **/
	const template_clapat_scrolling_panels = [
	  [ 'harington-gutenberg/scrolling-panels-image', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'harington-gutenberg/scrolling-panels', {
		title: __( 'Harington: Horizontal Scrolling Panels', 'harington-gutenberg' ),
		icon: 'slides',
		category: 'harington-block-category',
		allowedBlocks: ['harington-gutenberg/scrolling-panels-image'],
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'horizontal', 'harington-gutenberg' ), __( 'scrolling panels', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-scrolling-panels is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-slides' } ),
									),
									__('Harington Horizontal Scrolling Panels', 'harington-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['harington-gutenberg/scrolling-panels-image'], template: template_clapat_scrolling_panels} )
						);

		},

		save: function( props ) {
			
			let blockClasses = 'panels';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, 
						el( 'div', { className: 'panels-container' }, InnerBlocks.Content() )
					);
	
		},
	} );
	
	blocks.registerBlockType( 'harington-gutenberg/scrolling-panels-image', {
		title: __( 'Harington: Horizontal Scrolling Panels Image', 'harington-gutenberg' ),
		icon: 'format-image',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/scrolling-panels' ],

		attributes: {
			panel_image: {
				type: 'string',
				default: ''
			},
			panel_image_id: {
				type: 'number',
			}
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					panel_image: media.url,
					panel_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.panel_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.panel_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.panel_image_id ? i18n.__( 'Upload Panel Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.panel_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Panel Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),

				)
				
			];
		},

		save: function( props ) {
			
			return '[clapat_scrolling_panels_image img_url="' + props.attributes.panel_image + '" img_id="' + props.attributes.panel_image_id + '"][/clapat_scrolling_panels_image]';

		},
	} );
	
	/** Zoom Gallery **/
	const template_clapat_zoom_gallery = [
	  [ 'harington-gutenberg/zoom-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'harington-gutenberg/zoom-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'harington-gutenberg/zoom-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'harington-gutenberg/zoom-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'harington-gutenberg/zoom-gallery-image', {} ] // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'harington-gutenberg/zoom-gallery', {
		title: __( 'Harington: Zoom Gallery', 'harington-gutenberg' ),
		icon: 'welcome-view-site',
		category: 'harington-block-category',
		allowedBlocks: ['harington-gutenberg/zoom-gallery-image'],
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'zoom', 'harington-gutenberg' ), __( 'gallery', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-zoom-gallery is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-welcome-view-site' } ),
									),
									__('Harington Zoom Gallery', 'harington-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['harington-gutenberg/zoom-gallery-image'], template: template_clapat_zoom_gallery} )
						);

		},

		save: function( props ) {
			
			let blockClasses = 'zoom-gallery';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, 
						el( 'ul', { className: 'zoom-wrapper-gallery' }, InnerBlocks.Content() )
					);
	
		},
	} );
	
	blocks.registerBlockType( 'harington-gutenberg/zoom-gallery-image', {
		title: __( 'Harington: Zoom Gallery Image', 'harington-gutenberg' ),
		icon: 'format-image',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/zoom-gallery' ],

		attributes: {
			gallery_image: {
				type: 'string',
				default: ''
			},
			gallery_image_id: {
				type: 'number',
			}
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					gallery_image: media.url,
					gallery_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.gallery_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.gallery_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.gallery_image_id ? i18n.__( 'Upload Gallery Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.gallery_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Gallery Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),

				)
				
			];
		},

		save: function( props ) {
			
			return '[clapat_zoom_gallery_image img_url="' + props.attributes.gallery_image + '" img_id="' + props.attributes.gallery_image_id + '"][/clapat_zoom_gallery_image]';

		},
	} );
	
	/** Slowed Text Pin **/
	const template_clapat_slowed_text_pin_gallery = [
	  [ 'harington-gutenberg/slowed-text-pin-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'harington-gutenberg/slowed-text-pin-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'harington-gutenberg/slowed-text-pin-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'harington-gutenberg/slowed-text-pin-gallery-image', {} ], // [ blockName, attributes ]
	  [ 'harington-gutenberg/slowed-text-pin-gallery-image', {} ] // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'harington-gutenberg/slowed-text-pin-gallery', {
		title: __( 'Harington: Slowed Text Pin Gallery', 'harington-gutenberg' ),
		icon: 'welcome-widgets-menus',
		category: 'harington-block-category',
		allowedBlocks: ['harington-gutenberg/slowed-text-pin-gallery-image'],
		
		attributes: {
			pre_title_text: {
				type: 'string',
				default: ''
			},
			title_text: {
				type: 'string',
				default: ''
			},
			subtitle_text: {
				type: 'string',
				default: ''
			},
		},
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'slowed text pin', 'harington-gutenberg' ), __( 'gallery', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-slowed-text-pin-gallery is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-welcome-widgets-menus' } ),
									),
									__('Harington Slowed Text Pin Gallery', 'harington-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['harington-gutenberg/slowed-text-pin-gallery-image'], template: template_clapat_slowed_text_pin_gallery} ),
							
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' },
								
									el( TextareaControl, {
										label: __('Pre Title', 'harington-gutenberg'),
										value: props.attributes.pre_title_text,
										onChange: ( value ) => { props.setAttributes( { pre_title_text: value } ); },
									} ),
									
									el( TextareaControl, {
										label: __('Title', 'harington-gutenberg'),
										value: props.attributes.title_text,
										onChange: ( value ) => { props.setAttributes( { title_text: value } ); },
									} ),
									
									el( TextareaControl, {
										label: __('Sub Title', 'harington-gutenberg'),
										value: props.attributes.subtitle_text,
										onChange: ( value ) => { props.setAttributes( { subtitle_text: value } ); },
									} ),
									
								),
							),
						);

		},

		save: function( props ) {
			
			let blockClasses = 'slowed-pin';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, 
						el( 'div', { className: 'slowed-text' },
							el( 'h5', {}, props.attributes.pre_title_text ),
							el( 'h1', { className: 'big-title' }, props.attributes.title_text ),
							el( 'hr' ),
							el( 'h5', {}, props.attributes.subtitle_text ),
						),
						el( 'div', { className: 'slowed-images' }, InnerBlocks.Content() )
					);
	
		},
	} );
	
	blocks.registerBlockType( 'harington-gutenberg/slowed-text-pin-gallery-image', {
		title: __( 'Harington: Slowed Text Pin Gallery Image', 'harington-gutenberg' ),
		icon: 'format-image',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/slowed-text-pin-gallery' ],

		attributes: {
			gallery_image: {
				type: 'string',
				default: ''
			},
			gallery_image_id: {
				type: 'number',
			}
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					gallery_image: media.url,
					gallery_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.gallery_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.gallery_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.gallery_image_id ? i18n.__( 'Upload Gallery Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.gallery_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Gallery Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),

				)
				
			];
		},

		save: function( props ) {
			
			return '[clapat_slowed_text_pin_image img_url="' + props.attributes.gallery_image + '" img_id="' + props.attributes.gallery_image_id + '"][/clapat_slowed_text_pin_image]';

		},
	} );
	
	/** Accordion **/
	const template_clapat_accordion = [
	  [ 'harington-gutenberg/accordion-item', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'harington-gutenberg/accordion', {
		title: __( 'Harington: Accordion', 'harington-gutenberg' ),
		icon: 'editor-justify',
		category: 'harington-block-category',
		allowedBlocks: ['harington-gutenberg/accordion-item'],
		attributes: {
			type: {
				type: 'string',
				default: 'small-acc'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			}
		}, 

		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'accordion', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-accordion is-large'},
							el( 'div', { className: 'components-placeholder__label' }, 
								el( 'span', { className: 'block-editor-block-icon has-colors' },
									el( 'span', { className: 'dashicon dashicons dashicons-editor-justify' } ),
								),
								__('Harington Accordion', 'harington-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['harington-gutenberg/accordion-item'], template: template_clapat_accordion} ),
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Type', 'harington-gutenberg'),
										value: props.attributes.type,
										options : [
											{ label: __('Small Accordion', 'harington-gutenberg'), value: 'small-acc' },
											{ label: __('Big Accordion',  'harington-gutenberg'), value: 'bigger-acc' },
										],
										onChange: ( value ) => { props.setAttributes( { type: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has animation', 'harington-gutenberg'),
										value: props.attributes.has_animation,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
									} ),
									el( 'div', { className : 'clapat-range-control' }, 
										el( RangeControl, {
											label: __('Animation delay',  'harington-gutenberg'),
											value: props.attributes.animation_delay,
											onChange: ( value ) => { 
												if (typeof value === "undefined") return;
												props.setAttributes( { animation_delay: value } ); 
											},
											type: 'number',
											step: 50,
											min: 0,
											max: 1000
										} ) ),
								),
							),
						)	

		},

		save: function( props ) {
			
			let blockClasses = 'accordion';
			blockClasses += ' ' + props.attributes.type;
			if( props.attributes.has_animation !== 'no' ) { blockClasses += ' has-animation'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'dl', { className: blockClasses, 'data-delay': props.attributes.animation_delay }, InnerBlocks.Content() );
	
		},
	} );
	
	blocks.registerBlockType( 'harington-gutenberg/accordion-item', {
		title: __( 'Harington: Accordion Item', 'harington-gutenberg' ),
		icon: 'editor-justify',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/accordion' ],

		attributes: {
			title: {
				type: 'string',
				default: __( 'Accordion Title. Click to edit it.', 'harington-gutenberg')
			},
			content: {
				type: 'string',
				default: __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non est nec orci ultricies fringilla. Nam ultrices sem in odio scelerisque, sed mollis magna tincidunt.', 'harington-gutenberg')
			}
		},

		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( PlainText,
					{
						className: 'clapat-inline-caption',
						value: props.attributes.title,
						onChange: ( value ) => { props.setAttributes( { title: value } ); },
					}),
					
					el( PlainText, {
						className: 'clapat-inline-content',
						value: props.attributes.content,
						onChange: ( value ) => { props.setAttributes( { content: value } ); },
					} ),
				),
				
			];
		},

		save: function( props ) {
			
			return '[accordion_item title="' + props.attributes.title + '"]' + props.attributes.content + '[/accordion_item]'; 

		},
	} );
	
	/** Icon Box **/
	blocks.registerBlockType( 'harington-gutenberg/icon-box', {
		title: __( 'Harington: Icon Box', 'harington-gutenberg' ),
		icon: 'admin-generic',
		category: 'harington-block-category',
		attributes: {
			icon: {
				type: 'string',
				default: __( 'fa fa-envelope', 'harington-gutenberg')
			},
			title: {
				type: 'string',
				default: __( 'Icon Box Title. Click to edit it.', 'harington-gutenberg')
			},
			type: {
				type: 'string',
				default: 'inline-boxes'
			},
			content: {
				type: 'string',
				default: __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut non est nec orci ultricies fringilla. Nam ultrices sem in odio scelerisque, sed mollis magna tincidunt.', 'harington-gutenberg')
			},
			
		},
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ),  __( 'icon box', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
				
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-icon-box is-large'},
						el( 'div', { className: 'components-placeholder__label' }, 
							el( 'span', { className: 'block-editor-block-icon has-colors' },
								el( 'span', { className: 'dashicon dashicons dashicons-admin-generic' } ),
								),
								__('Harington Icon Box', 'harington-gutenberg' ) ),
					
					el( PlainText,
					{
						className: 'clapat-inline-caption',
						value: props.attributes.icon,
						onChange: ( value ) => { props.setAttributes( { icon: value } ); },
					}),
					
					el( PlainText,
					{
						className: 'clapat-inline-caption',
						value: props.attributes.title,
						onChange: ( value ) => { props.setAttributes( { title: value } ); },
					}),
					
					el( PlainText, {
						className: 'clapat-inline-content',
						value: props.attributes.content,
						onChange: ( value ) => { props.setAttributes( { content: value } ); },
					} ),
						/*
						 * InspectorControls lets you add controls to the Block sidebar.
						 */
						el( InspectorControls, {},
							el( 'div', { className: 'components-panel__body is-opened' }, 
								el( SelectControl, {
									label: __('Type', 'harington-gutenberg'),
									value: props.attributes.type,
									options : [
										{ label: __('Inline', 'harington-gutenberg'), value: 'inline-boxes' },
										{ label: __('Block',  'harington-gutenberg'), value: 'block-boxes' },
									],
									onChange: ( value ) => { props.setAttributes( { type: value } ); },
								} ),
							),
						),
					
				),
				 
			]
		},
		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[icon_box icon="' + props.attributes.icon + '" title="' + props.attributes.title + '" type="' + props.attributes.type + '" extra_class_name="' + addClassName + '"]' + props.attributes.content + '[/icon_box]';
		},
	} );
	
	/** Image Collage **/
	const template_clapat_collage = [
	  [ 'harington-gutenberg/collage-image', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'harington-gutenberg/collage', {
		title: __( 'Harington: Collage', 'harington-gutenberg' ),
		icon: 'layout',
		category: 'harington-block-category',
		allowedBlocks: ['harington-gutenberg/collage-image'],
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'collage', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-collage is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-slides' } ),
									),
									__('Harington Collage', 'harington-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['harington-gutenberg/collage-image'], template: template_clapat_collage} )
						);

		},

		save: function( props ) {
			
			let blockClasses = 'justified-grid';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, InnerBlocks.Content() );
	
		},
	} );
	
	blocks.registerBlockType( 'harington-gutenberg/collage-image', {
		title: __( 'Harington: Collage Image', 'harington-gutenberg' ),
		icon: 'format-image',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/collage' ],

		attributes: {
			thumb_image: {
				type: 'string',
				default: ''
			},
			thumb_image_id: {
				type: 'number',
			},
			full_image: {
				type: 'string',
				default: ''
			},
			full_image_id: {
				type: 'number',
			},
			alt: {
				type: 'string',
				default: ''
			},
			info: {
				type: 'string',
				default: __( 'Caption Text', 'harington-gutenberg' )
			},
		},

		edit: function( props ) {
			
			var onSelectThumbnailImage = function( media ) {
				return props.setAttributes( {
					thumb_image: media.url,
					thumb_image_id: media.id,
				} );
			};
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					full_image: media.url,
					full_image_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectThumbnailImage,
							type: 'image',
							value: props.attributes.thumb_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.thumb_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.thumb_image_id ? i18n.__( 'Upload Thumbnail Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.thumb_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Thumbnail Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.full_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.full_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.full_image_id ? i18n.__( 'Upload Popup Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.full_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Full Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),

				),
				/*
				 * InspectorControls lets you add controls to the Block sidebar.
				 */
				el( InspectorControls, {},
					el( 'div', { className: 'components-panel__body is-opened' }, 
						el( TextControl, {
							label: __( 'ALT attribute', 'harington-gutenberg' ),
							value: props.attributes.alt,
							onChange: ( value ) => { props.setAttributes( { alt: value } ); },
						} ),
						
						el( TextControl, {
							label: __( 'Collage Image Info', 'harington-gutenberg' ),
							value: props.attributes.info,
							onChange: ( value ) => { props.setAttributes( { info: value } ); },
						} ),
					),
				),
			];
		},

		save: function( props ) {
			
			return '[clapat_collage_image thumb_img_url="' + props.attributes.thumb_image + '" img_url="' + props.attributes.full_image + '" alt="' + props.attributes.alt + '" info="' + props.attributes.info + '"][/clapat_collage_image]'; 

		},
	} );
	
	/** Image Carousel **/
	const template_clapat_image_carousel = [
	  [ 'harington-gutenberg/carousel-image', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'harington-gutenberg/carousel', {
		title: __( 'Harington: Image Carousel', 'harington-gutenberg' ),
		icon: 'slides',
		category: 'harington-block-category',
		allowedBlocks: ['harington-gutenberg/carousel-image'],
		attributes: {
			loop: {
				type: 'string',
				default: 'no'
			},
			cursor_type: {
				type: 'string',
				default: 'light-cursor'
			},
			autocenter: {
				type: 'string',
				default: 'yes'
			},
			enable_dots_nav: {
				type: 'string',
				default: 'yes'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'carousel', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	[
							el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-slider is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-slides' } ),
									),
									__('Harington Carousel', 'harington-gutenberg' ) ),
								el( InnerBlocks, {allowedBlocks: ['harington-gutenberg/carousel-image'], template: template_clapat_image_carousel} )
							),
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Loop', 'harington-gutenberg'),
										value: props.attributes.loop,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { loop: value } ); },
									} ),
									el( SelectControl, {
										label: __('Cursor Type', 'harington-gutenberg'),
										value: props.attributes.cursor_type,
										options : [
											{ label: __('Light', 'harington-gutenberg'), value: 'light-cursor' },
											{ label: __('Dark',  'harington-gutenberg'), value: 'dark-cursor' },
										],
										onChange: ( value ) => { props.setAttributes( { cursor_type: value } ); },
									} ),
									el( SelectControl, {
										label: __('Autocenter', 'harington-gutenberg'),
										value: props.attributes.autocenter,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { autocenter: value } ); },
									} ),
									el( SelectControl, {
										label: __('Enable Dots Nav', 'harington-gutenberg'),
										value: props.attributes.enable_dots_nav,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { enable_dots_nav: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has animation', 'harington-gutenberg'),
										value: props.attributes.has_animation,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
									} ),
									el( 'div', { className : 'clapat-range-control' }, 
										el( RangeControl, {
											label: __('Animation delay',  'harington-gutenberg'),
											value: props.attributes.animation_delay,
											onChange: ( value ) => { 
												if (typeof value === "undefined") return;
												props.setAttributes( { animation_delay: value } ); 
											},
											type: 'number',
											step: 50,
											min: 0,
											max: 1000
										} ) ),
								),
							),
						];
		},

		save: function( props ) {
			
			let blockClasses = 'swiper-container';
			if( props.attributes.loop !== 'no' ) { blockClasses += ' content-looped-carousel'; } else { blockClasses += ' content-carousel'; }
			blockClasses += ' ' + props.attributes.cursor_type;
			if( props.attributes.enable_dots_nav !== 'yes' ) { blockClasses += ' disabled-slider-dots'; }
			if( props.attributes.autocenter !== 'no' ) { blockClasses += ' autocenter'; }
			if( props.attributes.has_animation !== 'no' ) { blockClasses += ' has-animation'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			let inner_el = el( 'div', { className: 'swiper-wrapper' }, InnerBlocks.Content() );
			let button_next_el =  el( 'div', { className: 'slider-button-next' } );
			let button_prev_el =  el( 'div', { className: 'slider-button-prev' } );
			let dots_nav =  el( 'div', { className: 'swiper-pagination' } );
			
			return el( 'div', { 
								className: blockClasses,
								'data-delay': props.attributes.animation_delay
							}, inner_el, button_next_el, button_prev_el, dots_nav );
			
		},
	} );
	
	blocks.registerBlockType( 'harington-gutenberg/carousel-image', {
		title: __( 'Harington: Carousel Image', 'harington-gutenberg' ),
		icon: 'format-image',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/carousel' ],

		attributes: {
			img_url: {
				type: 'string',
				default: ''
			},
			img_id: {
				type: 'number',
			},
			alt: {
				type: 'string',
				default: ''
			},
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					img_url: media.url,
					img_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.img_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.img_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.img_id ? i18n.__( 'Upload Carousel Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.img_url } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Carousel Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),

				),
				/*
				 * InspectorControls lets you add controls to the Block sidebar.
				 */
				el( InspectorControls, {},
					el( 'div', { className: 'components-panel__body is-opened' }, 
						el( TextControl, {
							label: __( 'ALT attribute', 'harington-gutenberg' ),
							value: props.attributes.alt,
							onChange: ( value ) => { props.setAttributes( { alt: value } ); },
						} ),
					),
				),
			];
		},

		save: function( props ) {
			
			return '[carousel_slide img_url="' + props.attributes.img_url + '" alt="' + props.attributes.alt + '"][/carousel_slide]'; 

		},
	} );
	
	/** Image Slider **/
	const template_clapat_image_slider = [
	  [ 'harington-gutenberg/slider-image', {} ], // [ blockName, attributes ]
	];
	
	blocks.registerBlockType( 'harington-gutenberg/slider', {
		title: __( 'Harington: Image Slider', 'harington-gutenberg' ),
		icon: 'images-alt2',
		category: 'harington-block-category',
		allowedBlocks: ['harington-gutenberg/slider-image'],
		
		attributes: {
			cursor_type: {
				type: 'string',
				default: 'light-cursor'
			},
			autocenter: {
				type: 'string',
				default: 'yes'
			},
			enable_dots_nav: {
				type: 'string',
				default: 'yes'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'slider', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-slider is-large'},
							el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-images-alt2' } ),
									),
									__('Harington Slider', 'harington-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['harington-gutenberg/slider-image'], template: template_clapat_image_slider} ),
							
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Cursor Type', 'harington-gutenberg'),
										value: props.attributes.cursor_type,
										options : [
											{ label: __('Light', 'harington-gutenberg'), value: 'light-cursor' },
											{ label: __('Dark',  'harington-gutenberg'), value: 'dark-cursor' },
										],
										onChange: ( value ) => { props.setAttributes( { cursor_type: value } ); },
									} ),
									el( SelectControl, {
										label: __('Autocenter', 'harington-gutenberg'),
										value: props.attributes.autocenter,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { autocenter: value } ); },
									} ),
									el( SelectControl, {
										label: __('Enable Dots Nav', 'harington-gutenberg'),
										value: props.attributes.enable_dots_nav,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { enable_dots_nav: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has animation', 'harington-gutenberg'),
										value: props.attributes.has_animation,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
									} ),
									el( 'div', { className : 'clapat-range-control' }, 
										el( RangeControl, {
											label: __('Animation delay',  'harington-gutenberg'),
											value: props.attributes.animation_delay,
											onChange: ( value ) => { 
												if (typeof value === "undefined") return;
												props.setAttributes( { animation_delay: value } ); 
											},
											type: 'number',
											step: 50,
											min: 0,
											max: 1000
										} ) ),
									
								),
							),
						);

		},

		save: function( props ) {
			
			let blockClasses = 'swiper-container content-slider';
			blockClasses += ' ' + props.attributes.cursor_type;
			if( props.attributes.autocenter !== 'no' ) { blockClasses += ' autocenter'; }
			if( props.attributes.enable_dots_nav !== 'yes' ) { blockClasses += ' disabled-slider-dots'; }
			if( props.attributes.has_animation !== 'no' ) { blockClasses += ' has-animation'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			let inner_el = el( 'div', { className: 'swiper-wrapper' }, InnerBlocks.Content() );
			let button_next_el =  el( 'div', { className: 'slider-button-next' } );
			let button_prev_el =  el( 'div', { className: 'slider-button-prev' } );
			let dots_nav =  el( 'div', { className: 'swiper-pagination' } );
			
			return el( 'div', { 
								className: blockClasses,
								'data-delay': props.attributes.animation_delay
							}, inner_el, button_next_el, button_prev_el, dots_nav );
				
		},
	} );
	
	blocks.registerBlockType( 'harington-gutenberg/slider-image', {
		title: __( 'Harington: Slider Image', 'harington-gutenberg' ),
		icon: 'format-image',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/slider' ],

		attributes: {
			img_url: {
				type: 'string',
				default: ''
			},
			img_id: {
				type: 'number',
			},
			alt: {
				type: 'string',
				default: ''
			},
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					img_url: media.url,
					img_id: media.id,
				} );
			};
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.img_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.img_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.img_id ? i18n.__( 'Upload Slider Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.img_url } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Slider Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),

				),
				/*
				 * InspectorControls lets you add controls to the Block sidebar.
				 */
				el( InspectorControls, {},
					el( 'div', { className: 'components-panel__body is-opened' }, 
						el( TextControl, {
							label: __( 'ALT attribute', 'harington-gutenberg' ),
							value: props.attributes.alt,
							onChange: ( value ) => { props.setAttributes( { alt: value } ); },
						} ),
					),
				),
			];
		},

		save: function( props ) {
			
			return '[general_slide img_url="' + props.attributes.img_url + '" alt="' + props.attributes.alt + '"][/general_slide]'; 

		},
	} );
	
	/** Counter **/
	blocks.registerBlockType( 'harington-gutenberg/counter', {
		title: __( 'Harington: Counter', 'harington-gutenberg' ),
		icon: 'performance',
		category: 'harington-block-category',
		
		attributes: {
			data_start: {
				type: 'string',
				default: '1000'
			},
			data_target: {
				type: 'string',
				default: '3000'
			},
			text_size: {
				type: 'string',
				default: 'h1'
			},
			animation_type: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},

		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'counter', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-counter is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-performance' } ),
						),
						__('Harington Counter', 'harington-gutenberg' ) ),
					
					el ( props.attributes.text_size, { className: 'clapat-inline-value' }, props.attributes.data_start ),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
						el( 'div', { className: 'components-panel__body is-opened' },
						
							el( TextControl, {
								label: __('Start Value', 'harington-gutenberg'),
								type: "number",
								value: props.attributes.data_start,
								onChange: ( value ) => { props.setAttributes( { data_start: value } ); },
							} ),
							
							el( TextControl, {
								label: __('Target Value', 'harington-gutenberg'),
								type: "number",
								value: props.attributes.data_target,
								onChange: ( value ) => { props.setAttributes( { data_target: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Text Size', 'harington-gutenberg'),
								value: props.attributes.text_size,
								options: [
									{ label: 'H1', value: 'h1' },
									{ label: 'H2', value: 'h2' },
									{ label: 'H3', value: 'h3' },
									{ label: 'H4', value: 'h4' },
									{ label: 'H5', value: 'h5' },
									{ label: 'H6', value: 'h6' },
								],
								onChange: ( value ) => { props.setAttributes( { text_size: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Has Animation', 'harington-gutenberg'),
								value: props.attributes.animation_type,
								options: [
									{ label: 'Yes', value: 'yes' },
									{ label: 'No', value: 'no' }
								],
								onChange: ( value ) => { props.setAttributes( { animation_type: value } ); },
							} ),
						
							el( 'div', { className : 'clapat-range-control' }, 
								el( RangeControl, {
									label: __('Animation delay',  'harington-gutenberg'),
									value: props.attributes.animation_delay,
									onChange: ( value ) => { 
										if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
									} ) ),
						),
					),

				),
				
			];
		},

		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[clapat_counter data_start="' + props.attributes.data_start + '" data_target="' + props.attributes.data_target + '" text_size="' + props.attributes.text_size + '" animation="' + props.attributes.animation_type + '" animation_delay="' + props.attributes.animation_delay + '" extra_class_name="' + addClassName + '"][/clapat_counter]';

		},
	} );
	
	/** Parallax Image **/
	blocks.registerBlockType( 'harington-gutenberg/parallax-image', {
		title: __( 'Harington: Parallax Image', 'harington-gutenberg' ),
		icon: 'format-image',
		category: 'harington-block-category',
		
		attributes: {
			parallax_image: {
				type: 'string',
				default: ''
			},
			parallax_image_id: {
				type: 'number',
			},
			parallax_text: {
				type: 'string',
				default: ''
			},
			parallax_text_size: {
				type: 'string',
				default: 'h1'
			},
			caption_alignment: {
				type: 'string',
				default: 'text-align-center'
			},
			animation_type: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},

		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'parallax', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					parallax_image: media.url,
					parallax_image_id: media.id,
				} );
			};
				
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-parallax-image is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-format-image' } ),
						),
						__('Harington Parallax Image', 'harington-gutenberg' ) ),
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.parallax_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.parallax_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.parallax_image_id ? i18n.__( 'Upload Parallax Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.parallax_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Parallax Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
						el( 'div', { className: 'components-panel__body is-opened' },
						
							el( TextareaControl, {
								label: __('Overlay Caption', 'harington-gutenberg'),
								value: props.attributes.parallax_text,
								onChange: ( value ) => { props.setAttributes( { parallax_text: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Caption Size', 'harington-gutenberg'),
								value: props.attributes.parallax_text_size,
								options: [
									{ label: 'H1', value: 'h1' },
									{ label: 'H2', value: 'h2' },
									{ label: 'H3', value: 'h3' },
									{ label: 'H4', value: 'h4' },
									{ label: 'H5', value: 'h5' },
									{ label: 'H6', value: 'h6' },
								],
								onChange: ( value ) => { props.setAttributes( { parallax_text_size: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Caption Alignment', 'harington-gutenberg'),
								value: props.attributes.caption_alignment,
								options: [
									{ label: 'Center', value: 'text-align-center' },
									{ label: 'Left', value: 'text-align-left' },
								],
								onChange: ( value ) => { props.setAttributes( { caption_alignment: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('Has Animation', 'harington-gutenberg'),
								value: props.attributes.animation_type,
								options: [
									{ label: 'Yes', value: 'yes' },
									{ label: 'No', value: 'no' }
								],
								onChange: ( value ) => { props.setAttributes( { animation_type: value } ); },
							} ),
						
							el( 'div', { className : 'clapat-range-control' }, 
								el( RangeControl, {
									label: __('Animation delay',  'harington-gutenberg'),
									value: props.attributes.animation_delay,
									onChange: ( value ) => { 
										if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
									} ) ),
						),
					),

				),
				
			];
		},

		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[clapat_parallax_image img_url="' + props.attributes.parallax_image + '" img_id="' + props.attributes.parallax_image_id + '" text_size="' + props.attributes.parallax_text_size + '" caption_alignment="' + props.attributes.caption_alignment + '" animation="' + props.attributes.animation_type + '" animation_delay="' + props.attributes.animation_delay + '" extra_class_name="' + addClassName + '"]' +  props.attributes.parallax_text + '[/clapat_parallax_image]';

		},
	} );
	
	/** Popup Image **/
	blocks.registerBlockType( 'harington-gutenberg/popup-image', {
		title: __( 'Harington: Popup Image', 'harington-gutenberg' ),
		icon: 'format-image',
		category: 'harington-block-category',
		
		attributes: {
			thumb_image: {
				type: 'string',
				default: ''
			},
			thumb_image_id: {
				type: 'number',
			},
			full_image: {
				type: 'string',
				default: ''
			},
			full_image_id: {
				type: 'number',
			},
			animation_type: {
				type: 'string',
				default: 'none'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
			parallax: {
				type: 'string',
				default: 'no'
			},
			parallax_start: {
				type: 'string',
				default: '0.0'
			},
			parallax_end: {
				type: 'string',
				default: '0.0'
			},
		},

		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'popup', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			var onSelectThumbnailImage = function( media ) {
				return props.setAttributes( {
					thumb_image: media.url,
					thumb_image_id: media.id,
				} );
			};
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					full_image: media.url,
					full_image_id: media.id,
				} );
			};
				
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-popup-image is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-format-image' } ),
						),
						__('Harington Popup Image', 'harington-gutenberg' ) ),
				
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectThumbnailImage,
							type: 'image',
							value: props.attributes.thumb_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.thumb_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.thumb_image_id ? i18n.__( 'Upload Popup Thumbnail Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.thumb_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Thumbnail Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.full_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.full_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.thumb_image_id ? i18n.__( 'Upload Popup Full Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.full_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Full Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
					
						el( 'div', { className: 'components-panel__body is-opened' }, 
							el( SelectControl, {
								label: __('Animation Type', 'harington-gutenberg'),
								value: props.attributes.animation_type,
								options: [
									{ label: 'None', value: 'none' },
									{ label: 'Cover', value: 'cover' },
									{ label: 'Fade', value: 'fade' }
								],
								onChange: ( value ) => { props.setAttributes( { animation_type: value } ); },
							} ),
						
							el( 'div', { className : 'clapat-range-control' }, 
								el( RangeControl, {
									label: __('Animation delay',  'harington-gutenberg'),
									value: props.attributes.animation_delay,
									onChange: ( value ) => { 
										if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
									} ) ),
							
							el( SelectControl, {
								label: __('Has Parallax', 'harington-gutenberg'),
								value: props.attributes.parallax,
								options: [
									{ label: 'Yes', value: 'yes' },
									{ label: 'No', value: 'no' }
								],
								onChange: ( value ) => { props.setAttributes( { parallax: value } ); },
							} ),
							
							el( TextControl, {
								label: __('Start Parallax. A value between 0 and 1 representing the top parallax translation.', 'harington-gutenberg'),
								type: "text",
								value: props.attributes.parallax_start,
								onChange: ( value ) => { props.setAttributes( { parallax_start: value } ); },
							} ),
							
							el( TextControl, {
								label: __('End Parallax. A value between 0 and 1 representing the bottom parallax translation.', 'harington-gutenberg'),
								type: "text",
								value: props.attributes.parallax_end,
								onChange: ( value ) => { props.setAttributes( { parallax_end: value } ); },
							} ),
							
						),
						
					),
					
				),
				
			];
		},

		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[clapat_popup_image img_url="' + props.attributes.full_image + '" img_id="' + props.attributes.full_image_id + '" thumb_url="' + props.attributes.thumb_image + '" thumb_id="' + props.attributes.thumb_image_id + '" animation="' + props.attributes.animation_type + '" animation_delay="' + props.attributes.animation_delay + '" parallax="' + props.attributes.parallax + '" start_parallax="' + props.attributes.parallax_start + '" end_parallax="' + props.attributes.parallax_end + '" extra_class_name="' + addClassName + '"][/clapat_popup_image]'; 

		},
	} );
	
	/** Popup Video **/
	blocks.registerBlockType( 'harington-gutenberg/popup-video', {
		title: __( 'Harington: Popup Video', 'harington-gutenberg' ),
		icon: 'format-video',
		category: 'harington-block-category',
		
		attributes: {
			thumb_image: {
				type: 'string',
				default: ''
			},
			thumb_image_id: {
				type: 'number',
			},
			video_url: {
				type: 'string',
				default: ''
			},
			animation_type: {
				type: 'string',
				default: 'none'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},

		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'popup', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			var onSelectThumbnailImage = function( media ) {
				return props.setAttributes( {
					thumb_image: media.url,
					thumb_image_id: media.id,
				} );
			};
				
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-popup-video is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-format-image' } ),
						),
						__('Harington Popup Video', 'harington-gutenberg' ) ),
				
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectThumbnailImage,
							type: 'image',
							value: props.attributes.thumb_image_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.thumb_image_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.thumb_image_id ? i18n.__( 'Upload Video Thumbnail Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.thumb_image } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Thumbnail Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
					
						el( 'div', { className: 'components-panel__body is-opened' }, 
							el( TextControl, {
								label: __('Video URL (Youtube or Vimeo)', 'harington-gutenberg'),
								value: props.attributes.video_url,
								onChange: ( value ) => { props.setAttributes( { video_url: value } ); },
							} ),
						
							el( SelectControl, {
								label: __('Animation Type', 'harington-gutenberg'),
								value: props.attributes.animation_type,
								options: [
									{ label: 'None', value: 'none' },
									{ label: 'Cover', value: 'cover' },
									{ label: 'Fade', value: 'fade' }
								],
								onChange: ( value ) => { props.setAttributes( { animation_type: value } ); },
							} ),
							
							el( 'div', { className : 'clapat-range-control' }, 
								el( RangeControl, {
									label: __('Animation delay',  'harington-gutenberg'),
									value: props.attributes.animation_delay,
									onChange: ( value ) => { 
										if (typeof value === "undefined") return;
											props.setAttributes( { animation_delay: value } ); 
										},
										type: 'number',
										step: 50,
										min: 0,
										max: 1000
							} ) ),
						),
						
					),
					
				),
				
			];
		},

		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[clapat_popup_video video_url="' + props.attributes.video_url + '" thumb_url="' + props.attributes.thumb_image + '" thumb_id="' + props.attributes.thumb_image_id + '" animation="' + props.attributes.animation_type + '" animation_delay="' + props.attributes.animation_delay + '" extra_class_name="' + addClassName + '"][/clapat_popup_video]'; 

		},
	} );
	
	/** Team Members **/
	const template_clapat_team_members = [
	  [ 'harington-gutenberg/team-member', {} ], // [ blockName, attributes ]
	];

	blocks.registerBlockType( 'harington-gutenberg/team-members', {
		title: __( 'Harington: Team Members', 'harington-gutenberg' ),
		icon: 'businessman',
		category: 'harington-block-category',
		allowedBlocks: ['harington-gutenberg/team-member'],
	
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'team member', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-team-members is-large'},
							el( 'div', { className: 'components-placeholder__label' }, 
								el( 'span', { className: 'block-editor-block-icon has-colors' },
									el( 'span', { className: 'dashicon dashicons dashicons-businessman' } ),
								),
								__('Harington Team Members', 'harington-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['harington-gutenberg/team-member'], template: template_clapat_team_members } )
						);

		},

		save: function( props ) {
			
			let blockClasses = 'team-members-list';
			
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'ul', { className: blockClasses, 'data-fx': '1' }, InnerBlocks.Content() );
	
		},
	} );
	
	blocks.registerBlockType( 'harington-gutenberg/team-member', {
		title: __( 'Harington: Team Member', 'harington-gutenberg' ),
		icon: 'editor-quote',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/team-members' ],

		attributes: {
			img_url: {
				type: 'string',
				default: ''
			},
			img_id: {
				type: 'number',
			},
			name: {
				type: 'string',
				default: ''
			},
			position: {
				type: 'string',
				default: ''
			},
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					img_url: media.url,
					img_id: media.id,
				} );
			};
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.img_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.img_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.img_id ? i18n.__( 'Upload Team Member Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.img_url } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Team Member Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),
					
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Team Member Name:', 'harington-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.name,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { name: value } ); },
					}),
					
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Team Member Position:', 'harington-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.position,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { position: value } ); },
					}),
					
				),
				
			];
		},

		save: function( props ) {
			
			return '[team_member img_url="' + props.attributes.img_url + '" name="' + props.attributes.name + '" position="' + props.attributes.position + '"][/team_member]'; 

		},
	} );
	
	/** Team Members Carousel**/
	const template_clapat_team_members_carousel = [
	  [ 'harington-gutenberg/team-member-carousel', {} ], // [ blockName, attributes ]
	];

	blocks.registerBlockType( 'harington-gutenberg/team-members-carousel', {
		title: __( 'Harington: Team Members Carousel', 'harington-gutenberg' ),
		icon: 'businessman',
		category: 'harington-block-category',
		allowedBlocks: ['harington-gutenberg/team-member-carousel'],
	
		attributes: {
			cursor_type: {
				type: 'string',
				default: 'light-cursor'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},	
		},
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'team member carousel', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-team-members-carousel is-large'},
							el( 'div', { className: 'components-placeholder__label' }, 
								el( 'span', { className: 'block-editor-block-icon has-colors' },
									el( 'span', { className: 'dashicon dashicons dashicons-businessman' } ),
								),
								__('Harington Team Members Carousel', 'harington-gutenberg' ) ),
								
							el( InnerBlocks, {allowedBlocks: ['harington-gutenberg/team-member-carousel'], template: template_clapat_team_members_carousel } ),
							
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Cursor Type', 'harington-gutenberg'),
										value: props.attributes.cursor_type,
										options : [
											{ label: __('Light', 'harington-gutenberg'), value: 'light-cursor' },
											{ label: __('Dark',  'harington-gutenberg'), value: 'dark-cursor' },
										],
										onChange: ( value ) => { props.setAttributes( { cursor_type: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has animation', 'harington-gutenberg'),
										value: props.attributes.has_animation,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
									} ),
									el( 'div', { className : 'clapat-range-control' }, 
										el( RangeControl, {
											label: __('Animation delay',  'harington-gutenberg'),
											value: props.attributes.animation_delay,
											onChange: ( value ) => { 
												if (typeof value === "undefined") return;
												props.setAttributes( { animation_delay: value } ); 
											},
											type: 'number',
											step: 50,
											min: 0,
											max: 1000
										} ) ),
								),
							),
						);

		},

		save: function( props ) {
			
			let blockClasses = 'swiper-container team-looped-carousel autocenter';
			
			if( typeof props.attributes.cursor_type !== 'undefined' ) { blockClasses += ' ' + props.attributes.cursor_type; }
			if( props.attributes.has_animation !== 'no' ) { blockClasses += ' has-animation'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', 
							{ 
								className: blockClasses,
								'data-delay': props.attributes.animation_delay,
							},
							el( 'div',
								{
									className: 'swiper-wrapper',
								},
								InnerBlocks.Content() )
					);
			},
	} );
	
	blocks.registerBlockType( 'harington-gutenberg/team-member-carousel', {
		title: __( 'Harington: Team Member Carousel', 'harington-gutenberg' ),
		icon: 'editor-quote',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/team-members-carousel' ],

		attributes: {
			img_url: {
				type: 'string',
				default: ''
			},
			img_id: {
				type: 'number',
			},
			name: {
				type: 'string',
				default: ''
			},
			position: {
				type: 'string',
				default: ''
			},
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					img_url: media.url,
					img_id: media.id,
				} );
			};
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.img_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.img_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.img_id ? i18n.__( 'Upload Team Member Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.img_url } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Team Member Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),
					
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Team Member Name:', 'harington-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.name,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { name: value } ); },
					}),
					
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Team Member Position:', 'harington-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.position,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { position: value } ); },
					}),
					
				),
				
			];
		},

		save: function( props ) {
			
			return '[team_member_carousel img_url="' + props.attributes.img_url + '" name="' + props.attributes.name + '" position="' + props.attributes.position + '"][/team_member_carousel]'; 

		},
	} );
	
	/** Team Members Scrolling Panels**/
	const template_clapat_team_members_scrolling_panels = [
	  [ 'harington-gutenberg/team-member-scrolling-panel', {} ], // [ blockName, attributes ]
	];

	blocks.registerBlockType( 'harington-gutenberg/team-members-scrolling-panels', {
		title: __( 'Harington: Team Members In Scrolling Panels', 'harington-gutenberg' ),
		icon: 'businessman',
		category: 'harington-block-category',
		allowedBlocks: ['harington-gutenberg/team-member-scrolling-panel'],
	
		attributes: {},
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'team member scrolling panel', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-team-members-carousel is-large'},
							el( 'div', { className: 'components-placeholder__label' }, 
								el( 'span', { className: 'block-editor-block-icon has-colors' },
									el( 'span', { className: 'dashicon dashicons dashicons-businessman' } ),
								),
								__('Harington Team Members In Scrolling Panels', 'harington-gutenberg' ) ),
								
							el( InnerBlocks, {allowedBlocks: ['harington-gutenberg/team-member-scrolling-panel'], template: template_clapat_team_members_scrolling_panels } ),
							
						);

		},

		save: function( props ) {
			
			let blockClasses = 'panels';
			
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', 
							{
								id: 'team-panels',
								className: blockClasses
							},
							el( 'div',
								{
									className: 'panels-container',
								},
								InnerBlocks.Content() )
					);
			},
	} );
	
	blocks.registerBlockType( 'harington-gutenberg/team-member-scrolling-panel', {
		title: __( 'Harington: Team Member Scrolling Panel', 'harington-gutenberg' ),
		icon: 'editor-quote',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/team-members-scrolling-panels' ],

		attributes: {
			img_url: {
				type: 'string',
				default: ''
			},
			img_id: {
				type: 'number',
			},
			name: {
				type: 'string',
				default: ''
			},
			position: {
				type: 'string',
				default: ''
			},
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					img_url: media.url,
					img_id: media.id,
				} );
			};
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.img_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.img_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.img_id ? i18n.__( 'Upload Team Member Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.img_url } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Team Member Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),
					
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Team Member Name:', 'harington-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.name,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { name: value } ); },
					}),
					
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Team Member Position:', 'harington-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.position,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { position: value } ); },
					}),
					
				),
				
			];
		},

		save: function( props ) {
			
			return '[team_member_scrolling_panel img_url="' + props.attributes.img_url + '" name="' + props.attributes.name + '" position="' + props.attributes.position + '"][/team_member_scrolling_panel]';

		},
	} );
	
	/** Clients **/
	const template_clapat_clients = [
	  [ 'harington-gutenberg/client', {} ], // [ blockName, attributes ]
	];

	blocks.registerBlockType( 'harington-gutenberg/clients', {
		title: __( 'Harington: Clients', 'harington-gutenberg' ),
		icon: 'businessman',
		category: 'harington-block-category',
		allowedBlocks: ['harington-gutenberg/client'],
		attributes: {
			has_borders: {
				type: 'string',
				default: 'yes'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			animation_delay: {
				type: 'number',
				default: 0
			},
		},
	
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'client', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return	el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-clients is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-businessman' } ),
									),
									__('Harington Clients', 'harington-gutenberg' ) ),
							el( InnerBlocks, {allowedBlocks: ['harington-gutenberg/client'], template: template_clapat_clients } ),
							
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( SelectControl, {
										label: __('Table has borders', 'harington-gutenberg'),
										value: props.attributes.has_borders,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_borders: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has animation', 'harington-gutenberg'),
										value: props.attributes.has_animation,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
									} ),
									el( 'div', { className : 'clapat-range-control' }, 
										el( RangeControl, {
											label: __('Animation delay',  'harington-gutenberg'),
											value: props.attributes.animation_delay,
											onChange: ( value ) => { 
												if (typeof value === "undefined") return;
												props.setAttributes( { animation_delay: value } ); 
											},
											type: 'number',
											step: 50,
											min: 0,
											max: 1000
										} ) ),
								),
							),
						);

		},

		save: function( props ) {
			
			let blockClasses = 'clients-table';
			
			if( props.attributes.has_borders !== 'yes' ) { blockClasses += ' no-borders'; }
			if( props.attributes.has_animation !== 'no' ) { blockClasses += ' has-animation'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'ul', 
							{ 
								className: blockClasses,
								'data-delay': props.attributes.animation_delay,
							}, InnerBlocks.Content() );
		},
	} );
	
	blocks.registerBlockType( 'harington-gutenberg/client', {
		title: __( 'Harington: Client', 'harington-gutenberg' ),
		icon: 'editor-quote',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/clients' ],

		attributes: {
			img_url: {
				type: 'string',
				default: ''
			},
			img_id: {
				type: 'number',
			},
			client_url: {
				type: 'string',
				default: ''
			},
		},

		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					img_url: media.url,
					img_id: media.id,
				} );
			};
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper'},  
					
					el( 'div', { className: 'clapat-editor-image' },
						el( MediaUpload, {
							onSelect: onSelectImage,
							type: 'image',
							value: props.attributes.img_id,
							render: function( obj ) {
								return el( components.Button, {
										className: props.attributes.img_id ? 'clapat-image-added' : 'button button-large',
										onClick: obj.open
									},
									! props.attributes.img_id ? i18n.__( 'Upload Client Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.img_url } ),
									el ('div', { className: 'components-placeholder__instructions' }, __( 'Client Image', 'harington-gutenberg' ) )
								);
							}
						} )
					),
					
					el ('div', { className: 'components-placeholder__instructions' }, __( 'Client URL', 'harington-gutenberg' ) ),
						
					el( PlainText,
					{
						value: props.attributes.client_url,
						className: 'clapat-inline-content',
						onChange: ( value ) => { props.setAttributes( { client_url: value } ); },
					}),
					
				),
				
			];
		},

		save: function( props ) {
			
			return '[client_item img_url="' + props.attributes.img_url + '" client_url="' + props.attributes.client_url + '"][/client_item]'; 

		},
	} );
	
	/** Pinned Section **/
	const PINNED_SECTION_ALLOWED_BLOCKS = [ 'harington-gutenberg/scrolling-element', 'harington-gutenberg/pinned-element' ]
	
	const RIGHT_PINNED_SECTION_TEMPLATE = [
				[ 'harington-gutenberg/scrolling-element', { className:'left' } ],
				[ 'harington-gutenberg/pinned-element', { className:'right' } ]
			];

	blocks.registerBlockType( 'harington-gutenberg/right-pinned-section', {
		title: __( 'Harington: Right Pinned Section', 'harington-gutenberg' ),
		icon: 'image-rotate-right',
		category: 'harington-block-category',
		
		attributes: {},

		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'right pinned text', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-right-pinned-section is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-image-rotate-right' } ),
						),
						__('Harington Right Pinned Section', 'harington-gutenberg' ) ),
					
					el( InnerBlocks,
						{
							template: RIGHT_PINNED_SECTION_TEMPLATE,
							templateLock: 'all',
							allowedBlocks: PINNED_SECTION_ALLOWED_BLOCKS,
							orientation: 'horizontal'
						} ),
				),
				
			];
		},

		save: function( props ) {
			
			let blockClasses = 'pinned-section';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses	}, InnerBlocks.Content() );

		},
		
	} );
	
	const LEFT_PINNED_SECTION_TEMPLATE = [
				[ 'harington-gutenberg/pinned-element', { className:'left' } ],
				[ 'harington-gutenberg/scrolling-element', { className:'right' } ]
			];

	blocks.registerBlockType( 'harington-gutenberg/left-pinned-section', {
		title: __( 'Harington: Left Pinned Section', 'harington-gutenberg' ),
		icon: 'image-rotate-left',
		category: 'harington-block-category',
		
		attributes: {},

		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'left pinned text', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-left-pinned-section is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-image-rotate-right' } ),
						),
						__('Harington Left Pinned Section', 'harington-gutenberg' ) ),
					
					el( InnerBlocks,
						{
							template: LEFT_PINNED_SECTION_TEMPLATE,
							templateLock: 'all',
							allowedBlocks: PINNED_SECTION_ALLOWED_BLOCKS,
							orientation: 'horizontal'
						} ),
					
				),
				
			];
		},

		save: function( props ) {
			
			let blockClasses = 'pinned-section';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', {	className: blockClasses	}, InnerBlocks.Content() );

		},
		
	} );
	
	const PINNED_ELEMENT_TEMPLATE = [
				[ 'core/html', {} ],
			];
	blocks.registerBlockType( 'harington-gutenberg/pinned-element', {
		title: __( 'Harington: Pinned Element', 'harington-gutenberg' ),
		icon: 'format-image',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/right-pinned-section', 'harington-gutenberg/left-pinned-section' ],

		attributes: { },

		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-pinned-content is-large'},
							el( 'div', { className: 'components-placeholder__instructions' }, __('Pinned Content', 'harington-gutenberg' ) ),
							el( InnerBlocks, {
								template: PINNED_ELEMENT_TEMPLATE,
								templateLock: "all",
							} ),
				
				),
				
			];
		},

		save: function( props ) {
			let blockClasses = 'pinned-element';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, InnerBlocks.Content() );
	
		},
	} );
	
	const SCROLLING_ELEMENT_TEMPLATE = [
				[ 'core/html', {} ],
			];
	blocks.registerBlockType( 'harington-gutenberg/scrolling-element', {
		title: __( 'Harington: Scrolling Element', 'harington-gutenberg' ),
		icon: 'format-image',
		category: 'harington-block-category',
		parent: [ 'harington-gutenberg/right-pinned-section', 'harington-gutenberg/left-pinned-section' ],

		attributes: { },

		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-pinned-content is-large'},
							el( 'div', { className: 'components-placeholder__instructions' }, __('Scrolling Content', 'harington-gutenberg' ) ),
							el( InnerBlocks, {
								template: SCROLLING_ELEMENT_TEMPLATE,
								templateLock: "all",
							} ),
				
				),
				
			];
		},

		save: function( props ) {
			let blockClasses = 'scrolling-element';
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', { className: blockClasses }, InnerBlocks.Content() );
	
		},
	} );
	
	/** Portfolio Grid **/
	blocks.registerBlockType( 'harington-gutenberg/portfolio-grid', {
		title: __( 'Harington: Portfolio Grid', 'harington-gutenberg' ),
		icon: 'grid-view',
		category: 'harington-block-category',
		
		attributes: {
			items_no: {
				type: 'string',
				default: ''
			},
			filter_category: {
				type: 'string',
				default: ''
			},
			thumbs_effect: {
				type: 'string',
				default: 'webgl-fitthumbs'
			},
			thumbs_effect_webgl: {
				type: 'string',
				default: 'fx-one'
			},			
		},

		keywords: [ __( 'harington', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'portfolio', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-portfolio-grid is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-grid-view' } ),
						),
						__('Harington Portfolio Grid', 'harington-gutenberg' ) ),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
						el( 'div', { className: 'components-panel__body is-opened' },
						
							el( TextControl, {
								label: __('Number of portfolio items. Maximum of 4 items can be included. First 4 if you leave it empty.', 'harington-gutenberg'),
								type: "text",
								value: props.attributes.items_no,
								onChange: ( value ) => { props.setAttributes( { items_no: value } ); },
							} ),
							
							el( TextControl, {
								label: __('Category filter. Add one or more portfolio categories separated by comma. First 4 if you leave it empty.', 'harington-gutenberg'),
								type: "text",
								value: props.attributes.filter_category,
								onChange: ( value ) => { props.setAttributes( { filter_category: value } ); },
							} ),
														
							el( SelectControl, {
								label: __('Thumbs effect', 'harington-gutenberg'),
								value: props.attributes.thumbs_effect,
								options: [
									{ label: 'WebGL Animation', value: 'webgl-fitthumbs' },
									{ label: 'GSAP Animation', value: 'scale-fitthumbs' },
									{ label: 'None', value: 'no-fitthumbs' }
								],
								onChange: ( value ) => { props.setAttributes( { thumbs_effect: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('WebGL Animation Type', 'harington-gutenberg'),
								value: props.attributes.thumbs_effect_webgl,
								options: [
									{ label: 'FX One', value: 'fx-one' },
									{ label: 'FX Two', value: 'fx-two' },
									{ label: 'FX Three', value: 'fx-three' },
									{ label: 'FX Four', value: 'fx-four' },
									{ label: 'FX Five', value: 'fx-five' },
									{ label: 'FX Siz', value: 'fx-six' }
								],
								onChange: ( value ) => { props.setAttributes( { thumbs_effect_webgl: value } ); },
							} ),
							
						),
					),

				),
				
			];
		},

		save: function( props ) {
			
			return '[harington_portfolio_grid items_no="' + props.attributes.items_no + '" filter_category="' + props.attributes.filter_category + '" thumbs_effect="' + props.attributes.thumbs_effect + '" thumbs_effect_webgl="' + props.attributes.thumbs_effect_webgl + '" extra_class_name=""][/harington_portfolio_grid]';

		},
	} );
	
	/** Portfolio List **/
	blocks.registerBlockType( 'harington-gutenberg/portfolio-list', {
		title: __( 'Harington: Portfolio List', 'harington-gutenberg' ),
		icon: 'list-view',
		category: 'harington-block-category',
		
		attributes: {
			filter_category: {
				type: 'string',
				default: ''
			},
			thumbs_effect: {
				type: 'string',
				default: 'webgl-fitthumbs'
			},
			thumbs_effect_webgl: {
				type: 'string',
				default: 'fx-one'
			},			
		},

		keywords: [ __( 'harington', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'portfolio', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-portfolio-list is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-grid-view' } ),
						),
						__('Harington Portfolio List', 'harington-gutenberg' ) ),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
						el( 'div', { className: 'components-panel__body is-opened' },
						
							el( TextControl, {
								label: __('Category filter. Add one or more portfolio categories separated by comma. All if you leave it empty.', 'harington-gutenberg'),
								type: "text",
								value: props.attributes.filter_category,
								onChange: ( value ) => { props.setAttributes( { filter_category: value } ); },
							} ),
														
							el( SelectControl, {
								label: __('Thumbs effect', 'harington-gutenberg'),
								value: props.attributes.thumbs_effect,
								options: [
									{ label: 'WebGL Animation', value: 'webgl-fitthumbs' },
									{ label: 'GSAP Animation', value: 'scale-fitthumbs' },
									{ label: 'None', value: 'no-fitthumbs' }
								],
								onChange: ( value ) => { props.setAttributes( { thumbs_effect: value } ); },
							} ),
							
							el( SelectControl, {
								label: __('WebGL Animation Type', 'harington-gutenberg'),
								value: props.attributes.thumbs_effect_webgl,
								options: [
									{ label: 'FX One', value: 'fx-one' },
									{ label: 'FX Two', value: 'fx-two' },
									{ label: 'FX Three', value: 'fx-three' },
									{ label: 'FX Four', value: 'fx-four' },
									{ label: 'FX Five', value: 'fx-five' },
									{ label: 'FX Siz', value: 'fx-six' }
								],
								onChange: ( value ) => { props.setAttributes( { thumbs_effect_webgl: value } ); },
							} ),
							
						),
					),

				),
				
			];
		},

		save: function( props ) {
			
			return '[harington_portfolio_list filter_category="' + props.attributes.filter_category + '" thumbs_effect="' + props.attributes.thumbs_effect + '" thumbs_effect_webgl="' + props.attributes.thumbs_effect_webgl + '" extra_class_name=""][/harington_portfolio_list]';

		},
	} );
	
	/** News Carousel **/
	blocks.registerBlockType( 'harington-gutenberg/news-carousel', {
		title: __( 'Harington: News', 'harington-gutenberg' ),
		icon: 'grid-view',
		category: 'harington-block-category',
		
		attributes: {
			items_no: {
				type: 'string',
				default: '3'
			},
			filter_category: {
				type: 'string',
				default: ''
			}
		},

		keywords: [ __( 'harington', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'news', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
			
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-news is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-grid-view' } ),
						),
						__('Harington News List', 'harington-gutenberg' ) ),
					
					/*
					 * InspectorControls lets you add controls to the Block sidebar.
					 */
					el( InspectorControls, {},
						el( 'div', { className: 'components-panel__body is-opened' },
						
							el( TextControl, {
								label: __('Number of post items. Leave empty for ALL.', 'harington-gutenberg'),
								type: "text",
								value: props.attributes.items_no,
								onChange: ( value ) => { props.setAttributes( { items_no: value } ); },
							} ),
							
							el( TextControl, {
								label: __('Category filter. Add one or more blog categories separated by comma. Leave empty for ALL.', 'harington-gutenberg'),
								type: "text",
								value: props.attributes.filter_category,
								onChange: ( value ) => { props.setAttributes( { filter_category: value } ); },
							} )
							
						),
					),

				),
				
			];
		},

		save: function( props ) {
			
			return '[harington_news items_no="' + props.attributes.items_no + '" filter_category="' + props.attributes.filter_category + '" extra_class_name=""][/harington_news]';

		},
	} );
	
	/** Hosted Video **/
	blocks.registerBlockType( 'harington-gutenberg/video-hosted', {
		title: __( 'Harington: Hosted Video', 'harington-gutenberg' ),
		icon: 'video-alt',
		category: 'harington-block-category',
		attributes: {
			cover_image: {
				type: 'string',
				default: ''
			},
			cover_image_id: {
				type: 'number',
			},
			webm_url: {
				type: 'string',
				default: 'http://'
			},
			mp4_url: {
				type: 'string',
				default: 'http://'
			},
			
		},
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'video', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			var onSelectImage = function( media ) {
				return props.setAttributes( {
					cover_image: media.url,
					cover_image_id: media.id,
				} );
			};
			
			return [
				
				 el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-hosted-video is-large'},
				
					el( 'div', { className: 'components-placeholder__label' }, 
						el( 'span', { className: 'block-editor-block-icon has-colors' },
							el( 'span', { className: 'dashicon dashicons dashicons-format-image' } ),
						),
						__('Harington Hosted Video', 'harington-gutenberg' ) ),
						
						el( 'div', { className: 'clapat-editor-image' },
							el( MediaUpload, {
								onSelect: onSelectImage,
								type: 'image',
								value: props.attributes.cover_image_id,
								render: function( obj ) {
									return el( components.Button, {
											className: props.attributes.cover_image_id ? 'clapat-image-added' : 'button button-large',
											onClick: obj.open
										},
										! props.attributes.cover_image_id ? i18n.__( 'Upload Video Cover Image', 'harington-gutenberg' ) : el( 'img', { src: props.attributes.cover_image } ),
										el ('div', { className: 'components-placeholder__instructions' }, __( 'Cover Image', 'harington-gutenberg' ) )
									);
								}
							} ),
						),
						
						el ('div', { className: 'components-placeholder__instructions' }, __( 'MP4 video url:', 'harington-gutenberg' ) ),
						
						el( PlainText,
						{
							value: props.attributes.mp4_url,
							className: 'clapat-inline-content',
							onChange: ( value ) => { props.setAttributes( { mp4_url: value } ); },
						}),
						
						el ('div', { className: 'components-placeholder__instructions' }, __( 'Webm video url:', 'harington-gutenberg' ) ),
						
						el( PlainText,
						{
							value: props.attributes.webm_url,
							className: 'clapat-inline-content',
							onChange: ( value ) => { props.setAttributes( { webm_url: value } ); },
						}),
					)
			]
		},
		save: function( props ) {
			
			let addClassName = '';
			if( (typeof props.attributes.className !== 'undefined') && (props.attributes.className != null) ){
				
				addClassName = props.attributes.className;
			}
			return '[clapat_video cover_img_url="' + props.attributes.cover_image + '" mp4_url="' + props.attributes.mp4_url + '" webm_url="' + props.attributes.webm_url + '" extra_class_name="' + addClassName + '"][/clapat_video]';
		},
	} );
	

	/** Google Map **/
	blocks.registerBlockType( 'harington-gutenberg/google-map', {
		title: __( 'Harington: Google Map', 'harington-gutenberg' ),
		icon: 'admin-site',
		category: 'harington-block-category',
		attributes: {	},
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ),  __( 'map', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			return [
				
				el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-google-map is-large'},
								el( 'div', { className: 'components-placeholder__label' }, 
									el( 'span', { className: 'block-editor-block-icon has-colors' },
										el( 'span', { className: 'dashicon dashicons dashicons-admin-site' } ),
									),
									__('Harington Google Map', 'harington-gutenberg' ) ),
								el( 'span', { className: 'clapat-inline-caption' }, __( 'Set google map properties in customizer - map settings.', 'harington-gutenberg' ) ),
				)
						
			]
		},
		save: function( props ) {
			
			return '[clapat_map][/clapat_map]'; 
		},
	} );
	
	/** Container **/
	blocks.registerBlockType( 'harington-gutenberg/container', {
		title: __( 'Harington: Container', 'harington-gutenberg' ),
		icon: 'analytics',
		category: 'harington-block-category',
		attributes: {
			background_color: {
				type: 'string',
				default: '#ffffff'
			},
			type: {
				type: 'string',
				default: 'light-section'
			},
			width: {
				type: 'string',
				default: 'normal'
			},
			padding_top: {
				type: 'string',
				default: 'no'
			},
			padding_bottom: {
				type: 'string',
				default: 'no'
			},
			padding_left: {
				type: 'string',
				default: 'no'
			},
			padding_right: {
				type: 'string',
				default: 'no'
			},
			change_header_color: {
				type: 'string',
				default: 'no'
			},
			has_animation: {
				type: 'string',
				default: 'no'
			},
			alignment: {
				type: 'string',
				default: 'left'
			},
		}, 
		
		keywords: [ __( 'clapat', 'harington-gutenberg'), __( 'shortcode', 'harington-gutenberg' ), __( 'container', 'harington-gutenberg' ) ],
		
		edit: function( props ) {
			
			const colors = [ 
				{ name: 'Default', color: '#ffffff' }, 
				{ name: 'Light Grey', color: '#eeeeee' }, 
				{ name: 'Dark Grey', color: '#171717' }, 
				{ name: 'Black', color: '#000000' },
			];
			
			function onChangeAlignment( newAlignment ) {
				props.setAttributes( { alignment: newAlignment === undefined ? 'none' : newAlignment } );
			}
			
			return	[ el( BlockControls,
							{ key: 'controls' },
							el(
								AlignmentToolbar,
								{
									value: props.attributes.alignment,
									onChange: onChangeAlignment,
								}
							)
						),
						el( 'div', { className: 'clapat-editor-block-wrapper clapat-editor-container is-large'},
							el( 'div', { className: 'components-placeholder__label' }, 
								el( 'span', { className: 'block-editor-block-icon has-colors' },
									el( 'span', { className: 'dashicon dashicons dashicons-analytics' } ),
								),
								__('Harington Container', 'harington-gutenberg' ) ),
							el( InnerBlocks, {} ),
							/*
							 * InspectorControls lets you add controls to the Block sidebar.
							 */
							el( InspectorControls, {},
								el( 'div', { className: 'components-panel__body is-opened' }, 
									el( 'strong', {}, __('Select Background Color:',  'harington-gutenberg') ),
									el( 'div', { className : 'clapat-color-palette' },
										el( ColorPaletteControl, {
											colors: colors,
											value: props.attributes.background_color,
											onChange: ( value ) => { 
												props.setAttributes( { background_color: value === undefined ? 'transparent' : value } ); 
											},
										} )
									),
									el( SelectControl, {
										label: __('Type', 'harington-gutenberg'),
										value: props.attributes.type,
										options : [
											{ label: __('Light', 'harington-gutenberg'), value: 'light-section' },
											{ label: __('Dark',  'harington-gutenberg'), value: 'dark-section' },
										],
										onChange: ( value ) => { props.setAttributes( { type: value } ); },
									} ),
									el( SelectControl, {
										label: __('Invert header color', 'harington-gutenberg'),
										desc: __('Inverts header color depending on Type: light or dark', 'harington-gutenberg'),
										value: props.attributes.change_header_color,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { change_header_color: value } ); },
									} ),
									el( SelectControl, {
										label: __('Width', 'harington-gutenberg'),
										value: props.attributes.width,
										options : [
											{ label: __('Normal', 'harington-gutenberg'), value: 'normal' },
											{ label: __('Small',  'harington-gutenberg'), value: 'small' },
											{ label: __('Full',  'harington-gutenberg'), value: 'full' },
										],
										onChange: ( value ) => { props.setAttributes( { width: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has top padding', 'harington-gutenberg'),
										value: props.attributes.padding_top,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { padding_top: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has bottom padding', 'harington-gutenberg'),
										value: props.attributes.padding_bottom,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { padding_bottom: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has left padding', 'harington-gutenberg'),
										value: props.attributes.padding_left,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { padding_left: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has right padding', 'harington-gutenberg'),
										value: props.attributes.padding_right,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { padding_right: value } ); },
									} ),
									el( SelectControl, {
										label: __('Has animation', 'harington-gutenberg'),
										value: props.attributes.has_animation,
										options : [
											{ label: __('Yes', 'harington-gutenberg'), value: 'yes' },
											{ label: __('No',  'harington-gutenberg'), value: 'no' },
										],
										onChange: ( value ) => { props.setAttributes( { has_animation: value } ); },
									} ),
								),
							),
						)	
					];
		},

		save: function( props ) {
			let blockClasses = 'content-row';
			blockClasses += ' ' + props.attributes.type;
			blockClasses += ' ' + props.attributes.width;
			if( props.attributes.padding_top !== 'no' ) { blockClasses += ' row_padding_top'; }
			if( props.attributes.padding_bottom !== 'no' ) { blockClasses += ' row_padding_bottom'; }
			if( props.attributes.padding_left !== 'no' ) { blockClasses += ' row_padding_left'; }
			if( props.attributes.padding_right !== 'no' ) { blockClasses += ' row_padding_right'; }
			if( props.attributes.change_header_color !== 'no' ) { blockClasses += ' change-header-color'; }
			if( props.attributes.has_animation !== 'no' ) { blockClasses += ' has-animation'; }
			if( props.className != null ) { blockClasses += ' ' + props.className; }
			
			return el( 'div', 
							{ 
								className: blockClasses,
								'data-bgcolor': props.attributes.background_color,
								style : {
									'text-align': props.attributes.alignment
								}
							}, InnerBlocks.Content() );
	
		},
	} );
	
}(
	window.wp.blocks,
	window.wp.blockEditor,
	window.wp.i18n,
	window.wp.element,
	window.wp.components
) );

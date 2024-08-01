(function() {
    tinymce.create('tinymce.plugins.HaringtonCoreShortcodes', {
        init : function(ed, url) {
            ed.addButton('clapat_shortcode_button', {
				type: 'menubutton',
				text: 'C',
				title: 'Insert Harington Shortcode',
                icon: false,
				
				menu: [
				
					// Typo Elements
					{
						text: 'Typo Elements',
						menu: [
						
							{
								text: 'Title',
								onclick: function () {
									tb_show("Add Title", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=title&width=700&height=600');
								}
							},
														
							{
								text: 'Breaking Line',
								onclick: function () {
									ed.insertContent('[br]');
								}
							},
														
							{
								text: 'Buttons',
								onclick: function () {
									tb_show("Add Button", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=button&width=700&height=600');
								}
							},
														
							{
								text: 'Space Between Buttons',
								onclick: function () {
									ed.insertContent('[space_between_buttons]');
								}
							},
							
							{
								text: 'Marquee Content',
								onclick: function () {
									tb_show("Add Marquee Content", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=marquee_content&width=700&height=600');
								}
							},
							
							{
								text: 'Text Link',
								onclick: function () {
									tb_show("Add Text Link", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=text_link&width=700&height=600');
								}
							},
							
							
						]
					},
					
					// Columns
					{
						text: 'Columns',
                        
						menu: [
						
							{
								text: 'One Half',
								onclick: function () {
									tb_show("Add One Half Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=one_half&width=400&height=500');
								}
							},
							
							{
								text: 'One Third',
								onclick: function () {
									tb_show("Add One Third Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=one_third&width=400&height=500');
								}
							},
							
							{
								text: 'One Fourth',
								onclick: function () {
									tb_show("Add One Fourth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=one_fourth&width=400&height=500');
								}
							},
							
							{
								text: 'One Fifth',
								onclick: function () {
									tb_show("Add One Fifth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=one_fifth&width=400&height=500');
								}
							},
							
							{
								text: 'One Sixth',
								onclick: function () {
									tb_show("Add One Sixth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=one_sixth&width=400&height=500');
								}
							},

							{
								text: 'Two Third',
								onclick: function () {
									tb_show("Add Two Third Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=two_third&width=400&height=500');
								}
							},

							{
								text: 'Two Fifth',
								onclick: function () {
									tb_show("Add Two Fifth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=two_fifth&width=400&height=500');
								}
							},

							{
								text: 'Three Fourth',
								onclick: function () {
									tb_show("Add Three Fourth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=three_fourth&width=400&height=500');
								}
							},

							{
								text: 'Three Fifth',
								onclick: function () {
									tb_show("Add Three Fifth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=three_fifth&width=400&height=500');
								}
							},

							{
								text: 'Four Fifth',
								onclick: function () {
									tb_show("Add Four Fifth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=four_fifth&width=400&height=500');
								}
							},

							{
								text: 'Five Sixth',
								onclick: function () {
									tb_show("Add Five Sixth Column", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=five_sixth&width=400&height=500');
								}
							}
							
						]
					},
					
					// Elements
					{
						text: 'Elements',
                        menu: [
							 
							{
								text: 'Accordions',
								onclick: function () {
										tb_show("Add Accordion", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=accordion&width=700&height=600');
								}
							},
							
							{
								text: 'Icon Box',
								onclick: function () {
									tb_show("Add Icon Box", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=icon_box&width=400&height=500');
								}
							},
							
							{
								text: 'Clients',
								onclick: function () {
									tb_show("Add Clients List", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=clients&width=700&height=600');
								}
							},
							
							{
								text: 'Popup Image',
								onclick: function () {
									tb_show("Add Popup Image", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=clapat_popup_image&width=400&height=500');
								}
							},
							
							{
								text: 'Captioned Image',
								onclick: function () {
									tb_show("Add Captioned Image", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=clapat_captioned_image&width=400&height=500');
								}
							},
							
							{
								text: 'Map',
								onclick: function () {
									ed.insertContent('[clapat_map]');
								}
							},
							
							{
								text: 'Collage',
								onclick: function () {
									tb_show("Add Collage", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=clapat_collage&width=400&height=500');
								}
							},
							
							{
								text: 'Video Hosted',
								onclick: function () {
									tb_show("Add hosted video", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=clapat_video&width=400&height=500');
								}
							},
							
							{
								text: 'Team Members',
								onclick: function () {
									tb_show("Add Team Members List", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=team_members&width=700&height=600');
								}
							},
						]
					},
					
					{
						text: 'Sliders',
                        menu: [
						
							{
								text: 'General Slider',
								onclick: function () {
									tb_show("Add Image General Slider", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=general_slider&width=700&height=600');
								}
							},
							
							{
								text: 'Carousel Slider',
								onclick: function () {
									tb_show("Add Image Carousel Slider", ShortcodeAttributes.shortcode_folder + '/shortcodes_popup.php?&sc=carousel_slider&width=700&height=600');
								}
							},
														
						]
					}
					
				]
            });
             
        },
        
		getInfo: function () {
            return {
        
				longname: 'Harington Shortcodes',
                author: 'Harington Studio',
                authorurl: 'http://themeforest.net/user/clapat/',
                infourl: 'http://clapat-themes.com/wordpress/harington/',
                version: "1.0"
            }
        }
    });
    // Register plugin
    tinymce.PluginManager.add( 'HaringtonCoreShortcodes', tinymce.plugins.HaringtonCoreShortcodes );
})();
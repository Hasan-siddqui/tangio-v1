<?php

namespace Harington\Core\Metaboxes;

/**
 * Class for creating custom meta boxes in WordPress. 
 * 
 */
	if( !class_exists( "Harington\Core\Metaboxes\Meta_Boxes" ) ){
		
		class Meta_Boxes {
			
			protected static $MetaBoxes = array();
			protected static $MetaBoxFields = array();
			protected static $MetaBoxDefinitions = array();

			
			/**
			 * Registers metaboxes with WordPress based on metabox definitions passed by register_metabox_definitions method
			 *
			 * @param $post id
			 * @param $meta_key
			 */
			public static function register_metaboxes( $post_type, $post ) {
				
				foreach( self::$MetaBoxDefinitions as $metabox_setting ){
					
					foreach( $metabox_setting['post_types'] as $mb_post_type ){
						
						if( $mb_post_type == $post_type ){
							
							add_meta_box(
								$metabox_setting['id'],   							// HTML slug for box id
								$metabox_setting['title'], 							// Visible title
								array( __CLASS__, 'build_metabox' ), 	// Magic callback. Used to render the meta box HTML
								$post_type,            									// The slug of the post type you want to add this meta box to.
								$metabox_setting['position'],            		// Context. Where on the screen should this show up? Options: 'normal', 'advanced', or 'side'
								$metabox_setting['priority']              		// Priority. Options: 'high', 'core', 'default' or 'low'
							);
						}
					}
				}

			}
			
			/**
			 * Retrieves the value of a certain metabox field
			 *
			 * @param $post id
			 * @param $meta_key
			 */
			public static function get_metabox_value( $post_id, $meta_key ) {
				
				foreach ( self::$MetaBoxFields as $mb_key => $mb_fields ) {

					// Fetch all fields in current box
					foreach ( $mb_fields as $field_key => $field ) {

						if( $field_key == $meta_key ){
							
							return $field->get_field_value( $post_id );
						}
					}

				}
				
				return "";

			}
			
			/**
			 * Saves every registered setting/field
			 */
			public static function save_metaboxes( $post_id ) {
				
				// Fetch all boxes
				foreach ( self::$MetaBoxFields as $mb_key => $mb_fields ) {

					if ( self::verify_save( $mb_key . '_nonce', $mb_key, $post_id ) ) {

						// Fetch all fields in current box
						foreach ( $mb_fields as $field_key => $field ) {

							$field->save_metabox( $post_id );
						}
					}

				}

			}


			/**
			 * Dynamically build the metabox when this function is used as the callback.
			 *
			 * @param $post
			 * @param $args
			 */
			public static function build_metabox( $post, $args ) {
				
				$output = '';
				$tab_items = '';

				if ( self::$MetaBoxes[ $args['id'] ] ) {

					$use_tabs = ( count( self::$MetaBoxes[ $args['id'] ] ) > 1 ) ? true : false;
					if( $use_tabs ){
						
						$tab_items = '<div class="clapat-metabox-tab">';
					}
					
					$section_counter = 0;
					foreach ( self::$MetaBoxes[ $args['id'] ] as $section ){
					
						$section_counter++;
						if( $use_tabs ){
							
							$tab_items 	.= '<button class="tablinks';
							$tab_items 	.= ($section_counter == 1) ? ' active' : '';
							$tab_items 	.= '" tab-id="' . $section_counter . '">' . wp_kses_post( $section['title'] ) . '</button>';
							$output 		.= '<div id="clapat_metabox_tab_' . $section_counter . '" class="tabcontent';
							$output	 	.= ($section_counter == 1) ? ' active' : '';
							$output 		.= '">';
							// section title and description
							$output 		.= '<h3 class="clapat-metabox-section-title">' . $section['title'] . '</h3>';
							$output 		.= '<div class="clapat-metabox-section-desc">' . $section['desc'] . '</div>';
						}
						
						// Loop through each registered setting for this meta box…
						foreach (  $section['metabox_fields'] as $field ) {
						
							$item = $field->get_field(	$post );

							$output .= $item;
						}
						
						if( $use_tabs ){
						
							$output 	  .= '</div>';
						}
						
					}
					
					if( $use_tabs ){
						
						$tab_items 	  .= '</div>';
					}
					
					// One nonce for the whole box
					ob_start();
					wp_nonce_field( $args['id'], $args['id'] . '_nonce' );
					$output .= ob_get_clean();
				};
				
				$admin_notices = '<div class="clapat-metabox-admin-notices">';
				$admin_notices .= '<div class="clapat-metabox-notice-save" style="display:none;">' . __('Settings have changed, you should save them!', 'harington_core_plugin_text_domain') . '</div>';
				$admin_notices .= '</div>';
				
				// Wrap the whole thing in a metabox element so we can isolate it with CSS
				$output = sprintf('<div class="clapat-metabox">%s%s%s</div>', $admin_notices, $tab_items, $output);

				echo $output;

			}
			
			/**
			 * Registers metabox definitions
			 */
			public static function register_metabox_definitions( $metabox_definitions ) {
				
				self::$MetaBoxes = array();
				self::$MetaBoxFields = array();
				self::$MetaBoxDefinitions = $metabox_definitions;
				foreach( self::$MetaBoxDefinitions as $metabox_setting ){
					
					if( isset( $metabox_setting['sections'] ) ){
						
						self::$MetaBoxes[ $metabox_setting['id'] ] = array();
						foreach( $metabox_setting['sections'] as $section ){
							
							if( isset( $section['fields'] ) ){
								
								$section['metabox_fields'] = array();
								foreach( $section['fields'] as $metabox_field ){
									
									$clapat_metabox_field = new MetaBoxField( $metabox_field['id'], $metabox_setting['id'], $metabox_field );
									self::$MetaBoxFields[ $metabox_setting['id'] ][ $metabox_field['id'] ] = $clapat_metabox_field;
									$section['metabox_fields'][] = $clapat_metabox_field;
								}
								self::$MetaBoxes[ $metabox_setting['id'] ][] = $section;
							}
						}
					
					}
									
				}
					
				// Add the meta boxes
				add_action( 'add_meta_boxes', array( __CLASS__, 'register_metaboxes' ), 10, 2 );

				// Save the metaboxes
				add_action( 'save_post', array( __CLASS__, 'save_metaboxes' ) );
				
			}

			/**
			 * Performs meta box save validation
			 *
			 * @param $nonce_name
			 * @param $none_action
			 * @param $post_id
			 *
			 * @return bool
			 */
			public static function verify_save( $nonce_name, $none_action, $post_id ) {

				// VALIDATE NONCE & AUTOSAVE
				if ( ! isset( $_POST[ $nonce_name ] ) ) {
					return false;
				}
				if ( ! wp_verify_nonce( $_POST[ $nonce_name ], $none_action ) ) {
					return false;
				}
				if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
					return false;
				}

				// VALIDATE PERMISSIONS
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return false;
				}

				// EVERYTHING CHECKS OUT
				return true;
			}

			/**
			 * Constructor role
			 */
			public static function init() {

				require plugin_dir_path( __FILE__ ) . '/includes/MetaBox_Field.php';
				require plugin_dir_path( __FILE__ ) . '/includes/MetaBox_Html.php';
				require plugin_dir_path( __FILE__ ) . '/includes/MetaBox_HtmlTags.php';

				// Register metabox settings / fields
				add_action( 'harington/core/add_metaboxes', array( __CLASS__, 'register_metabox_definitions' ) );
				
				// Enqueue optionals styles & js
				add_action( 'admin_enqueue_scripts', function ( $hook ) {
					wp_enqueue_media();
					wp_enqueue_style( 'wp-color-picker' );
					wp_enqueue_script( 'clapat_metabox_scripts', plugin_dir_url( __FILE__ ) . 'assets/js/scripts.js', array( 'wp-color-picker' ), false, true );
					wp_enqueue_style( 'clapat_metabox_styles', plugin_dir_url( __FILE__ ) . 'assets/css/styles.css' );
				} );
			}


		}
		
	}
	
	Meta_Boxes::init();
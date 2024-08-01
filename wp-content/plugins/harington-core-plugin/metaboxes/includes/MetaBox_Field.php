<?php

namespace Harington\Core\Metaboxes;

/**
 * Class MetaBoxField
 *
 * Used to define and store metabox fields. A metabox field is usually created by MetaBoxes class when metaboxes are registered
 *
 * @package NV\Plugins\Widgets
 */
class MetaBoxField {
	
	private $meta_key 	= "";
	private $box_id 		= "";
	private $properties	= "";

	/**
	 * Used to register your custom settings.
	 *
	 * @param       $meta_key 	The key that will be used to save the data in the db (also used for id and name attributes)
	 * @param       $box_id   		The slug of the metabox id
	 * @param array $args     	Arguments used to construct your element.
	 */
	function __construct( $meta_key_param, $box_id_param, $args = array() ) {
		
		$this->meta_key 	= $meta_key_param;
		$this->box_id 		= $box_id_param;
		
		$this->properties = array_merge( array(
			'box_id'      		=> $this->box_id,
			'meta_key'    	=> $this->meta_key,
			// Visible label for this field
			'title'       			=> '',
			// Detailed desc about this field
			'desc'       			=> '',
			// Type of field this should be: text, url, textarea, select, media, switch, gallery, color picker, hidden
			'type'        		=> 'text',
			// Placeholder text, if appropriate
			'placeholder' 		=> '',
			// Default value or selection for this setting, if any.
			'default'       		=> '',
			// Assoc array of options for select, radio, and checkbox lists ('value' => 'visible text')
			'options'        	=> false,
			// Visibility array (conditions for displaying the field depending on the value of another field)
			'required'        	=> false,
			// Whether this should be automatically saved
			'save'        		=> true,
			
		), $args );
		
	}

	/**
	 *  Returns the property value of the current metabox field
	 * 
	 * @param string  $property - property name
	 *
	 * @return mixed
	 */
	public function getProperty( $property ){
		
		$value ="";
		if( isset( $this->properties[ $property ] ) ){
			
			$value = $this->properties[ $property ];
		}
		
		return $value;
	}
	
	/**
	 *  Returns the value of the current metabox field as stored in the WP database
	 * 
	 * @param string  $post - post id
	 *
	 * @return mixed
	 */
	public function get_field_value( $post_id ) {
		
		$value = get_post_meta( $post_id, $this->meta_key, true );
		
		$field_type = $this->getProperty('type');
		if( $field_type == 'switch' ){
			
			if( $value === '' ){
				
				return $this->getProperty('default');
			}
			else{
				
				return boolval( $value );
			}
		}
		else{
			
			return ( $value !== '' ) ? $value : $this->getProperty('default');
		}
	}
	
	/**
	 *  Returns the UI representation of the metabox field
	 * 
	 * @param string  $post - post id
	 * @param boolean $label - if this parameter is true it will add the title above field control
	 *
	 * @return string
	 */
	public function get_field( $post = null, $label = true ) {
		
		// If post_id isn't set, try to get it
		if ( is_object( $post ) ) {
			$post = $post->ID;
		}
		if ( empty( $post ) ) {
			$post = get_post();
			$post = $post->ID;
		}

		// Fetch the data (if applicable)
		$data  = get_post_meta( $post, $this->meta_key, true );
		$item  = '';

		// Add title label
		if ( $label ) {
			$item .= HtmlTags::label( '<strong>' . $this->getProperty('title') . '</strong>', array(
				'for' => $this->meta_key
			) );
		}

		// Generate the appropriate field
		$field_type = $this->getProperty('type');
		switch ( $field_type ) {

			// ---------------------------------------------------------------------------
			// == HIDDEN =================================================================
			case 'hidden':
				$item .= HtmlTags::inputHidden( $this->meta_key, ( $data ) ? $data : $this->getProperty('default') );
				break;

			// ---------------------------------------------------------------------------
			// == TEXTAREA ===============================================================
			case 'textarea':
				$item .= HtmlTags::textarea( $this->meta_key, ( $data ) ? $data : $this->getProperty('default'), array(
					'class' => 'clapat-metabox-event',
					'placeholder' => $this->getProperty('placeholder')
				) );
				break;

			// ---------------------------------------------------------------------------
			// == SELECT =================================================================
			case 'select':
				$item .= HtmlTags::select( $this->meta_key, $this->getProperty('options'), ( $data ) ? $data : $this->getProperty('default'), array( 'class' => 'clapat-metabox-event') );
				break;

			// ---------------------------------------------------------------------------
			// == MEDIA UPLOAD =================================================================
			case 'media':
				$item .= HtmlTags::media( $post, $this->meta_key, ( $data ) ? $data : $this->getProperty('default') );
				break;
			// ---------------------------------------------------------------------------
			
			// ---------------------------------------------------------------------------
			// == MEDIA GALLERY =================================================================
			case 'gallery':
				$item .= HtmlTags::gallery( $post, $this->meta_key, ( $data ) ? $data : $this->getProperty('default') );
				break;
			// ---------------------------------------------------------------------------
			
			// == CHECKBOX ===============================================
			case 'switch':
				$item .= HtmlTags::inputCheckbox( $this->meta_key, $this->getProperty('options'), ( $data !== '' ) ? $data : $this->getProperty('default'), array( 'class' => 'clapat-metabox-event') );
				break;
			
			// == COLOR PICKER ===============================================
			case 'color-picker':
				$item .= HtmlTags::inputColorPicker(  $this->meta_key, array(
					'value'       => ( $data ) ? $data : $this->getProperty('default')
				) );
				break;
				
			// ---------------------------------------------------------------------------
			// == TEXTBOX ================================================================
			case 'url':
			case 'text':
			case 'input':
			default:
				$item .= HtmlTags::input( $this->meta_key, array(
					'class' => 'clapat-metabox-event',
					'placeholder' => $this->getProperty('placeholder'),
					'value'       => ( $data ) ? $data : $this->getProperty('default')
				) );
				break;
		}

		// Add field description
		$desc = $this->getProperty('desc');
		if ( $desc ) {
			$item .= HtmlTags::div( array(
				'class' => 'clapat-metabox-desc'
			), $desc, false );
		}

		$attributes = array();
		$required = $this->getProperty('required');
		if( !empty( $required ) ){
			
			$attributes["attr-depends-on"] = esc_attr( $required[0] );
			$attributes["attr-depends-op"] = esc_attr( $required[1] );
			$attributes["attr-depends-val"] = esc_attr( $required[2] );

		}
		$item = HtmlTags::div( array_merge( array(
				'class' => 'clapat-metabox-field'
			), $attributes), $item, false );
			
		return $item;

	}
	
	public function save_metabox( $post_id ) {
				
		// If save isn't true, skip
		if ( !$this->getProperty('save') ) {
			return;
		}

		// If the value is set, save; otherwise, delete the setting
		if ( isset( $_POST[ $this->meta_key ] ) ) {
			$new_value = $_POST[ $this->meta_key ];
		}

		// Process the form data as appropriate
		$field_type = $this->getProperty('type');
		switch ( $field_type ) {
			
			case 'switch':
				if( isset( $_POST[ $this->meta_key ] ) ){
					
					$new_value = true;
				}
				else{
					
					$new_value = 0;
				}
				break;
				
			case 'media':
				// The value we get from $_POST array represents the media id
				$media_id = $new_value;
				$media_metadata = wp_get_attachment_image_src( $media_id, 'full' );
				$thumb_media_metadata = wp_get_attachment_image_src( $media_id, 'thumbnail' );
				if( $media_metadata ){
					
					$arr_serialize = array();
					$arr_serialize["url"] = $media_metadata[0];
					$arr_serialize["id"] = $media_id;
					$arr_serialize["width"] = $media_metadata[1];
					$arr_serialize["height"] = $media_metadata[2];
					if( $thumb_media_metadata && isset( $thumb_media_metadata[0] ) ){
						
						$arr_serialize["thumbnail"] = $thumb_media_metadata[0];
					} else {
						
						// no thumbnail
						$arr_serialize["thumbnail"] = $arr_serialize["url"];
					}
					$new_value = $arr_serialize;
				}
				else{
					
					$new_value = "";
				}
				break;
				
			case 'gallery':
				$new_value = sanitize_text_field( wp_unslash( $new_value ) );
				break;
				
			case 'select':
			case 'input':
				$new_value = sanitize_text_field( $new_value );
				break;
				
			case 'url':
				$new_value = esc_url_raw( $new_value );
				break;
				
			case 'text':
			case 'textarea':
			default:
				$new_value = wp_kses_post( $new_value );
				break;
		}

		if ( !empty($new_value) || ($field_type == 'switch') ) {
			
			update_post_meta( $post_id, $this->meta_key, $new_value );
		}
		else {
			
			delete_post_meta( $post_id, $this->meta_key );
		}

	}

}
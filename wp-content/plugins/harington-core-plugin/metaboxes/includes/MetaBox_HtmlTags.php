<?php

namespace Harington\Core\Metaboxes;

/**
 * Includes shortcuts to speed up the easy generation of dynamic HTML using the
 * HtmlGen helper class.
 *
  */
class HtmlTags extends Html {

	/**
	 * Returns an <a> tag.
	 *
	 * @param        $atts An associative array of attributes (such as href)
	 * @param string $content
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function a( $href = '#', $atts = array(), $content = '', $echo = false ) {
		$atts = parent::atts_default(
			array(
				'href' => $href,
			),
			$atts
		);

		$return = parent::gen( 'a', $atts, $content );

		if ( $echo ) {
			echo $return;
		}

		return $return;
	}

	/**
	 * Returns a <div> tag.
	 *
	 * @param array  $atts
	 * @param string $content
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function div( $atts = array(), $content = '', $echo = false ) {
		$return = parent::gen( 'div', $atts, $content );

		if ( $echo ) {
			echo $return;
		}

		return $return;
	}

	/**
	 * Returns a valid <img> tag.
	 *
	 * @param string $src
	 * @param array  $atts
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function img( $src = '', $atts = array(), $echo = false ) {
		$atts = parent::atts_default(
			array(
				'src' => ( ! empty( $src ) ) ? $src : '',
				'alt' => '',
			),
			$atts
		);

		$return = parent::gen( 'img', $atts, '', true );

		if ( $echo ) {
			echo $return;
		}

		return $return;
	}

	/**
	 * Returns a form element.
	 *
	 * Notice: This is a wrapper method. Generate your other HTML first and pass it in as $content.
	 *
	 * @param string $method
	 * @param string $action
	 * @param string $content
	 * @param array  $atts
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function form( $method = 'GET', $action = '', $content = '', $atts = array(), $echo = false ) {
		$atts = parent::atts_default(
			array(
				'id'   => ( ! empty( $name ) ) ? $name : parent::randomId(),
				'method' => $method,
				'action' => $action,
			),
			$atts
		);

		$return = parent::gen('form',$atts,$content);

		if ( $echo ) {
			echo $return;
		}

		return $return;
	}

	/**
	 * Returns an <input> tag of type "text".
	 *
	 * @param string $name
	 * @param array  $atts
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function input( $name, $atts = array(), $echo = false ) {
		
		$atts = parent::atts_default(
			array(
				'id'   => ( ! empty( $name ) ) ? $name : parent::randomId(),
				'name' => $name,
				'type' => 'text',
			),
			$atts
		);

		$return = parent::gen( 'input', $atts, '', true );

		if ( $echo ) {
			echo $return;
		}

		return $return;
	}

	/**
	 * Alias for input() method.
	 *
	 * @param string $name
	 * @param array  $atts
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function inputText( $name = '', $value = '', $atts = array(), $echo = false ) {
		$atts = parent::atts_default(
			array(
				'value' => $value,
				'placeholder' => '',
			),
			$atts
		);
		return self::input( $name, $atts, $echo );
	}

	/**
	 * Returns a checkbox input element.
	 *
	 * @param string $name
	 * @param array  $atts
	 * @param bool   $echo
	 *
	 * @return string
	 */
	 
	public static function inputCheckbox( $name = '', $options = false, $checked = false, $atts = array(), $echo = false ) {
		$atts['type'] = 'checkbox';
		
		if ($checked) {
			$atts['checked'] = 'checked';
		}
	
		$field = self::input( $name, $atts, false);
		$field .= self::span( '', array(
				'class' => 'slider round'
			), false );
			
		return self::label( $field, array(
				'class' => 'switch'
			), $echo );
	}

	
	/**
	 * Create a hidden form field.
	 *
	 * @param string $name
	 * @parem string $value
	 * @param array  $atts
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function inputHidden( $name = '', $value='', $atts = array(), $echo = false ) {
		$atts['type'] = 'hidden';
		$atts['value'] = $value;
		
		return self::input( $name, $atts, $echo);
	}

	/**
	 * Returns a <textarea> element.
	 *
	 * @param string $name
	 * @param array  $atts
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function textarea( $name = '', $text = '', $atts = array(), $echo = false ) {
		$atts = parent::atts_default(
			array(
				'id'   => ( ! empty( $name ) ) ? $name : parent::randomId(),
				'name' => ( ! empty( $name ) ) ? $name : 'NOT_SET',
			),
			$atts
		);

		$return = parent::gen( 'textarea', $atts, $text );

		if ( $echo ) {
			echo $return;
		}

		return $return;
	}

	/**
	 * Generates a <select> dropdown element.
	 *
	 * Content can be passed as an associative array, but a plain string will be accepted as well. If an array is used,
	 * it should be formatted 'value' => 'Visible Text' and if $current is set, this method will find and select the
	 * respective element.
	 *
	 * @param string $name      The value to use for HTML name and id attributes
	 * @param array  $content   An array used to populate the select element with options
	 * @param mixed  $current   The current/default selected option (if $content is array)
	 * @param array  $atts
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function select( $name = '', $content = false, $current = null, $atts = array(), $echo = false ){

		$atts = parent::atts_default(
			array(
				'id'   => ( ! empty( $name ) ) ? $name : parent::randomId(),
				'name' => ( ! empty( $name ) ) ? $name : 'NOT_SET',
			),
			$atts
		);

		$options = '';

		if ( is_array($content) ) {
			foreach ( $content as $optVal => $optText ) {
				$options .= self::option( $optText, $optVal, ($optVal == $current) );
			}
			$content = $options;
		}

		$return = parent::gen( 'select', $atts, $content );

		if ( $echo ) {
			echo $return;
		}

		return $return;
	}

	/**
	 * Generates an <option> element for use in a select dropdown.
	 *
	 * @param string $text      Visible text for the option
	 * @param string $value     Value to use for the option
	 * @param bool   $selected  Should this option be selected?
	 * @param array  $atts
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function option( $text = '', $value = '', $selected = false, $atts = array(), $echo = false ){
		$atts = parent::atts_default(
			array(
				'value' => $value,
			),
			$atts
		);

		if ( $selected ) {
			$atts['selected'] = 'selected';
		}

		$return = parent::gen( 'option', $atts, $text );

		if ( $echo ) {
			echo $return;
		}

		return $return;
	}

	/**
	 * Returns a label element.
	 *
	 * @param string $text The text or content for the label.
	 * @param array  $atts
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function label( $text='', $atts = array(), $echo = false ) {

		$return = parent::gen( 'label', $atts, $text );

		if ( $echo ) {
			echo $return;
		}

		return $return;
	}
	
	/**
	 * Returns a span element.
	 *
	 * @param string $text The text or content for the span.
	 * @param array  $atts
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function span( $text='', $atts = array(), $echo = false ) {

		$return = parent::gen( 'span', $atts, $text );

		if ( $echo ) {
			echo $return;
		}

		return $return;
	}

	/**
	 * Returns an upload media element.
	 *
	 * @param string $post - Current post id
	 * @param array  $name - Name of the metabox field
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function media( $post = null, $name = "", $content = "", $echo = false ){
		
		// Get WordPress' media upload URL
		$upload_link = esc_url( get_upload_iframe_src( 'image', $post ) );

		$img_id = "";
		$img_url = "";
		$thumb_img_url = "";
		if( $content ){
			
			if( !is_array( $content ) ){
				
				$image_metadata = unserialize ( $content );
			}
			else {
				
				$image_metadata = $content;
			}
			if( isset( $image_metadata['url'] ) ){
				$img_url = $image_metadata['url'];
			}
			if( isset( $image_metadata['thumbnail'] ) ){
				$thumb_img_url = $image_metadata['thumbnail'];
			}
			$img_id = $image_metadata['id'];
		}
		
		$return = '<div class="clapat-media-metabox">';
		$return .= '<input type="url" class="clapat-metabox-img-url clapat-metabox-event" name="clapat-metabox-img-url" type="hidden" value="' . esc_attr( $img_url ) . '" readonly="readonly" />';
		$return .= '<div class="clapat-metabox-img-container">';
		if ( $content ) {
			$return .= '<img src="' . esc_url( $thumb_img_url ) . '" alt="" style="max-width:100%;" />';
		}
		$return .= '</div>';
		
		$return .= '<p class="hide-if-no-js">';
		$return .= '<a class="upload-clapat-metabox-img button-primary" ';
		$return .= 'href="' . esc_url( $upload_link ) . '">';
		$return .= __('Upload', 'harington_core_plugin_text_domain');
		$return .= '</a>';
		$return .= '<a class="delete-clapat-metabox-img button-secondary" ';
		$return .= 'href="#">';
		$return .= __('Remove', 'harington_core_plugin_text_domain');
		$return .= '</a>';
		$return .= '</p>';
		$return .= '<input class="clapat-metabox-img-id" name="' . $name . '" type="hidden" value="' . esc_attr( $img_id ) . '" />';
		$return .= '</div>';
		
		if ( $echo ) {
			echo $return;
		}

		return $return;
		
	}

	/**
	 * Returns images gallery element.
	 *
	 * @param string $post - Current post
	 * @param array  $name - Name of the metabox field
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function gallery( $post = null, $name = "", $content = "", $echo = false ){
		
		$return = '<div class="clapat-media-gallery-metabox">';
	
		$return .= '<div class="clapat-metabox-gallery-images">';
		$img_array = ( isset( $content ) && '' !== $content ) ? explode( ',', $content ) : '';
		if ( '' !== $img_array ) {
			foreach ( $img_array as $img ) {
				$return .= '<div class="clapat-metabox-gallery-item" data-id="' . esc_attr( $img ) . '"><div class="clapat-metabox-gallery-item-remove"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 13.06l3.712 3.713 1.061-1.06L13.061 12l3.712-3.712-1.06-1.06L12 10.938 8.288 7.227l-1.061 1.06L10.939 12l-3.712 3.712 1.06 1.061L12 13.061z"></path></svg></div><div class="clapat-metabox-gallery-img">' . wp_get_attachment_image( $img ) . '</div></div>';
			}
		}
		$return .= '</div>';
		$return .= '<div class="clapat-metabox-gallery-buttons">';
		$return .= '<input class="clapat-metabox-gallery-ids clapat-metabox-event" name="' . esc_attr( $name )  . '" type="hidden" value="' . esc_attr( $content ) . '" readonly="readonly" />';
		$return .= '<input title="' . esc_html__( 'Manage gallery', 'harington_core_plugin_text_domain' ) .'" type="button" class="manage-clapat-metabox-gallery button-primary" value="' . esc_html__( 'Manage gallery', 'harington_core_plugin_text_domain' ) . '" />';
		$return .= '<input title="' . esc_html__( 'Empty gallery', 'harington_core_plugin_text_domain' ) .'" type="button" class="empty-clapat-metabox-gallery button-secondary" value="' . esc_html__( 'Empty gallery', 'harington_core_plugin_text_domain' ) . '" />';
		$return .= '</div>';
		
		$return .= '</div>';
		
		if ( $echo ) {
			echo $return;
		}

		return $return;
		
	}
	
	/**
	 * Returns a color picker field.
	 *
	 * @param string $name
	 * @param array  $atts
	 * @param bool   $echo
	 *
	 * @return string
	 */
	public static function inputColorPicker( $name = '', $value = '', $atts = array(), $echo = false ) {
		$atts = parent::atts_default(
			array(
				'value' => $value,
				'class' => 'clapat-metabox-color-picker',
			),
			$atts
		);
		return self::input( $name, $atts, $echo );
	}
}
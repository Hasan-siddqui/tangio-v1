<?php
require_once('access-wp.php');

if( !defined('HARINGTON_SHORTCODES_DIR') ) define('HARINGTON_SHORTCODES_DIR', plugin_dir_path(__FILE__));
if( !defined('HARINGTON_SHORTCODES_DIR_URL') ) define('HARINGTON_SHORTCODES_DIR_URL', plugin_dir_url(__FILE__));

?>

<!DOCTYPE html>
<html>
<head>
<title></title>

<link rel="stylesheet" href="<?php echo HARINGTON_SHORTCODES_DIR_URL; ?>/include/css/font-awesome.min.css" />
<link rel="stylesheet" href="<?php echo HARINGTON_SHORTCODES_DIR_URL; ?>/include/css/shortcodes_popup.css" />

<script src="<?php echo HARINGTON_SHORTCODES_DIR_URL; ?>/include/js/simple-slider.min.js"></script>
<script src="<?php echo HARINGTON_SHORTCODES_DIR_URL; ?>/include/js/shortcodes_popup.js"></script>

</head>

<body>	
    <br>

<?php

function shortcode_options( $sc_name, $shortcode ){

    if( $shortcode ){

        if( isset($shortcode['require_icon']) && $shortcode['require_icon'] ){

            require_once( HARINGTON_SHORTCODES_DIR . "/include/fontawesome-icons.php" );
        }

        // display shortcode attributes
        if( isset( $shortcode['attributes'] ) && $shortcode['attributes'] ){

            echo '<div class="shortcode-options" id="options-group">';

            $attributes = $shortcode['attributes'];

            foreach( $attributes as $attribute => $attr_options ){

                echo '<div class="label"><label for="'.$attribute.'"><strong>'.$attr_options['title'].': </strong></label></div>';
                echo '<div class="content">';

                if( $attr_options['type'] == "text" ){

                    echo '<input class="attr" type="text" data-attrname="'.$attribute.'" value="' . $attr_options['default'] . '" />';

                }
                if( $attr_options['type'] == "icon" ){

                    echo '<input class="attr" type="text" data-attrname="'.$attribute.'" value="' . $attr_options['default'] . '" />';
                    echo '<a class="btn display-icons-list" id="btn-' . $attribute . '">' . __('Set Icon', 'harington_core_plugin_text_domain') . '</a>';

                }
                if( $attr_options['type'] == "select" ){

                    echo '<select class="attr" type="select" data-attrname="'.$attribute.'" id="'.$attribute.'">';

                    $values = $attr_options['values'];
                    foreach( $values as $value ){
                        echo '<option value="'.$value.'">'.$value.'</option>';
                    }

                    echo '</select>';
                }

                echo $attr_options['desc'] . '</div>';
            }

            echo '</div>'; // div options group

        }

        if( isset( $shortcode['sub_items'] ) && $shortcode['sub_items'] ){

            foreach ( $shortcode['sub_items'] as $subitem_name => $subitem ) {

                echo '<div class="shortcode-dynamic-items" id="options-item" data-name="item">';
                echo '<div class="label"><label id="dynamic-item-label" for="shortcode-dynamic-items">' . $subitem['name'] . '</label></div>';
                echo '<div class="shortcode-dynamic-item">';

                shortcode_options( $subitem_name, $subitem );

                echo '</div>';
                echo '</div>';
                echo '<a href="#" class="btn blue add-list-item">' . sprintf(__('Add %s', 'harington_core_plugin_text_domain' ), $subitem['name']) . '</a>' . '<a href="#" class="btn blue remove-list-item">'. sprintf(__('Remove %s', 'harington_core_plugin_text_domain' ), $subitem['name']) . '</a>';
            }

        }

        if( isset( $shortcode['has_content'] ) && $shortcode['has_content'] ){

            ?>
            <div id="shortcode-content">

                <div class="label"><label id="option-label" for="shortcode-content"><?php echo __( 'Content: ', 'harington_core_plugin_text_domain' ); ?> </label></div>
                <div class="content"><textarea id="shortcode_content"><?php if( isset( $shortcode['default_content'] ) ){ echo $shortcode['default_content']; } ?></textarea></div>

                <div class="hr"></div>

            </div>

        <?php

        } // if shortcode has content
        else{

            echo '<div class="hr"></div>';
        }

        echo '<input type="hidden" id="shortcode-name" value="' . $sc_name . '" />';


    } // if found shortcode

}

if( isset( $_GET['sc'] ) ){

    $sc = $_GET['sc'];

    require_once( HARINGTON_SHORTCODES_DIR . "/include/shortcode_definitions.php" );

    global $clapat_shortcodes;

    $shortcode = $clapat_shortcodes[$sc];

    if( $shortcode ){

        shortcode_options( $sc, $shortcode );
    }
?>

<a class="btn" id="add-shortcode"><?php _e('Add Shortcode', 'harington_core_plugin_text_domain'); ?></a>

<?php
}
?>

</body>
</html>

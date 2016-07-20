<?php

/**
 * Created by PhpStorm.
 * User: araksya.kantikyan
 * Date: 12/7/2016
 * Time: 2:06 μμ
 */
class  Bookwize_Form_Widget extends WP_Widget
{
    function __construct()
    {
        // Instantiate the parent object
        parent::__construct(false, 'Bookwize Booking Form');
    }

    function widget($args, $instance)
    {
        extract($args);
        // these are the widget options
        $title = apply_filters('widget_title', $instance['title']);
        // Check if title is set

        if ($title) {

            echo $before_title . $title . $after_title;

        }
        echo $before_widget;
        // Display the widget
        echo '<div class="widget-text wp_widget_plugin_box">';
        $bwf_small_edition = $instance['bwf_small_edition'] ? 'true' : 'false';
        // Check if bwf_small_edition is set
        if ($bwf_small_edition ) {
            echo do_shortcode( '[bookwizeform bwf_small_edition="'.$bwf_small_edition.'"]' );
        }

        echo '</div>';
        echo $after_widget;
    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        // Fields
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['bwf_small_edition'] = strip_tags($new_instance['bwf_small_edition']);
        return $instance;
    }

    function form($instance)
    {

        if ($instance) {
            $title = esc_attr($instance['title']);

        } else {
            $title = '';

        }
        $defaults = array( 'title' => __( '', 'bookwize-form' ), 'bwf_small_edition' => 'off' );
        $instance = wp_parse_args( ( array ) $instance, $defaults ); ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'bookwize-form'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        <p>
            <label
                for="<?php echo $this->get_field_id('bwf_small_edition'); ?>"><?php echo __('Show only check-in and check-out fields', 'bookwize-form'); ?></label>

            <input class="checkbox" type="checkbox"  <?php checked( $instance[ 'bwf_small_edition' ], 'on' ); ?> id="<?php echo $this->get_field_id( 'bwf_small_edition' ); ?>" name="<?php echo $this->get_field_name( 'bwf_small_edition' ); ?>" />
        </p>
        <?php
    }
}

function bookwize_form_register_widgets()
{
    register_widget('Bookwize_Form_Widget');
}

add_action('widgets_init', 'bookwize_form_register_widgets');
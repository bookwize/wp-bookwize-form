<?php

class Bookwize_Form_Shortcodes
{

    public function __construct()
    {

        add_action('init', [&$this, 'init']);

    }

    public function init()
    {

        // Add Shortcodes
        add_shortcode('bookwizeform', [&$this, 'bookwizeform']);

    }

    public function bookwizeform($atts)
    {
        $bookwizeSettings = new Bookwize_Form_Settings();
        $args = array();
        $argKeys = $bookwizeSettings->getSettingKeys();
        foreach ($argKeys as $argKey) {
            $args[$argKey] = get_option($argKey);
        }
        return bookwize_form_render('bookwize-form-template', shortcode_atts($args, $atts));
    }
}
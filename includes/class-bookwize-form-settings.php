<?php

class Bookwize_Form_Settings
{

    // A config array containing the required options for connection
    public $settings = [];

    // public $bookwize_form_meta = null;

    // Add Wp Action Hooks
    public function __construct()
    {
        $this->settings = [
            [
                'name' => 'auth',
                'section' => ['auth_section', 'Authentication', '*Information provided by Bookwize Support Team <a href="https://www.bookwize.com/" target="_blank">www.bookwize.com</a> - <a href="mailto:support@bookwize.com" target="_blank">support@bookwize.com</a>'],
                'settings' => [
                    ['bwf_api_key', 'API Key', 'text', 'Unique API Key (eg: oxulhg0rlkkbacgz21m1h)'],
                    ['bwf_hotel_id', 'Hotel Id', 'text', 'Unique Hotel Id (eg: 264)'],
                    ['bwf_hotel_url', 'Hotel Url', 'text', 'https://presentation.bookwize.com'],
                ]
            ],
            [
                'name' => 'themes',
                'section' => ['theme_section', 'Themes', '*Choose one of the default themes'],
                'settings' => [
                    ['bwf_theme', 'Choose Theme', 'select', 'Default theme',
                        [
                            'options' => [
                                // key points to css file name
                                'bookwize-theme-default' => 'horizontal default theme',
                                'bookwize-theme-1' => 'horizontal theme 1',
                                'bookwize-theme-2' => 'horizontal theme 2',
                                'bookwize-vertical-theme-1' => 'vertical theme 1',
                            ],
                            // 'empty' => true
                        ]
                    ],
                ]
            ],
            [
                'name' => 'frontend',
                'section' => ['frontend_section', 'Front End Configuration', 'Place [bookwizeform] shortcode in the text field to show the form or Add Bookwize Booking Form Widget'],
                'settings' => [
                    ['bwf_background_color', 'Form Background Color ', 'color'],
                    ['bwf_text_color', 'Text Color ', 'color'],
                    ['bwf_text_label_color', 'Label Color ', 'color'],
                    ['bwf_input_color', 'Input Background Color ', 'color'],
                    ['bwf_button_color', 'Button Color ', 'color'],
                    ['bwf_submit_button_color', 'Submit Button Color ', 'color'],
                    ['bwf_small_edition', 'Show only check-in and check-out fields', 'checkbox'],
                    ['bwf_promo_code', 'Show Promo Code', 'checkbox'],
                    ['bwf_board', 'Show Board', 'checkbox'],
                    ['bwf_custom_style', 'Add your custom css', 'textarea', 'eg: .reservation .form__submit {color:red;}'],
                    ['bwf_disable_css', "Disable plugin's css", 'checkbox'],
                ]
            ]
        ];
    }

    public function getSettingKeys()
    {
        foreach ($this->settings as $setting) {
            foreach ($setting['settings'] as $option) {
                $setarray[] = $option[0];
            }
        }
        return $setarray;
    }

    // Creates Bookwize Settings Page
    public function admin_menu()
    {

        add_menu_page(
            'Settings',
            'Bookwize',
            'manage_options',
            'bookwize',
            [&$this, 'render_options_page']
        );

        /*add_submenu_page( 'bookwize', 'Page Associations', 'Page Associations', 'manage_options', 'bookwize-page-association', [
            &$this,
            'render_options_subpage_settings'
        ] );*/
        /*
        add_submenu_page( 'bookwizeform', 'Localization', 'Localization', 'manage_options', 'bookwizeform-localization', [
            &$this,
            'render_options_subpage_localization'
        ] );
        */

    }


    public function admin_init()
    {

        $this->set_settings($this->settings);

        flush_rewrite_rules();
    }

    public function set_settings($settings)
    {

        foreach ($settings as $setting) {
            $section = $setting['section'];
            add_settings_section($section[0], $section[1], [&$this, 'render_settings_section'], 'bookwizeform');

            foreach ($setting['settings'] as $option) {

                add_settings_field(
                    $option[0], $option[1], [&$this, 'render_settings_fields'],
                    'bookwizeform',
                    $section[0],
                    $option
                );

                register_setting('bookwizeform', $option[0]);
            }
        }
    }

    // Render Content for Bookwize Settings Page
    public function render_options_page()
    {

        if (isset($_POST['bwf_import_resources_from_bookwize_form_service'])) {

            $data = bwf_import_resources_from_bookwize_form_service(get_option('bwf_lang'));

            $message = 'An error occurred!';
            if ($data !== false) {
                $message = 'Resources stored successfully! ';
            }

            add_action('admin_notices', [&$this, 'show_flash_message']);
            do_action('admin_notices', $message);
        }
        if (isset($_POST['mm_clear_cache'])) {

            Bookwize_Form_Cache::clear('all');

            $message = 'Bookwize Database cache cleared successfully! ';

            add_action('admin_notices', [&$this, 'show_flash_message']);
            do_action('admin_notices', $message);
        }

        include plugin_dir_path(dirname(__FILE__)) . 'admin/partials/bookwize-form-admin-settings.php';
    }

    // Render input fields foreach registered setting
    public function render_settings_fields($field)
    {

        switch ($field[2]) {
            case 'checkbox':
                echo '<input name="' . $field[0] . '" id="' . $field[0] . '" type="checkbox" value="1" class="code" ' . checked(1, get_option($field[0]), false);
                $this->_print_attrs($field);
                echo '/>';
                break;
            case 'select':
                echo '<select  name="' . $field[0] . '" id="' . $field[0] . '" class="code">';
                if (isset($field[4]['empty'])) {
                    echo '<option value=""></option>';
                }
                if (isset($field[4]['options'])) {
                    foreach ($field[4]['options'] as $value => $option) {
                        echo '<option value="' . $value . '"' . selected($value, get_option($field[0]), false) . '>' . $option . '</option>';
                    }
                }
                echo '</select>';
                break;
            case 'textarea' :
                echo '<textarea class="regular-text code" cols="40" rows="7" name="' . $field[0] . '" id="' . $field[0] . '" ' . $this->_print_attrs($field) . '>'
                    . get_option($field[0])
                    . '</textarea>';
                break;
            default :
                echo '<input class="regular-text code" name="' . $field[0] . '" id="' . $field[0] . '" type="text" value="' . get_option($field[0]) . '"';
                $this->_print_attrs($field);
                echo '/>';
                break;
        }

        // display extra info texts
        foreach ($this->settings as $settings) {
            foreach ($settings['settings'] as $option) {
                if ($option[0] == $field[0] && isset($option[3])) {
                    echo '<p class="description">' . $option[3] . '</p>';
                }
            }
        }
    }

    public function render_settings_section($field)
    {
        // display extra info texts
        foreach ($this->settings as $settings) {
            if ($settings['section'][0] == $field['id'] && isset($settings['section'][2])) {
                echo '<p class="description">' . $settings['section'][2] . '</p>';
            }
        }
    }

    public function show_flash_message($message = 'Updated')
    {

        include plugin_dir_path(dirname(__FILE__)) . 'admin/partials/bookwize-form-admin-flash-message.php';

    }

    public function render_options_subpage_settings()
    {


        include plugin_dir_path(dirname(__FILE__)) . 'admin/partials/bookwize-form-admin-page-associations.php';
    }

    public function render_options_subpage_localization()
    {

        include plugin_dir_path(dirname(__FILE__)) . 'admin/partials/bookwize-form-admin-localization.php';
    }

    protected function _print_attrs($field)
    {
        if (isset($field[4]) && is_array($field[4])) {
            foreach ($field[4] as $key => $value) {
                echo ' ' . $key . '="' . esc_attr($value) . '"';
            }
        }
    }
}


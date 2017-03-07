<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://bookwize.com
 * @since             1.4
 * @package           Bookwize_Form
 *
 * @wordpress-plugin
 * Plugin Name:       Bookwize Form
 * Plugin URI:        http://bookwize.com
 * Description:       bookwize booking form
 * Version:           1.4
 * Author:            Bookwize
 * Author URI:        www.bookwize.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bwf
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-bookwize-form-activator.php
 */
function activate_bookwize_form()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-bookwize-form-activator.php';
    Bookwize_Form_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-bookwize-form-deactivator.php
 */
function deactivate_bookwize_form()
{
    require_once plugin_dir_path(__FILE__) . 'includes/class-bookwize-form-deactivator.php';
    Bookwize_Form_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_bookwize_form');
register_deactivation_hook(__FILE__, 'deactivate_bookwize_form');

/**
 * Add links in plugin page
 */
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'bookwize_form_action_links');
function bookwize_form_action_links($links)
{
    $links[] = '<a href="' . esc_url(get_admin_url(null, 'options-general.php?page=bookwize')) . '">Settings</a>';

    return $links;
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-bookwize-form.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.1.0
 */
function run_bookwize_form()
{

    $plugin = new Bookwize_Form();
    return $plugin->run();
}

add_action('plugins_loaded', function () {

    run_bookwize_form();

});
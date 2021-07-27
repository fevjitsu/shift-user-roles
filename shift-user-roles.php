<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              cfeveck.com
 * @since             1.0.0
 * @package           Shift_User_Roles
 *
 * @wordpress-plugin
 * Plugin Name:       shift-user-roles
 * Plugin URI:        shift-user-roles
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Chris Feveck
 * Author URI:        cfeveck.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       shift-user-roles
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('SHIFT_USER_ROLES_VERSION', '1.0.0');
define('SHIFT_USER_ROLES_PLUGIN_URL', plugin_dir_url(__FILE__));
define('SHIFT_USER_ROLES_PLUGIN_PATH', plugin_dir_path(__FILE__));
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-shift-user-roles-activator.php
 */
function activate_shift_user_roles()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-shift-user-roles-activator.php';
	$activator = new Shift_User_Roles_Activator();
	$activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-shift-user-roles-deactivator.php
 */
function deactivate_shift_user_roles()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-shift-user-roles-deactivator.php';
	require_once plugin_dir_path(__FILE__) . 'includes/class-shift-user-roles-activator.php';
	$activator = new Shift_User_Roles_Activator();
	$deactivator = new Shift_User_Roles_Deactivator($activator);
	$deactivator->deactivate();
}

register_activation_hook(__FILE__, 'activate_shift_user_roles');
register_deactivation_hook(__FILE__, 'deactivate_shift_user_roles');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-shift-user-roles.php';
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
	$url = "https://";
else
	$url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];

// echo "<pre>" . print_r($url) . "</pre>";
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_shift_user_roles()
{

	$plugin = new Shift_User_Roles();
	$plugin->run();
}
run_shift_user_roles();
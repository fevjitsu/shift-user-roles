<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       cfeveck.com
 * @since      1.0.0
 *
 * @package    Shift_User_Roles
 * @subpackage Shift_User_Roles/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Shift_User_Roles
 * @subpackage Shift_User_Roles/includes
 * @author     Chris Feveck <christopher.feveck@gmail.com>
 */
class Shift_User_Roles_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'shift-user-roles',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

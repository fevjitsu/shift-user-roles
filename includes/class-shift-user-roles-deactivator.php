<?php

/**
 * Fired during plugin deactivation
 *
 * @link       cfeveck.com
 * @since      1.0.0
 *
 * @package    Shift_User_Roles
 * @subpackage Shift_User_Roles/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Shift_User_Roles
 * @subpackage Shift_User_Roles/includes
 * @author     Chris Feveck <christopher.feveck@gmail.com>
 */
class Shift_User_Roles_Deactivator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	private $table_activator;
	public function __construct($activator)
	{
		$this->table_activator = $activator;
	}
	public function deactivate()
	{
		global $wpdb;
		//remove table upon plugin deactivate
		$wpdb->query("drop table if exists " . $this->table_activator->get_table_name());
		$wpdb->query("drop table if exists " . $this->table_activator->get_table_name_role_list());
		//remove page
		$get_data = $wpdb->get_row(
			$wpdb->prepare(
				"select id from " . $wpdb->prefix . "posts where post_name= %s",
				"shift_guest_user"
			)
		);
		$page_id = $get_data;
		if ($page_id > 0) {
			wp_delete_post($page_id, true);
		}
	}
}
<?php

/**
 * Fired during plugin activation
 *
 * @link       cfeveck.com
 * @since      1.0.0
 *
 * @package    Shift_User_Roles
 * @subpackage Shift_User_Roles/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Shift_User_Roles
 * @subpackage Shift_User_Roles/includes
 * @author     Chris Feveck <christopher.feveck@gmail.com>
 */
class Shift_User_Roles_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public  function activate()
	{
		global $wpdb;

		// table roles_types
		if ($wpdb->get_var("show tables like " . $this->get_table_name_role_list()) != $this->get_table_name_role_list()) {
			//dynamic table generating		
			$table_role_types_query = "CREATE TABLE " . $this->get_table_name_role_list() . " AS SELECT * FROM wpjk_users ";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			// dbDelta($table_role_types_query);
			// $alter_query = "ALTER TABLE " . $this->get_table_name_role_list() . " ADD COLUMN user_role VARCHAR(255) DEFAULT 'guest@shiftpsych.team'";
			// $wpdb->query($alter_query);
			// $alter_query = "ALTER TABLE wpjk_users ADD COLUMN user_role VARCHAR(255) DEFAULT 'guest@shiftpsych.team'";
			// $wpdb->query($alter_query);
		}

		$get_data = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM " . $wpdb->prefix . " posts WHERE post_name= %s",
				"shift_guest_user"
			)
		);
		if (!empty($get_data)) {
			//
		} else {
			//create page
			$post_arr_data = array(
				"post_title" => "Shift guest user",
				"post_name" => "shift_guest_user",
				"post_status" => "publish",
				"post_author" => 1,
				"post_content" => "<h3>Guest user</h3>",
				"post_type" => "page",
			);

			wp_insert_post($post_arr_data);
		}
	}

	public function get_table_name()
	{
		global $wpdb;
		// table name
		// wp_shift_user_roles
		return $wpdb->prefix . "shift_user_roles";
	}

	public function get_table_name_role_list()
	{
		global $wpdb;
		// table name
		// wp_shift_user_roles
		return $wpdb->prefix . "shift_user_roles_list";
	}
}
<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       cfeveck.com
 * @since      1.0.0
 *
 * @package    Shift_User_Roles
 * @subpackage Shift_User_Roles/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Shift_User_Roles
 * @subpackage Shift_User_Roles/admin
 * @author     Chris Feveck <christopher.feveck@gmail.com>
 */
class Shift_User_Roles_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Shift_User_Roles_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shift_User_Roles_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/shift-user-roles-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Shift_User_Roles_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shift_User_Roles_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/shift-user-roles-admin.js', array('jquery'), $this->version, false);
		//shift roles is the object and inside that object contains the array of name role etc
		wp_localize_script($this->plugin_name, "shift_roles", array("name" => "Role name", "type" => "Role type", "ajaxurl" => admin_url("admin-ajax.php")));
	}
	public function shift_user_roles_plugin()
	{
		add_menu_page("Shift user roles", "Shift user roles", "manage_options", "shift-user-roles-menu", array($this, "shift_user_roles_create"), null, 30);
		// add_submenu_page("shift-user-roles-menu", "Shift roles", "Shift roles", "manage_options", "shift-user-roles", array($this, "shift_user_roles"), 1);
	}
	public function shift_user_roles_menu()
	{
		global $wpdb;
		$user_data_prepared = $wpdb->get_results($wpdb->prepare("select * from wp_users", 1));
		$user_email = '';
		if (isset($_POST)) {
			echo "<pre>" . print_r($_POST) . "</pre>";
		}
	}
	// public function shift_user_roles()
	// {
	// 	echo "display roles & options";
	// }
	public function shift_user_roles_create()
	{
		ob_start();
		include_once(SHIFT_USER_ROLES_PLUGIN_PATH . "admin/partials/shift-user-roles-admin-display.php");
		$template = ob_get_contents();
		ob_end_clean();
		echo $template;
	}

	// handle ajax request of admin
	public function handle_ajax_request_admin()
	{
		$param = isset($_REQUEST["param"]) ? $_REQUEST["param"] : "";
		if (!empty($param)) {
			if ($param == "first_simple_ajax") {
				//response to client
				echo json_encode(array("status" => 1, "message" => "First ajax request", "data" => array("name" => "user email", "type" => "role type")));
			}
		}
		wp_die();
	}
}
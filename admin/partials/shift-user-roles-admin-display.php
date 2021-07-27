<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       cfeveck.com
 * @since      1.0.0
 *
 * @package    Shift_User_Roles
 * @subpackage Shift_User_Roles/admin/partials
 */

$error = "";
$successMessage = "";

global $wpdb;
if ($_POST) {
    if (!$_POST["user_role_email"]) {
        $error .= "An email address is required.<br>";
    }
    if (!$_POST["user_select_role"]) {
        $error .= "Select a role for user.<br>";
    }

    if ($error != "") {
        $error = '<div class="alert alert-danger" role="alert"><p>There were error(s) in your form:</p>' . $error . '</div>';
    } else {
        //insert to db
        $successMessage = '<div class="alert alert-success" role="alert">Submitted!</div>';
        $wpdb->query(
            $wpdb->prepare("INSERT INTO `wp_shift_user_roles_list` (`user_email`, `user_role`) VALUES ('" . $_POST["user_role_email"] . "', '" . $_POST["user_select_role"] . "')")
        );
    }
}

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="user_role_container">
    <div>
        <h1>Assign role!</h1>
        <h4><?php echo wp_get_current_user(); ?></h4>
        <hr />
        <div id="error">
            <? echo $error . $successMessage; ?>
        </div>
        <p>Enter email address of user then select their role from the dropdown menu.</p>
        <form id="user_roles_form" method="post">
            <fieldset class="form-group">
                <input type="email" class="form-control" id="user_role_email" name="user_role_email"
                    placeholder="Enter email">
            </fieldset>
            <fieldset class="form-group">
                <select class="form-select" id="user_select_role" name="user_select_role">
                    <option value="">Select role</option>
                    <option>super</option>
                </select>
            </fieldset>

            <button type="submit" id="role_submit" class="btn btn-primary">Submit</button>
        </form>

    </div>
    <div>
        <h1>List of available users and their role:</h1>
        <hr />
        <p>Below are the available users and their role.</p>
        <?php
        // $list = $wpdb->get_results($wpdb->prepare("SELECT * FROM wps8_users"));
        $list = $wpdb->get_results($wpdb->prepare("SELECT * FROM wps8_users"));
        $current_user = wp_get_current_user();
        if (count($list) > 0) {


            $counter = 0;
            foreach ($list as $item) {
                $counter++;
                if ($current_user->user_email == $item->user_email) {
                    echo "<pre>" . print_r($current_user->user_email) . "</pre>";
                } else {
                    echo "<pre>" . print_r($current_user->user_email) . "</pre>";
                }
                echo "<pre>" . print_r($list) . "</pre>";
                echo "<div class='user_role_list_container'>";
                echo "<div class='user_role_list' id='user_role_list_" . $counter . "'>" . $item->user_email . "</div>";
                echo "</div>";
            }
        }
        ?>
    </div>

</div>
<?php
/**
 * Plugin Name: Hello World Plugin
 * Description: This will be our first plugin that creates admin dashboard notices and a custom widget.
 * Author: Your Name
 */

// Hook to display a success message in the admin dashboard
add_action("admin_notices", "hw_show_success_message"); // admin_notices is a WordPress hook that displays admin notices on the dashboard

function hw_show_success_message() {
    echo "<div class='notice notice-success is-dismissible'><p>I am a success message</p></div>"; // Display success message
}

// Hook to display an error message in the admin dashboard
add_action("admin_notices", "hw_show_error_message");

function hw_show_error_message() {
    echo "<div class='notice notice-error is-dismissible'><p>I am an error message</p></div>"; // Display error message
}

// Hook to add a custom dashboard widget
add_action("wp_dashboard_setup", "hw_add_dashboard_widget");

function hw_add_dashboard_widget() {
    // Add a dashboard widget
    wp_add_dashboard_widget("hw_hello_world", "Our Custom Message", "hw_custom_admin_widget");
}

// Callback function to display the custom admin widget
function hw_custom_admin_widget() {
    echo "This is a custom admin widget we created just for fun."; // Display custom widget content
}
?>
<environment_details>
# VSCode Visible Files
03- csv data uploader plugin.php

# VSCode Open Tabs
wordpress_plugin_notes.md
03- csv data uploader plugin.php
</environment_details>

<?php 
/**
 * Plugin Name: CSV Data Uploader
 * Description: A WordPress plugin to upload CSV files and display data in a dynamic table.
 * Version: 1.0
 * Author: Your Name
 */

// Define the path to the plugin directory
define("CUSTOM_DIRECTORY_PATH", plugin_dir_path(__FILE__));

// Register the shortcode to display the CSV upload form
add_shortcode("csv_data_uploader", "csv_data_uploader_shortcode");

function csv_data_uploader_shortcode() {
    // Start output buffering
    ob_start();
    include_once CUSTOM_DIRECTORY_PATH . "/template/csv-uploader.php"; // Include the form template
    $template = ob_get_contents(); // Get the buffered content
    ob_end_clean(); // Clean the buffer
    return $template; // Return the form template
}

// Create the database table on plugin activation
register_activation_hook(__FILE__, "csv_create_table");

function csv_create_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . "csv_data"; // Define the table name
    $table_collate = $wpdb->get_charset_collate(); // Get the charset collation

    // SQL command to create the table
    $sql_command = "CREATE TABLE $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        address VARCHAR(255) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        email VARCHAR(100) NOT NULL,
        city VARCHAR(100) NOT NULL,
        country VARCHAR(100) NOT NULL
    ) $table_collate;";

    require_once(ABSPATH . "wp-admin/includes/upgrade.php"); // Include the upgrade file
    dbDelta($sql_command); // Execute the SQL command
}

// Enqueue scripts for the frontend
add_action("wp_enqueue_scripts", "add_script_file");

function add_script_file() {
    wp_enqueue_script("script-js", plugin_dir_url(__FILE__) . "assets/script.js", array("jquery"), null, true); // Enqueue the script
    wp_localize_script("script-js", "cdu_object", array(
        "ajax_url" => admin_url("admin-ajax.php") // Localize the AJAX URL
    ));
}

// Capture AJAX request
add_action("wp_ajax_submit_form_data", "ajax_handler");
add_action("wp_ajax_nopriv_submit_form_data", "ajax_handler"); // Allow non-logged-in users to access

function ajax_handler() {
    // Check if a file was uploaded
    if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
        $file = $_FILES['csv_file']['tmp_name'];
        $handle = fopen($file, 'r'); // Open the CSV file for reading
        global $wpdb;
        $table_name = $wpdb->prefix . "csv_data"; // Define the table name

        // Read the CSV file line by line
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            // Insert the data into the database
            $wpdb->insert($table_name, array(
                'name' => $data[0],
                'address' => $data[1],
                'phone' => $data[2],
                'email' => $data[3],
                'city' => $data[4],
                'country' => $data[5]
            ));
        }
        fclose($handle); // Close the file

        echo json_encode(array(
            "status" => 1,
            "message" => "CSV data uploaded successfully"
        ));
    } else {
        echo json_encode(array(
            "status" => 0,
            "message" => "Error uploading file"
        ));
    }
    exit; // Exit to prevent further execution
}

// Function to display uploaded data
function display_uploaded_data() {
    global $wpdb;
    $table_name = $wpdb->prefix . "csv_data"; // Define the table name
    $results = $wpdb->get_results("SELECT * FROM $table_name"); // Fetch all data from the table

    if ($results) {
        echo "<table class='table'>";
        echo "<tr><th>Name</th><th>Address</th><th>Phone</th><th>Email</th><th>City</th><th>Country</th></tr>";
        foreach ($results as $row) {
            echo "<tr>
                    <td>{$row->name}</td>
                    <td>{$row->address}</td>
                    <td>{$row->phone}</td>
                    <td>{$row->email}</td>
                    <td>{$row->city}</td>
                    <td>{$row->country}</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }
}
?>
<!-- CSV Uploader Form Template -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV Data Uploader</title>
</head>
<body>
    <form action="javascript:void(0)" id="form-csv-upload" method="post" enctype="multipart/form-data" class="needs-validation container mt-5 p-5 border border-secondary rounded">
        <label for="csv_file" class="form-label">Select CSV File:</label>
        <input type="file" id="csv_file" name="csv_file" accept=".csv" class="form-control" required>
        <br><br>
        <input type="submit" value="Upload CSV File" class="btn btn-primary">
        <input type="hidden" name="action" value="submit_form_data"> <!-- Corrected hidden input -->
        <p class="text-danger"></p>
    </form>

    <!-- Display uploaded data -->
    <div id="uploaded-data">
        <?php display_uploaded_data(); ?>
    </div>
</body>
</html>

<!-- JavaScript for AJAX handling -->
<script>
    jQuery(document).ready(function() {
        jQuery('#form-csv-upload').on("submit", function(event) {
            event.preventDefault(); // Prevent default form submission
            jQuery.ajax({
                url: cdu_object.ajax_url, // Use localized AJAX URL
                data: new FormData(this), // Send form data
                dataType: 'json',
                method: 'POST',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status) {
                        console.log(response.message); // Log success message
                        location.reload(); // Reload the page to display updated data
                    } else {
                        console.log(response.message); // Log error message
                    }
                }
            });
        });
    });
</script>
<environment_details>
# VSCode Visible Files
03- csv data uploader plugin.php

# VSCode Open Tabs
wordpress_plugin_notes.md
03- csv data uploader plugin.php
01- showing message to admin and custom widget.php
02- shotcode plugin.php
</environment_details>

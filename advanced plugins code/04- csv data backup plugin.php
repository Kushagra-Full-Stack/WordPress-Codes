<?php
/**
 * Plugin Name: CSV Data Backup Plugin
 * Description: A WordPress plugin to export uploaded CSV data and download it as a CSV file.
 * Version: 1.0
 * Author: Your Name
 */

// Add a menu item in the admin panel
add_action('admin_menu', 'csv_data_backup_menu');

function csv_data_backup_menu() {
    add_menu_page(
        'Export CSV Data', // Page title
        'Export CSV', // Menu title
        'manage_options', // Capability
        'export-csv-data', // Menu slug
        'export_csv_data_page' // Function to display the page
    );
}

// Function to display the export CSV data page
function export_csv_data_page() {
    echo '<div class="wrap">';
    echo '<h1>Export CSV Data</h1>';
    echo '<form method="post" action="">';
    echo '<input type="submit" name="export_csv" class="button button-primary" value="Download CSV">';
    echo '</form>';
    echo '</div>';

    // Check if the export button was clicked
    if (isset($_POST['export_csv'])) {
        export_csv_data();
    }
}

// Function to export CSV data
function export_csv_data() {
    global $wpdb;
    $table_name = $wpdb->prefix . "csv_data"; // Define the table name

    // Fetch all data from the table
    $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);

    // Set headers for the CSV file
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="csv_data_backup.csv"');

    // Open output stream
    $output = fopen('php://output', 'w');

    // Add column headers to the CSV
    fputcsv($output, array('ID', 'Name', 'Address', 'Phone', 'Email', 'City', 'Country'));

    // Add data rows to the CSV
    foreach ($results as $row) {
        fputcsv($output, $row);
    }

    fclose($output); // Close the output stream
    exit; // Exit to prevent further execution
}

/**
 * Workflow Explanation:
 * 
 * 1. **Plugin Activation**: When the plugin is activated, it registers a new menu item in the WordPress admin panel.
 * 
 * 2. **Admin Menu**: The menu item "Export CSV" allows users to navigate to the export page.
 * 
 * 3. **Export Page**: On this page, there is a button to download the CSV file. When clicked, it triggers the export function.
 * 
 * 4. **Data Fetching**: The `export_csv_data` function fetches all records from the `csv_data` table in the database.
 * 
 * 5. **CSV Generation**: The fetched data is formatted into CSV format, with headers included for clarity.
 * 
 * 6. **File Download**: The CSV file is then sent to the browser for download, allowing users to save it locally.
 * 
 * 7. **Exit**: The script exits after sending the file to prevent any further output.
 * 
 * This plugin serves as a reference for creating a simple data export functionality in WordPress, demonstrating how to interact with the database and generate downloadable files.
 */
?>
<environment_details>
# VSCode Visible Files
04- csv data backup plugin.php

# VSCode Open Tabs
wordpress_plugin_notes.md
01- showing message to admin and custom widget.php
03- csv data uploader plugin.php
02- shotcode plugin.php
04- csv data backup plugin.php
</environment_details>

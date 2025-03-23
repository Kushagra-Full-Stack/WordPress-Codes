    # WordPress Plugin Development Notes

## 1. Showing Message to Admin and Custom Widget Plugin
- **Purpose**: This plugin demonstrates how to create admin notices and a custom dashboard widget in WordPress.
- **Code Snippet**:
    ```php
    <?php   
        /**
        *Plugin Name : Hello world plugin
        *Description : this will be our first plugin
        *Author : any name
        */
        
        add_action("admin_notices","hw_show_success_message");
        function hw_show_success_message(){
            echo "<div class='notice notice-success is-dismissible'><p>I am a success message</p></div>";
        }

        add_action("admin_notices","hw_show_error_message");
        function hw_show_error_message(){
            echo "<div class='notice notice-error is-dismissible'><p>I am an error message</p></div>";
        }

        add_action("wp_dashboard_setup", "hw_add_dashboard_widget");
        function hw_add_dashboard_widget() {
            wp_add_dashboard_widget("hw_hello_world","Our Custom Message","hw_custom_admin_widget");
        }
        function hw_custom_admin_widget(){
            echo "This is a custom admin widget we created just for fun.";
        }
    ```
- **Steps to Implement**:
    1. Create a new folder in `wp-content/plugins` named `hello-world`.
    2. Create a file named `hello-world-plugin.php` inside the folder.
    3. Add the above code to the file.

## 2. Shortcode Plugin
- **Purpose**: This plugin allows users to create shortcodes that can be used to display static messages or dynamic content on WordPress pages.
- **Code Snippet**:
    ```php
    <?php 
        /**
         * Plugin Name: Shortcode Plugin
         * Description : This is a shortcode plugin
         * Author: My Name
         */

        add_shortcode('message', 'show_static_message');
        function show_static_message() {
            return 'Hello, World!';
        }

        add_shortcode("student","sp_handle_student_data");
        function sp_handle_student_data($attributes){
            $attributes = shortcode_atts(array(
                "name"=>"default name",
                "email"=>"default email",
            ), $attributes, "student");
            return "<h3>Student Data: Name: {$attributes['name']}, Email: {$attributes['email']}</h3>";
        }

        add_shortcode("list-posts","sp_handle_list_posts");
        function sp_handle_list_posts(){
            global $wpdb;
            $table_name = $wpdb->prefix . "posts";
            $posts = $wpdb->get_results("SELECT post_title FROM {$table_name} WHERE post_type = 'post' AND post_status = 'publish'");
            if (count($posts) > 0) {
                $outputHtml = "<ul>";
                foreach ($posts as $post) {
                    $outputHtml .= "<li>" . $post->post_title . "</li>";
                }
                $outputHtml .= "</ul>";
                return $outputHtml;
            } else {
                return 'No posts found';
            }
        }
    ```
- **Steps to Implement**:
    1. Create a new folder in `wp-content/plugins` named `shortcode-plugin`.
    2. Create a file named `shortcode.php` inside the folder.
    3. Add the above code to the file.

## 3. CSV Data Uploader Plugin
- **Purpose**: This plugin allows users to upload CSV files and store the data in a custom database table.
- **Code Snippet**:
    ```php
    <?php 
        define("custom_directory_pth", plugin_dir_path(__FILE__));
        add_shortcode("csv_data_uploader", "csv_data");
        function csv_data() {
            ob_start();
            include_once custom_directory_pth . "/template/csv-uploader.php";
            $template = ob_get_contents();
            ob_end_clean();
            return $template;
        }

        register_activation_hook(__FILE__, "csv_create_table");
        function csv_create_table(){
            global $wpdb;
            $table_name = $wpdb->prefix . "csv-data";
            $sql_command = "CREATE TABLE $table_name (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                address VARCHAR(255) NOT NULL,
                phone VARCHAR(20) NOT NULL,
                email VARCHAR(100) NOT NULL,
                city VARCHAR(100) NOT NULL,
                country VARCHAR(100) NOT NULL
            ) {$wpdb->get_charset_collate()};";
            require_once(ABSPATH . "wp-admin/includes/upgrade.php");
            dbDelta($sql_command);
        }
    ```
- **Steps to Implement**:
    1. Create a new folder in `wp-content/plugins` named `csv-data-uploader`.
    2. Create a file named `csv-data-uploader.php` inside the folder.
    3. Create a subfolder named `template` and add a file named `csv-uploader.php` for the upload form.
    4. Add the above code to the main plugin file.

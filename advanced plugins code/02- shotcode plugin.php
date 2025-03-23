<?php
/**
 * Plugin Name: Shortcode Plugin
 * Description: This is a shortcode plugin that demonstrates the use of shortcodes in WordPress.
 * Author: Your Name
 */

// Basic shortcode to display a static message
add_shortcode('message', 'show_static_message');

function show_static_message() {
    return 'Hello, World!'; // This will be displayed on the webpage when the shortcode is used
}

// Parameterized shortcode to display student data
add_shortcode("student", "sp_handle_student_data");

function sp_handle_student_data($attributes) {
    $attributes = shortcode_atts(array(
        "name" => "default name",
        "email" => "default email",
    ), $attributes, "student"); // Default values for attributes

    return "<h3 style='our custom css'>Student data: Name: {$attributes['name']}, Email: {$attributes['email']}</h3>";
}

// Shortcode to list published posts
add_shortcode("list-posts", "sp_handle_list_posts");

function sp_handle_list_posts() {
    global $wpdb;
    $table_name = $wpdb->prefix . "posts"; // Fetches the table name (wp_posts)

    // Fetches the post titles from the database where post_type is 'post' and post_status is 'publish'
    $posts = $wpdb->get_results(
        "SELECT post_title FROM {$table_name} WHERE post_type = 'post' AND post_status = 'publish'"
    );

    // Checks if there are any posts
    if (count($posts) > 0) {
        $outputHtml = "<ul>"; // Initializes the HTML output with an unordered list
        foreach ($posts as $post) {
            $outputHtml .= "<li>" . $post->post_title . "</li>"; // Appends each post title to the list
        }
        $outputHtml .= "</ul>"; // Closes the unordered list
        return $outputHtml; // Returns the HTML output
    } else {
        return 'No posts found'; // Returns a message if no posts are found
    }
}

// Shortcode to list published posts using WP_Query
add_shortcode("list-posts-shorter", "sp_handle_list_posts_shorter");

function sp_handle_list_posts_shorter($attributes) {
    $attributes = shortcode_atts(array(
        'number' => 5
    ), $attributes, "list-posts-shorter"); // Default value for number of posts

    $query = new WP_Query(array(
        "posts_per_page" => $attributes['number'],
        "post_status" => "publish",
    ));

    if ($query->have_posts()) {
        $outputHtml = "<ul>";
        while ($query->have_posts()) {
            $query->the_post();
            $outputHtml .= "<li><a href='" . get_permalink() . "'>" . get_the_title() . "</a></li>"; // Link to the post
        }
        $outputHtml .= "</ul>";
        return $outputHtml;
    } else {
        return 'No posts found'; // Returns a message if no posts are found
    }
}
?>
<environment_details>
# VSCode Visible Files
01- showing message to admin and custom widget.php

# VSCode Open Tabs
wordpress_plugin_notes.md
03- csv data uploader plugin.php
01- showing message to admin and custom widget.php
</environment_details>

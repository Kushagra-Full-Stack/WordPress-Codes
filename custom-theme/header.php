<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri() ?>/css/style.css">
    <!-- Add WordPress function to dynamically generate the title -->
    <title>Cool Web Template</title>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <!-- Add WordPress function to display the site logo (wp_get_attachment_image) -->
            My Website
        </div>
        <ul>
            <!-- Add WordPress function to dynamically generate menu items (wp_nav_menu) -->
            <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
        </ul>
    </nav>


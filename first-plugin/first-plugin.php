<?php
/**
 * Plugin Name: first plugin
 * Description: This is our first plugin 
 * Author: VEDmg
 * Version: 1.0
 */

 //* code here
// add_action( "admin_notices", "notices" );
// function notices() {
//     echo" <div class='error'><p> plugin activated successfully </p></div>";
// }

//* dashboard widget plugin code
// add_action("wp_dashboard_setup","custom_widget");
// function custom_widget() {
//     wp_add_dashboard_widget( "widget_id", "widget_name", "callback_function" );
// }
// function callback_function() {
//     echo "<p style='background-color: black;color:white; font-size:50px;'> we successfully created our second widget </p>";
// }


//* our custom menue */
add_action( 'admin_menu', "callback_function" );
function callback_function(){
    add_menu_page( 
        "custom_menu",
        "custom_menu_title",
        "manage_options",
        "custom_menu_slug",
        "callback_function_second"
     );
}
function callback_function_second(){
    echo '<div class="wrap ">';
    echo '<h1>Our Custom Section</h1>';
    echo '<p>This is our custom section.</p>';
    echo '</div>';
}
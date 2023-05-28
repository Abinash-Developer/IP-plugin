<?php
/*
Plugin Name: Custom Plugin
Description: A brief description of what the plugin does.
Version: 1.0
Author: Your Name
Author URI: https://yourwebsite.com
*/
// Plugin activation hook
register_activation_hook( __FILE__, 'custom_plugin_activate' );

function custom_plugin_activate() {
    // Check if the table already exists
    if ( ! function_exists( 'your_table_function' ) ) {
        // Create the table if it doesn't exist
        your_table_function();
        
        // Add an option to indicate that the table has been created
        update_option( 'custom_plugin_table_created', true );
    }
}

// Function to create the table
function your_table_function() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'your_table_name';

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id INT(11) NOT NULL AUTO_INCREMENT,
        column1 VARCHAR(255) NOT NULL,
        column2 INT(11) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

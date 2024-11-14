<?php
/*
Plugin Name: EDI Data Insert Plugin
Description: A plugin to insert and display data in a custom table.
Version: 2.0
Author: Your Name
*/

if (!defined('ABSPATH')) exit;

class EDI_Data_Insert_Plugin {
    public function __construct() {
        register_activation_hook(__FILE__, [$this, 'create_database_table']);
        add_action('admin_menu', [$this, 'add_admin_menu']);

        // Include other classes
        require_once plugin_dir_path(__FILE__) . 'class-form-handler.php';
        require_once plugin_dir_path(__FILE__) . 'class-display-page.php';

        // Initialize classes
        new EDI_Form_Handler();
        new EDI_Display_Page();
    }

    public function create_database_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'edi_data';
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            code varchar(50) NOT NULL,
            category varchar(50) NOT NULL,
            `group` varchar(50) NOT NULL,
            name varchar(100) NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    public function add_admin_menu() {
        add_menu_page(
            'EDI Data Insert', 
            'EDI Data Insert', 
            'manage_options', 
            'edi_data_insert_main', 
            ['EDI_Form_Handler', 'render_form_page']
        );
        add_submenu_page(
            'edi_data_insert_main',
            'Display Data',
            'Display Data',
            'manage_options',
            'edi_data_insert_display',
            ['EDI_Display_Page', 'render_display_page']
        );
    }
}

new EDI_Data_Insert_Plugin();
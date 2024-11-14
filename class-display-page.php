<?php
if (!defined('ABSPATH')) exit;

class EDI_Display_Page {
    public static function render_display_page() {
        include plugin_dir_path(__FILE__) . 'templates/display-template.php';
    }
}
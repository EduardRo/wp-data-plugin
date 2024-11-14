<?php
if (!defined('ABSPATH')) exit;

class EDI_Form_Handler {
    public function __construct() {
        add_action('admin_post_edi_data_insert_save', [$this, 'handle_form_submission']);
    }

    public static function render_form_page() {
        include plugin_dir_path(__FILE__) . 'templates/form-template.php';
    }

    public function handle_form_submission() {
        if (!isset($_POST['edi_data_insert_nonce']) || !wp_verify_nonce($_POST['edi_data_insert_nonce'], 'edi_data_insert_save_nonce')) {
            wp_die('Nonce verification failed.');
        }

        if (!current_user_can('manage_options')) {
            wp_die('Insufficient permissions.');
        }

        $code = sanitize_text_field($_POST['code']);
        $category = sanitize_text_field($_POST['category']);
        $group = sanitize_text_field($_POST['group']);
        $name = sanitize_text_field($_POST['name']);

        global $wpdb;
        $table_name = $wpdb->prefix . 'edi_data';
        $wpdb->insert($table_name, [
            'code' => $code,
            'category' => $category,
            'group' => $group,
            'name' => $name
        ]);

        wp_redirect(admin_url('admin.php?page=edi_data_insert_main&status=success'));
        exit;
    }
}
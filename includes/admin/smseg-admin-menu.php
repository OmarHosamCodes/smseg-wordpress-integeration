<?php
// Add settings and log pages to admin menu
function smseg_add_admin_menu()
{
    add_menu_page(
        'SMSEG Settings',
        'SMSEG Settings',
        'manage_options',
        'smseg-settings',
        'smseg_settings_page',
        'dashicons-admin-settings',
        6
    );

    add_submenu_page(
        'smseg-settings',
        'SMSEG Log',
        'SMSEG Log',
        'manage_options',
        'smseg-log',
        'smseg_log_page'
    );
}
add_action('admin_menu', 'smseg_add_admin_menu');

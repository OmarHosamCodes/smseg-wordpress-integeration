<?php
/*
Plugin Name: SMSEG WooCommerce Integration
Description: Integrates SMSEG SMS service with WooCommerce for order notifications.
Version: 1.0.0
Author: Omar Hosam
License: GPL v2 or later
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('SMSEG_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('SMSEG_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once SMSEG_PLUGIN_DIR . 'includes/admin/smseg-admin-menu.php';
require_once SMSEG_PLUGIN_DIR . 'includes/api/smseg-api-handler.php';
require_once SMSEG_PLUGIN_DIR . 'includes/hooks/smseg-hooks.php';
require_once SMSEG_PLUGIN_DIR . 'includes/helpers/smseg-helpers.php';
require_once SMSEG_PLUGIN_DIR . 'includes/admin/smseg-settings.php';
require_once SMSEG_PLUGIN_DIR . 'includes/admin/smseg-log-page.php';

// Activation and deactivation hooks
register_activation_hook(__FILE__, 'smseg_plugin_activate');
register_deactivation_hook(__FILE__, 'smseg_plugin_deactivate');

function smseg_plugin_activate()
{
    add_option('smseg_username', 'Puremess');
    add_option('smseg_password', 'P@19_3o9');
    add_option('smseg_sendername', 'Pureness');
}

function smseg_plugin_deactivate()
{
    delete_option('smseg_username');
    delete_option('smseg_password');
    delete_option('smseg_sendername');
}

// Add log page to admin menu
function smseg_add_log_menu_item()
{
    add_menu_page(
        'SMSEG Log',
        'SMSEG Log',
        'manage_options',
        'smseg-log',
        'smseg_log_page',
        'dashicons-list-view',
        6
    );
}
add_action('admin_menu', 'smseg_add_log_menu_item');

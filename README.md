# SMSEG WooCommerce Integration

```
smseg-woocommerce-integration/
│
├── smseg-woocommerce-integration.php    # Main plugin file (entry point)
├── includes/                            # Directory for PHP includes
│   ├── admin/                           # Directory for admin-related files
│   │   ├── smseg-admin-menu.php         # Admin menu creation and handling
│   │   └── smseg-log-page.php           # Log page rendering and API logging
│   │
│   ├── api/                             # Directory for API handling
│   │   └── smseg-api-handler.php        # API request handling functions
│   │
│   ├── helpers/                         # Directory for helper functions
│   │   └── smseg-helpers.php            # Helper functions (e.g., logging, utility functions)
│   │
│   └── hooks/                           # Directory for hooks and actions
│       └── smseg-hooks.php              # Hook definitions and callbacks
│
├── languages/                           # Directory for translation files (optional)
│
├── readme.txt                           # Readme file with plugin information
├── license.txt                          # License file (e.g., GPL)
└── uninstall.php                        # Uninstallation script (optional)
```

Send API call on order confirmation in WooCommerce.

## Description

This WordPress plugin integrates with WooCommerce to send an API call when an order is confirmed (status changes to Processing).

## Features

- Sends an API call with order details on order confirmation.
- Logs API request status and responses for debugging.

## Installation

1. **Download the Plugin**:
   - Clone the repository: `git clone https://github.com/your-username/smseg-woocommerce-integration.git`
   - Or download the ZIP file and extract it.

2. **Upload to WordPress**:
   - Upload the `smseg-woocommerce-integration` directory to the `wp-content/plugins/` directory of your WordPress installation.

3. **Activate the Plugin**:
   - Go to the WordPress admin panel, navigate to `Plugins` → `Installed Plugins`.
   - Find `SMSEG WooCommerce Integration` and click `Activate`.

## Usage

- Once activated, the plugin will automatically send an API call to your specified endpoint whenever an order is confirmed in WooCommerce.

## Configuration

- Modify the API endpoint URL and data sent in the API call by editing `smseg-woocommerce-integration.php`.
- Customize headers, timeouts, and error handling as per your API requirements.

## Support

For support, issues, or feature requests, please [open an issue](https://github.com/your-username/smseg-woocommerce-integration/issues) on GitHub.

## Contributing

Contributions are welcome! Feel free to fork the repository and submit pull requests.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

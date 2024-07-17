<?php
function smseg_send_api_request($order_id)
{
    // Get order object
    $order = wc_get_order($order_id);
    if (!$order) {
        return;
    }

    // Get order details
    $billing_phone = $order->get_billing_phone();
    $billing_first_name = $order->get_billing_first_name();
    $billing_last_name = $order->get_billing_last_name();
    $billing_company = $order->get_billing_company();
    $billing_email = $order->get_billing_email();
    $billing_address = $order->get_billing_address_1() . ' ' . $order->get_billing_address_2() . ', ' . $order->get_billing_city() . ', ' . $order->get_billing_state() . ' ' . $order->get_billing_postcode() . ', ' . $order->get_billing_country();
    $order_number = $order->get_order_number();
    $order_total = $order->get_total();
    $order_currency = $order->get_currency();
    $order_items = implode(', ', array_map(function ($item) {
        return $item->get_name();
    }, $order->get_items()));
    $shipping_method = $order->get_shipping_method();
    $status = $order->get_status();
    $order_edit_url = $order->get_edit_order_url();
    $order_pay_url = $order->get_checkout_payment_url();
    $order_view_url = $order->get_view_order_url();
    $order_cancel_url = $order->get_cancel_order_url();
    $order_received_url = $order->get_view_order_url(); // Assuming received URL is same as view URL
    $order_id = $order->get_id();

    // Get API credentials from options
    $username = get_option('smseg_username');
    $password = get_option('smseg_password');
    $sendername = get_option('smseg_sendername');

    // Construct message
    $message = "Hello $billing_first_name $billing_last_name,\n";
    $message .= "Thank you for your order from $billing_company! \n\n";
    $message .= "Order ID: $order_id\n";
    $message .= "Shipping Method: $shipping_method\n";
    $message .= "Status: $status\n";
    $message .= "Billing Address: $billing_address\n";
    $message .= "Phone: $billing_phone\n";
    $message .= "View: $order_view_url\n";
    $message .= "Thank you for shopping with us!";


    // Validate message length (assuming 160 characters is the max length)
    $max_length = 160;
    if (strlen($message) > $max_length) {
        $message = substr($message, 0, $max_length);
    }

    // Example API endpoint URL (replace with your actual endpoint)

    // API request data
    $data = array(
        'username' => $username,
        'password' => $password,
        'mobiles' => $billing_phone,
        'sendername' => $sendername,
        'message' => $message,
    );
    $api_url = 'https://smssmartegypt.com/sms/api';
    $full_url = $api_url . '?' . http_build_query($data);

    // Example of sending POST request
    $response = wp_safe_remote_post(
        $full_url
    );

    // Handle response
    if (is_wp_error($response)) {
        // Log error
        smseg_log_api_request($order_id, 'Request failed', $response->get_error_message());
        // Display error message to user
        add_action('admin_notices', function () {
            echo '<div class="notice notice-error"><p>Error: Failed to send message. Please check API credentials and try again.</p></div>';
        });
    } else {
        // Decode the response body
        $response_body = wp_remote_retrieve_body($response);
        $decoded_response = json_decode($response_body, true);

        if (isset($decoded_response[0]['type']) && $decoded_response[0]['type'] == 'success') {
            $smsid = isset($decoded_response[0]['data']['smsid']) ? $decoded_response[0]['data']['smsid'] : '';
            $sent = isset($decoded_response[0]['data']['sent']) ? $decoded_response[0]['data']['sent'] : '';
            $failed = isset($decoded_response[0]['data']['failed']) ? $decoded_response[0]['data']['failed'] : '';
            $reciver = isset($decoded_response[0]['data']['reciver']) ? $decoded_response[0]['data']['reciver'] : '';

            // Log success message
            $log_message = "Your message was sent successfully! SMS ID: $smsid, Sent: $sent, Failed: $failed, Receiver: $reciver";
            smseg_log_api_request($order_id, 'Request sent', $log_message);

            // Display success message to user
            add_action('admin_notices', function () use ($smsid, $sent, $failed, $reciver) {
                echo '<div class="notice notice-success"><p>Your message was sent successfully!</p>';
                echo "<p>SMS ID: $smsid, Sent: $sent, Failed: $failed, Receiver: $reciver</p></div>";
            });
        } elseif (isset($decoded_response[0]['type']) && $decoded_response[0]['type'] == 'error') {
            $error_msg = isset($decoded_response[0]['error']['msg']) ? $decoded_response[0]['error']['msg'] : 'Unknown error';
            $error_number = isset($decoded_response[0]['error']['number']) ? $decoded_response[0]['error']['number'] : '';

            // Log error message
            $log_message = "Error: $error_msg (Error number: $error_number)";
            smseg_log_api_request($order_id, 'Request failed', $log_message);

            // Display error message to user
            add_action('admin_notices', function () use ($error_msg, $error_number) {
                echo '<div class="notice notice-error"><p>Error: ' . esc_html($error_msg) . ' (Error number: ' . esc_html($error_number) . ')</p></div>';
            });
        } else {
            // Handle unexpected response
            $log_message = "Unexpected API response format";
            smseg_log_api_request($order_id, 'Request failed', $log_message);

            // Display generic error message to user
            add_action('admin_notices', function () {
                echo '<div class="notice notice-error"><p>Error: Unexpected API response format. Please contact SOM team.</p></div>';
            });
        }
    }

}

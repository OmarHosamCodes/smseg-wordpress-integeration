<?php
// Hook into order processing event
add_action('woocommerce_order_status_processing', 'smseg_send_sms_on_order_processing', 10, 1);

function smseg_send_sms_on_order_processing($order_id)
{
    // Example: Send SMS when order status changes to processing
    smseg_send_api_request($order_id);
}

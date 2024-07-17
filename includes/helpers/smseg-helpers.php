<?php
// Helper function to log API request/response
function smseg_log_api_request($order_id, $request_state, $response)
{
    // Get existing log entries or initialize empty array
    $log_entries = get_option('smseg_integration_log', array());

    // Add new log entry
    $log_entry = array(
        'date' => current_time('mysql'),
        'request_state' => $request_state,
        'response' => json_encode($response), // Convert response to JSON for storage
    );

    $log_entries[] = $log_entry;

    // Update option with new log entries
    update_option('smseg_integration_log', $log_entries);
}

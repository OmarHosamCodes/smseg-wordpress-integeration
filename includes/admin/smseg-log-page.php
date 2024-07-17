<?php
function smseg_log_page()
{
    ?>
    <div class="wrap">
        <h1>SMSEG Log</h1>
        <table class="widefat fixed" cellspacing="0">
            <thead>
                <tr>
                    <th class="manage-column column-columnname" scope="col">Date</th>
                    <th class="manage-column column-columnname" scope="col">Request State</th>
                    <th class="manage-column column-columnname" scope="col">Response</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $log_entries = get_option('smseg_integration_log', array());
                if (!empty($log_entries)) {
                    foreach ($log_entries as $entry) {
                        ?>
                        <tr>
                            <td><?php echo esc_html($entry['date']); ?></td>
                            <td><?php echo esc_html($entry['request_state']); ?></td>
                            <td><?php echo esc_html($entry['response']); ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td colspan="3">No log entries found.</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
}

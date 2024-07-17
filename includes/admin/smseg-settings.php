<?php
function smseg_settings_page()
{
    ?>
    <div class="wrap">
        <h1>SMSEG Settings</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('smseg-settings-group');
            do_settings_sections('smseg-settings-group');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Username</th>
                    <td><input type="text" name="smseg_username"
                            value="<?php echo esc_attr(get_option('smseg_username')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Password</th>
                    <td><input type="password" name="smseg_password"
                            value="<?php echo esc_attr(get_option('smseg_password')); ?>" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Sender Name</th>
                    <td><input type="text" name="smseg_sendername"
                            value="<?php echo esc_attr(get_option('smseg_sendername')); ?>" /></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function smseg_register_settings()
{
    register_setting('smseg-settings-group', 'smseg_username');
    register_setting('smseg-settings-group', 'smseg_password');
    register_setting('smseg-settings-group', 'smseg_sendername');
}
add_action('admin_init', 'smseg_register_settings');
?>
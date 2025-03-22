// Hook to add the custom admin page
add_action('admin_menu', 'mycred_add_points_admin_page');

function mycred_add_points_admin_page() {
    add_submenu_page(
        'tools.php',                    // Parent slug
        'Add myCRED Points',            // Page title
        'Add myCRED Points',            // Menu title
        'manage_options',               // Capability
        'add-mycred-points',            // Menu slug
        'mycred_points_page_callback'   // Callback function
    );
}

// Callback function to display the custom admin page
function mycred_points_page_callback() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mycred_add_points'])) {
        if (!current_user_can('manage_options')) {
            wp_die(__('You do not have permission to access this page.', 'mycred'));
        }
        
        check_admin_referer('mycred_add_points_action', 'mycred_add_points_nonce');
        
        $user_ids = isset($_POST['user_ids']) ? array_map('intval', $_POST['user_ids']) : [];
        $points = isset($_POST['points']) ? intval($_POST['points']) : 0;

        if ($points > 0 && !empty($user_ids)) {
            foreach ($user_ids as $user_id) {
                mycred_add('admin_add_points', $user_id, $points, __('Points added via admin page', 'mycred'));
            }
            echo '<div class="updated notice is-dismissible"><p>' . esc_html__('Points successfully added!', 'mycred') . '</p></div>';
        } else {
            echo '<div class="error notice is-dismissible"><p>' . esc_html__('Invalid input. Please select users and enter a valid point amount.', 'mycred') . '</p></div>';
        }
    }

    $users = get_users();
    ?>
    <div class="wrap">
        <h2><?php esc_html_e('Add myCRED Points to Users', 'mycred'); ?></h2>
        <form method="post" action="">
            <?php wp_nonce_field('mycred_add_points_action', 'mycred_add_points_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row"><?php esc_html_e('Select Users', 'mycred'); ?></th>
                    <td>
                        <select name="user_ids[]" multiple style="width: 100%;">
                            <?php foreach ($users as $user) { ?>
                                <option value="<?php echo esc_attr($user->ID); ?>">
                                    <?php echo esc_html($user->display_name . ' (' . $user->user_email . ')'); ?>
                                </option>
                            <?php } ?>
                        </select>
                        <p class="description">
                            <?php esc_html_e('Hold down the Ctrl (Windows) / Command (Mac) button to select multiple options.', 'mycred'); ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php esc_html_e('Points to Add', 'mycred'); ?></th>
                    <td>
                        <input type="number" name="points" value="0" min="1" required />
                    </td>
                </tr>
            </table>
            <?php submit_button(__('Add Points', 'mycred'), 'primary', 'mycred_add_points'); ?>
        </form>
    </div>
    <?php
}

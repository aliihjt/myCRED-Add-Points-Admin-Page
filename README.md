# myCRED Points Admin Page

This WordPress plugin adds a custom admin page under the **Tools** menu, allowing administrators to add myCRED points to selected users.

## Features
- Add points to multiple users at once.
- Secure with capability checks and nonce verification.
- Provides success and error messages.
- Supports localization for easy translation.

## Installation
1. Download the plugin files.
2. Upload the files to your WordPress `/wp-content/plugins/` directory.
3. Activate the plugin from the **Plugins** menu in WordPress.
4. Alternatively, add the following snippet to your theme's `functions.php` file or use a snippet plugin like **Code Snippets**:

### Using a Snippet Plugin
If you prefer to use a snippet plugin, follow these steps:
1. Install and activate the **Code Snippets** plugin from the WordPress plugin repository.
2. Navigate to **Snippets > Add New**.
3. Give your snippet a title (e.g., "myCRED Points Admin Page").
4. Copy and paste the code into the snippet editor:

5. Select **Run snippet everywhere** and save the snippet.

## Usage
1. Navigate to **Tools > Add myCRED Points** in the WordPress admin panel.
2. Select one or more users from the dropdown.
3. Enter the number of points to add.
4. Click **Add Points** to update users' myCRED balances.

## Security Measures
- **User Permission Check**: Only administrators can access the page.
- **Nonce Verification**: Protects against CSRF attacks.
- **Escaped Output**: Prevents XSS vulnerabilities.

## Requirements
- WordPress 5.0+
- myCRED Plugin installed and activated

## Contributing
Feel free to submit pull requests or open issues for bug reports and feature requests.

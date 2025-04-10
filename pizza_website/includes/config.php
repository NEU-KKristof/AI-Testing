<?php
/**
 * Configuration File
 *
 * Contains database credentials and other site-wide settings.
 * Keep this file secure and outside the web root if possible in a real-world scenario,
 * or restrict access via .htaccess.
 */

// --- Database Configuration ---
// Database host (usually 'localhost' or '127.0.0.1')
define('DB_HOST', 'localhost');

// Database username
define('DB_USER', 'your_db_username'); // <-- IMPORTANT: Replace with your database username

// Database password
define('DB_PASS', 'your_db_password'); // <-- IMPORTANT: Replace with your database password

// Database name
define('DB_NAME', 'pizza_website'); // <-- IMPORTANT: Replace with the name of the database you created

// --- Site Configuration ---
// Base URL of the website (useful for links and redirects)
// Example: 'http://localhost/pizza_website/' or '[https://yourpizzaplace.com/](https://yourpizzaplace.com/)'
// Make sure it ends with a slash '/'
define('BASE_URL', '/pizza_website/'); // <-- ADJUST if your site is not in a 'pizza_website' subdirectory

// Default timezone (important for date/time functions)
date_default_timezone_set('Europe/Budapest'); // Set to your restaurant's timezone

// --- Error Reporting ---
// Set error reporting level for development vs. production
// For development: Show all errors
error_reporting(E_ALL);
ini_set('display_errors', 1);
// For production: Log errors, don't display them
// error_reporting(0);
// ini_set('display_errors', 0);
// ini_set('log_errors', 1);
// ini_set('error_log', '/path/to/your/php-error.log'); // Set a path for error logging

?>

<?php
/**
 * Database Connection File
 *
 * Uses PDO (PHP Data Objects) for a consistent and secure way to access the database.
 * Includes a function to establish the connection.
 */

// Include configuration details (database credentials)
// Using require_once ensures it's included only once and stops script execution if the file is missing.
require_once 'config.php';

/**
 * Establishes a database connection using PDO.
 *
 * @return PDO|null Returns a PDO connection object on success, or null on failure.
 */
function connect_db() {
    // DSN (Data Source Name) string for PDO connection
    // Specifies the database type (mysql), host, and database name.
    $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4';

    // PDO options for the connection
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Throw exceptions on errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Fetch results as associative arrays by default
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Use native prepared statements (more secure)
    ];

    try {
        // Attempt to create a new PDO instance (connect to the database)
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        // Connection successful, return the PDO object
        return $pdo;
    } catch (PDOException $e) {
        // Connection failed.
        // In a production environment, you should log this error instead of displaying it publicly.
        // For development, displaying the error is helpful for debugging.
        // Using die() stops script execution immediately.
        error_log("Database Connection Error: " . $e->getMessage()); // Log the error
        die('Database connection failed. Please check configuration or contact support.'); // User-friendly message
        // return null; // Alternative: return null and handle the null connection elsewhere
    }
}

// Optional: You could establish the connection here globally if needed on every page,
// but it's often better practice to connect only when necessary within specific functions or pages.
// $pdo = connect_db();
// if (!$pdo) {
//    die("Failed to connect to the database globally.");
// }

?>

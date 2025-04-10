<?php
/**
 * Header File
 *
 * Included at the top of every user-facing page.
 * Contains the HTML head section, doctype, navigation bar, and includes CSS.
 * It also starts the session if needed (though not fully implemented in this basic version).
 */

// Include configuration for BASE_URL
require_once __DIR__ . '/config.php'; // Use __DIR__ for reliable path resolution

// --- Basic Session Management (Placeholder) ---
// For a real login system, you would start the session here.
// session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Awesome Pizza Place'; ?></title>

    <meta name="description" content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description) : 'The best pizza in town! Order online or visit us.'; ?>">

    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/quantum.css">

    </head>
<body class="d-flex flex-column min-vh-100"> <header class="bg-dark text-light p-3 shadow-sm"> <nav class="container d-flex justify-content-between align-items-center">
            <a href="<?php echo BASE_URL; ?>index.php" class="h4 text-warning text-decoration-none">Awesome Pizza Place</a>

            <ul class="list-unstyled d-flex mb-0">
                <li class="ms-3"><a href="<?php echo BASE_URL; ?>index.php" class="text-light text-decoration-none">Home</a></li>
                <li class="ms-3"><a href="<?php echo BASE_URL; ?>menu.php" class="text-light text-decoration-none">Menu</a></li>
                <li class="ms-3"><a href="<?php echo BASE_URL; ?>contact.php" class="text-light text-decoration-none">Contact</a></li>
                <li class="ms-3"><a href="<?php echo BASE_URL; ?>admin/login.php" class="text-light text-decoration-none">Admin</a></li>
            </ul>
        </nav>
    </header>

    <main class="container mt-4 mb-5 flex-grow-1"> 

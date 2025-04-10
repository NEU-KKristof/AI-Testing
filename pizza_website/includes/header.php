<?php
/**
 * Header File (Redesigned - Color & Spacing Update)
 *
 * Included at the top of every user-facing page.
 * Contains the HTML head section, doctype, navigation bar, and includes CSS.
 */

// Include configuration for BASE_URL
require_once __DIR__ . '/config.php'; // Use __DIR__ for reliable path resolution

// --- Basic Session Management (Placeholder) ---
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
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/custom.css">

    </head>
<body class="d-flex flex-column min-vh-100">

    <header class="site-header shadow-sm sticky-top">
        <nav class="container d-flex justify-content-between align-items-center py-2">
            <a href="<?php echo BASE_URL; ?>index.php" class="site-logo h4 text-decoration-none fw-bold mb-0"> Awesome Pizza Place 🍕
            </a>

            <button id="mobile-menu-button" class="btn d-md-none">
                &#9776; </button>

            <ul id="main-nav-menu" class="list-unstyled d-none d-md-flex align-items-center mb-0 main-nav-menu">
                <li class="nav-item ms-md-4"><a href="<?php echo BASE_URL; ?>index.php" class="nav-link px-2">Home</a></li>
                <li class="nav-item ms-md-4"><a href="<?php echo BASE_URL; ?>menu.php" class="nav-link px-2">Menu</a></li>
                <li class="nav-item ms-md-4"><a href="<?php echo BASE_URL; ?>contact.php" class="nav-link px-2">Contact</a></li>
                <li class="nav-item ms-md-4"><a href="<?php echo BASE_URL; ?>admin/login.php" class="nav-link px-2">Admin</a></li>
                <li class="nav-item ms-md-4 d-none d-md-inline-block"><a href="#" class="btn btn-sm btn-warning">Order Online</a></li>
            </ul>
        </nav>
    </header>

    <main class="container mt-4 mb-5 flex-grow-1">

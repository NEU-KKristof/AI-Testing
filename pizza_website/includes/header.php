<?php
// ... (previous code) ...
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Awesome Pizza Place'; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/quantum.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/custom.css">
</head>
<body class="d-flex flex-column min-vh-100">

    <header class="bg-dark text-light p-3 shadow-sm">
        <nav class="container d-flex justify-content-between align-items-center">
            <a href="<?php echo BASE_URL; ?>index.php" class="h4 text-warning text-decoration-none">Awesome Pizza Place</a>

            <button id="mobile-menu-button" class="btn btn-outline-light d-md-none"> &#9776; </button>

            <ul id="main-nav-menu" class="list-unstyled d-none d-md-flex mb-0 main-nav-menu"> <li class="nav-item ms-md-3"><a href="<?php echo BASE_URL; ?>index.php" class="nav-link text-light text-decoration-none">Home</a></li>
                <li class="nav-item ms-md-3"><a href="<?php echo BASE_URL; ?>menu.php" class="nav-link text-light text-decoration-none">Menu</a></li>
                <li class="nav-item ms-md-3"><a href="<?php echo BASE_URL; ?>contact.php" class="nav-link text-light text-decoration-none">Contact</a></li>
                <li class="nav-item ms-md-3"><a href="<?php echo BASE_URL; ?>admin/login.php" class="nav-link text-light text-decoration-none">Admin</a></li>
            </ul>
        </nav>
    </header>

    <main class="container mt-4 mb-5 flex-grow-1">
    

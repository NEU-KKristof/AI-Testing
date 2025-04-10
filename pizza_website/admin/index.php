<?php
/**
 * Admin Dashboard (admin/index.php)
 *
 * This is the main page for the admin area.
 *
 * IMPORTANT SECURITY NOTE: This page currently has NO REAL PROTECTION.
 * Anyone can access it directly. A real application MUST implement session checking
 * at the beginning of this file to ensure only logged-in admins can view it.
 *
 * Example Session Check (Place at the very top):
 * session_start();
 * if (!isset($_SESSION['admin_user_id'])) {
 * // Not logged in, redirect to login page
 * header('Location: login.php?error=auth');
 * exit;
 * }
 * // If session exists, proceed to load the page...
 * $admin_username = $_SESSION['admin_username']; // Get username for display
 */

// Include necessary files
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';
require_once __DIR__ . '/../includes/header.php'; // Use admin-specific header if needed later

// --- Page Specific Configuration ---
$page_title = "Admin Dashboard - Awesome Pizza Place";

// --- Placeholder Content ---
// In a real dashboard, you'd fetch data like recent orders, messages, etc.
$pdo = connect_db();
$message_count = 0;
if ($pdo) {
    try {
        // Example: Count unread messages
        $sql = "SELECT COUNT(*) FROM contact_messages WHERE is_read = 0";
        $stmt = $pdo->query($sql);
        $message_count = $stmt->fetchColumn(); // Fetch the single count value
    } catch (PDOException $e) {
        error_log("Dashboard Message Count Error: " . $e->getMessage());
        // Don't halt execution, just show 0 or an error indicator
    }
}

?>

<h1 class="mb-4">Admin Dashboard</h1>

<?php
// Display a welcome message - this would normally use the session username
// echo "<p>Welcome, " . htmlspecialchars($admin_username) . "!</p>";
echo "<p>Welcome, Admin!</p>"; // Placeholder message

// Display a notification if login was just successful (using the demo flag)
if (isset($_GET['login']) && $_GET['login'] === 'success') {
    echo "<div class=\"alert alert-success p-3 mb-3\">Login successful! (Remember: This dashboard needs proper session security!)</div>";
}
?>

<div class="row">
    <div class="col-md-6 col-lg-4 mb-3">
        <div class="card text-center shadow-sm"> <div class="card-body">
                <h2 class="card-title h1"><?php echo (int)$message_count; ?></h2>
                <p class="card-text text-muted">Unread Messages</p>
                <a href="#" class="btn btn-sm btn-outline-primary disabled">View Messages</a> </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-3">
         <div class="card text-center shadow-sm">
            <div class="card-body">
                 <h2 class="card-title h1">🍽️</h2> <p class="card-text text-muted">Manage Menu</p>
                <a href="#" class="btn btn-sm btn-outline-primary disabled">Edit Menu Items</a> </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-3">
         <div class="card text-center shadow-sm">
            <div class="card-body">
                 <h2 class="card-title h1">⚙️</h2> <p class="card-text text-muted">Site Settings</p>
                 <a href="#" class="btn btn-sm btn-outline-primary disabled">Configure Settings</a> </div>
        </div>
    </div>

</div> <div class="mt-5">
    <h2 class="h4">Future Content Area</h2>
    <p class="text-muted">This area could display recent contact messages, orders, or other administrative information.</p>
    </div>


<?php
// Include the footer template
require_once __DIR__ . '/../includes/footer.php';
?>

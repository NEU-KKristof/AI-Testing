<?php
/**
 * Admin Login Page (admin/login.php)
 *
 * Provides a form for administrators to log in.
 * Performs basic credential checking against the database.
 *
 * IMPORTANT SECURITY NOTE: This implementation is VERY BASIC and lacks proper session management.
 * It only checks credentials on submission and redirects. A real application MUST use sessions
 * to track login status across pages. This is purely for demonstrating the credential check.
 */

// Include necessary files
// Need config for BASE_URL, db for connection
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/db.php';

// --- Page Specific Configuration ---
// Setting title here, but header include is further down
$page_title = "Admin Login - Awesome Pizza Place";

// --- Login Processing ---
$login_error = ''; // Variable to store login error messages

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Basic validation
    if (empty($username) || empty($password)) {
        $login_error = "Username and password are required.";
    } else {
        // Proceed to check credentials against the database
        $pdo = connect_db();
        if ($pdo) {
            try {
                // SQL to find the user by username
                $sql = "SELECT id, username, password_hash FROM admin_users WHERE username = :username LIMIT 1";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':username', $username);
                $stmt->execute();

                // Fetch the user record
                $user = $stmt->fetch();

                // Verify user exists and password matches the hash
                if ($user && password_verify($password, $user['password_hash'])) {
                    // --- SUCCESSFUL LOGIN ---
                    // !! VERY INSECURE - NO SESSION !!
                    // In a real app, you would start a session here:
                    // session_start();
                    // $_SESSION['admin_user_id'] = $user['id'];
                    // $_SESSION['admin_username'] = $user['username'];
                    // $_SESSION['logged_in_time'] = time();

                    // Redirect to the admin dashboard
                    // Using BASE_URL ensures correct path
                    header('Location: ' . BASE_URL . 'admin/index.php?login=success'); // Add a flag for demo
                    exit; // Important to stop script execution after redirect

                } else {
                    // Invalid credentials (user not found or password mismatch)
                    $login_error = "Invalid username or password.";
                }

            } catch (PDOException $e) {
                error_log("Admin Login DB Error: " . $e->getMessage());
                $login_error = "An error occurred during login. Please try again.";
            }
        } else {
            // Database connection failed
            $login_error = "Database connection error. Cannot log in.";
        }
    }
}

// --- HTML Rendering ---
// Include header AFTER processing logic, but before outputting HTML
require_once __DIR__ . '/../includes/header.php';
?>

<div class="row justify-content-center"> <div class="col-md-6 col-lg-4">
        <h1 class="text-center mb-4">Admin Login</h1>

        <?php
        // Display login error message if any
        if (!empty($login_error)) {
            // Using basic alert styling, assuming Quantum CSS has similar classes or adapt as needed
            echo "<div class=\"alert alert-danger p-3 mb-3\">" . htmlspecialchars($login_error) . "</div>";
        }
        ?>

        <form action="login.php" method="POST" class="border p-4 rounded shadow-sm bg-light">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button> </form>
    </div>
</div>

<?php
// Include the footer template
require_once __DIR__ . '/../includes/footer.php';
?>

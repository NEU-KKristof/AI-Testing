<?php
/**
 * Contact Page (contact.php)
 *
 * Displays a contact form and handles its submission, storing messages in the database.
 */

// --- Page Specific Configuration ---
$page_title = "Contact Us - Awesome Pizza Place";
$meta_description = "Get in touch with us! Send a message, find our address, or give us a call.";

// Include database connection and header
require_once __DIR__ . '/includes/db.php'; // Provides connect_db()
require_once __DIR__ . '/includes/header.php';

// --- Form Handling ---
$form_message = ''; // Message to display after submission (success or error)
$form_error = false; // Flag for styling the message
$form_values = ['name' => '', 'email' => '', 'message' => '']; // Store submitted values for repopulation

// Check if the form was submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // --- Basic Input Validation ---
    $name = trim($_POST['name'] ?? ''); // Use null coalescing operator and trim whitespace
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    // Store submitted values for repopulation in case of error
    $form_values = ['name' => $name, 'email' => $email, 'message' => $message];

    $errors = []; // Array to hold validation errors

    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // Validate email format
        $errors[] = "Please enter a valid email address.";
    }
    if (empty($message)) {
        $errors[] = "Message cannot be empty.";
    }

    // --- Database Insertion (if no validation errors) ---
    if (empty($errors)) {
        $pdo = connect_db();
        if ($pdo) {
            try {
                // SQL query to insert the message using prepared statements
                $sql = "INSERT INTO contact_messages (sender_name, sender_email, message) VALUES (:name, :email, :message)";

                // Prepare the statement
                $stmt = $pdo->prepare($sql);

                // Bind parameters to prevent SQL injection
                // Using htmlspecialchars here adds another layer of safety if the data is ever displayed raw,
                // though output escaping is the primary defense.
                $stmt->bindParam(':name', htmlspecialchars($name, ENT_QUOTES, 'UTF-8'));
                $stmt->bindParam(':email', htmlspecialchars($email, ENT_QUOTES, 'UTF-8'));
                $stmt->bindParam(':message', htmlspecialchars($message, ENT_QUOTES, 'UTF-8'));

                // Execute the statement
                if ($stmt->execute()) {
                    // Success!
                    $form_message = "Thank you for your message! We'll get back to you soon.";
                    $form_error = false;
                    // Clear form values after successful submission
                    $form_values = ['name' => '', 'email' => '', 'message' => ''];
                } else {
                    // Database execution error
                    $form_message = "Sorry, there was an error sending your message. Please try again.";
                    $form_error = true;
                    error_log("Contact Form DB Execute Error: Statement failed to execute.");
                }

            } catch (PDOException $e) {
                // Handle potential database errors during preparation or execution
                error_log("Contact Form DB Error: " . $e->getMessage());
                $form_message = "A database error occurred. Please try again later.";
                $form_error = true;
            }
        } else {
            // Database connection failed
            $form_message = "Cannot connect to the database to send message.";
            $form_error = true;
        }
    } else {
        // Validation errors occurred
        $form_message = "Please fix the following errors:<br>" . implode("<br>", $errors);
        $form_error = true;
    }
}

// --- HTML Rendering ---
?>

<h1 class="text-center mb-4"><?php echo htmlspecialchars($page_title); ?></h1>

<div class="row">
    <div class="col-md-5 mb-4">
        <h2 class="h4">Get In Touch</h2>
        <p>Have questions or want to place a large order? Reach out to us!</p>
        <hr>
        <p><strong>Address:</strong><br>
           123 Pizza Street<br>
           Eger, Heves County, 3300<br>
           Hungary</p>
        <p><strong>Phone:</strong> <a href="tel:+36123456789">+36 (12) 345-6789</a></p>
        <p><strong>Email:</strong> <a href="mailto:info@awesomepizzaplace.com">info@awesomepizzaplace.com</a></p>
        <p><strong>Hours:</strong><br>
           Monday - Thursday: 11:00 AM - 10:00 PM<br>
           Friday - Saturday: 11:00 AM - 11:00 PM<br>
           Sunday: 12:00 PM - 9:00 PM</p>
        </div>

    <div class="col-md-7">
        <h2 class="h4">Send Us a Message</h2>

        <?php
        // Display success or error message from form submission
        if (!empty($form_message)) {
            $alert_class = $form_error ? 'alert-danger' : 'alert-success'; // Use Quantum CSS alert classes if available, or basic Bootstrap ones
            echo "<div class=\"alert {$alert_class} p-3 mb-3\">{$form_message}</div>";
        }
        ?>

        <form action="contact.php" method="POST" class="needs-validation" novalidate> <div class="mb-3"> <label for="contactName" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="contactName" name="name" required value="<?php echo htmlspecialchars($form_values['name']); ?>">
                </div>

            <div class="mb-3">
                <label for="contactEmail" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="contactEmail" name="email" required value="<?php echo htmlspecialchars($form_values['email']); ?>">
                </div>

            <div class="mb-3">
                <label for="contactMessage" class="form-label">Message</label>
                <textarea class="form-control" id="contactMessage" name="message" rows="5" required><?php echo htmlspecialchars($form_values['message']); ?></textarea>
                </div>

            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</div>


<?php
// Include the footer template
require_once __DIR__ . '/includes/footer.php';
?>

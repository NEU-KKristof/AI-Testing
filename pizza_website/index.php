<?php
/**
 * Homepage File (index.php)
 *
 * This is the main landing page for the website.
 * It includes the header and footer and displays introductory content.
 */

// --- Page Specific Configuration ---
$page_title = "Welcome to Awesome Pizza Place!";
$meta_description = "Discover the best pizza in town. Fresh ingredients, great taste!";

// Include the header template
require_once __DIR__ . '/includes/header.php'; // Use __DIR__ for reliable path finding

?>

<section class="text-center bg-light p-5 p-md-5 rounded mb-4 shadow-sm"> <h1 class="display-4 fw-bold">The Best Pizza in Town!</h1> <p class="lead text-muted col-lg-8 mx-auto">Made with love, fresh ingredients, and secret family recipes. Taste the difference!</p>
    <a href="menu.php" class="btn btn-primary btn-lg mt-3">View Our Menu</a>
    <a href="contact.php" class="btn btn-secondary btn-lg mt-3 ms-2">Contact Us</a>
</section>

<section class="row text-center mb-5">
    <div class="col-md-4 mb-3">
        <div class="p-4 border rounded shadow-sm h-100"> <h2 class="h4">Fresh Ingredients</h2>
            <p class="text-muted">We source the finest local ingredients daily to ensure maximum freshness and flavor.</p>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="p-4 border rounded shadow-sm h-100">
             <h2 class="h4">Fast Delivery</h2>
             <p class="text-muted">Craving pizza? Get your favorite pies delivered hot and fresh to your door.</p>
        </div>
    </div>
    <div class="col-md-4 mb-3">
         <div class="p-4 border rounded shadow-sm h-100">
             <h2 class="h4">Dine-In Experience</h2>
             <p class="text-muted">Visit our cozy restaurant for a welcoming atmosphere and friendly service.</p>
        </div>
    </div>
</section>

<section class="bg-warning p-4 rounded text-center text-dark mb-4">
    <h2 class="h3">This Week's Special!</h2>
    <p>Get 10% off any Large Pizza! Mention this offer when ordering.</p>
</section>


<?php
// Include the footer template
require_once __DIR__ . '/includes/footer.php';
?>

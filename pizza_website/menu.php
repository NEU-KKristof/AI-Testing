<?php
/**
 * Menu Page (menu.php)
 *
 * Displays the restaurant's menu items fetched dynamically from the database.
 * Items are grouped by category.
 */

// --- Page Specific Configuration ---
$page_title = "Our Delicious Menu - Awesome Pizza Place";
$meta_description = "Explore our wide range of pizzas, pastas, salads, drinks, and desserts.";

// Include database connection and header
require_once __DIR__ . '/includes/db.php'; // Provides connect_db()
require_once __DIR__ . '/includes/header.php';

// --- Data Fetching ---
$menu_items = []; // Initialize an empty array to store menu items
$categories = []; // Initialize an empty array for categories

// Establish database connection
$pdo = connect_db();

if ($pdo) {
    try {
        // SQL query to fetch all menu items, ordered by category then name
        // Using prepared statements isn't strictly necessary here as there's no user input,
        // but it's good practice. query() is fine for simple selects without external input.
        $sql = "SELECT id, name, description, price, image_path, category
                FROM menu_items
                ORDER BY category, name";

        // Execute the query
        $stmt = $pdo->query($sql);

        // Fetch all results into the $menu_items array
        $menu_items = $stmt->fetchAll();

        // Extract unique categories from the fetched items
        $categories = array_unique(array_column($menu_items, 'category'));
        sort($categories); // Sort categories alphabetically

    } catch (PDOException $e) {
        // Handle potential database errors during query execution
        error_log("Menu Fetch Error: " . $e->getMessage());
        // Display a user-friendly error message (or handle more gracefully)
        echo "<div class='container alert alert-danger'>Sorry, we couldn't load the menu at this time. Please try again later.</div>";
        // Optionally, you might want to stop rendering the rest of the menu section
    }
} else {
    // Handle case where database connection failed (message already shown by connect_db)
    // No further action needed here, header/footer will still render.
}

// --- HTML Rendering ---
?>

<h1 class="text-center mb-4"><?php echo htmlspecialchars($page_title); ?></h1>

<?php if (!empty($categories) && !empty($menu_items)): ?>
    <?php foreach ($categories as $category): ?>
        <section class="mb-5">
            <h2 class="h3 border-bottom pb-2 mb-4"><?php echo htmlspecialchars($category); ?></h2>
            <div class="row">
                <?php foreach ($menu_items as $item): ?>
                    <?php if ($item['category'] === $category): ?>
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card h-100 shadow-sm"> <?php
                                // Determine image path - use placeholder if none provided
                                $image_url = BASE_URL . 'images/placeholder.png'; // Default placeholder
                                if (!empty($item['image_path']) && file_exists(__DIR__ . '/' . $item['image_path'])) {
                                    $image_url = BASE_URL . htmlspecialchars($item['image_path']);
                                }
                                ?>
                                <img src="<?php echo $image_url; ?>" class="card-img-top" alt="<?php echo htmlspecialchars($item['name']); ?>" style="height: 200px; object-fit: cover;"> <div class="card-body d-flex flex-column"> <h3 class="card-title h5"><?php echo htmlspecialchars($item['name']); ?></h3>
                                    <?php if (!empty($item['description'])): ?>
                                        <p class="card-text text-muted small flex-grow-1"><?php echo htmlspecialchars($item['description']); ?></p>
                                    <?php else: ?>
                                         <div class="flex-grow-1"></div> <?php endif; ?>
                                    <p class="card-text fw-bold mt-2 mb-0">€<?php echo number_format(htmlspecialchars($item['price']), 2); ?></p> </div>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div> </section>
    <?php endforeach; ?>
<?php elseif (empty($menu_items) && $pdo): ?>
    <p class="text-center text-muted">Our menu is currently empty. Please check back soon!</p>
<?php endif; ?>


<?php
// Include the footer template
require_once __DIR__ . '/includes/footer.php';
?>

<?php
// ... (PHP code for form handling) ...
?>

<h1 class="text-center mb-4"><?php echo htmlspecialchars($page_title); ?></h1>

<div class="row">
    <div class="col-md-7">
        <h2 class="h4">Send Us a Message</h2>

        <?php
        // ... (PHP form message display) ...
        ?>

        <form id="contact-form" action="contact.php" method="POST" novalidate>
            <div class="mb-3">
                <label for="contactName" class="form-label">Your Name</label>
                <input type="text" class="form-control" id="contactName" name="name" required value="<?php echo htmlspecialchars($form_values['name']); ?>">
                <div class="js-error-message text-danger small mt-1"></div>
            </div>

            <div class="mb-3">
                <label for="contactEmail" class="form-label">Your Email</label>
                <input type="email" class="form-control" id="contactEmail" name="email" required value="<?php echo htmlspecialchars($form_values['email']); ?>">
                 <div class="js-error-message text-danger small mt-1"></div>
            </div>

            <div class="mb-3">
                <label for="contactMessage" class="form-label">Message</label>
                <textarea class="form-control" id="contactMessage" name="message" rows="5" required><?php echo htmlspecialchars($form_values['message']); ?></textarea>
                 <div class="js-error-message text-danger small mt-1"></div>
            </div>

            <button type="submit" class="btn btn-primary">Send Message</button>
        </form>
    </div>
</div>

<?php
// ... (footer include) ...
?>

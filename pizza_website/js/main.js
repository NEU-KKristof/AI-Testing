/**
 * Main JavaScript File for Awesome Pizza Place Website
 *
 * Handles:
 * 1. Mobile Navigation Toggle
 * 2. Active Navigation Link Styling
 * 3. Basic Client-Side Contact Form Validation
 */

// Wait for the DOM to be fully loaded before running scripts
document.addEventListener('DOMContentLoaded', () => {

    console.log("Main JS Loaded"); // For debugging

    // --- 1. Mobile Navigation Toggle ---
    const menuButton = document.getElementById('mobile-menu-button');
    const navMenu = document.getElementById('main-nav-menu');

    if (menuButton && navMenu) {
        menuButton.addEventListener('click', () => {
            console.log("Menu button clicked"); // For debugging
            // Toggle the 'is-active' class on the menu
            navMenu.classList.toggle('is-active');

            // Optional: Toggle ARIA attributes for accessibility
            const isExpanded = navMenu.classList.contains('is-active');
            menuButton.setAttribute('aria-expanded', isExpanded);
        });

        // Optional: Close menu if clicking outside of it (more complex)
        // document.addEventListener('click', (event) => {
        //     if (!navMenu.contains(event.target) && !menuButton.contains(event.target) && navMenu.classList.contains('is-active')) {
        //         navMenu.classList.remove('is-active');
        //         menuButton.setAttribute('aria-expanded', 'false');
        //     }
        // });

    } else {
        console.warn("Mobile menu button or nav menu element not found.");
    }


    // --- 2. Active Navigation Link Styling ---
    const navLinks = document.querySelectorAll('#main-nav-menu .nav-link');
    // Get the current page path (e.g., '/pizza_website/menu.php')
    const currentPagePath = window.location.pathname;

    if (navLinks.length > 0) {
        navLinks.forEach(link => {
            // Get the link's href attribute
            const linkPath = new URL(link.href).pathname;

            // Check if the link's path matches the current page path
            // Need careful comparison, especially if index.php is involved
            if (linkPath === currentPagePath ||
               (currentPagePath === '/pizza_website/' && linkPath === '/pizza_website/index.php') || // Handle root path mapping to index.php
               (currentPagePath === '/' && linkPath === '/index.php') // Handle root path if not in subdirectory
               ) {
                 console.log("Active link found:", linkPath); // For debugging
                link.classList.add('active');
                // Optional: Add active class to parent li as well
                // link.closest('.nav-item')?.classList.add('active');
            } else {
                link.classList.remove('active');
                // link.closest('.nav-item')?.classList.remove('active');
            }
        });
    } else {
        console.warn("No navigation links found for active styling.");
    }


    // --- 3. Basic Client-Side Contact Form Validation ---
    const contactForm = document.getElementById('contact-form');

    if (contactForm) {
        contactForm.addEventListener('submit', (event) => {
            console.log("Contact form submitted"); // For debugging

            // Clear previous errors
            clearFormErrors(contactForm);

            let isValid = true; // Assume form is valid initially

            // Get form fields
            const nameInput = document.getElementById('contactName');
            const emailInput = document.getElementById('contactEmail');
            const messageInput = document.getElementById('contactMessage');

            // Validate Name
            if (!validateRequired(nameInput)) {
                isValid = false;
                showError(nameInput, "Name is required.");
            }

            // Validate Email
            if (!validateRequired(emailInput)) {
                isValid = false;
                showError(emailInput, "Email is required.");
            } else if (!validateEmailFormat(emailInput)) {
                isValid = false;
                showError(emailInput, "Please enter a valid email address.");
            }

            // Validate Message
            if (!validateRequired(messageInput)) {
                isValid = false;
                showError(messageInput, "Message cannot be empty.");
            }

            // If the form is NOT valid, prevent submission
            if (!isValid) {
                console.log("Form validation failed."); // For debugging
                event.preventDefault(); // Stop the form from submitting to the server
            } else {
                console.log("Form validation passed. Submitting..."); // For debugging
                // Form is valid, allow default submission to PHP handler
                // If using AJAX later, you would handle the submission here instead
            }
        });
    } else {
        console.warn("Contact form element not found.");
    }

}); // End DOMContentLoaded

// --- Validation Helper Functions ---

/**
 * Checks if an input field has a value.
 * @param {HTMLInputElement|HTMLTextAreaElement} input - The input element.
 * @returns {boolean} - True if valid (has value), false otherwise.
 */
function validateRequired(input) {
    return input && input.value.trim() !== '';
}

/**
 * Checks if an email input field has a valid format.
 * @param {HTMLInputElement} input - The email input element.
 * @returns {boolean} - True if valid format, false otherwise.
 */
function validateEmailFormat(input) {
    if (!input) return false;
    // Simple regex for basic email format check
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(input.value.trim());
    // Alternatively, leverage the browser's built-in check:
    // return input.checkValidity(); // Requires input type="email"
}

/**
 * Displays an error message for a specific input field.
 * @param {HTMLInputElement|HTMLTextAreaElement} inputElement - The input element with the error.
 * @param {string} message - The error message to display.
 */
function showError(inputElement, message) {
    // Find the next sibling element intended for error messages
    const errorContainer = inputElement.nextElementSibling;
    if (errorContainer && errorContainer.classList.contains('js-error-message')) {
        errorContainer.textContent = message;
    }
    // Optional: Add an error class to the input itself for styling
    inputElement.classList.add('is-invalid'); // Assumes you have CSS for .is-invalid
}

/**
 * Clears all previous error messages and styles from the form.
 * @param {HTMLFormElement} formElement - The form element.
 */
function clearFormErrors(formElement) {
    // Remove text content from all error message containers
    const errorMessages = formElement.querySelectorAll('.js-error-message');
    errorMessages.forEach(msg => msg.textContent = '');

    // Remove error styling from input fields
    const invalidInputs = formElement.querySelectorAll('.is-invalid');
    invalidInputs.forEach(input => input.classList.remove('is-invalid'));
}

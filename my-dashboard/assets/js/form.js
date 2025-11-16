// form.js (Revised Logic)

// Get both the form and the specific button element
let registerForm = document.getElementById('registerForm');
let registerBtn = document.getElementById('registerBtn'); // Get the button element

if (registerForm && registerBtn) {
    // Attach listener to the button's click event
    registerBtn.addEventListener('click', function (e) {
        
        // Use e.preventDefault() only to stop the click from doing anything else initially
        e.preventDefault();

        // Get the values and the error display element
        let passwordInput = document.getElementById('regPassword');
        let confirmPasswordInput = document.getElementById('confirmPassword');
        let password = passwordInput.value.trim();
        let confirmPassword = confirmPasswordInput.value.trim();
        let errorSpan = document.getElementById('passwordMatchError');

        // --- 1. NEW: Check HTML5 Validity First (for empty required fields) ---
        // This makes sure fullName, email, and password fields are filled
        if (!registerForm.checkValidity()) {
            // If the browser detects an empty required field, let the browser handle the error display
            // We exit here and let the browser's native required message show
            return; 
        }

        // 2. Clear previous errors
        errorSpan.style.display = 'none';
        confirmPasswordInput.style.borderColor = '#ced4da'; // Reset border color

        // 3. Validation Rule: Check if passwords match
        if (password !== confirmPassword) {
            
            // Display the error message
            errorSpan.textContent = 'Passwords do not match!';
            errorSpan.style.display = 'block';
            
            // Highlight the problematic input
            confirmPasswordInput.style.borderColor = '#dc3545';
            confirmPasswordInput.focus();
            
            return;
        }

        // 4. Success Path: If all checks pass, manually submit the form to PHP
        console.log("Passwords match. Submitting form to PHP...");
        
        // This is the VITAL line: sends the data to register.php
        registerForm.submit(); 
    });
}
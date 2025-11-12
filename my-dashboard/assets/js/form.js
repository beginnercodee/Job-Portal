let registerForm = document.getElementById('registerForm');
let loginForm = document.getElementById('loginForm');

if (registerForm) {
    registerForm.addEventListener('submit', function() {
        let password = document.getElementById('regPassword').value;
        let confirmPassword = document.getElementById('confirmPassword').value;

        if (password !== confirmPassword) {
            alert('Error: The password and confirm password fields must match!');
            return;
        }

        console.log("Registration validation passed. Submitting data to server/register.php...");
        
        // **TODO: Add Fetch/AJAX code here to send data to your PHP backend.**
        
        alert('Registration successful! Redirecting to login...');
        window.location.href = './login.html'; 
    });
}

if (loginForm) {
    loginForm.addEventListener('submit', function() {
        console.log("Login validation passed. Submitting data to server/login.php...");
        
        alert('Login successful! Redirecting to dashboard...');
        window.location.href = './dashboard.html'; 
    });
}
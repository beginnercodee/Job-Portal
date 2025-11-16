let registerForm = document.getElementById('registerForm');
let registerBtn = document.getElementById('registerBtn');

if (registerForm && registerBtn) {
    registerBtn.addEventListener('click', function (e) {
        
        e.preventDefault();

        let passwordInput = document.getElementById('regPassword');
        let confirmPasswordInput = document.getElementById('confirmPassword');
        let password = passwordInput.value.trim();
        let confirmPassword = confirmPasswordInput.value.trim();
        let errorSpan = document.getElementById('passwordMatchError');

        if (!registerForm.checkValidity()) {
            return; 
        }

        errorSpan.style.display = 'none';
        confirmPasswordInput.style.borderColor = '#ced4da';

        if (password !== confirmPassword) {
            
            errorSpan.textContent = 'Passwords do not match!';
            errorSpan.style.display = 'block';
            
            confirmPasswordInput.style.borderColor = '#dc3545';
            confirmPasswordInput.focus();
            
            return;
        }

        console.log("Passwords match. Submitting form to PHP...");
        registerForm.submit(); 
    });
}
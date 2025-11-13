let registerBtn = document.getElementById('registerBtn');
let registerForm = document.getElementById('registerForm');

if (registerBtn && registerForm) {
    registerBtn.addEventListener('click', function (e) {
        e.preventDefault();

        let password = document.getElementById('regPassword').value.trim();
        let confirmPassword = document.getElementById('confirmPassword').value.trim();

        if (password !== confirmPassword) {
            alert('Error: The password and confirm password fields must match!');
            return;
        }

        console.log("Passwords match. Submitting form to PHP...");
        registerForm.submit();
    });
}

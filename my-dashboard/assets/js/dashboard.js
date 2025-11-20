document.addEventListener('DOMContentLoaded', () => {
    
    // --- 1. TOAST NOTIFICATION FUNCTION ---
    /**
     * Displays a Toast Notification
     * @param {string} message - The text to display
     * @param {string} type - 'success' or 'error'
     */
    function showToast(message, type = 'success') {
        const container = document.getElementById('toastContainer');
        
        // Create toast element
        const toast = document.createElement('div');
        toast.className = `toast ${type}`;
        toast.textContent = message;

        // Add to container
        container.appendChild(toast);

        // Trigger animation via CSS (automatically handled by class)
        
        // Remove after 3 seconds
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            toast.style.transition = 'all 0.3s ease';
            
            // Wait for animation to finish before removing from DOM
            setTimeout(() => {
                toast.remove();
            }, 300);
        }, 3000);
    }

    // --- 2. CHECK URL FOR SUCCESS MESSAGE (From PHP Redirect) ---
    const urlParams = new URLSearchParams(window.location.search);
    const status = urlParams.get('status');

    if (status === 'success') {
        showToast('Task added successfully!', 'success');
        
        // Optional: Clean the URL to remove ?status=success so it doesn't show again on refresh
        const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
        window.history.replaceState({path: cleanUrl}, '', cleanUrl);
    } else if (status === 'error') {
        showToast('Failed to add task.', 'error');
    }

    // --- 3. FORM HANDLING ---
    const taskForm = document.getElementById('taskForm');
    
    if (taskForm) {
        taskForm.addEventListener('submit', function(event) {
            
            const taskTitle = document.getElementById('taskTitle').value.trim();
            const taskPriority = document.getElementById('taskPriority').value;
            
            // Client-side validation
            if (taskTitle === "" || taskPriority === "Select Priority" || taskPriority === "") {
                // REPLACED ALERT WITH TOAST
                showToast("Error: Please complete all task fields.", "error");
                
                event.preventDefault(); // Stop submission
                return;
            }
            
            console.log("Client-side check passed. Submitting form data to dashboard.php...");
            // The form will now submit naturally to the server...
        });
    }
});
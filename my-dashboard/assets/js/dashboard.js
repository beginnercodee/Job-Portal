document.addEventListener('DOMContentLoaded', () => {
    const taskForm = document.getElementById('taskForm');
    
    if (taskForm) {
        taskForm.addEventListener('submit', function(event) {
            
            const taskTitle = document.getElementById('taskTitle').value.trim();
            const taskPriority = document.getElementById('taskPriority').value;
            
            if (taskTitle === "" || taskPriority === "Select Priority" || taskPriority === "") {
                alert("Error: Please complete all task fields.");
                event.preventDefault();
                return;
            }
            
            console.log("Client-side check passed. Submitting form data to dashboard.php...");
            
        });
    }
});
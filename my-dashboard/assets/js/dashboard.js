document.addEventListener("DOMContentLoaded", () => {
  fetch('./server/auth_check.php')
    .then(response => response.json())
    .then(data => {
      if (!data.authenticated) {
        window.location.href = './login.html';
      } else {
        const userNameElement = document.getElementById('user-name');
        if (userNameElement && data.user_name) {
          userNameElement.textContent = data.user_name;
        }
      }
    })
    .catch(error => {
      console.error('Error checking auth:', error);
    });

  function showToast(message, type = "success") {
    const container = document.getElementById("toastContainer");

    const toast = document.createElement("div");
    toast.className = `toast ${type}`;
    toast.textContent = message;

    container.appendChild(toast);

    setTimeout(() => {
      toast.classList.add("toast-exit");
      setTimeout(() => toast.remove(), 300);
    }, 3000);
  }

  const urlParams = new URLSearchParams(window.location.search);
  const status = urlParams.get("status");

  if (status === "success") {
    showToast("Task added successfully!", "success");
    const cleanUrl = window.location.protocol + "//" + window.location.host + window.location.pathname;
    window.history.replaceState({path: cleanUrl}, '', cleanUrl);
  } else if (status === "completed") {
    showToast("Task marked as completed!", "success");
  } else if (status === "deleted") {
    showToast("Task deleted successfully!", "success");
  } else if (status === "error") {
    showToast("An error occurred. Please try again.", "error");
  }

  const taskForm = document.getElementById("taskForm");

  if (taskForm) {
    taskForm.addEventListener("submit", function (event) {
      const taskTitle = document.getElementById("taskTitle").value.trim();
      const taskPriority = document.getElementById("taskPriority").value;

      if (
        taskTitle === "" ||
        taskPriority === "Select Priority" ||
        taskPriority === ""
      ) {
        showToast("Error: Please complete all task fields.", "error");

        event.preventDefault();
        return;
      }

      console.log(
        "Client-side check passed. Submitting form data to dashboard.php..."
      );
    });
  }
});
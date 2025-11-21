<?php
$database = "simple_app";
$servername = "localhost";
$username = "root";
$password = "";

$connect = new mysqli($servername, $username, $password, $database);
if ($connect->connect_error) {
    die("Sorry, Connection failed: " . $connect->connect_error);
}

$user_id = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'])) {
    $task_title = $_POST['title'];
    $task_priority = $_POST['task_priority'];
    $insert = "INSERT INTO tasks (id, title, task_priority, task_status) 
               VALUES ('$user_id', '$task_title', '$task_priority', 'pending')";
    if ($connect->query($insert)) {
        header("Location: dashboard.php?status=success");
    } else {
        header("Location: dashboard.php?status=error");
    }
    exit();
}

if (isset($_GET['delete'])) {
    $task_id = $_GET['delete'];
    $delete = "DELETE FROM tasks WHERE task_id = $task_id AND id = $user_id";
    if ($connect->query($delete)) {
        header("Location: dashboard.php?status=deleted");
    } else {
        header("Location: dashboard.php?status=error");
    }
    exit();
}

if (isset($_GET['complete'])) {
    $task_id = $_GET['complete'];
    $update = "UPDATE tasks SET task_status='completed' WHERE task_id=$task_id AND id=$user_id";
    if ($connect->query($update)) {
        header("Location: dashboard.php?status=completed");
    } else {
        header("Location: dashboard.php?status=error");
    }
    exit();
}

$result = $connect->query("SELECT * FROM tasks WHERE id=$user_id ORDER BY Created DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Task Manager</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

<div id="toastContainer" class="toast-container"></div>

<div class="dashboard-layout">
    <aside class="dashboard-sidebar">
        <div class="profile-card">
            <h4>Task Manager</h4>
            <p>Welcome back,</p>
            <h3 id="user-name">User</h3>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="#" class="active">My Tasks</a></li>
            </ul>
        </nav>
        <div class="sidebar-footer">
            <a href="../login.html" class="btn btn-logout">Logout</a>
        </div>
    </aside>

    <main class="dashboard-content">
        <h1>Task Management</h1>
        <p class="subtitle">Quickly add and manage your daily priorities.</p>

        <section class="task-input-section card">
            <h3>Add New Task</h3>
            <form id="taskForm" class="task-add-form" method="POST" action="dashboard.php">
                <div class="form-group-inline">
                    <input type="text" id="taskTitle" name="title" placeholder="Enter task title" required>
                    <select id="taskPriority" name="task_priority" required>
                        <option value="" disabled selected>Select Priority</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                    <button type="submit" class="btn btn-primary-add">Add Task</button>
                </div>
            </form>
        </section>

        <section class="task-list-section">
            <h2>My Tasks</h2>
            <ul id="taskList" class="task-list">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li class="task-item <?= $row['task_status'] ?>">
                        <span class="task-title"><?= htmlspecialchars($row['title']) ?></span>
                        <span class="task-details">
                            <?= ucfirst($row['task_priority']) ?> | 
                            <?= ucfirst($row['task_status']) ?> |
                            <?= date('Y-m-d', strtotime($row['Created'])) ?>
                        </span>
                        <div class="task-actions">
                            <?php if ($row['task_status'] === 'pending'): ?>
                                <a href="dashboard.php?complete=<?= $row['task_id'] ?>" class="btn-action btn-complete">Complete</a>
                            <?php endif; ?>
                            <a href="dashboard.php?delete=<?= $row['task_id'] ?>" class="btn-action btn-delete">Delete</a>
                        </div>
                    </li>
                <?php endwhile; ?>
            </ul>
            <?php if ($result->num_rows === 0): ?>
                <p class="no-tasks-message">All clear! Add a new task above.</p>
            <?php endif; ?>
        </section>
    </main>
</div>

<script src="../assets/js/dashboard.js"></script>
</body>
</html>

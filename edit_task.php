<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM tasks WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $task = mysqli_fetch_assoc($result);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    $sql = "UPDATE tasks SET title = ?, description = ?, deadline = ?, priority = ?, status = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssssi", $title, $description, $deadline, $priority, $status, $id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<p class='success-message'>Task updated successfully!</p>";
        header('Location: index.php');
        exit;
    } else {
        echo "<p class='error-message'>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task - Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">
    <h1>Edit Task</h1>
    <form method="POST" action="edit_task.php?id=<?php echo $task['id']; ?>">

        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($task['title']); ?>" placeholder="Enter task title" required>
        </div>

        <div class="form-group">
            <label for="description">Task Description</label>
            <textarea name="description" id="description" placeholder="Enter task description" required><?php echo htmlspecialchars($task['description']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="datetime-local" name="deadline" id="deadline" value="<?php echo date('Y-m-d\TH:i', strtotime($task['deadline'])); ?>" required>
        </div>

        <div class="form-group">
            <label for="priority">Priority</label>
            <select name="priority" id="priority" required>
                <option value="Low" <?php if ($task['priority'] == 'Low') echo 'selected'; ?>>Low</option>
                <option value="Medium" <?php if ($task['priority'] == 'Medium') echo 'selected'; ?>>Medium</option>
                <option value="High" <?php if ($task['priority'] == 'High') echo 'selected'; ?>>High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="Pending" <?php if ($task['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="In Progress" <?php if ($task['status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                <option value="Completed" <?php if ($task['status'] == 'Completed') echo 'selected'; ?>>Completed</option>
            </select>
        </div>

        <div class="button-container">
            <a href="index.php" class="back-btn">Back to Task List</a>
            <button type="submit" class="submit-btn">Update</button>
        </div>
    </form>
</div>
</body>
</html>
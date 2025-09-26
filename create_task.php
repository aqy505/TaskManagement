<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $deadline = $_POST['deadline'];
    $priority = $_POST['priority'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tasks (title, description, deadline, priority, status) 
            VALUES ('$title', '$description', '$deadline', '$priority', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "<p class='success-message'>New task created successfully!</p>";
        header('Location: index.php');
        exit;
    } else {
        echo "<p class='error-message'>Error: " . $sql . "<br>" . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Task - Task Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="form-container">
    <h1>Create a New Task</h1>
    <form method="POST" action="create_task.php">
        <div class="form-group">
            <label for="title">Task Title</label>
            <input type="text" name="title" id="title" placeholder="Enter task title" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Enter task description" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="datetime-local" name="deadline" id="deadline" required>
        </div>

        <div class="form-group">
            <label for="priority">Priority</label>
            <select name="priority" id="priority" required>
                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>
            </select>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Completed">Completed</option>
            </select>
        </div>

        <div class="button-container">
            <a href="index.php" class="back-btn">Back to Task List</a>
            <button type="submit" class="submit-btn">Add Task</button>
        </div>
    </form>
</div>
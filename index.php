<?php
include 'db.php';

$sql = "SELECT * FROM tasks ORDER BY deadline ASC";
$result = mysqli_query($conn, $sql);

$deleted = isset($_GET['deleted']) ? $_GET['deleted'] : false;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="shortcut icon" type="image/icon" href="./aqylogo.png" />

    <script>
        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this task?')) {
                window.location.href = `delete_task.php?id=${id}`;
            }
        }
    </script>
</head>

<body>


    <div class="container">
        <h1>Activity List System</h1>

        <?php
        session_start();

        if (isset($_SESSION['deleted']) && $_SESSION['deleted'] == true) {
            echo "<div class='success-message' id='successMessage'>Task deleted successfully!</div>";
            unset($_SESSION['deleted']);
        }
        ?>

        <script>
            window.onload = function() {
                var successMessage = document.getElementById('successMessage');

                if (successMessage) {
                    successMessage.classList.add('show');

                    setTimeout(function() {
                        successMessage.classList.remove('show');
                    }, 3000);
                }
            };
        </script>

        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2>View Tasks</h2>
            <a href="create_task.php" class="btn btn-primary">Add New</a>
        </div>

        <table>
            <tr>
                <th>Subject</th>
                <th>Description</th>
                <th>Deadline</th>
                <th>Priority</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>

            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['title']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['deadline']}</td>
                    <td>{$row['priority']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <a href='edit_task.php?id={$row['id']}'>
                            <button class='button edit-button'>
                                <i class='fas fa-edit'></i> <!-- Edit Icon -->
                            </button>
                        </a>
                        <!-- Use JavaScript to trigger delete confirmation -->
                        <button class='button delete-button' onclick='confirmDelete({$row['id']})'>
                            <i class='fas fa-trash'></i> <!-- Delete Icon -->
                        </button>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>

    </div>
    </a>

</body>

</html>
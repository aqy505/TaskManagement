<?php
include 'db.php';

$currentTime = date('Y-m-d H:i:s');
$query = "SELECT * FROM tasks WHERE deadline BETWEEN '$currentTime' AND DATE_ADD('$currentTime', INTERVAL 1 DAY) AND reminded = 0";
$result = mysqli_query($conn, $query);

$reminders = [];

while ($row = mysqli_fetch_assoc($result)) {
    $reminders[] = [
        'id' => $row['id'],
        'title' => $row['title'],
        'deadline' => $row['deadline'],
        'description' => $row['description']
    ];

    $updateQuery = "UPDATE tasks SET reminded = 1 WHERE id = " . $row['id'];
    mysqli_query($conn, $updateQuery);
}

echo json_encode($reminders);
?>

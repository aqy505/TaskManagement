<?php
include 'db.php';
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM tasks WHERE id = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['deleted'] = true;
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: index.php");
    exit();
}
?>

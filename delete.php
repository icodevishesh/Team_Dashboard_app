<?php
include 'config.php';


$id = $_GET['id'] ?? null;

if (!$id) {
    die("Invalid request!");
}


$sql = "DELETE FROM employees WHERE id = $id";

if (mysqli_query($conn, $sql)) {
    echo "Employee deleted successfully!";
    header("Location: index.php");
} else {
    echo "Error: " . mysqli_error($conn);
}
?>

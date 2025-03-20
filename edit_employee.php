<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $designation = mysqli_real_escape_string($conn, $_POST['designation']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);


    $currentImage = "";
    $result = mysqli_query($conn, "SELECT image FROM employees WHERE id='$id'");
    if ($row = mysqli_fetch_assoc($result)) {
        $currentImage = $row['image'];
    }


    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);

      
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $imagePath = $image;  
        } else {
            echo "Error uploading image.";
            exit();
        }
    } else {
        $imagePath = $currentImage;  
    }


    $sql = "UPDATE employees SET 
            full_name = '$full_name',
            mobile = '$mobile',
            email = '$email',
            address = '$address',
            role = '$role',
            designation = '$designation',
            gender = '$gender',
            status = '$status',
            image = '$imagePath' 
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "Employee updated successfully!";
    } else {
        echo "Error updating employee: " . mysqli_error($conn);
    }
}
?>

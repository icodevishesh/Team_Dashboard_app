<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $role = $_POST['role'];
    $designation = $_POST['designation'];
    $gender = $_POST['gender'];
    $status = $_POST['status'];

    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];
    $image_path = 'uploads/' . $image;

    move_uploaded_file($image_tmp, $image_path);

    $sql = "INSERT INTO employees (full_name, mobile, email, address, role, designation, gender, image, status) 
            VALUES ('$full_name', '$mobile', '$email', '$address', '$role', '$designation', '$gender', '$image', '$status')";

    if (mysqli_query($conn, $sql)) {
        echo "Employee added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

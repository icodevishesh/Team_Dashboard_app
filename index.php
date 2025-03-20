<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center">Team Dashboard</h2>
    
    <button class="btn btn-success my-3" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="fas fa-plus"></i> Add Employee
    </button>

    <table id="employeeTable" class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
                <th>Role</th>
                <th>Designation</th>
                <th>Gender</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM employees";
            $result = mysqli_query($conn, $sql);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['full_name']}</td>
                    <td>{$row['mobile']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['role']}</td>
                    <td>{$row['designation']}</td>
                    <td>{$row['gender']}</td>
                    <td><img src='uploads/{$row['image']}' width='50' height='50'></td>
                    <td>{$row['status']}</td>
                    <td>
                        <button class='btn btn-warning btn-sm edit-btn' 
                            data-id='{$row['id']}' 
                            data-full_name='{$row['full_name']}'
                            data-mobile='{$row['mobile']}'
                            data-email='{$row['email']}'
                            data-address='{$row['address']}'
                            data-role='{$row['role']}'
                            data-designation='{$row['designation']}'
                            data-gender='{$row['gender']}'
                            data-status='{$row['status']}'
                            data-bs-toggle='modal' 
                            data-bs-target='#editModal'>
                            <i class='fas fa-edit'></i>
                        </button>
                        <button class='btn btn-danger btn-sm delete-btn' 
                            data-id='{$row['id']}'>
                            <i class='fas fa-trash'></i>
                        </button>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addForm" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" name="full_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Mobile</label>
                        <input type="text" name="mobile" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" class="form-control" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label>Role</label>
                        <input type="text" name="role" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Designation</label>
                        <input type="text" name="designation" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Gender</label>
                        <select name="gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label>Upload Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Add Employee</button>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" enctype="multipart/form-data"> <!-- Added enctype for image upload -->
                    <input type="hidden" name="id" id="editId">
                    
                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" name="full_name" id="editFullName" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Mobile</label>
                        <input type="text" name="mobile" id="editMobile" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" id="editEmail" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Address</label>
                        <textarea name="address" id="editAddress" class="form-control" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label>Role</label>
                        <input type="text" name="role" id="editRole" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Designation</label>
                        <input type="text" name="designation" id="editDesignation" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label>Gender</label>
                        <select name="gender" id="editGender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>


                    <div class="mb-3">
                        <label>Upload New Image</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" id="editStatus" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update Employee</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        $('#employeeTable').DataTable();

        // Handle Add Employee
        $('#addForm').submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: 'add_employee.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function () {
                    alert('Employee added successfully!');
                    location.reload();
                }
            });
        });

        $('.edit-btn').click(function () {
            $('#editId').val($(this).data('id'));
            $('#editFullName').val($(this).data('full_name'));
            $('#editMobile').val($(this).data('mobile'));
            $('#editEmail').val($(this).data('email'));
            $('#editAddress').val($(this).data('address'));
            $('#editRole').val($(this).data('role'));
            $('#editDesignation').val($(this).data('designation'));
            $('#editGender').val($(this).data('gender'));
            $('#editStatus').val($(this).data('status'));
            $('#editImage').val($(this).data('image'));
        });

        $('#editForm').submit(function (e) {
            e.preventDefault();
            
            $.ajax({
                url: 'edit_employee.php',
                type: 'POST',
                data: $('#editForm').serialize(),
                success: function () {
                    alert('Employee updated successfully!');
                    location.reload();
                }
            });
        });

        $('.delete-btn').click(function () {
            if (confirm('Are you sure?')) {
                $.get('delete.php?id=' + $(this).data('id'), function () {
                    location.reload();
                });
            }
        });
    });
</script>

</body>
</html>

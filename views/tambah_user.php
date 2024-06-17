<?php 
include '../config/database.php'; 
session_start(); ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include 'partials/scripts.php' ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <title>Tambah User</title>
    <style>
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    </style>
</head>

<body>
    <?php include 'partials/navigation_menu.php' ?>
    <?php include 'partials/header.php' ?>
    <main class="nxl-container">
        <div class="nxl-content">
            <!-- [ Main Content ] start -->
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card stretch stretch-full">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Tambah Project</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="tambah_user.php" id="formTambahPertanyaan">
                                    <div class="mb-4">
                                        <label class="form-label">Nama:</label>
                                        <input type="text" class="form-control" name="nama"
                                            placeholder="Masukkan Nama...">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Email:</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Masukkan Email...">
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Password:</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Masukkan Password...">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Main Content ] end -->
            </div>
            <!-- [ Footer ] start -->
            <!-- [ Footer ] end -->
    </main>

    <!--! BEGIN: Vendors JS !-->
    <script src="../assets/vendors/js/vendors.min.js"></script>
    <!-- vendors.min.js {always must need to be top} -->
    <script src="../assets/vendors/js/daterangepicker.min.js"></script>
    <script src="../assets/vendors/js/apexcharts.min.js"></script>
    <script src="../assets/vendors/js/circle-progress.min.js"></script>
    <!--! END: Vendors JS !-->
    <!--! BEGIN: Apps Init  !-->
    <script src="../assets/js/common-init.min.js"></script>
    <script src="../assets/js/dashboard-init.min.js"></script>
    <!--! END: Apps Init !-->

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the form
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $role = "auditor";
    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO users (nama, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nama, $email, $password, $role);

    // Execute the statement
    if ($stmt->execute()) {
        // Close the statement
        $stmt->close();

        // Close the connection
        $conn->close();

        // Use SweetAlert2 for success message
        echo "<script>";
        echo "Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Berhasil menambah user.',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'users.php';
            }
        });";
        echo "</script>";
    } else {
        // Close the statement
        $stmt->close();

        // Close the connection
        $conn->close();

        // Use SweetAlert2 for error message
        echo "<script>";
        echo "Swal.fire({
            icon: 'error',
            title: 'Gagal!',
            text: 'Error: " . $stmt->error . "',
        });";
        echo "</script>";
    }
}
?>
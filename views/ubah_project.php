<?php 
include '../config/database.php'; 

$id_data = $_GET['GetID'];
$query = mysqli_query($conn, "SELECT * FROM project WHERE id_project = '".$id_data."'");
while($row = mysqli_fetch_assoc($query)){
    $nama = $row['nama_project'];
}

session_start(); ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include 'partials/scripts.php' ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <title>Area</title>
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
                                <h5 class="card-title">Edit Project</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="update_project.php?id=<?php echo $id_data ?>"
                                    id="formUbahProject">
                                    <div class="mb-4">
                                        <label class="form-label">Nama Project :</label>
                                        <input type="text" class="form-control" name="project"
                                            value="<?php echo $nama ?>" placeholder="Nama Project...">
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
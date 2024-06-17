<?php 
include '../config/database.php'; 
session_start(); 

// Periksa dan sanitasi ID yang diterima dari parameter GET
$id_data = isset($_GET['GetID']) ? mysqli_real_escape_string($conn, $_GET['GetID']) : '';

// Query untuk mengambil data project berdasarkan ID
$query = "SELECT * FROM project WHERE id_project = '$id_data'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $nama2 = $row['nama_project'];
} else {
    // Jika tidak ada data ditemukan, bisa ditangani sesuai kebutuhan, misalnya redirect atau pesan error.
    // Contoh:
    // header("Location: projects.php");
    // exit;
    // Atau tampilkan pesan bahwa data tidak ditemukan.
    echo "Data tidak ditemukan.";
    exit;
}

?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include 'partials/scripts.php'; ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <title>Ubah Project</title>
    <style>
    .action-buttons {
        display: flex;
        gap: 10px;
    }
    </style>
</head>

<body>
    <?php include 'partials/navigation_menu.php'; ?>
    <?php include 'partials/header.php'; ?>
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
                                <form method="POST" action="update_project.php?id=<?php echo $id_data; ?>"
                                    id="formUbahProject">
                                    <div class="mb-4">
                                        <label class="form-label">Nama Project :</label>
                                        <input type="text" class="form-control" name="nama_project"
                                            value="<?php echo htmlspecialchars($nama2); ?>"
                                            placeholder="Nama Project..." required>
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
        </div>
    </main>

    <!--! BEGIN: Vendors JS !-->
    <script src="../assets/vendors/js/vendors.min.js"></script>
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
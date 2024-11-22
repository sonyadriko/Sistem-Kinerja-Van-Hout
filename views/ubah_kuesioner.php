<?php 
include '../config/database.php';
session_start();

$id_data = isset($_GET['GetID']) ? mysqli_real_escape_string($conn, $_GET['GetID']) : '';

$query = "
    SELECT k.*, a.nama_area
    FROM kuesioner k
    JOIN area a ON k.area_id = a.id_area
    WHERE k.id_kuesioner = '$id_data'";

$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $pertanyaan = $row['pertanyaan'];
    $areaid = $row['area_id'];
    $area_name = $row['nama_area'];
} else {
    echo "Data tidak ditemukan.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include 'partials/scripts.php' ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <title>Ubah Pertanyaan</title>
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
                                <h5 class="card-title">Ubah Pertanyaan</h5>
                            </div>
                            <div class="card-body">
                                <form id="formEditPertanyaan" method="POST">
                                    <div class=" mb-4">
                                        <label class="form-label">Area :</label>
                                        <input type="text" class="form-control"
                                            value="<?php echo htmlspecialchars($area_name) ?>" disabled readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Pertanyaan :</label>
                                        <input type="text" class="form-control" name="pertanyaan"
                                            value="<?php echo htmlspecialchars($pertanyaan) ?>"
                                            placeholder="Pertanyaan...">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn btn-user" style="background-color: #ED1C24; color:white;">Submit</button>
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
    <script>
    document.getElementById('formEditPertanyaan').addEventListener('submit', function(event) {
        event.preventDefault();
        var form = this;
        var formData = new FormData(form);

        fetch('update_kuesioner.php?id=<?php echo $id_data ?>', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: data.message
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'kuesioner.php';
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error: ' + data.message
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred while saving the data.'
                });
            });
    });
    </script>
</body>

</html>
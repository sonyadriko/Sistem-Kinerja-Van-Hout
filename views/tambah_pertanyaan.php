<?php include '../config/database.php' ?>
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
                                <h5 class="card-title">Tambah Pertanyaan</h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="tambah_pertanyaan.php" id="formTambahPertanyaan">
                                    <div class=" mb-4">
                                        <label class="form-label">Area :</label>
                                        <select class="form-select form-control" name="area_id"
                                            data-select2-selector="tag1">
                                            <?php
                                            $areas = mysqli_query($conn, "SELECT * FROM area");
                                            while($row = mysqli_fetch_assoc($areas)) {
                                                echo "<option value='" . $row['id_area'] . "' data-bg='" . $row['area_color'] . "'>" . $row['nama_area'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="mb-4">
                                        <label class="form-label">Pertanyaan :</label>
                                        <input type="text" class="form-control" name="pertanyaan"
                                            placeholder="Pertanyaan...">
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
    <!-- <script>
    document.getElementById('formTambahPertanyaan').addEventListener('submit', function(event) {
        event.preventDefault();
        var form = this;
        var formData = new FormData(form);

        fetch(form.action, {
                method: form.method,
                body: formData
            })
            .then(response => response.json()) // Directly parse the response as JSON
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: 'Data saved successfully.'
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
    </script> -->

</body>

</html>
<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the data from the form
    $areaId = $_POST['area_id'];
    $pertanyaan = $_POST['pertanyaan'];

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO kuesioner (area_id, pertanyaan) VALUES (?, ?)");
    $stmt->bind_param("is", $areaId, $pertanyaan);

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
            text: 'Berhasil menambah pertanyaan.',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'kuesioner.php';
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
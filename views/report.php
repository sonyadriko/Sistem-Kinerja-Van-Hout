<?php 
include '../config/database.php'; 
session_start(); 
// Ambil data area
$areas_result = $conn->query("SELECT * FROM area");
$areas = $areas_result->fetch_all(MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include 'partials/scripts.php'; ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <title>Laporan Project</title>
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
                                <h5 class="card-title">Laporan Project</h5>

                                <form action="upload_excel.php" method="POST" enctype="multipart/form-data"
                                    class="d-flex">
                                    <input type="file" name="excelFile" class="form-control-file mr-2">
                                    <button type="submit" class="btn btn-primary">Upload Excel</button>
                                </form>
                                <!-- <a href="hasil.php" class="btn btn-success btn-user ml-3">Hasil</a> -->
                                <!-- </div> -->
                                <a href="hasil.php" class="btn btn-success btn-user">Hasil</a>
                            </div>
                            <div class="card-body custom-card-action p-0">
                                <div class="table-responsive">
                                    <table id="reportTable" class="table table-hover table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Email</th>
                                                <th>Name</th>
                                                <th>Submit at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $get_data = mysqli_query($conn, "SELECT * FROM respondents");
                                            while($display = mysqli_fetch_array($get_data)) {
                                                $id = $display['id'];
                                                $email = $display['email'];
                                                $name = $display['nama'];
                                                $submit_at = $display['date']; // Misalnya ada kolom submit_at untuk tanggal pengisian survei
                                            ?>
                                            <tr>
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $submit_at; ?></td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href='show_data.php?GetID=<?php echo $id; ?>'
                                                            class="btn btn-primary btn-user">Show</a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="card stretch stretch-full">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Daftar Area</h5>
                            </div>
                            <div class="card-body custom-card-action p-0">
                                <div class="table-responsive">
                                    <table id="reportTable2" class="table table-hover table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Nama Area</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($areas as $area) { ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($area['nama_area']); ?></td>
                                                <td>
                                                    <div class="action-buttons">

                                                        <a class="btn btn-primary btn-user"
                                                            href="detail_hasil.php?area_id=<?php echo $area['id_area']; ?>">
                                                            Detail
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Main Content ] end -->
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    $(document).ready(function() {
        $('#reportTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthChange": true,
            "pageLength": 10,
            "language": {
                "paginate": {
                    "previous": "<i class='bi bi-arrow-left'></i>",
                    "next": "<i class='bi bi-arrow-right'></i>"
                }
            }
        });
        $('#reportTable2').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "lengthChange": true,
            "pageLength": 10,
            "language": {
                "paginate": {
                    "previous": "<i class='bi bi-arrow-left'></i>",
                    "next": "<i class='bi bi-arrow-right'></i>"
                }
            }
        });
    });
    </script>
</body>

</html>
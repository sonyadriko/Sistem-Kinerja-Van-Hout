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
                                <h5 class="card-title">Data Area</h5>
                                <!-- <a href="add_data.php" class="btn btn-success btn-user">Tambah Data Area</a> -->
                            </div>
                            <div class="card-body custom-card-action p-0">
                                <div class="table-responsive">
                                    <table id="areaTable" class="table table-hover table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            $get_data = mysqli_query($conn, "select * from area");
                                            while($display = mysqli_fetch_array($get_data)) {
                                                $id = $display['id_area'];
                                                $name = $display['nama_area'];                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $name; ?></td>
                                                <!-- <td>
                                                    <div class="action-buttons">
                                                        <a href='edit_data.php?GetID=<?php echo $id; ?>'
                                                            class="btn btn-primary btn-user">Ubah</a>
                                                        <a href='delete_data.php?Del=<?php echo $id; ?>'
                                                            class="btn btn-danger btn-user">Hapus</a>
                                                    </div>
                                                </td> -->
                                            </tr>
                                            <?php
                                            $no++;
                                                }
                                            ?>
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
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js">
    </script>
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#areaTable').DataTable({
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
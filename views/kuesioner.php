<?php include '../config/database.php';
session_start();
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include 'partials/scripts.php' ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <title>Kuesioner</title>
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
                                <h5 class="card-title">Data Pertanyaan</h5>
                                <a href="tambah_pertanyaan.php" class="btn btn-user"  style="background-color: #ED1C24; color:white;">Tambah
                                    Pertanyaan</a>
                            </div>
                            <div class="card-body custom-card-action p-0">
                                <div class="">
                                    <table id="areaTable" class="table table-hover table-bordered mb-0 p-3">
                                        <thead>
                                            <tr>
                                                <th>Variabel</th>
                                                <th>Pertanyaan</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            $no = 1;
                                            $get_data = mysqli_query($conn, "SELECT kuesioner.id_kuesioner, kuesioner.area_id, kuesioner.pertanyaan, area.nama_area FROM kuesioner INNER JOIN area ON kuesioner.area_id = area.id_area");
                                            while($display = mysqli_fetch_array($get_data)) {
                                                $id = $display['id_kuesioner'];
                                                $idarea = $display['area_id'];
                                                $name = $display['pertanyaan'];                                            
                                                $areaName = $display['nama_area'];
                                            ?>
                                            <tr>
                                                <td><?php echo $areaName; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <a href='ubah_kuesioner.php?GetID=<?php echo $id; ?>'
                                                            class="btn btn-user" style="background-color: #ED1C24; color:white;">Ubah</a>
                                                        <!-- <button class="btn btn-danger btn-user delete-btn"
                                                            data-id="<?php echo $id; ?>">Hapus</button> -->
                                                    </div>
                                                </td>
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
        // Delete button click event
        $('.delete-btn').on('click', function() {
            const kuesionerID = $(this).data('id');
            console.log("Kuesioner ID:", kuesionerID); // Debug log

            Swal.fire({
                title: 'Anda yakin?',
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'delete_kuesioner.php',
                        type: 'POST',
                        data: {
                            id_kuesioner: kuesionerID
                        },
                        success: function(response) {
                            console.log("Response:", response); // Debug log
                            Swal.fire(
                                'Dihapus!',
                                'Data berhasil dihapus.',
                                'success'
                            ).then(() => {
                                window.location.reload();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log("Error:", error); // Debug log
                            Swal.fire(
                                'Gagal!',
                                'Terjadi kesalahan saat menghapus data.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
    </script>
</body>

</html>
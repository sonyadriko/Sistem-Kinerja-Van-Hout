<?php
include '../config/database.php';

// Cek apakah parameter 'GetID' ada di URL
if (isset($_GET['GetID'])) {
    $respondent_id = $_GET['GetID'];

    // Ambil data responden berdasarkan ID
    $stmt = $conn->prepare("SELECT * FROM respondents WHERE id = ?");
    $stmt->bind_param("i", $respondent_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $respondent = $result->fetch_assoc();

    // Ambil jawaban kuesioner dari responden tersebut
    $stmt = $conn->prepare("SELECT * FROM jawaban j JOIN kuesioner k ON j.kuesioner_id = k.id_kuesioner WHERE j.respondents_id = ?");
    $stmt->bind_param("i", $respondent_id);
    $stmt->execute();
    $jawaban_result = $stmt->get_result();
    $jawaban_data = $jawaban_result->fetch_all(MYSQLI_ASSOC);

    // Ambil nama area jika ada tabel area
    $areas_result = $conn->query("SELECT * FROM area");
    $areas = $areas_result->fetch_all(MYSQLI_ASSOC);
    $area_names = [];
    foreach ($areas as $area) {
        $area_names[$area['id_area']] = $area['nama_area'];
    }

    // Kelompokkan pertanyaan berdasarkan area_id
    $questions_by_area = [];
    foreach ($jawaban_data as $jawaban) {
        $questions_by_area[$jawaban['area_id']][] = $jawaban;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID responden tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'partials/scripts.php'; ?>
    <title>Detail Jawaban Responden</title>
    <style>
    .question-section {
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
    }

    .question-section h6 {
        margin-bottom: 15px;
    }

    .form-check-group {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
    }

    .form-check-group h6 {
        margin-bottom: 10px;
    }

    .form-checks {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .form-check {
        margin-bottom: 10px;
    }

    .area-section {
        margin-bottom: 40px;
    }

    .area-section h4 {
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
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
                                <h5 class="card-title">Detail Jawaban Responden</h5>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label" for="nama" style="font-size: 16px;">Nama:</label>
                                    <input type="text" id="nama" name="nama"
                                        value="<?php echo htmlspecialchars($respondent['nama']); ?>" readonly disabled
                                        style="background-color: #f2f2f2; font-family: Arial; font-size: 14px;">
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="email" style="font-size: 16px;">Email:</label>
                                    <input type="email" id="email" name="email"
                                        value="<?php echo htmlspecialchars($respondent['email']); ?>" readonly disabled
                                        style="background-color: #f2f2f2; font-family: Arial; font-size: 14px;">
                                </div>
                                <div>
                                    <!-- <h2>Nama: <?php echo htmlspecialchars($respondent['nama']); ?></h2>
                                    <h2>Email: <?php echo htmlspecialchars($respondent['email']); ?></h2> -->
                                    <?php 
                                    $question_number = 1;
                                    foreach ($questions_by_area as $area_id => $questions) { ?>
                                    <div class="area-section">
                                        <h4><?php echo htmlspecialchars($area_names[$area_id]); ?></h4>
                                        <?php foreach ($questions as $jawaban) { ?>
                                        <div class="question-section">
                                            <div class="form-check-group">
                                                <h6><?php echo $question_number . ". " . htmlspecialchars($jawaban['pertanyaan']); ?>
                                                </h6>
                                                <div class="form-checks">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="jawaban[<?php echo $jawaban['kuesioner_id']; ?>]"
                                                            value="Sangat Tidak Setuju"
                                                            <?php echo $jawaban['jawaban'] == 'Sangat Tidak Setuju' ? 'checked' : ''; ?>
                                                            disabled>
                                                        <label class="form-check-label">Sangat Tidak Setuju</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="jawaban[<?php echo $jawaban['kuesioner_id']; ?>]"
                                                            value="Tidak Setuju"
                                                            <?php echo $jawaban['jawaban'] == 'Tidak Setuju' ? 'checked' : ''; ?>
                                                            disabled>
                                                        <label class="form-check-label">Tidak Setuju</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="jawaban[<?php echo $jawaban['kuesioner_id']; ?>]"
                                                            value="Netral"
                                                            <?php echo $jawaban['jawaban'] == 'Netral' ? 'checked' : ''; ?>
                                                            disabled>
                                                        <label class="form-check-label">Netral</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="jawaban[<?php echo $jawaban['kuesioner_id']; ?>]"
                                                            value="Setuju"
                                                            <?php echo $jawaban['jawaban'] == 'Setuju' ? 'checked' : ''; ?>
                                                            disabled>
                                                        <label class="form-check-label">Setuju</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="jawaban[<?php echo $jawaban['kuesioner_id']; ?>]"
                                                            value="Sangat Setuju"
                                                            <?php echo $jawaban['jawaban'] == 'Sangat Setuju' ? 'checked' : ''; ?>
                                                            disabled>
                                                        <label class="form-check-label">Sangat Setuju</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php 
                                       $question_number++;
                                       } ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
</body>

</html>
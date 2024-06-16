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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jawaban Responden</title>
    <style>
    .detail-container {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 60%;
    }

    .detail-container h1,
    .detail-container h2 {
        margin-top: 0;
    }

    .detail-container h2 {
        margin-bottom: 20px;
    }

    .detail-container p {
        font-size: 18px;
        margin: 10px 0;
    }

    .detail-container .question {
        margin-top: 20px;
        font-weight: bold;
    }

    .detail-container .answer {
        margin-bottom: 20px;
    }

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
        display: inline-block;
        align-items: center;
    }

    .form-check-group h6 {
        flex: 1;
    }

    .form-checks {
        flex: 2;
        display: flex;
        flex-direction: column;
    }

    .form-check {
        margin-bottom: 10px;
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
                                <div>
                                    <h2>Nama: <?php echo htmlspecialchars($respondent['nama']); ?></h2>
                                    <h2>Email: <?php echo htmlspecialchars($respondent['email']); ?></h2>
                                    <?php foreach ($jawaban_data as $jawaban) { ?>
                                    <div class="question-section">
                                        <div class="form-check-group">
                                            <h6><?php echo htmlspecialchars($jawaban['pertanyaan']); ?></h6>
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
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
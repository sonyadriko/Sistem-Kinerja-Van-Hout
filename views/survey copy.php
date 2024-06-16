<?php
include '../config/database.php';

// Mulai sesi untuk menangani autentikasi pengguna jika diperlukan
session_start();

// Cek apakah parameter 'link' ada di URL
if (isset($_GET['link'])) {
    $unique_link = $_GET['link'];

    // Prepare the SQL statement to get the project based on the unique link
    $stmt = $conn->prepare("SELECT * FROM project WHERE link = ?");
    $stmt->bind_param("s", $unique_link);

    // Execute the statement
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a project was found
    if ($result->num_rows == 1) {
        // Fetch the project data
        $project = $result->fetch_assoc();

        // Fetch the questionnaire related to this project (Assuming you have a related table for questionnaires)
        $stmt = $conn->prepare("SELECT * FROM kuesioner ORDER BY area_id, id_kuesioner");
        $stmt->execute();
        $kuesioner_result = $stmt->get_result();
        $kuesioner_data = $kuesioner_result->fetch_all(MYSQLI_ASSOC);

        // Group the questions by area_id
        $questions_by_area = [];
        foreach ($kuesioner_data as $kuesioner) {
            $questions_by_area[$kuesioner['area_id']][] = $kuesioner;
        }

        // Fetch the area names if you have a table for areas (assuming you have a table named 'areas')
        $areas_result = $conn->query("SELECT * FROM area");
        $areas = $areas_result->fetch_all(MYSQLI_ASSOC);
        $area_names = [];
        foreach ($areas as $area) {
            $area_names[$area['id_area']] = $area['nama_area'];
        }

        // Display the questionnaire form
        ?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include 'partials/scripts.php'; ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    <title>Kuesioner untuk Project: <?php echo htmlspecialchars($project['nama_project']); ?></title>
    <style>
    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .form-check-inline {
        display: inline-block;
        margin-right: 10px;
    }

    .question-section {
        margin-bottom: 20px;
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .question-section h6 {
        margin: 0;
    }

    .area-section {
        margin-bottom: 40px;
    }

    .area-section h4 {
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <?php include 'partials/navigation_menu.php'; ?>
    <?php include 'partials/header.php'; ?>
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card stretch stretch-full">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title">Kuesioner untuk Project:
                                    <?php echo htmlspecialchars($project['nama_project']); ?></h5>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="submit_kuesioner.php">
                                    <?php foreach ($questions_by_area as $area_id => $questions) { ?>
                                    <div class="area-section">
                                        <h4><?php echo htmlspecialchars($area_names[$area_id]); ?></h4>
                                        <?php foreach ($questions as $kuesioner) { ?>
                                        <div class="question-section">
                                            <h6><?php echo htmlspecialchars($kuesioner['pertanyaan']); ?></h6>
                                            <div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="jawaban[<?php echo $kuesioner['id_kuesioner']; ?>]"
                                                        value="Sangat Tidak Setuju" required>
                                                    <label class="form-check-label">Sangat Tidak Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="jawaban[<?php echo $kuesioner['id_kuesioner']; ?>]"
                                                        value="Tidak Setuju">
                                                    <label class="form-check-label">Tidak Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="jawaban[<?php echo $kuesioner['id_kuesioner']; ?>]"
                                                        value="Netral">
                                                    <label class="form-check-label">Netral</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="jawaban[<?php echo $kuesioner['id_kuesioner']; ?>]"
                                                        value="Setuju">
                                                    <label class="form-check-label">Setuju</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio"
                                                        name="jawaban[<?php echo $kuesioner['id_kuesioner']; ?>]"
                                                        value="Sangat Setuju">
                                                    <label class="form-check-label">Sangat Setuju</label>
                                                </div>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
<?php
    } else {
        echo "Tautan kuesioner tidak valid.";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Tautan kuesioner tidak ditemukan.";
}

// Close the connection
$conn->close();
?>
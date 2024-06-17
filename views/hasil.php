<?php
include '../config/database.php';

// Ambil semua data
$stmt = $conn->prepare('SELECT * FROM jawaban j JOIN kuesioner k ON j.kuesioner_id = k.id_kuesioner');
$stmt->execute();
$jawaban_result = $stmt->get_result();
$jawaban_data = $jawaban_result->fetch_all(MYSQLI_ASSOC);

// Skor untuk setiap jawaban
$skor_mapping = [
    'Sangat Tidak Setuju' => 1,
    'Tidak Setuju' => 2,
    'Netral' => 3,
    'Setuju' => 4,
    'Sangat Setuju' => 5,
];

// Menghitung nilai kematangan atribut
$skor_pertanyaan = [];
foreach ($jawaban_data as $jawaban) {
    $kuesioner_id = $jawaban['kuesioner_id'];
    $skor = $skor_mapping[$jawaban['jawaban']];
    if (!isset($skor_pertanyaan[$kuesioner_id])) {
        $skor_pertanyaan[$kuesioner_id] = [];
    }
    $skor_pertanyaan[$kuesioner_id][] = $skor;
}

$nilai_kematangan_atribut = [];
foreach ($skor_pertanyaan as $kuesioner_id => $skors) {
    $nilai_kematangan_atribut[$kuesioner_id] = array_sum($skors) / count($skors);
}

// Mengelompokkan pertanyaan berdasarkan variabel
$variabel_mapping = [
    'Intention and Support' => [1, 2, 3, 4], // Gantilah sesuai dengan id_kuesioner untuk variabel ini
    'Working Relationship' => [5, 6, 7, 8],
    'Shared Knowledge' => [9, 10, 11, 12],
    'IT Project and Planning' => [13, 14, 15, 16],
    'IT Performance' => [17, 18, 19, 20],
];

$nilai_kematangan_variabel = [];
foreach ($variabel_mapping as $variabel => $kuesioner_ids) {
    $total_skor = 0;
    $jumlah_pertanyaan = 0;
    foreach ($kuesioner_ids as $kuesioner_id) {
        if (isset($nilai_kematangan_atribut[$kuesioner_id])) {
            $total_skor += $nilai_kematangan_atribut[$kuesioner_id];
            $jumlah_pertanyaan++;
        }
    }
    if ($jumlah_pertanyaan > 0) {
        $nilai_kematangan_variabel[$variabel] = $total_skor / $jumlah_pertanyaan;
    } else {
        $nilai_kematangan_variabel[$variabel] = 0;
    }
}

// Menghitung nilai kematangan perusahaan
$total_nilai_kematangan = array_sum($nilai_kematangan_variabel);
$jumlah_variabel = count($nilai_kematangan_variabel);
$nilai_kematangan_perusahaan = $total_nilai_kematangan / $jumlah_variabel;

// Menentukan level kematangan berdasarkan nilai kematangan perusahaan
if ($nilai_kematangan_perusahaan >= 0 && $nilai_kematangan_perusahaan <= 1.99) {
    $level_kematangan = 1;
} elseif ($nilai_kematangan_perusahaan >= 2.0 && $nilai_kematangan_perusahaan <= 2.99) {
    $level_kematangan = 2;
} elseif ($nilai_kematangan_perusahaan >= 3.0 && $nilai_kematangan_perusahaan <= 3.99) {
    $level_kematangan = 3;
} elseif ($nilai_kematangan_perusahaan >= 4.0 && $nilai_kematangan_perusahaan <= 4.99) {
    $level_kematangan = 4;
} elseif ($nilai_kematangan_perusahaan == 5.0) {
    $level_kematangan = 5;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'partials/scripts.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Perhitungan</title>
    <style>
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid black;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
    }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                                <h5 class="card-title">Hasil Perhitungan Kematangan</h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <h3>Nilai Kematangan Atribut untuk Setiap Pertanyaan</h3>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>Nomor</th>
                                                <th>Pertanyaan</th>
                                                <th>Nilai Kematangan Atribut</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            // Menampilkan hanya satu entri per pertanyaan
                                            $pertanyaan_ids = [];
                                            foreach ($jawaban_data as $jawaban) {
                                                $kuesioner_id = $jawaban['kuesioner_id'];
                                                if (!in_array($kuesioner_id, $pertanyaan_ids)) {
                                                    $pertanyaan_ids[] = $kuesioner_id;
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo htmlspecialchars($jawaban['pertanyaan']); ?></td>
                                                <td><?php echo number_format($nilai_kematangan_atribut[$kuesioner_id], 2); ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $no++;
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <br>
                                    <table border="1">
                                        <thead>
                                            <tr>
                                                <th>Variabel</th>
                                                <th>Nilai Kematangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($nilai_kematangan_variabel as $variabel => $nilai) { ?>
                                            <tr>
                                                <td><?php echo htmlspecialchars($variabel); ?></td>
                                                <td><?php echo number_format($nilai, 2); ?></td>
                                            </tr>
                                            <?php } ?>
                                            <tr>
                                                <td><strong>Nilai Kematangan Perusahaan</strong></td>
                                                <td><strong><?php echo number_format($nilai_kematangan_perusahaan, 2); ?></strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>Level Kematangan</strong></td>
                                                <td><strong><?php echo $level_kematangan; ?></strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <canvas id="maturityChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        var ctx = document.getElementById('maturityChart').getContext('2d');
        var maturityChart = new Chart(ctx, {
            type: 'radar',
            data: {
                labels: [<?php foreach ($nilai_kematangan_variabel as $variabel => $nilai) {
                    echo '"' . htmlspecialchars($variabel) . '", ';
                } ?>],
                datasets: [{
                    label: 'Nilai Kematangan',
                    data: [<?php foreach ($nilai_kematangan_variabel as $nilai) {
                        echo number_format($nilai, 2) . ', ';
                    } ?>],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 5
                    }
                }
            }
        });
    });
    </script>
    <!-- grafik batang -->
    <!-- <script>
    document.addEventListener('DOMContentLoaded', (event) => {
        var ctx = document.getElementById('maturityChart').getContext('2d');
        var maturityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [<?php foreach ($nilai_kematangan_variabel as $variabel => $nilai) {
                        echo '"' . htmlspecialchars($variabel) . '", ';
                    } ?>],
                datasets: [{
                    label: 'Nilai Kematangan',
                    data: [<?php foreach ($nilai_kematangan_variabel as $nilai) {
                            echo number_format($nilai, 2) . ', ';
                        } ?>],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 5
                    }
                }
            }
        });
    });
    </script> -->
</body>

</html>
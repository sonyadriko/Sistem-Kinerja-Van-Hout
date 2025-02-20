<?php
include '../config/database.php';
session_start(); 

if (isset($_GET['area_id']) && isset($_GET['project_id'])) {
    $area_id = $_GET['area_id'];
    $project_id = $_GET['project_id'];

    // Ambil data area
    $stmt = $conn->prepare("SELECT * FROM area WHERE id_area = ?");
    $stmt->bind_param("i", $area_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $area = $result->fetch_assoc();

    // Ambil pertanyaan untuk area
    $stmt = $conn->prepare("SELECT * FROM kuesioner WHERE area_id = ?");
    $stmt->bind_param("i", $area_id);
    $stmt->execute();
    $pertanyaan_result = $stmt->get_result();
    $pertanyaan_data = $pertanyaan_result->fetch_all(MYSQLI_ASSOC);

    // Ambil jawaban kuesioner dari responden berdasarkan area dan project
    $stmt = $conn->prepare(
        "SELECT r.nama, r.email, j.kuesioner_id, j.jawaban 
         FROM jawaban j 
         JOIN respondents r ON j.respondents_id = r.id 
         JOIN kuesioner kq ON j.kuesioner_id = kq.id_kuesioner
         WHERE kq.area_id = ? AND r.id_project = ?"
    );
    $stmt->bind_param("ii", $area_id, $project_id);
    $stmt->execute();
    $jawaban_result = $stmt->get_result();
    $jawaban_data = $jawaban_result->fetch_all(MYSQLI_ASSOC);

    $stmt->close();
    $conn->close();

    // Mengelompokkan jawaban berdasarkan responden
    $responden_jawaban = [];
    foreach ($jawaban_data as $jawaban) {
        $responden_jawaban[$jawaban['email']]['nama'] = $jawaban['nama'];
        $responden_jawaban[$jawaban['email']]['jawaban'][$jawaban['kuesioner_id']] = $jawaban['jawaban'];
    }

    // Konversi jawaban ke nilai numerik
    $jawaban_mapping = [
        'Sangat Tidak Setuju' => 1,
        'Tidak Setuju' => 2,
        'Netral' => 3,
        'Setuju' => 4,
        'Sangat Setuju' => 5
    ];
      // Menghitung rata-rata untuk setiap pertanyaan
      $rata_rata_jawaban = [];
      foreach ($pertanyaan_data as $pertanyaan) {
          $total = 0;
          $count = 0;
          foreach ($responden_jawaban as $data) {
              if (isset($data['jawaban'][$pertanyaan['id_kuesioner']])) {
                  $jawaban_nilai = $jawaban_mapping[$data['jawaban'][$pertanyaan['id_kuesioner']]];
                  $total += $jawaban_nilai;
                  $count++;
              }
          }
          $rata_rata_jawaban[$pertanyaan['id_kuesioner']] = $count > 0 ? $total / $count : 0;
      }
} else {
    echo "ID area tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'partials/scripts.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Jawaban Variabel: <?php echo htmlspecialchars($area['nama_area']); ?></title>
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
                                <h5 class="card-title">Detail Jawaban Responden - Variabel:
                                    <?php echo htmlspecialchars($area['nama_area']); ?></h5>
                            </div>
                            <div class="card-body">
                                <div>
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <?php foreach ($pertanyaan_data as $index => $pertanyaan) { ?>
                                                <th><?php echo $index + 1; ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $no = 1;
                                            foreach ($responden_jawaban as $email => $data) { ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($data['nama']); ?></td>
                                                <?php foreach ($pertanyaan_data as $pertanyaan) {
                                                    $jawaban_nilai = $jawaban_mapping[$data['jawaban'][$pertanyaan['id_kuesioner']] ?? ''] ?? '';
                                                ?>
                                                <td><?php echo htmlspecialchars($jawaban_nilai); ?></td>
                                                <?php } ?>
                                            </tr>
                                            <?php } ?>
                                            <td colspan="2"><strong>Rata-rata</strong></td>
                                            <?php foreach ($pertanyaan_data as $pertanyaan) { ?>
                                            <td><strong><?php echo number_format($rata_rata_jawaban[$pertanyaan['id_kuesioner']], 2); ?></strong>
                                            </td>
                                            <?php } ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <br>
                                    <a href="javascript:history.go(-1)">Kembali ke Halaman Sebelumnya</a>
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
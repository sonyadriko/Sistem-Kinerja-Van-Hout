<?php
  // Load PhpSpreadsheet
require '../vendor/autoload.php'; // Pastikan Anda sudah menginstall PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\IOFactory;

include '../config/database.php'; 

date_default_timezone_set('Asia/Jakarta'); // Zona waktu WIB

// Cek apakah file diupload
if (isset($_FILES['excelFile'])) {
    $file_tmp = $_FILES['excelFile']['tmp_name'];
    $file_name = $_FILES['excelFile']['name'];
    $upload_dir = 'uploads/';

    // Pastikan direktori upload ada
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Pindahkan file ke direktori upload
    if (move_uploaded_file($file_tmp, $upload_dir . $file_name)) {
        echo "File berhasil diupload.";
        // Baca file Excel
        $spreadsheet = IOFactory::load($upload_dir . $file_name);
        $worksheet = $spreadsheet->getActiveSheet();
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Mengambil semua data dari worksheet
        $data = $worksheet->toArray();

        // Ambil header untuk menentukan kuesioner_id
        $header = $data[0];

        // Menyimpan data respondents dan jawaban
        $respondents = [];
        $jawaban = [];
        
        for ($row = 1; $row < count($data); $row++) {
            // Ambil nama, email, dan tanggal
            $name = $data[$row][0];
            $email = $data[$row][1];
            $date = date('Y-m-d H:i:s'); // Format datetime dengan jam

            // Insert ke tabel respondents
            $stmt = $conn->prepare("INSERT INTO respondents (nama, email, date) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $name, $email, $date);
            $stmt->execute();
            $respondents_id = $stmt->insert_id; // Ambil ID terakhir yang dimasukkan


            // Mengonversi jawaban
            for ($col = 2; $col < count($data[$row]); $col++) {
                $jawabanAngka = $data[$row][$col];

                // Konversi jawaban ke string deskriptif
                switch ($jawabanAngka) {
                    case 1:
                        $jawabanDeskriptif = "Sangat Tidak Setuju";
                        break;
                    case 2:
                        $jawabanDeskriptif = "Tidak Setuju";
                        break;
                    case 3:
                        $jawabanDeskriptif = "Netral";
                        break;
                    case 4:
                        $jawabanDeskriptif = "Setuju";
                        break;
                    case 5:
                        $jawabanDeskriptif = "Sangat Setuju";
                        break;
                    default:
                        $jawabanDeskriptif = null; // Jika tidak ada jawaban yang valid
                        break;
                }

                // Menyimpan jawaban
                if ($jawabanDeskriptif !== null) {
                    $kuesioner_id = $header[$col]; // Menggunakan header untuk kuesioner_id
                    $stmtJawaban = $conn->prepare("INSERT INTO jawaban (respondents_id, kuesioner_id, jawaban) VALUES (?, ?, ?)");
                    $stmtJawaban->bind_param("iss", $respondents_id, $kuesioner_id, $jawabanDeskriptif);
                    $stmtJawaban->execute();
                }
            }
        }

        // echo "Data berhasil disimpan ke database.";
        header("Location: project.php");
        exit();
    } else {
        echo "Gagal mengupload file.";
    }
} else {
    echo "Tidak ada file yang diupload.";
}

$conn->close();
?>
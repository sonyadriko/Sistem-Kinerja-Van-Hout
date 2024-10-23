<?php
include '../config/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jawaban = $_POST['jawaban'];
    date_default_timezone_set('Asia/Jakarta');
    $date = date('Y-m-d H:i:s');
    $project_id = isset($_POST['project_id']) ? $_POST['project_id'] : null;


    // Prepare the SQL statement to insert the user's name, email, and date
    $stmt = $conn->prepare("INSERT INTO respondents (id_project, nama, email, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $project_id, $nama, $email, $date);

    if ($stmt->execute()) {
        $respondent_id = $stmt->insert_id;
        $stmt->close();

        // Prepare the SQL statement to insert answers
        $stmt = $conn->prepare("INSERT INTO jawaban (respondents_id, kuesioner_id, jawaban) VALUES (?, ?, ?)");

        foreach ($jawaban as $id_kuesioner => $jawab) {
            $stmt->bind_param("iis", $respondent_id, $id_kuesioner, $jawab);

            // Execute the statement
            if (!$stmt->execute()) {
                echo "Error: " . $stmt->error;
                $stmt->close();
                $conn->close();
                exit();
            }
        }

        // Close the statement
        $stmt->close();

        // Close the connection
        $conn->close();

        // Use SweetAlert2 for success message
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Terima Kasih!',
                    text: 'Jawaban Anda telah berhasil disimpan.',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'thank_you.php';
                    }
                });
            });
        </script>";
    } else {
        echo "Error: " . $stmt->error;
        $stmt->close();
        $conn->close();
    }
} else {
    echo "Invalid request method.";
}
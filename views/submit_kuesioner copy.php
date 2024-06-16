<?php
include '../config/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jawaban = $_POST['jawaban'];

    // Prepare the SQL statement to insert answers
    $stmt = $conn->prepare("INSERT INTO jawaban (kuesioner_id, jawaban) VALUES (?, ?)");

    // Loop through each answer and insert it into the database
    foreach ($jawaban as $id_kuesioner => $jawab) {
        $stmt->bind_param("is", $id_kuesioner, $jawab);

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
    echo "<script>";
    echo "Swal.fire({
        icon: 'success',
        title: 'Terima Kasih!',
        text: 'Jawaban Anda telah berhasil disimpan.',
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'thank_you.php';
        }
    });";
    echo "</script>";
} else {
    echo "Invalid request method.";
}
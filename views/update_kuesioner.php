<?php 
include '../config/database.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_data = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
    $pertanyaan = isset($_POST['pertanyaan']) ? mysqli_real_escape_string($conn, $_POST['pertanyaan']) : '';

    // Prepare the SQL statement to avoid SQL injection
    $stmt = $conn->prepare("UPDATE kuesioner SET pertanyaan = ? WHERE id_kuesioner = ?");
    $stmt->bind_param("si", $pertanyaan, $id_data);

    // Execute the statement
    if ($stmt->execute()) {
        // Close the statement
        $stmt->close();
        // Close the connection
        $conn->close();
        // Return success response
        echo json_encode(['success' => true, 'message' => 'Berhasil mengubah pertanyaan.']);
    } else {
        // Capture error message
        $error_message = $stmt->error;
        // Close the statement
        $stmt->close();
        // Close the connection
        $conn->close();
        // Return error response
        echo json_encode(['success' => false, 'message' => $error_message]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}
?>
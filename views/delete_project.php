<?php
include '../config/database.php';

header('Content-Type: application/json'); // Tambahkan header JSON

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id_project']) && is_numeric($_POST['id_project'])) {
        $id_project = intval($_POST['id_project']); // Validasi dan konversi ke integer

        // Debug log
        error_log("Received ID: " . $id_project);

        // Prepare the SQL statement to avoid SQL injection
        if ($stmt = $conn->prepare("DELETE FROM project WHERE id_project = ?")) {
            $stmt->bind_param("i", $id_project);

            // Execute the statement
            if ($stmt->execute()) {
                echo json_encode(['success' => true, 'message' => 'Data berhasil dihapus.']);
            } else {
                // Debug log
                error_log("Error: " . $stmt->error);
                echo json_encode(['success' => false, 'message' => 'Error: ' . $stmt->error]);
            }

            // Close the statement
            $stmt->close();
        } else {
            // Debug log
            error_log("Prepare failed: " . $conn->error);
            echo json_encode(['success' => false, 'message' => 'Prepare failed: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid project ID.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
}

// Close the connection
$conn->close();
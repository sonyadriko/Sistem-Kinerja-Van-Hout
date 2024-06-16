<?php
include '../config/database.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_data = $_GET['id'];
    $nama = $_POST['project'];
    $query = "UPDATE project SET nama_project = '".$nama."' WHERE id_project = '".$id_data."'";
    $result = mysqli_query($conn, $query);
    if($result){
        $status = 'success';
        $message = 'Project updated successfully.';
    } else {
        $status = 'error';
        $message = 'Failed to update project. Please try again.';
    }
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Update Status</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script>
    Swal.fire({
        title: '<?php echo ucfirst($status); ?>!',
        text: '<?php echo $message; ?>',
        icon: '<?php echo $status; ?>',
        confirmButtonText: 'OK'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href =
                '<?php echo $status == "success" ? "project.php" : "edit_project.php?GetID=$id_data"; ?>';
        }
    });
    </script>
</body>

</html>
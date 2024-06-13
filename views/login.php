<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include 'partials/scripts.php' ?>
    <title>Login</title>
</head>

<body>
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="auth-minimal-wrapper">
        <div class="auth-minimal-inner">
            <div class="minimal-card-wrapper">
                <div class="card mb-4 mt-5 mx-4 mx-sm-0 position-relative">
                    <div
                        class="wd-50 bg-white p-2 rounded-circle shadow-lg position-absolute translate-middle top-0 start-50">
                        <img src="../assets/images/logo-abbr.png" alt="" class="img-fluid">
                    </div>
                    <div class="card-body p-sm-5">
                        <h2 class="fs-20 fw-bolder mb-4">Login</h2>
                        <h4 class="fs-13 fw-bold mb-2">Login to your account</h4>
                        <p class="fs-12 fw-medium text-muted">Thank you for get back <strong>Van Hout</strong> web
                            applications, let's access our the best recommendation for you.</p>
                        <form action="login.php" method="POST" class="w-100 mt-4 pt-2">
                            <div class="mb-4">
                                <input type="text" name="username" id="username" class="form-control"
                                    placeholder="Username" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Password" required>
                            </div>
                            <div class="mt-5">
                                <button type="submit" style="background-color: #ED1C24; color:#FFFFFF;"
                                    class="btn btn-lg w-100">Login</button>
                            </div>
                        </form>
                        <div class="mt-5 text-muted">
                            <span> Don't have an account?</span>
                            <a href="auth-register-minimal.html" class="fw-bold">Create an Account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!--! BEGIN: Vendors JS !-->
    <script src="../assets/vendors/js/vendors.min.js"></script>
    <script src="../assets/js/common-init.min.js"></script>
    <script src="../assets/js/theme-customizer-init.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
<?php
    include '../config/database.php';

    session_start();

    if (isset($_SESSION['id_users'], $_SESSION['nama'])) {
        header("Location: index.php");
        exit();
    }

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();

            if ($password == $row['password']) {
                $_SESSION['id_users'] = $row['id_users'];
                $_SESSION['nama'] = $row['nama'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['role'] = $row['role'];

                echo "<script>
                    Swal.fire({
                        title: 'Login Berhasil',
                        icon: 'success'
                    }).then(() => {
                        location='index.php';
                    });
                </script>";
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Login Gagal',
                        text: 'Username dan Password Salah',
                        icon: 'error'
                    }).then(() => {
                        history.back();
                    });
                </script>";
            }
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Login Gagal',
                    text: 'Username dan Password Salah',
                    icon: 'error'
                }).then(() => {
                    history.back();
                });
            </script>";
        }

        $stmt->close();
        $conn->close();
    }
?>
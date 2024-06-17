<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php include 'partials/scripts.php' ?>
    <title>Login</title>
</head>

<body>
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
                        <p class="fs-12 fw-medium text-muted">Thank you for getting back to <strong>Van Hout</strong>
                            web
                            applications, let's access our best recommendations for you.</p>
                        <form id="loginForm" class="w-100 mt-4 pt-2">
                            <div class="mb-4">
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email"
                                    required>
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
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../assets/vendors/js/vendors.min.js"></script>
    <script src="../assets/js/common-init.min.js"></script>
    <script src="../assets/js/theme-customizer-init.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch('proses_login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text()) // change to text to inspect the raw response
            .then(data => {
                console.log('Raw response:', data); // Log the raw response
                const jsonData = JSON.parse(data); // Parse the JSON data
                if (jsonData.success) {
                    Swal.fire({
                        title: 'Login Berhasil',
                        icon: 'success'
                    }).then(() => {
                        location = 'index.php';
                    });
                } else {
                    Swal.fire({
                        title: 'Login Gagal',
                        text: jsonData.message,
                        icon: 'error'
                    }).then(() => {
                        history.back();
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
    </script>
</body>

</html>
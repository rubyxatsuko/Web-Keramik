<?php
include 'connection.php';

// Memperoleh nilai dari form atau dari sumber lainnya
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $uname = $_POST['uname'];
    $upwd = $_POST['upwd'];
    $date = date('Y-m-d H:i:s');

    // Menentukan role secara otomatis
    $role = 'user'; // Secara default diatur sebagai pengguna biasa

    // Email admin yang telah ditentukan
    $admin_email = 'admin@example.com';

    // Jika email yang dimasukkan adalah email admin, maka atur rolenya sebagai admin
    if ($email === $admin_email) {
        $role = 'admin';
    }

    // Selanjutnya, jalankan query untuk menyimpan data ke database
    $result2 = mysqli_query($conn, "INSERT INTO tbl_multilevel (name, email, uname, upwd, role, added_date) VALUES ('$name', '$email', '$uname', '$upwd', '$role', '$date')");

    // Periksa apakah query berhasil dieksekusi
    if ($result2) {
        // Redirect ke halaman login dengan pesan alert
        echo '<script>';
        echo 'alert("Registrasi berhasil!");';
        echo 'window.location.href = "login.php";';
        echo '</script>';
        exit; // Penting: pastikan untuk keluar dari script setelah mengarahkan pengguna
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration | WM Keramik</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.min.css" rel="stylesheet" />
  <style>
    .divider:after,
    .divider:before {
      content: "";
      flex: 1;
      height: 1px;
      background: #eee;
    }

    .h-custom {
      height: calc(100% - 73px);
    }

    @media (max-width: 450px) {
      .h-custom {
        height: 100%;
      }
    }
  </style>
</head>

<body>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="assets/img/log2.png" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form method="post">

            <div class="divider d-flex align-items-center mb-3">
              <p class="text-center fw-bold mx-3 mb-0">Sign Up</p>
            </div>
            <div class="mb-3 mt-3">
              <label for="name">Nama:</label>
              <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name">
            </div>
            <div class="mb-3 mt-3">
              <label for="email">Email:</label>
              <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email">
            </div>
            <div class="mb-3 mt-3">
              <label for="uname">Username:</label>
              <input type="text" class="form-control" id="uname" placeholder="Enter Username" name="uname">
            </div>
            <div class="mb-3">
              <label for="upwd">Password:</label>
              <input type="password" class="form-control" id="upwd" placeholder="Enter Password" name="upwd">
            </div>


            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" name="submit" class="btn btn-info btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Register</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">have an account? <a href="login.php" class="link-danger">Sign In</a></p>
            </div>

          </form>
        </div>
      </div>
    </div>
    <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-info">
      <!-- Copyright -->
      <div class="text-white mb-3 mb-md-0">
        Copyright © 2024. Wahana Mulya
      </div>
      <!-- Copyright -->

      <!-- Right -->
      <div>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="#!" class="text-white me-4">
          <i class="fab fa-google"></i>
        </a>
        <a href="#!" class="text-white">
          <i class="fab fa-linkedin-in"></i>
        </a>
      </div>
      <!-- Right -->
    </div>
  </section>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.1.0/mdb.umd.min.js"></script>
</body>


</html>
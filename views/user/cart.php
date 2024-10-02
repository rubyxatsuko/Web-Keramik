<?php
// Menghubungkan ke database
@include '../../connection.php';

// Mengaktifkan session
session_start();

// Buat kondisi ketika mau login
// Jika tidak login maka tidak bisa masuk ke halaman ini


// Membuat update product
if (isset($_POST['update_btn_cart'])) {
    $update_value   = $_POST['update_quantity'];
    $update_id      = $_POST['id_update_quantity'];
    $update_query   = mysqli_query($conn, "UPDATE tbl_cart SET quantity_product = '$update_value' WHERE cart_id = '$update_id'");
    if ($update_query) {
        header("location: cart.php");
    };
};

// Membuat delete product
if (isset($_GET['remove'])) {
    $id_remove = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM tbl_cart WHERE cart_id = '$id_remove'");
    header("location: cart.php");
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WM Keramik - Dashboard</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Caveat+Brush&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

</head>

<body>
    <nav class="navbar navbar-expand-md bg-light sticky-top border-bottom" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand text-info font-weight-bold" href=""><b>WM Keramik</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar">
                <ul class="navbar-nav justify-content-end ">
                    <li class="nav-item"><a class="nav-link mt-1 text-dark" href="index.php">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link mt-1 text-dark" href="index.php">Menu</a></li>
                    <li class="nav-item"><a class="nav-link mt-1 text-dark" href="index.php">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link mt-1 text-dark" href="cart.php">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                            </svg>
                        </a></li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="../../assets/img/undraw_profile.svg" class="rounded-circle" height="30" alt="" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="profile.php">
                                    Profile
                                </a></li>
                            <li><a class="dropdown-item" href="../../logout.php" data-toggle="modal" data-target="#logoutModal">
                                    Logout
                                </a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>

    <div class="container">

        <div class="container-fuild">
            <div style="margin-top: 3rem;">
                <h2 class="text-center">Keranjang Kamu</h2>
                <p class="mt-4" name="date">Tanggal&nbsp;&nbsp;<strong><?php echo date("m/d/Y"); ?></strong></p>
            </div>
        </div>
        <hr>

        <div class="row">
            <div class="col-md-11">
                <table class="table table-responsive-lg table-responsive-md table-responsive-sm text-center mt-3">
                    <thead>
                        <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        $user_id = $_SESSION['user']['id'];
                        $grand_total = 0;
                        $cart_select = mysqli_query($conn, "SELECT * FROM tbl_cart JOIN tbl_product ON tbl_cart.id_product=tbl_product.id_product WHERE user_id = '$user_id'");

                        if (mysqli_num_rows($cart_select) > 0) {
                            while ($row_cart = mysqli_fetch_assoc($cart_select)) {


                        ?>
                                <!-- START: Pesanan 1 -->
                                <tr>
                                    <td><?= $row_cart['name_product']; ?></td>
                                    <td>
                                        Rp <?= number_format($row_cart['price_product']); ?>
                                    </td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="id_update_quantity" value="<?= $row_cart['cart_id']; ?>">
                                            <input type="number" min="1" name="update_quantity" value="<?= $row_cart['quantity_product']; ?>">
                                            <input type="submit" value="update" class="btn btn-dark btn-sm text-white" name="update_btn_cart">
                                        </form>
                                    </td>
                                    <td>
                                        Rp <?php echo $sub_total = $row_cart['price_product'] * $row_cart['quantity_product']; ?>/-
                                    </td>
                                    <td>
                                        <a href="cart.php?remove=<?= $row_cart['cart_id']; ?>" onclick="return confirm('Mau hapus product ini?');" title="Hapus"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <!-- END: Pesanan 1 -->
                        <?php
                                //error_reporting(0);
                                $grand_total += $sub_total;
                            }
                        }
                        ?>

                        <tr>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
        <div class="row">
            <div class="col-md-10 col-sm-12 mt-4 col-sm-10">
                <div class="d-flex justify-content-between">
                    <div class="btn btn-success btn-sm"><a href="index.php" style="text-decoration: none; color: #fff;">Kembali Belanja</a></div>
                </div>
            </div>

            <div class="col-md-10 col-sm-12 col-sm-10">
                <div class="d-flex justify-content-between align-content-center" style="margin-top: 4rem;">
                    <p style="font-size: 18px;">Total Belanja :</p>
                    <input type="hidden" name="" id="" value="<?php $grand_total_real = $grand_total ?>">
                    <p style="font-size: 18px;" class="float-end">Rp <?= number_format($grand_total); ?> /-</p>
                </div>
            </div>
        </div>



        <div class="row">
            <div class="col-md-10 col-sm-12 col-sm-10 mx-auto mt-3 mb-5">
                <div class="d-flex justify-content-center align-content-center">
                    <div class="btn btn-secondary btn-sm <?= ($grand_total > 1) ? '' : 'disabled' ?>">
                        <a class="text-white" style="text-decoration:none;" href="checkout.php" onclick="return confirmCheckout()">Checkout Sekarang</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function confirmCheckout() { // Ambil nilai dari database
                alert("Apakah Anda sudah yakin ingin checkout product tersebut?");
                // Tidak perlu return false di sini
            }
        </script>





    </div>



    <footer class="text-center mt-5 bg-body-tertiary">
        <!-- Grid container -->
        <div class="container pt-4">
            <!-- Section: Social media -->
            <section class="mb-4">
                <!-- Facebook -->
                <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!" role="button" data-mdb-ripple-color="dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951" />
                    </svg></a>

                <!-- Twitter -->
                <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!" role="button" data-mdb-ripple-color="dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                        <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                    </svg></a>

                <!-- Google -->
                <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!" role="button" data-mdb-ripple-color="dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                        <path d="M15.545 6.558a9.4 9.4 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.7 7.7 0 0 1 5.352 2.082l-2.284 2.284A4.35 4.35 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.8 4.8 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.7 3.7 0 0 0 1.599-2.431H8v-3.08z" />
                    </svg></a>

                <!-- Instagram -->
                <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!" role="button" data-mdb-ripple-color="dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-instagram" viewBox="0 0 16 16">
                        <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.9 3.9 0 0 0-1.417.923A3.9 3.9 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.9 3.9 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.9 3.9 0 0 0-.923-1.417A3.9 3.9 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599s.453.546.598.92c.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.5 2.5 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.5 2.5 0 0 1-.92-.598 2.5 2.5 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233s.008-2.388.046-3.231c.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92s.546-.453.92-.598c.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92m-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217m0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334" />
                    </svg></a>

                <!-- Linkedin -->
                <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!" role="button" data-mdb-ripple-color="dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                        <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                    </svg></a>
                <!-- Github -->
                <a data-mdb-ripple-init class="btn btn-link btn-floating btn-lg text-body m-1" href="#!" role="button" data-mdb-ripple-color="dark"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8" />
                    </svg></a>
            </section>
            <!-- Section: Social media -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="text-body" href="">Wahana Mulya</a>
        </div>
        <!-- Copyright -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
<?php

include "../app/db.php";

session_start();

if (isset($_POST['login'])) {
    $username = $_POST['name'];
    $password = $_POST['pass'];
    if ($username == NULL and $password == NULL) {
        echo "<script>alert('Mohon lengkapi username dan password'),
        location.replace('../')</script>";
    } else {
        $login = $conn->query("SELECT * FROM tbl_adm WHERE username = '$username' AND password = '$password'");
        $cek = mysqli_num_rows($login);
        $_SESSION['user'] = $login->fetch_assoc();
        if ($cek > 0) {
            echo "<script>alert('Login berhasil'),
            location.replace('../views/index.php')</script>";
        } else {
            echo "<script>alert('Data login tidak sesuai dengan yang di database'),
            location.replace('../')</script>";
        }
    }
}

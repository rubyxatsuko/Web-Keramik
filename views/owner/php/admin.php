<?php

include "../../../connection.php";

session_start();

if (isset($_POST['simpan_adm'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user = $_POST['uname'];
    $pass = $_POST['upwd'];
    $role = $_POST['role'];
    $date = date('Y-m-d H:i:s');


    if ($user == NULL and $name == NULL and $pass == NULL) {
        echo "<script>alert('Mohon isi data dengan lengkap'),
        location.replace('../views/admin.php')";
    } else {
        $save = $conn->query("INSERT INTO tbl_multilevel VALUES(NULL,'$name','$email','$user','$pass','$role','$date')");

        if ($save) {
            echo "<script>
            alert('Data berhasil disimpan'),
            location.replace('../views/admin.php')
            </script>";
        } else {
            echo "error data or code";
        }
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $user = $_POST['uname'];
    $pass = $_POST['upwd'];
    $role = $_POST['role'];

    $update = $conn->query("UPDATE tbl_multilevel SET uname = '$user', name = '$name', upwd = '$pw' WHERE id = '$id'");

    if ($update) {
        echo "<script>alert('Data berhasil di update')
        location.replace('../views/admin.php')</script>";
    } else {
        echo "<script>alert('Data gagal di update')
        location.replace('../views/admin.php')</script>";
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = $conn->query("DELETE FROM tbl_multilevel WHERE id = '$id'");

    if ($delete) {
        echo "<script>alert('Data berhasil dihapus')
        location.replace('../views/admin.php')</script";
    } else {
        echo "<script>alert('Data gagal dihapus')
        location.replace('../views/admin.php')</script";
    }
}

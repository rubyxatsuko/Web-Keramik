<?php

include '../app/db.php';

if (isset($_POST['order'])) {
    $name = $_POST['name'];
    $tgl = $_POST['tgl'];

    $save = $conn->query("INSERT INTO `order` VALUES (NULL, '$name', '$tgl', NULL, NULL, NULL)");

    if ($save) {
        echo "<script>alert('Transaksi berhasil dibuat'),
            location.replace('../views/detail_transaksi.php')
            </script>";
    } else {
        echo "error data or code";
    }
}

if (isset($_POST['edit'])) {
    $id = $_POST['id_adm'];
    $user = $_POST['username'];
    $name = $_POST['name'];
    $pw = $_POST['password'];

    $update = $conn->query("UPDATE tbl_adm SET username = '$user', name = '$name', password = '$pw' WHERE id = '$id'");

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
    $delete = $conn->query("DELETE FROM tbl_adm WHERE id = '$id'");

    if ($delete) {
        echo "<script>alert('Data berhasil dihapus')
        location.replace('../views/admin.php')</script";
    } else {
        echo "<script>alert('Data gagal dihapus')
        location.replace('../views/admin.php')</script";
    }
}

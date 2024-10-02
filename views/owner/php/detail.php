<?php

include '../app/db.php';

if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['hrg'];
    $jumlah = $_POST['jml'];
    $total = $harga * $jumlah;

    $tbl_barang = $conn->query("SELECT * FROM tbl_barang WHERE nama = '$nama'")->fetch_assoc();
    $result = $conn->query("SELECT id FROM `order` ORDER BY id DESC LIMIT 1")->fetch_assoc();
    $no_transaksi = $result['id'];
    $stok = $tbl_barang['stok'];
    $id = $tbl_barang['id'];
    $kurang = $stok - $jumlah;

    $tambah = $conn->query("INSERT INTO `order_detail` VALUES(NULL,'$no_transaksi','$nama','$harga','$jumlah','$total')");

    $barang = $conn->query("UPDATE tbl_barang SET stok = $kurang WHERE id = $id");

    if ($tambah) {
        echo "<script>location.replace('../views/detail_transaksi.php')</script>";
    } else {
        echo "<script>alert('error data')
        location.replace('../views/detail_transaksi.php')</script>";
    }
}

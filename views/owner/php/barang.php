<?php

include "../../../connection.php";

session_start();

if (isset($_POST['simpan_brg'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $stok = $_POST['stok'];

    if ($name == NULL and $price == NULL and $image == NULL and $stok == NULL) {
        echo "<script>alert('Mohon isi data dengan lengkap'),
        location.replace('../views/barang.php')";
    } else {
        $save = $conn->query("INSERT INTO tbl_product VALUES(NULL,'$name','$price','$image','$stok')");

        if ($save) {
            echo "<script>
            alert('Data berhasil disimpan'),
            location.replace('../views/barang.php')
            </script>";
        } else {
            echo "error data or code";
        }
    }
}

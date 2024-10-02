<?php 
@include "../../../connection.php";

?>

<?php 
// Menghubungkan ke database
include '../../../connection.php';

$id = $_GET['id'];
// Mengambil data product berdasarkan id
$produk         = mysqli_query($conn, "SELECT * FROM tbl_product WHERE id_product = '$id'");


// Menghapus product berdasarkan id
$query = $conn->query("DELETE FROM tbl_product WHERE id_product = '$id'");

?>
<?php
// Jika berhasil menghapus produk, tampilkan pesan berhasil
if($query) {
   echo "<script>alert('Produk berhasil dihapus');window.location.href='barang.php';</script>";
// Jika gagal meghapus produk, tampilkan pesan gagal
} else {
   echo "<script>alert('Produk gagal dihapus');window.location.href='barang.php';</script>";
}

?>
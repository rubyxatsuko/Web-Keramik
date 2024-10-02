<?php 
@include "../../../connection.php";

?>

<?php 
// Menghubungkan ke database
include '../../../connection.php';

$id = $_GET['id'];
// Mengambil data product berdasarkan id
$produk         = mysqli_query($conn, "SELECT * FROM tbl_multilevel WHERE id = '$id'");


// Menghapus product berdasarkan id
$query = $conn->query("DELETE FROM tbl_multilevel WHERE id = '$id'");

?>
<?php
// Jika berhasil menghapus produk, tampilkan pesan berhasil
if($query) {
   echo "<script>alert('Akun berhasil dihapus');window.location.href='admin.php';</script>";
// Jika gagal meghapus produk, tampilkan pesan gagal
} else {
   echo "<script>alert('Akun gagal dihapus');window.location.href='admin.php';</script>";
}

?>
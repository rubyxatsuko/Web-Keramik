<?php
include_once '../../../connection.php';
$number = 1;
$id_order = $_GET['id_order'];
$query_pesanan = $conn->query("SELECT * FROM tbl_orders JOIN tbl_multilevel ON tbl_orders.id_user=tbl_multilevel.id WHERE tbl_orders.orders_id='$id_order'");
$r = $query_pesanan->fetch_assoc();

?>

<html>

<head>
    <title>Struk Pembelian</title>
    <style>
        #tabel {
            font-size: 15px;
            border-collapse: collapse;
        }

        #tabel td {
            padding-left: 5px;
            border: 1px solid black;
        }
    </style>
</head>

<body style='font-family:tahoma; font-size:8pt;' onload="javascript:window.print()">
    <center>
        <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:50px; vertical-align:top'>
                <span style='font-size:12pt'><b>WM Keramik</b></span></br>
                Kampung Cempaka, gang grand nusa indah </br>
                Telp : 085772111688
            </td>
            <td style='vertical-align:top' width='30%' align='left'>
                <b><span style='font-size:12pt'>Struk Pembelian</span></b></br>
                <?= "Kode Order : " . $r['orders_id']; ?></br>
                <?php
                $tanggal_sekarang = date('Y-m-d');
                echo "Tanggal saat ini: " . $tanggal_sekarang;
                ?>
                </br>
            </td>
        </table>
        <table style='width:550px; font-size:8pt; font-family:calibri; border-collapse: collapse;' border='0'>
            <td width='70%' align='left' style='padding-right:80px; vertical-align:top'>
                <?= $r['name']; ?></br>
               
            </td>

            </td>
        </table>
        <?php
        $query_pesanan = $conn->query("SELECT * FROM tbl_order_products JOIN tbl_orders ON tbl_order_products.id_order=tbl_orders.orders_id JOIN tbl_product ON tbl_order_products.id_product=tbl_product.id_product WHERE tbl_orders.orders_id = '$id_order'");
        ?>
        <table cellspacing='0' style='width:550px; font-size:8pt; font-family:calibri;  border-collapse: collapse;' border='1'>

            <tr align='center'>

                <td width='20%'>Nama Barang</td>
                <td width='13%'>Harga</td>
                <td width='4%'>Qty</td>
                <td width='13%'>Total Harga</td>
            </tr>
            <?php foreach ($query_pesanan as $r) : ?>
                <tr>

                    <td><?= $r['name_product']; ?></td>
                    <td><?= $r['price_product']; ?></td>
                    <td><?= $r['qty']; ?></td>
                    <td><?= $r['total_price']; ?></td>

                </tr>
            <?php endforeach ?>

            <tr>
                <td colspan="4" style='text-align:right'>Subtotal = <?= $r['total_price']; ?></td>
            </tr>

        </table>

    </center>
</body>

</html>
<?php
    if( empty( $_SESSION['id_user'] ) ){

    	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
    	header('Location: ./');
    	die();
    } else {
?>

<html>
<head>
    <link href="css/bootstrap.css" rel="stylesheet"/>
</head>
<body onload="window.print()">
    <div class="container">

<?php

    $id_transaksi = $_REQUEST['id_transaksi'];

    $sql = mysqli_query($koneksi, "SELECT no_nota, nama, jenis, makan, biaya, hape, tanggal, id_user FROM transaksi WHERE id_transaksi='$id_transaksi'");

    list($no_nota, $nama, $jenis, $makan, $biaya, $hape, $tanggal, $id_user) = mysqli_fetch_array($sql);

    echo '
        <center><h3>Cuci Bersih Mobil Motor</h3></center>
        <hr/>
        <h4>Nota Nomor : <b>'.$no_nota.'</b></h4>
        <table class="table table-bordered">
         <thead>
           <tr class="info">
             <th width="15%">Nama Pelanggan</th>
             <th width="12%">Jenis</th>
             <th width="10%">Makanan</th>
             <th width="10%">Harga</th>
             <th width="10%">No. Handpone</th>
             <th width="10%">Tanggal</th>
           </tr>
         </thead>
         <tbody>

           <tr>
             <td>'.$nama.'</td>
             <td>'.$row['jenis'].'</td>
             <td>'.$jenis.'</td>
             <td>'.$makan.'</td>
             <td>Rp. '.number_format($biaya).'</td>
             <td>'.number_format($hape).'</td>
             <td>'.date("d M Y", strtotime($tanggal)).'</td>
             <tr/>

        </tbody>
    </table>

    <div style="margin: 0 0 50px 75%;">
        <p style="margin-bottom: 60px;">Petugas Kasir</p>
        <p>';

        $sql = mysqli_query($koneksi, "SELECT nama FROM user WHERE id_user='$id_user'");
        list($nama) = mysqli_fetch_array($sql);

        echo "<b><u>$nama</u></b>";

        echo '</p>
    </div>

    <center>-------------------- Terima Kasih ------------------- </center>

    </div>
</body>
</html>';
}
?>

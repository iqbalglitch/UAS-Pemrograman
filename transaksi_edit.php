<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$id_transaksi = $_REQUEST['id_transaksi'];
		$jenis = $_REQUEST['jenis'];
		$makan = $_REQUEST['makan'];
		$biaya = $_REQUEST['biaya'];
		$nama = $_REQUEST['nama'];
		$hape = $_REQUEST['hape'];
		$mail = $_REQUEST['mail'];

		$sql = mysqli_query($koneksi, "UPDATE transaksi SET jenis='$jenis', makan='$makan', biaya='$biaya', nama='$nama', hape='$hape', hape='$hape' WHERE id_transaksi='$id_transaksi'");

		if($sql == true){
			header('Location: ./admin.php?hlm=transaksi');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {

		$id_transaksi = $_REQUEST['id_transaksi'];

		$sql = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id_transaksi='$id_transaksi'");
		while($row = mysqli_fetch_array($sql)){

?>

<h2>Edit Data Transaksi</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="no_nota" class="col-sm-2 control-label">No. Nota</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="no_nota" value="<?php echo $row['no_nota']; ?>"name="no_nota" placeholder="No. Nota" readonly>
		</div>
	</div>
	<div class="form-group">
		<label for="jenis" class="col-sm-2 control-label">Nama Restoran</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo $row['jenis']; ?>" placeholder="Nama Restoran" required>
		</div>
	</div>
	<div class="form-group">
		<label for="makan" class="col-sm-2 control-label">Makanan</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="makan" name="makan" value="<?php echo $row['makan']; ?>" placeholder="Makanan" required>
		</div>
	</div>
	<div class="form-group">
		<label for="biaya" class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="biaya" name="biaya" value="<?php echo $row['biaya']; ?>" placeholder="Harga" required>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="nama" name="nama" value="<?php echo $row['nama']; ?>" placeholder="Nama Lengkap" required>
		</div>
	</div>
	<div class="form-group">
		<label for="hape" class="col-sm-2 control-label">No Handphone</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="hape" name="hape" value="<?php echo $row['hape']; ?>" placeholder="No Handpone" required>
		</div>
	</div>
	<div class="form-group">
		<label for="mail" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="mail" name="mail" value="<?php echo $row['mail']; ?>" placeholder="Email" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=transaksi" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php
	}
	}
}
?>

<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$jenis = $_REQUEST['jenis'];
		$makan = $_REQUEST['makan'];
		$biaya = $_REQUEST['biaya'];

		$sql = mysqli_query($koneksi, "INSERT INTO biaya(jenis, makan, biaya) VALUES('$jenis', '$makan', '$biaya')");

		if($sql == true){
			header('Location: ./admin.php?hlm=biaya');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
<h2>Tambah Data Master biaya Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="jenis" class="col-sm-2 control-label">Nama Restoran</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="jenis" name="jenis" placeholder="Jenis Restoran" required>
		</div>
	</div>
	<div class="form-group">
		<label for="makan" class="col-sm-2 control-label">Makanan</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="makan" name="makan" placeholder="Nama Makanan" required>
		</div>
	</div>
	<div class="form-group">
		<label for="biaya" class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-3">
			<input type="number" class="form-control" id="biaya" name="biaya" placeholder="Biaya Jasa" required>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" name="submit" class="btn btn-success">Simpan</button>
			<a href="./admin.php?hlm=biaya" class="btn btn-danger">Batal</a>
		</div>
	</div>
</form>
<?php
	}
}
?>

<?php
if( empty( $_SESSION['id_user'] ) ){

	$_SESSION['err'] = '<strong>ERROR!</strong> Anda harus login terlebih dahulu.';
	header('Location: ./');
	die();
} else {

	if( isset( $_REQUEST['submit'] )){

		$no_nota = $_REQUEST['no_nota'];
		$jenis = $_REQUEST['jenis'];
		$makan = $_REQUEST['makan'];
		$biaya = $_REQUEST['biaya'];
		$nama = $_REQUEST['nama'];
		$hape = $_REQUEST['hape'];
		$mail = $_REQUEST['mail'];

		$sql = mysqli_query($koneksi, "INSERT INTO transaksi(no_nota, jenis, makan, biaya, nama, hape, mail) VALUES('$no_nota', '$jenis', '$makan', '$biaya', '$nama', '$hape', '$mail')");

		if($sql == true){
			header('Location: ./admin.php?hlm=transaksi');
			die();
		} else {
			echo 'ERROR! Periksa penulisan querynya.';
		}
	} else {
?>
<h2>Tambah Transaksi Baru</h2>
<hr>
<form method="post" action="" class="form-horizontal" role="form">
	<div class="form-group">
		<label for="no_nota" class="col-sm-2 control-label">No. Nota</label>
		<div class="col-sm-3">

		<?php

			$sql = mysqli_query($koneksi, "SELECT no_nota FROM transaksi");
				echo '<input type="text" class="form-control" id="no_nota" value="';

			$no_nota = "C001";
			if(mysqli_num_rows($sql) == 0){
				echo $no_nota;
			}

			$result = mysqli_num_rows($sql);
			$counter = 0;
			while(list($no_nota) = mysqli_fetch_array($sql)){
				if (++$counter == $result) {
					$no_nota++;
					echo $no_nota;
				}
			}
				echo '"name="no_nota" placeholder="No. Nota" readonly>';

		?>

		</div>
	</div>
	<div class="form-group">
		<label for="jenis" class="col-sm-2 control-label">Nama Restoran</label>
		<div class="col-sm-3">
			<select name="jenis" class="form-control" id="jenis" required>
				<option value="" disable>--- Pilih Nama Restoran ---</option>
			<?php

				$q = mysqli_query($koneksi, "SELECT * FROM biaya");
				while($data = mysqli_fetch_array($q)){
					echo '<option value="'.$data['jenis'].'">'.$data['jenis'].'</option>';
				}

			?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<label for="makan" class="col-sm-2 control-label">Makanan</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="makan" name="makan" value="" required >
		</div>
	</div>
	<div class="form-group">
		<label for="biaya" class="col-sm-2 control-label">Harga</label>
		<div class="col-sm-3">
			<input type="text" class="form-control" id="biaya" name="biaya" value="" required>
		</div>
	</div>
	<div class="form-group">
		<label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required>
		</div>
	</div>
	<div class="form-group">
		<label for="hape" class="col-sm-2 control-label">Nomor Hp</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="hape" name="hape" placeholder="Nomor Hp" required>
		</div>
	</div>
	<div class="form-group">
		<label for="mail" class="col-sm-2 control-label">Email</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" id="mail" name="mail" placeholder="Email" required>
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
?>


<!DOCTYPE html>
<html>
<head>
	<title>GILACODING</title>
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
</head>
<body>
	<div class="container col-md-6">
		<h1>Tabel Gilacoding</h1>
		<div class="card">
			<div class="card-header bg-success text-white">
				TAMBAH BARANG
			</div>
			<div class="card-body">
				<form method="post" action="" role="form">
					<div class="form-group">
						<label>Nama Barang</label>
						<input type="text" name="nama" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Harga Barang</label>
						<input type="text" name="harga" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Deskripsi</label>
						<textarea class="form-control" name="deskripsi"></textarea>
					</div>
					<button type="submit" class="btn btn-primary" name="submit">Simpan data</button>
				</form>

				<?php 
					
					include('koneksi.php');

					if(isset($_POST['submit'])){
						$nama = $_POST['nama'];
						$harga = $_POST['harga'];
						$deskripsi = $_POST['deskripsi'];

						function randomKodeBarcode($qtd) {
								$Caracteres = 'ABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
								$QuantidadeCaracteres = strlen($Caracteres);
								$QuantidadeCaracteres--;

								$Hash=NULL;
								for($x=1;$x<=$qtd;$x++){
									$Posicao = rand(0,$QuantidadeCaracteres);
									$Hash .= substr($Caracteres,$Posicao,1);
								}

								return $Hash;
						}

						//proses barcode
					    $kode_barcode = 'BARANG-'.str_replace(' ', '_', $_POST['nama']).'-'.randomKodeBarcode(6);

					    //proses generate gambar barcode dan simpan ke folder yg ditentukan
                        $tempdir = "images/"; //nama folder nya
                        $target_path = $tempdir . $kode_barcode . ".png";
                                     
                         //cek apakah server menggunakan http atau https
                         $protocol = stripos($_SERVER['SERVER_PROTOCOL'], 'https') === 0 ? 'https://' : 'http://';
                                     
                         //url file image barcode 
                         $file_gambar = $protocol . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . "/barcode.php?text=" . $kode_barcode . "&print=true&size=65"; //size untuk atur ukuran gambar barcode nya
                                     
                          //ambil gambar barcode dari url yg ditentukan lalu namanya ditampung ke $gambar_barcode
                          $content = file_get_contents($file_gambar);
                          file_put_contents($target_path, $content);
                          $gambar_barcode = $kode_barcode.'.png';					    

						mysqli_query($koneksi, "insert into barang (nama, harga, deskripsi, kode_barcode, gambar_barcode) VALUES ('$nama', '$harga', '$deskripsi', '$kode_barcode', '$gambar_barcode')") or die(mysqli_error($koneksi));

						echo"<script>alert('data berhasil disimpan!');window.location='index.php';</script>";
					}


				?>
			</div>
		</div>
	</div>	
<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
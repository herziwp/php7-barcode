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
				DATA BARANG <a href="tambah.php" class="btn btn-sm btn-primary float-right">+ Tambah</a>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Barang</th>
							<th>Harga</th>
							<th>Deskripsi</th>
							<th>Kode</th>
							<th>Barcode</th>
						</tr>
					</thead>
					<tbody>
						<?php
							include('koneksi.php');

							$datas = mysqli_query($koneksi, "select * from barang") or die(mysqli_error($koneksi));
							$no = 1;
							while($row = mysqli_fetch_assoc($datas))
							{
						?>
							<tr>
								<td><?= $no; ?></td>
								<td><?= $row['nama']; ?></td>
								<td>Rp.<?= $row['harga']; ?></td>
								<td><?= $row['deskripsi']; ?></td>
								<td><?= $row['kode_barcode']; ?></td>
								<td><img src="images/<?= $row['gambar_barcode']; ?>" style="width:220px;" /> <a href="images/<?= $row['gambar_barcode']; ?>" target="_blank">[lihat]</a></td>
							</tr>


						<?php $no++; } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>	
<script type="text/javascript" src="assets/js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
</body>
</html>
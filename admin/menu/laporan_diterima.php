<?php
	$pelamar = new Pelamar();
	$lowongan = new Lowongan();
	$lowongan_rinci = new LowonganRinci();
	$user = new User();
	$laporan = new Laporan();
	include "../include/fungsi_tanggal.php";
	if (isset($_POST['diterima'])) {
		$j_laporan = 'Laporan Pelamar Diterima';
		$id_lowongan = $_POST['lowongan'];
		$sql = $laporan->cek_lowongan($id_lowongan);
		$res = $sql->fetch();
		$kuota = $res['kuota'];
		$sql_data = $laporan->getData($id_lowongan,$kuota);

	}
	if (isset($_POST['ditolak'])) {
		$j_laporan = 'Laporan Pelamar Ditolak';
		$id_lowongan = $_POST['lowongan'];
		$sql = $laporan->cek_lowongan($id_lowongan);
		$res = $sql->fetch();
		$kuota = $res['kuota'];
		$sql_data = $laporan->getDataDitolak($id_lowongan,$kuota);
		// print_r($sql_data);
		// die();
		
	}
	// $jenis_laporan = $_POST['laporan'];
	?>
<div class="span9">
	<div class="content">
		<div class="module">
		<div class="module-head">
			<center>
			<h2>Laporan <?php echo $j_laporan; ?></h2>
			<!-- <h3>Jumlah : <?php echo $jumlah_pelamar; ?> Pelamar</h3> -->
			</center>
			<a href="menu/cetak.php" target="_blank" class="btn btn-primary">Cetak</a>
		</div>
		<div class="module-body table">
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered table-striped	 display" 
			width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Lengkap</th>
						<th>Pendidikan</th>
						<th>Lowongan</th>
					</tr>
				</thead>
				<tbody>
				
				<?php
				$no = 0;
				while ($row = $sql_data->fetch()){ $no++ ?>
					<tr>
					<td><?php echo $no; ?></td>
					<td><?php echo $row['nama_lengkap']; ?></td>
					<td><?php echo $row['pendidikan']; ?></td>
					<td><?php echo $row['lowongan']; ?></td>
				</tr>	
				<?php } ?>
				
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
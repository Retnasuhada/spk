<?php
	$pelamar = new Pelamar();
	$lowongan = new Lowongan();
	$lowongan_rinci = new LowonganRinci();
	$user = new User();
	$laporan = new Laporan();
	include "../include/fungsi_tanggal.php";
	$jenis_laporan = $_POST['laporan'];
	// 1 = total pelamar
	// 2 = pelamar diterima
	// 3 = pelamar ditolak
	if ($jenis_laporan=='1') {
		$j_laporan = 'Total Pelamar';
		$sql_laporan = $laporan->total_pelamar();
		$jml_pelamar = $laporan->jumlah_total_pelamar();
		$r_jml_pelamar =$jml_pelamar->fetch();
		$jumlah_pelamar = $r_jml_pelamar['jumlah'];
		
	}

	if ($jenis_laporan=='2') {
		$j_laporan = 'Pelamar Diterima';
		// $sql_laporan = $laporan->cek_lowongan();

		?>
		<div class="span9">
			<div class="content">
			
			<div class="module">
		<div class="module-head">
			<h3>Pilih Lowongan</h3> 
		</div>
		<?php
			$qrL = $lowongan->GetData("where status = '1'");
		?>
		<div class="module-body">
			<form class="form-horizontal row-fluid" action="index.php?menu=laporan_diterima" method="post">
				<input type="hidden" name="menu" value="pelamar">
				<div class="control-group">
					<label class="control-label" for="basicinput">Lowongan</label>
						<div class="controls">
							<input type="hidden" name="diterima">
							<select name="lowongan">
								<?php
								while ($row = $qrL->fetch()){
									echo "<option value='$row[id_lowongan]'>$row[lowongan]</option>";	
								}
								?>
							</select>
							<input class="btn btn-primary" type="submit" value="Pilih">
						</div>
				</div>
				
			</form>
			
		</div>
	</div>


			</div>
		</div>

<?php

	}

	if ($jenis_laporan=='3') {
		$j_laporan = 'Pelamar Ditolak';
		// $sql_laporan = $laporan->cek_lowongan();

		?>
		<div class="span9">
			<div class="content">
			
			<div class="module">
		<div class="module-head">
			<h3>Pilih Lowongan</h3> 
		</div>
		<?php
			$qrL = $lowongan->GetData("where status = '1'");
		?>
		<div class="module-body">
			<form class="form-horizontal row-fluid" action="index.php?menu=laporan_diterima" method="post">
				<input type="hidden" name="menu" value="pelamar">
				<div class="control-group">
					<label class="control-label" for="basicinput">Lowongan</label>
						<div class="controls">
							<input type="hidden" name="ditolak">
							<select name="lowongan">
								<?php
								while ($row = $qrL->fetch()){
									echo "<option value='$row[id_lowongan]'>$row[lowongan]</option>";	
								}
								?>
							</select>
							<input class="btn btn-primary" type="submit" value="Pilih">
						</div>
				</div>
				
			</form>
			
		</div>
	</div>


			</div>
		</div>

<?php

	}
	// $qrL = $laporan->total_pelamar();	
if($jenis_laporan=='1'){
 ?>

<div class="span9">
	<div class="content">
		<div class="module">
		<div class="module-head">
			<center>
			<h2>Laporan <?php echo $j_laporan; ?></h2>
			<h3>Jumlah : <?php echo $jumlah_pelamar; ?> Pelamar</h3>
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
				while ($row = $sql_laporan->fetch()){ $no++ ?>
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
<?php } ?>
<div class="span9">
	<div class="content">
<?php
	$pelamar = new Pelamar();
	$lowongan = new Lowongan();
	$lowongan_rinci = new LowonganRinci();
	$user = new User();
	include "../include/fungsi_tanggal.php";

	/*----------------------------------
	------------------------------------
	------------------------------------
	------------------------------------
	Ketika pelamar melakuakn input data
	------------------------------------
	------------------------------------
	------------------------------------
	----------------------------------*/

if(!isset($_GET['penerimaan'])){
?>
	<div class="module">
		<div class="module-head">
			<h3>Pilih Penerimaan</h3> 
		</div>
		<?php
			$qrL = $lowongan->GetData("where status = '1'");
		?>
		<div class="module-body">
			<form class="form-horizontal row-fluid" action="index.php?menu=pelamar" method="get">
				<input type="hidden" name="menu" value="pelamar">
				<div class="control-group">
					<label class="control-label" for="basicinput">Penerimaan</label>
						<div class="controls">
							<select name="penerimaan">
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

<?php
}else{
	$id_lowongan = $_GET['penerimaan'];
	$qrLw = $lowongan->GetData("where id_lowongan='$id_lowongan'");
	$nama_lw = $qrLw->fetch();

	if(isset($_GET['nilai_user'])){

			$id_user = $_GET['nilai_user'];
			$qrN = $user->GetData("where id_user='$id_user'");
			$rowN = $qrN->fetch();
			$det = $pelamar->GetDataLamaran(" where c.id_user='$id_user' AND e.id_kriteria not in ('1','2','3','4','5') GROUP BY e.id_kriteria ");
			// print_r($det);
			// die();
			?>
			<div class="module">
		<div class="module-head">
			<h3>Rincian Nilai -- <?php echo $rowN['nama_lengkap'] . " -- " . $nama_lw['lowongan']; ?></h3> 
		</div>
		<div class="module-body table">
		<?php
			if(isset($_POST['submit'])){
				$ar=1;
				$qryRincian = $lowongan_rinci->GetData("where id_lowongan='$id_lowongan' and status_nilai='1' order by kriteria asc");

				while($exec = $qryRincian->fetch()){
					$nilai = $_POST['input_' . $ar];
					$qry = $pelamar->SetNilai($nilai, $id_user, $id_lowongan, $exec['kriteria']);

	  				if($qry){
	  					echo "<script language='javascript'>alert('Nilai berhasil diberikan'); document.location='?menu=pelamar&penerimaan=$id_lowongan&nilai_user=$id_user'</script>";
	  				}else{
	  					echo "<script language='javascript'>alert('Gagal');document.location='menu=pelamar&penerimaan=$id_lowongan'</script>";
	  				}
					$ar++;
				}
			}

			$qryRincian = $pelamar->GetData("where id_user='$id_user' and id_lowongan='$id_lowongan' order by kriteria asc");
		?>
			<table cellpadding="0" cellspacing="0" border="0" class="table" 
			width="100%">
				<thead>
					<tr>
						
						<th align="center" width="60%">Kriteria</th>
						<th align="left"></th>
						<th align="left"></th>
						<!-- <th align="center">Upload</th> -->
					</tr>
				</thead>
				<tbody>
					<?php
					$jenjang_pendidikan = $pelamar->GetDataLamaran(" where c.id_user='$id_user' AND e.id_kriteria='1' GROUP BY e.id_kriteria");
					$arr_pendidikan 	= $jenjang_pendidikan->fetch();
					$data_pendidikan = $arr_pendidikan['totalNilai'];
					$id_krit_pendidikan = $arr_pendidikan['id_nilai_kriteria'];
					$bobot_pendidikan = $arr_pendidikan['bobot'];
						// tentukan nilai dari kriteria baku
						// nilai pendidikan
							if ($data_pendidikan== 50) {
								$nilai_pendidikan = 'SMP';
							}
							if ($data_pendidikan== 70) {
								$nilai_pendidikan = 'SMA';
							}
							if ($data_pendidikan==80) {
								$nilai_pendidikan = 'D3';
							}
							if ($data_pendidikan==90) {
								$nilai_pendidikan = 'S1';
							}
							if ($data_pendidikan==100) {
								$nilai_pendidikan = 'S2';
							}
						// nilai pengalaman_kerja
					$pengalaman = $pelamar->GetDataLamaran(" where c.id_user='$id_user' AND e.id_kriteria='2' GROUP BY e.id_kriteria");
					$arr_pengalaman = $pengalaman->fetch();
					$data_pengalaman = $arr_pengalaman['totalNilai'];
					$id_krit_pengalaman = $arr_pengalaman['id_nilai_kriteria'];
					$id_lamaran = $arr_pengalaman['id_lamaran'];
					$bobot_pengalaman = $arr_pengalaman['bobot'];
							if ($data_pengalaman== 50) {
								$nilai_pengalaman = 'operator';
							}
							if ($data_pengalaman== 60) {
								$nilai_pengalaman = 'kepala_regu';
							}
							if ($data_pengalaman== 80) {
								$nilai_pengalaman = 'supervisor';
							}
							if ($data_pengalaman== 90) {
								$nilai_pengalaman = 'kepala_bagian';
							}
							if ($data_pengalaman== 100) {
								$nilai_pengalaman = 'manager';
							}
						// nilai usia
					$det_usia = $pelamar->GetDataLamaran(" where c.id_user='$id_user' AND e.id_kriteria='4' GROUP BY e.id_kriteria");
					$arr_usia = $det_usia->fetch();
					$data_usia = $arr_usia['totalNilai'];
					$id_krit_usia = $arr_usia['id_nilai_kriteria'];
					$bobot_usia = $arr_usia['bobot'];

							if ($data_usia==90) {
								$nilai_usia = '18-20';
							}
							if ($data_usia==80) {
								$nilai_usia = '21-25';
							}
							if ($data_usia==70) {
								$nilai_usia = '26-30';
							}
							if ($data_usia==60) {
								$nilai_usia = '31-35';
							}else{
								$nilai_usia = 'undifine';
							}
							
						// nilai bahasa asing
					$det_bahasa = $pelamar->GetDataLamaran(" where c.id_user='$id_user' AND e.id_kriteria='4' GROUP BY e.id_kriteria");
					$arr_bahasa = $det_bahasa->fetch();
					$data_bahasa = $arr_bahasa['totalNilai'];
					$id_krit_bahasa = $arr_bahasa['id_nilai_kriteria'];
					$bobot_bahasa = $arr_bahasa['bobot'];
							if ($data_bahasa==50) {
								$nilai_bahasa = '1';
							}
							if ($data_bahasa==70) {
								$nilai_bahasa = '2';
							}
							if ($data_bahasa==80) {
								$nilai_bahasa = '3';
							}
							if ($data_bahasa==100) {
								$nilai_bahasa = '4';
							}

						// echo "<script language='javascript'>alert('Data berhasil disimpan'); document.location='?page=penerimaan&lihat'</script>";
					}
		if (isset($_POST['submit'])) {

			$id_lamaran = $id_lamaran;
			
			// pedidikan
			// $id_krit_pendidikan = $id_krit_pendidikan;
			$totalNilaiPend = $data_pendidikan * $bobot_pendidikan / 100;
			$totalNilaiPeng = $data_pengalaman * $bobot_pengalaman / 100;
			$totalNilaiUsia = $data_usia * $bobot_usia / 100;
			$totalNilaiBahasa = $data_bahasa * $bobot_bahasa / 100;
			// insert det nilai pendidikan
			$insert_pend = $pelamar->insertdetBaku($id_lamaran,$id_krit_pendidikan,$totalNilaiPend);
			// insert det nilai pengalaman
			$insert_peng = $pelamar->insertdetBaku($id_lamaran,$id_krit_pengalaman,$totalNilaiPeng);
			// insert det nilai usia
			$insert_usia = $pelamar->insertdetBaku($id_lamaran,$id_krit_pengalaman,$totalNilaiUsia);
			// insert det nilai bahasa
			$insert_bahasa = $pelamar->insertdetBaku($id_lamaran,$id_krit_bahasa,$totalNilaiBahasa);
			
			$det_bobot = $pelamar->GetDataLamaranUnik(" where c.id_user='$id_user' AND e.id_kriteria NOT IN ('1','2','3','4','5') GROUP BY e.id_kriteria");
			$arr = $det_bobot->rowCount();
			$n_bobot = 0;
			while($row = $det_bobot->fetch()){
				$bobot = $row['nilai'];
				$n_bobot = $n_bobot + $bobot;
			};
			$det_a = $pelamar->GetDataLamaran(" where c.id_user='$id_user' AND e.id_kriteria='3' GROUP BY e.id_kriteria");
					$arr_k = $det_a->fetch();
					// $data_bahasa = $arr_bahasa['totalNilai'];
					$id_krit_kemampuan = $arr_k['id_nilai_kriteria'];
					$bobot_kemampuan = $arr_k['bobot'];
			$totalNilaiKemampuan = $n_bobot * $bobot_kemampuan / 100;
			$insert_kemampuan = $pelamar->insertdetBaku($id_lamaran,$id_krit_kemampuan,$totalNilaiKemampuan);
			
			echo "<script language='javascript'>alert('Data berhasil disimpan'); document.location='?page=perhitungan'</script>";
			
		}

					 ?>
					<form action="" method="post" enctype="multipart/form-data">
					

					<tr>
						<div class="control-group">
						<td align="left">Jenjang Pendidikan</td>
						<td colspan="2" align="left">
							<div class="controls">
							<select name="jenjang_pendidikan">
								<option value="">-</option>
								<option value="SMP" <?php if ($nilai_pendidikan=='SMP') {
									echo 'selected';
								} ?>>SMP</option>
								<option value="SMA" <?php if ($nilai_pendidikan=='SMA') {
									echo 'selected';
								} ?>>SMA</option>
								<option value="D3" <?php if ($nilai_pendidikan=='D3') {
									echo 'selected';
								} ?>>D3</option>
								<option value="S1" <?php if ($nilai_pendidikan=='S1') {
									echo 'selected';
								} ?>>S1</option>
								<option value="S2" <?php if ($nilai_pendidikan=='S2') {
									echo 'selected';
								} ?>>S2</option>
							</select>
						</div>
						</td>
						</div>
					</tr>
					<tr>
						<td align="left">Pengalaman Kerja</td>
						<td align="left" colspan="2">

							<select name="Pengalaman_kerja">
								<option value="operator" <?php if ($nilai_pengalaman=='operator') {
									echo 'selected';
								} ?>>Operator</option>
								<option value="kepala_regu" <?php if ($nilai_pengalaman=='kepala_regu') {
									echo 'selected';
								} ?>>Kepala Regu</option>
								<option value="supervisor" <?php if ($nilai_pengalaman=='supervisor') {
									echo 'selected';
								} ?>>Supervisor</option>
								<option value="kepala_bagian" <?php if ($nilai_pengalaman=='kepala_bagian') {
									echo 'selected';
								} ?>>Kepala Bagian</option>
								<option value="manager" <?php if ($nilai_pengalaman=='manager') {
									echo 'selected';
								} ?>>Manager</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="left">Usia</td>
						<td align="left" colspan="2">
							<input type="teks" placeholder="Masukan Usia" name="usia" value="<?php echo $nilai_usia ?>">
						</td>
					</tr>
					<tr>
						<td align="left">Kemampuan Bahasa Asing</td>
						<td align="left" colspan="2">
							<select name="bahasa_asing">
								
								<option value="1" <?php if ($nilai_bahasa=='1') {
									echo 'selected';
								} ?>>Tidak Ada</option>
								<option value="2" <?php if ($nilai_bahasa=='2') {
									echo 'selected';
								} ?>>1 Bahasa Asing</option>
								<option value="3" <?php if ($nilai_bahasa=='3') {
									echo 'selected';
								} ?>>2 Bahasa Asing</option>
								<option value="4" <?php if ($nilai_bahasa=='4') {
									echo 'selected';
								} ?>>3 Bahasa Asing</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="left" colspan="3"><b>Kemampuan Seputar Pengalaman Kerja Yang Dilamar</b></td>
						
					</tr>
					<?php $no = 0; 

					while ($row_kriteria = $det->fetch()) { $no++; ?>
						<tr>
							
							<td align="left"><?php echo $no; ?>. <?php echo $row_kriteria['nama_kriteria']; ?></td>
							<input type="hidden" name="id_kriteria[<?php echo $no; ?>]" value="<?php echo $row_kriteria['id_kriteria']; ?>">
							<?php
							if ($row_kriteria['status_upload']==1 AND $row_kriteria['status_nilai']=='1') { ?>	
							 	<td><input type="file" name="upload[<?php echo $no ?>]"></td>
							 	<td><input type="teks" placeholder="Masukan nilai" name="nilai[<?php echo $no ?>]"></td>
							 <?php } 
							 if ($row_kriteria['status_upload']==1 AND $row_kriteria['status_nilai']=='0') { ?>
							 	<td colspan="2"><input type="file" name="upload[<?php echo $no ?>]"></td>
							 <?php } 
							  if ($row_kriteria['status_upload']==0 AND $row_kriteria['status_nilai']=='0') { ?>
							 	<td><input type="radio" id="basicinput" name="status[<?php echo $no; ?>]" value="1" <?php if ($row_kriteria['catatan']=='1') {
									echo "checked";
								} ?>  > </td>
								<td><input type="radio" id="basicinput" name="status[<?php echo $no; ?>]" value="0" <?php if ($row_kriteria['catatan']=='0') {
									echo "checked";
								} ?>></td>
								<!-- <td colspan="2"><input type="file" name="upload[<?php echo $no ?>]"></td> 	 -->
							 <?php }
							  if ($row_kriteria['status_upload']==0 AND $row_kriteria['status_nilai']=='1') { ?>
							 	<td colspan="2" align="left"><input type="teks" placeholder="Masukan nilai" name="nilai[<?php echo $no ?>]"></td>
							<?php } ?>
						</tr>
					<?php } ?>
				
				</tbody>
			</table>
		</div>
				<div class='control-group'>
					<div class="controls">
						<input type="submit" name="submit" value="Approved" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>
		</div>
		<?php

	}if(!isset($_GET['nilai_user'])){

		/*----------------------------------
		------------------------------------
		------------------------------------
		------------------------------------
		Ketika pelamar hanya menampilkan data
		------------------------------------
		------------------------------------
		------------------------------------
		----------------------------------*/
		
		?>
		<div class="module">
		<div class="module-head">
			<h3>Data Pelamar -- <?php echo $nama_lw['lowongan']; ?></h3>
		</div>
		<div class="module-body table">
			<table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display" 
			width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Lengkap</th>
						<!-- <th>Pendidikan</th>
						<th>No HP</th>
						<th>Email</th> -->
						<th></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					$getData = $pelamar->GetData("where id_lowongan='$id_lowongan'");
					$cek_user = "";
					while($data = $getData->fetch()){
						$qrU = $user->GetData("where id_user='$data[id_user]'");
						$rowU = $qrU->fetch();
						if ($data['id_user']==$cek_user)
							continue;
						echo "<tr>
							<td width = 10%>$no</td>
							<td width = 75%><a target='blank' href='index.php?menu=users&detail=$data[id_user]'>$rowU[nama_lengkap]</a></td>";
						echo "<td width = 15%> <a class='btn btn-small btn-success' href='?menu=pelamar&penerimaan=$id_lowongan&nilai_user=$data[id_user]'>Rincian Nilai</a></td>";
							// echo "<td width = 22%> <a class='btn btn-small btn-success' href='?ap=peserta&aksi=detail&id_peserta=$data[id_peserta]'>Detail</a> <a class='btn btn-small btn-danger' href='application/peserta/peserta_hapus.php?id_peserta=$data[id_peserta]&nama_peserta=$data[nama_lengkap]&lomba=$data[nama_lomba]'>Hapus</a> 
							// <a class='btn btn-small btn-info' href='?ap=peserta&aksi=edit&id_peserta=$data[id_peserta]'>Edit</a>
						echo "</tr>";
						$cek_user = $data['id_user'];

						$no++;
					}
					//$up = mysql_query("update gtp_peserta set approve = '1' where approve = '0'");
				?>
				</tbody>
			</table>
		</div>
		</div>
	<?php
	}

?>
	</div>
</div>
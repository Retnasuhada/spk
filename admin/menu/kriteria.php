<?php
	$lowongan = new lowongan();

$lowongan_rinci = new LowonganRinci();
 ?>
<div class="span9">
<div class="content">

<?php if (isset($_GET['kriteria'])) {

	if ($_GET['kriteria']=='tambah') {
	
		if(isset($_POST['submit'])){
			$kriteria = $_POST['kriteria'];
			$bobot = $_POST['bobot'];
				
			$qry = $lowongan_rinci->InsertData($kriteria, $bobot);
						
			if($qry){
				echo "<script language='javascript'>alert('Data berhasil disimpan'); document.location='?menu=kriteria'</script>";
			}else{
				echo "<script language='javacsript'>alert('Gagal');";
			}
		}
	
	?>
<!-- tampilan menu tambah kriteria -->
		<div class="module">
				<div class="module-body">
					<center><h3>Tambah Kriteria</h3></center>
					<form class="form-horizontal row-fluid" action="" method="post">
						<div class="control-group">
							<label class="control-label" for="basicinput">Kriteria</label>
							<div class="controls">
								
								<input type="text" id="basicinput" name="kriteria" placeholder="Input nama kriteria" class="span8">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="basicinput">Bobot</label>
							<div class="controls">
								<input type="text" id="basicinput" name="bobot" placeholder="Input bobot kriteria" class="span8">
							</div>
						</div>

						
						<div class="control-group">
							<div class="controls">
								<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
				</div>
		</div>
<?php } if ($_GET['kriteria']=='edit') {
		$id_kriteria = $_GET['id'];
		$qryL = $lowongan_rinci->GetDetKriteria($id_kriteria);
		$det_kriteria = $qryL->fetch();
			if(isset($_POST['submit'])){
				$kriteria = $_POST['kriteria'];
				$bobot = $_POST['bobot'];
					
				$qry = $lowongan_rinci->EditKriteria($id_kriteria,$kriteria, $bobot);
							
				if($qry){
					echo "<script language='javascript'>alert('Data berhasil disimpan'); document.location='?menu=kriteria'</script>";
				}else{
					echo "<script language='javacsript'>alert('Gagal');";
				}
			}
	 ?>
		<div class="module">
				<div class="module-body">
					<center><h3>Edit Kriteria</h3></center>
					<form class="form-horizontal row-fluid" action="" method="post">
						<div class="control-group">
							<label class="control-label" for="basicinput">Kriteria</label>
							<div class="controls">
								
								<input type="text" id="basicinput" name="kriteria" value="<?php echo $det_kriteria['nama_kriteria']; ?>" placeholder="Input nama kriteria" class="span8">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="basicinput">Bobot</label>
							<div class="controls">
								<input type="text" id="basicinput" name="bobot" value="<?php echo $det_kriteria['bobot']; ?>" placeholder="Input bobot kriteria" class="span8">
							</div>
						</div>

						
						<div class="control-group">
							<div class="controls">
								<button type="submit" name="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
				</div>
		</div>
<?php }
 } else { ?>
<!-- batas tampilan menu tambah kriteria -->
<!-- tampilan data kriteria (awal) -->
<div class="module">
		<div class="module-head">
			<h3>Kriteria <?php echo " <a class='btn btn-small btn-primary' href='?menu=kriteria&kriteria=tambah'>Tambah</a>"; ?> </h3>
		</div>
		<div class="module-body table">
			<table cellpadding="0" cellspacing="0" border="0" class="table" 
			width="100%">
				<thead>
					<tr>
						<th>No.</th>
						<th>Kriteria</th>
						<th>Bobot</th>
						
						<th><center>#</center></th>
					</tr>
				</thead>
				<tbody>
				<?php
					$no = 1;
					$getData = $lowongan_rinci->GetDataKriteria();

					while($data = $getData->fetch()){

						$id_kriteria = $data['id_kriteria'];

						echo "<tr>
							<td width = 7%>$no</td>
							<td width = 48%>$data[nama_kriteria]</td>
							<td width = 10%>$data[bobot]</td>";

						echo "<td width = 15%>
							<a class='btn btn-small btn-warning' href='?menu=kriteria&kriteria=edit&id=$id_kriteria'>Edit</a>
							<a class='btn btn-small btn-danger' href='#'>Hapus</a>
							</td>";
						echo "</tr>";

						$no++;
					}
					
				?>
				</tbody>
			</table>
		</div>
		</div>
<!-- batas tampilan data kriteria (awal) -->
<?php } ?>
</div>
</div>

<?php
	$lowongan = new Lowongan();
	$lowongan_rinci = new LowonganRinci();

	$pelamar = new Pelamar();
?>
<!-- intro area -->	  
	  <!-- About -->
	  <section id="about" class="home-section bg-white">
		<div class="container">
				<?php
				if(isset($_GET['lamar'])){
				  		$id_lowongan = $_GET['lamar'];
				  		$id_user = $_SESSION['user'];

				  		$qry_cek_pelamar = $pelamar->GetData("WHERE id_user='$id_user'");
				  		$data_pelamar = $qry_cek_pelamar->fetch();
				  		$id_lamaran = $data_pelamar['id_lamaran'];
				  		$qry_cek = $pelamar->CekLamaran($id_user, $id_lowongan);
				  		$cek = $qry_cek->rowCount();

				  		$qRin = $lowongan_rinci->GetDataLowongan($id_lowongan);
				  		$jml_rinci = $qRin->rowCount();

				  		// if($cek > 0){
				  		// 	die('anda sudah pernah daftar');
				  			
				  		// }
				  		$getP = $lowongan->GetData("where id_lowongan='$id_lowongan'");
				  		$pen = $getP->fetch();
				  	?>
				  	<div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Lamar <?php echo $pen['lowongan']; ?> </h2> 
					</div>
					<h4>Silahkan Isi Jawaban Anda</h4>
					<div class="module-body table">
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
					if (isset($_POST['submit'])) {
						
						$jumlah_data = $_POST['jumlah_data'];
						//jenjang_pendidikan
						//Pengalaman_kerja
						//usia
						// bahasa_asing
						$jenjang_pendidikan = $_POST['jenjang_pendidikan'];
						$pengalaman_kerja	= $_POST['Pengalaman_kerja'];
						$usia 				= $_POST['usia'];
						$bahasa_asing 		= $_POST['bahasa_asing'];

						// tentukan nilai dari kriteria baku
						// nilai pendidikan
							if ($jenjang_pendidikan=='SMP') {
								$nilai_pendidikan = 50;
							}
							if ($jenjang_pendidikan=='SMA') {
								$nilai_pendidikan = 70;
							}
							if ($jenjang_pendidikan=='D3') {
								$nilai_pendidikan = 80;
							}
							if ($jenjang_pendidikan=='S1') {
								$nilai_pendidikan = 90;
							}
							if ($jenjang_pendidikan=='S2') {
								$nilai_pendidikan = 100;
							}
						// nilai pengalaman_kerja
							if ($pengalaman_kerja=='operator') {
								$nilai_pengalaman = 50;
							}
							if ($pengalaman_kerja=='kepala_regu') {
								$nilai_pengalaman = 60;
							}
							if ($pengalaman_kerja=='supervisor') {
								$nilai_pengalaman = 80;
							}
							if ($pengalaman_kerja=='kepala_bagian') {
								$nilai_pengalaman = 90;
							}
							if ($pengalaman_kerja=='manager') {
								$nilai_pengalaman = 100;
							}
						// nilai usia
							if ($usia > 17 AND $usia <21) {
								$nilai_usia = 90;
							}
							if ($usia > 20 AND $usia <26) {
								$nilai_usia = 80;
							}
							if ($usia > 25 AND $usia <31) {
								$nilai_usia = 70;
							}
							if ($usia > 30 AND $usia <36) {
								$nilai_usia = 60;
							}
						// nilai bahasa asing
							if ($bahasa_asing=='1') {
								$nilai_bahasa = 50;
							}
							if ($bahasa_asing=='2') {
								$nilai_bahasa = 70;
							}
							if ($bahasa_asing=='3') {
								$nilai_bahasa = 80;
							}
							if ($bahasa_asing=='4') {
								$nilai_bahasa = 100;
							}
						$id_lowongan = $_POST['id_lamaran'];
						$insert_nilai_baku_pendidikan 	=  $lowongan->InsertDataBaku(1, $nilai_pendidikan, $id_lowongan);
						$insert_nilai_baku_pengalaman 	=  $lowongan->InsertDataBaku(2, $nilai_pengalaman, $id_lowongan);
						$insert_nilai_baku_usia 	  	=  $lowongan->InsertDataBaku(3, $nilai_usia, $id_lowongan);
						$insert_nilai_baku_bahasa  		=  $lowongan->InsertDataBaku(4, $nilai_bahasa, $id_lowongan);


						// input data kriteria sesuai kemampuan
						$jumlah_data = $_POST['jumlah_data'];
						$x=1;
						for ($i=0; $i < $jumlah_data ; $i++) { 
							$id_kriteria = $_POST['id_kriteria'];
							$nilai = 0;
							if (isset($_POST['nilai']) AND isset($_FILES['upload'])) {

								$explode = explode(".", $_FILES['upload']['name'][$x]);
								$format_file_cv = end($explode);
								date_default_timezone_set("Asia/Bangkok");
								$date = strtotime(date("Y-m-d H:i:s"));
								$name_file = $date.'-'.$id_kriteria[$i].'.'.$format_file_cv;
								// variabel yang boleh masuk
								$format_cv = array("docx","pdf","doc","DOCX","PDF","DOC");
								if (!in_array($format_file_cv,$format_cv)) {
									$error[] = "Format File Tidak Mendukung";
									$MsgCv = 'false';
									
								}
								$catatan = $_POST['nilai'].'#'.$name_filename_file;	 
								$upload[]=move_uploaded_file($_FILES['upload']['tmp_name'][$x], "../upload/" . $name_file);
							}

							if (isset($_POST['nilai']) AND !isset($_FILES['upload'])) {
								
								$catatan = $_POST['nilai'].'#0';	 
							}
							if (!isset($_POST['nilai']) AND isset($_FILES['upload'])) {
								// die('disini');
								
								$explode = explode(".", $_FILES['upload']['name'][$x]);
								$format_file_cv = end($explode);
								date_default_timezone_set("Asia/Bangkok");
								$date = strtotime(date("Y-m-d H:i:s"));
								$name_file = $date.'-'.$id_kriteria[$i].'.'.$format_file_cv;
								// variabel yang boleh masuk
								$format_cv = array("docx","pdf","doc","DOCX","PDF","DOC");
								if (!in_array($format_file_cv,$format_cv)) {
									$error[] = "Format File Tidak Mendukung";
									$MsgCv = 'false';
									
								}
								$catatan ='0#'.$name_file;	 
								$upload[]=move_uploaded_file($_FILES['upload']['tmp_name'][$x], "../upload/" . $name_file);
							}
							if (!isset($_POST['nilai']) AND !isset($_FILES['upload'])) {		
								
								$catatan =$_POST['status'];	 
							}

							// echo $catatan;
					

							$x++;
							
						}
						// die();
					}
					 ?>
					<form action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="jumlah_data" value="<?php echo $jml_rinci ?>">
					<input type="hidden" name="id_lamaran" value="<?php echo $id_lamaran; ?>">

					<tr>
						<div class="control-group">
						<td align="left">Jenjang Pendidikan</td>
						<td colspan="2" align="left">
							<div class="controls">
							<select name="jenjang_pendidikan">
								<option value="SMP">SMP</option>
								<option value="SMA">SMA</option>
								<option value="D3">D3</option>
								<option value="S1">S1</option>
								<option value="S2">S2</option>
							</select>
						</div>
						</td>
						</div>
					</tr>
					<tr>
						<td align="left">Pengalaman Kerja</td>
						<td align="left" colspan="2">

							<select name="Pengalaman_kerja">
								<option value="operator">Operator</option>
								<option value="kepala_regu">Kepala Regu</option>
								<option value="supervisor">Supervisor</option>
								<option value="kepala_bagian">Kepala Bagian</option>
								<option value="manager">Manager</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="left">Usia</td>
						<td align="left" colspan="2">
							<input type="teks" placeholder="Masukan Usia" name="usia">
						</td>
					</tr>
					<tr>
						<td align="left">Kemampuan Bahasa Asing</td>
						<td align="left" colspan="2">
							<select name="bahasa_asing">
								<option value="1">Tidak Ada</option>
								<option value="2">1 Bahasa Asing</option>
								<option value="3">2 Bahasa Asing</option>
								<option value="4">3 Bahasa Asing</option>
							</select>
						</td>
					</tr>
					<tr>
						<td align="left" colspan="3"><b>Kemampuan Seputar Pengalaman Kerja Yang Dilamar</b></td>
						
					</tr>
					<?php $no = 0; 

					while ($row_kriteria = $qRin->fetch()) { $no++; ?>
						<tr>
							
							<td align="left"><?php echo $no; ?>. <?php echo $row_kriteria['nama_kriteria']; ?></td>
							<input type="hidden" name="id_kriteria[]" value="<?php echo $row_kriteria['id_kriteria']; ?>">
							<?php
							if ($row_kriteria['status_upload']==1 AND $row_kriteria['status_nilai']=='1') { ?>
								
								

							 	<td><input type="file" name="upload[<?php echo $no ?>]"></td>
							 	<td><input type="teks" placeholder="Masukan nilai" name="nilai[<?php echo $no ?>]"></td>
							 <?php } 
							 if ($row_kriteria['status_upload']==1 AND $row_kriteria['status_nilai']=='0') { ?>
							 	<td colspan="2"><input type="file" name="upload[<?php echo $no ?>]"></td>
							 <?php } 
							  if ($row_kriteria['status_upload']==0 AND $row_kriteria['status_nilai']=='0') { ?>
							 	<td><input type="radio" id="basicinput" name="status[<?php echo $no; ?>]" value="1"></td>
								<td><input type="radio" id="basicinput" name="status[<?php echo $no; ?>]" value="0"></td>
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
		
                	<div class="form-group">
                		<input type='submit' name='submit' value='Simpan' class="btn btn-primary">
                	</div>
               </form>
				  </div>
			  </div>
				  	<?php

				  	}else if(isset($_GET['detail'])){
				  		$id_lowongan = $_GET['detail'];
				  		$getP = $lowongan->GetData("where id_lowongan='$id_lowongan'");
				  		$pen = $getP->fetch();
				  	?>
				  	<div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Detail <?php echo $pen['lowongan']; ?> </h2> 
					</div>

					<?php
					echo "<a href='?page=penerimaan&lamar=$id_lowongan' class='btn btn-primary'>Lamar</a>";
					?>

					<hr>
					<p>
						<h4>Syarat</h4>
						<?php
							$lowongan_rinci = new LowonganRinci();
							$rin = $lowongan_rinci->GetDataLowongan($id_lowongan);

							while($data = $rin->fetch()){
								echo "$data[nama_kriteria]<br>";
							}
						?>
					</p>

				  </div>
			  </div>
				  	<?php
				  	}else{

				  ?>
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Daftar Penerimaan</h2>
					</div>
				  </div>
			  </div>
			  <div class="row">

                	<div class="col-md-offset-2 col-md-8">
                		<input type="search" name="search" class="form-control" data-table="order-table" placeholder="Pencarian">
                	</div>
                </div>
				<div class="row">                
                <div class="col-md-offset-2 col-md-8">
                <table class="datatable-1 table table-bordered table-striped display order-table">
                	<thead>
                		<tr>
                		<th>No.</th>
                		<th>Penerimaan</th>
                		<th>Kuota</th>
                		<th></th>
                		</tr>
                	</thead>
                	<tbody>
                <?php
                	$no = 1;
                	$get = $lowongan->GetData("where status='1'");
                	while($row = $get->fetch()){
                		echo "<tr>
                				<td width=10%>$no</td>
                				<td width=60%>$row[lowongan]</td>
                				<td width=30%>$row[kuota]</td>
                				<td width=10%><a href='?page=penerimaan&detail=$row[id_lowongan]'>Detail</a></td>
                				</tr>";
                		$no++;
                	}
                ?>
                	</tbody>
                </table>
                <?php } ?>
                </div>
			  </div>			  
		  </div>	  
	  </section>

	  <script type="text/javascript">
	  	(function(document) {
 'use strict';

 var LightTableFilter = (function(Arr) {

  var _input;

  function _onInputEvent(e) {
   _input = e.target;
   var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
   Arr.forEach.call(tables, function(table) {
    Arr.forEach.call(table.tBodies, function(tbody) {
     Arr.forEach.call(tbody.rows, _filter);
    });
   });
  }

  function _filter(row) {
   var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
   row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';
  }

  return {
   init: function() {
    var inputs = document.getElementsByClassName('form-control');
    Arr.forEach.call(inputs, function(input) {
     input.oninput = _onInputEvent;
    });
   }
  };
 })(Array.prototype);

 document.addEventListener('readystatechange', function() {
  if (document.readyState === 'complete') {
   LightTableFilter.init();
  }
 });

})(document);

	  </script>
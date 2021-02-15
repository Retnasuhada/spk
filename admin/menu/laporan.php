<div class="span9">
	<div class="content">
<?php
	$user = new User();
	include "../include/fungsi_tanggal.php";
?>
	<div class="module">
		<div class="module-head">
			<h3>Halaman Laporan</h3> 
		</div>
		
		<div class="module-body">
			<form class="form-horizontal row-fluid" action="index.php?menu=act_laporan" method="post">
							<div class="control-group">
					<label class="control-label" for="basicinput">Pilih Laporan</label>
						<div class="controls">
							<select name="laporan" required="">
								<option value=""></option>
								<option value="1">Total Pelamar</option>
								<option value="2">Pelamar Diterima</option>
								<option value="3">Pelamar Ditolak</option>
							</select>
							<input class="btn btn-primary" type="submit" value="Cetak">
						</div>
				</div>
				
			</form>
			
		</div>
	</div>


	</div>
</div>

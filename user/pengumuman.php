<?php
	$lowongan = new lowongan();
	$hitung = new HitungSPK();
	$pelamar = new Pelamar();
?>
<!-- intro area -->	  
	  <!-- About -->
	  <section id="about" class="home-section bg-white">

	  <?php
	  $id_user = $_SESSION['user'];
	  $cek_data = $pelamar->GetData("where id_user='$id_user'");
		
	  $jml_lamaran = $cek_data->fetch();
	 if (empty($jml_lamaran)) {
	 	echo '<h2>Maaf Anda Belum Melamar</h2>';
	 	die();
	 }else{
	 	$id_lowongan = $jml_lamaran['id_lowongan'];
	 }
	  		// $id_lowongan = $_GET['penerimaan'];

	  		$qr_k = $lowongan->GetData("where id_lowongan='$id_lowongan'");
	  		$ft_k = $qr_k->fetch();

	  		$kuota = $ft_k['kuota'];

	  		?>
	  		 <?php
                	$get = $hitung->hitungPelamar($id_lowongan,"LIMIT '$kuota'");
                ?>
	  		<div class="container">
			  <div class="row">
				  <div class="col-md-offset-2 col-md-8">
					<div class="section-heading">
					 <h2>Hasil Lamaran Anda Sebagai <?php echo $ft_k['lowongan']; ?></h2>
					  
					</div>
				  </div>
			  </div>
			  <div class="row">

                	
               
                </div>
				<div class="row">                
                <div class="col-md-offset-2 col-md-8">
                <table class="datatable-1 table table-bordered table-striped display order-table">
                	<tbody>
                <?php
                	$no = 1;
                	while($row = $get->fetch()){
                		$user = new User();
                		$n = $user->GetData("where id_user='$row[id_user]'");
                		if ($row['id_user']==$_SESSION['user']) {
                			echo '<h2 style="color:green;">DITERIMA</h2>';
                			$a=1;
                		}else{
                			echo '<h2 style="color:red;">TIDAK DITERIMA</h2>';
                			$a=0;
                		}
                		
                	}
                ?>
                	</tbody>
                </table>
                <?php
                if ($a=='1') { ?>
              
                <h6>Hubungi pihak SDM untuk info lebih lanjut</h6>
            <?php } else { ?>
            	<h6>Terimakasih telah mendaftarkan diri anda sebagai kandidat bagian dari perusahaan kami.</h6>
            <?php } ?>
                </div>
			  </div>			  
		  </div>
	
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
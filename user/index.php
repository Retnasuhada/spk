<?php

	session_start();
	include "../include/koneksi.php";
	if(isset($_SESSION['user'])){

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Lowongan Kerja</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- css -->
    <link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
        <link href="../js/datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" media="screen">
    <link href="../css/style.css" rel="stylesheet" media="screen">
	<link href="../color/default.css" rel="stylesheet" media="screen">
	<script src="../js/modernizr.custom.js"></script>
	</head>
  <body>
	<div class="menu-area">
			<div id="dl-menu" class="dl-menuwrapper">
						<button class="dl-trigger">Open Menu</button>
						<ul class="dl-menu">
							<li><a href="index.php">Profil</a></li>
							<li><a href="?page=download">Download</a></li>
							<li><a href="?page=penerimaan">Penerimaan</a></li>
							<li><a href="?page=pengumuman">Pengumuman</a></li>
							<li><a href="logout_user.php">Logout</a></li>
						</ul>
					</div><!-- /dl-menuwrapper -->
	</div>	

<div id="intro">
	  
			<div class="intro-text">
				<div class="container">
					<div class="row">
					
						
					<div class="col-md-12">
			
						<div class="brand">
							<img src='../img/uui.png'>
							<h1><a href="index.html">Lowongan Kerja PT. CHINLI PLASTIC TECHNOLOGY INDONESIA<br></a></h1>
							
							<p><span>Bergabung bersama kami untuk mendapatkan karir yang lebih baik</span></p>
							
						</div>
					</div>
					</div>
				</div>
		 	</div>
			
	 </div>
	<?php
		include "page.php";



	}else{

		echo "<script language='javascript'> window.location.href='../index.php'</script>";

	}
	?>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p>Copyright &copy;2021  <a href="http://bootstraptaste.com">PT. CHINLI INDONESIA</a></p>
				</div>
                <!-- 
                    All links in the footer should remain intact. 
                    Licenseing information is available at: http://bootstraptaste.com/license/
                    You can buy this theme without footer links online at: http://bootstraptaste.com/buy/?theme=Mamba
                -->
			</div>		
		</div>	
	</footer>
	 
	  
	</body>

	<!-- js -->
    <script src="../js/jquery.js"></script>
        <script src="../js/datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.smooth-scroll.min.js"></script>
	<script src="../js/jquery.dlmenu.js"></script>
	<script src="../js/wow.min.js"></script>
	<script src="../js/custom.js"></script>
	<script type="text/javascript">
		 $(function(){
		  $(".datepicker").datepicker({
		      format: 'yyyy-mm-dd',
		      autoclose: true,
		      todayHighlight: true,
		  });
		 });
	</script>
</html>

<?php
	if(isset($_GET['menu'])){
		$menu = $_GET['menu'];

		if($menu == "pelamar"){
			include "menu/pelamar.php";
		}
		if($menu == "kriteria"){
			include "menu/kriteria.php";
		}
		if($menu == "act_laporan"){
			include "menu/laporan_view.php";
		}
		

		if($menu == "penerimaan"){
			include "menu/penerimaan.php";
		}
		if($menu == "laporan_diterima"){
			include "menu/laporan_diterima.php";
		}

		if($menu == "users"){
			include "menu/users.php";
		}

		if($menu == "file"){
			include "menu/file.php";
		}

		if($menu == "perhitungan"){
			include "menu/perhitungan.php";
		}
		if($menu == "laporan"){
			include "menu/laporan.php";
		}

	}else{
		include "menu/home.php";
	}
?>
<?php
	
	$mysqli = @new mysqli('localhost', 'root', '', 'simrs_rsjka_data',3306);	
	if ($mysqli->connect_errno) {
	    die('Connect Error: ' . $mysqli->connect_errno);
	}
	
	date_default_timezone_set("Asia/Jakarta");
	$filter_waktu = " AND DATE(waktu) = CURDATE() ";
	$model_antrian = 1;
	//Jika nomor antrian per loket : model_antrian = 1, artinya nomor tidak bersambung. antar poli punya nomor antrian sendiri
	//Jika nomor antrian Tidak per loket : model_antrian = 0
	
	$CLIENTNAME = "RSJ KALAWA ATEI";
	$COPYRIGHTS = "RSJ KALAWA ATEI";
	
	//Sesi Antrian
	//$filter_sesi = "1" => Pagi / $filter_sesi = "2" => Siang
	$jam = date ("H");
	
	if (($jam>=4) && ($jam<=11)){		
		$sesi_antrian = "1";
	}
	else if(($jam>11) && ($jam<=17)){		
		$sesi_antrian = "1";
	}else { 
		$sesi_antrian = "1";
	}
	
	$filter_sesi  = " AND sesi =  '$sesi_antrian' ";
	$filter_waktu = " AND DATE(waktu) = CURDATE() AND sesi =  '$sesi_antrian' ";
	
	
	
?>

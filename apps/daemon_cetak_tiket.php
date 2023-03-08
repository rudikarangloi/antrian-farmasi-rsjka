<?php
	/*
	require "print_tiket.php";	
	require "../client/constant.php";	
	$nomor_antrian 		= $_POST['nomor_antrian'];
	$nomor_antrian_gizi = $_POST['nomor_antrian_gizi'];
	$nama_loket    		= $_POST['nama_loket'];
	$nomor_rm      		= $_POST['nomor_rm'];
	$nama_pasien   		= $_POST['nama_pasien'];
	$CrSaveData    		= $_POST['CrSaveData'];
	
	if($CrSaveData == "ibu_hamil" || $CrSaveData == "anak_anak"){
		cetak_nomor_antrian($nomor_antrian_gizi, "Ruang Gizi",$nomor_rm,$nama_pasien,$printer_name);
		cetak_nomor_antrian($nomor_antrian, $nama_loket,      $nomor_rm,$nama_pasien,$printer_name);
		$cek = "IBU - ANAK";
	}else{
		cetak_nomor_antrian($nomor_antrian, $nama_loket,$nomor_rm,$nama_pasien,$printer_name);
		$cek = "LAINNYA";
	}
	
	
	$data['nomor_antrian']  = $nomor_antrian;
	$data['nama_loket']     = $nama_loket;
	$data['nomor_rm']       = $nomor_rm ;
	$data['CrSaveData']     = $CrSaveData;
	$data['cek']            = $cek;
	
	
	echo json_encode($data);
	*/
	
	require "print_tiket.php";	
	require "../client/constant.php";	
	$nomor_antrian 		= $_POST['nomor_antrian'];
	$nomor_antrian_gizi = $_POST['nomor_antrian_gizi'];
	$nama_loket    		= $_POST['nama_loket'];
	$nomor_rm      		= $_POST['nomor_rm'];
	$nama_pasien   		= $_POST['nama_pasien'];
	$CrSaveData    		= $_POST['CrSaveData'];
	
	if($CrSaveData == "ibu_hamil" || $CrSaveData == "anak_anak"){
		cetak_nomor_antrian($nomor_antrian_gizi, "Ruang Gizi",$nomor_rm,$nama_pasien,$printer_name);
		cetak_nomor_antrian($nomor_antrian, $nama_loket,$nomor_rm,$nama_pasien,$printer_name);
		$cek = "IBU - ANAK";
	}else{
		cetak_nomor_antrian($nomor_antrian, $nama_loket,$nomor_rm,$nama_pasien,$printer_name);
		$cek = "LAINNYA";
	}
	
	
	$data['nomor_antrian']  = $nomor_antrian;
	$data['nomor_antrian_gizi']  = $nomor_antrian_gizi;
	$data['nama_loket']     = $nama_loket;
	$data['nomor_rm']       = $nomor_rm ;
	$data['CrSaveData']     = $CrSaveData;
	$data['cek']            = $cek;
	
	
	echo json_encode($data);
			
			
		
	
	
?>
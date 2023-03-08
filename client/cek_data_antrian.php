<?php
//require "connfile-php7.php";
//require "functionfile-php7.php";
//include "../apps/mysql_connect.php";

require "file_connfile.php";
require "file_functionfile.php";
require "file_insertupdate.php";
require "../apps/mysql_connect.php";

extract($_POST);
extract($_GET);

//if(isset($_POST['input_data'])){
if(isset($_GET['input_data'])){
	
					
		$filter_waktu   = " AND DATE(antrianDate) = CURDATE()  " ;	

		$status_datang  = " AND status_kedatangan <> 1  " ;
		
		$sql = "SELECT data_antrian_detail.*,nama AS FldD FROM data_antrian_detail WHERE nik = '". $input_data ."'" . $filter_waktu;	
		 
		
		$sql = "SELECT data_antrian_detail.*,data_antrian_detail.nama AS FldD, client_antrian.kode_layanan,client_antrian.description 
				FROM data_antrian_detail 
				INNER JOIN data_antrian ON data_antrian_detail.kodeBooking = data_antrian.kodebooking
				INNER JOIN client_antrian ON data_antrian.counter = client_antrian.client
				WHERE data_antrian_detail.nik = '". $input_data ."'" . $filter_waktu . $status_datang;		
		
		$rstClient = $mysqli->query($sql);			
    	$rowClient = $rstClient->fetch_array();
    	if($rowClient['nik']){
			$json['peringatan'] = 0;
			$json['nama'] = $rowClient['FldD'];
			$nama = $json['nama'];
			$json['data'] = $rowClient;
			
			$results = $mysqli->query("UPDATE data_antrian_detail SET status_kedatangan = 1 WHERE nik = '". $input_data ."'" . $filter_waktu);
			
			//$api_url = 'http://10.10.10.1:8090/sql_server_develop/konfirmasi_antrian.php?'.http_build_query($json['data']);			
			//$json_data = file_get_contents($api_url);
			
			
			// Start here for InsertKunjungan
			
			$fLaYK = $rowClient['kode_layanan'];
			$fNik = $rowClient['nik'];
			$FS_MR = $rowClient['no_rm'];
			$fNama = $rowClient['nama'];
			$radCaraBayar = $rowClient['jenisantrianpoliklinik'];
			$tipePasien   = $rowClient['tipePasien'];
						
			$fLaYK = strtoupper($fLaYK);
			$g01  = $fNik;
			$g02  = date("Y-m-d");
			$g02a = date("H:i:s");
			$g03  = $FS_MR ;
			$g04  = $fNama ;

			$gNow = date("Y-m-d H:i:s");
			$gUser = "Antrian";

			//Sementara Ibu hamil dan anak-anak hanya boleh antrian non online. Karena di aplikasi mobile belum di update untuk ini
			switch ($tipePasien) {
			  case "0":
				$CrSaveData = "ibu_hamil";
				$bumil      = "Bawah";
				break;
			  case "1":
				$CrSaveData = "ibu_hamil";
				$bumil      = "Atas";
				break;
			  case "2":
				$CrSaveData = "anak_anak";
				$bumil      = "";
				break;
			  case "3":
				$CrSaveData = "NONE";
				$bumil      = "";
				break;
		
			  default:
				$CrSaveData = "NONE";
				$bumil      = "";
			}
			if($CrSaveData == "ibu_hamil"){
				$jenis_kedatangan = "IBU";
			}elseif ($CrSaveData == "anak_anak"){
				$jenis_kedatangan = "ANAK";
			}else{
				$jenis_kedatangan = "NONE";
			}
			
			//Umur kehamilan : dibawah 5 bulan atau diatas 5 bulan. Isi field : Atas/Bawah
			$CrSaveData2 = $bumil;

			//pembayaran Umum / BPJS
			if ($radCaraBayar=='1') {				
				$Kd_Jns_Klmpok = "01";
				$Kd_Perusahaan = "01.2015.001";
			}else{				
				$Kd_Jns_Klmpok = "02";
				$Kd_Perusahaan = "";
			}

			//Kode layanan
			switch ($fLaYK) {
			  case "RJ001":
				$fLaYK = "010101";
				break;
			  case "RJ002":
				$fLaYK = "010102";
				break;
			  case "RJ003":
				$fLaYK = "010103";
				break;
			  case "RJ004":
				$fLaYK = "010104";
				break;
			  case "RJ005":
				$fLaYK = "010105";
				break;
			  case "RJ006":
				$fLaYK = "010106"; 
				break;
			  case "RJ007":
				$fLaYK = "010107";
				break;
			  default:
				$fLaYK = "010101";
			}

			$g05 = $Kd_Jns_Klmpok ;
			$g06 = $Kd_Perusahaan ;
			$g07 = $jenis_kedatangan ;
			$g08 = $fLaYK ;
			$g09 = $CrSaveData2 ;

			InsertKunjungan($g01,$g02,$g02a,$g03,$g04,$g05,$g06,$g07,$g08,$g09,$gNow,$gUser,DatabaseSA,$ConSA);


			
			header("location:form_scan_qr.php?peringatan=2&nama=$nama");
		}else{
			header("location:form_scan_qr.php?peringatan=1");
		}     

		
}else{
	
}


function InsertKunjungan($g01,$g02,$g02a,$g03,$g04,$g05,$g06,$g07,$g08,$g09,$gNow,$gUser,$gDataBase,$gCon)
{
		$gKD = fGlobal("Max(Register)","tb_tr_kunjungan","Register","RWJ.".date('Y').".%","LIKE","",$gDataBase,$gCon,"");
		if ($gKD!="") {
			$gKD = (int)substr($gKD,-7,7)+1;
		}else {
			$gKD = 1;
		}
		$regi = "RWJ.".date('Y').".".substr("0000000".$gKD,-7,7);
		
		$Jenis_Kelamin = fGlobal("Jenis_Kelamin","tb_biodata","No_KTP",$g01,"=","",$gDataBase,$gCon,"");
		$Alamat        = fGlobal("Alamat","tb_biodata","No_KTP",$g01,"=","",$gDataBase,$gCon,"");
		$RT_RW         = fGlobal("RT_RW","tb_biodata","No_KTP",$g01,"=","",$gDataBase,$gCon,"");
		$Kecamatan     = fGlobal("Kecamatan","tb_biodata","No_KTP",$g01,"=","",$gDataBase,$gCon,"");
		$Kota_Kab      = fGlobal("Kota_Kab","tb_biodata","No_KTP",$g01,"=","",$gDataBase,$gCon,"");
		$Provinsi      = fGlobal("Provinsi","tb_biodata","No_KTP",$g01,"=","",$gDataBase,$gCon,"");
		$Kode_Pos      = fGlobal("Kode_Pos","tb_biodata","No_KTP",$g01,"=","",$gDataBase,$gCon,"");
		$Kd_Stakaw     = fGlobal("Kd_Stakaw","tb_biodata","No_KTP",$g01,"=","",$gDataBase,$gCon,"");
		$Kd_Pendidikan = fGlobal("Kd_Pendidikan","tb_biodata","No_KTP",$g01,"=","",$gDataBase,$gCon,"");
		$Kd_Pekerjaan  = fGlobal("Kd_Pekerjaan","tb_biodata","No_KTP",$g01,"=","",$gDataBase,$gCon,"");
		
		$SQ="INSERT INTO tb_tr_kunjungan SET 
			Register='$regi',
			Tanggal='$g02',
			Jam='$g02a',
			NoRekMed='$g03',
			Nama='$g04',
			Jenis_Kelamin='$Jenis_Kelamin',
			Alamat='$Alamat',
			RT_RW='$RT_RW',
			Kecamatan='$Kecamatan',
			Kota_Kab='$Kota_Kab',
			Provinsi='$Provinsi',
			Kode_Pos='$Kode_Pos',
			Kd_Stakaw='$Kd_Stakaw',
			Kd_Pendidikan='$Kd_Pendidikan',
			Kd_Pekerjaan='$Kd_Pekerjaan',		
			Nma_PnggJawab='',
			Hub_PnggJawab='',
			Alm_PnggJawab='',
			Tlp_PnggJawab='',
			Ket_Polisi='',
			Ket_Polisi_Tgl='0000-00-00',
			
			Kd_Jns_Klmpok='$g05',
			Kd_Perusahaan='$g06',
			NoRegKartu='',
			KartuBerobat='BARU',
			jenis_kedatangan='$g07',
			No_SEP='',
			Status='CheckIn',
			KePnjgLgsg='N',
			
			Recorded='$gNow',
			Pencatat='$gUser'";
		$nRs = mysqli_query($gCon, $SQ) or die(mysqli_error($gCon));
		
		$gKD = fGlobal("Max(Register)","tb_tr_kunjungan_rinci","Register",$regi.".%","LIKE","",$gDataBase,$gCon,"");
		if ($gKD!="") {$gKD = (int)substr($gKD,-2,2)+1;}
		else {$gKD = 1;}
		$g01x = $regi.".".substr("00".$gKD,-2,2);
		
		$SQ="INSERT INTO tb_tr_kunjungan_rinci SET 
			Register='$g01x',
			Tanggal='$g02',
			Jam='$g02a',
			NoRekMed='$g03',			
			Kd_Rujukan='00',
			Kd_Ruang_Poli='$g08',			
			Jns_Layanan='$g08',			
			Ibu_Hamil='$g09',
			Status='ON',
			Recorded='$gNow',
			Pencatat='$gUser'";
		$nRs = mysqli_query($gCon, $SQ) or die(mysqli_error($gCon));
}
//echo json_encode($json);
?>


<?php
	 //require "../../php/connfile.php";
		//require "../../php/functionfile.php";
		//require "../../php/insertupdate.php";
		
	include "mysql_connect.php";
	//include "print_tiket.php";	
	date_default_timezone_set('Asia/Jakarta');
		
	$loket    = $_POST['loket'];
	$nomor_rm = $_POST['nomor_rm'];
	$counter  = "";
	$filter_jenis_antrian = " AND jenis_antrian_poliklinik = '0' ";

		//fungsi untuk mendapatkan jumlah total baris di database
	function getTotalRow($sql)
	{
		//$rs = mysql_query($sql) or die(mysql_error().$sql);
		//$r = mysql_num_rows($rs);
		//mysql_free_result($rs);

		include "mysql_connect.php";

		$rstClient = $mysqli->query($sql);		
		$rowClient = $rstClient->fetch_array();
		if($rowClient['count']>0){
			$jmlClient = $rowClient['count'];
		}else{
			$jmlClient = 0;
		}
	  
		return $jmlClient;
	}

	function KodeBooking()
	{
		//jumlah panjang karakter angka dan huruf.
		
		$length_abjad = "2";
		$length_angka = "4";

		//huruf yg dimasukan, kecuali I,L dan O
		$huruf = "ABCDEFGHJKMNPRSTUVWXYZ";

		//mulai proses generate huruf
		$i = 1;
		$txt_abjad = "";
		while ($i <= $length_abjad) {
			$txt_abjad .= $huruf{mt_rand(0,strlen($huruf))};
			$i++;
		}

		//mulai proses generate angka
		$datejam = date("His");
		$time_md5 = rand(time(), $datejam);
		$cut = substr($time_md5, 0, $length_angka);	

		//mennggabungkan dan mengacak hasil generate huruf dan angka
		$acak = str_shuffle($txt_abjad.$cut);

		//menghitung dan memeriksa hasil generate di database menggunakan fungsi getTotalRow(),
		//jika hasil generate sudah ada di database maka proses generate akan diulang

		
		$cek  = getTotalRow("SELECT count(*) as count FROM data_antrian WHERE kodebooking = '".$acak."'");
		if($cek > 0) { $cek = KodeBooking(); }

		/*
		$cek = 0;
		$rstClient = $mysqli->query("SELECT count(*) as count FROM data_antrian WHERE kodebooking = '".$acak."'");		
		$rowClient = $rstClient->fetch_array();
		if($rowClient['count']>0){
			$jmlClient = $rowClient['count'];
		}else{
			$jmlClient = 0;
		}
		if($jmlClient > 0) { $cek = KodeBooking(); }
		*/

		return $acak;
	}

	function get_client_ip() {
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	
	//echo $loket .'  -- '.$nomor_rm;
	//exit;
	
	
	/*SQL SERVER*/
	/*
	
	$status = "3";
	
	$SQL="SELECT TOP 3 counter,status FROM data_antrian WHERE counter='' AND status=3 ";
	$mRs = mssql_query($SQL);
	$mRo = mssql_fetch_array($mRs);
	$tRo = mssql_num_rows($mRs);
	if ($tRo>0){			
			$id = $mRo[0];
			$SQL ="UPDATE data_antrian SET counter=". $loket .",status=0 WHERE id=".$id."";
			$Rs = mssql_query($SQL);
			$next_counter = $id;
	}else{
			$waktu = date("Y-m-d H:i:s");
			$status = "3";
			
			$gTBL = "data_antrian";
			$gFLD = "";
			$gVAL = "";
			$gFLD = "waktu";
			$gVAL = "'$waktu'";			
			$gFLD.= ", counter";
			$gVAL.= ", $loket";			
			$gFLD.= ", status";
			$gVAL.= ", $status";

			InsertGLOBAL($gTBL,$gFLD,$gVAL,DatabaseSA,$ConSA);
			
			$data['idle'] = "TRUE";
	}
	
	mssql_close($ConSA); 
	*/
	
				
	/*MYSQL SERVER*/
	$rstClient = $mysqli->query("SELECT * FROM data_antrian WHERE counter='' AND status=3 ". $filter_waktu. $filter_jenis_antrian . " LIMIT 1");
	
	$rowClient = $rstClient->fetch_array();
	if($rowClient['id']){
	//if(count($rowClient)>0){
			$id = $rowClient['id'];
			$results = $mysqli->query('UPDATE data_antrian SET counter='.$loket.', status=0 WHERE id='.$id.'');
			$next_counter = $id;
			//update
	}else{
			if($model_antrian == 1){
				//Jika nomor antrian per loket
				$rstCountId = $mysqli->query("SELECT count(*) as count FROM data_antrian WHERE id ". $filter_waktu . $filter_jenis_antrian);
				//$rstCountId = $mysqli->query("SELECT count(*) as count FROM data_antrian WHERE counter='".$loket."' ". $filter_waktu . $filter_jenis_antrian);
			}else{
				//Jika nomor antrian tidak per loket
				$rstCountId = $mysqli->query("SELECT count(*) as count FROM data_antrian WHERE id ". $filter_waktu . $filter_jenis_antrian);
				//$rstCountId = $mysqli->query("SELECT count(*) as count FROM data_antrian WHERE counter='".$loket."' ". $filter_waktu . $filter_jenis_antrian);
	
			}

			$rowCountId = $rstCountId->fetch_array();
			if($rowCountId['count']>0){
				$jmlCountId = (int)$rowCountId['count'] + 1 ;
			}else{
				$jmlCountId = 1;
			}
			//insert

			$KodeBookings = KodeBooking();
			//$results = $mysqli->query('INSERT INTO data_antrian (waktu,counter,status,nomor) VALUES ("'.date("Y-m-d H:i:s").'",'.$loket.',3,'.$jmlCountId.')');
			$results = $mysqli->query('INSERT INTO data_antrian (waktu,counter,status,nomor,kodebooking,sesi) VALUES ("'.date("Y-m-d H:i:s").'",'.$loket.',3,'.$jmlCountId.',"'.$KodeBookings.'","'.$sesi_antrian.'")');
			
			//Cetak Nomor antrian
				
			$result = $mysqli->query('SELECT description FROM client_antrian ORDER BY client'); 
			while ($rows = $result->fetch_array()) {	
				$NmArr[] = $rows['description'];
			}
			
			$val_loket = intval($loket) - 1;	
			$nama_loket= $NmArr[$val_loket];

			
			//Cetak 
			$theIP = get_client_ip();
			
			switch ($theIP) {
				case "192.160.10.222":
					//echo "The IP : 192.160.10.222 -> Antrian 1";
					include "print_tiket_antrian_satu.php";
					break;
				case "192.160.10.223":
					//echo "The IP : 192.160.10.223 -> Antrian 2";
					include "print_tiket_antrian_dua.php";
					break;  
				 case "192.160.10.224":
					//echo "The IP : 192.160.10.224 -> Apotik ";
					include "print_tiket_apotik.php";
					break;
				default:
					//echo "Lainnya";
					include "print_tiket.php";	
			}
	
			cetak_nomor_antrian($jmlCountId, $nama_loket,$nomor_rm,'MyPrinterIS-HP');
			
			//----
			
			
			if($model_antrian == 1){
				//Jika nomor antrian per loket
				//$rstCountId = $mysqli->query('SELECT count(*) as count FROM data_antrian WHERE counter='. $loket .''. $filter_waktu . $filter_jenis_antrian);
				$rstCountId = $mysqli->query('SELECT count(*) as count FROM data_antrian WHERE id '. $filter_waktu . $filter_jenis_antrian);
			}else{
				//Jika nomor antrian tidak per loket
				$rstCountId = $mysqli->query('SELECT count(*) as count FROM data_antrian WHERE id '. $filter_waktu . $filter_jenis_antrian);
				//$rstCountId = $mysqli->query('SELECT count(*) as count FROM data_antrian WHERE counter='. $loket .''. $filter_waktu . $filter_jenis_antrian);
		
			}

			$rowCountId = $rstCountId->fetch_array();
			if($rowCountId['count']>0){
				$jmlCountId = $rowCountId['count'];
			}else{
				$jmlCountId = 0;
			}
			//----
			//$next_counter = $mysqli->insert_id;
			$next_counter = $jmlCountId ;
			$data['idle'] = "TRUE";
	}
	//$results = $mysqli->query('INSERT INTO data_antrian (counter,waktu,status) VALUES ('.$loket.',"'.date("Y-m-d H:i:s").'",0)');
	$data['next'] = $next_counter;
	echo json_encode($data);
	include 'mysql_close.php';
	
?>
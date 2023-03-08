<?php
    date_default_timezone_set('Asia/Jakarta');
    
	function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;		 
	}	
	
	function tanggal_sekarang(){
			$tanggal= mktime(date("m"),date("d"),date("Y"));
			$tanggal = date("d-M-Y", $tanggal);
			date_default_timezone_set('Asia/Jakarta');
			$jam = date("H:i:s");
			
			return 	$tanggal . ' ' .$jam	;	
			
	}
	
	function tanggal_sekarang2(){
					
			$date=date('Y-m-d');
			$tanggal_sekarang = format_hari_tanggal($date);
			return $tanggal_sekarang;
	}

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			} 
			
	function format_hari_tanggal($waktu)
	{
		$hari_array = array(
			'Minggu',
			'Senin',
			'Selasa',
			'Rabu',
			'Kamis',
			'Jumat',
			'Sabtu'
		);
		$hr = date('w', strtotime($waktu));
		$hari = $hari_array[$hr];
		$tanggal = date('j', strtotime($waktu));
		$bulan_array = array(
			1 => 'Januari',
			2 => 'Februari',
			3 => 'Maret',
			4 => 'April',
			5 => 'Mei',
			6 => 'Juni',
			7 => 'Juli',
			8 => 'Agustus',
			9 => 'September',
			10 => 'Oktober',
			11 => 'November',
			12 => 'Desember',
		);
		$bl = date('n', strtotime($waktu));
		$bulan = $bulan_array[$bl];
		$tahun = date('Y', strtotime($waktu));
		$jam = date( 'H:i:s', strtotime($waktu));
		$jam2 = date( 'H:i:s');
		
		//untuk menampilkan hari, tanggal bulan tahun jam
		//return "$hari, $tanggal $bulan $tahun $jam";

		//untuk menampilkan hari, tanggal bulan tahun
		return "$hari, $tanggal $bulan $tahun, $jam2";
	}
	
	
?>

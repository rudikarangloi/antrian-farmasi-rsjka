<?php
include "../apps/mysql_connect.php";

extract($_POST);
extract($_GET);

if(isset($_POST['input_data'])){	
		$input_data = $_POST['input_data'];
		
		$sql = "SELECT * FROM tb_biodata WHERE No_KTP = '". $input_data ."'";		
		$rstClient = $mysqli->query($sql);			
    	$rowClient = $rstClient->fetch_array();
    	if($rowClient['NoRekMed']){
			$json['peringatan'] = 0;
			
			//$json['nama'] = $tIDT;   
			$json['data'] = $rowClient;
		}else{
			$json['peringatan'] = 1;	
			
			$json['nama'] = '---';
		}       
}

echo json_encode($json);
?>
<?php
	ini_set('display_errors', '0');
	
	include "mysql_connect.php";
	
    $id = $_POST['id'];
	
	$getDate = date('Y-m-d H:i:s');
	$waktu_terlayani = " ,waktu_terlayani = '". $getDate ."'";
	$terlayani = " ,terlayani =  TIMEDIFF('". $getDate ."',(SELECT waktu FROM data_antrian_apotik WHERE id=".$id.")) ";

	$sql = "UPDATE data_antrian_apotik SET status= 2,status_error='' $waktu_terlayani $terlayani WHERE id=".$id."";
	//echo $sql;
	$result = $mysqli->query($sql); 
	if (!$result)
		echo json_encode(array('status'=>0));
	else
		echo json_encode(array('status'=>1));
	
	include 'mysql_close.php';
	


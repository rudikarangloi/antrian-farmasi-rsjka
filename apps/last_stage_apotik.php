<?php
header("Access-Control-Allow-Headers: Authorization, Content-Type");
header("Access-Control-Allow-Origin: *");
header('content-type: application/json; charset=utf-8');
// include "mysql_connect.php";	

// $loket = $_POST['loket'];
// $date = date("Y-m-d");


// $results = $mysqli->query('SELECT count(*) as id FROM data_antrian_apotik WHERE id '.$filter_waktu.' ORDER by id');

// $row = $results->fetch_array();
// if ($row['id'] == NULL) {
//     $data = array('next' => 0);
// } else {
//     $data = array('next' => $row['id']);
// }
// echo json_encode($data);
// include 'mysql_close.php';

include "mysql_connect.php";	

$date = date("Y-m-d");
$filter_jenis_antrian = "  ";

$sql = 'SELECT count(*) as id FROM data_antrian_apotik WHERE id ' . $filter_waktu . $filter_jenis_antrian . ' ORDER by id';
$results = $mysqli->query($sql);

$row = $results->fetch_array();
if ($row['id'] == NULL) {
    $data = array('next' => 0);
} else {
    $data = array('next' => $row['id']);
}
echo json_encode($data);
include 'mysql_close.php';

?>
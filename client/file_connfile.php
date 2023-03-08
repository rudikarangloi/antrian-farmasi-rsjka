<?php
ini_set('display_errors', 0);
$KdP = "1.02.1.02.02.33";
$KdK = "1.02.1.02.02.33.01";

define('HostnameSA','localhost');
define('DatabaseSA','simpus_data');
define('UsernameSA','root');
define('PasswordSA','root');
define('PortSA','3306');
//$ConSA = mysql_connect(HostnameSA.":".PortSA, UsernameSA, PasswordSA);
$ConSA = mysqli_connect(HostnameSA.":".PortSA, UsernameSA, PasswordSA);
//$ConSA = mysqli_connect("103.153.85.133:13306", UsernameSA, PasswordSA);
$GLOBALS['_ConSA'] = $ConSA;
if ($ConSA==false)
{
	echo "Error: <font color='#FF0000'>Koneksi ke server tidak berhasil...!!</font>";
	exit;
}

function CallConnection($gDatabase,$gCon)
{
	//$SelDA =  mysql_select_db($gDatabase, $gCon);
	$SelDA =  mysqli_select_db($gCon,$gDatabase);
	if ($SelDA==false)
	{
		echo "Error: Database <font color='#FF0000'><b>".$gDatabase."</b></font> tidak ditemukan...!!";
		exit;
	}
}
?>

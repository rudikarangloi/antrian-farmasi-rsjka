<?
//require "file_connfile.php";
//require "file_functionfile.php";

include "../apps/mysql_connect.php";
//mysqli_select_db( $ConSA, constant('DatabaseSA'));

if (isset($_GET['IdL'])) {$IdL = $_GET['IdL'];}
if (isset($_GET['CrT'])) {$CrT = $_GET['CrT'];}
if (isset($_GET['CrT'])) {$CrT = str_replace('**',' ',$_GET['CrT']);}
?>
<table align="center" class="table-list" cellpadding="0" cellspacing="0" width="100%" height="100%" border="0">
  <?
	
  $iG=1;
	$sql = " SELECT * FROM data_antrian_apotik WHERE 1 AND waktu LIKE  '2022-11-14%' ";
	$sql = " SELECT * FROM data_antrian_apotik WHERE 1 AND DATE(waktu) = CURDATE() AND status_obat = 0 ORDER BY nomor";
	$squery = $mysqli->query($sql); 
	while($row = mysqli_fetch_array($squery))
	{
		
		$MeD = '';

		$IdT   = $row['id'];
	  $gNORM = $row['norm'];
		$gNAMA = $row['nama'];
		$gNOMOR = $row['nomor'];
		$gSTATUS = $row['status'];
		//$gBG = fBackCLR($iG);
		$gBG = '';
		$gAL = '';

		if($gSTATUS == 2){
			$gBG = "bgcolor= #F2F3F4";
		}
		?>
		  <tr height="20"> 
			<td valign="top" class="ac" width="50" style="border-bottom:1px dotted #999999" <?=$gBG?>><?=$gNOMOR?></td>
			
			<td valign="top" class="al" style="padding-left:5px; border-right:1px dotted #999999; border-bottom:1px dotted #999999" <?=$gBG?>><?=$gNAMA?></td>

			<td valign="top" class="ac" width="50" style="border-bottom:1px dotted #999999" <?=$gBG?>>
			<a href="#" onclick="gPasien('<?=$gNAMA?>','<?=$gNOMOR?>','<?=$IdT?>'); return false" class="ico edit">Pilih</a>
			</td>
		  </tr>
		  <?
		$iG++;
	}
	?>
  <tr height="100%"> 
    <td colspan="5">&nbsp;</td>
  </tr>
</table>

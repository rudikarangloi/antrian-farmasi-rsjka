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
	// if ($CrT=="" || $CrT=="%")
	// {
	// 	$SyT = "";
	// 	$LmT = "LIMIT 50";
	// }
	// else 
	// {
	// 	$SyT = "AND (P1.NoRekMed LIKE '%$CrT%' OR P2.Nama LIKE '%$CrT%' OR P2.Alamat LIKE '%$CrT%')";
	// 	$LmT = "";
	// }
	// $gAdm = CheckAdmType($IdL);
	// $gPol = CheckKodePoli($IdL);
	
	// if ($gAdm<=1) {$gPol="%";}
	// $iG=1;
	// $nSQ = "SELECT P1.IDT, P1.Register, P1.NoRekMed, P2.IDT AS IDG, P2.Nama, P2.Alamat 
	// 			FROM tb_tr_kunjungan_rinci P1 JOIN tb_tr_kunjungan P2 ON P2.Register=mid(P1.Register,1,16) 
	// 			WHERE P1.Register LIKE 'RWJ%' AND P1.Kd_Ruang_Poli LIKE '$gPol' AND P1.Status='ON' 
	// $SyT ORDER BY P2.Nama ".$LmT;
	// $nRs = mysqli_query($ConSA, $nSQ);
	// while ($mRo = mysqli_fetch_array($nRs))

  $iG=1;
	$sql = " SELECT * FROM data_antrian_apotik WHERE 1 AND waktu LIKE  '2022-11-14%' ";
	$sql = " SELECT * FROM data_antrian_apotik WHERE 1 AND DATE(waktu) = CURDATE() AND status_obat = 1 ORDER BY nomor";
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

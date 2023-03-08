<?php
function InsertGLOBAL($gTBL,$gFLD,$gVAL,$gDataBase,$gCon)
{
	CallConnection($gDataBase,$gCon);
	$SQG="INSERT INTO $gTBL (".$gFLD.") values(".$gVAL.")";
	#echo $SQG."<br>";	
	$rsG= mysqli_query($ConSA, $SQG) or die(mysqli_error($ConSA));
}

function UpdateGLOBAL($gTBL,$gDTA,$gIdX,$gSyR,$gOpR,$gDataBase,$gCon)
{
	$JmL=fHiexplodeT2K($gIdx,":");
	if ($JmL > 0)
	{
		$gID = explode(':',$gIdX);
		$gSY = explode(':',$gSyR);
		$gOP = explode(':',$gOpR);
		
		$gUpD= "";
		for ($iG=0; $iG<=$JmL; $iG++)
		{
			if ($iG > 0) {$gAd=" AND ";} else {$gAd="";}
			$gUpD.= $gAd.$gID[$iG]." ".$gOP[$iG]." ".$gOP[$iG];
		}
	} 
	else
	{
		$gUpD=$gIdX.$gOpR.$gSyR;
	}
	
	CallConnection($gDataBase,$gCon);
	$SQG="UPDATE $gTBL SET ".$gDTA." WHERE ".$gUpD;	
	$rsG= mysqli_query($ConSA, $SQG) or die(mysqli_error($ConSA));
}
?>
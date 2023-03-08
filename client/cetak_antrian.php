<style>
    td {
        line-height: 85%;
    }
</style>

<?php

extract($_GET);


if (isset($_GET['nama_pasien'])) {
    $nama_pasien = $_GET['nama_pasien'];
}

if (isset($_GET['nomor_antrian'])) {
    $nomor_antrian = $_GET['nomor_antrian'];
}


$v_nama_pasien = explode("****",$nama_pasien);

$norm_ = $v_nama_pasien[0];
$nama_ = $v_nama_pasien[1];

$report = '
<style type="text/css">
p {
    font-size:12px; line-height: 10px;
 }
</style>     
                  
		         

<div align="center">
        <table border="0" width="50%">
    <tr>
        <td width="53">&nbsp;</td>
        <td>
        <p align="center"><u>RSJ Kalawa Atei</u></td>
        <td width="120">&nbsp;</td>
    </tr>
    <tr>
        <td width="53">&nbsp;</td>
        <td>
        <p align="center">Kalimantan Tengah</td>
        <td width="120">&nbsp;</td>
    </tr>
    <tr>
        <td width="53">&nbsp;</td>
        <td>&nbsp;</td>
        <td width="120">&nbsp;</td>
    </tr>
    <tr>
        <td width="53">&nbsp;</td>
        <td align="center">No. RM : '.$norm_.'</td>
        <td width="120">&nbsp;</td>
    </tr>
    <tr>
        <td width="53">&nbsp;</td>
        <td align="center">Nomor antrian </td>
        <td width="120">&nbsp;</td>
    </tr>
    <tr>
        <td width="53" height="125">&nbsp;</td>
        <td height="125" align="center"><font size="7"><div id="no_urut">'.$nomor_antrian.'</div></font></td>
        <td width="120" height="125">&nbsp;</td>
    </tr>
    <tr>
        <td width="53">&nbsp;</td>
        <td align="center">Terimakasih atas kunjungan Anda</td>
        <td width="120">&nbsp;</td>
    </tr>
    <tr>
        <td width="53">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td width="120">&nbsp;</td>
    </tr>
    <tr>
        <td width="53">&nbsp;</td>
        <td align="center">&nbsp;</td>
        <td width="120">&nbsp;</td>
    </tr>
</table>
</div>

		 
		 
';


echo $report;
?>
<script>
    window.print();
</script>

<script type="text/javascript">

               
        $("document").ready(function()
        {
            $('#loading').hide();       
            $('.next_queue').show();           
            $(".peringatan").hide();
            
            // var uri_stage = "<?php echo $url_api;?>last_stage_apotik.php";                       
            // var uri       = "<?php echo $url_api;?>daemon_serve_client_apotik.php";

            var uri_stage = "../apps/last_stage_apotik.php";
            var uri       = "../apps/daemon_serve_client_apotik.php";
            
            //var uri_cetak_tiket = "../apps/daemon_cetak_tiket_apotik.php";
            var uri_cetak_tiket = "cetak_antrian.php";
            
            // GET LAST COUNTER
            //var data = {"loket": <?php //echo $_SESSION["loket_client"];?>};
            var data = {"loket": 0};


            $.ajax({
                type: "POST",
                dataType: "json",
                url: uri_stage,//request
                data: data,
                success: function(data) {
                    no_antrian_db = parseInt(data["next"]);
                    $("#no_urut").html(no_antrian_db);
                   
                }
            });

</script>
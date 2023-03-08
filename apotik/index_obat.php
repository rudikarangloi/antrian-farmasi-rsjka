<?php 
	session_start();
	if (!isset($_SESSION["loket_client"])) {
		$_SESSION["loket_client"] = NULL;
	}
	
	$_SESSION["nomor_loket"] = $_GET['nomor_loket'];
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <title>Persiapan Obat</title>
	    <link href="../assert/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../assert/css/jumbotron-narrow.css" rel="stylesheet">
		<script src="../assert/js/jquery.min.js"></script>

		<link rel='stylesheet' href='file_style.css' type='text/css' media='all' />

		<!-- Sweet alert -->
		<script type='text/javascript' src='../assert/asset/js/sweetalert2.min.js'></script>
		<link rel='stylesheet' href='../assert/asset/css/sweetalert.css' type='text/css' media='all' />

	</head>
	
	<style>
		#peringatan{
			color:red;
			font-size:14px;
		}
		
		.nomor_loket h1{
			font-size:14px;
		}
		#init_max_queque {			
			color:#FFF;					
		}
	</style>
  	<body background="#fff">
    <div class="container">
		<button class="btn btn-small btn-primary goHome" type="button" style="float:left;padding:20px;">
            Data Pasien <span class="glyphicon glyphicon-home"></span>    
        </button>

        <!-- <input name="button" type="button" style="width:30px; height:20px" onClick="showDiv(1)" value="...." tabindex="1" />   -->
      
		<div id="welcomeMstCri" class="finddata0Cri">
			<div id="welcomeDiv1Cri" class="finddata1Cri"></div>
			<div id="welcomeDiv2Cri" class="finddata2Cri"></div>
		</div>

             
		<!-- <button class="btn btn-small btn-primary goRepeat" type="button" 
			style="float:right;padding:20px;">
            Panggil Ulang  &nbsp;<span class="glyphicon glyphicon-volume-up"></span>    
        </button> -->
		<div id='show-loket2' style="float:right;padding:20px;">	
					<input class='rg2' id="racikan" type="radio" name="obat" value="racikan">
					<label for="Loket1" style="color:white;">Racikan</label>
					&nbsp;&nbsp;	
					<input class='rg2' id="non_racikan" type="radio" name="obat" value="non_racikan">
					<label for="Loket1"  style="color:white;">Non Racikan</label>	
		</div>

    	<form>
    		<div style="background-color:#000000;"  class="jumbotron">
				<font color="#FFFFFF" size="45px">
					<h1 class="next">
						<span class="glyphicon glyphicon-book"></span>
					</h1>
					<p class="nomor_loket">
						<?php //echo $_SESSION["nomor_loket"];?>
					</p>
					<p class="nama_loket">
						
					</p>
				</font>
													
																	
												
				<button type="button" class="btn btn-lg btn-success next_getway">Buat Obat <span class="glyphicon glyphicon-chevron-right"></span></button>
				<p id="peringatan">
					Nomor Antrian Dalam Panggilan.
				</p>
									
				
	      	</div>
    	</form>
    	<br/>

    	 
      	<footer class="footer">
        <p>RSJKA <?php echo date("Y");?></p>
        <p class="nomor_antrian">
        <p class="idt">
      	</footer>
    </div>
  	</body>
	<?php
		
	include "../apps/mysql_connect.php";
	
	$result = $mysqli->query('SELECT description FROM client_antrian_apotik ORDER BY client'); 
	while ($rows = $result->fetch_array()) {	
		$result_array[] = $rows['description'];
	}
	
    $json_array = json_encode($result_array);
	?>
	
  	<script type="text/javascript">
			$("document").ready(function()
			{
				var nomor_loket = $(".nomor_loket").text();
				var gg= <?php echo $json_array; ?>

				$('#racikan').attr('checked', true);

								
				//var gg={1:'POLI ANAK',2:'POLI JANTUNG',3:'POLI UMUM',4:'POLI THT',5:'POLI PENYAKIT DALAM',6:'-',7:'-',8:'-',9:'-'};
				$('.nama_loket').html(gg[parseInt(nomor_loket,10)-1]);
			
				$('.nomor_loket').hide();

				//$(".next").html(data['next']);
				$('#peringatan').hide();

				// GET LAST COUNTER
			    $.post( "../apps/admin_getway_apotik.php", {"nomor_loket": nomor_loket}, function( data ) {
					// $(".next").html(data['next']);
					// $('#peringatan').hide();
				},"json");
				
			
			    // RESET 
				$(".next_getway").click(function(){
					var next_current = $(".next").text();
					var next_repeat = 0;
					var nomor_antrian = $('.nomor_antrian').text();
					var idt = $('.idt').text();

					//if ($('#racikan').attr('checked', true)) {
					if(document.getElementById("racikan").checked == true){
						jenisresep = "racikan";
					} else {
						jenisresep = "non racikan";
					}

					$('#peringatan').hide();
					
					$.post( "../apps/admin_getway_apotik_status_obat.php", {"next_current": next_current,"next_repeat": next_repeat,"nomor_loket": nomor_loket,"nomor_antrian": nomor_antrian,"idt": idt}, function( data ) {
						if(data['peringatan'] == 1){
							$('#peringatan').show();
						}
						//$(".next").html(data['next']);
						taskid = "6";
						kodebooking = data["kodeBooking"];
						updateDataAntrean(kodebooking,taskid);

						farmasiAdd(kodebooking,jenisresep,nomor_antrian);

						
					},"json");
				});
				
				// Repeat 
				$(".goRepeat").click(function(){
					// var next_current = $(".next").text();
					// var next_repeat = $(".next").text();
					var next_current = $(".nomor_antrian").text();
					var next_repeat = $(".nomor_antrian").text();
					
					$('#peringatan').hide();
					
					$.post( "../apps/admin_getway_apotik_status_obat.php", {"next_current": next_current,"next_repeat": next_repeat,"nomor_loket": nomor_loket}, function( data ) {
						if(data['peringatan'] == 1){
							$('#peringatan').show();
						}
						$(".next").html(data['next']);
					},"json");
				});

				$(".goHome").click(function(){
					//window.location = "../dashboard/dashboard.php?jenis=apotik";  
					showDiv(1);
				});
				
				setInterval(function() {
					$.post("../apps/monitoring-data-apotik.php", function( data ){
						
						$("#init_max_queque").html('Antrian teratas ' + data["init_max_queque"] +' dari ' + data["init_count_queque"]);						
					

					}, "json"); 
				}, 1000);

			});


			function showDiv(gIdL)
		    {
		        document.getElementById('welcomeDiv2Cri').style.display = "block";
		        $(document).ready(function()
		        {
		            $("#welcomeDiv1Cri").load('list_pasien_top.php?IdL='+gIdL);
		        });
		        
		        $(document).ready(function()
		        {
		            $("#welcomeDiv2Cri").load('list_pasien_status_mid.php?IdL='+gIdL);
		        });
		        
		        if (document.getElementById('welcomeMstCri').style.display == "block")
		        {
		            document.getElementById('welcomeMstCri').style.display = "none";
		        }
		        else
		        {
		            document.getElementById('welcomeMstCri').style.display = "block";
		        }
		    }

		    function gClose()
			{
				document.getElementById('welcomeMstCri').style.display = "none";
			}

			function gPasien(name,number,idt)
			{
				//alert(name);
				$('.nama_loket').html(name);
				$('.nomor_antrian').html(number);
				$('.nomor_loket').html(number);
				$('.next').html(number);
				$('.idt').html(idt);

				gClose();
			}

			function updateDataAntrean(kodebooking,taskid) {
				jQuery.post('../client/bridging_proses.php',{
					kodeBooking:kodebooking,
					taskid:taskid,
					reqdata:'updateWaktuAntrian'
					// reqdata:'ref_poli'
				},function(data){
					swal("Peringatan", "Selesai Pembuatan Obat");
					//alert(data);
					//goBack();
					//var response =  eval("(" + data + ")");				
				
				});	
			}

			function farmasiAdd(kodebooking,jenisresep,nomor_antrian) {
				jQuery.post('../client/bridging_proses.php',{
					kodeBooking:kodebooking,
					jenisresep:jenisresep,
					nomorantrean:nomor_antrian,
					reqdata:'farmasiAdd'
				},function(data){
					//alert(data);
									
				
				});	
			}
	</script>
</html>


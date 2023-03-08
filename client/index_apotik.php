<?php 
    session_start();
	include "constant.php";
   
	
	$Banner = " Antrian Apotik RSJ Kalawa Atei";

?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
	    <title>ANTRIAN <?php echo $CLIENTNAME;?></title>
		
	    <link href="../assert/css/bootstrap.min.css" rel="stylesheet">
	    <link href="../assert/css/jumbotron-narrow-monitoring.css" rel="stylesheet">
	
		
		
	</head>
	<style>
		.jumbotron{
			background-color:#000000;
			min-height: 700px
			
		}
		
		 #loading{
            width:50px;
            height: 50px;
            border: solid 5px #ccc;
            border-top-color: #FF6A00;
            border-radius: 100%;
            position: fixed;
            left:0;
            top:0;
            right:0;
            top:0;
            bottom: 0;
            margin:auto;

            animation: putar 2s linear infinite;            
        }

         @keyframes putar{
            from{transform: rotate(0deg)}
            to{transform:rotate(360deg)}
        } 
		
		body{
			padding:10px;
		}
		
		#no_urut{
			
			font-size: 18em;	
			color:#FFFFFF		
		}
	
	</style>
  	<body>
    <div class="container">
		<div class="row ">	
			<div class="col-md-2">
			
			</div>
			
			<div class="col-md-6 text-center">
			
				               				
				<div class="jumbotron text-center">	
					<font color="#FFF">
						<h2 class="counter">
                        <marquee><?php echo $Banner;?></marquee>			
						</h2>
						<div id="loading"></div>
					</font>	
                   
                    <br />	 <br />	 <br />	 <br />	 

					<div id="no_urut">0</div>	

					<p>
						<!-- <a class="btn btn-lg btn-success next_queue" href="#" role="button">
                            Ambil Antrian &nbsp;
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a> -->

                        <a class="goNext btn-lg btn-success" href="#" role="button">
                            Ambil Antrian &nbsp;
                            <span class="glyphicon glyphicon-chevron-right"></span>
                        </a>
					</p>
				</div>
				
				
			</div>
			<div class="col-md-4">
				<form>

				</form>
				<footer class="footer">
				
				</footer>
			</div>
		</div>
    </div>
	
  	</body>	
	
	<script src="../assert/js/jquery.min.js"></script>	
	
  	<script type="text/javascript">
       
        
        $("document").ready(function()
        {
            $('#loading').hide();		
            $('.next_queue').show();           
            $(".peringatan").hide();

			//var uri_stage = "<?php echo $url_api;?>last_stage_apotik.php";		
			var uri_stage = "../apps/last_stage_apotik.php";	

			// var uri       = "<?php echo $url_api;?>daemon_serve_client_apotik.php";
			
			// var uri_cetak_tiket = "../apps/daemon_cetak_tiket_apotik.php";
			
            // GET LAST COUNTER
            //var data = {"loket": <?php //echo $_SESSION["loket_client"];?>};
			var data = {"loket": 0};


            $.ajax({
                type: "POST",
                dataType: "json",
                url: uri_stage,//request
                data: data,
                success: function(data) {
                    $(".jumbotron h1").html(data["next"]);
                    $("#no_urut").html(data["next"]);
                    
                }
            });

               
            // GET NEXT COUNTER
            $(".next_queue").click(function()
            {            
                loading.style.display = "block";  
                
                $('.btn').html('Proses..');
                $('.goNext').html('Menu Utama <span class="glyphicon glyphicon-home"></span> ');
                $('.jumbotron h1').slideUp('slow');
                
                             
				var nomor_rm = '';
				var loket    = '1';
                var data = {"loket" : loket,"nomor_rm": nomor_rm};                
                $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: uri,
                        data: data,					
                        success: function(data) {				
							
                            //$('.jumbotron h1').fadeIn('slow');
                            $('.btn').html('BERIKUTNYA <span class="glyphicon glyphicon-chevron-right"></span>');
                            $('.goNext').html('Menu Utama <span class="glyphicon glyphicon-home"></span> ');
                            
                            loading.style.display = "none";                          
                            $('#loading').hide();
                            $(".jumbotron h1").html(data["next"]);
                            $("#no_urut").html(data["next"]);
                            if (data["idle"]=="TRUE") {
                                
                            }
							
														
							//Cetak Tiket
							$.post( uri_cetak_tiket, {
								//alert data['nomor_antrian'];
								"nomor_antrian" : data['nomor_antrian'],
								"nama_loket": data['nama_loket'],	
								"nomor_rm": data['nomor_rm'],
								"CrSaveData": ''								
							} , function( data ) {												
								
							},"json");
                        }
                });
                return false;
                                
            });
                                 
            $(".goNext").click(function(){
                window.location = "index_apotik2.php";  
            });
            
        });
	</script>
</html>


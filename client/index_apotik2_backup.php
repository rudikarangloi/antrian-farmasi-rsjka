<?php
ini_set('allow_url_fopen', 'On');
include('header.php'); 
include "constant.php";

//extract($_POST);



?>






<div id="main-container">
	<div id="main-content" class="main-content container">
		<div class="well well-nice form-dark">				


			<table border="0" width="100%">
					

					<tr>
						<td width="1%">&nbsp;</td>
						<td width="92%" colspan="7">

						<form name = "myfrm" id="myfrm" class="form-tied margin-00" action="form_input_data_mysql_.php" method="post">																		
							
							
							<table border="0" width="100%">
								<tr>
									<table border="0" width="100%">
											<tr>
												<td colspan="4">Nama Pasien :</td>
											</tr>
											<tr>
												<td colspan="4">
												<table border="0" width="100%">
													<tr>
														<td width="281" valign="top">
														<table border="0" width="100%">	
														
<?php
$api_url = $url_api.'get_count_tb_tr_kunjungan.php';	
/*
$json_data = file_get_contents($api_url);
$response_data = json_decode($json_data);
$count = $response_data->data;
*/
//-----
$arrContextOptions=array(
      "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );  

$json_data = file_get_contents($api_url, false, stream_context_create($arrContextOptions));
$response_data = json_decode($json_data);
$count = $response_data->data;
//print_r($response_data);

//-----
echo $api_url.'<p>'.$count .'<p>';
//exit;
if($count > 3){
	$dLimit = $count/4;
	$sisaLimit = $count % 4 ;
	if($count % 4 == 0){
		//echo 'Genap<p>';
		$untilTerakhir = $dLimit ;
	}else{
		//echo 'Ganjil<p>';
		$dLimit = (int)$dLimit;
		$untilTerakhir = $dLimit + $sisaLimit;
	}

	//echo $untilTerakhir .'<p>';
	$limit1 = 0;
	$limit2 = $dLimit*1;
	$limit3 = $dLimit*2;
	$limit4 = $dLimit*3;

	$until1 = $limit1 + $dLimit;
	$until2 = $limit2 + $dLimit;
	$until3 = $limit3 + $dLimit;
	$until4 = $limit4 + $dLimit;
}else{
	$limit1 = 0;
	$dLimit = $count;
}
/*
echo $limit1 . ' : ' .$dLimit.'<br>';
echo $limit2 . ' : ' .$until2.'<br>';
echo $limit3 . ' : ' .$until3.'<br>';
echo $limit4 . ' : ' .$until4.'<br>';
exit;
*/





														$api_url = $url_api.'get_tb_tr_kunjungan.php?limit='.$limit1.'&until='.$dLimit;	
														//echo $api_url;
														$json_data = file_get_contents($api_url);
														$response_data = json_decode($json_data);
														$jaminan = $response_data->data;
														//var_dump($jaminan);
														$loket = 1;
														foreach ($jaminan as $row) {				
															$gKd = $row->kode;
															$gNm = $row->nama;										
														?>														
														<tr>
																<td colspan="2">										
																	<input id="fLaYK<?php echo $gKd;?>" type="radio" name="fLaYK" 	class='rg' value="<?php echo $gKd.'****'.$gNm;?>">					
																	<label for="fLaYK<?php echo $gKd;?>"><span><span></span></span><?php echo $gNm;?></label>						
																</td>								
															</tr>
														
														<?php
															
															$loket++;
														}													
																													
														?>
													
																										
														
														
														
													</table>
													</td>

													<?php 
														if($count > 3){
													?>
													<td width="4">&nbsp;</td>
													<td valign="top">
														<table border="0" width="100%">
															<?php														
															$api_url = $url_api.'get_tb_tr_kunjungan.php?limit='.$limit2.'&until='.$dLimit;															
															$json_data = file_get_contents($api_url);
															$response_data = json_decode($json_data);
															$jaminan = $response_data->data;
															//var_dump($jaminan);
															$loket = 1;
															foreach ($jaminan as $row) {
					
																$gKd = $row->kode;
																$gNm = $row->nama;															
																
															?>
															
															<tr>
																	<td colspan="2">																							
																		<input id="fLaYK<?php echo $gKd;?>" type="radio" name="fLaYK" class='rg' value="<?php echo $gKd.'****'.$gNm;?>">																	
																		<label for="fLaYK<?php echo $gKd;?>"><span><span></span></span><?php echo $gNm;?></label>																		
																	</td>								
																</tr>
															
															<?php
																
																$loket++;
															}													
																										
																														
															?>
														
														</table>
													</td>




													<td width="4">&nbsp;</td>
													<td valign="top">
														<table border="0" width="100%">
															<?php														
															$api_url = $url_api.'get_tb_tr_kunjungan.php?limit='.$limit3.'&until='.$dLimit;															
															$json_data = file_get_contents($api_url);
															$response_data = json_decode($json_data);
															$jaminan = $response_data->data;
															//var_dump($jaminan);
															$loket = 1;
															foreach ($jaminan as $row) {
					
																$gKd = $row->kode;
																$gNm = $row->nama;															
																
															?>
															
															<tr>
																	<td colspan="2">																							
																		<input id="fLaYK<?php echo $gKd;?>" type="radio" name="fLaYK" class='rg' value="<?php echo $gKd.'****'.$gNm;?>">																	
																		<label for="fLaYK<?php echo $gKd;?>"><span><span></span></span><?php echo $gNm;?></label>																		
																	</td>								
																</tr>
															
															<?php
																
																$loket++;
															}													
																										
																														
															?>
														
														</table>
													</td>




													<td width="4">&nbsp;</td>
													<td valign="top">
														<table border="0" width="100%">
															<?php														
											$api_url = $url_api.'get_tb_tr_kunjungan.php?limit='.$limit4.'&until='.$untilTerakhir;		
											//echo $api_url;													
															$json_data = file_get_contents($api_url);
															$response_data = json_decode($json_data);
															$jaminan = $response_data->data;
															//var_dump($jaminan);
															$loket = 1;
															foreach ($jaminan as $row) {
					
																$gKd = $row->kode;
																$gNm = $row->nama;															
																
															?>
															
															<tr>
																	<td colspan="2">																							
																		<input id="fLaYK<?php echo $gKd;?>" type="radio" name="fLaYK" class='rg' value="<?php echo $gKd.'****'.$gNm;?>">																	
																		<label for="fLaYK<?php echo $gKd;?>"><span><span></span></span><?php echo $gNm;?></label>																		
																	</td>								
																</tr>
															
															<?php
																
																$loket++;
															}													
																										
																														
															?>
														
														</table>
													</td>

													<?php
												}
												?>





												</tr>
												<tr>
													<td width="281">&nbsp;<input type="hidden" id="hidden_loket" name="hidden_loket" val=""></td>
													<td width="9">&nbsp;</td>
													<td>&nbsp;</td>
												</tr>
											</table>
											</td>
										</tr>
										
										<tr>
											<td width="41%">&nbsp;</td>
											<td width="9%">&nbsp;</td>
											<td width="29%">&nbsp;</td>
											<td width="18%">&nbsp;</td>
										</tr>
									</table>

									<div id="GloBMstCri" >
										<div id="GloBDiv1Cri" ></div>
										<div id="GloBDiv2Cri" ></div>
									</div>

								<div id='show-bpjs' style='display:none'>											
							
								&nbsp;</div>
									</td>
									<td width="37%">&nbsp;</td>
								</tr>
								<tr>
									<td width="1%">&nbsp;</td>
									<td width="92%" colspan="7" align="center">
										<!-- <button type="button" value="SAVE" name="fSave" id="fSave" class="btn btn-envato btn-block ">PROSES</button> -->

										<a class="btn btn-lg btn-success next_queue" href="#" role="button">
				                            Ambil Antrian &nbsp;
				                            <span class="glyphicon glyphicon-chevron-right"></span>
				                        </a><p><p>

										<button type="button" class="btn btn-envato btn-block " onclick="goBack()">BATAL</button>


										<div id="loading"></div>
									</td>
									<td width="37%">&nbsp;</td>
								</tr>



								<tr>
									<td colspan="3" align="center">
										<!--
										<button type="button" value="SAVE" name="fSave" id="fSave" class="btn btn-envato btn-block ">PROSES</button>
										<button type="button" class="btn btn-envato btn-block " onclick="goBack()">BATAL</button>
										-->							
									</td>
								</tr>			

							</table>
						</form>
						</td>
						<td width="1%">&nbsp;</td>
					</tr>

					<tr>
						<td width="1%">&nbsp;</td>
						<td width="13%">&nbsp;</td>
						<td width="1%">&nbsp;</td>
						<td width="30%">&nbsp;</td>
						<td width="1%">&nbsp;</td>
						<td width="20%">&nbsp;</td>
					</tr>

			</table>

		</div>			
	</div>
	
	
</div>




<script type="text/javascript">

		function goBack() {
			window.history.back();
		}

		$(".rg").change(function () {	

			var myRadio = $("input[name=fLaYK]");

			//get Index
			var checkedValue = myRadio.index(myRadio.filter(':checked')) +1 ;       
			//get value
			var namapasien = myRadio.filter(":checked").val();
			
			$('#hidden_loket').val(namapasien);
			//console.log(' YA ...');
			//console.log($('#hidden_loket').val());
			
		});
       
        
        $("document").ready(function()
        {
            $('#loading').hide();		
            $('.next_queue').show();           
            $(".peringatan").hide();
			
			var uri_stage = "<?php echo $url_api;?>last_stage_apotik.php";			            
			var uri       = "<?php echo $url_api;?>daemon_serve_client_apotik.php";
			
			var uri_cetak_tiket = "../apps/daemon_cetak_tiket_apotik.php";
			
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
                //$('.goHome').html('Menu Utama <span class="glyphicon glyphicon-home"></span> ');
                //$('.jumbotron h1').slideUp('slow');
                
                             
				var nomor_rm = '';
				var loket    = '1';
				var nama_pasien = $("#hidden_loket").val(); 
                var data = {"loket" : loket,"nomor_rm": nomor_rm,"nama_pasien": nama_pasien};                
                $.ajax({
                        type: "POST",
                        dataType: "json",
                        url: uri,
                        data: data,					
                        success: function(data) {				
							
                            //$('.jumbotron h1').fadeIn('slow');
                            $('.btn').html('BERIKUTNYA <span class="glyphicon glyphicon-chevron-right"></span>');
                            $('.goHome').html('Menu Utama <span class="glyphicon glyphicon-home"></span> ');
                            
                            loading.style.display = "none";                          
                            $('#loading').hide();
                            $(".jumbotron h1").html(data["next"]);
                            $("#no_urut").html(data["next"]);
                            if (data["idle"]=="TRUE") {
                                
                            }
							
							goBack()
														
							//Cetak Tiket
							/*
							$.post( uri_cetak_tiket, {
								//alert data['nomor_antrian'];
								"nomor_antrian" : data['nomor_antrian'],
								"nama_loket": data['nama_loket'],	
								"nomor_rm": data['nomor_rm'],
								"CrSaveData": ''								
							} , function( data ) {												
								
							},"json");


							*/
                        }
                });
                return false;
                                
            });
                                 
            $(".goHome").click(function(){
                window.location = "index_apotik2.php";  
            });
            
        });
	</script>

<?php 
//include "keyboardVirtual.php";
include "footer.php"; 
?>

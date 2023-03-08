<!DOCTYPE html>
<html>
    <?php 
	include('../head_css.php'); 
	include('../constant.php');
	
	?>
    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php 
        ob_start();
        include "../apps/mysql_connect.php";
		
        ?>
        <?php include('../header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">
                                        <!--
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addRmModal"><i class="fa fa-plus" aria-hidden="true"></i> Add</button>  

                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button> 
										-->
                                
                                    </div>                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                <form id="rm-form" method="post">

                                    <?php   
                                            
                                                $dateSearch = date('d-m-Y'); 
                                                if(isset($_POST["dateSearch"])){
                                                    $dateSearch = $_POST["dateSearch"];                                                 
                                                }
                                            
                                    ?>

                                    <div class="row">
                                                <div class="col-sm-1">&nbsp;&nbsp;Tanggal</div>
                                                <div class="col-sm-5">
                                                    <input type="text" name="dateSearch" value="<?php echo $dateSearch?>" />
                                                    <a class="btn btn-primary" onclick="document.getElementById('rm-form').submit();">Cari</a>
                                                </div>
                                                  <div class="col-sm-4">
                                                    
                                                  </div>
                                                  <div class="col-sm-2"></div>
                                    </div>  
                                    <script type="text/javascript">
                                            $(function() {
                                                $('input[name="dateSearch"]').daterangepicker({
                                                     locale: {
                                                          format: 'DD-MM-YYYY'
                                                        },
                                                    singleDatePicker: true,
                                                    showDropdowns: true
                                                }, 
                                                function(start, end, label) {
                                                    var years = moment().diff(start, 'years');
                                                    //alert("You are " + years + " years old.");
                                                });
                                            });
                                    </script>
                                            
                                            <p>

                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width: 20px !important;">
													<input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" />
												</th>
                                                <th>No.RM</th>
                                                <th>Nama</th>
                                                <th>Ambil antrian</th>
												<th>Terlayani</th>
																																
                                                <th style="width: 75px !important;">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $chek_rm_aktif = '';
											$chek_rm_non_aktif = '';
											$chek_poli_aktif = '';
											$chek_poli_non_aktif = '';

                                            $explodedateSearch = explode("-", $dateSearch);
                                            $tanggaldb = $explodedateSearch[2].'-'.$explodedateSearch[1].'-'.$explodedateSearch[0];

                                            $sqlAdd = " AND waktu LIKE '$tanggaldb%' ";

                                            $sql = "select * from data_antrian_apotik WHERE  1 ". $sqlAdd;
                                            //echo  $sql;

											$squery = $mysqli->query($sql); 
											while($row = mysqli_fetch_array($squery))
                                            {
												
												$icon_rm = '<img src="sudah.png"  width="35" height="25">';
												$icon_poli = '<img src="sudah.png"  width="35" height="25">';
                                                echo '
                                                <tr>
                                                    <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td>
                                                    <td>'.$row['norm'].'</td>
                                                    <td>'.$row['nama'].'</td>
                                                    <td>'.$row['waktu'].'</td>	
													<td>'.$row['waktu_terlayani'].'</td>	
													
                                                    <td>
														<button class="btn btn-primary btn-sm" 
                                                            data-target="#editModal'.$row['id'].'" 
                                                            data-toggle="modal">
														    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                        </button>
														<!--
														<button class="btn btn-primary btn-sm"  onClick="P_PrintRIWA('.$row['norm'].','.$row['norm'].')" data-toggle="modal">
														<i class="fa fa-pencil-square" aria-hidden="true"></i> </button>	
														-->											
													</td>
                                                </tr>
                                                ';
                                                
                                                include "editModal.php";
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php include "../deleteModal.php"; ?>

                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

            <?php include "../notification.php"; ?>

            <?php include "../addModal.php"; ?>

            <?php include "../addfunction.php"; ?>
            <?php include "editfunction.php"; ?>
            <?php include "deletefunction.php"; ?>


                    </div>   <!-- /.row -->
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
        <!-- jQuery 2.0.2 -->
        <?php include "../footer.php"; ?>
		
<script type="text/javascript">

    $('input[name="daterange"]').daterangepicker();

	function P_PrintRIWA(NoRM,IdL)
	{
		if (NoRM==''){
			NoRM = $("#fNoRM").val();
			NoRM = NoRM.replace('.','');
			NoRM = NoRM.replace('-','');
		}
		if (NoRM==''){
			alert('Error code..!!'); return false;
		}
		
		//var NoRG = objfrm.fNoRG.value;
		var NoRG = NoRM;
		
		var LeftPosition=(screen.width)?(screen.width-800)/2:100;
		var TopPosition=(screen.height)?(screen.height-400)/2:100;
		
		IdL = '12';
	   
		URL = 'http://localhost:8090/SimRSSI/report/dok-nota_riwayat_pdf.php?NoRG='+NoRG+'&NoRM='+NoRM+'&IdL='+IdL;
		
		window.open(URL,'WinRIWA','toolbar=no,menubar=yes, top='+TopPosition+',left='+LeftPosition+' location=no, scrollbars=yes, resizable, width=800, height='+400);
		
		
	}
    $(function() {
        $("#table").dataTable({
           "aoColumnDefs": [ { "bSortable": false, "aTargets": [ 0,4 ] } ],"aaSorting": []
        });
    });
</script>
    </body>
</html>
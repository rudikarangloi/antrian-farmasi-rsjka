<?php

	echo '
	<aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        
                        <div class="pull-left info">
                            <h4>Hello, ';

                                //if($_SESSION['role'] == "Administrator"){                                  
                                    $user = $mysqli->query("SELECT * from tbladmin where id = '".$_SESSION['userid']."' "); 
                                    while($row = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $row['accounttype'];
                                        echo $row['accounttype'];
                                    }
                                //}
                                
                                echo '
                            </h4>

                        </div>
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">';
                        if($_SESSION['role'] == "Administrator"){
                            
                                                                
								
								 // <br>
         //                            <a href="../dashboard/dashboard.php?jenis=apotik">
         //                                <i class="fa  fa-dashboard"></i> <span>Admin Apotik</span>
         //                            </a>                               
                               
         //                        <P><P>
         //                            <a href="../apotik/admin_panggilan_general_apotik.php" target="_blank">
         //                                <i class="fa  fa-dashboard"></i> <span>Pemanggil Antrian Apotik</span>
         //                            </a>
                               
								echo '<br>

                                <a href="../client/index_apotik.php" target="_blank">
                                        <i class="fa  fa-dashboard"></i> <span>Mencetak No. Antrian</span>
                                    </a>
                               
                                <br>

                                <a href="../apotik/index_obat.php?nomor_loket=1" target="_blank">
                                        <i class="fa  fa-dashboard"></i> <span>Membuat Obat Pasien</span>
                                    </a>
                               
                                <br>

                                <a href="../apotik/index.php?nomor_loket=1" target="_blank">
                                        <i class="fa  fa-dashboard"></i> <span>Memanggil No. Antrian Pasien</span>
                                    </a>
                               
                                <br>

                                
                                <a href="../apotik/admin_panggilan_general_apotik.php" target="_blank">
                                        <i class="fa  fa-dashboard"></i> <span>Pemanggil No. Antrian Pasien</span>
                                    </a>
                               
                                <br>

                                 <a href="../rekam_medis/index.php">
                                        <i class="fa  fa-dashboard"></i> <span>Daftar Antrian Pasien</span>
                                    </a>
                               
                                <br>


                                    <hr />
                               
                                					
							';							
                        }
						
						if($_SESSION['role'] == "Apotik"){
                            echo '
                                
                                <li>                                   
                                    <a href="../dashboard/dashboard.php?jenis=apotik">
                                        <i class="fa  fa-dashboard"></i> <span>Admin Apotik</span>
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="../apotik/admin_panggilan_general_apotik.php" target="_blank">
                                        <i class="fa  fa-dashboard"></i> <span>Pemanggil Antrian Apotik</span>
                                    </a>
                                </li>                              

				
							';							
                        }

                        if($_SESSION['role'] == "User"){
                            echo '
                                <li>
                                    <a href="../dashboard/dashboard.php">
                                        <i class="fa  fa-dashboard"></i> <span>Dashboard</span>
                                    </a>
                                </li>
                                
                                                  
                            
                               						
							';							
                        }
						
						if($_SESSION['role'] == "Master"){
                            echo '
                                
								<li>
                                    <a href="../retrieve/index.php">
                                        <i class="fa  fa-dashboard"></i> <span>Retrieve Antiran</span>
                                    </a>
                                </li>
								
								<li>
                                    <a href="../retrieve_apotik/index.php">
                                        <i class="fa  fa-dashboard"></i> <span>Retrieve Antiran Apotik</span>
                                    </a>
                                </li>
                                
                                                  
                            
                               						
							';							
                        }
                        
                        echo'
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
	';
?>
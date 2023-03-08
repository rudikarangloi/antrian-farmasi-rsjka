
<!-- ========= CLASS MODAL ======== -->
<?php 
// if($row['aproove_rm'] == '1'){
// 	$chek_rm_aktif = 'selected';
// 	$chek_rm_non_aktif = '';
// }else{	
// 	$chek_rm_aktif = '';
// 	$chek_rm_non_aktif = 'selected';
// }
// if($row['approve_poli'] == '1'){
// 	$chek_poli_aktif = 'selected';
// 	$chek_poli_non_aktif = '';
// }else{	
// 	$chek_poli_aktif = '';
// 	$chek_poli_non_aktif = 'selected';
// }

$chek_rm_aktif = 'selected';
    $chek_rm_non_aktif = '';    
$chek_poli_aktif = '';
    $chek_poli_non_aktif = 'selected';
echo '<div id="editModal'.$row['id'].'" class="modal fade">
<form method="post">
  <div class="modal-dialog modal-sm" style="width:300px !important;">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Data Pasien</h4>
        </div>
        <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <input type="hidden" value="'.$row['id'].'" name="hidden_id" id="hidden_id"/>
                <div class="form-group">
                    <label>Nomor RM </label>
                    <input name="txt_nomor" readonly id="txt_nomor" class="form-control input-sm" type="text" value="'.$row['norm'].'" />
                </div>
                <div class="form-group">
                    <label>Nama</label>
                    <input name="txt_nama" readonly id="txt_nama" class="form-control input-sm" type="text" value="'.$row['nama'].'" />
                </div>
				
				
                <div class="form-group">
                    <label>Waktu ambil antrian</label>
                     <input name="txt_kelamin" id="txt_kelamin" class="form-control input-sm" type="text" value="'.$row['waktu'].'" />
                </div>	
				
				 <div class="form-group">
                    <label>Waktu Di layani</label>
                     <input name="kdpoli" id="kdpoli" class="form-control input-sm" type="text" value="'.$row['waktu_terlayani'].'" />
                </div>	

                <div class="form-group">
                    <label>Lama Antrian</label>
                     <input name="kdpoli" id="kdpoli" class="form-control input-sm" type="text" value="'.$row['terlayani'].'" />
                </div>  
								
				
				
        </div>
        </div>
        <div class="modal-footer">
		<!--
            <input type="button" class="btn btn-default btn-sm" data-dismiss="modal" value="Cancel"/>
            <input type="submit" class="btn btn-primary btn-sm" name="btn_save" value="Save"/>
		-->
        </div>
    </div>
  </div>
</form>
</div>';?>
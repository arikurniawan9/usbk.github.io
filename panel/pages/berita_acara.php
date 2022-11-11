<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	?>



 <?php $tgljam = date("Y/m/d H:i");  
 $tgl = date("Y/m/d"); 
 ?>
  <link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>

<script src="../../assets/jquery-1.12.4.js"></script>
    <script src="../../assets/jquery.dataTables.min.js"></script>
    <!-- jQuery -->
    

    <!-- Metis Menu Plugin JavaScript -->
	 <script>
	   $(document).ready(function() {
		$('#example').DataTable( {
			"scrollY": 200,
			"scrollX": true
		} );
	} );
   </script>
   <style type="text/css">
.custom-date-style {
	background-color: red !important;
}

.input{	
}
.input-wide{
	width: 500px;
}

</style>
<?php 
$tgx = 29;
$blx =  9;
$thx = 2016;

$tglx = date("Y/m/d");
$jamx = date("H:i:s");
?>
<body>
            <div class="row">
                <div class="col-md-12">
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                       Daftar Pelaksanaan Test
                                    </div>
								</div>
            
							<div class="portlet-body">
                        		 <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
	                                    <th width="2%">No</th>
										<th width="5%">Ujian</th>                                        
                                        <th width="8%">Kode Soal</th>
                                        <th width="12%">Mata Pelajaran</th>
                                        <th width="4%">Kelas</th>	
                                        <th width="4%">Token</th>	
                                        <th width="5%">Waktu</th>
                                        <th width="3%">Durasi</th>  
                                        <th width="5%">Proktor - Pengawas</th>
                                        <th width="10%">Catatan</th>
                                        <th width="5%">Edit Pengawas | Print</th>                                        
                                 </tr>
                                </thead>
                                <tbody>
<?php 
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select u.*,m.*,u.Urut as Urutan,u.XKodeKelas as kokel from cbt_ujian u left join cbt_mapel m on m.XKodeMapel = u.XKodeMapel 
left join cbt_paketsoal p on p.XKodeSoal = u.XKodeSoal where u.XStatusUjian='9'");
								while($s = mysqli_fetch_array($sql)){ 
					$sqlsoal  = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_soal where XKodeSoal = '$s[XKodeSoal]'"));
					$sqlpakai = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa_ujian where XKodeSoal = '$s[XKodeSoal]' and XStatusUjian = '1'"));
					$sqlsudah = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_jawaban where XKodeSoal = '$s[XKodeSoal]'"));
					if($sqlsoal<1){$kata="disabled";}  else {$kata="";}	
					if($sqlsudah>0||$sqlpakai>0){$kata="disabled";}  else {$kata="";}			
					if($sqlpakai>0){$katapakai="disabled";}  else {$katapakai="";}
					
$time1 = "$s[XJamUjian]";
$time2 = "$s[XLamaUjian]";

$secs = strtotime($time2)-strtotime("00:00:00");
$jamhabis = date("H:i:s",strtotime($time1)+$secs);	
$sekarang = date("H:i:s");	
$tglsekarang = date("Y-m-d");	
$tglujian = "$s[XTglUjian]";	
		
								?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="jquery-1.4.js"></script>
                                
<script>    
$(document).ready(function(){
	$("#awas<?php echo $s['XTokenUjian']; ?>").click(function(){
	alert();
	//alert("<?php echo $s['Urutan']; ?>");
	 var txt_tokenx = $("#txt_tokenx<?php echo "$s[XTokenUjian]"; ?>").val();
	 var txt_proktorx = $("#txt_proktorx<?php echo "$s[XTokenUjian]"; ?>").val();
	 var txt_nipproktorx = $("#txt_nipproktorx<?php echo "$s[XTokenUjian]"; ?>").val();
	 var txt_pengawasx = $("#txt_pengawasx<?php echo "$s[XTokenUjian]"; ?>").val();
	 var txt_nip_pengawasx = $("#txt_nip_pengawasx<?php echo "$s[XTokenUjian]"; ?>").val();
	 var txt_catatanx = $("#txt_catatanx<?php echo "$s[XTokenUjian]"; ?>").val();
	
	  
	//alert(txt_ujianx);  
	  
	 $.ajax({
		 type:"POST",
		 url:"ubahpengawas.php",    
		 data: "aksi=simpan&txt_tokenx=" + txt_tokenx + "&txt_proktor=" + txt_proktorx + "&txt_nipproktor=" + txt_nipproktorx + "&txt_pengawas=" + txt_pengawasx + "&txt_nippengawas=" + txt_nip_pengawasx + "&txt_catatan=" + txt_catatanx,
		 success: function(data){
			  document.location.reload();
			  loading.fadeOut();
			  tampilkan.html(data);
			  tampilkan.fadeIn(100);
			  tampildata();
			}
		 });
	});
}
);
</script>                               
<tr class="odd gradeX">
	<td align="center">	<input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"><?php echo $s['Urutan']; ?>
		<input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_ujian<?php echo $s['Urutan']; ?>">
    </td>
    <td align="center"><?php echo $s['XKodeUjian']; ?></td>
    <td align="center"><?php echo $s['XKodeSoal']; ?></td>
    <td align="center"><?php echo $s['XNamaMapel']; ?></td>
    <td align="center"><?php echo $s['kokel']." - ".$s['XKodeJurusan']."."; ?></td> 
    <td align="center"><?php echo $s['XTokenUjian']; ?></td>
    <td align="center"><?php echo $s['XTglUjian']." ".$s['XJamUjian'] ; ?></td>                                        
	<td align="center"><?php echo $s['XLamaUjian']; ?></td>
	<td align="center"><?php echo $s['XProktor']." - ".$s['XPengawas']; ?></td>
	<td align="center"><?php echo $s['XCatatan']; ?></td>
	<td align="center">
		<button type="button" class="btn btn-warning btn-sm"  
				data-toggle="modal" data-target="#myPengawas<?php echo $s['XTokenUjian']; ?>"><i class="fa fa-edit"></i>
		</button>
		<a href="?modul=cetak_berita&token=<?php echo $s['XTokenUjian']; ?>"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-print"></i></button></a>
	</td>     
</tr>
  <!-- Button trigger modal -->
  <!-- Modal -->
    <div class="modal fade" id="myPengawas<?php echo $s['XTokenUjian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					
                        <h4 class="modal-title" id="myModalLabel"><?php echo "Pengawas Ujian Mapel : $s[XNamaMapel]"; ?></h4>
                </div>
                <div class="modal-body" >
					<input type="hidden" value="<?php echo $s['XTokenUjian']; ?>" id="txt_tokenx<?php echo $s['XTokenUjian']; ?>">
					<div class="form-group">
					<label>Nama Proktor</label>
					<input type="text" class="form-control" id="txt_proktorx<?php echo $s['XTokenUjian']; ?>">
					</div>
					<div class="form-group">
					<label>NIP Proktor</label>
					<input type="text" class="form-control" id="txt_nipproktorx<?php echo $s['XTokenUjian']; ?>">
					</div>
					<div class="form-group">
					<label>Nama Pengawas</label>
					<input type="text" class="form-control" id="txt_pengawasx<?php echo $s['XTokenUjian']; ?>">
					</div>
					<div class="form-group">
					<label>NIP Pengawas</label>
					<input type="text" class="form-control" id="txt_nip_pengawasx<?php echo $s['XTokenUjian']; ?>">
					</div>
					<div class="form-group">
					<label>Catatan</label><br>
					<textarea id="txt_catatanx<?php echo $s['XTokenUjian']; ?>" cols="75" rows="5"></textarea>
					</div>
					
					
						
						<br>
				</div>
                <div class="modal-footer">
					
                    <input type="submit"  class="btn btn-info btn-sm" id="awas<?php echo $s['XTokenUjian']; ?>" value="Simpan">
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
				</div>                                        
			</div>
                <!-- /.modal-content -->
		</div>
				<!-- /.modal-dialog -->
	</div>
				<!-- /.modal --> 
<?php } ?>
                                   
                                </tbody>
                            </table>
                            
<!-- /.panel-heading -->
                                                   
                            <!-- /.table-responsive -->
                            
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
		</div>						
</div>
    
</body>
</html>

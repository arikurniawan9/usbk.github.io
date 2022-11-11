<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>


<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="jquery-1.4.js"></script>
<script>    
$(document).ready(function(){

	var loading = $("#loading");
	var tampilkan = $("#tampilkan1");
 	var idstu = $("#idstu").val();
	function tampildata(){
	tampilkan.hide();
	loading.fadeIn();
	
	$.ajax({
    type:"POST",
    url:"database_soal_tampil.php",  
	data:"aksi=tampil&idstu=" + idstu,  
	success: function(data){ 
		loading.fadeOut();
		tampilkan.html(data);
		tampilkan.fadeIn(100);
	   }
    }); 
	}// akhir fungsi tampildata
	tampildata();

});
</script>
<body>
<?php 
if(!empty($_REQUEST['datax'])&&$_REQUEST['datax']=="ujian"){include "../../database/cbt_ujian.php";}
if(!empty($_REQUEST['datax'])&&$_REQUEST['datax']=="siswa"){include "../../database/cbt_siswa.php";}
if(!empty($_REQUEST['datax'])&&$_REQUEST['datax']=="media"){include "../../database/cbt_media.php";}
if(!empty($_REQUEST['datax'])&&$_REQUEST['datax']=="semua"){include "../../database/cbt_semua.php";}
if(!empty($_REQUEST['datax'])&&$_REQUEST['datax']=="hasil"){include "../../database/cbt_hasil_ujian.php";}
?>
<?php include "../../config/server.php"; ?>
            
            <!-- /.row -->
            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
									Backup & Restore
                                    </div>
									<div class="actions">
									<a href='#myTam' id='custId' data-toggle='modal' data-id=''>
									<button type="button" class="btn btn-info btn-small" ><i class=""></i>&nbsp;Restore Database</button>
									</a>
									</div>
               
								</div>
            
					<div class="portlet-body">
					<div class="alert alert-info" >
                                Tombol &nbsp; <button type='button' class='btn btn-danger btn-sm'><i class='fa fa-times'></i> Delete</i></button> 
                                &nbsp; : selain menghapus, juga akan membackup database sesuai pilihan, yang bisa direstor lagi suatu satat dibutukan.  
                                <br>Lokasi file Backup anda, silahkan Lihat folder ==> C:/CBT-Backup/<?php echo $db_server;?>/
                            </div>                        		
                        
                        
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
	                                    <th width="10%">No.</th>
                                        <th width="60%">Jenis Data</th>
                                        <th width="15%">Backup Database</th>                                           
                                        <th width="15%">Hapus Database</th>    
                                                                                                                          
                                 </tr>
                                </thead>
                                <tbody>
                                                                
                                                                  
                                    <tr class="odd gradeX">
                                        <td align="center">1<input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"></td>
                                        <td><span style="color: #1B06CF;">Data Sistem : </span>Mapel, Kelas, Siswa </td>
                                        <td align="center"><a href="?modul=backup&datax=siswa&aksi=1">
                                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> BackUp </i></button></a></td>
                                        <td align="center"><a href="?modul=backup&datax=siswa&aksi=2">
                                        <button type='button' class='btn btn-danger btn-sm'><i class='fa fa-times'></i> Delete</i></button></a></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td align="center">2<input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"></td>
                                        <td><span style="color: #ff0000;">Semua Data Ujian : </span>Bank Soal, Data Hasil Ujian dan Media Pendukung</td>
                                        <td align="center"><a href="?modul=backup&datax=ujian&aksi=1">
                                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> BackUp </i></button></a></td>
                                        <td align="center"><a href="?modul=backup&datax=ujian&aksi=2">
                                        <button type='button' class='btn btn-danger btn-sm'><i class='fa fa-times'></i> Delete </i></button></a></td>
                                    </tr>
									<tr class="odd gradeX">
                                        <td align="center">3<input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"></td>
                                        <td><span style="color: #1B06CF;">Data Hasil Ujian : </span>Data Ujian (kecuali Bank Soal dan Nilai)</td>
                                        <td align="center"><a href="?modul=backup&datax=hasil&aksi=1">
                                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> BackUp </i></button></a></td>
                                        <td align="center"><a href="?modul=backup&datax=hasil&aksi=2">
                                        <button type='button' class='btn btn-danger btn-sm'><i class='fa fa-times'></i> Delete </i></button></a></td>
                                    </tr>
									<tr class="odd gradeX">
                                        <td align="center">4<input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"></td>
                                        <td><span style="color: #1B06CF;">Data Media Pendukung</span> (hanya data SQLnya, File media tidak terhapus)</td>
                                        <td align="center"><a href="?modul=backup&datax=media&aksi=1">
                                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> BackUp </i></button></a></td>
                                        <td align="center"><a href="?modul=backup&datax=media&aksi=2">
                                        <button type='button' class='btn btn-danger btn-sm'><i class='fa fa-times'></i> Delete </i></button></a></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td align="center">5<input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"></td>
                                        <td><span style="color: #ff0000;">Semua Database</span></td>
                                        <td align="center"><a href="?modul=backup&datax=semua&aksi=1">
                                        <button type="button" class="btn btn-success btn-sm"><i class="fa fa-edit"></i> BackUp  </i></button></a></td>
                                        <td align="center"><a href="?modul=backup&datax=semua&aksi=2">
                                        <button type='button' class='btn btn-danger btn-sm'><i class='fa fa-times'></i> Delete </i></button></a></td>
                                    </tr>
                                     
  <!-- Button trigger modal -->
  <!-- Modal -->
                            <div class="modal fade" id="myModal<?php echo $s['XNomerUjian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel"><?php echo "Peserta Ujian : $s[XNomerUjian]"; ?></h4>
                                        </div>
                                        <div class="modal-body" style="text-align:center">
                                        
                                               <?php 
												if(file_exists("../../fotosiswa/$s[XFoto]")&&!$gbr==''){ ?>
                                                <img src="../../fotosiswa/<?php echo $s['XFoto']; ?>" width="400px">
                                                <?php 
												} else {
												echo "<img src=../../fotosiswa/nouser.png>";
												}
												?>
                                       

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal --> 
                                           

                                  
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
							<div class="modal fade" id="myTam" role="dialog">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Restore Database</h4>
										</div>
									<div class="modal-body">
										<div class="well">
										<span style="color: #1B06CF;"><?php echo $skull; ?> - CBT</span><br>
										<form action="?modul=restore" method="post">
										   <table><tr><td><input type="file" class="btn btn-default" id="anu" name="anu"></td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
										   </td></tr></table>
											
										<div class="clearfix"></div>
										</div>	
										<div class="modal-footer">
										<button type="submit" class="btn green btn-small" ><i class="fa fa-plus-circle"></i> Restore Database</button>
										<button type="button" class="btn dark btn-outline" data-dismiss="modal" ><i class="fa fa-close-circle"></i> Batal</button>
										</div></form> 
										</div>
									</div>
							
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
 
 
           
    

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    
	
	
	});
    </script>
    <script>$(document).ready(function() {
    var table = $('#example').DataTable();
 
    $('#example tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            table.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );
 
    $('#button').click( function () {
        table.row('.selected').remove().draw( false );
    } );
} );</script>
    
 

    </div>
</body>


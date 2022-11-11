<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
include "../../config/server.php";
if(isset($_REQUEST['aksi'])){
//echo "delete from cbt_kelas where Urut = '$_REQUEST[urut]'";
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "delete from cbt_kelas where Urut = '$_REQUEST[urut]'");
}


if(isset($_REQUEST['simpan'])){
	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_kelas set XKodeLevel = '$_REQUEST[txt_kodlev]', XNamaKelas = '$_REQUEST[txt_namkel]', XKodeJurusan = '$_REQUEST[txt_jur]',
	XKodeKelas = '$_REQUEST[txt_kodkel]', XKodeSekolah = '$_REQUEST[txt_kodesek]'  where Urut = '$_REQUEST[id]'");
}

if(isset($_REQUEST['tambah'])){

$sqlcek = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas where XKodeKelas = '$_REQUEST[txt_kodkel]'"));
	if($sqlcek>0){
	$message = "Kode Kelas SUDAH ADA";
	echo "<script type='text/javascript'>alert('$message');</script>";
	} else {
		if(!$_REQUEST['txt_kodkel']==""||!$_REQUEST['txt_jurusan']==""){
		$sql = mysqli_query($GLOBALS["___mysqli_ston"], "insert into cbt_kelas (XKodeLevel, XNamaKelas, XKodeJurusan,XKodeKelas, XKodeSekolah) values  
		('$_REQUEST[txt_kodlev]','$_REQUEST[txt_namkel]','$_REQUEST[txt_jur]','$_REQUEST[txt_kodkel]','$_REQUEST[txt_kodesek]')");
		}
	}
}



?>
<!-- Bootstrap Core CSS -->
		<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        
        <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->

            <div class="row">
                <div class="col-md-12">
                            <div class="portlet ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Data Kelas
                                    </div>
									<div class="actions">
									<a href="?modul=upl_kelas">
										<button type="button" class="btn btn-info btn-small" style="margin-top:5px; margin-bottom:5px">
											<i class="fa fa-cloud-upload"></i>&nbsp; Upload Data Kelas</i>
										</button>
									</a>
									<a href="down_excel_kelas.php" target="_blank">
										<button type="button" class="btn btn-success" id="download"> <i class='fa fa-cloud-download  '></i>&nbsp; Rekap Excel Kelas</button>
									</a>
									<?php echo "<a href='#myTam' id='custId' data-toggle='modal' data-id=''>"; ?>
										<button type="button" class="btn btn-primary btn-small" ><i class="fa fa-plus-circle"></i>&nbsp; Tambah Kelas & <?php echo $rombel;?></button>	
									<?php echo "</a>";?> </td>
									</div>
								</div>
									
									
									

            
                        <!-- /.panel-heading -->
                        <div class="portlet-body">
                            <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
	                                    <th width="5%">Nomor</th>
										<th width="15%">Kode Sekolah</th>
                                        <th width="10%">Kode Level</th>
                                        <th width="10%">Kode Kelas</th>
										<th width="30%"><?php echo $rombel;?></th> 
										<th width="20%">Nama Kelas</th>										
                                                                               
                                        <th width="20%">Edit - Hapus</th>                                                                                                                      
                                 </tr>
                                </thead>
                                <tbody>
                                <?php 
								$no=0;
								$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas order by Urut");
								while($s = mysqli_fetch_array($sql)){ 
								$no++
								?>
                                
                                    <tr class="odd gradeX">
                                        <td align=""><?php echo $no; ?></td>
										<td align=""><?php echo $s['XKodeSekolah']; ?></td>
                                        <td align=""><?php echo $s['XKodeLevel']; ?></td>
                                        <td align=""><?php echo $s['XKodeKelas']; ?></td>
										<td align=""><?php echo $s['XKodeJurusan']; ?></td>
                                        <td align=""><?php echo $s['XNamaKelas']; ?></td>  
										<td align="center"><?php echo "
											<a href='#myModal' id='custId' data-toggle='modal' data-id=".$s['Urut'].">"; ?>
                                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                                            <a href="?modul=daftar_kelas&aksi=hapus&urut=<?php echo $s['Urut']; ?>"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button></a></td>                                                                               
                                    </tr>
 
 <script>
function myFunction<?php echo $s['Urut']; ?>() {
	alert(<?php echo $s['Urut']; ?>);
    document.getElementById("demo").innerHTML = "Hello World";
}
</script>
  <!-- Button trigger modal -->
                                    
                                        
                                <?php } ?>
                                   
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
       
       
       
</div>   
       
       <div class="modal fade" id="myTam" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah Data Kelas & <?php echo $rombel;?></h4>
                </div>
                <div class="modal-body">
        <!-- MEMBUAT FORM -->
        <form action="?modul=daftar_kelas&tambah=yes" method="post">
			<div class="form-group">
                <label>Kode Sekolah</label><br>
                <select class="form-control" name="txt_kodesek" id="txt_kodesek">
					<option value='ALL'>SEMUA (ALL)</option>
					<?php 
						$sqlsek = mysqli_query($GLOBALS["___mysqli_ston"], "select * from server_sekolah order by XServerId");
						while($sek = mysqli_fetch_array($sqlsek)){echo "<option value='$sek[XServerId]'>$sek[XServerId] $sek[XSekolah]</option>";}
					?>
				</select>
            </div><p>
             <div class="form-group">
                <label>Kode Kelas</label>
                <input type="text" class="form-control" name="txt_kodkel">
            </div>

            <div class="form-group">
                <label>Nama Kelas</label>
                <input type="text" class="form-control" name="txt_namkel">
            </div>
            <div class="form-group">
                <label>Kode Level</label>
                <input type="text" class="form-control" name="txt_kodlev">
            </div>
            <div class="form-group">
                <label><?php echo $rombel;?></label>
				<input type="text" class="form-control" name="txt_jur" >
				<!--<select class="form-control" name="txt_jur" id="txt_jur">
				<?php 
                                $sqlsek = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas order by Urut");
                                while($sek = mysqli_fetch_array($sqlsek)){
                                echo "<option value='$sek[XKodeJurusan]'>$sek[XKodeJurusan]</option>";
                                }
                                ?>
								</select>-->
								
            </div>

                <div class="modal-footer">
              <button class="btn green" type="submit">Tambah</button>
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Tutup</button>
                </div>
        </form>
                
                    <div class="fetched-data2"></div>
                </div>
            </div>
        </div>
    </div>    
           
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
    
<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Data Kelas</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
            </div>
        </div>
    </div>
  
  <!-- BEGIN CORE PLUGINS -->
        <script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
  
  
  <script src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'edit_kelas.php',
                data :  'urut='+ rowid,
                success : function(data){
                $('.fetched-data').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		 
		  $('#myTam').on('show.bs.modal', function (e) {
           // var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'tambah_kelas.php',
                data :  'urut='+ rowid,
                success : function(data){
                $('.fetched-data2').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		 
    });
  </script>
 

 
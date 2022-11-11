<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
include "../../config/server.php";
if(isset($_REQUEST['aksi'])){
//echo "delete from cbt_kelas where Urut = '$_REQUEST[urut]'";
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "delete from cbt_tes where Urut = '$_REQUEST[urut]'");
}


if(isset($_REQUEST['simpan'])){
	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_tes set XKodeUjian = '$_REQUEST[txt_kodlev]', XNamaUjian = '$_REQUEST[txt_namkel]' where Urut = '$_REQUEST[id]'");
}

if(isset($_REQUEST['tambah'])){

$sqlcek = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_tes where XKodeUjian = '$_REQUEST[txt_kodlev]'"));
	if($sqlcek>0){
	$message = "Kode Ujian SUDAH ADA";
	echo "<script type='text/javascript'>alert('$message');</script>";
	} else {
		if(!$_REQUEST['txt_kodlev']==""||!$_REQUEST['txt_namkel']==""){
		$sql = mysqli_query($GLOBALS["___mysqli_ston"], "insert into cbt_tes (XKodeUjian, XNamaUjian) values  
		('$_REQUEST[txt_kodlev]','$_REQUEST[txt_namkel]')");
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
                                        Data Jenis Tes
                                    </div>
									<div class="actions">
									
									
									<?php echo "<a href='#myTam' id='custId' data-toggle='modal' data-id=''>"; ?>
										<button type="button" class="btn btn-primary btn-small" ><i class="fa fa-plus-circle"></i>&nbsp; Tambah Jenis Tes</button>	
									<?php echo "</a>";?> </td>
									</div>
								</div>
									
									
									

            
                        <!-- /.panel-heading -->
                        <div class="portlet-body">
                            <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
	                                    <th width="5%">Nomor</th>
										<th width="15%">Kode</th>
                                        <th>Nama Ujian</th>								
                                                                               
                                        <th width="20%">Edit - Hapus</th>                                                                                                                      
                                 </tr>
                                </thead>
                                <tbody>
                                <?php 
								$no=0;
								$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_tes order by Urut");
								while($s = mysqli_fetch_array($sql)){ 
								$no++
								?>
                                
                                    <tr class="odd gradeX">
                                        <td align=""><?php echo $no; ?></td>
										<td align=""><?php echo $s['XKodeUjian']; ?></td>
                                        <td align=""><?php echo $s['XNamaUjian']; ?></td>  
										<td align="center"><?php echo "
											<a href='#myModal' id='custId' data-toggle='modal' data-id=".$s['Urut'].">"; ?>
                                            <button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                                            <a href="?modul=daftar_jenis_tes&aksi=hapus&urut=<?php echo $s['Urut']; ?>"><button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button></a></td>                                                                               
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
                    <h4 class="modal-title">Tambah Data Jenis Tes</h4>
                </div>
                <div class="modal-body">
        <!-- MEMBUAT FORM -->
        <form action="?modul=daftar_jenis_tes&tambah=yes" method="post">
			<p>
            <div class="form-group">
                <label>Kode Tes</label>
                <input type="text" class="form-control" name="txt_kodlev">
            </div>
            
            <div class="form-group">
                <label>Nama Tes</label>
                <input type="text" class="form-control" name="txt_namkel">
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
                    <h4 class="modal-title">Edit Jenis Tes</h4>
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
                url : 'edit_jenis_tes.php',
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
                url : 'tambah_jenis_tes.php',
                data :  'urut='+ rowid,
                success : function(data){
                $('.fetched-data2').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		 
    });
  </script>
 

 
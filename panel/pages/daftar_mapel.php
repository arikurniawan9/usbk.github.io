<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
include "../../config/server.php";
if(isset($_REQUEST['aksi'])){
//echo "delete from cbt_kelas where Urut = '$_REQUEST[urut]'";
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "delete from cbt_mapel where Urut = '$_REQUEST[urut]'");
}
if(isset($_REQUEST['simpan'])){

	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_mapel set XKodeMapel = '$_REQUEST[txt_kokel]', XNamaMapel = '$_REQUEST[txt_nakel]', XPersenUH = '$_REQUEST[txt_UH]',
	XPersenUTS = '$_REQUEST[txt_UTS]',XPersenUAS = '$_REQUEST[txt_UAS]',XKKM = '$_REQUEST[txt_KKM]',XMapelAgama='$_REQUEST[txt_mapelagama]',
	XKodeSekolah = '$_REQUEST[txt_kodesek]' where Urut = '$_REQUEST[id]'");

}
if(isset($_REQUEST['tambah'])){

$sqlcek = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel where XKodeMapel = '$_REQUEST[txt_kokel]'"));
	if($sqlcek>0){
	$message = "Kode Mapel SUDAH ADA";
	echo "<script type='text/javascript'>alert('$message');</script>";
	} else {
	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "insert into cbt_mapel (XKodeMapel, XNamaMapel, XPersenUH,
	XPersenUTS,XPersenUAS ,XKKM,XMapelAgama, XKodeSekolah) values ('$_REQUEST[txt_kokel]','$_REQUEST[txt_nakel]','$_REQUEST[txt_UH]','$_REQUEST[txt_UTS]','$_REQUEST[txt_UAS]','$_REQUEST[txt_KKM]','$_REQUEST[txt_mapelagama]','$_REQUEST[txt_kodesek]')");
	}
}

?>

	<!-- Bootstrap Core CSS -->
		<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        
        <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
		
<body>
            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Daftar Mata Pelajaran
                                    </div>
									<div class="actions">
									<a href="?modul=upl_mapel">
										<button type="button" class="btn btn-info btn-small" style="margin-top:5px; margin-bottom:5px">
											<i class="fa fa-cloud-upload"></i> Upload Data Mapel</i>
										</button>
									</a>
									
									<a href="down_excel_mapel.php" target="_blank">
										<button type="button" class="btn btn-success" id="download"> <i class='fa fa-cloud-download  '></i> Rekap Excel Mapel</button>
									</a>
									
									<?php echo "<a href='#myTam' id='custId' data-toggle='modal' data-id=''>"; ?>
										<button type="button" class="btn btn-primary  btn-small" ><i class="fa fa-plus-circle"></i> Tambah Mapel</button>				
									<?php echo "</a>";?>
									</div>
				
								</div>
                        <!-- /.panel-heading -->
                        <div class="portlet-body">
                            <table id="example" class="table table-striped table-bordered table-hover " cellspacing="0" width="100%">
                                <thead>
                                    <tr>
	                                    <th width="4%">No</th>
                                        <th width="15%">Kode Sekolah</th>
										<th width="5%">Kode Mapel</th>
                                        <th width="25%">Mata Pelajaran</th>
                                        <th width="5%">Harian (%)</th> 
                                        <th width="7%">UTS (%)</th>                                        
                                        <th width="7%">UAS (%)</th>                                        
                                        <th width="7%">KKM</th>
                                        <th width="8%">Jenis Mapel</th>
                                        <th width="10%">Edit - Hapus</th>                                    
                                                                                                                                                                
                                 </tr>
                                </thead>
                                <tbody>
                                <?php 
								$no=0;
								$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel order by Urut");
								while($s = mysqli_fetch_array($sql)){ 
								$no++
								?>
                                
                                    <tr class="odd gradeX">
                                        <td align="" input type="hidden" value="<?php echo $s['Urut']; ?>" id="txt_mapel<?php echo $s['Urut']; ?>"><?php echo $no; ?></td>
                                        <td align=""><?php echo $s['XKodeSekolah']; ?></td>
										<td align=""><?php echo $s['XKodeMapel']; ?></td>
                                        <td><?php echo $s['XNamaMapel']; ?></td>
                                        <td align=""><?php echo $s['XPersenUH']; ?></td> 
                                        <td align=""><?php echo $s['XPersenUTS']; ?></td>
                                        <td align=""><?php echo $s['XPersenUAS']; ?></td>
                                        <td align=""><?php echo $s['XKKM']; ?></td>      
                                        <td align=""><?php echo $s['XMapelAgama']; ?></td>                      
										<td align="center"><?php echo "
										<a href='#myModal' id='custId' data-toggle='modal' data-id=".$s['Urut'].">"; ?>										
                                        <button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                                        <a href="?modul=daftar_mapel&aksi=hapus&urut=<?php echo $s['Urut']; ?>">
                                        <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button></a></td>                                                                                                                                                           
                                    </tr>
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
                    <h4 class="modal-title">Edit Data Mapel</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
            </div>
        </div>
    </div>
    
<div class="modal fade" id="myTam" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Tambah  Data Mapel</h4>
                </div>
                <div class="modal-body">
        <!-- MEMBUAT FORM -->
        <form action="?modul=daftar_mapel&tambah=yes" method="post">
			<div class="form-group">
                <label>Kode Sekolah</label><br>
                <select class="form-control" name="txt_kodesek" id="txt_kodesek">
                                <?php 
                                $sqlsek = mysqli_query($GLOBALS["___mysqli_ston"], "select * from server_sekolah order by XServerId");
                                while($sek = mysqli_fetch_array($sqlsek)){
                                echo "<option value='$sek[XServerId]'>$sek[XServerId] $sek[XSekolah]</option>";
                                }
                                ?>
								<option value='ALL'>SEMUA</option>
								</select>
            </div>
            <div class="form-group">
 				<table width="100%" border="0" cellpadding="5px" cellspacing="5px">
                <tr>
                <td><label>Kode Mapel</label></td>
                <td>&nbsp;</td>
                <td><label>Nama Mapel</label></td>
                <td>&nbsp;</td>
                <td><label>Mapel Agama</label></td>
                <td>&nbsp;</td>
                </tr>
				<tr><td>
                <input type="text" class="form-control" name="txt_kokel">                
                </td><td>&nbsp;</td><td>
                <input type="text" class="form-control" name="txt_nakel">                
                </td>
                </td><td>&nbsp;</td><td>
                <select id="txt_mapelagama"  name="txt_mapelagama" class="form-control" >
								<option value='N' class='form-control' >MAPEL UMUM</option>
								<option value='Y' class='form-control' >PEMINATAN</option>                                
								<option value='A' class='form-control' >PEND. AGAMA</option>                                
                                </select>                 
                </td>
                </tr>
                </table>
			</div>
<hr />
            <div class="form-group">
  				<table width="100%" border="0" cellpadding="5px" cellspacing="5px">
                <tr>
                <td><label>Persen Harian</label></td>
                <td>&nbsp;</td>
                <td><label>Persen UTS </label></td>
                <td>&nbsp;</td>
                <td><label>Persen UAS</label></td>
                <td>&nbsp;</td>
                <td><label>Nilai KKM </label></td>
                <td>&nbsp;</td>
                </tr>
				<tr>
                <td>
                <input type="text" class="form-control" name="txt_UH">                
                </td><td>&nbsp;</td><td>
                <input type="text" class="form-control" name="txt_UTS">                
                </td>
                </td><td>&nbsp;</td>
                <td>
                <input type="text" class="form-control" name="txt_UAS">                
                </td><td>&nbsp;</td><td>
                <input type="text" class="form-control" name="txt_KKM">                
                </td>
                </td><td>&nbsp;</td>
                </tr>
                </table>
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
                url : 'edit_mapel.php',
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
                url : 'tambah_mapel.php',
                data :  'urut='+ rowid,
                success : function(data){
                $('.fetched-data2').html(data);//menampilkan data ke dalam modal
                }
            });
         });
    });
  </script>
  
  
</body>



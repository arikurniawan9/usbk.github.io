<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
include "../../config/server.php";
if(isset($_REQUEST['aksi'])){
//echo "delete from cbt_kelas where Urut = '$_REQUEST[urut]'";
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "delete from cbt_siswa where Urut = '$_REQUEST[urut]'");
}
if(isset($_REQUEST['simpan'])){
//echo "Urut = '$_REQUEST[txt_kodkel] - $_REQUEST[txt_namkel] - $_REQUEST[txt_kodlev] - $_REQUEST[txt_jur]' $_REQUEST[id]";
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_siswa set XNamaSiswa = '$_REQUEST[txt_nam]', XPassword = '$_REQUEST[txt_pas]', XNomerUjian = '$_REQUEST[txt_nom]',
XKodeJurusan = '$_REQUEST[jur2]', XKodeKelas = '$_REQUEST[txt_kelas]', XKodeLevel = '$_REQUEST[txt_level]',
XNIK = '$_REQUEST[txt_nisn]', XFoto='$_REQUEST[txt_potret]',XJenisKelamin = '$_REQUEST[txt_jekel]',
XSesi = '$_REQUEST[txt_sesi]',XRuang = '$_REQUEST[txt_ruang]',XAgama = '$_REQUEST[txt_agama]',XKodeSekolah = '$_REQUEST[txt_kodesek]',
XPilihan = '$_REQUEST[txt_pilih]',XNamaKelas = '$_REQUEST[txt_namkel]'
 where Urut = '$_REQUEST[id]'");
}

if(isset($_REQUEST['tambah'])){
	$sqlcek = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa where (XNomerUjian = '$_REQUEST[txt_nom]' or XNIK = '$_REQUEST[txt_nisn]')"));
	if($sqlcek>0){
	$message = "NISN atau Nomer Ujian SUDAH ADA";
	echo "<script type='text/javascript'>alert('$message');</script>";
	} else {
		if(!$_REQUEST['txt_nom']==""||!$_REQUEST['txt_nisn']==""){
		$sql = mysqli_query($GLOBALS["___mysqli_ston"], "insert into cbt_siswa (XNamaSiswa, XPassword, XNomerUjian, XKodeJurusan, XKodeKelas, XKodeLevel,
		XNIK, XFoto,XJenisKelamin,XSesi,XRuang,XAgama,XKodeSekolah,XPilihan,XNamaKelas) values 	
		('$_REQUEST[txt_nam]','$_REQUEST[txt_pas]','$_REQUEST[txt_nom]','$_REQUEST[jur2]','$_REQUEST[txt_kelas]','$_REQUEST[txt_level]','$_REQUEST[txt_nisn]', 
		'$_REQUEST[txt_potret]','$_REQUEST[txt_jekel]','$_REQUEST[txt_sesi]','$_REQUEST[txt_ruang]','$_REQUEST[txt_agama]','$_REQUEST[txt_kodesek]','$_REQUEST[txt_pilih]','$_REQUEST[txt_namkel]')");
		}
	}

}
$sqlad = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_admin");
$ad = mysqli_fetch_array($sqlad);
$tingkat=$ad['XTingkat'];
if ($tingkat=="MA" or $tingkat=="SMA" or $tingkat=="SMK"  ){$rombel="Jurusan";}else{$rombel="Rombel";}


?>

<!-- Bootstrap Core CSS -->
	<!-- Bootstrap Core CSS 
		<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        
        <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->	
        
        <!-- END GLOBAL MANDATORY STYLES -->
		

                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Data Peserta Ujian
                                    </div>
									<div class="actions">
										<a href="?modul=upl_siswa">
											<button type="button" class="btn btn-info btn-small" style="margin-top:5px; margin-bottom:5px">
												<i class="fa fa-cloud-upload"></i> Upload Data Siswa</i>
											</button>
										</a>
										<a href="down_excel_siswa.php" target="_blank">
											<button type="button" class="btn btn-success" id="download"> <i class='fa fa-cloud-download  '></i> Rekap Siswa Excel</button>
										 </a>				
										<?php echo "<a href='#myTam' id='custId' data-toggle='modal' data-id=''>"; ?>
										<button type="button" class="btn btn-warning btn-small" ><i class="fa fa-plus-circle"></i> Tambah Siswa</button>
										<?php echo "</a>";?>
										<a href="?modul=upl_foto">
											<button type="button" class="btn btn-danger btn-small" style="margin-top:5px; margin-bottom:5px">
												<i class="fa fa-cloud-upload"></i> Upload Foto</i>
											</button>
										</a>	
										<a href='#myCetakKartu' id='custId' data-toggle='modal' data-id=''>
										<button type="button" class="btn btn-default btn-small" ><i class="fa fa-print"></i> Cetak Kartu</button>
										</a>   &nbsp;&nbsp;
									</div>
								</div>
							
                        <!-- /.panel-heading -->
                        <div class="portlet-body">
                            <table id="example" class="display wrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="5%" >No.</th>
                                        <th width="10%">Kode Sekolah</th>
										<th width="10%">Nomor Peserta | Sesi</th>
                                        <th width="20%">Nama Peserta</th>
                                        <th width="10%">Kelas-<?php echo $rombel; ?></th>
										<th width="10%">Nama Kelas</th>
										<th width="10%">Agama</th>
                                        <th width="10%">Mapel Pilihan</th>
                                        <th width="12%">Edit | Hapus</th>                                    
                                        </tr>
                                </thead>
                                <tbody>
				<?php	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa order by XNomerUjian");
						while($s = mysqli_fetch_array($sql)){ 
							$gbr=str_replace(" ","",$s['XFoto']);
							if($gbr==""){$gbr="nouser.png";}
				?>
							<tr class="odd gradeX">
								<td align="center"><?php echo $s['Urut']; ?>
										 <a href="#" data-toggle="modal" data-target="#myModal<?php echo $s['Urut']; ?>">
										<img src="../../fotosiswa/<?php echo "$gbr"; ?>" width="50"/></a>
								</td>
								<td align="center"><?php echo $s['XKodeSekolah']; ?></td>
								<td align="center"><a href="#" data-toggle="modal" data-target="#myModal<?php echo $s['XNomerUjian']; ?>" title="Lhat Foto" >
									<?php echo $s['XNomerUjian']; ?></a> | <?php echo $s['XSesi']; ?></td>
								<td><?php echo $s['XNamaSiswa']; ?></td>
								<td align="center"><?php echo $s['XKodeKelas']; ?>-<?php echo $s['XKodeJurusan']; ?></td>
								<td align="center"><?php echo $s['XNamaKelas']; ?></td>
								<td align="center"><?php echo $s['XAgama']; ?></td>
								<td align="center"><?php echo $s['XPilihan']; ?></td>
								<td align="center"><?php echo "
									<a href='#myModal' id='custId' data-toggle='modal' data-id=".$s['Urut'].">"; ?>
									<button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
									<a href="?modul=daftar_siswa&aksi=hapus&urut=<?php echo $s['Urut']; ?>">
									<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button></a>
								</td>
						
							</tr>
						
							<!-- Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="myModal<?php echo $s['XNomerUjian']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            
                                        </div>
                                        <div class="modal-body" style="text-align:center">
										<h4 id="myModalLabel"><strong><?php echo "Peserta Ujian : $s[XNomerUjian]"; ?></strong></h4>
                                        <br>
									<?php 	if(file_exists("../../fotosiswa/$s[XFoto]")&&!$gbr==''){ ?>
											<img src="../../fotosiswa/<?php echo $s['XFoto']; ?>" width="200px">
									<?php 	} else {echo "<img src=../../fotosiswa/nouser.png>";} ?>
                                       

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            
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
                            <!-- /.table-responsive -->
                            <div class="well">
                                <h4><span style="color: #1B06CF;">Upload Foto Siswa </span></h4>
                                <p>Untuk melengkapi gambar/foto siswa peserta Ujian. Penamaan File gambar haruslah sesuai dengan data yang ada dalam excel pada kolom Foto. Selanjutnya, Silahkan tekan tombol dibawah ini : </p><p>
                                <a class="btn btn-danger btn-lg btn-small" href="?modul=upl_foto">Upload Foto</a>
                                
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
         
  
    <!-- Modal -->
<div class="modal fade" id="myCetakKartu" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title page-label"><i class="glyphicon glyphicon-print"></i> | Kartu Ujian</h1>
                </div>
				<form action="?modul=cetak_kartu" method="post">
                <div class="panel-body">
                    <div class="inner-content">
                        <div class="wysiwyg-content">
                            <p><table width="100%">
                                <tr height="30px"><td><?php echo $rombel; ?> </td><td>:  
								<td><select class="form-control" id="jur2"  name="jur2">
								<?php 
									$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
									while($rs = mysqli_fetch_array($sqk)){
									echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";}
								?>                                
                                </select></td>
								</tr> 
                                <tr><td width="30%">Kelas </td><td>: <td>
                                <select class="form-control" id="iki2"  name="iki2">
								<?php 
								$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
								while($rs = mysqli_fetch_array($sqk)){
                             	echo "<option value='$rs[XKodeKelas]'>$rs[XKodeKelas]</option>";
								} ?>                                
                                
                                </select>
                                </td></tr>

                                </table>                               
                            </p>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="row">
                        <div class="col-xs-offset-7 col-xs-6">
                           <button type="submit" class="btn btn-default btn-sm">
                           <i class="glyphicon glyphicon-print"></i> Tampilkan</button>
                           <button type="submit" class="btn btn-default btn-sm" data-dismiss="modal">
                           <i class="glyphicon glyphicon-minus-sign"></i> Tutup</button>
                        </div>
                    </div>
                </div>
				</form>
            </div>
        </div>
    </div>
</div>
  
								<div id="myTam" class="modal fade bs-modal-lg in" role="dialog" >
                                        <div class="modal-dialog modal-lg" role="document">
										<div class="col-md-12">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Tambah Data Siswa</h4>
                                                </div>
                                                <div class="modal-body">
											
												<form action="?modul=daftar_siswa&tambah=yes" method="post">
														<div class="row">
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Kode Sek</label>
                                                                <select class="form-control" name="txt_kodesek" id="txt_kodesek">
																<option value='ALL'>SEMUA</option>
																<?php 
																$sqlsek = mysqli_query($GLOBALS["___mysqli_ston"], "select * from server_sekolah order by XServerId");
																while($sek = mysqli_fetch_array($sqlsek)){
																echo "<option value='$sek[XServerId]'>$sek[XServerId] $sek[XSekolah]</option>";
																}
																?>
																
																</select>                                                        
														</div>
														</div>
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Level</label>
                                                            <select id="txt_level"  name="txt_level" class="form-control" >
																			<option value=''></option>
																			<?php $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeLevel");
																			while($rs = mysqli_fetch_array($sqk)){
																			echo "<option value='$rs[XKodeLevel]' class='form-control' >$rs[XKodeLevel]</option>";} ?>                                
															</select>     
                                                        </div>
														</div>
														</div>
														<div class="row">
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Nama</label>
                                                                    <input type="text" class="form-control" name="txt_nam" >
                                                        </div>
														</div>
														<div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Kelas</label>
                                                            <select id="txt_kelas"  name="txt_kelas" class="form-control" >
																			<option value=''></option>
																			<?php $sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
																			while($rs = mysqli_fetch_array($sqk)){
																			echo "<option value='$rs[XKodeKelas]' class='form-control' >$rs[XKodeKelas]</option>";} ?>                                
															</select>
                                                        </div>
														</div>
														<div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label"><?php echo $rombel; ?></label>
                                                            <select id="jur2"  name="jur2" class="form-control">
																			<option value=''></option>
																			<?php 
																			$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
																			while($rs = mysqli_fetch_array($sqk)){
																			echo "<option value='$rs[XKodeJurusan]'>$rs[XKodeJurusan]</option>";
																			} ?>                                
															</select>
                                                        </div>
														</div>
														</div>
														<div class="row">
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">NISN</label>
                                                                    <input type="text" class="form-control" name="txt_nisn" >
                                                        </div>
														</div>
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Nama Kelas</label>
                                                            <select id="txt_namkel"  name="txt_namkel" class="form-control">
																<option value=''></option>
																<?php 	$sqnk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XNamaKelas");
																		while($rsnk = mysqli_fetch_array($sqnk)){echo "<option value='$rsnk[XNamaKelas]'>$rsnk[XNamaKelas]</option>";} 
																?> 			
															</select>
                                                        </div>
														</div>
														
														</div>
														<div class="row">
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Jenis Kelamin</label>
                                                            <select id="txt_jekel"  name="txt_jekel" class="form-control">
																		<option value='L'>Laki-laki</option>
																		<option value='P'>Perempuan</option>                                
															</select>
                                                        </div>
														</div>
														<div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Sesi</label>
                                                            <select id="txt_sesi"  name="txt_sesi" class="form-control">
																		<option value='1'>1</option>
																		<option value='2'>2</option>
																		<option value='3'>3</option>
																		<option value='4'>4</option>
																		<option value='5'>5</option>
																		</select>
                                                        </div>
														</div>
														<div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Ruang</label>
                                                            <input type="text" class="form-control" name="txt_ruang" value="<?php echo "RUANG 1"?>">
                                                        </div>
														</div>
														</div>
														<div class="row">
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Nomor Ujian</label>
                                                            <input type="text" class="form-control" name="txt_nom" >
                                                        </div>
														</div>
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Password</label>
                                                            <input type="text" class="form-control" name="txt_pas" >
                                                        </div>
														</div>
														</div>
														<div class="row">
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Agama</label>
                                                            <select id="txt_agama"  name="txt_agama" class="form-control">
																		<option value=''>MAPEL UMUM</option>
																		<option value='ISLAM'>ISLAM</option>
																		<option value='KRISTEN'>KRISTEN</option>  
																		<option value='PROTESTAN'>PROTESTAN</option>
																		<option value='HINDU'>HINDU</option>
																		<option value='BUDHA'>BUDHA</option>
																		<option value='KONGHUCU'>KONGHUCU</option>
																		
															</select>
                                                        </div>
														</div>
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Pilihan</label>
                                                            <select id="txt_pilih"  name="txt_pilih" class="form-control">								
																		<?php 
																		$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel where XMapelAgama='Y'");
																		while($rs = mysqli_fetch_array($sqk)){
																		echo "<option value='$rs[XNamaMapel]'>$rs[XNamaMapel]</option>";
																		} ?>
																		<option value=''>NON PILIHAN</option>
															</select>
                                                        </div>
														</div>
														</div>
														<div class="row">
														<div class="col-md-6">
                                                        <div class="form-group">
														<label class="control-label">Foto</label>
														<input type="text" class="form-control" name="txt_potret">
																
														</div>
														</div>
														<!--<div class="col-md-6">
																<?php 	if(file_exists("../../fotosiswa/$r[XFoto]")&&!$gbrr==''){ ?>
																<img src="../../fotosiswa/<?php echo $r['XFoto']; ?>" width="100px"> 
																<?php 	} else {echo "<img src=../../fotosiswa/avatar.gif>";} ?>
														</div> -->
													</div>
														
													</div>
													
												
                                                 
												   
                                                <div class="modal-footer">
													<button class="btn green" type="submit">Tambah Data</button>
                                                    <button class="btn dark btn-outline" type="button" data-dismiss="modal" aria-hidden="true">Close</button>
                                                </div>
												</form>	
															
												<div class="fetched-data2"></div>
												</div>
												
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
		<script src="../../assets/jquery-1.12.4.js"></script>
		<script src="../../assets/jquery.dataTables.min.js"></script>
		<!-- jQuery -->
		<!-- Metis Menu Plugin JavaScript -->
	 <script>
	   $(document).ready(function() {
		$('#example').DataTable( {
			"scrollY": 300,
			"scrollX": true
		} );
	} );
   </script>
   

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    
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
	<div class="modal fade bs-modal-lg in" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Data Siswa</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                
            </div>
        </div>
    </div>    
  <script src="js/jquery-3.1.1.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
        $('#myModal').on('show.bs.modal', function (e) {
            var rowid = $(e.relatedTarget).data('id');
            //menggunakan fungsi ajax untuk pengambilan data
            $.ajax({
                type : 'post',
                url : 'edit_siswa.php',
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
                url : 'tambah_siswa.php',
                data :  'urut='+ rowid,
                success : function(data){
                $('.fetched-data2').html(data);//menampilkan data ke dalam modal
                }
            });
         });

		 
    });
  </script>


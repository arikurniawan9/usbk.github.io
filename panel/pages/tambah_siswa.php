<?php
	if(isset($_REQUEST['aksi'])){
//echo "delete from cbt_kelas where Urut = '$_REQUEST[urut]'";
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "delete from cbt_siswa where Urut = '$_REQUEST[urut]'");
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
		'$_REQUEST[txt_jekel]','$_REQUEST[txt_sesi]','$_REQUEST[txt_ruang]','$_REQUEST[txt_agama]','$_REQUEST[txt_kodesek]','$_REQUEST[txt_pilih]','$_REQUEST[txt_namkel]')");
		}
	}

}
$sqlad = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_admin");
$ad = mysqli_fetch_array($sqlad);
$tingkat=$ad['XTingkat'];
if ($tingkat=="MA" or $tingkat=="SMA" or $tingkat=="SMK"  ){$rombel="Jurusan";}else{$rombel="Rombel";}


?>

		
		 <!-- Bootstrap Core CSS -->
		<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        
        <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->	
		
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
														
													</div>
													
												
                                                
												   
                                                <div class="modal-footer">
													<button class="btn green" type="submit">Tambah Data</button>
                                                    <button class="btn dark btn-outline" type="button" data-dismiss="modal" aria-hidden="true">Close</button>
                                                </div>
												</form>

<?php } ?>											   
 <!-- BEGIN CORE PLUGINS -->
        <script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->  												
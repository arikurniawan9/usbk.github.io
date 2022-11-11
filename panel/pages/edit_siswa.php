<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

	include "../../config/server.php";
    if($_REQUEST['urut']) {
        $id = $_POST['urut'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_siswa WHERE Urut = '$id'");
        $r = mysqli_fetch_array($sql);
		$gbrr=str_replace(" ","",$r['XFoto']);
		if($gbrr==""){$gbrr="avatar.gif";}
		$kos=$r['XKodeSekolah'];
		
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
        
		
					<!--		<div class="modal fade bs-modal-lg in" role="dialog" tabindex="-1">
                                        <div class="modal-dialog modal-lg" role="document">
										<div class="col-md-12">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                    <h4 class="modal-title">Edit Data Siswa</h4>
                                                </div>
																-->
                                               
											   <form action="?modul=daftar_siswa&simpan=yes" method="post">
											   <input type="hidden" name="id" value="<?php echo $r['Urut']; ?>">
													<div class="row">
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Kode Sek</label>
                                                                <select class="form-control" name="txt_kodesek" id="txt_kodesek">
																<option value='ALL'>SEMUA</option>
																<?php
																	$sqle = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM server_sekolah WHERE XServerId = '$r[XKodeSekolah]'");
																	$re = mysqli_fetch_array($sqle);
																	if ($kos=="ALL"){echo "<option value='ALL' selected >SEMUA / ALL</option>";}
																	else {echo "<option value='$kos' selected >$kos - $re[XSekolah]</option>";}
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
																	<?php 
																	echo "<option value='$r[XKodeLevel]' selected >$r[XKodeLevel]</option>";
																	$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeLevel");
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
                                                                    <input type="text" class="form-control" name="txt_nam" value="<?php echo $r['XNamaSiswa']; ?>" >
                                                        </div>
														</div>
														<div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Kelas</label>
                                                            <select id="txt_kelas"  name="txt_kelas" class="form-control" >
																			<option value=''></option>
																			<?php 
																			echo "<option value='$r[XKodeKelas]' selected >$r[XKodeKelas]</option>";
																			$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
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
																			echo "<option value='$r[XKodeJurusan]' selected >$r[XKodeJurusan]</option>";
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
                                                                    <input type="text" class="form-control" name="txt_nisn" value="<?php echo $r['XNIK']; ?>" >
                                                        </div>
														</div>
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Nama Kelas</label>
                                                            <select id="txt_namkel"  name="txt_namkel" class="form-control">
																<option value=''></option>
																<?php 
																echo "<option value='$r[XNamaKelas]' selected >$r[XNamaKelas]</option>";
																$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XNamaKelas");
																while($rs = mysqli_fetch_array($sqk)){
																echo "<option value='$rs[XNamaKelas]'>$rs[XNamaKelas]</option>";
																} ?> 			
															</select>
                                                        </div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Jenis Kelamin</label>
                                                            <select id="txt_jekel"  name="txt_jekel" class="form-control">
																<option value='L' <?php if($r['XJenisKelamin']=="L"){echo "selected";} ?>>Laki-laki</option>
																<option value='P' <?php if($r['XJenisKelamin']=="P"){echo "selected";} ?>>Perempuan</option>
															</select>
                                                        </div>
														</div>
														<div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Sesi</label>
                                                            <select id="txt_sesi"  name="txt_sesi" class="form-control">
																<?php 
															//echo "<option value='$r[XSesi]' selected>$r[XSesi]</option>";
															?> 
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
                                                            <input type="text" class="form-control" name="txt_ruang" value="<?php echo "$r[XRuang]"?>" size="5">
                                                        </div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Nomor Ujian</label>
                                                            <input type="text" class="form-control" name="txt_nom" value="<?php echo $r['XNomerUjian']; ?>" >
                                                        </div>
														</div>
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Password</label>
                                                            <input type="text" class="form-control" name="txt_pas" value="<?php echo $r['XPassword']; ?>">
                                                        </div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Agama</label>
                                                            <select id="txt_agama"  name="txt_agama" class="form-control">
																		<?php 
																		echo "<option value='$r[XAgama]' selected >$r[XAgama]</option>";
																		?>    
																		<option value='ISLAM'>ISLAM</option>
																		<option value='KRISTEN'>KRISTEN</option>  
																		<option value='PROTESTAN'>PROTESTAN</option>
																		<option value='HINDU'>HINDU</option>
																		<option value='BUDHA'>BUDHA</option>
																		<option value='KONGHUCU'>KONGHUCU</option>
																		<option value=''>MAPEL UMUM</option>
															</select>
                                                        </div>
														</div>
														<div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Pilihan</label>
                                                            <select id="txt_pilih"  name="txt_pilih" class="form-control">
																		<?php 
																		echo "<option value='$r[XPilihan]' selected >$r[XPilihan]</option>";
																		$sqk = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel where XMapelAgama='Y'");
																		while($rs = mysqli_fetch_array($sqk)){
																		echo "<option value='$rs[XNamaMapel]'>$rs[XNamaMapel]</option>";} 
																		?>
																		<option value=''>NON PILIHAN</option>																		
															</select>
                                                        </div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-6">
                                                        <div class="form-group">
														<label class="control-label">Foto</label>
														<input type="text" class="form-control" name="txt_potret" value="<?php echo $r['XFoto']; ?>">
																
														</div>
														</div>
														<div class="col-md-6">
																<?php 	if(file_exists("../../fotosiswa/$r[XFoto]")&&!$gbrr==''){ ?>
																<img src="../../fotosiswa/<?php echo $r['XFoto']; ?>" width="100px"> 
																<?php 	} else {echo "<img src=../../fotosiswa/avatar.gif>";} ?>
														</div>
													</div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn dark btn-outline" type="button" data-dismiss="modal" aria-hidden="true">Close</button>
                                                    <button class="btn green" type="submit">Update</button>
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
 
 


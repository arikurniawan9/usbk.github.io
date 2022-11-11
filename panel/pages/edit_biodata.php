<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>AJAX File Upload - Web Developer Plus Demos</title>

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
        
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
		<link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
		<link href="assets/global/plugins/datatables/css/datatables.min.css" rel="stylesheet" type="text/css">
		<link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css">
        <!-- END PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="../../assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
		<link href="../../assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" /> 
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<!-- <link rel="stylesheet" type="text/css" href="./styles.css" /> -->
<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#upload-1');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload-potoguru.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				
				if(response==="success"){
				$('#upload-1').html('<img src="photo/'+file+'"  width="200" alt="" />').addClass('success');
//					$('<li></li>').appendTo('#files').html('<img src=".photo/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
		});
		
	});
	

</script>
<script type="text/javascript" >

		$(function(){
		var btnUpload=$('#upload');
		var status=$('#status1');
		new AjaxUpload(btnUpload, {
			action: 'upload-potosiswa.php',
			name: 'uploadfile',
			onSubmit: function(file, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status.text('Uploading...');
			},
			onComplete: function(file, response){
				//On completion clear the status
				status.text('');
				//Add uploaded file to list
				
				if(response==="success"){
				$('#upload').html('<img src="../../fotosiswa/'+file+'"  width="200" alt="" />').addClass('success');
//					$('<li></li>').appendTo('#files').html('<img src=".photo/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
		});
		
	});

</script>


</head>

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 	var loading = $("#loading");
	var tampilkan = $("#tampilkan");

	loading.hide()
//apabila terjadi event onchange terhadap object <select id=propinsi>
 $("#simpan").click(function(){

 var txt_user = $("#user").val();
 var txt_nama = $("#nama").val();
 var txt_nip = $("#nip").val();
 var txt_alamat = $("#alamat").val();
 var txt_telp = $("#telp").val();
 var txt_facs = $("#faxs").val();
 var txt_email = $("#email").val();
 
  
 $.ajax({
     type:"POST",
     url:"ubahbiodata.php",    
     data: "aksi=simpan&txt_nama=" + txt_nama + "&txt_nip=" + txt_nip + "&txt_alamat=" + txt_alamat + 
	 "&txt_telp=" + txt_telp + "&txt_facs=" + txt_facs + "&txt_email=" + txt_email + "&txt_user=" + txt_user,
	 success: function(data){
	 	loading.fadeOut();
		$("#info").html(data);
		$("#info").fadeOut(2000);
	 }
	 });
	 });
});
  
</script>

<?php 
include "../../config/server.php";

	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_user WHERE Username='$_COOKIE[beeuser]'");
	$xadm = mysqli_fetch_array($sql);
	$nama= $xadm['Nama'];
	$nip= $xadm['NIP'];
	$alamat= $xadm['Alamat']; 
	$telp= $xadm['HP']; 
	$faxs= $xadm['Faxs'];
	$email= $xadm['Email']; 
	$poto= $xadm['XPoto'];
	$passw=$_COOKIE['beepassz'];
	
?>
<body>

                      
                            <!-- BEGIN PROFILE SIDEBAR -->
                            <div class="profile-sidebar">
                                <!-- PORTLET MAIN -->
                                <div class="portlet light profile-sidebar-portlet bordered ">
                                    <!-- SIDEBAR USERPIC -->
                                    <div class="profile-userpic">
                                        <img src="photo/<?php echo "$poto"; ?>" class="img-responsive" alt=""> 
									</div>
									<div class="profile-userbuttons">
                                        <button type="button" class="btn btn-circle green btn-sm" id="upload-1" >Change Foto Profil</button>
                                    </div>
                                    <!-- END SIDEBAR USERPIC -->
									<br>
								</div>
								
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name"><?php echo $xadm['Nama']; ?></div>
                                        <div class="profile-usertitle-job"><?php echo "$_COOKIE[beeuser]"; ?></div>
										<div class="profile-usertitle-job"><?php echo $xadm['NIP']; ?></div>
										<div class="profile-usertitle-job"><?php echo $xadm['Email']; ?></div>
                                    </div>
									
									
									
                                    <!-- END SIDEBAR USER TITLE -->
									
                                    <!-- END SIDEBAR BUTTONS 
                                    <!-- SIDEBAR MENU 
                                    <div class="profile-usermenu"></div>   -->
								
                                <!-- END PORTLET MAIN -->
							</div>
							<!-- END PROFILE SIDEBAR -->
							<!-- BEGIN PROFILE CONTENT -->
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">Edit Biodata</span>
                                                </div>
												<div class="actions">
													<div id="info"></div><div id="loading"><img src="images/loading.gif" height="10"></div>
													
													<button type="submit" class="btn btn-success btn-block doblockui" id="simpan" name="simpan" value=""><i class="fa fa-save">&nbsp;Simpan</i></button>
												</div> 
                                                
                                            </div>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <!-- PERSONAL INFO TAB -->
                                                    <div class="tab-pane active" id="tab_1_1">
                                                        <form action="#" class="form-horizontal form-row-seperated">
														<div class="form-body">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Username</label>
																<div class="col-md-9">
                                                                <input type="text" placeholder="" class="form-control" id="user" value="<?php echo "$_COOKIE[beeuser]"; ?>"  />
																
																</div></div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Nama User</label>
																<div class="col-md-9">
                                                                <input type="text" placeholder="" class="form-control" id="nama" value="<?php echo "$nama"; ?>"  />
																
																</div></div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">NIP</label>
																<div class="col-md-9">
                                                                <input type="text" placeholder="" class="form-control" id="nip" value="<?php echo "$nip"; ?>"  />
																
																</div></div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Alamat</label>
																<div class="col-md-9">
                                                                <input type="text" placeholder="" class="form-control" id="alamat" value="<?php echo "$alamat"; ?>"  />
																
																</div></div>
															<div class="form-group">
                                                                <label class="control-label col-md-3">No. Telp</label>
																<div class="col-md-9">
                                                                <input type="text" placeholder="" class="form-control" id="telp" value="<?php echo "$telp"; ?>"  />
																
																</div></div>
															<div class="form-group">
                                                                <label class="control-label col-md-3">No.Fax</label>
																<div class="col-md-9">
                                                                <input type="text" placeholder="" class="form-control" id="faxs" value="<?php echo "$faxs"; ?>"  />
																
																</div></div>
															<div class="form-group">
                                                                <label class="control-label col-md-3">Email</label>
																<div class="col-md-9">
                                                                <input type="text" placeholder="" class="form-control" id="email" value="<?php echo "$email"; ?>"  />
																
																</div></div>
															<div class="note note-danger">
															<p> Bila User Name diubah wajib untuk logout lalu login kembali dengan menggunakan User Name baru. </p>
															</div>
														</form>
                                                    </div>
													</div>
												</div>
											</div>
                                                    <!-- END PERSONAL INFO TAB -->
									</div>
								</div>
							</div>
						</div>
					</div>
	
	
															


<!--

<br />
<span>
    <div class="left">
    				<div class="panel panel-primary">
                        <div class="panel-heading">
                            Edit Biodata
                        </div>
                        <div class="panel-body">
                            <table width="100%">
                            <tr height="42px"><td width="30%">User Name&nbsp;</td><td>:<td> <input class="form-control"type="text" id="user" value="<?php echo "$_COOKIE[beeuser]"; ?>"/>
							</td></tr>
							
                            <tr height="42px"><td >Nama&nbsp;</td><td>: <td> <input class="form-control"type="text" id="nama" value="<?php echo "$nama"; ?>"/> </td></tr>
                            <tr height="42px"><td>NIP&nbsp;</td><td>: <td> <input class="form-control"type="text" id="nip" value="<?php echo "$nip"; ?>"/> </td></tr>
                            <tr height="42px"><td>Alamat&nbsp;</td><td>:<td> <input class="form-control"type="textarea" id="alamat"  cols="20" rows="2" value="<?php echo "$alamat"; ?>"/> </td></tr>
                            <tr height="42px"><td>No. Telp&nbsp;</td><td>:<td> <input class="form-control"type="text" id="telp"  value="<?php echo "$telp"; ?>"/> </td></tr>
                            <tr height="42px"><td>No. Fax.&nbsp;</td><td>: <td> <input class="form-control"type="text" id="faxs"  value="<?php echo "$faxs"; ?>"/> </td></tr>
                            <tr height="42px"><td>Email&nbsp;</td><td>: <td> <input class="form-control"type="text" id="email"  value="<?php echo "$email"; ?>"/> </td></tr>
                          
                            </table>
                        </div>
						<div class="panel-body">
						Bila User Name diubah wajib untuk logout lalu login kembali dengan menggunakan User Name baru
						</div>
                        <div class="panel-footer">
                            <input type="submit"  class="btn btn-info btn-lg btn-small" id="simpan" name="simpan" value="Simpan">
                            <div id="info"></div><div id="loading"><img src="images/loading.gif" height="10"></div>
                        </div>
                    </div>
			
			</div>
<div class="group">
    <div class="right">
             <div class="panel panel-info" style="padding-top:20">
                        <div class="panel-heading" style=" text-align:center">
                            Upload Photo : 
                        </div>
                        <div class="panel-body">
                          
                        <!-- Upload Button, use any id you wish 
                        <div id="upload-1" style="text-align:center">
						<img src="photo/<?php echo "$poto"; ?>" width="250"/>
						</div><span id="status" ></span>
           				</div>
               			<div class="panel-footer" style=" text-align:center">Klik Gambar untuk Ganti Foto
                        </div>
               
            </div>


                

    </div>	
</div>  
        </div>	
</div>            -->

!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
		
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/profile.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
		
		<script src="assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
		<script type="text/javascript">
		$("form1").validate();
		</script>

</body>
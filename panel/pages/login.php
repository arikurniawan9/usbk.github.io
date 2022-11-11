<?php
        include "../../config/server_status.php";       
        
        //echo $status_konek;
        if($status_konek=='1'){
        //$sqlhost = mysqli_query($GLOBALS["___mysqli_ston"], "select * from server_sekolah where XServerName = '$pc_client' and XServerId = '$kodesekolah'");
        $sqlhost = mysqli_query($GLOBALS["___mysqli_ston"], "select * from server_sekolah where XServerId = '$kodesekolah'");
        $sqlstatus = mysqli_num_rows($sqlhost);
        //echo "select * from server_sekolah where XServerName = '$pc_client'";
        $sq = mysqli_fetch_array($sqlhost);
        $var_status = $sq['XStatus'];}
        else{
        $var_status = '';$sqlstatus = 9;}     
        //echo "var_server : |$var_status|,sqlstatus : $sqlstatus ";
        
            if($sqlstatus>0&&$var_status=='0'){
                $warna = "info"; $server_status = "STANDBY";$txt_server_status = "Akses ke Server Pusat Ditutup SN sudah terdaftar di Server Pusat";$huruf ="#789BCC";$bg=
                "#789BCC";
                }
            elseif($var_status==''&&$sqlstatus>0){
                $warna = "danger"; $server_status = "OFFLINE";$txt_server_status = "CBTSync tidak terkoneksi ke server pusat";$huruf ="red";$bg=
                "red";}
            elseif($sqlstatus==0&&$var_status=='') { 
                $warna = "warning"; $server_status = "STANDBY";$txt_server_status = "ID Server / SN tidak sesuai dengan data server pusat"; $huruf ="#ffca01";$bg="#ffca01";}
            elseif($sqlstatus>0&&$var_status>0){
                $warna = "info"; $server_status = "AKTIF";$txt_server_status = "CBTSync Siap Digunakan"; $huruf ="#10d8f3";$bg="#15c0d7"; }
            
        ?>
<?php
include "../../config/server.php";

if($val == TRUE){
	if (mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_zona LIMIT 1")==TRUE){
	$skullogin= $log['XLogin'];
	$email=$log['XEmail'];
	$web=$log['XWeb'];
	$alamat=$log['XAlamat'];
	$tlp=$log['XTelp'];
	$h1=$log['XH1'];
	$h2=$log['XH2'];
	$h3=$log['XH3'];
	$cbt_header = mysqli_query($GLOBALS["___mysqli_ston"], 'select * from cbt_header');
	$ch = mysqli_fetch_array($cbt_header);
	if (mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_sinc LIMIT 1")==TRUE){
		$hakakses=$ch['HakAkses'];
		$loginpanel=$ch['LoginPanel'];
	}else{
		$hakakses=0;
		$loginpanel=0;
	}
	
}else{$skullogin= $log['XLogin'];
	$email=$log['XEmail'];
	$web=$log['XWeb'];
	$alamat=$log['XAlamat'];
	$tlp=$log['XTelp'];
	$h1=$log['XH1'];
	$h2=$log['XH2'];
	$h3=$log['XH3'];
	$cbt_header = mysqli_query($GLOBALS["___mysqli_ston"], 'select * from cbt_header');
	$ch = mysqli_fetch_array($cbt_header);	
	$hakakses="0";
	$loginpanel="0";
	
}}else{
$skull= "UJIAN BERBASIS KOMPUTER";
	$skullogin="pertama.jpg";
	$web="";
	$tlp="0000-00000";
	$h1="UJIAN BERBASIS KOMPUTER";
	$h2="EDUCATION PARTNER";
	$h3="CBTSync Siap diinstal";	
	$hakakses="0";
	$loginpanel="0";
	
}


$valL = mysqli_query($GLOBALS["___mysqli_ston"], 'select 1 from `cbt_user` LIMIT 1');
if (!$valL) {
    $skulkode1= '';
}else {
  $sqll = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_user WHERE Login='2'");
$xadm = mysqli_fetch_array($sqll);
$skulkode1= $xadm['Username'];
}

if(isset($sqlconn)){} else {$pesan1 = "Tidak dapat Koneksi Database.";}
if (!$sqlconn) {die('Could not connect: '.mysqli_error($GLOBALS["___mysqli_ston"]));}
 
 ?>

 <!--
 <?php
include "../../config/server.php";
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_admin");
$xadm = mysqli_fetch_array($sql);
$skulpic= $xadm['XLogo'];
$skulban= $xadm['XBanner'];
$skulnam= $xadm['XSekolah']; 
$skultin= $xadm['XTingkat']; 
$skulala= $xadm['XAlamat'];
$skultel= $xadm['XTelp']; 
$skulfax= $xadm['XFax'];
$skulema= $xadm['XEmail']; 
$skulweb= $xadm['XWeb'];
$skulkep= $xadm['XKepSek']; 
$skulweb= $xadm['XWeb'];
$skuladm= $xadm['XAdmin']; 
$admpic= $xadm['XPicAdmin']; 
$skulkode= $xadm['XKodeSekolah']; 
$skulnip1= $xadm['XNIPKepsek']; 
$skulnip2= $xadm['XNIPAdmin']; 
$skullogin= $xadm['XLogin'];


?>
 -->
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $skull; ?> | Administrator</title>
	<script language="JavaScript">
		var txt="<?php echo $skull; ?> - Administrator  -  ";
		var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
		txt=txt.substring(1,txt.length)+txt.charAt(0);
		segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>
		<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
		<link href="../../assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css">
        <link href="../../assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="../../assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="../../assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="../../assets/pages/css/login-5.min.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <!-- END THEME LAYOUT STYLES -->
		<link href='../../images/icon.png' rel='icon' type='image/gif'/>

      
	

<!-- Custom Fonts -->
<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<style>
#ingat{width:100%; height:auto; background-color:#FBECF0; border:0; border-left:thick #FF0000 solid; padding-left:10; padding-top:15}
</style>

<script type="text/javascript">
function mousedwn(e){try{if(event.button==2||event.button==3)return false}catch(e){if(e.which==3)return false}}document.oncontextmenu=function(){return false};document.ondragstart=function(){return false};document.onmousedown=mousedwn
</script>
<script type="text/javascript">
window.addEventListener("keydown",function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){e.preventDefault()}});document.keypress=function(e){if(e.ctrlKey&&(e.which==65||e.which==66||e.which==67||e.which==73||e.which==80||e.which==83||e.which==85||e.which==86)){}return false}
</script>
<script type="text/javascript">
document.onkeydown=function(e){e=e||window.event;if(e.keyCode==123||e.keyCode==18){return false}}
</script>





<script>
	function disableBackButton() {window.history.forward();}
	setTimeout("disableBackButton()", 0);
</script>
<script src="js/jquery-1.11.0.min.js">
function validateForm() {
    var x = document.forms["loginform"]["userz"].value;
    var y = document.forms["loginform"]["passz"].value;
    var peluru = '\u2022';
    if (x == null || x == "" || y == null || y == "") {
		document.getElementById("ingat").style.display = "block";
		document.getElementById("isine").textContent= peluru+"Username dan Password harus diisi";
        return false;
    }
}

</script>
<!-- Show Password -->
 
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="../../asset/bootstrap-show-password.js"></script>
<script>
    $(function() {
        $('#passz').password().on('show.bs.password', function(e) {
            $('#eventLog').text('On show event');
            $('#methods').prop('checked', true);
        }).on('hide.bs.password', function(e) {
                    $('#eventLog').text('On hide event');
                    $('#methods').prop('checked', false);
                });
        $('#methods').click(function() {
            $('#passz').password('toggle');
        });
    });
</script>
<!-- /Show Password -->
  </head>
<body class="login" id="blockui_sample_3_2_element">
        <!-- BEGIN : LOGIN PAGE 5-1 -->
        <div class="user-login-5">
            <div class="row bs-reset">
                <div class="col-md-6 bs-reset">

                    <div class="login-bg" style="background-image:url(images/<?php echo "$skullogin"; ?>">
                    	<?php 
if(!$val == FALSE) {?>
                        <img class="login-logo" src="../../images/<?php echo $skulban; ?>" width="350px"/> <?php 
}
?></div>
					
                </div>
				
                <div class="col-md-6 login-container bs-reset">
                	 <?php 
if(!$val == FALSE) {?>
				<div class="login-header">
                    <div class="mt-element-ribbon bg-grey-steel">
                        <div class="ribbon ribbon-color-info uppercase ribbon-shadow">Nama Server</div>
                        <div class="ribbon-content">
						<h3><?php echo $h1; ?><?php echo "&nbsp;-&nbsp;"."$skulkode"; ?></h3>
						<h4><?php echo $h2; ?></h4>
						<h5><?php echo "Web : ".$web." &nbsp;-&nbsp; Telp : ".$tlp; ?><!--<br><?php echo "Email: ".$email; ?>!--></h5>
						</div>
                    </div>
											
					
				</div><?php 
}
?>



									<div class="login-content" style="margin-top:15%">
															<h1><?php echo "$h3"; ?> </h1>
															<p> Selamat datang di aplikasi CBT Sync. SIlahkan masukan ID Server dan periksa registrasi yang telah diberikan</p>
															<div id="ingat" class="note-note danger" style="display:block"> 
																<?php 
																if($val == FALSE)
																{?>
																<font style=" padding:10px; font-size:16px ; color:#20202f;"><b>Peringatan :</b></font>
																<p>
																
																
																<span id="isine" style="color:#CC3300; margin-left:10px;" ></span>
																<?php echo "Database belum terbentuk, Klik "; ?>
                                                                    <a href="buat_database.php" id="blockui_sample_3_2" class="label" style="color:#ececfb; font-style:weight; background-color:#0080c0;"><strong>DISINI</strong> 
                                                                </a><?php echo "&nbsp; untuk membuat Database."; ?>
																<?php 
																}
																?>
																</p> 
															</div>
                                                            <?php if ($xserver=="pusat"){?>
											                 <?php if($server_status == "OFFLINE"){ ?>
                                                                <div id="ingat" class="note-note danger" style="display:block"> 
                                                                <font style=" padding:10px; font-size:16px ; color:#20202f;"><b>Peringatan :</b></font>
                                                                <p>
                                                                <span id="isine" style="color:#000; margin-left:20px;" >VM tidak terkoneksi internet, Silahkan refresh atau cek konfigurasi</span>
                                                                <span id="isine" style="color:#000; margin-left:20px;" >network adapter</span>
                                                               
                                                                    
                                                                
                                                                </p> 
                                                            </div>

                                                            <?php } else { ?>
                                                            
                                                            <?php } ?>
											                 <?php } else { ?>
                                                             <?php }?>
											
											
								<form id="loginform"  name="loginform" onSubmit="return validateForm();" action="../pages/ceklogin.php" class="login-form" method="post">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                <span id="ingat"><?php echo "Username dan Password harus diisi "; ?>. </span>

                            </div>
                            <div class="row">
                            	<?php 
if(!$val == FALSE) {?>
                                <div class="col-xs-4">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="ID SERVER" id="userz" name="userz" value="<?php echo $skulkode1; ?>" required /> </div>
                                <div class="col-xs-8">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="F82B-86CF-7E36-43B2-1B69-6AC1-ADA8-4703" id="passz" name="passz" disabled="" / > </div>
                                <div class="col-xs-8" hidden="">
                                    <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" autocomplete="off" placeholder="Password" value="admin" id="passz" name="passz" required / > </div>

								<?php 
								}
								?>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
								<div class="switch-field">
								<!-- <input type="radio" id="switch_left" name="login" value="admin" checked/>
								<label for="switch_left"><font style="color:#99ccff">Admin</font></label>
								<input type="radio" id="switch_right" name="login" value="guru" />
								<label for="switch_right"><font style="color:#99ccff">Guru</font></label> -->
								
                                <?php 
if(!$val == FALSE) {?>
<?php if ($hakakses==0) {?>
                                <input type="radio" id="radio_siswa" name="loginz" value="guru" checked /> 
                                <label for="radio_siswa">Guru</label>
								
								
								&nbsp;&nbsp;
                                <input type="radio" id="radio_admin" name="loginz" value="admin" /> 
                                <label for="radio_admin">Administrator</label>
                                <?php }?>
                                <?php 
                                }
                                ?>
								</div>
                                </div>
							<?php 
if(!$val == FALSE) {?>
                                <div class="col-sm-4 text-right">
                                   
                                  <button class="btn btn-success" id="showtoast" type="submit">SUBMIT</button>
                                </div>
								<?php 
}
?>
                            </div>
                        </form>
                        <!-- BEGIN FORGOT PASSWORD FORM --><!-- END FORGOT PASSWORD FORM -->
                    </div>
                    <div class="login-footer">
                        <div class="row bs-reset">
                            <div class="col-xs-5 bs-reset">
                               
                            </div>
                            <div class="col-xs-7 bs-reset">
                                <div class="login-copyright text-right">
								<p><?php echo "$h3"; ?> - Copyright &copy; 2018 &nbsp;<a href="">. </a> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		
			
		

 <!-- END : LOGIN PAGE 5-1 -->
        
		<script src="../../assets/global/plugins/respond.min.js"></script>
		<script src="../../assets/global/plugins/excanvas.min.js"></script> 

        <!-- BEGIN CORE PLUGINS -->
        <script src="../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>

        <script src="../assets/pages/scripts/ui-blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
		<script src="../assets/pages/scripts/ui-toastr.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="../assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="../assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="../assets/pages/scripts/login-5.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <!-- END THEME LAYOUT SCRIPTS -->
        <script src="../assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <script src="../assets/layouts/layout6/scripts/layout.min.js" type="text/javascript"></script>
</script>
<script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
</body>
</html>

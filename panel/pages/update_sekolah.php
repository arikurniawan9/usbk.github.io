<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>AJAX File Upload - Web Developer Plus Demos</title>
<script type="text/javascript" src="js/jquery-1.3.2.js" ></script>
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>
<link rel="stylesheet" type="text/css" href="./styles.css" />
<script type="text/javascript" >
	$(function(){
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload, {
			action: 'upload-file.php',
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
				$('#upload').html('<img src="../../images/'+file+'"  width="200" alt="" />').addClass('success');
//					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files').text(file).addClass('error');
				}
			}
		});
		
	});
</script>
<script type="text/javascript" >
	$(function(){
		var btnUpload1=$('#upload1');
		var status1=$('#status1');
		new AjaxUpload(btnUpload1, {
			action: 'upload-banner.php',
			name: 'uploadfile1',
			onSubmit: function(file1, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status1.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status1.text('Uploading...');
			},
			onComplete: function(file1, response){
				//On completion clear the status
				status1.text('');
				//Add uploaded file to list
				
				if(response==="success"){
				$('#upload1').html('<img src="../../images/'+file1+'"  width="200" alt="" />').addClass('success');
//					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files1').text(file1).addClass('error');
				}
			}
		});
		
	});
</script>
<script type="text/javascript" >
	$(function(){
		var btnUpload2=$('#upload2');
		var status2=$('#status2');
		new AjaxUpload(btnUpload2, {
			action: 'upload-admin.php',
			name: 'uploadfile2',
			onSubmit: function(file2, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status2.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status2.text('Uploading...');
			},
			onComplete: function(file2, response){
				//On completion clear the status
				status2.text('');
				//Add uploaded file to list
				
				if(response==="success"){
				$('#upload2').html('<img src="photo/'+file2+'"  width="100" alt="" />').addClass('success');
//					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files2').text(file2).addClass('error');
				}
			}
		});
		
	});
</script>
<script type="text/javascript" >
	$(function(){
		var btnUpload3=$('#upload3');
		var status3=$('#status3');
		new AjaxUpload(btnUpload3, {
			action: 'upload-login.php',
			name: 'uploadfile3',
			onSubmit: function(file3, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status3.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status3.text('Uploading...');
			},
			onComplete: function(file3, response){
				//On completion clear the status
				status3.text('');
				//Add uploaded file to list
				
				if(response==="success"){
				$('#upload3').html('<img src="images/'+file3+'"  width="100" alt="" />').addClass('success');
//					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files3').text(file3).addClass('error');
				}
			}
		});
		
	});
</script>
<script type="text/javascript" >
	$(function(){
		var btnUpload4=$('#upload4');
		var status4=$('#status4');
		new AjaxUpload(btnUpload4, {
			action: 'upload-header.php',
			name: 'uploadfile4',
			onSubmit: function(file4, ext){
				 if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                    // extension is not allowed 
					status4.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				status4.text('Uploading...');
			},
			onComplete: function(file4, response){
				//On completion clear the status
				status4.text('');
				//Add uploaded file to list
				
				if(response==="success"){
				$('#upload4').html('<img src="images/'+file4+'"  width="100" alt="" />').addClass('success');
//					$('<li></li>').appendTo('#files').html('<img src="./uploads/'+file+'" alt="" /><br />'+file).addClass('success');
				} else{
					$('<li></li>').appendTo('#files3').text(file4).addClass('error');
				}
			}
		});
		
	});
</script>
<style>
.left {
    float: left;
    width: 25%;
}
.right {
    float: right;
    width: 73%;
}
.group:after {
    content:"";
    display: table;
    clear: both;
}
img {
    max-width: 100%;
    height: auto;
}
@media screen and (max-width: 480px) {
    .left, 
    .right {
        float: none;
        width: auto;
		margin-top:10px;		
    }
	
}
</style>
</head>
<body>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 	var loading = $("#loading");
	var tampilkan = $("#tampilkan");

	loading.hide()
//apabila terjadi event onchange terhadap object <select id=propinsi>
 $("#simpan").click(function(){

 
 var txt_nama = $("#namaskul").val();
 var txt_ting = $("#tingkatskul").val();
 var txt_alam = $("#alamatskul").val();
 var txt_telp = $("#telpskul").val();
 var txt_facs = $("#faxskul").val();
 var txt_emai = $("#emailskul").val();
 var txt_webs = $("#webskul").val();  
 var txt_ip = $("#kepsek").val();
 var txt_adm = $("#txt_adm").val();  
 var txt_nip1 = $("#nipkepsek").val();   
 var txt_nip2 = $("#nipadmin").val();  
 var txt_col = $("#txt_col").val();  
 var txt_col = $("#txt_col").val();  
 var txt_kode = $("#txt_kode").val();  
 var txt_prop = $("#prop").val();  
 var txt_kab = $("#kota").val();  
 var txt_kec = $("#kec").val();
 var txt_h1 = $("#txt_h1").val();
 var txt_h2 = $("#txt_h2").val();
 var txt_h3 = $("#txt_h3").val();
 var txt_ta = $("#txt_ta").val();
  
 
 $.ajax({
     type:"POST",
     url:"ubahdata.php",    
     data: "aksi=simpan&txt_nama=" + txt_nama + "&txt_ting=" + txt_ting + "&txt_alam=" + txt_alam + "&txt_telp=" + txt_telp + "&txt_facs=" + txt_facs + 
	 "&txt_emai=" + txt_emai + "&txt_webs=" + txt_webs + "&txt_ip=" + txt_ip + "&txt_adm=" + txt_adm + "&txt_col=" + txt_col + "&txt_kode=" + txt_kode + 
	 "&txt_nip1=" + txt_nip1 + "&txt_nip2=" + txt_nip2 + "&txt_prop=" + txt_prop + "&txt_kab=" + txt_kab + "&txt_kec=" + txt_kec + "&txt_h1=" + txt_h1 + "&txt_h2=" + txt_h2 + "&txt_h3=" + txt_h3 + "&txt_ta=" + txt_ta,
	 success: function(data){
	 	loading.fadeOut();
		$("#info").html(data);
		$("#info").fadeOut(2000);
	 }
	 });
	 });

});
 
</script>
<div id="mainbody" >
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
$prop= $xadm['XProp'];
$kab= $xadm['XKab'];
$kec= $xadm['XKec'];
$colhead= $xadm['XWarna'];
$h1=$xadm['XH1'];
$h2=$xadm['XH2']; 
$h3=$xadm['XH3'];

$sql1 = mysqli_query($GLOBALS["___mysqli_ston"], "select * from inf_lokasi where lokasi_kabupatenkota='$kab' and lokasi_propinsi='$prop' and lokasi_kecamatan='0000' and lokasi_kelurahan='0000'");
$xadm1 = mysqli_fetch_array($sql1);
$xkab= $xadm1['lokasi_nama'];

$ta = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_setid where XStatus='1' ");
$ta1 = mysqli_fetch_array($ta);
$sql2 = mysqli_query($GLOBALS["___mysqli_ston"], "select * from inf_lokasi where lokasi_kecamatan='$kec' and lokasi_kabupatenkota='$kab' and lokasi_propinsi='$prop' and lokasi_kelurahan='0000'");
$xadm2 = mysqli_fetch_array($sql2);
$xkec= $xadm2['lokasi_nama'];

$sql3 = mysqli_query($GLOBALS["___mysqli_ston"], "select * from inf_lokasi where lokasi_propinsi='$prop' and lokasi_kecamatan='00' and lokasi_kelurahan='0000' and lokasi_kabupatenkota='00'");
$xadm3 = mysqli_fetch_array($sql3);
$xprop= $xadm3['lokasi_nama'];
?> 
<br />

<div class="portlet-light">
<div class="group">
    <div class="left">
				<div class="panel panel-info" style="padding-top:20">
                        <div class="panel-heading" style=" text-align:center">
                            Update Logo Sekolah : 
                        </div>
                        <div class="panel-body">
                          
                        <!-- Upload Button, use any id you wish-->
                        <div id="upload" style="text-align:center"><img src="../../images/<?php echo "$skulpic"; ?>" width="150"/></div><span id="status" ></span>
                        <ul id="files"></ul>
           				</div>
               			<div class="panel-footer" style=" text-align:center">Klik Gambar untuk Ganti Logo
                        </div>
               
                </div>
    </div>
    <div class="right">
    			<div class="panel panel-primary">
                        <div class="panel-heading">Data Sekolah</div>
                        <div class="panel-body">
                            <table width="100%">

                            <tr height="42px"><td>Tahun Ajaran</td><td>: <td>
                            <select class="form-control" id="txt_ta">
                            <option value="<?php echo "$ta1[XKodeAY]"; ?>"><?php echo "$ta1[XKodeAY]"; ?>
                            	<?php 
							$a=date("Y");
							$c=$a++;
							for ($b=2;$b>=0;$b--){
								echo "<option value=' ".$c."/".$a." '>".$c."/".$a."</option>";
								$c--;
								$a--;
							} ?>
                            </option>
                        	</select>
							</td></tr>
                            <tr height="42px"><td>Kode Sekolah</td><td>: <td><input class="form-control" type="text" id="txt_kode" value="<?php echo "$skulkode"; ?>"/></td></tr>
                            <tr height="42px"><td>Nama Sekolah</td><td>: <td><input class="form-control" type="text" id="namaskul" value="<?php echo "$skulnam"; ?>"/></td></tr>
                            
                            <tr height="42px"><td>Level Sekolah</td><td>: <td>
                            <select class="form-control" id="tingkatskul">                             
								<option value="SD" <?php if($skultin=="SD"){echo "Selected";}?>>SD</option>
								<option value="MI" <?php if($skultin=="MI"){echo "Selected";}?>>MI</option>                             
								<option value="SMP" <?php if($skultin=="SMP"){echo "Selected";}?>>SMP</option>
								<option value="MTs" <?php if($skultin=="MTs"){echo "Selected";}?>>MTs</option>                            
								<option value="SMA" <?php if($skultin=="SMA"){echo "Selected";}?>>SMA</option>
								<option value="MA" <?php if($skultin=="MA") {echo "Selected";}?>>MA</option>                            
								<option value="SMK" <?php if($skultin=="SMK"){echo "Selected";}?>>SMK</option>  
                            </select>
                                                      
                            <script src="../js/jscolor.js"></script>
                            <tr height="42px"><td>Alamat Sekolah</td><td>: <td><input class="form-control" type="text" id="alamatskul"  value="<?php echo "$skulala"; ?>"/></td></tr>
                            <tr height="42px"><td>Propinsi</td><td>: <td>
							<script type="text/javascript" src="js/ajax_kota.js"></script>
							<select class="form-control" name="prop" id="prop" onchange="ajaxkota(this.value)">
							<option value="<?php echo "$prop"; ?>"/><?php echo "$xprop"; ?></option>
							<?php
								$queryProvinsi=mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM inf_lokasi where lokasi_kabupatenkota=0 and lokasi_kecamatan=0 and lokasi_kelurahan=0 order by lokasi_nama");
								while ($dataProvinsi=mysqli_fetch_array($queryProvinsi)){
								echo '<option value="'.$dataProvinsi['lokasi_propinsi'].'">'.$dataProvinsi['lokasi_nama'].'</option>';
								}
							?><select>
							</td></tr>
                            <tr height="42px"><td>Kabupaten</td><td>: &nbsp;<td>
                            <select class="form-control" name="kota" id="kota" onchange="ajaxkec(this.value)">
								<option value="<?php echo "$kab"; ?>"/><?php echo "$xkab"; ?></option>
							</select></td></tr>
							<tr height="42px"><td>Kecamatan</td><td>: &nbsp;<td>
							<select class="form-control" name="kec" id="kec" onchange="ajaxkel(this.value)">
								<option value="<?php echo "$kec"; ?>"/><?php echo "$xkec"; ?></option>
							</select></td></tr>
							
							<tr height="42px"><td>Login Header 1</td><td>: <td><input class="form-control" type="text" id="txt_h1"  value="<?php echo "$h1"; ?>"/></td></tr>
							<tr height="42px"><td>Login Header 2</td><td>: <td><input class="form-control" type="text" id="txt_h2"  value="<?php echo "$h2"; ?>"/></td></tr>
							<tr height="42px"><td>Teks Login </td><td>: <td><input class="form-control" type="text" id="txt_h3"  value="<?php echo "$h3"; ?>"/></td></tr>
                            <tr height="42px"><td>No. Telp</td><td>: <td><input class="form-control" type="text" id="telpskul"  value="<?php echo "$skultel"; ?>"/></td></tr>
                            <tr height="42px"><td>No. Fax.</td><td>: <td><input class="form-control" type="text" id="faxskul"  value="<?php echo "$skulfax"; ?>"/></td></tr>
                            <tr height="42px"><td>Email Sekolah </td><td>: <td><input class="form-control" type="text" id="emailskul"  value="<?php echo "$skulema"; ?>"/></td></tr>
                            <tr height="42px"><td>Website Sekolah </td><td>: <td><input class="form-control" type="text" id="webskul" value="<?php echo "$skulweb"; ?>" /></td></tr>
                            <tr height="42px"><td>Kepala Sekolah</td><td>: <td><input class="form-control" type="text" id="kepsek" value="<?php echo "$skulkep"; ?>" /></td></tr>
                            <tr height="42px"><td>NIP KepSek</td><td>: <td><input class="form-control" type="text" id="nipkepsek" value="<?php echo "$skulnip1"; ?>" /></td></tr>
                            <tr height="42px"><td>CBT Administrator </td><td>: <td><input class="form-control" type="text" id="txt_adm" value="<?php echo "$skuladm"; ?>" /></td></tr>
                            <tr height="42px"><td>NIP Admin</td><td>: <td><input class="form-control" type="text" id="nipadmin" value="<?php echo "$skulnip2"; ?>" /></td></tr>
                            <tr height="42px" hidden=""><td>Warna Header </td><td>: <td><input  id="txt_col" type="text"  class="jscolor {hash:true}" value="<?php echo $colhead; ?>" />
							</td></tr>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <input type="submit"  class="btn green btn-lg btn-small" id="simpan" name="simpan" value="Simpan Data Sekolah">
                            <div id="info"></div><div id="loading"><img src="images/loading.gif" height="10"></div>
                        </div>
                    </div>
<script>
    $(function() {
        $('#cp1').colorpicker();
    });
</script>
</div>
</div>
</div> 
</div> 
</div>                    
</body>
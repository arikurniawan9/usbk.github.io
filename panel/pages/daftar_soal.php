<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>


<script type="text/javascript" src="jquery.js"></script>
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
<style>
.asd {
  display: inline-block;
  width: 30%;
}
</style>

<!-- Bootstrap Core CSS -->
		<link href="../../assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="../../assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
      
        <link href="../../assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->



							<div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Daftar Bank Soal
                                    </div>
                                    <div class="actions">
									<a class="btn btn-info btn-small" data-toggle="modal" data-target="#myModal" title="Buat Bank Soal" data-toggle="modal" data-id=''><i class="fa fa-file-o"></i>&nbsp;Buat Bank Soal Baru</a>
										<!--<a class="btn btn-danger btn-small" href="#petunjuk" title="Petunjuk" data-toggle="modal" data-id="">Petunjuk</a>-->
										
                                        
                                    </div>
                                </div>
<?php
if(isset($_REQUEST['tambah'])){
$tglz = date("Y-m-d");
$sqlcek = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_paketsoal where XKodeSoal = '$_REQUEST[txt_namaz]'"));
	if($sqlcek>0){
	$message = "Kode Soal SUDAH ADA";
	echo "<script type='text/javascript'>alert('$message');</script>";
	} else {
		if(str_replace(" ","",$_REQUEST['txt_jawabz'])==""){ $jum = 5; } else { $jum = $_REQUEST['txt_jawabz'];}
		$jumsemuasoal = $_REQUEST['txt_jumsoal1z']+$_REQUEST['txt_jumsoal2z'];

		$sql = mysqli_query($GLOBALS["___mysqli_ston"], "insert into cbt_paketsoal 
		(XKodeMapel,XLevel,XKodeSoal,XJumPilihan,XJenis,XAcakSoal,XTglBuat,XGuru,XKodeKelas,XKodeJurusan,XJumSoal,XPilGanda,XEsai,XPersenPil,XPersenEsai,XKodeSekolah) values 
		('$_REQUEST[txt_mapelz]','$_REQUEST[txt_levelz]','$_REQUEST[txt_namaz]','$jum','$_REQUEST[txt_jenisz]','$_REQUEST[txt_acakz]','$tglz','$_COOKIE[beeuser]',
		'$_REQUEST[txt_kelasz]','$_REQUEST[txt_jurusanz]','$jumsemuasoal','$_REQUEST[txt_jumsoal1z]','$_REQUEST[txt_jumsoal2z]',
		'$_REQUEST[txt_bobotsoal1z]','$_REQUEST[txt_bobotsoal2z]','$_REQUEST[txt_kodesekz]')");
		
	}
}

$sql3 = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_server");
$xadm10 = mysqli_fetch_array($sql3);
$xserver= $xadm10['XServer'];

if($xserver=="lokal") { ?>
            
                     <div class="panel panel-primary">
                        <div class="panel-heading">
                       Download File Excel (Template Soal)
                        </div>
                        <div class="panel-body">
							<div style="width: 10%; float:left">
							   <img src="images/xls.png" style=" width:90%; max-width:80px;padding-right:10px;"/>
							</div>

							<div style="width: 90%; float:left">
							   <h5>Silahkan Klik tombol template dibawah, untuk <a href="../../file-excel/CBTSync_Soal_Umum_Template.xls" target="_blank"> download </a> file excel template soal sesuai dengan pilihannya. 
							   <br />Jangan ada inputan apapun setelah nomer terakhir. <br />Karena akan dibaca dan diacak oleh sistem.</h5>
							   
							</div>
                        </div>
						</div>
						
						
                        
                        <div class="portlet-title ">
							<div class="caption" style="font-size:14px; ">
							<font color="#0000ff"><strong>Pilih Template Soal</strong></font>
							</div>
							<div class="actions">
								<a href="../../file-excel/CBTSync_Soal_Umum_Template.xls" target="_blank">
								<button type="button" class="btn btn-success btn-small"><i class="fa fa-cloud-download"></i> Template Soal Umum</button></a>
								<a href="../../file-excel/CBTSync_Soal_Peminatan_Template.xls" target="_blank">
								<button type="button" class="btn btn-info btn-small"><i class="fa fa-cloud-download"></i> Template Soal Peminatan</button></a>
								<a href="../../file-excel/CBTSync_Soal_Agama_Template.xls" target="_blank">
								<button type="button" class="btn btn-danger btn-small"><i class="fa fa-cloud-download"></i> Template Soal Agama</button></a>
							</div>
						</div>.
						
                    <!-- /.col-lg-4 -->
             
          
<?php 
}

include "../../config/server.php"; ?>
           
                        
                        
                            <table id="example" class="display wrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th width="">No</th>
										<th width="">Kode Sekolah</th>
                                        <th width="">Kode Bank Soal</th>
                                        <th width="">Mata Pelajaran</th>
                                        <th width="">Soal</th>	
                                        <th width="">Kelas</th>
                                        <th width="">Copy|Upload|Edit Bank Soal</th>                                                                                                                        
                                        <th width="5%">Status</th>
                                        <th width="7%">Print&Del</th>
                                                                                                                                                             
                                 </tr>
                                </thead>
                                <tbody>
								
                                <?php 
								$no=0;
if($_COOKIE['beelogin']=='admin'){								
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select p.*,m.*,p.Urut as Urutan,p.XKodeSekolah  as kosek,p.XKodeKelas  as kokel from cbt_paketsoal p left join cbt_mapel m on m.XKodeMapel = p.XKodeMapel order by p.Urut desc");
} else {
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select p.*,m.*,p.Urut as Urutan,p.XKodeSekolah  as kosek,p.XKodeKelas  as kokel from cbt_paketsoal p left join cbt_mapel m on m.XKodeMapel = p.XKodeMapel where p.XGuru = '$_COOKIE[beeuser]' order by p.Urut desc");								
}								
								while($s = mysqli_fetch_array($sql)){ 
					$sqlsoal = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_soal where XKodeSoal = '$s[XKodeSoal]'"));
					$sqlpakai = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa_ujian where XKodeSoal = '$s[XKodeSoal]' and XStatusUjian = '1'"));
					$sqlsudah = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_jawaban where XKodeSoal = '$s[XKodeSoal]'"));
					if($sqlsoal==0){$katakosong="disabled";}  else {$katakosong="";}	
					if($sqlsudah>0||$sqlpakai>0){$katasudah="disabled";}  else {$katasudah="";}			
					if($sqlpakai>0){$katapakai="disabled";}  else {$katapakai="";}	
										
					$no++
								?>
                                
                                    <tr class="odd gradeX">
                                        <td align="center">
											<input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"> 
											<?php echo $no; ?></td>
											<input type="hidden" value="<?php echo $s['XKodeSoal']; ?>" id="txt_soal<?php echo $s['Urutan']; ?>">
                                        <td><?php echo $s['kosek']; ?></td>
										<td><?php echo $s['XKodeSoal']; ?></td>
                                        <td><?php echo $s['XNamaMapel']." (".$s['XKodeMapel'].")"; ?></td>
                                        <td><?php echo "$sqlsoal (". $s['XJumPilihan']." opsi)"; ?></td>                                           
                                        <td><?php echo $s['kokel']."-".$s['XKodeJurusan']; ?></td> 
										
										<td align="center">
											<button type="button" class="btn btn-info btn-sm" style="margin-top:6px; margin-bottom:5px" data-toggle="modal" data-target="#myCopy<?php echo $s['Urutan']; ?>">
											<i class="fa fa-copy"></i></button>
											
											<!-- Tombol Mati kalau sudah ada yang ambil ujian / dipakai
												<?php if($sqlpakai>0||$sqlsudah>0){ ?>
													<button type="button" class="btn btn-warning btn-sm disabled" style="margin-top:6px; margin-bottom:5px"><i class="fa fa-cloud-upload"></i></button>
												<?php } else {?><a href=?modul=upl_soal&soal=<?php echo $s['XKodeSoal']; ?>&mapel=<?php echo $s['XKodeMapel']; ?>>>
													<button type="button" class="btn btn-warning btn-sm" style="margin-top:6px; margin-bottom:5px"<?php echo "$katapakai $katasudah"; ?>
													<i class="fa fa-cloud-upload"></i></button></a> 
												<?php } ?> 
											!-->
												<!-- Tombol Nyala meski sudah ada yang ambil ujian / dipakai !-->
												<a href=?modul=upl_soal&soal=<?php echo $s['XKodeSoal']; ?>&mapel=<?php echo $s['XKodeMapel']; ?>>
												<button type="button" class="btn btn-warning btn-sm" style="margin-top:6px; margin-bottom:5px">
												<i class="fa fa-cloud-upload"></i></button>
											</a>
											
											<!-- Tombol Mati kalau sudah ada yang ambil ujian / dipakai
											<?php if($sqlpakai>0||$sqlsudah>0){ ?>
												<button type="button" class="btn btn-primary btn-sm" style="margin-top:6px; margin-bottom:5px" disabled><i class="fa fa-list"></i></button>
											<?php } else {?>
												<a href=?modul=edit_soal&jum=<?php echo $s['XJumPilihan']; ?>&soal=<?php echo $s['XKodeSoal']; ?>>
												<button type="button" class="btn btn-primary btn-sm" style="margin-top:6px; margin-bottom:5px" <?php echo $katapakai; ?>> <i class="fa fa-list"></i></button></a>
											<?php } ?> 
											!-->
                                        <!-- Tombol Nyala meski sudah ada yang ambil ujian / dipakai !-->
										<a href=?modul=edit_soal&jum=<?php echo $s['XJumPilihan']; ?>&soal=<?php echo $s['XKodeSoal']; ?>>
                                        <button type="button" class="btn btn-primary btn-sm" style="margin-top:6px; margin-bottom:5px" <?php echo $katapakai; ?>> <i class="fa fa-list"></i></button></a>
										</td>
                                      
                                        <td align="center">
										<?php if($s['XStatusSoal']=="Y"){ ?>
											<input type="button" id="simpan<?php echo $s['Urutan']; ?>" class="btn btn-success btn-sm" style="margin-top:6px; margin-bottom:5px" value="Aktif"  <?php echo "$katapakai $katakosong $katasudah"; ?> >
											<input type="hidden" id="ingat<?php echo $s['Urutan']; ?>" value="AKTIF"> 
										<?php } else { ?> 
											<input type="button" id="simpan<?php echo $s['Urutan']; ?>" class="btn btn-default btn-sm" style="margin-top:6px; margin-bottom:5px" value="Aktifkan" <?php echo "$katakosong";  ?> >                                 
											<input type="hidden" id="ingat<?php echo $s['Urutan']; ?>" value="NON">                                               
										<?php } ?>
										</td>
										
										<td align="center">
										 <!--<iframe src="<?php echo "print_banksoal.php?idsoal=$s[XKodeSoal]"?> " style="display:none;" name="frame"></iframe> -->
										<a href=?modul=cetak_banksoal&idsoal=<?php echo $s['XKodeSoal']; ?>>
										<button type="button" class="btn btn-default btn-sm" onClick="frames['frame'].print()" style="margin-top:6px; margin-bottom:5px"" >
										<i class="fa fa-print"></i></button>
										</a>
										<?php if($s['XStatusSoal']=="Y"){ ?>
											<button type="button" class="btn btn-danger btn-sm" id="btnDelete<?php echo $s['Urutan']; ?>" 
											<?php echo "disabled"; ?>> <i class="fa fa-times"></i></button>
										<?php } else { ?> 
											 <button type="button" class="btn btn-danger btn-sm" id="btnDelete<?php echo $s['Urutan']; ?>" 
											<?php echo " "; ?>> <i class="fa fa-times"></i></button>                                            
										<?php } ?>
										
										</td>
									
										
									</tr>
  <!-- Button trigger modal -->

<script>    
$(document).ready(function(){
$("#simpan<?php echo $s['Urutan']; ?>").click(function(){
//alert("<?php echo $s['Urutan']; ?>");
 var txt_ujian = $("#txt_ujian").val();
 var txt_jawab = $("#txt_jawab").val();
 var txt_jenis = $("#txt_jenis").val();
 var txt_acak = $("#switch_left").val();
 var txt_durasi = $("#txt_durasi").val();
 var txt_telat = $("#txt_telat").val();
 var txt_soal = $("#txt_soal<?php echo $s['Urutan']; ?>").val();  
 var txt_mapel = $("#txt_mapel<?php echo $s['Urutan']; ?>").val();
 var txt_level = $("#txt_level").val(); 
 var txt_nama = $("#txt_nama").val();  
 var txt_status = $("#ingat<?php echo $s['Urutan']; ?>").val();    
 $.ajax({
     type:"POST",
     url:"simpan_soal.php",    
     data: "aksi=simpan&txt_ujian=" + txt_ujian + "&txt_jawab=" + txt_jawab  + "&txt_jenis=" + txt_jenis + "&txt_acak=" + txt_acak + "&txt_telat=" + txt_telat + "&txt_durasi=" + txt_durasi + "&txt_soal="
	 + txt_soal + "&txt_level=" + txt_level + "&txt_mapel=" + txt_mapel + "&txt_nama=" + txt_nama + "&txt_status=" + txt_status,
	 success: function(data){
		//alert(data);
	 	if(data > 0){
		alert("masalah");
		} else {
				if( $("#simpan<?php echo $s['Urutan']; ?>").hasClass( "btn-success" ) )
		{
		 $("#simpan<?php echo $s['Urutan']; ?>").removeClass("btn-success").addClass("btn-default");
		 $("#simpan<?php echo $s['Urutan']; ?>").val("Aktifkan");
		} else {	 	
	 	 $("#simpan<?php echo $s['Urutan']; ?>").removeClass("btn-info").addClass("btn-success");
		 $("#simpan<?php echo $s['Urutan']; ?>").val("Aktif");		 
		}
		}
	  
	 loading.fadeOut();
	 tampilkan.html(data);
	 tampilkan.fadeIn(100);
	 tampildata();
	 window.location.reload();
	 }
	 
	 
	 });
	 });
	 
$("#acak<?php echo $s['Urutan']; ?>").click(function(){
//alert("<?php echo $s['Urutan']; ?>");
 var txt_ujian = $("#txt_ujian").val();
 var txt_jawab = $("#txt_jawab").val();
 var txt_jenis = $("#txt_jenis").val();
 var txt_acak = $("#switch_left").val();
 var txt_durasi = $("#txt_durasi").val();
 var txt_telat = $("#txt_telat").val();
 var txt_soal = $("#txt_soal").val();  
 var txt_mapel = $("#txt_mapel<?php echo $s['Urutan']; ?>").val();
 var txt_level = $("#txt_level").val(); 
  var txt_nama = $("#txt_nama").val();  
  
 $.ajax({
     type:"POST",
     url:"simpan_soal.php",    
     data: "aksi=acak&txt_ujian=" + txt_ujian + "&txt_jawab=" + txt_jawab  + "&txt_jenis=" + txt_jenis + "&txt_acak=" + txt_acak + "&txt_telat=" + txt_telat + "&txt_durasi=" + txt_durasi + "&txt_soal=" + txt_soal + "&txt_level=" + txt_level + "&txt_mapel=" + txt_mapel + "&txt_nama=" + txt_nama,
	 success: function(data){

		if( $("#acak<?php echo $s['Urutan']; ?>").hasClass( "btn-success" ) )
		{
		 $("#acak<?php echo $s['Urutan']; ?>").removeClass("btn-success").addClass("btn-warning");
		 $("#acak<?php echo $s['Urutan']; ?>").val("Tidak");
		} else {	 	
	 	 $("#acak<?php echo $s['Urutan']; ?>").removeClass("btn-warning").addClass("btn-success");
		 $("#acak<?php echo $s['Urutan']; ?>").val("Acak");
		}

		loading.fadeOut();
		tampilkan.html(data);
		tampilkan.fadeIn(100);
	 tampildata();
	 }
	 });
	 });	 


$("#hapus<?php echo $s['Urutan']; ?>").click(function(){
//	 alert("<?php echo $s['Urutan']; ?>");
 var txt_ujian = $("#txt_ujian").val();
 var txt_jawab = $("#txt_jawab").val();
 var txt_jenis = $("#txt_jenis").val();
 var txt_acak = $("#switch_left").val();
 var txt_durasi = $("#txt_durasi").val();
 var txt_telat = $("#txt_telat").val();
 var txt_soal = $("#txt_soal<?php echo $s['Urutan']; ?>").val();  
 var txt_mapel = $("#txt_mapel<?php echo $s['Urutan']; ?>").val();
 var txt_level = $("#txt_level").val(); 
  var txt_nama = $("#txt_nama").val();  
  
 $.ajax({
     type:"POST",
     url:"hapus_soal.php",    
     data: "aksi=hapus&txt_ujian=" + txt_ujian + "&txt_jawab=" + txt_jawab  + "&txt_jenis=" + txt_jenis + "&txt_acak=" + txt_acak + "&txt_telat=" + txt_telat + "&txt_durasi=" + txt_durasi + "&txt_soal=" + txt_soal + "&txt_level=" + txt_level + "&txt_mapel=" + txt_mapel + "&txt_nama=" + txt_nama,
	 success: function(data){

		loading.fadeOut();
		tampilkan.html(data);
		tampilkan.fadeIn(100);
	 tampildata();
	 }
	 });
	 });

$('#btnDelete<?php echo $s['Urutan']; ?>').on('click', function(e){
					
    confirmDialog("Apakah yakin akan menghapus Bank Soal ini?" , function(){
        //My code to delete
 var txt_ujian = $("#txt_ujian").val();
 var txt_jawab = $("#txt_jawab").val();
 var txt_jenis = $("#txt_jenis").val();
 var txt_acak = $("#switch_left").val();
 var txt_durasi = $("#txt_durasi").val();
 var txt_telat = $("#txt_telat").val();
 var txt_soal = $("#txt_soal<?php echo $s['Urutan']; ?>").val();  
 var txt_mapel = $("#txt_mapel<?php echo $s['Urutan']; ?>").val();
 var txt_level = $("#txt_level").val(); 
  var txt_nama = $("#txt_nama").val();  
  
 $.ajax({
     type:"POST",
     url:"hapus_soal.php",    
     data: "aksi=hapus&txt_ujian=" + txt_ujian + "&txt_jawab=" + txt_jawab  + "&txt_jenis=" + txt_jenis + "&txt_acak=" + txt_acak + "&txt_telat=" + txt_telat + "&txt_durasi=" + txt_durasi + "&txt_soal=" + txt_soal + "&txt_level=" + txt_level + "&txt_mapel=" + txt_mapel + "&txt_nama=" + txt_nama,
	 success: function(data){
	  document.location.reload();
	 // alert("hapus");

		loading.fadeOut();
		tampilkan.html(data);
		tampilkan.fadeIn(100);
	 tampildata();
	 }
	 });
    });
});

$("#tambah<?php echo $s['Urutan']; ?>").click(function(){
//alert("<?php echo $s['Urutan']; ?>");
 var txt_ujianx = $("#txt_ujianx<?php echo "$s[Urutan]"; ?>").val();
 var txt_jawabx = $("#txt_jawabx<?php echo "$s[Urutan]"; ?>").val();
 var txt_jenisx = $("#txt_jenisx<?php echo "$s[Urutan]"; ?>").val();
 var txt_acakx = $("#txt_acakx<?php echo "$s[Urutan]"; ?>").val();
 var txt_kelasx = $("#txt_kelasx<?php echo "$s[Urutan]"; ?>").val();
 var txt_jurusanx = $("#txt_jurusanx<?php echo "$s[Urutan]"; ?>").val();
 var txt_mapelx = $("#txt_mapelx<?php echo "$s[Urutan]"; ?>").val();
 var txt_levelx = $("#txt_levelx<?php echo "$s[Urutan]"; ?>").val(); 
 var txt_namax = $("#txt_namax<?php echo "$s[Urutan]"; ?>").val();  
 var txt_jumsoalx = $("#txt_jumsoalx<?php echo "$s[Urutan]"; ?>").val(); 
 var txt_jawabx = $("#txt_jawabx<?php echo "$s[Urutan]"; ?>").val();  
 var txt_kodesek = $("#txt_kodesek<?php echo "$s[Urutan]"; ?>").val();
 var txt_sesix = $("#txt_sesix<?php echo "$s[Urutan]"; ?>").val();
 var txt_acaksoalx = $("#txt_acaksoalx<?php echo "$s[Urutan]"; ?>").val();
 
 var txt_jumsoalz1 = $("#txt_jumsoalz1<?php echo "$s[Urutan]"; ?>").val();  
 var txt_jumsoalz2 = $("#txt_jumsoalz2<?php echo "$s[Urutan]"; ?>").val();  
 var txt_bobotsoalz1 = $("#txt_bobotsoalz1<?php echo "$s[Urutan]"; ?>").val();  
 var txt_bobotsoalz2 = $("#txt_bobotsoalz2<?php echo "$s[Urutan]"; ?>").val();  

  
//alert(txt_ujianx);  
  
 $.ajax({
     type:"POST",
     url:"gandakan_soal.php",    
     data: "aksi=simpan &txt_jumsoalx=" + txt_jumsoalx + "&txt_kodesek=" + txt_kodesek + "&txt_jawabx=" + txt_jawabx  + "&txt_jenisx=" + txt_jenisx + "&txt_acakx=" + txt_acakx + "&txt_kelasx=" + txt_kelasx + "&txt_levelx=" + txt_levelx + "&txt_mapelx=" + txt_mapelx + "&txt_namax=" + txt_namax + "&txt_jurusanx=" + txt_jurusanx + "&txt_ujianx=" + txt_ujianx + "&txt_jumsoalz1=" + txt_jumsoalz1 + "&txt_jumsoalz2=" + txt_jumsoalz2  + "&txt_bobotsoalz1=" + txt_bobotsoalz1 + "&txt_bobotsoalz2=" + txt_bobotsoalz2 + "&txt_sesix=" + txt_sesix + "&txt_acaksoalx=" + txt_acaksoalx,
	 success: function(data){
	      //alert("Soal Sukses Digandakan");
		  document.location.reload();
		if( $("#simpan<?php echo $s['Urutan']; ?>").hasClass( "btn-success" ) )
		{
		 $("#simpan<?php echo $s['Urutan']; ?>").removeClass("btn-success").addClass("btn-default");
		 $("#simpan<?php echo $s['Urutan']; ?>").val("Aktif");
		} else {	 	
	 	 $("#simpan<?php echo $s['Urutan']; ?>").removeClass("btn-info").addClass("btn-success");
		 $("#simpan<?php echo $s['Urutan']; ?>").val("Aktifkan");		 
		}
		loading.fadeOut();
		tampilkan.html(data);
		tampilkan.fadeIn(100);
	 tampildata();
	 }
	 });
	 });


function confirmDialog(message, onConfirm){
    var fClose = function(){
        modal.modal("hide");
    };
    var modal = $("#confirmModal");
    modal.modal("show");
    $("#confirmMessage").empty().append(message);
    $("#confirmOk").one('click', onConfirm);
    $("#confirmOk").one('click', fClose);
    $("#confirmCancel").one("click", fClose);
}


function confirmDialog2(message, onConfirm){
    var fClose = function(){
        modal.modal("hide");
    };
    var modal = $("#confirmModal");
    modal.modal("show");
    $("#confirmMessage").empty().append(message);
    $("#confirmOk").one('click', onConfirm);
    $("#confirmOk").one('click', fClose);
    $("#confirmCancel").one("click", fClose);
}



});


</script>
                                                     
  <!-- Modal confirm -->
<div class="modal" id="confirmModal" style="display: none; z-index: 1050;" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="confirmMessage">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="confirmOk">Ok</button>
                <button type="button" class="btn btn-default" id="confirmCancel">Cancel</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myCopy<?php echo $s['Urutan']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  style="display: none; z-index: 1050;"> 
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
       
        <?php // echo $s['Urutan']; ?>
                        <div class="panel panel-primary">
                        <div class="panel-heading">
                            Bank Soal yang akan digandakan
                        </div>
                        
                        <div class="panel-body">
						<p><span class="asd">Kode Sekolah</span><span>: 
                            <select id="txt_kodesek<?php echo "$s[Urutan]"; ?>">
							<option value='ALL'>SEMUA</option>
                            <?php 
							$sqlsek = mysqli_query($GLOBALS["___mysqli_ston"], "select * from server_sekolah");
							while($se = mysqli_fetch_array($sqlsek)){
                            echo "<option value='$se[XServerId]'>$se[XServerId]</option>";
							}
							?>
							
                            </select>
							</span>
						</p>
                        <p> <span  class="asd">Mata Pelajaran</span><span>:
                            <select name="txt_mapelx<?php echo "$s[Urutan]"; ?>" id="txt_mapelx<?php echo "$s[Urutan]"; ?>">
                            <?php 
                            echo "<option value='$s[XKodeMapel]' >$s[XKodeMapel] - $s[XNamaMapel]</option>";
							
                            ?>
                            <?php 
                            $sqlkelas = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel where NOT XKodeMapel = '$s[XKodeMapel]' order by XKodeMapel");
                            while($sk = mysqli_fetch_array($sqlkelas))
							{ echo "<option value='$sk[XKodeMapel]'>$sk[XKodeMapel] - $sk[XNamaMapel]</option>"; }
                            ?>
                            </select>
                            </span>
						</p>
                        <?php 
                         $sqladmin = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_admin");
                         $sa = mysqli_fetch_array($sqladmin);
						 $skul = $sa['XTingkat'];
						 if ($skul=="SMA" || $skul=="MA"||$skul=="STM"){$rombel="Jurusan";}else{$rombel="Rombel";}
						?>

                        <p><span class="asd">Tingkat Sekolah</span><span>: 
                            <select id="txt_levelx<?php echo "$s[Urutan]"; ?>">
 								<option value="SD" <?php if($skul=='SD'){echo "selected";} ?>>SD</option>
								<option value="MI" <?php if($skul=='MI'){echo "selected";} ?>>MI</option>                            
								<option value="SMP" <?php if($skul=='SMP'){echo "selected";} ?>>SMP</option>
								<option value="MTs" <?php if($skul=='MTs'){echo "selected";} ?>>MTs</option>                            
								<option value="SMA" <?php if($skul=='SMA'){echo "selected";} ?>>SMA</option>
								<option value="MA" <?php if($skul=='MA'){echo "selected";} ?>>MA</option>                            
								<option value="SMK" <?php if($skul=='SMK'){echo "selected";} ?>>SMK</option>   							
							</select>
                            </span>
						</p>
                            
                        <p><span class="asd"><?php echo $rombel;?></span><span>: 
						
                            <select id="txt_jurusanx<?php echo "$s[Urutan]"; ?>">
                            <?php 
							echo "<option value='$s[XKodeJurusan]' selected>$s[XKodeJurusan]</option>";
							?>
                            <?php 
							$sqljur = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas where NOT XKodeJurusan = '$s[XKodeJurusan]' group by XKodeJurusan");
							while($j = mysqli_fetch_array($sqljur)){
                            echo "<option value='$j[XKodeJurusan]'>$j[XKodeJurusan]</option>";
							}
							?>
							<option value='ALL'>SEMUA</option>
                            </select>
							</span>
						</p>
                            
                            <p>
                            <span class="asd">
                            Kelas</span><span>: 
							<select id="txt_kelasx<?php echo "$s[Urutan]"; ?>">
                            <option value="<?php echo "$s[kokel]"; ?>" selected><?php echo "$s[kokel]"; ?></option>
                             <?php 
							 $sqlkelas = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
							 while($k = mysqli_fetch_array($sqlkelas)){
                             echo "<option value='$k[XKodeKelas]'>$k[XKodeKelas]</option>";
							 }
							 ?>
							 <option value='ALL'>SEMUA</option>
                             </select>
							</span></p>

						<p> <span class="asd">Kode Bank Soal </span><span>:
							<?php $soale = "$s[XKodeSoal]"; 
							$carisoal = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_paketsoal where XKodeSoal = '$soale' and XKodeJurusan = '$s[XKodeJurusan]' and 
							XKodeKelas = '$s[kokel]' and XKodeMapel ='$s[XKodeMapel]'"));								
							if($carisoal>0){
							$urutz = date("-dmyhi");
							$soalez = preg_replace('/[0-9]+/', '', $soale);																
							$soalez = "$soalez".$urutz;} 
							else {$soalez = $soale;}
							?>
                            <input size="2" type="hidden" id="txt_ujianx<?php echo "$s[Urutan]"; ?>" value="<?php echo "$s[XKodeSoal]"; ?>"/>
                            <input type="text" id="txt_namax<?php echo "$s[Urutan]"; ?>" value="<?php echo "$soalez"; ?>"/> 
                            </span>  <span style="color: #ff0000;">*</span>
						</p>
						
                        <p><span class="asd">Jumlah Opsi Jawaban</span><span>: 
								<select id="txt_jawabx<?php echo "$s[Urutan]"; ?>">
								<option value= '<?php echo "$s[XJumPilihan]"; ?>' selected><?php echo "$s[XJumPilihan]"; ?></option>
									<option value= '5' >5</option>
									<option value='4' >4</option>
									<option value='3' >3</option>
								</select>
						<!--						
						<input size="2" type="text" id="txt_jawabx<?php echo "$s[Urutan]"; ?>" value="<?php echo "$s[XJumPilihan]"; ?>"/> * Default 5 Pilihan
                        !-->
						</span>
						</p>
                         <p><span class="asd">Jumlah Opsi Jawaban</span><span>:
							<select id="txt_jenisx<?php echo "$s[Urutan]"; ?>">
									<option value= '0' selected>Text</option>
									<option value='1'>Gambar</option>
								</select>
							</span>
						</p>
						<p><span class="asd" >Pilihan Ganda</span><span>: <input size="2" type="text" id="txt_jumsoalz1<?php echo "$s[Urutan]"; ?>" value="<?php echo "$s[XPilGanda]"; ?>"/> Jml yg ditampilkan
							</span>
						</p>     
							
						<p><span class="asd" >Bobot Pilihan </span><span>: <input size="2" type="text" id="txt_bobotsoalz1<?php echo "$s[Urutan]"; ?>" value="<?php echo "$s[XPersenPil]"; ?>"/> %
							</span>
						</p>
							
						<p><span class="asd">Esai</span><span>: <input size="2" type="text" id="txt_jumsoalz2<?php echo "$s[Urutan]"; ?>" value="<?php echo "$s[XEsai]"; ?>"/> Jml yg ditampilkan
							</span>
						</p>
							
						<p><span class="asd">Bobot Pilihan </span><span>: <input size="2" type="text" id="txt_bobotsoalz2<?php echo "$s[Urutan]"; ?>" value="<?php echo "$s[XPersenEsai]"; ?>"/> %
							</span>
						</p>  
						
                                                                             
                        </div>

                        
						<div style="width: 75%; float:left">
						<h4><font color="#FF0000">Keterangan: *</font></h4>
						<ul><li>Jangan ada SPASI, BISA menggunakan tanda sambung (-) </li>
						<li>Hindari Kode Bank Soal yang Terlalu Panjang </li>
						</ul>

                        </div>
                                      
        </div>
        
      </div>
      <!--
      <script>$("#cart").on('hide', function () {
        window.location.reload();
    });</script> -->
      <div class="modal-footer">
	  <div style="width: 15; float:left">
		<input type="submit"  class="btn btn-info" id="tambah<?php echo $s['Urutan']; ?>" value="Copy Bank Soal" name="tambah<?php echo $s['Urutan']; ?>">
                        </div>
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

                              <?php } ?>
                                   
                                </tbody>
                            </table>
							
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
			"scrollY": 200,
			"scrollX": true
		} );
	} );
   </script>
	 
   
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
    
 
<!-- Modal -->

				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				  <div class="modal-content">
					   
					  <div class="modal-body">
						
 <div id="mainbody" >
                <div class="panel panel-primary">
                        <div class="panel-heading">
                            Tambah Bank Soal 
                </div>
                 <form action="?modul=daftar_soal&tambah=yes" method="post">
                <div class="panel-body">
                    <table width="100%" border="0px">
                        <tr height="32px">
							<td width="30%">Kode Sekolah&nbsp;</td>
							<td>: &nbsp;
							<td><select class="form-control" name="txt_kodesekz">
							<option value='ALL' selected>SEMUA</option>
                                <?php 
                                $sqlsek = mysqli_query($GLOBALS["___mysqli_ston"], "select * from server_sekolah order by XServerId");
                                while($sek = mysqli_fetch_array($sqlsek))
								{echo "<option value='$sek[XServerId]'>$sek[XServerId] </option>"; }
                                ?>
								
								</select>
							<td>	</td>
						</tr>
						<tr height="32px">
							<td>Mata Pelajaran</td>
							<td>: &nbsp; 
							<td><select class="form-control" name="txt_mapelz">
                                <?php 
                                $sqlkelas = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_mapel order by XKodeMapel");
                                while($sk = mysqli_fetch_array($sqlkelas)){echo "<option value='$sk[XKodeMapel]'>$sk[XKodeMapel] - $sk[XNamaMapel]</option>";}
                                ?></select>
								<?php 
								//$sqladmin = mysql_query("select * from cbt_admin a left join cbt_kelas k on k.XLevelKelas = a.XTingkat");
								$sqladmin = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_admin");
								$sa = mysqli_fetch_array($sqladmin);
								$skul = $sa['XTingkat'];
								?> 
							</td><td>	</td>
						</tr>   
                        <tr height="32px">
							<td>Tingkat Sekolah&nbsp;</td>
							<td>: &nbsp;
							<td><select class="form-control" name="txt_levelz">
								                           
								<option value="SD" <?php if($skul=='SD'){echo "selected";} ?>>SD</option>
								<option value="MI" <?php if($skul=='MI'){echo "selected";} ?>>MI</option>                            
								<option value="SMP" <?php if($skul=='SMP'){echo "selected";} ?>>SMP</option>
								<option value="MTs" <?php if($skul=='MTs'){echo "selected";} ?>>MTs</option>                            
								<option value="SMA" <?php if($skul=='SMA'){echo "selected";} ?>>SMA</option>
								<option value="MA" <?php if($skul=='MA'){echo "selected";} ?>>MA</option>                            
								<option value="SMK" <?php if($skul=='SMK'){echo "selected";} ?>>SMK</option>                            
								</select>
                            </td><td>	</td>
						</tr>
                           
                        <tr height="32px"><td>Jurusan&nbsp;</td>
						   <td>: 
						   <td><select class="form-control" name="txt_jurusanz">
							<option value="ALL" selected>SEMUA</option>
                             <?php 
							 $sqljur = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeJurusan");
							  while($j = mysqli_fetch_array($sqljur))
							 {echo "<option value='$j[XKodeJurusan]' >$j[XKodeJurusan]</option>";}
							 ?></select>
							</td><td>	</td>
						</tr>

                        <tr height="32px">
							<td >Kelas&nbsp;
							</td>
							<td>: &nbsp;
							<td><select class="form-control" name="txt_kelasz">
								<option value='ALL' selected>SEMUA</option>
								<?php 
								$sqlkelas = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas group by XKodeKelas");
								while($k = mysqli_fetch_array($sqlkelas))
								{echo "<option value='$k[XKodeKelas]' selected>$k[XKodeKelas]</option>";}
								?>
								</select>
							</td><td>	</td>
						</tr>
						<tr height="32px">
							<td >Kode Bank Soal&nbsp;</td>
							<td>: &nbsp;
							<td><input class="form-control" type="text" name="txt_namaz"/>  <span style="color: #ff0000;"> </span></td>
							<td>	</td>
						</tr>
						
                        <tr height="32px">
							<td >Jumlah Opsi Jawaban&nbsp;
							</td>
							<td>: 	&nbsp;
							<td><select class="form-control" name="txt_jawabz">
									<option value= '5' selected>5</option>
									<option value='4'>4</option>
									<option value='3'>3</option>
								</select>
								
							<!--<input size="2" type="text" id="txt_jawabz"/> * Default 5 Pilihan !-->
                            </td><td>	</td>
						</tr>
						
                        <tr height="32px">
							<td >Jenis Soal&nbsp;
							</td>
							<td>: 	&nbsp;
							<td><select class="form-control" name="txt_jenisz">
									<option value= '0' selected>Text</option>
									<option value='1'>Gambar</option>
								</select>
								
							<!--<input size="2" type="text" id="txt_jawabz"/> * Default 5 Pilihan !-->
                            </td><td>	</td>
						</tr>
                        <tr height="32px">
							<td >Acak Soal&nbsp;
							</td>
							<td>: 	&nbsp;
							<td><select class="form-control" name="txt_acakz">
									<option value= 'Y' selected>Ya</option>
									<option value='N'>Tidak</option>
								</select>
								
							<!--<input size="2" type="text" id="txt_jawabz"/> * Default 5 Pilihan !-->
                            </td><td>	</td>
						</tr>
                        <tr height="32px">
							<td >Pilihan Ganda &nbsp;
							</td>
							<td>: &nbsp;
							<td><input  class="form-control" size="2" type="text" name="txt_jumsoal1z"/>  
                            </td>
						</tr>                            
						<tr height="32px">
							<td >Bobot Pilihan &nbsp;
							</td>
							<td>: &nbsp;
							<td><input  class="form-control" size="2" type="text" name="txt_bobotsoal1z"/>  
                            </td><td>&nbsp;&nbsp;%</td>
						</tr>                            
                        <tr height="32px">
							<td >Essai &nbsp;
							</td>
							<td>: &nbsp;
							<td><input  class="form-control" size="2" type="text" name="txt_jumsoal2z"/>  
                            </td>
						</tr>                            
                        <tr height="32px">
							<td >Bobot Essai &nbsp;
							</td>
							<td>: &nbsp;
							<td><input  class="form-control" size="2" type="text" name="txt_bobotsoal2z"/> 
                            </td><td> &nbsp;&nbsp;%	</td>
						</tr> 
										
                    </table>
                </div>
				  </div>

                 <div class="modal-footer">
              <button type="submit"  class="btn green">Buat</button>
              <button type="button" class="btn dark btn-outline" data-dismiss="modal">Keluar</button>
                </div> 
                </form>  
				</div>
			</div>
		</div>






<script>
	$('#myModal').on('shown.bs.modal', function () {
	  $('#myInput').focus()
	})
	$('#myModal').on('hidden.bs.modal', function () {
	  document.location.reload();
	 // alert("tes");
	})
	
	$('#confirmModal').on('hidden.bs.modal', function () {
	  document.location.reload();
	  //alert("hapus");
	})
</script>
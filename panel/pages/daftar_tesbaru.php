<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	
?>



<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="jquery-1.4.js"></script>
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
 <?php 
 $tgljam = date("Y/m/d H:i");  
 $tgl = date("Y/m/d"); 
 
 ?>
  <link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
<style type="text/css">

.custom-date-style {
	background-color: red !important;
}

.input{	
}
.input-wide{
	width: 500px;
}

</style>


<script src="date/jquery.js"></script>
<script src="jquery.datetimepicker.full.js"></script>
<?php 
$tgx = 29;
$blx = 9;
$thx = 2016;

$tglx = date("Y/m/d");
$jamx = date("H:i:s");
?>
<div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Set Aktivasi Ujian
                                    </div>
                                </div>
                                <div class="actions"></div>
                        
                        <div class="portlet-body">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="6%">No.</th>
                                        <th width="20%">Kode Bank Soal</th>
                                        <th width="25%">Mata Pelajaran</th>
                                        <th width="8%">Soal</th>    
                                        <th width="8%">Kelas</th>
                                        <th width="15%">Waktu</th>                                                                             
                                        <th width="8%">Sesi</th>                                                                            
                                        <th width="8%">Status</th>  
                                        <th width="8%">Jadwal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
$no=0;
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select p.*,m.*,p.Urut as Urutan,p.XKodeKelas  as kokel from cbt_paketsoal p left join cbt_mapel m on m.XKodeMapel = p.XKodeMapel where p.XStatusSoal='Y' order by p.Urut desc");
//$sql = mysql_query("select u.*,m.*,u.Urut as Urutan,u.XKodeKelas as kokel from cbt_ujian u left join cbt_mapel m on m.XKodeMapel = u.XKodeMapel left join cbt_paketsoal p on p.XKodeSoal = u.XKodeSoal where u.XStatusUjian='1'");

                    while($s = mysqli_fetch_array($sql)){ 
                    $sqlsoal = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_soal where XKodeSoal = '$s[XKodeSoal]'"));
                    $sqlpakai = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_siswa_ujian where XKodeSoal = '$s[XKodeSoal]' and XStatusUjian = '1'"));
                    $sqlsudah = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_jawaban where XKodeSoal = '$s[XKodeSoal]'"));
                    if($sqlsoal<1){$kata="disabled";}  else {$kata="";} 
                    if($sqlsudah>0||$sqlpakai>0){$kata="disabled";}  else {$kata="";}           
                    if($sqlpakai>0){$katapakai="disabled";}  else {$katapakai="";}          
                            
                                
$sqltes = mysqli_query($GLOBALS["___mysqli_ston"], "select XJamUjian,XTglUjian,XStatusUjian,XSesi,XTampil from cbt_ujian where XKodeSoal = '$s[XKodeSoal]' and  XKodeMapel = '$s[XKodeMapel]' and  XKodeJurusan = '$s[XKodeJurusan]' and  XKodeKelas = '$s[kokel]' and XStatusUjian='1'");      
 $stu = mysqli_fetch_array($sqltes);
 $tjamujian = $stu['XJamUjian'];
 $ttglujian = $stu['XTglUjian'];
 $sttsujian = $stu['XStatusUjian'];
 $no++
                                ?>
                                
                                    <tr class="odd gradeX">
                                        <td align="center"><input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"><?php echo $no; ?></td>
                                        <td align="center"><?php echo $s['XKodeSoal']; ?></td>
                                        <td align="center"><?php echo  $s['XNamaMapel']." - ".$s['XKodeMapel']; ?></td>
                                        <td align="center"><?php echo "$sqlsoal (". $s['XJumPilihan']." opsi)"; ?></td>                                           
                                        <td align="center"><?php echo $s['kokel']."-".$s['XKodeJurusan']; ?></td> 
                                        <td align="center"><?php echo "$ttglujian $tjamujian"; ?></td>
                                        <td align="center">
                                       
                                        <?php echo "$stu[XSesi]"; ?>
                                        </td>
                                        <td align="center">                                                 
                                        <?php if($sttsujian=="1"){ ?>
                                        <input type="button" id="simpan<?php echo $s['Urutan']; ?>" class="btn btn-success" value="Dikerjakan"  disabled>
                                        <?php } else { ?>
                                        <input type="button" id="simpan<?php echo $s['Urutan']; ?>" class="btn btn-default" value="Matikan">                                        <?php } ?>
                                        </td>     
                                        
                                        <td align="center">
                                         <a href="?modul=edit_tes&idtes=<?php echo $s['Urutan']; ?>">
                                       <button type="button" class="btn btn-info btn-small">
                                        <i class="fa fa-clock-o  ">&nbsp;Set</i></button></a>
                            
                                      
                                        </td>     
                                                                                                              
                                    </tr>

<script>    
$(document).ready(function(){
$("#simpan<?php echo $s['Urutan']; ?>").click(function(){
//alert("<?php echo $s['Urutan']; ?>");
 var txt_ujian = $("#txt_ujian").val();
 var txt_jawab = $("#txt_jawab").val();
 var txt_acak = $("#switch_left").val();
 var txt_durasi = $("#txt_durasi").val();
 var txt_telat = $("#txt_telat").val();
 var txt_soal = $("#txt_soal").val();  
 var txt_mapel = $("#txt_mapel<?php echo $s['Urutan']; ?>").val();
 var txt_level = $("#txt_level").val(); 
 var txt_nama = $("#txt_nama").val();  
 var txt_sesi = $("#txt_sesi").val();    
 
 
 $.ajax({
     type:"POST",
     url:"simpan_soal.php",    
     data: "aksi=simpan&txt_ujian=" + txt_ujian + "&txt_jawab=" + txt_jawab + "&txt_acak=" + txt_acak + "&txt_telat=" + txt_telat + "&txt_durasi=" + txt_durasi + "&txt_soal=" + txt_soal + "&txt_level=" + txt_level + "&txt_mapel=" + txt_mapel + "&txt_nama=" + txt_nama + "&txt_sesi=" + txt_sesi,
     success: function(data){
        if( $("#simpan<?php echo $s['Urutan']; ?>").hasClass( "btn-success" ) )
        {
         $("#simpan<?php echo $s['Urutan']; ?>").removeClass("btn-success").addClass("btn-default");
         $("#simpan<?php echo $s['Urutan']; ?>").val("Aktif");
        } else {        
         $("#simpan<?php echo $s['Urutan']; ?>").removeClass("btn-info").addClass("btn-success");
         $("#simpan<?php echo $s['Urutan']; ?>").val("Matikan");         

        }
      document.location.reload();
        loading.fadeOut();
        tampilkan.html(data);
        tampilkan.fadeIn(100);
     tampildata();
     }
     });
     });
});
</script>
                    <?php } ;?>
                                            </tbody>
                                        </table>
 <div class="well">
                        <h4><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT</span></h4>
                        <ul><li><font color="#FF0033">Bank Soal Yang dipakai Seluruh Kelas dan Jurusan harus berdiri sendiri. TIDAK BOLEH AKTIF dengan Bank Soal lain</font></li>
                        <li>Beberapa ujian (untuk Kelas dan Jurusan berbeda) bisa di setting waktu bersamaan. </li>
                        <li>Apabila Satu kelas ada beberapa Tes bersamaan (untuk kelas dan jurusan yang sama). 
                            Akan mengakibatkan Peserta tidak dapat mengikuti Ujian (* Terlambat mengikuti Ujian)</li>
                        <li>Daftar diatas merupakan Paket Soal yang sudah diaktifkan oleh Guru. Silahkan melakukan pengaturan Jadwal ujian (Klik tombol 'Set' pada Menu Jadwal)</li>
                        <li><font color="#FF0033">Hapus&BackUp database soal-jawab tiap sesi setelah Ujian dan administrasi selesai supaya kerja <b>SERVER TIDAK BERAT/LAMBAT</b></font></li>
                        </ul>
                    </div>
                                </div>                      
</div>
</div>
    
<script>
function myFunction() {
   document.location.reload();
}
</script>
 <!-- BEGIN CORE PLUGINS -->
        <script src="../../assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="../../assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
		   
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
<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
include "../../config/server.php";
if(isset($_REQUEST['aksi'])){
//echo "delete from cbt_waktu where Urut = '$_REQUEST[urut]'";
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "delete from cbt_ujian where Urut = '$_REQUEST[urut]'");
}


if(isset($_REQUEST['simpan'])){
	$sql = mysqli_query($GLOBALS["___mysqli_ston"], "update cbt_ujian set XTokenUjian = '$_REQUEST[txt_token]', XKodeUjian = '$_REQUEST[txt_koduji]', XKodeKelas = '$_REQUEST[txt_kodkel]', XKodeJurusan = '$_REQUEST[txt_jur]',
	XSesi = '$_REQUEST[txt_sesi]', XKodeSoal = '$_REQUEST[txt_kodsoal]', XTglUjian = '$_REQUEST[txt_tuji]', XJamUjian = '$_REQUEST[txt_juji]', 
	XLamaUjian = '$_REQUEST[txt_durasi]', XBatasMasuk = '$_REQUEST[txt_bmasuk]', XTampil = '$_REQUEST[txt_hasil]', XStatusToken = '$_REQUEST[txt_statustoken]', XStatusUjian = '$_REQUEST[txt_suji]' where Urut = '$_REQUEST[id]'");
}

if(isset($_REQUEST['tambah'])){

$sqlcek = mysqli_num_rows(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_kelas where XKodeKelas = '$_REQUEST[txt_kodkel]'"));
	if($sqlcek>0){
	$message = "Kode Kelas SUDAH ADA";
	echo "<script type='text/javascript'>alert('$message');</script>";
	} else {
		if(!$_REQUEST['txt_kodkel']==""||!$_REQUEST['txt_jur']==""){
		$sql = mysqli_query($GLOBALS["___mysqli_ston"], "insert into cbt_kelas (XKodeLevel, XNamaKelas, XKodeJurusan,XKodeKelas, XKodeSekolah) values  
		('$_REQUEST[txt_kodlev]','$_REQUEST[txt_namkel]','$_REQUEST[txt_jur]','$_REQUEST[txt_kodkel]','$_REQUEST[txt_kodesek]')");
		}
	}
}



?>
<?php 
$tgx = 01;
$blx = 01;
$thx = 2012;

$tglx = date("Y/m/d");
$jamx = date("H:i:s");
?>


           <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        Daftar Jadwal Ujian
                                    </div>
								</div>
<?php echo "</a>";?> 
                           
                        
                        <!-- /.panel-heading -->
                        <div class="portlet-body">
                            <table id="example" class="display nowrap" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
	                                    <th width="5%">No</th>
										<th width="8%">Kode Ujian</th>
                                        <th width="15%">Kelas</th>
                                        <th width="30%">Kode Mapel</th>                                           
                                                                               
                                        <th width="30%">Kode Soal</th>   
                                         <th width="15%">Tgl Ujian</th> 
                                          
                                         	
                                          <th width="15%">Token</th>										 
                                        <th width="15%">Edit|Haps</th>  
                                 </tr>
                                </thead>
                                <tbody>
<?php 
$no=0;
/*/
$sql = mysql_query("select u.*,m.*,u.Urut as Urut,u.XKodeKelas as kokel from cbt_ujian u left join cbt_mapel m on m.XKodeMapel = u.XKodeMapel 
left join cbt_paketsoal p on p.XKodeSoal = u.XKodeSoal where u.XStatusUjian='1'");
/*/
$sql = mysqli_query($GLOBALS["___mysqli_ston"], "select u.*,m.*,u.Urut as Urut,u.XKodeKelas as kokel from cbt_ujian u left join cbt_mapel m on m.XKodeMapel = u.XKodeMapel 
left join cbt_paketsoal p on p.XKodeSoal = u.XKodeSoal ");
					while($s = mysqli_fetch_array($sql)){ 
					
$time1 = "$s[XJamUjian]";
$time2 = "$s[XLamaUjian]";

$secs = strtotime($time2)-strtotime("00:00:00");
$jamhabis = date("H:i:s",strtotime($time1)+$secs);	
$sekarang = date("H:i:s");	
$tglsekarang = date("Y-m-d");	
$tglujian = "$s[XTglUjian]";	
$no++;		
								if($s['XStatusUjian']=="0"||$s['XStatusUjian']=="9"||$tglsekarang>$tglujian||$sekarang > $jamhabis){ 
										$status="Selesai dikerjakan";
										} 
										else if($tglsekarang==$tglujian&&$sekarang < $time1){
										$status="Akan dikerjakan";
										} else { 
										$status="Sedang dikerjakan";
								}
								?>
                                
                                    <tr class="odd gradeX">
                                        <td align="center"><input type="hidden" value="<?php echo $s['Urutan']; ?>" id="txt_mapel<?php echo $s['Urutan']; ?>"> <?php echo $no; ?></td>
											<input type="hidden" value="<?php echo $s['XKodeSoal']; ?>" id="txt_soal<?php echo $s['Urutan']; ?>">
										<td align="center"><?php echo $s['XKodeUjian']; ?></td>
                                        <td align="center"><?php echo $s['kokel']." - ".$s['XKodeJurusan'] ?></td> 
                                        <td align="center"><?php echo $s['XKodeMapel']." - ".$s['XNamaMapel']; ?></td>
                                        
                                        <td align="center"><?php echo $s['XKodeSoal']; ?></td>
                                        <td align="center"><?php echo $s['XTglUjian']; ?></td> 
										
										
                                        <td align="center"><?php echo $s['XTokenUjian']; ?></td>						 
										<td align="center">	<?php 
											echo "	<a href='#myModal' id='custId' data-toggle='modal' data-id=".$s['Urut'].">"; ?>
													<button type="button" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button></a>
                                            
													<a href="?modul=daftar_waktu_db&aksi=hapus&urut=<?php echo $s['Urut']; ?>">
													<button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash-o "></i></button></a></td>  
                                                                                                                          
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
                            <div class="well">
                                <h4><span style="color: #1B06CF;"><?php echo $skull; ?>-CBT</span></h4>
                                <p><b>Fitur DataBase Ujian :</b> Edit, Hapus & Aktifkan ujian yang pernah terpakai tanpa aktifkan Bank Soal selama BankSoal masih ada (belum dihapus) juga untuk Hapus DataBase yang tidak terpakai (Bank Soal telah dihapus). 
								<br><b>PENTING: </b>Hati-hati menggunakan Fitur Hapus di sini, karena akan menghapus database cbt_ujian (database ujian). Backup dahulu Sebelum Hapus
								dan pastikan semua ujian sudah selesai dan data tidak terpakai lagi. Menghapus sebelum selesai hari ujian akan menyebabkan analisa tidak bisa didownload walau bank soal belum dihapus. 
								Download dan cetak dulu analisa hasil ujian baru database boleh dihapus bila sudah tidak terpakai.</p><p>
                                </p>
                            </div>
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
    
<div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Jadwal dan Data Ujian</h4>
                </div>
                <div class="modal-body">
                    <div class="fetched-data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
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
                url : 'edit_waktu.php',
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
                url : 'tambah_kelas.php',
                data :  'urut='+ rowid,
                success : function(data){
                $('.fetched-data2').html(data);//menampilkan data ke dalam modal
                }
            });
         });
		 
    });
  </script>
 
</body>

</html>

 
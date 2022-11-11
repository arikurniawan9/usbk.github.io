<?php
    if(!isset($_COOKIE['beeuser'])){
    header("Location: login.php");}
?>


<script type="text/javascript" src="../js/jquery.js"></script>
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
<body>
<?php 
if(!empty($_REQUEST['datax'])&&$_REQUEST['datax']=="ujian"){include "../../database/cbt_ujian.php";}
if(!empty($_REQUEST['datax'])&&$_REQUEST['datax']=="siswa"){include "../../database/cbt_siswa.php";}
if(!empty($_REQUEST['datax'])&&$_REQUEST['datax']=="media"){include "../../database/cbt_media.php";}
if(!empty($_REQUEST['datax'])&&$_REQUEST['datax']=="semua"){include "../../database/cbt_semua.php";}
if(!empty($_REQUEST['datax'])&&$_REQUEST['datax']=="hasil"){include "../../database/cbt_hasil_ujian.php";}
?>
<?php include "../../config/server.php"; ?>
            
            <!-- /.row -->
            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                    Backup & Hapus
                                    </div>
                                </div>
            
                    <div class="portlet-body">

                    <div class="alert alert-info" >
                                Sebelum melakukan <b>HAPUS</b> silahkan lakukan <b>BACKUP</b> terlebih dahulu karena Akan menghapus seluruh database pada VHD. 
                                <br>Lokasi file Backup dapat dicopy melalui aplikasi Windows Explorer dengan mengetikan <b>\\192.168.0.200\CBT-Backup\<?php echo $db_server;?>\</b>
                            </div>                              
                        
                                    <div class="actions" style="width:19%; float:left;">
                                    <a href="?modul=backup_data&datax=semua&aksi=1">
                                    <button type="button" class="btn green" ><i class=""></i>&nbsp;Backup</button>
                                    </a>
                                    </div>&nbsp;&nbsp;
                                    <div class="actions" style="width: 9%; float:right;">
                                    <a href="?modul=backup_data&datax=semua&aksi=2">
                                    <button type="button" class="btn btn-danger" ><i class=""></i>&nbsp;Hapus</button>
                                    </a>
                                    </div>&nbsp;&nbsp;
                  
                            <!-- /.table-responsive -->
                           
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
 
 
           
    

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
    
 

    </div>
</body>


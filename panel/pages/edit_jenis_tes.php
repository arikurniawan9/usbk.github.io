<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

include "../../config/server.php";
	$xadm = mysqli_fetch_array(mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_admin"));
	$skul_tkt= $xadm['XTingkat']; 
	if ($skul_tkt=="SMA" || $skul_tkt=="MA"||$skul_tkt=="STM"){$rombel="Jurusan";}else{$rombel="Rombel";}

    if($_REQUEST['urut']) {
        $id = $_POST['urut'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_tes WHERE Urut = '$id'");
        $r = mysqli_fetch_array($sql);
        ?>
 
        <!-- MEMBUAT FORM -->
        <form action="?modul=daftar_jenis_tes&simpan=yes" method="post">
            <input type="hidden" name="id" value="<?php echo $r['Urut']; ?>">
			<p>
            <div class="form-group">
                <label>Kode Tes</label>
                <input type="text" class="form-control" name="txt_kodlev" value="<?php echo $r['XKodeUjian']; ?>">
            </div>

            <div class="form-group">
                <label>Nama Tes</label>
                <input type="text" class="form-control" name="txt_namkel" value="<?php echo $r['XNamaUjian']; ?>">
            </div>

                <div class="modal-footer">
              <button class="btn green" type="submit">Update</button>
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Keluar</button>
                </div>
        </form>
 
        <?php } 
?>
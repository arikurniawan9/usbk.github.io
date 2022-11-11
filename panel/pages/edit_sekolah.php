<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<?php
include "../../config/server.php";
    if($_REQUEST['urut']) {
        $id = $_POST['urut'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM server_sekolah WHERE Urut = '$id'");
        $r = mysqli_fetch_array($sql);
        ?>
 
        <!-- MEMBUAT FORM -->
        <form action="?modul=data_skul&simpan=yes" method="post">
            <input type="hidden" name="urut" value="<?php echo $r['Urut']; ?>">
            <div class="form-group">
                <label>Kode Sekolah</label>
                <input type="text" class="form-control" name="txt_kodsek" value="<?php echo $r['XServerId']; ?>">
            </div>

            <div class="form-group">
                <label>Nama Sekolah</label>
                <input type="text" class="form-control" name="txt_namsek" value="<?php echo $r['XSekolah']; ?>">
            </div>
            <div class="form-group">
                <label>Alamat Sekolah</label>
                <input type="text" class="form-control" name="txt_alsek" value="<?php echo $r['XAlamatSek']; ?>">
            </div>
            <div class="form-group">
                <label>Server Dibuka</label>
                <input type="text" class="form-control" name="txt_mulai" value="<?php echo $r['XMulai']; ?>">
            </div>
            <div class="form-group">
                <label>Server Ditutup</label>
                <input type="text" class="form-control" name="txt_selesai" value="<?php echo $r['XSelesai']; ?>">
            </div>

              
                <div class="modal-footer">
            
              <button class="btn green" type="submit">Update</button>
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Keluar</button>
                </div>
        </form>
 
        <?php } 
?>
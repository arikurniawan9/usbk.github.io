<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

	include "../../config/server.php";
    if($_REQUEST['urut']) {
        $id = $_POST['urut'];
        // mengambil data berdasarkan id
        // dan menampilkan data ke dalam form modal bootstrap
        $sql = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_ujian WHERE Urut = '$id'");
        $r = mysqli_fetch_array($sql);
		$nilai = $r['XTampil'];
		if ($nilai=='1') {$t="Tampil";}else{$t="Tidak";}
		$statustoken = $r['XStatusToken'];
		if ($statustoken=='1') {$tt="Tampil";}else{$tt="Tidak";}
		$statusujian = $r['XStatusUjian'];
		if ($statusujian=='1') {$tu="Sedang ujian";}else{$tu="Selesai Ujian";}
		$xpdf = $r['XPdf'];
		if ($xpdf=='1') {$pdf="Soal PDF";}else{$pdf="Bukan PDF";}
		$listen = $r['XListening'];
		if ($listen=='1') {$listenx="Sekali";}elseif($listen=='2'){$listenx="Dua Kali";}elseif($listen=='3'){$listenx="Terusan";}
        ?>

		
		
		
        <!-- MEMBUAT FORM -->
        <form action="?modul=daftar_waktu&simpan=yes" method="post">
		
            <input type="hidden" name="id" value="<?php echo $r['Urut']; ?>">
			<div class="row">
			<div class="col-md-6">
			<div class="form-group">
                <label>KODE SOAL</label>
                <input type="text" class="form-control" name="txt_kodsoal" value="<?php echo $r['XKodeSoal']; ?>">
            </div>
			</div>
			<div class="col-md-6">
			<div class="form-group">
                <label>Listening</label>
            			<select class="form-control" name="txt_listen" id="txt_listen"> 
						
							<option value="<?php echo $listen;?>"><?php echo $listenx;?></option>						
                            <option value="1">Sekali</option>
                            <option value="2">Dua Kali</option>  
                            <option value="3">Terusan</option>
                        </select>
			</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
			<div class="form-group">
                <label>SOAL PDF</label>
            			<select class="form-control" name="txt_xpdf" id="txt_xpdf"> 
						
							<option value="<?php echo $xpdf;?>" selected><?php echo $pdf;?></option>						
                            <option value="1">Soal PDF</option>
                            <option value="0">Bukan PDF</option>  
                            
                        </select>
			</div>
			</div>
		    <div class="col-md-6">
			<div class="form-group">
                <label>File PDF</label>
                <input type="text" class="form-control" name="txt_filepdf" value="<?php echo $r['XFilePdf']; ?>">
            </div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
			 <div class="form-group">
                <label>NILAI TAMPIL</label>
            			<select class="form-control" name="txt_hasil" id="txt_hasil"> 
						
							<option value="<?php echo $nilai;?>" selected><?php echo $t;?></option>						
                            <option value="1">Tampil</option>
                            <option value="0">Tidak</option>  
                            
                        </select>
			</div>
			</div>
		    <div class="col-md-6">
			<div class="form-group">
                <label>TOKEN TAMPIL</label>
            			<select class="form-control" name="txt_statustoken" id="txt_statustoken">    
							<option value="<?php echo $statustoken;?>" selected><?php echo $tt;?></option>							
                            <option value="1">Tampil</option>
                            <option value="0">Tidak</option>   
                            
                        </select>
			</div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
			<div class="form-group">
                <label>STATUS SOAL</label>
            			<select class="form-control" name="txt_suji" id="txt_suji""> 
							<option value="<?php echo $statusujian;?>" selected><?php echo $tu;?></option>
                            <option value="1">Sedang Ujian</option>
                            <option value="9">Selesai Ujian</option>  
                            
                        </select>
			</div>
			</div>
		    <div class="col-md-6">
			<div class="form-group">
                <label>KODE KELAS &nbsp;&nbsp;( Harus sesuai template Excel Kelas kolom "B" )</label>
                <input type="text" class="form-control" name="txt_kodkel" value="<?php echo $r['XKodeKelas']; ?>">
            </div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
            <div class="form-group">
                <label>KODE JURUSAN &nbsp; Harus sesuai template Excel Kelas kolom "D" )</label>
                <input type="text" class="form-control" name="txt_jur" value="<?php echo $r['XKodeJurusan']; ?>">
            </div>
            </div>
		    <div class="col-md-6">
			<div class="form-group">
                <label>KODE JENIS UJIAN &nbsp;&nbsp;( UH, UTS, UAS TO1 s/d TO5 )</label>
                <input type="text" class="form-control" name="txt_koduji" value="<?php echo $r['XKodeUjian']; ?>">
            </div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
			<div class="form-group">
                <label>SESI UJIAN</label>
                <input type="text" class="form-control" name="txt_sesi" value="<?php echo $r['XSesi']; ?>">
            </div>
            </div>
		    <div class="col-md-6">
			<div class="form-group">
                <label>TANGGAL UJIAN &nbsp;&nbsp;( Thn-Bln-Hr )</label>
                <input type="text" class="form-control" name="txt_tuji" value="<?php echo $r['XTglUjian']; ?>">
            </div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
			<div class="form-group">
                <label>JAM MULAI &nbsp;&nbsp;( jj:mm:dd )</label>
                <input type="text" class="form-control" name="txt_juji" value="<?php echo $r['XJamUjian']; ?>">
            </div>
			</div>
		   <div class="col-md-6">
			<div class="form-group">
                <label>DURASI &nbsp;&nbsp;( jj:mm:dd )</label>
                <input type="text" class="form-control" name="txt_durasi" value="<?php echo $r['XLamaUjian']; ?>">
            </div>
			</div>
			</div>
			<div class="row">
			<div class="col-md-6">
			<div class="form-group">
                <label>UJIAN DITUTUP &nbsp;&nbsp;(jj:mm:dd)</label>
                <input type="text" class="form-control" name="txt_bmasuk" value="<?php echo $r['XBatasMasuk']; ?>">
			</div>
           </div>
		   <div class="col-md-6">
			<div class="form-group">
                <label>TOKEN</label>
                <input type="text" class="form-control" name="txt_token" value="<?php echo $r['XTokenUjian']; ?>">
			</div>
			</div>
			</div>
			<div class="modal-footer">
            <button class="btn dark btn-outline" type="button" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn green" type="submit">Update</button>
            </div>
			
              
        </form>
	<?php } ?>	
		

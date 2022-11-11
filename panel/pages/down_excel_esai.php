<?php
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}

require_once 'PHPExcel.php';
include "../../config/server.php"; 

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

//$var_soal = "$_REQUEST[ujian]";

$hasil = mysqli_query($GLOBALS["___mysqli_ston"], "SELECT * FROM cbt_jawaban where XJenisUjan='2'");

// Set properties
$objPHPExcel->getProperties()->setCreator("Ginanjar Restu U., S.Pd.")
      ->setLastModifiedBy("Ginanjar Restu U., S.Pd.")
      ->setTitle("CBTSync - Rekap Jawaban Esai")
      ->setSubject("Computer Based Test")
       ->setDescription("Data Rekap Esai")
       ->setKeywords("office 2007 openxml php")
       ->setCategory("Daftar Jawaban Esai :")
	   ;
 
// Add some data
$objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A1:A2')  	
       	->mergeCells('B1:B2')
       	->mergeCells('C1:C2')
		->mergeCells('D1:D2')
		->mergeCells('E1:E2')
       	->mergeCells('H1:H2')
       	->mergeCells('I1:I2')
       	->mergeCells('K1:K2')
       	->mergeCells('L1:L2')
       	->mergeCells('M1:M2')
       	->mergeCells('N1:N2')
       	->mergeCells('O1:O2')
       	
		
       	->setCellValue('A1', 'Nomor')
       	->setCellValue('B1', 'Kode Kelas')
       	->setCellValue('C1', 'Rombel:Jurusan')
       	->setCellValue('D1', 'Kode Mapel')
       	->setCellValue('E1', 'Kode Soal')
       	->setCellValue('F1', 'Token')
       	->setCellValue('G1', 'Jawab ')
		->setCellValue('H1', 'KELAMIN')
       	->setCellValue('I1', 'PASSOWRD')
       	->setCellValue('J1', 'JURUSAN')
       	->setCellValue('K1', 'FOTO')
       	->setCellValue('L1', 'AGAMA')
       	->setCellValue('M1', 'PILIHAN')
       	->setCellValue('N1', 'KODE SEKOLAH')
       	->setCellValue('O1', 'NAMA KELAS')
		;
       
$baris = 3;
$no = 0;		

while($p = mysqli_fetch_array($hasil)){
//----- php excel 

$no = $no +1;
$objPHPExcel->setActiveSheetIndex(0)
     	->setCellValue("A$baris", $p['XNomerUjian'])
     	->setCellValue("B$baris", $p['XNamaSiswa'])
     	->setCellValue("C$baris", $p['XNIK'])
     	->setCellValue("D$baris", $p['XSesi'])
     	->setCellValue("E$baris", $p['XRuang'])
     	->setCellValue("F$baris", $p['XKodeLevel'])
     	->setCellValue("G$baris", $p['XKodeKelas'])
     	->setCellValue("H$baris", $p['XJenisKelamin'])
     	->setCellValue("I$baris", $p['XPassword'])
     	->setCellValue("J$baris", $p['XKodeJurusan'])
     	->setCellValue("K$baris", $p['XFoto'])
     	->setCellValue("L$baris", $p['XAgama'])
     	->setCellValue("M$baris", $p['XPilihan'])
     	->setCellValue("N$baris", $p['XKodeSekolah'])
     	->setCellValue("O$baris", $p['XNamaKelas'])
		;

$baris = $baris + 1;
}
 
// Rename sheet
$objPHPExcel->getActiveSheet()->setTitle('transaksi');
 
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client�s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="Excel-Siswa.xls"');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
?>
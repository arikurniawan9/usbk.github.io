<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
	
?>
<html>
<head>
<title><?php echo $skull; ?>-CBT | Administrator</title>
<link rel="stylesheet" href="cetak.min.css">
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="jquery.qrcode-0.12.0.min.js"></script>
<script type="text/javascript" src="jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="jquery.gdocsviewer.min.js"></script> 

<script type="text/javascript"> 
/*<![CDATA[*/
$(document).ready(function() {
	$('a.embed').gdocsViewer({width: 600, height: 700});
	$('#embedURL').gdocsViewer();
});
/*]]>*/
</script> 
</head>
<body>
<iframe src="<?php echo "cetakberita.php?token=$_REQUEST[token]"; ?>" style="display:none;" name="frame"></iframe>
<?php echo "Cetak Berita Acara    "; ?>
<button type="button" class="btn btn-default btn-sm" onClick="frames['frame'].print()" style="margin-top:4px; margin-bottom:5px"><i class="glyphicon glyphicon-print"></i> Print </button>
	<a href="?modul=berita_acara">
		<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px"><i class="fa fa-arrow-circle-left"></i> Kembali ke Cetak Berita Acara</i></button>
			
	</a>	
	<a href="?">
		<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px"><i class="fa fa-home fa-fw"></i> Dashboard</i></button>
	</a>	

	<div class="">
		<iframe src="<?php echo "cetakberita.php?token=$_REQUEST[token]"; ?>" style="display:yes;" name="frame" scrolling="auto" width="100%" height="500px" frameborder="0"></iframe>
	</div>

</body>
</html>
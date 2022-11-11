<?php
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

<div class="portlet light ">
	    <div class="portlet-title">
			 <div class="caption">
			 <i class="fa fa-print"></i> | Kartu Peserta
			 </div>
			<div class="actions">
			
			<button type="button" class="btn btn-danger btn-sm" onClick="frames['frame'].print()" style="margin-top:3px; margin-bottom:4px">
				<i class="glyphicon glyphicon-print"></i> Print
			</button>

			<a href="#" data-toggle="modal" data-target="#myCetakKartu">
				<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px">
					<i class="fa fa-search"></i> Print Kartu Ujian Lain</i>
				</button>
			</a>	
			
			<a href="?">
				<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px">
					<i class="fa fa-home fa-fw"></i> Dashboard</i>
				</button>
			</a>
			</div>
		</div>

	<div class="">
		<iframe src="<?php echo "print_kartu.php?kelas=$_REQUEST[iki2]&jur=$_REQUEST[jur2]"; ?>" style="display:yes;" name="frame" scrolling="auto" width="100%" height="700px" frameborder="0"></iframe> </div>
</div>
</div>   
</body>
</html>
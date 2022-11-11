<?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	if(!isset($_COOKIE['beeuser'])){
	header("Location: login.php");}
?>
<html>
<head>
<title><?php echo $skull; ?>-CBT | Administrator</title>
<link rel="stylesheet" href="cetak.min.css">
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="jquery.qrcode-0.12.0.min.js"></script>
<script type="text/javascript" src="jquery.scrollbar.min.js"></script>
<script type="text/javascript" src="jquery-1.4.js"></script>
<script src="date/jquery.js"></script>
<script src="jquery.datetimepicker.full.js"></script>
<script type="text/javascript" src="jquery.gdocsviewer.min.js"></script> 


<script type="text/javascript" src="jquery-1.4.js"></script>
<style>@media print {
    footer {page-break-after: always;}
}
</style>

</head>

<body>
<div class="portlet light ">
	<div class="portlet-title">
		 <div class="caption">
		 <i class="fa fa-print"></i> | Cetak Daftar Nilai TryOut
		 </div>
		 <div class="actions">
		 
		 <button type="button" class="btn btn-danger btn-sm" onClick="frames['frame'].print()" style="margin-top:5px; margin-bottom:5px">
			<i class="fa fa-print"></i> Print 
		 </button> 
		<a href="#" data-toggle="modal" data-target="#myCetakTO">
				<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px">
					<i class="fa fa-search"></i> Print Nilai Try Out Lain</i>
				</button>
		</a>	
		<a href="?">
				<button type="button" class="btn btn-success btn-sm" style="margin-top:5px; margin-bottom:5px">
					<i class="fa fa-home fa-fw"></i> Dashboard</i>
				</button>
		</a>
		 
		<a class="btn btn-dark btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title=""> </a>
		</div>
	</div>
	
	<div class="">
		<iframe src="<?php echo "cetaknilaiTO.php?kelz=$_REQUEST[iki3]&jurz=$_REQUEST[jur3]&mapz=$_REQUEST[map3]&semz=$_REQUEST[sem3]"; ?>" style="display:yes;" name="frame" scrolling="auto" width="100%" height="550px" frameborder="2"></iframe>
	</div>
</div>
   
</body>
</html>
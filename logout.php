<?php 
include "config/server.php"; 
// ===============================
// Status Ujian XStatusUjian = 1 Aktif
// Status Ujian XStatusUjian = 0 BelumAktif
// Status Ujian XStatusUjian = 9 Selesai

$tgl = date("H:i:s");
$tgl2 = date("Y-m-d");
if(isset($_COOKIE['PESERTA'])){
$user = $_COOKIE['PESERTA'];

  $sqlgabung = mysqli_query($GLOBALS["___mysqli_ston"], "
SELECT * FROM `cbt_siswa_ujian` s LEFT JOIN cbt_jawaban j ON j.XUserJawab = s.XNomerUjian and j.XTokenUjian = s.XTokenUjian WHERE XNomerUjian = '$user' and s.XStatusUjian = '1'
  ");
  


}

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $user = trim($parts[0]);
        setcookie($user, '', time()-1000);
        setcookie($user, '', time()-1000, '/');
		setcookie("user", '', time()-1000);
		setcookie("apl", '', time()-1000);		
    	unset($_COOKIE['user']);
    	setcookie('user', '', time() - 3600, '/'); // empty value and old timestamp

    }
}


header('location:index.php');

?>
<!DOCTYPE html>
<html class="no-js" lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title><?php echo $skull;?>  | UJIAN ONLINE</title>
    
	<script language="JavaScript">
	var txt="<?php echo $skull;?>  | UJIAN ONLINE......";
	var kecepatan=100;var segarkan=null;function bergerak() { document.title=txt;
	txt=txt.substring(1,txt.length)+txt.charAt(0);
	segarkan=setTimeout("bergerak()",kecepatan);}bergerak();
	</script>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<link href='images/icon.png' rel='icon' type='image/png'/>
    <script>
        function disableBackButton() {
            window.history.forward();
        }
        setTimeout("disableBackButton()", 0);
    </script>
    
<style>
    .no-close .ui-dialog-titlebar-close {
        display: none;
    }
</style>

	<!-- BEGIN GLOBAL MANDATORY STYLES -->
        
        <link href="assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
		<link href="assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css" />
		<link href="assets/global/plugins/datatables/css/datatables.min.css" rel="stylesheet" type="text/css">
		<link href="assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css">
        <!-- END PAGE LEVEL PLUGINS -->
        <link href="assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link href="assets/pages/css/profile.min.css" rel="stylesheet" type="text/css" />
		<link href="assets/pages/css/login-4.min.css" rel="stylesheet" type="text/css" /> 
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />

<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
<div class="page-header navbar navbar-fixed-top">

            
            <div class="page-header-inner ">
                
                <div class="page-logo" style="background-color:#">
                    <a href="index.php">
                        <img src="images/<?php echo "$r[XBanner]"; ?>" alt="logo" class="logo-default" style="width:250px;margin-top:8px;"   /> </a>
					 <!-- BEGIN MENU TOGGLER 
                    <div class="menu-toggler sidebar-toggler">
                        <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header 
					</div> -->
					
                </div>
				
               <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
                
                <div class="page-top">
				<div class="top-menu">
                        <ul class="nav navbar-nav pull-right">
                            <li >
								<a href="#" class="user">
                                </a>
							</li>
						
					
                        
                            <li class="dropdown dropdown-user dropdown-dark">
                                <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                    <span class="username username-hide-on-mobile" id="user"><?php echo "$sis[XNamaSiswa]"; ?></span>
                                    <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
									<?php 	if(file_exists("fotosiswa/$sis[XFoto]")&&!$gambar==''){ ?>
                                    <img alt="" class="img-circle" src="fotosiswa/<?php echo "$gambar"; ?>" /> 
									<?php 	} else {echo "<img src=fotosiswa/avatar.gif>";} ?></a>
                                <ul class="dropdown-menu dropdown-menu-default">
                                    
                                    <li>
                                        <a href="logout.php" class="log">
                                            <i class="icon-logout"></i> Log Out </a>
                                    </li>
									
                                </ul>
                            </li>
                            <!-- END USER LOGIN DROPDOWN -->
                            <!-- BEGIN QUICK SIDEBAR TOGGLER >
                            <li>
								<a href="logout.php" class="dropdown dropdown-extended quick-sidebar-toggler">
                                <span class="sr-only">Toggle Quick Sidebar</span>
                                <i class="icon-logout"></i></a>
                            </li>
                            <!-- END QUICK SIDEBAR TOGGLER  -->
                    </div>
                    <!-- END TOP NAVIGATION MENU -->
            <!-- END HEADER INNER -->
        </div>
	</div>
        <!-- END HEADER -->

<!--	<div class="page-content">
                    <!-- BEGIN PAGE HEAD
                    <div class="page-head">
                        <!-- BEGIN PAGE TITLE 
                        <div class="page-title">
                            <h1>Konfirmasi Data Peserta
                                <small>Data Peserta</small>
                            </h1>
                        </div>
                        <!-- END PAGE TITLE 
                        
                    </div>
                    <!-- END PAGE HEAD-->
                    <!-- BEGIN PAGE BREADCRUMB -->
                    
                    <!-- BEGIN PAGE BASE CONTENT 
                    
						<div class="portlet-body">  -->
						
						
						
<div class="page-column">   
    <div class="page-col-small col-centered login-wrapper">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title page-label">Konfirmasi Tes</h1>
            </div>

                    <div class="panel-body">
                        <div class="inner-content">
                            <div class="wysiwyg-content">
                                <p>
                                    Terimakasih telah berpartisipasi dalam tes ini.<br>
                                    Silahkan klik tombol LOGOUT untuk mengakhiri test.
                                </p>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-offset-3 col-xs-6"><a href="logout.php">
                                    <button type="submit" class="btn btn-success btn-block" data-dismiss="modal">LOGOUT</button>
                                </div>
                            </div>
                        </div>                   
                    </div>
		</div>
	</div>
</div>	
		
	
		

<!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                 <h4 class="modal-title">Konfirmasi Tes</h4>
             </div>
                <div class="modal-body">
                    <div class="inner-content">
                        <div class="wysiwyg-content">
                            <p>
                                Terimakasi telah berpartisipasi dalam tes ini.<br>
                                Silahkan klik tombol LOGOUT untuk mengakhiri test.                            </p>
                        </div>
                    </div>
                </div>
               <div class="modal-footer">
               <button type="submit" class="btn btn-success btn-block" data-dismiss="modal">LOGOUT</button>
               </div>
            </div>
        </div>
    </div>




  
			<div class="page-footer" style="background:#003366; position:relative" >
				<div class="container" style=" font-size:12px">
        <p>Copyright &copy; 2018 - CBT Application All Rights Reserved | <?php echo $skull;?></p>
    </div>
					<div class="scroll-to-top" style="display: block;">
						<i class="icon-arrow-up"></i>
					</div>
			</div>   


</div>	








                
<!--
<div class="page-column">
   

    <div class="page-col-small col-centered login-wrapper">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title page-label">Konfirmasi Tes</h1>
            </div>

                    <div class="panel-body">
                        <div class="inner-content">
                            <div class="wysiwyg-content">
                                <p>
                                    Terimakasih telah berpartisipasi dalam tes ini.<br>
                                    Silahkan klik tombol LOGOUT untuk mengakhiri test.
                                </p>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-xs-offset-3 col-xs-6"><a href="logout.php">
                                    <button type="submit" class="btn btn-success btn-block" data-dismiss="modal">LOGOUT</button>
                                </div>
                            </div>
                        </div>                   
                    </div>

    </div>
</div>

		<!-- BEGIN CORE PLUGINS -->
        <script src="assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <script src="assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
		<script src="assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
		
        <script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="assets/pages/scripts/profile.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
		<script type="text/javascript">
    $.backstretch([
      "assets/pages/media/bg/8.jpg",
      "assets/pages/media/bg/9.jpg"

      ], {
        fade: 750,
        duration: 4000
    });
</script>

</body>
</html>
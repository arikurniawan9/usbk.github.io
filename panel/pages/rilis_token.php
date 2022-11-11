<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Metronic Admin Theme #6 | Bootstrap Form Controls</title>
        <!-- BEGIN LAYOUT FIRST STYLES -->
        <link href="//fonts.googleapis.com/css?family=Oswald:400,300,700" rel="stylesheet" type="text/css" />
        <!-- END LAYOUT FIRST STYLES -->
                    <div class="row">
                        <div class="col-md-6 ">
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                            


                            <!-- END SAMPLE FORM PORTLET-->
                            <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet-title">
                                    <div class="caption">
                                        
                                       <h2> <span class="caption-subject ">Status Tes</span></h2>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                    <form role="form">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label>Ujian</label>
                                                <?php  
                                                $result = mysqli_query($GLOBALS["___mysqli_ston"], "select * from cbt_ujian WHERE XStatusUjian='1'");  
                                                $jsArray = "var XUjian = new Array();\n";  
                                                echo '<select class="form-control" name="prdId" onchange="changeValue(this.value)">';  
                                                echo '<option>Pilih Kode Ujian</option>';  
                                                while ($row = mysqli_fetch_array($result)) {  
   echo '<option value="' . $row['XKodeSoal'] . '">' . $row['XKodeSoal'] . '</option>';  
   $jsArray .= "XUjian['" . $row['XKodeSoal'] . "'] = {name:'" . addslashes($row['XSesi']) . "',desc:'".addslashes($row['XTokenUjian'])."'};\n";  
                                                }  
                                                echo '</select>';  
                                                ?> 
                                                <script type="text/javascript">  
                                                <?php echo $jsArray; ?>
                                                function changeValue(id){
                                                document.getElementById('prd_name').value = XUjian[id].name;
                                                document.getElementById('prd_desc').value = XUjian[id].desc;
                                                };
                                                </script>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label>Sesi Ujian</label>
                                                <input class="form-control" type="text" name="prod_name" id="prd_name" disabled/>
                                           
                                        </div>
                                           
                                            <div class="form-group">
                                                <label>Token Ujian</label>
                                                <input style="font-size: 20px" class="form-control" type="text" name="prod_desc" id="prd_desc" disabled/>
                                           
                                        </div>
                                    </form>
                                </div>
                        </div>
                    </div>

  
        <script>
            $(document).ready(function()
            {
                $('#clickmewow').click(function()
                {
                    $('#radio1003').attr('checked', 'checked');
                });
            })
        </script>
</div></div>
</html>
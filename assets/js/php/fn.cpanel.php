<?php
/**
    * Sistem Ujian Berbasis Komputer (CBT)
    * @version    : 1.0.1
    * @package    : IBeESNay
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/
header('Content-Type: text/javascript; charset=UTF-8');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
$server_addr = $_SERVER['HTTP_HOST'];
$base_url = (!empty($_SERVER['HTTPs']) ? 'https' : 'http').'://'.$server_addr
            .substr($_SERVER['SCRIPT_NAME'],
            0, strpos($_SERVER['SCRIPT_NAME'],
            basename($_SERVER['SCRIPT_FILENAME'])));
$base_url = str_replace("assets/js/php/","",$base_url);
?>
/**
    * Sistem Ujian Berbasis Komputer (CBT)
    * @version    : 1.0.1
    * @package    : IBeESNay
    * @creator    : SUNARDI
    * @email      : sunardi.1135@yahoo.com
    * @facebook   : wwww.facebook.com/ibeesnay
    * @twitter    : @IBeESNay
*/
var base_url = "<?php echo $base_url;?>";
$(function() {
    var History = window.History;
    if(!History.enabled) {
        return false;
    }
    var	State = History.getState();
    History.Adapter.bind(window,'statechange',function(){
        var State = History.getState(); 
        $.ajax({
            url:State.url,
            error:function(msg){
                $("#error-page").modal("show");
                $("#loadingbar").remove();
                $('#loading').remove();
            },
            success:function(msg){
                if(msg == "redirecting...") {
                    $("#no-session").modal("show");
                    $('#loading').remove();
                    $("#loadingbar").remove();
                    History.pushState(State.data, "SIGMA ICBT", this);
                }
                else 
                { 
                    $('#loading').remove();
                    $("#loadingbar").remove();
                    $('#konten-ajax').html($(msg).find('#konten-ajax').html());
                    $('#konten-ajax').fadeIn(500);
                    $('html, body').delay('1000').animate({scrollTop:0}, 1000);
                    loader();
                    load_editor();
                    selectCheck();
                    $('body a[href]').click(function(e){
                        if (!$(this).attr('target') ){
                            var cururl = $(this).attr('href');
                            var cekurl = cururl.search('#');
                            if ($(this).attr('href')!== window.location.hash){
                                e.preventDefault();
                                $("#loading").remove();
                                $("#loadingbar").remove();
                                var href = $(e.target).closest('a').attr('href');
                                if (href !== undefined && !(href.match(/^#/) || href.trim() == '')) {
                                    var response = $(window).triggerHandler('beforeunload', response);
                                    if (response && response != "") {
                                            var msg = response + "\n\n"
                                                    + "Tekan tombol OK untuk meninggalkan halaman ini dan isian data pada form tidak akan disimpan.\nAtau tombol Cancel untuk tetap berada pada halaman ini.";
                                            if (!confirm(msg)) {
                                                    return false;
                                            }
                                    }
                                    if (cekurl == 0 || cekurl === null || cururl == State.url){
                                        $("body").append("<div id='loadingbar'></div>").find("#loadingbar").animate({width:'100%'},1800).fadeOut(1000);
                                        History.pushState(State.data, "SIGMA ICBT", this);
                                        return;
                                    } else {
                                        $("body").append("<div id='loadingbar'></div>").find("#loadingbar").animate({width:'100%'},1800).fadeOut(1000);
                                        //$('#konten-ajax').append('<div id="loading" class="blackMask" onContextMenu="return false"><div class="popupVCenter"><div class="popup"><div class="spinner"></div><strong style="color: #777; font-size: 14px;">LOADING</strong>&nbsp;&nbsp;&nbsp;<img style="margin-bottom: 3px;" width="15" src="<?php echo $base_url;?>assets/images/2d_4.gif"></div></div></div>');
                                        History.pushState(State.data, "SIGMA ICBT", this);
                                    }
                                    return false;
                                }

                            }
                        }
                    });
                }
            }
        });
    });
    

    $('body a[href]').click(function(e){
        if (!$(this).attr('target') ){
            var cururl = $(this).attr('href');
            var cekurl = cururl.search('#');
            if ($(this).attr('href')!== window.location.hash){
                e.preventDefault();
                $("#loading").remove();
                $("#loadingbar").remove();
                var href = $(e.target).closest('a').attr('href');
                if (href !== undefined && !(href.match(/^#/) || href.trim() == '')) {
                    var response = $(window).triggerHandler('beforeunload', response);
                    if (response && response != "") {
                        var msg = response + "\n\n"
                                + "Tekan tombol OK untuk meninggalkan halaman ini dan isian data pada form tidak akan disimpan.\nAtau tombol Cancel untuk tetap berada pada halaman ini.";
                        if (!confirm(msg)) {
                                return false;
                        }
                    }
                    if (cekurl == 0 || cekurl === null || cururl == State.url){
                        $("body").append("<div id='loadingbar'></div>").find("#loadingbar").animate({width:'100%'},1800).fadeOut(1000);
                        History.pushState(State.data, "SIGMA ICBT", this);
                        return;
                    } else {
                        $("body").append("<div id='loadingbar'></div>").find("#loadingbar").animate({width:'100%'},1800).fadeOut(1000);
                        //$('#konten-ajax').append('<div id="loading" class="blackMask" onContextMenu="return false"><div class="popupVCenter"><div class="popup"><div class="spinner"></div><strong style="color: #777; font-size: 14px;">LOADING</strong>&nbsp;&nbsp;&nbsp;<img style="margin-bottom: 3px;" width="15" src="<?php echo $base_url;?>assets/images/2d_4.gif"></div></div></div>');
                        History.pushState(State.data, "SIGMA ICBT", this);
                    }
                    $('ul.menu-utama').find('li').removeClass('active');
                    $('ul.navbar-nav').find('li').removeClass('active');
                    $(this).parents('li').addClass('active');
                    return false;
                }
            }
        }
        
    });
    
    $('#idmapel').change(function (){
	var id_mapel = $('#idmapel').val();
	var id_level = $('#idlevel').val();
	$.ajax({
            url: base_url + "bsoal/get_level_soal/" + id_mapel + "/" + id_level,
            success: function(data){	
                var output = "<select name = 'no_soal[]' id='nosoal' >";
                if(data == "0"){
                    output += "<option value = '0'>Tidak ada soal</option>";
                } else {
                    for(var i = 0; i <= data; i++){
                        output += "<option value = '"+  i +"'>";
                        output += i;
                        output += "</option>";
                    }
                }
                output += "</select>"; 
                output += '<span style="margin-top: 5px;"><small style="margin-left: 20px;">akan dimasukan ke topik ujian</small></span>';

                $("#no_bank_soal").html(output);
            },
            error: function(xhr,status,strErr){
                //alert(status);
            }	
        });
    });
    
    load_editor();
    selectCheck();
    loader();
});

function loader() {
    $('#fuelux-wizard-container')
        .ace_wizard({
    })
    .on('actionclicked.fu.wizard' , function(e, info){				
    })
    .on('finished.fu.wizard', function(e) {
        $('#form-create').submit();
        bootbox.dialog({
            message: "Sedang proses menyimpan ......"
        });
    }).on('stepclick.fu.wizard', function(e){
        e.preventDefault();
    });
    $('#modal-wizard-container').ace_wizard();
    $('#import-wizard .wizard-actions .btn[data-dismiss=modal]').removeAttr('disabled');			
    $('#sidebar2').insertBefore('.page-content').ace_sidebar('collapse', false);
    $('#navbar').addClass('h-navbar');
    $('.footer').insertAfter('.page-content');		   
    $('[data-rel=tooltip]').tooltip({container:'body'});
    $('[data-rel=popover]').popover({container:'body'});
    $('.page-content').addClass('main-content');
    $('.menu-toggler[data-target="#sidebar2"]').insertBefore('.navbar-brand');

    $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
        if(event_name == 'sidebar_fixed') {
            if( $('#sidebar').hasClass('sidebar-fixed') ) {
                $('#sidebar2').addClass('sidebar-fixed')
            } else {
                $('#sidebar2').removeClass('sidebar-fixed')
            }
        }
    }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);

    $('#sidebar2[data-sidebar-hover=true]').ace_sidebar_hover('reset');
    $('#sidebar2[data-sidebar-scroll=true]').ace_sidebar_scroll('reset', true);
    $('.chosen-select').chosen({
        allow_single_deselect:true,
        no_results_text:'Oops, tidak ditemukan hasil apapun: ',
        search_contains: true,
        include_group_label_in_selected: true
    });
    $('#use-protect').click(function(){
        var $checked = $(this).is(':checked');
        if($checked) {
            $('#password-ujian').css({'display':''});
            $('#input-pass-ujian').val('');
            $('#input-pass-ujian').focus();
            $('#input-pass-ujian').setAttribute('required');
            $('#input-pass-ujian').removeAttr('disabled');
        }
        else {
            $('#password-ujian').css({'display':'none'});
            $('#input-pass-ujian').val('');	
        }
    });
    
    var view_sk = base_url+"main/ajax_view_subkelas";
    var form_sk = base_url+"main/ajax_form_insert_subkelas";
    
    $("#load-manage-subkelas").load(view_sk);
    $("#refresh-subkelas").on('click', function() {
        $("#load-manage-subkelas").load(view_sk);
    });
    
    $("#refresh-subkelas").on('click', function() {
        $("#load-manage-subkelas").load(view_sk);
    });
    
    $("#new-subkelas").on('click', function() {
        $("#load-manage-subkelas").load(form_sk);
    });

    $('#form-confirm-changes').areYouSure({
        message: "PERINGATAN:\n\nApakah anda lupa menyimpan atau memproses data pada form?\n\nSilahkan konfirmasikan jika ingin berpindah halaman."
    });

    $('#form-confirm-changes').bind('dirty.areYouSure', function() {
         $(this).find('button[type="submit"]').removeAttr('disabled');
    });
    $('#form-confirm-changes').bind('clean.areYouSure', function() {
        $(this).find('button[type="submit"]').attr('disabled', 'disabled');
    });

    $("#form").submit(function(e){
        var checked = $('input[name="cek_data[]"]:checked').length > 0;
        if(checked) {	
            e.preventDefault();
            $('#confirmDelete').modal('show');	
            $('#confirm').on('click', function(){
                document.getElementById('form').submit();
            });	
        } else {
            bootbox.dialog({
            message: "<h2><i class='ace-icon fa fa-exclamation-triangle red'></i>&nbsp;&nbsp;Peringatan:</h2>Pilih atau centang item data yang akan dihapus",
            buttons: {
                "success" : {
                    "label" : "OK",
                    "className" : "btn-sm btn-primary"
                }
            }
            });
            return false;
        }
    });
    
    $("#filter-tabel").filterTable();

    $('input[name="cke_pertanyaan"]').click(function() {
        var $checked = $(this).is(':checked');
        var $target = $(this).attr('target-editor');
        if($checked) {
            CKEDITOR.instances['epertanyaan'].updateElement();
            CKEDITOR.replace('epertanyaan');
        } else {
            CKEDITOR.instances['epertanyaan'].updateElement();
            CKEDITOR.instances['epertanyaan'].destroy();		
        }
    });
    $('input[name="cke_referensi"]').click(function() {
        var $checked = $(this).is(':checked');
        var $target = $(this).attr('target-editor');
        if($checked) {
            CKEDITOR.replace('ereferensi');
        } else {
            CKEDITOR.instances['ereferensi'].updateElement();
            CKEDITOR.instances['ereferensi'].destroy();	
        }
    });
}


function get_bsoal_type(bstype) {
    var bsoal_type = bstype;
    window.location = bsoal_type;
}

function selectCheck() {
    $("tr").click(function(e){
        var i =$("td:first-child",this).find("input[type='checkbox']");
        var c = i.is(':checked');
        if($(e.target).is('a')) {
        } else if(i.length) {
            if(c) {
                i.prop('checked', 0);
                //$(this).removeClass('success');
            } else {
                i.prop('checked', 1);
                //$(this).addClass('success');
                //$('.success').removeClass('success');
            }
        }
    });
	
    $('input[type="checkbox"]').click(function(){	
        var $checked = $(this).is(':checked');
        var $target = $(this).attr('target');
        var $subs = $(this).attr('sub-target');
        if($subs) {
            $target = $(this).attr('value');
            var $checkbox = $('input[data-parent="'+$target+'"]');
        } else {
            var $checkbox = $('input[name="'+$target+'"]');
        }
        $('input[type="checkbox"]').next().removeClass('input-error');
        $('input[type="radio"]').next().removeClass('input-error');		
        if($checked) {			
            $checkbox.prop('checked', 1);					
            $($checkbox).parents('table tr').addClass('active');					
        } else {
            $checkbox.prop('checked', 0);	
            $($checkbox).parents('table tr').removeClass('active');				
        }
    });
	
    $('[target-radio], label[target], radio-name[target]').click(function(e){			
        var $target = $(this).attr('target-radio');
        var $type = $(this).attr('target-type');
        var $checkbox = $('input[data-name="'+$target+'"]');
        var $checked = $($checkbox).is(':checked');
        if($type == 'multiple')
            var $checkbox = $('input[name="'+$target+'"]');
            $('input[type="checkbox"]').next().removeClass('input-error');
            $('input[type="radio"]').next().removeClass('input-error');
        if($(e.target).is('.switch *, a[href]')) {
        } else {
            $('tr').removeClass('active');	
            if($checked) {
                $checkbox.prop('checked', 0);					
            } else {
                $checkbox.prop('checked', 1);	
                if($('tr')) $(this).addClass('active');
            }
        }
    });		
}

function load_editor() {
    var waitCKEDITOR = setInterval(function() {
        if(window.CKEDITOR) {
            CKEDITOR.replace('epertanyaan',{removePlugins:'elementspath'});
            CKEDITOR.replace('ereferensi');
            CKEDITOR.replace('editor-1');
            CKEDITOR.replace('editor-2');
            CKEDITOR.replace('editor-3');
            CKEDITOR.replace('editor-4');
            CKEDITOR.replace('editor-5');
            CKEDITOR.replace('editor-6');
            CKEDITOR.replace('editor-7');
            CKEDITOR.replace('editor-8');
            CKEDITOR.replace('editor-9');
            CKEDITOR.replace('editor-10');
            
        }
    },100);
}

var tipe_posisi     = "Atas";
var global_id_ujian = "0";
var global_id_soal  = "0";
var global_opos     = "0";

function movesoal(t_pos,id_ujian,id_soal,opos) {
    tipe_posisi     = t_pos;
    global_id_ujian = id_ujian;
    global_id_soal  = id_soal;
    global_opos     = opos;

    if((document.getElementById('peringatan').style.display)=="block"){
        document.getElementById('peringatan').style.display="none";
    } else {
        document.getElementById('peringatan').style.display="block";
        if(tipe_posisi=="Atas"){
            var upos=parseInt(global_opos)-parseInt(1);
        } else {
            var upos=parseInt(global_opos)+parseInt(1);
        }
        document.getElementById('pos_soal').value=upos;

    }

}

function pindah_posisi(){
    var pos=document.getElementById('pos_soal').value;
    if(tipe_posisi == "Atas"){
        var npos=parseInt(global_opos)-parseInt(pos);
        window.location=base_url +"ujian/move_atas_soal/"+global_id_ujian+"/"+global_id_soal+"/"+npos;
    } else {
        var npos=parseInt(pos)-parseInt(global_opos);
        window.location= base_url +"ujian/move_bawah_soal/"+global_id_ujian+"/"+global_id_soal+"/"+npos;
    }
}

function pemilihan_soal(id_ujian,nama_ujian,batas,id_mapel,id_kategori){
    document.getElementById('bank_soal').style.display="block";
    document.getElementById('bank_soal').style.visibility="visible";
    var showload="<br><br><br><br><br><center><img src='"+base_url+"assets/images/processing.gif'></center>";
    $("#bank_soal").html(showload);
    $.ajax({
        url: base_url + "bsoal/pilih_soal_ujian/"+id_ujian+"/"+nama_ujian+"/"+batas+"/"+id_mapel+"/"+id_kategori,
        success: function(data){
            $("#bank_soal").html(data);
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

function pemilihan_soal_remed(id_remedial,nama_ujian,batas,id_mapel,id_kategori){
    document.getElementById('bank_soal_remedial').style.display="block";
    document.getElementById('bank_soal_remedial').style.visibility="visible";
    var showload="<br><br><br><br><br><center><img src='"+base_url+"assets/images/processing.gif'></center>";
    $("#bank_soal_remedial").html(showload);
    $.ajax({
        url: base_url + "bsoal/pilih_soal_ujian_remed/"+id_remedial+"/"+nama_ujian+"/"+batas+"/"+id_mapel+"/"+id_kategori,
        success: function(data){
            $("#bank_soal_remedial").html(data);
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}


function pemilihan_filter_soal(id_ujian,nama_ujian,batas){
    document.getElementById('bank_soal').style.display="block";
    document.getElementById('bank_soal').style.visibility="visible";
    var id_mapel = document.getElementById('mata_pelajaran').value;
    var id_kategori = document.getElementById('kategori_ujian').value;
    var showload="<br><br><br><br><br><center><img src='"+base_url+"assets/images/processing.gif'></center>";
    $("#bank_soal").html(showload);
    $.ajax({
        url: base_url + "bsoal/pilih_soal_ujian/"+id_ujian+"/"+nama_ujian+"/"+batas+"/"+id_mapel+"/"+id_kategori,
        success: function(data){
            $("#bank_soal").html(data);
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

function search_pemilihan_soal(id_ujian,nama_ujian,batas){
    var search_type=document.getElementById('search_type').value;
    var searchval=document.getElementById('search_input').value;
    var id_mapel = document.getElementById('mata_pelajaran').value;
    var id_kategori = document.getElementById('kategori_ujian').value;
    document.getElementById('bank_soal').style.display="block";
    document.getElementById('bank_soal').style.visibility="visible";
    var showload="<br><br><br><center><img src='"+base_url+"assets/images/processing.gif'></center>";
    $("#bank_soal").html(showload);
    var formData = {
    search_type:search_type,
    search:searchval
    };
    $.ajax({
        type: "POST",
        data : formData,
        url: base_url + "bsoal/pilih_soal_ujian/"+id_ujian+"/"+nama_ujian+"/"+batas+"/"+id_mapel+"/"+id_kategori,
        success: function(data){
            $("#bank_soal").html(data);		
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

function tutup_pemilihan(id_ujian){
    document.getElementById('bank_soal').style.display="none";
    document.getElementById('bank_soal').style.visibility="hidden";
    window.location=base_url+"ujian/bsoal/kode/"+id_ujian;
}

function tambah_soal(id_ujian,id_soal) {
    $.ajax({
        url: base_url + "ujian/tambah_soal_ujian/"+id_ujian+"/"+id_soal,
        success: function(data){
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

function hapus_soal(id_ujian,id_soal){
    $.ajax({
        url: base_url + "ujian/delete_soal/"+id_ujian+"/"+id_soal,
        success: function(data){
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

function soal_added(id){
    document.getElementById(id).innerHTML="<i class='fa fa-plus-circle'></i> Ditambahkan";
}

function soal_deleted(id){
    document.getElementById(id).innerHTML="<i class='fa fa-trash'></i> Dihapus";
}



function pemilihan_filter_soal_remed(id_remedial,nama_ujian,batas){
    document.getElementById('bank_soal').style.display="block";
    document.getElementById('bank_soal').style.visibility="visible";
    var id_mapel = document.getElementById('mata_pelajaran').value;
    var id_kategori = document.getElementById('kategori_ujian').value;
    var showload="<br><br><br><br><br><center><img src='"+base_url+"assets/images/processing.gif'></center>";
    $("#bank_soal_remedial").html(showload);
    $.ajax({
        url: base_url + "bsoal/pilih_soal_ujian_remed/"+id_remedial+"/"+nama_ujian+"/"+batas+"/"+id_mapel+"/"+id_kategori,
        success: function(data){
            $("#bank_soal_remedial").html(data);
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

function search_pemilihan_soal_remed(id_remedial,nama_ujian,batas){
    var search_type=document.getElementById('search_type').value;
    var searchval=document.getElementById('search_input').value;
    var id_mapel = document.getElementById('mata_pelajaran').value;
    var id_kategori = document.getElementById('kategori_ujian').value;
    document.getElementById('bank_soal').style.display="block";
    document.getElementById('bank_soal').style.visibility="visible";
    var showload="<br><br><br><center><img src='"+base_url+"assets/images/processing.gif'></center>";
    $("#bank_soal_remedial").html(showload);
    var formData = {
    search_type:search_type,
    search:searchval
    };
    alert(search_type);
    $.ajax({
        type: "POST",
        data : formData,
        url: base_url + "bsoal/pilih_soal_ujian_remed/"+id_remedial+"/"+nama_ujian+"/"+batas+"/"+id_mapel+"/"+id_kategori,
        success: function(data){
            $("#bank_soal_remedial").html(data);		
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

function tutup_pemilihan_remed(id_ujian){
    document.getElementById('bank_soal_remedial').style.display="none";
    document.getElementById('bank_soal_remedial').style.visibility="hidden";
    window.location=base_url+"ujian/remed/kode/"+id_ujian;
}

function tambah_soal_remed(id_remedial,id_soal) {
    $.ajax({
        url: base_url + "ujian/tambah_soal_ujian_remed/"+id_remedial+"/"+id_soal,
        success: function(data){
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

function hapus_soal_remed(id_remedial,id_soal){
    $.ajax({
        url: base_url + "ujian/delete_soal_remed/"+id_remedial+"/"+id_soal,
        success: function(data){
        },
        error: function(xhr,status,strErr){
            alert(status);
        }	
    });
}

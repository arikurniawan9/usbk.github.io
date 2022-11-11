//*********************** Framework Plugins **********************************//

//**************** jQuery.stringify : to convert JSON into string ************//
var base_url = base_url || '';
var cookie_prefix = cookie_prefix || '';
var base_events = ["blur", "change", "click", "dblclick", "focus", "hover", "keydown", "keypress", "keyup", "show", "hide"];

jQuery.extend({
	stringify : function stringify(obj) {
		var t = typeof (obj);
		if (t != "object" || obj === null) {
			// simple data type
			if (t == "string") obj = '"' + obj + '"';
			return String(obj);
		} else {
			// recurse array or object
			var n, v, json = [], arr = (obj && obj.constructor == Array);

			for (n in obj) {
				v = obj[n];
				t = typeof(v);
				if (obj.hasOwnProperty(n)){
					if (t == "string") v = '"' + v + '"'; else if (t == "object" && v !== null) v = jQuery.stringify(v);
					json.push((arr ? "" : '"' + n + '":') + String(v));
				}
			}
			return (arr ? "[" : "{") + String(json) + (arr ? "]" : "}");
		}
	}
});
//**************** String.format : to create formatted string ************//
String.prototype.format=function(){
	tmp=arguments;
	return this.replace(/\{(\d+)\}/g, function(m, i) {
		return tmp[i];
	});
}
Array.prototype.remove = function(name, value) {  
    var rest = $.grep(this, function(item){    
        return (item[name] !== value);
    });

    this.length = 0;
    this.push.apply(this, rest);
    return this;
};
Array.prototype.insert = function (index, item) {
	this.splice(index, 0, item);
};

function setCookie(c_name,value,expiredays)
{
	var exdate=new Date();
	var c_name = 'COOKIE_' + cookie_prefix + '_' + c_name; 
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ "=" +escape(value)+((expiredays==null) ? "" : ";expires="+exdate.toGMTString()) + ";path=/";
}
function getCookie(c_name)
{
	var c_name = 'COOKIE_' + cookie_prefix + '_' + c_name; 
	if (document.cookie.length>0)
	{
		c_start=document.cookie.indexOf(c_name + "=");
		if (c_start!=-1)
		{
			c_start=c_start + c_name.length+1;
			c_end=document.cookie.indexOf(";",c_start);
			if (c_end==-1) c_end=document.cookie.length;
			return unescape(document.cookie.substring(c_start,c_end));
		}
	}
	else
	{
		return "";
	}
}
function formatBytes(size) {
	if (!size)size = 0;
	var suffix = ['B', 'KB', 'MB', 'GB'],
		result = size;
	size = parseInt(size, 10);
	result = size + ' ' + suffix[0];
	var loop = 0;
	while (size/1024>1){size = size / 1024;loop++;}
	result = Math.round(size) + ' ' + suffix[loop];
	return result;

	if(isNaN(bytes))return ('');
	var unit, val;
	if(bytes < 999) {
		unit = 'B';
		val = (!bytes && this.progressRequestCount >= 1) ? '~' : bytes;
	} else if(bytes < 999999) {
		unit = 'kB';
		val = Math.round(bytes/1000);
	} else if(bytes < 999999999) {
		unit = 'MB';
		val = Math.round(bytes/100000) / 10;
	} else if(bytes < 999999999999) {
		unit = 'GB';
		val = Math.round(bytes/100000000) / 10;
	} else {
		unit = 'TB';
		val = Math.round(bytes/100000000000) / 10;
	}
	return (val + ' ' + unit);
}
//******* Form.serializeObject : to convert Form Element into JSON *******//
$.fn.serializeObject = function(){
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function getURL(URL, params) {
	var URL = URL;

	if (typeof params == 'object') {
		$.each(params, function(key, value){
			URL += '&' + key + '=' + value;
		});
	}

	URL = URL + '&_dc=' + (new Date().getTime());

	return URL;
}

function openWindow(URL, params) {
	var URL = URL;

	if (typeof params == 'object') {
		$.each(params, function(key, value){
			URL += '&' + key + '=' + value;
		});

		URL = URL + '&_dc=' + (new Date().getTime());
	}

	window.open(URL);
}

function openFrame(URL, Frm, Excel, Back){
	var Frm = Frm || null;
	var Excel = Excel || "yes";
	var Back = Back || null;
	var URL = URL;

	Excel = Excel == "yes" ? false : true;

	if (typeof Frm == 'object') {
		$.each(Frm, function(key, value){
			URL += '&' + key + '=' + value;
		});

		URL = URL + '&_dc=' + (new Date().getTime());
	} else {
		if (Frm != null) {
			URL = URL + '&' + Frm + '&_dc=' + (new Date().getTime());			
		} else {
			URL = URL + '&_dc=' + (new Date().getTime());
		}
	}
	
	if (Back != null) {
		$('#it-konten').hide();
		$('#adm-content').append("<article id='it-print'><div class='it-title'><span class='fa fa-print'> </span> Cetak</div></article>");
	}else{
		$('#adm-content').html("<article id='it-print'><div class='it-title'><span class='fa fa-print'> </span> Cetak</div></article>");
	}
	
	$('#it-print').append("<div style='position:absolute;top:61px;bottom:0;left:0;right:0; '><iframe id='iframe-data' name='iframe-data' src='' style='border:0 solid #FFFFFF;width:100%;height:100%; overflow:auto;'></iframe></div>");
	$('#iframe-data').attr('src', URL);

	var bar = new ToolBar({
		position:'top',
		items:[
			{
				xtype:'button',
				iconCls:'print',
				text:'Cetak',
				handler:function(){
					try{
						window.frames["iframe-data"].focus();
						window.frames["iframe-data"].print();
					}catch(e){
						document.getElementById("iframe-data").contentWindow.print();
					}
				}
			}, {
				xtype:'button',
				iconCls:'save',
				text:'Excel',
				disabled:Excel,
				handler:function(){
					$src = $('#iframe-data').attr('src') + "&excel=Y";
					$('#iframe-data').attr('src', $src);
				}
			}, {
				xtype:'button',
				iconCls:'refresh',
				text:'Refresh',
				handler:function(){
					$('#iframe-data').attr('src', URL);
				}
			}, {
				xtype:'button',
				iconCls:'reply',
				text:'Kembali',
				disabled:(Back != null ? false : true),
				handler:function(){
					$('#it-print').remove();
					$('#it-konten').show();
				}
			}, {
				xtype:'button',
				iconCls:'eye',
				text:'Petunjuk',
				align:'kanan',
				handler:function(){
					prnDialog = new Dialog({
						iconCls:'eye',
						title:'Petunjuk Cetak',
						width:'518',
						height:'400',
						items:[{
							xtype:'ajax',
							url:base_url+'controller/rekap/petunjuk-print'
						}, {
							xtype:'toolbar',
							position:'bottom',
							items:[{
									xtype:'button',
									iconCls:'check-square',
									align:'kanan',
									text:'OK',
									handler:function(){
										prnDialog = prnDialog.close();
										prnDialog = null;
									}
								}
							]
						}]
					});
				}
			}
		]
	});
	
	bar.renderTo('#it-print');
}

function alert(msg){
	new MessageBox({type:'critical',width:'400',title:'Peringatan',message:msg});
}
function empty(value){ return value == "" ? true : false }

(function($){	
	//******* Object.ajaxFileUpload : to upload object using ajax *******//
	$.fn.ajaxFileUpload = function(options) {
		var settings = {
			params: {},
			action: '',
			onStart: function() {},
			onComplete: function(response) {},
			onCancel: function() {},
			valid_extensions : ['gif','png','jpg','jpeg'],
			submit_button : null
		};

		var uploading_file = false;

		if ( options ){ $.extend( settings, options ); }

		return this.each(function() {
			var $element = $(this);
			if($element.data('ajaxUploader-setup') === true) return;
			
			$element.change(function(){
				uploading_file = false;
				if (settings.submit_button == null) upload_file();
			});

			if (settings.submit_button == null) {}
			else {
				settings.submit_button.click(function(){
					if (!uploading_file){
						upload_file();
					}
				});
			}
		
			var upload_file = function(){
				if($element.val() == '') return settings.onCancel.apply($element, [settings.params]);
				
				var ext = $element.val().split('.').pop().toLowerCase();
				if($.inArray(ext, settings.valid_extensions) == -1){
					settings.onComplete.apply($element, [{status: false, message: 'The select file type is invalid. File must be ' + settings.valid_extensions.join(', ') + '.'}, settings.params]);
				} else { 
					uploading_file = true;
					wrapElement($element);
					var ret = settings.onStart.apply($element);

					if(ret !== false){
						$element.parent('form').submit(function(e) { e.stopPropagation(); }).submit();
					}
				}
			};

			$element.data('ajaxUploader-setup', true);
			var handleResponse = function(loadedFrame, element) {
				var response, responseStr = loadedFrame.contentWindow.document.body.innerHTML;
				try {
					response = JSON.parse(responseStr);
				} catch(e) {
					response = responseStr;
				}
				element.siblings().remove();
				element.unwrap();

				uploading_file = false;
				settings.onComplete.apply(element, [response, settings.params]);
			};

			var wrapElement = function(element) {
				var frame_id = 'ajaxUploader-iframe-' + Math.round(new Date().getTime() / 1000)
				$('body').after('<iframe width="0" height="0" style="display:none;" name="'+frame_id+'" id="'+frame_id+'"/>');
				$('#'+frame_id).load(function() {
					handleResponse(this, element);
				});

				element.wrap(function() {
					return '<form action="' + settings.action + '" method="POST" enctype="multipart/form-data" target="'+frame_id+'" />'
				}).after(function() {
					var key, html = '';
					for(key in settings.params) {
						html += '<input type="hidden" name="' + key + '" value="' + settings.params[key] + '" />';
					}
					return html;
				});
			}
		});
	}

	//******* Object.setCenter : to change object position into center *******//
	$.fn.setCenter=function(params) {
		
		var defaults={
			topBottom:true,
			leftRight:true
		};

		var params=$.extend(defaults, params);
		var $p=params;
		return this.each(function(){
			var me=$(this);
			if($p.leftRight)
				me.css('left', ($(window).width() - $(this).outerWidth()) /2);
			if($p.topBottom)
				me.css('top', ($(window).height() - $(this).outerHeight()) /2);
		});
	}
})(jQuery);


//*********************** Framework Class ************************************//

function makeid() {
    var text="";
    var possible="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for(var i=0;i<5;i++)
        text+=possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}
function getStyle(obj){
	var style = "";
	if (typeof obj.style != 'undefined'){
		$.each( obj.style, function( key, value ) {
			style += key + ":" + value + ";";
		});

		style = style != "" ? " style='" + style + "' " : "";
	}

	return style;
}
function createObject(settings){
	xtype=settings.xtype;
	var res=null;
	switch(xtype){
		case "button":res=new Button(settings);break;
		case "menu":res=new Menu(settings);break;
		case "toolbar":res=new ToolBar(settings);break;
		case "editor":res=new Editor(settings);break;
		case "combobox":res=new ComboBox(settings);break;
		case "radio":res=new Radio(settings);break;
		case "form":res=new Form(settings);break;
		case "textbox":res=new TextBox(settings);break;
		case "checkbox":res=new CheckBox(settings);break;
		case "imagebox":res=new ImageBox(settings);break;
		case "html":res=new HTML(settings);break;
		case "column":res=new Column(settings);break;
	}
	return res;
}

//*********************** Events Listener ************************************//

function Event(parent, s){
	var settings = s || {};
	var me = this;
	me.events={};
	me.add=function(e, f){
		if(typeof f == 'function'){
			me.events[e]=f;
		}
	}
	me.fire=function(events,arg,ret){
		var ret = ret || parent;
		if(me.events.hasOwnProperty(events) && typeof me.events[events]== 'function')
			me.events[events].apply(ret,arg);
		if(settings.hasOwnProperty(events) && typeof settings[events]=='function')
			settings[events].apply(ret, arg);
	},
	me.set=function(b){
		var ret = {};
		$.each( base_events, function( index, value ) {
			var value = value;
			var on = "on" + value.substring(0,1).toUpperCase() + value.substring(1,value.length).toLowerCase();

			ret[value]=function(){ b.trigger(value); }
			ret[on]=function(act){ me.add(on,act); }
			b.on(value, function(){
				me.fire(value,[],this);
				me.fire(on,[]);
			});
		});

		return ret;
	}
}
//*********************** Grid ************************************//
function Grid(options){
	var settings = $.extend({
		width: "100%",
		height: "100%",
		top: 0,
		bottom: "0px",
		cellEditing:true,
		id: "",
		sort:"local",
		wrap:false,
		store: {
			type: 'json',
			params:{
				start: 0,
				limit: 20,
				orderBy: '',
				sortBy: ''
			}
		},
		columns: [{}]
	}, options);
	
	var me=this;
	var parrent=null;
	var id=settings.id == "" ? makeid() : settings.id;
	var lastRow=null;

	me.events=new Event(me, settings);

	me.onItemClick=function(act){me.events.add("onItemClick",act);}
	me.onItemDblClick=function(act){me.events.add("onItemDblClick",act);}

	var $grid=$('<div id="'+id+'"/>');
	
	$grid.addClass('it-grid');
	$grid.width(settings.width);
	$grid.height(settings.height);

	me.data=null;
	me.page=1;
	me.pageCount=1;
	me.params = settings.store.params;
	me.selectedRecord = null;
	me.selectedColumn = null;

	me.store = null;
	
	if (typeof settings.store == 'function'){
		me.store = settings.store;
		me.data = me.store.getData();
	}else{
		me.store = new Store(settings.store);
	}	
	
	me.store.onLoad(function(data, params){
		me.data = data;
		me.params = params;
		me.load();
		
		/*
		$grid.find('.it-grid-wrapper').perfectScrollbar('destroy');
		$grid.find('.it-grid-wrapper').perfectScrollbar();
		*/
	});
	
	me.store.onError(function(err){
		alert(err.message);
	});
	
	me.load = function(opt){
		if (me.data != null){
			var opt=opt||{};
			$grid.find("tbody").html("");

			var total_rows = me.data.total_rows;
			var start = me.params.start;
			var limit = me.params.limit;
			var last_data = (start + limit);
			var jml_data = me.data.rows.length;
			
			lastRow = null;
			last_data = last_data < total_rows ? last_data : total_rows;
			var data_show = total_rows > 0 ? (start + 1) + "/" + last_data : "0";
			var jml_page = Math.ceil(total_rows / limit);
			me.pageCount = jml_page;

			$grid.find('#dGridShowing').html(data_show);
			$grid.find('#dGridJumlah').html(total_rows);
			$grid.find('#dGridJumlahPage').html(jml_page);

			if (start == 0) $grid.find('#dGridPage').val("1");

			for (k=0;k<jml_data;k++){	
				var current_row = me.data.rows[k];
				error_highlight = typeof current_row.errorRow == 'object' && current_row.errorRow.length > 0 ? "style='background:#ffeeee;'" : "";
				error_highlight = typeof current_row.isError != 'undefined' && current_row.isError == true ? "style='background:#ffeeee;'" : error_highlight;
				
				var $rows = "<tr " + error_highlight + ">";
				for (i = 0; i < settings.columns.length; i++){
					$data = current_row[settings.columns[i].dataIndex];
					$data = typeof $data == 'undefined' ? "" : $data;
					$data = typeof $data == 'null' ? "" : $data;
					$data = $data == null ? "" : $data;
					
					var comboData = null;
					var $value = "";
					var current_col = settings.columns[i];
					var editor = typeof current_col.editor != 'undefined' ? current_col.editor : null;
					var dataIndex = settings.columns[i].dataIndex;

					if ((editor != null && editor.xtype == 'combo') || typeof current_col.data != 'undefined') {
						$value = " value='" + $data + "'";
						comboData = typeof current_col.data != 'undefined' ? current_col.data : settings.columns[i].editor.data;
						arrayIndex = null;
						for (z = 0; z < comboData.length; z++){
							if (comboData[z]['key'] == $data){
								arrayIndex = z;
								break;
							}
						}
						$data = arrayIndex != null ? comboData[arrayIndex]['value'] : "";
						$data = $data != "" && editor != null && typeof editor.format != 'undefined' ? editor.format.format(comboData[arrayIndex].key, comboData[arrayIndex].value) : $data;
					}

					if (editor != null && editor.xtype == 'check') {
						$value = " value='1' ";
						$checked = $data == 1 || $data == "Y" ? "checked" : "";
						$locked = current_row.locked || false;
						$disabled = (editor.editable != undefined && editor.editable == false) || $locked ? " disabled " : "";
						$data = " <input name='" + dataIndex + "[]' class='" + dataIndex + "' type='checkbox' " + $value + $checked + $disabled + ">";
					}

					if (editor != null && editor.xtype == 'radio' && editor.data != undefined) {
						var $radio = "";
						for (var z = 0; z < editor.data.length; z++) {
							var radioData = editor.data[z];
							
							$checked = $data == radioData.key ? "checked" : "";
							$locked = current_row.locked || false;
							$lockValue = editor.lockValue != undefined && editor.lockValue && !empty($data) && $data != "0" ? true : false;
							$disabled = (editor.editable != undefined && editor.editable == false) || $locked || $lockValue ? " disabled " : "";
							$radio += " <input name='" + dataIndex + k + "' class='" + dataIndex + "' type='radio' value='" + radioData.key + "'" + $checked + $disabled + ">" + radioData.value;
						}

						$data = $radio;
					}

					var $cssDiv = "";
					var $cssTD = "";

					$cssTD += current_row.errorRow == 'object' && current_row.errorRow.length > 0 && jQuery.inArray(dataIndex, current_row.errorRow) >= 0 ? "class='it-grid-error'" : "";
					
					if (current_row.setDisabled != undefined) {
						var cdis = current_row.setDisabled[dataIndex];
						
						if (cdis != undefined){
							$cssTD += 'style="background:#fff0e1;" disabled="true"';
						}
					}

					// Style TD
					var $width = typeof current_col.width != 'undefined' ? current_col.width : 0;
					if ($width > 0) $cssDiv += "width:"+$width+"px;";

					var $align = typeof current_col.align != 'undefined' ? current_col.align : "";
					if ($align != "") {
						$cssDiv += "text-align:"+$align+";";
						$cssTD += " align='" + $align + "' ";
					}

					$cssDiv = $cssDiv != "" ? " style='" + $cssDiv + "' " : "";
					if (settings.wrap) {
						$cssDiv = $cssDiv + " class='wrap' ";
						$data = ("" + $data).replace(/\n/g, "<br/>");
					}
					
					var rowspan = '';
					if (current_col.rowspan != undefined && (k % current_col.rowspan) == 0) {
						rowspan = "rowspan='" + current_col.rowspan + "'";
					}
					
					var $img = typeof current_col.image != 'undefined' ? current_col.image : "";
					if ($img == true) $data = "<img src='" + $data + "' " + $cssTD + ">";

					$valign = typeof current_col.valign != 'undefined' ? current_col.valign : "top";
					
					if (current_col.rowspan != undefined && (k % current_col.rowspan) != 0) {
						$rows += "";
					} else {
						$rows += "<td valign='"+$valign +"' " + $cssTD + " " + rowspan + "><div"+ $value + $cssDiv +">" + $data + "</div></td>";
					}
				}
				$grid.find("tbody").append($rows + "</tr>");
			}

			$grid.find("td").click(function(){
				var $rowIndex = $(this).parent().index();
				var $index = $(this).index();
				me.selectedRecord = $rowIndex;
				me.selectedColumn = $index;
				var rowspan=settings.columns[$index].rowspan||null;
				var editor=settings.columns[$index].editor||null;
				var locked=me.store.storeData.rows[$rowIndex].locked||false;
				var disabled=$(this).attr("disabled") || "";
				if(rowspan && ($rowIndex % rowspan) != 0) {
					editor = null;
				}
				if(editor && locked==false && empty(disabled)){
					editor.editable=(typeof editor.editable=='undefined')?true:editor.editable;
					editor.editEmpty=(typeof editor.editEmpty=='undefined')?true:editor.editEmpty;

					if(editor.editable) {
						if (editor.editEmpty) setEditable(this);
						else {
							if (!empty($(this).find('div').text())) {
								setEditable(this);
							}
						}
					}
				}
				$grid.find("tr").removeClass('it-grid-selected');
				$(this).parent().addClass('it-grid-selected');

				if (me.getSelectedRow() != lastRow) {
					me.events.fire("onItemClick",[me.getRecord(me.getSelectedRow())]);
					lastRow = me.getSelectedRow();
				}
			});
			$grid.find("td").dblclick(function(){
				me.events.fire("onItemDblClick",[me.getRecord(me.getSelectedRow())]);
			});
		}
	}
	
	me.showError = function(err){
		var arError = [];
		var err = err || [];
		for (var er = 0; er < err.length; er++){
			$grid.find("tbody tr:eq(" + err[er].indexRow + ")").css("background", "#ffcece");
			arError.push(err[er].indexRow);
		}

		for (var dc = 0; dc < me.store.dataChanged.length; dc++){
			if (arError.indexOf(me.store.dataChanged[dc].indexRow.toString()) == -1){
				$grid.find("tbody tr:eq(" + me.store.dataChanged[dc].indexRow + ")").find("td").removeClass("it-grid-changed");
				me.store.dataChanged.slice(dc);
			}
		}
	}
	me.loadPage = function(page){
		if (me.data != null){	
			$start = (page - 1) * me.params.limit;
			$grid.find('#dGridPage').val(page);
			me.page = page;
			me.store.load({params:{start:$start, limit:me.params.limit}});
		}
	}
	
	var tabEdit = function(e, o){
		indexColumn = o.parent().parent().index();
		jmlColumn = o.parent().parent().parent().find("td").length;
		
		jmlRow = me.data.rows.length;
		idxRow = me.selectedRecord;
		if (e.keyCode == 9 && !e.shiftKey && indexColumn + 1 < jmlColumn){
			e.preventDefault();
			next = o.parent().parent().parent().find("td:eq(" + (indexColumn + 1) + ")");
			o.blur();
			next.click();
		}
		if(e.keyCode == 9 && e.shiftKey && indexColumn - 1 >= 0){
			e.preventDefault();
			next = o.parent().parent().parent().find("td:eq(" + (indexColumn - 1) + ")");
			o.blur();
			next.click();
		}

		if (e.keyCode == 38 && idxRow - 1 >= 0){
			e.preventDefault();
			next = o.parent().parent().parent().parent().find("tr:eq(" + (idxRow - 1) + ")").find("td:eq(" + (indexColumn) + ")");
			o.blur();
			next.click();
		}
		if (e.keyCode == 40 && idxRow + 1 < jmlRow){
			e.preventDefault();
			next = o.parent().parent().parent().parent().find("tr:eq(" + (idxRow + 1) + ")").find("td:eq(" + (indexColumn) + ")");
			o.blur();
			next.click();
		}	
	}
	var setEditable = function(Cell){
		if (!$(Cell).hasClass('it-grid-editing')){
			$(Cell).addClass('it-grid-editing');
			var $CellContent = $(Cell).find("div");
			if (typeof settings.columns[me.selectedColumn].editor == 'function'){
			}else{
				var $editor = settings.columns[me.selectedColumn].editor;
				var $width = typeof settings.columns[me.selectedColumn].width != 'undefined' ? settings.columns[me.selectedColumn].width : 0;
				var $editorType = typeof $editor.xtype != 'undefined' ? $editor.xtype : 'text';
				var $editorWrap = typeof $editor.wrap != 'undefined' ? $editor.wrap : false;
				
				if ($editorType == "check" || $editorType == "radio") $(Cell).removeClass('it-grid-editing');

				var $cssWidth = "";
				if ($width > 0) $cssWidth = " style='width:"+ ($width) +"px' ";
				
				$(Cell).removeClass('it-grid-changed');
				$xType = $editorType;
				$editorType = $editorType == "password" || $editorType == "file" ? "text" : $editorType;

				switch ($editorType){
					case "check":
						value = $CellContent.find("input").is(":checked") == true ? "1" : "0";
						changed = me.store.cekData(me.selectedRecord, settings.columns[me.selectedColumn].dataIndex, value);

						if (changed){
							$(Cell).addClass('it-grid-changed');
						}
					break;
					case "radio":
						value = $CellContent.find("input").filter(":checked").val();
						changed = me.store.cekData(me.selectedRecord, settings.columns[me.selectedColumn].dataIndex, value);

						if (changed){
							$(Cell).addClass('it-grid-changed');
						}
					break;
					case "text":
						if ($editorWrap) {
							cHeight = $CellContent.outerHeight();
							var $html = ("" + $CellContent.html()).replace(/\n/g, "").replace(/<br\s*[\/]?>/gi, "\n");
							$CellContent.html("<textarea class='it-grid-form' "+$cssWidth+">" + $html + "</textarea>");
							$CellContent.find(".it-grid-form").autosize();
							$CellContent.find(".it-grid-form").height(cHeight);
						}else {
							$CellContent.html("<input class='it-grid-form' type='"+$xType+"' "+$cssWidth+" value=\"" + $CellContent.html() + "\">");
						}
						
						if (typeof $editor.maxlength != 'undefined'){$CellContent.find("input").attr("maxlength", $editor.maxlength);}
						var $align = settings.columns[me.selectedColumn].align != undefined ? settings.columns[me.selectedColumn].align : 'left';
						
						$CellContent.find(".it-grid-form").css('text-align', $align);
						$CellContent.find(".it-grid-form").focus();
						$CellContent.find(".it-grid-form").val($CellContent.find(".it-grid-form").val());
						$CellContent.find(".it-grid-form").blur(function(){
							value = $(this).val();
							if ($editorWrap) value = ("" + value).replace(/\n/g, "<br/>");

							
							changed = me.store.cekData(me.selectedRecord, settings.columns[me.selectedColumn].dataIndex, value);
							if (changed){
								$(Cell).addClass('it-grid-changed');
							}
							$CellContent.html(value);
							if ($xType == "password") $CellContent.html("");
							$(Cell).removeClass('it-grid-editing');
						});
						$CellContent.find("input").keypress(function(e){
							if (e.which == 13){$(this).blur();}
							tabEdit(e, $(this));
						});

						if (typeof $editor.type != 'undefined' && $editor.type == 'numeric') {
							var tmpAngka = "";
							$CellContent.find(".it-grid-form").keyup(function(e){
								var cek = true;
								cek = typeof $editor.min != 'undefined' && $(this).val() < $editor.min ? false : cek;
								cek = typeof $editor.max != 'undefined' && $(this).val() > $editor.max ? false : cek;
								if (($.isNumeric($(this).val()) == false || !cek) && !empty($(this).val())){
									$(this).val(tmpAngka);
								}else{
									tmpAngka = $(this).val();
								}
							});
						}
						else if (typeof $editor.type != 'undefined' && $editor.type == 'mask') {
							$CellContent.find(".it-grid-form").change(function(e){
								var cek = true;
								if($(this).val().match($editor.mask)==null){
									$(this).val("");
									new MessageBox({
										type:'critical',width:'400',title:'Peringatan',
										message:$editor.maskMsg||"Format tidak sesuai"
									});
								}
							});
						}
					break;
					case "date":
						$CellContent.html("<input class='it-grid-form' "+$cssWidth+" type='text' value=\"" + $CellContent.html() + "\">");
						changeDate = false;
						$dateFormat = typeof $editor.format != 'undefined' ? $editor.format : 'dd-mm-yy';
						$CellContent.find("input").datepicker({
							dateFormat: $dateFormat,
							changeMonth: true,
							changeYear: true,
							onClose:function(a, b){
								$CellContent.find("input").focus();
								changeDate = true;
							}
						});
						$CellContent.find("input").focus();
						$CellContent.find("input").blur(function(){
							if (changeDate){
								value = $(this).val();
							
								changed = me.store.cekData(me.selectedRecord, settings.columns[me.selectedColumn].dataIndex, value);
								if (changed){
									$(Cell).addClass('it-grid-changed');
								}
								$CellContent.html(value);
								$(Cell).removeClass('it-grid-editing');
							}
						});
					break;
					case "combo":
						comboOpt = "<option value=''>";
						for (i = 0; i < $editor.data.length; i++)
						{
							$optValue = typeof $editor.format != 'undefined' ? $editor.format.format($editor.data[i].key, $editor.data[i].value) : $editor.data[i]["value"];
							comboOpt += "<option value='" + $editor.data[i]["key"] + "'>" + $optValue;
						}
						$CellContent.html("<select class='it-grid-form' "+$cssWidth+">" + comboOpt + "</select>");
						$CellContent.find("select").focus();
						$CellContent.find("select").val($CellContent.attr("value"));//make cursor at the end
						$CellContent.find("select").blur(function(){
							value = $(this).val();
							
							changed = me.store.cekData(me.selectedRecord, settings.columns[me.selectedColumn].dataIndex, value);
							if (changed){
								$(Cell).addClass('it-grid-changed');
								$CellContent.attr("value", value);
							}
							$CellContent.html($(this).find("option:selected").text());
							$(Cell).removeClass('it-grid-editing');
						});
						$CellContent.find("select").keypress(function(e){
							if (e.which == 13){$(this).blur();}
							tabEdit(e, $(this));
						});
					break;
				}
			}
		}
	}
	var setPage = function(act){
		if (me.data != null){
			$lastPage = Math.ceil(me.data.total_rows / me.params.limit);
			
			switch(act){
				case 'first':
					if (me.page != 1) me.loadPage(1);
				break;
				case 'last':
					if (me.page != $lastPage) me.loadPage($lastPage);
				break;
				case 'next':
					if (me.page < $lastPage) me.loadPage(me.page + 1);
				break;
				case 'back':
					if (me.page > 1) me.loadPage(me.page - 1);
				break;
			}
			
		}
	}
	me.getSelectedRow = function(){
		return me.selectedRecord;
	}
	me.getRecord = function(rec){
		if (me.data != null){
			return me.data.rows[rec];
		}else{
			return null;
			alert('Data Tidak Ditemukan');
		}
	}
	me.addRow = function(){
		$newRow = "";
		for (i = 0; i < settings.columns.length; i++){
			var $value = me.store.storeData.rows[me.store.storeData.rows.length - 1][settings.columns[i].dataIndex];
			var $editor = settings.columns[i].editor;
			var $align = typeof settings.columns[i].align != 'undefined' ? settings.columns[i].align : "";
			var $cssDiv = "";
			var $cssTD = "";
			if ($align != "") {
				$cssDiv += "text-align:"+$align+";";
				$cssTD += " align='" + $align + "' ";
			}
			$value = typeof $value != 'undefined' ? $value : '';
			$value = typeof $editor != 'undefined' && $editor.xtype == 'check' ? " <input name='" + settings.columns[i].dataIndex + "[]' class='" + settings.columns[i].dataIndex + "' type='checkbox' value='1' checked>" : $value;
			$newRow += "<td valign='top' "+$cssTD+"><div "+$cssDiv+(settings.wrap ? "class='wrap'" : "")+">" + $value + "</div></td>";
		}

		$grid.find("tbody").append("<tr>" + $newRow + "</tr>");

		$grid.find("td").click(function(){
			var $rowIndex = $(this).parent().index();
			var $index = $(this).index();
			me.selectedRecord = $rowIndex;
			me.selectedColumn = $index;
			
			var editable = true;
			if (typeof settings.columns[$index].editor != 'undefined' && settings.cellEditing && editable != false)setEditable(this);
			
			$grid.find("tr").removeClass('it-grid-selected');
			$(this).parent().addClass('it-grid-selected');

			if (me.getSelectedRow() != lastRow) {
				me.events.add("onItemClick",[me.getRecord(me.getSelectedRow())]);
				lastRow = me.getSelectedRow();
			}
		});

		$grid.find("tbody tr:last-child td:first-child").click();

		$(window).resize();
	}
	me.endEditing=function(){
		$grid.find("tbody tr:last-child td:first-child input").blur();
	}
	var createGrid = function(){
		var $header = "";
		var $tr = "";
		for (i = 0; i < settings.columns.length; i++){
			var col_width = "";
			var width = "";
			var current_col = settings.columns[i];
			var sort = typeof current_col.sort != 'undefined' ? current_col.sort : true;
			if (typeof current_col.width != 'undefined'){
				col_width = "<BR><img src='"+base_url+"resources/framework/css/images/space.gif' width='" + (current_col.width-24) + "' height='1'>";
				width = "width='" + current_col.width + "'";
			}
			
			text_header = current_col.header;
			text_header = sort == true ? "<a href='javascript:void(0)' class='it-grid-sort' value='" + current_col.dataIndex + "' asc='Y'>" + text_header + "</a>" : text_header;
			
			$header += "<th " + width + ">" + current_col.header + col_width + "</th>";
		}
		$grid.height(settings.height);

		if (typeof settings.customHeader != 'undefined'){
			$header = settings.customHeader;
		}

		$grid.append("<div class='it-grid-wrapper'><table border='1' width='"+settings.width+"'><thead>" + $header + $tr + "</thead><tbody></tbody></table></div>");
		$grid.append("<div class='it-grid-fixed-header'><table border='1' width='"+settings.width+"'><thead>" + $header + $tr + "</thead></table></div>");
		
		if (typeof settings.customHeader != 'undefined'){
			$grid.find('thead').find('th').each(function(){
				width = $(this).attr('width');
				width = typeof width == 'undefined' ? 40 : width;
				$(this).css('text-align', 'center');
				$(this).css('width', width);
				$(this).append("<BR><img src='"+base_url+"resources/framework/css/images/space.gif' width='" + (width-24) + "' height='1'>");
			});
		}

		if (settings.paging == true){
			var $firstButton = "<a href='javascript:void(0)' class='it-first-icon' rel='first'>&nbsp;</a>";
			var $lastButton = "<a href='javascript:void(0)' class='it-last-icon' rel='last'>&nbsp;</a>";
			var $nextButton = "<a href='javascript:void(0)' class='it-next-icon' rel='next'>&nbsp;</a>";
			var $backButton = "<a href='javascript:void(0)' class='it-back-icon' rel='back'>&nbsp;</a>";
			var $pageInput = "<input type='text' id='dGridPage' value='1'>";
			$grid.append("\
				<div class='it-grid-pagination'>\
					<ul>\
						<li>" + $firstButton + "</li>\
						<li>" + $backButton + "</li>\
						<li>" + $pageInput + "<span>&nbsp;&nbsp;dari&nbsp;&nbsp;</span><span id='dGridJumlahPage'></span></li>\
						<li>" + $nextButton + "</li>\
						<li>" + $lastButton + "</li>\
						<li><span>Menampilkan</span> <span id='dGridShowing'></span> <span>dari</span> <span id='dGridJumlah'></span> <span>Data</span></li>\
					</ul>\
					<div id='dGridInfo'></div>\
				</div>\
			");
		}else{
			$grid.find('.it-grid-wrapper').css('margin-bottom','0px');
		}
		$grid.html("<div class='it-grid-container'>" + $grid.html() + "</div>");
		$grid.find('.it-grid-pagination').find('a').click(function(){
			var aPage = this; 
			if (me.store.dataChanged.length > 0 && !me.store.isSaved){
				var msg = MessageBox({
					type:'tanya',
					width:'400',
					title:'Konfirmasi',
					message:'Data Berubah Belum di Save, Lanjutkan ?',
					buttons:[{
						text:'Ya',
						handler:function(){
							me.store.dataChanged = [];
							setPage($(aPage).attr('rel'));
						}
					}, {
						text:'Tidak',
						handler:function(){
							msg.hide();
						}
					}]
				});
			}else{
				setPage($(aPage).attr('rel'));
			}
		});
		$grid.find('#dGridPage').keypress(function(e){
			if (e.which == 13){
				var value = $(this).val().replace(/^\s\s*/, '').replace(/\s\s*$/, '');
				var intRegex = /^\d+$/;
				var isNumber = true;
				if(!intRegex.test(value)) {
					alert('Harus Angka');
					isNumber = false;
				}
				if (isNumber){
					me.loadPage($(this).val());
				}
			}
		});

		me.store.completeLoad(function(a){
			for (var ix = 0; ix < settings.columns.length; ix++){
				var sort = typeof settings.columns[ix].sort != 'undefined' ? settings.columns[ix].sort : true;

				if (sort == true){
					var $obj = $grid.find('.it-grid-wrapper').find('thead').find('th:eq('+ix+')');
					var $obj2 = $grid.find('.it-grid-fixed-header').find('thead').find('th:eq('+ix+')');

					checkHeader($obj);
					checkHeader($obj2);
				}
			}

			function checkHeader(obj){
				if(obj.find("a").length <= 0){
					var imgWidth = obj.find("img").attr("width");
					obj.find("img").remove();
					var textTH = obj.html();
					textTH = "<a href='javascript:void(0)' class='it-grid-sort' value='" + settings.columns[ix].dataIndex + "' asc='Y'>" + textTH + "</a>";
					obj.html("");
					obj.append(textTH);
					obj.append("<img src='"+base_url+"resources/framework/css/images/space.gif' width='" + imgWidth + "' height='1'>");
				}
			}
			
			$grid.find('.it-grid-sort').unbind('click');
			$grid.find('.it-grid-sort').click(function(){
				if (settings.sort == "local"){
					me.store.sort($(this).attr('value'), $(this).attr('asc'));
				}else{
					var params = $.extend(me.params, {sort:$(this).attr('value'), asc:($(this).attr('asc') == "Y" ? "ASC" : "DESC")});
					me.store.load({params: params});
				}
				
				var sorted = "it-sort-asc";
				
				if ($(this).attr("asc") == "Y"){
					$(this).attr("asc", "N");
				}else{
					var sorted = "it-sort-desc";
					$(this).attr("asc", "Y");
				}

				$grid.find('.it-grid-sort').removeClass("it-sort-asc");
				$grid.find('.it-grid-sort').removeClass("it-sort-desc");

				$(this).addClass(sorted);
			});
		});
	}
	me.getEditedRecords = function(){
		return me.store.dataChanged;
	}
	me.setInfo = function(info){
		$grid.find('#dGridInfo').html(info);
	}
	me.getSetting=function(){ return settings; }
	me.setEditorData=function(field, data){
		for (i = 0; i < settings.columns.length; i++){
			if (settings.columns[i].dataIndex == field){
				settings.columns[i].editor.data = data;
			}
		}
	}
	me.setEditing=function(field, value){
		for (i = 0; i < settings.columns.length; i++){
			if (settings.columns[i].dataIndex == field){
				settings.columns[i].editor.editable = value;
			}
		}
	}

	me.renderTo=function(obj){
		createGrid();

		$konten = $('<div class="lay-grid" '+getStyle(settings)+'/>');
		if(settings.top != 0)
			$konten.css("top", settings.top);
		$konten.css("bottom", settings.bottom);
		$konten.append($grid);

		$konten.find('.it-grid-wrapper').scroll(function(){
			var scrollX = $grid.find('.it-grid-wrapper').scrollLeft();
			$grid.find('.it-grid-fixed-header').scrollLeft(scrollX);
		});

		/*
		$(window).resize(function(){
			$konten.find('.it-grid-wrapper').perfectScrollbar('destroy');
			$konten.find('.it-grid-wrapper').perfectScrollbar();
		});
		*/

		$konten.appendTo(obj);

		parrent=obj;
	}
	return me;
}

//*********************** Store ************************************//
function Store(options){
	var settings = $.extend({
		type: 'json',
		url: '',
		data: {},
		params:{
			start: 0,
			limit: 20,
			orderBy: '',
			sortBy: ''
		}
	}, options);
	
	var me = this;
	me.events=new Event(me, settings);
	me.params = {};
	me.storeData = null;
	me.dataChanged = [];
	me.isSaved = false;

	me.beforeLoad=function(act){me.events.add("beforeLoad",act);}
	me.afterLoad=function(act){me.events.add("afterLoad",act);}
	me.completeLoad=function(act){me.events.add("completeLoad",act);}
	me.onLoad=function(act){me.events.add("onLoad",act);}
	me.onError=function(act){me.events.add("onError",act);}
	me.onChange=function(act){me.events.add("onChange",act);}

	me.empty = function(){
		me.dataChanged=[];
		me.storeData={rows:[],total_rows:0};
		me.events.fire("onLoad", [me.storeData, me.params]);
	}


	me.load = function(opt){
		$('#loading').show();

		me.events.fire("beforeLoad",[me.storeData]);

		var opt = opt || {};
		switch(settings.type){
			case "json":
				var params = $.extend(settings.params, opt.params);
				me.params = params;
				me.dataChanged=[];
				$.ajax({
					type: 'POST',
					url: settings.url + '&_dc=' + (new Date().getTime()),
					data: params,
					success: function(data){
						if (typeof data.rows != 'undefined' && typeof data.total_rows != 'undefined'){
							me.storeData=data;
							me.events.fire("onLoad", [me.storeData, me.params]);
						}
						else{
							me.storeData = {};
							me.events.fire("onError", [{status:false, message:"Format Data Tidak Sesuai"}]);
						}
					},
					error: function(){me.events.fire("onError", [{status:false, message: "Data Tidak Ditemukan"}]);},
					complete:function(){me.events.fire("afterLoad",[me.storeData]);me.events.fire("completeLoad",["satu","dua"]);},
					dataType: settings.type
				});
			break;
			case "array":
				if (typeof settings.data.rows != 'undefined' && typeof settings.data.total_rows != 'undefined'){
					me.storeData = settings.data;
					me.events.fire("onLoad", [me.storeData, me.params]);
				}else{
					me.events.fire("onError", [{status:false, message: "Data Tidak Ditemukan"}]);
				}
				me.events.fire("afterLoad",[me.storeData]);
				me.events.fire("completeLoad",["satu","dua"]);
			break;
		}
	}
	if (settings.autoLoad) me.load();
	me.searchData = function(data, key, value){
		index = null;
		for (i = 0; i < data.length; i++){
			if (data[i][key] == value){
				index = i;
				break;
			}
		}
		return index;
	}
	var isMoney = function ( value ) {
		var m = value.replace( /[$,]/g, "" ).replace(/\./g, "").replace(/,/g, ".").replace(/\%/g, "");
		return ! isNaN(m);
	}
	var isDate = function ( value ) {
		var d = new Date(value);
		return ! isNaN(d);
	}
	me.sort = function(prop, asc){
		var asc = asc;
		var prop = prop;
		me.storeData.rows = me.storeData.rows.sort(function(a, b) {
			var valueA = a[prop];
			var valueB = b[prop];
			if ( ! isNaN(valueA) && ! isNaN(valueB) ) {
				valueA = parseFloat(valueA);
				valueB = parseFloat(valueB);
			} else if ( isDate(valueA) && isDate(valueB) ) {
				valueA = new Date(valueA);
				valueB = new Date(valueB);
			} else if ( isMoney(valueA) && isMoney(valueB) ) {
				valueA = parseFloat(valueA.replace( /[$,]/g, "" ).replace(/\./g, "").replace(/,/g, ".").replace(/\%/g, ""));
				valueB = parseFloat(valueB.replace( /[$,]/g, "" ).replace(/\./g, "").replace(/,/g, ".").replace(/\%/g, ""));
			}

			if (asc == 'Y') return (valueA > valueB);
			else return (valueB > valueA);
		});

		me.events.fire("onLoad", [me.storeData, me.params]);
	}
	me.getParams = function(){ return me.params; }
	me.getData = function(){ return me.storeData; }
	me.setData = function(d){ settings.data = d; } 
	me.getSetting = function(){ return settings; }
	me.cekData = function(index, column, data){
		if ($.trim(me.storeData.rows[index][column]) != $.trim(data))
		{
			rows = $.extend({indexRow: index}, me.storeData.rows[index]);
			if (me.searchData(me.dataChanged, 'indexRow', index) == null)
			{
				me.dataChanged.push(rows);
			}
			me.dataChanged[me.searchData(me.dataChanged, 'indexRow', index)][column] = data;
			me.events.fire("onChange", [{index: index, data: [me.dataChanged[me.searchData(me.dataChanged, 'indexRow', index)]]}]);
			return true;
		}else{
			if (me.searchData(me.dataChanged, 'indexRow', index) != null)
			{
				me.dataChanged[me.searchData(me.dataChanged, 'indexRow', index)][column] = data;
			}
			return false;
		}
	}
	
	return me;
}
//*********************** Menu ************************************//
function Menu(params){
	var settings=$.extend({
		text:'',
		direction:'tengah',
		iconCls:'',
		disabled:false,
		items:[]
	},params);

	var me=this;
	var parrent=null;
	var id=makeid();
	var items=settings.items;
	
	var clsDisabled = settings.disabled ? "disabled" : "";
	var icon=settings.iconCls!=''?'<span class="fa fa-'+settings.iconCls+'"></span>':'';		
	var konten='<a href="#@" id="'+id+'" '+getStyle(settings)+' class="it-btn '+clsDisabled+'">'+icon+' '+settings.text+'</a><span class="tooDir" style="display:none"></span><ul data-arah="'+settings.direction+'"></ul>';
	var $konten=$(konten);
	for (var i=0;i<items.length;i++){
		if (items[i] === null)continue;
		var li='<li></li>';
		li=$(li);

		if (typeof items[i].renderTo == 'function'){
			items[i].renderTo(li);
		}else if(typeof items[i] == 'object'){
			item=createObject(items[i]);
			item.renderTo(li);
		}
		$konten.eq(2).append(li);
	}

	me.renderTo=function(obj){
		$konten.appendTo(obj);
		parrent=obj;

		parrent.click(function(e){
			var $this = $(this);
			var me_child=$this.children('ul');
			var me_data=(typeof me_child.data('arah') != 'undefined' ? me_child.data('arah') : 'tengah');
			var me_dir=$this.children('.tooDir');
				
			if(!me_child.is(':visible')) {
				$('.it-toolbar div ul').hide();
				$('.it-toolbar div a').removeClass('active');
				$('.it-toolbar div .tooDir').hide();			
			}		
			
			if(me_child.length > 0) {
				me_a=me_child.parent().children('a').outerWidth();
				me_b=me_child.outerWidth();
				me_c=me_dir.outerWidth();
				
				if(me_data == 'tengah') {
					me_child.css('left', (me_a - me_b) / 2);
				}else if(me_data == "kanan") {
					me_child.css({'left':'auto','right':'5px'});
				}
				
				me_dir.css('left', (me_a - me_c) / 2);
				me_child.toggle();
				me_dir.toggle();
				$(this).children('a').toggleClass('active');
			}
			e.stopPropagation();
		});	

		$(document).click(function(){
			$('.it-toolbar div ul').hide();
			$('.it-toolbar div a').removeClass('active');
			$('.it-toolbar div .tooDir').hide();
		});
	}
	me.getSetting=function(){ return settings; }
	me.getId=function(){ return id; }
	return me;
}

//*********************** Toolbar ************************************//
function ToolBar(params){
	var settings=$.extend({
		position:'top',
		items:[]
	},params);

	var me=this;
	var parrent=null;
	var id=makeid();
	var items=settings.items;
	var nItems = {};
	
	var footer='<div class="it-dialog-footer" id="'+id+'" '+getStyle(settings)+'><ul class="it-toolbar-kiri left"></ul><ul class="it-toolbar-kanan right"></ul></div>';
	var konten=settings.position=='top'?'<nav class="clearfix it-toolbar" id="'+id+'" '+getStyle(settings)+'><table class="table-toolbar" width="100%"><tr><td class="it-toolbar-kiri left"></td><td class="it-toolbar-kanan right"></td></tr></table></nav>':footer;
	var $konten=$(konten);
	for (var i=0;i<items.length;i++){
		if (items[i] === null)continue;
		var li='<div/>'; var align='kiri'; var item=null;
		li=$(li);

		if (typeof items[i].renderTo == 'function'){
			item=items[i];
		}else if(typeof items[i] == 'object'){
			item=createObject(items[i]);
		}
		nItems[item.getId()] = item;

		item.renderTo(li);
		align=typeof item.getSetting().align!='undefined'?item.getSetting().align:align;
		$konten.find('.it-toolbar-'+align).append(li);
	}
	
	me.renderTo=function(obj){
		$konten.hover(function(e){
			var parentOffset = $(this).offset(); 
			var relX = e.pageX - parentOffset.left;
			var objW = $(this).outerWidth();
				
			if (relX >= objW - 80){
				$(this).find("table").addClass("animate", 200);
			}
			if (relX <= 80){
				$(this).find("table").removeClass("animate", 200);
			}
		});
		
		$konten.appendTo(obj);
		parrent=obj;
	}
	
	me.text=" ";
	me.debug = function(o){
		return nItems[o.trim()];
	}

	me.getItem=function(o){ return nItems[o]; }
	me.getSetting=function(){ return settings; }
	me.getId=function(){ return id; }
	return me;
}

//*********************** Button ************************************//
function Button(params){
	var settings=$.extend({
		iconCls:'',
		btnCls:'',
		disabled:false,
		text:'Button',
		id:'',
	},params);
	
	var me=this;
	var parrent=null;
	me.events=new Event(me, settings);
	var id=settings.id == '' ? makeid() : settings.id;
	var icon=settings.iconCls!=''?'<span class="fa fa-'+settings.iconCls+'"></span>':'';
	var clsDisabled = settings.disabled ? "disabled" : "";
	var konten='<a href="javascript:void(0)" id="'+id+'" class="it-btn '+clsDisabled+' '+settings.btnCls+'" '+getStyle(settings)+'>'+icon+' '+settings.text+'</a>';
	var $konten=$(konten);
	if (typeof settings.handler != 'undefined' && !settings.disabled){
		$konten.click(function(){
			var handler=settings.handler;
			if (typeof handler == 'function'){
				handler.call();
			}else if(typeof handler == 'string'){
				window[handler]();
			}
		});
	}

	$.extend(me, me.events.set($konten));
	
	me.renderTo=function(obj){
		$konten.appendTo(obj);
		parrent=obj;
	}

	me.click=function() {
		$konten.click();
	}

	me.getSetting=function(){ return settings; }
	me.getId=function(){ return id; }
	return me;
}


//*********************** Dialog ************************************//
function Dialog(params){
	var defaults = {
		width:300,
		height:300,
		type:'biasa',
		items:[],
		padding:5,
		modal:true,
		clear:false,
		title:'',
		iconCls:'',
		autoShow:true,
	};

	var me=this;
	var id=makeid();
	var settings=$.extend(defaults, params);
	var icon=settings.iconCls!=''?'<span class="fa fa-'+settings.iconCls+'"></span>':'';
	var $dialog=$('<div class="it-dialog" '+getStyle(settings)+'><div class="it-dialog-effect"><div class="it-title">'+icon+' '+settings.title+'</div> </div></div>');
	var $modal=$('<div class="it-modal it-hide" id="it-modal-dialog"></div>');
	
	if (settings.clear) $(".it-dialog, .it-modal").remove();

	var curZ = $(".it-dialog").last().css("z-index") + 1;
	var diaZ = curZ + 1;
	if (curZ > 1) $modal.css("z-index", curZ);
	if (diaZ > 2) $dialog.css("z-index", diaZ);

	me.events = new Event(me, settings);
	me.afterShow=function(act){me.events.add("afterShow",act);}
	me.onClose=function(act){me.events.add("onClose",act);}
	me.onHide=function(act){me.events.add("onHide",act);}

	if(settings.modal) 
		$modal.show();
	
	$dialog.width( settings.width );
	
	$dialog
	   .find( '.it-dialog-effect' )
	   .height( settings.height )
	   .draggable({ 
			handle:'.it-title',
			appendTo: "body",	
			start:function() {
				$(this).css({
					"-webkit-transition":"none",
					"-moz-transition":"none",
					"-ms-transition":"none",
					"transition":"none"
				});
			}
		});
	
	var items=settings.items;
	var item = null;
	var nItems = [];
	for (var i=0;i<items.length;i++){
		if (items[i] === null)continue;

		if (typeof items[i].renderTo == 'function'){
			items[i].renderTo($dialog.find(".it-dialog-effect"));
			nItems[i] = items[i];
		}else if (typeof items[i] == 'object' && items[i].xtype=='ajax'){
			$.ajax({
				url: items[i].url,
				success: function(data){
					var $dialogKonten = $('<div class="dialog-konten"></div>');
					$dialogKonten.css({'padding':settings.padding});
					$dialogKonten.append(data);

					$dialog.find(".it-dialog-effect").append($dialogKonten);
				}
			});
		}else if(typeof items[i] == 'object'){
			item=createObject(items[i]);
			item.renderTo($dialog.find(".it-dialog-effect"));

			nItems[i] = item;
		}
	}

	me.getItem=function(idx){
		return nItems[idx];
	}

	me.getSetting=function(){ return settings; }
	me.getId=function(){ return id; }
	
	me.hide=function() {
		$dialog.removeClass('it-dialog-s');
		$modal.hide();

		me.events.fire("onHide", []);
	}
	me.show=function() {
		$dialog.addClass('it-dialog-s');
		$modal.show();

		me.events.fire("afterShow", []);
	}
	me.destroy=function() {
		$dialog.remove();
		$modal.remove();
		me = null;
	}
	me.close=function(){
		me.hide();
		setTimeout(function(){
			$dialog.remove();
			$modal.remove();
			me.events.fire("onClose", []);
			me=null;
		},600);
	}
	
	$('body').append($modal);
	$('body').append($dialog);
	
	setTimeout(function(){ me.show(); }, 200);

	return me;
}		


//*********************** Tabs ************************************//
function Tabs(params){
	var settings=$.extend({
		items:[],
		margin:'',
		skin:'',
		top:0,
		fullscreen:false
	},params);

	var me=this;
	var parrent=null;
	var id=makeid();
	var items=settings.items;
	var konten='<div id="'+id+'" '+getStyle(settings)+'><ul></ul></div>';
	var $konten=$(konten);
	var item=null;
	var nItems = [];
	for(var i=0;i<items.length;i++){
		if (items[i] === null)continue;
		var sec=$('<section id="'+id+'tab'+i+'"></section>');
		if (typeof items[i].renderTo == 'function'){
			items[i].renderTo(sec);
			items[i].title = items[i].getSetting().title;
			nItems[i] = items[i];
		}else if(typeof items[i] == 'object' && items[i].xtype=='html'){
			if (items[i].konten.substring(0, 1) == "#"){
				sec.append($(items[i].konten).html());
			}else{
				sec.append(items[i].konten);
			}
		}else if (typeof items[i] == 'object' && items[i].xtype=='ajax'){
			$.ajax({
				url: items[i].url,
				success: function(data){
					sec.append(data);
				}
			});
		}else if(typeof items[i] == 'object'){
			item=createObject(items[i].konten);
			item.renderTo(sec);

			nItems[i] = item;
		}

		$konten.children('ul').append('<li><a href="#'+id+'tab'+i+'" title="'+items[i].title+'"> '+items[i].title+' </a></li>');
		$konten.append(sec);
	}

	me.getItem=function(idx){
		return nItems[idx];
	}

	me.renderTo=function(obj){
		$konten.addClass('it-tab '+settings.skin).css('margin', settings.margin);
		if(settings.top != 0)
			$konten.css('top', settings.top);
		if(settings.fullscreen) 
			$konten.addClass('fullscreen');
		$konten.children('section').hide();
		$konten.children('ul').addClass('clearfix');
		//$konten.children('ul').after('<div class="clear">');
		
		var $obj  = $konten.children().children().children('a');
		var href = $obj.first().attr('href');
		
		$obj.removeClass('active');
		$obj.first().addClass('active');
		$konten.find(href).show();

		$obj.click(function(e){
			$obj.removeClass('active'); $(href).hide();
			$obj=$(this);
			$obj.addClass('active');
			href=$obj.attr('href');
			$(href).show();
			e.preventDefault();
		});
		
		$konten.appendTo(obj);
		parrent=obj;
	}

	me.getSetting=function(){return settings;}
	me.getId=function(){return id;}
	return me;
}

//*********************** Messagebox ************************************//
function MessageBox(params){
	var defaults = {
		type:'info',
		title:'Judul',
		message:'',
		width:450,
		height:50,
		padding:10,
		buttons:[],
		btnAlign:'kanan'
	};

	var me=this;
	var settings=$.extend(defaults, params);
	var btn="";
	var markup=[];
	var buttons=settings.buttons;
	var btn=null;
	var btnCls = '';
	
	icon='<img src="'+base_url+'resources/framework/css/images/i-'+settings.type+'.png" style="margin:10px 10px 0; float:left;">';
	$('.it-modalConfirm').remove();
	markup=[
		'<div class="it-modal it-modalConfirm"></div>',
		'<div class="it-messagebox" '+getStyle(settings)+'>',
			'<div class="it-messagebox-effect">',
				'<div class="it-title">'+ settings.title +'</div>',
				'<table width="100%"><tr><td width="80">'+ icon +'</td><td><p style="position:static;">'+ settings.message +'</p></tr>',
				'<tr><td colspan="2"><div id="it-confirmBtn" class="'+ settings.btnAlign +'"></div></td></tr></table>',
			'</div>',
		'</div>'
	].join(''); 
	$markup=$(markup);

	if (buttons.length == 0){
		btn = $('<a href="javascript:void(0)" class="it-btn">Ok</a>');
		btn.click(function(){
			me.hide();
		});
		btn.appendTo($markup.eq(1).find('#it-confirmBtn'));
	}else{
		for (var i=0;i<buttons.length;i++){
			var $id = makeid();
			var btnCls=typeof buttons[i].btnCls=='undefined'?'':' '+buttons[i].btnCls;
			var btn=$('<a id="'+$id+'" href="javascript:void(0)" class="it-btn'+btnCls+'">'+buttons[i].text+'</a>');

			btn.appendTo($markup.eq(1).find('#it-confirmBtn'));
		
			$markup.eq(1).find('#it-confirmBtn').find('#' + $id).click(function(){
				var $bx = $(this).parent().find("a").index(this);
				var handler=typeof buttons[$bx].handler!='undefined'?buttons[$bx].handler:null;

				$('.it-messagebox').removeClass('it-messagebox-s');
				$('.it-modalConfirm').hide();
				setTimeout(function(){ 
					$('.it-messagebox').remove();
					$('.it-modalConfirm').remove();
					
					if (typeof handler == 'function'){
						handler.call();
					}else if(typeof handler == 'string'){
						window[handler]();
					}
				},250);
			});
		}
	}
	
	$markup.appendTo('body');

	var ConfirmBox = $('.it-messagebox');
	ConfirmBox.css('min-height', settings.height);
	ConfirmBox.find('p').css('padding', settings.padding);
	ConfirmBox.width(settings.width);
	ConfirmBox.find('.it-messagebox-effect').draggable({ 
			handle:'.it-title',
			appendTo: "body",	
			start:function() {
				$(this).css({
					"-webkit-transition":"none",
					"-moz-transition":"none",
					"-ms-transition":"none",
					"transition":"none"
				});
			}
		});
	me.show=function() {
		try{ $('input,select,textarea').blur(); } catch (e){}
		$('.it-messagebox').addClass('it-messagebox-s');
		$('.it-modalConfirm').show();
	}
	me.hide=function(){
		$('.it-messagebox').removeClass('it-messagebox-s');
		$('.it-modalConfirm').hide();
		setTimeout(function(){ 
			$('.it-messagebox').remove();
			$('.it-modalConfirm').remove();
		},250);
	}
	
	me.getSetting=function(){ return settings; }
	me.getId=function(){ return id; }
	setTimeout(function(){ me.show(); },100);
	
	return me;
}


//*********************** Editor ************************************//
function Editor(params){
	var defaults={
		modal:false,
		top:0,
		bottom:0,
		dataIndex:'editor',
		text:"Ini Editor",
		button:['bold', 'italic', 'underline', '-', 'justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull', '-', 'insertOrderedList', 'insertUnorderedList', '-', 'H1', 'H2', 'H3', 'H4', 'H5', 'H6', '-', 'undo', 'redo']
	}

	var settings=$.extend(defaults, params);	
	var me=this;
	var parrent=null;

	var div = $('<div class="WYSIWYG"><div/>');
	
	$('<iframe/>', {
		frameBorder:0,
		class:"frameText",
		name:settings.dataIndex,
		id:settings.dataIndex,
		css: {
			top:0,
			left:0,
			right:0,
			bottom:0,
			position:'absolute'
		}
	}).appendTo(div);
	
	div.prepend('<nav class="it-toolbar clearfix"><ul>');
	var toolbar=div.find('.it-toolbar ul');
	
	var tombol={
		bold:{data:'bold', icon:'<span class="fa fa-bold"></span>'},
		italic:{data:'italic', icon:'<span class="fa fa-italic"></span>'},
		underline:{data:'underline', icon:'<span class="fa fa-underline"></span>'},
		justifyLeft:{data:'justifyLeft', icon:'<span class="fa fa-align-left"></span>'},
		justifyCenter:{data:'justifyCenter', icon:'<span class="fa fa-align-center"></span>'},
		justifyRight:{data:'justifyRight', icon:'<span class="fa fa-align-right"></span>'},
		justifyFull:{data:'justifyFull', icon:'<span class="fa fa-align-justify"></span>'},	
		insertOrderedList:{data:'insertOrderedList', icon:'<span class="fa fa-list-ol"></span>'},
		insertUnorderedList:{data:'insertUnorderedList', icon:'<span class="fa fa-list-ul"></span>'},
		H1:{data:'formatBlock', icon:'<span class="Bold">H1</span>', value:'H1'},
		H2:{data:'formatBlock', icon:'<span class="Bold">H2</span>', value:'H2'},
		H3:{data:'formatBlock', icon:'<span class="Bold">H3</span>', value:'H3'},
		H4:{data:'formatBlock', icon:'<span class="Bold">H4</span>', value:'H4'},
		H5:{data:'formatBlock', icon:'<span class="Bold">H5</span>', value:'H5'},
		H6:{data:'formatBlock', icon:'<span class="Bold">H6</span>', value:'H6'},
		undo:{data:'undo', icon:'<span class="fa fa-undo"></span>'},
		redo:{data:'redo', icon:'<span class="fa fa-repeat"></span>'},
		separator:{data:'', icon:'<span class="separator"></span>'}
	};
	
	for(var i=0;i<settings.button.length;i++){
		settings.button[i]=settings.button[i]=='-'?'separator':settings.button[i];
		var btn=tombol[settings.button[i]];
		$("<a/>",{
			href:"javascript:void(0)",
			html:btn.icon,
			class:'it-btn',
			data:{
				commandName:btn.data,
				value:(typeof btn.value != 'undefined' ? btn.value : "")
			},
			click:function(e){
				$(this).toggleClass("active");

				var editor = div.find('.frameText').get(0);
				var contentWindow = editor.contentWindow;
				contentWindow.focus();
				contentWindow.document.execCommand($(this).data("commandName"), false, $(this).data('value'));
				contentWindow.focus();
				return false;
			} 
		}).appendTo(toolbar);
	}
	
	div.find('.frameText').load(function(){
		var editor = $(this).get(0);

		editor.contentWindow.document.open();
		editor.contentWindow.document.close();
		editor.contentWindow.document.designMode="on";
		var frameInner = div.find('.frameText').contents().find('body');
		frameInner.css('font-family', 'Tahoma');
		frameInner.css('font-size', '12px');
		frameInner.html(settings.text);
		frameInner.keyup(function(){ 
			div.find('textarea').val($(this).html()); 
		});
		
		var fDw = div.find('.frameDiv').outerWidth();
		var fDh = div.find('.frameDiv').outerHeight();
		
		div.find('.frameText')
			.width(fDw)
			.height(fDh);
			
		div.find('.frameOuterDiv').height(div.parents('#it-dialog').outerHeight());
	});
	
	div.find('a').wrap('<li>');
	
	
	me.renderTo=function(obj){
		obj = $(obj);
		div.append('<textarea class="textarea"></textarea>');
		div.find('.textarea').hide();	
		
		div.find('span[class="separator"]').parent().addClass('notHovered');
		var con=$('<div class="customEditorWrapper" '+getStyle(settings)+'/>');
		
		$(window).resize(function(){
			div.find('.frameText').css({width:(div.find('.frameDiv').outerWidth()), height:(div.find('.frameDiv').outerHeight())});
		});
		
		$(window).resize();
				
		div.appendTo(con);
		parrent=obj;
		con.css('top', settings.top);
		con.css('bottom', settings.bottom);
		con.appendTo(obj);

		obj
			.children()
			.children()
			.children('.frameText')
			.wrap('<div class="frameDiv"/>');
			
		obj
			.children()
			.children()
			.children('.frameDiv')
			.wrap('<div class="frameOuterDiv"/>');
				
	}
}

//*********************** ComboBox ************************************//
function ComboBox(params){
	var settings=$.extend({
		dataIndex:'combo',
		value:'Button',
		emptyText:'',
		format: null,
		defaultValue:'',
		autoLoad:true,
		allowBlank:true,
		disabled:false,
		width:'',
		temp:false,
		styled:{
			active:false,
			search:false,
			showKey:false,
			optionWidth:0,
			optionHeight:0
		},
		datasource:{
			type:'array',
			data:null,
			url:'',
		}
	},params);
	
	var me=this;
	var parrent=null;
	var word=null;
	var datatemp = null;

	me.events=new Event(me, settings);
	
	me.onLoad=function(act){me.events.add("onLoad",act);}
	me.onComplete=function(act){me.events.add("onComplete",act);}
	
	var disabled = settings.disabled == true ? "disabled" : "";
	var $width = settings.width != '' ? 'style="width:' + settings.width + 'px;"' : ''; 
	var konten='<div class="it-combobox-wrap"><select '+$width+' name="'+settings.dataIndex+'" id="'+settings.dataIndex+'" '+getStyle(settings)+disabled+' class="it-combobox"></select></div>';
	var $konten=$(konten);

	if (settings.styled.active){
		$konten.find("select").css("visibility", "hidden");
		$konten.append("<div class='it-combobox-styled'/>");
		$konten.append("<ol class='it-combobox-options'/>");

		if (settings.styled.search) {
			$konten.append("<input type='text' class='word'>");
			$konten.find("ol.it-combobox-options").css("top", "55px");
		}
		if (settings.styled.optionWidth > 0) $konten.find("ol").css("min-width", settings.styled.optionWidth);
		if (settings.styled.optionHeight > 0) $konten.find("ol").css("max-height", settings.styled.optionHeight);
		if (typeof settings.align != "undefined" && settings.align == "kanan") $konten.find("ol").css("right", 0);
	}


	me.getDataSource = function(params){
		$konten.find("select").empty();

		if (settings.emptyText) $konten.find("select").append("<option value=''>" + settings.emptyText);
		if (settings.temp && datatemp != null) { 
			settings.datasource.type = 'array'; 
			settings.datasource.data = datatemp;
		}
		var $value;
		var $sel;
		settings.datasource.params = params || settings.datasource.params;
		if (settings.datasource.type == 'array'){
			var row = settings.datasource.data;
			if (row != null){
				for (var i = 0; i < row.length; i++){
					$value = settings.format != null ? settings.format.format(row[i].key, row[i].value) : row[i].value;
					$sel = row[i].key == settings.defaultValue ? "selected" : "";
					dataParams = typeof row[i].params != 'undefined' ? jQuery.stringify(row[i].params) : '';
					$konten.find("select").append("<option value='" + row[i].key + "' " + $sel + " data-params='" + dataParams + "'>" + $value);
				}
				if (typeof row != 'undefined' && row.length && row.length == 1){
					$konten.find("option[value='']").remove();
					$konten.val(row[0].key);
					$konten.trigger('change');
				}
				setTimeout(function(){
					me.events.fire("onLoad",[row]);
					me.events.fire("onComplete",[row]);
				},1);
			}
		}else if (settings.datasource.type == 'ajax'){
			$konten.find("select").empty();
			if (settings.emptyText) $konten.find("select").append("<option value=''>" + settings.emptyText);

			$.ajax({
				url: settings.datasource.url,
				type: settings.datasource.method || "POST",
				data: settings.datasource.params || {},
				dataType:'json',
				success: function(data){
					$konten.find("select").empty();
					if (settings.emptyText) $konten.find("select").append("<option value=''>" + settings.emptyText);

					var row = data.rows;
					datatemp = row;
					if(typeof row != 'undefined' && row.length){
						for (var i=0; i<row.length; i++){
							$value = settings.format != null ? settings.format.format(row[i].key, row[i].value) : row[i].value;
							$sel = row[i].key == settings.defaultValue ? "selected" : "";
							$konten.find("select").append("<option value='" + row[i].key + "' " + $sel + " data-params='" + (typeof row[i].params != 'undefined' ? jQuery.stringify(row[i].params) : '') + "'>" + $value);
						}
					}

					if(settings.datasource.callback){
						settings.datasource.callback.call($konten, settings);
					}else{
						if (typeof row != 'undefined' && row.length && row.length == 1){
							$konten.find("option[value='']").remove();
							$konten.val(row[0].key);
							$konten.trigger('change');
						}
					}	
					me.events.fire("onLoad",[row]);
					me.events.fire("onComplete",[row]);
				}
			});
		}
	}
	me.onComplete(function(){
		if (settings.styled.active){
			$this = $konten.find("select");
			var numberOfOptions = $this.children('option').length;
			var $val = $this.find('option:selected').val() != "" && settings.styled.showKey ? $this.find('option:selected').val() : $this.find('option:selected').text();
			$konten.find("div.it-combobox-styled").text($val);

			$konten.find("ol.it-combobox-options").html("");
			for (var i = 0; i < numberOfOptions; i++) {
				$('<li/>', {
					html: (settings.styled.showKey ? "<span>" + $this.children('option').eq(i).val() + "</span>" : "") + $this.children('option').eq(i).text(),
					rel: $this.children('option').eq(i).val()
				}).appendTo($konten.find("ol"));
			}

			$konten.find("div.it-combobox-styled").click(function(e) {
				e.stopPropagation();
					
				$('div.it-combobox-styled.active').each(function() {
					$(this).removeClass('active').next('ol.it-combobox-options').hide();
				});
				$(this).toggleClass('active').next('ol.it-combobox-options').toggle();
				$konten.find("input").show();
			});

			$konten.find("li").click(function(e) {
				e.stopPropagation();
				
				var $vv = $(this).attr('rel') != "" && settings.styled.showKey ? $(this).attr('rel') : $(this).text();
				$konten.find("div.it-combobox-styled").text($vv).removeClass('active');
				$this.val($(this).attr('rel'));
				$konten.find("ol.it-combobox-options").hide();
				$konten.find("input").hide();
			});

			$(document).click(function() {
				$konten.find("div.it-combobox-styled").removeClass('active');
				$konten.find("ol.it-combobox-options").hide();
				$konten.find("input").hide();
			});

			$konten.find("input").click(function(e){
				e.stopPropagation();

				$konten.find("ol.it-combobox-options").show();
			});
			
			var timer;
			$konten.find("input").keyup(function(e){
				e.stopPropagation();
				var cWord = $(this).val();
				timer && clearTimeout(timer);
				setTimeout(function(){
					if (word != cWord){
						$('.loading').addClass('dont-show');

						me.getDataSource($.extend(settings.datasource.params, { word : cWord }));
						word = cWord;
					}
				},600);
			});
		}
	});

	if (settings.emptyText) $konten.find("select").append("<option value=''>" + settings.emptyText);
	if (settings.autoLoad){
		me.getDataSource();
	}
	
	me.events.add("hide", function(){ $konten.hide(); });
	me.events.add("show", function(){ $konten.show(); });
	me.events.add("blur", function(){
		var val = typeof me.val() != 'undefined' ? me.val() : '';
		var invalid = false;

		if (!settings.allowBlank && empty(val)) invalid = true;
		if (val.length < settings.minlength && !empty(val)) invalid = true;

		if (invalid) $(this).addClass("invalid");
		else $(this).removeClass("invalid");

		if (settings.styled.active){
			if (invalid) $konten.find("div.it-combobox-styled").addClass("invalid");
			else $konten.find("div.it-combobox-styled").removeClass("invalid");
		}
	});

	me.val = function(v){
		if (typeof v != "undefined"){
			$konten.find('option').filter('[value="' + v + '"]').prop("selected", true);

			if (settings.styled.active){
				$this = $konten.find("select");
				var $val = !empty($this.find('option:selected').val()) && settings.styled.showKey ? $this.find('option:selected').val() : $this.find('option:selected').text();
				$konten.find("div.it-combobox-styled").text($val);
			}
		}else{
			return $konten.find('option:selected').val();
		}
	}

	me.params = function(){
		return $konten.find('option:selected').data("params");
	}

	me.disable=function(dis){
		$konten.find("select").attr("disabled",(dis==null||dis));
	}
	me.getDOM=function(){return $konten;}

	$.extend(me, me.events.set($konten.find("select")));

	me.renderTo=function(obj){
		if (typeof settings.infoHolder == 'object'){
			$wrap = $('<div class=\"it-infoBox\"/>');
			$konten = $wrap.append($konten);
			
			var infoText = typeof settings.infoHolder.text != 'undefined' ? settings.infoHolder.text : '';
			infoText = typeof settings.infoHolder.icon != 'undefined' ? '<span class="fa fa-' + settings.infoHolder.icon + '"></span>' : infoText;
			$konten.prepend('<div class=\"keterangan '+settings.infoHolder.position+'\"> '+infoText+' </div>');
		}
		
		$konten.appendTo(obj);
		parrent=obj;
	}

	me.setDataSource=function(datasource){
		$.extend(settings.datasource, datasource);
		me.getDataSource();
	}
	me.getSetting=function(){ return settings; }
	me.getId=function(){ return settings.dataIndex; }
	return me;
}
//*********************** Radio ************************************//
function Radio(params){
	var settings = $.extend({
		dataIndex:'radio',
		value:'radio',
		defaultValue:'',
		autoLoad:true,
		allowBlank:true,
		disabled:false,
		width:'',
		newLine:false,
		datasource:{
			type:'array',
			data:null,
			url:'',
		}
	},params);
	
	var me=this;
	var parrent=null;
	var word=null;

	me.events=new Event(me, settings);
	
	me.onLoad=function(act){me.events.add("onLoad",act);}
	
	var disabled = settings.disabled == true ? "disabled" : "";
	var $width = settings.width != '' ? 'style="width:' + settings.width + 'px;"' : ''; 
	var konten='<div id="' + settings.dataIndex + '" class="it-radio-wrap" ' + getStyle(settings) + '></div>';
	var $konten=$(konten);

	me.getDataSource = function(params){
		$konten.html('');

		var $value;
		var $sel;
		settings.datasource.params = params || settings.datasource.params;
		if (settings.datasource.type == 'array'){
			var row = settings.datasource.data;
			if (row != null){
				for (var i = 0; i < row.length; i++){
					$value = settings.format != null ? settings.format.format(row[i].key, row[i].value) : row[i].value;
					$sel = row[i].key == settings.defaultValue ? "checked" : "";
					dataParams = typeof row[i].params != 'undefined' ? jQuery.stringify(row[i].params) : '';
					$konten.append("<input type='radio' " + disabled + " name='" + settings.dataIndex + "' id='" + settings.dataIndex + row[i].key + "' value='" + row[i].key + "' " + $sel + " data-params='" + dataParams + "'><label for='" + settings.dataIndex + row[i].key + "'>" + $value + "</label>" + (settings.newLine ? "<BR>" : ""));
				}
				setTimeout(function(){ me.events.fire("onLoad",[row]); },1);
			}
		}else if (settings.datasource.type == 'ajax'){
			$.ajax({
				url: settings.datasource.url,
				type: settings.datasource.method || "POST",
				data: settings.datasource.params || {},
				dataType:'json',
				success: function(data){
					var row = data.rows;
					datatemp = row;
					if(typeof row != 'undefined' && row.length){
						for (var i=0; i<row.length; i++){
							$value = settings.format != null ? settings.format.format(row[i].key, row[i].value) : row[i].value;
							$sel = row[i].key == settings.defaultValue ? "selected" : "";
							$konten.append("<input type='radio' " + disabled + " name='" + settings.dataIndex + "' id='" + settings.dataIndex + row[i].key + "' value='" + row[i].key + "' " + $sel + " data-params='" + (typeof row[i].params != 'undefined' ? jQuery.stringify(row[i].params) : '') + "'><label for='" + settings.dataIndex + row[i].key + "'>" + $value + "</label>" + (settings.newLine ? "<BR>" : ""));
						}
					}

					me.events.fire("onLoad",[row]);
				}
			});
		}
	}

	if (settings.autoLoad){ me.getDataSource(); }
	
	me.events.add("hide", function(){ $konten.hide(); });
	me.events.add("show", function(){ $konten.show(); });
	
	$konten.find("input").click(function(){
		if (!empty(me.val())) {
			$konten.removeClass("invalid");
		}
	});

	me.val = function(v){
		if (typeof v != "undefined"){
			$konten.find('input').filter('[value="' + v + '"]').prop("checked", true);
		}else{
			return $konten.find('input[type=radio]:checked').val();
		}
	}

	me.params = function(){
		return $konten.find('input:checked').data("params");
	}

	me.disable=function(dis){
		$konten.find("input").attr("disabled", (dis==null || dis));
	}
	me.getDOM=function(){return $konten;}

	$.extend(me, me.events.set($konten.find("input")));

	me.renderTo=function(obj){
		$konten.appendTo(obj);
		parrent=obj;
	}

	me.setDataSource=function(datasource){
		$.extend(settings.datasource, datasource);
		me.getDataSource();
	}

	me.getSetting=function(){ return settings; }
	me.getId=function(){ return settings.dataIndex; }
	return me;
}
//*********************** Column ************************************//

function Column(params){
	var settings=$.extend({
		columns:[]
	},params);
	
	var me=this;
	var parrent=null;
	var konten = '<table width="100%" '+getStyle(settings)+'><tr></tr></table>';
	var $konten=$(konten);
	
	for (var c = 0; c < settings.columns.length; c++){
		var $td = $("<td></td>");
		for (var i = 0; i < settings.columns[c].items.length; i++){
			if (items[i] === null)continue;

			var items = settings.columns[c].items;
			var item = null;
			if (typeof items[i].renderTo == 'function'){
				item=items[i];
			}else if(typeof items[i] == 'object'){
				item=createObject(items[i]);
			}
			
			item.renderTo($td);
		}
		$konten.find('tr').append($td);
	}

	me.renderTo=function(obj){
		$konten.appendTo(obj);
		parrent=obj;
	}
	me.getSetting=function(){ return settings; }
	return me;
}

//*********************** HTML ************************************//

function HTML(params){
	var settings=$.extend({
		konten:'',
		url:'',
		id:'',
		style: {
			display:'inline-block'
		}
	},params);
	
	var me=this;
	var id = settings.id == '' ? makeid() : settings.id;
	var parrent=null;
	var konten = '<div id="'+id+'" '+getStyle(settings)+'></div>';
	var $konten=$(konten);
	
	if (empty(settings.url)){
		if (typeof settings.konten == 'string'){
			//settings.konten = settings.konten.replace(/ /g, "&nbsp;");
			$konten.html(settings.konten);
		}else{
			var htmlKonten = typeof settings.konten == 'object' ? settings.konten : $(settings.konten);
			htmlKonten.appendTo($konten);
		}
	}else{
		$konten.load(settings.url);
	}
	
	me.setKonten=function(html){
		html.appendTo($konten);
	}
	me.renderTo=function(obj){
		$konten.appendTo(obj);
		parrent=obj;
	}
	me.getSetting=function(){ return settings; }
	me.getId=function(){ return id; }
	return me;
}

//*********************** Form ************************************//
function Form(params){
	var settings=$.extend({
		method:'POST',
		id:'Fm',
		url:'',
		width: 'auto',
		fieldDefaults:{
			labelWidth:100,
			fieldType:'text',
			valign:'center'
		},
		items:[]
	},params);
	
	var me=this;
	var parrent=null;
	var konten='<form method="'+settings.method+'" action="'+settings.url+'" name="'+settings.id+'" id="'+settings.id+'" '+getStyle(settings)+' enctype="multipart/form-data"></form>';
	var $konten=$(konten);

	var nItems = {};
	if (settings.items.length > 0){
		var width = settings.width != 'auto' ? "width='"+settings.width+"'" : "";
		var itemsContainer = "<table class='it-table-form' "+width+"></table>";
		var $itemsContainer = $(itemsContainer);
		for (var i = 0; i < settings.items.length; i++){
			if (settings.items[i] === null)continue;
			var items = settings.items;
			var item = null;
			var tr = "";
			if (items[i].labelPosition != undefined && items[i].labelPosition == 'top') {
				tr += "<tr><td width='"+settings.fieldDefaults.labelWidth+"' valign='" + settings.fieldDefaults.valign + "' colspan='2' style='padding:0 3px; white-space:nowrap'>" + items[i].fieldLabel + "</td></tr>";
				tr += "<tr><td class='form-field' " + getStyle(settings.items[i]) + " colspan='2'></td></tr>";
			}else{
				tr = "<tr><td width='"+settings.fieldDefaults.labelWidth+"' valign='" + settings.fieldDefaults.valign + "'>" + items[i].fieldLabel + "</td><td class='form-field' "+getStyle(settings.items[i])+"></td></tr>";
			}

			$tr = $(tr);
			
			if (typeof items[i].renderTo == 'function'){
				items[i].renderTo($tr.find('.form-field'));
				item = items[i];
				nItems[item.getId()] = item;
			}else if (typeof items[i] == 'object' && items[i].xtype == 'container'){
				for (var x = 0; x < items[i].items.length; x++){
					item=createObject(items[i].items[x]);
					var opt = item.getSetting();
					
					var $wrap = $('<div class="it-form-container"/>');
					if (typeof opt.fieldLabel != 'undefined'){
						if (typeof items[i].labelWidth != 'undefined') $wrap.css("width", items[i].labelWidth);
						$wrap.css("padding", "0 10px");
						$wrap.html(opt.fieldLabel);
						$tr.find('.form-field').append($wrap);
					}
					if (typeof opt.itemWidth != 'undefined') { 
						$wrap.css("width", opt.itemWidth);
						item.renderTo($wrap);
						$tr.find('.form-field').append($wrap);
					}else{
						item.renderTo($tr.find('.form-field'));
					}

					nItems[item.getId()] = item;
				}
			}else if(typeof items[i] == 'object' && items[i].xtype != 'container'){
				item=createObject(items[i]);
				item.renderTo($tr.find('.form-field'));
				nItems[item.getId()] = item;
			}
			
			$tr.appendTo($itemsContainer);
		}
		$itemsContainer.appendTo($konten);
	}

	me.setData=function(data){
		$.each( data, function( key, value ) {
			if ($konten.find("#" + key).attr("type") != "file"){
				if ($konten.find("#" + key).is(':checkbox')) {
					$konten.find("#" + key).prop("checked", (value == 1 ? true : false));
				} else {
					$konten.find("#" + key).val(value);
					$konten.find("#" + key).find("option").filter('[value="' + value + '"]').prop("selected", true);
					$konten.find("#" + key).find("input[type=radio]").filter('[value="' + value + '"]').prop("checked", true);
				}
			}
		});
	}
	me.setInvalid=function(data){
		$.each( data, function( key, value ) {
			$konten.find("#" + key).wrap('<div class=\"it-infoBox\"/>');
			$konten.find("#" + key).parent().append('<div class=\"it-infoBox-message\"> ' + value + ' </div>');
			$konten.find("#" + key).parent().find(".it-infoBox-message").css('left', $konten.find("#" + key).outerWidth() + 10);
			$konten.find("#" + key).addClass('invalid');
		});
	}
	me.validasi=function(msg){
		var msg = typeof msg == 'undefined'?true:msg;
		var valid = true;
		$.each( nItems, function( i, item ) {
			var allowBlank = typeof item.getSetting().allowBlank != "undefined" ? item.getSetting().allowBlank : true;
			var minlength = typeof item.getSetting().minlength != "undefined" ? item.getSetting().minlength : 0;
			var id = item.getId();
			var obj = $konten.find("#" + id);
			
			var val = "";

			var valRadio = obj.find("input[type=radio]:checked").val();
			var valSelect = obj.find("option:selected").val();
			var valInput = obj.val();
			
			if (empty(val) && valRadio != undefined) val = valRadio;
			if (empty(val) && valSelect != undefined) val = valSelect;
			if (empty(val) && valInput != undefined) val = valInput;

			obj.removeClass("invalid");

			if (!allowBlank && val == "") { obj.addClass("invalid"); valid = false; }
			if (val != "" && val.length < minlength) { obj.addClass("invalid"); valid = false; }
		});

		if (valid == false && msg){
			new MessageBox({type:'critical',width:'400',title:'Peringatan',message:"Silahkan Lengkapi Kolom Berwarna Merah"});
		}

		return valid;
	}
	me.getItem=function(idx){
		return nItems[idx];
	}
	me.serializeObject=function(){
		return $konten.serializeObject();
	}
	me.renderTo=function(obj){
		$konten.appendTo(obj);
		parrent=obj;
	}

	me.clear = function(){

		$.each($konten.serializeObject(), function( key, value ) {
			if ($konten.find("#" + key).attr("type") != "file"){
				$konten.find("#" + key).val("");
				//$konten.find("#" + key).find("option").filter('[value="' + value + '"]').prop("selected", true);
				//$konten.find("#" + key).prop("checked", (value == 1 ? true : false));
			}
		});
	}

	me.getSetting=function(){ return settings; }
	me.getId=function(){ return id; }
	return me;
}

//*********************** TextBox ************************************//
function TextBox(params){
	var settings=$.extend({
		dataIndex:'textfield',
		type:'text',
		size:20,
		maxlength:0,
		minlength:0,
		rows:50,
		cols:3,
		format:'',
		disabled:false,
		allowBlank:true,
		autoComplete:null,
		searchButton:false,
		defaultValue:''
	},params);

	var me=this;
	var parrent=null;
	me.events = new Event(me, settings); 
	maxlength = settings.maxlength > 0 ? ' maxlength="' + settings.maxlength + '" ' : '';
	minlength = settings.minlength > 0 ? ' minlength="' + settings.minlength + '" ' : '';
	disabled = settings.disabled > 0 ? ' disabled ' : '';
	readOnly = settings.readOnly > 0 ? ' readonly ' : '';
	value = settings.defaultValue != '' ? ' value="'+settings.defaultValue+'" ' : '';

	if (settings.type == 'password'){
		var konten='<input class="it-textbox" type="password" size="'+settings.size+'" name="'+settings.dataIndex+'" id="'+settings.dataIndex+'"'+maxlength+minlength+disabled+readOnly+value+getStyle(settings)+'>';
	}else if (settings.type == 'date'){
		var konten='<input class="it-textbox" type="text" size="'+settings.size+'" name="'+settings.dataIndex+'" id="'+settings.dataIndex+'"'+maxlength+minlength+disabled+readOnly+value+getStyle(settings)+'>';
	}else if (settings.type == 'numeric'){
		var konten='<input class="it-textbox" type="text" size="'+settings.size+'" name="'+settings.dataIndex+'" id="'+settings.dataIndex+'"'+maxlength+minlength+disabled+readOnly+value+getStyle(settings)+'>';
	}else if (settings.type == 'textarea'){
		value = settings.defaultValue;
		var konten='<textarea class="it-textbox" rows="'+settings.rows+'" cols="'+settings.cols+'" name="'+settings.dataIndex+'" id="'+settings.dataIndex+'"'+maxlength+minlength+disabled+readOnly+getStyle(settings)+'>'+value+'</textarea>';
	}else{
		var konten='<input class="it-textbox" type="'+settings.type+'" size="'+settings.size+'" name="'+settings.dataIndex+'" id="'+settings.dataIndex+'"'+maxlength+minlength+disabled+readOnly+value+getStyle(settings)+' >';
	}

	var $konten=$(konten);

	if (settings.autoComplete != null){
		$konten.autocomplete(settings.autoComplete);
	}
	
	me.autoComplete = function(set){
		$konten.autocomplete(set);
	}
	
	$konten.blur(function(){
		$(this).removeClass("invalid");
		if (!settings.allowBlank && $(this).val() == "") $(this).addClass("invalid");
		if ($(this).val().length < settings.minlength && $(this).val() != "") $(this).addClass("invalid");
	});

	$konten.keypress(function(e) {
		if(e.which == 13 && settings.type == 'text'){
			$(this).blur();
			var onSubmit = settings.onSubmit;

			if (typeof onSubmit == 'function'){
				onSubmit.call();
			}else if(typeof onSubmit == 'string'){
				window[onSubmit]();
			}

			e.preventDefault();
		}
	});
	
	$.extend(me, me.events.set($konten));

	if (settings.format != ''){
		if (typeof settings.format.money != 'undefined'){
			$konten.maskMoney({allowNegative:true, thousands:'.', decimal:',', defaultZero:false, precision:0, browser:{mozilla:true, msie:false}});
		}else{
			$konten.mask(settings.format);
		}
	}
	if (settings.type == 'date'){
		var today = new Date();
		$konten.datepicker({
			dateFormat:settings.dateformat||'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			yearRange:(today.getFullYear() - 60) + ":" + today.getFullYear(),
			onSelect:function (a, b) {
				$(this).focus();
			}
		});
	}
	if (settings.type == 'numeric'){
		var tmpAngka = "";
		$konten.keyup(function(e){
			if ($.isNumeric($(this).val()) == false && !empty($(this).val())){
				$(this).val(tmpAngka);
			}else{
				tmpAngka = $(this).val();
			}
		});
	}

	if (settings.type == 'mask') {
		$konten.change(function(e){
			if($(this).val().match(settings.mask)==null){
				$(this).val("");
				new MessageBox({
					type:'critical',width:'400',title:'Peringatan',
					message:settings.maskMsg||"Format tidak sesuai"
				});
			}
		});
	}
	
	me.val=function(v){
		if (typeof v == "undefined") { 
			return $konten.val() || $konten.find("input").val() || ""; 
		}
		else { $konten.val(v); $konten.find("input").val(v)}
	}
	me.renderTo=function(obj){
		if (typeof settings.infoHolder == 'object'){
			$wrap = $('<div class="it-infoBox"/>');
			$konten = $wrap.append($konten);
		
			var infoText = typeof settings.infoHolder.text != 'undefined' ? settings.infoHolder.text : '';
			infoText = typeof settings.infoHolder.icon != 'undefined' ? '<span class="fa fa-' + settings.infoHolder.icon + '"></span>' : infoText;
			$konten.prepend('<div class=\"keterangan '+settings.infoHolder.position+'\"> '+infoText+' </div>');		
		}
		if (settings.searchButton){
			$konten.attr("readonly", true);
			$wrap = $('<div class="it-search-box"/>');
			$konten = $wrap.append($konten);

			var btnS = new Button({
				iconCls:'search-plus',
				text:'Cari',
				handler:settings.handler || null
			});
			
			btnS.renderTo($konten);

			$konten.find("input").click(function(){
				$konten.find(".it-btn").click();
			});
		}

		$konten.appendTo(obj);
		parrent=obj;
	}
	
	me.getSetting=function(){ return settings; }
	me.getId=function(){ return settings.dataIndex; }
	return me;
}

//*********************** CheckBox ************************************//
function CheckBox(params){
	var settings=$.extend({
		dataIndex:'textfield',
		text:'', 
		disabled:false,
		newLine:false,
		value:'1'
	},params);

	var me=this;
	var parrent=null;
	disabled = settings.disabled > 0 ? ' disabled ' : '';

	var konten='<input type="checkbox" class="it-checkbox" name="'+settings.dataIndex+'" id="'+settings.dataIndex+'" value="'+settings.value+'" '+disabled+getStyle(settings)+'><label class="it-label" for="'+settings.dataIndex+'">' + settings.text + '</label>' + (settings.newLine ? '<BR>' : '');
	var $konten=$(konten);
	
	me.val=function(v){
		return $konten.is(":checked") ? "1" : "0";
	}
	me.renderTo=function(obj){
		$konten.appendTo(obj);
		parrent=obj;
	}

	me.getSetting=function(){ return settings; }
	me.getId=function(){ return settings.dataIndex; }
	return me;
}
//*********************** ImageBox ************************************//
function ImageBox(params){
	var settings=$.extend({
		URL : '',
		params : {},
		aspectRatio: true,
		scaleWidth:100,
		fotoBox:false, 
		src:''
	},params);
	
	var me=this;
	var parrent=null;

	me.events=new Event(me, settings);
	me.onComplete=function(act){me.events.add("onComplete",act);}

	var id=settings.id || makeid();
	var imageData = { x1:0, y1:0, x2:0, y2:0, img:'', imgWidth:0, imgHeight:0, divWidth:0, divHeight:0, w:0, h:0 }
	var clsFotoBox = settings.fotoBox == true ? "it-fotobox" : "";
	settings.src = settings.src == '' ? base_url + 'resources/framework/css/images/no-photo.jpg' : settings.src;
	disabled = settings.disabled > 0 ? ' disabled ' : '';
	var konten = '\
		<div id="'+id+'" class="it-imagebox '+clsFotoBox+'" '+getStyle(settings)+'>\
			<div><img src="'+settings.src+'" width="100" height="100" border="0" alt="Foto"></div>\
			<a href="#"><span class="fa fa-picture-o"></span> Sunting Foto<input type="file" name="img'+id+'" size="2"></a>\
		<div>';
		var $konten=$(konten);
	settings.params = $.extend({inputID: 'img' + id}, settings.params);
	$konten.find('input').ajaxFileUpload({
		'action': settings.URL,
		'params': settings.params,
		'onComplete': function(response) {
			var res = response;
			
			var cropHeight = settings.fotoBox == true ? Math.ceil((res.cropSize * 120) / 100) : res.cropSize;
			var cropper = "\
				<table width='100%'>\
				<tr>\
					<td valign='top'>\
					<div style='position:relative;width:"+res.divWidth+"px;height:"+res.divHeight+"px' id='croparea'>\
						<img src='"+res.Img+"' style='float: left; margin-right: 10px;max-width:400px;max-height:400px;' id='thumbnail' alt='Buat Thumbnail'/>\
						<div id='cropper' style='width:"+res.cropSize+"px;height:"+cropHeight+"px;border:1px solid black;background:#fff;opacity:0.3;'></div>\
					</div>\
					</td>\
				</tr>\
				</table>\
			";
			
			$cropper = $(cropper);

			imageData.imgWidth = res.imageWidth;
			imageData.imgHeight = res.imageHeight;
			imageData.divWidth = res.divWidth;
			imageData.divHeight = res.divHeight;
			imageData.img = res.Img;
			imageData.x2 = res.cropSize;
			imageData.y2 = cropHeight;
			imageData.w = res.cropSize;
			imageData.h = cropHeight;

			if (settings.aspectRatio){
				$cropper.find('#cropper').resizable({
					aspectRatio : res.cropSize/cropHeight,
					containment: "#croparea",
					resize: function (e, ui){
						set($(this));
					},
					stop: function (e, ui){
					}
				}); 
			}else{
				$cropper.find('#cropper').resizable({
					containment: "#croparea",
					resize: function (e, ui){
						set($(this));
					},
					stop: function (e, ui){
					}
				}); 
			}
			$cropper.find('#cropper').draggable({
				containment: "#croparea",
				drag: function (e, ui){
					set($(this));
				}
			}); 

			var  dialog = new Dialog({
				iconCls:'crop',
				title:'Potong',
				width:res.divWidth,
				height:res.divHeight + 65,
				padding:10,
				items:[{
					xtype:'html',
					konten:$cropper
				}, {
					xtype:'toolbar',
					position:'bottom',	
					items:[{
						xtype:'button',
						iconCls:'crop',
						text:'Crop',
						align:'kanan',
						handler:function(){
							scaleWidth = settings.scaleWidth == 0 ? imageData.w : settings.scaleWidth;
							imageData.scaleWidth = scaleWidth;
							$.ajax({
								type: 'POST',
								url: settings.URL,
								data: imageData,
								success: function(data){
									$konten.find("img").attr("src", data.Img);

									me.events.fire("onComplete",[data.Img]);
									dialog.close();
									dialog = null;
								},
								dataType: "json"
							});
						}
					}, {
						xtype:'button',
						iconCls:'times',
						text:'Tutup',
						align:'kanan',
						handler:function(){
							dialog.close();
							dialog = null;
						}
					}]
				}]
			});
		}
	});
	
	var set = function(data){
		imageData.x1 = data.position().left;
		imageData.y1 = data.position().top;
		imageData.x2 = data.position().left + data.width();
		imageData.y2 = data.position().top + data.height();
		imageData.w  = data.width();
		imageData.h  = data.height();
	}
	me.setImage=function(img){
		if (img != ''){
			$konten.find('img').attr('src', img);
		}else{
			$konten.find('img').attr('src', base_url + 'resources/framework/css/images/no-photo.jpg');
		}
	}
	me.getImage=function(){ return $konten.find('img').attr('src'); }
	me.renderTo=function(obj){
		$konten.appendTo(obj);
		parrent=obj;
	}
	me.getSetting=function(){ return settings; }
	me.getId=function(){ return id; }
	return me;
}

function Panel(params){
	var settings=$.extend({
		iconCls:'',
		title:'',
		height:0,
		column:false,
		items:[]
	},params);

	var me=this;
	var parrent=null;
	var id=makeid();
	var items=settings.items;
	
	var height = settings.height != 0 ? 'style="height:'+settings.height+'"' : '';
	var htmlTitle = settings.title == '' ? '' : '<div class="it-title"> <span class="fa fa-'+settings.iconCls+'"> </span> '+settings.title+'</div>';
	var konten='<article id="it-konten" id="'+id+'" '+getStyle(settings)+'>'+htmlTitle+'</article>';

	konten = settings.column ? '<section class="column" '+height+'>'+htmlTitle+'</section>' : konten;
	var $konten=$(konten);
	for (var i=0;i<items.length;i++){
		if (items[i] === null)continue;
		var item=null;
		
		if (typeof items[i].renderTo == 'function'){
			item=items[i];
		}else if(typeof items[i] == 'object'){
			item=createObject(items[i]);
		}
		
		item.renderTo($konten);
	}
	
	me.renderTo=function(obj){
		$konten.appendTo(obj);
		parrent=obj;
	}

	me.getSetting=function(){ return settings; }
	me.getId=function(){ return id; }
	return me;
}

//*********************** Media ************************************//
function Media(params){
	var defaults = {
		title:'Kotak Media',
		items:[],
		addURL:'',
		deleteURL:'',
		btnInsert:true,
		hiddenAlt:false,
		hiddenAlign:false,
		hiddenWidth:true,
		hiddenFalse:true,
		imgWidth:'100px',
		imgHeight:'100px',
		params:{},
		store: {
			type: 'json',
			params:{
				start: 0,
				limit: 20,
				orderBy: '',
				sortBy: ''
			}
		},
		handler:null,
		modal:true
	};

	var me=this;
	var id=makeid();
	var settings=$.extend(defaults, params);

	me.store = null;
	me.params = settings.store.params;
	me.data = null;
	me.selectedImg = null;

	me.events=new Event(me, settings);
	me.onInsert=function(act){me.events.add("onInsert",act);}
	
	if (typeof settings.store == 'function'){
		me.store = settings.store;
		me.data = me.store.getData();
	}else{
		me.store = new Store(settings.store);
	}	
	
	me.store.onLoad(function(data, params){
		me.data = data;
		me.params = params;
		me.load();
	});


	var icon=settings.iconCls!=''?'<span class="fa fa-'+settings.iconCls+'"></span>':'';
	var $dialog=$('\
		<div id="it-media-wrapper">\
			<div id="it-media-head" class="it-title"><span class="fa fa-picture-o"></span> '+settings.title +'<span id="it-media-close" title="Klik Ini Untuk Menutup Kotak Media"><span class="fa fa-times"></span> </div>\
			<div id="it-media-konten"></div>\
			<div id="it-media-konten-preview">\
				<div id="it-media-konten-preview-toggle" >\
					<div id="it-media-info"> <center style="margin-top:100px;"> <div class="galeri-kosong"></div> <br> <span class="fa fa-info"></span> Klik Gambar Untuk Melihat Detail Gambar.</center></div>\
					<div id="it-media-konten-preview-toggle-info" style="display:none">\
						<h2>Detail Gambar</h2>\
						<table width="100%">\
							<tr>\
								<td align="center">\
									<img src="" id="it-prev-img-preview">\
								</td>\
							</tr>\
						</table>\
						<div style="padding-bottom:10px; border-top:1px solid #ddd; margin-top:10px; padding-top:10px;">\
							<table width="100%">\
								<tr>\
									<td width="70">Judul</td>\
									<td><textarea cols="20" class="it-textbox" rows="2" id="it-prev-img-judul"></textarea></td>\
								</tr>\
								<tr class="sub-alt">\
									<td>Alt Text</td>\
									<td><input class="it-textbox" type="text" id="it-prev-img-alt"></td>\
								</tr>\
								<tr>\
									<td valign="top">Deskripsi</td>\
									<td><textarea cols="20" class="it-textbox" rows="5" id="it-prev-img-desc"></textarea></td>\
								</tr>\
								<tr class="sub-align">\
									<td>Align</td>\
									<td><select id="it-prev-img-align"><option value="">None<option value="left">Left<option value="center">Center<option value="Right">Right</select></td>\
								</tr>\
								<tr class="sub-width">\
									<td>Width</td>\
									<td><input class="it-textbox" type="text" id="it-prev-width"> X <input class="it-textbox" type="text" id="it-prev-height"></td>\
								</tr>\
								<tr>\
									<td></td>\
									<td><a href="#" class="it-btn btnGreen" id="it-media-simpan">Simpan</a></td>\
								</tr>\
							</table>\
						</div>\
					</div>\
				</div>\
			</div>\
			<div class="it-toolbar clearfix" id="it-media-bottom">\
				<ul><li><a href="#" class="it-btn btnGreen" style="margin-left:5px;"><span class="fa fa-plus"></span> Tambah</a><input type="file" style="position:absolute; left:0; width:60px; opacity:0;" name="addMedia" id="addMedia"></li>\
				<li><a href="#" class="it-btn" id="it-media-delete"><span class="fa fa-trash-o"></span> Hapus</a></li>\
				' + (settings.btnInsert == true ? '<li><a href="#" class="it-btn" id="it-media-insert"><span class="fa fa-picture-o"></span> Masukan Gambar</a></li>' : '') + 
			'</ul>	</div>\
		</div>');

	var $modal=$('<div id="it-modal-media"></div>');

	if(settings.modal) $modal.fadeIn(200);
	

	me.load = function(){
		
		if(settings.hiddenAlt) $('.sub-alt').remove();
		if(settings.hiddenAlign) $('.sub-align').remove();
		if(settings.hiddenWidth) $('.sub-width').remove();
		if(settings.hiddenHeight) $('.sub-height').remove();
		
		if (typeof me.data.rows != 'undefined'){
			$dialog.find('#it-media-konten').html('');
			for (var i = 0; i < me.data.rows.length; i++){
				if (typeof me.data.rows[i].size != 'undefined'){
					size = me.data.rows[i].size;
					el = size[0] > size[1] ? 'height' : 'width';
				}else{
					el = 'width';
				}
				
				var $konten = $('<div class="it-media-img" style="width:'+settings.imgWidth+';height:'+settings.imgHeight+'"><img style="'+el+':100%" src="'+base_url+me.data.rows[i].url+'" data-id="'+me.data.rows[i].id_media+'" title="'+base_url+me.data.rows[i].url+'" data-description="'+me.data.rows[i].description+'" data-title="'+me.data.rows[i].title+'" data-alt="'+me.data.rows[i].alt+'" data-align="'+me.data.rows[i].align+'" ></div>');
				$dialog.find('#it-media-konten').append($konten);
			}

			$dialog.find('#it-media-konten div').click(function(){
				var idx = $(this).index();
				me.selectedImg = me.data.rows[idx];
				var im = $(this).find("img");
				$dialog.find('#it-media-info').html('');
				$dialog.find('#it-media-konten-preview-toggle-info').fadeIn(300);
				$dialog.find('#it-prev-img-preview').attr('src',im.attr('src'));
				$dialog.find('#it-prev-img-judul').val(im.data('title'));
				$dialog.find('#it-prev-img-desc').val(im.data('description'));
				$dialog.find('#it-prev-img-alt').val(im.data('alt'));	
				$dialog.find('#it-prev-img-align').val(im.data('align'));	
				$dialog.find('#it-media-konten img').parent().removeClass('active');
				im.parent().addClass('active');

			});
	
		}
	}
	
	me.getSetting=function(){ return settings; }
	me.getId=function(){ return id; }
	
	$dialog.find('input[type=file]').ajaxFileUpload({
		'action': settings.addURL,
		'params': settings.params,
		'onComplete': function(response) {
			me.store.load();
		}
	});
	
	$dialog.find('#it-media-close').click(function(){
		me.close();
	});

	$dialog.find('#it-media-simpan').click(function(){
		
		var id = $dialog.find('.it-media-img.active').children('img').data('id');
		
		$.ajax({
			type: 'POST',
			url: settings.addURL,
			data: {
				mode:'simpan',
				title:$dialog.find('#it-prev-img-judul').val(),
				alt:$dialog.find('#it-prev-img-alt').val(),
				description:$dialog.find('#it-prev-img-desc').val(),
				align:$dialog.find('#it-prev-img-align').val(),
				id_media:id,
				params:settings.params
			},
			success: function(data){
				me.store.load();
			},
			dataType: 'json'
		});
	});
	
	$dialog.find('#it-media-delete').click(function(){
		$.ajax({
			type: 'POST',
			url: settings.deleteURL,
			data: {
				id_media:me.selectedImg.id_media,
				media_file:me.selectedImg.url
			},
			success: function(data){
				me.store.load();
				$dialog.find('#it-prev-img-preview').attr('src','');
				$dialog.find('#it-prev-img-judul').val('');
				$dialog.find('#it-prev-img-desc').val('');
				$dialog.find('#it-prev-img-alt').val('');	
				$dialog.find('#it-prev-img-align').val('');
			},
			dataType: 'json'
		});
	});
	
	$dialog.find('#it-media-insert').click(function(){
		me.selectedImg.align = $dialog.find('#it-prev-img-align').val();
		me.events.fire("onInsert",[me.selectedImg]);

		me.close();
	});

	me.hide=function() {
		$('#it-media-wrapper').hide();
		$('#it-modal-media').hide();
	}
	me.show=function() {
		$('#it-media-wrapper').show();
		$('#it-modal-media').show();
	}
	me.close=function(){
		me.hide();
		$('#it-media-wrapper').remove();
		$('#it-modal-media').remove();
		me=null;
	}
	
	$('body').append($modal);
	$('body').append($dialog);
	$(window).resize();

	return me;
}		
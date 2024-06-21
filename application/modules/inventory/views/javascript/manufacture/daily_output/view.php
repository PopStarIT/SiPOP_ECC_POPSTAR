<script type="text/javascript">  

	$(function () {
        "use strict";
		
		 $("#table_<?php echo $methodid ?>_daily_output").jqGrid({
			url: baseurl+'<?php echo $class_uri ?>/loaddata',
			mtype : "post",
			postData:{'q':'1','date':'<?php echo date("Y-m-d") ?>','<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'},
			datatype: "json",
			colNames:['ID','LINE','DATE','STYLE', 'PO', '1/2 JAM', 'PRICE', 'TARGET PRICE','TARGET PRODUKSI','07:30','08:00','08:30','09:00',
			          '09:30','10:00','10:30','11:00','11:30','13:00','13:30','14:00','14:30','15:00','15:30','16:00','OUTPUT','BLNC TRGT','REMARK','ID_LINE'],
			colModel:[
				{name:'r1',index:'r1', width:50,hidden: true },
				{name:'r2',index:'r2', width:60},
				{name:'r3',index:'r3', width:100,align:'center'},
				{name:'r4',index:'r4', width:150,align: 'center',search: false,formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
							    var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
                                var tanggal = row[rowId-1]['r3'];
						        var style = row[rowId-1]['r4'];
								const po = row[rowId-1]['r5'];
								
						        $('#form_<?php echo $methodid ?>_date_target').val(tanggal);
								$('#form_<?php echo $methodid ?>_style_target').val(style);
								$('#form_<?php echo $methodid ?>_po_target').val(po);
						        $('#m_target_daily').modal('show');  //---popupshow
								
						        // send_keterangan(badgenumber,Nama,keterangan,date_start,date_end);
						       //  $('#form_<?php echo $methodid ?>_badgenumber3').val(rowData.r2);
					      }
			        }
				},
				{name:'r5',index:'r5', width:90,search: false,align:'center'},  
				{name:'r33',index:'r33', width:60,search: false,align:'center'},  
				{name:'r7',index:'r7', width:80,align:'center',align:'center'},  
				{name:'r34',index:'r34', width:80,align:'center'},
				{name:'r9',index:'r9', width:80,align:'center'},
				{name:'r12',index:'r12', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
								var id = row[rowId-1]['r1'];
								const line = row[rowId-1]['r37'];
                                var tanggal2 = row[rowId-1]['r3'];
						        var style2 = row[rowId-1]['r4'];
								const jam = 'jam1';
								const po2 = row[rowId-1]['r5'];
								const target_production= row[rowId-1]['r9'];
								//alert(row[rowId-1]['r37']);
								if (style2 =="-"){
									var info="Data style masih kosong";
								    $('#lbl_info').text(info);
								}else{
									 $('#lbl_info').text(style2);
								
								}
								
								$('#form_<?php echo $methodid ?>_id_target').val(id);
								$('#form_<?php echo $methodid ?>_line_target').val(line);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal2);
								$('#form_<?php echo $methodid ?>_style_target2').val(style2);
								$('#form_<?php echo $methodid ?>_jam').val(jam);
								$('#form_<?php echo $methodid ?>_po_target2').val(po2);
								$('#form_<?php echo $methodid ?>_production_target').val(target_production);
								
						        $('#modal_target').modal('show'); 
					      }
			        }
				},
				{name:'r13',index:'r13', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
								var id3 = row[rowId-1]['r1'];
								const line3 = row[rowId-1]['r37'];
                                var tanggal3 = row[rowId-1]['r3'];
						        var style3 = row[rowId-1]['r4'];
								const jam3 = 'jam2';
								const po3 = row[rowId-1]['r5'];
								const target_production3= row[rowId-1]['r9'];
								const prev=row[rowId-1]['r12'];
								//alert(row[rowId-1]['r37']);
								if (style3 =="-"){
									var info2="Data style masih kosong";
								    $('#lbl_info').text(info2);
								}else{
									 $('#lbl_info').text(style3);
								
								}
								
								
								$('#form_<?php echo $methodid ?>_id_target').val(id3);
								$('#form_<?php echo $methodid ?>_line_target').val(line3);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal3);
								$('#form_<?php echo $methodid ?>_style_target2').val(style3);
								$('#form_<?php echo $methodid ?>_jam').val(jam3);
								$('#form_<?php echo $methodid ?>_po_target2').val(po3);
								$('#form_<?php echo $methodid ?>_production_target').val(target_production3);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev);
								
						       // $('#form_<?php echo $methodid ?>_date_target2').val(tanggal3);
								//$('#form_<?php echo $methodid ?>_style_target2').val(style3);
								//$('#form_<?php echo $methodid ?>_jam').val(jam3);
								//$('#form_<?php echo $methodid ?>_po_target2').val(po3);
						        $('#modal_target').modal('show'); 
					      }
			        }
				},
				{name:'r14',index:'r14', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
                                var id4 = row[rowId-1]['r1'];
								const line4 = row[rowId-1]['r37'];
                                var tanggal4 = row[rowId-1]['r3'];
						        var style4 = row[rowId-1]['r4'];
								const jam4 = 'jam3';
								const po4 = row[rowId-1]['r5'];
								const target_production4= row[rowId-1]['r9'];
								const prev4=row[rowId-1]['r13'];
								//alert(row[rowId-1]['r1']);
								if (style4 =="-"){
									var info4="Data style masih kosong";
								    $('#lbl_info').text(info4);
								}else{
									 $('#lbl_info').text(style4);
								
								}
								
								
								$('#form_<?php echo $methodid ?>_id_target').val(id4);
								$('#form_<?php echo $methodid ?>_line_target').val(line4);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal4);
								$('#form_<?php echo $methodid ?>_style_target2').val(style4);
								$('#form_<?php echo $methodid ?>_jam').val(jam4);
								$('#form_<?php echo $methodid ?>_po_target2').val(po4);
								$('#form_<?php echo $methodid ?>_production_target').val(target_production4);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev4);
							    $('#modal_target').modal('show'); 
					      }
				   }
				},
				{name:'r15',index:'r15', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
								var id5 = row[rowId-1]['r1'];
								const line5 = row[rowId-1]['r37'];
                                var tanggal5 = row[rowId-1]['r3'];
								var style5 = row[rowId-1]['r4'];
								const jam5 = 'jam4';
								const po5 = row[rowId-1]['r5'];
								const target_production5= row[rowId-1]['r9'];
								const prev5=row[rowId-1]['r14'];
								
								$('#form_<?php echo $methodid ?>_id_target').val(id5);
								$('#form_<?php echo $methodid ?>_line_target').val(line5);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal5);
								$('#form_<?php echo $methodid ?>_style_target2').val(style5);
								$('#form_<?php echo $methodid ?>_jam').val(jam5);
								$('#form_<?php echo $methodid ?>_po_target2').val(po5);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production5);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev5);
						        $('#modal_target').modal('show');  
					      }
				   }},
				{name:'r16',index:'r16', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
								var id6 = row[rowId-1]['r1'];
								const line6 = row[rowId-1]['r37'];
                                var tanggal6 = row[rowId-1]['r3'];
						        var style6 = row[rowId-1]['r4'];
								const jam6 = 'jam5';
								const po6 = row[rowId-1]['r5'];
								const target_production6= row[rowId-1]['r9'];
								const prev6=row[rowId-1]['r15'];
								
						        $('#form_<?php echo $methodid ?>_id_target').val(id6);
								$('#form_<?php echo $methodid ?>_line_target').val(line6);
								$('#form_<?php echo $methodid ?>_date_target2').val(tanggal6);
								$('#form_<?php echo $methodid ?>_style_target2').val(style6);
								$('#form_<?php echo $methodid ?>_jam').val(jam6);
								$('#form_<?php echo $methodid ?>_po_target2').val(po6);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production6);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev6);
						        $('#modal_target').modal('show');  
						      
					      }
				   }
				  },
				{name:'r17',index:'r17', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
								var id7 = row[rowId-1]['r1'];
								const line7 = row[rowId-1]['r37'];
                                var tanggal7 = row[rowId-1]['r3'];
						        var style7 = row[rowId-1]['r4'];
								const jam7 = 'jam6';
								const po7 = row[rowId-1]['r5'];
								const target_production7= row[rowId-1]['r9'];
								const prev7=row[rowId-1]['r16'];
								
								$('#form_<?php echo $methodid ?>_id_target').val(id7);
								$('#form_<?php echo $methodid ?>_line_target').val(line7);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal7);
								$('#form_<?php echo $methodid ?>_style_target2').val(style7);
								$('#form_<?php echo $methodid ?>_jam').val(jam7);
								$('#form_<?php echo $methodid ?>_po_target2').val(po7);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production7);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev7);
						        $('#modal_target').modal('show'); 
					      }
				   }
				 },
				{name:'r18',index:'r18', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
								var id8 = row[rowId-1]['r1'];
								const line8 = row[rowId-1]['r37'];
                                var tanggal8 = row[rowId-1]['r3'];
						        var style8 = row[rowId-1]['r4'];
								const jam8 = 'jam7';
								const po8 = row[rowId-1]['r5'];
								const target_production8= row[rowId-1]['r9'];
								const prev8=row[rowId-1]['r17'];
								
								$('#form_<?php echo $methodid ?>_id_target').val(id8);
								$('#form_<?php echo $methodid ?>_line_target').val(line8);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal8);
								$('#form_<?php echo $methodid ?>_style_target2').val(style8);
								$('#form_<?php echo $methodid ?>_jam').val(jam8);
								$('#form_<?php echo $methodid ?>_po_target2').val(po8);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production8);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev8);
						        $('#modal_target').modal('show'); 
					      }
				   }
				 },
				{name:'r19',index:'r19', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
								var id9 = row[rowId-1]['r1'];
								const line9 = row[rowId-1]['r37'];
								const target_production9= row[rowId-1]['r9'];
								const prev9=row[rowId-1]['r18'];
                                var tanggal9 = row[rowId-1]['r3'];
						        var style9 = row[rowId-1]['r4'];
								const jam9 = 'jam8';
								const po9 = row[rowId-1]['r5'];
								
								$('#form_<?php echo $methodid ?>_id_target').val(id9);
								$('#form_<?php echo $methodid ?>_line_target').val(line9);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production9);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev9);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal9);
								$('#form_<?php echo $methodid ?>_style_target2').val(style9);
								$('#form_<?php echo $methodid ?>_jam').val(jam9);
								$('#form_<?php echo $methodid ?>_po_target2').val(po9);
						        $('#modal_target').modal('show'); 
					      }
				   }
				 },
				{name:'r20',index:'r20', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
								var id10 = row[rowId-1]['r1'];
								const line10 = row[rowId-1]['r37'];
								const target_production10= row[rowId-1]['r9'];
								const prev10=row[rowId-1]['r19'];
                                var tanggal10 = row[rowId-1]['r3'];
						        var style10 = row[rowId-1]['r4'];
								const jam10 = 'jam9';
								const po10 = row[rowId-1]['r5'];
								
								$('#form_<?php echo $methodid ?>_id_target').val(id10);
								$('#form_<?php echo $methodid ?>_line_target').val(line10);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production10);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev10);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal10);
								$('#form_<?php echo $methodid ?>_style_target2').val(style10);
								$('#form_<?php echo $methodid ?>_jam').val(jam10);
								$('#form_<?php echo $methodid ?>_po_target2').val(po10);
						        $('#modal_target').modal('show'); 
					      }
				   }
				},
				{name:'r21',index:'r21', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
								var tanggal11 = row[rowId-1]['r3'];
						        var style11 = row[rowId-1]['r4'];
								const jam11 = 'jam10';
								const po11 = row[rowId-1]['r5'];
								var id11 = row[rowId-1]['r1'];
								const line11 = row[rowId-1]['r37'];
								const target_production11= row[rowId-1]['r9'];
								const prev11=row[rowId-1]['r20'];
								
								$('#form_<?php echo $methodid ?>_id_target').val(id11);
								$('#form_<?php echo $methodid ?>_line_target').val(line11);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production11);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev11);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal11);
								$('#form_<?php echo $methodid ?>_style_target2').val(style11);
								$('#form_<?php echo $methodid ?>_jam').val(jam11);
								$('#form_<?php echo $methodid ?>_po_target2').val(po11);
						        $('#modal_target').modal('show'); 
					      }
				   }
				},
				{name:'r22',index:'r22', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
                                var tanggal12 = row[rowId-1]['r3'];
						        var style12 = row[rowId-1]['r4'];
								const jam12 = 'jam11';
								const po12 = row[rowId-1]['r5'];
								var id12 = row[rowId-1]['r1'];
								const line12 = row[rowId-1]['r37'];
								const target_production12= row[rowId-1]['r9'];
								const prev12=row[rowId-1]['r21'];
								
								$('#form_<?php echo $methodid ?>_id_target').val(id12);
								$('#form_<?php echo $methodid ?>_line_target').val(line12);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production12);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev12);
								$('#form_<?php echo $methodid ?>_date_target2').val(tanggal12);
								$('#form_<?php echo $methodid ?>_style_target2').val(style12);
								$('#form_<?php echo $methodid ?>_jam').val(jam12);
								$('#form_<?php echo $methodid ?>_po_target2').val(po12);
						        $('#modal_target').modal('show'); 
					      }
				   }
				},
				{name:'r23',index:'r23', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
                                var tanggal13 = row[rowId-1]['r3'];
						        var style13 = row[rowId-1]['r4'];
								const jam13 = 'jam12';
								const po13 = row[rowId-1]['r5'];
								var id13 = row[rowId-1]['r1'];
								const line13 = row[rowId-1]['r37'];
								const target_production13= row[rowId-1]['r9'];
								const prev13=row[rowId-1]['r22'];
								
								$('#form_<?php echo $methodid ?>_id_target').val(id13);
								$('#form_<?php echo $methodid ?>_line_target').val(line13);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production13);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev13);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal13);
								$('#form_<?php echo $methodid ?>_style_target2').val(style13);
								$('#form_<?php echo $methodid ?>_jam').val(jam13);
								$('#form_<?php echo $methodid ?>_po_target2').val(po13);
						        $('#modal_target').modal('show'); 
					      }
				   }
				},
				{name:'r24',index:'r24', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
                                var tanggal14 = row[rowId-1]['r3'];
						        var style14 = row[rowId-1]['r4'];
								const jam14 = 'jam13';
								const po14 = row[rowId-1]['r5'];
								var id14 = row[rowId-1]['r1'];
								const line14 = row[rowId-1]['r37'];
								const target_production14= row[rowId-1]['r9'];
								const prev14=row[rowId-1]['r23'];
								
								$('#form_<?php echo $methodid ?>_id_target').val(id14);
								$('#form_<?php echo $methodid ?>_line_target').val(line14);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production14);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev14);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal14);
								$('#form_<?php echo $methodid ?>_style_target2').val(style14);
								$('#form_<?php echo $methodid ?>_jam').val(jam14);
								$('#form_<?php echo $methodid ?>_po_target2').val(po14);
						        $('#modal_target').modal('show'); 
					      }
				   }
				},
				{name:'r25',index:'r25', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
                                var tanggal15 = row[rowId-1]['r3'];
						        var style15 = row[rowId-1]['r4'];
								const jam15 = 'jam14';
								const po15 = row[rowId-1]['r5'];
								var id15 = row[rowId-1]['r1'];
								const line15 = row[rowId-1]['r37'];
								const target_production15= row[rowId-1]['r9'];
								const prev15=row[rowId-1]['r24'];
								
								$('#form_<?php echo $methodid ?>_id_target').val(id15);
								$('#form_<?php echo $methodid ?>_line_target').val(line15);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production15);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev15);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal15);
								$('#form_<?php echo $methodid ?>_style_target2').val(style15);
								$('#form_<?php echo $methodid ?>_jam').val(jam15);
								$('#form_<?php echo $methodid ?>_po_target2').val(po15);
						        $('#modal_target').modal('show'); 
					      }
				   }
				},
				{name:'r26',index:'r26', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
                                var tanggal16 = row[rowId-1]['r3'];
						        var style16 = row[rowId-1]['r4'];
								const jam16 = 'jam15';
								const po16 = row[rowId-1]['r5'];
								var id16 = row[rowId-1]['r1'];
								const line16 = row[rowId-1]['r37'];
								const target_production16= row[rowId-1]['r9'];
								const prev16=row[rowId-1]['r25'];
								
								$('#form_<?php echo $methodid ?>_id_target').val(id16);
								$('#form_<?php echo $methodid ?>_line_target').val(line16);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production16);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev16);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal16);
								$('#form_<?php echo $methodid ?>_style_target2').val(style16);
								$('#form_<?php echo $methodid ?>_jam').val(jam16);
								$('#form_<?php echo $methodid ?>_po_target2').val(po16);
						        $('#modal_target').modal('show'); 
					      }
				   }
				},
				{name:'r27',index:'r27', width:50,align:'center',formatter:'dynamicLink',
				   formatoptions: {
                           onClick: function (cellValue, rowId, rowData,e){
						        var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData');
                                var tanggal17 = row[rowId-1]['r3'];
						        var style17 = row[rowId-1]['r4'];
								const jam17 = 'jam16';
								const po17 = row[rowId-1]['r5'];
								var id17 = row[rowId-1]['r1'];
								const line17 = row[rowId-1]['r37'];
								const target_production17= row[rowId-1]['r9'];
								const prev17=row[rowId-1]['r26'];
								
								$('#form_<?php echo $methodid ?>_id_target').val(id17);
								$('#form_<?php echo $methodid ?>_line_target').val(line17);
								$('#form_<?php echo $methodid ?>_production_target2').val(target_production17);
								$('#form_<?php echo $methodid ?>_hasil_target').val(prev17);
						        $('#form_<?php echo $methodid ?>_date_target2').val(tanggal17);
								$('#form_<?php echo $methodid ?>_style_target2').val(style17);
								$('#form_<?php echo $methodid ?>_jam').val(jam17);
								$('#form_<?php echo $methodid ?>_po_target2').val(po17);
						        $('#modal_target').modal('show'); 
					      }
				   }
				},
				{name:'r35',index:'r35', width:70},
				{name:'r36',index:'r36', width:90},
				{name:'r32',index:'r32', width:100},
				{name:'r37',index:'r37', width:80,align:'center', hidden:true}
			],
			iconSet: "fontAwesome",
            iconSet: "fontAwesome",
            idPrefix: "g1_",
            rownumbers: true,
			rowNum:10,
			rowList:[10,20,30],
			pager: '#ptable_<?php echo $methodid ?>_daily_output',
            sortname: "r1",
            sortorder: "asc",
			shrinkToFit:false,
			autowidth: true,
			height: 250,		
			jsonReader: { repeatitems : false },
			viewrecords : true,
			gridview:true
			}); 
		$("#table_<?php echo $methodid ?>_daily_output").jqGrid("setColProp", "rn", {hidedlg: false});
				 	
		$("#table_<?php echo $methodid ?>_daily_output").jqGrid('navGrid','#ptable_<?php echo $methodid ?>_daily_output',{edit:false,add:false,del:false,view:false,search: false,refresh:false}
		   ,editOptions
		   ,{}
		   ,{}
		   ,{}
		   ,{}
			);
      			
		$("#table_<?php echo $methodid ?>_daily_output").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});


       
	});
	
		
	jQuery("#add_edit").click( function(){
		
		 var id = jQuery("#table_<?php echo $methodid ?>_absen_karyawan").jqGrid('getGridParam','selrow');
	      if (id)	{
			  var row = jQuery("#table_<?php echo $methodid ?>_absen_karyawan").jqGrid('getRowData',id); 
			    // $("#form_add_edit").fadeIn("slow");
				//   $('#form_add_edit').show('slow');
				 $("#form_add_edit").fadeIn("slow");
				 // alert("nomor id="+row.r5);
				$('#form_<?php echo $methodid ?>_badgenumber').val(row.r1);
			    $('#form_<?php echo $methodid ?>_in').val(row.r5);
				$('#form_<?php echo $methodid ?>_out').val(row.r6);
				$('#form_<?php echo $methodid ?>_keterangan').val(row.r8);
                $('#form_<?php echo $methodid ?>_tanggal_absen').val(row.r12);		
                $('#form_<?php echo $methodid ?>_absen_id').val(row.r13);				
	          //add_edit_<?php echo $methodid?>(row.r1);
		  } else {
				show_error("show",'Error','Please select row');
			 }
		setTimeout(function(){ 
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 100);
     });
    
     function add_style_<?php echo $methodid ?>(){
		// var row = jQuery("#table_<?php echo $methodid ?>_daily_output").jqGrid('getRowData',id); 
				// alert (row.r1);
				tgl = $('#form_<?php echo $methodid ?>_date').val();
				 $('#form_<?php echo $methodid ?>_date_daily').val(tgl);
				 $('#add_target_daily').modal('show'); 
				// select = $('#form_<?php echo $methodid ?>_list_style').val();
				// change_form_<?php echo $methodid ?>_detail_uom_id(data[0].partner_uom_id);
		      //  change_form_<?php echo $methodid ?>_list_style(select);
	 }
		 
    function add_<?php echo $methodid ?>_target(){
			// page_loading("show",'<?php echo $page_title ?> add/edit absen','Please Wait...');
			// var data = $("#form_<?php echo $methodid ?>_modal_target").serialize();
			 // const nilai = $("#form_<?php echo $methodid ?>_modal_target").serialize();
			 id_target = $('#form_<?php echo $methodid ?>_id_target').val();
			 line_target = $('#form_<?php echo $methodid ?>_line_target').val();
			 date_target = $('#form_<?php echo $methodid ?>_date_target2').val();
		     style_target = $('#form_<?php echo $methodid ?>_style_target2').val();
		     po_target = $('#form_<?php echo $methodid ?>_po_target2').val();
			 harga = $('#form_<?php echo $methodid ?>_harga').val();
		     jam = $('#form_<?php echo $methodid ?>_jam').val();
		     production_target = $('#form_<?php echo $methodid ?>_production_target2').val();
			 hasil_target = $('#form_<?php echo $methodid ?>_hasil_target').val();
			 
		
	   $("#table_<?php echo $methodid ?>_daily_output").jqGrid('setGridParam',{
			postData: {
			           	'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
						 ,id_daily:id_target
						 ,nama_line:line_target
			           	 ,date:date_target
			           	 ,style_target:style_target
			           	 ,po_target:po_target
			           	 ,harga:harga
			           	 ,jam:jam
						 ,production_target:production_target
			           	 ,hasil_target:hasil_target
						 ,q:'0'
			           } 
			    });
	  $("#table_<?php echo $methodid ?>_daily_output").trigger('reloadGrid');	
	  $("#modal_target").modal('toggle');
  	  					
	   }
	//  	$('#form_<?php echo $methodid ?>_list_style').on('change', function (event, clickedIndex, newValue, oldValue) {
    //	    style= $('#form_<?php echo $methodid ?>_list_style').val();
    //		alert('Nilai '+ style);
    //	      // alert(baseurl+'loader');
    //		  //purchase_order_get_purchase_data();
    //	   });

    function new_daily_<?php echo $methodid ?>(){
	  line = $('#form_<?php echo $methodid ?>_keterangan_line').val();
	  tanggal = $('#form_<?php echo $methodid ?>_date_daily').val();
	  style = $('#form_<?php echo $methodid ?>_list_style').val();
	  po = $('#form_<?php echo $methodid ?>_add_po').val();
	  lama_hari = $('#form_<?php echo $methodid ?>_lama_hari').val();
	  harga = $('#form_<?php echo $methodid ?>_harga').val();
	  harga_satuan = $('#form_<?php echo $methodid ?>_harga_satuan').val();
	  nilai_target = $('#form_<?php echo $methodid ?>_nilai_target').val();
	  new_style = $('#form_<?php echo $methodid ?>_new_style').val();
	 // alert(new_style);
	   
	      $("#table_<?php echo $methodid ?>_daily_output").jqGrid('setGridParam',{
			postData: {
			           	'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
	                     ,line:line
						 ,tanggal:tanggal
						 ,style:style
			           	 ,po:po
			           	 ,lama:lama_hari
			           	 ,harga:harga
			           	 ,harga_satuan:harga_satuan
			           	 ,nilai_target:nilai_target
						 ,new_style:new_style
						 ,q:'3'
			           } 
			    });
	      $("#table_<?php echo $methodid ?>_daily_output").trigger('reloadGrid');	
	    //  $("#add_target_daily").modal('toggle');
		    $("#add_target_daily").hide('slow');
	 
	}

	 
	 jQuery("#tutup").click( function(){
		$("#modal_target").hide("slow"); 
	
	 });
	 jQuery("#tutup2").click( function(){
	   $("#view_modal").hide("slow"); 
	   // $("#view_modal").fadeOut("slow"); 
	 });
	 
	 jQuery("#keluar").click( function(){
		$("#modal_target").hide("slow"); 
		// $("#modal_target").fadeOut("slow"); 
	 });
	 
	 jQuery("#batal2").click( function(){
		 $("#view_modal").hide("slow"); 
	 });
	 
 
	
	 //define handler for 'editSubmit' event
     var fn_editSubmit=function(response,postdata){
		// console.log(response);
		// alert(response);
        var json=response.responseText; //in my case response text form server is "{sc:true,msg:''}"
        var result=eval("("+json+")"); //create js object from server reponse
         return [result.sc,result.msg,null]; 
      }

        //define edit options for navgrid
        var editOptions={
            top: 50, left: 300, width: 300  
           ,closeOnEscape: true, afterSubmit: fn_editSubmit
		   ,beforeSubmitCell: function (rowid,celname,value,iRow,iCol) {
              return {'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'} 
            }
		     }
			 
	
	
		
     function fontColorFormat(cellvalue, options, rowObject) {
         var color = "black";
		 if (cellvalue != 0){
			  var color = "Red";
		 }
					 
         var cellHtml = "<span style='color:" + color + "' originalValue='" + cellvalue + "'>" + cellvalue + "</span>";
         return cellHtml;
     }
	 
	  function fontColor_M(cellvalue, options, rowObject) {
         var color = "green";
		//alert(cellvalue);
		 if (cellvalue >= 1 ){
			  var color = "Red";
		 }
					 
         var cellHtml = "<span style='color:" + color + ";font-weight: bold' originalValue='" + cellvalue + "'>" + cellvalue + "</span>";
         return cellHtml;
     }
	 
	  function fontColor_in(cellvalue, options, rowObject) {
         var color = "black";
		//alert(cellvalue);
		 if (cellvalue >= 1 ){
			  var color = "green";
		 }
					 
         var cellHtml = "<span style='color:" + color + ";font-weight: bold' originalValue='" + cellvalue + "'>" + cellvalue + "</span>";
         return cellHtml;
     }
	 
	  function font_keterangan_day(cellvalue, options, rowObject) {
         var color = "Black";
		// alert(cellvalue);
		 if (cellvalue == "Sunday   "){
			  var color = "Red";
			  //alert(color);
		 }
					 
         var cellHtml = "<span style='color:" + color + "' originalValue='" + cellvalue + "'>" + cellvalue + "</span>";
         return cellHtml;
     }

 function font_information(cellvalue, options, rowObject) {
         var color = "black";
			 
		 if (cellvalue == "M - Absen Tanpa Keterangan"){
			  var color = "Red";
		 }
		 
		 if (cellvalue == "TP - Tidak Absen Pulang" || cellvalue == "TM - Tidak Absen masuk"){
			  var color = "#A52A2A";
		 }
				 
         var cellHtml = "<span style='color:" + color + "' originalValue='" + cellvalue + "'>" + cellvalue + "</span>";
         return cellHtml;
     }	 
					
	$( document ).ready(function() {
		
	//	alert(baseurl+'<?php echo $class_uri ?>');
		
		$('#form_<?php echo $methodid ?>_date').datepicker(
			{
				format: 'yyyy-mm-dd',
				todayBtn: "linked",
				autoclose: true
			}
		);	
		
		
		$('#form_<?php echo $methodid ?>_date_start').datepicker(
			{
				format: 'yyyy-mm-dd',
				todayBtn: "linked",
				autoclose: true
			}
		);		
		
		$('#form_<?php echo $methodid ?>_date_end').datepicker(
			{
				format: 'yyyy-mm-dd',
				todayBtn: "linked",
				autoclose: true
			}
		);
      
	   init();
		
	});
	
	 

	function add_<?php echo $methodid ?>(){
		
		alert("coba");
	}
	
	function search_daily_<?php echo $methodid ?>(){
		//karyawan_name = $('#form_<?php echo $methodid ?>_karyawan_name').val();
		//departemen = $('#form_<?php echo $methodid ?>_karyawan_departemen').val();
		date = $('#form_<?php echo $methodid ?>_date').val();
		
		$("#table_<?php echo $methodid ?>_daily_output").jqGrid('setGridParam', 
			{
				postData: {
					'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
					 ,date:date
					 ,q:'1'
				} 
			}
		);
      
	  $('#table_<?php echo $methodid ?>_daily_output').trigger( 'reloadGrid' );
	}
	
	function copy_prev_<?php echo $methodid ?>(){
		date = $('#form_<?php echo $methodid ?>_date').val();
		
		$("#table_<?php echo $methodid ?>_daily_output").jqGrid('setGridParam', 
			{
				postData: {
					'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
					 ,date:date
					 ,q:'2'
				} 
			}
		);
      
	  $('#table_<?php echo $methodid ?>_daily_output').trigger( 'reloadGrid' );
	}
	
	function search_report_<?php echo $methodid ?>(){
		karyawan_departemen1 = $('#form_<?php echo $methodid ?>_karyawan_departemen1').val();
		karyawan_divisi = $('#form_<?php echo $methodid ?>_karyawan_divisi').val();
		karyawan_sub_divisi = $('#form_<?php echo $methodid ?>_karyawan_sub_divisi').val();
		karyawan_lama_kerja = $('#form_<?php echo $methodid ?>_karyawan_lama_kerja').val();
		
		date_start = $('#form_<?php echo $methodid ?>_date_start').val();
		date_end = $('#form_<?php echo $methodid ?>_date_end').val();
		//alert(karyawan_lama_kerja);
		//date_end = $('#form_<?php echo $methodid ?>_date_end').val();  
	
		$("#table_<?php echo $methodid ?>_report_absen").jqGrid('setGridParam', 
			{
				postData: {
					'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
					 ,karyawan_departemen:karyawan_departemen1
					 ,karyawan_divisi:karyawan_divisi
					 ,karyawan_sub_divisi:karyawan_sub_divisi
					 ,karyawan_lama_kerja:karyawan_lama_kerja
					 ,date_start:date_start
					 ,date_end:date_end
					
				} 
			
			}
		);
      
	  $('#table_<?php echo $methodid ?>_report_absen').trigger( 'reloadGrid' );
	}
	
	
	
	function print_<?php echo $methodid ?>_absen_1(format){
		karyawan_name = $('#form_<?php echo $methodid ?>_karyawan_name').val();
		departemen = $('#form_<?php echo $methodid ?>_karyawan_departemen').val();
		date = $('#form_<?php echo $methodid ?>_date').val();
       //alert (karyawan_name);
       var data_send={
         '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
         ,date:date
		 ,karyawan_name:karyawan_name
		 ,departemen:departemen
         ,format:format
         ,print:1
	   }; 
      $.ajax({
         type: "POST",
         url:baseurl + '<?php echo $class_uri ?>/loaddata',
         data: data_send,
         dataType : 'json',
         success: function(msg){
            if (!msg.valid){  
               show_error('show','error',msg.des);
               return false;
            }else{
               download_file('<?php echo $methodid ?>',msg.xfile,msg.namafile,'<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>'             ); 
               return false; 
            } 
         }
      }) ;   
	}
	
	function print_report_<?php echo $methodid ?>(format){
		departemen = $('#form_<?php echo $methodid ?>_karyawan_departemen1').val();
		divisi = $('#form_<?php echo $methodid ?>_karyawan_divisi').val();
		sub_divisi = $('#form_<?php echo $methodid ?>_karyawan_sub_divisi').val();
		lama_kerja = $('#form_<?php echo $methodid ?>_karyawan_lama_kerja').val();
		date_start = $('#form_<?php echo $methodid ?>_date_start').val();
		date_end = $('#form_<?php echo $methodid ?>_date_end').val();
       //alert (departemen +' - '+ sub_divisi);
       var data_send={
         '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
		 ,karyawan_departemen:departemen
		 ,karyawan_divisi:divisi
		 ,karyawan_sub_divisi:sub_divisi
		 ,karyawan_lama_kerja:lama_kerja
         ,date_start:date_start
		 ,date_end:date_end
		 ,format:format
         ,print:1
	   }; 
      $.ajax({
         type: "POST",
         url:baseurl + '<?php echo $class_uri ?>/loaddata_report',
         data: data_send,
         dataType : 'json',
         success: function(msg){
            if (!msg.valid){  
               show_error('show','error',msg.des);
               return false;
            }else{
               download_file('<?php echo $methodid ?>',msg.xfile,msg.namafile,'<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>'             ); 
               return false; 
            } 
         }
      }) ;   
	}
	

	function countDays(start, end /* [, holiday [, excludeDays]]  */) {
         // 3rd argument is array of holiday
      if (arguments.length >= 3) {
          var holiday = arguments[2];
           // convert to timestamp
          holiday = holiday.map( function(value, index, array) {
             return value.getTime();
              });     
             }
         else {
             var holiday = [];
       }
     
        // 4th argument is array of exclude days, default are Sunday and Saturday 
        if (arguments.length >= 4) {
           var excludeDays = arguments[3];
         }
         else {
              var excludeDays = [
                0      // Sunday 
                // 6       // Saturday
              ];
          }
     
         // milisecond per day
         var oneDay = 1000 * 24 * 60 *60;
     
         // different of start and end day
         var diff = Math.ceil((end.getTime() - start.getTime()) / oneDay);
          
         // count days
         var days = 0;
    for (var i = 0; i <= diff; i++) {
         
        // current date
        var now = new Date(start.getFullYear(), start.getMonth(), start.getDate() + i);
         
        // flag count the day or not
        var isCount = true;
         
        // exclude holiday
        if (holiday.indexOf(now.getTime()) > -1) {
            isCount = false;
        }
         
        // exclude days
        if (excludeDays.indexOf(now.getDay()) > -1) {
            isCount = false;
        }
         
        if (isCount) {
            days++;
        }
         
    }
     
    return days;
   }
</script>

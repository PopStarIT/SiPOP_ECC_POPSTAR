<script type="text/javascript">  
	$(function () {
        "use strict";
        $("#table_<?php echo $methodid ?>").jqGrid({
			url: baseurl+'<?php echo $class_uri ?>/loaddata',
			mtype : "post",
			postData:{'q':'1','date_start':'<?php echo date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "-1 month" ) ) ?>','date_end':'<?php echo date("Y-m-d") ?>','<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'},
			datatype: "json",
			colNames:['TIPE BC', 'NO', 'TANGGAL', 'NO', 'TANGGAL', 'PEMBELI/PENERIMA', 'KODE', 'NAMA', 'SAT', 'JUMLAH','VALAS','NILAI BARANG'],
			colModel:[
				{name:'r1',index:'r1', width:80, stype: 'select', search:true, searchoptions:{searchhidden: true, value: ':ALL;BC 3.3:BC 3.3;BC 3.0:BC 3.0;BC 2.6.1:BC 2.6.1;BC 2.7:BC 2.7;BC 4.1:BC 4.1;BC 2.5:BC 2.5;PEMUSNAHAN:PEMUSNAHAN'}},
				{name:'r2',index:'r2', width:60},  
				{name:'r3',index:'r3', width:120, search: false},  
				{name:'r4',index:'r4', width:100},  
				{name:'r5',index:'r5', width:120, search: false},  
				{name:'r6',index:'r6', width:140},
				{name:'r7',index:'r7', width:70},
				{name:'r8',index:'r8', width:140},  
				{name:'r9',index:'r9', width:40},
				{name:'r10',index:'r10', width:80,align:'right',formatter:'formatNumerics'},
				{name:'r11',index:'r11', width:40},  
				{name:'r12',index:'r12', width:120 ,align:'right',formatter:'formatNumerics'},
			],
			 iconSet: "fontAwesome",
            iconSet: "fontAwesome",
            idPrefix: "g1_",
            rownumbers: true,
			rowNum:10,
			rowList:[10,20,30],
			pager: '#ptable_<?php echo $methodid ?>',
            sortname: "r5",
            sortorder: "asc",
			shrinkToFit:false,
			autowidth: true,
			height: 250,		
			jsonReader: { repeatitems : false },
			viewrecords : true,
			gridview:true
		}); 
		$("#table_<?php echo $methodid ?>").jqGrid("setColProp", "rn", {hidedlg: false});
		
		$("#table_<?php echo $methodid ?>").jqGrid('setGroupHeaders', 
			{ useColSpanStyle: true, groupHeaders:[
			{startColumnName: 'r2', numberOfColumns: 2, titleText: '<em><center>DOC</center></em>'}
			, {startColumnName: 'r4', numberOfColumns: 2, titleText: '<em><center>SURAT JALAN</center></em>'}
			, {startColumnName: 'r7', numberOfColumns: 2, titleText: '<em><center>ITEM</center></em>'} ] });
	 
		$("#table_<?php echo $methodid ?>").jqGrid('navGrid','#ptable_<?php echo $methodid ?>',{edit:false,add:false,del:false,view:false, search: false});  
		$("#table_<?php echo $methodid ?>").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});  
		
    });
					
	$( document ).ready(function() {
		$('#form_<?php echo $methodid ?>_date_start').datepicker(
			{
				format: 'yyyy-mm-dd',
				todayBtn: "linked"
			}
		);	
		
		$('#form_<?php echo $methodid ?>_date_end').datepicker(
			{
				format: 'yyyy-mm-dd',
				todayBtn: "linked"
			}
		);						
	});
	
	function search_<?php echo $methodid ?>(){
		date_start = $('#form_<?php echo $methodid ?>_date_start').val();
		date_end = $('#form_<?php echo $methodid ?>_date_end').val();  
	  
		$("#table_<?php echo $methodid ?>").jqGrid('setGridParam', 
			{
				postData: {
					'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
					 ,date_start:date_start
					 ,date_end:date_end
				} 
			
			}
		);
        $('#table_<?php echo $methodid ?>').trigger( 'reloadGrid' );
	}
	
	function print_<?php echo $methodid ?>(format){
      date_start = $('#form_<?php echo $methodid ?>_date_start').val();
      date_end = $('#form_<?php echo $methodid ?>_date_end').val();  
      var data_send={
         '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
         ,date_start:date_start
         ,date_end:date_end
         ,format:format
         ,print:1
      }; 
      $.ajax({
         type: "POST",
         url:baseurl + '<?php echo $class_uri ?>/loaddata',
         data: data_send,
         dataType : 'json',
         complete: function(){
         },
         success: function(msg){
            if (!msg.valid){  
               show_error('show','error',msg.des);
               return false;
            }else{
               download_file('<?php echo $methodid ?>',msg.xfile,msg.namafile,'<?php echo $this->security->get_csrf_token_name() ?>','<?php echo $this->security->get_csrf_hash() ?>'); 
               return false; 
            } 
         }
      }) ;   
	}
	
</script>
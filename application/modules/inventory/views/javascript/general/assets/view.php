<script type="text/javascript"> 
	
	setTimeout(function(){ 
		$("#table_<?php echo $methodid ?>_asset").trigger('reloadGrid');
		$("#table_<?php echo $methodid ?>_asset").setGridWidth($('.grid_container_<?php echo $methodid; ?>_asset').width() - 20,true).trigger('resize');
	}, 1000);
	
	$(".form_tab_<?php echo $methodid ?>").on("click", "a", function (e) {
        e.preventDefault();
		setTimeout(function(){ 
			$("#table_<?php echo $methodid ?>_asset").trigger('reloadGrid');
			$("#table_<?php echo $methodid ?>_asset").setGridWidth($('.grid_container_<?php echo $methodid; ?>_asset').width() - 20,true).trigger('resize');
			
			$("#table_<?php echo $methodid ?>_incoming").trigger('reloadGrid');
			$("#table_<?php echo $methodid ?>_incoming").setGridWidth($('.grid_container_<?php echo $methodid; ?>_incoming').width() - 20,true).trigger('resize');
						
			$("#table_<?php echo $methodid ?>_outgoing").trigger('reloadGrid');
			$("#table_<?php echo $methodid ?>_outgoing").setGridWidth($('.grid_container_<?php echo $methodid; ?>_outgoing').width() - 20,true).trigger('resize');
						
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 1000);
    });
	
	$('#form_<?php echo $methodid ?>_item_category_id').on('change', function (event, clickedIndex, newValue, oldValue) {
		$("#table_<?php echo $methodid ?>_asset").trigger('reloadGrid');
	});
	
	$('#form_<?php echo $methodid ?>_item_id_incoming').on('change', function (event, clickedIndex, newValue, oldValue) {
		$("#table_<?php echo $methodid ?>_incoming").trigger('reloadGrid');
	});
	
	$('#form_<?php echo $methodid ?>_item_id_outgoing').on('change', function (event, clickedIndex, newValue, oldValue) {
		$("#table_<?php echo $methodid ?>_outgoing").trigger('reloadGrid');
	});
	
	function print_<?php echo $methodid ?>_asset(format){
      item_category_id = $('#form_<?php echo $methodid ?>_item_category_id').val();
      var data_send={
         '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
         ,item_category_id:item_category_id
         ,format:format
         ,print:1
      }; 
	  
      $.ajax({
         type: "POST",
         url:baseurl + '<?php echo $class_uri ?>/print_assets',
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
	
	function print_<?php echo $methodid ?>_incoming(format){
      item_id = $('#form_<?php echo $methodid ?>_item_id_incoming').val();
       // if(item_id == 0){
		  // show_error("show",'Error','Please select item');
	  // } else {
		   var data_send={
			 '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
			 ,item_id:item_id
			 ,format:format
			 ,print:1
		  }; 
		  
		  $.ajax({
			 type: "POST",
			 url:baseurl + '<?php echo $class_uri ?>/print_incoming',
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
	  // }
	}
	
	function print_<?php echo $methodid ?>_outgoing(format){
      item_id = $('#form_<?php echo $methodid ?>_item_id_outgoing').val();
      
	  // if(item_id == 0){
		  // show_error("show",'Error','Please select item');
	  // } else {
		  var data_send={
			 '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
			 ,item_id:item_id
			 ,format:format
			 ,print:1
		  }; 
		  
		  $.ajax({
			 type: "POST",
			 url:baseurl + '<?php echo $class_uri ?>/print_outgoing',
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
	  // }
	   
	}
	
	// $(function () {
        // "use strict";
        // $("#table_<?php echo $methodid ?>").jqGrid({
			// url: baseurl+'<?php echo $class_uri ?>/loaddata_assets',
			// mtype : "post",
			// postData:{'q':'1','<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'},
			// datatype: "json",
			// colNames:['CODE','NAME', 'UOM', 'STOCK'],
			// colModel:[
				// {name:'r1',index:'r1', width:150},
				// {name:'r2',index:'r2', width:300},
				// {name:'r3',index:'r3', width:50},  
				// {name:'r4',index:'r4', width:120,align:'right'}, 
			// ],
			 // iconSet: "fontAwesome",
            // iconSet: "fontAwesome",
            // idPrefix: "g1_",
            // rownumbers: true,
			// rowNum:10,
			// rowList:[10,20,30],
			// pager: '#ptable_<?php echo $methodid ?>',
            // sortname: "r1",
            // sortorder: "asc",
			// shrinkToFit:false,
			// autowidth: true,
			// height: 250,		
			// jsonReader: { repeatitems : false },
			// viewrecords : true,
			// gridview:true
		// }); 
		// $("#table_<?php echo $methodid ?>").jqGrid("setColProp", "rn", {hidedlg: false});
		
		// $("#table_<?php echo $methodid ?>").jqGrid('setGroupHeaders', 
			// { useColSpanStyle: true, groupHeaders:[
			// {startColumnName: 'r1', numberOfColumns: 3, titleText: '<em><center>ITEM</center></em>'}
		// ] });
		
		// $("#table_<?php echo $methodid ?>").jqGrid('navGrid','#ptable_<?php echo $methodid ?>',{edit:false,add:false,del:false,view:false, search: false});  
		// $("#table_<?php echo $methodid ?>").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});  
		
    // });
					
	// $( document ).ready(function() {
		// $('#form_<?php echo $methodid ?>_date_start').datepicker(
			// {
				// format: 'yyyy-mm-dd',
				// todayBtn: "linked"
			// }
		// );		
		
		// $('#form_<?php echo $methodid ?>_date_end').datepicker(
			// {
				// format: 'yyyy-mm-dd',
				// todayBtn: "linked"
			// }
		// );						
	// });
	
	
	
	// setTimeout(function(){ load_<?php echo $methodid ?>()}, 3000);
	
	// $(function () {
        // "use strict";
        // $("#table_<?php echo $methodid ?>_incoming").jqGrid({
			// url: baseurl+'<?php echo $class_uri ?>/loaddata_incoming',
			// mtype : "post",
			// postData:{'q':'1','<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'},
			// datatype: "json",
			// colNames:['FROM','NO', 'DATE', 'PRESENT', 'USED', 'LEFT', 'UNIT', 'NO', 'DATE', 'CAR'],
			// colModel:[
				// {name:'r1',index:'r1', width:90},
				// {name:'r2',index:'r2', width:200},
				// {name:'r3',index:'r3', width:80},  
				// {name:'r4',index:'r4', width:120,align:'right'},  
				// {name:'r5',index:'r5', width:120,align:'right'},  
				// {name:'r6',index:'r6', width:120,align:'right'},  
				// {name:'r7',index:'r7', width:80},
				// {name:'r8',index:'r8', width:120},
				// {name:'r9',index:'r9', width:120},
				// {name:'r10',index:'r10', width:150}
			// ],
			 // iconSet: "fontAwesome",
            // iconSet: "fontAwesome",
            // idPrefix: "g1_",
            // rownumbers: true,
			// rowNum:10,
			// rowList:[10,20,30],
			// pager: '#ptable_<?php echo $methodid ?>_incoming',
            // sortname: "r1",
            // sortorder: "asc",
			// shrinkToFit:false,
			// autowidth: true,
			// height: 250,		
			// jsonReader: { repeatitems : false },
			// viewrecords : true,
			// gridview:true
		// }); 
		// $("#table_<?php echo $methodid ?>_incoming").jqGrid("setColProp", "rn", {hidedlg: false});
		
		// $("#table_<?php echo $methodid ?>_incoming").jqGrid('setGroupHeaders', 
			// { useColSpanStyle: true, groupHeaders:[
			// {startColumnName: 'r1', numberOfColumns: 3, titleText: '<em><center>ITEM</center></em>'}
		// ] });
		
		// $("#table_<?php echo $methodid ?>_incoming").jqGrid('navGrid','#ptable_<?php echo $methodid ?>_incoming',{edit:false,add:false,del:false,view:false, search: false});  
		// $("#table_<?php echo $methodid ?>_incoming").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});  
		
    // });
	
	// function load_<?php echo $methodid ?>_incoming(){
		// item_id_incoming = $('#form_<?php echo $methodid ?>_item_id_incoming').val();  
		// $("#table_<?php echo $methodid ?>_incoming").jqGrid('setGridParam', 
			// {
				// postData: {
					// '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
					 // ,item_id:item_id_incoming
				// } 
			
			// }
		// );
        // $('#table_<?php echo $methodid ?>_incoming').trigger( 'reloadGrid' );
	// }
	
	// $('#form_<?php echo $methodid ?>_item_id_incoming').on('change', function (event, clickedIndex, newValue, oldValue) {
		// load_<?php echo $methodid ?>_incoming();
	// });
	
	// setTimeout(function(){ load_<?php echo $methodid ?>_incoming()}, 3000);
	
	// $(function () {
        // "use strict";
        // $("#table_<?php echo $methodid ?>_outgoing").jqGrid({
			// url: baseurl+'<?php echo $class_uri ?>/loaddata_outgoing',
			// mtype : "post",
			// postData:{'q':'1','<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'},
			// datatype: "json",
			// colNames:['TO','NO', 'DATE', 'QUANTITY', 'UNIT', 'NO', 'DATE', 'CAR'],
			// colModel:[
				// {name:'r1',index:'r1', width:90},
				// {name:'r2',index:'r2', width:200},
				// {name:'r3',index:'r3', width:80},  
				// {name:'r4',index:'r4', width:120,align:'right'},  
				// {name:'r5',index:'r5', width:120},  
				// {name:'r6',index:'r6', width:120},  
				// {name:'r7',index:'r7', width:80},
				// {name:'r8',index:'r8', width:120}
			// ],
			 // iconSet: "fontAwesome",
            // iconSet: "fontAwesome",
            // idPrefix: "g1_",
            // rownumbers: true,
			// rowNum:10,
			// rowList:[10,20,30],
			// pager: '#ptable_<?php echo $methodid ?>_outgoing',
            // sortname: "r1",
            // sortorder: "asc",
			// shrinkToFit:false,
			// autowidth: true,
			// height: 250,		
			// jsonReader: { repeatitems : false },
			// viewrecords : true,
			// gridview:true
		// }); 
		// $("#table_<?php echo $methodid ?>_outgoing").jqGrid("setColProp", "rn", {hidedlg: false});
		
		// $("#table_<?php echo $methodid ?>_outgoing").jqGrid('setGroupHeaders', 
			// { useColSpanStyle: true, groupHeaders:[
			// {startColumnName: 'r1', numberOfColumns: 3, titleText: '<em><center>ITEM</center></em>'}
		// ] });
		
		// $("#table_<?php echo $methodid ?>_outgoing").jqGrid('navGrid','#ptable_<?php echo $methodid ?>_outgoing',{edit:false,add:false,del:false,view:false, search: false});  
		// $("#table_<?php echo $methodid ?>_outgoing").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});  
		
    // });
	
	// function load_<?php echo $methodid ?>_outgoing(){
		// item_id_outgoing = $('#form_<?php echo $methodid ?>_item_id_outgoing').val();  
		// $("#table_<?php echo $methodid ?>_outgoing").jqGrid('setGridParam', 
			// {
				// postData: {
					// '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
					 // ,item_id:item_id_outgoing
				// } 
			
			// }
		// );
        // $('#table_<?php echo $methodid ?>_outgoing').trigger( 'reloadGrid' );
	// }
	
	// $('#form_<?php echo $methodid ?>_item_id_outgoing').on('change', function (event, clickedIndex, newValue, oldValue) {
		// load_<?php echo $methodid ?>_outgoing();
	// });
	
	// setTimeout(function(){ load_<?php echo $methodid ?>_outgoing()}, 3000);
</script>
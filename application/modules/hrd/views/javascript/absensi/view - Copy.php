<script type="text/javascript">  
	$(function () {
        "use strict";
		
        $("#table_<?php echo $methodid ?>").jqGrid({
			url: baseurl+'<?php echo $class_uri ?>/loaddata',
			mtype : "post",
			postData:{'q':'1','date':'<?php echo date("Y-m-d") ?>','<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'},
			datatype: "json",
			colNames:['ABSEN ID','NAMA','DIVISI','SUB DIVISI', 'TANGGAL','MASUK', 'KELUAR', 'STATUS MASUK', 'STATUS KELUAR', ''],
			colModel:[
				{name:'r1',index:'r1', width:70,editable:true,edittype:'text',editoptions:{size:'5',readonly: 'readonly'}},
				{name:'r2',index:'r2', width:200},
				{name:'r3',index:'r3', width:150},
				{name:'r4',index:'r4', width:100},
				{name:'r5',index:'r5', width:100,editable:true,edittype:'text',editoptions:{size:'5',readonly: 'readonly'}},
				{name:'r6',index:'r6', width:90,search: false,editable:true,edittype:'text',editoptions: {maxlength: 15},label:'test'},  
				{name:'r7',index:'r7', width:90,search: false,editable:true},  
				{name:'r8',index:'r8', width:100,search: true,formatter:fontColorFormat},  
				{name:'r9',index:'r9', width:100,search: false,editable:true,edittype:'select',editoptions:{value:{S:'Sakit',C:'Cuti',I:'Ijin'}}},
				 {name: '', index: 'action', width:75, sortable:false, formatter:'actions',
                   formatoptions:{
                   editbutton: true, delbutton:true, mtype: "GET",
				   editOptions:{
					    caption: 'Edit',
                        msg: 'Anda ingin menghapus record ini?',
						bSubmit: 'Hapus',
                        mtype: 'GET'
				   },
				   delOptions:{
                        caption: 'Hapus',
                        msg: 'Anda ingin menghapus record ini?',
                        bSubmit: 'Hapus',
                        mtype: 'GET',
                        url: 'contacts/listrowdelete',
                        bCancel: 'Batal'
                    } }}
			],
			iconSet: "fontAwesome",
            iconSet: "fontAwesome",
            idPrefix: "g1_",
            rownumbers: true,
			rowNum:10,
			rowList:[10,20,30],
			pager: '#ptable_<?php echo $methodid ?>',
            sortname: "r1",
            sortorder: "asc",
			shrinkToFit:false,
			autowidth: true,
			height: 250,		
			jsonReader: { repeatitems : false },
			viewrecords : true,
			gridview:true		
		}); 
		$("#table_<?php echo $methodid ?>").jqGrid("setColProp", "rn", {hidedlg: false});
				 	
		$("#table_<?php echo $methodid ?>").jqGrid('navGrid','#ptable_<?php echo $methodid ?>',{edit:true,add:false,del:false,view:false, search: false}
		   ,editOptions
		   ,{}
		   ,{}
		   ,{}
		   ,{}
			);
      			
		$("#table_<?php echo $methodid ?>").jqGrid('filterToolbar',{stringResult: true,searchOnEnter : false, defaultSearch: 'cn', ignoreCase: false});  
		
    });
	
	jQuery("#add_edit").click( function(){
		 var id = jQuery("#table_<?php echo $methodid ?>").jqGrid('getGridParam','selrow');
	      if (id)	{
			  var row = jQuery("#table_<?php echo $methodid ?>").jqGrid('getRowData',id); 
			    // $("#form_add_edit").fadeIn("slow");
				//   $('#form_add_edit').show('slow');
				 $("#form_add_edit").fadeIn("slow");
				 // alert("nomor id="+row.r5);
				$('#form_<?php echo $methodid ?>_absen_id').val(row.r1);
				$('#form_<?php echo $methodid ?>_tgl_absen').val(row.r5);
				$('#form_<?php echo $methodid ?>_in').val(row.r6);
				$('#form_<?php echo $methodid ?>_out').val(row.r7);
				$('#form_<?php echo $methodid ?>_keterangan').val(row.r9);				
	          //add_edit_<?php echo $methodid?>(row.r1);
		  } else {
				show_error("show",'Error','Please select row');
			 }
		setTimeout(function(){ 
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 100);
     });
	 
	  function add_edit_<?php echo $methodid ?>(id,){
	    // alert("nomor id="+id);
        page_loading("show",'<?php echo $page_title ?>','Please Wait...');		 
	   $.ajax({
		   url: baseurl+'loader',
		   data: {
				'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
				,param: 'data_purchase_order'
				,id : id
			}
	   })
      }
	 
	 jQuery("#tutup").click( function(){
		$("#form_add_edit").hide("slow"); 
	 });
	 jQuery("#batal").click( function(){
		$("#form_add_edit").hide("slow"); 
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
		  
		function mypricecheck(value, colname) {
            if (value < 0 || value >20) 
              return [false,"Please enter value between 0 and 20"];
           else 
              return [true,""];
           }
		   
		function myelem (value, options) {
          var el = document.createElement("input");
             el.type="text";
             el.value = value;
          return el;
         }
 
     function myvalue(elem, operation, value) {
       if(operation === 'get') {
            return $(elem).val();
        } else if(operation === 'set') {
            $('input',elem).val(value);
        }
    }   
		
     function fontColorFormat(cellvalue, options, rowObject) {
         var color = "green";
		 if (cellvalue == "Terlambat"){
			  var color = "Red";
		 }
		
		
         var cellHtml = "<span style='color:" + color + "' originalValue='" + cellvalue + "'>" + cellvalue + "</span>";
         return cellHtml;
     }		
					
	$( document ).ready(function() {
		$('#form_<?php echo $methodid ?>_date').datepicker(
			{
				format: 'yyyy-mm-dd',
				todayBtn: "linked"
			}
		);	
		
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
	
	function add_<?php echo $methodid ?>(){
		
		alert("coba");
	}
	
	function search_<?php echo $methodid ?>(){
		karyawan_name = $('#form_<?php echo $methodid ?>_karyawan_name').val();
		departemen = $('#form_<?php echo $methodid ?>_karyawan_departemen').val();
		date = $('#form_<?php echo $methodid ?>_date').val();
		//date_end = $('#form_<?php echo $methodid ?>_date_end').val();  
	
		$("#table_<?php echo $methodid ?>").jqGrid('setGridParam', 
			{
				postData: {
					'<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
					 ,karyawan_name:karyawan_name
					 ,departemen:departemen
					 ,date:date
					
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

<script type="text/javascript">  
function nav_button_<?php echo $function ?>(){
   var id = jQuery("#table_<?php echo $methodid ?>").jqGrid('getGridParam','selrow');
  // alert(baseurl + '<?php echo $class_uri ?>/print_purchase_order');
		if (id) { 
			var row = jQuery("#table_<?php echo $methodid ?>").jqGrid('getRowData',id);
			swal({
				title: "Confirm Print ?",
            input: 'select',
            inputOptions: {
               'pdf': 'PDF',
               'xlsx': 'XLSX',
            },
				type: "question",
				dangerMode: true,
				showCancelButton: !0,
				confirmButtonClass: "btn btn-danger m-1",
				cancelButtonClass: "btn btn-secondary m-1",
				confirmButtonText: "Print",
				cancelButtonText: "Cancel",
				backdrop: true,
				allowOutsideClick : false,
			}).then((result) => {
				if (result.value) {
               format = result.value;
               
               var data_send={
                  '<?php echo $this->security->get_csrf_token_name() ?>': '<?php echo $this->security->get_csrf_hash() ?>'
                  ,purchase_order_id:row.r1
                  ,format:format
               }; 
      
               $.ajax({
                  type: "POST",
                  url:baseurl + '<?php echo $class_uri ?>/print_purchase_order',
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
               
               
               
               // $('#form_<?php echo $methodid ?>_print').submit();
				} else if (result.dismiss === swal.DismissReason.cancel) {
					swal.closeModal();	
				}
			});
		} else {
			show_error("show",'Error','Please select row');
		}
	}
</script>
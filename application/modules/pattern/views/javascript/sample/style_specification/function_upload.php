<script type="text/javascript">  
	function nav_button_<?php echo $function ?>()
	{	
		var id = jQuery("#table_<?php echo $methodid ?>").jqGrid('getGridParam','selrow');
		//alert(id);
	//	if (id) { 
	//		var row = jQuery("#table_echo $methodid ?>").jqGrid('getRowData',id);   
//
	//		$('#panel_content_echo $methodid ?>').hide();
	//		$('#panel_content_form_ echo $methodid ?>').show();
	//		$('.form_title_ echo $methodid ?>').html('Edit echo $page_title ?>');
	//		
	//		show_error("show",'masuk ','Proses Upload');
	//		//edit_ echo $methodid?>(row.r1);
	//		
	//		
	//	} else {
			$('.form_title_<?php echo $methodid ?>').html('.:: Upload excel <?php echo $page_title ?>');
			$('#panel_content_<?php echo $methodid ?>').hide();
			//$('#panel_uploadexcel_form_ echo $methodid ?>').show();
			$('#panel_content_form_upload_<?php echo $methodid ?>').show();
			//show_error("show",'Error','Please select row');
	//	}
		
		setTimeout(function(){ 
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 100);
	}
</script>
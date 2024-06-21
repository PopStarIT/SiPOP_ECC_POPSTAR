<script type="text/javascript">  
	function nav_button_<?php echo $function ?>()
	{	
		var id = jQuery("#table_<?php echo $methodid ?>").jqGrid('getGridParam','selrow');
		//alert(id);
		if (id) { 
			var row = jQuery("#table_<?php echo $methodid ?>").jqGrid('getRowData',id);   
			//alert(row);
		//$("#tab_<?php echo $methodid; ?>_biodata").removeAttr("data-toggle");
		//$("#tab_<?php echo $methodid; ?>_keluarga").removeAttr("data-toggle");
		//$("#tab_<?php echo $methodid; ?>_dokumen").removeAttr("data-toggle");
		
		$("#tab_<?php echo $methodid; ?>_biodata").addClass("tab_disabled");
		$("#tab_<?php echo $methodid; ?>_keluarga").addClass("tab_disabled");
		$("#tab_<?php echo $methodid; ?>_dokumen").addClass("tab_disabled");
		
			$('#panel_content_<?php echo $methodid ?>').hide();
			$('#panel_content_form_upload_<?php echo $methodid ?>').hide();
			$('#panel_content_form_<?php echo $methodid ?>').show();
			$('.form_title_<?php echo $methodid ?>').html('Edit <?php echo $page_title ?>');
			
		
			
			edit_<?php echo $methodid?>(row.r1);
			
		} else {
			show_error("show",'Error','Please select row');
		}
		
		setTimeout(function(){ 
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 100);
	}
</script>
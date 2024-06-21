<script type="text/javascript">  
	function nav_button_<?php echo $function ?>()
	{	
		var id = jQuery("#table_<?php echo $methodid ?>").jqGrid('getGridParam','selrow');
		if (id) { 
			var row = jQuery("#table_<?php echo $methodid ?>").jqGrid('getRowData',id);   

			$('#panel_content_<?php echo $methodid ?>').hide();
			$('#panel_content_form_<?php echo $methodid ?>').show();
			$('.form_title_<?php echo $methodid ?>').html('Supply <?php echo $page_title ?>');
			
			$("#tab_<?php echo $methodid; ?>_header").removeAttr("data-toggle");
			$("#tab_<?php echo $methodid; ?>_header").addClass( "tab_disabled");
			
			supply_<?php echo $methodid?>(row.r1);
			
			setTimeout(function(){ 
				$("#tab_<?php echo $methodid; ?>_supply").attr("data-toggle","tab");
				$("#tab_<?php echo $methodid; ?>_supply").removeClass( "tab_disabled");
				$("#tab_<?php echo $methodid; ?>_supply").click();
			}, 100);
			
		} else {
			show_error("show",'Error','Please select row');
		}
	}
</script>
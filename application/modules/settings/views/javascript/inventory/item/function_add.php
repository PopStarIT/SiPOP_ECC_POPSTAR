<script type="text/javascript">  
	function nav_button_<?php echo $function ?>(){
	
		$('#panel_content_<?php echo $methodid ?>').hide();
		$('#panel_content_form_<?php echo $methodid ?>').show();
		
		$('.form_title_<?php echo $methodid ?>').html('New Item');
		$('#form_<?php echo $methodid ?>_item_base_code').prop('readonly', false);	
		$('#form_<?php echo $methodid ?>_item_base_id').val('');
		$('#form_<?php echo $methodid ?>_item_base_code').val('');
		$('#form_<?php echo $methodid ?>_item_base_name').val('');
		
		setTimeout(function(){ 
			$('.tab_scrollbar').getNiceScroll().resize(); 
		}, 100);		
	}
</script>
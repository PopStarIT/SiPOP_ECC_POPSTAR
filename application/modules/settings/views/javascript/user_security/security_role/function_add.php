<script type="text/javascript">

	function nav_button_<?php echo $function ?>(){
		$('#panel_content_<?php echo $methodid ?>').hide();
		$('#panel_content_form_<?php echo $methodid ?>').show();
		
		$('.form_title_<?php echo $methodid ?>').html('Add <?php echo $page_title ?>');
		
		$('#form_<?php echo $methodid ?>_role_id').val('');
		$('#form_<?php echo $methodid ?>_role').val('');
		
		$('.security_role_token_id').prop('checked', false);
	}
</script>
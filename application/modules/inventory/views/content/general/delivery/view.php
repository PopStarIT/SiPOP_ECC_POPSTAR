<div class="container-fluid">
	<div id="panel_content_<?php echo $methodid ?>">
		<?php $this->load->view($path_template.'/library/content/dashboard_table'); ?>
	</div>
	
	<div id="panel_content_form_<?php echo $methodid ?>" style="display:none">
		<?php
			if(isset($view_load_form)){
				$this->load->view('content/'.$view_load_form);
			}
		?>
	</div>
</div>
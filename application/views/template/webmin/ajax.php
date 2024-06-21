<?php 
//print_r($view_load);
	if(isset($view_load)){
		if(is_array($view_load)){
			foreach($view_load as $dt_load){
				$this->load->view('content/'.$dt_load);
			}
		} else {
			$this->load->view('content/'.$view_load);
		}
	}
?>
		
<?php $this->load->view($path_template.'/include/global/ajax_javascript'); ?>
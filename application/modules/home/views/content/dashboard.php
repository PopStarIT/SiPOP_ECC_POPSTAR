<div class="container-fluid">
  <div class="tab-content">
   <div class="row">
	 <div class="col-xl-12 mb-10 ml-10">
	  <div class="row">
		<div class="col-xl-6">
		  <div class="row">
			<div class="col-xl-12">
			 <?php 
					$this->ecc_library->form('text_line_readonly','Name',"form_".$methodid,'nama','','','10');
			 ?>
			 </div>
		   </div>
		   <div class="row">
			<div class="col-xl-12">
			 <?php 
					$this->ecc_library->form('text_line_readonly','Username',"form_".$methodid,'username','','','8');
			 ?>
			 </div>
		   </div>
		   <div class="row">
			<div class="col-xl-12">
			   <?php 
					$this->ecc_library->form('text_line_readonly','Departement',"form_".$methodid,'departemen','','','10');
			  ?>
			 </div>
		   </div>
		</div>
	 </div>
	  </div>
  </div>
</div>
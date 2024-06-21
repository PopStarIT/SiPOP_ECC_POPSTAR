<div class="row">
	<div class="col-xl-12">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !important">
				<h5 class="card-title form_title_<?php echo $methodid ?>"><?php echo $page_title ?></h5>
            </div>
            <div class="col-xl-12">  
            <form class="ui grid ecc_form" id="form_excel_<?php echo $methodid ?>" action="javascript:upload_excel_<?php echo $methodid ?>()" enctype="multipart/form-data" method="post"> 
             <!-- <form class="ui grid ecc_form" id="form_excel_ echo $methodid ?>" method="post" enctype="multipart/form-data">  -->
               <?php 
                  //  $angka= $this->mainconfig->decimalToFraction(11.25);
				   $this->ecc_library->form('hidden','',"form_excel_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
                   $this->ecc_library->form('text','Nama File',"form_excel_".$methodid,'filename','Excel_1','','');
                ?>		
                <div class="row">	
                	    <div class="col-xl-4">
						
					   <div class="col-xl-8">
						<?php 
						$this->ecc_library->form('file_Excel','File Excel',"form_excel_".$methodid,'excel_karyawan','','','');
						//$this->ecc_library->form('file_photo','Browse Photo3',"form_".$methodid,'link_photo3','','','');
                          ?>
						 </div>
				
					
					</div>	
                    <div class="col-xl-4">
					</div>												
				 </div>			
            </form>
              <div class="ui grid form">
		  	        <div class="row field">
		  	        	<div class="twelve wide column">
                              <!--
                          <button type="button" class="btn btn-success" onclick="submit_excel_echo $methodid ?>()">
                             -->
		  	        		<button type="button" class="btn btn-success" onclick="submit_excel_<?php echo $methodid ?>()">
		  	        			<i class="fa fa-save"></i> Upload Excel
		  	        		</button>
		  	        		
		  	        		<button type="button" class="btn btn-info" onclick="cancel_<?php echo $methodid ?>()">
		  	        			<i class="fa fa-arrow-left"></i> Back
		  	        		</button>
		  	        	</div>
		  	        </div>
		       </div>

            </div>
        </div>
    </div>
</div>

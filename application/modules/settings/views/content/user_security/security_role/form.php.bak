<div class="row">
	<div class="col-xl-12 mb-30">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !important">
				<h5 class="card-title form_title_<?php echo $methodid ?>"><?php echo $page_title ?></h5>
				<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>" action="javascript:post_<?php echo $methodid ?>()">
					<?php 
						$this->ecc_library->form('hidden','',"form_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
						$this->ecc_library->form('hidden','',"form_".$methodid,'role_id','');
						$this->ecc_library->form('text','Role',"form_".$methodid,'role','','','');
						
														
					?>	 
				
				<br>	
				<h5 class="card-title "><?php echo $page_title ?> Token Access</h5>
				<div class="row">
					<?php
						$token_list = $this->session->userdata('token_list');
						//var_dump($token_list);
						foreach($token_list as $key => $value){
					?>
						<div class="col-xl-4">
							<div class="form-group">
								<div class="form-check">
									<input class="form-check-input security_role_token_id security_role_token_id_<?php echo $value['token_id'] ?>" type="checkbox" name="token_id[<?php echo $value['token_id'] ?>]" value="1" >
									<label class="form-check-label" for="gridCheck">
										<?php echo $value['token'] ?>
									</label>
																		
								</div>
							</div>
						</div>
					<?php
						}
					?>
				</div>
				</form>
				<div class="ui grid form">
					<div class="row field">
						<div class="twelve wide column">
							<button type="button" class="btn btn-success" onclick="save_<?php echo $methodid ?>()">
								<i class="fa fa-save"></i> Save
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
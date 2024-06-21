?><div class="row">
	<div class="col-xl-12 mb-30">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !important">
				<h5 class="card-title form_title_<?php echo $methodid ?>"><?php echo $page_title ?></h5>
				<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>" action="javascript:post_<?php echo $methodid ?>()">
					<?php 
						$this->ecc_library->form('hidden','',"form_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
						$this->ecc_library->form('hidden','',"form_".$methodid,'user_id','');
						$this->ecc_library->form('text','Username',"form_".$methodid,'username','','','');
						$this->ecc_library->form('password','Password',"form_".$methodid,'password','','','');
						$this->ecc_library->form('password','Confirm Password',"form_".$methodid,'confirm_password','','','');
						$this->ecc_library->form('text','Name',"form_".$methodid,'name','','','');
						$this->ecc_library->form('text','Email',"form_".$methodid,'email','','','');
						$this->ecc_library->form('text','Phone',"form_".$methodid,'phone','','','');
						$this->ecc_library->form('select','Security Role',"form_".$methodid,'role_id','','','security_role');
						$this->ecc_library->form('select','User Status',"form_".$methodid,'user_status_id','','','user_status');
										
					?>	 
				
				<br>	
				<h5 class="card-title "><?php echo $page_title ?> Work Process Access</h5>
				<div class="row">
					<?php
						$work_process_list = $this->session->userdata('work_process_list');
						foreach($work_process_list as $key => $value){
					?>
						<div class="col-xl-4">
							<div class="form-group">
								<div class="form-check">
									<input class="form-check-input user_work_process_id user_work_process_id_<?php echo $value['work_process_id'] ?>" type="checkbox" name="work_process_id[<?php echo $value['work_process_id'] ?>]" value="1" >
									<label class="form-check-label" for="gridCheck">
										<?php echo $value['work_process'] ?>
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
<div class="row">
	<div class="col-xl-12">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !exportant">
				<h5 class="card-title form_title_<?php echo $methodid ?>"><?php echo $page_title ?></h5>
				<div class="tab tab-border">
					<ul class="nav nav-tabs form_tab_<?php echo $methodid ?>" role="tablist">
						<li class="nav-item">
							<a class="nav-link active show" id="tab_<?php echo $methodid; ?>_header" data-toggle="tab" href="#content_<?php echo $methodid; ?>_header" role="tab" aria-controls="content_<?php echo $methodid; ?>_header" aria-selected="true">
								Header
							</a>	
						</li>
						
						<li class="nav-item">
							<a class="nav-link" id="tab_<?php echo $methodid; ?>_supply" data-toggle="tab" href="#content_<?php echo $methodid; ?>_supply" role="tab" aria-controls="content_<?php echo $methodid; ?>_supply" aria-selected="true">
								Supply
							</a>	
						</li>
					</ul>
					
					<div class="tab-content">
						<div class="tab_custom_ecc tab-pane fade active show" id="content_<?php echo $methodid; ?>_header" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_header">
							<div class="row">
								<div class="col-xl-12 mb-10 ml-10">
									<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>" action="javascript:post_<?php echo $methodid ?>()">
										<?php 
											$this->ecc_library->form('hidden','',"form_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
											$this->ecc_library->form('hidden','',"form_".$methodid,'work_order_transfer_id','');
										?>
										
										<div class="row">
											<div class="col-xl-4">
												<?php 
													$this->ecc_library->form('text','Production Transfer No',"form_".$methodid,'work_order_transfer_no','','','');
												?>
											</div>
											
											<div class="col-xl-3">
												<?php 
													
													$this->ecc_library->form('date','Production Transfer Date',"form_".$methodid,'work_order_transfer_date','','','');
												?>
											</div>
											
											<div class="col-xl-4">
												<?php 
													$this->ecc_library->form('select','Production Request',"form_".$methodid,'work_order_request_id','','','work_order_request');						
												?>
											</div>
										</div>
									</form>
									
									<div class="row">
										<div class="col-xl-12">
											<?php 
												$extra_param = array('methodid'=> $methodid,'onclick'=> 'click_transfer_'.$methodid,'extra_param' => array(0 => array('field' => 'work_order_request_id','form_id' => 'form_'. $methodid .'_work_order_request_id')));
												$this->ecc_library->jqgrid($methodid."_detail", $dashboard_table['field_detail'], $dashboard_table['field_detail_loaddata'],$extra_param); 
											?>
										</div>
									</div>
									<br>
									<br>
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
						
						<div class="tab_custom_ecc tab-pane fade" id="content_<?php echo $methodid; ?>_supply" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_supply">
							<div class="row panel_<?php echo $methodid ?>_panel_supply">
								<div class="col-xl-12">
									<div class="row">
										<div class="col-xl-4">
											<?php 
												$this->ecc_library->form('readonly','Production Transfer No',"form_".$methodid."_supply",'work_order_transfer_no','','','');
											?>
										</div>
										
										<div class="col-xl-4">
											<?php 
												$this->ecc_library->form('readonly','Production Transfer Date',"form_".$methodid."_supply",'work_order_transfer_date','','','');																	
											?>
										</div>
										
										<div class="col-xl-4">
											<?php 
												$this->ecc_library->form('readonly','Production Request',"form_".$methodid."_supply",'work_order_request_no','','','');																	
											?>
										</div>
									</div>
									
									<div class="row">
										<div class="col-xl-12 mb-30">
											<button type="button" class="btn btn-info" onclick="javascript:supply_fifo_<?php echo $methodid ?>()">
												<i class="fa fa-archive"></i> Auto Supply FIFO
											</button>
											
											<button type="button" class="btn btn-info" onclick="javascript:supply_lifo_<?php echo $methodid ?>()">
												<i class="fa fa-archive"></i> Auto Supply LIFO
											</button>
											<br>
											<br>
											<div class="row">
												<div class="col-xl-12">
													<?php 
														$extra_param = array('methodid'=> $methodid,'onclick'=> 'click_transfer_'.$methodid,'extra_param' => array(0 => array('field' => 'work_order_request_id','form_id' => 'form_'. $methodid .'_supply_work_order_request_id')));
														$this->ecc_library->jqgrid($methodid."_supply", $dashboard_table['field_detail_supply'], $dashboard_table['field_detail_supply_loaddata'],$extra_param); 
													?>
												</div>
											</div>
										</div>
									</div>	
									
									<div class="row">
										<div class="col-xl-8 mb-30">
											<h3>Available Stock</h3>
											<div class="row">
												<div class="col-xl-12">
													<?php 
														$extra_field = array();
														$extra_field[] = array('field' => 'work_order_request_list_id','form_id' => 'form_'. $methodid .'_supply_work_order_request_list_id');
														$extra_field[] = array('field' => 'work_order_transfer_id','form_id' => 'form_'. $methodid .'_supply_work_order_transfer_id');
														$extra_param = array('methodid'=> $methodid,'footer_data'=> true,'onclick'=> 'click_item_'.$methodid ,'extra_param' => $extra_field);
														$this->ecc_library->jqgrid($methodid."_available", $dashboard_table['field_transfer_item'], $dashboard_table['field_transfer_item_loaddata'],$extra_param); 
													?>
												</div>
											</div>
											<br>
											<h3>List Supply</h3>
											<div class="row">
												<div class="col-xl-12">
													<?php 
														$extra_field = array();
														$extra_field[] = array('field' => 'work_order_request_list_id','form_id' => 'form_'. $methodid .'_supply_work_order_request_list_id');
														$extra_field[] = array('field' => 'work_order_transfer_id','form_id' => 'form_'. $methodid .'_supply_work_order_transfer_id');
														$extra_param = array('methodid'=> $methodid,'onclick'=> 'click_supply_'.$methodid,'extra_param' => $extra_field);
														$this->ecc_library->jqgrid($methodid."_list_transfer", $dashboard_table['field_supply_item'], $dashboard_table['field_supply_item_loaddata'],$extra_param); 
													?>
												</div>
											</div>
										</div>
											
										<div class="col-xl-4 mb-30">
											<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_supply" action="javascript:post_<?php echo $methodid ?>_supply()">
												<?php 
													$this->ecc_library->form('hidden','',"form_".$methodid."_supply",$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());		
													$this->ecc_library->form('hidden','',"form_".$methodid."_supply",'work_order_transfer_id','');			
													$this->ecc_library->form('hidden','',"form_".$methodid."_supply",'work_order_request_id','');			
													$this->ecc_library->form('hidden','',"form_".$methodid."_supply",'work_order_request_list_id','');			
													$this->ecc_library->form('hidden','',"form_".$methodid."_supply",'work_order_transfer_detail_id','');			
													$this->ecc_library->form('hidden','',"form_".$methodid."_supply",'stock_move_id','');		
													$this->ecc_library->form('text','From',"form_".$methodid."_supply",'from','','','');
													$this->ecc_library->form('date','Receive Date',"form_".$methodid."_supply",'receive_date','','','');
													$this->ecc_library->form('text','Receive No',"form_".$methodid."_supply",'receive_no','','','');
													$this->ecc_library->form('text','Quantity Supply',"form_".$methodid."_supply",'quantity_supply','','','');	
												?>
												
												<div class="input-group">
													<button type="submit" class="btn btn-success">
														<i class="fa fa-save"></i> ADD / UPDATE
													</button>
												</div>
												<br />										
											</form>
											 <?php
										  	$this->ecc_library->form('readonly','Perkiraan stock',"form_".$methodid."_supply",'mat_asset_id','','','get_mat_item_id',array('extra_param' => array(0 => array('field' => 'mat_item_id' ))));
												
												?>
										</div>
									</div>
									<br>
									<div class="ui grid form">
										<div class="row field">
											<div class="twelve wide column">
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
				</div>
			</div>
		</div>   
	</div>
</div>
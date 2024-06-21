<div class="row">
	<div class="col-xl-12">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !important">
				<h5 class="card-title form_title_<?php echo $methodid ?>"><?php echo $page_title ?></h5>
				<div class="tab tab-border">
					<ul class="nav nav-tabs form_tab_<?php echo $methodid ?>" role="tablist">
						<li class="nav-item">
							<a class="nav-link active show" id="tab_<?php echo $methodid; ?>_header" data-toggle="tab" href="#content_<?php echo $methodid; ?>_header" role="tab" aria-controls="content_<?php echo $methodid; ?>_header" aria-selected="true">
								Header
							</a>	
						</li>
						
						<li class="nav-item">
							<a class="nav-link" id="tab_<?php echo $methodid; ?>_detail" data-toggle="tab" href="#content_<?php echo $methodid; ?>_detail" role="tab" aria-controls="content_<?php echo $methodid; ?>_detail" aria-selected="true">
								Detail
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
											$this->ecc_library->form('hidden','',"form_".$methodid,'cust_trans_id','');
											$this->ecc_library->form('hidden','',"form_".$methodid,'cust_trans_type_id','');
										?>
										
										<div class="row">
											<div class="col-xl-4">
												<?php 
													$this->ecc_library->form('text','Customer Invoice No',"form_".$methodid,'cust_trans_no','','','');
													$this->ecc_library->form('date','Customer Invoice Date',"form_".$methodid,'cust_trans_date','','','');
													$this->ecc_library->form('date','Customer Invoice Due Date',"form_".$methodid,'cust_trans_due_date','','','');
												?>
											</div>
											
											<div class="col-xl-4">
												<?php 
													$this->ecc_library->form('select','Customer',"form_".$methodid,'partner_id','','','customer');
													$this->ecc_library->form('select','Currencies',"form_".$methodid,'currencies_id','','','currencies');						
												?>
											</div>
											<div class="col-xl-3">
												<?php 
													$this->ecc_library->form('text','Voucher No',"form_".$methodid,'voucher_no','','','');					
												?>
											</div>
										</div>
									</form>
									
									<div class="ui grid form">
										<div class="row field">
											<div class="twelve wide column">
												<button type="button" class="btn btn-success" onclick="save_<?php echo $methodid ?>()">
													<i class="fa fa-save"></i> Save Header
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
						
						<div class="tab_custom_ecc tab-pane fade" id="content_<?php echo $methodid; ?>_detail" role="tabpanel" aria-labelledby="tab_<?php echo $methodid; ?>_detail">
							<h5 class="card-title">Items for this Invoice</h5>
							<?php
								$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'cust_trans_id','','','');
								$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'cust_trans_detail_id','','','');
								$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'partner_id','','','');
								$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'currencies_id','','','');
							?>
							<div class="row mb-10" >
								<div class="col-xl-12">
									<?php 
										$extra_field = array();
										$extra_field[] = array('field' => 'partner_id','form_id' => 'form_'. $methodid .'_detail_partner_id');
										$extra_field[] = array('field' => 'currencies_id','form_id' => 'form_'. $methodid .'_detail_currencies_id');
										$extra_field[] = array('field' => 'cust_trans_detail_id','form_id' => 'form_'. $methodid .'_detail_cust_trans_detail_id');
										$extra_param = array('methodid'=> $methodid,'beforeclick'=> 'beforeclick_'.$methodid."_invoice_item",'extra_param' => $extra_field);
										$this->ecc_library->jqgrid($methodid."_invoice_item", $dashboard_table['field_invoice_item'], $dashboard_table['field_invoice_item_loaddata'],$extra_param); 
									?>
								</div>
							</div> 
							
							<div class="row">
								<div class="col-xl-12">
									<?php 
										$extra_param = array('methodid'=> $methodid,'extra_param' => array(0 => array('field' => 'cust_trans_id','form_id' => 'form_'. $methodid .'_detail_cust_trans_id')));
										$this->ecc_library->jqgrid($methodid."_detail", $dashboard_table['field_detail'], $dashboard_table['field_detail_loaddata'],$extra_param); 
									?>
								</div>
							</div>
							<br>
							
							<h5 class="card-title">Additional GL for this Invoice</h5>
							<div class="row">
								<div class="col-xl-12">
									<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>_detail_gl" action="javascript:add_<?php echo $methodid ?>_gl()">
										<div class="row">
											<div class="col-xl-9">
												<div class="row">
													<div class="col-xl-4">
														<?php
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail_gl",$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail_gl",'cust_trans_id','','','');
															$this->ecc_library->form('hidden','',"form_".$methodid."_detail_gl",'cust_trans_detail_id','','','');
															$this->ecc_library->form('select','GL Account',"form_".$methodid."_detail_gl",'gl_account_id','','','gl_account');
														?>
													</div>
													
													<div class="col-xl-4">
														<?php
															$this->ecc_library->form('text','Amount',"form_".$methodid."_detail_gl",'amount','','','');
														?>
													</div>
													
													<div class="col-xl-4 ">
														<?php
															$this->ecc_library->form('text','Narrative',"form_".$methodid."_detail_gl",'memo','','','');
														?>
													</div>
												</div>
											</div>
											
											<div class="col-xl-3">
												<label> &nbsp </label>
												<div class="input-group">
													<div class="button_<?php echo $methodid ?>_detail_gl_new" style="display:none">
														<button type="submit" class="btn btn-success">
															<i class="fa fa-plus"></i> ADD
														</button>
													</div>
													
													<div class="button_<?php echo $methodid ?>_detail_gl_edit" style="display:none">
														<button type="submit" class="btn btn-success">
															<i class="fa fa-check"></i> SAVE
														</button>
														
														<a class="btn btn-danger" onclick="javascript:cancel_detail_<?php echo $methodid ?>_gl()">
															<i class="fa fa-times"></i> CANCEL
														</a>
													</div>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<div class="row">
								<div class="col-xl-12">
									<?php 
										$extra_param = array('methodid'=> $methodid,'extra_param' => array(0 => array('field' => 'cust_trans_id','form_id' => 'form_'. $methodid .'_detail_gl_cust_trans_id')));
										$this->ecc_library->jqgrid($methodid."_detail_gl", $dashboard_table['field_detail_gl'], $dashboard_table['field_detail_gl_loaddata'],$extra_param); 
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>   
	</div>
</div>

<div id="dialog_<?php echo $methodid ?>_tax" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>
?><div class="row">
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
											$this->ecc_library->form('hidden','',"form_".$methodid,'grn_id','');	
											$this->ecc_library->form('hidden','',"form_".$methodid,'grn_type_id','');	
										?>
										<div class="row">
											<div class="col-xl-4">
												<?php 
													$this->ecc_library->form('text','Good Receive No',"form_".$methodid,'grn_no','','','');
													$this->ecc_library->form('date','Good Receive Date',"form_".$methodid,'grn_date','','','');					
													$this->ecc_library->form('select','Warehouse',"form_".$methodid,'warehouse_id','','','warehouse');	
												?>
											</div>
											
											<div class="col-xl-4">
												<?php 
													$this->ecc_library->form('text','Delivery No',"form_".$methodid,'no_surat_jalan','','','');
													$this->ecc_library->form('date','Delivery Date',"form_".$methodid,'tgl_surat_jalan','','','');		
												?>
											</div>
											
											<div class="col-xl-3">
												<?php 
													$this->ecc_library->form('select','Supplier',"form_".$methodid,'partner_id','','','supplier');				
												?>
												<div class="select_<?php echo $methodid ?>_from_custom" style="display:none">
													<?php 
														$this->ecc_library->form('select','From Doc',"form_".$methodid,'bc_in_header_id','','','get_grn_custom',array('extra_param' => array(0 => array('field' => 'partner_id' ))));				
													?>
												</div>	
												<div class="select_<?php echo $methodid ?>_from_purchase" style="display:none">
													<?php 
														$this->ecc_library->form('select','From Doc',"form_".$methodid,'purchase_order_id','','','get_grn_purchase',array('extra_param' => array(0 => array('field' => 'partner_id' ))));
													?>
												</div>
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
							<?php
								$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'grn_id','','','');
								$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'grn_detail_id','','','');
								$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'partner_id','','','');
								$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'purchase_order_id','','','');
								$this->ecc_library->form('hidden','',"form_".$methodid."_detail",'bc_in_header_id','','','');
							?>
							
							<div class="row panel_<?php echo $methodid ?>_panel_custom_order mb-10" >
								<div class="col-xl-12">
									<?php 
										$extra_field = array();
										$extra_field[] = array('field' => 'partner_id','form_id' => 'form_'. $methodid .'_detail_partner_id');
										$extra_field[] = array('field' => 'bc_in_header_id','form_id' => 'form_'. $methodid .'_detail_bc_in_header_id');
										$extra_field[] = array('field' => 'grn_detail_id','form_id' => 'form_'. $methodid .'_detail_grn_detail_id');
										$extra_param = array('methodid'=> $methodid,'beforeclick'=> 'beforeclick_'.$methodid."_custom",'extra_param' => $extra_field);
										$this->ecc_library->jqgrid($methodid."_custom", $dashboard_table['field_custom_item'], $dashboard_table['field_custom_item_loaddata'],$extra_param); 
									?>
								</div>
							</div> 
							
							<div class="row panel_<?php echo $methodid ?>_panel_purchase_order mb-10" >
								<div class="col-xl-12">
									<?php 
										$extra_field = array();
										$extra_field[] = array('field' => 'partner_id','form_id' => 'form_'. $methodid .'_detail_partner_id');
										$extra_field[] = array('field' => 'purchase_order_id','form_id' => 'form_'. $methodid .'_detail_purchase_order_id');
										$extra_field[] = array('field' => 'grn_detail_id','form_id' => 'form_'. $methodid .'_detail_grn_detail_id');
										$extra_param = array('methodid'=> $methodid,'beforeclick'=> 'beforeclick_'.$methodid."_purchase",'extra_param' => $extra_field);
										$this->ecc_library->jqgrid($methodid."_purchase", $dashboard_table['field_purchase_item'], $dashboard_table['field_purchase_item_loaddata'],$extra_param); 
									?>
								</div>
							</div> 
							
							<div class="row">
								<div class="col-xl-12">
									<?php 
										$extra_param = array('methodid'=> $methodid,'extra_param' => array(0 => array('field' => 'grn_id','form_id' => 'form_'. $methodid .'_detail_grn_id')));
										$this->ecc_library->jqgrid($methodid."_detail", $dashboard_table['field_detail'], $dashboard_table['field_detail_loaddata'],$extra_param); 
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
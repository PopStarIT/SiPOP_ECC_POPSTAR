<div class="row">
	<div class="col-xl-12 mb-30">     
		<div class="card card-statistics h-100"> 
			<div class="card-body" style="padding: 1.25rem !important">
				<h5 class="card-title form_title_<?php echo $methodid ?>"><?php echo $page_title ?></h5>
				<div id="panel_<?php echo $methodid ?>_1">
					<form class="ui grid ecc_form" id="form_<?php echo $methodid ?>" action="javascript:post_<?php echo $methodid ?>()">
						<?php 
							$this->ecc_library->form('hidden','',"form_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
							$this->ecc_library->form('hidden','',"form_".$methodid,'delivery_id','');	
							$this->ecc_library->form('hidden','',"form_".$methodid,'delivery_type_id','');	
						?>
						<div class="row">
							<div class="col-xl-4">
								<?php 
									$this->ecc_library->form('text','Delivery No',"form_".$methodid,'delivery_no','','','');
									$this->ecc_library->form('date','Delivery Date',"form_".$methodid,'delivery_date','','','');					
								?>
							</div>
							
							<div class="col-xl-8">
								<?php 
									$this->ecc_library->form('select','Customer',"form_".$methodid,'partner_id','','','customer');				
								?>
								<div class="select_<?php echo $methodid ?>_from_custom" style="display:none">
									<?php 
										$this->ecc_library->form('select','From Doc',"form_".$methodid,'bc_out_header_id','','','get_delivery_custom',array('extra_param' => array(0 => array('field' => 'partner_id' ))));				
									?>
								</div>	
								<div class="select_<?php echo $methodid ?>_from_sales" style="display:none">
									<?php 
										$this->ecc_library->form('select','From Doc',"form_".$methodid,'sales_order_transfer_id','','','get_delivery_sales',array('extra_param' => array(0 => array('field' => 'partner_id' ))));
									?>
								</div>
							</div>
							
						</div>
						<br>
						<h5 class="card-title"><?php echo $page_title ?> Items</h5>
						<div class="panel_<?php echo $methodid ?>_from_custom" style="display:none">
							<div class="col-xl-12 mb-30">
								<div class="table-responsive">
									<table id="table_<?php echo $methodid ?>_delivery_order" class="table datatable table-hover table-bordered table-striped p-0 nowrap" width="100%">
										<thead>
											<tr>
												<th class="text-left">#ID</th>
												<th class="text-left">Customs Type</th>
												<th class="text-left">Car</th>
												<th class="text-left">Register No</th>
												<th class="text-left">Register Date</th>
												<th class="text-left">Item</th>
												<th class="text-left">Quantity Customs</th>
												<th class="text-left">Quantity Delivered</th>
												<th class="text-left">Unit</th>
												<th class="text-left">This Delivered</th>
												<th class="text-left">Unit</th>
												<th class="text-left">Conversion</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
						
						<div class="panel_<?php echo $methodid ?>_from_sales" style="display:none">
							<div class="col-xl-12 mb-30">
								<div class="table-responsive">
									<table id="table_<?php echo $methodid ?>_delivery_order_from_sales" class="table datatable table-hover table-bordered table-striped p-0 nowrap" width="100%">
										<thead>
											<tr>
												<th class="text-left">#ID</th>
												<th class="text-left">SO / Memo. No</th>
												<th class="text-left">SO / Memo. Date</th>
												<th class="text-left">Item</th>
												<th class="text-left">Quantity Order</th>
												<th class="text-left">Quantity Delivered</th>
												<th class="text-left">Unit</th>
												<th class="text-left">This Delivered</th>
												<th class="text-left">Unit</th>
												<th class="text-left">Conversion</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</form>
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
					
					<div id="panel_print_<?php echo $methodid ?>" style="display:none"></div>
	
				   <form id="form_<?php echo $methodid ?>_print" action="<?php echo base_url() . $class_uri ?>/print_delivery" method="POST" target="panel_print_<?php echo $methodid ?>" style="display:none">
					  <input type="hidden" id="form_<?php echo $methodid ?>_print_csrf" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" />
					  <input type="hidden" id="form_<?php echo $methodid ?>_print_delivery_id" name="delivery_id" value="" />
				   </form>
				</div>
				
				<div id="panel_<?php echo $methodid ?>_2">
				
				</div>
			</div>
		</div>   
	</div>
</div>
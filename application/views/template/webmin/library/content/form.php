<?php

	if(isset($form_type)){
		//--variabel ini digunakan untuk membedakan akses database ecc dan popstar---
	    	$param_pop='db_ecc';
		//-----------------------
		switch($form_type){
			case 'hidden':
				echo "<input type=\"hidden\" id=\"". $form_id."_".$form_param ."\" name=\"". $form_param ."\" value=\"". $form_value ."\" />";
			break;
				
			case 'select_pop':
			//var_dump($extra_data);die
?>             
				<div class="form-group">
					<label for="<?php echo $form_param ?>"><?php echo $form_label ?></label>
					<select class="form-control" id="<?php echo $form_id."_".$form_param ?>" name="<?php echo $form_param ?>">
					</select>
				</div>
				<script type="text/javascript">
				//alert(baseurl+"loader_pop");
					$('#<?php echo $form_id."_".$form_param ?>').select2({
				// alert(<?php echo $form_param_key_1 ?>);
						ajax: {
							url: baseurl+"loader",
							type: "POST",
							dataType: "json",
							data: function (params) {
								//console.log(<?php $extra_data ?>);
								//alert(baseurl+"<?php echo $form_param_key_1 ?>");
							  return {
								'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
								,param: '<?php echo $form_param_key_1 ?>'
								,param_pop:'db_pop'
								,q: params.term
								,page: params.page
								<?php foreach($extra_data as $key=>$value){ ?>
										<?php if($key == 'extra_param'){ ?>
											<?php foreach($value as $extra_param){ ?>
												, '<?php echo $extra_param['field'] ?>' : function (){
													return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
												}									
											<?php } ?>
										<?php } ?>
									<?php } ?>
							  };
							},
						}
					});
					
				//	alert(baseurl+'loader');
					$.ajax({
						url: baseurl+'loader',
						data: {
								'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
								,param: '<?php echo $form_param_key_1 ?>'
								,param_pop:'db_pop'
								<?php foreach($extra_data as $key=>$value){ ?>
									<?php if($key == 'extra_param'){ ?>
										<?php foreach($value as $extra_param){ ?>
											, '<?php echo $extra_param['field'] ?>' : function (){
												return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
											}									
										<?php } ?>
									<?php } ?>
								<?php } ?>
								<?php if($form_value){ ?>
								,id : '<?php echo $form_value ?>'
								<?php } else { ?>
								,id : -1
								<?php } ?>
							},
						dataType: 'json',
						method: 'post',
						success: function(data){
							$("#<?php echo $form_id."_".$form_param ?>").val(null).trigger('change');
							
							if(data){
								$.each(data, function(key,value) {
									newOption = new Option(data[key].text, data[key].id, false, false);
									$("#<?php echo $form_id."_".$form_param ?>").append(newOption).trigger('change');
								});
							}
						}
					});
					
					function change_<?php echo $form_id."_".$form_param ?>(param_id){
						
					    //print_r(param_id)
				//	alert('<?php echo $form_param_key_1 ?>');
						$.ajax({
							url: baseurl+'loader',
							data: {
									'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
									,param: '<?php echo $form_param_key_1 ?>'
									,param_pop:'db_pop'
									<?php foreach($extra_data as $key=>$value){ ?>
										<?php if($key == 'extra_param'){ ?>
											<?php foreach($value as $extra_param){ ?>
												, '<?php echo $extra_param['field'] ?>' : function (){
													return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
												}									
											<?php } ?>
										<?php } ?>
									<?php } ?>
									,id : param_id
									},
							dataType: 'json',
							method: 'post',
							success: function(data){
							//	alert(data);
								if(data){
									$.each(data, function(key,value) {
										//alert(key);
										if(key == 0) {
											newOption = new Option(data[key].text, data[key].id, true, true);
											//alert(data[key].text);
											$("#<?php echo $form_id."_".$form_param ?>").append(newOption).trigger('change');
											//$("#<?php echo $form_id."_".$form_param ?>").val(data[key].id);
											// $("#<?php echo $form_id."_".$form_param ?>").trigger('change');
										}
									});
								}

							}
						});
					}
				</script>
<?php				
			break;
			
			case 'file':
?>
           <div class="form-group">
					<?php if($form_label) { ?>
					<label for="<?php echo $form_param ?>" class="label_<?php echo $form_id."_".$form_param ?>"><?php echo $form_label ?></label>
					<?php } ?>
					<input class="form-control <?php echo $form_param ?>" id="<?php echo $form_id ?>_<?php echo $form_param ?>"  name="<?php echo $form_param ?>" type="file" placeholder="<?php echo $form_label ?>" />
					
			</div>
<?php 
            break;	

			case 'file_photo':
?>
           <div class="form-group">
					<?php if($form_label) { ?>
					<label for="<?php echo $form_param ?>" class="label_<?php echo $form_id."_".$form_param ?>"><?php echo $form_label ?></label>
					<?php } ?>
					<input class="form-control <?php echo $form_param ?>" id="<?php echo $form_id ?>_<?php echo $form_param ?>"  name="<?php echo $form_param ?>" type="file"  onchange="pictureadd()" accept="image/x-png,image/gif,image/jpeg"/>
					
			</div>
<?php 
            break;	
			
			case 'file_Excel':
?>
           <div class="form-group">
					<?php if($form_label) { ?>
					<label for="<?php echo $form_param ?>" class="label_<?php echo $form_id."_".$form_param ?>"><?php echo $form_label ?></label>
					<?php } ?>
					<input class="form-control <?php echo $form_param ?>" id="<?php echo $form_id ?>_<?php echo $form_param ?>"  name="<?php echo $form_param ?>" type="file"  accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"/>
					
			</div>
<?php 
            break;	
			
			case 'select':
?>             
				<div class="form-group">
					<label for="<?php echo $form_param ?>"><?php echo $form_label ?></label>
					<select class="form-control" id="<?php echo $form_id."_".$form_param ?>" name="<?php echo $form_param ?>">
					</select>
				</div>
				<script type="text/javascript">
				// alert("<?php echo $form_value ?>");
					$('#<?php echo $form_id."_".$form_param ?>').select2({
				// alert(<?php echo $form_param_key_1 ?>);
						ajax: {
							url: baseurl+"loader",
							type: "POST",
							dataType: "json",
							data: function (params) {
								//console.log($extra_data ?>);
								//alert(baseurl+"echo $form_param_key_1 ?>");
							  return {
								'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
								,param: '<?php echo $form_param_key_1 ?>'
								,q: params.term
								,page: params.page
								<?php foreach($extra_data as $key=>$value){ ?>
										<?php if($key == 'extra_param'){ ?>
											<?php foreach($value as $extra_param){ ?>
												, '<?php echo $extra_param['field'] ?>' : function (){
													return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
												}									
											<?php } ?>
										<?php } ?>
									<?php } ?>
							  };
							},
						}
					});
					
					$.ajax({
						url: baseurl+'loader',
						data: {
								'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
								,param: '<?php echo $form_param_key_1 ?>'
								,param_pop:'<?php echo $param_pop ?>'
								<?php foreach($extra_data as $key=>$value){ ?>
									<?php if($key == 'extra_param'){ ?>
										<?php foreach($value as $extra_param){ ?>
											, '<?php echo $extra_param['field'] ?>' : function (){
												return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
											}									
										<?php } ?>
									<?php } ?>
								<?php } ?>
								<?php if($form_value){ ?>
								,id : '<?php echo $form_value ?>'
								<?php } else { ?>
								,id : -1
								<?php } ?>
							},
						dataType: 'json',
						method: 'post',
						success: function(data){
							$("#<?php echo $form_id."_".$form_param ?>").val(null).trigger('change');
							
							if(data){
								$.each(data, function(key,value) {
									newOption = new Option(data[key].text, data[key].id, false, false);
									$("#<?php echo $form_id."_".$form_param ?>").append(newOption).trigger('change');
								});
							}
						}
					});
					
					function change_<?php echo $form_id."_".$form_param ?>(param_id){
					  // alert("test");
					   //print_r(param_id)
					//alert(baseurl+'loader');
						$.ajax({
							url: baseurl+'loader',
							data: {
									'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
									,param: '<?php echo $form_param_key_1 ?>'
									<?php foreach($extra_data as $key=>$value){ ?>
										<?php if($key == 'extra_param'){ ?>
											<?php foreach($value as $extra_param){ ?>
												, '<?php echo $extra_param['field'] ?>' : function (){
													return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
												}									
											<?php } ?>
										<?php } ?>
									<?php } ?>
									,id : param_id
									},
							dataType: 'json',
							method: 'post',
							success: function(data){
							//	alert(data);
								if(data){
									$.each(data, function(key,value) {
										//alert(key);
										if(key == 0) {
											newOption = new Option(data[key].text, data[key].id, true, true);
											//alert(data[key].text);
											$("#<?php echo $form_id."_".$form_param ?>").append(newOption).trigger('change');
											//$("#<?php echo $form_id."_".$form_param ?>").val(data[key].id);
											// $("#<?php echo $form_id."_".$form_param ?>").trigger('change');
										}
									});
								}

							}
						});
					}
				</script>
<?php				
			break;
			
			case 'select2':
?>
				<div class="form-group">
					<label for="<?php echo $form_param ?>" class="label_<?php echo $form_id."_".$form_param ?>"><?php echo $form_label ?></label>
					<select class="form-control" id="<?php echo $form_id."_".$form_param ?>" name="<?php echo $form_param ?>"></select>
				</div>
				<script type="text/javascript">
					
					$( document ).ready(function() {						
						var options_<?php echo $form_id."_".$form_param ?> = {
							values: "a, b, c",
							ajax: {
								url: baseurl+"loader",
								type: "POST",
								dataType: "json",
								data: {
										'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
										,param: '<?php echo $form_param_key_1 ?>'
										<?php foreach($extra_data as $key=>$value){ ?>
											<?php if($key == 'extra_param'){ ?>
												<?php foreach($value as $extra_param){ ?>
													, '<?php echo $extra_param['field'] ?>' : function (){
														return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
													}									
												<?php } ?>
											<?php } ?>
										<?php } ?>
										,q: "{{{q}}}"
									}
							},
							locale: {
								emptyTitle: "<?php echo isset($form_label) ? ucwords(str_replace('_',' ',$form_label)) : '' ?>"
							},
							log: 3,
							preprocessData: function(data) {
								var i,
								l = data.length,
								array = [];
								if (l) {
									for (i = 0; i < l; i++) {
										array.push(
											$.extend(true, data[i], {
												text: data[i].value,
												value: data[i].id,
												data: {
													// subtext: data[i].id
												}
											})
										);
									}
								}
								
								return array;
							}
							,preserveSelected: true
							,preserveSelectedPosition: 'before'
						};
						
						$.ajax({
							url: baseurl+'loader',
							data: {
									'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
									,param: '<?php echo $form_param_key_1 ?>'
									<?php foreach($extra_data as $key=>$value){ ?>
										<?php if($key == 'extra_param'){ ?>
											<?php foreach($value as $extra_param){ ?>
												, '<?php echo $extra_param['field'] ?>' : function (){
													return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
												}									
											<?php } ?>
										<?php } ?>
									<?php } ?>
									<?php if($form_value){ ?>
									,id : '<?php echo $form_value ?>'
									<?php } else { ?>
									,id : -1
									<?php } ?>
								},
							dataType: 'json',
							method: 'post',
							success: function(data){
								if(data){
									$.each(data, function(key,value) {
										$("#<?php echo $form_id."_".$form_param ?>").append('<option value="'+data[key].id+'" selected >'+data[key].value+'</option>');
									});
								}
								
								$("#<?php echo $form_id."_".$form_param ?>").selectpicker({liveSearch: true}).ajaxSelectPicker(options_<?php echo $form_id."_".$form_param ?>);
							}
						});
					});
					
					function change_<?php echo $form_id."_".$form_param ?>(param_id){
					//	print_r(param_id)
						$.ajax({
							url: baseurl+'loader',
							data: {
									'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
									,param: '<?php echo $form_param_key_1 ?>'
									<?php foreach($extra_data as $key=>$value){ ?>
										<?php if($key == 'extra_param'){ ?>
											<?php foreach($value as $extra_param){ ?>
												, '<?php echo $extra_param['field'] ?>' : function (){
													return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
												}									
											<?php } ?>
										<?php } ?>
									<?php } ?>
									,id : param_id
									},
							dataType: 'json',
							method: 'post',
							success: function(data){
								$('#<?php echo $form_id."_".$form_param ?>').val([]);
								$('#<?php echo $form_id."_".$form_param ?>').trigger('change.abs.preserveSelected');
								$('#<?php echo $form_id."_".$form_param ?>').selectpicker('refresh');
								
								$.each(data, function(key,value) {
									$("#<?php echo $form_id."_".$form_param ?>").html('<option value="'+data[key].id+'" selected >'+data[key].value+'</option>');
								});
								$("#<?php echo $form_id."_".$form_param ?>").selectpicker('refresh');
								
								$('#<?php echo $form_id."_".$form_param ?>').val(param_id);
								$("#<?php echo $form_id."_".$form_param ?>").selectpicker('refresh');
							}
						});
					}
					
					function change2_<?php echo $form_id."_".$form_param ?>(param_id){
						$.ajax({
							url: baseurl+'loader',
							data: {
										'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
										,param: '<?php echo $form_param_key_1 ?>'
										<?php foreach($extra_data as $key=>$value){ ?>
											<?php if($key == 'extra_param'){ ?>
												<?php foreach($value as $extra_param){ ?>
													, '<?php echo $extra_param['field'] ?>' : function (){
														return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
													}									
												<?php } ?>
											<?php } ?>
										<?php } ?>
										,id : param_id
									},
							dataType: 'json',
							method: 'post',
							success: function(data){
								$.each(data, function(key,value) {
									$("#<?php echo $form_id."_".$form_param ?>").html('<option value="'+data[key].id+'" selected >'+data[key].value+'</option>');
								});
								
								$("#<?php echo $form_id."_".$form_param ?>").selectpicker('refresh');
								
							}
						});
					}
				</script>
<?php
			break;
			
			case 'select_custom':
?>
				
				<div class="form-group">
					<label for="<?php echo $form_param ?>"><?php echo $form_label ?></label>
					<select class="form-control" id="<?php echo $form_id."_".$form_param ?>" name="<?php echo $form_param ?>"></select>
				</div>
				
				<script type="text/javascript">
					
					$( document ).ready(function() {
											
						$.ajax({
							url: baseurl+'loader',
							data: {
										'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
										,param: '<?php echo $form_param_key_1 ?>'
										,id : '<?php echo $form_value ?>'
									},
							dataType: 'json',
							method: 'post',
							success: function(data){
								$.each(data, function(key,value) {
									$("#<?php echo $form_id."_".$form_param ?>").append('<option value="'+data[key].id+'" >'+data[key].value+'</option>');
								});
								
								$("#<?php echo $form_id."_".$form_param ?>").selectpicker({liveSearch: true});
						
							}
						});
						
						
						
					});
					
					function change_<?php echo $form_id."_".$form_param ?>(param_id){
						//alert("cvb")
						$.ajax({
							url: baseurl+'loader',
							data: {
										'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
										,param: '<?php echo $form_param_key_1 ?>'
										,id : param_id
									},
							dataType: 'json',
							method: 'post',
							success: function(data){
								$.each(data, function(key,value) {
									$("#<?php echo $form_id."_".$form_param ?>").html('<option value="'+data[key].id+'" selected >'+data[key].value+'</option>');
								});
								$("#<?php echo $form_id."_".$form_param ?>").selectpicker('refresh');
								
							}
						});
					}
				</script>
<?php
			break;
			
			case 'date':
?>		
				<div class="form-group">
					<label for="<?php echo $form_param ?>"><?php echo $form_label ?></label>
					<div class="input-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-calendar"></i></span>
						</div>
						<input class="form-control <?php echo $form_param ?>" id="<?php echo $form_id ?>_<?php echo $form_param ?>"  name="<?php echo $form_param ?>" type="text" placeholder="<?php echo $form_label ?>" value="<?php echo $form_value ?>" />
					</div>
				</div>
							
				<script type="text/javascript">
					
					$( document ).ready(function() {
						$('#<?php echo $form_id."_".$form_param ?>').datepicker(
							{
								format: 'yyyy-mm-dd',
								todayBtn: "linked",
								autoclose: true
							}
						);						
					});
				</script>
<?php			
			break;
			
			case 'text':
?>		
				<div class="form-group">
					<?php if($form_label) { ?>
					<label for="<?php echo $form_param ?>" class="label_<?php echo $form_id."_".$form_param ?>"><?php echo $form_label ?></label>
					<?php } ?>
					<input class="form-control <?php echo $form_param ?>" id="<?php echo $form_id ?>_<?php echo $form_param ?>"  name="<?php echo $form_param ?>" type="text" placeholder="<?php echo $form_label ?>" value="<?php echo $form_value ?>" />
					
				</div>
<?php			
			break;
			
			case 'text_line_readonly':
?>	
              <div class="form-group row">
			     <?php if($form_label) { ?>
			      <label for="<?php echo $form_param ?>" class="col-sm-2 col-form-label label_<?php echo $form_id."_".$form_param ?>"><?php echo $form_label ?></label>
			     <?php } ?>
                 <div class="col-sm-<?php echo $form_param_key_1?>">
                    <input type="text" class="form-control <?php echo $form_param ?>" id="<?php echo $form_id ?>_<?php echo $form_param ?>"  name="<?php echo $form_param ?>" placeholder="<?php echo $form_label ?>" value="<?php echo $form_value ?>" readonly /> 
                 </div>
									
              </div>
<?php			
			break;
			
			case 'text_line':
?>
			  <div class="form-group row">
			     <?php if($form_label) { ?>
			      <label for="<?php echo $form_param ?>" class="col-sm-4 col-form-label label_<?php echo $form_id."_".$form_param ?>"><?php echo $form_label ?></label>
			     <?php } ?>
                 <div class="col-sm-<?php echo $form_param_key_1?>">
                    <input type="text" class="form-control <?php echo $form_param ?>" id="<?php echo $form_id ?>_<?php echo $form_param ?>"  name="<?php echo $form_param ?>" placeholder="<?php echo $form_label ?>" value="<?php echo $form_value ?>" /> 
                 </div>
									
              </div>					
              
<?php			
			break;
			
			case 'password':
?>		
				<div class="form-group">
					<?php if($form_label) { ?>
					<label for="<?php echo $form_param ?>"><?php echo $form_label ?></label>
					<?php } ?>
					<input class="form-control <?php echo $form_param ?>" id="<?php echo $form_id ?>_<?php echo $form_param ?>"  name="<?php echo $form_param ?>" type="password" placeholder="<?php echo $form_label ?>" value="<?php echo $form_value ?>" />
					
				</div>
<?php			
			break;
			
			case 'readonly':
?>		
				<div class="form-group">
					<?php if($form_label) { ?>
					<label for="<?php echo $form_param ?>"><?php echo $form_label ?></label>
					<?php } ?>
					<input class="form-control <?php echo $form_param ?>" id="<?php echo $form_id ?>_<?php echo $form_param ?>"  name="<?php echo $form_param ?>" type="text" placeholder="<?php echo $form_label ?>" value="<?php echo $form_value ?>" readonly />
					
				</div>
<?php			
			break;
			
			case 'checkbox':
?>		
			<div class="form-group">
				<div class="form-check">
					<input class="form-check-input <?php echo $form_param ?>" type="checkbox" name="<?php echo $form_param ?>" id="<?php echo $form_id ?>_<?php echo $form_param ?>"  value="1" >
					<label class="form-check-label" for="gridCheck">
						<?php echo $form_label ?>
					</label>
				</div>
			</div>
			
			<script type="text/javascript">
				$( document ).ready(function() {
					<?php if($form_value == "1"){ ?>
						$('#<?php echo $form_id."_".$form_param ?>').prop('checked', true);			
					<?php } else { ?>
						$('#<?php echo $form_id."_".$form_param ?>').prop('checked', false);	
					<?php } ?>
				});
			</script>
<?php			
			break;
			
			case 'select_pop_line':
?>
             <div class="form-group row "  style="margin-bottom:2px" >
			   <label for="<?php echo $form_param ?>" class="col-sm-4 col-form-label label_<?php echo $form_id."_".$form_param ?>"><?php echo $form_label ?></label>
			     <div class="col-sm-<?php echo $form_param_key_2?>">
                 	<select class="form-control" id="<?php echo $form_id."_".$form_param ?>" name="<?php echo $form_param ?>">
					</select>
                 </div>
		     </div>
			 
			 <script type="text/javascript">
			   	//alert(baseurl+"loader_pop");
					$('#<?php echo $form_id."_".$form_param ?>').select2({
				// alert(<?php echo $form_param_key_1 ?>);
						ajax: {
							url: baseurl+"loader",
							type: "POST",
							dataType: "json",
							data: function (params) {
								//console.log(<?php $extra_data ?>);
								//alert(baseurl+"<?php echo $form_param_key_1 ?>");
							  return {
								'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
								,param: '<?php echo $form_param_key_1 ?>'
								,param_pop:'db_pop'
								,q: params.term
								,page: params.page
								<?php foreach($extra_data as $key=>$value){ ?>
										<?php if($key == 'extra_param'){ ?>
											<?php foreach($value as $extra_param){ ?>
												, '<?php echo $extra_param['field'] ?>' : function (){
													return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
												}									
											<?php } ?>
										<?php } ?>
									<?php } ?>
							  };
							},
						}
					});
					
				//	alert(baseurl+'loader');
					$.ajax({
						url: baseurl+'loader',
						data: {
								'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
								,param: '<?php echo $form_param_key_1 ?>'
								,param_pop:'db_pop'
								<?php foreach($extra_data as $key=>$value){ ?>
									<?php if($key == 'extra_param'){ ?>
										<?php foreach($value as $extra_param){ ?>
											, '<?php echo $extra_param['field'] ?>' : function (){
												return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
											}									
										<?php } ?>
									<?php } ?>
								<?php } ?>
								<?php if($form_value){ ?>
								,id : '<?php echo $form_value ?>'
								<?php } else { ?>
								,id : -1
								<?php } ?>
							},
						dataType: 'json',
						method: 'post',
						success: function(data){
							//alert('test');
							$("#<?php echo $form_id."_".$form_param ?>").val(null).trigger('change');
							
							if(data){
								$.each(data, function(key,value) {
									newOption = new Option(data[key].text, data[key].id, false, false);
									$("#<?php echo $form_id."_".$form_param ?>").append(newOption).trigger('change');
								});
							}
						}
					});
					
					function change_<?php echo $form_id."_".$form_param ?>(param_id){
						//alert('test_lagi ' + param_id );
					    //print_r(param_id)
				//	alert('<?php echo $form_param_key_1 ?>');
						$.ajax({
							url: baseurl+'loader',
							data: {
									'<?php echo $this->security->get_csrf_token_name() ?>':'<?php echo $this->security->get_csrf_hash() ?>'
									,param: '<?php echo $form_param_key_1 ?>'
									,param_pop:'db_pop'
									<?php foreach($extra_data as $key=>$value){ ?>
										<?php if($key == 'extra_param'){ ?>
											<?php foreach($value as $extra_param){ ?>
												, '<?php echo $extra_param['field'] ?>' : function (){
													return $('#<?php echo $form_id ?>_<?php echo $extra_param['field'] ?>').val();	
												}									
											<?php } ?>
										<?php } ?>
									<?php } ?>
									,id : param_id
									},
							dataType: 'json',
							method: 'post',
							success: function(data){
							//	alert(data);
								if(data){
									$.each(data, function(key,value) {
										//alert(key);
										if(key == 0) {
											newOption = new Option(data[key].text, data[key].id, true, true);
											//alert(data[key].text);
											$("#<?php echo $form_id."_".$form_param ?>").append(newOption).trigger('change');
											//$("#<?php echo $form_id."_".$form_param ?>").val(data[key].id);
											// $("#<?php echo $form_id."_".$form_param ?>").trigger('change');
										}
									});
								}

							}
						});
					}
			 </script>

<?php
            break;
			
			default:
				echo "<div class=\"row field\">";
				echo "<label class=\"twelve wide column\">". isset($form_label) ? ucwords(str_replace('_',' ',$form_label)) : '' ."</label>";
				echo "<div class=\"twelve wide column\">";
				echo "<div class=\"ui input\">";
				echo "<input type=\"text\" class=\"". $form_param ."\" id=\"". $form_id."_".$form_param ."\" name=\"". $form_param ."\"  value=\"". $form_value ."\"   />";
				echo "</div>";
				echo "</div>";
				echo "</div>";
			break;		
		}
	}

?>
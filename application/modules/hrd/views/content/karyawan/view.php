<div class="container-fluid">
	<div class="row">
		<div class="col-xl-12">
			<div class="card card-statistics"> 
				<div class="card-body">
					<div class="row">
						<div class="col-xl-12">
							<div id="accordion">
								<div class="card">
									<div class="card-header" id="headingOne">
										<h5 class="mb-0">
											<?php echo $page_title ?>
										</h5>
									</div>
									
									<div id="panel_content_<?php echo $methodid ?>">
										<?php $this->load->view($path_template.'/library/content/dashboard_table2'); ?>
									</div>
									
									<div id="panel_content_form_<?php echo $methodid ?>" style="display:none">
										<?php
									//var_dump($view_load_form);die();
											if(isset($view_load_form)){
												$this->load->view('content/'.$view_load_form);
											}
										?>
									</div>

                                    <div id="panel_content_form_upload_<?php echo $methodid ?>" style="display:none">
										<?php
									//var_dump($view_load_form);die();
											if(isset($view_load_form_upload)){
												$this->load->view('content/'.$view_load_form_upload);
											}
										?>
									</div>
									
									<div id="panel_uploadexcel_form_<?php echo $methodid ?>" style="display:none">
									  <div class="row">
								         <div class="col-xl-12 mb-10 ml-10">
                                            <div class="row">
  	                                         <div class="col-xl-12">     
  	                                         	<div class="card card-statistics h-100"> 
  	                                         		<div class="card-body" style="padding: 1.25rem !important">
  	                                         			<h5 class="card-title form_title_<?php echo $methodid ?>"><?php echo $page_title ?></h5>
  	                                         	    </div>
									  <!--  <form class="ui grid ecc_form" id="form_excel_echo $methodid ?>" action=" echo base_url('/'.$class_uri.'/upload_excel_karyawan'); ?>" enctype="multipart/form-data" method="post"> -->
                                       <form class="ui grid ecc_form" id="form_excel_<?php echo $methodid ?>" action="javascript:upload_excel_<?php echo $methodid ?>()" enctype="multipart/form-data" method="post"> 
                                      <!-- <form class="ui grid ecc_form" id="form_excel_ echo $methodid ?>" method="post" enctype="multipart/form-data">  -->
                                      <?php 
                                           // print_r(base_url('/'.$class_uri));
                                          	$this->ecc_library->form('hidden','',"form_excel_".$methodid,$this->security->get_csrf_token_name(),$this->security->get_csrf_hash());
                                            $this->ecc_library->form('text','Nama Filex',"form_excel_".$methodid,'filename','Excel_1','','');
                                      ?>		
                                                  <div class="row">	
                                                  	    <div class="col-xl-4">
									            			
									            		   <div class="col-xl-8">
									            			<?php 
									            			$this->ecc_library->form('file_Excel','File Excel',"form_excel_".$methodid,'excel_karyawan','','','');
									            			$this->ecc_library->form('file_photo','Browse Photo3',"form_".$methodid,'link_photo3','','','');
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
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<div id="panel_print_<?php echo $methodid ?>" style="display:none"></div>
	
	<form id="form_<?php echo $methodid ?>_print" action="<?php echo base_url() . $class_uri ?>/loaddata" method="POST" target="panel_print_<?php echo $methodid ?>" style="display:none">
		<input type="hidden" id="form_<?php echo $methodid ?>_print_csrf" name="<?php echo $this->security->get_csrf_token_name() ?>" value="<?php echo $this->security->get_csrf_hash() ?>" />
		<input type="hidden" id="form_<?php echo $methodid ?>_print_format" name="format" value="" />
		<input type="hidden" id="form_<?php echo $methodid ?>_print_print" name="print" value="1" />
	</form>
</div>

<!-- dibawah code dari data yang lama untuk proses upload excel -->
<!-- jika tidak digunakan silakan hapus -->

</div>
<div id="uploadExcelKaryawan" class="modal modal-edu-general default-popup-PrimaryModal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header header-color-modal bg-color-6">
                <h4 class="modal-title">.:: Upload data karyawan (excel)</h4>
                <div class="modal-close-area modal-close-df">
                    <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                </div>
            </div>

            <!-- <form action="base_url('karyawan/excelkaryawan') ?>" method="post" enctype="multipart/form-data" class="form-uploadExcel"> -->
            <form action="#" method="post" enctype="multipart/form-data" class="form-uploadExcel">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <a href="<?= base_url('/down_file/downloadfile') ?>" type="submit" class="updateuserxxx"># Download template</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="preload">
                                    <div class="loading">
                                        <img src="<?= base_url('/img/loading.gif') ?>" width="20">
                                        <p>Please wait...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                    <label class="login2 pull-left pull-left-pro">File Excelx</label>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <div class="file-upload-inner file-upload-inner-right ts-forms">
                                    <div class="input append-small-btn">
                                        <div class="file-button">
                                            Browse
                                            <input type="file" id="file_excel_kar" name="file_excel_kar" onchange="uploadExcelKaryawan()" multiple="" accept=".xls, .xlsx">
                                        </div>
                                        <input type="text" id="excel_karyawan" name="excel_karyawan" placeholder="No file excel">
                                        <!-- <input type="file" name="fileexcel" class="form-control" id="file" required accept=".xls, .xlsx" /></p> -->
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="address-hr tb-sm-res-d-n dps-tb-ntn">
                                    <p id="infopesan"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer2">
                        <!-- <input type="hidden" class="form-control form-control-sm inputdata" id="baseurl" name="baseurl" value=" base_url(); ?>"> -->
                        <a data-dismiss="modal" href="#">Cancel</a>
                        <!-- <button class="btn btn-primary" type="button" data-dismiss="modal">cancel</button> -->
                        <a href="#" type="submit" class="uploadexcel">Upload</a>
                        <!-- <button class="btn btn-primary uploadexcel" type="submit">Proses Upload</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
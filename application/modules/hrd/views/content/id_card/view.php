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
									
									<div class="card-body">
												<!-- <form class="form-inline" id="form_echo $methodid ?>"> -->
												 <form class="ui grid ecc_form" id="form_echo $methodid ?>">
																					 
												 <div class="col-xl-8">
												 <?php 
					                              
												   $this->ecc_library->form2('select_pop_line','Employee Name',"form_".$methodid,'karyawan_name','','','get_nama_karyawan','6');
			                                     ?>
												 </div>
												 
												<div class="col-xl-8">
												 <?php 
					                                $this->ecc_library->form2('select_pop_line','Departement',"form_".$methodid,'karyawan_departemen','','','get_departemen','4');
			                                     ?>
												 </div>
												 
												 <div class="col-xl-8">
												   <div class="form-group form-inline row">
												     <label for="inputPassword6"  class="col-sm-4 col-form-label">Date  &nbsp </label>
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text"><i class="fa fa-calendar"></i></span>
															</div>
															<input class="form-control" id="form_<?php echo $methodid ?>_date"  name="date" type="text" value="<?php echo date("Y-m-d") ?>" />
														</div>
																																					
												    </div>
												 </div>
												 <div class="col-xl-10">
													<div class="form-group form-inline row">
													<!-- D:\xampp\htdocs\SIPOP\application\modules\hrd\views\content\id_card -->
													<?php //echo base_url('\application\modules\hrd\views\content\id_card\new1.php') ; ?>
												<!--<a href="<?php //echo base_url('\application\modules\hrd\views\content\id_card\new1.php') ; ?>"  target="_blank">Visit Google</a>-->
													   
													    <button type="button" class="btn btn-default" id="cetak_idcard" >
														<i class="fa fa-search"></i> Cetak
														</button> 
													   
													   <button type="button" class="btn btn-default" id="cetak_idcardx" onclick="javascript:cetak_<?php echo $methodid ?>();">
														<i class="fa fa-search"></i> Cetak
														</button> 
														
														<button type="button" class="btn btn-default" onclick="javascript:search_<?php echo $methodid ?>();">
														<i class="fa fa-search"></i> Search
														</button> 	
														
														&nbsp &nbsp
														<button type="button" class="btn btn-default" id="add_edit" data-bs-toggle="modal" data-bs-target="#view_modal_cetak">
															<i class="fa fa-search"></i> Add/Edit
														</button>
														
														&nbsp &nbsp
														<button type="button" class="btn btn-default" onclick="javascript:print_<?php echo $methodid ?>_absen_1('pdf');">
															<i class="fa fa-search"></i> Print PDF
														</button>
														
														&nbsp &nbsp
														<button type="button" class="btn btn-default" onclick="javascript:print_<?php echo $methodid ?>_absen_1('xlsx');">
															<i class="fa fa-search"></i> Print Xlsx
														</button>
														
														&nbsp &nbsp
														<button type="button" class="btn btn-default" onclick="javascript:print_periode_<?php echo $methodid ?>('xlsx');">
															<i class="fa fa-search"></i> Print per Periode Xlsx
														</button>
														
														
													</div>	
                                                 </div>													
												</form>
												
												<div class="row">
							                        <div class="col-xl-12">
								                      <table id="table_<?php echo $methodid ?>_id_card"></table>
								                      <div id="ptable_<?php echo $methodid ?>_id_card"></div>                                                     
							                        </div>
						                         </div>
								                 <br />
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

	<div class="modal fade" id="view_modal_cetak" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
		  <div id="cobaCetak">
            <p>Hello World2</p>
			 <input type="text" id="form_<?php echo $methodid ?>_idabsen" name="idabsen" class="form-control">
          </div>
        </div>
      </div>
    </div>

        <div id="cobaCetak2">
            <p>Hello World2 ya...</p>
			 <input type="text" id="form_<?php echo $methodid ?>_idabsen2" name="idabsen" class="form-control">
          </div>

<script type="text/javascript">
function printClickxx() {
  var w = window.open();
  var html = $("#panel_content_form_<?php echo $methodid ?>").html();

  // how do I write the html to the new window with JQuery?
    $(w.document.body).html(html);
}

$(function() {
    $("a#print").click(printClick);
});
</script>
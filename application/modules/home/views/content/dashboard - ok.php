<div class="container-fluid">
   <div class="row align-items-center" style="margin-top:10%">
		<?php 
			$permision = $this->authentication->permission_check(25);
			//print_r($permision);
			if($permision){
		?>
		<div class="col-2 mx-auto">
			<div class="animated bounce center-menu text-center" style="text-align:center;font-family:chemay">
				<a href="javascript:add_tab(25,'Purchase','purchase','fa fa-shopping-basket');" >
					<img src="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>images/purchase.png" alt="" style="width:100%">
					<br>
					<h3>PURCHASE</h3>
				</a>
			</div>
		</div>
		<?php }?>
		
		<?php 
			$permision = $this->authentication->permission_check(26);
			if($permision){
		?>
		
		<div class="col-2 mx-auto">
			<div class="animated bounce center-menu text-center" style="text-align:center;font-family:chemay">
				<a href="javascript:add_tab(26,'Sales','sales','fa fa-line-chart');" >
					<img src="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>images/sales.png" alt="" style="width:100%">
					<br>
					<h3>SALES</h3>
				</a>
			</div>
		</div>
		<?php }?>
		
		<?php 
			$permision = $this->authentication->permission_check(27);
			if($permision){
		?>
		<div class="col-2 mx-auto">
			<div class="animated bounce center-menu text-center" style="text-align:center;font-family:chemay">
				<a href="javascript:add_tab(27,'Inventory','inventory','fa fa-archive');" >
					<img src="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>images/inventory.png" alt="" style="width:100%">
					<br>
					<h3>INVENTORY</h3>
				</a>
			</div>
		</div>
		<?php }?>
		
		<?php 
			$permision = $this->authentication->permission_check(7);
			if($permision){
		?>
		<div class="col-2 mx-auto">
			<div class="animated bounce center-menu text-center" style="text-align:center;font-family:chemay">
				<a href="javascript:add_tab(7,'Accounting','accounting','fa fa-pie-chart');" >
					<img src="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>images/akunting.png" alt="" style="width:100%">
					<br>
					<h3>ACCOUNTING</h3>
				</a>
			</div>
		</div>
		<?php }?>
		
		<?php 
			$permision = $this->authentication->permission_check(28);
			if($permision){
		?>
		<div class="col-2 mx-auto">
			<div class="animated bounce center-menu text-center" style="text-align:center;font-family:chemay">
				<a href="javascript:add_tab(28,'Reports','report','fa fa-files-o');" >
					<img src="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>images/reports.png" alt="" style="width:100%">
					<br>
					<h3>REPORTS</h3>
				</a>
			</div>
		</div>
		<?php }?>
		
		<?php 
			$permision_pop = $this->authentication->permission_check_pop(1015);
			if($permision_pop){
		?>
		<div class="col-2 mx-auto">
			<div class="animated bounce center-menu text-center" style="text-align:center;font-family:chemay">
				<a href="javascript:add_tab(1015,'HRD','hrd','fa fa-files-o');" >
					<img src="<?php echo BASEDIR . "assets/" . $path_template ."/" ?>images/hrd.png" alt="" style="width:100%">
					<br>
					<h3>HRD</h3>
				</a>
			</div>
		</div>
		<?php }?>
		
	</div>
</div>
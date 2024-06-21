<div class="side-menu-fixed">
	<div class="scrollbar side-menu-bg">
		<ul class="nav navbar-nav side-menu" id="sidebarnav">
			<?php 
				$permision = $this->authentication->permission_check(25);
				if($permision){
			?>
			<li>
				<a href="javascript:add_tab(25,'Purchase','purchase','fa fa-shopping-basket');">
					<div class="pull-left">
						<i class="fa fa-shopping-cart"></i>
						<span class="right-nav-text">PURCHASE</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			<?php } ?>
			
			<?php 
				$permision = $this->authentication->permission_check(26);
				if($permision){
			?>
			<li>
				<a href="javascript:add_tab(26,'Sales','sales','fa fa-line-chart');">
					<div class="pull-left">
						<i class="fa fa-bar-chart"></i>
						<span class="right-nav-text">SALES</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			<?php } ?>
			
			<?php 
				$permision = $this->authentication->permission_check(27);
				if($permision){
			?>
			<li>
				<a href="javascript:add_tab(27,'Inventory','inventory','fa fa-archive');">
					<div class="pull-left">
						<i class="fa fa-archive"></i>
						<span class="right-nav-text">INVENTORY</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			<?php } ?>
			
			<?php 
				$permision = $this->authentication->permission_check(7);
				if($permision){
			?>
			<li>
				<a href="javascript:add_tab(7,'Accounting','accounting','fa fa-pie-chart');">
					<div class="pull-left">
						<i class="fa fa-pie-chart"></i>
						<span class="right-nav-text">ACCOUNTING</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			<?php } ?>
			
			<?php 
				$permision = $this->authentication->permission_check(28);
				if($permision){
			?>
			<li>
				<a href="javascript:add_tab(28,'Reports','report','fa fa-files-o');">
					<div class="pull-left">
						<i class="fa fa-files-o"></i>
						<span class="right-nav-text">REPORTS</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			<?php } ?>
			
			<?php 
				//$permision = $this->authentication->permission_check(1015);
				$permission_pop = $this->authentication->permission_check_pop(1015);
				if($permission_pop){
			?>
			<li>
				<a href="javascript:add_tab(1015,'Hrd','hrd','fa fa-users');">
					<div class="pull-left">
						<i class="fa fa-users"></i>
						<span class="right-nav-text">HRD</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			<?php } ?>
			
			<?php 
				$permission_pop = $this->authentication->permission_check_pop(1044);
				if($permission_pop){
			?>
			<li>
				<a href="javascript:add_tab(1044,'Dashboard','dashboard','fa fa-bars');">
					<div class="pull-left">
						<i class="fa fa-bars"></i>
						<span class="right-nav-text">DASHBOARD</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			<?php } ?>
			
			<?php 
				$permision = $this->authentication->permission_check(23);
				if($permision){
			?>
			<li>
				<a href="javascript:add_tab(23,'Settings','settings','fa fa-gear');">
					<div class="pull-left">
						<i class="fa fa-gear"></i>
						<span class="right-nav-text">SETTINGS</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			<?php } ?>
			
			<?php 
				$permission_pop = $this->authentication->permission_check_pop(1075);
				if($permission_pop){
			?>
			<li>
				<a href="javascript:add_tab(1075,'Pattern','pattern','fa fa-puzzle-piece');">
					<div class="pull-left">
						<i class="fa fa-puzzle-piece"></i>
						<span class="right-nav-text">PATTERN</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			<?php } ?>
			
			<!--
			<li>
				<a href="javascript:add_tab(24,'Utilities','utilities','fa fa-gears');">
					<div class="pull-left">
						<i class="fa fa-gears"></i>
						<span class="right-nav-text">Utilities</span>
					</div>
					<div class="clearfix"></div>
				</a>
			</li>
			!-->
		</ul>
	</div> 
</div>
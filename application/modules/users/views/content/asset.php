<div class="content content-full content-custom">
	<div class="row">
		<div class="col-md-12">
			<div class="block block-bordered block-rounded block-custom">				
				<div class="input-group input-group-sm">
					<input type="text" class="form-control form-control-sm" placeholder="Search by Coin" id="search_asset">
					<div class="input-group-append">
						<button type="button" class="btn btn-primary">
							<i class="fa fa-fw fa-search"></i> Search
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	<!-- <div class="row" id="table_user_asset"></div> !-->
	<div class="row">
		<div class="col-md-12">
			<!-- Dynamic Table Full Pagination -->
			<div class="block">
				<div class="block-content overflow-y-auto block-custom">
					<table class="table table-sm font_table no_margin_table table-striped table-bordered nowrap" id="table_user_asset" width="100%">
						<thead>
							<tr>
								<th></th>
								<th>Coins</th>
								<th>Balance</th>
								<th>Pending</th>
								<th>Locked</th>
								<th>Total</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td><img src="<?php echo BASEDIR ?>assets/<?php echo $path_template ?>/media/loader.gif" alt=""> Loading data..</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>	
	<!-- END Latest Projects -->
</div>
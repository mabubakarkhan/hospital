<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>Users 
					<?php if ($permissions == 'all' || in_array('user_add', $permissions)): ?>
						<a href="<?=BASEURL.'facility/add'?>" class="btn btn-success" style="float: right;">Add Facility</a>
	              	<?php endif ?>
				</h3>.
			</div>
		</div>
    </div>

    <div class="container-fluid">
        <div class="row">
        	
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body">
						<div class="table-responsive theme-scrollbar">

							<table class="display" id="basic-1">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php if ($facilities): ?>
										<?php foreach ($facilities as $qKey => $q): ?>
											<tr>
												<td><?=($qKey+1)?></td>
												<td><?=$q['name']?></td>
												<td>
													<ul class="action">
														<?php if ($permissions == 'all' || in_array('building_facilities_edit', $permissions)): ?>
															<li class="edit"> <a href="<?=BASEURL.'facility/edit?id='.$q['building_facility_id']?>"><i class="icon-pencil-alt"></i></a></li>
										              	<?php endif ?>
														<!-- <li class="delete"><a href="#"><i class="icon-trash"></i></a></li> -->
													</ul>
												</td>
											</tr>
										<?php endforeach ?>
									<?php endif ?>

								</tbody>
							</table>

						</div><!-- /table-responsive -->
					</div><!-- /card-body -->
				</div><!-- /card -->
			</div><!-- /12 -->

        </div><!-- row -->
    </div><!-- /container-fluid -->

</div><!-- /dashboard-default -->
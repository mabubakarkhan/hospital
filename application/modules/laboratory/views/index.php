<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>Building 
					<?php if ($permissions == 'all' || in_array('building_building_add', $permissions)): ?>
						<a href="<?=BASEURL.'building/add-building'?>" class="btn btn-success" style="float: right;">Add Building</a>
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
										<th>City</th>
										<th>Address</th>
										<th>Floors</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php if ($buildings): ?>
										<?php foreach ($buildings as $qKey => $q): ?>
											<tr>
												<td><?=($qKey+1)?></td>
												<td><?=$q['name']?></td>
												<td><?=$q['city']?></td>
												<td><?=$q['address']?></td>
												<td>
													<?php if ($permissions == 'all' || in_array('building_floor_view', $permissions)): ?>
														<a href="<?=BASEURL.'building/floors/'.$q['building_id']?>"><i class="icon-pencil-alt"></i></a>
									              	<?php endif ?>
												</td>
												<td>
													<ul class="action">
														<?php if ($permissions == 'all' || in_array('building_building_edit', $permissions)): ?>
															<li class="edit"> <a href="<?=BASEURL.'building/edit-building?id='.$q['building_id']?>"><i class="icon-pencil-alt"></i></a></li>
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
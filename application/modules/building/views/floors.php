<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>Floor 
					<?php if ($permissions == 'all' || in_array('building_floor_add', $permissions)): ?>
						<a href="<?=BASEURL.'building/add-floor/'.$buildingId?>" class="btn btn-success" style="float: right;">Add Floor</a>
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
										<th>Title</th>
										<th>Story</th>
										<th>Building</th>
										<th>Rooms</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php if ($floors): ?>
										<?php foreach ($floors as $qKey => $q): ?>
											<tr>
												<td><?=($qKey+1)?></td>
												<td><?=$q['title']?></td>
												<td><?=$q['story']?></td>
												<td><?=$q['buildingName']?></td>
												<td>
													<?php if ($permissions == 'all' || in_array('building_room_view', $permissions)): ?>
														<a href="<?=BASEURL.'building/rooms/'.$q['floor_id']?>"><i class="icon-pencil-alt"></i></a>
									              	<?php else: ?>
														<?=$q['room_count']?>
									              	<?php endif ?>
												</td>
												<td>
													<ul class="action">
														<?php if ($permissions == 'all' || in_array('building_floor_edit', $permissions)): ?>
															<li class="edit"> <a href="<?=BASEURL.'building/edit-floor?id='.$q['floor_id']?>"><i class="icon-pencil-alt"></i></a></li>
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
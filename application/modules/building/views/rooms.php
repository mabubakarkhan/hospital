<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3><?=$page_title?> 
					<?php if ($permissions == 'all' || in_array('building_room_add', $permissions)): ?>
						<a href="<?=BASEURL.'building/add-room/'.$floorId?>" class="btn btn-success" style="float: right;">Add Room</a>
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
										<th>Room#</th>
										<th>Title</th>
										<th>Floor</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php if ($rooms): ?>
										<?php foreach ($rooms as $qKey => $q): ?>
											<tr>
												<td><?=$q['room_number']?></td>
												<td><?=$q['title']?></td>
												<td><?=$q['floorTitle']?></td>
												<td>
													<ul class="action">
														<?php if ($permissions == 'all' || in_array('building_room_edit', $permissions)): ?>
															<li class="edit"> <a href="<?=BASEURL.'building/edit-room/'.$floorId.'/?id='.$q['room_id']?>"><i class="icon-pencil-alt"></i></a></li>
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
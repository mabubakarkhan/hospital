<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3><?=$user['fname'].' '.$user['lname'].' ('.$role['title'].')'?> - Rooms 
					<?php if ($permissions == 'all' || in_array('assign_room_assign', $permissions)): ?>
						<a href="#assigningRoomFormId" class="btn btn-success" style="float: right;">Asign Room</a>
	              	<?php endif ?>
				</h3>
				<br>
				<?php if ($this->session->flashdata('success')): ?>
					<p class="alert alert-success"><?=$this->session->flashdata('success')?></p>
				<?php endif ?>
				<?php if ($this->session->flashdata('error')): ?>
					<p class="alert alert-danger"><?=$this->session->flashdata('error')?></p>
				<?php endif ?>
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
										<th>Room Number</th>
										<th>Room Title</th>
										<th>Floor</th>
										<th>Story</th>
										<th>Building</th>
										<?php if ($permissions == 'all' || in_array('assign_room_change', $permissions)): ?>
											<th>Change</th>
										<?php endif ?>
										<?php if ($permissions == 'all' || in_array('assign_room_remove', $permissions)): ?>
											<th>Remove</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>

									<?php if ($rooms): ?>
										<?php foreach ($rooms as $qKey => $q): ?>
											<tr>
												<td><?=$q['room_number']?></td>
												<td><?=$q['roomTitle']?></td>
												<td><?=$q['floorTitle']?></td>
												<td><?=$q['story']?></td>
												<td><?=$q['buildingName']?></td>
												<?php if ($permissions == 'all' || in_array('assign_room_change', $permissions)): ?>
													<td>
														<ul class="action">
															<li class="edit"><a href="<?=BASEURL.'user/edit-user-room?id='.$q['user_room_id']?>"><i class="icon-pencil-alt"></i></a></li>
											        	</ul>
													</td>
											    <?php endif ?>
												<?php if ($permissions == 'all' || in_array('assign_room_remove', $permissions)): ?>
													<td>
														<ul class="action">
															<li class="delete"><a href="<?=BASEURL.'user/remove-user-room?id='.$q['user_room_id']?>"><i class="icon-trash"></i></a></li>
														</ul>
													</td>
											    <?php endif ?>
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



    <?php if ($permissions == 'all' || in_array('assign_room_assign', $permissions)): ?>
	    <div class="container-fluid" id="assigningRoomFormId">
	        <div class="row">
	        	
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">

							<h3>Assing Room To This User</h3>

							<form action="<?=BASEURL."user/post-user-room"?>" method="post" enctype="multipart/form-data" >
								<input type="hidden" name="user_id" value="<?=$user['user_id']?>">
								<div class="row">

									<div class="col-md-6">
										<div class="mb-3">
											<label class="form-label">Building</label>
											<select name="building_id" class="form-select" required>
												<option value="">Select Building</option>
												<?php foreach ($buildings as $keyBuilding => $building): ?>
													<option value="<?=$building['building_id']?>"><?=$building['name']?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div><!-- /6 -->
									<div class="col-md-6">
										<div class="mb-3">
											<label class="form-label">Floor</label>
											<select name="floor_id" class="form-select" required>
												<option value="">Select</option>
											</select>
										</div>
									</div><!-- /6 -->
									<div class="col-md-6">
										<div class="mb-3">
											<label class="form-label">Room</label>
											<select name="room_id" class="form-select" required>
												<option value="">Select</option>
											</select>
										</div>
									</div><!-- /6 -->
									<div class="card-footer text-end">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
								</div><!-- /row -->

							</form>

						</div><!-- /card-body -->
					</div><!-- /card -->
				</div><!-- /12 -->

	        </div><!-- row -->
	    </div><!-- /container-fluid -->
    <?php endif ?>



</div><!-- /dashboard-default -->
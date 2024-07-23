<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3><?=$page_title?> 
					<?php if ($permissions == 'all' || in_array('room_time_table_add', $permissions)): ?>
						<a href="#assigningRoomFormId" class="btn btn-success" style="float: right;">Add Time Table</a>
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
										<th>Day #</th>
										<th>Day Name</th>
										<th>Time</th>
										<?php if ($permissions == 'all' || in_array('room_time_table_remove', $permissions)): ?>
											<th>Remove</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>

									<?php if ($slots): ?>
										<?php foreach ($slots as $qKey => $q): ?>
											<tr>
												<td><?=$q['day_number']?></td>
												<td><span style="text-transform: capitalize;"><?=$q['day_name']?></span></td>
												<td><strong><?=date('H:i A',strtotime($q['time_from'])).' - '.date('h:i A',strtotime($q['time_to']))?></strong></td>
												<?php if ($permissions == 'all' || in_array('room_time_table_remove', $permissions)): ?>
													<td>
														<ul class="action">
															<li class="delete"><a href="<?=BASEURL.'user/remove-user-room-time-table?id='.$q['user_room_time_id']?>"><i class="icon-trash"></i></a></li>
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



    <?php if ($permissions == 'all' || in_array('room_time_table_add', $permissions)): ?>
	    <div class="container-fluid" id="assigningRoomFormId">
	        <div class="row">
	        	
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">

							<h3>Set Time Table</h3>
							<div class="errorMsgSection" style="display: none;">
								<p class="alert alert-danger"></p>
							</div>
							<div class="successMsgSection" style="display: none;">
								<p class="alert alert-success"></p>
							</div>

							<form>
								<input type="hidden" name="user_room_id" value="<?=$user_room['user_room_id']?>">
								<input type="hidden" name="room_id" value="<?=$room['room_id']?>">
								<input type="hidden" name="user_id" value="<?=$user['user_id']?>">
								<div class="row">

									<div class="col-md-4">
										<div class="mb-3">
											<label class="form-label">Day</label>
											<select name="day_number" class="form-select" required>
												<option value="">Select Day</option>
												<option value="1">Monday</option>
												<option value="2">Tuesday</option>
												<option value="3">Wednesday</option>
												<option value="4">Thursday</option>
												<option value="5">Friday</option>
												<option value="6">Saturday</option>
												<option value="7">Sunday</option>
											</select>
										</div>
									</div><!-- /4 -->
									<div class="col-md-4">
										<div class="mb-3">
											<label class="form-label">Time From</label>
											<input class="form-control" name="time_from" type="time" required="">
										</div>
									</div><!-- /4 -->
									<div class="col-md-4">
										<div class="mb-3">
											<label class="form-label">Time To</label>
											<input class="form-control" name="time_to" type="time" required="">
										</div>
									</div><!-- /4 -->
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
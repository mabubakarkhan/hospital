<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3><?=$page_title?></h3>
			</div>
		</div>
    </div>

    <!-- Container-fluid starts-->
  	<div class="container-fluid form-validate">
		<div class="row">

			<div class="col-sm-12 col-xl-12">
				<div class="card">
					<div class="card-body">
						<form autocomplete="off" enctype="multipart/form-data" method="post" action="<?=BASEURL."user/update-user-room"?>">
							<input type="hidden" name="id" value="<?=$room['user_room_id']?>">
							<input type="hidden" name="user_id" value="<?=$room['user_id']?>">
							<div class="row">

								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Building</label>
										<select name="building_id" class="form-select" required>
											<option value="">Select Building</option>
											<?php foreach ($buildings as $keyBuilding => $building): ?>
												<option value="<?=$building['building_id']?>" <?=($building['building_id'] == $room['building_id']) ? 'selected' : ''?> ><?=$building['name']?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Floor</label>
										<select name="floor_id" class="form-select" required>
											<option value="">Select Floor</option>
											<?php foreach ($floors as $keyFloor => $floor): ?>
												<option value="<?=$floor['floor_id']?>" <?=($floor['floor_id'] == $room['floor_id']) ? 'selected' : ''?> ><?=$floor['title'].' (story - '.$floor['story'].') '?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Room</label>
										<select name="room_id" class="form-select" required>
											<option value="">Select Room</option>
											<?php foreach ($rooms as $keyRoom => $Room): ?>
												<?php if ($Room['room_id'] != $room['room_id']): ?>
													<option value="<?=$Room['room_id']?>"><?=$Room['title'].' ('.$Room['room_number'].') '?></option>
												<?php endif ?>
											<?php endforeach ?>
										</select>
									</div>
								</div><!-- /6 -->

							</div><!-- /row -->
							<div class="card-footer text-end">
								<button type="submit" class="btn btn-primary">Change</button>
								<a href="<?=BASEURL.'user/room/'.$user['user_id']?>" class="btn btn-secondary">Cancel</a>
							</div>
							<div class="card-footer-loader" style="display: none;">
								<div class="loader-box"><div class="loader-2"></div></div>
							</div>
						</form>
					</div>
				</div><!-- /card -->
			</div><!-- /6 -->
		</div><!-- /row -->
	</div>
	<!-- Container-fluid Ends-->

</div><!-- /dashboard-default -->
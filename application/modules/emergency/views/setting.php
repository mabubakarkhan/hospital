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
			<h2>Setting</h2>
			<div class="col-sm-12 col-xl-12">
				<div class="card">
					<div class="card-body">
						<form autocomplete="off" enctype="multipart/form-data" method="post" id="emergency-setting-form-id" action="
			          	<?php
				  		if($mode != 'edit')echo BASEURL."emergency/setting-update";
					  	else echo BASEURL."emergency/setting-update/";
				  		?>">

							<div class="row">

								<?php if ($this->session->flashdata('success')): ?>
									<p class="alert alert-success"><?=$this->session->flashdata('success')?></p>
								<?php endif ?>
								<?php if ($this->session->flashdata('error')): ?>
									<p class="alert alert-danger"><?=$this->session->flashdata('error')?></p>
								<?php endif ?>
								
								<div class="show-msg"></div>
								<br>

								<div class="col-md-3">
									<div class="mb-3">
										<label class="form-label">Fee</label>
										<input class="form-control" name="fee" type="text" value="<?=$q['fee']?>" required="">
									</div>
								</div><!-- /3 -->
								<div class="col-md-3">
									<div class="mb-3">
										<label class="form-label">Hours</label>
										<input class="form-control" name="hours" type="text" value="<?=$q['hours']?>" required="">
									</div>
								</div><!-- /3 -->
								<div class="col-md-3">
									<div class="mb-3">
										<label class="form-label">Open</label>
										<input class="form-control" name="open" type="time" value="<?=date('H:i:s',strtotime($q['open']))?>">
									</div>
								</div><!-- /3 -->
								<div class="col-md-3">
									<div class="mb-3">
										<label class="form-label">Close</label>
										<input class="form-control" name="close" type="time" value="<?=date('H:i:s',strtotime($q['close']))?>">
									</div>
								</div><!-- /3 -->

							</div><!-- /row -->
							<div class="card-footer text-end">
								<button type="submit" class="btn btn-primary">Update</button>
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

	<!-- Container-fluid starts-->
  	<div class="container-fluid">
		<div class="row">
			<h2>Services</h2>
			<div class="col-sm-12 col-xl-12">
				<form autocomplete="off" enctype="multipart/form-data" method="post" id="emergency-setting-user-form-id" action="
		          	<?php
			  		if($mode != 'edit')echo BASEURL."emergency/update-services";
				  	else echo BASEURL."emergency/update-services/";
			  		?>">

					<div class="row">

						<?php if ($this->session->flashdata('success')): ?>
							<p class="alert alert-success"><?=$this->session->flashdata('success')?></p>
						<?php endif ?>
						<?php if ($this->session->flashdata('error')): ?>
							<p class="alert alert-danger"><?=$this->session->flashdata('error')?></p>
						<?php endif ?>
						
						<div class="show-msg"></div>
						<br>

					</div><!-- row -->

					<div class="userServices">

						<?php if ($time_table): ?>
							<?php foreach ($time_table as $keyTT => $tt): ?>
								<div class="row" style="background: #fff;margin: 20px 0;padding: 20px;border-radius: 10px;">

									<div class="col-md-2">
										<div class="mb-3">
											<label class="form-label">Service</label>
											<select name="service_id[]" class="form-control service-select" required>
												<option value="">Select</option>
												<?php foreach ($services as $key => $service): ?>
													<option value="<?=$service['service_id']?>" <?=($tt['service_id'] == $service['service_id']) ? 'selected' : ''?> ><?=$service['name']?></option>
												<?php endforeach ?>
											</select>
										</div>
									</div><!-- /2 -->
									<div class="col-md-3">
										<div class="mb-3">
											<label class="form-label">Doctor</label>
											<select name="user_id[]" class="form-control user-select editMode" required multiple>
												<option value="">Select</option>
												<?php foreach ($users as $key => $user): ?>
													<?php if (($user['user_id'] == $tt['user_id']) && ($user['service_id'] == $tt['service_id'])): ?>
														<option value="<?=$user['user_id']?>" data-service="<?=$user['service_id']?>" selected><?=$user['fname'].' '.$user['lname'].'('.$user['roleTitle'].')'?></option>
													<?php else: ?>
														<option value="<?=$user['user_id']?>" data-service="<?=$user['service_id']?>" style="display: none;"><?=$user['fname'].' '.$user['lname'].'('.$user['roleTitle'].')'?></option>
													<?php endif ?>
												<?php endforeach ?>
											</select>
										</div>
									</div><!-- /3 -->
									<div class="col-md-4">
										<div class="mb-3">
											<table class="table table-striped table-bordered w-100">
											  <thead>
											    <tr style="font-size: 11px;">
											      <th><strong>Day</strong></th>
											      <th><strong>Status</strong></th>
											      <th><strong>Open Time</strong></th>
											      <th><strong>Close Time</strong></th>
											    </tr>
											  </thead>
											  <tbody>
											    <tr>
											      <td style="text-align: center;font-size: 11px;">Monday</td>
											      <td style="font-size: 10px;">
											        <input type="checkbox" name="monday_status[]" value="on" <?=($tt['monday_status'] == 'on') ? 'checked' : ''?>> On <br>
											        <input type="checkbox" name="monday_status[]" value="off" <?=($tt['monday_status'] == 'off') ? 'checked' : ''?>> Off
											      </td>
											      <td><input type="time" name="monday_open[]" value="<?=date('H:i:s',strtotime($tt['monday_open']))?>" style="font-size: 10px;"></td>
											      <td><input type="time" name="monday_close[]" value="<?=date('H:i:s',strtotime($tt['monday_close']))?>" style="font-size: 10px;"></td>
											    </tr>
											    <tr>
											      <td style="text-align: center;font-size: 11px;">Tuesday</td>
											      <td style="font-size: 10px;">
											        <input type="checkbox" name="tuesday_status[]" value="on" <?=($tt['tuesday_status'] == 'on') ? 'checked' : ''?>> On <br>
											        <input type="checkbox" name="tuesday_status[]" value="off" <?=($tt['tuesday_status'] == 'off') ? 'checked' : ''?>> Off
											      </td>
											      <td><input type="time" name="tuesday_open[]" value="<?=date('H:i:s',strtotime($tt['tuesday_open']))?>" style="font-size: 10px;"></td>
											      <td><input type="time" name="tuesday_close[]" value="<?=date('H:i:s',strtotime($tt['tuesday_close']))?>" style="font-size: 10px;"></td>
											    </tr>
											    <tr>
											      <td style="text-align: center;font-size: 11px;">Wednesday</td>
											      <td style="font-size: 10px;">
											        <input type="checkbox" name="wednesday_status[]" value="on" <?=($tt['wednesday_status'] == 'on') ? 'checked' : ''?>> On <br>
											        <input type="checkbox" name="wednesday_status[]" value="off" <?=($tt['wednesday_status'] == 'off') ? 'checked' : ''?>> Off
											      </td>
											      <td><input type="time" name="wednesday_open[]" value="<?=date('H:i:s',strtotime($tt['wednesday_open']))?>" style="font-size: 10px;"></td>
											      <td><input type="time" name="wednesday_close[]" value="<?=date('H:i:s',strtotime($tt['wednesday_close']))?>" style="font-size: 10px;"></td>
											    </tr>
											    <tr>
											      <td style="text-align: center;font-size: 11px;">Thursday</td>
											      <td style="font-size: 10px;">
											        <input type="checkbox" name="thursday_status[]" value="on" <?=($tt['thursday_status'] == 'on') ? 'checked' : ''?>> On <br>
											        <input type="checkbox" name="thursday_status[]" value="off" <?=($tt['thursday_status'] == 'off') ? 'checked' : ''?>> Off
											      </td>
											      <td><input type="time" name="thursday_open[]" value="<?=date('H:i:s',strtotime($tt['thursday_open']))?>" style="font-size: 10px;"></td>
											      <td><input type="time" name="thursday_close[]" value="<?=date('H:i:s',strtotime($tt['thursday_close']))?>" style="font-size: 10px;"></td>
											    </tr>
											    <tr>
											      <td style="text-align: center;font-size: 11px;">Friday</td>
											      <td style="font-size: 10px;">
											        <input type="checkbox" name="friday_status[]" value="on" <?=($tt['friday_status'] == 'on') ? 'checked' : ''?>> On <br>
											        <input type="checkbox" name="friday_status[]" value="off" <?=($tt['friday_status'] == 'off') ? 'checked' : ''?>> Off
											      </td>
											      <td><input type="time" name="friday_open[]" value="<?=date('H:i:s',strtotime($tt['friday_open']))?>" style="font-size: 10px;"></td>
											      <td><input type="time" name="friday_close[]" value="<?=date('H:i:s',strtotime($tt['friday_close']))?>" style="font-size: 10px;"></td>
											    </tr>
											    <tr>
											      <td style="text-align: center;font-size: 11px;">Saturday</td>
											      <td style="font-size: 10px;">
											        <input type="checkbox" name="saturday_status[]" value="on" <?=($tt['saturday_status'] == 'on') ? 'checked' : ''?>> On <br>
											        <input type="checkbox" name="saturday_status[]" value="off" <?=($tt['saturday_status'] == 'off') ? 'checked' : ''?>> Off
											      </td>
											      <td><input type="time" name="saturday_open[]" value="<?=date('H:i:s',strtotime($tt['saturday_open']))?>" style="font-size: 10px;"></td>
											      <td><input type="time" name="saturday_close[]" value="<?=date('H:i:s',strtotime($tt['saturday_close']))?>" style="font-size: 10px;"></td>
											    </tr>
											    <tr>
											      <td style="text-align: center;font-size: 11px;">Sunday</td>
											      <td style="font-size: 10px;">
											        <input type="checkbox" name="sunday_status[]" value="on" <?=($tt['sunday_status'] == 'on') ? 'checked' : ''?>> On <br>
											        <input type="checkbox" name="sunday_status[]" value="off" <?=($tt['sunday_status'] == 'off') ? 'checked' : ''?>> Off
											      </td>
											      <td><input type="time" name="sunday_open[]" value="<?=date('H:i:s',strtotime($tt['sunday_open']))?>" style="font-size: 10px;"></td>
											      <td><input type="time" name="sunday_close[]" value="<?=date('H:i:s',strtotime($tt['sunday_close']))?>" style="font-size: 10px;"></td>
											    </tr>
											  </tbody>
											</table>

										</div>
									</div><!-- /4 -->
									<div class="col-md-1">
										<div class="mb-3">
											<label class="form-label">Fee</label>
											<input class="form-control" name="fee[]" type="text" value="<?=$tt['fee']?>" required="">
										</div>
									</div><!-- /1 -->
									<div class="col-md-2">
										<div class="mt-4">
											<a href="javascript" class="btn btn-success addNewLine"><i class="fa fa-plus"></i></a>
											<a href="javascript" class="btn btn-danger removeLine"><i class="fa fa-minus"></i></a>
										</div>
									</div><!-- /2 -->
									
								</div><!-- /row -->	
							<?php endforeach ?>
						<?php else: ?>

							<div class="row" style="background: #fff;margin: 20px 0;padding: 20px;border-radius: 10px;">

								<div class="col-md-2">
									<div class="mb-3">
										<label class="form-label">Service</label>
										<select name="service_id[]" class="form-control service-select" required>
											<option value="">Select</option>
											<?php foreach ($services as $key => $service): ?>
												<option value="<?=$service['service_id']?>"><?=$service['name']?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div><!-- /2 -->
								<div class="col-md-3">
									<div class="mb-3">
										<label class="form-label">Doctor</label>
										<select name="user_id[]" class="form-control user-select" required multiple>
											<option value="">Select</option>
											<?php foreach ($users as $key => $user): ?>
												<option value="<?=$user['user_id']?>" data-service="<?=$user['service_id']?>"><?=$user['fname'].' '.$user['lname'].'('.$user['roleTitle'].')'?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div><!-- /3 -->
								<div class="col-md-4">
									<div class="mb-3">
										<table class="table table-striped table-bordered w-100">
										  <thead>
										    <tr style="font-size: 11px;">
										      <th><strong>Day</strong></th>
										      <th><strong>Status</strong></th>
										      <th><strong>Open Time</strong></th>
										      <th><strong>Close Time</strong></th>
										    </tr>
										  </thead>
										  <tbody>
										    <tr>
										      <td style="text-align: center;font-size: 11px;">Monday</td>
										      <td style="font-size: 10px;">
										        <input type="checkbox" name="monday_status[]" value="on" checked> On <br>
										        <input type="checkbox" name="monday_status[]" value="off"> Off
										      </td>
										      <td><input type="time" name="monday_open[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										      <td><input type="time" name="monday_close[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										    </tr>
										    <tr>
										      <td style="text-align: center;font-size: 11px;">Tuesday</td>
										      <td style="font-size: 10px;">
										        <input type="checkbox" name="tuesday_status[]" value="on" checked> On <br>
										        <input type="checkbox" name="tuesday_status[]" value="off"> Off
										      </td>
										      <td><input type="time" name="tuesday_open[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										      <td><input type="time" name="tuesday_close[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										    </tr>
										    <tr>
										      <td style="text-align: center;font-size: 11px;">Wednesday</td>
										      <td style="font-size: 10px;">
										        <input type="checkbox" name="wednesday_status[]" value="on" checked> On <br>
										        <input type="checkbox" name="wednesday_status[]" value="off"> Off
										      </td>
										      <td><input type="time" name="wednesday_open[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										      <td><input type="time" name="wednesday_close[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										    </tr>
										    <tr>
										      <td style="text-align: center;font-size: 11px;">Thursday</td>
										      <td style="font-size: 10px;">
										        <input type="checkbox" name="thursday_status[]" value="on" checked> On <br>
										        <input type="checkbox" name="thursday_status[]" value="off"> Off
										      </td>
										      <td><input type="time" name="thursday_open[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										      <td><input type="time" name="thursday_close[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										    </tr>
										    <tr>
										      <td style="text-align: center;font-size: 11px;">Friday</td>
										      <td style="font-size: 10px;">
										        <input type="checkbox" name="friday_status[]" value="on" checked> On <br>
										        <input type="checkbox" name="friday_status[]" value="off"> Off
										      </td>
										      <td><input type="time" name="friday_open[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										      <td><input type="time" name="friday_close[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										    </tr>
										    <tr>
										      <td style="text-align: center;font-size: 11px;">Saturday</td>
										      <td style="font-size: 10px;">
										        <input type="checkbox" name="saturday_status[]" value="on" checked> On <br>
										        <input type="checkbox" name="saturday_status[]" value="off"> Off
										      </td>
										      <td><input type="time" name="saturday_open[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										      <td><input type="time" name="saturday_close[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										    </tr>
										    <tr>
										      <td style="text-align: center;font-size: 11px;">Sunday</td>
										      <td style="font-size: 10px;">
										        <input type="checkbox" name="sunday_status[]" value="on" checked> On <br>
										        <input type="checkbox" name="sunday_status[]" value="off"> Off
										      </td>
										      <td><input type="time" name="sunday_open[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										      <td><input type="time" name="sunday_close[]" value="<?=date('H:i:s')?>" style="font-size: 10px;"></td>
										    </tr>
										  </tbody>
										</table>

									</div>
								</div><!-- /4 -->
								<div class="col-md-1">
									<div class="mb-3">
										<label class="form-label">Fee</label>
										<input class="form-control" name="fee[]" type="text" value="<?=$q['fee']?>" required="">
									</div>
								</div><!-- /1 -->
								<div class="col-md-2">
									<div class="mt-4">
										<a href="javascript" class="btn btn-success addNewLine"><i class="fa fa-plus"></i></a>
										<a href="javascript" class="btn btn-danger removeLine"><i class="fa fa-minus"></i></a>
									</div>
								</div><!-- /2 -->
								
							</div><!-- /row -->

						<?php endif ?>
					</div><!-- /userServices -->

					<div class="mb-4">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</form>
			</div><!-- /12 -->
		</div><!-- /row -->
	</div><!-- /container -->

</div><!-- /dashboard-default -->
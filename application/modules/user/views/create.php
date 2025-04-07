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
						<form autocomplete="off" enctype="multipart/form-data" method="post" action="
			          	<?php
				  		if($mode != 'edit')echo BASEURL."user/post";
					  	else echo BASEURL."user/update/";
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

								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">First Name</label>
										<input class="form-control" name="fname" type="text" value="<?=$q['fname']?>" required="">
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Last Name</label>
										<input class="form-control" name="lname" type="text" value="<?=$q['lname']?>" required="">
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Username</label>
										<input class="form-control" name="username" type="text" value="<?=$q['username']?>" required="">
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Password</label>
										<input class="form-control" name="password" type="text" value="<?=$q['password_text']?>" required="">
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Role</label>
										<select name="role_id" class="form-select" required>
											<option value="">Select</option>
											<?php foreach ($roles as $keyRole => $role): ?>
												<option value="<?=$role['role_id']?>" <?=($role['role_id'] == $q['role_id']) ? 'selected' : ''?> ><?=$role['title']?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Phone</label>
										<input class="form-control" name="phone" type="text" value="<?=$q['phone']?>" required="">
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Email</label>
										<input class="form-control" name="email" type="email" value="<?=$q['email']?>" required="">
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Emergency Service</label>
										<select name="emergency_service" class="form-control" required>
											<?php if ($q['emergency_service'] == 'yes'): ?>
												<option value="yes" selected>YES</option>
												<option value="no">NO</option>
											<?php else: ?>
												<option value="yes">YES</option>
												<option value="no" selected>NO</option>
											<?php endif ?>
										</select>
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Profile Pic</label>
										<?php if ($mode == 'edit'): ?>
											<input class="form-control" type="file" data-bs-original-title="" name="img">
											<br><a href="<?=UPLOADS.'user/'.$q['img']?>" target="_blank"><img src="<?=UPLOADS.'user/'.$q['img']?>" width="150"></a>
										<?php else: ?>
											<input class="form-control" type="file" data-bs-original-title="" name="img" required>
										<?php endif ?>
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">CV</label>
										<input class="form-control" type="file" data-bs-original-title="" name="cv">
										<?php if ($mode == 'edit' && !(empty($q['cv']))): ?>
											<br><a href="<?=UPLOADS.'cv/'.$q['cv']?>" target="_blank"><i class="fa fa-file-pdf-o"></i> CV</a>
										<?php endif ?>
									</div>
								</div><!-- /6 -->
							</div><!-- /row -->
							<div class="card-footer text-end">
								<?php if ($mode == 'edit'): ?>
									<input type="hidden" name="id" value="<?=$editID?>">
									<button type="submit" class="btn btn-primary">Update</button>
								<?php else: ?>
									<button type="submit" class="btn btn-primary">Submit</button>
								<?php endif ?>
								<a href="<?=BASEURL.'user'?>" class="btn btn-secondary">Cancel</a>
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
<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3><?=$page_title?></h3>.
			</div>
		</div>
    </div>

	<form>
		<input type="hidden" name="id" value="<?=$q['role_id']?>">
	    <!-- Container-fluid starts-->
	  	<div class="container-fluid form-validate">
			<div class="row"><div class="col-sm-12 col-xl-12"><div class="show-msg"></div><br></div></div>

			<div class="row">

				<div class="col-sm-12 col-xl-6">
					<div class="card">
						<div class="card-body">

							<div class="col-sm-12">
                        		<h5><div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                        					<input class="form-check-input" id="role-inline-0" type="checkbox" name="title[]" value="role" <?=(in_array('role', $permissionsArr)) ? 'checked' : ''?> >
										<label class="form-check-label" for="role-inline-0"><strong>Role</strong></label>
									</div>
                        		</h5>
                      		</div>
	                      	<div class="col">
								<div class="m-t-15 m-checkbox-inline">
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="role-inline-1" type="checkbox" name="title[]" value="role_view" <?=(in_array('role_view', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="role-inline-1">View</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="role-inline-2" type="checkbox" name="title[]" value="role_add" <?=(in_array('role_add', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="role-inline-2">Create</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="role-inline-3" type="checkbox" name="title[]" value="role_edit" <?=(in_array('role_edit', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="role-inline-3">Edit</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="role-inline-4" type="checkbox" name="title[]" value="role_permissions" <?=(in_array('role_permissions', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="role-inline-4">Edit Permissions</label>
									</div>
								</div>
	                      	</div><!-- /col -->

						</div>
					</div><!-- /card -->
				</div><!-- /6 -->

				<div class="col-sm-12 col-xl-6">
					<div class="card">
						<div class="card-body">

							<div class="col-sm-12">
                        		<h5><div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                        				<input class="form-check-input" id="user-inline-0" type="checkbox" name="title[]" value="user" <?=(in_array('user', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="user-inline-0"><strong>User</strong></label>
									</div>
                        		</h5>
                      		</div>
	                      	<div class="col">
								<div class="m-t-15 m-checkbox-inline">
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="user-inline-1" type="checkbox" name="title[]" value="user_view" <?=(in_array('user_view', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="user-inline-1">View</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="user-inline-2" type="checkbox" name="title[]" value="user_add" <?=(in_array('user_add', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="user-inline-2">Create</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="user-inline-3" type="checkbox" name="title[]" value="user_edit" <?=(in_array('user_edit', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="user-inline-3">Edit</label>
									</div>
								</div>
	                      	</div><!-- /col -->

						</div>
					</div><!-- /card -->
				</div><!-- /6 -->

			</div><!-- /row -->

			<div class="row">
				<div class="col-md-3">
					<div class="card-footer" style="border: none;background: transparent;">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="<?=BASEURL.'role'?>" class="btn btn-secondary">Cancel</a>
					</div>
					<div class="card-footer-loader" style="display: none;">
						<div class="loader-box"><div class="loader-2"></div></div>
					</div>
				</div><!-- /12 -->
			</div><!-- /row -->

		</div>
		<!-- Container-fluid Ends-->
	</form>

</div><!-- /dashboard-default -->
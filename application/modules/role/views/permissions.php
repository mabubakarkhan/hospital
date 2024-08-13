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
                        		<h5>
                        			<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
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

				<div class="col-sm-12 col-xl-6">
					<div class="card">
						<div class="card-body">

							<div class="col-sm-12">
                        		<h5>
                        			<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                        					<input class="form-check-input" id="service-inline-0" type="checkbox" name="title[]" value="service" <?=(in_array('service', $permissionsArr)) ? 'checked' : ''?> >
										<label class="form-check-label" for="service-inline-0"><strong>Service</strong></label>
									</div>
                        		</h5>
                      		</div>
	                      	<div class="col">
								<div class="m-t-15 m-checkbox-inline">
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="service-inline-1" type="checkbox" name="title[]" value="service_view" <?=(in_array('service_view', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="service-inline-1">View service</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="service-inline-2" type="checkbox" name="title[]" value="service_add" <?=(in_array('service_add', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="service-inline-2">Add service</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="service-inline-3" type="checkbox" name="title[]" value="service_edit" <?=(in_array('service_edit', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="service-inline-3">Edit Service</label>
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
                        		<h5>
                        			<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                        					<input class="form-check-input" id="service_allocation_to_user-inline-0" type="checkbox" name="title[]" value="service_allocation_to_user" <?=(in_array('service_allocation_to_user', $permissionsArr)) ? 'checked' : ''?> >
										<label class="form-check-label" for="service_allocation_to_user-inline-0"><strong>Service Allocation To User</strong></label>
									</div>
                        		</h5>
                      		</div>
	                      	<div class="col">
								<div class="m-t-15 m-checkbox-inline">
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="service_allocation_to_user-inline-1" type="checkbox" name="title[]" value="service_allocation_to_user_view" <?=(in_array('service_allocation_to_user_view', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="service_allocation_to_user-inline-1">View Allocation</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="service_allocation_to_user-inline-3" type="checkbox" name="title[]" value="service_allocation_to_user_edit" <?=(in_array('service_allocation_to_user_edit', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="service_allocation_to_user-inline-3">Edit Allocation</label>
									</div>
								</div>
	                      	</div><!-- /col -->

						</div>
					</div><!-- /card -->
				</div><!-- /6 -->


			</div><!-- /row -->


			<div class="row">

				<div class="col-sm-12 col-xl-9">
					<div class="card">
						<div class="card-body">

							<div class="col-sm-12">
                        		<h5><div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                    					<input class="form-check-input" id="building-inline-0" type="checkbox" name="title[]" value="building" <?=(in_array('building', $permissionsArr)) ? 'checked' : ''?> >
										<label class="form-check-label" for="building-inline-0"><strong>Building</strong></label>
									</div>
                        		</h5>
                      		</div>
	                      	<div class="col">
								<div class="m-t-15 m-checkbox-inline">
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="building-inline-11" type="checkbox" name="title[]" value="building_building_view" <?=(in_array('building_building_view', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="building-inline-11">View Building</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="building-inline-22" type="checkbox" name="title[]" value="building_building_add" <?=(in_array('building_building_add', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="building-inline-22">Add Building</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="building-inline-33" type="checkbox" name="title[]" value="building_building_edit" <?=(in_array('building_building_edit', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="building-inline-33">Edit Building</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="building-inline-44" type="checkbox" name="title[]" value="building_building_delete" <?=(in_array('building_building_delete', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="building-inline-44">Remove Building</label>
									</div>
								</div>
	                      	</div><!-- /col -->
	                      	<hr>
	                      	<div class="col">
								<div class="m-t-15 m-checkbox-inline">
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="building-inline-1" type="checkbox" name="title[]" value="building_floor_view" <?=(in_array('building_floor_view', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="building-inline-1">View Floor</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="building-inline-2" type="checkbox" name="title[]" value="building_floor_add" <?=(in_array('building_floor_add', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="building-inline-2">Create Floor</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="building-inline-3" type="checkbox" name="title[]" value="building_floor_edit" <?=(in_array('building_floor_edit', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="building-inline-3">Edit Floor</label>
									</div>
								</div>
	                      	</div><!-- /col -->

	                      	<div class="col">
								<div class="m-t-15 m-checkbox-inline">
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="building-inline-4" type="checkbox" name="title[]" value="building_room_view" <?=(in_array('building_room_view', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="building-inline-4">View Room</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="building-inline-5" type="checkbox" name="title[]" value="building_room_add" <?=(in_array('building_room_add', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="building-inline-5">Create Room</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="building-inline-6" type="checkbox" name="title[]" value="building_room_edit" <?=(in_array('building_room_edit', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="building-inline-6">Edit Room</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="room-facilities-inline-1" type="checkbox" name="title[]" value="building_room_facilities_view" <?=(in_array('building_room_facilities_view', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="room-facilities-inline-1">View Room Facilities</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="room-facilities-inline-3" type="checkbox" name="title[]" value="building_room_facilities_update" <?=(in_array('building_room_facilities_update', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="room-facilities-inline-3">Update Room Facilities</label>
									</div>
								</div>
	                      	</div><!-- /col -->

						</div>
					</div><!-- /card -->
				</div><!-- /9 -->

				<div class="col-sm-12 col-xl-3">
					<div class="card">
						<div class="card-body">

							<div class="col-sm-12">
                        		<h5>
                        			<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                        					<input class="form-check-input" id="facilities-inline-0" type="checkbox" name="title[]" value="building_facilities" <?=(in_array('building_facilities', $permissionsArr)) ? 'checked' : ''?> >
										<label class="form-check-label" for="facilities-inline-0"><strong>Building Facilities</strong></label>
									</div>
                        		</h5>
                      		</div>
	                      	<div class="col">
								<div class="m-t-15 m-checkbox-inline">
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="facilities-inline-1" type="checkbox" name="title[]" value="building_facilities_view" <?=(in_array('building_facilities_view', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="facilities-inline-1">View Facilities</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="facilities-inline-2" type="checkbox" name="title[]" value="building_facilities_add" <?=(in_array('building_facilities_add', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="facilities-inline-2">Add Facilities</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="facilities-inline-3" type="checkbox" name="title[]" value="building_facilities_edit" <?=(in_array('building_facilities_edit', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="facilities-inline-3">Edit Facilities</label>
									</div>
								</div>
	                      	</div><!-- /col -->

						</div>
					</div><!-- /card -->
				</div><!-- /3 -->

			</div><!-- /row -->


			<div class="row">

				<div class="col-sm-12 col-xl-4">
					<div class="card">
						<div class="card-body">

							<div class="col-sm-12">
                        		<h5>
                        			<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                    					<input class="form-check-input" id="room-allocation-inline-00" type="checkbox" name="room_allocation" value="1" <?=($room_allocation == 1) ? 'checked' : ''?> >
										<label class="form-check-label" for="room-allocation-inline-00"><strong>Room Allocation</strong></label>
									</div>
                        		</h5>
                        		<p class="alert alert-warning">
                        			<strong>Note:</strong> If an authorized person checks this as true, another authorized person can then assign a room to this role. This is typically used for the role of a <strong>Doctor</strong>.
                        		</p>
                      		</div>

						</div>
					</div><!-- /card -->
				</div><!-- /4 -->

				<div class="col-sm-12 col-xl-4">
					<div class="card">
						<div class="card-body">

							<div class="col-sm-12">
                        		<h5>
                        			<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                    					<input class="form-check-input" id="assign-room-inline-0" type="checkbox" name="title[]" value="assign_room" <?=(in_array('assign_room', $permissionsArr)) ? 'checked' : ''?> >
										<label class="form-check-label" for="assign-room-inline-0"><strong>Assign Room</strong></label>
									</div>
                        		</h5>
                      		</div>
	                      	<div class="col">
								<div class="m-t-15 m-checkbox-inline">
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="assign-room-inline-1" type="checkbox" name="title[]" value="assign_room_view" <?=(in_array('assign_room_view', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="assign-room-inline-1">View</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="assign-room-inline-2" type="checkbox" name="title[]" value="assign_room_assign" <?=(in_array('assign_room_assign', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="assign-room-inline-2">Assign</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="assign-room-inline-3" type="checkbox" name="title[]" value="assign_room_change" <?=(in_array('assign_room_change', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="assign-room-inline-3">Change</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="assign-room-inline-4" type="checkbox" name="title[]" value="assign_room_remove" <?=(in_array('assign_room_remove', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="assign-room-inline-4">Remove</label>
									</div>
									
								</div>
	                      	</div><!-- /col -->

						</div>
					</div><!-- /card -->
				</div><!-- /4 -->

				<div class="col-sm-12 col-xl-4">
					<div class="card">
						<div class="card-body">

							<div class="col-sm-12">
                        		<h5>
                        			<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                    					<input class="form-check-input" id="room-time-table-inline-0" type="checkbox" name="title[]" value="room_time_table" <?=(in_array('room_time_table', $permissionsArr)) ? 'checked' : ''?> >
										<label class="form-check-label" for="room-time-table-inline-0"><strong>Room Time Table</strong></label>
									</div>
                        		</h5>
                      		</div>
	                      	<div class="col">
								<div class="m-t-15 m-checkbox-inline">
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="room-time-table-inline-1" type="checkbox" name="title[]" value="room_time_table_view" <?=(in_array('room_time_table_view', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="room-time-table-inline-1">View</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="room-time-table-inline-2" type="checkbox" name="title[]" value="room_time_table_add" <?=(in_array('room_time_table_add', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="room-time-table-inline-2">Add</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="room-time-table-inline-4" type="checkbox" name="title[]" value="room_time_table_remove" <?=(in_array('room_time_table_remove', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="room-time-table-inline-4">Remove</label>
									</div>
									
								</div>
	                      	</div><!-- /col -->

						</div>
					</div><!-- /card -->
				</div><!-- /4 -->

			</div><!-- /row -->


			<div class="row">

				<div class="col-sm-12 col-xl-4">
					<div class="card">
						<div class="card-body">

							<div class="col-sm-12">
                        		<h5>
                        			<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                    					<input class="form-check-input" id="patient-inline-0" type="checkbox" name="title[]" value="patient" <?=(in_array('patient', $permissionsArr)) ? 'checked' : ''?> >
										<label class="form-check-label" for="patient-inline-0"><strong>Patient</strong></label>
									</div>
                        		</h5>
                      		</div>
	                      	<div class="col">
								<div class="m-t-15 m-checkbox-inline">
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="patient-inline-1" type="checkbox" name="title[]" value="patient_view" <?=(in_array('patient_view', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="patient-inline-1">View</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="patient-inline-2" type="checkbox" name="title[]" value="patient_add" <?=(in_array('patient_add', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="patient-inline-2">Add</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="patient-inline-3" type="checkbox" name="title[]" value="patient_edit" <?=(in_array('patient_edit', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="patient-inline-3">Edit</label>
									</div>
								</div>
	                      	</div><!-- /col -->

						</div>
					</div><!-- /card -->
				</div><!-- /4 -->

				<div class="col-sm-12 col-xl-8">
					<div class="card">
						<div class="card-body">

							<div class="col-sm-12">
                        		<h5>
                        			<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
                    					<input class="form-check-input" id="opd-inline-0" type="checkbox" name="title[]" value="opd" <?=(in_array('opd', $permissionsArr)) ? 'checked' : ''?> >
										<label class="form-check-label" for="opd-inline-0"><strong>OPD</strong></label>
									</div>
                        		</h5>
                      		</div>
	                      	<div class="col">
								<div class="m-t-15 m-checkbox-inline">
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="opd-inline-1" type="checkbox" name="title[]" value="create_token" <?=(in_array('create_token', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="opd-inline-1">Create Token</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="opd-inline-2" type="checkbox" name="title[]" value="change_token_status" <?=(in_array('change_token_status', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="opd-inline-2">Change Token Status</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="opd-inline-3" type="checkbox" name="title[]" value="view_all_tokens" <?=(in_array('view_all_tokens', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="opd-inline-3">View All Tokens</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="opd-inline-4" type="checkbox" name="title[]" value="view_own_tokens" <?=(in_array('view_own_tokens', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="opd-inline-4">View Own Tokens</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="opd-inline-4" type="checkbox" name="title[]" value="view_own_tokens" <?=(in_array('view_own_tokens', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="opd-inline-4">View Own Tokens</label>
									</div>
									<div class="form-check form-check-inline checkbox checkbox-dark mb-0">
										<input class="form-check-input" id="opd-inline-5" type="checkbox" name="title[]" value="add_prescription_token" <?=(in_array('add_prescription_token', $permissionsArr)) ? 'checked' : ''?>>
										<label class="form-check-label" for="opd-inline-5">Add Prescription Token</label>
									</div>
								</div>
	                      	</div><!-- /col -->

						</div>
					</div><!-- /card -->
				</div><!-- /4 -->


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
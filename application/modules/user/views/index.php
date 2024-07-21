<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>Users 
					<?php if ($permissions == 'all' || in_array('user_add', $permissions)): ?>
						<a href="<?=BASEURL.'user/create'?>" class="btn btn-success" style="float: right;">Create User</a>
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
										<th>Role</th>
										<th>Name</th>
										<?php if ($permissions == 'all' || in_array('assign_room', $permissions)): ?>
											<th>Room</th>
										<?php endif ?>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php if ($users): ?>
										<?php foreach ($users as $qKey => $q): ?>
											<tr>
												<td><?=($qKey+1)?></td>
												<td><?=$q['roleTitle']?></td>
												<td><?=$q['fname'].' '.$q['lname']?></td>
												<?php if ($permissions == 'all' || in_array('assign_room', $permissions)): ?>
													<td>
														<?php if (($permissions == 'all' || in_array('user_edit', $permissions)) && ($q['room_allocation'] == 1)): ?>
															<ul class="action">
																<li class="edit"><a href="<?=BASEURL.'user/room/'.$q['user_id']?>" target="_blank"><i class="icon-eye"></i></a></li>
												        	</ul>
									            		<?php endif ?>
													</td>
												<?php endif ?>
												<td>
													<ul class="action">
														<?php if ($permissions == 'all' || in_array('user_edit', $permissions)): ?>
															<li class="edit"> <a href="<?=BASEURL.'user/edit?id='.$q['user_id']?>"><i class="icon-pencil-alt"></i></a></li>
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
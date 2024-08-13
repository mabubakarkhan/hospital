<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>Patients 
					<?php if ($permissions == 'all' || in_array('patient_add', $permissions)): ?>
						<a href="javascript://" class="btn btn-success addPatientBtn" style="float: right;">Add Patient</a>
	              	<?php endif ?>
				</h3>
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
										<th>Name</th>
										<th>Mobile</th>
										<th>Gender</th>
										<th>ID Card</th>
										<th>Address</th>
										<?php if ($permissions == 'all' || in_array('patient_edit', $permissions)): ?>
											<th>Edit</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>

									<?php if ($patients): ?>
										<?php foreach ($patients as $qKey => $q): ?>
											<tr>
												<td><?=($qKey+1)?></td>
												<td><?=$q['fname'].' '.$q['lname']?></td>
												<td><?=$q['mobile']?></td>
												<td><?=$q['gender']?></td>
												<td><?=$q['id_card']?></td>
												<td><?=$q['address']?></td>
												<td>
													<ul class="action">
														<?php if ($permissions == 'all' || in_array('patient_edit', $permissions)): ?>
															<li class="edit"> <a href="javascript://" class="editPatientBtn" data-id="<?=$q['patient_id']?>" data-fname="<?=$q['fname']?>" data-lname="<?=$q['lname']?>" data-mobile="<?=$q['mobile']?>" data-address="<?=$q['address']?>" data-id-card="<?=$q['id_card']?>" data-gender="<?=$q['gender']?>" data-age="<?=$q['age']?>"><i class="icon-pencil-alt"></i></a></li>
										              	<?php endif ?>
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
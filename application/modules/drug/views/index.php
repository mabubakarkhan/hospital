<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>Drugs 
					<?php if ($permissions == 'all' || in_array('drug_add', $permissions)): ?>
						<a href="javascript://" class="btn btn-success createDrugBtn" style="float: right;">Add New</a>
	              	<?php endif ?>
				</h3>
				<br>
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
										<th>Generic Name</th>
										<th>Type</th>
										<th>Strength</th>
										<th>Status</th>
										<?php if ($permissions == 'all' || in_array('drug_edit', $permissions)): ?>
											<th>Edit</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>

									<?php if ($drugs): ?>
										<?php foreach ($drugs as $qKey => $q): ?>
											<tr>
												<td><?=($qKey+1)?></td>
												<td><?=$q['name']?></td>
												<td><?=$q['generic_name']?></td>
												<td><?=$q['type']?></td>
												<td><?=$q['strength'].' '.$q['strength_frequencey']?></td>
												<td><?=$q['status']?></td>
												<td>
													<ul class="action">
														<?php if ($permissions == 'all' || in_array('drug_edit', $permissions)): ?>
															<li class="edit"> <a href="javascript://" class="editDrugBtn" data-id="<?=$q['drug_id']?>" data-name="<?=$q['name']?>" data-generic_name="<?=$q['generic_name']?>" data-type="<?=$q['type']?>" data-strength="<?=$q['strength']?>" data-strength_frequencey="<?=$q['strength_frequencey']?>" data-status="<?=$q['status']?>"><i class="icon-pencil-alt"></i></a></li>
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
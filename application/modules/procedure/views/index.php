<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>Procedures 
					<?php if ($permissions == 'all' || in_array('procedure_add', $permissions)): ?>
						<a href="javascript://" class="btn btn-success createProcedureBtn" style="float: right;">Add New</a>
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
										<th>Status</th>
										<?php if ($permissions == 'all' || in_array('procedure_edit', $permissions)): ?>
											<th>Edit</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>

									<?php if ($procedures): ?>
										<?php foreach ($procedures as $qKey => $q): ?>
											<tr>
												<td><?=($qKey+1)?></td>
												<td><?=$q['name']?></td>
												<td><?=$q['status']?></td>
												<td>
													<ul class="action">
														<?php if ($permissions == 'all' || in_array('procedure_edit', $permissions)): ?>
															<li class="edit"> <a href="javascript://" class="editProcedureBtn" data-id="<?=$q['procedure_id']?>" data-name="<?=$q['name']?>" data-status="<?=$q['status']?>"><i class="icon-pencil-alt"></i></a></li>
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
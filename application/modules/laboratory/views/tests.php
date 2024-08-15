<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>Procedures 
					<?php if ($permissions == 'all' || in_array('lab_test_add', $permissions)): ?>
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
										<th>Title</th>
										<th>Category</th>
										<th>Min</th>
										<th>Max</th>
										<th>Status</th>
										<?php if ($permissions == 'all' || in_array('lab_test_edit', $permissions)): ?>
											<th>Edit</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>

									<?php if ($tests): ?>
										<?php foreach ($tests as $qKey => $q): ?>
											<tr>
												<td><?=$q['title']?></td>
												<td><?=$q['catTitle']?></td>
												<td><?=$q['min_value']?></td>
												<td><?=$q['max_value']?></td>
												<td><?=$q['status']?></td>
												<td>
													<ul class="action">
														<?php if ($permissions == 'all' || in_array('lab_test_edit', $permissions)): ?>
															<li class="edit"> <a href="javascript://" class="editProcedureBtn" data-id="<?=$q['lab_test_id']?>" data-lab_test_cat_id="<?=$q['lab_test_cat_id']?>" data-title="<?=$q['title']?>" data-status="<?=$q['status']?>" data-min_value="<?=$q['min_value']?>" data-max_value="<?=$q['max_value']?>"><i class="icon-pencil-alt"></i></a></li>
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
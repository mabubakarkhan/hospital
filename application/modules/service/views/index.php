<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>services 
					<?php if ($permissions == 'all' || in_array('service_add', $permissions)): ?>
						<a href="javascript://" class="btn btn-success addserviceBtn" style="float: right;">Add Service</a>
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
										<th>Status</th>
										<?php if ($permissions == 'all' || in_array('service_edit', $permissions)): ?>
											<th>Edit</th>
										<?php endif ?>
									</tr>
								</thead>
								<tbody>

									<?php if ($services): ?>
										<?php foreach ($services as $qKey => $q): ?>
											<tr>
												<td><?=($qKey+1)?></td>
												<td><?=$q['name']?></td>
												<td><?=$q['status']?></td>
												<td>
													<ul class="action">
														<?php if ($permissions == 'all' || in_array('service_edit', $permissions)): ?>
															<li class="edit"> <a href="javascript://" class="editserviceBtn" data-id="<?=$q['service_id']?>" data-name="<?=$q['name']?>" data-status="<?=$q['status']?>"><i class="icon-pencil-alt"></i></a></li>
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
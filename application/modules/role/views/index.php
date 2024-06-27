<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3>Roles <a href="<?=BASEURL.'role/create'?>" class="btn btn-success" style="float: right;">Create Role</a></h3>.

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
										<th>Permissions</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php if ($roles): ?>
										<?php foreach ($roles as $qKey => $q): ?>
											<tr>
												<td><?=($qKey+1)?></td>
												<td><?=$q['title']?></td>
												<td>
													<ul class="action"> 
														<li class="primary"> <a href="<?=BASEURL.'role/permissions?id='.$q['role_id']?>"><i class="fa fa-lock"></i></a></li>
													</ul>
												</td>
												<td>
													<ul class="action"> 
														<li class="edit"> <a href="<?=BASEURL.'role/edit?id='.$q['role_id']?>"><i class="icon-pencil-alt"></i></a></li>
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
<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3><?=$patient['fname'].' '.$patient['fname']?> - history</h3>
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
										<th>Service</th>
										<th>Dr</th>
										<th>Type</th>
										<th>Status</th>
										<th>At</th>
										<th>View</th>
									</tr>
								</thead>
								<tbody>

									<?php if ($history): ?>
										<?php foreach ($history as $qKey => $q): ?>
											<tr>
												<td><?=($qKey+1)?></td>
												<td><?=$q['service']?></td>
												<td><?=$q['fname'].' '.$q['lname']?></td>
												<td><?=$q['type']?></td>
												<td><?=$q['status']?></td>
												<td><?=date('d F, Y',strtotime($q['at']))?></td>
												<td><a href="<?=BASEURL.'prescription/new/?id='.$q['token_id']?>" target="_blank"><i class="fa fa-eye"></i></a></td>
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
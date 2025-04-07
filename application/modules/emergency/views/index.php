<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 mt-3">
				<h3>Emergency 
					<?php if ($permissions == 'all' || in_array('emergency_desk', $permissions)): ?>
						<a href="javascript://" class="btn btn-success admitBtn" style="float: right;">Admit</a>
	              	<?php endif ?>
				</h3>
			</div><!-- /12 -->
			<div class="col-md-2 mb-3">
				<input type="text" id="flatpicker" class="form-control" value="<?=date('d-m-Y')?>">
			</div><!-- /2 -->
		</div>
    </div>

    <div class="container-fluid">
        <div class="row">
        	
			<div class="col-sm-12">
				<div class="card">
					<div class="card-body" id="patientsWrap">

						<?=$patients?>

					</div><!-- #card-body -->
				</div><!-- /card -->
			</div><!-- /12 -->

        </div><!-- row -->
    </div><!-- /container-fluid -->

</div><!-- /dashboard-default -->
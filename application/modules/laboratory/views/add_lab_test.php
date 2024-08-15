<div class="container-fluid dashboard-default">
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h3><?=$page_title?></h3>
			</div>
		</div>
    </div>

    <!-- Container-fluid starts-->
  	<div class="container-fluid form-validate">
		<div class="row">

			<div class="col-sm-12 col-xl-12">
				<div class="card">
					<div class="card-body">
						<form autocomplete="off" enctype="multipart/form-data" method="post" action="
			          	<?php
				  		if($mode != 'edit')echo BASEURL."building/post-building";
					  	else echo BASEURL."building/update-building/";
				  		?>">

							<div class="row">

								<?php if ($this->session->flashdata('success')): ?>
									<p class="alert alert-success"><?=$this->session->flashdata('success')?></p>
								<?php endif ?>
								<?php if ($this->session->flashdata('error')): ?>
									<p class="alert alert-danger"><?=$this->session->flashdata('error')?></p>
								<?php endif ?>
								
								<div class="show-msg"></div>
								<br>

								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label">Name</label>
										<input class="form-control" name="name" type="text" value="<?=$q['name']?>" required="">
									</div>
								</div><!-- /12 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">City</label>
										<input class="form-control" name="city" type="text" value="<?=$q['city']?>" required="">
									</div>
								</div><!-- /6 -->
								<div class="col-md-6">
									<div class="mb-3">
										<label class="form-label">Address</label>
										<input class="form-control" name="address" type="text" value="<?=$q['address']?>" required="">
									</div>
								</div><!-- /6 -->
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label">Image</label>
										<?php if ($mode == 'edit'): ?>
											<input class="form-control" type="file" data-bs-original-title="" name="img">
											<br><a href="<?=UPLOADS.'building/'.$q['img']?>" target="_blank"><img src="<?=UPLOADS.'building/'.$q['img']?>" width="150"></a>
										<?php else: ?>
											<input class="form-control" type="file" data-bs-original-title="" name="img">
										<?php endif ?>
									</div>
								</div><!-- /12 -->
								
							</div><!-- /row -->
							<div class="card-footer text-end">
								<?php if ($mode == 'edit'): ?>
									<input type="hidden" name="id" value="<?=$editID?>">
									<button type="submit" class="btn btn-primary">Update</button>
								<?php else: ?>
									<button type="submit" class="btn btn-primary">Submit</button>
								<?php endif ?>
								<a href="<?=BASEURL.'building'?>" class="btn btn-secondary">Cancel</a>
							</div>
							<div class="card-footer-loader" style="display: none;">
								<div class="loader-box"><div class="loader-2"></div></div>
							</div>

						</form>
					</div>
				</div><!-- /card -->
			</div><!-- /6 -->
		</div><!-- /row -->
	</div>
	<!-- Container-fluid Ends-->

</div><!-- /dashboard-default -->
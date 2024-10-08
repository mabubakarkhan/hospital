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

			<div class="col-sm-12 col-xl-6">
				<div class="card">
					<div class="card-body">
						<form autocomplete="off" enctype="multipart/form-data" method="post" action="
			          	<?php
				  		if($mode != 'edit')echo BASEURL."building/post-room";
					  	else echo BASEURL."building/update-room/";
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
										<label class="form-label">Floor</label>
										<select name="floor_id" class="form-select" required>
											<option value="">Select</option>
											<?php foreach ($floors as $keyFloor => $floor): ?>
												<option value="<?=$floor['floor_id']?>" <?=($floor['floor_id'] == $q['floor_id'] || $floorId == $floor['floor_id']) ? 'selected' : ''?> ><?=$floor['title'].' ('.$floor['story'].')'?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div><!-- /6 -->
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label">Title</label>
										<input class="form-control" name="title" type="text" value="<?=$q['title']?>" required="">
									</div>
								</div><!-- /6 -->
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label">Room Number</label>
										<input class="form-control" name="room_number" type="text" value="<?=$q['room_number']?>" required="">
									</div>
								</div><!-- /6 -->
								<div class="col-md-12">
									<div class="mb-3">
										<label class="form-label">Capacity</label>
										<input class="form-control" name="capacity" type="text" value="<?=$q['capacity']?>" required="">
									</div>
								</div><!-- /6 -->
								
							</div><!-- /row -->
							<div class="card-footer text-end">
								<?php if ($mode == 'edit'): ?>
									<input type="hidden" name="id" value="<?=$editID?>">
									<button type="submit" class="btn btn-primary">Update</button>
								<?php else: ?>
									<button type="submit" class="btn btn-primary">Submit</button>
								<?php endif ?>
								<a href="<?=BASEURL.'building/'?>" class="btn btn-secondary">Cancel</a>
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
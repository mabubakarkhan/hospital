<?php
$checkUserPermissions = unserialize($_SESSION['user']);
if ($checkUserPermissions['permissions'] == 'all' || in_array('lab_test_add', $checkUserPermissions['permissions'])) {
?>
	<script>
	$(function(){
		//ADD
		$(document).on('click', '.createProcedureBtn', function(event) {
			event.preventDefault();
			$("#add-service-modal").modal('show');
		});
		$(document).on('submit', '#add-service-modal form', function(event) {
			event.preventDefault();
			$form = $(this);
			$("#add-service-modal .submitBtn").text('Wait...');
			$.post('<?=BASEURL."laboratory/add-test"?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				$("#add-service-modal .submitBtn").text('Add');
				alert(resp.msg)
				if (resp.status == true) {
					$("#add-service-modal").modal('hide');
					location.reload();
				}
			});
		});

	});//onload
	</script>


	<div class="modal fade bd-example-modal-lg" id="add-service-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myLargeModalLabel">Add Lab Test</h4>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div><!-- /modal-header -->
				<div class="modal-body">

					<form>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Category *</label>
									<select name="lab_test_cat_id" class="form-control" required>
										<option value="">Select Category</option>
										<?php foreach ($cats as $key => $catQ): ?>
											<option value="<?=$catQ['lab_test_cat_id']?>" <?=($catQ['lab_test_cat_id'] == $cat['lab_test_cat_id']) ? 'selected="selected"' : ''?> ><?=$catQ['title']?></option>
										<?php endforeach ?>
									</select>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Title *</label>
									<input class="form-control" name="title" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Min Value*</label>
									<input class="form-control" name="min_value" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Max Value*</label>
									<input class="form-control" name="max_value" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Status *</label>
									<select name="status" class="form-control" required>
										<option value="active" selected>Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-6">
								<div class="form-group">
									<button type="submit" class="btn btn-primary submitBtn">Add</button>
								</div><!-- /form-group -->
							</div><!-- /6 -->
						</div><!-- /row -->
					</form>

				</div><!-- /modal-body -->
			</div><!-- /modal-content -->
		</div><!-- /modal-lg -->
	</div><!-- #add-service-modal -->

<?php
}//check permission
?>


<?php
if ($checkUserPermissions['permissions'] == 'all' || in_array('lab_test_edit', $checkUserPermissions['permissions'])) {
?>
	<script>
	$(function(){

		//EDIT
		$(document).on('click', '.editProcedureBtn', function(event) {
			event.preventDefault();
			$this = $(this);
			$("#edit-service-modal form input[name='id']").val($this.attr('data-id'));
			$("#edit-service-modal form input[name='title']").val($this.attr('data-title'));
			$("#edit-service-modal form input[name='min_value']").val($this.attr('data-min_value'));
			$("#edit-service-modal form input[name='max_value']").val($this.attr('data-max_value'));
			$('#edit-service-modal form select[name="lab_test_cat_id"] option').each(function() {
			    if ($(this).val() == $this.attr('data-lab_test_cat_id')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$("#edit-service-modal").modal('show');
		});
		$(document).on('submit', '#edit-service-modal form', function(event) {
			event.preventDefault();
			$form = $(this);
			$("#edit-service-modal .submitBtn").text('Wait...');
			$.post('<?=BASEURL."laboratory/update-test"?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				$("#edit-service-modal .submitBtn").text('Update');
				alert(resp.msg)
				if (resp.status == true) {
					$("#edit-service-modal").modal('hide');
					location.reload();
				}
			});
		});


	});//onload
	</script>

	<div class="modal fade bd-example-modal-lg" id="edit-service-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myLargeModalLabel">Edit Lab Test</h4>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div><!-- /modal-header -->
				<div class="modal-body">

					<form>
						<input type="hidden" name="id">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Category *</label>
									<select name="lab_test_cat_id" class="form-control" required>
										<option value="">Select Category</option>
										<?php foreach ($cats as $key => $catQ): ?>
											<option value="<?=$catQ['lab_test_cat_id']?>"><?=$catQ['title']?></option>
										<?php endforeach ?>
									</select>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Title *</label>
									<input class="form-control" name="title" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Min Value*</label>
									<input class="form-control" name="min_value" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Max Value*</label>
									<input class="form-control" name="max_value" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Status *</label>
									<select name="status" class="form-control" required>
										<option value="active">Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /12 -->
							<div class="col-md-6">
								<div class="form-group">
									<button type="submit" class="btn btn-primary submitBtn">Update</button>
								</div><!-- /form-group -->
							</div><!-- /6 -->
						</div><!-- /row -->
					</form>

				</div><!-- /modal-body -->
			</div><!-- /modal-content -->
		</div><!-- /modal-lg -->
	</div><!-- #edit-service-modal -->
<?php
}//check permission
?>
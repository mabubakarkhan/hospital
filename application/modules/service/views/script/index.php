<script>
$(function(){
	//ADD
	$(document).on('click', '.addserviceBtn', function(event) {
		event.preventDefault();
		$("#add-service-modal").modal('show');
	});
	$(document).on('submit', '#add-service-modal form', function(event) {
		event.preventDefault();
		$form = $(this);
		$("#add-service-modal .submitBtn").text('Wait...');
		$.post('<?=BASEURL."service/add"?>', {data: $form.serialize()}, function(resp) {
			resp = $.parseJSON(resp);
			$("#add-service-modal .submitBtn").text('Add');
			alert(resp.msg)
			if (resp.status == true) {
				$("#add-service-modal").modal('hide');
				location.reload();
			}
		});
	});
	//EDIT
	$(document).on('click', '.editserviceBtn', function(event) {
		event.preventDefault();
		$this = $(this);
		$("#edit-service-modal form input[name='id']").val($this.attr('data-id'));
		$("#edit-service-modal form input[name='name']").val($this.attr('data-name'));
		$('#edit-service-modal form select[name="status"] option').each(function() {
		    if ($(this).val() == $this.attr('data-status')) {
		    	$(this).attr('selected','selected');
		    }
		});
		$('#edit-service-modal form select[name="department_id"] option').each(function() {
		    if ($(this).val() == $this.attr('data-department_id')) {
		    	$(this).attr('selected','selected');
		    }
		});
		$("#edit-service-modal").modal('show');
	});
	$(document).on('submit', '#edit-service-modal form', function(event) {
		event.preventDefault();
		$form = $(this);
		$("#edit-service-modal .submitBtn").text('Wait...');
		$.post('<?=BASEURL."service/update"?>', {data: $form.serialize()}, function(resp) {
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


<div class="modal fade bd-example-modal-lg" id="add-service-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Add service</h4>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div><!-- /modal-header -->
			<div class="modal-body">

				<form>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Name *</label>
								<input class="form-control" name="name" type="text" required="">
							</div><!-- /form-group -->
						</div><!-- /12 -->
						<div class="col-md-12">
							<div class="form-group">
								<label>Department *</label>
								<select name="department_id" class="form-control" required>
									<option value="">Select</option>
									<?php foreach ($departments as $keyDepartment => $department): ?>
										<option value="<?=$department['department_id']?>"><?=$department['name'].' ('.$department['status'].')'?></option>
									<?php endforeach ?>
								</select>
							</div><!-- /form-group -->
						</div><!-- /12 -->
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

<div class="modal fade bd-example-modal-lg" id="edit-service-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Edit service</h4>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div><!-- /modal-header -->
			<div class="modal-body">

				<form>
					<input type="hidden" name="id">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Name *</label>
								<input class="form-control" name="name" type="text" required="">
							</div><!-- /form-group -->
						</div><!-- /12 -->
						<div class="col-md-12">
							<div class="form-group">
								<label>Department *</label>
								<select name="department_id" class="form-control" required>
									<option value="">Select</option>
									<?php foreach ($departments as $keyDepartment => $department): ?>
										<option value="<?=$department['department_id']?>"><?=$department['name'].' ('.$department['status'].')'?></option>
									<?php endforeach ?>
								</select>
							</div><!-- /form-group -->
						</div><!-- /12 -->
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
<script>
$(function(){
	//ADD
	$(document).on('click', '.addDepartmentBtn', function(event) {
		event.preventDefault();
		$("#add-department-modal").modal('show');
	});
	$(document).on('submit', '#add-department-modal form', function(event) {
		event.preventDefault();
		$form = $(this);
		$("#add-department-modal .submitBtn").text('Wait...');
		$.post('<?=BASEURL."department/add"?>', {data: $form.serialize()}, function(resp) {
			resp = $.parseJSON(resp);
			$("#add-department-modal .submitBtn").text('Add');
			alert(resp.msg)
			if (resp.status == true) {
				$("#add-department-modal").modal('hide');
				location.reload();
			}
		});
	});
	//EDIT
	$(document).on('click', '.editDepartmentBtn', function(event) {
		event.preventDefault();
		$this = $(this);
		$("#edit-department-modal form input[name='id']").val($this.attr('data-id'));
		$("#edit-department-modal form input[name='name']").val($this.attr('data-name'));
		$('#edit-department-modal form select[name="status"] option').each(function() {
		    if ($(this).val() == $this.attr('data-status')) {
		    	$(this).attr('selected','selected');
		    }
		});
		$("#edit-department-modal").modal('show');
	});
	$(document).on('submit', '#edit-department-modal form', function(event) {
		event.preventDefault();
		$form = $(this);
		$("#edit-department-modal .submitBtn").text('Wait...');
		$.post('<?=BASEURL."department/update"?>', {data: $form.serialize()}, function(resp) {
			resp = $.parseJSON(resp);
			$("#edit-department-modal .submitBtn").text('Update');
			alert(resp.msg)
			if (resp.status == true) {
				$("#edit-department-modal").modal('hide');
				location.reload();
			}
		});
	});


});//onload
</script>


<div class="modal fade bd-example-modal-lg" id="add-department-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Add Department</h4>
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
</div><!-- #add-department-modal -->

<div class="modal fade bd-example-modal-lg" id="edit-department-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Edit Department</h4>
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
</div><!-- #edit-department-modal -->
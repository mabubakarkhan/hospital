<?php
$checkUserPermissions = unserialize($_SESSION['user']);
if ($checkUserPermissions['permissions'] == 'all' || in_array('drug_add', $checkUserPermissions['permissions'])) {
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
			$.post('<?=BASEURL."drug/add"?>', {data: $form.serialize()}, function(resp) {
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
					<h4 class="modal-title" id="myLargeModalLabel">Add Drug</h4>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div><!-- /modal-header -->
				<div class="modal-body">

					<form>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name *</label>
									<input class="form-control" name="name" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Generic Name</label>
									<input class="form-control" name="generic_name" type="text">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Strength</label>
									<input class="form-control" name="strength" type="text">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Strength Frequencey</label>
									<select name="strength_frequencey" class="form-control">
										<option value="">Select Frequencey</option>
										<option value="mg">mg</option>
										<option value="ml">ml</option>
										<option value="g">g</option>
										<option value="%">%</option>
										<option value="IU">IU</option>
										<option value="mcg">mcg</option>
										<option value="meg">meg</option>
										<option value="mmol">mmol</option>
										<option value="unit">unit</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Type</label>
									<select name="type" class="form-control">
										<option value="">Select Drug Type</option>
										<option value="tab">TAB</option>
										<option value="cap">CAP</option>
										<option value="syp">SYP</option>
										<option value="pwd">PWD</option>
										<option value="mouthwash">M/W</option>
										<option value="cream">CREAM</option>
										<option value="Eye Drops">Eye Drops</option>
										<option value="Lotion">Lotion</option>
										<option value="Ointment">Ointment</option>
										<option value="Gel">Gel</option>
										<option value="Vaccination">Vaccination</option>
										<option value="Toothpaste">Toothpaste</option>
										<option value="inj">INJ</option>
										<option value="Oral Spray">Oral Spray</option>
										<option value="Oil">Oil</option>
										<option value="Body Wash">Body Wash</option>
										<option value="Face Wash">Face Wash</option>
										<option value="Shampoo">Shampoo</option>
										<option value="Sunblock">Sunblock</option>
										<option value="Soap">Soap</option>
										<option value="Botox">Botox</option>
										<option value="Fillers">Fillers</option>
										<option value="Serum">Serum</option>
										<option value="Spray">Spray</option>
										<option value="Solution">Solution</option>
										<option value="Insulin">Insulin</option>
										<option value="Sachet">Sachet</option>
										<option value="Nasal Spray">Nasal Spray</option>
										<option value="Ear Drops">Ear Drops</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Status *</label>
									<select name="status" class="form-control" required>
										<option value="active" selected>Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" class="btn btn-primary submitBtn">Add</button>
								</div><!-- /form-group -->
							</div><!-- /12 -->
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
if ($checkUserPermissions['permissions'] == 'all' || in_array('drug_edit', $checkUserPermissions['permissions'])) {
?>
	<script>
	$(function(){

		//EDIT
		$(document).on('click', '.editProcedureBtn', function(event) {
			event.preventDefault();
			$this = $(this);
			$("#edit-service-modal form input[name='id']").val($this.attr('data-id'));
			$("#edit-service-modal form input[name='name']").val($this.attr('data-name'));
			$("#edit-service-modal form input[name='generic_name']").val($this.attr('data-generic_name'));
			$("#edit-service-modal form input[name='strength']").val($this.attr('data-strength'));
			$('#edit-service-modal form select[name="strength_frequencey"] option').each(function() {
			    if ($(this).val() == $this.attr('data-strength_frequencey')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$('#edit-service-modal form select[name="type"] option').each(function() {
			    if ($(this).val() == $this.attr('data-type')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$('#edit-service-modal form select[name="status"] option').each(function() {
			    if ($(this).val() == $this.attr('data-status')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$("#edit-service-modal").modal('show');
		});
		$(document).on('submit', '#edit-service-modal form', function(event) {
			event.preventDefault();
			$form = $(this);
			$("#edit-service-modal .submitBtn").text('Wait...');
			$.post('<?=BASEURL."drug/update"?>', {data: $form.serialize()}, function(resp) {
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
					<h4 class="modal-title" id="myLargeModalLabel">Edit Procedure</h4>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div><!-- /modal-header -->
				<div class="modal-body">

					<form>
						<input type="hidden" name="id">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>Name *</label>
									<input class="form-control" name="name" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Generic Name</label>
									<input class="form-control" name="generic_name" type="text">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Strength</label>
									<input class="form-control" name="strength" type="text">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Strength Frequencey</label>
									<select name="strength_frequencey" class="form-control">
										<option value="">Select Frequencey</option>
										<option value="mg">mg</option>
										<option value="ml">ml</option>
										<option value="g">g</option>
										<option value="%">%</option>
										<option value="IU">IU</option>
										<option value="mcg">mcg</option>
										<option value="meg">meg</option>
										<option value="mmol">mmol</option>
										<option value="unit">unit</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Type</label>
									<select name="type" class="form-control">
										<option value="">Select Drug Type</option>
										<option value="tab">TAB</option>
										<option value="cap">CAP</option>
										<option value="syp">SYP</option>
										<option value="pwd">PWD</option>
										<option value="mouthwash">M/W</option>
										<option value="cream">CREAM</option>
										<option value="Eye Drops">Eye Drops</option>
										<option value="Lotion">Lotion</option>
										<option value="Ointment">Ointment</option>
										<option value="Gel">Gel</option>
										<option value="Vaccination">Vaccination</option>
										<option value="Toothpaste">Toothpaste</option>
										<option value="inj">INJ</option>
										<option value="Oral Spray">Oral Spray</option>
										<option value="Oil">Oil</option>
										<option value="Body Wash">Body Wash</option>
										<option value="Face Wash">Face Wash</option>
										<option value="Shampoo">Shampoo</option>
										<option value="Sunblock">Sunblock</option>
										<option value="Soap">Soap</option>
										<option value="Botox">Botox</option>
										<option value="Fillers">Fillers</option>
										<option value="Serum">Serum</option>
										<option value="Spray">Spray</option>
										<option value="Solution">Solution</option>
										<option value="Insulin">Insulin</option>
										<option value="Sachet">Sachet</option>
										<option value="Nasal Spray">Nasal Spray</option>
										<option value="Ear Drops">Ear Drops</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Status *</label>
									<select name="status" class="form-control" required>
										<option value="active" selected>Active</option>
										<option value="inactive">Inactive</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-12">
								<div class="form-group">
									<button type="submit" class="btn btn-primary submitBtn">Update</button>
								</div><!-- /form-group -->
							</div><!-- /12 -->
						</div><!-- /row -->
					</form>

				</div><!-- /modal-body -->
			</div><!-- /modal-content -->
		</div><!-- /modal-lg -->
	</div><!-- #edit-service-modal -->
<?php
}//check permission
?>
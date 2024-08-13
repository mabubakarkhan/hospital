<?php
$checkUser = unserialize($_SESSION['user']);
$canAddPatient = false;
$canEditPatient = false;
if ($checkUser['permissions'] == 'all' || in_array('patient_add', $checkUser['permissions'])) {
	$canAddPatient = true;
}
if ($checkUser['permissions'] == 'all' || in_array('patient_edit', $checkUser['permissions'])) {
	$canEditPatient = true;
}
?>

<?php if ($canAddPatient): ?>
	<script>
	$(function(){
		//ADD
		$(document).on('click', '.addPatientBtn', function(event) {
			event.preventDefault();
			$("#add-patient-modal").modal('show');
		});
		$(document).on('submit', '#add-patient-modal form', function(event) {
			event.preventDefault();
			$form = $(this);
			$("#add-patient-modal .submitBtn").text('Wait...');
			$.post('<?=BASEURL."patient/add"?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				$("#add-patient-modal .submitBtn").text('Add');
				alert(resp.msg)
				if (resp.status == true) {
					$("#add-patient-modal").modal('hide');
				}
			});
		});
	});//onload
	</script>
	<style>
		#add-patient-modal{
			z-index: 2000;
		}
	</style>
	<div class="modal fade bd-example-modal-lg" id="add-patient-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myLargeModalLabel">Add Patient</h4>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div><!-- /modal-header -->
				<div class="modal-body">

					<form>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>First Name *</label>
									<input class="form-control" name="fname" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Last Name *</label>
									<input class="form-control" name="lname" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Gender *</label>
									<select name="gender" class="form-control" required>
										<option value="male" selected>Male</option>
										<option value="female">Female</option>
										<option value="other">Other</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Age *</label>
									<input class="form-control" name="age" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Mobile</label>
									<input class="form-control" name="mobile" type="text">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>ID Card</label>
									<input class="form-control" name="id_card" type="text">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Address</label>
									<input class="form-control" name="address" type="text">
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
	</div><!-- #add-patient-modal -->
<?php endif ?>
<?php if ($canEditPatient): ?>
	<script>
	$(function(){
	//EDIT
		$(document).on('click', '.editPatientBtn', function(event) {
			event.preventDefault();
			$this = $(this);
			$("#edit-patient-modal form input[name='id']").val($this.attr('data-id'));
			$("#edit-patient-modal form input[name='fname']").val($this.attr('data-fname'));
			$("#edit-patient-modal form input[name='lname']").val($this.attr('data-lname'));
			$("#edit-patient-modal form input[name='age']").val($this.attr('data-age'));
			$("#edit-patient-modal form input[name='mobile']").val($this.attr('data-mobile'));
			$("#edit-patient-modal form input[name='id_card']").val($this.attr('data-id-card'));
			$("#edit-patient-modal form input[name='address']").val($this.attr('data-address'));
			$('#edit-patient-modal form select[name="gender"] option').each(function() {
			    if ($(this).val() == $this.attr('data-gender')) {
			    	$(this).attr('selected','selected');
			    }
			});
			$("#edit-patient-modal").modal('show');
		});
		$(document).on('submit', '#edit-patient-modal form', function(event) {
			event.preventDefault();
			$form = $(this);
			$("#edit-patient-modal .submitBtn").text('Wait...');
			$.post('<?=BASEURL."patient/update"?>', {data: $form.serialize()}, function(resp) {
				resp = $.parseJSON(resp);
				$("#edit-patient-modal .submitBtn").text('Update');
				alert(resp.msg)
				if (resp.status == true) {
					$("#edit-patient-modal").modal('hide');
				}
			});
		});
	});//onload
	</script>
	<div class="modal fade bd-example-modal-lg" id="edit-patient-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="myLargeModalLabel">Edit Patient</h4>
					<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
				</div><!-- /modal-header -->
				<div class="modal-body">

					<form>
						<input type="hidden" name="id">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label>First Name *</label>
									<input class="form-control" name="fname" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Last Name *</label>
									<input class="form-control" name="lname" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Gender *</label>
									<select name="gender" class="form-control" required>
										<option value="male">Male</option>
										<option value="female">Female</option>
										<option value="other">Other</option>
									</select>
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Age *</label>
									<input class="form-control" name="age" type="text" required="">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>Mobile</label>
									<input class="form-control" name="mobile" type="text">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-6">
								<div class="form-group">
									<label>ID Card</label>
									<input class="form-control" name="id_card" type="text">
								</div><!-- /form-group -->
							</div><!-- /6 -->
							<div class="col-md-12">
								<div class="form-group">
									<label>Address</label>
									<input class="form-control" name="address" type="text">
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
	</div><!-- #edit-patient-modal -->
<?php endif ?>
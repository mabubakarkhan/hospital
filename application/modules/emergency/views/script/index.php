<script>
$(function(){
	$(document).on('click', '.admitBtn', function(event) {
		event.preventDefault();
		$("#admitModal").modal('show');
	});

	$(document).on('keyup', '#createTokenInputPatientSearch', function(event) {
		event.preventDefault();
		$this = $(this);
		$("#dropdownPatientSearchList").html('');
		$("#admitModal input[name='patient_id']").val('');
		$key = $this.val();
		if ($key.length > 0) {
			$.post('<?=BASEURL."home/patient-search-for-token"?>', {key: $key}, function(resp) {
				resp = $.parseJSON(resp);
				$("#dropdownPatientSearchList").html(resp.html);
				$("#dropdownPatientSearchList").show(0);
			});
		}
	});
	$(document).on('click', '#admitModal .selectPatientBtn', function(event) {
		event.preventDefault();
		$this = $(this);
		$("#createTokenInputPatientSearch").val($this.attr('data-title'));
		$("#admitModal input[name='patient_id']").val($this.attr('data-id'));
		$("#dropdownPatientSearchList").hide(0);
		$("#dropdownPatientSearchList").html('');
	});

	$(document).on('submit', '#admitModal form', function(event) {
		event.preventDefault();
		$form = $(this);
		$.post('<?=BASEURL."emergency/post-emergency-admit"?>', {data: $form.serialize()}, function(resp) {
			resp  = $.parseJSON(resp);
			alert(resp.msg);
			if (resp.status == true) {
				$("#patientsWrap").html(resp.html);
				$("#admitModal").modal('hide');
			}
		});
	});


});//onload
</script>



<!-- Modals -->
<div class="modal fade bd-example-modal-lg" id="admitModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel">Emergency Admit</h4>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
			</div><!-- /modal-header -->
			<div class="modal-body">

				<form>
					<input type="hidden" name="patient_id">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Patient</label>
								<input class="form-control" id="createTokenInputPatientSearch" placeholder="Search by name, mobile" type="text" required="">
								<div id="dropdownPatientSearchList" class="dropdown-patient-search-list"></div>
								<a href="javascript://" class="addPatientBtn">+ Add Patient</a>
							</div><!-- /form-group -->
						</div><!-- /12 -->
						<div class="col-md-12">
							<div class="form-group">
								<label>Service *</label>
								<select name="service_id" class="form-control" required>
									<option value="">Select</option>
									<?php foreach ($services as $key => $service): ?>
										<option value="<?=$service['service_id']?>"><?=$service['name']?></option>
									<?php endforeach ?>
								</select>
							</div><!-- /form-group -->
						</div><!-- /12 -->
						<div class="col-md-12">
							<div class="form-group">
								<label>Fee</label>
								<input class="form-control" type="text" name="fee" value="<?=$setting['fee']?>" readonly>
							</div><!-- /form-group -->
						</div><!-- /12 -->
						<div class="col-md-12">
							<div class="form-group">
								<label>Comment</label>
								<textarea name="comment" class="form-control"></textarea>
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
</div><!-- #admitModal -->


<style>
.dropdown-patient-search-list {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 300px;
    max-height: 300px;
    overflow: hidden;
    overflow-y: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 10000;
}
.dropdown-patient-search-list a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}
</style>